<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_paginas extends Model_banco {

    function __construct() {
        parent::__construct();
//        ver('heogasd');
    }

    //trata as queries para buscar $dados..
    function trata_query($conteudo_sql) {
        $resultados = array();
        $xxx[] = ('<pre>trata_query<br> ');
        $xxx[] = ($conteudo_sql);
        $xxx[] = ('<br>***************<br> ');
        foreach ($conteudo_sql as $value) {
            $sql = $this->trata_sql($value->Consulta_sql_txf);
            $resultados = $this->executa_sql($value, $sql);
        }

        $xxx[] = ('trata_query<br> ');
        $xxx[] = ($resultados);
        $xxx[] = ('<br>***************<br> ');
        return $resultados;
    }

    function trata_sql($sql) {
        $xxx[] = ('trata_sql ');
        $xxx[] = ($sql);
        $xxx[] = ('<br>**********<br>resultado<br> ');


        $consulta = str_replace('{segment1}', str_replace("_", " ", $this->uri->segment(1)), $sql);
        $consulta = str_replace('{segment2}', str_replace("_", " ", $this->uri->segment(2)), $consulta);
        $consulta = str_replace('{segment3}', str_replace("_", " ", $this->uri->segment(3)), $consulta);
        $consulta = str_replace('{segment4}', str_replace("_", " ", $this->uri->segment(4)), $consulta);


        $xxx[] = ($consulta);
        return $consulta;
    }

    function executa_sql($content, $sql) {

        $xxx[] = 'Executa_sql<br>';
        $xxx[] = 'content = ';
        $xxx[] = ($content);
        $xxx[] = '<br>';
        $xxx[] = 'sql = ';
        $xxx[] = ($sql);
        $xxx[] = '<br>executou funcao ';
//print_r($xxx);
        switch ($content->Metodo_txf) {
            case 'SQL':
                $this->load->database($content->Base_dados_txf, TRUE);
                $qr = $content->Tabela_txf . ' ' . $sql;
                $result = $this->buscar_tudo($qr);
                if (isset($result)) {
                    $vars[$content->Variavel_txf] = $result;
                }
                $this->smarty->assign($content->Variavel_txf, $result);
                $xxx[] = "SQL<br>";
                break;

            case 'PAGINACAO':
                $this->load->database($content->Base_dados_txf, TRUE);
                $valor = $this->valores_paginacao_generic_categoria($content->Tabela_txf, $sql, (intval($this->uri->segment(2) > 0)) ? intval($this->uri->segment(2)) : '1', $content->Qtde_registro_pagina_txf);

                if (isset($valor)) {
                    $vars[$content->Variavel_txf] = $valor;
                }
                $this->smarty->assign($content->Variavel_txf, $valor);
                $xxx[] = "PAGINACAO<br>";

                break;

            case 'PAGINACAO C/ SUBCATEGORIA':
                $this->load->database($content->Base_dados_txf, TRUE);
                $valor = $this->valores_paginacao_generic_categoria($content->Tabela_txf, $sql, (intval($this->uri->segment(3) > 0)) ? intval($this->uri->segment(3)) : '1', $content->Qtde_registro_pagina_txf);
                if (isset($valor)) {
                    $vars[$content->Variavel_txf] = $valor;
                }
                $this->smarty->assign($content->Variavel_txf, $valor);

                $xxx[] = "PAGINACAO C/ SUBCATEGORIA<br>";

                break;

            case 'IMAGENS E CONTEUDO':
                $this->load->database($content->Base_dados_txf, TRUE);
                $valor = $this->buscar_desc_imagens($content->Tabela_txf, $sql);
                if (isset($valor)) {
                    $vars[$content->Variavel_txf] = $valor;
                }
                $this->smarty->assign($content->Variavel_txf, $valor);

                $xxx[] = "IMAGENS E CONTEUDO<br>";

                break;

            case 'VIDEOS E CONTEUDO':
                $this->load->database($content->Base_dados_txf, TRUE);
                $valor = $this->buscar_desc_videos($content->Tabela_txf, $sql);

                if (isset($valor)) {
                    $vars[$content->Variavel_txf] = $valor;
                }
                $this->smarty->assign($content->Variavel_txf, $valor);

                $xxx[] = "VIDEOS E CONTEUDO<br>";

                break;

            default:
                break;
        }

        $this->load->database($content->Base_dados_txf, TRUE);
        if (isset($vars)) {
            return $vars;
        } else
            die('nao encontrou respostas');
    }

}

?>