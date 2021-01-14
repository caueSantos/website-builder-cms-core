<?php

require_once(COMMONPATH . 'core/lands_core.php');

/**
 * Constructor
 *
 * @access public
 */
class lands_labcloud extends lands_core {

      public $modulo = 'hiperofertas';
      public $namespace_empresa = '';
      public $usuario = '';
      public $admin = '';
      public $configuracoes;
      public $empresa;
      public $configuracoes_empresa;
      public $modulos_empresa;

      public function __construct() {

            parent::__construct();
            $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);
            $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);
            $this->conecta_mbc($this->app->Conexoes_for);
            $this->carrega_obrigatorios();
            $this->load->database('default', null, true);
      }

      function index() {
            die('nao tem index');
      }

      function checa_ativacao_usuario() {
            $this->checa_login();

            if ($this->usuario->Ativo_sel == 'NAO') {
                  $this->model_smarty->carrega_bloco('usuario_inativo', 'usuario_inativo', $this->app->Template_txf);
            }
      }

      function checa_login() {
            if (!isset($this->session->userdata['usuario'])) {
//modules::run('login');


                  if (isset($_SERVER['REDIRECT_URL'])) {
                        $pagina_atual = '/';
                        foreach ($this->uri->segments as $segmento) {
                              $pagina_atual.=$segmento . '/';
                        }
                        if ($this->namespace_empresa) {
                              redirect("login?redirect_link=$pagina_atual&empresa={$this->namespace_empresa}");
                        } else {
                              redirect("login?redirect_link=$pagina_atual");
                        }
                  } else {
                        redirect("login");
                  }
            } else {
                  $this->smarty->assign('usuario_logado', $this->session->userdata['usuario']);
                  return true;
            }
      }

      function carrega_promocao() {
            
      }

## OVERRIDE ##

      function carrega_obrigatorios() {
//carrega lista de emrpesas
            $empresas = $this->mbc->buscar_completo("empresas", "where Ativo_sel='SIM' order by Nome_txf");
            if (isset($empresas[0]->Id_int)) {
                  $this->smarty->assign('empresas', $empresas);
            } else {
                  die('Nenhuma empresa no momento');
            }

            $configuracoes = $this->mbc->buscar_tudo("configuracoes");
            $this->configuracoes = $configuracoes[0];
            $this->smarty->assign('configuracoes', $this->configuracoes);

// $this->carrega_admin();
      }

      function busca_usuario() {
            $usuario = $this->session->userdata['usuario']->Usuario_txf;
            $senha = $this->session->userdata['usuario']->Senha_txf;
            $namespace = $this->session->userdata['usuario']->Namespace_empresa_sel;
            $usuario = $this->mbc->buscar_completo("usuarios", "where Usuario_txf='{$usuario}' and Senha_txf='{$senha}' and  Namespace_empresa_sel='{$namespace}'");
            if ($usuario[0]) {
                  $this->usuario = $usuario[0];
                  $this->smarty->assign('usuario', $this->usuario);
            }
      }

      function configura_usuario() {
            $usuario = $this->session->userdata['usuario']->Usuario_txf;
            $senha = $this->session->userdata['usuario']->Senha_txf;
            $namespace = $this->session->userdata['usuario']->Namespace_empresa_sel;


            $sql = "select * from usuarios where Usuario_txf='{$usuario}' and Senha_txf='{$senha}' and Namespace_empresa_sel='{$namespace}'";

            $usuario = $this->mbc->executa_sql($sql);
            if ($usuario[0]) {
                  $this->usuario = $usuario[0];
                  $this->smarty->assign('usuario', $this->usuario);
                  if ($this->namespace_empresa) {
                        if ($namespace != $this->namespace_empresa) {
                              redirect('acesso_invalido');
                        }
                  }
            } else {
                  if ($namespace != $this->namespace_empresa) {
                        redirect('acesso_invalido');
                  }
                  $this->usuario = $this->session->userdata['usuario'];
                  if ($this->insere_usuario()) {
                        $this->configura_usuario();
                  } else {
                        die("ERRO AO INSERIR NOVO USUÁRIO");
                  }
            }
//cria usuario automaticamente
// $this->session->set_userdata('usuario', $this->usuario);
      }

      function insere_usuario() {
            $usuario_inserir['Usuario_txf'] = $this->usuario->Usuario_txf;
            $usuario_inserir['Senha_txf'] = $this->usuario->Senha_txf;
            $usuario_inserir['Namespace_empresa_sel'] = $this->usuario->Namespace_empresa_sel;
            $usuario_inserir['Ativo_sel'] = 'NAO';

            if ($this->mbc->db_insert('usuarios', $usuario_inserir)) {
                  return true;
            } else {
                  return false;
            }
      }

      /*      function carrega_admin() {
        $sql = "select * from administradores where ( Ativo_sel='SIM' and  Namespace_empresa_sel='TODAS')";
        if (isset($this->namespace_empresa)) {
        $sql.=" or ( Ativo_sel='SIM' and Namespace_empresa_sel='{$this->namespace_empresa}' )";
        }
        $admin = $this->mbc->executa_sql($sql);
        if (isset($admin[0]->Id_int)) {

        foreach ($admin as $adm) {
        $adm_id = explode('/', $adm->Usuario_sel);
        $adm->Nome_txf = $adm_id[0];
        $adm->Facebook_id_txf = $adm_id[1];

        if ($adm->Facebook_id_txf == $this->usuario->Facebook_id_txf) {
        $this->smarty->assign('admin', $adm);
        $this->admin = $adm;

        $this->model_smarty->carrega_bloco('admin', 'admin', $this->app->Template_txf);
        }
        }
        }
        return $admin;
        }
       */

      function carrega_namespace_empresa($namespace = null) {
            if (isset($namespace)) {
                  $this->namespace_empresa = $namespace;
            } else {
                  $this->namespace_empresa = $this->uri->segment($this->app->Segmento_padrao_txf);
            }

            $this->checa_login($this->namespace_empresa);
            $this->smarty->assign('namespace_empresa', $this->namespace_empresa);

            if (($this->uri->segment($this->app->Segmento_padrao_txf + 1)) && (!is_numeric($this->uri->segment($this->app->Segmento_padrao_txf + 1)))) {
                  $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
            } else {
                  $this->pagina_atual = 'principal';
            }
//   $this->carrega_admin();

            $this->carrega_empresa();
            $this->configura_usuario();
            $this->switch_pagina_empresa($this->pagina_atual);
      }

      function carrega_namespace_empresa_admin() {
            $this->checa_ativacao_usuario();
            $this->verifica_admin();
            $this->namespace_empresa = $this->usuario->Namespace_empresa_sel;

            $this->checa_login($this->namespace_empresa);
            $this->smarty->assign('namespace_empresa', $this->namespace_empresa);

            if (($this->uri->segment($this->app->Segmento_padrao_txf + 1)) && (!is_numeric($this->uri->segment($this->app->Segmento_padrao_txf + 1)))) {
                  $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
            } else {
                  $this->pagina_atual = 'principal_admin';
            }



            $this->carrega_empresa();
            $this->switch_pagina_admin($this->pagina_atual);
      }

      function carrega_empresa($namespace = null) {
            if (isset($namespace)) {
                  $this->namespace_empresa = $namespace;
            }

            $empresa = $this->mbc->buscar_completo("empresas", "where Id_int is not null and Namespace_txf='{$this->namespace_empresa}'");

            if (isset($empresa[0]->Id_int)) {
                  $this->smarty->assign('namespace_empresa', $this->namespace_empresa);
                  $this->smarty->assign('empresa', $empresa[0]);
                  $this->empresa = $empresa[0];
                  /* $this->model_smarty->carrega_bloco('logo_empresa', 'logo_empresa', $this->app->Template_txf);
                    $this->model_smarty->carrega_bloco('fanpage', 'fanpage', $this->app->Template_txf);
                    $this->model_smarty->carrega_bloco('contato', 'contato', $this->app->Template_txf);
                    $this->model_smarty->carrega_bloco('formulario_contato', 'formulario_contato', $this->app->Template_txf);
                    $this->model_smarty->carrega_bloco('cabecalho', 'cabecalho', $this->app->Template_txf);
                   * */
            } else {
                  die('Empresa ou pagina nao encontrada');
            }

            $this->carrega_configuracoes_empresa($this->namespace_empresa);
            $this->carrega_modulos_empresa($this->namespace_empresa);
      }

      function carrega_configuracoes_empresa($namespace = 'TODAS') {
            $sql = "select * from empresas_configs where Namespace_empresa_sel='{$namespace}'";
            $configuracoes = $this->mbc->executa_sql($sql);
            $this->configuracoes_empresa = $configuracoes[0];
            $this->smarty->assign('configuracoes_empresa', $this->configuracoes_empresa);
      }

      function carrega_modulos_empresa($namespace = 'TODAS') {
            $sql = "select * from empresas_modulos where Namespace_empresa_sel='{$namespace}'";
            $configuracoes = $this->mbc->executa_sql($sql);
            $this->modulos_empresa = $configuracoes[0];
            $this->smarty->assign('modulos_empresa', $this->modulos_empresa);
            $this->model_smarty->carrega_bloco('modulos', 'modulos', $this->app->Template_txf);
            $this->model_smarty->carrega_bloco('menu_laboratorio', 'menu_laboratorio', $this->app->Template_txf);
      }

      function verifica_admin() {

            if ($this->usuario->Admin_sel == 'SIM') {
                  $this->admin = $this->usuario;
                  $this->smarty->assign("admin", $this->admin);
            } else {
                  redirect($this->app->Url_cliente . "acesso_negado_admin");
            }
      }

      function verifica_autorizacao_modulo($modulo) {
            switch ($modulo) {
                  case 'resultados':
                        if ($this->modulos_empresa->Resultados_txf != 'SIM') {
                              redirect($this->app->Url_cliente . "acesso_negado");
                        }
                        break;
                  case 'avisos':
                        if ($this->modulos_empresa->Avisos_txf != 'SIM') {
                              redirect($this->app->Url_cliente . "acesso_negado");
                        }
                        break;
                  case 'formulario_materiais':
                        if ($this->modulos_empresa->Solicitacao_materiais_txf != 'SIM') {
                              redirect($this->app->Url_cliente . "acesso_negado");
                        }
                        break;
                  case 'formulario_exames':
                        if ($this->modulos_empresa->Solicitacao_exames_txf != 'SIM') {
                              redirect($this->app->Url_cliente . "acesso_negado");
                        }

                        break;
                  case 'formulario_orcamento':
                        if ($this->modulos_empresa->Solicitacao_exames_txf != 'SIM') {
                              redirect($this->app->Url_cliente . "acesso_negado");
                        }
                        break;
                  case 'exames':
                        if ($this->modulos_empresa->Exames_txf != 'SIM') {
                              redirect($this->app->Url_cliente . "acesso_negado");
                        }
                        break;
                  case 'filtro_exames':
                        if ($this->modulos_empresa->Exames_txf != 'SIM') {
                              redirect($this->app->Url_cliente . "acesso_negado");
                        }
                        break;
            }
      }

      function carrega_bloco_formulario() {
            if ($this->promocao[0]->Bloco_formulario_txf == 'padrao') {
                  $this->model_smarty->carrega_tpl_modulo($this->app->Template_txf, 'formularios', 'padrao', 'formulario');
            } else {
                  $this->model_smarty->carrega_tpl_modulo($this->app->Template_txf, 'formularios/' . $this->namespace_empresa, $this->promocao[0]->Bloco_formulario_txf, 'formulario');
            }
      }

      function conecta_ftp($dados) {
            $this->load->library('ftp');
            $config['hostname'] = $dados->Ftp_host_txf;
            $config['username'] = $dados->Ftp_user_txf;
            $config['password'] = $dados->Ftp_pass_txf;
            $config['debug'] = FALSE;
            return $this->ftp->connect($config);
      }

      function fazer_login() {
            $namespace_empresa = $_POST['Namespace_empresa_txf'];
            $login = $_POST['Usuario_txf'];
            $senha = $_POST['Senha_txf'];
            $pasta.=$login . '-' . $senha;
            $pasta.='/';
            $this->carrega_empresa($namespace_empresa);

            if (!$this->conecta_ftp($this->configuracoes_empresa)) {
                  $this->smarty->assign('mensagem', 'ftp_erro');
                  $this->model_smarty->render_ajax('msg_login', $this->app->Template_txf);
                  die();
            }
            $pasta = $this->configuracoes_empresa->Ftp_path_txf . $pasta;
            $list = $this->ftp->list_files($pasta);
            if ($list) {
                  $pasta_final = $this->app->Url_cliente . $pasta;
                  $usuario = new StdClass;
                  $usuario->Usuario_txf = $login;
                  $usuario->Senha_txf = $senha;
                  $usuario->Namespace_empresa_sel = $namespace_empresa;

                  $this->session->set_userdata('usuario', $usuario);
                  $this->smarty->assign('mensagem', 'login_ok');
                  $this->model_smarty->render_ajax('msg_login', $this->app->Template_txf);
                  redireciona($this->app->Url_cliente . $this->namespace_empresa);
                  die();
            } else {
                  $this->smarty->assign('mensagem', 'login_erro');
                  $this->model_smarty->render_ajax('msg_login', $this->app->Template_txf);
                  die();
            }
      }

      function altera_insere_registro() {

            $dados = $_POST;
            if (!$dados['Tabela_txf']) {

                  die('Campo Tabela_txf nao encontrado');
            }



            if (!$dados['Id_int']) {
                  if ($this->mbc->db_insert($dados['Tabela_txf'], $_POST)) {
                        $this->smarty->assign('mensagem', 'inseriu_ok');
                        $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                  } else {
                        $this->smarty->assign('mensagem', 'inseriu_erro');
                        $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                  }
            } else {
                  if ($this->mbc->updateTable($dados['Tabela_txf'], $_POST, 'Id_int', $dados['Id_int'])) {
                        $this->smarty->assign('mensagem', 'atualizacao_ok');
                        $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                  } else {
                        $this->smarty->assign('mensagem', 'atualizacao_erro');
                        $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                  }
            }
      }

      function exclui_registro() {

            $dados = $_POST;
            if (!$dados['Tabela_txf']) {
                  die('Campo Tabela_txf nao encontrado');
            }
            if (!$dados['Id_int']) {
                  die('Id_in nao passado');
            }
            $tabela = $_POST['Tabela_txf'];
            $id = $_POST['Id_int'];
    
            
            $sql= "select * from $tabela where Id_int=$id";
            $registro=$this->mbc->executa_sql($sql);
           
            if ($registro[0]) {
                  if ($this->mbc->db_delete($tabela, 'Id_int', $id)) {
                        $this->smarty->assign('mensagem', 'excluiu_ok');
                        $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                  } else {
                        $this->smarty->assign('mensagem', 'excluiu_erro');
                        $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                  }
            } else {
                  $this->smarty->assign('mensagem', 'registro_inexistente');
                  $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            }
      }

      function grava_log_acesso($pagina = null) {
//    if ($_SERVER['REMOTE_ADDR'] != IP_LANDS) {
            $array['Facebook_id_txf'] = $this->fbuser;
            $array['Nome_txf'] = $this->fb_name;
            if (!isset($pagina)) {
                  $array['Pagina_txf'] = $this->pagina_atual;
            } else {
                  $array['Pagina_txf'] = $pagina;
            }
            $array['Namespace_empresa_txf'] = $this->namespace_empresa;
            $array['Namespace_promocao_txf'] = $this->namespace_promocao;
            if (isset($this->promocao)) {
                  $array['Id_promocao_txf'] = $this->promocao->Id_int;
            }

            $hora = date('H');
            $hora = $hora + 5;
            $dia = date('Y-m-d');
            $hora = $hora . date(':i:s');
            $array['Data_dat'] = $dia;
            $array['Data_hora_dat'] = $dia . ' ' . $hora;
            $this->mbc->db_insert('acessos', $array);
      }

}