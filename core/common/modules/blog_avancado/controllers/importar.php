<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_blog.php');

class importar extends lands_core {

    public $importacao;

    public function __construct() {
        parent::__construct();
        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : 'importacoes');
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


        $this->smarty->assign('nome_pagina', 'Importações');



        $this->conecta_mbc($this->app->Conexoes_for);
        switch ($this->pagina_atual) {

            case 'importacoes':
                $importacoes = $this->mbc->buscar_completo("importacao", "order by Id_int Desc");
                $this->smarty->assign("importacoes", $importacoes);

                break;
            case 'corretoresdeseguros':
                
                  echo "<br>*****************<br>";
                echo "iniciando importacao";
                echo "<br>*****************<br>";
                echo "<br><br>";
                
                $url="http://www.corretoresdeseguros.com.br/cgi-corretoresdeseguros/noticias/cginews_corretores.pl?template=/home/planaltoseguros/www/news_corretores.htm";
                $curl_response= curlContents($url) ;
                $noticias=$curl_response['contents'];
                $noticias=strip_tags($noticias,"<a>");
                $noticias=  str_replace("<a ","",$noticias);
                $noticias=  str_replace("</a>","",$noticias);
                $noticias=  str_replace("href=","@@@#VAR",$noticias);
                $noticias=  str_replace("target=_blank>","#VAR",$noticias);
                $noticias_temp=explode("@@@",$noticias);
                unset($noticias_temp[0]);
                $todas_noticias=array();

                foreach($noticias_temp as $noticia){
                    $noticia_temp=explode("#VAR",$noticia);
                    $obj_noticia=new stdClass();
                      $obj_noticia->Link_txf=strip_tags($noticia_temp[1]);
                    $obj_noticia->Titulo_txf=strip_tags($noticia_temp[2]);
                    $obj_noticia->Autor_sel='Portal Corretor de Seguros';
                    $obj_noticia->Categoria_sel='Notícias';
                    $obj_noticia->Ativo_sel='SIM';
                  
                    $todas_noticias[]=$obj_noticia;
                }
               $cont=0;
               
//               rsort ($todas_noticias);
//               ver($todas_noticias);
                foreach($todas_noticias as $noticia){
                    $noticia_inserida=$this->mbc->executa_sql("select * from post where Titulo_txf='{$noticia->Titulo_txf}'");
                    if(!$noticia_inserida[0]){
                        $noticia->Data_dat=date('Y-m-d');
                          $noticia->Conteudo_txa= noticiaIframe($noticia->Link_txf,TRUE);
                          
                        $array=object_to_array($noticia);
                        $this->mbc->db_insert('post',$array);
                        echo "noticia {$noticia->Titulo_txf} inserida <br>";
                        $cont=$cont+1;
                    }
                }
                
                
                echo "<br>*****************<br>";
                echo "{$cont} notícias inseridas";
                echo "<br>*****************<br>";
                
                
                die();
                
                
              
                
                             
                break;
            case 'blogger':
                if ($this->uri->segment('3')) {
                    $id = $this->uri->segment('3');
                    $importacoes = $this->mbc->buscar_completo("importacao", "where Id_int={$id}");
                    if (!$importacoes[0]->Arquivos[0]) {
                        die('Arquivo nao encontrado');
                    } else {
                        $this->importacao = $importacoes[0];
//                        $blog_id = "2976505272941342543";
//                           $caminho_teste = "http://www.blogger.com/feeds/{$blog_id}/posts/default";
                        $caminho_importacao = $this->app->Url_cliente . $this->app->Pasta_painel . $this->importacao->Arquivos[0]->Caminho_txf;
                    }
                } else {
                    die('Arquivo nao encontrado');
                }
                //    @header('Content-Type: text/html; charset=utf-8');
                $rss = simplexml_load_file($caminho_importacao);


                $this->load->library('format');
                $this->format->factory($rss, 'xml');
                $dados = $this->format->to_array($rss);
                $i = 0;
                $posts = array();
                $cont = 0;

                foreach ($dados['entry'] as $entry) {
                    $post = new stdClass();
                    $i = $i + 1;

                    $ano = substr($entry['published'], 0, 4);
                    if ($ano >= '2013') {

                        $post->Data_dat = substr($entry['published'], 0, 10);
                        if (is_array($entry['title'])) {
                            $data = arruma_data($post->Data_dat);
                            $titulo = "Notícia de $data";
                        } else {
                            $titulo = $entry['title'];
                        }
                        $post->Titulo_txf = $titulo;
                        if (is_array($entry['content'])) {
                            $conteudo = "Sem conteúdo";
                        } else {
                            $conteudo = $entry['content'];
                        }
                        $post->Descricao_txa = substr(strip_tags($conteudo), 0, 200);

                        $post->Conteudo_txa = $conteudo;

                        $post->Id_blogger_txf = $entry['id'];
                        $post->Autor_sel = $entry['author']['name'];
                        $post->Categoria_sel = 'Geral';
                        $post->Ativo_sel = 'SIM';

                        if ($this->importa_post($post, 'blogger')) {
                            $cont = $cont + 1;
                        }


//                            $post->Imagens[0]=$entry['media'];
                        // $posts[] = $post;
                    }
                }
                $this->importar_imagens();
                echo "$cont posts importados";
                die();

                break;
        }
    }

    function importar_imagens() {
        $posts = $this->mbc->buscar_completo("post", "order by Id_int");
        foreach ($posts as $post) {
            $tags=array();
            if (!$post->Imagens[0]) {
                $doc = new DOMDocument();
                $doc->loadHTML($post->Conteudo_txa);
                $imageTags = $doc->getElementsByTagName('img');
                foreach ($imageTags as $tag) {
                    $tags[] = $tag->getAttribute('src');
                }
                if($tags[0]){
                $imagem=new stdClass();
                $imagem->Campo_sel='Imagens_ico';
                $imagem->Tabela_con='post';
                $imagem->Id_imagem_con=$post->Id_int;
                $imagem->Caminho_txf=$tags[0];
                $imagem_array=object_to_array($imagem);
                $this->mbc->db_insert("imagens",$imagem_array);
                echo "Imagem de {$post->Titulo_txf} inserida<br>";
                }
            }
        }
    }

// =============================================================================
// Helper
// =============================================================================



    function importa_post($post, $tipo = null) {
        switch ($tipo) {
            case 'blogger':
                $post_cadastrado = $this->mbc->executa_sql("select * from post where Id_blogger_txf='{$post->Id_blogger_txf}'");

                if ($post_cadastrado[0]) {

                    return FALSE;

                    if ($this->mbc->updateTable("post", $post, 'Id_blogger_txf', $post->Id_blogger_txf)) {
                        echo "{$post->Titulo_txf} atualizado<br>";
                        return TRUE;
                    } else {
                        echo "{$post->Titulo_txf} COM ERRO AO ATUALIZAR";
                        return FALSE;
                    }
                } else {
                    if ($this->mbc->db_insert("post", $post)) {
                        echo "{$post->Titulo_txf} inserir<br>";
                        return TRUE;
                    } else {
                        echo "{$post->Titulo_txf} COM ERRO AO INSERIR";
                        return FALSE;
                    }
                }

                break;

            default:
                die('tipo de importacao desconhecida');
                break;
        }
    }

}

?>