<?php   

class cep{

public $dados;
 # O retorno ser� um array EX:
 							# @ $dados['tipo_logradouro']
							# @ $dados['logradouro']
							# @ $dados['bairro']
							# @ $dados['cidade']
							# @ $dados['uf']
public $msg_erro;

function Gera_Dados($requisicao){
	
	$this->dados = $this->Busca_Cep($requisicao);
	
}

public function Busca_Cep($cep) {  
    $resultado = @file_get_contents('http://cep.republicavirtual.com.br/web_cep.php?cep='.urlencode($cep).'&formato=query_string');  
	
    if(!$resultado) {  
        $this->msg_erro = "Cep inválido ou Inexistente!"; 
		
    }  
    parse_str($resultado, $retorno);   
    return $retorno;  
}  
} // fecha classe

?>