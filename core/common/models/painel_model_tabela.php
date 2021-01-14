<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  ESTA CLASSE SE COMUNICA COM O BANCO DE DADOS DO SITE, 
 *  UTILIZANDO AS CONFIGURAÇÕES QUE FORAM PASSADAS PELO MODEL
 *  GERENCIADOR
 * 
 *  ESTA CLASSE É A RESPONSAVEL POR EDITAR OS REGISTROS
 *  
 */

class Painel_model_tabela extends Model_banco_cliente {

    public $db = null;
    public $app;
    public $cliente;
    public $modulo;
    public $configuracoes;

    function __construct() {
        parent::__construct();
    }

    function inicializa($app, $cliente = null, $modulo = null, $configuracoes = null) {
        $this->app = $app;

        if ($cliente) {
            $this->cliente = $cliente;
        }
        if ($modulo) {
            $this->modulo = $modulo;
        }
        if ($configuracoes) {
            $this->configuracoes = $configuracoes;
        }
    }

    function valida_tabelas($menu = null) {
        $tabelas = array();
        $lista_tabelas = $this->executa_sql("show tables");
        foreach ($lista_tabelas as $key) {
            foreach ($key as $k) {
                $tabelas[] = $k;
            }
        }
        $this->tabelas = $tabelas;
        foreach ($menu as $sessao) {
            foreach ($sessao->Tabelas as $item => $valor) {
                if (!in_array($valor->Tabela_txf, $tabelas)) {
                    unset($sessao->Tabelas[$item]);
                }
            }
        }
        return $menu;
    }

    function clonar_registro($dados, $id_objeto_con = FALSE) {



        $tabela = $dados->Tabela;

        $id_registro = $dados->Id_int;


        $registro = $this->buscar_completo($dados->Tabela, "where Id_int={$dados->Id_int}");


        $array_insert = object_to_array($registro[0]);
        unset($array_insert['Id_int']);
        if ($id_objeto_con) {
            $array_insert['Id_objeto_con'] = $id_objeto_con;
        }

        $novo_registro = $this->db_insert($tabela, $array_insert, TRUE);


        if (isset($dados->Imagens)) {

            $imagens = array();
            $imagens = $registro[0]->Imagens;

            $this->copia_imagens($novo_registro, $imagens, $tabela);
        }
        if (isset($dados->Arquivos)) {
            $arquivos = array();
            $arquivos = $registro[0]->Arquivos;

            $this->copia_arquivos($novo_registro, $arquivos, $tabela);
        }
        if (isset($dados->Videos)) {
            $videos = array();
            $videos = $registro[0]->Videos;
            $this->copia_videos($novo_registro, $videos);
        }
        if (isset($dados->Vinculos)) {
            $this->copia_vinculos($dados, $tabela, $registro[0], $novo_registro);
        }

        return $novo_registro;
    }

    function copia_imagens($novo_registro, $imagens, $tabela) {
        $id_registro = $novo_registro->Id_int;
        foreach ($imagens as $imagem) {
            $new_dir = $this->configuracoes->Ftp_caminho_txf;

            $img_antiga = $new_dir . $imagem->Caminho_txf;
            $ext = strtolower(pathinfo($img_antiga, PATHINFO_EXTENSION));
            $new_name = $id_registro . '_' . $tabela . '_' . date("His") . uniqid("") . '.' . $ext;
            $img_nova = "{$new_dir}img/{$this->db->database}/$new_name";
            $temp = "/home/landsage/public_html/subdominios/painel/painel/img/{$this->db->database}/$new_name";
            $dir = "/home/landsage/public_html/subdominios/painel/painel/img/{$this->db->database}/";
            if (!file_exists($dir)) {

                echo "Criando pasta $dir <br>";
                mkdir($dir, 0755, true);
            }


            if ($this->ftp->copia_remoto($img_antiga, $img_nova, $temp)) {
                unset($imagem->Id_int);
                $imagem->Id_imagem_con = $id_registro;
                $imagem->Caminho_txf = "img/{$this->db->database}/$new_name";
                $array_insert = object_to_array($imagem);
                $this->db_insert('imagens', $array_insert, TRUE);
            } else {
                echo "deu pau no copiar imagem $img_antiga <br> ";
            }
        }
    }

    function copia_arquivos($novo_registro, $arquivos, $tabela) {
        $id_registro = $novo_registro->Id_int;
        foreach ($arquivos as $arquivo) {
            $new_dir = $this->configuracoes->Ftp_caminho_txf;
            $img_antiga = $new_dir . $arquivo->Caminho_txf;
            $ext = strtolower(pathinfo($img_antiga, PATHINFO_EXTENSION));
            $new_name = $id_registro . '_' . $tabela . '_' . date("His") . uniqid("") . '.' . $ext;
            $img_nova = "{$new_dir}arquivos/{$this->db->database}/$new_name";
            $temp = "/home/landsage/public_html/subdominios/painel/painel/arquivos/{$this->db->database}/$new_name";
            $dir = "/home/landsage/public_html/subdominios/painel/painel/arquivos/{$this->db->database}/";
            if (!file_exists($dir)) {

                echo "Criando pasta $dir <br>";
                mkdir($dir, 0755, true);
            }
            if ($this->ftp->copia_remoto($img_antiga, $img_nova, $temp)) {
                unset($arquivo->Id_int);
                $arquivo->Id_arquivo_con = $id_registro;
                $arquivo->Caminho_txf = "arquivos/{$this->db->database}/$new_name";
                $array_insert = object_to_array($arquivo);
                $this->db_insert('arquivos', $array_insert, TRUE);
            }
        }
    }

    function copia_videos($novo_registro, $videos) {
        $id_registro = $novo_registro->Id_int;
        foreach ($videos as $video) {
            unset($video->Id_int);
            $video->Id_video_con = $id_registro;
            $array_insert = object_to_array($video);
            $this->db_insert('videos', $array_insert, TRUE);
        }
    }

    function copia_vinculos($dados, $tabela, $registro, $novo_registro) {

        $campos = $this->executa_sql("describe $tabela");
        foreach ($campos as $campo) {
            $campo->Tipo = retorna_extensao($campo->Field);
        }

// monta as propriedades dos campos..



        $campos_vin = array();
        foreach ($campos as $campo) {
            if ($campo->Tipo == 'vin') {

                $campo->Tabela_vin = strtolower(remove_sufixo2($campo->Field));
                $campos_vin[] = $campo;
            }
        }

        if (isset($campos_vin[0])) {
            foreach ($campos_vin as $campo_vin) {
                $tabela = $campo_vin->Tabela_vin;
                $id_objeto_con = $dados->Id_int;
                $registros_vin = $this->buscar_completo($tabela, " where Id_objeto_con={$id_objeto_con}");
                unset($dados->Vinculos);
//                unset($dados->Imagens);
//                unset($dados->Videos);
//                unset($dados->Arquivos);
                foreach ($registros_vin as $vinculo) {
                    $dadosnovos = $dados;
                    $dadosnovos->Quantidade = 1;
                    $dadosnovos->Tabela = $campo_vin->Tabela_vin;
                    $dadosnovos->Id_int = $vinculo->Id_int;
                    $this->clonar_registro($dadosnovos, $novo_registro->Id_int);
                }
            }
        }








//        foreach ($videos as $video) {
//            unset($video->Id_int);
//            $video->Id_video_con = $id_registro;
//            $array_insert = object_to_array($video);
//            $this->db_insert('videos', $array_insert, TRUE);
//        }
//        echo "copia vinculos nao implementado<br>";
    }

    function compacta_imagem($arquivo, $destino, $formato = FALSE, $compactacao = '70') {
        include_once COMMONPATH . 'third_party/ImgCompressor/lib/ImgCompressor.class.php';

        // include ImgCompressor.php
// setting
//        $compacto=  str_replace("/home/landsage/public_html/subdominios/painel/","",$destino);
        $setting = array(
            'directory' => $destino, // directory file compressed output
            'file_type' => array(// file format allowed
                'image/jpeg',
                'image/png',
                'image/gif'
            )
        );

// create object
        $ImgCompressor = new ImgCompressor($setting);
        if (!$formato) {
            $formato = strtolower(substr($arquivo, -3));
        }

        $compactacao = 10 - ($compactacao / 10);

// run('STRING original file path', 'output file type', INTEGER Compression level: from 0 (no compression) to 9);
        $result = $ImgCompressor->run($arquivo, $formato, $compactacao); // example level = 2 same quality 80%, level = 7 same quality 30% etc

        return $result;
//
////
        //
// result array
//        echo '<pre>';
//        print_r($result);
//        echo '</pre>';
    }

    function monta_cabecalho($tabela, $configuracoes = null) {

        $campos = $this->executa_sql("describe $tabela");

// monta as propriedades dos campos..
        foreach ($campos as $campo) {
            if (isset($configuracoes->Excecoes[0])) {
                foreach ($configuracoes->Excecoes as $execao) {
                    if ($execao->Campo_txf == $campo->Field) {
                        $campo->Excecoes = json_decode($execao->Config_jso);
                    }
                }
            }
        }



//monta o campo Tipo do campo.... e escreve a url amigavel..
        foreach ($campos as $campo) {
            $campo->Tipo = retorna_extensao($campo->Field);
            if (isset($campo->Excecoes->Label)) {
                $campo->Label = $campo->Excecoes->Label;
            } else {
                if ($campo->Tipo == 'url') {
                    $campo->Label = 'Url Amigável';
                } else {
                    $lbl = remove_sufixo($campo->Field);
                    $lbl = str_replace("_", " ", $lbl);
                    $campo->Label = $lbl;
                }
            }
        }


        return $campos;
    }

    /* MONTA OS CAMPOS PARA A LISTAGEM */

    function monta_campos_listagem($tabela, $configuracoes = null) {
        $campos = $this->executa_sql("describe $tabela");

// monta as propriedades dos campos..
        foreach ($campos as $campo) {
            if (isset($configuracoes->Excecoes[0])) {
                foreach ($configuracoes->Excecoes as $execao) {
                    if ($execao->Campo_txf == $campo->Field) {
                        $campo->Excecoes = json_decode($execao->Config_jso);
                    }
                }
            }
        }


//monta o campo Tipo do campo.... e escreve a url amigavel..
        foreach ($campos as $campo) {
            $campo->Tipo = retorna_extensao($campo->Field);
            if (isset($campo->Excecoes->Label)) {
                $campo->Label = $campo->Excecoes->Label;
            } else {
                if ($campo->Tipo == 'url') {
                    $campo->Label = 'Url Amigável';
                } else {
                    $lbl = remove_sufixo($campo->Field);
                    $lbl = str_replace("_", " ", $lbl);
                    $campo->Label = $lbl;
                }
            }
        }

// se tiver setado o campo listagem, ele deixa somente os campos que estão na lista
        if (isset($configuracoes->Config->listagem)) {
            $array_campos = explode(",", $configuracoes->Config->listagem);

            $lista_campos = array();

            foreach ($campos as $campo) {
                if (in_array($campo->Field, $array_campos)) {
                    if ($this->campoexiste($campo->Field, $configuracoes->Tabela_txf)) {
                        $lista_campos[] = $campo;
                    }
                }
            }
            $campos = $lista_campos;
        } else {

            //se nao tiver ele vai exibir apenas os principais tipos...
            foreach ($campos as $campo) {
                switch ($campo->Tipo) {
                    case 'int':
                        if ($campo->Field == 'Id_int') {
                            $lista_campos[] = $campo;
                        }

                        break;
                    case 'tit':
                        $lista_campos[] = $campo;
                        break;
                    case 'txf':
                        $lista_campos[] = $campo;
                        break;
                    case 'sel':
                        if ($campo->Field == 'Ativo_sel') {
                            $lista_campos[] = $campo;
                        }
                        break;
                }
            }

// se tiver apenas 1 campo, ele busca os txa tbm...
            if (count($lista_campos) == 1) {
                $lista_campos = null;
                foreach ($campos as $campo) {
                    switch ($campo->Tipo) {
                        case 'int':
                            if ($campo->Field == 'Id_int') {
                                $lista_campos[] = $campo;
                            }
                            break;
                        case 'txa':
                            $lista_campos[] = $campo;
                            break;
                        case 'vid':
                            if ($campo->Field != 'Videos_vid') {
                                $lista_campos[] = $campo;
                            }
                            break;
                    }
                }
                $lista_campos[] = $campo;
            }

            $campos = $lista_campos;
        }
        return $campos;
    }

    function exclui_imagem($id_imagem) {

        $sql = "select * from imagens where Id_int=$id_imagem";


        $imagem = $this->executa_sql($sql);
        if (isset($imagem[0])) {

            $arquivo = FCPATH . $this->app->Pasta_painel . '/' . $imagem[0]->Caminho_txf;

            $arquivo = str_replace('//', '/', $arquivo);
            if (file_exists($arquivo)) {
                unlink($arquivo);
                return $this->db_delete('imagens', 'Id_int', $id_imagem);
            }
        }
    }

    function exclui_arquivo($id_arquivo) {
        $sql = "select * from arquivos where Id_int=$id_arquivo";
        $arquivo = $this->executa_sql($sql);
        if (isset($arquivo[0])) {
            $arquivo = FCPATH . $this->app->Pasta_painel . '/' . $arquivo[0]->Caminho_txf;
            $arquivo = str_replace('//', '/', $arquivo);
            if (file_exists($arquivo)) {
                unlink($arquivo);
                return $this->db_delete('arquivos', 'Id_int', $id_arquivo);
            }
        }
    }

    function retorna_imagens($tabela, $id, $campo = null) {
        $and = '';
        if ($campo != null) {
            $and = " and Campo_sel='{$campo}' ";
        }
        $sql = "select * from imagens where Tabela_con='{$tabela}' and Id_imagem_con={$id} ";
        $sql.=$and;
        $imagens = $this->executa_sql($sql);
        return $imagens;
    }

    function ordena_imagens($tabela, $id, $ordenacao, $campo = null) {
        $and = '';
        if ($campo != null) {
            $and = " and Campo_sel='{$campo}' ";
        }
        $sql = "select * from imagens where Tabela_con='{$tabela}' and Id_imagem_con={$id} ";
        $sql.=$and;
        $imagens = $this->executa_sql($sql);
        foreach ($imagens as $imagem) {
            foreach ($ordenacao as $key => $value) {

                if ($imagem->Id_int == $value) {
                    $imagem->Ordem_int = $key;
                    $dados = object_to_array($imagem);
                    unset($dados['Id_int']);
                    unset($dados['Caminho_txf']);

                    $this->updateTable('imagens', $dados, 'Id_int', $imagem->Id_int);
                }
            }
        }
        return $imagens;
    }

    function ordena_arquivos($tabela, $id, $ordenacao, $campo = null) {
        $and = '';
        if ($campo != null) {
            $and = " and Campo_sel='{$campo}' ";
        }
        $sql = "select * from arquivos where Tabela_con='{$tabela}' and Id_arquivo_con={$id} order by Ordem_int,Id_int";
        $sql.=$and;
        $arquivos = $this->executa_sql($sql);
        foreach ($arquivos as $arquivo) {
            foreach ($ordenacao as $key => $value) {

                if ($arquivo->Id_int == $value) {
                    $arquivo->Ordem_int = $key;
                    $dados = object_to_array($arquivo);
                    unset($dados['Id_int']);
                    unset($dados['Caminho_txf']);

                    $this->updateTable('arquivos', $dados, 'Id_int', $arquivo->Id_int);
                }
            }
        }
        return $arquivos;
    }

    function ordena_videos($tabela, $id, $ordenacao, $campo = null) {
        $and = '';
        if ($campo != null) {
            $and = " and Campo_sel='{$campo}' ";
        }
        $sql = "select * from videos where Tabela_con='{$tabela}' and Id_video_con={$id} ";
        $sql.=$and;
        $videos = $this->executa_sql($sql);
        foreach ($videos as $video) {
            foreach ($ordenacao as $key => $value) {

                if ($video->Id_int == $value) {
                    $video->Ordem_int = $key;
                    $dados = object_to_array($video);
                    unset($dados['Id_int']);
                    unset($dados['Caminho_txf']);

                    $this->updateTable('videos', $dados, 'Id_int', $video->Id_int);
                }
            }
        }
        return $videos;
    }

    function envia_video($arquivo, $id, $ordem, $campo = null) {



        $endereco = explode("v=", $arquivo['Endereco_txf']);
        if ($endereco[1]) {
            $valor = $endereco[1];
        } else {
            $valor = $arquivo['Endereco_txf'];
        }

        $arquivo_inserir['Tabela_con'] = $arquivo['Tabela_con'];
//                    $arquivo_inserir['Descricao_txf'] = 'Arquivo de contato';
        $arquivo_inserir['Endereco_txf'] = $valor;
        $arquivo_inserir['Titulo_txf'] = $arquivo['Titulo_txf'];
//                    $arquivo_inserir['Tipo_txf'] = strtolower($ext);
//                    $arquivo_inserir['Nome_txf'] = $name;
        $arquivo_inserir['Campo_sel'] = $campo;
        $arquivo_inserir['Ordem_int'] = $ordem;
        $arquivo_inserir['timestamp_hid'] = time();

//                    $arquivo['Nome_txf'] = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($name));
//                    $arquivo_inserir['Data_int'] = time();
        $arquivo_inserir['Id_video_con'] = $id;
        $videos = $this->db_insert('videos', $arquivo_inserir, TRUE);



        return $videos;
    }

    function envia_imagem($arquivo, $tabela, $id, $ordem, $campo = null) {
        //  echo "Jhonatan, preciso que vc envie junto com as imagens campo Ordem_int.. dizendo qual a ordem que ela vai entrar, sempre por ultimo!";
        if (!isset($campo)) {
            foreach ($arquivo as $key => $value) {
                $campo = $key;
                break;
            }
        }
        $pasta_painel = $this->app->Pasta_painel;
        $name = $arquivo['file']['name']; //Atribui uma array com os nomes dos arquivos à variável
        $tmp_name = $arquivo['file']['tmp_name']; //Atribui uma array com os nomes temporários dos arquivos à variável

        if ($name) {
            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            $new_name = $id . '_' . $tabela . '_' . date("His") . uniqid("") . '.' . $ext;
            $pasta = $this->db->database;
//                $pasta = $tabela;
            $dir = FCPATH . $pasta_painel . '/img/' . $pasta . '/';
            $dir = str_replace('//', '/', $dir);
            $arq = $dir . $new_name;

            $caminho_relativo = 'img/' . $pasta . '/' . $new_name;
            $caminho_relativo = str_replace('//', '/', $caminho_relativo);

            if (!file_exists($dir)) {

                echo "Criando pasta $dir <br>";
                mkdir($dir, 0755, true);
            }




            move_uploaded_file($tmp_name, $arq);

            if (file_exists($arq)) {
                $arquivo_inserir['Tabela_con'] = $tabela;
//                    $arquivo_inserir['Descricao_txf'] = 'Arquivo de contato';
                $arquivo_inserir['Caminho_txf'] = $caminho_relativo;
//                    $arquivo_inserir['Tipo_txf'] = strtolower($ext);
//                    $arquivo_inserir['Nome_txf'] = $name;
                $arquivo_inserir['Campo_sel'] = $campo;
                $arquivo_inserir['Ordem_int'] = $ordem;
//                    $arquivo['Nome_txf'] = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($name));
//                    $arquivo_inserir['Data_int'] = time();
                $arquivo_inserir['Id_imagem_con'] = $id;
                $imagens = $this->db_insert('imagens', $arquivo_inserir, TRUE);
            }
        }

        return $imagens;
    }

    function envia_arquivo($arquivo, $tabela, $id, $ordem, $campo = null) {

        if (!isset($campo)) {
            foreach ($arquivo as $key => $value) {
                $campo = $key;
                break;
            }
        }
        $pasta_painel = $this->app->Pasta_painel;
        $name = $arquivo['file']['name']; //Atribui uma array com os nomes dos arquivos à variável
        $tmp_name = $arquivo['file']['tmp_name']; //Atribui uma array com os nomes temporários dos arquivos à variável

        if ($name) {
            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            $new_name = $id . '_' . $tabela . '_' . date("His") . uniqid("") . '.' . $ext;
            $pasta = $this->db->database;
//                $pasta = $tabela;
            $dir = FCPATH . $pasta_painel . '/arquivos/' . $pasta . '/';
            $dir = str_replace('//', '/', $dir);
            $arq = $dir . $new_name;

            $caminho_relativo = 'arquivos/' . $pasta . '/' . $new_name;
            $caminho_relativo = str_replace('//', '/', $caminho_relativo);


            if (!file_exists($dir)) {

                echo "Criando pasta $dir <br>";
                mkdir($dir, 0755, true);
            }


            move_uploaded_file($tmp_name, $arq);

            if (file_exists($arq)) {
                $arquivo_inserir['Tabela_con'] = $tabela;
//                    $arquivo_inserir['Descricao_txf'] = 'Arquivo de contato';
                $arquivo_inserir['Caminho_txf'] = $caminho_relativo;
//                    $arquivo_inserir['Tipo_txf'] = strtolower($ext);
                $arquivo_inserir['Campo_sel'] = $campo;
                $arquivo_inserir['Tipo_txf'] = $ext;
                $arquivo_inserir['Nome_txf'] = $name;
                $arquivo_inserir['Ordem_int'] = $ordem;
                $arquivo_inserir['Data_int'] = time();

//                    $arquivo['Nome_txf'] = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($name));
//                    $arquivo_inserir['Data_int'] = time();
                $arquivo_inserir['Id_arquivo_con'] = $id;
                $imagens = $this->db_insert('arquivos', $arquivo_inserir, TRUE);
            }
        }

        return $imagens;
    }

    function atualiza_tabela($tabela) {


        switch ($tabela) {
            case 'arquivos':
                if (!$this->campoexiste('Ordem_int', $tabela)) {

                    $sql = "ALTER TABLE `arquivos` ADD `Ordem_int` int(11) COLLATE 'latin1_swedish_ci' NOT NULL, COMMENT='Campo de ordenacao';";
                    echo "criou campo ordem<br>";
                    $this->db->query($sql);
                }
                if (!$this->campoexiste('Campo_sel', $tabela)) {

                    $sql = "ALTER TABLE `arquivos` ADD `Campo_sel` varchar(255) COLLATE 'latin1_swedish_ci' NOT NULL, COMMENT='Campo de ordenacao';";
                    echo "criou campo Campo_sel<br>";
                    $this->db->query($sql);
                }
                break;
            case 'videos':
                if (!$this->campoexiste('Ordem_int', $tabela)) {

                    $sql = "ALTER TABLE `videos` ADD `Ordem_int` int(11) COLLATE 'latin1_swedish_ci' NOT NULL, COMMENT='Campo de ordenacao';";
                    echo "criou campo ordem<br>";
                    $this->db->query($sql);
                }
                if (!$this->campoexiste('Campo_sel', $tabela)) {

                    $sql = "ALTER TABLE `videos` ADD `Campo_sel` varchar(255) COLLATE 'latin1_swedish_ci' NOT NULL, COMMENT='Campo de ordenacao';";
                    echo "criou campo Campo_sel<br>";
                    $this->db->query($sql);
                }
                break;

            case 'imagens':

                if (!$this->campoexiste('Ordem_int', $tabela)) {

                    $sql = "ALTER TABLE `videos` ADD `Ordem_int` int(11) COLLATE 'latin1_swedish_ci' NOT NULL, COMMENT='Campo de ordenacao';";
                    echo "criou campo ordem<br>";
                    $this->db->query($sql);
                }



                if (!$this->campoexiste('Campo_sel', $tabela)) {

                    $sql = "ALTER TABLE `videos` ADD `Campo_sel` varchar(255) COLLATE 'latin1_swedish_ci' NOT NULL, COMMENT='Campo de ordenacao';";
                    echo "criou campo Campo_sel<br>";
                    $this->db->query($sql);
                }
                break;


            default:
                break;
        }
    }

    function transfere_imagem() {
        
    }

    function busca_lista_imagens($tabela, $id_registro, $campo = null) {
        $and_campo = '';
        if ($campo) {
            $and_campo = " and Campo_sel='{$campo}'";
        }
        $sql = "select * from imagens where Tabela_con='$tabela' and Id_imagem_con='{$id_registro}' {$and_campo} order by Ordem_int, Id_int";
        $imgs = $this->executa_sql($sql);
        $this->smarty->assign('imgs', $imgs);
        return $imgs;
    }

    function monta_formulario($tabela, $configuracoes = '', $id = '') {

        if ($configuracoes == '') {
            die('configuracoes sao obrigatorias');
        }
        $id_registro = '';
        $where = '';
        $itens = array();

        if ($id != '') {
            $where = " where Id_int={$id}";
            $registro = $this->buscar_completo($tabela, $where);

            $id_registro = $registro[0]->Id_int;
            $acao = 'editar';
        } else {
            $acao = 'inserir';
        }

        $campos = $this->monta_cabecalho($tabela, $configuracoes = '', $id = '');

        foreach ($campos as $campo) {

            $campo->Acao = $acao;
            $campo->Id_registro = $id_registro;
            $campo->Tabela = $tabela;
            $nome_campo = $campo->Field;
            if (isset($registro[0])) {
                $valor = $registro[0]->$nome_campo;
            } else {
                $valor = '';
            }
            $campo->Valor = $valor;

            $this->smarty->assign('campo', $campo);
            if ($nome_campo != 'Id_int') {
                switch ($campo->Tipo) {
                    case 'txa' :
                        $tipo_campo = 'wysihtml5';
                        $this->smarty->assign('tipo_campo', $tipo_campo);
                        $itens[] = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, $this->modulo . '/tipos', 'default');
                        break;
                    case 'sma' :
                        $tipo_campo = 'smart';
                        $this->smarty->assign('tipo_campo', $tipo_campo);
                        $itens[] = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, $this->modulo . '/tipos', 'sma');
                        break;
                    case 'txp' :
                        $tipo_campo = 'password';
                        $this->smarty->assign('tipo_campo', $tipo_campo);
                        $itens[] = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, $this->modulo . '/tipos', 'txp');
                        break;
                    case 'cpk' :
                        $tipo_campo = 'color';
                        $this->smarty->assign('tipo_campo', $tipo_campo);
                        $itens[] = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, $this->modulo . '/tipos', 'cpk');
                        break;
                    case 'jso' :
                        $tipo_campo = 'jsoninput';
                        $this->smarty->assign('tipo_campo', $tipo_campo);
                        $itens[] = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, $this->modulo . '/tipos', 'jso');
                        break;
                    case 'hid':
                        //nao mostra nada
                        break;
                    case 'dat':

                        if ($campo->Type == 'datetime') {
                            $tipo_campo = 'datetime';
                        }
                        if ($campo->Type == 'date') {
                            $tipo_campo = 'date';
                        }
                        $this->smarty->assign('tipo_campo', $tipo_campo);
                        $itens[] = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, $this->modulo . '/tipos', 'dat');
                        //$detalhes = $this->executa_sql("describe $tabela");
                        //nao mostra nada
                        break;
                    case 'for':

                        $tipo_campo = 'select2';
                        $this->smarty->assign('tipo_campo', $tipo_campo);

                        $campo->Select = json_encode($this->busca_opcoes($campo));

                        $this->smarty->assign('campo', $campo);
                        $itens[] = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, $this->modulo . '/tipos', 'sel');

                        break;
                    case 'sel':
                        $tipo_campo = 'select2';
                        $this->smarty->assign('tipo_campo', $tipo_campo);
                        $campo->Select = json_encode($this->busca_opcoes($campo));
                        $this->smarty->assign('campo', $campo);
                        $itens[] = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, $this->modulo . '/tipos', 'sel');
                        //$detalhes = $this->executa_sql("describe $tabela");
                        //nao mostra nada
                        break;
                    case 'chb':
                        $tipo_campo = 'checklist';
                        $this->smarty->assign('tipo_campo', $tipo_campo);
                        $items = $this->busca_chb($campo);

                        $campo->Opcoes = json_encode($items['opcoes']);
                        $campo->Valores = $items['valores'];
                        $this->smarty->assign('campo', $campo);
                        $itens[] = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, $this->modulo . '/tipos', 'chb');
                        //$detalhes = $this->executa_sql("describe $tabela");
                        //nao mostra nada
                        break;
                    case 'est':
                        $tipo_campo = 'select2';
                        $this->smarty->assign('tipo_campo', $tipo_campo);
                        $campo->Select = json_encode($this->busca_opcoes($campo));
                        $this->smarty->assign('campo', $campo);
                        $itens[] = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, $this->modulo . '/tipos', 'sel');
                        //$detalhes = $this->executa_sql("describe $tabela");
                        //nao mostra nada
                        break;
                    case 'url':
                    case 'img':
                    case 'arq':
                    case 'ico':
                    case 'vin':
                    case 'vid':

                        break;

//                    case 'est' :
//                        $tipo_campo = 'select';
//                        $this->smarty->assign('tipo_campo', $tipo_campo);
//                        $itens[] = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, $this->modulo . '/tipos', 'est');
//                        break;
                    default:
                        $tipo_campo = 'text';
                        $this->smarty->assign('tipo_campo', $tipo_campo);
                        $itens[] = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, $this->modulo . '/tipos', 'default');
                        break;
                }
            }
        }








        return $itens;
    }

    function busca_campos_imagem($tabela, $configuracoes = '', $id = '') {

        $campos = $this->monta_cabecalho($tabela, $configuracoes, $id);
        $campos_img = array();
        foreach ($campos as $campo) {

            if ($campo->Tipo == 'ico' || $campo->Tipo == 'img') {
                $campos_img[] = $campo;
            }
        }
        return $campos_img;
    }

    function busca_campos_arquivo($tabela, $configuracoes = '', $id = '') {

        $campos = $this->monta_cabecalho($tabela, $configuracoes, $id);
        $campos_arq = array();

        foreach ($campos as $campo) {

            if ($campo->Tipo == 'arq') {
                $campos_arq[] = $campo;
            }
        }
        return $campos_arq;
    }

    function busca_campos_video($tabela, $configuracoes = '', $id = '') {

        $campos = $this->monta_cabecalho($tabela, $configuracoes, $id);
        $campos_vid = array();
        foreach ($campos as $campo) {

            if ($campo->Tipo == 'vid') {
                $campos_vid[] = $campo;
            }
        }
        return $campos_vid;
    }

    function busca_imagens($tabela, $configuracoes = '', $id = '', $nome_campo) {
        $campos = $this->monta_cabecalho($tabela, $configuracoes, $id);
        foreach ($campos as $campo) {
            if ($nome_campo == $campo->Field) {
                $sql = "select * from imagens where Tabela_con='$tabela' and Id_imagem_con='$id' and Campo_sel='{$campo->Field}' order by Ordem_int, Id_int";
                $imgs = $this->executa_sql($sql);
                $this->smarty->assign('imgs', $imgs);
                $this->smarty->assign("campo", $campo);
                return $imgs;
            }
        }
    }

    function busca_arquivos($tabela, $configuracoes = '', $id = '', $nome_campo) {
        $sql_temp = "select * from arquivos where Tabela_con='$tabela' and Campo_sel='' order by Ordem_int,Id_int";
        $arquivos_perdidos = $this->executa_sql($sql_temp);
        if (isset($arquivos_perdidos[0])) {
            foreach ($arquivos_perdidos as $arquivo) {
                $dados = array();
                $dados['Campo_sel'] = $nome_campo;
                $this->updateTable('arquivos', $dados, 'Id_int', $arquivo->Id_int, TRUE);
            }
        }

        $campos = $this->monta_cabecalho($tabela, $configuracoes, $id);
        //and Campo_sel='{$campo->Field}' order by Ordem_int
        foreach ($campos as $campo) {
            if ($nome_campo == $campo->Field) {
                $sql = "select * from arquivos where Tabela_con='$tabela' and Id_arquivo_con='$id' and Campo_sel='{$campo->Field}' order by Ordem_int,Id_int";
                $arqs = $this->executa_sql($sql);
                $this->smarty->assign('arqs', $arqs);
                $this->smarty->assign("campo", $campo);
                return $arqs;
            }
        }
    }

    function busca_videos($tabela, $configuracoes = '', $id = '', $nome_campo) {

        $sql_temp = "select * from videos where Tabela_con='$tabela'  and Campo_sel=''";
        $videos_perdidos = $this->executa_sql($sql_temp);
        if (isset($videos_perdidos[0])) {
            foreach ($videos_perdidos as $video) {
                $dados = array();
                $dados['Campo_sel'] = $nome_campo;
                $this->updateTable('videos', $dados, 'Id_int', $video->Id_int, TRUE);
            }
        }

        $campos = $this->monta_cabecalho($tabela, $configuracoes, $id);
        //and Campo_sel='{$campo->Field}' order by Ordem_int

        foreach ($campos as $campo) {
            if ($nome_campo == $campo->Field) {
                $sql = "select * from videos where Tabela_con='$tabela' and Id_video_con='$id' and Campo_sel='{$campo->Field}' order by Ordem_int,Id_int";
                $vids = $this->executa_sql($sql);
                $this->smarty->assign('vids', $vids);
                $this->smarty->assign("campo", $campo);
                return $vids;
            }
        }
    }

    function busca_configuracoes_antigas() {
        $dados = new stdClass();
        $restricao = $this->executa_sql("select * from restricao");
        $excecoes = $this->executa_sql("select * from excecoes");

        $dados->restricao = $restricao;
        $dados->excecoes = $excecoes;
        return $dados;
    }

    function busca_vins_cliente($tabela, $configuracoes = '', $id = '') {

        $campos = $this->monta_cabecalho($tabela, $configuracoes);

        $campos_vin = array();
        foreach ($campos as $campo) {
            if ($campo->Tipo == 'vin') {

                $campo->Tabela_vin = strtolower(remove_sufixo2($campo->Field));
                $campos_vin[] = $campo;
            }
        }

        return $campos_vin;
    }

    function busca_selects($dados) {
        $tabela = $dados['Tabela_sel'];
        $campo = $dados['Campo_tabela_sel'];
        $items = $this->executa_sql("select * from selects_checkboxes where Campo_tabela_sel='{$campo}' and Tabela_sel='{$tabela}' order by Campo_txf ");
        return $items;
    }

    function excluir_selects($dados) {
        $deucerto = TRUE;

        foreach ($dados['opcoes'] as $dado) {

            if (!$this->db_delete('selects_checkboxes', 'Id_int', $dado)) {
                $deucerto = FALSE;
            }
        }
        return $deucerto;
    }

    function excluir_registro($tabela, $id) {



        return $this->db_delete($tabela, 'Id_int', $id);
    }

    function excluir_registros($tabela, $ids) {
        $deucerto = TRUE;

        foreach ($ids as $id) {
//            $imagens = $this->executa_sql("select * from imagens where Tabela_con='{$tabela}' and Id_imagem_con='{$id}'");
//            if ($imagens[0]) {
//                foreach ($imagens as $imagem) {
//                    $this->exclui_imagem($imagem);
//                }
//            }
//            $videos = $this->executa_sql("select * from videos where Tabela_con='{$tabela}' and Id_video_con='{$id}'");
//            if ($videos[0]) {
//                foreach ($videos as $videos) {
//                    $this->exclui_imagem($imagem);
//                }
//            }

            if (!$this->db_delete($tabela, 'Id_int', $id)) {
                $deucerto = FALSE;
            }
        }
        return $deucerto;
    }

    function exclui_video($video) {
        return $this->db_delete('videos', 'Id_int', $video->Id_int);
    }

    function busca_chb($campo) {





        $opcoes = array();
        $tabela_chb = strtolower(remove_sufixo2($campo->Field));
        $tab = $this->executa_sql("describe $tabela_chb");
        $nome_campo = $tab[1]->Field;

        $sql_opcoes = "select * from {$tabela_chb} order by {$nome_campo}";
        $valores = $this->executa_sql($sql_opcoes);

//
//        $tabela = $campo->Tabela;
//        $id = $campo->Id_registro;
//        $sql_selecionados = "select * from checkboxes where Tabela_con='$tabela' and Tabela_chb_con='$tabela_chb' and Id_objeto_con=$id";
//        $selecionados = $this->executa_sql($sql_selecionados);
//        if (isset($selecionados[0])) {
//            $tipo = 'normal';
//            $this->smarty->assign("tipo", $tipo);
//        } else {
//
//            $tipo = 'novo';
//            $this->smarty->assign("tipo", $tipo);
//        } 
        $tipo = 'novo';
        $this->smarty->assign("tipo", $tipo);

        foreach ($valores as $valor) {
            $opcao = new stdClass();
            $opcao->value = $valor->Id_int;
            $opcao->text = $valor->$nome_campo;
            $opcoes['opcoes'][] = $opcao;
        }

        switch ($tipo) {
            case 'normal':
//                foreach ($selecionados as $selecionado) {
//                    $val[] = $selecionado->Id_chb_con;
//                }
//                $opcoes['valores'] = implode(",", $val);
//                return $opcoes;
                break;
            case 'novo':
                $opcoes['valores'] = $campo->Valor;
                return $opcoes;
                break;
        }
    }

    function busca_opcoes($campo) {

        $tipo = 'normal';
        //    $select = new stdClass();
        //identifica ENUM
        $nome_tipo = explode('enum', $campo->Type);
        if (isset($nome_tipo[1])) {
            $tipo = 'enum';
        }

        if ($campo->Field == 'Ativo_sel') {
            $tipo = 'boolean';
        }

        $sql = "select * from excecoes where Tabela_txf='{$campo->Tabela}' and Campo_txf='{$campo->Field}'";

        $excecoes = $this->executa_sql($sql);
        if ($excecoes[0]) {
            $tipo = 'excecao';
        }

        if ($campo->Tipo == 'for') {
            $tipo = 'for';
        }
        if ($campo->Field == 'Estado_est') {
            $tipo = 'estados';
        }

        if ($campo->Field == 'Estado_sel') {
            $tipo = 'estados';
        }

        $this->smarty->assign("tipo", $tipo);

        switch ($tipo) {
            case 'enum':
                $values = array();
                $valores = str_replace("(", "", $nome_tipo[1]);
                $valores = str_replace("'", "", $valores);
                $valores = str_replace(")", "", $valores);
                $values = explode(",", $valores);

                $opcoes = array();
                foreach ($values as $valor) {
                    $opcao = new stdClass();
                    $opcao->id = $valor;
                    $opcao->text = $valor;
                    $opcoes[] = $opcao;
                }

                return $opcoes;
                break;

            case 'excecao':
                $sql = $excecoes[0]->Sql_txa;
                $valores = $this->executa_sql("$sql");
                $opcoes = array();
                foreach ($valores as $valor => $value) {
                    foreach ($value as $v) {
                        $opcao = new stdClass();
                        $opcao->id = $v;
                        $opcao->text = $v;
                        $opcoes[] = $opcao;
                    }
                }
                return $opcoes;
                break;
            case 'for':

                $tabela_for = strtolower(remove_sufixo2($campo->Field));
                $sql = "select * from {$tabela_for}";




                $valores = $this->executa_sql("$sql");
                $i = 0;
                foreach ($valores[0] as $key => $x) {
                    $i = $i + 1;
                    if ($i == 2) {
                        $nome_campo = $key;
                        break;
                    }
                }


                $valores = $this->executa_sql("select * from {$tabela_for} order by {$nome_campo}");

                $opcoes = array();
                foreach ($valores as $valor) {

                    $opcao = new stdClass();
                    $opcao->id = $valor->Id_int;
                    if ($tabela_for == 'modulos_gc') {
                        $opcao->text = "{$valor->Nome_cliente_txf} - {$valor->Nome_txf}";
                    } else {
                        $opcao->text = $valor->$nome_campo;
                    }

                    $opcoes[] = $opcao;
                }

//                 sorteia_array_objetos($opcoes, array('text' => SORT_DESC));

                return $opcoes;
                break;
            case 'normal':
                $valores = $this->executa_sql("select * from selects_checkboxes where Tabela_sel='{$campo->Tabela}' and Campo_tabela_sel='{$campo->Field}' order by Campo_txf");
                $opcoes = array();
                foreach ($valores as $valor) {
                    $opcao = new stdClass();
                    $opcao->id = $valor->Campo_txf;
                    $opcao->text = $valor->Campo_txf;
                    $opcoes[] = $opcao;
                }

                return $opcoes;
                break;

            case 'estados':
                $estados = array(
                    array("sigla" => "AC", "nome" => "Acre"),
                    array("sigla" => "AL", "nome" => "Alagoas"),
                    array("sigla" => "AM", "nome" => "Amazonas"),
                    array("sigla" => "AP", "nome" => "Amapá"),
                    array("sigla" => "BA", "nome" => "Bahia"),
                    array("sigla" => "CE", "nome" => "Ceará"),
                    array("sigla" => "DF", "nome" => "Distrito Federal"),
                    array("sigla" => "ES", "nome" => "Espírito Santo"),
                    array("sigla" => "GO", "nome" => "Goiás"),
                    array("sigla" => "MA", "nome" => "Maranhão"),
                    array("sigla" => "MT", "nome" => "Mato Grosso"),
                    array("sigla" => "MS", "nome" => "Mato Grosso do Sul"),
                    array("sigla" => "MG", "nome" => "Minas Gerais"),
                    array("sigla" => "PA", "nome" => "Pará"),
                    array("sigla" => "PB", "nome" => "Paraíba"),
                    array("sigla" => "PR", "nome" => "Paraná"),
                    array("sigla" => "PE", "nome" => "Pernambuco"),
                    array("sigla" => "PI", "nome" => "Piauí"),
                    array("sigla" => "RJ", "nome" => "Rio de Janeiro"),
                    array("sigla" => "RN", "nome" => "Rio Grande do Norte"),
                    array("sigla" => "RO", "nome" => "Rondônia"),
                    array("sigla" => "RS", "nome" => "Rio Grande do Sul"),
                    array("sigla" => "RR", "nome" => "Roraima"),
                    array("sigla" => "SC", "nome" => "Santa Catarina"),
                    array("sigla" => "SE", "nome" => "Sergipe"),
                    array("sigla" => "SP", "nome" => "São Paulo"),
                    array("sigla" => "TO", "nome" => "Tocantins")
                );

                $opcoes = array();
                foreach ($estados as $valor) {
                    $opcao = new stdClass();
                    $opcao->id = $valor['sigla'];
                    $opcao->text = $valor['nome'];
                    $opcoes[] = $opcao;
                }

                return $opcoes;
                break;





            case 'boolean':
                $valores[] = 'SIM';
                $valores[] = 'NAO';
                $opcoes = array();
                foreach ($valores as $valor) {
                    $opcao = new stdClass();
                    $opcao->id = $valor;
                    $opcao->text = $valor;
                    $opcoes[] = $opcao;
                }

                return $opcoes;
                break;
        }







//       if($campo->Type){
//           
//       }
    }

    function trata_campos($tabela, $registro) {
        
    }

    function abre_tabela($configs = null, $vin = null) {
        $tabela = $configs->Tabela_txf;
        $where = '';
        if ($vin != null) {
            $this->smarty->assign('vin', $vin);
            $where.=" where Tabela_con='{$vin->tabelavin}' and Id_objeto_con={$vin->id_vin} ";
        }

        $where.= ' order by Id_int desc';

        $registros = $this->buscar_completo($tabela, $where);

        $estrutura = $this->monta_campos_listagem($tabela, $configs);

        $this->smarty->assign('tabela', $configs);
        $this->smarty->assign('registros', $registros);
        $this->smarty->assign('estrutura', $estrutura);
    }

    function salvar_registro_completo($tabela, $dados, $id = null) {
        if (isset($id)) {
            $acao = 'update';
        } else {
            $acao = 'insert';
        }

        switch ($acao) {
            case 'update':
                if ($id) {

                    return $this->updateTable($tabela, $dados, 'Id_int', $id, TRUE);
                }
                break;
            case 'insert':

                return $this->db_insert($tabela, $dados, TRUE);
                break;
        }

        return false;
    }

    function salva_novo_registro($tabela, $dados) {


//        ver($dados,1);
        foreach ($dados as $campo => $valor) {
            $tipo = retorna_extensao($campo);
//            echo "cuidando do campo {$campo} que eh do tipo {$tipo} <br> ";
            switch ($tipo) {
                case 'chb':
                    if (is_array($valor)) {
                        $valor = implode(",", $valor);
                    } else {
                        $valor = '';
                    }
                    $dados[$campo] = $valor;
                    break;
                case 'dat':
                    
                    $tempo = strtotime($valor);
                    
                    $valor = date("Y-m-d H:i:s", $tempo);
                    
                    
                    $dados[$campo] = $valor;

                    break;
                case 'tit':

                    $outro_campo = remove_sufixo2($campo);

                    $outro_campo.="_url";

                    $dados[$campo] = $valor;
                    $dados[$outro_campo] = url_title($valor);

                    break;

                default:

                    $dados[$campo] = $valor;

                    break;
            }
        }
        unset($dados['nome_tabela']);
        unset($dados['id_tabela']);


        return $this->db_insert($tabela, $dados, TRUE);
    }

    function salvar_registro($tabela, $campo, $valor, $id = null, $tipo_banco = null) {
        $tipo = retorna_extensao($campo);


        switch ($tipo) {
            case 'dat':

                $valor = strtotime($valor);
                $valor = date("Y-m-d H:i:s", $valor);

                $dados = array();
                $dados[$campo] = $valor;
                if ($id) {
                    return $this->updateTable($tabela, $dados, 'Id_int', $id);
                }
                break;
            case 'txp':
                $valor = md5($valor);

                $dados = array();
                $dados[$campo] = $valor;
                if ($id) {
                    return $this->updateTable($tabela, $dados, 'Id_int', $id);
                }
                break;


            case 'ico':
            case 'img':
            case 'arq':
            case 'vid':
                $dados[$campo] = '';
                if ($id) {

                    return $this->updateTable($tabela, $dados, 'Id_int', $id);
                }
                break;
            case 'tit':

                $outro_campo = remove_sufixo2($campo);

                $outro_campo.="_url";
                $dados = array();
                $dados[$campo] = $valor;
                $dados[$outro_campo] = url_title($valor);
                if ($id) {

                    return $this->updateTable($tabela, $dados, 'Id_int', $id);
                }
                break;

            default:
                $dados = array();
                $dados[$campo] = $valor;
                if ($id) {
                    return $this->updateTable($tabela, $dados, 'Id_int', $id);
                }
                break;
        }
    }

}

