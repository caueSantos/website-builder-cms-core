<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_eventos.php');

class eventos extends lands_eventos {

    public $formularios_imprensa;
    public $formularios;
    public $evento;

    public function __construct() {
        parent::__construct();
        $this->load->helper('landspay');
        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);
//        die('Plataforma em manutenção');
    }

    function index() {
        if (!method_exists(__CLASS__, $this->pagina_atual)) {
            $this->carrega_pagina($this->pagina_atual);
        } else {
            $funcao_atual = $this->pagina_atual;
//executa uma funcao que deve ser programa nesta classe.
            $this->$funcao_atual();
        }
    }

    function carrega_obrigatorios() {
        $emails = $this->mbc->buscar_tudo("departamentos", "where Ativo_sel='SIM'");

        $this->smarty->assign('emails', $emails);

        /* vedana alterou dia 02.08 */
        $eventos_admin = $this->busca_eventos('', $this->usuario->Empresa_sel);
        $this->smarty->assign("admin_eventos", $eventos_admin);
    }

    function switch_pagina() {

        $this->carrega_obrigatorios();
        switch ($this->pagina_atual) {
            case 'inicio' :
                $this->busca_eventos();
                $this->model_smarty->carrega_bloco('eventos', 'eventos', $this->app->Template_txf);
                break;
            case 'gerador':

                $this->checa_login($this->pagina_atual);
                $this->checa_usuario_admin();

                $where_usuario = '';
                if ($this->usuario->Empresa_sel != 'TODAS') {
                    $where_usuario = " and Empresa_sel='{$this->usuario->Empresa_sel}'";
                }

                $where = "";
                if ($this->uri->segment(2)) {
                    $nome_evento = $this->uri->segment(2);
                    $where = " and Url_amigavel_txf='{$nome_evento}'";
                }
                $sql = "select * from eventos where Ativo_sel='SIM' $where $where_usuario order by Id_int desc";

                $eventos = $this->mbc->executa_sql($sql);

                $sql2 = "select * from empresas order by Nome_txf";

                $empresas = $this->mbc->executa_sql($sql2);
                $this->smarty->assign("empresas", $empresas);


//                 $where = "where Evento_sel='{$url_amigavel_evento}' and Formulario_sel='{$url_amigavel_form}' order by Instituicao_sel";
//                $formularios_cupons = $this->mbc->buscar_tudo("formularios_cupons", $where);


                foreach ($eventos as $evento) {
                    $evento->Formularios = $this->mbc->buscar_completo('eventos_formularios', "where Evento_sel='{$evento->Url_amigavel_txf}'");
                    foreach ($evento->Formularios as $formulario) {
                        foreach ($evento->Formularios as $formulario) {
                            $formulario->Instituicoes = $this->mbc->executa_sql("select i.* from instituicoes i left outer join formularios_cupons fc on fc.Instituicao_sel=i.Nome_txf where i.Id_int is not null and fc.Formulario_sel='{$formulario->Url_amigavel_txf}' and fc.Evento_sel='{$evento->Url_amigavel_txf}' order by i.Nome_txf ");
                        }
                    }
                }
                $this->smarty->assign("eventos", $eventos);

                break;
            case 'eventos' :
                $this->busca_eventos();
                $this->model_smarty->carrega_bloco('eventos', 'eventos', $this->app->Template_txf);
                break;
            case 'meus_dados':
                $this->checa_login();

                $usuario = $this->mbc->buscar_tudo("usuarios", "where Email_txf='{$this->usuario->Email_txf}'");
                $this->smarty->assign('usuario', $usuario[0]);
                break;

            case 'historico' :
                $this->checa_login();
                $this->busca_eventos();
                $this->busca_formularios();
                $this->busca_formularios_imprensa();
                $this->usuario = $this->session->userdata['usuario'];
                if ($this->uri->segment(2)) {
                    $id = $this->uri->segment(2);
                    $where = " where Id_int={$id}";
                } else {
                    $where = " where Email_txf='{$this->usuario->Email_txf}' ";
                }
                $usuario_inscricao = $this->mbc->buscar_tudo('usuarios', $where);
                $this->usuario = $usuario_inscricao[0];
                $this->smarty->assign("usuario_inscricao", $usuario_inscricao);
                if ($usuario_inscricao) {
                    $where = " where Email_txf='{$this->usuario->Email_txf}' order by Data_dat desc";
                    $inscricoes = $this->mbc->buscar_tudo('inscricoes', $where);
                    if ($inscricoes[0]->Id_int) {
                        $this->smarty->assign("inscricoes", $inscricoes);
                    }

                    $inscricoes_imprensa = $this->mbc->buscar_tudo('inscricoes_imprensa', $where);
                    if ($inscricoes_imprensa[0]->Id_int) {
                        $this->smarty->assign("inscricoes_imprensa", $inscricoes_imprensa);
                    }
                } else {
                    die('Usuario invalido');
                }
                break;


            case 'inscricao' :
                $this->checa_login();


                /* busca inscricao */
                if ($this->uri->segment(2)) {
                    $id = $this->uri->segment(2);
                    $where = " where Id_int={$id}";
                } else {
                    die('acesso invalido');
                }
                if ($this->uri->segment(3)) {
                    $acao = $this->uri->segment(3);
                    $this->smarty->assign('acao', $acao);
                }
                $inscricoes = $this->mbc->buscar_tudo('inscricoes', $where);

//                /*REMOVER BLOCO APOS ATIVAR O CRON*/
//                $consulta_pagto = consulta_pagamento(1, $inscricoes[0]->Id_int);
//
//                if ($consulta_pagto[0]) {
//
//                    if ($inscricoes[0]->Pago_sel == 'SIM') {
//
//                        $status = 'pago';
//                    } else {
//
//                        $status = 'aguardando';
//                    }
//                    if ($status != $consulta_pagto[0]->status) {
//                        if ($consulta_pagto[0]->status == 'pago') {
//                            $status2 = 'SIM';
//                        }
//                        if ($consulta_pagto[0]->status == 'aguardando') {
//                            $status2 = 'NAO';
//                        }
//                        $this->atualiza_pagamento_inscricao($inscricoes[0]->Id_int, $status2);
//                        $inscricoes = $this->mbc->buscar_tudo('inscricoes', $where);
//                    }
//                }
//                /*FIM REMOVER BLOCO APOS ATIVAR O CRON*/

                $this->smarty->assign('inscricoes', $inscricoes);
                if (!$inscricoes[0]) {
                    die('inscricao nao encontrada');
                } else {
                    $this->inscricao = $inscricoes[0];
                }

                $this->busca_formularios_eventos($inscricoes);



                if ($this->formularios[0]->Gera_pagto_sel == 'SIM') {
                    $x = $this->busca_configuracoes_pagto_originais();
                }

                $this->busca_sub_inscricoes($inscricoes[0]->Id_int);


                /* busca usuario da inscricao */
                $email_usuario = $inscricoes[0]->Email_txf;
                $where = "where Email_txf='$email_usuario'";
                $usuario_inscricao = $this->mbc->buscar_tudo('usuarios', $where);
                $this->usuario = $usuario_inscricao[0];
                $this->smarty->assign("usuario_inscricao", $usuario_inscricao);
                if (!$usuario_inscricao) {
                    die('Usuario invalido');
                }



                if ($this->formularios[0]->Gera_pagto_sel == 'SIM') {
                    $this->busca_configuracoes_pagto();
                }

                break;
            case 'inscricao_imprensa' :
                $this->checa_login();


                /* busca inscricao */
                if ($this->uri->segment(2)) {
                    $id = $this->uri->segment(2);
                    $where = " where Id_int={$id}";
                } else {
                    die('acesso invalido');
                }
                $inscricoes = $this->mbc->buscar_tudo('inscricoes_imprensa', $where);


                $this->smarty->assign('inscricoes', $inscricoes);
                if (!$inscricoes[0]) {
                    die('inscricao nao encontrada');
                }

                $this->busca_formularios_imprensa($inscricoes);


                $this->busca_eventos($inscricoes[0]->Evento_txf);
//                /* busca formulario da inscricao */
//                $url_amigavel_form = $inscricoes[0]->Formulario_txf;
//                $where = "where Url_amigavel_txf='$url_amigavel_form'";
//                $this->busca_formularios_imprensa($where);
//
//                /* busca evento da inscricao */
//                $url_amigavel_evento = $inscricoes[0]->Evento_txf;
//                $this->busca_eventos($url_amigavel_evento);

                /* busca usuario da inscricao */
                $email_usuario = $inscricoes[0]->Email_txf;
                $where = "where Email_txf='$email_usuario'";
                $usuario_inscricao = $this->mbc->buscar_tudo('usuarios', $where);
                $this->usuario = $usuario_inscricao[0];
                $this->smarty->assign("usuario_inscricao", $usuario_inscricao);
                if (!$usuario_inscricao) {
                    die('Usuario invalido');
                }
                break;

            case 'evento' :
                if ($this->uri->segment(2)) {
                    $url_amigavel = $this->uri->segment(2);
                } else {
                    die('acesso invalido');
                }
                $this->busca_eventos($url_amigavel);
                $where = "where Evento_sel='$url_amigavel'";
                $this->busca_formularios($where);
                if ($this->formularios) {
                    $this->model_smarty->carrega_bloco('formularios', 'formularios', $this->app->Template_txf);
                }



                $this->busca_formularios_imprensa(null, $url_amigavel);


                if ($this->formularios_imprensa) {
                    $this->model_smarty->carrega_bloco('formularios_imprensa', 'formularios_imprensa', $this->app->Template_txf);
                }

                break;
            case 'formulario' :
                if ($this->uri->segment(2)) {
                    $url_amigavel_form = $this->uri->segment(2);
                    $where = "where Url_amigavel_txf='$url_amigavel_form'";
                } else {
                    die('acesso invalido');
                }

                $this->busca_formularios($where);

                $url_amigavel = $this->formularios[0]->Evento_sel;
                $this->busca_eventos($url_amigavel);


                if ($this->busca_configuracoes_pagto('admin')) {



//                    $this->smarty->assign("promocao_configs",$this->promocao_configs);
                }


                $this->busca_vagas($this->formularios[0]->Vagas_txf);
                /* melhorias utilizar o CHB */
                $where = "Order by Nome_txf";
                $instituicoes = $this->mbc->buscar_tudo("instituicoes", $where);
                $this->smarty->assign('instituicoes', $instituicoes);

                $sql = "select c.*, fc.Instituicao_sel from cupons c left outer join formularios_cupons fc on c.Id_objeto_con=fc.Id_int where fc.Formulario_sel='$url_amigavel_form' and c.Utilizado_sel!='SIM'";
                $formularios_cupons = $this->mbc->executa_sql($sql);

                $this->smarty->assign('formularios_cupons', $formularios_cupons);

                $this->carrega_formulario($this->formularios[0]);

                break;
            case 'formulario_imprensa' :
                if ($this->uri->segment(2) && $this->uri->segment(3)) {
                    $evento = $this->uri->segment(2);
                    $formulario = $this->uri->segment(3);
                    $dados[0]->Evento_txf = $evento;
                    $dados[0]->Formulario_txf = $formulario;
                } else {
                    die('acesso invalido');
                }

                $this->busca_formularios_imprensa($dados);

                $url_amigavel = $this->formularios_imprensa[0]->Evento_sel;


                $this->busca_eventos($url_amigavel);


                $this->carrega_formulario($this->formularios_imprensa[0]);

                break;
            case 'admin' :
                $this->checa_login($this->pagina_atual);
                $this->checa_usuario_admin();
                $this->switch_pagina_admin();
                break;
            case 'imprimir' :

                $this->switch_pagina_imprimir();
                break;
        }
        $this->model_smarty->carrega_bloco('navegacao', 'navegacao', $this->app->Template_txf);
        $this->model_smarty->carrega_bloco('seguranca', 'seguranca', $this->app->Template_txf);
    }

    function busca_sub_inscricoes($id_inscricao) {

        $sub_inscricoes = $this->mbc->executa_sql("select * from sub_inscricoes where Id_inscricao=$id_inscricao");

        $this->smarty->assign('sub_inscricoes', $sub_inscricoes);
    }

    function exportar_inscricoes() {


        /* busca formulario */
        if ($this->uri->segment(2)) {
            $url_amigavel_form = $this->uri->segment(2);
            $where = "where Url_amigavel_txf='$url_amigavel_form'";
        } else {
            die('acesso invalido');
        }

        $this->busca_formularios($where);


        /* busca evento */
        $url_amigavel_evento = $this->formularios[0]->Evento_sel;
        $this->busca_eventos($url_amigavel_evento);
        $where = "where Evento_sel='{$url_amigavel_evento}' and Formulario_sel='{$url_amigavel_form}'";



        /* busca inscricoes */
        //Pago_sel='SIM' and
        $where = "where  Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}'";
        $sql2 = "select i.Id_int as Id, u.Nome_txf as Nome, i.Email_txf as Email, u.Cpf_txf as Cpf,  u.Rg_txf as Rg, i.Tipo_inscricao_txf as Tipo, u.Telefone_txf as Telefone, i.Pago_sel as Pago from inscricoes i left outer join usuarios u on u.Email_txf=i.Email_txf " . $where;

        $query = $this->mbc->db->query($sql2);
        $datahora = date('d-m-Y-H-i-s');
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename={$url_amigavel_form}-{$datahora}.csv");
        header("Pragma: no-cache");
        header("Expires: 0");
        $delimiter = ";";
        $newline = "\r\n";
        $this->load->dbutil();
        echo $this->dbutil->csv_from_result($query, $delimiter, $newline);
        die();
    }

    function atualiza_pagamento_inscricao($id_inscricao, $status) {

        $array = array();
        $array['Pago_sel'] = $status;


        $this->mbc->updateTable('inscricoes', $array, 'Id_int', $id_inscricao);
    }

    function imprimir_crachas() {
        $this->checa_login($this->pagina_atual);

        if (!$_POST) {
            die('acesso invalido');
        }
        /* busca formulario */
        if ($_POST['Evento_txf']) {
            $url_amigavel_evento = $_POST['Evento_txf'];
            $where = "where Url_amigavel_txf='$url_amigavel_evento'";
        } else {
            die('acesso invalido');
        }

        $this->busca_eventos($url_amigavel_evento);
        $where = "where Evento_sel='{$url_amigavel_evento}' ";


        $where_pago = "";
        if ($_POST['Pago_sel'] == 'SIM') {
            $where_pago = " and Pago_sel='SIM'";
        }
        $where_form = "";
        if ($_POST['Formularios'] != 'TODOS') {
            $where_form = " and Formulario_txf='{$_POST['Formularios']}'";
        }
        /* busca inscricoes */
        $where = "where 1=1 $where_pago and Evento_txf='{$this->evento->Url_amigavel_txf}' ";
        $sql = "select * from inscricoes i left outer join usuarios u on u.Email_txf=i.Email_txf $where $where_form order by u.Nome_txf";

        $inscricoes = $this->mbc->executa_sql($sql);


        $this->inscricoes = $inscricoes;
        $this->smarty->assign('inscricoes', $inscricoes);


        $this->model_smarty->render_tpl('impressao_cracha', $this->app->Template_txf);
    }

    function imprimir_cracha() {
        $this->checa_login($this->pagina_atual);
//                $this->checa_usuario_admin();

        if (!$_POST) {
            die('acesso invalido');
        }
        /* busca formulario */
        if ($_POST['Formulario_txf']) {
            $url_amigavel_form = $_POST['Formulario_txf'];
            $where = "where Url_amigavel_txf='$url_amigavel_form'";
        } else {
            die('acesso invalido');
        }

        if ($_POST['Id_int']) {
            $id_inscricao = $_POST['Id_int'];
        } else {
            die('acesso invalido');
        }



        $this->busca_formularios($where);

        /* busca evento */
        $url_amigavel_evento = $this->formularios[0]->Evento_sel;
        $this->busca_eventos($url_amigavel_evento);
        $where = "where Evento_sel='{$url_amigavel_evento}' and Formulario_sel='{$url_amigavel_form}'";


        $where_pago = "";
        if ($_POST['Pago_sel'] == 'SIM') {
            $where_pago = " and Pago_sel='SIM'";
        }
        $where_form = "";
        if ($_POST['Formularios'] == 'ATUAL') {
            $where_form = " and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}'";
        }
        /* busca inscricoes */
        $where = "where 1=1 $where_pago and Evento_txf='{$this->evento->Url_amigavel_txf}' ";
        $sql = "select * from inscricoes i left outer join usuarios u on u.Email_txf=i.Email_txf $where $where_form and i.Id_int=$id_inscricao order by u.Nome_txf";

        $inscricoes = $this->mbc->executa_sql($sql);

        $this->inscricoes = $inscricoes;
        $this->smarty->assign('inscricoes', $inscricoes);


        $this->model_smarty->render_tpl('impressao_cracha', $this->app->Template_txf);
    }

    function switch_pagina_imprimir() {


        if (($this->uri->segment($this->app->Segmento_padrao_txf + 1)) && (!is_numeric($this->uri->segment($this->app->Segmento_padrao_txf + 1)))) {
            $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
        } else {
            $this->pagina_atual = 'imprimir';
        }


        $this->smarty->assign('pagina_atual', $this->pagina_atual);


        switch ($this->pagina_atual) {
            case 'imprimir_inscricao':


                /* busca inscricao */
                if ($this->uri->segment(3)) {
                    $id = $this->uri->segment(3);
                    $where = " where Id_int={$id}";
                } else {
                    die('acesso invalido');
                }

                $inscricoes = $this->mbc->buscar_tudo('inscricoes', $where);
                $this->smarty->assign('inscricoes', $inscricoes);
                if (!$inscricoes[0]) {
                    die('inscricao nao encontrada');
                }

                $this->busca_formularios_eventos($inscricoes);
//                /* busca formulario da inscricao */
//                $url_amigavel_form = $inscricoes[0]->Formulario_txf;
//                $where = "where Url_amigavel_txf='$url_amigavel_form'";
//                $this->busca_formularios($where);
//
//                /* busca evento da inscricao */
//                $url_amigavel_evento = $inscricoes[0]->Evento_txf;
//                $this->busca_eventos($url_amigavel_evento);

                /* busca usuario da inscricao */
                $email_usuario = $inscricoes[0]->Email_txf;
                $where = "where Email_txf='$email_usuario'";
                $usuario_inscricao = $this->mbc->buscar_tudo('usuarios', $where);
                $this->usuario = $usuario_inscricao[0];
                $this->smarty->assign("usuario_inscricao", $usuario_inscricao);
                if (!$usuario_inscricao) {
                    die('Usuario invalido');
                }

                break;
            case 'imprimir_recibo':


                /* busca inscricao */
                if ($this->uri->segment(3)) {
                    $id = $this->uri->segment(3);
                    $where = " where Id_int={$id}";
                } else {
                    die('acesso invalido');
                }

                $inscricoes = $this->mbc->buscar_tudo('inscricoes', $where);
                $this->smarty->assign('inscricoes', $inscricoes);
                if (!$inscricoes[0]) {
                    die('inscricao nao encontrada');
                }

                $this->busca_formularios_eventos($inscricoes);
//                /* busca formulario da inscricao */
//                $url_amigavel_form = $inscricoes[0]->Formulario_txf;
//                $where = "where Url_amigavel_txf='$url_amigavel_form'";
//                $this->busca_formularios($where);
//
//                /* busca evento da inscricao */
//                $url_amigavel_evento = $inscricoes[0]->Evento_txf;
//                $this->busca_eventos($url_amigavel_evento);

                /* busca usuario da inscricao */
                $email_usuario = $inscricoes[0]->Email_txf;
                $where = "where Email_txf='$email_usuario'";
                $usuario_inscricao = $this->mbc->buscar_tudo('usuarios', $where);
                $this->usuario = $usuario_inscricao[0];
                $this->smarty->assign("usuario_inscricao", $usuario_inscricao);
                if (!$usuario_inscricao) {
                    die('Usuario invalido');
                }

                break;
            case 'imprimir_inscricoes' :

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



                /* busca inscricoes */
                $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}' order by i.Pago_sel desc, Nome_txf";
                $inscricoes = $this->mbc->executa_sql("select * from inscricoes i left outer join usuarios u on u.Email_txf=i.Email_txf " . $where);
                $this->inscricoes = $inscricoes;
                $this->smarty->assign('inscricoes', $inscricoes);

                /* busca totalizadores */
                $this->busca_totalizadores();
//                $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}'";
//                $totalizadores = $this->mbc->executa_sql("select  COUNT(i.Pago_sel) as total, i.Pago_sel from inscricoes i  {$where} group by Pago_sel order by i.Pago_sel desc, i.Email_txf");
//                $this->smarty->assign('totalizadores', $totalizadores);
//                $this->model_smarty->carrega_bloco('totalizadores', 'totalizadores', $this->app->Template_txf);

                /* carrega blocos de inscricoes */
                $this->model_smarty->carrega_bloco('lista_inscritos', 'lista_inscritos', $this->app->Template_txf);
                $this->model_smarty->carrega_bloco('admin_formulario_inscricoes', 'admin_formulario_inscricoes', $this->app->Template_txf);
                break;

            case 'imprimir_controle_presenca' :

                $this->cria_controle_presenca('TODAS');
                break;

            case 'imprimir_lista_certificados' :
                if ($this->uri->segment(4)) {
                    $tipo = $this->uri->segment(4);
                } else {
                    $tipo = 'TODAS';
                }


                $this->cria_lista_certificados($tipo);
                break;

            case 'imprimir_controle_presenca_tipo' :

                if ($this->uri->segment(4)) {
                    $tipo = $this->uri->segment(4);
                } else {
                    $tipo = 'TODAS';
                }
                $this->cria_controle_presenca($tipo);
                break;
            case 'imprimir_inscricoes_sorteio' :

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



                /* busca inscricoes */
                $where = "where Pago_sel='SIM' and Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}'";
                $inscricoes = $this->mbc->executa_sql("select * from inscricoes i left outer join usuarios u on u.Email_txf=i.Email_txf " . $where);
                $this->inscricoes = $inscricoes;
                $this->smarty->assign('inscricoes', $inscricoes);

                $sql = "select  COUNT(i.Pago_sel) as total, i.Pago_sel from inscricoes i  {$where} group by Pago_sel order by i.Pago_sel desc, i.Email_txf";

                $totalizadores = $this->mbc->executa_sql($sql);
                $this->smarty->assign('totalizadores', $totalizadores);
                $this->model_smarty->carrega_bloco('totalizadores', 'totalizadores', $this->app->Template_txf);

                /* carrega blocos de inscricoes */
                $this->model_smarty->carrega_bloco('lista_inscritos', 'lista_inscritos', $this->app->Template_txf);
                $this->model_smarty->carrega_bloco('admin_formulario_inscricoes', 'admin_formulario_inscricoes', $this->app->Template_txf);
                break;
            case 'imprimir_inscricao_imprensa' :
                /* busca inscricao */
                if ($this->uri->segment(3)) {
                    $id = $this->uri->segment(3);
                    $where = " where Id_int={$id}";
                } else {
                    die('acesso invalido');
                }

                $inscricoes = $this->mbc->buscar_tudo('inscricoes_imprensa', $where);
                $this->smarty->assign('inscricoes', $inscricoes);
                if (!$inscricoes[0]) {
                    die('inscricao nao encontrada');
                }

                $this->busca_formularios_imprensa($inscricoes);
                $this->busca_eventos($inscricoes[0]->Evento_txf);
//                /* busca formulario da inscricao */
//                $url_amigavel_form = $inscricoes[0]->Formulario_txf;
//                $where = "where Url_amigavel_txf='$url_amigavel_form'";
//                $this->busca_formularios_imprensa($where);
//
//                /* busca evento da inscricao */
//                $url_amigavel_evento = $inscricoes[0]->Evento_txf;
//                $this->busca_eventos($url_amigavel_evento);

                /* busca usuario da inscricao */
                $email_usuario = $inscricoes[0]->Email_txf;
                $where = "where Email_txf='$email_usuario'";
                $usuario_inscricao = $this->mbc->buscar_tudo('usuarios', $where);
                $this->usuario = $usuario_inscricao[0];
                $this->smarty->assign("usuario_inscricao", $usuario_inscricao);
                if (!$usuario_inscricao) {
                    die('Usuario invalido');
                }

                break;
            case 'imprimir_inscricoes_imprensa' :

                /* busca formulario */
                if ($this->uri->segment(3) && $this->uri->segment(4)) {
                    $evento = $this->uri->segment(3);
                    $formulario = $this->uri->segment(4);
                    $dados[0]->Evento_txf = $evento;
                    $dados[0]->Formulario_txf = $formulario;
                } else {
                    die('acesso invalido');
                }

                $this->busca_formularios_imprensa($dados);

                /* busca evento */

                $this->busca_eventos($evento);
//                $where = "where Evento_sel='{$evento}' and Formulario_sel='{$formulario}'";



                /* busca inscricoes */
                $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios_imprensa[0]->Url_amigavel_txf}'  ";
                $sql = "select * from inscricoes_imprensa i left outer join usuarios u on u.Email_txf=i.Email_txf {$where} order by Nome_txf";
                $inscricoes = $this->mbc->executa_sql($sql);
                if ($inscricoes[0]) {


                    $this->inscricoes = $inscricoes;
                    $this->smarty->assign('inscricoes', $inscricoes);
                } else {
                    die('Nenhum credenciamento');
                }

                /* busca totalizadores */
                $totalizadores = $this->mbc->executa_sql("select  COUNT(i.Confirmado_sel) as total, i.Confirmado_sel from inscricoes_imprensa i  {$where} group by Confirmado_sel order by i.Confirmado_sel desc, i.Email_txf");
                $this->smarty->assign('totalizadores', $totalizadores);
//                        $this->model_smarty->carrega_bloco('totalizadores', 'totalizadores', $this->app->Template_txf);

                /* carrega blocos de inscricoes */
//                        $this->model_smarty->carrega_bloco('lista_inscritos_imprensa', 'lista_inscritos_imprensa', $this->app->Template_txf);
//                        $this->model_smarty->carrega_bloco('admin_formulario_inscricoes_imprensa', 'admin_formulario_inscricoes_imprensa', $this->app->Template_txf);
                break;

            case 'imprimir_cupons':
                $this->checa_login($this->pagina_atual);
                $this->checa_usuario_admin();
                if ($this->uri->segment(3)) {
                    $id = $this->uri->segment(3);
                } else {
                    die('acesso invalido');
                }

                /* busca os cupons */
                $where = " where Id_objeto_con={$id} and Utilizado_sel!='SIM'";
                $cupons = $this->mbc->buscar_tudo("cupons", $where);
                $this->cupons = $cupons[0];
                $this->smarty->assign('cupons', $cupons);
                if (!isset($cupons[0])) {
                    $mensagem = "Nenhum cupom para imprimir, você deve gerar os cupons antes de imprimir";
                    echo utf8_decode($mensagem);
                    die();
                }

                /* busca configurações do formulario */
                $where = " where Id_int={$id}";
                $formularios_cupons = $this->mbc->buscar_tudo("formularios_cupons", $where);
                $this->formularios_cupons = $formularios_cupons;
                $this->smarty->assign('formularios_cupons', $formularios_cupons);

//                $this->busca_formularios_eventos($inscricoes);
                /* busca formulario da inscricao */
                $url_amigavel_form = $formularios_cupons[0]->Formulario_sel;
                $where = "where Url_amigavel_txf='$url_amigavel_form'";
                $this->busca_formularios($where);

                /* busca evento */
                $url_amigavel_evento = $formularios_cupons[0]->Evento_sel;
                $this->busca_eventos($url_amigavel_evento);

                /* busca instituicoes */
                $where = "where Nome_txf='{$formularios_cupons[0]->Instituicao_sel}'";
                $instituicoes = $this->mbc->buscar_tudo("instituicoes", $where);
                $this->smarty->assign('instituicoes', $instituicoes);
                break;
            case 'imprimir_crachas':
                $this->checa_login($this->pagina_atual);
//                $this->checa_usuario_admin();

                if (!$_POST) {
                    die('acesso invalido');
                }
                /* busca formulario */
                if ($_POST['Evento_txf']) {
                    $url_amigavel_evento = $_POST['Evento_txf'];
                    $where = "where Url_amigavel_txf='$url_amigavel_evento'";
                } else {
                    die('acesso invalido');
                }


//                $this->busca_formularios($where);
//
//                /* busca evento */
//                $url_amigavel_evento = $this->formularios[0]->Evento_sel;
                $this->busca_eventos($url_amigavel_evento);
                $where = "where Evento_sel='{$url_amigavel_evento}' and Formulario_sel='{$url_amigavel_form}'";


                $where_pago = "";
                if ($_POST['Pago_sel'] == 'SIM') {
                    $where_pago = " and Pago_sel='SIM'";
                }
                $where_form = "";
                if ($_POST['Formularios'] != 'TODOS') {
                    $where_form = " and Formulario_txf='{$_POST['Formularios']}'";
                }
                /* busca inscricoes */
                $where = "where 1=1 $where_pago and Evento_txf='{$this->evento->Url_amigavel_txf}' ";
                $sql = "select * from inscricoes i left outer join usuarios u on u.Email_txf=i.Email_txf $where $where_form order by u.Nome_txf";

                $inscricoes = $this->mbc->executa_sql($sql);

                $this->inscricoes = $inscricoes;
                $this->smarty->assign('inscricoes', $inscricoes);



                break;
            case 'imprimir_cracha':
                $this->checa_login($this->pagina_atual);
//                $this->checa_usuario_admin();

                if (!$_POST) {
                    die('acesso invalido');
                }
                /* busca formulario */
                if ($_POST['Formulario_txf']) {
                    $url_amigavel_form = $_POST['Formulario_txf'];
                    $where = "where Url_amigavel_txf='$url_amigavel_form'";
                } else {
                    die('acesso invalido');
                }

                if ($_POST['Id_int']) {
                    $id_inscricao = $_POST['Id_int'];
                } else {
                    die('acesso invalido');
                }



                $this->busca_formularios($where);

                /* busca evento */
                $url_amigavel_evento = $this->formularios[0]->Evento_sel;
                $this->busca_eventos($url_amigavel_evento);
                $where = "where Evento_sel='{$url_amigavel_evento}' and Formulario_sel='{$url_amigavel_form}'";


                $where_pago = "";
                if ($_POST['Pago_sel'] == 'SIM') {
                    $where_pago = " and Pago_sel='SIM'";
                }
                $where_form = "";
                if ($_POST['Formularios'] == 'ATUAL') {
                    $where_form = " and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}'";
                }
                /* busca inscricoes */
                $where = "where 1=1 $where_pago and Evento_txf='{$this->evento->Url_amigavel_txf}' ";
                $sql = "select * from inscricoes i left outer join usuarios u on u.Email_txf=i.Email_txf $where $where_form and i.Id_int=$id_inscricao order by u.Nome_txf";

                $inscricoes = $this->mbc->executa_sql($sql);

                $this->inscricoes = $inscricoes;
                $this->smarty->assign('inscricoes', $inscricoes);



                break;

            case 'imprimir_cupons_geral':
                $this->checa_login($this->pagina_atual);
                $this->checa_usuario_admin();
                if ($this->uri->segment(3)) {
                    $formulario = $this->uri->segment(3);
                } else {
                    die('acesso invalido');
                }


                /* busca configuracoes de cupons das instituicoes */
                $where = " where Formulario_sel='{$formulario}' order by Instituicao_sel";
                $formularios_cupons = $this->mbc->buscar_tudo("formularios_cupons", $where);
                $this->formularios_cupons = $formularios_cupons;
                /* busca os cupons */
                foreach ($this->formularios_cupons as $form) {
                    $where = " where Id_objeto_con={$form->Id_int} and Utilizado_sel!='SIM'";
                    $cupons = $this->mbc->buscar_tudo("cupons", $where);
                    $form->Cupons = $cupons;
                }
                $this->smarty->assign('formularios_cupons', $formularios_cupons);

//                $this->busca_formularios_eventos($inscricoes);
                /* busca formulario da inscricao */
                $url_amigavel_form = $formularios_cupons[0]->Formulario_sel;
                $where = "where Url_amigavel_txf='$url_amigavel_form'";
                $this->busca_formularios($where);

                /* busca evento */
                $url_amigavel_evento = $formularios_cupons[0]->Evento_sel;
                $this->busca_eventos($url_amigavel_evento);
                break;
            case 'gerar_certificado_old':

                /* busca inscricao */
                if ($this->uri->segment(3)) {
                    $id = $this->uri->segment(3);
                    $where = " where Id_int={$id}";
                } else {
                    die('acesso invalido');
                }

                $inscricoes = $this->mbc->buscar_tudo('inscricoes', $where);
                $this->smarty->assign('inscricoes', $inscricoes);
                if (!$inscricoes[0]) {
                    die('inscricao nao encontrada');
                }
                $this->inscricao = $inscricoes[0];

                if ($this->inscricao->Certificado_sel == 'SIM') {
                    $this->busca_formularios_eventos($inscricoes);
//                    /* busca formulario da inscricao */
//                    $url_amigavel_form = $inscricoes[0]->Formulario_txf;
//                    $where = "where Url_amigavel_txf='$url_amigavel_form'";
//                    $this->busca_formularios($where);
//
//                    /* busca evento da inscricao */
//                    $url_amigavel_evento = $inscricoes[0]->Evento_txf;
//                    $this->busca_eventos($url_amigavel_evento);

                    /* busca usuario da inscricao */
                    $email_usuario = $inscricoes[0]->Email_txf;
                    $where = "where Email_txf='$email_usuario'";
                    $usuario_inscricao = $this->mbc->buscar_tudo('usuarios', $where);
                    $this->usuario = $usuario_inscricao[0];
                    $this->smarty->assign("usuario_inscricao", $usuario_inscricao[0]);
                    if (!$usuario_inscricao) {
                        die('Usuario invalido');
                    }
                    $certificado_configs = $this->mbc->buscar_completo("certificados_configs", "where Evento_sel='{$this->inscricao->Evento_txf}' and Formulario_sel='{$this->inscricao->Formulario_txf}'");
                    $this->certificado_configs = $certificado_configs[0];
                    $this->smarty->assign('certificado_configs', $this->certificado_configs);
                    if ($this->certificado_configs->Arquivo_tpl_txf == 'padrao') {
                        $this->model_smarty->carrega_tpl_modulo($this->app->Template_txf, 'certificados', 'padrao', 'certificado');
                    } else {
                        $this->model_smarty->carrega_tpl_modulo($this->app->Template_txf, 'certificados/' . $this->namespace_empresa, $this->certificado_configs->Arquivo_tpl_txf, 'certificado');
                    }
//$this->model_smarty->render_tpl('certificado', $this->app->Template_txf);
                    $html = $this->model_smarty->retorna_tpl('certificado', $this->app->Template_txf);
//echo $html;
//die(); 
                    $pdfFilePath = "certificado_{$this->promocao->Namespace_promocao_txf}_{$this->inscricao->Id_int}.pdf";
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
                    $this->pdf->Output($pdfFilePath, "D");
//  echo $html;
                    die();
                } else {
                    die("Impressao de certificado nao permitida. para a inscricao de numero {$id}");
                }
                break;
            case 'gerar_certificado':

                /* BUSCA ID DA INSCRICAO */
                if ($this->uri->segment(3)) {
                    $id = $this->uri->segment(3);
                } else {
                    die('acesso invalido');
                }

                $this->cria_pdf_certificado($id);

                break;
        }

        $this->smarty->assign('segment1', $this->uri->segment($this->app->Segmento_padrao_txf));
        $this->model_smarty->carrega_bloco('impressao_topo', 'impressao_topo', $this->app->Template_txf);
    }

    function switch_pagina_admin() {
        if (($this->uri->segment($this->app->Segmento_padrao_txf + 1)) && (!is_numeric($this->uri->segment($this->app->Segmento_padrao_txf + 1)))) {
            $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
        } else {
            $this->pagina_atual = 'admin_principal';
        }
        $this->smarty->assign('pagina_atual', $this->pagina_atual);

        if ($this->usuario->Empresa_sel == 'TODAS') {
            $this->empresa = '';
        } else {
            $this->empresa = $this->usuario->Empresa_sel;
        }

        switch ($this->pagina_atual) {

            case 'sharpspring':
//                $id = '3_D728768F51DB574D26C359A62BB0B6C1';
//                $senha = '146B96F2246DFED5283BF3D949756CB9';
//                $params['accountID'] = $id;
//                $params['secretKey'] = $senha;
//$this->load->library('SharpSpring', $params);
                $this->load->library('SharpSpring');
                ver($this->sharpspring);



                $limit = 500;
                $offset = 0;

//                $criar_lista=$this->sharpspring->cria_lista("Lista de teste");
//                ver($cria_lista);
//                $leads = $this->sharpspring->busca_leads();
//                ver($leads);
//                $id = 524803561475;
//                $lead = $this->sharpspring->busca_lead($id);
//                ver($lead);
                //procura lead por email

                $idlista = 621487107;
                $contato = new stdClass();
                $contato->firstName = "Caue";
                $contato->lastName = "dos Santos";
                $contato->emailAddress = "caue.santos@landsagenciaweb.com.br";
                $inseriu = $this->sharpspring->insere_contato_lista($idlista, $contato);
                ver($inseriu);


//                $where["id"] = 621487107;
//                $minha_lista = $this->sharpspring->busca_listas($where);
//                ver($minha_lista, 1);

                $membros_lista = $this->sharpspring->busca_membros_lista(621487107);
                ver($membros_lista, 1);

                $novo_membro = $this->sharpspring->cria_membro_lista(621487107, 524803561475);
                //$novo_membro=$this->sharpspring->insere_email_lista(621487107,'guvedana@gmail.com');
                ver($novo_membro, 1);


                $membros_lista = $this->sharpspring->busca_membros_lista(621487107);
                ver($membros_lista);
                ///$result = $this->sharpspring->call('getLeads', array('where' => array('emailAddress' => 'gustavo.vedana@landsdigital.com.br'), 'limit' => $limit, 'offset' => $offset));

                $listas = $this->sharpspring->busca_listas();

                ver($listas);


                break;
            case 'admin_principal':


                $this->busca_eventos('', $this->empresa);
                $this->model_smarty->carrega_bloco('admin_eventos', 'admin_eventos', $this->app->Template_txf);
                break;
            case 'cadastro_usuario':

                if ($this->uri->segment(3)) {
                    $url_amigavel_evento = $this->uri->segment(3);
                    //  $where = "where Url_amigavel_txf='$url_amigavel_evento'";
                } else {
                    die('acesso invalido');
                }

                $evento = $this->busca_eventos($url_amigavel_evento, $this->empresa);

                $redirect = $this->app->Url_cliente . "admin/admin_geral/{$evento[0]->Url_amigavel_txf}";
                $this->smarty->assign('redirect', $redirect);

                break;
            case 'admin_evento' :
                if ($this->uri->segment(3)) {
                    $url_amigavel = $this->uri->segment(3);
                } else {
                    die('acesso invalido');
                }
                $this->busca_eventos($url_amigavel, $this->empresa);
                $where = "where Evento_sel='$url_amigavel'";

                $this->busca_formularios($where);

                $this->busca_formularios_imprensa(null, $url_amigavel);
                $this->model_smarty->carrega_bloco('admin_evento_formularios', 'admin_evento_formularios', $this->app->Template_txf);
                $this->model_smarty->carrega_bloco('admin_evento_formularios_imprensa', 'admin_evento_formularios_imprensa', $this->app->Template_txf);
                break;
            case 'admin_formulario_imprensa' :
                /* busca formulario */

                if ($this->uri->segment(3) && $this->uri->segment(4)) {
                    $evento = $this->uri->segment(3);
                    $formulario = $this->uri->segment(4);
                    $dados[0]->Evento_txf = $evento;
                    $dados[0]->Formulario_txf = $formulario;
                } else {
                    die('acesso invalido');
                }

                $this->busca_formularios_imprensa($dados);


                /* busca evento */

                $this->busca_eventos($evento, $this->empresa);
                $where = "where Evento_sel='{$evento}' and Formulario_sel='{$formulario}'";
                /* busca inscricoes */
                $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios_imprensa[0]->Url_amigavel_txf}'";
                $sql = "select i.*, i.Id_int as Id_inscricao, u.* from inscricoes_imprensa i left outer join usuarios u on u.Email_txf=i.Email_txf {$where} order by Nome_txf";

                $inscricoes = $this->mbc->executa_sql($sql);

                $this->inscricoes = $inscricoes;
                $this->smarty->assign('inscricoes', $inscricoes);

                /* busca totalizadores */
                $totalizadores = $this->mbc->executa_sql("select  COUNT(i.Confirmado_sel) as total, i.Confirmado_sel from inscricoes_imprensa i  {$where} group by Confirmado_sel order by i.Confirmado_sel desc, i.Email_txf");
                $this->smarty->assign('totalizadores', $totalizadores);
                $this->model_smarty->carrega_bloco('totalizadores_imprensa', 'totalizadores_imprensa', $this->app->Template_txf);

                /* carrega blocos de inscricoes */
                $this->model_smarty->carrega_bloco('lista_inscritos_imprensa', 'lista_inscritos_imprensa', $this->app->Template_txf);
                $this->model_smarty->carrega_bloco('admin_formulario_inscricoes_imprensa', 'admin_formulario_inscricoes_imprensa', $this->app->Template_txf);

                break;

            case 'editar_usuario':

                if ($this->uri->segment(3)) {
                    $id = $this->uri->segment(3);
                    $where = "where Id_int=$id";
                } else {
                    die('acesso invalido');
                }

                $usuario = $this->mbc->buscar_tudo("usuarios", "$where");

                $this->smarty->assign('usuario_editar', $usuario[0]);

                break;
            case 'admin_formulario' :

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
                $this->busca_eventos($url_amigavel_evento, $this->empresa);
                $where = "where Evento_sel='{$url_amigavel_evento}' and Formulario_sel='{$url_amigavel_form}' order by Instituicao_sel";

                /* busca cupons do formulario */
                $formularios_cupons = $this->mbc->buscar_tudo("formularios_cupons", $where);
                $this->formularios_cupons = $formularios_cupons;
                $this->smarty->assign('formularios_cupons', $formularios_cupons);


                /* busca cupons */
                $cupons = $this->mbc->buscar_completo("cupons");
                $this->cupons = $cupons[0];
                $this->smarty->assign('cupons', $cupons);

                /* carrega blocos de cupons */
                $this->model_smarty->carrega_bloco('lista_cupons', 'lista_cupons', $this->app->Template_txf);
                $this->model_smarty->carrega_bloco('admin_formulario_cupons', 'admin_formulario_cupons', $this->app->Template_txf);

                $this->busca_vagas($this->formularios[0]->Vagas_txf);
                /* busca inscricoes */


                if ($this->evento->Tipo_inscricao_sel == 'PAGAS') {
                    $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}' and Pago_sel='SIM' order by i.Pago_sel desc, Nome_txf";
                } else {
                    $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}' order by i.Pago_sel desc, Nome_txf";
                }

                $sql = "select i.*, i.Id_int as Id_inscricao, u.* from inscricoes i left outer join usuarios u on u.Email_txf=i.Email_txf " . $where;

                $inscricoes = $this->mbc->executa_sql($sql);


                $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}' order by i.Pago_sel desc, Nome_txf";
                $sql2 = "select sub.*, sub.Id_int as Id_subinscricao, i.*, u.Nome_txf as Nome_master_txf  from sub_inscricoes sub 
left outer join inscricoes i on i.Id_int=sub.Id_inscricao 
left outer join usuarios u on u.Email_txf=i.Email_txf " . $where;

                $sub_inscricoes = $this->mbc->executa_sql($sql2);

                $this->smarty->assign('sub_inscricoes', $sub_inscricoes);



                if ($this->formularios[0]->Gera_presenca_sel == 'SIM') {


                    $where = "where Evento_sel='{$inscricoes[0]->Evento_txf}' and Formulario_sel='{$inscricoes[0]->Formulario_txf}' order by Data_dat";
                    $sql = "select * from presencas_configs $where";
                    $presencas_configs = $this->mbc->executa_sql($sql);

                    $this->smarty->assign('presencas_configs', $presencas_configs);

//$layout, $modulo, $view, $variavel
                    $this->model_smarty->carrega_tpl_modulo($this->app->Template_txf, 'forms_presenca', $this->formularios[0]->Formulario_presenca_txf . '_admin', 'presencas_admin');
                }


                if ($this->formularios[0]->Gera_certificado_sel == 'SIM') {
//                    $where = "where Evento_sel='{$inscricoes[0]->Evento_txf}' and Formulario_sel='{$inscricoes[0]->Formulario_txf}'";
                    $where = "where Evento_sel='{$inscricoes[0]->Evento_txf}' ";
                    $sql = "select * from certificados_configs $where";
                    $certificados_configs = $this->mbc->executa_sql($sql);
                    $this->smarty->assign('certificados_configs', $certificados_configs);

                    //$layout, $modulo, $view, $variavel
                    $this->model_smarty->carrega_tpl_modulo($this->app->Template_txf, 'forms_certificados', 'padrao_admin', 'certificado_admin');
                }

                $tipos_inscricoes = $this->mbc->executa_sql("select COUNT(i.Tipo_inscricao_txf) as total, Tipo_inscricao_txf from inscricoes i where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}' group by Tipo_inscricao_txf");
                $this->smarty->assign('tipos_inscricoes', $tipos_inscricoes);


                $this->inscricoes = $inscricoes;
                $this->smarty->assign('inscricoes', $inscricoes);


                $this->busca_recebimentos();

                $this->busca_totalizadores();



                /* carrega blocos de inscricoes */

                $this->model_smarty->carrega_bloco('lista_inscritos', $this->formularios[0]->Arquivo_lista_txf, $this->app->Template_txf);
                $this->model_smarty->carrega_bloco('admin_formulario_inscricoes', 'admin_formulario_inscricoes', $this->app->Template_txf);




                break;
            case 'admin_geral' :

                /* busca formulario */
                if ($this->uri->segment(3)) {
                    $url_amigavel_evento = $this->uri->segment(3);
                    $where = "where Url_amigavel_txf='$url_amigavel_evento'";
                } else {
                    die('acesso invalido');
                }

                // $this->busca_formularios($where);

                /* busca evento */
                //    $url_amigavel_evento = $this->formularios[0]->Evento_sel;
                $evento = $this->busca_eventos($url_amigavel_evento, $this->empresa);

                $where = "where Evento_sel='{$url_amigavel_evento}' and Formulario_sel='{$url_amigavel_form}' order by Instituicao_sel";
                // $where2 = "where Evento_sel='{$url_amigavel_evento}' and Formulario_sel='{$url_amigavel_form}' order by Instituicao_sel";

                /* busca inscricoes */
                if ($this->evento->Tipo_inscricao_sel == 'PAGAS') {
                    $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and   Pago_sel='SIM' order by i.Pago_sel desc, Nome_txf";
                } else {
                    $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}'  order by i.Pago_sel desc, Nome_txf";
                }
                $where2 = " where  Pago_sel='NAO' and i.Evento_txf='{$this->evento->Url_amigavel_txf}'  order by i.Pago_sel desc, Nome_txf";
                $sql = "select i.*, i.Id_int as Id_inscricao, u.* from inscricoes i left outer join usuarios u on u.Email_txf=i.Email_txf " . $where;
                $sql2 = "select i.*, i.Id_int as Id_inscricao, u.* from inscricoes i left outer join usuarios u on u.Email_txf=i.Email_txf " . $where2;

                $where3 = " where  Abriu_certificado_sel='SIM' and i.Evento_txf='{$this->evento->Url_amigavel_txf}'  order by i.Pago_sel desc, Nome_txf";
                $sql3 = "select i.*, i.Id_int as Id_inscricao, u.* from inscricoes i left outer join usuarios u on u.Email_txf=i.Email_txf " . $where3;

                $inscricoes = $this->mbc->executa_sql($sql);

                $inscricoes_nao_pagas = $this->mbc->executa_sql($sql2);

                $inscricoes_certificados = $this->mbc->executa_sql($sql3);

                $this->inscricoes = $inscricoes;
                $this->smarty->assign('inscricoes', $inscricoes);

                $this->smarty->assign('inscricoes_nao_pagas', $inscricoes_nao_pagas);
                $this->smarty->assign('inscricoes_certificados', $inscricoes_certificados);

                $formularios = $this->mbc->executa_sql("select Id_int, Nome_txf, Url_amigavel_txf, Evento_sel  from eventos_formularios where Evento_sel='{$this->evento->Url_amigavel_txf}'");


                $this->smarty->assign('todos_formularios', $formularios);

                $total_geral = 0;
                $total_geral_inscritos = 0;
                foreach ($formularios as $form) {
                    $form->Total = 0;
                    $form->Total_inscritos = 0;

                    foreach ($inscricoes as $insc) {
                        if ($insc->Formulario_txf == $form->Url_amigavel_txf) {
                            if ($insc->Pago_sel == 'SIM') {
                                $form->Total = $form->Total + $insc->Valor_txf;
                                $form->Total_inscritos = $form->Total_inscritos + 1;
                            }
                        }
                    }
                    $total_geral = $total_geral + $form->Total;
                    $total_geral_inscritos = $total_geral_inscritos + $form->Total_inscritos;
                }

                $this->smarty->assign('formularios', $formularios);
                $this->smarty->assign('total_geral_inscritos', $total_geral_inscritos);
                $this->smarty->assign('total_geral', $total_geral);


                $empresa = $this->evento->Empresa_sel;
                if (is_lands()) {
                    $administradores = $this->mbc->buscar_completo("usuarios", "where  (Empresa_sel='TODAS' and Tipo_sel='admin') or (Tipo_sel='admin' and  Empresa_sel='{$empresa}')");
                } else {
                    $administradores = $this->mbc->buscar_completo("usuarios", "where   (Tipo_sel='admin' and  Empresa_sel='{$empresa}')");
                }

                $this->smarty->assign('administradores', $administradores);



                $this->model_smarty->carrega_bloco('lista_inscritos', 'lista/default', $this->app->Template_txf);

                $this->model_smarty->carrega_bloco('admin_formulario_inscricoes', 'admin_formulario_inscricoes', $this->app->Template_txf);




                break;

            case 'admin_credenciamento' :

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
                $this->busca_eventos($url_amigavel_evento, $this->empresa);
                $where = "where Evento_sel='{$url_amigavel_evento}' and Formulario_sel='{$url_amigavel_form}' order by Instituicao_sel";


                /* busca inscricoes */
                $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}' and Pago_sel='SIM' order by i.Pago_sel desc, Nome_txf";

                $sql = "select i.*, i.Id_int as Id_inscricao, u.* from inscricoes i left outer join usuarios u on u.Email_txf=i.Email_txf " . $where;
                $inscricoes = $this->mbc->executa_sql($sql);

                $this->calcula_totais_credenciamento();


                if ($this->formularios[0]->Gera_presenca_sel == 'SIM') {
                    $where = "where Evento_sel='{$inscricoes[0]->Evento_txf}' and Formulario_sel='{$inscricoes[0]->Formulario_txf}' order by Data_dat";
                    $sql = "select * from presencas_configs $where";
                    $presencas_configs = $this->mbc->executa_sql($sql);

                    $this->smarty->assign('presencas_configs', $presencas_configs);

//$layout, $modulo, $view, $variavel
                    $this->model_smarty->carrega_tpl_modulo($this->app->Template_txf, 'forms_presenca', $this->formularios[0]->Formulario_presenca_txf . '_admin', 'presencas_admin');
                }


                $this->inscricoes = $inscricoes;
                $this->smarty->assign('inscricoes', $inscricoes);


                $formularios = $this->mbc->executa_sql("select Id_int, Nome_txf, Url_amigavel_txf, Evento_sel  from eventos_formularios where Evento_sel='{$this->evento->Url_amigavel_txf}'");
                $this->smarty->assign('todos_formularios', $formularios);



                break;
            case 'admin_credenciamento_geral' :

                /* busca formulario */
                if ($this->uri->segment(3)) {
                    $url_amigavel_evento = $this->uri->segment(3);
//                    $where = "where Url_amigavel_txf='$url_amigavel_form'";
                } else {
                    die('acesso invalido');
                }

//                $this->busca_formularios($where);

                /* busca evento */
//                $url_amigavel_evento = $this->formularios[0]->Evento_sel;
                $this->busca_eventos($url_amigavel_evento, $this->empresa);
//                $where = "where Evento_sel='{$url_amigavel_evento}' and Formulario_sel='{$url_amigavel_form}' order by Instituicao_sel";


                /* busca inscricoes */
                $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and Pago_sel='SIM' order by i.Pago_sel desc, Nome_txf";

                $sql = "select i.*, i.Id_int as Id_inscricao, u.* from inscricoes i left outer join usuarios u on u.Email_txf=i.Email_txf " . $where;
                $inscricoes = $this->mbc->executa_sql($sql);

                $this->calcula_totais_credenciamento();


                if ($this->formularios[0]->Gera_presenca_sel == 'SIM') {
                    $where = "where Evento_sel='{$inscricoes[0]->Evento_txf}'  order by Data_dat";
                    $sql = "select * from presencas_configs $where";
                    $presencas_configs = $this->mbc->executa_sql($sql);

                    $this->smarty->assign('presencas_configs', $presencas_configs);

//$layout, $modulo, $view, $variavel
                    $this->model_smarty->carrega_tpl_modulo($this->app->Template_txf, 'forms_presenca', $this->formularios[0]->Formulario_presenca_txf . '_admin', 'presencas_admin');
                }


                $this->inscricoes = $inscricoes;
                $this->smarty->assign('inscricoes', $inscricoes);


                $formularios = $this->mbc->executa_sql("select Id_int, Nome_txf, Url_amigavel_txf, Evento_sel  from eventos_formularios where Evento_sel='{$this->evento->Url_amigavel_txf}'");
                $this->smarty->assign('todos_formularios', $formularios);



                break;

            default:
                die("pagina {$pagina} nao encontrada");
                break;
        }
    }

    function busca_recebimentos() {
        $where_form = " and Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}'";
        $destinos = $this->mbc->executa_sql("select Destino_pagto_txf from inscricoes  where 1=1 $where_form group by Destino_pagto_txf");
        foreach ($destinos as $destino) {
            $soma_destino = 0;
            $total_destino = 0;
            $destino->Tipos = $this->mbc->executa_sql("select Tipo_pagto_txf from inscricoes  where Destino_pagto_txf='{$destino->Destino_pagto_txf}' $where_form group by Tipo_pagto_txf");
            foreach ($destino->Tipos as $tipo) {
                $soma_tipo = 0;
                $tipo->Inscricoes = $this->mbc->executa_sql("select i.*, i.Id_int as Id_inscricao, u.* from inscricoes i left outer join usuarios u on u.Email_txf=i.Email_txf  where Destino_pagto_txf='{$destino->Destino_pagto_txf}' and Tipo_pagto_txf='{$tipo->Tipo_pagto_txf}'  and Pago_sel='SIM' $where_form order by Nome_txf");
                foreach ($tipo->Inscricoes as $inscricao) {
                    $total_destino = $total_destino + 1;
                    $soma_destino = $soma_destino + $inscricao->Valor_txf;
                    $soma_tipo = $soma_tipo + $inscricao->Valor_txf;
                }
                if ($tipo->Tipo_pagto_txf == '') {
                    $tipo->Tipo_pagto_txf = 'Indefinido';
                }
                $tipo->Total_valor = number_format($soma_tipo, 2, ",", ".");
            }
            if ($destino->Destino_pagto_txf == '') {
                $destino->Destino_pagto_txf = 'Indefinido';
            }
            $destino->Total_ingressos = $total_destino;
            $destino->Total_valor = number_format($soma_destino, 2, ",", ".");
        }
        $this->smarty->assign("destinos", $destinos);
    }

    function busca_totalizadores() {

        $inscricoes_data = $this->mbc->executa_sql("select COUNT(i.Tipo_inscricao_txf) as total, i.Data_dat from inscricoes i where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}'  group by Data_dat");



        if ($this->evento->Tipo_inscricao_sel == 'PAGAS') {
            $sql = "SELECT  Data_dat, Tipo_inscricao_txf, count(Id_int) as Numero_inscritos, Valor_txf,  sum(Valor_txf) as Total, Pago_sel FROM inscricoes where Pago_sel='SIM' and Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}' group by Data_dat, Pago_sel, Tipo_inscricao_txf";
//                    $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}' and Pago_sel='SIM' order by i.Pago_sel desc, Nome_txf";
        } else {
            $sql = "SELECT  Data_dat, Tipo_inscricao_txf, count(Id_int) as Numero_inscritos, Valor_txf,  sum(Valor_txf) as Total, Pago_sel FROM inscricoes where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}' group by Data_dat, Pago_sel, Tipo_inscricao_txf";
//            $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}' order by i.Pago_sel desc, Nome_txf";
        }



//         $sql = "select  COUNT(i.Pago_sel) as total, i.Pago_sel from inscricoes i  {$where} group by Pago_sel order by i.Pago_sel desc, i.Email_txf";

        $inscricoes_agrupadas = $this->mbc->executa_sql($sql);


        foreach ($inscricoes_data as $inscricao_data) {
            $inscricao_data->Total = 0;
            $inscricao_data->Total_inscritos = 0;
            $inscricao_data->Total_receber = 0;
            foreach ($this->inscricoes as $inscricao) {
                if ($inscricao->Data_dat == $inscricao_data->Data_dat) {
                    (double) $inscricao_data->Total_inscritos = (double) $inscricao_data->Total_inscritos + 1;
                    if ($inscricao->Pago_sel == 'SIM') {
                        (double) $inscricao_data->Total = (double) $inscricao_data->Total + (double) $inscricao->Valor_txf;
                    } else {
                        (double) $inscricao_data->Total_receber = (double) $inscricao_data->Total_receber + (double) $inscricao->Valor_txf;
                    }
                }
            }
        }

        $inscricoes_total->Total = 0;
        $inscricoes_total->Total_receber = 0;
        $inscricoes_total->Total_inscritos = 0;
        foreach ($this->inscricoes as $inscricao) {
            (double) $inscricoes_total->Total_inscritos = (double) $inscricoes_total->Total_inscritos + 1;
            if ($inscricao->Pago_sel == 'SIM') {
                (double) $inscricoes_total->Total = (double) $inscricoes_total->Total + (double) $inscricao->Valor_txf;
            } else {
                (double) $inscricoes_total->Total_receber = (double) $inscricoes_total->Total_receber + (double) $inscricao->Valor_txf;
            }
        }


        $this->smarty->assign('inscricoes_total', $inscricoes_total);
        $this->smarty->assign('inscricoes_data', $inscricoes_data);
        $this->smarty->assign('inscricoes_agrupadas', $inscricoes_agrupadas);


        /* busca totalizadores */
        $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}'";
        $totalizadores = $this->mbc->executa_sql("select  COUNT(i.Pago_sel) as total, i.Pago_sel from inscricoes i  {$where} and Cupom_txf='' group by Pago_sel order by i.Pago_sel desc, i.Email_txf");
        $this->smarty->assign('totalizadores', $totalizadores);


        $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}'";
        $totalizadores_cupons = $this->mbc->executa_sql("select  COUNT(i.Pago_sel) as total, i.Pago_sel from inscricoes i  {$where} and Cupom_txf!='' group by Pago_sel order by i.Pago_sel desc, i.Email_txf");
        $this->smarty->assign('totalizadores_cupons', $totalizadores_cupons);


        $this->model_smarty->carrega_bloco('totalizadores', 'totalizadores', $this->app->Template_txf);
    }

    function calcula_totais_credenciamento() {

        $sql_total = "select count(*) as total from inscricoes where 
                    Evento_txf='{$this->evento->Url_amigavel_txf}' and 
                    Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}'";
        $wp1 = " and Presenca1_sel='SIM'";
        $wp2 = " and Presenca2_sel='SIM'";
        $wp3 = " and Presenca3_sel='SIM'";
        $total_temp = $this->mbc->executa_sql($sql_total);
        $total = $total_temp[0]->total;

        $total_temp1 = $this->mbc->executa_sql($sql_total . $wp1);
        $total1 = $total_temp1[0]->total;

        $total_temp2 = $this->mbc->executa_sql($sql_total . $wp2);
        $total2 = $total_temp2[0]->total;

        $total_temp3 = $this->mbc->executa_sql($sql_total . $wp3);
        $total3 = $total_temp3[0]->total;

        $this->smarty->assign('total', $total);
        $this->smarty->assign('total1', $total1);
        $this->smarty->assign('total2', $total2);
        $this->smarty->assign('total3', $total3);
    }

    function cria_controle_presenca($tipo) {


        if ($tipo == 'TODAS') {
            $where_tipo = '';
        } else {
            $where_tipo = " and i.Tipo_inscricao_txf='{$tipo}' ";
        }




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



        /* busca inscricoes */
        $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}'  {$where_tipo} order by i.Pago_sel desc, Nome_txf";

        $inscricoes = $this->mbc->executa_sql("select * from inscricoes i left outer join usuarios u on u.Email_txf=i.Email_txf " . $where);
        $this->inscricoes = $inscricoes;
        $this->smarty->assign('inscricoes', $inscricoes);

        /* busca totalizadores */
        $this->busca_totalizadores();
//                $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}'";
//                $totalizadores = $this->mbc->executa_sql("select  COUNT(i.Pago_sel) as total, i.Pago_sel from inscricoes i  {$where} group by Pago_sel order by i.Pago_sel desc, i.Email_txf");
//                $this->smarty->assign('totalizadores', $totalizadores);
//                $this->model_smarty->carrega_bloco('totalizadores', 'totalizadores', $this->app->Template_txf);

        /* carrega blocos de inscricoes */
        $this->model_smarty->carrega_bloco('lista_inscritos', 'lista_inscritos', $this->app->Template_txf);
        $this->model_smarty->carrega_bloco('admin_formulario_inscricoes', 'admin_formulario_inscricoes', $this->app->Template_txf);
    }

    function enviar() {
        $segmento = (int) $this->app->Segmento_padrao_txf;
        $segmento = $segmento + 1;
        if ($this->uri->segment($segmento)) {
            $segmento_post = $this->uri->segment($segmento);
        } else {
            $segmento_post = $this->uri->segment($this->app->Segmento_padrao_txf);
        }


        switch ($segmento_post) {
            case 'busca_form_sharp':
                $this->load->library('SharpSpring');
                $listas = $this->sharpspring->busca_listas();
                $listas_ativas = $listas->result->activeList;
                $this->smarty->assign('listas', $listas_ativas);

                foreach ($_POST as $key => $value) {
                    $this->smarty->assign($key, $value);
                }

                $this->model_smarty->render_ajax('form_sharp', $this->app->Template_txf);
                break;
            case 'envia_lista_sharpspring':


                $idlista = $_POST['listId'];
                $this->busca_eventos($_POST['Evento_txf']);
                $sql = "select i.*,  i.Id_int as Id_inscricao, u.* from inscricoes i left outer join usuarios u on u.Email_txf=i.Email_txf where i.Evento_txf='{$this->evento->Url_amigavel_txf}' and i.Certificado_sel='SIM' ";
                $certificados = $this->mbc->executa_sql($sql);

                $this->load->library('SharpSpring');



//                if (count($certificados) > 500) {
                $array_certificados = array_chunk($certificados, 500);
//                    ver($array_certificados);
//                }
//                    ver($array_certificados);
                $cont = 0;
                $cont_error = 0;

                foreach ($array_certificados as $certificados) {

//                   ver($this->sharpspring->cria_leads($certificados));
                    $inseriu = $this->sharpspring->insere_contatos_lista_por_email($idlista, $certificados);
//ver($inseriu);
                    foreach ($inseriu->result->creates as $membro) {
                        if ($membro->success) {
                            $cont = $cont + 1;
                        }
                        if ($membro->error) {
                            $cont_error = $cont_error + 1;
                        }
                    }
                }
                $total_sucesso = $cont;
                $total_erro = $cont_error;

                $this->smarty->assign("idlista", $idlista);
                $this->smarty->assign("total_sucesso", $total_sucesso);
                $this->smarty->assign("total_erro", $total_erro);

                $membros = $this->sharpspring->busca_membros_lista($idlista);
                $this->smarty->assign("membros", $membros->result->getWherelistMemberGets);

//                foreach($membros->result->hetWherelistMemberGets as $member){
//                    foreach($certificados as $certificado){
//                        if($certificado->Email)
//                    }
//                    
//                }
//                $lista_leads[0] = 545724827651;
//                $lista_leads[1] = 545724826627;
//                $lista_leads[2] = 545724488707;
//                $lista_leads[3] = 545723510787;
//                $lista_leads[4] = 524804625411;
//                $lista_leads[5] = 545724828675;
//                $lista_leads[6] = 545723512835;


                /*
                 * CRIA LEADS UM A UM E CRIA MEMBROS JUNTOS
                 */
//                foreach ($certificados as $certificado) {
//                    $i++;
//                    $parametros['emailAddress'] = $certificado->Email_txf;
//                    $leads = $this->sharpspring->busca_leads($parametros);
//                    if ($leads->result->lead[0]) {
//                        echo "Lead Existente";
//                        $lista_leads[] = $leads->result->lead[0]->id;
//                    } else {
//                        echo "Criando lead";
//                        $contato = new stdClass();
//                        $contato->firstName = $certificado->Nome_txf;
//                        $contato->emailAddress = $certificado->Email_txf;
//                        $resultado = $this->sharpspring->cria_lead($contato);
//                        $lista_leads[] = $resultado->result->creates[0]->id;
//                    }
//                    if($i==4){
//                        ver($lista_leads);
//                    }
//                }
//                $inseriu = $this->sharpspring->insere_membros_lista($idlista, $lista_leads);
//                ver($inseriu);


                /*
                  INSERE LEADS E MEMBROS UM A UM
                 */
//                foreach ($certificados as $certificado) {
//                    $contato = new stdClass();
//                    $contato->firstName = $certificado->Nome_txf;
//                    $contato->emailAddress = $certificado->Email_txf;
//                    $inseriu = $this->sharpspring->insere_contato_lista($idlista, $contato);
//                    if ($inseriu->result->creates[0]->id) {
//                        $certificado->id_sharpspring = $inseriu->result->creates[0]->id;
//                    } else {
//                        $certificado->id_sharpspring = '';
//                    }
//                }

                $this->model_smarty->render_ajax('lista_sharp', $this->app->Template_txf);
                die();

                break;
            case 'gerador':

                $id_instituicao = $_POST['Instituicao_txf'];
                $url_form = $_POST['Url_formulario'];

                //                $instituicao=$this->mbc->executa_sql("select * from instituicoes where Id_int=$id_instituicao");

                $and_instituicao = '';
                if ($_POST['cupom_auto']) {
                    $and_instituicao.= "&cpm=true";
                }
                if ($_POST['adm']) {
                    $and_instituicao.= "&adm=true";
                }
                $link = $this->app->Url_cliente . 'formulario/' . $url_form . '?inst=' . $id_instituicao . $and_instituicao;


                $this->smarty->assign('link', $link);
                $this->model_smarty->render_ajax('link', $this->app->Template_txf);

                break;
            case 'inscricao':


                $url_amigavel_form = $_POST['Formulario_txf'];
                $where = "where Url_amigavel_txf='$url_amigavel_form'";
                $this->busca_formularios($where);
                $url_amigavel_evento = $_POST['Evento_txf'];
                $this->busca_eventos($url_amigavel_evento);

                /* BUSCA SE AINDA POSSUI VAGAS */
                $vagas = $this->busca_vagas($this->formularios[0]->Vagas_txf);
                if (empty($vagas)) {
                    $this->smarty->assign('mensagem', 'vagas_encerradas');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                    die();
                } else {
                    echo "Verificando número de vagas... <br>";
                    echo "Ok<br>";
                }
                /*                 * ************************************ */


                if (isset($_POST['Nascimento_dat'])) {
                    $_POST['Nascimento_dat'] = formata_data_sql($_POST['Nascimento_dat']);
                }

                $pasta = $this->evento->Url_amigavel_txf;
                $pasta.='/';

                /* verifica se o usuario já existe */
                $email = $_POST['Email_txf'];

                $url_evento = $_POST['Evento_txf'];
                $url_formulario = $_POST['Formulario_txf'];
                /* verifica se já se cadastrou nessa promocao */
                $inscricao = $this->mbc->executa_sql("select * from inscricoes where Evento_txf='{$url_evento}' and Formulario_txf='{$url_formulario}' and Email_txf='{$email}' ");

                if ($inscricao[0]->Id_int) {

                    if ($_POST['adm'] == 'true') {
                        echo "Usuário já inscrito neste evento";
                        die();
                    }
                    $fade = "NAO";
                    $this->smarty->assign('fade', $fade);
                    $link = $this->app->Url_cliente . "fazer_login/?auto=true&Email_txf={$inscricao[0]->Email_txf}&redirect_link={$this->app->Url_cliente}/inscricao/{$inscricao[0]->Id_int}";
                    $this->smarty->assign('link', $link);
//                    ver($link);
                    $this->smarty->assign('mensagem', 'inscricao_dupla');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);

                    die();
//
//                    $link = $this->app->Url_cliente . "fazer_login/?auto=true&Email_txf={$inscricao[0]->Email_txf}&redirect_link={$this->app->Url_cliente}/inscricao/{$inscricao[0]->Id_int}";
                    redireciona($link);


                    die();
                } else {

                    $usuario = $this->mbc->buscar_tudo("usuarios", "where Email_txf='{$email}'");
                    if (!$usuario[0]->Id_int) {
                        $_POST['Tipo_sel'] = 'usuario';
                        $this->usuario = $this->insere_usuario();
                        echo "Novo Usuário criado";
                    } else {
                        $this->usuario = $usuario[0];
                        $this->atualiza_usuario_auto($this->usuario);
                    }

                    $this->smarty->assign('usuario', $this->usuario);
                    if ($_POST['Cupom_txf']) {
                        $_POST['Cupom_txf'] = strtoupper($_POST['Cupom_txf']);
                    }
                    if ($_POST['Cupom_txf']) {
                        $utiliza_cupom = $this->verifica_cupom();
                    } else {
                        $utiliza_cupom = FALSE;
                    }

                    /* INGRESSOS DA FESTA */
                    if ($_POST['Valor_festa_txf']) {
                        $valor_novo = $_POST['Valor_txf'] + $_POST['Valor_festa_txf'];
                        $_POST['Valor_txf'] = number_format($valor_novo, 2, ".", "");
                    }

//                    ver($_POST);
//                    ver('chegou na bomba');



                    if ($this->mbc->db_insert('inscricoes', $_POST)) {
                        if ($utiliza_cupom) {
                            $this->verifica_cupom('SIM');
                        }
                        $inscricao = $this->mbc->executa_sql("select * from inscricoes where Evento_txf='{$url_evento}' and Formulario_txf='{$url_formulario}' and Email_txf='{$email}' ");
                        if ($inscricao[0]) {

                            if ($_POST['adm'] == 'true') {
                                $redirect_url = $_SERVER['HTTP_REFERER'];
                                $link = $redirect_url;
                                //                          $link = $this->app->Url_cliente . "formulario/{$url_formulario}";
                            } else {
                                $link = $this->app->Url_cliente . "fazer_login/?auto=true&Email_txf={$inscricao[0]->Email_txf}&redirect_link={$this->app->Url_cliente}/inscricao/{$inscricao[0]->Id_int}";
                            }
                        } else {
                            $this->smarty->assign('mensagem', 'inscricao_erro');
                            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                            die();
                        }
                        $this->smarty->assign('inscricao', $inscricao[0]);
                        $email = $_POST;
                        if (!isset($email['Assunto_txf'])) {
                            $email['Assunto_txf'] = 'Inscrição ' . $this->evento->Nome_txf . $this->Formularios[0]->Nome_txf;
                        }
                        $this->smarty->assign('cadastro', $_POST);

                        /* inverte os remetentes */
                        $email['Destinatario_txf'] = $_POST['Email_txf'];
                        $email['Email_txf'] = $_POST['Destinatario_txf'];


                        if ($this->evento->Email_tipo_sel == 'smtp') {
                            if ($this->envia_email_inscricao_smtp($email, $this->evento, $pasta, 'email_inscricao')) {
                                $this->smarty->assign('mensagem', 'inscricao_ok');
                                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                                redireciona($link);
                                die();
                            } else {
                                $this->smarty->assign('mensagem', 'inscricao_erro');
                                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                                die();
                            }
                        } else {
                            if ($this->envia_email_inscricao($email, $pasta, 'email_inscricao')) {
                                $this->smarty->assign('mensagem', 'inscricao_ok');
                                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                                redireciona($link);
                                die();
                            } else {
                                $this->smarty->assign('mensagem', 'inscricao_erro');
                                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                                die();
                            }
                        }
                    } else {
                        $this->smarty->assign('mensagem', 'inscricao_erro');
                        $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                        die();
                    }
                }
                break;

            case 'sub_inscricao':


                $url_amigavel_form = $_POST['Formulario_txf'];
                $where = "where Url_amigavel_txf='$url_amigavel_form'";
                $this->busca_formularios($where);
                $url_amigavel_evento = $_POST['Evento_txf'];
                $this->busca_eventos($url_amigavel_evento);

                /* BUSCA SE AINDA POSSUI VAGAS */
                $vagas = $this->busca_vagas($this->formularios[0]->Vagas_txf);
                if (empty($vagas)) {
                    $this->smarty->assign('mensagem', 'vagas_encerradas');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                    die();
                } else {
//                    echo "Verificando número de vagas... <br>";
//                    echo "Ok<br>";
                }


                /*                 * ************************************ */

                $pasta = $this->evento->Url_amigavel_txf;
                $pasta.='/';

                /* verifica se o usuario já existe */
                $email = $_POST['Email_txf'];
                $cpf = $_POST['Cpf_txf'];
                $url_evento = $_POST['Evento_txf'];
                $url_formulario = $_POST['Formulario_txf'];
                $id_inscricao = $_POST['Id_inscricao'];
                $_POST['Destino_pagto_txf'] = 'subinscricao';
                $_POST['Tipo_pato_txf'] = 'subinscricao';

                if ($_POST['Email_txf'] == '') {
                    die('Email em branco');
                }
                //verifica se exist um usuario
                $usuario = $this->mbc->buscar_tudo("usuarios", "where Cpf_txf='{$cpf}'");
                if (!$usuario[0]->Id_int) {
                    $_POST['Tipo_sel'] = 'usuario';
                    $_POST['Sub_sel'] = 'SIM';

                    $this->usuario = $this->insere_usuario();
                    echo "Novo Usuário criado";
                } else {

                    $_POST['Email_txf'] = $usuario[0]->Email_txf;
                    $_POST['Email_master_txf'] = $usuario[0]->Email_txf;
                }



                if ($this->mbc->db_insert('inscricoes', $_POST)) {


                    $inscricao = $this->mbc->executa_sql("select * from inscricoes where Evento_txf='{$url_evento}' and Formulario_txf='{$url_formulario}' and Email_txf='{$_POST['Email_txf']}' ");
                    if (!$inscricao[0]) {
                        $this->smarty->assign('mensagem', 'inscricao_erro');
                        $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                        die();
                    } else {
                        //apaga a sub
                        $sub = $this->mbc->executa_sql("select * from sub_inscricoes where Id_inscricao='{$id_inscricao}' and Cpf_txf='{$cpf}'");
                        if ($sub[0]) {
//                        $this->mbc->db_delete('sub_inscricoes', 'Id_int', $sub[0]->Id_int);
                            $updateArr['Bloqueado_sel'] = 'SIM';
                            $this->mbc->updateTable('sub_inscricoes', $updateArr, 'Id_int', $sub[0]->Id_int);
                        } else {
                            echo "<br>sub inscricao nonexiste mais<br>";
                        }
                    }

                    $this->smarty->assign('inscricao', $inscricao[0]);
                    $email = $_POST;
                    if (!isset($email['Assunto_txf'])) {
                        $email['Assunto_txf'] = 'Sub Inscrição Convertida em Inscrição' . $this->evento->Nome_txf;
                    }
                    $this->smarty->assign('cadastro', $_POST);

                    /* inverte os remetentes */
                    $email['Destinatario_txf'] = $_POST['Email_master_txf'];
                    $email['Email_txf'] = $_POST['Destinatario_txf'];

                    die('criou');
                    if ($this->evento->Email_tipo_sel == 'smtp') {
                        if ($this->envia_email_inscricao_smtp($email, $this->evento, $pasta, 'email_subinscricao')) {
                            $this->smarty->assign('mensagem', 'subinscricao_ok');
                            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);

                            die();
                        } else {
                            $this->smarty->assign('mensagem', 'inscricao_erro');
                            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                            die();
                        }
                    } else {

                        if ($this->envia_email_inscricao($email, $pasta, 'email_subinscricao')) {
                            $this->smarty->assign('mensagem', 'subinscricao_ok');
                            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);

                            die();
                        } else {
                            $this->smarty->assign('mensagem', 'inscricao_erro');
                            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                            die();
                        }
                    }
                } else {
                    $this->smarty->assign('mensagem', 'inscricao_erro');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                    die();
                }

                break;

            case 'enviar_recibo':
                $this->enviar_recibo();

                break;
            case 'enviar_pagamento':
                $this->enviar_pagamento();

                break;

            case 'atualizar_sub_inscricoes':
                $id_inscricao = $_POST['Id_inscricao'];
                $sub_inscricoes = $_POST['Sub_inscricoes'];

                foreach ($sub_inscricoes as $sub_inscricao) {
                    if ($sub_inscricao['Id_int']) {
                        /* atualiza */
                        $id = $sub_inscricao['Id_int'];
                        unset($sub_inscricao['Id_int']);
                        ver('vai atualizar', 1);

                        $this->mbc->updateTable('sub_inscricoes', $sub_inscricao, 'Id_int', $id);
                    } else {
                        /* insere */
                        ver('vai inserir', 1);

                        unset($sub_inscricao['Id_int']);
                        $this->mbc->db_insert('sub_inscricoes', $sub_inscricao);
                    }
                }

                redirect("inscricao/$id_inscricao");


                break;
            case 'total_inscricoes':
                $id_inscricao = $_POST['Id_inscricao'];
                $valor_unitario = $_POST['Valor_txf'];
                $qtd_ingressos = $_POST['Qtd_ingressos_txf'];


                $array['Valor_txf'] = number_format($valor_unitario * $qtd_ingressos, 2, ".", "");
                $array['Qtd_ingressos_txf'] = $qtd_ingressos;

                $sub_inscricoes = $this->mbc->executa_sql("select * from sub_inscricoes where Id_inscricao=$id_inscricao order by Id_int desc");

                if ($sub_inscricoes[0]) {
                    $cont = count($sub_inscricoes);
                } else {
                    $cont = 0;
                }

                $quant_real = $qtd_ingressos - 1;



                while ($cont > $quant_real) {
                    $sub_inscricoes = $this->mbc->executa_sql("select * from sub_inscricoes where Id_inscricao=$id_inscricao order by Id_int desc");
                    $this->mbc->deleteRow('sub_inscricoes', 'Id_int', $sub_inscricoes[0]->Id_int);
                    $cont = $cont - 1;
                }
                $this->mbc->updateTable('inscricoes', $array, 'Id_int', $id_inscricao);


                redirect("inscricao/$id_inscricao");

                break;
            case 'enviar_presenca':

                $id_inscriao = $_POST['Inscricoes_for'];
                $id_config = $_POST['Presencas_configs_for'];
                $sql = "select * from inscricoes_presencas where Inscricoes_for={$id_inscriao} and Presencas_configs_for={$id_config}";
                if ($_POST['Saida_dat']) {
                    $_POST['Bloqueado_sel'] = 'SIM';
                }
                if ($_POST['Entrada_dat'] && $_POST['Saida_dat']) {
                    if ($_POST['Entrada_dat'] >= $_POST['Saida_dat']) {
                        $this->smarty->assign('mensagem', 'data_invalida');
                        $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                        die();
                    }
                }
                $presenca = $this->mbc->executa_sql($sql);
                if ($presenca[0]) {

                    if ($this->mbc->updateTable('inscricoes_presencas', $_POST, 'Id_int', $presenca[0]->Id_int)) {
                        $this->smarty->assign('mensagem', 'atualizacao_ok');
                        $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                    } else {
                        $this->smarty->assign('mensagem', 'atualizacao_erro');
                        $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                    }
                } else {

                    if ($this->mbc->db_insert('inscricoes_presencas', $_POST)) {
                        $this->smarty->assign('mensagem', 'inseriu_ok');
                        $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                    } else {
                        $this->smarty->assign('mensagem', 'inseriu_erro');
                        $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                    }
                }

                die();


                break;

            case 'insere_atualiza_usuario':

                $dados = array_to_object($_POST);
                if ($dados->Id_int) {
                    $id = $dados->Id_int;
                }
                if ($dados->Email_txf) {
                    $email = $dados->Email_txf;
                }
//                ver($dados);
//                ver($id);
                if ($id) {
                    $usuario_salvo = $this->insere_atualiza_usuario($dados);
                } else {
//                    $sql = "select * from usuarios where Email_txf='{$email}'";
//                    ver($sql);

                    $usuario = $this->mbc->buscar_tudo("usuarios", "where Email_txf='{$email}'");

                    if ($usuario[0]->Id_int) {
                        $dados->Id_int = $usuario[0]->Id_int;

                        $usuario_salvo = $this->insere_atualiza_usuario($dados);
                    } else {
                        if (!$dados->Tipo_sel) {
                            $dados->Tipo_sel = 'usuario';
                        }
                        echo "novo usuário vai ser criado";
                        $usuario_salvo = $this->insere_atualiza_usuario($dados);
                    }
                }
                if ($usuario_salvo) {
                    $this->smarty->assign('mensagem', 'atualizacao_ok');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                } else {
                    $this->smarty->assign('mensagem', 'atualizacao_erro');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                }

//                if (!$usuario[0]->Id_int) {
//                    $_POST['Tipo_sel'] = 'usuario';
//                    $this->usuario = $this->insere_usuario();
//                    echo "Novo Usuário criado";
//                } else {
//                    $this->usuario = $usuario[0];
//                }

                break;

            case 'enviar_presenca_todos':
                $id_config = $_POST['Presencas_configs_for'];
                $sql = "select * from inscricoes_presencas where  Presencas_configs_for={$id_config} and Bloqueado_sel!='SIM'";
                $presencas = $this->mbc->executa_sql($sql);
                $total_presencas = count($presencas);
                $count = 0;


                $this->mbc->updateTable('presencas_configs', $_POST, 'Id_int', $id_config);
                if ($presencas[0]) {

                    foreach ($presencas as $presenca) {
                        if ($this->mbc->updateTable('inscricoes_presencas', $_POST, 'Id_int', $presenca->Id_int)) {
                            $count = $count + 1;
                        }
                    }

                    $total_atualizados = $count;

                    $this->smarty->assign('total_presencas', $total_presencas);
                    $this->smarty->assign('total_atualizados', $total_atualizados);
                    if ($total_atualizados == $total_presencas) {
                        $this->smarty->assign('mensagem', 'atualizacao_presencas_ok');
                    } else {
                        $this->smarty->assign('mensagem', 'atualizacao_presencas_erro');
                    }

                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                } else {
                    $this->smarty->assign('mensagem', 'nenhum_registro');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                }


                die();


                break;
            case 'cupons':
                $quantidade = $_POST['Quantidade'];
                $dados = $_POST;
                for ($i = 1; $i <= $quantidade; $i++) {
                    $cupom = gera_cupons();
                    $dados['Codigo_txf'] = $cupom[0];
                    $this->mbc->db_insert('cupons', $dados);
                }

                $url_amigavel_evento = $_POST['Evento_txf'];
                $url_amigavel_form = $_POST['Formulario_txf'];
                $where = "where Evento_sel='{$url_amigavel_evento}' and Formulario_sel='{$url_amigavel_form}'";


                /* busca cupons do formulario */
                $formularios_cupons = $this->mbc->buscar_tudo("formularios_cupons", $where);
                $this->formularios_cupons = $formularios_cupons;

                $this->smarty->assign('formularios_cupons', $formularios_cupons);

                /* busca cupons */
                $cupons = $this->mbc->buscar_completo("cupons");
                $this->cupons = $cupons[0];
                $this->smarty->assign('cupons', $cupons);
                $this->model_smarty->render_bloco('lista_cupons', $this->app->Template_txf);
                break;


            case 'inscricao_imprensa':
                $url_amigavel_form = $_POST['Formulario_txf'];
                $where = "where Url_amigavel_txf='$url_amigavel_form'";
                $this->busca_formularios_imprensa($where);
                $url_amigavel_evento = $_POST['Evento_txf'];
                $this->busca_eventos($url_amigavel_evento);
                if (isset($_POST['Nascimento_dat'])) {
                    $_POST['Nascimento_dat'] = formata_data_sql($_POST['Nascimento_dat']);
                }
                /* verifica se o usuario já existe */
                $email = $_POST['Email_txf'];
                $usuario = $this->mbc->buscar_tudo("usuarios", "where Email_txf='{$email}'");
                if (!$usuario[0]->Id_int) {
                    $_POST['Tipo_sel'] = 'usuario';
                    $this->usuario = $this->insere_usuario();
                    echo "Novo Usuário criado";
                } else {
                    $this->usuario = $usuario[0];
                    $this->atualiza_usuario_auto($this->usuario);
                }
                $this->smarty->assign('usuario', $this->usuario);

                $url_evento = $_POST['Evento_txf'];
                $url_formulario = $_POST['Formulario_txf'];
                /* verifica se já se cadastrou nessa promocao */
                $inscricao = $this->mbc->executa_sql("select * from inscricoes_imprensa where Evento_txf='{$url_evento}' and Formulario_txf='{$url_formulario}' and Email_txf='{$email}' ");

//                  $email = $_POST;
//                  $this->envia_email($email, 'email_inscricao_imprensa');

                if ($inscricao[0]->Id_int) {


                    $this->smarty->assign('mensagem', 'inscricao_dupla');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                    die();
                } else {


                    if ($this->mbc->db_insert('inscricoes_imprensa', $_POST)) {
                        $inscricao = $this->mbc->executa_sql("select * from inscricoes_imprensa where Evento_txf='{$url_evento}' and Formulario_txf='{$url_formulario}' and Email_txf='{$email}' ");
                        $this->smarty->assign('inscricao', $inscricao[0]);



                        $email = $_POST;
                        if (!isset($email['Assunto_txf'])) {
                            $email['Assunto_txf'] = 'Credenciamento de Imprensa - ' . $this->evento->Nome_txf . $this->Formularios[0]->Nome_txf;
                        }
                        $this->smarty->assign('cadastro', $_POST);
//                       ;
                        //$this->envia_email($email, 'email_inscricao_imprensa')
                        if ($this->envia_email_inscricao_smtp($email, $this->evento, '', 'email_inscricao_imprensa')) {
                            $this->smarty->assign('mensagem', 'inscricao_ok');
                            $link = $this->app->Url_cliente . "fazer_login/?auto=true&Email_txf={$inscricao[0]->Email_txf}&redirect_link={$this->app->Url_cliente}/inscricao_imprensa/{$inscricao[0]->Id_int}";
//                            $link = $this->app->Url_cliente . "evento/{$url_evento}";
                            $this->smarty->assign('link', $link);

                            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                            die();
                        } else {

                            $this->smarty->assign('mensagem', 'inscricao_erro');
                            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                        }
                    } else {

                        $this->smarty->assign('mensagem', 'inscricao_erro');
                        $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                        die();
                    }
                }
                die();
                break;
            case 'atualizar_registro';

                $this->altera_registro();
                break;

            case 'gerar_certificados';

                $this->gerar_certificados();
                break;

            case 'filtro' :

                /* busca formulario */
                if ($_POST['Formulario_txf']) {
                    $url_amigavel_form = $_POST['Formulario_txf'];
                    $where = "where Url_amigavel_txf='$url_amigavel_form'";
                } else {
                    die('acesso invalido');
                }

                $this->busca_formularios($where);

                /* busca evento */
                $url_amigavel_evento = $this->formularios[0]->Evento_sel;
                $this->busca_eventos($url_amigavel_evento);
                $where = "where Evento_sel='{$url_amigavel_evento}' and Formulario_sel='{$url_amigavel_form}' order by Instituicao_sel";

                /* busca inscricoes */
                $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}' and ( Nome_txf LIKE '%{$_POST['Nome_txf']}%' or i.Id_int LIKE '%{$_POST['Nome_txf']}%' or i.Email_txf LIKE '%{$_POST['Nome_txf']}%' or u.Cpf_txf LIKE '%{$_POST['Nome_txf']}%'  ) order by i.Pago_sel desc, Nome_txf";

                if ($this->evento->Tipo_inscricao_sel == 'PAGAS') {
                    $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}' and Pago_sel='SIM'  and ( Nome_txf LIKE '%{$_POST['Nome_txf']}%' or i.Id_int LIKE '%{$_POST['Nome_txf']}%' or i.Email_txf LIKE '%{$_POST['Nome_txf']}%' or u.Cpf_txf LIKE '%{$_POST['Nome_txf']}%'  ) order by i.Pago_sel desc, Nome_txf";
//                    $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}' and Pago_sel='SIM' order by i.Pago_sel desc, Nome_txf";
                } else {

                    $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}' and ( Nome_txf LIKE '%{$_POST['Nome_txf']}%' or i.Id_int LIKE '%{$_POST['Nome_txf']}%' or i.Email_txf LIKE '%{$_POST['Nome_txf']}%' or u.Cpf_txf LIKE '%{$_POST['Nome_txf']}%'  ) order by i.Pago_sel desc, Nome_txf";
//                    $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}' order by i.Pago_sel desc, Nome_txf";
                }

                $sql = "select i.*, i.Id_int as Id_inscricao, u.* from inscricoes i left outer join usuarios u on u.Email_txf=i.Email_txf " . $where;

                $inscricoes = $this->mbc->executa_sql($sql);


                $this->inscricoes = $inscricoes;
                $this->smarty->assign('inscricoes', $inscricoes);


                $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}' and ( sub.Nome_txf LIKE '%{$_POST['Nome_txf']}%'  or u.Nome_txf LIKE '%{$_POST['Nome_txf']}%' or i.Email_txf LIKE '%{$_POST['Nome_txf']}%' or u.Cpf_txf LIKE '%{$_POST['Nome_txf']}%'  ) order by Nome_txf, sub.Nome_txf";
                $sql2 = "select sub.*, sub.Id_int as Id_subinscricao, i.*, u.Nome_txf as Nome_master_txf  from sub_inscricoes sub 
left outer join inscricoes i on i.Id_int=sub.Id_inscricao
left outer join usuarios u on u.Email_txf=i.Email_txf " . $where;

                $sub_inscricoes = $this->mbc->executa_sql($sql2);

                $this->smarty->assign('sub_inscricoes', $sub_inscricoes);

                /* busca totalizadores */
//                        $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}'";
//                        $totalizadores = $this->mbc->executa_sql("select  COUNT(i.Pago_sel) as total, i.Pago_sel from inscricoes i  {$where} group by Pago_sel order by i.Pago_sel desc, i.Email_txf");
//                        $this->smarty->assign('totalizadores', $totalizadores);
//                        $this->model_smarty->carrega_bloco('totalizadores', 'totalizadores', $this->app->Template_txf);

                /* carrega blocos de inscricoes */
                $this->model_smarty->carrega_bloco('lista_inscritos', $this->formularios[0]->Arquivo_lista_txf, $this->app->Template_txf);

                $this->model_smarty->render_bloco('admin_formulario_inscricoes', $this->app->Template_txf);
                die();
                break;

            case 'filtro_geral_nao_pagas' :

                /* busca formulario */
                if ($_POST['Evento_txf']) {
                    $url_amigavel_evento = $_POST['Evento_txf'];
                    $where = "where Evento_sel='$url_amigavel_evento'";
                } else {
                    die('acesso invalido');
                }
                $evento = $this->busca_eventos($url_amigavel_evento, $this->empresa);
                $where = "where i.Id_int is not null and ( Nome_txf LIKE '%{$_POST['Nome_txf']}%' or i.Id_int LIKE '%{$_POST['Nome_txf']}%' or i.Email_txf LIKE '%{$_POST['Nome_txf']}%' or u.Cpf_txf LIKE '%{$_POST['Nome_txf']}%'  ) ";
                $where .= " and  Evento_txf='{$this->evento->Url_amigavel_txf}' and   Pago_sel='NAO' order by i.Pago_sel desc, Nome_txf";
                $sql = "select i.*, i.Id_int as Id_inscricao, u.* from inscricoes i left outer join usuarios u on u.Email_txf=i.Email_txf " . $where;

                $inscricoes = $this->mbc->executa_sql($sql);
                $this->inscricoes = $inscricoes;
                $this->smarty->assign('inscricoes_nao_pagas', $inscricoes);
                $this->model_smarty->render_bloco('admin_formulario_inscricoes_nao_pagas', $this->app->Template_txf);
                break;

            case 'filtro_geral' :

                /* busca formulario */
                if ($_POST['Evento_txf']) {
                    $url_amigavel_evento = $_POST['Evento_txf'];
                    $where = "where Evento_sel='$url_amigavel_evento'";
                } else {
                    die('acesso invalido');
                }


                $evento = $this->busca_eventos($url_amigavel_evento, $this->empresa);


                $where = "where i.Id_int is not null and ( Nome_txf LIKE '%{$_POST['Nome_txf']}%' or i.Id_int LIKE '%{$_POST['Nome_txf']}%' or i.Email_txf LIKE '%{$_POST['Nome_txf']}%' or u.Cpf_txf LIKE '%{$_POST['Nome_txf']}%'  ) ";
                /* busca inscricoes */
                if ($this->evento->Tipo_inscricao_sel == 'PAGAS') {
                    $where .= " and  Evento_txf='{$this->evento->Url_amigavel_txf}' and   Pago_sel='SIM' order by i.Pago_sel desc, Nome_txf";
                } else {
                    $where .= " and Evento_txf='{$this->evento->Url_amigavel_txf}'  order by i.Pago_sel desc, Nome_txf";
                }

                $sql = "select i.*, i.Id_int as Id_inscricao, u.* from inscricoes i left outer join usuarios u on u.Email_txf=i.Email_txf " . $where;

                $inscricoes = $this->mbc->executa_sql($sql);
                $this->inscricoes = $inscricoes;
                $this->smarty->assign('inscricoes', $inscricoes);
                $this->model_smarty->carrega_bloco('lista_inscritos', 'lista/default', $this->app->Template_txf);
                $this->model_smarty->render_bloco('admin_formulario_inscricoes', $this->app->Template_txf);
                die();
                break;
            case 'filtro_credenciamento' :

                /* busca formulario */
                if ($_POST['Formulario_txf']) {
                    $url_amigavel_form = $_POST['Formulario_txf'];
                    $where = "where Url_amigavel_txf='$url_amigavel_form'";
                } else {
                    die('acesso invalido');
                }

                $this->busca_formularios($where);

                /* busca evento */
                $url_amigavel_evento = $this->formularios[0]->Evento_sel;
                $this->busca_eventos($url_amigavel_evento);
                $where = "where Evento_sel='{$url_amigavel_evento}' and Formulario_sel='{$url_amigavel_form}' order by Instituicao_sel";

                /* busca inscricoes */
                $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}' and ( Nome_txf LIKE '%{$_POST['Nome_txf']}%' or i.Id_int LIKE '%{$_POST['Nome_txf']}%' or i.Email_txf LIKE '%{$_POST['Nome_txf']}%' or u.Cpf_txf LIKE '%{$_POST['Nome_txf']}%'  ) ";
                if ($_POST['Pago_sel']) {
                    $where.= " and Pago_sel='SIM'";
                }
                if ($_POST['Material_sel']) {
                    $where.= " and Material_sel='SIM'";
                }

                $order = " order by i.Pago_sel desc, Nome_txf";
                $where.=$order;
                $sql = "select i.*, i.Id_int as Id_inscricao, u.* from inscricoes i left outer join usuarios u on u.Email_txf=i.Email_txf " . $where;




                $inscricoes = $this->mbc->executa_sql($sql);


                $this->inscricoes = $inscricoes;
                $this->smarty->assign('inscricoes', $inscricoes);
                $this->calcula_totais_credenciamento();
//
//
//                $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}' and ( sub.Nome_txf LIKE '%{$_POST['Nome_txf']}%' or i.Email_txf LIKE '%{$_POST['Nome_txf']}%' or u.Cpf_txf LIKE '%{$_POST['Nome_txf']}%'  ) order by i.Pago_sel desc, Nome_txf, sub.Nome_txf";
//                $sql2 = "select sub.*, i.Email_txf, u.Nome_txf as Nome_master_txf  from sub_inscricoes sub 
//left outer join inscricoes i on i.Id_int=sub.Id_inscricao
//left outer join usuarios u on u.Email_txf=i.Email_txf " . $where;
//
//                $sub_inscricoes = $this->mbc->executa_sql($sql2);
//
//                $this->smarty->assign('sub_inscricoes', $sub_inscricoes);

                /* busca totalizadores */
//                        $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and Formulario_txf='{$this->formularios[0]->Url_amigavel_txf}'";
//                        $totalizadores = $this->mbc->executa_sql("select  COUNT(i.Pago_sel) as total, i.Pago_sel from inscricoes i  {$where} group by Pago_sel order by i.Pago_sel desc, i.Email_txf");
//                        $this->smarty->assign('totalizadores', $totalizadores);
//                        $this->model_smarty->carrega_bloco('totalizadores', 'totalizadores', $this->app->Template_txf);

                /* carrega blocos de inscricoes */
                $this->model_smarty->render_ajax('lista_credenciamento', $this->app->Template_txf);

//                $this->model_smarty->render_bloco('admin_formulario_inscricoes', $this->app->Template_txf);
                die();
                break;

            case 'filtro_credenciamento_geral' :


                /* busca formulario */
                if ($_POST['Evento_txf']) {
                    $url_amigavel_evento = $_POST['Evento_txf'];
                    // $where = "where Url_amigavel_txf='$url_amigavel_form'";
                } else {
                    die('acesso invalido');
                }

                ///$this->busca_formularios($where);

                /* busca evento */
                //    $url_amigavel_evento = $this->formularios[0]->Evento_sel;
                $this->busca_eventos($url_amigavel_evento);
//                $where = "where Evento_sel='{$url_amigavel_evento}'  order by Instituicao_sel";

                /* busca inscricoes */
                $where = "where Evento_txf='{$this->evento->Url_amigavel_txf}' and ( Nome_txf LIKE '%{$_POST['Nome_txf']}%' or i.Id_int LIKE '%{$_POST['Nome_txf']}%' or i.Email_txf LIKE '%{$_POST['Nome_txf']}%' or u.Cpf_txf LIKE '%{$_POST['Nome_txf']}%'  ) ";
                if ($_POST['Pago_sel']) {
                    $where.= " and Pago_sel='SIM'";
                }
                if ($_POST['Material_sel']) {
                    $where.= " and Material_sel='SIM'";
                }

                $order = " order by i.Pago_sel desc, Nome_txf";
                $where.=$order;
                $sql = "select i.*, i.Id_int as Id_inscricao, u.* from inscricoes i left outer join usuarios u on u.Email_txf=i.Email_txf " . $where;

//ver($sql);


                $inscricoes = $this->mbc->executa_sql($sql);


                $this->inscricoes = $inscricoes;
                $this->smarty->assign('inscricoes', $inscricoes);
                $this->calcula_totais_credenciamento();

                $this->model_smarty->render_ajax('lista_credenciamento', $this->app->Template_txf);

//                $this->model_smarty->render_bloco('admin_formulario_inscricoes', $this->app->Template_txf);
                die();
                break;
        }

        die();
    }

    function ajax() {
        $this->conecta_mbc($this->app->Conexoes_for);
        $segmento = (int) $this->app->Segmento_padrao_txf;
        $segmento = $segmento + 1;
        $pagina = $this->uri->segment($segmento);
        switch ($pagina) {
            case 'presenca':
                $id = $_POST['Id_int'];
                $where = " where Id_int={$id}";
                $inscricoes = $this->mbc->buscar_tudo('inscricoes', $where);
                if (!$inscricoes[0]) {
                    echo "Nao encontrou inscricao";
                    die();
                }
                if ($inscricoes[0]->Pago_sel != 'SIM') {
                    $this->smarty->assign('mensagem', 'inscricao_nao_paga');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                }

                $this->smarty->assign('inscricao', $inscricoes[0]);

                $this->busca_formularios_eventos($inscricoes);



                $hora = date('H:i');
                $this->smarty->assign('hora', $hora);
                $where = "where Evento_sel='{$inscricoes[0]->Evento_txf}' and Formulario_sel='{$inscricoes[0]->Formulario_txf}' order by Data_dat";
                $sql = "select * from presencas_configs $where";


                $presencas_configs = $this->mbc->executa_sql($sql);

                foreach ($presencas_configs as $presenca) {
                    $presenca_atual = $this->mbc->executa_sql("select * from inscricoes_presencas where Inscricoes_for={$inscricoes[0]->Id_int} and Presencas_configs_for={$presenca->Id_int}");
                    $presenca->Presenca = $presenca_atual;
                }
                $this->smarty->assign('presencas_configs', $presencas_configs);


                echo $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, 'forms_presenca', $this->formularios[0]->Formulario_presenca_txf);
                die();
                break;

            case 'excluir':

                echo $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, 'forms', $pagina);
                die();
                break;

            default:
                break;
        }
    }

}

