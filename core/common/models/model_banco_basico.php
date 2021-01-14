<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_banco_basico extends CI_Model {

    public $app;
    public $cliente;

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    /**
     * Initialize the user preferences
     *
     * Accepts an associative array as input, containing display preferences
     *
     * @access	public
     * @param	array	config preferences
     * @return	void
     */
    function set_basic_table($table_name = null) {
        if (!($this->db->table_exists($table_name)))
            return false;
        $this->table_name = $table_name;
        return true;
    }

  
    /**
     * Initialize the user preferences
     *
     * Accepts an associative array as input, containing display preferences
     *
     * @access	public
     * @param	array	config preferences
     * @return	void
     */
    function field_exists($field, $table_name = null) {
        return $this->db->field_exists($field, $table_name);
    }

    /**
     * Initialize the user preferences
     *
     * Accepts an associative array as input, containing display preferences
     *
     * @access	public
     * @param	array	config preferences
     * @return	void
     */
    function db_get_fields($tabela) {
        return $this->db->list_fields($tabela);
    }

   
    function db_delete($tableName, $primaryKey, $primarykeyValue) {
        return $this->db->delete($tableName, array($primaryKey => $primarykeyValue));
    }

    /**
     * Initialize the user preferences
     *
     * Accepts an associative array as input, containing display preferences
     *
     * @access	public
     * @param	array	config preferences
     * @return	void
     */
    function db_update($post_array, $primary_key_value) {
        $primary_key_field = $this->get_primary_key();
        return $this->db->update($this->table_name, $post_array, array($primary_key_field => $primary_key_value));
    }

    function campoexiste($campo, $tabela) {
        return (!in_array($campo, $this->db->list_fields($tabela))) ? FALSE : TRUE;
    }

    /**
     * Initialize the user preferences
     *
     * Accepts an associative array as input, containing display preferences
     *
     * @access	public
     * @param	array	config preferences
     * @return	void
     */
    function tabelaexiste($tabela) {
        // echo "<br>Vai procurar a TABELA " . $tabela;
        return (!in_array($this->db->_protect_identifiers($tabela, TRUE, FALSE, FALSE), $this->db->list_tables())) ? FALSE : TRUE;
    }

    /**
     * Initialize the user preferences
     *
     * Accepts an associative array as input, containing display preferences
     *
     * @access	public
     * @param	array	config preferences
     * @return	void
     */
    function db_insert_upper($tabela, $post_array, $sistema = null) {
        foreach ($post_array as $key => $value) {
            if ($this->field_exists($key, $tabela)) {
                ($post_array_novo[$key] = strtoupper($value));
            }
        }

        return $this->db->insert($tabela, $post_array_novo);
    }

    /**
     * Initialize the user preferences
     *
     * Accepts an associative array as input, containing display preferences
     *
     * @access	public
     * @param	array	config preferences
     * @return	void
     */
    function findTableCount($tableName) {
        return $this->db->count_all_results($tableName);
    }

    
    
     /**
     * Initialize the user preferences
     *
     * Accepts an associative array as input, containing display preferences
     *
     * @access	public
     * @param	array	config preferences
     * @return	void
     */
    function updateTable($updateTableName, $updateArr, $primaryKey, $primarykeyValue, $retorno = FALSE) {

        foreach ($updateArr as $key => $value) {
            if ($this->field_exists($key, $updateTableName)) {
                ($updateArr_novo[$key] = $value);
            }
        }

        $updateResult = $this->db->update($updateTableName, $updateArr_novo, array($primaryKey => $primarykeyValue));
        if ($updateResult) {
            if ($retorno) {

                $query = $this->db->query("SELECT * FROM " . $updateTableName . " where $primaryKey='$primarykeyValue'");
                $result = $query->result();
                return $result[0];
            } else {
                return $updateResult;
            }
        } else {
            return FALSE;
        }
    }
     /**
     * Initialize the user preferences
     *
     * Accepts an associative array as input, containing display preferences
     *
     * @access	public
     * @param	array	config preferences
     * @return	void
     */
    function db_insert($tabela, $post_array, $return = false) {

        if (!$this->tabelaexiste($tabela)) {
            return FALSE;
        }

        foreach ($post_array as $key => $value) {
            if ($this->field_exists($key, $tabela)) {
                ($post_array_novo[$key] = $value);
            }
        }
        if ($return) {
            $this->db->insert($tabela, $post_array_novo);
            return $this->retorna_ultimo_registro($tabela);
        } else {
            return $this->db->insert($tabela, $post_array_novo);
        }
    }
    
    
    /**
     * Initialize the user preferences
     *
     * Accepts an associative array as input, containing display preferences
     *
     * @access	public
     * @param	array	config preferences
     * @return	void
     */
    function retorna_ultimo_registro($tableName) {

        $query = $this->db->query("SELECT * FROM " . $tableName . " ORDER BY Id_int Desc LIMIT 1");
        $result = $query->result();
        //  print_r($result[0]->id); die();
        return $result[0];
    }

    /**
     * Initialize the user preferences
     *
     * Accepts an associative array as input, containing display preferences
     *
     * @access	public
     * @param	array	config preferences
     * @return	void
     */
    function deleteRow($tableName, $primaryKey, $primarykeyValue) {
        $deleteRowResult = $this->db->delete($tableName, array($primaryKey => $primarykeyValue));
        if ($deleteRowResult == true) {
            $deleteRowResultMesaj = "Satır silme işlemi başarılı.(TableInfo : $tableName)";
        } else {
            $deleteRowResultMesaj = "Satır silme işlemi başarısız.(TableInfo : $tableName)";
        }
        return $deleteRowResultMesaj;
    }

    /**
     * Initialize the user preferences
     *
     * Accepts an associative array as input, containing display preferences
     *
     * @access	public
     * @param	array	config preferences
     * @return	void
     */
    function selectTekAlan($tableName, $alanAdi, $primaryKeyName, $primaryKeyValue) {
        $this->db->select($alanAdi);
        $this->db->where($primaryKeyName, $primaryKeyValue);
        $query = $this->db->get($tableName);

        if ($query->num_rows() == 1) {
            $row = $query->row();
            $alanAdiValue = $row->$alanAdi;
        } else {
            $alanAdiValue = FALSE;
        }
        return $alanAdiValue;
    }

    /**
     * Initialize the user preferences
     *
     * Accepts an associative array as input, containing display preferences
     *
     * @access	public
     * @param	array	config preferences
     * @return	void
     */
    function findLastInsertID($tableName) {

        $query = $this->db->query("SELECT id FROM " . $tableName . " ORDER BY id Desc LIMIT 1");
        $result = $query->result();
        //  print_r($result[0]->id); die();
        return $result[0]->id;
    }

}

?>
