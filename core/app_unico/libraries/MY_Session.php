<?php/* * To change this template, choose Tools | Templates * and open the template in the editor. *//** * Description of MY_Session * * @author vedana */class MY_Session extends CI_Session {    //put your code here    public function __construct($config = array()) {        parent::__construct($config);    }    /**     * Add or change data in the "userdata" array     * ALTERADO PELO VEDANA     * @access	public     * @param	mixed     * @param	string     * @return	void     */    function set_userdata($newdata = array(), $newval = '') {        if (is_string($newdata)) {            if ($newdata == 'usuario') {                if (is_object($newval)) {                    $newval->app = $this->CI->model_banco->app->Lands_id;                }                if (is_array($newval)) {                    $newval['app'] = $this->CI->model_banco->app->Lands_id;                }            }            $newdata = array($newdata => $newval);        }        if (count($newdata) > 0) {            foreach ($newdata as $key => $val) {                $this->userdata[$key] = $val;            }        }        $this->sess_write();    }}?>