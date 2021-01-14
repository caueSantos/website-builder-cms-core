<?php

require_once(COMMONPATH . 'core/lands_core.php');

/**
 * Constructor
 *
 * @access public
 */
class lands_blog extends lands_core {

      function __construct() {
            parent::__construct();
            
      }

      
      function index() {
//          $this->carreg
          
            die('lands_core nao possui metodo index');
      }

      /**
       * Carrega página do sistema
       *
       * @access	public
       * @param	int nome_pagina
       * @param	array qqr coisa
       * @return	bool
       */
      function carrega_pagina($nome_pagina = null) {


            if (!isset($nome_pagina)) {
                  $nome_pagina = $this->pagina_atual;
            }
//funcao chamada pela classe filha.... (core_main)..
//carrega os dados necessários para exibicao da página...
            $this->carrega_dados($nome_pagina);
            $this->carrega_menu_blog();
            $this->switch_pagina();

            $this->model_smarty->render($this->pagina_atual, $this->app->Template_txf);
      }

      function switch_pagina() {
  
            $this->smarty->assign('titulo_pagina', ucfirst($this->pagina_atual));

            switch ($this->pagina_atual) {
                  case 'inicio':
                        $posts = $this->mbc->valores_paginacao_generic($this->app, $this->pagina_atual, 'post', "where Ativo_sel='SIM'  order by Id_int desc, Data_dat desc", (intval($this->uri->segment(2) > 0)) ? intval($this->uri->segment(2)) : '1', 2);
                        $this->smarty->assign('posts', $posts->registros);
                        $this->smarty->assign('paginacao', $posts->paginacao);
                        $tags = $this->mbc->executa_sql("select * from tags where Tabela_con='post'");
                        $this->smarty->assign('tags', $tags);
                        $post_imagens = $this->mbc->executa_sql("select * from imagens where Tabela_con='post' order by Id_int");
                        $this->smarty->assign('post_imagens', $post_imagens);
                        break;

                  case 'posts':
                
                        
                        
                         $id = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
                        $posts = $this->mbc->buscar_completo("post", "where Ativo_sel='SIM' and Id_int=" . $id);
                        
                        $this->smarty->assign('posts', $posts);
                        $post_imagens = $this->mbc->executa_sql("select * from imagens where Tabela_con='post' order by Id_int");
                        $this->smarty->assign('post_imagens', $post_imagens);
                        break;

                  case 'lista_recentes':
                        $posts = $this->mbc->executa_sql("select * from post  order by Data_dat desc limit 6");
                        $this->smarty->assign('lista_posts', $posts);
                        $this->smarty->assign('titulo_pagina', 'Posts recentes');
                        break;

                  case 'lista_categorias':
                        $categorias_lista = $this->mbc->executa_sql("select COUNT(*) as total, t.* from post t where t.Ativo_sel='SIM'  group by t.Categoria_sel order by total desc ");
                        $this->smarty->assign('categorias_lista', $categorias_lista);
                        $this->smarty->assign('titulo_pagina', 'Lista de Categorias');
                        break;

                  case 'lista_posts':
//                        $cat = str_replace("_", " ", $this->uri->segment($this->app->Segmento_padrao_txf + 1));
                        //                      $cat = str_replace("-", " ", $cat);
                        $cat = urldecode($this->uri->segment($this->app->Segmento_padrao_txf + 1));


                        $sql = "select * from post where Categoria_sel = '" . $cat . "' order by Data_dat desc";
                        $lista_posts = $this->mbc->executa_sql($sql);
                        $this->smarty->assign('lista_posts', $lista_posts);
                        $this->smarty->assign('titulo_pagina', 'Posts da categoria "' . $cat . '"');
                        break;

                  case 'lista_todas_tags':
                        $sql = "select COUNT(*) as total, t.Id_int, t.Palavra_txf, p.Data_dat from tags t left outer join post p on p.Id_int=t.Id_objeto_con where p.Ativo_sel='SIM' group by Palavra_txf order by total desc, t.Palavra_txf";

                        $tag_list = $this->mbc->executa_sql($sql);
                        $this->smarty->assign('tag_list', $tag_list);
                        $this->smarty->assign('titulo_pagina', 'Lista de Tags');

                        break;

                  case 'lista_tags':
//                        $tag = str_replace("_", " ", $this->uri->segment($this->app->Segmento_padrao_txf + 2));
//                        $tag = str_replace("-", " ", $tag);
                        $tag = urldecode($this->uri->segment($this->app->Segmento_padrao_txf + 2));

                        $sql = "select * from post p right outer join tags t on p.Id_int = t.Id_objeto_con 
	                        where t.Palavra_txf='" . $tag . "' order by p.Data_dat desc";
                        $posts_tags = $this->mbc->executa_sql($sql);
                        $this->smarty->assign('posts_tags', $posts_tags);
                        $this->smarty->assign('titulo_pagina', 'Posts com a tag "' . $tag . '"');
                        break;

                  case 'lista_data':
                        $sql = "select * from post where Data_dat = '" . $this->uri->segment($this->app->Segmento_padrao_txf + 1) . "'";
                        $lista_data = $this->mbc->executa_sql($sql);
                        $this->smarty->assign('lista_data', $lista_data);
                        $this->smarty->assign('titulo_pagina', 'Posts na data ' . arruma_data($this->uri->segment($this->app->Segmento_padrao_txf + 1)));
                        break;

                  case 'busca':
                        $resultado['post'] = $this->mbc->get_busca("post", $_POST['valor']);
                        $resultado['tags'] = $this->mbc->get_busca("tags", $_POST['valor']);
                        $this->smarty->assign('titulo_pagina', 'Resultados para "' . $_POST['valor'] . '"');
                        $this->smarty->assign('resultado', $resultado);
                        break;

                  case 'lista_autor':
                        $autor = str_replace("_", " ", $this->uri->segment($this->app->Segmento_padrao_txf + 1));
                        $autor = str_replace("-", " ", $autor);
                        $autor = urldecode($this->uri->segment($this->app->Segmento_padrao_txf + 1));
                        $sql = "select * from post where Autor_sel='$autor' order by Data_dat desc";
                        $lista_autor = $this->mbc->executa_sql($sql);
                        $this->smarty->assign('autor', $autor);
                        $this->smarty->assign('lista_autor', $lista_autor);
                        $this->smarty->assign('titulo_pagina', 'Posts de "' . $autor . '"');
                        break;

                  case 'arquivos':
                        $mes = $this->uri->segment(4);
                        $ano = $this->uri->segment(3);
                        $data_dat = $this->uri->segment(2);
                        $sql = "select p.* from post p where YEAR(p.Data_dat)=YEAR('$data_dat') and MONTHNAME(p.Data_dat) = MONTHNAME('$data_dat') order by Data_dat desc";
                        $this->smarty->assign('mes', $mes);
                        $this->smarty->assign('url', 'http://intensivodonto.com.br/blog/');
                        $this->smarty->assign('ano', $ano);
                        $arquivos = $this->mbc->executa_sql($sql);
                        $this->smarty->assign('arquivos', $arquivos);
                        $this->smarty->assign('titulo_pagina', 'Arquivos de "' . $mes . '/' . $ano . '"');
            }
      }

      function carrega_menu_blog() {
            //Carrega lista de tags no menu da direita


            $this->conecta_mbc($this->app->Conexoes_for);
            $tags_direita = $this->mbc->executa_sql("select COUNT(*) as total, t.Id_int, t.Palavra_txf, p.Data_dat from tags t left outer join post p on p.Id_int=t.Id_objeto_con where p.Ativo_sel='SIM' group by Palavra_txf order by total desc, p.Data_dat, t.Palavra_txf limit 6");
            $this->smarty->assign('tags_direita', $tags_direita);

//Carrega lista de categorias no menu da direita
            $categorias_direita = $this->mbc->executa_sql("select COUNT(*) as total, t.* from post t where t.Ativo_sel='SIM'  group by t.Categoria_sel order by total desc ");
            $this->smarty->assign('categorias_direita', $categorias_direita);

//Carrega lista de arquivo no menu da direita
            $arquivos_direita = $this->mbc->executa_sql("select * from post where Ativo_sel='SIM' group by Data_dat");
            $this->smarty->assign('arquivos_direita', $arquivos_direita);

//Carrega lista de recentes no menu da direita
            $recentes_direita = $this->mbc->executa_sql("select * from post where Ativo_sel='SIM' order by Id_int desc limit 6");
            $this->smarty->assign('recentes_direita', $recentes_direita);

//altera o idioma do banco 
            $this->mbc->seta_idioma('pt_BR');

            // carrega o alista ARQUIVOS [ano][mes] o menu da direita
            $anos = $this->mbc->executa_sql("SELECT  distinct DATE_FORMAT(p.Data_dat, '%Y') as ano FROM post p where p.Data_dat>'2000-01-01' and p.Ativo_sel='SIM'");
            $this->smarty->assign('anos', $anos);
            foreach ($anos as $ano) {
                  $meses = $this->mbc->executa_sql("SELECT distinct MONTHNAME(p.Data_dat) as mes FROM post p where DATE_FORMAT(p.Data_dat, '%Y')='$ano->ano' ");
                  foreach ($meses as $mes) {
                        $postagens[$ano->ano][$mes->mes] = $this->mbc->executa_sql("select p.*  from post p where DATE_FORMAT(p.Data_dat, '%Y')='$ano->ano' and MONTHNAME(p.Data_dat)='$mes->mes'");
                  }
            }
            
            $this->smarty->assign('postagens', $postagens);
            
            //faz o parse nas views (BLOCOS)
            //   $this->assign_blocos();
      }

//      public function assign_blocos() {
//            $blocos = array();
//            $blocos_ativos = $this->model_banco->buscar_tudo("blocos_direita where Ativo_sel ='SIM' order by Ordem_int");
//
//
//            foreach ($blocos_ativos as $bloco) {
//                  $blocos[] = $this->smarty->fetch(COMMONPATH . "../templates/" . $this->app->Template_txf . "/blocos/" . $bloco->Bloco_sel . ".tpl");
//            }
//            $this->smarty->assign('blocos', $blocos);
//      }
//      function postar($remetente = FALSE) {
//            $this->smarty->assign('data_atual', date("Y/m/d"));
//
//            switch ($this->uri->segment(2)) {
//                  case 'busca':
//                        $res = array();
//
//                        $valor = $this->input->post('valor');
//
//
//                        $res = $this->model_banco->get_busca('post', $valor, 10);
//
//                        foreach ($res as $key => $value) {
//                              $this->session->set_flashdata('busca_post', $res[$key] = $value);
//
//                              $this->smarty->assign('resultado', $res[$key]);
//                        }
//                        redirect(site_url() . 'resultado_busca');
//                        break;
//                  case 'posts':
//                        $envia = $this->model_banco->db_insert('comentarios', $this->input->post());
//                        redirect(site_url() . 'posts/' . $this->uri->segment(2));
//                        break;
//                  case 'abre_replica':
//                        $id_replica = $this->uri->segment(3);
//                        $id_post = $this->uri->segment(4);
//                        $this->smarty->assign('id_replica', $id_replica);
//                        $this->smarty->assign('id_post', $id_post);
//                        echo $this->smarty->fetch($this->template . '/replica.tpl');
//
//                        break;
//
//                  case 'comentario':
//
//                        $id_post = $this->uri->segment(3);
//                        if ($this->input->post('Comentario_txf') == '') {
//                              redirect(site_url() . 'posts/' . $id_post);
//                        }
//                        if ($this->input->post('Email_txf') == '') {
//                              redirect(site_url() . 'posts/' . $id_post);
//                        }
//                        if ($this->input->post('Nome_txf') == '') {
//                              redirect(site_url() . 'posts/' . $id_post);
//                        }
//
//                        $x = $this->input->post();
//
//                        $this->model_banco_basico->db_insert('comentarios', $this->input->post());
//
//                        redirect(site_url() . 'posts/' . $id_post);
//
//
//                        break;
//
//                  case 'lista_mes':
//
//                        $mes = $this->uri->segment(4);
//
//                        $ano = $this->uri->segment(3);
//                        $mes_extenso = $this->uri->segment(5);
//                        $data_dat = $this->input->post('Data_dat');
//                        $mes_num = $this->input->post('mes_num');
//                        $sql = "post where DATE_FORMAT(Data_dat, '%Y') = '$ano' and DATE_FORMAT(Data_dat, '%m') = '$mes'";
//                        $this->smarty->assign('mes', $mes);
//                        $this->smarty->assign('url', 'http://intensivodonto.com.br/blog/');
//                        $this->smarty->assign('ano', $ano);
//                        $this->smarty->assign('mes_num', $mes_num);
//                        $this->smarty->assign('mes_extenso', $mes_extenso);
//                        $arquivos = $this->model_banco->buscar_tudo($sql);
//                        $this->smarty->assign('arquivos', $arquivos);
//
//
//                        echo $this->smarty->fetch($this->template . '/arquivos.tpl');
//
//
//
//
//
//
//
//                        break;
//
//                  case 'arquivos':
//
//                        $mes = $this->uri->segment(5);
//                        $ano = $this->uri->segment(4);
//                        $data_dat = $this->uri->segment(3);
//                        $sql = "select p.* from post p where YEAR(p.Data_dat)=YEAR('$data_dat') and MONTHNAME(p.Data_dat) = MONTHNAME('$data_dat')";
//                        $this->smarty->assign('mes', $mes);
//                        $this->smarty->assign('url', 'http://intensivodonto.com.br/blog/');
//                        $this->smarty->assign('ano', $ano);
//                        $arquivos = $this->model_banco->executa_sql($sql);
//                        $this->smarty->assign('arquivos', $arquivos);
//                        echo $this->smarty->fetch($this->template . '/arquivos.tpl');
//
//
//
//
//
//
//
//                        break;
//
//                  case 'inserir_replica':
//                        $id_replica = $this->uri->segment(3);
//                        $id_post = $this->uri->segment(4);
//                        $this->smarty->assign('id_replica', $id_replica);
//                        $this->smarty->assign('id_post', $id_post);
//
//                        $replica = $this->input->post();
//                        $this->model_banco_basico->db_insert('replicas', $this->input->post());
//                        redirect(site_url() . 'posts/' . $id_post);
//
//                        break;
//
//
//                  case 'contato':
//                        $this->load->model('model_mail');
//                        $envia = $this->model_mail->envia_email_contato($this->input->post());
//                        if ($envia) {
//                              echo "<div id='enviado'>Mensagem enviada com sucesso!</div>";
//                        } else {
//                              echo "<div id='atencao'>Ocorram erros ao enviar o e-mail</div>";
//                        }
//                        break;
//            }
//      }
}