<?php

require_once(COMMONPATH . 'core/lands_core.php');

/**
 * Constructor
 *
 * @access public
 */
class lands_eventos extends lands_core {

    public $formularios;
    public $evento;

    public function __construct() {
        parent::__construct();
        $this->load->helper('tradutor');
        $this->load->helper('eventools');
        $this->load->model('model_mailer');
        $this->model_mailer->inicializa($this->app, $this->cliente);

        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);
    }

    function index() {
        die('nao tem index');
    }

    function agenda_envio($registro, $email = 'enviar_pagamento') {



        $resposta = $this->model_mailer->agenda_envio($email, $registro);
    }

    function altera_registro() {

        $dados = $_POST;
        if (!isset($dados['Tabela_txf']))
            die('Campo Tabela_txf nao encontrado');
        if (!isset($dados['Id_int']))
            die('Campo Id_int nao encontrado');

//        ver($dados);
        if ($this->mbc->updateTable($dados['Tabela_txf'], $_POST, 'Id_int', $dados['Id_int'])) {
            $this->smarty->assign('mensagem', 'atualizacao_ok');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
        } else {
            $this->smarty->assign('mensagem', 'atualizacao_erro');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
        }
    }

    /* ATUALIZA AS INSCRICOES */

    function atualiza_incricoes($inscricoes) {
        foreach ($inscricoes as $inscricao) {
            $array_update = object_to_array($inscricao);
            $this->mbc->updateTable('inscricoes', $array_update, 'Id_int', $array_update['Id_int']);
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
                redirect("login?redirect_link=$pagina_atual");
            } else {
                redirect("login");
            }
        } else {
            $this->usuario = $this->session->userdata['usuario'];
            $this->smarty->assign('usuario', $this->usuario);
            $this->smarty->assign('usuario_logado', $this->session->userdata['usuario']);
            return true;
        }
    }

    function checa_usuario_admin() {
        if ($this->usuario->Tipo_sel != 'admin') {
            redirect('acesso_negado_admin');
        }
    }

    function busca_formularios($where = null) {

        if (!$where) {
            $where = "where Id_int is not null ";
        }
        $where.=" and Ativo_sel='SIM' order by Ordenacao_txf, Data_inicio_dat ";
        //   ver($where);
        $formularios = $this->mbc->buscar_completo("eventos_formularios", $where);

//        if($formularios[1]){
//            die('Url amigavel de formulário repetida');
//        }
        foreach ($formularios as $formulario) {
            $sql = "select * from formularios_configs where Evento_sel='{$this->evento->Url_amigavel_txf}' and Formulario_sel='{$formulario->Url_amigavel_txf}'";
            $formulario->Valores = $this->mbc->executa_sql($sql);
        }


        $this->formularios = $formularios;
        $this->smarty->assign('formularios', $this->formularios);
    }

    function busca_formularios_imprensa($inscricao = null, $nome_evento = null) {

        $where = "where Id_int is not null ";

        if ($inscricao[0]) {
            $evento = $inscricao[0]->Evento_txf;
            $formulario = $inscricao[0]->Formulario_txf;
            $where = "where Url_amigavel_txf='{$formulario}' and Evento_sel='{$evento}' ";
        }

        if ($nome_evento) {
            $where = "where Evento_sel='{$nome_evento}' ";
        }





        $where.=" and Ativo_sel='SIM' order by Ordenacao_txf, Data_inicio_dat desc";


        $formularios_imprensa = $this->mbc->buscar_completo("eventos_formularios_imprensa", $where);

        $this->formularios_imprensa = $formularios_imprensa;

        $this->smarty->assign('formularios_imprensa', $this->formularios_imprensa);
    }

    function busca_eventos($url_amigavel = null, $empresa = null) {

        $where = "where Ativo_sel='SIM' ";
        if ($url_amigavel) {
            $where.=" and Url_amigavel_txf='$url_amigavel'";
        }
        if ($empresa) {
            $where.=" and Empresa_sel='$empresa'";
        }
        $eventos = $this->mbc->buscar_completo("eventos", $where . " order by Id_int desc ");
//        ver($eventos);
        if (!$eventos[0]) {
            die('Acesso Invalido');
        }
        $this->evento = $eventos[0];

        $this->smarty->assign('eventos', $eventos);
        return $eventos;
    }

    function carrega_formulario($formulario = null) {
        if (!$formulario) {
            $formulario = $this->formularios[0];
        }
        if ($this->formulario->Arquivo_formulario_txf == 'padrao') {
            $this->model_smarty->carrega_tpl_modulo($this->app->Template_txf, 'formularios', 'padrao', 'formulario');
        } else {
            $this->model_smarty->carrega_tpl_modulo($this->app->Template_txf, 'formularios/' . $formulario->Evento_sel, $formulario->Arquivo_formulario_txf, 'formulario');
        }
    }

    function insere_atualiza_usuario($dados) {

        if (is_object($dados)) {
            $array = object_to_array($dados);
        } else {
            $array = $dados;
        }

        if ($array['Id_int']) {
            unset($array['Email_txf']);
            $array['Ultima_atualizacao_dat'] = date('Y-m-d H:i:s');

            return $this->mbc->updateTable('usuarios', $array, 'Id_int', $array['Id_int'], TRUE);
        } else {

            $array['Data_dat'] = date('Y-m-d H:i:s');
            return $this->mbc->db_insert('usuarios', $array, TRUE);
        }
    }

    function atualiza_usuario_auto() {

        $dados = $_POST;


        if (is_object($dados)) {
            $dados = object_to_array($dados);
        }
        unset($dados['Cpf_txf']);
        unset($dados['Email_txf']);

        $datetime = retorna_date_time();
        $dados['Ultima_atualizacao_dat'] = $datetime;
        $this->mbc->updateTable('usuarios', $dados, 'Id_int', $this->usuario->Id_int);
    }

    function insere_usuario() {
        $email = $_POST['Email_txf'];

        $this->mbc->db_insert('usuarios', $_POST);

        $usuario = $this->mbc->buscar_completo("usuarios", "where Email_txf='$email'");
        if (!isset($usuario[0]->Id_int)) {
            //     $usuario = $this->mbc->buscar_completo("usuarios", "where Facebook_id_txf='764064293669850'");
            die('nao criou usuario');
        }
        return $usuario[0];
    }

    function verifica_cupom($atualiza) {


        $formulario_cupom = null;
        $cupom = $this->mbc->executa_sql("select * from cupons where Codigo_txf='{$_POST['Cupom_txf']}' and Utilizado_sel='NAO'");

        if ($cupom[0]->Id_int) {
            $formulario_cupom = $this->mbc->executa_sql("select * from formularios_cupons where Formulario_sel='{$_POST['Formulario_txf']}' and Id_int={$cupom[0]->Id_objeto_con}");
        }
        if ($formulario_cupom[0]) {


            $valor_original = $_POST['Valor_txf'];
            if ($formulario_cupom[0]->Desconto_txf) {
                $desconto = $formulario_cupom[0]->Desconto_txf;
            } else {
                $desconto = '100';
            }
            $valor_novo = $valor_original - (($desconto / 100) * $valor_original);
            $valor_novo = round($valor_novo);
            $valor_novo = number_format($valor_novo, 2, ".", "");
            $_POST['Valor_txf'] = $valor_novo;
            if ($desconto == '100') {
                $_POST['Pago_sel'] = 'SIM';
            }



            if ($atualiza) {
                $cupom[0]->Utilizado_sel = 'SIM';
                $this->mbc->updateTable('cupons', $cupom[0], 'Id_int', $cupom[0]->Id_int);

                $this->smarty->assign('mensagem', 'cupom_utilizado');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            }
            return TRUE;
        } else {

            $this->smarty->assign('mensagem', 'cupom_erro');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            die();
        }
    }

    function verifica_cupom_ajax() {
        $formulario_cupom = null;
        $sql = "select c.* from cupons c where Codigo_txf='{$_POST['Cupom_txf']}' and Utilizado_sel='NAO'";
        $cupom = $this->mbc->executa_sql($sql);
//        ver($_POST,1);
        //left outer join formularios_cupons on
        if ($cupom[0]->Id_int) {
            $formulario_cupom = $this->mbc->executa_sql("select * from formularios_cupons where Formulario_sel='{$_POST['Formulario_txf']}' and Id_int={$cupom[0]->Id_objeto_con}");
            if ($formulario_cupom[0]) {
                $valor_original = $_POST['Valor_txf'];
                if ($formulario_cupom[0]->Desconto_txf) {
                    $desconto = $formulario_cupom[0]->Desconto_txf;
                } else {
                    $desconto = '100';
                }
                $valor_novo = $valor_original - (($desconto / 100) * $valor_original);
//                $valor_novo=56;
                $valor_novo = round($valor_novo);
                $valor_novo = number_format($valor_novo, 2, ",", "");
                echo "Você irá pagar R$ {$valor_novo}";
            } else {
                echo "Cupom inválido";
            }
        } else {
            echo "Cupom não identificado";
        }

        die();
    }

    function fazer_login() {

        $login = $_REQUEST['Email_txf'];

        $senha = $_REQUEST['Senha_txf'];

        $redirect = $_REQUEST['redirect_link'];



        $sql = "select * from usuarios where Email_txf='$login'";
//        if (!$_REQUEST['auto']) {
//            $sql.=" and ( Senha_txf='$senha' or Cpf_txf='$senha' or Rg_txf='$senha' or Matricula_txf='$senha' ) limit 1";
//        }


        $usuarios = $this->mbc->executa_sql($sql);

        if ($usuarios) {


            if ($this->checa_senha($usuarios, $senha)) {

                $usuario = $usuarios[0];

                $this->session->set_userdata('usuario', $usuario);

                $this->smarty->assign('mensagem', 'login_ok');
                $this->model_smarty->render_ajax('msg_login', $this->app->Template_txf);

//                ver($redirect);
                $redirect = str_replace("eventools//", "eventools/", $redirect);

//                ver($redirect);
//                $url = str_replace('http://', '', $this->app->Url_cliente);
                $redirect = str_replace('https:https://', 'https://', $redirect);
//                $url_temp = str_replace('//', '/', $url . $redirect);
//                $url_final = "https://" . $url_temp;
                //  ver($redirect);
                redireciona($redirect);
                die();
            } else {

                $this->smarty->assign('mensagem', 'login_erro');
                $this->model_smarty->render_ajax('msg_login', $this->app->Template_txf);
                die();
            }
        } else {
            $this->smarty->assign('mensagem', 'login_erro');
            $this->model_smarty->render_ajax('msg_login', $this->app->Template_txf);
            die();
        }
    }

    function checa_senha($usuarios, $senha) {

        if ($_REQUEST['auto']) {
            return true;
        }
        $senha = str_replace('.', '', $senha);
        $senha = str_replace('-', '', $senha);
        $senha = str_replace('/', '', $senha);

        $cpf = str_replace('.', '', $usuarios[0]->Cpf_txf);
        $cpf = str_replace('-', '', $cpf);

        $rg = str_replace('.', '', $usuarios[0]->Rg_txf);
        $rg = str_replace('-', '', $rg);
        $rg = str_replace('/', '', $rg);

//        $matricula=  str_replace('.', '', $usuarios[0]->Matricula_txf);
//        $matricula=  str_replace('-', '', $matricula);


        if ($senha == $cpf) {
            return true;
        }
        if ($senha == $rg) {
            return true;
        }
//        if($senha==$matricula){
//            return true;
//        }


        return false;
    }

    function logout() {

        $this->session->unset_userdata('usuario');
        if (isset($this->session->userdata['email']))
            $this->session->unset_userdata('email');
        if (isset($this->session->userdata['senha_temporaria']))
            $this->session->unset_userdata('senha_temporaria');
        $mensagem = '<label>Deslogado com sucesso!</label>';


        if (isset($this->requisicao['redirect_link'])) {
            redirect($this->requisicao['redirect_link']);
        } else {
            redirect('/');
        }
    }

    function recuperar_senha() {
        if (!isset($_POST['Email_txf'])) {
            die('Email do usuario nao foi passado como parametro');
        }
        $valor = $_POST['Email_txf'];
        $this->conecta_mbc($this->app->Conexoes_for);
        $usu = $this->mbc->executa_sql("select * from usuarios where Email_txf='$valor' limit 1");

        if (isset($usu[0]->Email_txf)) {
            $this->smarty->assign('usuario', $usu[0]);
            $this->load->model('model_login');
            $this->model_login->configura($this->app);
            $email['Email_txf'] = 'webmaster@landshosting.com.br';
            $email['Destinatario_txf'] = $_POST['Email_txf'];
            $email['Nome_txf'] = 'Web Master';
            $email['Assunto_txf'] = 'Recuperação de Senha - ' . $this->app->Nome_app_txf;
            if ($this->envia_email($email, 'recuperacao_senha')) {
                $this->smarty->assign('mensagem', 'recuperacao_ok');
                $this->model_smarty->render_ajax('msg_login', $this->app->Template_txf);
            } else {
                $this->smarty->assign('mensagem', 'recuperacao_erro');
                $this->model_smarty->render_ajax('msg_login', $this->app->Template_txf);
            }
        } else {

            $this->smarty->assign('mensagem', 'recuperacao_not_email');
            $this->model_smarty->render_ajax('msg_login', $this->app->Template_txf);
        }
    }

    function envia_email($email, $formulario = null, $copia_cliente = TRUE) {
        if (!isset($email['Nome_txf'])) {
            $email['Nome_txf'] = 'Email do Site ' . $this->app->Nome_app_txf;
        }
        $email['Destinatario_txf'] = $email['Destinatario_txf'];
        $email['Assunto_txf'];
        if (isset($formulario)) {
            $mensagem = $this->smarty->fetch(COMMONPATH . "../templates/{$this->app->Template_txf}/email/{$formulario}.tpl");
            $email['Mensagem_txa'] = $mensagem;
        }



        $this->load->model('model_mail');
        $this->model_mail->inicializa($this->app);
        $enviou = $this->model_mail->envia_email_novo($email, $copia_cliente);

        return $enviou;
    }

    function envia_email_inscricao($email, $pasta = '', $formulario = null, $copia_cliente = TRUE) {
        if (!isset($email['Nome_txf'])) {
            $email['Nome_txf'] = 'Email do Site ' . $this->app->Nome_app_txf;
        }
        $email['Destinatario_txf'] = $email['Destinatario_txf'];
        $email['Assunto_txf'];

        if (isset($formulario)) {
            $caminho = COMMONPATH . "../templates/{$this->app->Template_txf}/email/{$pasta}{$formulario}.tpl";
            if (file_exists($caminho)) {
                //$this->model_smarty->render($this->pagina_atual, $this->app->Template_txf, $this->modulo);
            } else {
                $caminho = COMMONPATH . "../templates/{$this->app->Template_txf}/email/{$formulario}.tpl";
            }
            $mensagem = $this->smarty->fetch($caminho);
            $email['Mensagem_txa'] = $mensagem;
        }
        $this->load->model('model_mail');
        $this->model_mail->inicializa($this->app);
        $enviou = $this->model_mail->envia_email_novo($email, $copia_cliente);

        return $enviou;
    }

    function envia_email_inscricao_smtp($email, $config, $pasta = '', $formulario = null, $copia_cliente = TRUE) {
        if (!isset($email['Nome_txf'])) {
            $email['Nome_txf'] = 'Email do Site ' . $this->app->Nome_app_txf;
        }
        $email['Destinatario_txf'] = $email['Destinatario_txf'];
        $email['Assunto_txf'];
        if (isset($formulario)) {
            $caminho = COMMONPATH . "../templates/{$this->app->Template_txf}/email/{$pasta}{$formulario}.tpl";
            if (file_exists($caminho)) {
                // $this->model_smarty->render($this->pagina_atual, $this->app->Template_txf, $this->modulo);
            } else {
                $caminho = COMMONPATH . "../templates/{$this->app->Template_txf}/email/{$formulario}.tpl";
            }
            $mensagem = $this->smarty->fetch($caminho);
        }

//        ver($mensagem,1);
        $dados = new stdClass();
        $dados->Subject = $email['Assunto_txf'];
        $dados->From = $config->Smtp_usuario_txf;
        $dados->FromName = $config->Nome_txf;
        $dados->Email_txf = $email['Email_txf'];
        $dados->Destinatarios[] = $email['Destinatario_txf'];
//        $dados->Destinatarios[] = $email['Email_txf'];

        $dados->Host = $config->Smtp_host_txf;
        $dados->Port = $config->Smtp_porta_txf;
        $dados->Username = $config->Smtp_usuario_txf;
        $dados->Password = $config->Smtp_senha_txf;
        $dados->Body = $mensagem;
        $dados->AltBody = $dados->Subject;
        $this->load->model('model_mail');
//        ver($dados);
        $this->model_mail->inicializa($this->app);
        $enviou = $this->model_mail->envia_email_smtp($dados, $copia_cliente);
        return $enviou;
    }

    function grava_log_certificado() {
        $array = array();
        $array['Abriu_certificado_sel'] = 'SIM';
        $this->mbc->updateTable('inscricoes', $array, 'Id_int', $this->inscricao->Id_int);
        $array['Inscricoes_for'] = $this->inscricao->Id_int;
        $array['Data_dat'] = date('Y-m-d H:i:s');
        $this->mbc->db_insert('certificados_aberturas', $array);
    }

    function cria_pdf_certificado($id) {
        /* BUSCA A INSCRICAO */
        $where = " where Id_int={$id}";
        $inscricoes = $this->mbc->buscar_tudo('inscricoes', $where);
        $inscricoes[0]->Percentual_presenca_txf = number_format($inscricoes[0]->Percentual_presenca_txf, 1, ",", ".");

        $this->smarty->assign('inscricoes', $inscricoes);
        if (!$inscricoes[0]) {
            die('inscricao nao encontrada');
        }
        $this->inscricao = $inscricoes[0];



        /* SE TIVER PERMITIDA A IMPRESSAO VAI ADIANTE */
        if ($this->inscricao->Certificado_sel == 'SIM') {




            /* BUSCA DADOS DO FORMULARIO E DO EVENTO */
            $this->busca_formularios_eventos($inscricoes);



            /* BUSCA USUARIO DA INSCRICAO */
            $email_usuario = $inscricoes[0]->Email_txf;
            $where = "where Email_txf='$email_usuario'";
            $usuario_inscricao = $this->mbc->buscar_tudo('usuarios', $where);
            $this->usuario = $usuario_inscricao[0];


            if ($this->session->userdata['usuario']->Id_int == $this->usuario->Id_int) {
                $this->grava_log_certificado();
            }

            $this->smarty->assign("usuario_inscricao", $usuario_inscricao[0]);
            if (!$usuario_inscricao) {
                die('Usuario invalido');
            }

            /* BUSCA CONFIGURACOES DO CERTIFICADO */
            $certificado_configs = $this->mbc->buscar_completo("certificados_configs", "where Evento_sel='{$this->inscricao->Evento_txf}' and Formulario_sel='{$this->inscricao->Formulario_txf}'");
            if (!$certificado_configs[0]) {
                $certificado_configs = $this->mbc->buscar_completo("certificados_configs", "where Evento_sel='{$this->inscricao->Evento_txf}' ");
//                die('Sem configuracoes de certificado para este evento');
            }



            $this->certificado_configs = $certificado_configs[0];
            $this->smarty->assign('certificado_configs', $this->certificado_configs);


            /* CARREGA O NUMERO DE CERTIFICADOS */
            $where = "where Pago_sel='SIM' and Evento_txf='{$this->inscricao->Evento_txf}' and Formulario_txf='{$this->inscricao->Formulario_txf}' and Certificado_sel='SIM' order by Id_inscricao";
            $todas_inscricoes = $this->mbc->executa_sql("select i.Id_int as Id_inscricao, i.*, u.* from inscricoes i left outer join usuarios u on u.Email_txf=i.Email_txf " . $where);
            $cont = 0;

            foreach ($todas_inscricoes as $inscricao) {
                $cont = $cont + 1;
                if ($inscricao->Id_inscricao == $inscricoes[0]->Id_int) {
                    $numero_inscricao = $cont;
                }
            }
            $total_gerados = conta($todas_inscricoes, 'Certificado_sel', 'SIM');
            $this->smarty->assign('numero_inscricao', $numero_inscricao);
            $this->smarty->assign('total_gerados', $total_gerados);





            /* CARREGA O BLOCO CONTENDO O CONTEUDO DO CERTIFICADO */
            if ($this->certificado_configs->Arquivo_tpl_txf == 'padrao') {
                $this->model_smarty->carrega_tpl_modulo($this->app->Template_txf, 'certificados', 'padrao', 'certificado');
            } else {
                $this->model_smarty->carrega_tpl_modulo($this->app->Template_txf, 'certificados/' . $this->namespace_empresa, $this->certificado_configs->Arquivo_tpl_txf, 'certificado');
            }

            /* CARREGA O HTML PRINCIPAL DO CERTIFICADO */
            $html = $this->model_smarty->retorna_tpl('certificado', $this->app->Template_txf);

//            echo $html;
//            die();


            /* CONVERTE PARA EM PDF */
            $pdfFilePath = "certificado_{$this->evento->Url_amigavel_txf}_{$this->inscricao->Id_int}.pdf";
            $this->load->library('landspdf');
            $default_font_size = 0;
            $default_font = '';
            $mgl = 0;
            $mgr = 0;
            $mgt = 0;
            $mgb = 0;
            $mgh = 0;
            $mgf = 0;
            $orientation = 'l';

            $this->pdf = $this->landspdf->load('c', 'A4-L', $default_font_size, $default_font, $mgl, $mgr, $mgt, $mgb, $mgh, $mgf, $orientation);
            $this->pdf->WriteHTML($html);
            if (is_lands()) {
//                echo $html;
//                die();
                
                $this->pdf->Output($pdfFilePath, "D");
            } else {
                $this->pdf->Output($pdfFilePath, "D");
            }
            die();
        } else {
            die("Impressao de certificado nao permitida. para a inscricao de numero {$id}");
        }
    }

    function cria_lista_certificados($tipo) {
        /* busca formulario */
        if ($this->uri->segment(3)) {
            $url_amigavel_form = $this->uri->segment(3);
            $where = "where Url_amigavel_txf='$url_amigavel_form'";
        } else {
            die('acesso invalido');
        }

        $this->busca_formularios($where);

        /* busca evento */
        $url_amigavel_evento = $this->formularios[0]->Evento_sel;
        $this->busca_eventos($url_amigavel_evento);
        $where = "where Evento_sel='{$url_amigavel_evento}' and Formulario_sel='{$url_amigavel_form}'";


        $certificado_configs = $this->mbc->buscar_completo("certificados_configs", "$where");
        $this->certificado_configs = $certificado_configs[0];

        $and = '';
        if ($this->certificado_configs->Presenca_txf) {
            $and = " and Percentual_presenca_txf>={$this->certificado_configs->Presenca_txf}";
        }

        /* busca inscricoes */
        if ($tipo == 'TODAS') {
            $where_tipo = "";
        } else {
            $where_tipo = " and i.Tipo_inscricao_txf='$tipo' ";
        }
        $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}' $and $where_tipo order by Nome_txf";
        $inscricoes = $this->mbc->executa_sql("select * from inscricoes i left outer join usuarios u on u.Email_txf=i.Email_txf " . $where);

        $this->inscricoes = $inscricoes;
        $this->smarty->assign('inscricoes', $inscricoes);

        $total_gerados = conta($inscricoes, 'Certificado_sel', 'SIM');
        $total_negados = conta($inscricoes, 'Certificado_sel', 'NAO');

        $this->smarty->assign('total_negados', $total_negados);
        $this->smarty->assign('total_gerados', $total_gerados);
    }

    function enviar_recibo($id = null) {
        /* busca inscricao */

        if ($id == null) {
            $id = $_POST['Id_int'];
        }
        $where = " where Id_int={$id} and Pago_sel='SIM'";

        $inscricoes = $this->mbc->buscar_tudo('inscricoes', $where);
        $this->smarty->assign('inscricoes', $inscricoes);
        if (!$inscricoes[0]) {
            $this->smarty->assign('mensagem', 'recibo_nao_pago');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            die();
        }


        $this->busca_formularios_eventos($inscricoes);

        $pasta = $this->evento->Url_amigavel_txf;
        $pasta.='/';
        /* busca usuario da inscricao */
        $email_usuario = $inscricoes[0]->Email_txf;
        $where = "where Email_txf='$email_usuario'";
        $usuario_inscricao = $this->mbc->buscar_tudo('usuarios', $where);
        $this->usuario = $usuario_inscricao[0];


        $this->smarty->assign("usuario_inscricao", $usuario_inscricao);
        if (!$usuario_inscricao) {
            die('Usuario invalido');
        }
        $email['Nome_txf'] = 'Administração - ' . $this->evento->Nome_txf;
        $email['Assunto_txf'] = 'Recibo ' . $this->evento->Nome_txf . $this->Formularios[0]->Nome_txf;
        $email['Destinatario_txf'] = $this->usuario->Email_txf;
        $email['Email_txf'] = $this->evento->Evento_principal_txf;



//        if ($this->envia_email_inscricao($email, $pasta, 'email_recibo')) {
//            $this->smarty->assign('mensagem', 'recibo_ok');
//            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
//        } else {
//            $this->smarty->assign('mensagem', 'recibo_erro');
//            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
//        }

        if ($this->evento->Email_tipo_sel == 'smtp') {
            if ($this->envia_email_inscricao_smtp($email, $this->evento, $pasta, 'email_recibo')) {
                $this->smarty->assign('mensagem', 'recibo_ok');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                die();
            } else {
                $this->smarty->assign('mensagem', 'recibo_erro');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                die();
            }
        } else {
            if ($this->envia_email_inscricao($email, $pasta, 'email_recibo')) {
                $this->smarty->assign('mensagem', 'recibo_ok');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                die();
            } else {
                $this->smarty->assign('mensagem', 'recibo_erro');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                die();
            }
        }
    }

    function enviar_pagamento($id = null) {
        /* busca inscricao */

        if ($id == null) {
            $id = $_POST['Id_int'];
        }
        $where = " where Id_int={$id}";

        $inscricoes = $this->mbc->buscar_tudo('inscricoes', $where);
        $this->smarty->assign('inscricoes', $inscricoes);

        $this->busca_formularios_eventos($inscricoes);

        $pasta = $this->evento->Url_amigavel_txf;
        $pasta.='/';
        /* busca usuario da inscricao */
        $email_usuario = $inscricoes[0]->Email_txf;
        $where = "where Email_txf='$email_usuario'";
        $usuario_inscricao = $this->mbc->buscar_tudo('usuarios', $where);
        $this->usuario = $usuario_inscricao[0];


        $this->smarty->assign("usuario_inscricao", $usuario_inscricao);
        if (!$usuario_inscricao) {
            die('Usuario invalido');
        }
        $email['Nome_txf'] = 'Administração - ' . $this->evento->Nome_txf;
        $email['Assunto_txf'] = 'Eventtools - Link para pagamento';
        $email['Destinatario_txf'] = $this->usuario->Email_txf;
        $email['Email_txf'] = $this->evento->Evento_principal_txf;


//        $retorno = json_decode(consulta_link($this->evento->id_sistema, $inscricoes[0]->Id_int));

        $link = "{$this->app->Url_cliente}fazer_login?auto=true&Email_txf=$email_usuario&redirect_link={$this->app->Url_cliente}/inscricao/{$id}/pagar";
        $this->smarty->assign("link", $link);


        if ($this->evento->Email_tipo_sel == 'smtp') {
            if ($this->envia_email_inscricao_smtp($email, $this->evento, $pasta, 'email_pagamento')) {
                $this->smarty->assign('mensagem', 'email_ok');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                die();
            } else {
                $this->smarty->assign('mensagem', 'email_erro');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                die();
            }
        } else {
            if ($this->envia_email_inscricao($email, $pasta, 'email_pagamento')) {
                $this->smarty->assign('mensagem', 'email_ok');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                die();
            } else {
                $this->smarty->assign('mensagem', 'email_erro');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                die();
            }
        }
    }

    function busca_vagas($total = 0) {

        $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}'";
        $totalizadores = $this->mbc->executa_sql("select  COUNT(i.Id_int) as total, i.Email_txf from inscricoes i  {$where}");

        if ($total == 0) {
            $this->smarty->assign('total_vagas', 'Ilimitado');
            $this->smarty->assign('total_inscricoes', $totalizadores[0]->total);
            $this->smarty->assign('vagas_restantes', 'Ilimitado');
            return 'Ilimitado';
        } else {
//  ver($total,1);
// ver($totalizadores[0]->total,1);

            $vagas_restantes = $total - $totalizadores[0]->total;

            $this->smarty->assign('total_vagas', $total);
            $this->smarty->assign('total_inscricoes', $totalizadores[0]->total);
            $this->smarty->assign('vagas_restantes', $vagas_restantes);




            return $vagas_restantes;
        }
    }

    function busca_configuracoes_pagto_originais($admin = null) {
        $sql = "select * from formularios_configs where Evento_sel='{$this->evento->Url_amigavel_txf}' and Formulario_sel='{$this->formularios[0]->Url_amigavel_txf}'";
        $promocao_configs_originais = $this->mbc->executa_sql($sql);
        if ($promocao_configs_originais) {
            $promocao_configs_originais[0]->Valor_ajustado = str_replace(",", ".", $promocao_configs_originais[0]->Valor_txf);
        }

        $this->smarty->assign('promocao_configs_originais', $promocao_configs_originais);

        return $promocao_configs_originais;
    }

    function busca_configuracoes_pagto($admin = null) {
        $sql = "select * from formularios_configs where Evento_sel='{$this->evento->Url_amigavel_txf}' and Formulario_sel='{$this->formularios[0]->Url_amigavel_txf}'";

        $promocao_configs = $this->mbc->executa_sql($sql);


        if ($this->inscricao->Valor_txf) {
            $promocao_configs[0]->Valor_txf = $this->inscricao->Valor_txf;
        }

        $promocao_configs[0]->Valor_ajustado = str_replace(",", ".", $promocao_configs[0]->Valor_txf);

        $this->promocao_configs = $promocao_configs[0];

        $this->smarty->assign('promocao_configs', $promocao_configs);

//        
//
//        foreach ($pagamentos_permitidos as $pagamentos) {
//
//            $temp = $this->mbc->buscar_completo($pagamentos, "where Evento_sel='{$this->evento->Url_amigavel_txf}'");
//            if (isset($temp[0])) {
//                $pagto = str_replace('boleto_', '', $pagamentos);
//                $boleto[$pagto] = $temp[0];
//            }
//        }
//        $this->boleto = $boleto;
//        $this->smarty->assign('boleto', $boleto);
        if (!$admin) {
            $this->model_smarty->carrega_bloco('efetuar_pagamento', 'efetuar_pagamento', $this->app->Template_txf);
        }

        return $this->promocao_configs;
    }

    /* CALCULA O NUMERO DE PRESENCAS VALIDAS DA PESSOA E RETORNA O PERCENTUAL */

    function calcula_presenca($inscricao, $formulario) {



        if ($formulario->Tipo_presenca_sel == 'simples') {

            $presencas_obrigatorias = $formulario->Dias_presenca_txf;

            $presencas_reais = 0;

            if ($inscricao->Presenca1_sel == 'SIM') {
                $presencas_reais = $presencas_reais + 1;
            }
            if ($inscricao->Presenca2_sel == 'SIM') {
                $presencas_reais = $presencas_reais + 1;
            }
            if ($inscricao->Presenca3_sel == 'SIM') {
                $presencas_reais = $presencas_reais + 1;
            }

            $percentual = (100 * $presencas_reais) / $presencas_obrigatorias;


            if (!$percentual) {
                $percentual = 0;
            }
//        ver($inscricao,1);
//          ver($percentual);
            return $percentual;
        } else {

            if (count($this->presencas_config) != 0) {
                $presencas_obrigatorias = count($this->presencas_config);
            } else {
                $presencas_obrigatorias = 0;
            }

            $presencas = $this->mbc->executa_sql("select * from inscricoes_presencas where Inscricoes_for={$inscricao->Id_inscricao} and Valido_sel='SIM'");

            if ($presencas[0]->Id_int) {
                $presencas_reais = count($presencas);
            } else {
                $presencas_reais = 0;
            }
            $percentual = (100 * $presencas_reais) / $presencas_obrigatorias;


            if (!$percentual) {
                $percentual = 0;
            }
            return $percentual;
        }
    }

    function busca_formularios_eventos($inscricoes) {

        /* busca formulario da inscricao */
        $url_amigavel_form = $inscricoes[0]->Formulario_txf;
        $where = "where Url_amigavel_txf='$url_amigavel_form'";
        $this->busca_formularios($where);


        /* busca evento da inscricao */
        $url_amigavel_evento = $inscricoes[0]->Evento_txf;
        $this->busca_eventos($url_amigavel_evento);
    }

    function gerar_certificados() {
        // ver($_POST, 1);
        $url_evento = $_POST['Evento_txf'];
        $url_formulario = $_POST['Formulario_txf'];

        //i.Id_int=551 and 
        /* BUSCA TODAS AS INSCRICOES DO EVENTO */
//        $where = "where Pago_sel='SIM' and Evento_txf='{$url_evento}' and Formulario_txf='{$url_formulario}' order by Tipo_inscricao_txf, Nome_txf";
        $where = "where Pago_sel='SIM' and Evento_txf='{$url_evento}' order by Tipo_inscricao_txf, Nome_txf";
        $inscricoes = $this->mbc->executa_sql("select i.Id_int as Id_inscricao, i.*, u.* from inscricoes i left outer join usuarios u on u.Email_txf=i.Email_txf " . $where);
        $this->inscricoes = $inscricoes;
        // ver($inscricoes[0], 1);



        /* BUSCA AS CONFIGURAÇÕES DE CERTIFICADO */
//        $certificado_configs = $this->mbc->buscar_completo("certificados_configs", "where Evento_sel='{$url_evento}' and Formulario_sel='{$url_formulario}'");
        $certificado_configs = $this->mbc->buscar_completo("certificados_configs", "where Evento_sel='{$url_evento}'");
        $this->certificado_configs = $certificado_configs[0];
        //ver($certificado_configs[0], 1);
        //ver($this->inscricoes);

        /* BUSCA DADOS DO FORMULARIO E EVENTO */
        $this->busca_formularios_eventos($inscricoes);


        /* BUSCA AS CONFIGURAÇÕES DE PRESENCA, OU SEJA, A LISTA DE DIAS DO EVENTO EM QUE É CONTROLADO PRESENÇA */
        $where = "where Evento_sel='{$url_evento}' and Formulario_sel='{$url_formulario}' order by Data_dat";
        $sql = "select * from presencas_configs $where";
        $presencas_configs = $this->mbc->executa_sql($sql);
        // ver($presencas_configs, 1);
        $this->presencas_config = $presencas_configs;
        $this->smarty->assign('presencas_configs', $presencas_configs);



        /* PARA CADA INSCRIÇÃO, BUSCA O PERCENTUAL E ATUALIZA
          NO BANCO DE DADOS SE TEM DIREITO A CERTIFICADO OU NAO */
        $total_gerados = 0;
        $total_negados = 0;
        if ($_POST['liberar']) {
            $liberar = $_POST['liberar'];
        } else {
            $liberar = 'NAO';
        }



//        ver($tipo_presenca);
        foreach ($inscricoes as $inscricao) {

            $inscricao->Percentual_presenca_txf = $this->calcula_presenca($inscricao, $this->formularios[0]);
            if ($liberar == 'SIM') {
                if ($inscricao->Percentual_presenca_txf >= $this->certificado_configs->Presenca_txf) {
                    $inscricao->Certificado_sel = 'SIM';
                    $total_gerados = $total_gerados + 1;
                } else {
                    $inscricao->Certificado_sel = 'NAO';
                    $total_negados = $total_negados + 1;
                }
            }
            $inscricao->Id_int = $inscricao->Id_inscricao;
            $inscricao->Ultima_atualizacao_dat = date('Y-m-d H:i:s');
        }



        $this->atualiza_incricoes($inscricoes);

        /* ORDENA OS REGISTROS POR ORDEM DE PORCENTAGEM */
        sorteia_array_objetos($inscricoes, array('Percentual_presenca_txf' => SORT_DESC, 'Tipo_inscricao_txf' => SORT_ASC, 'Nome_txf' => SORT_ASC));


        $this->smarty->assign('total_negados', $total_negados);
        $this->smarty->assign('total_gerados', $total_gerados);
        $this->smarty->assign('inscricoes', $inscricoes);

        /* EXIBE A LISTA DE REGISTROS */
        $this->model_smarty->render_tpl('lista_presenca', $this->app->Template_txf . '/forms_presenca');

        //$this->model_smarty->carrega_tpl_modulo($this->app->Template_txf, 'formularios/' . $formulario->Evento_sel, $formulario->Arquivo_formulario_txf, 'formulario');
    }

}