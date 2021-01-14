<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class post extends lands_core {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->helper('language');
        $this->load->language('welcome');
        $this->load->helper('lands');
        $this->load->helper('tradutor');
        $_REQUEST['data_atual'] = date('Y-m-d');
        $this->load->model('model_smarty');
        $this->output->enable_profiler(FALSE);
    }

    function index() {


        $this->router();
    }

    /* FUNCAO SOBREPOSTA PARA NAO FAZER BLOQUEAR CASO O SITE ESTEJA EM CONSTRUCAO */

    function verifica_seguranca() {

// verifica se ja foi definido o ID E SENHA DO APP
        (defined('LANDS_ID')) OR exit('LANDS_ID NAO FOI DEFINIDO');
        (defined('LANDS_PASS')) OR exit('LANDS_PASS NAO FOI DEFINIDO');
        $this->smarty->assign('_SERVER', $_SERVER);

        $this->load->model('model_seguranca');

// verifica se o app esta cadastrado na tabela de apps da do banco de dados lands_core..
// caso nao esteja ativo mata a aplicacao;
//configura os atributos do objeto app.... 

        $this->app = $this->model_seguranca->verifica_ativacao(LANDS_ID, LANDS_PASS);

        if (isset($this->app->Url_curl_txf)) {
            if ($this->app->Url_curl_txf != '')
                $this->app->Url_cliente = $this->app->Url_curl_txf;
        }

        $this->cliente = $this->model_seguranca->busca_dados_cliente($this->app->Clientes_for);
        $this->model_banco->inicializa(array('app' => $this->app, 'cliente' => $this->cliente));

// ver($this->cliente); 
//analisa o tipo de app para tomar para iniciar a execucao;
        $vars[] = $this->model_seguranca->analisa_tipo($this->app->Tipo_app_sel);
        $this->assign_vars();

        switch ($this->uri->segment($this->app->Segmento_padrao_txf)) {
            case 'liberar':
                $this->liberar();
                redirect($this->app->Url_cliente);
                break;
            case 'layout':
                $this->layout();
                break;
        }





        $this->assign_vars();
//assign nas variaves da classe e do app;
    }

    function router($param = null) {



        if (!isset($_REQUEST['Lands_id'])) {
            die('Acesso invalido, Lands_id não foi definido');
        }

        $segmento = (int) $this->app->Segmento_padrao_txf;
        $segmento = $segmento + 1;


        if ($this->uri->segment($segmento)) {
            $segmento_post = $this->uri->segment($segmento);
        } else {
            $segmento_post = $this->uri->segment($this->app->Segmento_padrao_txf);
        }



        switch ($segmento_post) {
            case 'contato':


                $this->postar_contato();
                break;

            case 'enviar_contato':

                if (is_lands()) {
                    $this->postar_contato_novissimo();
                } else {
                    $this->postar_contato_novo();
                }


                break;
            case 'lista_transmissao':

                $this->postar_lista_transmissao();
                break;

            case 'calcular_imc':

                $peso = $_POST['Peso_txf'];
                $altura = $_POST['Altura_txf'];
                $peso = str_replace(',', '.', $peso);
                $altura = str_replace(',', '.', $altura);
                $imc = $peso / ($altura * $altura);

                if ($imc <= 18.499) {

                    $classificacao = "abaixo";
                }

                if ($imc >= 18.5 && $imc <= 24.99) {
                    $classificacao = "normal";
                }

                if ($imc >= 25 && $imc <= 29.99) {
                    $classificacao = "acima";
                }
                if ($imc >= 30 && $imc <= 39.99) {
                    $classificacao = "obeso";
                }
                if ($imc >= 40) {
                    $classificacao = "morbido";
                }

                $imc = round($imc, 2);



                $this->smarty->assign('classificacao', $classificacao);
                $this->smarty->assign('imc', $imc);
                $this->smarty->assign('mensagem', 'imc_ok');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);

                break;


            case 'pergunta' :
                $this->output->enable_profiler(FALSE);
                $this->model_banco_basico->insertTable('perguntas', $this->input->post());
                echo "<div id='enviado'>Pergunta enviada com sucesso!</div>";
                break;
            case 'informativo':

                $this->postar_informativo();
                break;

            case 'modal_orcamento':
                $this->postar_orcamento();
                break;
//            case 'curriculo':
//                $this->output->enable_profiler(FALSE);
//                $this->postar_curriculo();
//                break;


            case 'cadastrar_usuario':


                $this->cadastrar_usuario();
                break;

            case 'gerar_senha':


                $this->gerar_senha();

                break;


            case 'editar':


                $this->editar();
                break;
            case 'bannerfull':
                $this->session->set_userdata('bannerfull', 'sim');
                redirect($this->app->Url_cliente);


                $this->editar();
                break;

            case 'ativar_senha':
                $this->ativar_senha();

                break;
            case 'curriculo':


                $this->postar_curriculo();
                break;

            case 'lead':
                $this->postar_lead();
                break;

            case 'cadastro':
                $this->postar_cadastro();
                break;
            case 'acesso':
                $this->postar_acesso();
                break;
            case 'registro_produto':


                $this->postar_registro_produto();
                break;

            case 'editar_cadastro':


                $this->editar_cadastro();
                break;
            case 'maioridade':
                if ($_POST['resposta'] == 'SIM') {
                    $this->session->set_userdata('maioridade', 'SIM');
                }
                if (isset($_POST['redirect'])) {
                    redirect($_POST['redirect']);
                } else {
                    redirect($this->app->Url_cliente);
                }
                break;

            case 'assinarsky':

                $this->load->model('model_mail');
                $this->model_mail->inicializa($this->app, $this->cliente);
                $email = $_POST;

                $url_pacote = $_POST['Pacote_sel'];
                $this->conecta_mbc($this->app->Conexoes_for);
                $this->mbc->db_insert('pedidos_assinatura', $_POST);
                $pacote = $this->mbc->executa_sql("select * from pacotes where Url_amigavel_txf='$url_pacote'");

                $this->smarty->assign('pacote', $pacote[0]);

                $email['Email_txf'] = $email['Email_txf'];
                $email['Nome_txf'] = $email['Nome_txf'];
                $email['Assunto_txf'] = "Nova Assinatura Sky - " . $this->app->Nome_app_txf;



                if ($this->model_mail->envia_email_tpl($email, 'assinatura')) {
                    $this->smarty->assign('mensagem', 'pedido_enviado');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                    die();
                } else {
                    $this->smarty->assign('mensagem', 'pedido_erro');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                    die();
                }
                break;

            case 'empreendimentos':


                $this->output->enable_profiler(FALSE);
                $id = $_POST['Id_int'];
                $this->conecta_mbc($this->app->Conexoes_for);
                $empreendimento = $this->mbc->buscar_registro_imagens_videos('empreendimentos', "where Id_int=$id");
                if (!isset($empreendimento[0]->Id_int))
                    die('nao achou nenhum empreendimento com o id ' . $id);
                $this->smarty->assign('empr', $empreendimento);

                $this->model_smarty->render_ajax('empreendimento', $this->app->Template_txf);
                break;

            case 'facebook':
                die('vai chamar o model facebook');
                break;
            case 'busca' :
                break;

            case 'compara' :
                $this->output->enable_profiler(FALSE);
                $id = $_POST['Id_int'];
                $tabela = $_POST['Tabela_txf'];
                $this->session->set_userdata('tabela', $tabela);
                $this->conecta_mbc($this->app->Conexoes_for);

                if (isset($id)) {
                    $item_antes = $this->mbc->buscar_registro_imagens_videos($tabela, "where Id_int=$id");
                    $item[0]->Id_int = $item_antes[0]->Id_int;
                    $item[0]->Nome_txf = $item_antes[0]->Nome_txf;
                }


                if ($id == $this->session->userdata['item1']->Id_int) {
                    echo '<script>alert("Este ítem já está na lista.");</script>';
                    $this->smarty->assign('item1', $this->session->userdata['item1']);
                    $this->smarty->assign('item2', $this->session->userdata['item2']);
                    $this->smarty->assign('item3', $this->session->userdata['item3']);

                    $this->model_smarty->render_ajax('compara', $this->app->Template_txf);
                    exit();
                }

                if ($id == $this->session->userdata['item2']->Id_int) {
                    echo '<script>alert("Este ítem já está na lista.");</script>';
                    $this->smarty->assign('item1', $this->session->userdata['item1']);
                    $this->smarty->assign('item2', $this->session->userdata['item2']);
                    $this->smarty->assign('item3', $this->session->userdata['item3']);

                    $this->model_smarty->render_ajax('compara', $this->app->Template_txf);
                    exit();
                }

                if ($id == $this->session->userdata['item3']->Id_int) {
                    echo '<script>alert("Este ítem já está na lista.");</script>';
                    $this->smarty->assign('item1', $this->session->userdata['item1']);
                    $this->smarty->assign('item2', $this->session->userdata['item2']);
                    $this->smarty->assign('item3', $this->session->userdata['item3']);

                    $this->model_smarty->render_ajax('compara', $this->app->Template_txf);
                    exit();
                }

                //atualiza a sessao
                if (!isset($this->session->userdata['item1'])) {
                    $this->session->set_userdata('item1', $item[0]);
                } else {
                    if (!isset($this->session->userdata['item2'])) {
                        $this->session->set_userdata('item2', $item[0]);
                    } else {
                        if (!isset($this->session->userdata['item3'])) {
                            $this->session->set_userdata('item3', $item[0]);
                        } else {
                            $this->smarty->assign('mensagem', "limite");
                        }
                    }
                }

                $this->smarty->assign('item1', $this->session->userdata['item1']);
                $this->smarty->assign('item2', $this->session->userdata['item2']);
                $this->smarty->assign('item3', $this->session->userdata['item3']);

                $this->model_smarty->render_ajax('compara', $this->app->Template_txf);
                break;

            case 'promocao':
                $this->postar_promocao();
                break;
            case 'remove_compara' :
                $this->output->enable_profiler(FALSE);
                $id = $_POST['Id_int'];
                $tabela = $_POST['Tabela_txf'];
                // $this->conecta_mbc($this->app->Conexoes_for);



                if ($id == 'todos') {
                    $this->session->unset_userdata('item1');
                    $this->session->unset_userdata('item2');
                    $this->session->unset_userdata('item3');
                    $this->smarty->assign('mensagem', "vazio");
                } else {

                    $this->smarty->assign('id', $id);
                    $this->session->unset_userdata("item$id");
                    $this->smarty->assign('mensagem', "removido");
                }

                if (isset($this->session->userdata['item1']))
                    $this->smarty->assign('item1', $this->session->userdata['item1']);
                if (isset($this->session->userdata['item2']))
                    $this->smarty->assign('item2', $this->session->userdata['item2']);
                if (isset($this->session->userdata['item3']))
                    $this->smarty->assign('item3', $this->session->userdata['item3']);

                $this->model_smarty->render_ajax('compara', $this->app->Template_txf);
                break;
        }
    }

    function gerar_senha() {
        $this->output->enable_profiler(FALSE);
        $this->conecta_mbc($this->app->Conexoes_for);


        if (!isset($_POST['Tabela_txf']))
            die('funcao gerar_senha necessita Tabela_txf como parametro');
        $tabela = $_POST['Tabela_txf'];

        if (!isset($_POST['Email_txf']))
            die('funcao gerar_senha necessita Email como parametro');
        $email = $_POST['Email_txf'];
//verifica usuario ja cadastrado;
        $dados['Tabela_txf'] = $tabela;
        $dados['Email_txf'] = $_POST['Email_txf'];
        $dados['Senha_temp_txf'] = senha_aleatoria(5, true, true);

        $query = "select * from $tabela where Email_txf='$email'";

        $usu = $this->mbc->executa_sql($query);

        if (isset($usu[0]->Id_int)) {
            $dados['usuario'] = $usu[0];

//se nao encontrar, cadastra, senao retorna erro. 
            $gravou = $this->mbc->updateTable($tabela, $dados, 'Email_txf', $dados['Email_txf']);

            if ($gravou) {

                $this->smarty->assign('dados', $dados);
                $enviou = $this->reenvia_email_senha($dados, 'recuperacao_senha');
                if ($enviou) {
                    $this->smarty->assign('resposta', 'email_ok');
                    $this->model_smarty->render_ajax('msg_cadastro', $this->app->Template_txf);
                } else {

                    $this->smarty->assign('resposta', 'email_erro');
                    $this->model_smarty->render_ajax('msg_cadastro', $this->app->Template_txf);
                }
            } else {
                $this->smarty->assign('resposta', 'senha_temp_erro');
                $this->model_smarty->render_ajax('msg_cadastro', $this->app->Template_txf);
            }
        } else {
            $this->smarty->assign('email', $_POST['Email_txf']);
            $this->smarty->assign('resposta', 'email_nao_cadastrado');
            $this->model_smarty->render_ajax('msg_cadastro', $this->app->Template_txf);
        }
    }

    function reenvia_email_senha($usuario, $formulario) {


//ver($this->session->all_userdata('email'));
        $email['Email_txf'] = 'contato@parkgirassol.com.br';
        $email['Nome_txf'] = $this->app->Nome_app_txf;
        $email['Destinatario_txf'] = $usuario['Email_txf'] . ',gustavo.vedana@landsdigital.com.br';
        $email['Assunto_txf'] = 'Recuperação de senha';


//$mensagem = $this->smarty->fetch(COMMONPATH . "../templates/{$this->app->Template_txf}/email/{$formulario}.tpl");
        $mensagem = htmlspecialchars_decode($this->model_smarty->retorna_tpl('recuperacao_senha', $this->app->Template_txf));
        $email['Mensagem_txa'] = $mensagem;

//            ver($email);
        $this->load->model('model_mail');
        $this->model_mail->inicializa($this->app, $this->cliente);
        $enviou = $this->model_mail->envia_email($email, 'boolean');
        return $enviou;
    }

    function envia_email($email, $formulario = null, $copia_cliente = TRUE) {
        if (!isset($email['Nome_txf'])) {
            $email['Nome_txf'] = 'Email do Site ' . $this->app->Nome_app_txf;
        }
        $email['Destinatario_txf'] = $email['Destinatario_txf'];
        $email['Assunto_txf'];



        if (isset($formulario)) {
            $mensagem = $this->smarty->fetch(COMMONPATH . "../templates/{$this->app->Template_txf}/email/{$formulario}.tpl");

//$mensagem = htmlspecialchars_decode($this->model_smarty->retorna_tpl('recuperacao_senha', $this->app->Template_txf));
            $email['Mensagem_txa'] = $mensagem;
        }




        $this->load->model('model_mail');
        $this->model_mail->inicializa($this->app, $this->cliente);
//             $enviou = $this->model_mail->envia_email($email, 'boolean');
        $enviou = $this->model_mail->envia_email_novo($email, $copia_cliente);

        return $enviou;
    }

    function cadastrar_usuario() {
        $this->output->enable_profiler(FALSE);
        $this->conecta_mbc($this->app->Conexoes_for);

        if (!isset($_POST['Tabela_txf']))
            die('funcao cadastrar necessita Tabela_txf como parametro');
        $tabela = $_POST['Tabela_txf'];
//verifica usuario ja cadastrado;
        $usu = $this->mbc->executa_sql("select * from $tabela where Email_txf='" . $_POST['Email_txf'] . "'");
        $dados = $_POST;
        $dados['Senha_txp'] = md5($_POST['Senha_txp']);
//se nao encontrar, cadastra, senao retorna erro.
        if (!isset($usu[0]->Id_int)) {
            $this->conecta_mbc($this->app->Conexoes_for);


            $gravou = $this->mbc->db_insert($tabela, $dados);
            if ($gravou) {
                $this->smarty->assign('resposta', 'gravou_ok');
                $this->model_smarty->render_ajax('msg_cadastro', $this->app->Template_txf);
            } else {
                $this->smarty->assign('resposta', 'gravou_erro');
                $this->model_smarty->render_ajax('msg_cadastro', $this->app->Template_txf);
            }
        } else {
            $this->smarty->assign('email', $_POST['Email_txf']);
            $this->smarty->assign('resposta', 'usuario_existente');
            $this->model_smarty->render_ajax('msg_cadastro', $this->app->Template_txf);
        }
        if (isset($_POST['redirect'])) {
            $redirect = $_POST['redirect'];

            echo "<script>top.location='$redirect';</script>";
        }
    }

    function editar() {
        $this->output->enable_profiler(FALSE);
        $this->conecta_mbc($this->app->Conexoes_for);

        if (!isset($_POST['Tabela_txf']))
            die('funcao cadastrar necessita Tabela_txf como parametro');
        $tabela = $_POST['Tabela_txf'];
//verifica usuario ja cadastrado;

        $dados = $_POST;
        $dados['Senha_txp'] = md5($_POST['Senha_txp']);
//se nao encontrar, cadastra, senao retorna erro.
        $this->conecta_mbc($this->app->Conexoes_for);

        $gravou = $this->mbc->updateTable($tabela, $dados, 'Id_int', $dados['Id_int']);
        if ($gravou) {
            $this->session->set_userdata('usuario', $_POST);
            $this->smarty->assign('resposta', 'editou_ok');
            $this->model_smarty->render_ajax('msg_cadastro', $this->app->Template_txf);
        } else {
            $this->smarty->assign('resposta', 'editou_erro');
            $this->model_smarty->render_ajax('msg_cadastro', $this->app->Template_txf);
        }

        if (isset($_POST['redirect'])) {
            $redirect = $_POST['redirect'];

            echo "<script>top.location='$redirect';</script>";
        }
    }

    protected function editar_cadastro() {


        $this->output->enable_profiler(FALSE);
        $this->conecta_mbc($this->app->Conexoes_for);
//verifica se a tabela foi passada por post;

        if (!isset($_POST['Tabela_txf'])) {
            $this->smarty->assign('mensagem', 'tabela');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            die();
        }

        if (!isset($_POST['Id_int'])) {
            die('Id_int nao encontrado');
        }
        $id = $_POST['Id_int'];

        $tabela = $_POST['Tabela_txf'];

//verifica se a tabela existe
        if (!$this->mbc->tabelaexiste($tabela)) {
            $this->smarty->assign('tabela', $tabela);
            $this->smarty->assign('mensagem', 'tabela_nao_existe');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            die();
        }

//edita registro
        if ($this->mbc->updateTable($tabela, $_POST, 'Id_int', $id)) {

            $this->smarty->assign('mensagem', 'edicao_ok');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            die();
//envia email
        } else {
            $this->smarty->assign('mensagem', 'edicao_erro');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            die();
        }
    }

    function postar_orcamento() {
        $this->output->enable_profiler(FALSE);
        $this->conecta_mbc($this->app->Conexoes_for);
        if (isset($_POST['Tabela_txf'])) {

            if ($this->mbc->tabelaexiste($_POST['Tabela_txf'])) {
                $this->mbc->db_insert($_POST['Tabela_txf'], $_POST);
            } else {
                die('tabela nao existe');
            }
        }

        $this->load->model('model_mail');
        $this->model_mail->inicializa($this->app, $this->cliente);
        $email = $_POST;
        $email['Assunto_txf'] = "Novo Orçamento - " . $this->app->Nome_app_txf;

        if ($this->model_mail->envia_email_tpl($email, 'orcamento')) {
            $this->smarty->assign('mensagem', 'orcamento_enviado');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            die();
        } else {
            $this->smarty->assign('mensagem', 'orcamento_erro');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            die();
        }
    }

    function postar_registro_produto() {

        $this->output->enable_profiler(FALSE);
        $this->conecta_mbc($this->app->Conexoes_for);
        if (isset($_POST['Tabela_txf'])) {

            if ($this->mbc->tabelaexiste($_POST['Tabela_txf'])) {
                $this->mbc->db_insert($_POST['Tabela_txf'], $_POST);
            } else {
                die('tabela nao existe');
            }
        }

        $this->load->model('model_mail');
        $this->model_mail->inicializa($this->app, $this->cliente);
        $email = $_POST;
        $email['Assunto_txf'] = "Registro de Produto - " . $this->app->Nome_app_txf;

        if ($this->model_mail->envia_email_tpl($email, 'registro')) {
            $this->smarty->assign('mensagem', 'registro_ok');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            die();
        } else {
            $this->smarty->assign('mensagem', 'registro_erro');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            die();
        }
    }

    function postar_cadastro() {


        $this->output->enable_profiler(FALSE);
        $this->conecta_mbc($this->app->Conexoes_for);





        if (isset($_POST['Nascimento_dat'])) {
            $_POST['Nascimento_dat'] = formata_data_sql($_POST['Nascimento_dat']);
        }
        if (isset($_POST['Data_dat'])) {
            $_POST['Data_dat'] = formata_data_sql($_POST['Data_dat']);
        } else {
            $_POST['Data_dat'] = date('Y-m-d');
        }


        $_POST['Data_hora_dat'] = date('Y-m-d H:i:s');




//verifica se a tabela foi passada por post;


        if (!isset($_POST['Tabela_txf'])) {
            $this->smarty->assign('mensagem', 'tabela');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            die();
        }

        if (!isset($_POST['Destinatario_txf'])) {
            $this->smarty->assign('mensagem', 'destinatario');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            die();
        }

        if (!isset($_POST['Email_txf'])) {
            $this->smarty->assign('mensagem', 'email');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            die();
        }
        $tabela = $_POST['Tabela_txf'];





//verifica se a tabela existe
        if (!$this->mbc->tabelaexiste($tabela)) {
            $this->smarty->assign('tabela', $tabela);
            $this->smarty->assign('mensagem', 'tabela_nao_existe');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            die();
        }



        //verifica se existe algum registro com o e-mail associado
        if (!$_POST['Permite_duplo_cadastro_txf']) {


            $email = $_POST['Email_txf'];
            $sql = "select * from $tabela where Email_txf = '$email'";
            $email_bd = $this->mbc->executa_sql($sql);
            //ver($x);
            if (isset($email_bd[0]->Id_int)) {

                $this->smarty->assign('mensagem', 'email_ja_existe');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                die();
            }
        }






//insere registro
        if ($this->mbc->db_insert($tabela, $_POST)) {

            $email = $_POST;
            if (!isset($email['Assunto_txf'])) {
                $email['Assunto_txf'] = 'Cadastro no Site ' . $this->app->Nome_app_txf;
            }
            $this->smarty->assign('cadastro', $_POST);


//envia email
//ver($email);
            if ($this->envia_email($email, 'cadastro')) {

                $this->smarty->assign('mensagem', 'cadastro_inserido');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            } else {

                $this->smarty->assign('mensagem', 'cadastro_erro');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            }
            die();
        } else {
            ver("nao inseriu");
            $this->smarty->assign('mensagem', 'cadastro_erro');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            die();
        }
    }

    function postar_acesso() {
        $this->output->enable_profiler(FALSE);
        $this->conecta_mbc($this->app->Conexoes_for);


        if (isset($_POST['Data_dat'])) {
            $_POST['Data_dat'] = formata_data_sql($_POST['Data_dat']);
        } else {
            $_POST['Data_dat'] = date('Y-m-d');
        }
        $_POST['Data_hora_dat'] = date('Y-m-d H:i:s');
//verifica se a tabela foi passada por post;
        if (!isset($_POST['Tabela_txf'])) {
            $this->smarty->assign('mensagem', 'tabela');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            die();
        }
        if ($_POST['Marcador_txf']) {
            $this->smarty->assign('marcador', $_POST['Marcador_txf']);
        }
        $tabela = $_POST['Tabela_txf'];
        if ($_POST['Tpl_retorno_txf']) {
            $tpl_retorno = $_POST['Tpl_retorno_txf'];
        } else {
            $tpl_retorno = "acesso";
        }

//verifica se a tabela existe
        if (!$this->mbc->tabelaexiste($tabela)) {
            $this->smarty->assign('tabela', $tabela);
            $this->smarty->assign('mensagem', 'tabela_nao_existe');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            die();
        }
        $acesso = $_POST;
        $acesso['Ip_txf'] = $_SERVER['REMOTE_ADDR'];
        $acesso['Acesso_dat'] = date("Y-m-d H:i:s");
        if (isset($_REQUEST['utm_source'])) {
            $acesso['Source_txf'] = $_REQUEST['utm_source'];
        }
        if (isset($_REQUEST['utm_medium'])) {
            $acesso['Medium_txf'] = $_REQUEST['utm_medium'];
        }
        if (isset($_REQUEST['utm_content'])) {
            $acesso['Content_txf'] = $_REQUEST['utm_content'];
        }
        if (isset($_REQUEST['utm_campaign'])) {
            $acesso['Campaign_txf'] = $_REQUEST['utm_campaign'];
        }




//insere registro

        if ($this->mbc->db_insert($tabela, $acesso)) {
            $this->smarty->assign('mensagem', 'acesso_ok');
            $this->model_smarty->render_ajax($tpl_retorno, $this->app->Template_txf);

            die();
        } else {
            ver("nao inseriu");
            $this->smarty->assign('mensagem', 'acesso_erro');
            $this->model_smarty->render_ajax($tpl_retorno, $this->app->Template_txf);
            die();
        }
    }

    function postar_lista_transmissao() {
        $this->output->enable_profiler(FALSE);
        $this->conecta_mbc($this->app->Conexoes_for);

        if (isset($_POST['Nascimento_dat'])) {
            $_POST['Nascimento_dat'] = formata_data_sql($_POST['Nascimento_dat']);
        }
        if (isset($_POST['Data_dat'])) {
            $_POST['Data_dat'] = formata_data_sql($_POST['Data_dat']);
        } else {
            $_POST['Data_dat'] = date('Y-m-d');
        }
        $_POST['Data_hora_dat'] = date('Y-m-d H:i:s');
        
        //verifica se a tabela foi passada por post;
        if (!isset($_POST['Tabela_txf'])) {
            die('tabela nao definida');
        }
        $tabela = $_POST['Tabela_txf'];
        
        //verifica se a tabela existe
        if (!$this->mbc->tabelaexiste($tabela)) {
            die("Tabela $tabela nao existe");
            $this->smarty->assign('tabela', $tabela);
            $this->smarty->assign('mensagem', 'tabela_nao_existe');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            die();
        }

        //verifica se existe algum registro com o e-mail associado
        if (!$_POST['Permite_duplo_cadastro_txf']) {
            $telefone = $_POST['Telefone_txf'];
            $sql = "select * from $tabela where Telefone_txf = '$telefone'";
            $registro_bd = $this->mbc->executa_sql($sql);
            //ver($x);
            if (isset($registro_bd[0]->Id_int)) {
                $this->smarty->assign('mensagem', 'registro_repetido');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                die();
            }
        }
        
        
        //insere registro
        if ($this->mbc->db_insert($tabela, $_POST)) {
            $this->session->set_userdata("exibe_popup", 'NAO');
            $this->smarty->assign('mensagem', 'registro_inserido');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
        } else {
            $this->smarty->assign('mensagem', 'registro_erro');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            die();
        }
    }

    function postar_lead() {
        $this->output->enable_profiler(FALSE);
        $this->conecta_mbc($this->app->Conexoes_for);

        if (isset($_POST['Nascimento_dat'])) {
            $_POST['Nascimento_dat'] = formata_data_sql($_POST['Nascimento_dat']);
        }
        
        if (isset($_POST['Data_dat'])) {
            $_POST['Data_dat'] = formata_data_sql($_POST['Data_dat']);
        } else {
            $_POST['Data_dat'] = date('Y-m-d');
        }

        $_POST['Data_hora_dat'] = date('Y-m-d H:i:s');
        
        //verifica se a tabela foi passada por post;        
        if (!isset($_POST['Tabela_txf'])) {
            $this->smarty->assign('mensagem', 'tabela');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            die();
        }
        if (!isset($_POST['Destinatario_txf'])) {
            $this->smarty->assign('mensagem', 'destinatario');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            die();
        }

        if (!isset($_POST['Email_txf'])) {
            $this->smarty->assign('mensagem', 'email');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            die();
        }
        $tabela = $_POST['Tabela_txf'];

        //verifica se a tabela existe
        if (!$this->mbc->tabelaexiste($tabela)) {
            $this->smarty->assign('tabela', $tabela);
            $this->smarty->assign('mensagem', 'tabela_nao_existe');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            die();
        }

        //verifica se existe algum registro com o e-mail associado
        if (!$_POST['Permite_duplo_cadastro_txf']) {
            $email = $_POST['Email_txf'];
            $sql = "select * from $tabela where Email_txf = '$email'";
            $email_bd = $this->mbc->executa_sql($sql);
            //ver($x);
            if (isset($email_bd[0]->Id_int)) {
                $this->smarty->assign('mensagem', 'email_ja_existe');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                die();
            }
        }

        if ($_POST['Sql_tabela_txf']) {

            $tabela_nova = addslashes($_POST['Sql_tabela_txf']);
            $id = addslashes($_POST['Sql_id_txf']);
            $where = addslashes($_POST['Sql_where_txf']);
            $conexao = addslashes($_POST['Sql_conexao_txf']);
            $registros = $this->executa_query($tabela_nova, $where, $id, $conexao);
        }

        //insere registro
        if ($this->mbc->db_insert($tabela, $_POST)) {

            if ($_POST['Envia_email_txf']) {

                $email = $_POST;
                if (!isset($email['Assunto_txf'])) {
                    $email['Assunto_txf'] = 'Novo Lead no Site ' . $this->app->Nome_app_txf;
                }
                $this->smarty->assign('cadastro', $_POST);

                //$id_conexao=$_POST['Conexe']
                //$this->conecta_mbc($this->app->Conexoes_for);
//envia email
//ver($email);
                if ($this->envia_email($email, 'lead')) {

                    $this->smarty->assign('mensagem', 'lead_inserido');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                } else {

                    $this->smarty->assign('mensagem', 'lead_erro');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                }
            } else {
                $this->smarty->assign('mensagem', 'lead_inserido');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            }
            die();
        } else {
            ver("nao inseriu");
            $this->smarty->assign('mensagem', 'cadastro_erro');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            die();
        }
    }

    protected function executa_query($tabela = null, $where = null, $id = null, $conexao = null) {
        if ($conexao) {
            $this->conecta_mbc($conexao);
        }

        $where_final = "where Id_int is not null";
        if ($where) {
            $where_final.=" and $where";
        }
        if ($id) {
            $where_final.=" and Id_int=$id";
        }

//        ver($where_final);
        $registros = $this->mbc->buscar_completo($tabela, $where_final);

        $this->smarty->assign('registros', $registros);

        return ($registros);
    }

    protected

    function postar_contato() {
        $this->output->enable_profiler(FALSE);


        if ($this->carrega_model('model_contato')) {
//se nao tiver definido a tabela_contato_txf do app envia sem parâmetros, pegando o default="_contato"

            if ($this->app->Tabela_contato_txf != '') {
                $dados_contato = $this->model_contato->prepara_contato_local($this->app->Lands_id, $this->app->Tabela_contato_txf);
            } else {
                $dados_contato = $this->model_contato->prepara_contato_local($this->app->Lands_id);
            }

            $dados_contato['Lands_id'] = $this->app->Lands_id;
            $dados_contato['Data_dat'] = date('Y-m-d');

            if ($dados_contato['next'] == 'criar_tabela') {
                $script = $this->model_contato->criar_tabela_contato($this->app->Lands_id);

                $this->postar_contato();
            } else {
                $resultado_final = $this->model_contato->insere_contato_local($dados_contato);
                $this->load->model('model_formulario');
                if ($this->model_formulario->envia_formulario($this->app, 'contato'))
                    echo 'Email enviado com sucesso!';
                $this->smarty->assign('resposta', $resultado_final);
                $this->model_smarty->render_ajax('contato_resposta');
                $this->load->database('default', null, true);
                return $resultado_final;
            }
        }
    }

    function postar_promocao() {
        $this->output->enable_profiler(FALSE);
        $this->conecta_mbc($this->app->Conexoes_for);
        if (isset($_POST['Tabela_txf'])) {
            $tabela = $_POST['Tabela_txf'];
        } else {
            $tabela = "inscricoes";
        }

        $inscricao = $_POST;
        $mensagem = htmlspecialchars_decode($this->model_smarty->retorna_tpl('email/inscricao', $this->app->Template_txf));
        $inscricao['Tpl_email_txf'] = $mensagem;


        if ($this->mbc->tabelaexiste($tabela)) {
            $this->mbc->db_insert($tabela, $inscricao);
        } else {
            die('tabela nao existe');
        }

        $this->load->model('model_mail');
        $this->model_mail->inicializa($this->app, $this->cliente);
        $email = $_POST;
        $email['Assunto_txf'] = "Cadastro Promoção - " . $this->app->Nome_app_txf;

        if ($this->model_mail->envia_email_tpl($email, 'inscricao')) {
            $this->smarty->assign('mensagem', 'envio_ok');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            die();
        } else {
            $this->smarty->assign('mensagem', 'envio_erro');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            die();
        }
    }

    function postar_contato_novissimo() {
        $this->output->enable_profiler(FALSE);
        if (isset($_POST['Tpl_txf'])) {
            if ($_POST['Tpl_txf']) {
                $arquivo_email = $_POST['Tpl_txf'];
            } else {
                $arquivo_email = 'contato';
            }
        } else {
            $arquivo_email = 'contato';
        }

        if ($this->carrega_model('model_contato_novo')) {

            $this->model_contato_novo->inicializa($this->app, $this->cliente);
//se nao tiver definido a tabela_contato_txf do app envia sem parâmetros, pegando o default="_contato"



            if ($this->app->Tabela_contato_txf != '') {
                $dados_contato = $this->model_contato_novo->prepara_contato_local($this->app->Lands_id, $this->app->Tabela_contato_txf);
            } else {
                $dados_contato = $this->model_contato_novo->prepara_contato_local($this->app->Lands_id);
            }

//            ver($dados_contato);

            $dados_contato['Lands_id'] = $this->app->Lands_id;
            $dados_contato['Data_dat'] = date('Y-m-d');
//            


            if ($dados_contato['next'] == 'criar_tabela') {
                $script = $this->model_contato_novo->criar_tabela_contato($this->app->Lands_id);
                $this->postar_contato_novissimo();
            } else {


                $resultado_final = $this->model_contato_novo->insere_contato_local($dados_contato);

                $this->load->model('model_formulario');
                $this->model_formulario->inicializa($this->app, $this->cliente);
                if ($this->model_formulario->envia_formulario($this->app, $arquivo_email)) {
                    $this->smarty->assign('mensagem', 'contato_ok');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                } else {
                    $this->smarty->assign('mensagem', 'contato_erro');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                }
                $this->load->database('default', null, true);
                return $resultado_final;
            }
        }
    }

    function postar_contato_novo() {
        $this->output->enable_profiler(FALSE);
        if (isset($_POST['Tpl_txf'])) {
            if ($_POST['Tpl_txf']) {
                $arquivo_email = $_POST['Tpl_txf'];
            } else {
                $arquivo_email = 'contato';
            }
        } else {
            $arquivo_email = 'contato';
        }


        if ($this->carrega_model('model_contato')) {



            $this->model_contato->inicializa($this->app, $this->cliente);
//se nao tiver definido a tabela_contato_txf do app envia sem parâmetros, pegando o default="_contato"



            if ($this->app->Tabela_contato_txf != '') {
                $dados_contato = $this->model_contato->prepara_contato_local($this->app->Lands_id, $this->app->Tabela_contato_txf);
            } else {
                $dados_contato = $this->model_contato->prepara_contato_local($this->app->Lands_id);
            }

//            ver($dados_contato);

            $dados_contato['Lands_id'] = $this->app->Lands_id;
            $dados_contato['Data_dat'] = date('Y-m-d');
//            


            if ($dados_contato['next'] == 'criar_tabela') {
                $script = $this->model_contato->criar_tabela_contato($this->app->Lands_id);
                $this->postar_contato_novo();
            } else {


                $resultado_final = $this->model_contato->insere_contato_local($dados_contato);

                $this->load->model('model_formulario');
                $this->model_formulario->inicializa($this->app, $this->cliente);
                if ($this->model_formulario->envia_formulario($this->app, $arquivo_email)) {
                    $this->smarty->assign('mensagem', 'contato_ok');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                } else {
                    $this->smarty->assign('mensagem', 'contato_erro');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                }
                $this->load->database('default', null, true);
                return $resultado_final;
            }
        }
    }

    function postar_informativo() {
        $this->output->enable_profiler(FALSE);
        $this->load->database('default', null, true);
        $this->conecta_mbc($this->app->Conexoes_for);
        $this->carrega_model('model_informativo');
        $this->model_informativo->inicializa($this->app, $this->cliente);
//$email_usuario['Email_txf'] = $this->input->post();
        $dados_info = $this->model_informativo->prepara_informativo_local($this->app->Lands_id, $this->app->Tabela_info_txf);
        $dados_info['Lands_id'] = $this->app->Lands_id;
        $dados_info['Data_dat'] = date('Y-m-d');
        if ($dados_info['next'] == 'criar_tabela') {
            $script = $this->model_informativo->criar_tabela_info($this->app->Lands_id, $this->app->Tabela_info_txf);
            $this->postar_informativo();
            die();
        } else {
            if ($this->model_informativo->valida_email($_POST['Email_txf'])) {
                $liberacao = $this->model_informativo->verifica_duplicidade($dados_info);
                if ($liberacao['resposta'] != 'ok') {
                    //   $resultado_final = $liberacao['css'];
                    $resultado_final = $liberacao['mensagem'];
                    $resultado_final2 = $liberacao['css_message'];
                    $this->smarty->assign('mensagem', $liberacao);
                } else {
                    $re = $this->model_informativo->insere_info_local($dados_info);
                    $resultado_final = $re['mensagem'];
                    $resultado_final2 = $re['css_message'];
                    $this->smarty->assign('mensagem', $re);
                }

                $this->smarty->assign('resultado', $liberacao['resposta']);
                $this->smarty->assign('resposta', $resultado_final);
                $this->smarty->assign('resposta_css', $resultado_final2);
                $this->model_smarty->render_ajax('informativo_resposta', $this->app->Template_txf);
                $this->load->database('default', null, true);
                return $resultado_final;
            } else {

                $this->smarty->assign('resultado', 'email_invalido');
                $resultado_final = 'Email_inválido';
                $resultado_final2 = '<span style="color:#D83F4A">Email inválido</span>';
                $this->smarty->assign('resposta', $resultado_final);
                $this->smarty->assign('resposta_css', $resultado_final2);
                $this->model_smarty->render_ajax('informativo_resposta', $this->app->Template_txf);
                $this->load->database('default', null, true);
                return $resultado_final;
            }
        }
    }

    function postar_curriculo() {


        if (isset($_POST['pasta'])) {
            $pasta_painel = $_POST['pasta'];
        } else {
            $pasta_painel = $this->app->Pasta_painel;
        }



        $this->output->enable_profiler(FALSE);
        $this->load->database('default', null, true);
        $this->conecta_mbc($this->app->Conexoes_for);
        $this->carrega_model('model_curriculo');
        $_POST['Data_dat'] = retorna_date_time();
        if (!$this->verifica_campos_curriculo()) {
            echo '<div id="status">error</div>';
            echo '<div id="message">Preencha todos os campos.</div>';
            exit();
        }

        if ($this->mbc->tabelaexiste('curriculos')) {
            $pasta = $this->dados_conexao['database'];
            $upload_path_url = $this->app->Url_cliente . $pasta_painel . '/arquivos/' . $pasta . '/';
//            ver($upload_path_url);
            $config['upload_path'] = FCPATH . $pasta_painel . '/arquivos/' . $pasta . '/';

//		$config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'doc|docx|ppt|pptx|txt|rtf|pdf|jpg|png|zip|avi';
            $config['overwrite'] = TRUE;
//            ver($config);
            /* $config['max_size']	= '1000';
             * 
              $config['max_width']  = '1024';
              $config['max_height']  = '768'; */


            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {
                echo '<div id="status">error</div>';
                echo '<div id="message">' . $this->upload->display_errors() . '</div>';
            } else {

                $this->conecta_mbc($this->app->Conexoes_for);
                $curriculo = $_POST;
                $curriculo['Curriculo_arq'] = "<img rel='Visualizar' src='imagens/visualizar_geral.png' />";
                if ($this->mbc->db_insert('curriculos', $curriculo)) {
                    $ultimo_currico = $this->mbc->executa_sql("select * from curriculos order by Id_int desc;");
                };
                $id = $ultimo_currico[0]->Id_int;
                $data = array('upload_data' => $this->upload->data());
                $arquivo['Nome_txf'] = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($data['upload_data']['file_name']));

                $arquivo['Caminho_txf'] = 'arquivos/' . $pasta . '/' . $arquivo['Nome_txf'];
                $arquivo['Tipo_txf'] = str_replace('.', '', $data['upload_data']['file_ext']);
                $arquivo['Descricao_txf'] = $_POST['Nome_txf'];
                $arquivo['Id_arquivo_con'] = $id;
                $arquivo['Tabela_con'] = 'curriculos';
                $arquivo['Data_int'] = time();

                $this->conecta_mbc($this->app->Conexoes_for);
                $this->mbc->db_insert('arquivos', $arquivo);





                echo '<div id="status">success</div>';
//then output your message (optional)
                echo '<div id="message"> Currículo enviado com sucesso!</div>';
//pass the data to js
                echo '<div id="upload_data">' . json_encode($data) . '</div>';
                $email['Email_txf'] = $_POST['Email_txf'];
                $email['Nome_txf'] = $_POST['Nome_txf'];
                $email['Vaga_txf'] = $_POST['Vaga_txf'];
                $email['Telefone_txf'] = $_POST['Telefone_txf'];
                $email['Destinatario_txf'] = $_POST['Destinatario_txf'];
                $email['Assunto_txf'] = 'Novo currículo - ' . $this->app->Nome_app_txf;
                $email['Arquivo_txf'] = $arquivo['Caminho_txf'];
                $email['Arquivo_nome_txf'] = $arquivo['Nome_txf'];

                $dados_email = array_to_object($email);
                $this->smarty->assign('dados_email', $dados_email);


                try {

                    $caminho = COMMONPATH . "../templates/{$this->app->Template_txf}/forms/curriculo.tpl";

                    $mensagem_formatada = $this->smarty->fetch($caminho);
                } catch (Exception $e) {
                    $mensagem_formatada = $this->smarty->fetch(COMMONPATH . "../templates/padrao/forms/curriculo.tpl");
                }


                $email['Mensagem_txa'] = $mensagem_formatada;
//                    $email['Mensagem_txa'] = 'Novo currículo de ' . $email['Nome_txf'] . ' foi enviado em seu site. Para vizualizá-lo acesse o painel de controle. <a href="http://painel.landsdigital.com.br" >http://painel.landsdigital.com.br</a>';
                //envia email para o site
                $this->envia_email($email, NULL, FALSE);

                //envia confirmacao para o enviador
                $email['Email_txf'] = "webmaster@landshosting.com.br";
                $email['Destinatario_txf'] = $_POST['Email_txf'];
                $email['Nome_txf'] = $this->app->Nome_app_txf;
                $email['Assunto_txf'] = 'Currículo recebido (' . ($this->app->Nome_app_txf) . ')';
                $email['Mensagem_txa'] = "Seu currículo foi enviado com sucesso para o site {$this->app->Nome_app_txf}. Obrigado pelo contato.";
                $this->envia_email($email, NULL, FALSE);
            }
        } else {

            $this->model_curriculo->cria_tabela_curriculo($this->app->Lands_id, 'curriculos');
            $this->postar_curriculo();
        }
    }

    function verifica_campos_curriculo() {
        if ($_POST['Email_txf'] == '')
            return false;
        if ($_POST['Nome_txf'] == '')
            return false;

        return true;
    }

}

?>