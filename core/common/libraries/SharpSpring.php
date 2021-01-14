<?php

//namespace AngeloPublio;
/**
 * Super-simple SharpSpring API v1 wrapper, in PHP.
 * 
 * @author Angelo Públio <angelopublio.com> 
 * @version 0.1
 */
class SharpSpring {

    public $accountID = '3_D728768F51DB574D26C359A62BB0B6C1';
    public $secretKey = '146B96F2246DFED5283BF3D949756CB9';

//        function __construct($rules = array()) {
//          
//        parent::__construct($rules);
//        $this->ci = & get_instance();
//       
//    }
    public function __construct($params = null) {
        if ($params) {

            foreach ($params as $key => $value) {
                $this->$key = $value;
            }
//            $this->accountID = $params['accountID'];
//            $this->secretKey = $params['$secretKey'];
        }
    }

//    public function __construct($accountID, $secretKey)
//    {
//        $this->accountID = $accountID;
//        $this->secretKey = $secretKey;
//    }

    function cria_lead($lead) {
//        ver($array);
        $result = $this->call('createLeads', $lead);
        return json_decode($result);
    }

    function insere_contatos_lista_por_email($idlista, $membros) {

        foreach ($membros as $membro) {
            $member = new stdClass();
            $member->listID = $idlista;
            $member->emailAddress = $membro->Email_txf;
            if ($membro->Email_txf) {
                $lista_membros['objects'][] = $member;
            }
        }
//        ver($lista_membros);

        $result = $this->call('addListMembersEmailAddress', $lista_membros);
        //$result = $this->call('getListMembers', array('where' => $where, 'limit' => $limit, 'offset' => $offset));
        return json_decode($result);
    }

    function insere_contato_lista($idlista, $contato) {
        if (!is_object($contato)) {
            $contato = array_to_object($contato);
        }

        $parametros['emailAddress'] = $contato->emailAddress;
        $leads = $this->busca_leads($parametros);
        if ($leads->result->lead[0]) {
            $lead = $leads->result->lead[0];
            $novo_membro = $this->cria_membro_lista($idlista, $lead->id);
        } else {
            $resultado = $this->cria_lead($contato);
            $id_lead = $resultado->result->creates[0]->id;
            $novo_membro = $this->cria_membro_lista($idlista, $id_lead);
        }
        return $novo_membro;
    }

    function busca_leads($where = null, $limit = null, $offset = null) {
        //$where=array('emailAddress' => 'gustavo.vedana@landsdigital.com.br');
        $result = $this->call('getLeads', array('where' => $where, 'limit' => $limit, 'offset' => $offset));
        return json_decode($result);
    }

    function busca_lead($id) {
        $parametros['id'] = $id;
        $result = $this->call('getLead', $parametros);
        return json_decode($result);
    }

    function cria_leads($membros) {
//ver($membros);
        foreach ($membros as $membro) {
            $nome_array = explode(" ", $membro->Nome_txf);
            $firstName = $nome_array[0];
            unset($nome_array[0]);
            $lastName = implode(" ", $nome_array);
            $member = new stdClass();
            $member->firstName = $firstName;
            $member->lastName = $lastName;
            $member->emailAddress = $membro->Email_txf;
            $lista_leads['objects'][] = $member;
            //$parametros
        }

        $result = $this->call('createLeads', $lista_leads);
        //$result = $this->call('getListMembers', array('where' => $where, 'limit' => $limit, 'offset' => $offset));
        return json_decode($result);
    }

    function cria_membros_lista($idlista, $membros) {

        foreach ($membros as $membro) {
            $membro = new stdClass();
            $membro->listID = $idlista;
            $membro->memberID = $membro;
            $lista_membros[] = $membro;
            //$parametros
        }

        $result = $this->call('addListMembers', $lista_membros);
        //$result = $this->call('getListMembers', array('where' => $where, 'limit' => $limit, 'offset' => $offset));
        return json_decode($result);
    }

    function cria_membro_lista($idlista, $idmembro) {
        $parametros['listID'] = $idlista;
        $parametros['memberID'] = $idmembro;

        $result = $this->call('addListMember', $parametros);
        //$result = $this->call('getListMembers', array('where' => $where, 'limit' => $limit, 'offset' => $offset));
        return json_decode($result);
    }

    function busca_membros_lista($idlista, $limit = '500', $offset = '0') {
        $where['id'] = $idlista;

        $result = $this->call('getListMembers', array('where' => $where));
        //$result = $this->call('getListMembers', array('where' => $where, 'limit' => $limit, 'offset' => $offset));
        return json_decode($result);
    }

    function busca_listas($where = null, $limit = null, $offset = null) {
        //$where=array('emailAddress' => 'gustavo.vedana@landsdigital.com.br');
        $result = $this->call('getActiveLists', array('where' => $where, 'limit' => $limit, 'offset' => $offset));
        return json_decode($result);
    }

    function cria_lista($nome, $descricao = null) {
        //$where=array('emailAddress' => 'gustavo.vedana@landsdigital.com.br');
//        ver('chegou');
        $parametros['name'] = $nome;
        $parametros['description'] = $descricao;
        $result = $this->call('createList', $parametros);
        return json_decode($result);
    }

    public function call($method, $args = array()) {
        return $this->makeRequest($method, $args);
    }

    private function makeRequest($method, $args = array()) {


        $queryString = http_build_query(array('accountID' => $this->accountID, 'secretKey' => $this->secretKey));
        $url = "http://api.sharpspring.com/pubapi/v1/?$queryString";
        $requestID = uniqid();

        $data = array(
            'method' => $method,
            'params' => $args,
            'id' => $requestID,
        );


        if (function_exists('curl_init') && function_exists('curl_setopt')) {

            $data = json_encode($data);

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            ));

            $result = curl_exec($ch);
            curl_close($ch);

            return($result);
        } else {
            ver('chegou2');
            $json_data = json_encode($args);
            $result = file_get_contents($url, null, stream_context_create(array(
                        'http' => array(
                            'protocol_version' => 1.1,
                            'user_agent' => 'PHP-MCAPI/2.0',
                            'method' => 'POST',
                            'header' => "Content-type: application/json\r\n" .
                            "Connection: close\r\n" .
                            "Content-length: " . strlen($json_data) . "\r\n",
                            'content' => $json_data,
                        ),
                    )));
        }

        return $result ? json_decode($result, true) : false;
    }

}