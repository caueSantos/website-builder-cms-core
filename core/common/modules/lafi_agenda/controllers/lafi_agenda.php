<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class lafi_agenda extends lands_core {

    public $modulo = 'blog';
    public $configuracoes;
    public $filtrodata = " and Data_inicio_dat>= CURRENT_DATE() ";

    public function __construct() {
        parent::__construct();
        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);
        if ($this->session->userdata['usuario']) {
            $this->usuario = $this->session->userdata['usuario'];
        }


//        if(!is_lands()){
//            header("HTTP/1.1 301 Redirecionando...");
//            header("Location: http://www.laficosmeticos.com.br");
//            
//        }
    }

    function index() {

//        if (!$this->usuario->Id_int) {
//            if (!is_lands()) {
//                redireciona("http://laficosmeticos.com.br");
//            }
//        }

        if (!method_exists(__CLASS__, $this->pagina_atual)) {
            $this->carrega_pagina($this->pagina_atual);
        } else {
            $funcao_atual = $this->pagina_atual;
//executa uma funcao que deve ser programa nesta classe.
            $this->$funcao_atual();
        }
    }

    function ajax() {

        $this->conecta_mbc($this->app->Conexoes_for);

        if (!$this->uri->segment($this->app->Segmento_padrao_txf + 1)) {
            redireciona($this->app->Pagina_inicial_txf);
        }
        $this->pagina_ajax = $this->uri->segment($this->app->Segmento_padrao_txf + 1);

        switch ($this->pagina_ajax) {
            case 'filtro':
                $tipo_agenda = $_POST['Tipo_agenda_sel'];
                $cursos_eventos = $_POST['Cursos_eventos_sel'];

                $this->filtra_agenda($tipo_agenda, $cursos_eventos, TRUE);
                break;
        }
    }

    function filtra_agenda($tipo_agenda = false, $cursos_eventos = false, $render = false) {


        $where_cursos = "";
        $filtro_agenda = "";

        if ($tipo_agenda) {
            if (is_array($tipo_agenda)) {
                $filtro_agenda.= " and (";
                $i = 0;
                foreach ($tipo_agenda as $agenda) {
                    if ($i != 0) {
                        $where_cursos.= " or ";
                    }
                    $i = $i + 1;

                    $filtro_agenda.= " Cursos_eventos_sel='{$agenda}' ";
                }
                $filtro_agenda.=") ";
            } else {
                $filtro_agenda.=" and Tipo_agenda_sel='{$tipo_agenda}'";
            }
        }


        if ($cursos_eventos) {
            if (is_array($cursos_eventos)) {
                $where_cursos.= " and (";
                $i = 0;
                foreach ($cursos_eventos as $cursos) {
                    if ($i != 0) {
                        $where_cursos.= " or ";
                    }
                    $i = $i + 1;

                    $where_cursos.= " Cursos_eventos_sel='{$cursos}' ";
                }
                $where_cursos.=") ";
            } else {
                $where_cursos.=" and Cursos_eventos_sel='{$cursos_eventos}'";
            }
        }


        $sql = "select * from agendas where Ativo_sel = 'SIM' {$filtro_agenda} {$this->filtrodata}  {$where_cursos} order by Data_inicio_dat";
        $agendas_incompletas = $this->mbc->executa_sql($sql);

        $agendas_estados = $this->mbc->executa_sql("select count(agendas.Id_int) as total, Estado_sel, e.Sigla_txf, e.Nome_txf from agendas left outer join estados e on e.Sigla_txf=Estado_sel where agendas.Id_int is not null {$filtro_agenda} {$this->filtrodata}  {$where_cursos} group by Estado_sel order by total desc, e.Nome_txf");



        $this->smarty->assign('agendas_estados', $agendas_estados);

        $agendas = $this->complementa_agendas($agendas_incompletas);
        $this->smarty->assign('agendas', $agendas);

        if ($render) {
            $this->model_smarty->render_bloco('lista_agenda', $this->app->Template_txf);
            die();
        } else {


            $this->model_smarty->carrega_bloco('lista_agenda', 'lista_agenda', $this->app->Template_txf);
        }
    }

    function complementa_agendas($agendas) {

        foreach ($agendas as $agenda) {
            if ($agenda->Texto_data_txf != '') {
                $agenda->Data = $agenda->Texto_data_txf;
            } else {
                if ($agenda->Data_inicio_dat == $agenda->Data_fim_dat || $agenda->Data_fim_dat == '') {
                    $agenda->Data = arruma_data($agenda->Data_inicio_dat);
                } else {
                    $agenda->Data = arruma_data($agenda->Data_inicio_dat) . " à " . arruma_data($agenda->Data_fim_dat);
                }
            }

            $agenda->Tipo_agenda = $this->mbc->executa_sql("select * from tipos_agenda where Url_amigavel_txf='{$agenda->Tipo_agenda_sel}'");
            $agenda->Curso = $this->mbc->executa_sql("select * from cursos_eventos where Url_amigavel_txf='{$agenda->Cursos_eventos_sel}'");
            $agenda->Tecnicos = $this->mbc->executa_sql("select t.* from tecnicos t left outer join checkboxes c on c.Id_chb_con=t.Id_int where c.Id_objeto_con={$agenda->Id_int}");
            $agenda->Tecnicos = $this->mbc->complementa_registros($agenda->Tecnicos, 'tecnicos');
        }
        return $agendas;
    }

    function switch_pagina() {
        $this->smarty->assign('titulo_pagina', ucfirst($this->pagina_atual));
//        $this->carrega_configuracoes();
        $this->conecta_mbc($this->app->Conexoes_for);
        switch ($this->pagina_atual) {
            case 'busca':
                if (!isset($_POST['valor'])) {
                    redirect($this->app->Pagina_inicial_txf);
                }
                if (!isset($_POST['Tabelas_txf'])) {

                    //  redirect($this->app->Url_cliente);
                    ver('Você deve definir as tabelas no qual a busca será feita');
                    die();
                }
                $tabelas = explode(',', $_POST['Tabelas_txf']);
                $this->conecta_mbc($this->app->Conexoes_for);
                foreach ($tabelas as $tabela) {
                    $resultado[$tabela] = $this->mbc->get_busca($tabela, $_POST['valor']);
                }
                $this->smarty->assign('resultado', $resultado);
//                $resultado['post'] = $this->mbc->get_busca("post", $_POST['valor']);
//                $resultado['tags'] = $this->mbc->get_busca("tags", $_POST['valor']);
                $this->smarty->assign('titulo_pagina', 'Resultados para "' . $_POST['valor'] . '"');
                $this->smarty->assign('resultado', $resultado);
                break;
            case 'cursos':
                $tipo_agenda = $this->mbc->buscar_completo("tipos_agenda", "where Ativo_sel='SIM'");
                $cursos_eventos = $this->mbc->buscar_completo("cursos_eventos", "where Id_int is not null order by Nome_txf");
                foreach ($cursos_eventos as $curso) {
                    $sql = "select  t.* from agendas t  where t.Ativo_sel='SIM' {$this->filtrodata} and Cursos_eventos_sel='{$curso->Url_amigavel_txf}' ";
                    $total = $this->mbc->executa_sql($sql);
                    if ($total[0]->Id_int) {
                        $curso->total = count($total);
                        $cursos_novos[] = $curso;
                    } else {
                        $curso->total = 0;
                    }
                }

                $this->smarty->assign('tipo_agenda', $tipo_agenda);
                $this->smarty->assign('cursos_eventos', $cursos_eventos);
                $this->model_smarty->carrega_bloco('filtros_agenda', 'filtros_agenda_novo', $this->app->Template_txf);
                $this->model_smarty->carrega_bloco('lista_cursos', 'lista_cursos', $this->app->Template_txf);
                break;
            case 'agenda':
                $where = "  Ativo_sel='SIM' ";
                $tipo_agenda = $this->mbc->buscar_completo("tipos_agenda", "where {$where}");

//ver($this->filtrodata);
                
                if(is_lands()) {
                    $this->filtrodata= " and Data_fim_dat>=DATE_ADD(CURRENT_DATE(), INTERVAL -4 DAY)  ";
                    
//                $this->filtrodata= " and Data_fim_dat>= DATE_ADD(CURRENT_DATE(), INTERVAL +3 DAY) ";
                }
//                ver($this->filtrodata);
                foreach ($tipo_agenda as $curso) {
                    $sql = "select  t.* from agendas t  where t.Ativo_sel='SIM' {$this->filtrodata} and  Tipo_agenda_sel='{$curso->Url_amigavel_txf}' ";
//                    ver($sql);
                    $total = $this->mbc->executa_sql($sql);

                    if ($total[0]->Id_int) {
                        $curso->total = count($total);
                    } else {
                        $curso->total = 0;
                    }
                }




                $cursos_eventos = $this->mbc->buscar_completo("cursos_eventos", "where {$where} order by Nome_txf");
                foreach ($cursos_eventos as $curso) {
                    $sql = "select  t.* from agendas t  where t.Ativo_sel='SIM' {$this->filtrodata} and Cursos_eventos_sel='{$curso->Url_amigavel_txf}' ";
                    $total = $this->mbc->executa_sql($sql);
                    if ($total[0]->Id_int) {
                        $curso->total = count($total);
                        $cursos_novos[] = $curso;
                    } else {
                        $curso->total = 0;
                    }
                }
                $this->filtra_agenda(FALSE, FALSE, FALSE);

                $this->smarty->assign('tipo_agenda', $tipo_agenda);
                $this->smarty->assign('cursos_eventos', $cursos_novos);

                $this->model_smarty->carrega_bloco('filtros_agenda', 'filtros_agenda', $this->app->Template_txf);
                $this->model_smarty->carrega_bloco('lista_cursos', 'lista_cursos', $this->app->Template_txf);
                break;
            case 'curso_evento':
                $filtra_agenda = TRUE;
                $this->busca_curso_evento($filtra_agenda);
                break;
            case 'agenda_descricao':
                if (!$this->uri->segment($this->app->Segmento_padrao_txf + 1)) {
                    redirect($this->app->Pagina_inicial_txf);
                }
                $id = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
                $this->busca_descricao_agenda($id);
                $this->grava_visualizacao_agenda($this->agenda);
                $this->busca_visualizacoes($this->agenda->Id_int, 'agendas');
                $this->smarty->assign('titulo_pagina', $this->agenda->Titulo_pagina_txf);
                $this->model_smarty->carrega_bloco('post_anexos', 'post_anexos', $this->app->Template_txf);
                $this->busca_proximas_agendas();



                break;
//            case 'fashionhair':
//                redireciona('http://eventos.lafi.com.br/fashion-hair-lages-2016');
//                die();
//                break;
        }
        $this->carrega_itens_obrigatorios();
    }

    function busca_proximas_agendas() {
        $proximas_inc = $this->mbc->buscar_completo("agendas", "where Data_inicio_dat>=CURRENT_DATE() limit 6");

//        ver($proximas_inc);
        $proximas_agendas = $this->complementa_agendas($proximas_inc);

        $this->smarty->assign('proximas_agendas', $proximas_agendas);
        return $proximas_agendas;
    }

    function busca_descricao_agenda($id) {
        $agendas_incompletas = $this->mbc->buscar_completo("agendas", "and Id_int={$id}");
        if (!$agendas_incompletas[0]) {
            redirect($this->app->Url_cliente);
        }
        $agendas = $this->complementa_agendas($agendas_incompletas);
        $this->smarty->assign('agendas', $agendas);
        $this->smarty->assign('posts', $agendas);
        $this->agenda = $agendas[0];
    }

    function busca_curso_evento() {

        if (!$this->uri->segment($this->app->Segmento_padrao_txf + 1)) {
            redirect($this->app->Pagina_inicial_txf);
        }
        $id = $this->uri->segment($this->app->Segmento_padrao_txf + 1);


        $where = "where Ativo_sel='SIM' and Id_int=" . $id;
//  $where="where Ativo_sel='SIM' {$this->filtrodata} and Id_int=" . $id;

        $cursos_eventos = $this->mbc->buscar_completo("cursos_eventos", $where);
        $this->cursos_eventos = $cursos_eventos[0];
        $tipo_agenda = $this->mbc->buscar_completo("tipos_agenda", "where Url_amigavel_txf='{$cursos_eventos[0]->Tipo_agenda_sel}'");
        $this->tipo_agenda = $tipo_agenda[0];

        $this->smarty->assign('tipo_agenda', $tipo_agenda);
        $this->smarty->assign('cursos_eventos', $cursos_eventos);

        $this->filtra_agenda($cursos_eventos[0]->Tipo_agenda_sel, $cursos_eventos[0]->Url_amigavel_txf);

        $this->smarty->assign('titulo_pagina', $cursos_eventos[0]->Nome_txf);

//$this->model_smarty->carrega_bloco('lista_agenda', 'lista_agenda', $this->app->Template_txf);
    }

    function grava_visualizacao_agenda($post) {

//        if (!is_lands()) {
        if ($this->mbc->tabelaexiste('visualizacoes')) {
            $visualizacoes['Ip_txf'] = $_SERVER['REMOTE_ADDR'];
            $visualizacoes['Id_objeto_con'] = $post->Id_int;
            $visualizacoes['Tabela_con'] = 'agenda';
            $visualizacoes['Titulo_txf'] = $post->Nome_txf;
            $visualizacoes['Acesso_dat'] = date("Y-m-d H:i:s");
            if (isset($_REQUEST['utm_source'])) {
                $visualizacoes['Origem_txf'] = $_REQUEST['utm_source'];
            } else {
                $visualizacoes['Origem_txf'] = 'desconhecido';
            }
            $this->mbc->db_insert('visualizacoes', $visualizacoes);
        }
//        }
    }

    function busca_visualizacoes($id, $tabela = 'post') {
        if ($this->mbc->tabelaexiste('visualizacoes')) {
            $sql = "select COUNT(*) as total, v.* from visualizacoes v where v.Id_objeto_con={$id} and v.Tabela_con='{$tabela}' group by  v.Id_objeto_con";
            $visualizacoes = $this->mbc->executa_sql($sql);
            $this->smarty->assign('visualizacoes', $visualizacoes);
        }
    }

    function carrega_configuracoes() {
        $this->conecta_mbc($this->app->Conexoes_for);
        $configuracoes = $this->mbc->executa_sql("select * from configuracoes limit 1");
        if (isset($configuracoes[0]->Id_int)) {
            $this->configuracoes = $configuracoes[0];
            $this->smarty->assign('configuracoes', $configuracoes[0]);
        }
    }

    function carrega_itens_obrigatorios() {
//Carrega lista de tags no menu da direita

        $this->conecta_mbc($this->app->Conexoes_for);


//        } else {
        $cursos_direita = $this->mbc->buscar_completo("tipos_agenda", "where Ativo_sel='SIM'");
        $cursos_eventos = $this->mbc->buscar_completo("cursos_eventos", "where Id_int is not null order by Nome_txf");
        foreach ($cursos_direita as $curso) {
            $total = conta($cursos_eventos, 'Tipo_agenda_sel', $curso->Url_amigavel_txf);

            $curso->total = $total;
        }
//        }
//        $this->smarty->assign('cursos_direita', $cursos_direita);
//        $this->model_smarty->carrega_bloco('cursos_direita', 'cursos_direita', $this->app->Template_txf);
//carrega lista de autores
    }

}

?>