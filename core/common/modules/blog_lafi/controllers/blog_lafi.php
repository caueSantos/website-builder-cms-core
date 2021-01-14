<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_blog.php');

class blog_lafi extends lands_core {

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



        $agendas_incompletas = $this->mbc->executa_sql("select * from agendas where Id_int is not null {$filtro_agenda} {$this->filtrodata}  {$where_cursos} order by Data_inicio_dat");

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
            if ($agenda->Data_inicio_dat == $agenda->Data_fim_dat || $agenda->Data_fim_dat == '') {
                $agenda->Data = arruma_data($agenda->Data_inicio_dat);
            } else {
                $agenda->Data = arruma_data($agenda->Data_inicio_dat) . " à " . arruma_data($agenda->Data_fim_dat);
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

        $this->carrega_configuracoes();
        $this->conecta_mbc($this->app->Conexoes_for);

        switch ($this->pagina_atual) {
            case 'inicio':

                $posts = $this->mbc->valores_paginacao_generic($this->app, $this->pagina_atual, 'post', "where Ativo_sel='SIM' and data_dat <= CURRENT_DATE() order by Data_dat desc, Id_int desc", (intval($this->uri->segment(2) > 0)) ? intval($this->uri->segment(2)) : '1', $this->configuracoes->Qtd_posts_inicio_txf);
                $this->smarty->assign('posts', $posts->registros);
                $this->smarty->assign('paginacao', $posts->paginacao);
                $tags = $this->mbc->executa_sql("select * from tags where Tabela_con='post'");
                $this->smarty->assign('tags', $tags);

                break;

            case 'posts':
                if (!$this->uri->segment($this->app->Segmento_padrao_txf + 1)) {
                    redirect($this->app->Pagina_inicial_txf);
                }
                $id = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
                $posts = $this->mbc->buscar_completo("post", "where Ativo_sel='SIM' and Id_int=" . $id);
//ver($posts);
                if (!isset($posts[0])) {
                    redirect($this->app->Pagina_inicial_txf);
                }

                $this->smarty->assign('posts', $posts);
                $this->grava_visualizacao_post($posts[0]);
                $this->busca_visualizacoes($posts[0]->Id_int, 'post');
//    $categoria = $posts[0]->Categoria_sel;
//$posts_relacionados = $this->mbc->buscar_completo("post", "where Ativo_sel='SIM' and Categoria_sel='$categoria' and Data_dat <= CURRENT_DATE()  and Id_int!=$id order by Data_dat desc limit {$this->configuracoes->Qtd_relacionados_txf}");
                $where = "where Ativo_sel='SIM'  and Data_dat <= CURRENT_DATE()  and Data_dat<= '{$posts[0]->Data_dat}'  and Id_int!=$id order by Data_dat desc limit {$this->configuracoes->Qtd_relacionados_txf}";

                $posts_relacionados = $this->mbc->buscar_completo("post", $where);
//                        ver($posts_relacionados);

                $this->smarty->assign('posts_relacionados', $posts_relacionados);
                $this->model_smarty->carrega_bloco('posts_relacionados', 'posts_relacionados', $this->app->Template_txf);
             


                $this->model_smarty->carrega_bloco('post_anexos', 'post_anexos', $this->app->Template_txf);
                break;

            case 'lista_recentes':

                $posts = $this->mbc->valores_paginacao_generic($this->app, $this->pagina_atual, 'post', "where Ativo_sel='SIM' and data_dat <= CURRENT_DATE() order by Data_dat desc, Id_int desc ", (intval($this->uri->segment(2) > 0)) ? intval($this->uri->segment(2)) : '1', $this->configuracoes->Qtd_posts_lista_txf);


                $this->smarty->assign('lista_posts', $posts->registros);
                $this->smarty->assign('paginacao', $posts->paginacao);
                $this->smarty->assign('titulo_pagina', 'Posts recentes');
                break;

            case 'lista_categorias':

                $categorias = $this->mbc->executa_sql("select COUNT(*) as total,t.Categoria_sel from post t where t.Ativo_sel='SIM' and Data_dat <= CURRENT_DATE() group by  t.Categoria_sel order by total desc, t.Data_dat desc, t.Id_int desc ");
                foreach ($categorias as $categ) {

                    $post = $this->mbc->buscar_completo("post", "where Ativo_sel='SIM' and Data_dat <= CURRENT_DATE() and Categoria_sel='{$categ->Categoria_sel}' order by Data_dat desc, Id_int desc limit 1");
                    $post[0]->total = $categ->total;
                    $categorias_lista[] = $post[0];
                }

                $this->smarty->assign('categorias_lista', $categorias_lista);
                $this->smarty->assign('titulo_pagina', 'Lista de Categorias');
                break;

            case 'lista_posts':
//                        $cat = str_replace("_", " ", $this->uri->segment($this->app->Segmento_padrao_txf + 1));
//                      $cat = str_replace("-", " ", $cat);
                $cat = urldecode($this->uri->segment($this->app->Segmento_padrao_txf + 1));
//                        $sql = "select * from post where Categoria_sel = '" . $cat . "' order by Data_dat desc";
                $posts = $this->mbc->valores_paginacao_generic($this->app, $this->pagina_atual, 'post', "where Ativo_sel='SIM' and Categoria_sel = '" . $cat . "' and data_dat <= CURRENT_DATE() order by Data_dat desc", (intval($this->uri->segment(3) > 0)) ? intval($this->uri->segment(3)) : '1', $this->configuracoes->Qtd_posts_lista_txf, $cat);
                $this->smarty->assign('lista_posts', $posts->registros);
                if (isset($posts->paginacao)) {
                    $this->smarty->assign('paginacao', $posts->paginacao);
                }

                $this->smarty->assign('titulo_pagina', 'Posts da categoria "' . $cat . '"');
                break;


            case 'lista_todas_tags':
                $sql = "select COUNT(*) as total, t.Id_int, t.Nome_txf, p.Data_dat from tags t left outer join post p on p.Id_int=t.Id_objeto_con where p.Ativo_sel='SIM' and p.Data_dat <= CURRENT_DATE() group by Nome_txf order by total desc, t.Nome_txf";
                $temp_tags = $this->mbc->executa_sql($sql);
                $tag_list = $this->mbc->complementa_registros($temp_tags, 'post');
                $this->smarty->assign('tag_list', $tag_list);
                $this->smarty->assign('titulo_pagina', 'Lista de Tags');

                break;

            case 'lista_tags':
//                        $tag = str_replace("_", " ", $this->uri->segment($this->app->Segmento_padrao_txf + 2));
//                        $tag = str_replace("-", " ", $tag);
                $tag = urldecode($this->uri->segment($this->app->Segmento_padrao_txf + 2));
                $sql = "select p.* from post p right outer join tags t on p.Id_int = t.Id_objeto_con 
	                        where t.Nome_txf='" . $tag . "' and p.Ativo_sel='SIM' order by p.Data_dat desc";
                $temp_tags = $this->mbc->executa_sql($sql);
                $posts_tags = $this->mbc->complementa_registros($temp_tags, 'post');

                $this->smarty->assign('posts_tags', $posts_tags);
                $this->smarty->assign('titulo_pagina', 'Posts com a tag "' . $tag . '"');
                break;

            case 'lista_data':
                if (!$this->uri->segment($this->app->Segmento_padrao_txf + 1)) {
                    redirect($this->app->Pagina_inicial_txf);
                }
                $sql = "select * from post where   Ativo_sel='SIM'  and Data_dat = '" . $this->uri->segment($this->app->Segmento_padrao_txf + 1) . "'";

                $temp_post = $this->mbc->executa_sql($sql);
                $lista_data = $this->mbc->complementa_registros($temp_post, 'post');

                $this->smarty->assign('lista_data', $lista_data);
                $this->smarty->assign('titulo_pagina', 'Posts na data ' . arruma_data($this->uri->segment($this->app->Segmento_padrao_txf + 1)));
                break;

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

            case 'lista_autor':
                if (!$this->uri->segment($this->app->Segmento_padrao_txf + 1)) {
                    redirect($this->app->Pagina_inicial_txf);
                }

                $autor = str_replace("_", " ", $this->uri->segment($this->app->Segmento_padrao_txf + 1));
                $autor = str_replace("-", " ", $autor);
                $autor = urldecode($this->uri->segment($this->app->Segmento_padrao_txf + 1));

// $sql = "select * from post where Autor_sel='$autor' order by Data_dat desc";
                $posts = $this->mbc->valores_paginacao_generic($this->app, $this->pagina_atual, 'post', "where Ativo_sel='SIM' and Autor_sel='$autor' and data_dat <= CURRENT_DATE() order by Data_dat desc", (intval($this->uri->segment(3) > 0)) ? intval($this->uri->segment(3)) : '1', $this->configuracoes->Qtd_posts_lista_txf, $autor);

                $this->smarty->assign('lista_autor', $posts->registros);
                if (isset($posts->paginacao)) {
                    $this->smarty->assign('paginacao', $posts->paginacao);
                }

//$lista_autor = $this->mbc->executa_sql($sql);
//$lista_autor = $this->mbc->executa_sql($sql);

                $perfil = $this->mbc->buscar_completo("autor_perfil", "where Autor_sel='$autor'");
                if (isset($perfil[0]->Id_int)) {
                    $this->smarty->assign('autor_perfil', $perfil);
                    $this->model_smarty->carrega_bloco('autor_perfil', 'autor_perfil', $this->app->Template_txf);
                }

                $this->smarty->assign('autor', $autor);
//    $this->smarty->assign('lista_autor', $lista_autor);
                $this->smarty->assign('titulo_pagina', 'Perfil do Autor');
                break;

            case 'arquivos':
                $mes = $this->uri->segment(4);
                if ($mes == 'mar%C3%A7o') {
                    $mes = 'março';
                }
                $ano = $this->uri->segment(3);
                $data_dat = $this->uri->segment(2);
                $sql = "select p.* from post p where  p.Ativo_sel='SIM'  and YEAR(p.Data_dat)=YEAR('$data_dat') and MONTHNAME(p.Data_dat) = MONTHNAME('$data_dat') and Data_dat <= CURRENT_DATE() order by Data_dat desc";
                $this->smarty->assign('mes', $mes);
                $this->smarty->assign('ano', $ano);
                $this->smarty->assign('ano_dat', $data_dat);

                $temp_posts = $this->mbc->executa_sql($sql);

                if (isset($temp_posts[0])) {
                    $arquivos = $this->mbc->complementa_registros($temp_posts, 'post');
                    $this->smarty->assign('arquivos', $arquivos);
                }
                $this->smarty->assign('titulo_pagina', 'Posts de "' . $mes . '/' . $ano . '"');
                break;

            case 'cursos':

//                if ($this->usuario) {
                    $this->pagina_cursos_nova();
//                } else {
//                    $this->pagina_cursos();
//                }

                break;

            case 'agenda':
                $where = "  Ativo_sel='SIM' ";
                $tipo_agenda = $this->mbc->buscar_completo("tipos_agenda", "where {$where}");
                foreach ($tipo_agenda as $curso) {
                    $sql = "select  t.* from agendas t  where t.Ativo_sel='SIM' {$this->filtrodata} and  Tipo_agenda_sel='{$curso->Url_amigavel_txf}' ";
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
                $this->smarty->assign('categorias_lista', $categorias_lista);
                $this->smarty->assign('titulo_pagina', 'Cursos e Eventos Lafi Profissional');
                $this->model_smarty->carrega_bloco('filtros_agenda', 'filtros_agenda', $this->app->Template_txf);
                $this->model_smarty->carrega_bloco('lista_cursos', 'lista_cursos', $this->app->Template_txf);
                break;
            case 'curso_evento':
                $filtra_agenda = TRUE;
                $this->busca_curso_evento($filtra_agenda);


                break;

            case 'lafi_no_seu_salao':
                $conteudo = $this->mbc->buscar_completo("lafi_no_seu_salao");

                $this->smarty->assign('conteudo', $conteudo);

                $this->smarty->assign('titulo_pagina', 'Lafi no seu salão');


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
//    $categoria = $posts[0]->Categoria_sel;
//$posts_relacionados = $this->mbc->buscar_completo("post", "where Ativo_sel='SIM' and Categoria_sel='$categoria' and Data_dat <= CURRENT_DATE()  and Id_int!=$id order by Data_dat desc limit {$this->configuracoes->Qtd_relacionados_txf}");
                /*
                  $where = "where Ativo_sel='SIM'  and Data_dat >= CURRENT_DATE()  and Data_dat<= '{$posts[0]->Data_dat}'  and Id_int!=$id order by Data_dat desc limit {$this->configuracoes->Qtd_relacionados_txf}";
                  $posts_relacionados = $this->mbc->buscar_completo("cursos", $where);
                  $this->smarty->assign('posts_relacionados', $posts_relacionados);
                  $this->model_smarty->carrega_bloco('posts_relacionados', 'posts_relacionados', $this->app->Template_txf);
                  $this->model_smarty->carrega_bloco('post_anexos', 'post_anexos', $this->app->Template_txf);
                 */
                break;
        }
        $this->carrega_itens_obrigatorios();
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

    function pagina_cursos_nova() {

        $tipo_agenda = $this->mbc->buscar_completo("tipos_agenda", "where Ativo_sel='SIM'");

        $cursos_eventos = $this->mbc->buscar_completo("cursos_eventos", "where Id_int is not null order by Nome_txf");


//                foreach ($cursos_eventos as $curso) {
//
//                    $sql = "select  t.* from agendas t  where t.Ativo_sel='SIM' {$this->filtrodata} and Cursos_eventos_sel='{$curso->Url_amigavel_txf}' ";
//
//                    $total = $this->mbc->executa_sql($sql);
//
//                    if ($total[0]->Id_int) {
//                        $curso->total = count($total);
//                        $cursos_novos[] = $curso;
//                    } else {
//                        $curso->total = 0;
//                    }
//                } 

        $this->smarty->assign('tipo_agenda', $tipo_agenda);
        $this->smarty->assign('cursos_eventos', $cursos_eventos);
        $this->smarty->assign('categorias_lista', $categorias_lista);
        $this->smarty->assign('titulo_pagina', 'Cursos e Eventos Lafi Profissional');
        $this->model_smarty->carrega_bloco('filtros_agenda', 'filtros_agenda_novo', $this->app->Template_txf);
        $this->model_smarty->carrega_bloco('lista_cursos', 'lista_cursos', $this->app->Template_txf);
        $this->pagina_atual = 'cursos_novo';
    }

    function pagina_cursos() {
        $where = "  Ativo_sel='SIM' ";
        $where2 = "  Ativo_sel='SIM' ";
        if ($this->uri->segment($this->app->Segmento_padrao_txf + 1)) {
            $url_categoria = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
            $where.="and Tipo_agenda_sel='$url_categoria' ";
            $where2.="and  Url_amigavel_txf='$url_categoria'";
        }

        $tipo_agenda = $this->mbc->buscar_completo("tipos_agenda", "where {$where2}");


        foreach ($tipo_agenda as $curso) {
// $sql = "select  t.* from cursos_eventos t  where t.Ativo_sel='SIM'  and Tipo_agenda_sel='{$curso->Url_amigavel_txf}' group by t.Nome_txf ";
            $sql = "select  t.* from agendas t  where t.Ativo_sel='SIM' {$this->filtrodata} and  Tipo_agenda_sel='{$curso->Url_amigavel_txf}' ";
            $total = $this->mbc->executa_sql($sql);

// $curso->total = count($total);
            if ($total[0]->Id_int) {
                $curso->total = count($total);
//                        $cursos_novos[] = $curso;
            } else {
                $curso->total = 0;
            }
        }


//                ver($tipo_agenda);
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

        $this->smarty->assign('tipo_agenda', $tipo_agenda);
        $this->smarty->assign('cursos_eventos', $cursos_novos);
        $this->smarty->assign('categorias_lista', $categorias_lista);
        $this->smarty->assign('titulo_pagina', 'Cursos e Eventos Lafi Profissional');
        $this->model_smarty->carrega_bloco('filtros_agenda', 'filtros_agenda', $this->app->Template_txf);
        $this->model_smarty->carrega_bloco('lista_cursos', 'lista_cursos', $this->app->Template_txf);
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

    function grava_visualizacao_post($post) {
        if (!is_lands()) {
            if ($this->mbc->tabelaexiste('visualizacoes')) {
                $visualizacoes['Ip_txf'] = $_SERVER['REMOTE_ADDR'];
                $visualizacoes['Id_objeto_con'] = $post->Id_int;
                $visualizacoes['Tabela_con'] = 'post';
                $visualizacoes['Titulo_txf'] = $post->Titulo_txf;
                $visualizacoes['Acesso_dat'] = date("Y-m-d H:i:s");
                if (isset($_REQUEST['utm_source'])) {
                    $visualizacoes['Origem_txf'] = $_REQUEST['utm_source'];
                } else {
                    $visualizacoes['Origem_txf'] = 'desconhecido';
                }
                $this->mbc->db_insert('visualizacoes', $visualizacoes);
            }
        }
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
        $tags_direita = $this->mbc->executa_sql("select COUNT(*) as total, t.Id_int, t.Nome_txf, p.Data_dat from tags t left outer join post p on p.Id_int=t.Id_objeto_con where p.Ativo_sel='SIM' and p.Data_dat <= CURRENT_DATE() group by Nome_txf order by total desc, p.Data_dat, t.Nome_txf limit {$this->configuracoes->Qtd_tags_direita_txf}");
        $this->smarty->assign('tags_direita', $tags_direita);
        $this->model_smarty->carrega_bloco('tags_direita', 'tags_direita', $this->app->Template_txf);


//            //Carrega lista de categorias completa
//            $categorias = $this->mbc->executa_sql("select COUNT(*) as total, t.* from post t where t.Ativo_sel='SIM' and Data_dat <= CURRENT_DATE() group by t.Categoria_sel order by total desc");
//            $this->smarty->assign('todas_categorias', $categorias);
//Carrega lista de categorias no menu da direita
        $categorias_direita = $this->mbc->executa_sql("select COUNT(*) as total, t.* from post t where t.Ativo_sel='SIM' and Data_dat <= CURRENT_DATE() group by t.Categoria_sel order by total desc limit {$this->configuracoes->Qtd_categorias_direita_txf}");
        $this->smarty->assign('categorias_direita', $categorias_direita);
        $this->model_smarty->carrega_bloco('categorias_direita', 'categorias_direita', $this->app->Template_txf);


/*VERSAO ANTIGA DOS CURSOS*/
//        if (!$this->usuario) {
//            $sql = "select t.* from tipos_agenda t  where t.Ativo_sel='SIM' group by t.Nome_txf order by Nome_txf";
//
//
//            $cursos_direita = $this->mbc->executa_sql($sql);
//            foreach ($cursos_direita as $curso) {
//                $sql = "select  t.* from agendas t  where t.Ativo_sel='SIM' ";
//                $sql.=$this->filtrodata;
//                $sql.=" and Tipo_agenda_sel='{$curso->Url_amigavel_txf}'";
//                $total = $this->mbc->executa_sql($sql);
//                if ($total[0]) {
//                    $curso->total = count($total);
//                } else {
//                    $curso->total = 0;
//                }
//            }
//        } else {
            $cursos_direita = $this->mbc->buscar_completo("tipos_agenda", "where Ativo_sel='SIM'");
            $cursos_eventos = $this->mbc->buscar_completo("cursos_eventos", "where Id_int is not null order by Nome_txf");
            foreach ($cursos_direita as $curso) {
                $total = conta($cursos_eventos, 'Tipo_agenda_sel', $curso->Url_amigavel_txf);
                
                    $curso->total = $total;
                
            }
//        }



        $this->smarty->assign('cursos_direita', $cursos_direita);
        $this->model_smarty->carrega_bloco('cursos_direita', 'cursos_direita', $this->app->Template_txf);
//carrega lista de autores
        $autores_direita = $this->mbc->executa_sql("select * from post where Ativo_sel='SIM' and Data_dat <= CURRENT_DATE() group by Autor_sel order by Autor_sel");
        $this->smarty->assign('autores_direita', $autores_direita);

        $this->model_smarty->carrega_bloco('autores_direita', 'autores_direita', $this->app->Template_txf);


//Carrega lista de recentes no menu da direita
        $recentes_direita = $this->mbc->buscar_completo("post", " where Ativo_sel='SIM' and Data_dat <= CURRENT_DATE() order by Data_dat desc, Id_int desc limit {$this->configuracoes->Qtd_recentes_direita_txf}");
        $this->smarty->assign('recentes_direita', $recentes_direita);
        $this->model_smarty->carrega_bloco('recentes_direita', 'recentes_direita', $this->app->Template_txf);

//carrega blogo busca
        $this->model_smarty->carrega_bloco('busca_direita', 'busca_direita', $this->app->Template_txf);
//carrega navegacao
        $this->model_smarty->carrega_bloco('navegacao', 'navegacao', $this->app->Template_txf);
//carrega social tags
        $this->model_smarty->carrega_bloco('social', 'social', $this->app->Template_txf);

//altera o idioma do banco 
        $this->mbc->seta_idioma('pt_BR');
// carrega o alista ARQUIVOS [ano][mes] o menu da direita
        $anos = $this->mbc->executa_sql("SELECT  distinct DATE_FORMAT(p.Data_dat, '%Y') as ano FROM post p where p.Data_dat>'2000-01-01' and p.Ativo_sel='SIM' and Data_dat <= CURRENT_DATE()  order by ano desc");
        $this->smarty->assign('anos', $anos);
        foreach ($anos as $ano) {
            $meses = $this->mbc->executa_sql("SELECT distinct MONTHNAME(p.Data_dat) as mes FROM post p where DATE_FORMAT(p.Data_dat, '%Y')='$ano->ano' order by p.Data_dat desc ");
            foreach ($meses as $mes) {
                $postagens[$ano->ano][$mes->mes] = $this->mbc->executa_sql("select p.*  from post p where DATE_FORMAT(p.Data_dat, '%Y')='$ano->ano' and MONTHNAME(p.Data_dat)='$mes->mes'");
            }
        }


        $this->smarty->assign('postagens', $postagens);


//Carrega lista de arquivo no menu da direita
        $arquivos_direita = $this->mbc->executa_sql("select * from post where Ativo_sel='SIM' and Data_dat <= CURRENT_DATE() group by Data_dat");
        $this->smarty->assign('arquivos_direita', $arquivos_direita);
        $this->model_smarty->carrega_bloco('arquivos_direita', 'arquivos_direita', $this->app->Template_txf);
    }

}

?>