<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

class Lands_facebook extends MX_Controller {

      public $fbuser_id = null;
      public $lista_fanpages;
      public $fanpage;
      public $detalhes_fanpage;
      public $cliente_painel;
      public $client;
      public $mbc;
	  public $where_connection;
	  public $stat;

      function __construct() {
            parent::__construct();
            $config['appId'] = '509610239108521';
            $config['secret'] = '6d8f4135df68b31d5e98cf09532efa94';

            $this->load->library('lands_face', $config);
			//$this->where_connection="where Id_fanpage_txf='$fanpage_id'";
			$this->where_connection="where m.Tipo_sel='blog' and c.Id_fanpage_txf='".$config['appId']."'";
			$this->stat=$this->cria_conexao_cliente($this->where_connection);
      }

      public function lista_fanpages() {
            $this->fbuser_id = $this->lands_face->buscar_id_usuario();
            $qry = 'select page_id, fan_count, unread_message_count, name, pic  from page where page_id in (select page_id from page_admin where uid =' . $this->fbuser_id . ')';
            $this->lista_fanpages = $this->lands_face->sql($qry);
            $dados['lista_fanpages'] = $this->lista_fanpages;
            $this->smarty->assign("fanpages", $this->lista_fanpages);



            foreach ($this->lista_fanpages as $fp) {
                  $dados['notifications'][$fp->page_id] = $this->notifications($fp->page_id);
            }



            $this->render('lista_fanpages', $dados);
      }

      public function notifications($id = null) {


            $dados['notifications'] = $this->lands_face->get_notifications($id);
            $this->smarty->assign('not_index', $id);
            $this->smarty->assign("notifications", $dados['notifications']);
            $this->smarty->assign('pagina_notifications', $this->smarty->fetch('notifications.tpl'));


            return $dados['notifications'];
      }

      public function home() {
            $this->fbuser_id = $this->lands_face->buscar_id_usuario();
            $qry = 'select page_id, fan_count, unread_message_count, name, pic  from page where page_id in (select page_id from page_admin where uid =' . $this->fbuser_id . ')';

            if ($qry) {
                  $this->lista_fanpages = $this->lands_face->sql($qry);
                  $this->smarty->assign("fanpages", $this->lista_fanpages);
            }

            $dados = $this->get_profile($this->fbuser_id);


            $dados['notifications'][$this->fbuser_id] = $this->notifications($this->fbuser_id);
            $this->smarty->assign("notifications", $dados['notifications']);



            $this->render('home', $dados);
      }

      function index() {
            die('This core module dont have index');
      }

      function get($fanpage_id = 'me', $item = '') {
            $resultado = $this->lands_face->get($fanpage_id, $item);
            return $resultado;
      }

      function open($fanpage_id = 'me') {
            $dados = $this->get_profile($fanpage_id);
            $this->render('generico', $dados);
      }

      function get_profile($fanpage_id = 'me') {
            $dados['usuario'] = $this->lands_face->get($fanpage_id);
            $dados['posts'] = $this->lands_face->get($fanpage_id, 'feed');
            $dados['likes'] = $this->lands_face->get($fanpage_id, 'likes');


            $dados['friends'] = $this->lands_face->get($fanpage_id, 'friends');
            $this->smarty->assign("dados", $dados);

            foreach ($dados as $key => $value) {
                  $this->smarty->assign("$key", $value);
            }

            return $dados;
      }

      function page($fanpage_id) {

            $this->fanpage = $this->lands_face->buscar_fanpage($fanpage_id);
            $this->smarty->assign('fanpage', $this->fanpage);
            $dados['fanpage'] = $this->fanpage;

            $qry = 'select page_id, fan_count, unread_message_count, name, pic  from page where page_id =' . $fanpage_id;
            $this->detalhes_fanpage = $this->lands_face->sql($qry);
            $this->smarty->assign("pagina", $this->detalhes_fanpage);
            $dados['detalhes_fanpage'] = $this->detalhes_fanpage;




            $dados['notifications']['page_id'] = $this->notifications($fanpage_id);
            $this->smarty->assign("notifications", $dados['notifications']);



//            $notifications = $this->lands_face->buscar_algo($fanpage_id, 'notifications');
//            $this->smarty->assign('notifications', $notifications);
//            $dados['notifications'] = $notifications;

            $posts = $this->lands_face->buscar_algo($fanpage_id, 'feed');
            $this->smarty->assign('posts', $posts);
            $dados['posts'] = $posts;

//            echo '<pre>';
//            print_r($dados); die();

            if ($this->cria_conexao_cliente($fanpage_id) === true) {

                  $x = $this->mbc->executa_sql('select * from imagens');
                  $imagens = array();
                  if (isset($x)) {
                        foreach ($x as $img) {
                              $domin = $this->cliente_painel->Host_Ftp_txf;
                              $imagens[] = $domin . $img->Caminho_txf;
                        }

                        $this->smarty->assign('imagens', $imagens);
                        $dados['imagens'] = $imagens;
                  }
                  $status_cli = '<h5 style="color:green">Cliente com cadastro no Painel da Lands.</h5>';
                  $this->smarty->assign('status_cli', $status_cli);
            } else {
                  $status_cli = '<h5 style="color:red">Cliente SEM IMAGENS, pois não possui Painel  ou FanPage não cadastrada.</h5>';
                  $this->smarty->assign('status_cli', $status_cli);
            }


            /* $tabelas = $this->model_banco->executa_sql("show tables");
              print_r($tabelas);
              die(); */
            $this->smarty->assign('menu_fanpage', $this->smarty->fetch('menu_fanpage.tpl'));
            $this->render('fanpage', $dados);
      } 

      function meu_perfil() {
            $this->render('meu_perfil', $dados);
      }

      function render($pagina, $dados = null) {
            $this->smarty->assign('usuario_logado', $this->lands_face->buscar_usuario());
            $this->smarty->assign('css', $this->smarty->fetch('css.tpl'));
            $this->smarty->assign('topo', $this->smarty->fetch('topo/topo.tpl'));
            $this->smarty->assign('content', $this->smarty->fetch('paginas/' . $pagina . '.tpl'));


            echo $this->smarty->fetch('layout.tpl');
      }

      function blog($fanpage_id) {
            $dados = ''; // print_r('funcao blog pra o id ' . $fanpage_id . '<br>');
            if ($this->cria_conexao_cliente($fanpage_id, 'blog') === true) {
                  $dados['sql'] = "select p.*,i.Caminho_txf from post p left outer join imagens i on i.Id_imagem_con=p.Id_int and i.Tabela_con='post' where Ativo_sel='sim'";
                  $x = $this->mbc->executa_sql($dados['sql']);
                  $posts = array();
                  if (isset($x)) {
                        $domin = $this->cliente_painel->Host_modulo_txf;
                        $this->smarty->assign("dominio", $domin);

                        $dados['posts'] = $x;
                        $this->smarty->assign('posts', $dados['posts']);
                  }
                  $status_cli = '<h5 style="color:green">Cliente possui um blog com a Lands!.</h5>';
                  $this->smarty->assign('status_cli', $status_cli);
            } else {
                  $status_cli = '<h5 style="color:red">Cliente sem  blog</h5>';
                  $this->smarty->assign('status_cli', $status_cli);
            }
            $this->render('blog', $dados);
      }

      function cria_conexao_cliente($fanpage_id, $tipo = null) {
            //  print_r('cria_conexao_cliente ' . $fanpage_id . '<br>');
            if ($tipo == null) {
                  $this->load->database('default', null, true);
                  $cliente_painel = $this->model_banco->executa_sql("select  * from clientes ");
$cliente_painel = $this->model_banco->executa_sql("select  c.Id_int as Id_cliente_painel, m.* from clientes c left outer join modulos m on m.Id_objeto_con=c.Id_int $this->where_connection");


                  if (isset($cliente_painel[0]->Id_int)) {
                        //     print_r('cliente=<br>');
                        //     print_r($cliente_painel);
                        $this->cliente_painel = $cliente_painel[0];
                        $this->client = array(
                            'hostname' => $this->cliente_painel->Servidor_txf,
                            'username' => $this->cliente_painel->Usuario_bd_txf,
                            'password' => $this->cliente_painel->Senha_bd_txf,
                            'database' => $this->cliente_painel->Nome_bd_txf,
                            'dbdriver' => 'mysql',
                            'dbprefix' => '',
                            'pconnect' => TRUE,
                            'db_debug' => TRUE,
                            'cache_on' => FALSE,
                            'cachedir' => '',
                            'char_set' => 'utf8',
                            'dbcollat' => 'utf8_general_ci',
                            'swap_pre' => '',
                            'autoinit' => TRUE,
                            'stricton' => FALSE
                        );


                        $this->mbc = $this->load->model('model_banco_client', 'mbc', $this->client);
                        $this->mbc->db = $this->load->database($this->client, TRUE);
						$data['result']='ok';
						$data['mensagem']='Painel conectado!';
                        return json_encode($data);
                  } else {
                        return false;
                  }
            } else {

                  if ($tipo == 'blog') {
                        $this->load->database('default', null, true);
                        $cliente_painel = $this->model_banco->executa_sql("select  c.Id_int as Id_cliente_painel, m.* from clientes c left outer join modulos m on m.Id_objeto_con=c.Id_int where m.Tipo_sel='blog' and c.Id_fanpage_txf='$fanpage_id'");

                        if (isset($cliente_painel[0])) {
                              $this->cliente_painel = $cliente_painel[0];
                              $this->client = array(
                                  'hostname' => $this->cliente_painel->Servidor_bd_txf,
                                  'username' => $this->cliente_painel->Usuario_bd_txf,
                                  'password' => $this->cliente_painel->Senha_bd_txf,
                                  'database' => $this->cliente_painel->Nome_bd_txf,
                                  'dbdriver' => 'mysql',
                                  'dbprefix' => '',
                                  'pconnect' => TRUE,
                                  'db_debug' => TRUE,
                                  'cache_on' => FALSE,
                                  'cachedir' => '',
                                  'char_set' => 'utf8',
                                  'dbcollat' => 'utf8_general_ci',
                                  'swap_pre' => '',
                                  'autoinit' => TRUE,
                                  'stricton' => FALSE
                              );


                              $this->mbc = $this->load->model('model_banco_client', 'mbc', $this->client);
                              $this->mbc->db = $this->load->database($this->client, TRUE);
                              return true;
                        } else {
                              return false;
                              die('cliente nao possui blog<br>');
                        }
                  }
                  //  print_r('cria conexao com blogs<br>');
            }
      }

      function postar() {
            $this->load->helper('url');

            $this->smarty->assign('data_atual', date("Y/m/d"));

            if (isset($_REQUEST['fanpage_id'])) {
                  $this->fanpage_id = $_REQUEST['fanpage_id'];
            } else {
                  $this->fanpage_id = $this->uri->segment(2);
            }

            if (!isset($_REQUEST['message'])) {
                  redirect($this->fanpage_id);
            }

            if (isset($_REQUEST['message']) and $_REQUEST['message'] != '') {
                  $postou = $this->lands_face->postar($this->fanpage_id);
                  $x = "<script>
                  alert('$postou'); </script>";

                  echo $x;
                  $this->smarty->assign('retorno', $postou);
            }
            $this->page($this->fanpage_id);
      }

}