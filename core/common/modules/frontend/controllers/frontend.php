<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class frontend extends lands_core {

    public function __construct() {

        parent::__construct();

        $this->load->helper('tradutor');
        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);



    }

    function index() {
        if (!method_exists(__CLASS__, $this->pagina_atual)) {

            try {
                $this->carrega_pagina($this->pagina_atual);
            } catch (Exception $exc) {
                ver($exc->getTraceAsString());
            }
        } else {
            $funcao_atual = $this->pagina_atual;
            //executa uma funcao que deve ser programa nesta classe.
            $this->$funcao_atual();
        }
    }


      function verifica_jobs() {

          if($this->uri->segment(2)){
              $limit = $this->uri->segment(2);

          } else {
              $limit = 5;
          }

        $jobs = $this->model_banco->executa_sql("select * from mautic_job where Lands_id='{$this->app->Lands_id}' order by Id_int desc limit $limit
        ");
        foreach ($jobs as $job) {
            $job->dados = json_decode($job->Dados_jso);
            unset($job->Dados_jso);
        }
        ver($jobs);
    }

    function migracao($segment = null) {


        $segment = $this->uri->segment(2);

        $cat = array();
        switch ($segment) {
            case 'categorias':
                die('ja importou');
                $categorias = $this->mbc->executa_sql("select * from categoria_gota");
                foreach ($categorias as $categoria) {
                    $categoria_inserir = new stdClass();
                    $categoria_inserir->Nome_tit = $categoria->titulo;
                    $categoria_inserir->Nome_url = url_title($categoria->titulo);


                    $categoria_inserir->Ativo_sel = 'SIM';
                    $cat[] = $categoria_inserir;
                }

                foreach ($cat as $produto) {
                    $array = object_to_array($produto);

                    echo "inseriu categproa {$produto->Nome_tit}<br>";
                    $this->mbc->db_insert('produtos_categorias_temp', $array);
                }
                break;

            case 'marcas':
                die('ja importou');
                $marcas = $this->mbc->executa_sql("select * from marca_gota");
                foreach ($marcas as $marca) {
                    $marca_inserir = new stdClass();
                    $marca_inserir->Nome_tit = $marca->titulo;
                    $marca_inserir->Nome_url = url_title($marca->titulo);
                    $marca_inserir->Imagem_ico = $marca->logo;

                    $marca_inserir->Ativo_sel = 'SIM';
                    $mar[] = $marca_inserir;
                }


                foreach ($mar as $produto) {
                    $array = object_to_array($produto);

                    echo "inseriu marca {$produto->Nome_tit}<br>";
                    $this->mbc->db_insert('marcas_temp', $array);
                }

                break;
            case 'imagens':
                die('ja importou');
                $produtos = $this->mbc->executa_sql("select * from produtos_temp");
                foreach ($produtos as $produto) {
                    $imagems = array();
                    $imagems = $this->mbc->executa_sql("select * from produtos_gota_imagem where id_produto={$produto->id_antigo}");
                    $array_imagems = array();
                    foreach ($imagems as $imagem) {
                        $obj = new stdClass();
                        $obj->Tabela_con = 'produtos_temp';
                        $obj->Id_imagem_con = $produto->Id_int;
                        $obj->Campo_sel = 'Imagens_ico';
                        $obj->Caminho_txf = 'img/' . $this->mbc->db->database . '/' . $imagem->imagem;

                        $array = object_to_array($obj);

                        echo "inseriu imagem<br>";
                        $this->mbc->db_insert('imagens', $array);

                        $array_imagems[] = $obj;
                    }
                    $produto->imagens = $array_imagems;
                }


                break;

            case 'videos':

                $produtos = $this->mbc->executa_sql("select * from produtos_temp");
                foreach ($produtos as $produto) {
                    $videos = array();

                    $videos = $this->mbc->executa_sql("select * from produtos_gota_video  where id_produto={$produto->id_antigo}");
                    if ($videos[0]) {
                        ver($videos);


                        $array_videos = array();
                        foreach ($videos as $imagem) {
                            $obj = new stdClass();
                            $obj->Tabela_con = 'produtos_temp';
                            $obj->Id_imagem_con = $produto->Id_int;
                            $obj->Campo_sel = 'Videos_ico';
                            $obj->Caminho_txf = 'img/' . $this->mbc->db->database . '/' . $imagem->imagem;

                            $array = object_to_array($obj);

                            echo "inseriu imagem<br>";
                            $this->mbc->db_insert('videos', $array);

                            $array_videos[] = $obj;
                        }
                    } else {
                        echo "produto {$produto->id_antigo} sem vídeos<br>";
                    }

                    $produto->videos = $array_videos;
                }


                break;


            case 'produtos':
                die('ja importou');
                $prod = array();
                $produtos = $this->mbc->executa_sql("select * from produtos_gota");

                foreach ($produtos as $produto) {

                    $newprod = new stdClass();

                    $y = '';
                    $x = '';

                    $newprod->id_antigo = $produto->id;
                    $newprod->Nome_txf = $produto->titulo;
                    $newprod->Categoria_sel = '';
                    if ($produto->id_categoria) {
                        $categoria = $this->mbc->executa_sql("select * from categoria_gota where id={$produto->id_categoria}");
                        $x = $categoria[0];

                        $newprod->Categoria_sel = url_title($x->titulo);
                    }
                    $newprod->Departamento_sel = '';
                    $newprod->Marca_sel = '';
                    if ($produto->id_marca) {

                        $marca = $this->mbc->executa_sql("select * from marca_gota where id={$produto->id_marca}");
                        $y = $marca[0];
                        $newprod->Marca_sel = url_title($y->titulo);
                    }
                    $newprod->Link_loja_txf = '';
                    $newprod->Descricao_txa = $produto->descricao;
                    $newprod->Aplicacao_txa = $produto->aplicacao;
                    $newprod->Info_txa = $produto->info;
                    $newprod->Ativo_sel = 'NAO';


                    $prod[] = $newprod;

//                    $produto->Categoria = array();
//                    $produto->Marca = array();
//                    $produto->Imagens = array();
//                    $produto->Videos = array();
//                    if ($produto->id_categoria) {
//                        $cat = $this->mbc->executa_sql("select * from categoria_gota where id={$produto->id_categoria}");
//                        $produto->Categoria = $cat[0];
//                    }
//                    if ($produto->id_marca) {
//                        $marca = $this->mbc->executa_sql("select * from marca_gota where id={$produto->id_marca}");
//                        $produto->Marca = $marca[0];
//                        $produto->Marca_sel = url_title($produto->Marca->titulo);
//                    }
//                    $produto->Imagens = $this->mbc->executa_sql("select * from produtos_gota_imagem where id_produto={$produto->id}");
//                    $produto->Videos = $this->mbc->executa_sql("select * from produtos_gota_video where id_produto={$produto->id}");
                }

                foreach ($prod as $produto) {
                    $array = object_to_array($produto);
                    echo "inseriu produto {$produto->Nome_txf}<br>";
                    $this->mbc->db_insert('produtos_temp', $array);
                }
                die();



                break;


            default:
                die('defina a tabela q quer migrar');
                break;
        }
    }

    function switch_pagina() {



        switch ($this->pagina_atual) {

            case 'lista_comparacao' :

                $this->conecta_mbc($this->app->Conexoes_for);
                if (isset($this->session->userdata['tabela'])) {
                    $tabela = $this->session->userdata['tabela'];
                } else {
                    die('tabela de comparacao nao encontrada na sessao');
                }


                if (isset($this->session->userdata['item1'])) {
                    $id1 = $this->session->userdata['item1']->Id_int;
                    $item1 = $this->mbc->buscar_registro_imagens_videos($tabela, "where Id_int=$id1");
                    $this->smarty->assign('item1', $item1[0]);
                }
                if (isset($this->session->userdata['item2'])) {
                    $id2 = $this->session->userdata['item2']->Id_int;
                    $item2 = $this->mbc->buscar_registro_imagens_videos($tabela, "where Id_int=$id2");
                    $this->smarty->assign('item2', $item2[0]);
                }
                if (isset($this->session->userdata['item3'])) {
                    $id3 = $this->session->userdata['item3']->Id_int;
                    $item3 = $this->mbc->buscar_registro_imagens_videos($tabela, "where Id_int=$id3");
                    $this->smarty->assign('item3', $item3[0]);
                }

                break;

            case 'busca':
//                if($this->app->Lands_id=='girassol') {
//                print_r($_POST);
//                d
//                verie();
//                }

                $this->fazer_busca();
                break;


            case 'overview':
                $this->conecta_mbc(257);


                $atividades = $this->mbc->executa_sql("select * from activity where event_id=2 order by start_date");
                foreach ($atividades as $atividade) {
//                    $atividade->subscribes=$this->mbc->executa_sql("select * from subscribes where event_subscribe_type_id is null");
                    $atividade->members = $this->mbc->executa_sql("
                        select s.*, po.status as pagto from ticket_activity ta
                        left outer join subscribe_ticket_activity sta on sta.ticket_activity_id=ta.id
                        left outer join subscribe s on sta.subscribe_id=s.id
                        left outer join purchase_order po on po.id=purchase_order_id
                        where ta.activity_id={$atividade->id}  and s.id is not null order by pagto, name
                        ");

//                        ver($atividade->members);
                }

                foreach ($atividades as $atividade) {
                    $atividade->vendas = count($atividade->members);
                    $atividade->pagos = conta($atividade->members, 'pagto', 'PAID');
                    $atividade->aguardando = conta($atividade->members, 'pagto', 'WAITING');
                    $atividade->cancelados = conta($atividade->members, 'pagto', 'NOT_PAID');
                }


//                sorteia_array_objetos($atividades, array('vendas' => SORT_DESC));

                $this->smarty->assign("atividades", $atividades);
//
//                ver($atividades);


                break;

            case 'checkins':


                $this->conecta_mbc(257);


                if ($_REQUEST['data']) {
                    $data = $_REQUEST['data'];
                    $wheredata = " and c.created_at BETWEEN '{$data} 00:00:00' and '{$data} 23:59:59'";
                }

                $sql = "select u.name, u.email, u.id as user_id from checkin c left outer join user u on u.id=c.user_id where event_id=2 $wheredata group by user_id order by u.name";

//                ver($sql);
//

                $checkins = $this->mbc->executa_sql($sql);


                $this->smarty->assign("checkins", $checkins);


                break;
            case 'clientes-whmcs':


                $this->conecta_mbc(94);


//                if ($_REQUEST['data']) {
//                    $data = $_REQUEST['data'];
//                    $wheredata = " and c.created_at BETWEEN '{$data} 00:00:00' and '{$data} 23:59:59'";
//                }
//                $clientes=$this->mbc->executaq_sql("");

                $sql = "select id, firstname, lastname, companyname, email, phonenumber from tblclients where city='Lages'";

//                ver($sql);
//

                $clientes = $this->mbc->executa_sql($sql);
                foreach ($clientes as $cliente) {
                    $cnpjs = $this->mbc->executa_sql("select *  from tblcustomfieldsvalues where fieldid=1 and relid={$cliente->id}");
                    if ($cnpjs[0]) {
                        $cliente->cnpj = $cnpjs[0]->value;
                    } else {
                        $cliente->cnpj = null;
                    }
                     $cpfs = $this->mbc->executa_sql("select *  from tblcustomfieldsvalues where fieldid=15 and relid={$cliente->id}");
                    if ($cpfs[0]) {
                        $cliente->cpf = $cpfs[0]->value;
                    } else {
                        $cliente->cpf = null;
                    }
                }



                $this->smarty->assign("clientes", $clientes);


                break;

            case 'enviar-emails':
                $this->conecta_mbc(257);

                $sql = "select u.* from user u where  enviado=0 order by u.name limit 100";
                $cadastros = $this->mbc->executa_sql($sql);

                if ($cadastros[0]) {
                    foreach ($cadastros as $cadastro) {
                        $dados = new stdClass();
                        $dados->From = 'contato@conexaoserra.com';
                        $dados->FromName = ('Conexão Serra');
                        $caminho = COMMONPATH . "../templates/{$this->app->Template_txf}/email/cadastro.tpl";
                        $dados->Subject = ('Certificado Conexão Serra');
                        $this->smarty->assign('cadastro', $cadastro);
                        $mensagem = $this->smarty->fetch($caminho);
//                    ver($mensagem);
//                    print_r($mensagem);
//                    die();
                        $dados->Body = ($mensagem);

                        if ($this->envia_email_aws($dados, $cadastro->email)) {
                            $cont = $cont + 1;
                            $atu = array();
                            $atu['enviado'] = 1;
                            $this->mbc->updateTable('user', $atu, 'id', $cadastro->id);

                            echo "Email enviado para {$cadastro->email} <br>";
                        } else {
                            echo "Erro ao enviar email para  {$cadastro->email} <br>";
                        }
                    }
                    echo "<br><br>Email enviado para $cont pessoas";
                } else {
                    die('Todos os emails foram enviados');
                }
//
                die();


                break;

            case 'cadastros':
                $this->conecta_mbc(257);
                $sql = "select u.* from user u order by u.name";
                $cadastros = $this->mbc->executa_sql($sql);
                foreach ($cadastros as $cadastro) {
                    $cadastro->extras = $this->mbc->executa_sql("select * from user_detail where user_id={$cadastro->id}");
                }
                $this->smarty->assign("cadastros", $cadastros);
                break;
            case 'atualizar_cadastro':
                $this->conecta_mbc(257);

                $user_id = $_REQUEST['uid'];
                $email = $_REQUEST['email'];
                $sql = "select u.* from user u where id=$user_id and email='$email' order by u.name";
                $cadastros = $this->mbc->executa_sql($sql);

                foreach ($cadastros as $cadastro) {
                    $extras = $this->mbc->executa_sql("select * from user_detail where user_id={$cadastro->id}");
                    foreach ($extras as $extra) {
                        $key = $extra->detail;
                        $value = $extra->value;
                        $cadastro->extras->$key = $value;
                    }
                }
                $this->smarty->assign("cadastro", $cadastros[0]);
                break;

            case 'cadastro-save':
                $this->conecta_mbc(257);


                $cadastro_post = $_POST;
                unset($cadastro_post['id']);

                if ($_POST['id']) {
                    $id = $_POST['id'];
                    $cadastro_bd = $this->mbc->executa_sql("select * from user where id=$id");



                    if ($cadastro_bd[0]) {
                        $this->mbc->updateTable("user", $cadastro_post, 'id', $id, TRUE);



                        $extras = $this->mbc->executa_sql("select * from user_detail where user_id={$id}");
                        if ($extras[0]) {
                            $this->mbc->myquery("delete from user_detail where user_id={$id}");
                        }
                        foreach ($_POST['information'] as $key => $value) {
                            $array_objeto['user_id'] = $id;
                            $array_objeto['detail'] = $key;
                            $array_objeto['value'] = $value;
                            $this->mbc->db_insert('user_detail', $array_objeto);
                        }

                        $this->smarty->assign("mensagem", 'salvou_ok');
                    } else {
                        $this->smarty->assign("mensagem", 'salvou_erro');
                    }
                } else {
                    $this->smarty->assign("mensagem", 'salvou_erro');
                }

                $this->model_smarty->render_ajax('cadastro-msg', $this->app->Template_txf);

                die();
                break;
            case 'vouchers':

                $this->checa_login('vouchers');
                $this->conecta_mbc(257);


                $vouchers = $this->mbc->executa_sql("select * from voucher where event_id=2 ");


                foreach ($vouchers as $voucher) {

                    $voucher->tickets = $this->mbc->executa_sql("select t.* from voucher_ticket vt left outer join ticket t on t.id=vt.ticket_id where vt.voucher_id=$voucher->id");
                    $voucher->subscribes = $this->mbc->executa_sql("select * from subscribe where voucher_id={$voucher->id}");
                    if ($voucher->subscribes[0]) {
                        $voucher->utilizados = count($voucher->subscribes);
                    } else {
                        $voucher->utilizados = 0;
                    }
                    $voucher->restantes = $voucher->quantity - $voucher->utilizados;
                }



                $this->smarty->assign("vouchers", $vouchers);

                break;

            case 'voucher-edit':
                $this->conecta_mbc(257);

                if ($_POST['Id_int']) {
                    $id = $_POST['Id_int'];
                    $var = $this->mbc->executa_sql("select * from voucher where id={$id}");
                    if ($var[0]) {
                        $registro = $var[0];
                    }
                    $registro->tickets = $this->mbc->executa_sql("select t.* from voucher_ticket vt left outer join ticket t on t.id=vt.ticket_id where vt.voucher_id=$id");
                }



                $tickets = $this->mbc->executa_sql("select * from ticket where exclusive_code is null and event_id=2");


                $this->smarty->assign("tickets", $tickets);

                $this->smarty->assign("registro", $registro);

                $this->model_smarty->render_ajax('voucher-edit', $this->app->Template_txf);
                die();
                break;


            case 'voucher-delete':

                $this->conecta_mbc(257);
                if ($_POST['id']) {
                    $id = $_POST['id'];
                    $subscribes = $this->mbc->executa_sql("select * from subscribe where voucher_id={$id}");

                    if (!$subscribes[0]) {

                        $voucher_tickets = $this->mbc->executa_sql("select * from voucher_ticket where voucher_id=$id");
                        if ($voucher_tickets[0]) {
                            $this->mbc->myquery("delete from voucher_ticket where voucher_id={$id}");
                        }
                        $deletou = $this->mbc->db_delete('voucher', 'id', $id);
                        if ($deletou) {
                            $this->smarty->assign("mensagem", 'salvou_ok');
                        } else {
                            $this->smarty->assign("mensagem", 'salvou_erro');
                        }
                    } else {
                        $this->smarty->assign("mensagem", 'tem_subscribe');
                    }
                } else {
                    $this->smarty->assign("mensagem", 'salvou_erro');
                }

                $this->model_smarty->render_ajax('voucher-msg', $this->app->Template_txf);
                die();
                break;
            case 'voucher-save':


                $this->conecta_mbc(257);

                $voucherpost = $_POST;
                unset($voucherpost['id']);

                if ($_POST['id']) {

                    $id = $_POST['id'];


                    $voucher_bd = $this->mbc->updateTable("voucher", $voucherpost, 'id', $id, TRUE);
                } else {

                    $voucher_bd = $this->mbc->db_insert("voucher", $voucherpost);
                    $inserido = $this->mbc->executa_sql("select * from voucher order by id desc");
                    $voucher_bd = $inserido[0];
                }


                if ($_POST['tickets'][0]) {

                    if ($_POST['id']) {
                        $this->mbc->myquery("delete from voucher_ticket where voucher_id={$voucher_bd->id}");
                    }
                    foreach ($_POST['tickets'] as $ticket) {
                        $array_insert = array();
                        $array_insert['ticket_id'] = $ticket;
                        $array_insert['voucher_id'] = $voucher_bd->id;
                        $this->mbc->db_insert('voucher_ticket', $array_insert);
                    }
                }

                if ($voucher_bd) {
                    $this->smarty->assign("mensagem", 'salvou_ok');
                } else {
                    $this->smarty->assign("mensagem", 'salvou_erro');
                }

                $this->model_smarty->render_ajax('voucher-msg', $this->app->Template_txf);

                die();
                break;


            case 'boleto':
                header('Content-type: text/html; charset=utf-8');
                $this->load->library('lands_boleto');
                //      $this->lands_boleto->loadBanco('104');
                //   ver($this->lands_boleto);
                $this->lands_boleto->cria();
                die();
                break;
            case 'restclient':

                $nome_funcao = $this->uri->segment($this->app->Segmento_padrao_txf + 1);

                $this->executa_ws($nome_funcao);

                break;
//            default :
//                ver('o vedana eh lindo');
//                break;
        }
    }

    function envia_email_aws($dados = null, $destinatario = null) {

        require (COMMONPATH . 'third_party/amazon_sdk/vendor/autoload.php');

        $sharedConfig = [
            'region' => 'us-east-1',
            'version' => 'latest',
            'credentials' => [
                'key' => 'AKIAIYUM2ZKXOQ3IIYMA',
                'secret' => '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'
            ]
        ];

// Create an SDK class used to share configuration across clients.
        $sdk = new Aws\Sdk($sharedConfig);

// Create an Amazon S3 client using the shared configuration data.
        $client = $sdk->createSes();



        try {
//            ver($destinatario->Email_txf);
            $result = $client->sendEmail([
//                'ConfigurationSetName' => 'ConfigSet',
                'Destination' => [ // REQUIRED
                    //   'BccAddresses' => ['<string>'],
                    // 'CcAddresses' => ['<string>'],
                    'ToAddresses' => [$destinatario],
                ],
                'Message' => [ // REQUIRED
                    'Body' => [ // REQUIRED
                        'Html' => [
                            'Charset' => 'UTF-8',
                            'Data' => $dados->Body, // REQUIRED
                    ],
//                        'Text' => [
//                            'Charset' => 'UTF-8',
//                            'Data' => 'Email de teste', // REQUIRED
//                    ],
                    ],
                    'Subject' => [ // REQUIRED
                        'Charset' => 'UTF-8',
                        'Data' => $dados->Subject, // REQUIRED
                ],
                ],
                //'ReplyToAddresses' => ['contato@bolaopapodecopa.com.br'],
                //'ReturnPath' => '<string>',
                //'ReturnPathArn' => '<string>',

                'Source' => '"conexaoserra.com" <contato@conexaoserra.com>', // REQUIRED
                    //'SourceArn' => '<string>',
                    //  'Tags' => [
                    //    [
                    //      'Name' => '<string>', // REQUIRED
                    //    'Value' => '<string>', // REQUIRED
                    //],
//                ],
                    ]);
//ver($result);
            return $result;
//            ver($result);
        } catch (Exception $e) {


//            ver($e->getTrace());
            // output error message if fails
            echo "<br><br>";
            echo $e->getMessage();
            echo "<br><br>";
//            ver($e->getMessage());
            error_log($e->getMessage());

            return false;
        }
    }

    function executa_ws($nome_funcao) {


        $link = "{$this->app->Url_cliente}rest/$nome_funcao";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $link,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "x-api-key: simplesvet",
                "x-senha: vedana",
                "x-usuario: vedana"
            ),
        ));



        $response = curl_exec($curl);

        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }

        die();
    }

}

?>
