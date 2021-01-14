<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_blog.php');

class espaco_orante extends lands_core {

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

      function switch_pagina() {


            $this->smarty->assign('titulo_pagina', ucfirst($this->pagina_atual));

            $this->carrega_configuracoes();
            $this->conecta_mbc($this->app->Conexoes_for);
            switch ($this->pagina_atual) {
                  case 'inicio':
                        /* busca oracoes */
                        /*
                          $posts = $this->mbc->valores_paginacao_generic($this->app, $this->pagina_atual, 'post', "where Ativo_sel='SIM' and data_dat <= CURRENT_DATE() order by Data_dat desc, Id_int desc", (intval($this->uri->segment(2) > 0)) ? intval($this->uri->segment(2)) : '1', $this->configuracoes->Qtd_posts_inicio_txf);
                          $this->smarty->assign('posts', $posts->registros);
                          $this->smarty->assign('paginacao', $posts->paginacao);
                          $tags = $this->mbc->executa_sql("select * from tags where Tabela_con='post'");
                          $this->smarty->assign('tags', $tags);
                         * 
                         */


                        //BUSCA SANTO DO DIA
                        $dia = date('d');
                        $mes = date('m');
                        $this->smarty->assign('mes', $mes);
                        $this->smarty->assign('dia', $dia);
                        $santos = $this->mbc->buscar_completo("santos", "where Dia_txf=$dia and Mes_txf=$mes");

                        if (isset($posts[0]->Id_int)) {
                              $this->smarty->assign('santos', $santos);
                        } else {

                              $posts = $this->mbc->buscar_completo("santos", "where Mes_txf <=$mes and Dia_txf <=$dia order by Mes_txf desc,Dia_txf desc  ");
                              $this->smarty->assign('santos', $santos);
                        }


                        //BUSCA LITURGIA DIÁRIA
                        $data = date('Y-m-d');
                        $where = "where Ativo_sel='SIM' and Data_dat=$data";
                        $liturgias = $this->mbc->buscar_completo("liturgia_diaria", "where Ativo_sel='SIM' and Data_dat='$data'");

                        if (isset($liturgias[0]->Id_int)) {

                              $this->smarty->assign('liturgias', $liturgias);
                        } else {
                              $liturgias = $this->mbc->buscar_completo("liturgia_diaria", "where Ativo_sel='SIM' and Data_dat <= CURRENT_DATE() order by Data_dat desc ");
                              $this->smarty->assign('liturgias', $liturgias);
                        }



                        break;

                  case 'posts':
                        if (!$this->uri->segment($this->app->Segmento_padrao_txf + 1)) {
                              redirect($this->app->Pagina_inicial_txf);
                        }
                        $id = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
                        $posts = $this->mbc->buscar_completo("post", "where Ativo_sel='SIM' and Id_int=" . $id);

                        $this->smarty->assign('posts', $posts);
                        $categoria = $posts[0]->Categoria_sel;
                        $posts_relacionados = $this->mbc->buscar_completo("post", "where Ativo_sel='SIM' and Categoria_sel='$categoria' and Data_dat <= CURRENT_DATE() and Id_int!=$id order by Data_dat desc limit {$this->configuracoes->Qtd_relacionados_txf}");
                        $this->smarty->assign('posts_relacionados', $posts_relacionados);
                        $this->model_smarty->carrega_bloco('posts_relacionados', 'posts_relacionados', $this->app->Template_txf);


                        $this->model_smarty->carrega_bloco('post_anexos', 'post_anexos', $this->app->Template_txf);
                        break;

                  case 'santo_do_dia':
                        if (!$this->uri->segment($this->app->Segmento_padrao_txf + 1)) {
                              $dia = date('d');
                        } else {
                              $dia = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
                        }
                        if (!$this->uri->segment($this->app->Segmento_padrao_txf + 2)) {
                              $mes = date('m');
                        } else {
                              $mes = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
                        }

                        $posts = $this->mbc->buscar_completo("santos", "where Dia_txf=$dia and Mes_txf=$mes");
                        if (isset($posts[0]->Id_int)) {
                              $this->smarty->assign('posts', $posts);
                        } else {

                              $posts = $this->mbc->buscar_completo("santos", "where Mes_txf <=$mes and Dia_txf <=$dia order by Mes_txf desc,Dia_txf desc  ");
                              $this->smarty->assign('posts', $posts);
                        }

                        $meses = $this->mbc->executa_sql("select * from meses order by Numero_txf");
                        $this->smarty->assign('meses', $meses);

                        $lista_santos = $this->mbc->buscar_completo("santos", "where Id_int is not null order by Mes_txf, Dia_txf");
                        $this->smarty->assign('lista_santos', $lista_santos);

                        $this->model_smarty->carrega_bloco('santos_anexos', 'santos_anexos', $this->app->Template_txf);
                        $this->model_smarty->carrega_bloco('santos_meses', 'santos_meses', $this->app->Template_txf);
                        break;

                  case 'liturgia_diaria':
                        if (!$this->uri->segment($this->app->Segmento_padrao_txf + 1)) {
                              $data = date('Y-m-d');
                        } else {
                              $data = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
                        }
                        $where = "where Ativo_sel='SIM' and Data_dat=$data";


                        $posts = $this->mbc->buscar_completo("liturgia_diaria", "where Ativo_sel='SIM' and Data_dat='$data'");

                        if (isset($posts[0]->Id_int)) {

                              $this->smarty->assign('posts', $posts);
                        } else {
                              $posts = $this->mbc->buscar_completo("liturgia_diaria", "where Ativo_sel='SIM' and Data_dat <= CURRENT_DATE() order by Data_dat desc ");
                              $this->smarty->assign('posts', $posts);
                        }


                        $this->model_smarty->carrega_bloco('liturgia_anexos', 'liturgia_anexos', $this->app->Template_txf);
                        $id = $posts[0]->Id_int;
                        $liturgias_relacionadas = $this->mbc->buscar_completo("liturgia_diaria", "where Ativo_sel='SIM' and Data_dat <= CURRENT_DATE() and Id_int!=$id order by Data_dat desc limit {$this->configuracoes->Qtd_relacionados_txf}");
                        $this->smarty->assign('liturgias_relacionadas', $liturgias_relacionadas);
                        $this->model_smarty->carrega_bloco('liturgias_relacionadas', 'liturgias_relacionadas', $this->app->Template_txf);

                        break;

                  case 'lista_recentes':

                        $posts = $this->mbc->valores_paginacao_generic($this->app, $this->pagina_atual, 'post', "where Ativo_sel='SIM' and data_dat <= CURRENT_DATE() order by Data_dat desc", (intval($this->uri->segment(2) > 0)) ? intval($this->uri->segment(2)) : '1', $this->configuracoes->Qtd_posts_lista_txf);


                        $this->smarty->assign('lista_posts', $posts->registros);
                        $this->smarty->assign('paginacao', $posts->paginacao);
                        $this->smarty->assign('titulo_pagina', 'Orações recentes');
                        break;

                  case 'liturgias_recentes':
                        $posts = $this->mbc->valores_paginacao_generic($this->app, $this->pagina_atual, 'liturgia_diaria', "where Ativo_sel='SIM' and data_dat <= CURRENT_DATE() order by Data_dat desc", (intval($this->uri->segment(2) > 0)) ? intval($this->uri->segment(2)) : '1', $this->configuracoes->Qtd_posts_lista_txf);
                        $this->smarty->assign('lista_posts', $posts->registros);
                        $this->smarty->assign('paginacao', $posts->paginacao);
                        $this->smarty->assign('titulo_pagina', 'Liturgias recentes');
                        break;

                  case 'lista_categorias':
                        $categorias_lista = $this->mbc->executa_sql("select COUNT(*) as total, t.* from post t where t.Ativo_sel='SIM' and Data_dat <= CURRENT_DATE() group by t.Categoria_sel order by total desc ");
                        $this->smarty->assign('categorias_lista', $categorias_lista);
                        $this->smarty->assign('titulo_pagina', 'Lista de Categorias');
                        break;

                  case 'lista_posts':
                        $cat = urldecode($this->uri->segment($this->app->Segmento_padrao_txf + 1));
                        $posts = $this->mbc->valores_paginacao_generic($this->app, $this->pagina_atual, 'post', "where Ativo_sel='SIM' and Categoria_sel = '" . $cat . "' and data_dat <= CURRENT_DATE() order by Data_dat desc", (intval($this->uri->segment(3) > 0)) ? intval($this->uri->segment(3)) : '1', $this->configuracoes->Qtd_posts_lista_txf, $cat);
                        $this->smarty->assign('lista_posts', $posts->registros);
                        $this->smarty->assign('paginacao', $posts->paginacao);
                        $this->smarty->assign('titulo_pagina', 'Orações da categoria "' . $cat . '"');
                        break;

                  case 'lista_todas_tags':
                        $sql = "select COUNT(*) as total, t.Id_int, t.Nome_txf, p.Data_dat from tags t left outer join post p on p.Id_int=t.Id_objeto_con where p.Ativo_sel='SIM' and p.Data_dat <= CURRENT_DATE() group by Nome_txf order by total desc, t.Nome_txf";
                        $tag_list = $this->mbc->executa_sql($sql);
                        $this->smarty->assign('tag_list', $tag_list);
                        $this->smarty->assign('titulo_pagina', 'Lista de Tags');

                        break;

                  case 'lista_tags':
//                        $tag = str_replace("_", " ", $this->uri->segment($this->app->Segmento_padrao_txf + 2));
//                        $tag = str_replace("-", " ", $tag);
                        $tag = urldecode($this->uri->segment($this->app->Segmento_padrao_txf + 2));

                        $sql = "select * from post p right outer join tags t on p.Id_int = t.Id_objeto_con 
	                        where t.Nome_txf='" . $tag . "' order by p.Data_dat desc";
                        $posts_tags = $this->mbc->executa_sql($sql);
                        $this->smarty->assign('posts_tags', $posts_tags);
                        $this->smarty->assign('titulo_pagina', 'Orações com a tag "' . $tag . '"');
                        break;

                  case 'lista_data':
                        if (!$this->uri->segment($this->app->Segmento_padrao_txf + 1)) {
                              redirect($this->app->Pagina_inicial_txf);
                        }

                        $sql = "select * from post where Data_dat = '" . $this->uri->segment($this->app->Segmento_padrao_txf + 1) . "'";
                        $lista_data = $this->mbc->executa_sql($sql);
                        $this->smarty->assign('lista_data', $lista_data);
                        $this->smarty->assign('titulo_pagina', 'Orações na data ' . arruma_data($this->uri->segment($this->app->Segmento_padrao_txf + 1)));
                        break;

                  case 'busca':
                        $this->fazer_busca();
                        $this->smarty->assign('titulo_pagina', 'Resultados para "' . $_POST['valor'] . '"');
//                        
//                        $resultado['post'] = $this->mbc->get_busca("post", $_POST['valor']);
//                        $resultado['tags'] = $this->mbc->get_busca("tags", $_POST['valor']);
//                        $this->smarty->assign('titulo_pagina', 'Resultados para "' . $_POST['valor'] . '"');
//                        $this->smarty->assign('resultado', $resultado);
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
                        $this->smarty->assign('paginacao', $posts->paginacao);
                        //$lista_autor = $this->mbc->executa_sql($sql);
                        //$lista_autor = $this->mbc->executa_sql($sql);
                        $perfil = $this->mbc->buscar_completo("autor_perfil", "where Autor_sel='$autor'");
                        if (isset($perfil[0]->Id_int)) {
                              $this->smarty->assign('autor_perfil', $perfil);
                              $this->model_smarty->carrega_bloco('autor_perfil', 'autor_perfil', $this->app->Template_txf);
                        }

                        $this->smarty->assign('autor', $autor);
                        //    $this->smarty->assign('lista_autor', $lista_autor);
                        $this->smarty->assign('titulo_pagina', 'Orações postadas por "' . $autor . '"');
                        break;

                  case 'arquivos':
                        $mes = $this->uri->segment(4);
                        $ano = $this->uri->segment(3);
                        $data_dat = $this->uri->segment(2);
                        $sql = "select p.* from post p where YEAR(p.Data_dat)=YEAR('$data_dat') and MONTHNAME(p.Data_dat) = MONTHNAME('$data_dat') and Data_dat <= CURRENT_DATE() order by Data_dat desc";
                        $this->smarty->assign('mes', $mes);
                        $this->smarty->assign('ano', $ano);
                        $arquivos = $this->mbc->executa_sql($sql);
                        $this->smarty->assign('arquivos', $arquivos);
                        $this->smarty->assign('titulo_pagina', 'Orações de "' . $mes . '/' . $ano . '"');
                        break;
            }
            $this->carrega_itens_obrigatorios();
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

//Carrega lista de categorias no menu da direita
            $categorias_direita = $this->mbc->executa_sql("select COUNT(*) as total, t.* from post t where t.Ativo_sel='SIM' and Data_dat <= CURRENT_DATE() group by t.Categoria_sel order by total desc,Categoria_sel limit {$this->configuracoes->Qtd_categorias_direita_txf}");
            $this->smarty->assign('categorias_direita', $categorias_direita);
            $this->model_smarty->carrega_bloco('categorias_direita', 'categorias_direita', $this->app->Template_txf);
//Carrega lista de recentes no menu da direita
            $recentes_direita = $this->mbc->executa_sql("select * from post where Ativo_sel='SIM' and Data_dat <= CURRENT_DATE() order by Data_dat desc limit {$this->configuracoes->Qtd_recentes_direita_txf}");
            $this->smarty->assign('recentes_direita', $recentes_direita);
            $this->model_smarty->carrega_bloco('recentes_direita', 'recentes_direita', $this->app->Template_txf);

            //Carrega lista de recentes no menu da direita
            $liturgias_direita = $this->mbc->executa_sql("select * from liturgia_diaria where Ativo_sel='SIM' and Data_dat <= CURRENT_DATE() order by Data_dat desc limit {$this->configuracoes->Qtd_recentes_direita_txf}");
            $this->smarty->assign('liturgias_direita', $liturgias_direita);
            $this->model_smarty->carrega_bloco('liturgias_direita', 'liturgias_direita', $this->app->Template_txf);

//carrega blogo busca
            $this->model_smarty->carrega_bloco('busca_direita', 'busca_direita', $this->app->Template_txf);
//carrega navegacao
            $this->model_smarty->carrega_bloco('navegacao', 'navegacao', $this->app->Template_txf);
//carrega social tags
            $this->model_smarty->carrega_bloco('social', 'social', $this->app->Template_txf);
//altera o idioma do banco 
            $this->mbc->seta_idioma('pt_BR');
            // carrega o alista ARQUIVOS [ano][mes] o menu da direita
            $anos = $this->mbc->executa_sql("SELECT  distinct DATE_FORMAT(p.Data_dat, '%Y') as ano FROM post p where p.Data_dat>'2000-01-01' and p.Ativo_sel='SIM'");
            $this->smarty->assign('anos', $anos);
            foreach ($anos as $ano) {
                  $meses = $this->mbc->executa_sql("SELECT distinct MONTHNAME(p.Data_dat) as mes FROM post p where DATE_FORMAT(p.Data_dat, '%Y')='$ano->ano' order by p.Data_dat desc");
                  foreach ($meses as $mes) {
                        $postagens[$ano->ano][$mes->mes] = $this->mbc->executa_sql("select p.*  from post p where DATE_FORMAT(p.Data_dat, '%Y')='$ano->ano' and MONTHNAME(p.Data_dat)='$mes->mes'");
                  }
            }
            $this->smarty->assign('postagens', $postagens);
            //Carrega lista de arquivo no menu da direita
            $arquivos_direita = $this->mbc->executa_sql("select * from post where Ativo_sel='SIM' group by Data_dat");
            $this->smarty->assign('arquivos_direita', $arquivos_direita);
            $this->model_smarty->carrega_bloco('arquivos_direita', 'arquivos_direita', $this->app->Template_txf);
      }

}

?>