
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_blog.php');

class ingaia extends lands_core {

    public $ingaia_configs;
    public $tabela_imoveis = 'imoveis';

    public function __construct() {
        parent::__construct();
        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : 'ingaia');
        if ($this->pagina_atual != 'sincronizar') {
            $this->checa_login('ingaia');
        }
//        $this->load->helper('vivareal');
        $this->checa_compatibilidade();
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

    function checa_compatibilidade() {
//        ver('chegou'); 
        $erro = FALSE;
//        if (!$this->mbc->campoexiste("Vivareal_hid", "imoveis") || !$this->mbc->campoexiste("Tipo_anuncio_hid", "imoveis")) {
//            $erro = TRUE;
//        }
        if (!$this->mbc->tabelaexiste('ingaia_configs')) {
            $erro = TRUE;
        }
        if ($erro === TRUE) {
            die('Seu site nao comporta este tipo de integracao, favor entre em contato com o suporte pelo telefone (49) 3224-1773');
        }

        $configs = $this->mbc->buscar_completo("ingaia_configs", "where Id_int is not null limit 1");
        if ($configs[0]) {
            $this->ingaia_configs = $configs[0];
            $this->smarty->assign("ingaia_configs", $this->ingaia_configs);
        } else {
            die('nao encontrou configuracoes para a integracao do vivareal');
        }
    }

    function switch_pagina() {

        $this->conecta_mbc($this->app->Conexoes_for);
        switch ($this->pagina_atual) {

            case 'ingaia':



                break;

            case 'sincronizar':
                die('módulo desativado');
                $this->desativa_imoveis();
                $this->sincronizar_ingaia();
                die('morreu');
                break;
            
            default :
                break;
        }
        
//        die('chegou');
//       $this->carrega_pagina();
    }

    function sincronizar_ingaia() {
        
        

        $this->ingaia_configs->Webservice_txf;
        $imoveisxml = simplexml_load_file($this->ingaia_configs->Webservice_txf, null, LIBXML_NOCDATA);
        
//        ver($this->ingaia_configs->Webservice_txf);
        
        $json = json_encode($imoveisxml);
        $array = json_decode($json, TRUE);
//ver($array);
//           $this->load->library('Format');
        //     ver($array['Imoveis']['Imovel']);
        $lista_imoveis = array_to_object($array['Imoveis']['Imovel']);


 $array_imoveis= array();
        foreach ($lista_imoveis as $imobile) {
            $imovel = new StdClass();
//if($imobile->CodigoImovel=='AR0001'){
//    ver($imobile);
//}
 
            $imovel->Nome_txf = $imobile->TituloImovel;
            if($imobile->PrecoLocacao){
                $imovel->Operacao_sel = 'aluguel';
                 $imovel->Valor_txf = $imobile->PrecoLocacao;
            } else {
                $imovel->Operacao_sel = 'venda';
                 $imovel->Valor_txf = $imobile->PrecoVenda;
            }
            
            $imovel->Referencia_txf = $imobile->CodigoImovel;
            $imovel->Cidade_sel = $imobile->Cidade;
            $imovel->Bairro_sel = $imobile->Bairro;
            $imovel->Tipo_imovel_sel = $imobile->TipoImovel;
            $imovel->Quartos_sel = $imobile->QtdDormitorios;
            $imovel->Banheiros_sel = $imobile->QtdBanheiros;
            $imovel->Metragem_txf = $imobile->AreaUtil;
            if(is_object($imobile->AreaUtil)){
                     $imovel->Metragem_txf =0 ;
            }

//            $imovel->Valor_txf = $imobile->PrecoVenda;
//            $imovel->Caracteristicas_vin = $imobile->TituloImovel;
            $imovel->Endereco_txf = $imobile->Endereco;
            $imovel->Descricao_txa = $imobile->Observacao;
//            if ($imobile->Publicar == 1) {
                $imovel->Ativo_sel = 'SIM';
//            }
            foreach ($imobile->Fotos->Foto as $imagem) {
                $imovel->Imagens[] = $imagem;
            }

            $array_imoveis[] = $imovel;
        }
        
//        ver($array_imoveis);
        

        foreach ($array_imoveis as $imovel) {
            $imovel_bd = $this->insere_imovel($imovel);
           $this->insere_imagens($imovel_bd, $imovel);
        }
        
        die('Sincronização encerrada');
    }

    function insere_imagens($imovel_bd, $imovel) {

//ver($imovel_bd);


        echo "inserindo imagens imóvel {$imovel_bd->Id_int} <br>";
        

        foreach ($imovel->Imagens as $imagem) {
            $nome = $this->busca_imagem($imagem);
            
            if ($nome) {
                $img = array();
                $img['Tabela_con'] = $this->tabela_imoveis;
                $img['Id_imagem_con'] = $imovel_bd->Id_int;
                $img['Campo_sel'] = 'Imagens_ico';
                $img['Caminho_txf'] = "img/{$this->dados_conexao['database']}/{$nome}";
                
                $jatem = $this->mbc->executa_sql("select * from imagens where Caminho_txf='{$img['Caminho_txf']}'");
                if($jatem[0]){
                    echo "Imagem repedita";
//                      $this->mbc->updateTable('imagens', $img,'Id_int', $jatem[0]->Id_int);
                } else {
                                    $this->mbc->db_insert('imagens', $img);
                }

                
                
            }
        }
    }

    function desativa_imoveis() {
        $produtos_cadastrados = $this->mbc->executa_sql("select * from  {$this->tabela_imoveis} where Ativo_sel='SIM' and  Referencia_txf!=''");
        foreach ($produtos_cadastrados as $produ) {
            $produ->Ativo_sel = 'NAO';
            $array['Ativo_sel'] = 'NAO';
            $this->mbc->updateTable($this->tabela_imoveis, $array, 'Referencia_txf', $produ->Referencia_txf);
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

    function busca_imagem($imagem) {






// URL completa da imagem no sistema AutoGestor.
//        $url_img = 'http://autogestor.net/imagens/auto-gestor.png';
//        
// Coleta apenas o nome e extensão da imagem.
        //    $img_nome = substr($url_img, strrpos($url_img, '/') + 1);
//        ver($imagem);
        $url_img = $imagem->URLArquivo;
        $img_nome = $imagem->NomeArquivo;

// Diretório onde será salva a imagem.
        $dir = "painel/img/{$this->dados_conexao['database']}/";


//file_get_contents("http://example.com/", 0, $ctx); 
// Le o conteúdo do arquivo no sistema AutoGestor.
        $get_img = file_get_contents($url_img);
// Caso a leitura obtenha sucesso...
        if ($get_img) {
            
          //  ver($get_img);
            // Salva a imagem no servidor onde está o site do Cliente.
//ver($dir . $img_nome.'.png');
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

    function insere_imovel($imovel) {
//ver($imovel);
        $imovel_cadastrado = $this->mbc->executa_sql("select * from {$this->tabela_imoveis} where Referencia_txf='{$imovel->Referencia_txf}'");
//        ver($imovel_cadastrado);
        if ($imovel_cadastrado[0]) {
            
            $produto_update=object_to_array($imovel_cadastrado[0]);
            $produto_update['Ativo_sel'] = 'SIM';
 
            echo "Imóvel  {$imovel->Referencia_txf}    já cadastrado<br>";
           return $this->mbc->updateTable($this->tabela_imoveis, $produto_update, 'Id_int', $imovel_cadastrado[0]->Id_int, TRUE);
           
            
            
//            return $imovel_cadastrado[0];
        } else {
               echo "Imóvel  {$imovel->Referencia_txf}    vai inserir<br>";
//            ver($produto_array);
//            ver($imovel);
            $produto_array = object_to_array($imovel);
            return  $this->mbc->db_insert($this->tabela_imoveis, $produto_array, TRUE);
//            return $produto_inserido->Id_int;
        }
    }

}

?>