<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_blog.php');

class exportar extends lands_core {

    public function __construct() {
        parent::__construct();
        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : 'exportar');
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


        $this->smarty->assign('nome_pagina', 'Exportações');



        $this->conecta_mbc($this->app->Conexoes_for);
        switch ($this->pagina_atual) {

            case 'rss':
                $pagina = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
                $pagina = ($pagina != "" ? $pagina : 'noticias');
//            ver($pagina);
                $config = array();
                $config['img_classe'] = '';
                $config['img_fora'] = 'centro';
                $config['img_style'] = 'max-height:700px; width:auto;';
                $config['vid_style'] = 'width:400px; height:300px;';
                $config['tipo_nota'] = 'popover';

                $limit = 'limit 50';
                if ($_REQUEST['limit']) {
                    $limit = " limit {$_REQUEST['limit']}";
                }


                switch ($pagina) {
                    case 'receitas':


                        $posts = $this->mbc->buscar_completo("$pagina", "where Ativo_sel='SIM' order by Id_int desc $limit");

//                        ver($posts);
                        ////                count($postsw)
                        // Instanciamos/chamamos a classe

                        $feeds = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><rss></rss>');
                        $feeds->addAttribute('version', '2.0');

// Criar elemento channel, como filho do elemento rss
                        $channel = $feeds->addChild('channel');
                        $channel->addChild('title', 'Feed de Receitas');
                        $channel->addChild('link', $this->app->Url_cliente);
                        $channel->addChild('description', 'Feed de Receitas');

// Define a consulta MySQL
// Inclui um <item> para cada resultado encontrado
//                ver(count($posts));


                        foreach ($posts as $post) {

                            $id = $post->Id_int;
                            $titulo = $post->Nome_tit;
                            //  $texto = $post->Conteudo_txa;
                            //            $texto = ignora_tags(strip_tags(html_entity_decode($post->Conteudo_txa)));

                            
                            $texto = cria_tags((html_entity_decode($post->Descricao_txa)), $config, $post->Imagens, $post->Videos, $post->Arquivos, $post->Notas);
                            $texto .= "<img style='{$config['img_style']}' title='{$post->Imagens[0]->Caminho_txf}' alt='{$post->Imagens[0]->Caminho_txf}' class='' src='{$this->app->Url_cliente}{$this->app->Pasta_painel}{$post->Imagens[0]->Caminho_txf}'/><div class='legenda'></div></div><br>";
//                            ver($texto);

                            $data = $post->Data_dat;
// Cria um elemento <item> dentro de <channel>
                            $item = $channel->addChild('item');
// Adiciona sub-elementos ao elemento <item>
                            $item->addChild('title', $titulo);
//                    $autor = $this->mbc->executa_sql("select * from autor_perfil where Autor_sel='{$post->Autor_sel}'");
//                    if ($autor[0]) {
//                        $item->addChild('author', $autor[0]->Email_txf);
//                    }
                            $item->addChild('author', $post->Autor_sel);

                            $item->addChild('link', "{$this->app->Url_cliente}$pagina/{$id}");
                            $item->addChild('description', $texto);
                            $item->addChild('category', $post->Categoria_sel);
                            $item->addChild('pubDate', $data);
                        }



                        break;

                    default:

                        $posts = $this->mbc->buscar_completo("$pagina", "where Ativo_sel='SIM' order by Data_dat desc $limit");
//ver($posts);
                        ////                count($postsw)
                        // Instanciamos/chamamos a classe

                        $feeds = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><rss></rss>');
                        $feeds->addAttribute('version', '2.0');

// Criar elemento channel, como filho do elemento rss
                        $channel = $feeds->addChild('channel');
                        $channel->addChild('title', 'Feed de notícias '.$this->app->Nome_app_txf);
                        $channel->addChild('link', $this->app->Url_cliente);
                        $channel->addChild('description', 'Feed de notícias '.$this->app->Nome_app_txf);

// Define a consulta MySQL
// Inclui um <item> para cada resultado encontrado
//                ver(count($posts));


                        foreach ($posts as $post) {

                            $id = $post->Id_int;
                            $titulo = $post->Titulo_txf;
                            //  $texto = $post->Conteudo_txa;
                            //            $texto = ignora_tags(strip_tags(html_entity_decode($post->Conteudo_txa)));

                            $texto = cria_tags((html_entity_decode($post->Conteudo_txa)), $config, $post->Imagens, $post->Videos, $post->Arquivos, $post->Notas);
                            $data = $post->Data_dat;
// Cria um elemento <item> dentro de <channel>
                            $item = $channel->addChild('item');
// Adiciona sub-elementos ao elemento <item>
                            $item->addChild('title', $titulo);
//                    $autor = $this->mbc->executa_sql("select * from autor_perfil where Autor_sel='{$post->Autor_sel}'");
//                    if ($autor[0]) {
//                        $item->addChild('author', $autor[0]->Email_txf);
//                    }
                            $item->addChild('author', $post->Autor_sel);

                            $item->addChild('link', "{$this->app->Url_cliente}$pagina/{$id}");
                            $item->addChild('description', $texto);
                            $item->addChild('category', $post->Categoria_sel);
                            $item->addChild('pubDate', $data);
                        }
                        break;
                }



//               ver('chegou');
//                ver($feeds);
//                ver($feeds);
//                ver($rss);
// Define o tipo de conteúdo e o charset
                header("content-type: application/rss+xml; charset=utf-8");

// Entrega o conteúdo do RSS completo:
                //print_r($feeds);
                echo $feeds->asXML();

                die();

                break;
            case 'testenovo':



                /**
                 * For demonstration purposes, the data is defined here.
                 * In a real scenario it should be loaded from a database.
                 */
                $channel = array("title" => "Example RSS feed",
                    "description" => "Example of a RSS feed, part of a programming tutorial on making a feed in PHP.",
                    "link" => "http://www.broculos.net",
                    "copyright" => "Copyright (C) 2008 Broculos.net");

                $items = array(
                    array("title" => "Example 1",
                        "description" => "This is the description of the first example.",
                        "link" => "http://www.example.com/example1.html",
                        "pubDate" => date("D, d M Y H:i:s O", mktime(22, 10, 0, 12, 29, 2008)))
                    , array("title" => "Example 2",
                        "description" => "This is the description of the second example.",
                        "link" => "http://www.example.com/example2.html",
                        "pubDate" => date("D, d M Y H:i:s O", mktime(14, 27, 15, 1, 3, 2008)))
                );

                $output = '<?xml version="1.0" encoding="ISO-8859-1"?>';
                $output .= '<rss version="2.0">';
                $output .= "<channel>";
                $output .= "<title>" . $channel["title"] . "</title>";
                $output .= "<description>" . $channel["description"] . "</description>";
                $output .= "<link>" . $channel["link"] . "</link>";
                $output .= "<copyright>" . $channel["copyright"] . "</copyright>";

                foreach ($items as $item) {
                    $output .= "<item>";
                    $output .= "<title>" . $item["title"] . "</title>";
                    $output .= "<description>" . $item["description"] . "</description>";
                    $output .= "<link>" . $item["link"] . "</link>";
                    $output .= "<pubDate>" . $item["pubDate"] . "</pubDate>";
                    $output .= "</item>";
                }
                $output .= "</channel>";
                $output .= "</rss>";

                header("Content-Type: application/rss+xml; charset=ISO-8859-1");
                echo $output;
                die();
                break;
            case 'teste':
                // array com itens, simulando resultados do banco de dados
                $data = array(
                    array(
                        'titulo' => 'Página Pessoal',
                        'link' => 'http://www.diogomatheus.com.br/',
                        'description' => 'Descrição da página pessoal'
                    ),
                    array(
                        'titulo' => 'Blog',
                        'link' => 'http://www.diogomatheus.com.br/blog/',
                        'description' => 'Descrição do blog'
                    )
                );

                $feeds = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><rss></rss>');
                $feeds->addAttribute('version', '2.0');

// Criar elemento channel, como filho do elemento rss
                $channel = $feeds->addChild('channel');
                $channel->addChild('title', 'Criando Feeds RSS com PHP');
                $channel->addChild('link', 'http://www.diogomatheus.com.br');
                $channel->addChild('description', 'Feed RSS usando SimpleXMLElement');

// Percorrer os dados pré-definidos
                foreach ($data as $item) {
                    // Criar elemento item, como filho do elemento channel
                    $item_channel = $channel->addChild('item');
                    // Criar elementos, filhos do elemento item
                    $item_channel->addChild('title', $item['titulo']);
                    $item_channel->addChild('link', $item['link']);
                    $item_channel->addChild('description', $item['description']);
                    // Simular horário de inserção
                    $item_channel->addChild('pubDate', date('r'));
                }

// Definir tipo de resposta do script e charset de codificação
                header("content-type: application/rss+xml; charset=utf-8");

//                ver('chegou');
// Imprimir XML gerado
                print_r($feeds->asXML());
                die();
                break;
        }
    }

}

?>