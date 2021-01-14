<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_blog.php');

class exportar extends lands_core {

    public $usuario;
    public $pasta = 'public_html/';

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


        die('modulo nao programado');
        $this->conecta_mbc($this->app->Conexoes_for);
        switch ($this->pagina_atual) {

            case 'imobifort':
                $pastas = $this->busca_pastas_arquivos();
                $this->smarty->assign("pastas", $pastas);
                break;

            case 'importar_fotos_imobifort':

                $pasta = $_POST['pasta'];
                $arquivos = $this->busca_pastas_arquivos("upload/{$pasta}");



                $dados = array_to_object($_POST);
                $dados->Codigo_txf = $pasta;
                $imovel = $this->mbc->executa_sql("select * from imoveis where Codigo_txf='{$dados->Codigo_txf}'");
                if ($imovel[0]) {
                    $dados->Id_int = $imovel[0]->Id_int;

                    foreach ($arquivos as $arquivo) {
                        $this->insere_imagem($dados, $arquivo);
                        //   $this->deleta_arquivo($dados, $arquivo);
                    }
                } else {
                    echo ('imovel nao encontrado');
                }

                $this->deleta_pasta($dados);

                redireciona($this->app->Url_cliente . 'importar/imobifort');
                die();
                break;
        }
    }

    function insere_imagem($dados, $arquivo) {



        $caminho = $this->transfere_imagem($dados, $arquivo->Nome_txf);
        $imagem = new stdClass();
        $imagem->Caminho_txf = $caminho;
        $imagem->Tabela_con = 'imoveis';
        $imagem->Campo_sel = 'Imagens_ico';
        $imagem->Id_imagem_con = $dados->Id_int;
        $imagem_inserir = object_to_array($imagem);
        $this->mbc->db_insert('imagens', $imagem_inserir);
    }

    function transfere_imagem($dados, $arquivo, $tipo = 'imagem') {
        $origem = str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']);
        $origem.= "upload/{$dados->pasta}/{$arquivo}";

        $destino = str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']);
        $destino.= "painel/img/{$this->dados_conexao['database']}/{$arquivo}";

        $caminho = "img/{$this->dados_conexao['database']}/{$arquivo}";

        $copy = copy($origem, $destino);
        return $caminho;
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
            if ($entry != '.' && $entry != '..') {
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

?>