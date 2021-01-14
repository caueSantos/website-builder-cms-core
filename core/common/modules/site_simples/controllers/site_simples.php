<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');
include(COMMONPATH . 'libraries/phpQuery-onefile.php');

require COMMONPATH . 'third_party/moip/vendor/autoload.php';

use Moip\Moip;
use Moip\MoipBasicAuth;

class site_simples extends lands_core {

    public function __construct() {
        parent::__construct();
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



//ver($this->app);
        $this->conecta_mbc($this->app->Conexoes_for);

        /* CARREGA DEFAULTS */
        $this->carrega_defaults();

        if ($this->uri->segment(2)) {
            $this->smarty->assign('segment2', $this->uri->segment(2));
        }

        switch ($this->pagina_atual) {
            case 'inicio' :


                break;
            case 'empresa' :
                $empresa = $this->mbc->buscar_registro_imagens_videos('empresa');
                $this->smarty->assign('empresa', $empresa);


                break;


            case 'teste_upload' :
                ver($_POST);


                break;
            case 'teste_moip' :

                if ($_POST) {

                    $token = '33K9KBUR7WRBDX03AHLWC4YNOHK6PXYT';
                    $key = '8UDHR9Q9EIRVEKFI5DGVI3WIJWI1N2CAFLSKI0OE';
                    $chave = base64_encode($token . $key);
                    ver($chave, 1);

                    $moip = new Moip(new MoipBasicAuth($token, $key), Moip::ENDPOINT_SANDBOX);


                    try {
                        $customer = $moip->customers()->setOwnId(uniqid())
                                ->setFullname('Fulano de Tal')
                                ->setEmail('fulano@email.com')
                                ->setBirthDate('1988-12-30')
                                ->setTaxDocument('22222222222')
                                ->setPhone(11, 66778899)
                                ->addAddress('BILLING', 'Rua de teste', 123, 'Bairro', 'Sao Paulo', 'SP', '01234567', 8)
                                ->addAddress('SHIPPING', 'Rua de teste do SHIPPING', 123, 'Bairro do SHIPPING', 'Sao Paulo', 'SP', '01234567', 8)
                                ->create();
                        ver(($customer), 1);
                    } catch (Exception $e) {
                        ver($e->__toString(), 1);
                    }

                    try {
                        $order = $moip->orders()->setOwnId(uniqid())
                                ->addItem("bicicleta 1", 1, "sku1", 10000)
                                ->addItem("bicicleta 2", 1, "sku2", 11000)
                                ->addItem("bicicleta 3", 1, "sku3", 12000)
                                ->addItem("bicicleta 4", 1, "sku4", 13000)
                                ->addItem("bicicleta 5", 1, "sku5", 14000)
                                ->addItem("bicicleta 6", 1, "sku6", 15000)
                                ->addItem("bicicleta 7", 1, "sku7", 16000)
                                ->addItem("bicicleta 8", 1, "sku8", 17000)
                                ->addItem("bicicleta 9", 1, "sku9", 18000)
                                ->addItem("bicicleta 10", 1, "sku10", 19000)
                                ->setShippingAmount(3000)->setAddition(1000)->setDiscount(5000)
                                ->setCustomer($customer)
                                ->create();

                        ver(($order), 1);
                    } catch (Exception $e) {
                        ver($e->__toString(), 1);
                    }

//PAGAMENTO
//                try {
//                    $payment = $order->payments()->setCreditCard(12, 21, '4073020000000002', '123', $customer)
//                            ->execute();
//
//                    ver($payment, 1);
//                } catch (Exception $e) {
//                    ver($e->__toString(), 1);
//                }
                }

                break;

            case 'busca_cep' :
                $cep = $_GET['cep'];



//                        $html = $this->simple_curl('http://m.correios.com.br/movel/buscaCepConfirma.do', array(
//                            'cepEntrada' => $cep,
//                            'tipoCep' => '',
//                            'cepTemp' => '',
//                            'metodo' => 'buscarCep'
//                                ));

                $html = $this->simple_curl('http://cep.republicavirtual.com.br/web_cep.php', array(
                    'cep' => $cep,
                    'formato' => 'json'
                        ));
                die(print_r($html));
                $resposta = json_decode($html);
                die(print_r($resposta));

                ver($html);

                phpQuery::newDocumentHTML($html, $charset = 'utf-8');

                $dados =
                        array(
                            'logradouro' => trim(pq('.caixacampobranco .resposta:contains("Logradouro: ") + .respostadestaque:eq(0)')->html()),
                            'bairro' => trim(pq('.caixacampobranco .resposta:contains("Bairro: ") + .respostadestaque:eq(0)')->html()),
                            'cidade/uf' => trim(pq('.caixacampobranco .resposta:contains("Localidade / UF: ") + .respostadestaque:eq(0)')->html()),
                            'cep' => trim(pq('.caixacampobranco .resposta:contains("CEP: ") + .respostadestaque:eq(0)')->html())
                );

                $dados['cidade/uf'] = explode('/', $dados['cidade/uf']);
                $dados['cidade'] = trim($dados['cidade/uf'][0]);
                $dados['uf'] = trim($dados['cidade/uf'][1]);
                unset($dados['cidade/uf']);

                die(json_encode($dados));
                break;
            case 'contato' :

                $emails = $this->mbc->buscar_registro_imagens_videos('departamentos', "where Ativo_sel='SIM'");
                $this->smarty->assign('emails', $emails);

                break;
            case 'galeria' :
                $and = '';
                if ($this->uri->segment(2)) {
                    $segment2 = $this->uri->segment(2);
                    $and = " and Url_amigavel_txf='$segment2'";
                }


                $galeria = $this->mbc->buscar_registro_imagens_videos('galeria', "where Ativo_sel='SIM' $and");
                $this->smarty->assign('galeria', $galeria);

                break;
            case 'portifolio' :
                $categorias_portifolio = $this->mbc->executa_sql('select * from categorias_portifolio');
                $this->smarty->assign('categorias_portifolio', $categorias_portifolio);

                $portifolio = $this->mbc->buscar_registro_imagens_videos('portifolio', "where Ativo_sel='SIM'");
                $this->smarty->assign('portifolio', $portifolio);

                break;
            case 'produtos' :
                $categorias_produtos = $this->mbc->executa_sql('select * from categorias_produtos');
                $this->smarty->assign('categorias_produtos', $categorias_produtos);

                $produtos = $this->mbc->buscar_registro_imagens_videos('produtos', "where Ativo_sel='SIM'");
                $this->smarty->assign('produtos', $produtos);

                break;
            default:
                break;
        }

        $this->carrega_blocos();
    }

    function carrega_defaults() {
        $contato = $this->mbc->buscar_registro_imagens_videos('contato');
        $this->smarty->assign('contato', $contato);
    }

    function rest_test() {


        if ($_GET) {
            $method = "GET";
        }
        if ($_POST) {

            $method = "POST";
//            $data = $_POST;
            $data = "";
            foreach ($_POST as $key => $value) {
                $data.="&$key=$value";
            }

            //$data="Id_ficha=21560&Nome_txf=Exame%20de%20Teste&Proprietario_txf=Gustavo%20Vedana%20Erckmann&Animal_txf=Raiska&Arquivo_txf=Enzo_Daniel_Maciel_HEMOGRAMA_21560.pdf";
        }


        $headers = array("cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded",
            "x-api-key: simplesvet",
            "x-senha: vedana",
            "x-usuario: vedana");

        $url = 'vetinlab.com.br/rest/resultados';




        $resposta = curlContents($url, $method, $data, $headers);
        echo($resposta['contents']);
    }

    function carrega_blocos() {

        $this->model_smarty->carrega_bloco('navegacao', 'navegacao', $this->app->Template_txf);

        $this->model_smarty->carrega_bloco('slider', 'slider', $this->app->Template_txf);
        $this->model_smarty->carrega_bloco('flex_slider', 'flex_slider', $this->app->Template_txf);
        $this->model_smarty->carrega_bloco('flexslider', 'flexslider', $this->app->Template_txf);
        $this->model_smarty->carrega_bloco('bannerfull', 'bannerfull', $this->app->Template_txf);
    }

    function simple_curl($url, $post = array(), $get = array()) {
        $url = explode('?', $url, 2);
        if (count($url) === 2) {
            $temp_get = array();
            parse_str($url[1], $temp_get);
            $get = array_merge($get, $temp_get);
        }

        $ch = curl_init($url[0] . "?" . http_build_query($get));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return curl_exec($ch);
    }

}

?>