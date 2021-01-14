<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class camara extends lands_core {

    public function __construct() {
        parent::__construct();
        $this->load->helper('tradutor');
        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);
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
        $this->conecta_mbc($this->app->Conexoes_for);
        $this->carrega_menu();

        $redes_sociais = $this->mbc->buscar_tudo("redes_sociais");
        $this->smarty->assign('redes_sociais', $redes_sociais[0]);

        $configuracoes = $this->mbc->buscar_tudo("configuracoes");
        $this->configuracoes = $configuracoes[0];
        $this->smarty->assign('configuracoes', $configuracoes[0]);



        $emails = $this->mbc->buscar_tudo("departamentos", "where Ativo_sel='SIM'");
        $this->smarty->assign('emails', $emails);

        $contato = $this->mbc->buscar_tudo("contato");
        $this->smarty->assign('contato', $contato[0]);

        $ultimas_noticias = $this->mbc->buscar_completo("noticias", "where Ativo_sel='SIM' and data_dat <= CURRENT_DATE() limit 3");
        $this->smarty->assign('ultimas_noticias', $ultimas_noticias);



        $this->model_smarty->carrega_bloco('demo', 'demo', $this->app->Template_txf);
        $this->model_smarty->carrega_bloco('navegacao', 'navegacao', $this->app->Template_txf);
        $this->model_smarty->carrega_bloco('facebook', 'facebook', $this->app->Template_txf);
    }

    function carrega_menu() {

        $menu_camaras = $this->mbc->buscar_completo("camara", "where Ativo_sel='SIM' order by Ordenacao_txf");
        $this->smarty->assign('menu_camaras', $menu_camaras);


        $menu_cidades = $this->mbc->buscar_completo("cidade", "where Ativo_sel='SIM' order by Ordenacao_txf");
        $this->smarty->assign('menu_cidades', $menu_cidades);

        $menu_noticias = $this->mbc->buscar_completo("noticias", "where Ativo_sel='SIM' and Data_dat <= CURRENT_DATE() group by Categoria_sel  ");
        $this->smarty->assign('menu_noticias', $menu_noticias);
    }

    function ordenacao($tabela, $ultimo = FALSE, $campo = 'Ordenacao_txf') {
        $order = '';
        if ($this->mbc->tabelaexiste($tabela)) {
            if ($this->mbc->campoexiste($campo, $tabela)) {
                $order = " order by $campo";
                if (!$ultimo) {
                    $order.=',';
                }
            }
        }


        return $order;
    }

    function switch_pagina() {
        $this->carrega_obrigatorios();


        switch ($this->pagina_atual) {
            case 'inicio':
                $banners = $this->mbc->buscar_completo("banners", "where Ativo_sel='SIM' order by Ordenacao_txf");
                $this->smarty->assign('banners', $banners);
                $this->model_smarty->carrega_bloco('banner', 'banner', $this->app->Template_txf);
                $registros = $this->mbc->valores_paginacao_generic($this->app, $this->pagina_atual, 'noticias', "where Ativo_sel='SIM' and Data_dat <= CURRENT_DATE() order by Data_dat desc, Id_int desc", (intval($this->uri->segment(2) > 0)) ? intval($this->uri->segment(2)) : '1', '5');


//                        $sql = "select * from post where Categoria_sel = '" . $cat . "' order by Data_dat desc";

                $this->smarty->assign('registros', $registros->registros);
                if (isset($registros->paginacao)) {
                    $this->smarty->assign('paginacao', $registros->paginacao);
                }
                
                $registros_videos = $this->mbc->buscar_completo("galeria_videos", "where Mostra_inicio_sel='SIM' order by Data_dat desc, Categoria_sel limit 1");
                
//                 ver($registros_videos);
                $this->smarty->assign('registros_videos', $registros_videos);
                $this->model_smarty->carrega_bloco('noticias', 'noticias', $this->app->Template_txf);

                break;
            case 'camara':
                $where = "where Ativo_sel='SIM' ";
                if ($this->uri->segment(2)) {
                    $id = $this->uri->segment(2);
                    $where.=" and Id_int=$id";
                }
                $camaras = $this->mbc->buscar_completo("camara", $where . "  order by Ordenacao_txf");
                $this->smarty->assign('camaras', $camaras);

                break;
            case 'cidade':
                $where = "where Ativo_sel='SIM' ";
                if ($this->uri->segment(2)) {
                    $id = $this->uri->segment(2);
                    $where.=" and Id_int=$id";
                }
                $cidades = $this->mbc->buscar_completo("cidade", $where . " order by Ordenacao_txf");
                $this->smarty->assign('cidades', $cidades);

                break;
            case 'decretos':
                $where = "where Id_int is not null ";
                if ($this->uri->segment(2)) {
                    $categoria = urldecode($this->uri->segment(2));
                    $where.=" and Categoria_sel='{$categoria}'";
                }
                $registros = $this->mbc->buscar_completo("decretos", $where);
                $this->smarty->assign('registros', $registros);
                $registros_categorias = $this->mbc->executa_sql("select * from decretos group by Categoria_sel order by Data_dat desc");
                $this->smarty->assign('registros_categorias', $registros_categorias);

                break;
            case 'publicacoes':
                $where = "where Id_int is not null ";
                if ($this->uri->segment(2)) {
                    $categoria = urldecode($this->uri->segment(2));
                    $where.=" and Categoria_sel='{$categoria}'";
                }
                $registros = $this->mbc->buscar_completo("publicacoes", $where);
                $this->smarty->assign('registros', $registros);
                $registros_categorias = $this->mbc->executa_sql("select * from publicacoes group by Categoria_sel order by Data_dat desc");
                $this->smarty->assign('registros_categorias', $registros_categorias);

                break;
            case 'resolucoes':
                $where = "where Id_int is not null ";
                if ($this->uri->segment(2)) {
                    $categoria = urldecode($this->uri->segment(2));
                    $where.=" and Categoria_sel='{$categoria}'";
                }
                $registros = $this->mbc->buscar_completo("resolucoes", $where);
                $this->smarty->assign('registros', $registros);
                $registros_categorias = $this->mbc->executa_sql("select * from resolucoes group by Categoria_sel order by Data_dat desc");
                $this->smarty->assign('registros_categorias', $registros_categorias);

                break;
            case 'atas':
                $where = "where Id_int is not null ";
                if ($this->uri->segment(2)) {
                    $categoria = urldecode($this->uri->segment(2));
                    $where.=" and Categoria_sel='{$categoria}'";
                }
                $registros = $this->mbc->buscar_completo("atas_expedidas", $where);
                $this->smarty->assign('registros', $registros);
                $registros_categorias = $this->mbc->executa_sql("select * from atas_expedidas group by Categoria_sel order by Data_dat desc");
                $this->smarty->assign('registros_categorias', $registros_categorias);

                break;
            case 'pautas':
                $where = "where Id_int is not null ";
                if ($this->uri->segment(2)) {
                    $categoria = urldecode($this->uri->segment(2));
                    $where.=" and Categoria_sel='{$categoria}'";
                }
                $registros = $this->mbc->buscar_completo("pautas", $where);
                $this->smarty->assign('registros', $registros);
                $registros_categorias = $this->mbc->executa_sql("select * from pautas group by Categoria_sel order by Data_dat desc");
                $this->smarty->assign('registros_categorias', $registros_categorias);

                break;
            case 'hinos':
                $where = "where Id_int is not null order by Titulo_txf ";
                $registros = $this->mbc->buscar_completo("hinos", $where);
                $this->smarty->assign('registros', $registros);
                break;
            case 'departamentos':
                $where = "where Id_int is not null order by Funcao_txf, Nome_txf ";
                $registros = $this->mbc->buscar_completo("funcionarios", $where);
                $this->smarty->assign('registros', $registros);
                break;
            case 'contas':
                $where = "where Id_int is not null ";
                if ($this->uri->segment(2)) {
                    $ano = urldecode($this->uri->segment(2));
                    $where.=" and Ano_sel='{$ano}'";
                }

                if ($this->uri->segment(3)) {
                    $tipo = urldecode($this->uri->segment(3));
                    $where.=" and Tipo_sel='{$tipo}'";
                }

                $registros = $this->mbc->buscar_completo("contas_publicas", "$where order by Ano_sel desc, Tipo_sel");
                $this->smarty->assign('registros', $registros);
                $registros_anos = $this->mbc->executa_sql("select * from contas_publicas group by Ano_sel order by Ano_sel desc");
                $this->smarty->assign('registros_anos', $registros_anos);

                if ($this->uri->segment(2)) {
                    $where = "where Id_int is not null ";
                    $ano = urldecode($this->uri->segment(2));
                    $where.=" and Ano_sel='{$ano}'";
                    $registros_tipos = $this->mbc->executa_sql("select * from contas_publicas $where group by Tipo_sel order by Tipo_sel");
                    $this->smarty->assign('registros_tipos', $registros_tipos);
                }


                break;
            case 'ex_prefeitos':
                $where = "where Id_int is not null ";
                if ($this->uri->segment(2)) {
                    $periodo = urldecode($this->uri->segment(2));
                    $where.=" and Periodo_sel='{$periodo}'";
                }
                $ordenacao = $this->ordenacao('ex_prefeitos');
                $registros = $this->mbc->buscar_completo("ex_prefeitos", "$where $ordenacao Politico_sel");
                foreach ($registros as $registro) {
                    $politico = $this->mbc->buscar_completo("politicos", "where Nome_txf='{$registro->Politico_sel}'");
                    $registro->Politico = $politico[0];
                }
                $this->smarty->assign('registros', $registros);
                $registros_categorias = $this->mbc->executa_sql("select * from ex_prefeitos group by Periodo_sel order by Periodo_sel desc");
                $this->smarty->assign('registros_categorias', $registros_categorias);
                break;
            case 'ex_presidentes':
                $where = "where Id_int is not null ";
                if ($this->uri->segment(2)) {
                    $periodo = urldecode($this->uri->segment(2));
                    $where.=" and Periodo_sel='{$periodo}'";
                }
                $registros = $this->mbc->buscar_completo("ex_presidentes", "$where order by Politico_sel");
                foreach ($registros as $registro) {
                    $politico = $this->mbc->buscar_completo("politicos", "where Nome_txf='{$registro->Politico_sel}'");
                    $registro->Politico = $politico[0];
                }
                $this->smarty->assign('registros', $registros);
                $registros_categorias = $this->mbc->executa_sql("select * from ex_presidentes group by Periodo_sel order by Periodo_sel desc");
                $this->smarty->assign('registros_categorias', $registros_categorias);
                break;
            case 'ex_vereadores':
                $where = "where Id_int is not null ";
                if ($this->uri->segment(2)) {
                    $periodo = urldecode($this->uri->segment(2));
                    $where.=" and Periodo_sel='{$periodo}'";
                }
                $registros = $this->mbc->buscar_completo("ex_vereadores", "$where order by Politico_sel");
                foreach ($registros as $registro) {
                    $politico = $this->mbc->buscar_completo("politicos", "where Nome_txf='{$registro->Politico_sel}'");
                    $registro->Politico = $politico[0];
                }
                $this->smarty->assign('registros', $registros);
                $registros_categorias = $this->mbc->executa_sql("select * from ex_vereadores group by Periodo_sel order by Periodo_sel desc");
                $this->smarty->assign('registros_categorias', $registros_categorias);
                break;
            case 'vereadores':
                $registros = $this->mbc->buscar_completo("vereadores", "order by Politico_sel");
                foreach ($registros as $registro) {
                    $politico = $this->mbc->buscar_completo("politicos", "where Nome_txf='{$registro->Politico_sel}'");
                    $registro->Politico = $politico[0];
                }
                $this->smarty->assign('registros', $registros);

                break;
                  case 'prefeitos':
                $registros = $this->mbc->buscar_completo("prefeitos", "order by Politico_sel");
                foreach ($registros as $registro) {
                    $politico = $this->mbc->buscar_completo("politicos", "where Nome_txf='{$registro->Politico_sel}'");
                    $registro->Politico = $politico[0];
                }
                $this->smarty->assign('registros', $registros);

                break;
            case 'mesa_diretora':
                $registros = $this->mbc->buscar_completo("mesa_diretora", "order by Ordenacao_txf, Politico_sel");
                foreach ($registros as $registro) {
                    $politico = $this->mbc->buscar_completo("politicos", "where Nome_txf='{$registro->Politico_sel}'");
                    $registro->Politico = $politico[0];
                }
                $this->smarty->assign('registros', $registros);

                break;
            case 'comissoes':
                $where = "where Id_int is not null ";

                if ($this->uri->segment(2)) {

                    $id = urldecode($this->uri->segment(2));
                    $reg = $this->mbc->buscar_tudo("comissoes", "where Id_int=$id");

                    $periodo = $reg[0]->Comissao_sel;
                    $where.=" and Comissao_sel='{$periodo}'";
                }

                $registros = $this->mbc->buscar_completo("comissoes", "$where order by Ordenacao_txf, Politico_sel");
                foreach ($registros as $registro) {
                    $politico = $this->mbc->buscar_completo("politicos", "where Nome_txf='{$registro->Politico_sel}'");
                    $registro->Politico = $politico[0];
                }
                $this->smarty->assign('registros', $registros);
                $registros_categorias = $this->mbc->executa_sql("select * from comissoes group by Comissao_sel order by Comissao_sel");
                $this->smarty->assign('registros_categorias', $registros_categorias);
                break;
            case 'proposicoes':
                $where = "where Id_int is not null ";
                if ($this->uri->segment(2)) {
                    $ano = urldecode($this->uri->segment(2));
                    $where.=" and Ano_sel='{$ano}'";
                }

                if ($this->uri->segment(3)) {
                    $tipo = urldecode($this->uri->segment(3));
                    $where.=" and Tipo_sel='{$tipo}'";
                }

                $registros = $this->mbc->buscar_completo("proposicoes", "$where order by Data_dat desc, Tipo_sel");
                $this->smarty->assign('registros', $registros);
                $registros_anos = $this->mbc->executa_sql("select * from proposicoes group by Ano_sel order by Ano_sel desc");
                $this->smarty->assign('registros_anos', $registros_anos);

                if ($this->uri->segment(2)) {
                    $where = "where Id_int is not null ";
                    $ano = urldecode($this->uri->segment(2));
                    $where.=" and Ano_sel='{$ano}'";
                    $registros_tipos = $this->mbc->executa_sql("select * from proposicoes $where group by Tipo_sel order by Tipo_sel");
                    $this->smarty->assign('registros_tipos', $registros_tipos);
                }


                break;
            case 'projetos':
                $where = "where Id_int is not null ";
                if ($this->uri->segment(2)) {
                    $ano = urldecode($this->uri->segment(2));
                    $where.=" and Ano_sel='{$ano}'";
                }

                if ($this->uri->segment(3)) {
                    $tipo = urldecode($this->uri->segment(3));
                    $where.=" and Tipo_sel='{$tipo}'";
                }

                $registros = $this->mbc->buscar_completo("projetos", "$where order by Data_dat desc, Tipo_sel");
                $this->smarty->assign('registros', $registros);
                $registros_anos = $this->mbc->executa_sql("select * from projetos group by Ano_sel order by Ano_sel desc");
                $this->smarty->assign('registros_anos', $registros_anos);

                if ($this->uri->segment(2)) {
                    $where = "where Id_int is not null ";
                    $ano = urldecode($this->uri->segment(2));
                    $where.=" and Ano_sel='{$ano}'";
                    $registros_tipos = $this->mbc->executa_sql("select * from projetos $where group by Tipo_sel order by Tipo_sel");
                    $this->smarty->assign('registros_tipos', $registros_tipos);
                }


                break;
            case 'noticias':

                $registros = $this->mbc->valores_paginacao_generic($this->app, $this->pagina_atual, 'noticias', "where Ativo_sel='SIM' and data_dat <= CURRENT_DATE() order by Data_dat desc, Id_int desc", (intval($this->uri->segment(2) > 0)) ? intval($this->uri->segment(2)) : '1', '5');
//                        $sql = "select * from post where Categoria_sel = '" . $cat . "' order by Data_dat desc";

                $this->smarty->assign('registros', $registros->registros);
                if (isset($registros->paginacao)) {
                    $this->smarty->assign('paginacao', $registros->paginacao);
                }
                $this->model_smarty->carrega_bloco('noticias', 'noticias', $this->app->Template_txf);
                break;
            case 'noticias_categorias':

                $cat = urldecode($this->uri->segment(2));
//                        $sql = "select * from post where Categoria_sel = '" . $cat . "' order by Data_dat desc";
                $registros = $this->mbc->valores_paginacao_generic($this->app, $this->pagina_atual, 'noticias', "where Ativo_sel='SIM' and Categoria_sel = '" . $cat . "' and data_dat <= CURRENT_DATE() order by Data_dat desc", (intval($this->uri->segment(3) > 0)) ? intval($this->uri->segment(3)) : '1', '5', $cat);

//                        $sql = "select * from post where Categoria_sel = '" . $cat . "' order by Data_dat desc";

                $this->smarty->assign('registros', $registros->registros);
                if (isset($registros->paginacao)) {
                    $this->smarty->assign('paginacao', $registros->paginacao);
                }

                $this->model_smarty->carrega_bloco('noticias', 'noticias', $this->app->Template_txf);
                break;
            case 'noticia':
                $where = "where Id_int is not null ";

                if ($this->uri->segment(2)) {
                    $id = urldecode($this->uri->segment(2));
                    $where.=" and Id_int='{$id}'";
                } else {
                    redireciona('noticias');
                }

                $registros = $this->mbc->buscar_completo("noticias", $where);
                $this->smarty->assign('registros', $registros);



                $registros_ultimos = $this->mbc->executa_sql("select * from noticias where Ativo_sel='SIM' and data_dat <= CURRENT_DATE() and Id_int!={$id} order by Data_dat desc, Id_int desc limit 6");
                $this->smarty->assign('registros_ultimos', $registros_ultimos);

                $this->model_smarty->carrega_bloco('social', 'social', $this->app->Template_txf);

                break;
            case 'perfil':
                $where = "where Id_int is not null ";
                $where2 = "where Id_int is not null ";
                if ($this->uri->segment(2)) {
                    $id = urldecode($this->uri->segment(2));
                    $where.=" and Id_int='{$id}'";
                    $where2.=" and Id_int!='{$id}'";
                }


                $registros = $this->mbc->buscar_completo("politicos", $where);

                $this->smarty->assign('registros', $registros);
                $registros_outros = $this->mbc->executa_sql("select * from politicos {$where2} order by Rand() limit 6");
                $this->smarty->assign('registros_outros', $registros_outros);

                $this->model_smarty->carrega_bloco('social', 'social', $this->app->Template_txf);

                break;
            case 'galerias':
                $where = "where Ativo_sel='SIM' ";
                $registros = $this->mbc->buscar_completo("galerias", $where . " order by Data_dat desc");
                $this->smarty->assign('registros', $registros);
                break;
            case 'galeria':
                $where = "where Id_int is not null ";
                if ($this->uri->segment(2)) {
                    $id = urldecode($this->uri->segment(2));
                    $where.=" and Id_int='{$id}'";
                } else {
                    redireciona("galerias");
                }
                $registros = $this->mbc->buscar_completo("galerias", $where);
                $this->smarty->assign('registros', $registros);

                $registros_categorias = $this->mbc->executa_sql("select * from galerias where Ativo_sel='SIM' order by Data_dat desc");
                $this->smarty->assign('registros_categorias', $registros_categorias);
                break;
            case 'videos':
                $where = "where Id_int is not null ";
                if ($this->uri->segment(2)) {
                    $ano = urldecode($this->uri->segment(2));
                    $where.=" and Categoria_sel='{$ano}'";
                }
                $registros = $this->mbc->buscar_completo("galeria_videos", "$where order by Data_dat desc, Categoria_sel");
                $this->smarty->assign('registros', $registros);
                $registros_categorias = $this->mbc->executa_sql("select * from galeria_videos group by Categoria_sel order by Categoria_sel");
                $this->smarty->assign('registros_categorias', $registros_categorias);
                break;
        }
    }

}
