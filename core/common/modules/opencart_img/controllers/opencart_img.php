<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class opencart_img extends lands_core {

    public $usuario;
    public $pasta = 'public_html/';

    function __construct() {
        $this->load->library('session');
        parent::__construct();
        
        $this->checa_login();
    }

    function index() {
        $funcao = $this->pagina_atual;
        if ($this->uri->segment($this->app->Segmento_padrao_txf)) {
            $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);
            $funcao = ($this->uri->segment($this->app->Segmento_padrao_txf));
        }
        if (!method_exists(__CLASS__, $funcao)) {
            $this->carrega_pagina($this->pagina_atual);
        } else {
//executa uma funcao que deve ser programa nesta classe.
            $this->$funcao();
        }
    }

    function switch_pagina() {
        $this->load->library('session');

        switch ($this->pagina_atual) {
            case 'inicio':
                $pastas = $this->busca_pastas_arquivos();
                $this->smarty->assign("pastas", $pastas);
                $this->busca_categorias();
                break;
            default:
                break;
        }
    }

    function busca_pastas_arquivos($dir = 'upload') {
        $i = 0;

//                $dir = "upload";
        $folders = $this->sdir($dir);
        $pastas = array();
        foreach ($folders as $folder) {
            $i = $i + 1;
            $pasta = new stdClass();
            $pasta->Id_int = $i;
            $pasta->Nome_txf = $folder;
            $pasta->Arquivos = $this->sdir($dir . '/' . $folder);
            $pastas[] = $pasta;
        }
        return $pastas;
    }

    function busca_categorias($category_id = null) {
        $raiz = " and parent_id='0' ";
        $sql = "select c.parent_id,cd.* from category c
                left outer join category_description cd
                on cd.category_id = c.category_id 
                where c.category_id is not null";
        $order = " order by cd.name";
        if ($category_id) {
            $wherecat = " and c.category_id='{$category_id}' ";
            $categorias = $this->mbc->executa_sql($sql . $wherecat);
        } else {
            $categorias = $this->mbc->executa_sql($sql . $raiz . $order);
            foreach ($categorias as $categoria) {
                $andsub = " and c.parent_id='{$categoria->category_id}' ";
                $categoria->filhas = $this->mbc->executa_sql($sql . $andsub . $order);
                foreach ($categoria->filhas as $sub) {
                    $andsub = " and c.parent_id='{$sub->category_id}' ";
                    $sub->netas = $this->mbc->executa_sql($sql . $andsub . $order);
                }
            }
        }

        $this->smarty->assign("categorias", $categorias);
        return $categorias;
    }

    function postar() {
        $pagina = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
        switch ($pagina) {
            case 'fotos':

                $pasta = $_POST['pasta'];
                $arquivos = $this->busca_pastas_arquivos("upload/{$pasta}");

                $dados = array_to_object($_POST);
                $contagem = $dados->contagem;

                foreach ($arquivos as $arquivo) {

                    $this->cria_produto($dados, $arquivo, $contagem);
                    $this->deleta_arquivo($dados, $arquivo);

                    $contagem = $contagem + 1;
                }

                $this->deleta_pasta($dados);

                $contagem = $contagem - 1;
                echo "$contagem produtos criados";
               echo "<br><a href='{$this->app->Url_cliente}'>Clique aqui para retornar ao sistema</a>";
                die();
//                redireciona($this->app->Url_cliente.'inicio');
                
                break;
            default:
                break;
        }
    }

    function deleta_arquivo($dados, $arquivo) {
        $caminho = 'upload/' . $dados->pasta . '/' . $arquivo->Nome_txf;
        if (file_exists($caminho)) {
            unlink($caminho);
        } else {
            echo ("Arqvuivo {$arquivo->Nome_txf} existe");
        }
    }

    function deleta_pasta($dados) {

        $caminho = 'upload/' . $dados->pasta . '/';

        $this->deleteDir($caminho);
    }

    function deleteDir($dirPath) {
        if (!is_dir($dirPath)) {
            ver('nao existe a pasta');
//            throw new InvalidArgumentException("$dirPath must be a directory");
        } else {
            
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }

    function cria_produto($dados, $arquivo, $contagem = '') {
        if (!$dados->price) {
            die('preco nao enviado');
        }
        if (!$dados->category_id) {
            die('categoria nao enviado');
        }
        if (!$dados->pasta) {
            die('pasta nao enviado');
        }
        if (!$arquivo->Nome_txf) {
            die('arquivo nao enviado');
        }
        if (!$dados->titulo) {
            die('titulo nao enviado');
        }

        $categoria = $this->busca_categorias($dados->category_id);
        
        $contagem=str_pad($contagem, 3, "0", STR_PAD_LEFT);
        $nome = $dados->titulo . ' ' . $contagem;
        $produto_temp = new stdClass();
        $produto_temp->model = $arquivo->Nome_txf;
        $produto_temp->name = $nome;
        $produto_temp->quantity = 1;
        $produto_temp->description = '';
        $produto_temp->meta_description = $categoria[0]->meta_description;
        $produto_temp->meta_keyword = $categoria[0]->meta_keyword;
        $produto_temp->tag = $categoria[0]->meta_keyword;
        $produto_temp->date_added = date('Y-m-d H:i:s');
        $produto_temp->date_avaible = date('Y-m-d');
        $produto_temp->sort_order = 1;
        $produto_temp->shipping = 0;
        $produto_temp->weight = 0;
        $produto_temp->length = 0;
        $produto_temp->width = 0;
        $produto_temp->height = 0;
        $produto_temp->price = 0;
        $produto_temp->status = 1;
        $produto_temp->subtract = 0;
        $produto_temp->language_id = 2;
        $produto_temp->image = $this->transfere_imagem($dados, $arquivo->Nome_txf);
//ver($produto_temp);
//        ver('transferiu');
        $produto = object_to_array($produto_temp);

        $this->mbc->db_insert('product', $produto);
        echo "inseriu o produto<br>";
        $product_id = $this->mbc->executa_sql("select * from product order by product_id desc limit 1");
        if ($product_id[0]) {
            $produto['product_id'] = $product_id[0]->product_id;
            $produto['store_id'] = 0;
            $produto['category_id'] = $dados->category_id;
            $this->mbc->db_insert('product_description', $produto);
            echo "inseriu o product_to_store<br>";
            $this->mbc->db_insert('product_to_store', $produto);
            echo "inseriu o product_to_store<br>";
            $this->mbc->db_insert('product_to_category', $produto);
            echo "inseriu o product_to_category<br>";
            $produto['option_id'] = 17;
            $produto['required'] = 1;
            $this->mbc->db_insert('product_option', $produto);
            echo "inseriu o product_option<br>";
        }


        /* product_option values ADICIONA A OPCAO DE COMPRA DE FOTO DIGITAL */
        $option_id = $this->mbc->executa_sql("select * from product_option order by product_option_id desc limit 1");
        if ($option_id[0]) {
            $option_values['product_option_id'] = $option_id[0]->product_option_id;
            $option_values['product_id'] = $product_id[0]->product_id;
            $option_values['option_id'] = 17;
            $option_values['option_value_id'] = 57;
            $option_values['quantity'] = 100;
            $option_values['subtract'] = 0;
            $option_values['price'] = $dados->price;
            $option_values['price_prefix'] = '+';
            $option_values['points'] = '0';
            $option_values['points_prefix'] = '+';
            $option_values['weight'] = '0.0000';
            $option_values['weight_prefix'] = '+';
            $option_values['opt_min'] = '1';
            $option_values['opt_max'] = '1';
            $option_values['opt_step'] = '1';
            $option_values['customer_group_id'] = '1';
            $this->mbc->db_insert('product_option_value', $option_values);
            echo "inseriu o product_option_value<br>";
        }

        $download['filename'] = $this->transfere_imagem($dados, $arquivo->Nome_txf, 'download');
        $download['mask'] = $arquivo->Nome_txf;
        $download['date_added'] = date('Y-m-d H:i:s');
        $download['remaining'] = 9999999;
        $this->mbc->db_insert('download', $download);
        echo "inseriu o download<br>";

        $download_id = $this->mbc->executa_sql("select * from download order by download_id desc limit 1");
        if ($download_id[0]) {
            $download['product_id'] = $product_id[0]->product_id;
            $download['download_id'] = $download_id[0]->download_id;
            $download['language_id'] = 2;
            $download['name'] = $nome;
            $this->mbc->db_insert('download_description', $download);
            echo "inseriu o download_description<br>";
            $this->mbc->db_insert('product_to_download', $download);
            echo "inseriu o download<br>";
        }
        echo("$nome inserida por completo<br><br><br>");
    }

    function transfere_imagem($dados, $arquivo, $tipo = 'imagem') {
        $origem = "/home/photoesp/public_html/automatizador/upload/{$dados->pasta}/{$arquivo}";

        switch ($tipo) {
            case 'imagem':
                $caminho_pasta = "/home/photoesp/public_html/image/data/{$dados->pasta}";
                $destino = "$caminho_pasta/{$arquivo}";
                $caminho = "data/{$dados->pasta}/{$arquivo}";

                if (!$this->pasta_existe($caminho_pasta)) {
                    mkdir($caminho_pasta);
                }
                $copy = copy($origem, $destino);

                break;
            case 'download':
//                $caminho_pasta = "/home/photoesp/public_html/download/{$dados->pasta}";
                $mask = base64_encode("{$dados->pasta}/{$arquivo}");
                $destino = "/home/photoesp/public_html/download/{$arquivo}.{$mask}";
                $caminho = "$arquivo.$mask";
//                if (!$this->pasta_existe($caminho_pasta)) {
//                    mkdir($caminho_pasta);
//                }
                $copy = copy($origem, $destino);
//                $download['filename'] = $arquivo->Nome_txf . '840918410981409';
                break;
        }
        return $caminho;
    }

    function pasta_existe($folder) {
        $path = realpath($folder);
        if ($path !== false AND is_dir($path)) {
            return $path;
        }
        return false;
    }

    function sdir($path = '.', $masks = '*', $nocache = 0) {
        static $dir = array(); // cache result in memory 
        if (!isset($dir[$path]) || $nocache) {
            $dir[$path] = scandir($path);
        }
        $masks = explode("|", $masks);
        foreach ($dir[$path] as $i => $entry) {
            if ($entry != '.' && $entry != '..' & $entry != '.ftpquota') {
                foreach ($masks as $mask) {
                    if (fnmatch($mask, $entry)) {
                        $sdir[] = $entry;
                    }
                }
            }
        }
        
        return $sdir;
    }

}

