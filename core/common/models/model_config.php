<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class model_config extends Model_banco {

    private $Tabela_config = '_vedana_configs';
    private $filtro = ' Id_int is not null ';

    function __construct($tabela = null, $filtro = null) {
        parent::__construct();
        if ($tabela != null) {
            $this->Tabela_config = $tabela;
            if ($filtro != null) {
                $this->filtro = $filtro;
            }
        }
    }

    function load_all_configs($modulo = null) {
        $consulta = ("$this->Tabela_config " . "$this->filtro");

        if ($modulo != null)
            $consulta.= (" and Modulo_txf='$modulo'");
        return $this->buscar_tudo($consulta);
    }

    function load_item($item = null, $modulo = null) {
        if ($item == null) {
            die('Voce esta tentando buscar uma configuracao sem nome na funcao load item, model_config');
        }
        $consulta = ("$this->Tabela_config where Variavel_txf='$item' and " . "$this->filtro");

        if ($modulo != null)
            $consulta.= (" and Modulo_txf='$modulo'");
        $retorno = $this->buscar_tudo($consulta);
        if (isset($retorno[0]))
            return $retorno[0]->Valor_txf;
        else
            return null;
    }

}

?>