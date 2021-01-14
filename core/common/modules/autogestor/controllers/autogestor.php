<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');
// Inclui o arquivo que contem a Class AutoGestorWs
include(COMMONPATH . 'third_party/autogestor/AutoGestorWs.php');

class autogestor extends lands_core {

    public $tabela_veiculos = 'produtos';

    public function __construct() {
        
        parent::__construct();
        
        
// Autorisa o "fopen" em conexões externas.
        ini_set("allow_url_fopen", 1);

        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);
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



        switch ($this->pagina_atual) {

            case 'inicio' :

                break;
            case 'sincroniza' :
                $this->sincronizar();
                die();
                break;
            default:
                break;
        }
    }

    function sincronizar() {
//    phpinfo();
// Instancia a Class
        $rest = new AutoGestorWs();
// Fornece a chave de acesso e identificação do Cliente
        //chave demo
        //$rest->chave('4297f44b13955235245b2497399d7a93');
        
        $rest->chave('9b906d078c43cbbe5413e9774f47364f');
        
        
// Define o propósito da requisição
        $rest->acao('ag_lista_itens');
// Retorna um Objeto SimpleXMLElement ao invés de uma String XML
        $rest->objeto(true);
// Executa a requisição
        $xml = $rest->executa();
        
        
      //  ver($xml);
// OK
        $this->load->library('Format');

        //desaativa os veículos
        $this->desativa_veiculos();

        if ($xml) {
            // Looping nos registros
            
            foreach ($xml->registro as $dados) {

                $veiculo = $this->format->to_array($dados);
                
//                ver($veiculo);
                $veiculo = array_to_object($veiculo);
                $id_produto = $this->insere_veiculo($veiculo);

                if ($id_produto) {
//                    echo "vai inserir acessorios<br>";
                    $this->insere_acessorios($id_produto, $veiculo);

//                    echo "vai inserir imagens<br>";
                    $this->insere_imagens($id_produto, $veiculo);
                    $msg = "Veículo {$veiculo->codigo}  {$veiculo->marca} {$veiculo->modelo} inserido";
                    echo "$msg <br>";
                    $this->log_sincro($msg);
                }
            }
        }
// ERRO
        else {
            // Imprime o Erro
            print '<pre>';

            print_r($rest->erro());
            $this->log_sincro($rest->erro());
        }
    }

    function desativa_veiculos() {
        $produtos_cadastrados = $this->mbc->executa_sql("select * from  {$this->tabela_veiculos} where Ativo_sel='SIM' and  Codigo_txf!=''");
        foreach ($produtos_cadastrados as $produ) {
            $produ->Ativo_sel = 'NAO';
            $array['Ativo_sel'] = 'NAO';
            $this->mbc->updateTable($this->tabela_veiculos, $array, 'Codigo_txf', $produ->Codigo_txf);
        }
    }

    function insere_imagens($id_produto, $veiculo) {
        echo "inserindo imagens produto {$id_produto} <br>";
         
        foreach ($veiculo->fotos->url as $imagem) {
            $nome = $this->busca_imagem($imagem);
            if ($nome) {
                $img = array();
                $img['Tabela_con'] = $this->tabela_veiculos;
                $img['Id_imagem_con'] = $id_produto;
                $img['Campo_sel'] = 'Imagens_ico';
                $img['Caminho_txf'] = "img/{$this->dados_conexao['database']}/{$nome}";
                $this->mbc->db_insert('imagens', $img);
            }
        }
    }

    function insere_acessorios($id_produto, $veiculo) {
        foreach ($veiculo->acessorios->item as $acessorio) {
            $acc = array();
            $acc['Tabela_con'] = $this->tabela_veiculos;
            $acc['Id_objeto_con'] = $id_produto;
            $acc['Nome_txf'] = $acessorio;
            $this->mbc->db_insert('acessorios', $acc);
            echo "inseriu $acessorio do {$veiculo->marca} {$veiculo->modelo} <br>";
        }
    }

    function insere_veiculo($veiculo) {

        $veiculo_cadastrado = $this->mbc->executa_sql("select * from {$this->tabela_veiculos} where Codigo_txf='{$veiculo->codigo}'");
        if ($veiculo_cadastrado[0]) {
            $produto_update['Ativo_sel'] = 'SIM';
            $this->mbc->updateTable($this->tabela_veiculos, $produto_update, 'Codigo_txf', $veiculo->codigo);
            echo "produto  {$veiculo->codigo}  {$veiculo->marca} {$veiculo->modelo} reativado já cadastrado<br>";
            return 0;
        } else {

            $produto = new stdClass();
            if (!is_object($veiculo->codigo)) {
                $produto->Codigo_txf = $veiculo->codigo;
            }
            if (!is_object($veiculo->marca)) {
                $produto->Marca_sel = $veiculo->marca;
            }
            if (!is_object($veiculo->modelo)) {
                $produto->Modelo_sel = $veiculo->modelo;
            }
            if (!is_object($veiculo->carroceria)) {
                $produto->Linha_sel = $veiculo->carroceria;
            }

            if (!is_object($veiculo->versao)) {
                $produto->Versao_txf = $veiculo->versao;
            }

            if (!is_object($veiculo->combustivel)) {
                $produto->Combustivel_sel = $veiculo->combustivel;
            }
            if (!is_object($veiculo->cor)) {
                $produto->Cor_sel = $veiculo->cor;
            }
            if (!is_object($veiculo->ano_modelo)) {
                $produto->Ano_sel = $veiculo->ano_modelo;
            }

            if (!is_object($veiculo->preco)) {
                $preco = '';
                $preco = explode(",", $veiculo->preco);
                $preco_final = str_replace(".", "", $preco[0]);

                $produto->Valor_txf = $preco_final;
            }
            if (!is_object($veiculo->estado)) {
                $produto->Estado_de_uso_sel = $veiculo->estado;
            }
            if (!is_object($veiculo->descricao)) {
                $produto->Informacoes_adicionais_txa = $veiculo->descricao;
            }
            if (!is_object($veiculo->portas)) {
                $produto->Numero_de_portas_sel = $veiculo->portas;
            }
            if (!is_object($veiculo->placa)) {
                $produto->Placa_txf = $veiculo->placa;
            }
            if (!is_object($veiculo->km)) {
                $produto->Kilometragem_txf = $veiculo->km;
            }
            if (!is_object($veiculo->data_cadastro)) {
                $produto->Data_cadastro_dat = $veiculo->data_cadastro;
            }
            if (!is_object($veiculo->data_alteracao)) {
                $produto->Data_modificacao_dat = $veiculo->data_alteracao;
            }

            $produto->Ativo_sel = 'SIM';

//            $produto->Motor_sel = $veiculo->marca;
//            $produto->Valvulas_sel = $veiculo->marca;
//            $produto->Estado_sel = $veiculo->marca;
//            $produto->Cidade_txf= $veiculo->marca;

            $produto_array = object_to_array($produto);
            $this->mbc->db_insert($this->tabela_veiculos, $produto_array);
            $produto_inserido = $this->mbc->executa_sql("select * from {$this->tabela_veiculos} order by Id_int desc limit 1");
            return $produto_inserido[0]->Id_int;
        }
    }
    
   

    function busca_imagem($url_img) {



        
        
    
// URL completa da imagem no sistema AutoGestor.
//        $url_img = 'http://autogestor.net/imagens/auto-gestor.png';
//        
// Coleta apenas o nome e extensão da imagem.
        $img_nome = substr($url_img, strrpos($url_img, '/') + 1);
// Diretório onde será salva a imagem.
        $dir = "../painel/img/{$this->dados_conexao['database']}/";
        
  
//file_get_contents("http://example.com/", 0, $ctx); 

// Le o conteúdo do arquivo no sistema AutoGestor.
        $get_img = file_get_contents($url_img);
// Caso a leitura obtenha sucesso...
        if ($get_img) {
            // Salva a imagem no servidor onde está o site do Cliente.
           
            $sav_img = file_put_contents($dir . $img_nome, $get_img);
            // Caso tenha salvado com sucesso...
            if ($sav_img) {
                // Exibe a mensagem de sucesso.
                //  print 'Imagem copiada com sucesso<br>';
                return $img_nome;
                return true;
            } else {
                // Exibe a mensagem de Erro.
                print 'Erro ao salvar a imagem<br>';
                return false;
            }
        } else {
            
         //    ver($url_img);
            // Exibe a mensagem de Erro.
            print "Erro ao obter a imagem <a href='$url_img'>$url_img</a><br>";
            return false;
        }
    }

    function busca_objeto($array, $campo, $valor) {
        $chave = null;
        if (is_array($array)) {
            foreach ($array as $chave => $objeto) {
                if ($objeto->$campo == $valor) {
                    return $objeto;
                }
            }
        }
    }

    function log_sincro($msg) {
        $array['Data_dat'] = date('Y-m-d H:i:s');
        $array['Mensagem_txa'] = $msg;
        $this->mbc->db_insert("log_sincro", $array);
    }
}

?>