<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_blog.php');

class blog_avancado extends lands_core {

    public $modulo = 'blog';
    public $configuracoes;

    public function __construct() {
        parent::__construct();
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

    function ajax() {

        $pagina = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
        $this->carrega_configuracoes();
        switch ($pagina) {
            case 'posts':

                $autores = $this->mbc->buscar_completo("autores");
                $this->smarty->assign('autores', $autores);

                $ultimo_post_old = $_POST['ultimo_post'];
                $and_ultimo = '';

                if ($ultimo_post_old) {
                    $and_ultimo = " and Id_int<'{$ultimo_post_old}'";
                }
                $posts = $this->mbc->buscar_completo('post', "where Ativo_sel='SIM' $and_ultimo order by Data_dat desc, Id_int desc limit {$this->configuracoes->Qtd_posts_inicio_txf}");
                $this->smarty->assign('posts', $posts);

                $tags = $this->mbc->executa_sql("select * from tags where Tabela_con='post'");
                $this->smarty->assign('tags', $tags);

                $ultimo_post = $posts[$this->configuracoes->Qtd_posts_inicio_txf - 1]->Id_int;
                $this->smarty->assign('ultimo_post', $ultimo_post);
                $this->model_smarty->render_ajax('posts', $this->app->Template_txf);

//                $ultimo_post=$posts[$this->configuracoes->Qtd_posts_inicio_txf - 1]->Id_int;
//                $this->session->set_userdata('ultimo_post', $posts[$this->configuracoes->Qtd_posts_inicio_txf - 1]->Id_int);
//                ver($posts);


                die();

                break;
        }
    }

    function nomes_navegacao($pagina) {
        $nome_pagina = $pagina;
        switch ($pagina) {
            case 'inicio':
                $nome_pagina = 'Início';
                break;
            case 'lista_posts':
                $nome_pagina = 'Lista categoria';
                break;

            case 'lista_tags':
                $nome_pagina = 'Lista tag';
                break;

            case 'lista_todas_tags':
                $nome_pagina = 'Lista de tags';
                break;

            case 'lista_categorias':
                $nome_pagina = 'Lista de categorias';
                break;
            case 'lista_recentes':
                $nome_pagina = 'Posts recentes';
                break;
            case 'lista_autor':
                $nome_pagina = 'Lista autor';
                break;
        }

        $this->smarty->assign('nome_pagina', $nome_pagina);
    }

    function switch_pagina() {

        $this->smarty->assign('titulo_pagina', ucfirst($this->pagina_atual));

        $this->carrega_configuracoes();
        $this->conecta_mbc($this->app->Conexoes_for);
        $this->nomes_navegacao($this->pagina_atual);
        switch ($this->pagina_atual) {
            case 'inicio':

                $posts = $this->mbc->valores_paginacao_generic($this->app, $this->pagina_atual, 'post', "where Ativo_sel='SIM' and data_dat <= CURRENT_DATE() order by Data_dat desc, Id_int desc", (intval($this->uri->segment(2) > 0)) ? intval($this->uri->segment(2)) : '1', $this->configuracoes->Qtd_posts_inicio_txf);
                $this->smarty->assign('posts', $posts->registros);
                $this->smarty->assign('paginacao', $posts->paginacao);
                $tags = $this->mbc->executa_sql("select * from tags where Tabela_con='post'");
                $this->smarty->assign('tags', $tags);

                $ultimo_post = $posts->registros[$this->configuracoes->Qtd_posts_inicio_txf - 1]->Id_int;
                $this->smarty->assign('ultimo_post', $ultimo_post);


                break;

            case 'posts':
                if (!$this->uri->segment($this->app->Segmento_padrao_txf + 1)) {
                    redirect($this->app->Pagina_inicial_txf);
                }
                $id = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
                $posts = $this->mbc->buscar_completo("post", "where Id_int=" . $id, 'Imagens_ico');
//                        $posts = $this->mbc->buscar_completo("post", "where Ativo_sel='SIM' and Id_int=" . $id);
//ver($posts);
                if (!isset($posts[0])) {
                    redirect($this->app->Pagina_inicial_txf);
                }

                $this->smarty->assign('posts', $posts);
                $this->grava_visualizacao_post($posts[0]);
                $this->busca_visualizacoes_post($posts[0]->Id_int);
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
                $where_cat = '';
                if ($this->uri->segment($this->app->Segmento_padrao_txf + 1)) {

                    $cat = urldecode($this->uri->segment($this->app->Segmento_padrao_txf + 1));
                    $where_cat.=" and Categoria_sel='{$cat}' ";
                }

//                        $sql = "select * from post where Categoria_sel = '" . $cat . "' order by Data_dat desc";

                $wheresub = '';
                if ($this->uri->segment($this->app->Segmento_padrao_txf + 2)) {

                    if ($this->mbc->campoexiste('Subcategoria_sel', 'post')) {
                        $sub = urldecode($this->uri->segment($this->app->Segmento_padrao_txf + 2));
                        $wheresub = " and Subcategoria_sel='{$sub}'";
                    }
                }

                $posts = $this->mbc->valores_paginacao_generic($this->app, $this->pagina_atual, 'post', "where Ativo_sel='SIM'  {$where_cat} {$wheresub} and data_dat <= CURRENT_DATE() order by Data_dat desc", (intval($this->uri->segment(3) > 0)) ? intval($this->uri->segment(3)) : '1', $this->configuracoes->Qtd_posts_lista_txf, $cat);

                $this->smarty->assign('lista_posts', $posts->registros);
                $this->smarty->assign('posts', $posts->registros);
                if (isset($posts->paginacao)) {
                    $this->smarty->assign('paginacao', $posts->paginacao);
                }

                $this->smarty->assign('titulo_pagina', 'Posts da categoria "' . $cat . '"');
                break;

            case 'exibe_categoria':
//                        $cat = str_replace("_", " ", $this->uri->segment($this->app->Segmento_padrao_txf + 1));
                //                      $cat = str_replace("-", " ", $cat);
                $cat = urldecode($this->uri->segment($this->app->Segmento_padrao_txf + 1));

                $wheresub = '';
                if ($this->uri->segment($this->app->Segmento_padrao_txf + 2)) {

                    if ($this->mbc->campoexiste('Subcategoria_sel', 'post')) {
                        $sub = urldecode($this->uri->segment($this->app->Segmento_padrao_txf + 2));
                        $wheresub = " and Subcategoria_sel='{$sub}'";
                    }
                }


//                        $sql = "select * from post where Categoria_sel = '" . $cat . "' order by Data_dat desc";
                $posts = $this->mbc->valores_paginacao_generic($this->app, $this->pagina_atual, 'post', "where Ativo_sel='SIM' and Categoria_sel = '" . $cat . "' {$wheresub} and data_dat <= CURRENT_DATE() order by Data_dat desc", (intval($this->uri->segment(3) > 0)) ? intval($this->uri->segment(3)) : '1', $this->configuracoes->Qtd_posts_inicio_txf, $cat);
                $this->smarty->assign('posts', $posts->registros);
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

//                ver($_POST);
                if (!isset($_POST['valor'])) {
                    redirect($this->app->Pagina_inicial_txf);
                }
            
                
                $resultado['post'] = $this->mbc->busca_posts("post", $_POST['valor']);
                
                $resultado['tags'] = $this->mbc->get_busca("tags", $_POST['valor']);
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
                $this->smarty->assign('posts', $posts->registros);
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
                $this->smarty->assign('titulo_pagina', 'Perfil - ' . $perfil[0]->Nome_txf);
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
        }
        $this->carrega_itens_obrigatorios();
    }

    function grava_visualizacao_post($post) {
//        if (!is_lands()) {
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
//        }
    }

    function busca_visualizacoes_post($id) {
        if ($this->mbc->tabelaexiste('visualizacoes')) {
            $sql = "select COUNT(*) as total, v.* from visualizacoes v where v.Id_objeto_con={$id} group by  v.Id_objeto_con";
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


        if ($this->mbc->tabelaexiste('texto_rodape')) {

            $texto_rodape = $this->mbc->buscar_completo('texto_rodape');
            $this->smarty->assign('texto_rodape', $texto_rodape);
        }
        if ($this->mbc->tabelaexiste('redes_sociais')) {
            $redes_sociais = $this->mbc->buscar_completo('redes_sociais');
            $this->smarty->assign('redes_sociais', $redes_sociais);
        }

        if ($this->mbc->tabelaexiste('contato')) {
            $contato = $this->mbc->buscar_completo('contato');
            $this->smarty->assign('contato', $contato);
        }
        if ($this->mbc->tabelaexiste('departamentos')) {
            $departamentos = $this->mbc->buscar_completo('departamentos');
            $this->smarty->assign('departamentos', $departamentos);
        }

//            //Carrega lista de categorias completa
//            $categorias = $this->mbc->executa_sql("select COUNT(*) as total, t.* from post t where t.Ativo_sel='SIM' and Data_dat <= CURRENT_DATE() group by t.Categoria_sel order by total desc");
//            $this->smarty->assign('todas_categorias', $categorias);
//Carrega lista de categorias no menu da direita
        $categorias_direita = $this->mbc->executa_sql("select COUNT(*) as total, t.* from post t where t.Ativo_sel='SIM' and Data_dat <= CURRENT_DATE() group by t.Categoria_sel order by total desc limit {$this->configuracoes->Qtd_categorias_direita_txf}");
        $this->smarty->assign('categorias_direita', $categorias_direita);
        $this->model_smarty->carrega_bloco('categorias_direita', 'categorias_direita', $this->app->Template_txf);





        if ($this->app->Lands_id == 'guguphotoblog') {
            $sql = "SELECT  COUNT(DISTINCT Id_int) AS Total, Id_objeto_con, Titulo_txf FROM visualizacoes GROUP BY Id_objeto_con order by Total desc limit 12";
            $ids = $this->mbc->executa_sql($sql);
            $mais_vistos = array();
            foreach ($ids as $id) {

                $postagem = $this->mbc->buscar_completo('post', "where Id_int={$id->Id_objeto_con}");

                if ($postagem[0]) {
                    $mais_vistos[] = $postagem[0];
                }
            }


            $this->smarty->assign('mais_vistos', $mais_vistos);
        }




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
        $anos = $this->mbc->executa_sql("SELECT  distinct DATE_FORMAT(p.Data_dat, '%Y') as ano FROM post p where p.Data_dat>'2013-01-01' and p.Ativo_sel='SIM' and Data_dat <= CURRENT_DATE()  order by ano desc");
        $this->smarty->assign('anos', $anos);

        foreach ($anos as $ano) {
            if ($ano->ano >= '2014') {
                $meses = $this->mbc->executa_sql("SELECT distinct MONTHNAME(p.Data_dat) as mes FROM post p where DATE_FORMAT(p.Data_dat, '%Y')='$ano->ano' order by p.Data_dat desc ");

                foreach ($meses as $mes) {
                    $postagens[$ano->ano][$mes->mes] = $this->mbc->executa_sql("select p.Titulo_txf, p.Id_int, p.Data_dat  from post p where DATE_FORMAT(p.Data_dat, '%Y')='$ano->ano' and MONTHNAME(p.Data_dat)='$mes->mes'");
                }
            }
        }

//          ver($postagens);



        $this->smarty->assign('postagens', $postagens);


        //Carrega lista de arquivo no menu da direita
        $arquivos_direita = $this->mbc->executa_sql("select * from post where Ativo_sel='SIM' and Data_dat <= CURRENT_DATE() group by Data_dat");
        $this->smarty->assign('arquivos_direita', $arquivos_direita);
        $this->model_smarty->carrega_bloco('arquivos_direita', 'arquivos_direita', $this->app->Template_txf);
    }

}

?>