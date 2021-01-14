<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class app_lab extends lands_core {

    public $usuario;
    public $Pasta_exames = 'usuarios/ftp/';

    function __construct() {
        $this->load->library('session');
        parent::__construct();

        if ($this->pagina_atual != 'formulario_cadastro') {
            $this->checa_login();
        }

        $this->abre_area_restrita();
    }

    function index() {
        $funcao = $this->pagina_atual;
        if ($this->uri->segment($this->app->Segmento_padrao_txf)) {
            $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);
            $funcao = ($this->uri->segment($this->app->Segmento_padrao_txf));
        }
        if (!method_exists(__CLASS__, $funcao)) {
            $this->carrega_pagina($this->pagina_atual);
        } else {
//executa uma funcao que deve ser programa nesta classe.
            $this->$funcao();
        }
    }

    function abre_area_restrita() {

        if (isset($this->session->userdata['usuario'])) {
            $this->usuario = $this->session->userdata['usuario'];
            $this->smarty->assign('user', $this->usuario);
        }
        if (isset($_SESSION)) {
            $this->smarty->assign('sessao', $_SESSION);
        }

        if ($this->uri->segment($this->app->Segmento_padrao_txf + 1)) {
            $this->smarty->assign('segment2', $this->uri->segment($this->app->Segmento_padrao_txf + 1));
        } else {
            $this->smarty->assign('segment2', '');
        }
        if ($this->uri->segment($this->app->Segmento_padrao_txf + 2)) {
            $this->smarty->assign('segment3', $this->uri->segment($this->app->Segmento_padrao_txf + 2));
        } else {
            $this->smarty->assign('segment3', '');
        }
        if (isset($this->app->Pasta_exames)) {
            $this->Pasta_exames = $this->app->Pasta_exames;
        }
        $this->switch_pagina();
    }

    function switch_pagina() {
        $this->load->library('session');


        switch ($this->pagina_atual) {
            case 'editar_cadastro':
                $user_id = $this->session->userdata['usuario']->Id_int;
                $user = $this->mbc->executa_sql("select * from cadastros where Id_int=$user_id");
                if (!isset($user[0]->Id_int))
                    die('Erro ao editar usuario, usuario de id ' . $user_id . ' nao foi encontrado');
                $this->smarty->assign('user', $user[0]);
                break;
//            case 'baixar_pdf':
//                $user_id = $this->session->userdata['usuario']->Id_int;
//                $id = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
//                $where = "where Id_int={$id}";
//                $solicitacao = $this->mbc->buscar_completo('solicitacoes', $where);
//                if (!isset($solicitacao[0]->Id_int)) {
//                    die('solicitacao nao existe');
//                }
//                if ($user_id != $solicitacao[0]->Id_objeto_con) {
//                    die('Acesso invalido, você só pode ver suas próprias requisições');
//                } else {
//                    $user = $this->mbc->executa_sql("select * from cadastros where Id_int=$user_id");
//                    if (!isset($user[0]->Id_int))
//                        die('Erro ao usuario de id ' . $user_id . ' nao foi encontrado');
//                    $this->smarty->assign('user', $user[0]);
//                    $this->smarty->assign('solicitacao', $solicitacao[0]);
//                    $html = $this->model_smarty->retorna_tpl('pdf_requisicao', $this->app->Template_txf);
//                    $pdfFilePath = "requisicao{$id}.pdf";
//                    $this->load->library('landspdf');
//                    $this->pdf = $this->landspdf->load('c', 'A4');
//                    $this->pdf->WriteHTML($html);
//                    $this->pdf->Output($pdfFilePath, "D");
//                    die();
//                }
//                break;

            case 'restrita':
                if ($this->mbc->tabelaexiste('solicitacoes')) {
                    $user_id = $this->session->userdata['usuario']->Id_int;
                    $solicitacoes = $this->mbc->executa_sql("select * from solicitacoes where Id_objeto_con=$user_id order by Data_dat desc");
                    $this->smarty->assign('solicitacoes', $solicitacoes);
                } else {
                    //   ver('nao existe');
                }
                break;
            case 'lista_resultados':
                $resultados = $this->mbc->executa_sql("select * from sincro where Cadastros_for='{$this->usuario->Id_int}'");
                $this->smarty->assign('resultados', $resultados);
                break;

            case 'resultados':
                $resposta = $this->curlContents($this->usuario->Pasta_txf, 'GET');

                $this->smarty->assign("resultados", $resposta['contents']);
                break;

            case 'resultados_ftp':
                if ($this->conecta_ftp($this->app->Conexao_ftp_for)) {
                    $pasta = $this->usuario->Login_txf . '-' . $this->usuario->Senha_txf;

                    $pasta = $this->configuracoes_ftp->Path_txf . $pasta;
                    $list = $this->ftp->lista_detalhada($pasta);

                    $server = $_SERVER['SERVER_NAME'];

                    foreach ($list as $exame) {
                        $exame->Link_txf = "//{$server}/usuarios/ftp/{$this->usuario->Login_txf}-{$this->usuario->Senha_txf}/{$exame->name}";
                        $exame->Data_dat = date("d/m/Y  H:i:s", $exame->date);
//                        $exame->time=str_replace(':','',$exame->time);
//                            $exame->Data_dat = $exame->time . '-' . retorna_mes_fromstring($exame->month) . '-' . str_pad($exame->day, 2, '0', STR_PAD_LEFT);
                    }

                    sorteia_array_objetos($list, array('date' => SORT_DESC));
                    $this->smarty->assign('resultados', $list);
                } else {
                    die('Erro de conexao ftp');
                }
                break;

            case 'avisos':
//
//                $avisos = $this->mbc->buscar_completo("avisos");
//
//                $this->smarty->assign('avisos', $avisos);

                break;
            case 'ver_arquivo':

                if ($_POST['link']) {
                    $link = 'http:';
                    $link.= $_POST['link'];
                }
                if ($_POST['nome_arquivo']) {
                    $nome_arquivo = str_replace('.pdf', '', $_POST['nome_arquivo']);
                }
                if ($_POST['pagina_anterior']) {
                    $pagina_anterior = $_POST['pagina_anterior'];
                } else {
                    $pagina_anterior = '';
                }
                $this->smarty->assign("pagina_anterior", $pagina_anterior);
                $imagem_arquivo = "img/{$nome_arquivo}.jpg";
//                if (!file_exists($imagem_arquivo)) {
//                ini_set('display_errors', 'On');

                $imagick = new Imagick();

//                ver($_POST);
                $imagick->readImage($link);
//                $imagick->setResolution(200, 200);
//                $imagick->scaleImage(800, 0);
                $imagick->writeImages($imagem_arquivo, false);
                $total_paginas = $imagick->getNumberImages();

                $imagens = array();
                if ($total_paginas == 1) {
                    $imagem = new stdClass();
                    $imagem->Caminho_txf = "img/{$nome_arquivo}.jpg";
                    $imagens[] = $imagem;
                } else {
                    for ($i = 0; $i <= $total_paginas - 1; $i++) {
                        $imagem = new stdClass();
                        $imagem->Caminho_txf = "img/{$nome_arquivo}-{$i}.jpg";
                        $imagens[] = $imagem;
                    }
//                }
                }
                $this->smarty->assign("imagens", $imagens);
                break;
            case 'exame':

                $arquivo = $_REQUEST['link'];
                header("Content-type:application/pdf");

// It will be called downloaded.pdf
                header("Content-Disposition:attachment;filename=exame.pdf");

// The PDF source is in original.pdf
                readfile("$arquivo");
                die();

                break;


            default:

                break;
        }

        $this->smarty->assign("sessao_ci", $this->session->all_userdata());
        if (isset($_SESSION)) {
            $this->smarty->assign("sessao", $_SESSION);
        }
    }

    function count_pages($pdfname) {
//        ver($pdfname);
        $pdftext = file_get_contents($pdfname);

        $num = preg_match_all("/\/Page\W/", $pdftext, $dummy);
        return $num;
    }

    function curlContents($url, $method = 'GET', $data = false, $headers = false, $returnInfo = true) {
        $ch = curl_init();


        $url = str_replace(' ', '%20', $url);

        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            if ($data !== false) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }
        } else {
            if ($data !== false) {
                if (is_array($data)) {
                    $dataTokens = array();
                    foreach ($data as $key => $value) {
                        array_push($dataTokens, urlencode($key) . '=' . urlencode($value));
                    }
                    $data = implode('&', $dataTokens);
                }
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $data);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        if ($headers !== false) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        $contents = curl_exec($ch);

        if ($returnInfo) {
            $info = curl_getinfo($ch);
        }

        curl_close($ch);

        if ($returnInfo) {
            return array('contents' => $contents, 'info' => $info);
        } else {
            return $contents;
        }
    }

    function postar() {
        $pagina = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
        switch ($pagina) {
            case 'exames':
                $this->load->model('model_mail');
                $this->model_mail->inicializa($this->app, $this->cliente);
                $email = $_POST;
                $this->smarty->assign('usuario', array_to_object($email['usuario']));
                $this->smarty->assign('exames', array_to_object($email['exames']));
                $email['Nome_txf'] = $email['usuario']['Nome_fantasia_txf'];
                $email['Assunto_txf'] = "Solicitação de Exames - " . $this->app->Nome_app_txf;
                if ($this->model_mail->envia_email_tpl($email, 'exames')) {
                    $this->smarty->assign('mensagem', 'exame_enviado');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                    die();
                } else {
                    $this->smarty->assign('mensagem', 'exame_erro');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                    die();
                }
                break;
            case 'exames_v2':
//armazena no banco e envia email
                $this->load->model('model_mail');
                $this->model_mail->inicializa($this->app, $this->cliente);
                $email = $_POST;
                $usuario = array_to_object($email['usuario']);
                $exames = $this->busca_exames();
//$exames = array_to_object($email['exames']);
                $this->smarty->assign('usuario', $usuario);
                $this->smarty->assign('exames', $exames);
                $email['Nome_txf'] = $email['usuario']['Nome_fantasia_txf'];
                $email['Assunto_txf'] = "Solicitação de Exames - " . $this->app->Nome_app_txf;

                if ($usuario->Tipo_pessoa_txf == 'F') {
                    $clinica = $usuario->Nome_txf;
                } else {
                    $clinica = $usuario->Nome_fantasia_txf;
                }
                date_default_timezone_set('America/Sao_Paulo');
                $solicitacao['Data_dat'] = date("Y-m-d");
                $solicitacao['Hora_txf'] = date("H:i:s");
                $solicitacao['Clinica_txf'] = $clinica;
                $solicitacao['Clinica_txf'] = $clinica;
                $solicitacao['Tipo_servico_sel'] = $_POST['Tipo_servico_sel'];
                $solicitacao['Id_objeto_con'] = $usuario->Id_int;
                $solicitacao['Tabela_con'] = 'cadastros';
                $tpl = $this->model_smarty->retrurn_email('exames', $this->app->Template_txf);
                $solicitacao['Solicitacao_txa'] = $tpl;
                $this->mbc->db_insert('solicitacoes', $solicitacao);
                if ($this->model_mail->envia_email_tpl($email, 'exames')) {
                    $this->smarty->assign('mensagem', 'exame_enviado');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                    die();
                } else {
                    $this->smarty->assign('mensagem', 'exame_erro');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                    die();
                }
                break;


            case 'exames_v3':
//armazena no banco e envia email e gera pdf
                $this->load->model('model_mail');
                $this->model_mail->inicializa($this->app, $this->cliente);
                $email = $_POST;
                $usuario = array_to_object($email['usuario']);
                $exames = $this->busca_exames();
//$exames = array_to_object($email['exames']);
                $this->smarty->assign('usuario', $usuario);
                $this->smarty->assign('exames', $exames);
                $email['Nome_txf'] = $email['usuario']['Nome_fantasia_txf'];
                $email['Assunto_txf'] = "Solicitação de Exames - " . $this->app->Nome_app_txf;

                if ($usuario->Tipo_pessoa_txf == 'F') {
                    $clinica = $usuario->Nome_txf;
                } else {
                    $clinica = $usuario->Nome_fantasia_txf;
                }
                date_default_timezone_set('America/Sao_Paulo');
                $solicitacao = $_POST;
                $solicitacao['Data_dat'] = date("Y-m-d");
                $solicitacao['Hora_txf'] = date("H:i:s");
                $solicitacao['Clinica_txf'] = $clinica;
                $solicitacao['Id_objeto_con'] = $usuario->Id_int;
                $solicitacao['Tabela_con'] = 'cadastros';
                $tpl = $this->model_smarty->retrurn_email('exames', $this->app->Template_txf);
                $solicitacao['Solicitacao_txa'] = $tpl;
                $this->mbc->db_insert('solicitacoes', $solicitacao);
                if ($this->model_mail->envia_email_tpl($email, 'exames')) {
                    $this->smarty->assign('mensagem', 'exame_enviado');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                    die();
                } else {
                    $this->smarty->assign('mensagem', 'exame_erro');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                    die();
                }
                break;

            case 'pre_visualizar':
                date_default_timezone_set('America/Sao_Paulo');
                $usuario = array_to_object($_POST['usuario']);
                $exames = $this->busca_exames();
//                        array_to_object($_POST['exames']);
                $this->smarty->assign('usuario', $usuario);
                $this->smarty->assign('exames', $exames);
                $this->model_smarty->render_ajax('pre_visualizar', $this->app->Template_txf);
                die();
                break;
            case 'template':
                date_default_timezone_set('America/Sao_Paulo');
                $usuario = array_to_object($_POST['usuario']);
                $exames = $this->busca_exames();
                $exames_oculto = $this->busca_exames('template');
                $this->smarty->assign('usuario', $usuario);
                $this->smarty->assign('exames', $exames);
                $this->smarty->assign('exames_oculto', $exames_oculto);
                $this->model_smarty->render_ajax('template', $this->app->Template_txf);
                die();
                break;
            case 'salvar_template':
                date_default_timezone_set('America/Sao_Paulo');
                $usuario = array_to_object($_POST['usuario']);
                $objeto['Nome_txf'] = $_POST['Nome_txf'];
                $objeto['Resumo_txf'] = $_POST['Resumo_txf'];
                $objeto['Id_objeto_con'] = $_POST['usuario']['Id_int'];
                $objeto['Tabela_con'] = 'cadastros';
                $objeto['Exames_txa'] = serialize($_POST['Exames']);
                if ($this->mbc->db_insert('templates', $objeto)) {
                    $this->smarty->assign('mensagem', 'salvou_ok');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                } else {
                    $this->smarty->assign('mensagem', 'salvou_erro');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                }
                die();
                break;
            case 'atualiza_templates':
                date_default_timezone_set('America/Sao_Paulo');
                $usuario = array_to_object($_POST['usuario']);
                $id = $_POST['usuario']['Id_int'];
                $templates = $this->mbc->executa_sql("select * from templates where Id_objeto_con=$id order by Nome_txf");
                $this->smarty->assign('templates', $templates);
                $this->model_smarty->render_bloco('templates', $this->app->Template_txf);
                die();
                break;

            case 'carrega_template':
                $this->carrega_dados('formulario_exames');
                date_default_timezone_set('America/Sao_Paulo');
                $id = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
                $exames_carregados = $this->mbc->executa_sql("select * from templates where Id_int=$id");
                $exames_carregados[0]->Exames = unserialize($exames_carregados[0]->Exames_txa);
                $this->smarty->assign('exames_carregados', $exames_carregados);
                $this->model_smarty->render_bloco('abas_exames', $this->app->Template_txf);
                die();
                break;
            case 'deleta_template':
                $id = $this->uri->segment($this->app->Segmento_padrao_txf + 3);
                $this->mbc->deleteRow('templates', 'Id_int', $id);
                $templates = $this->mbc->executa_sql("select * from templates order by Nome_txf");
                $this->smarty->assign('templates', $templates);
                $this->model_smarty->render_bloco('templates', $this->app->Template_txf);
                die();
                break;

            case 'materiais':

                $this->load->model('model_mail');
                $this->model_mail->inicializa($this->app, $this->cliente);
                $email = $_POST;
                $mat = $_POST['materiais'];
                $this->conecta_mbc($this->app->Conexoes_for);

                $materiais = $this->mbc->executa_sql("select * from materiais");
                $materiais_escolhidos = array();
                foreach ($materiais as $material) {
                    foreach ($mat as $key => $value) {
                        if ($material->Id_int == $key && $value != '') {
                            $material->Quantidade_txf = $value;
                            $materiais_escolhidos[] = $material;
                        }
                    }
                }
                $email['materiais'] = $materiais_escolhidos;
                $this->smarty->assign('usuario', array_to_object($email['usuario']));
                $this->smarty->assign('materiais', array_to_object($email['materiais']));
                $email['Nome_txf'] = $email['usuario']['Nome_fantasia_txf'];
                $email['Assunto_txf'] = "Solicitação de Materiais - " . $this->app->Nome_app_txf;

                if ($this->model_mail->envia_email_tpl($email, 'materiais')) {
                    $this->smarty->assign('mensagem', 'materiais_enviado');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                    die();
                } else {
                    $this->smarty->assign('mensagem', 'materiais_erro');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                    die();
                }
                break;

            case 'orcamento':
                $this->load->model('model_mail');
                $this->model_mail->inicializa($this->app, $this->cliente);
                $email = $_POST;
                $this->smarty->assign('usuario', array_to_object($email['usuario']));
                $email['Email_txf'] = $email['usuario']['Email_txf'];
                $email['Nome_txf'] = $email['Responsavel_txf'];
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
                break;
            default:
                break;
        }
    }

    function busca_exames($funcao = null) {
        switch ($funcao) {
            case 'template':

                $exames = array_to_object($_POST['exames']);
                foreach ($exames as $exame) {
                    foreach ($exame as $ex) {
                        $inzame = $this->mbc->executa_sql("select * from exames where Id_int='$ex'");
                        $lista[] = $inzame[0];
                    }
                }
                return $lista;
                break;

            default:
                $exames = array_to_object($_POST['exames']);
                foreach ($exames as $key => $value) {
                    foreach ($value as $ex) {
                        $inzame = $this->mbc->executa_sql("select * from exames where Id_int='$ex'");
                        $lista[$key][] = $inzame[0]->Exame_txf . '(' . $inzame[0]->Amostra_txf . ')';
                    }
                }
                return $lista;
                break;
        }
    }

}

