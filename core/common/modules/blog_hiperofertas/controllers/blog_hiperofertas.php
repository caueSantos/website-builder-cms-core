<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_blog.php');

class blog_hiperofertas extends lands_core {

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

                        $posts = $this->mbc->valores_paginacao_generic($this->app, $this->pagina_atual, 'promocoes', "where Ativo_sel='SIM' and Inicio_dat <= CURRENT_DATE() order by Inicio_dat desc, Id_int desc", (intval($this->uri->segment(2) > 0)) ? intval($this->uri->segment(2)) : '1', $this->configuracoes->Qtd_posts_inicio_txf);
                        $this->smarty->assign('posts', $posts->registros);
                        $this->smarty->assign('paginacao', $posts->paginacao);
//                        $tags = $this->mbc->executa_sql("select * from tags where Tabela_con='post'");
//                        $this->smarty->assign('tags', $tags);

                        break;

                  case 'posts':
                        if (!$this->uri->segment($this->app->Segmento_padrao_txf + 1)) {
                              redirect($this->app->Pagina_inicial_txf);
                        }
                        $id = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
                        $posts = $this->mbc->buscar_completo("promocoes", "where Ativo_sel='SIM' and Id_int=" . $id);
//ver($posts);
                        if (!isset($posts[0])) {
                              redirect($this->app->Pagina_inicial_txf);
                        }

                        $this->smarty->assign('posts', $posts);
                        $this->grava_visualizacao_post($posts[0]);
                        $this->busca_visualizacoes_post($posts[0]->Id_int);
                        //    $categoria = $posts[0]->Categoria_sel;
                        //$posts_relacionados = $this->mbc->buscar_completo("post", "where Ativo_sel='SIM' and Categoria_sel='$categoria' and Data_dat <= CURRENT_DATE()  and Id_int!=$id order by Data_dat desc limit {$this->configuracoes->Qtd_relacionados_txf}");
                        $where = "where Ativo_sel='SIM'  and Inicio_dat <= CURRENT_DATE()  and Inicio_dat<= '{$posts[0]->Inicio_dat}'  and Id_int!=$id order by Inicio_dat desc limit {$this->configuracoes->Qtd_relacionados_txf}";

                        $posts_relacionados = $this->mbc->buscar_completo("promocoes", $where);
//                        ver($posts_relacionados);

                        $this->smarty->assign('posts_relacionados', $posts_relacionados);
                        $this->model_smarty->carrega_bloco('posts_relacionados', 'posts_relacionados', $this->app->Template_txf);


                        $this->model_smarty->carrega_bloco('post_anexos', 'post_anexos', $this->app->Template_txf);
                        break;

                  case 'lista_recentes':

                        $posts = $this->mbc->valores_paginacao_generic($this->app, $this->pagina_atual, 'promocoes', "where Ativo_sel='SIM' and Inicio_dat <= CURRENT_DATE() order by Inicio_dat desc, Id_int desc ", (intval($this->uri->segment(2) > 0)) ? intval($this->uri->segment(2)) : '1', $this->configuracoes->Qtd_posts_lista_txf);


                        $this->smarty->assign('lista_posts', $posts->registros);
                        $this->smarty->assign('paginacao', $posts->paginacao);
                        $this->smarty->assign('titulo_pagina', 'Promoções recentes');
                        break;

                  case 'lista_categorias':

                        $categorias = $this->mbc->executa_sql("select COUNT(*) as total,t.Namespace_empresa_sel from promocoes t where t.Ativo_sel='SIM' and Inicio_dat <= CURRENT_DATE() group by  t.Namespace_empresa_sel order by total desc, t.Inicio_dat desc, t.Id_int desc ");
                        foreach ($categorias as $categ) {

                              $post = $this->mbc->buscar_completo("promocoes", "where Ativo_sel='SIM' and Inicio_dat <= CURRENT_DATE() and Namespace_empresa_sel='{$categ->Namespace_empresa_sel}' order by Inicio_dat desc, Id_int desc limit 1");
                              $post[0]->total = $categ->total;
                              $categorias_lista[] = $post[0];
                        }

                        $this->smarty->assign('categorias_lista', $categorias_lista);
                        $this->smarty->assign('titulo_pagina', 'Lista Empresas');
                        break;

                  case 'lista_posts':
//                        $cat = str_replace("_", " ", $this->uri->segment($this->app->Segmento_padrao_txf + 1));
                        //                      $cat = str_replace("-", " ", $cat);
                        $cat = urldecode($this->uri->segment($this->app->Segmento_padrao_txf + 1));
//                        $sql = "select * from post where Categoria_sel = '" . $cat . "' order by Data_dat desc";
                        $posts = $this->mbc->valores_paginacao_generic($this->app, $this->pagina_atual, 'promocoes', "where Ativo_sel='SIM' and Namespace_empresa_sel = '" . $cat . "' and Inicio_dat <= CURRENT_DATE() order by Inicio_dat desc", (intval($this->uri->segment(3) > 0)) ? intval($this->uri->segment(3)) : '1', $this->configuracoes->Qtd_posts_lista_txf, $cat);
                        $this->smarty->assign('lista_posts', $posts->registros);
                        if (isset($posts->paginacao)) {
                              $this->smarty->assign('paginacao', $posts->paginacao);
                        }

                        $this->smarty->assign('titulo_pagina', 'Posts da categoria "' . $cat . '"');
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
                        $resultado['promocoes'] = $this->mbc->get_busca("promocoes", $_POST['valor']);
              
                        $this->smarty->assign('titulo_pagina', 'Resultados para "' . $_POST['valor'] . '"');
                        $this->smarty->assign('resultado', $resultado);
                        break;

                  

                  case 'arquivos':
                        $mes = $this->uri->segment(4);
                        if ($mes == 'mar%C3%A7o') {
                              $mes = 'março';
                        }
                        $ano = $this->uri->segment(3);
                        $data_dat = $this->uri->segment(2);
                        $sql = "select p.* from promocoes p where  p.Ativo_sel='SIM'  and YEAR(p.Inicio_dat)=YEAR('$data_dat') and MONTHNAME(p.Inicio_dat) = MONTHNAME('$data_dat') and Inicio_dat <= CURRENT_DATE() order by Inicio_dat desc";
                        $this->smarty->assign('mes', $mes);
                        $this->smarty->assign('ano', $ano);
                        $this->smarty->assign('ano_dat', $data_dat);

                        $temp_posts = $this->mbc->executa_sql($sql);

                        if (isset($temp_posts[0])) {
                              $arquivos = $this->mbc->complementa_registros($temp_posts, 'promocoes');
                              $this->smarty->assign('arquivos', $arquivos);
                        }






                        $this->smarty->assign('titulo_pagina', 'Posts de "' . $mes . '/' . $ano . '"');
                        break;
            }
            $this->carrega_itens_obrigatorios();
      }

      function grava_visualizacao_post($post) {
            if(!is_lands()){
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

      function busca_visualizacoes_post($id) {
            if ($this->mbc->tabelaexiste('visualizacoes')) {
                  $sql = "select COUNT(*) as total, v.* from visualizacoes v where v.Id_objeto_con={$id} group by  v.Id_objeto_con";
                  $visualizacoes = $this->mbc->executa_sql($sql);
                  $this->smarty->assign('visualizacoes', $visualizacoes);
            }
      }

      function carrega_configuracoes() {
            $this->conecta_mbc($this->app->Conexoes_for);
            $configuracoes = $this->mbc->executa_sql("select * from configuracoes_blog limit 1");
            if (isset($configuracoes[0]->Id_int)) {
                  $this->configuracoes = $configuracoes[0];
                  $this->smarty->assign('configuracoes', $configuracoes[0]);
            }
      }

      function carrega_itens_obrigatorios() {
            

            //Carrega lista de tags no menu da direita
/*
            $this->conecta_mbc($this->app->Conexoes_for);
            $tags_direita = $this->mbc->executa_sql("select COUNT(*) as total, t.Id_int, t.Nome_txf, p.Data_dat from tags t left outer join post p on p.Id_int=t.Id_objeto_con where p.Ativo_sel='SIM' and p.Data_dat <= CURRENT_DATE() group by Nome_txf order by total desc, p.Data_dat, t.Nome_txf limit {$this->configuracoes->Qtd_tags_direita_txf}");
            $this->smarty->assign('tags_direita', $tags_direita);
            $this->model_smarty->carrega_bloco('tags_direita', 'tags_direita', $this->app->Template_txf);
*/

//            //Carrega lista de categorias completa
//            $categorias = $this->mbc->executa_sql("select COUNT(*) as total, t.* from post t where t.Ativo_sel='SIM' and Data_dat <= CURRENT_DATE() group by t.Categoria_sel order by total desc");
//            $this->smarty->assign('todas_categorias', $categorias);
//Carrega lista de categorias no menu da direita
            $sql="select COUNT(*) as total,  e.Nome_txf, t.* from promocoes t left outer join empresas e on e.Namespace_txf=t.Namespace_empresa_sel where  e.Ativo_sel='SIM'  and t.Ativo_sel='SIM' and Inicio_dat <= CURRENT_DATE() group by t.Namespace_empresa_sel order by total desc limit {$this->configuracoes->Qtd_categorias_direita_txf}";
            
            $categorias_direita = $this->mbc->executa_sql($sql);
          
            $this->smarty->assign('categorias_direita', $categorias_direita);
            $this->model_smarty->carrega_bloco('categorias_direita', 'categorias_direita', $this->app->Template_txf);

/*
//carrega lista de autores
            $autores_direita = $this->mbc->executa_sql("select * from post where Ativo_sel='SIM' and Data_dat <= CURRENT_DATE() group by Autor_sel order by Autor_sel");
            $this->smarty->assign('autores_direita', $autores_direita);

            $this->model_smarty->carrega_bloco('autores_direita', 'autores_direita', $this->app->Template_txf);
*/

//Carrega lista de recentes no menu da direita
            $recentes_direita = $this->mbc->buscar_completo("promocoes", " where Ativo_sel='SIM' and Inicio_dat <= CURRENT_DATE() order by Inicio_dat desc, Id_int desc limit {$this->configuracoes->Qtd_recentes_direita_txf}");
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
            $anos = $this->mbc->executa_sql("SELECT  distinct DATE_FORMAT(p.Inicio_dat, '%Y') as ano FROM promocoes p where p.Inicio_dat>'2000-01-01' and p.Ativo_sel='SIM' and Inicio_dat <= CURRENT_DATE()  order by ano desc");
            $this->smarty->assign('anos', $anos);
            foreach ($anos as $ano) {
                  $meses = $this->mbc->executa_sql("SELECT distinct MONTHNAME(p.Inicio_dat) as mes FROM promocoes p where DATE_FORMAT(p.Inicio_dat, '%Y')='$ano->ano' order by p.Inicio_dat desc ");
                  foreach ($meses as $mes) {
                        $postagens[$ano->ano][$mes->mes] = $this->mbc->executa_sql("select p.*  from promocoes p where DATE_FORMAT(p.Inicio_dat, '%Y')='$ano->ano' and MONTHNAME(p.Inicio_dat)='$mes->mes'");
                  }
            }


            $this->smarty->assign('postagens', $postagens);


            //Carrega lista de arquivo no menu da direita
            $arquivos_direita = $this->mbc->executa_sql("select * from promocoes where Ativo_sel='SIM' and Inicio_dat <= CURRENT_DATE() group by Inicio_dat");
            $this->smarty->assign('arquivos_direita', $arquivos_direita);
            $this->model_smarty->carrega_bloco('arquivos_direita', 'arquivos_direita', $this->app->Template_txf);

      }

}

?>