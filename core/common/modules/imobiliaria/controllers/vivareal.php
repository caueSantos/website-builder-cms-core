
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_blog.php');

class vivareal extends lands_core {

    public $vivaconfigs;

    public function __construct() {
        parent::__construct();
        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : 'vivareal');
        if ($this->pagina_atual != 'gerar') {
            $this->checa_login('vivareal');
        }
        $this->load->helper('vivareal');
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

    function checa_anuncios() {

        $where = "where Ativo_sel='SIM' order by Vivareal_hid desc, Tipo_anuncio_hid";
        $imoveis = $this->mbc->buscar_completo('imoveis', $where);
        $this->smarty->assign("imoveis", $imoveis);

        $sql = "select * from imoveis where Ativo_sel='SIM' and Vivareal_hid='SIM' order by Vivareal_hid desc, Tipo_anuncio_hid";
        $anuncios = $this->mbc->executa_sql($sql);


        $totalizador = new stdClass();
        if ($anuncios[0]) {
            $total = count($anuncios);
        } else {
            $total = 0;
        }



        $totalizador->total = $total;
        $totalizador->normal = 0;
        $totalizador->destaque = 0;

        foreach ($anuncios as $anuncio) {

            if ($anuncio->Tipo_anuncio_hid == "normal") {

                $totalizador->normal++;
            }

            if ($anuncio->Tipo_anuncio_hid == "destaque") {

                $totalizador->destaque++;
            }
        }

        $this->smarty->assign("totalizador", $totalizador);
    }

    function checa_compatibilidade() {
//        ver('chegou'); 
        $erro = FALSE;
        if (!$this->mbc->campoexiste("Vivareal_hid", "imoveis") || !$this->mbc->campoexiste("Tipo_anuncio_hid", "imoveis")) {
            $erro = TRUE;
            ver('erro 1');
        }
        if (!$this->mbc->tabelaexiste('vivareal_configs')) {
            $erro = TRUE;
            ver('erro 2');
        }
        if ($erro === TRUE) {
            die('Seu site nao comporta este tipo de integracao, favor entre em contato com o suporte pelo telefone (49) 3224-1773');
        }

        $configs = $this->mbc->buscar_completo("vivareal_configs", "where Id_int is not null limit 1");
        if ($configs[0]) {
            $this->vivaconfigs = $configs[0];
            $this->smarty->assign("vivaconfigs", $this->vivaconfigs);
        } else {
            die('nao encontrou configuracoes para a integracao do vivareal');
        }
    }

    function switch_pagina() {

        $this->conecta_mbc($this->app->Conexoes_for);
        switch ($this->pagina_atual) {

            case 'vivareal':

                $this->checa_anuncios();

                break;

            case 'gerar':
                $this->gerar_xml();
                break;
        }
    }

    function alterar() {

        $pagina = $this->uri->segment($this->app->Segmento_padrao_txf + 2);

//ver('chegou');
//ver($_POST);
        switch ($pagina) {
            case 'anuncio':
                if (!$_POST['Vivareal_hid']) {
                    $_POST['Vivareal_hid'] = 'NAO';
                    $_POST['Tipo_anuncio_hid'] = '';
                } else {

                    if ($_POST['Vivareal_hid'] == 'on') {
                        $_POST['Vivareal_hid'] = 'SIM';
                    }
                    if (!$_POST['Tipo_anuncio_hid']) {
                        $_POST['Tipo_anuncio_hid'] = 'normal';
                    }
                }



                $array_update = $_POST;
//                ver($array_update);
                if ($this->mbc->updateTable("imoveis", $array_update, "Id_int", $_POST['Id_int'])) {

                    $this->smarty->assign("mensagem", "alteracao_ok");
                } else {

                    $this->smarty->assign("mensagem", "alteracao_erro");
                }

                $this->checa_anuncios();
                $this->model_smarty->render_ajax('vivareal_imoveis', $this->app->Template_txf);
                die();
                break;
        }
    }

    function gerar_xml() {

        $imoveis = $this->mbc->buscar_completo("imoveis", "where Ativo_sel='SIM' and Vivareal_hid='SIM' order by Tipo_anuncio_hid");

        $cont = 0;
        echo "<h3> Resultado da Integração </h3>";
        echo "<table border='1'>";
        $produtos = array();
        if ($imoveis[0]) {
            foreach ($imoveis as $imovel) {

                $cont = $cont + 1;
                echo "<tr>";
                echo "<td>$cont</td>";
                echo "<td> {$imovel->Tipo_anuncio_hid}  </td>";
                echo "<td> {$imovel->Id_int}  </td>";
                echo "<td> {$imovel->Referencia_txf}  </td>";
                echo "<td> {$imovel->Tipo_imovel_sel} / {$imovel->Cidade_sel}</td>";
                echo "<td> {$imovel->Valor_txf} </td>";
                echo "<td> {$imovel->Periodo_valor_sel} </td>";

                echo "</tr>";
//            if ($imovel->Operacao_sel != 'aluguel') {
                $produtos [] = array(
                    'ListingID' => $imovel->Id_int,
                    'Title' => retorna_titulo($imovel),
                    'TransactionType' => retorna_tipo_transacao($imovel),
                    'Featured' => retorna_tipo_anuncio($imovel),
                    'Media' => retorna_imagens($imovel),
                    'Details' => retorna_detalhes($imovel),
                    'Location' => retorna_location($imovel),
                    'ContactInfo' => retorna_contact_info($this->vivaconfigs)
                );
//            }
            }
            echo "</table>";

//            ver($produtos);
//ver($produtos);


            $doc = new DOMDocument('1.0', 'utf-8');
            $doc->formatOutput = true;

// Cria o Elemento raiz
//        $r = $doc->createElement("Listings");
//        $doc->appendChild($r);


            $raiz = $doc->createElementNS("http://www.vivareal.com/schemas/1.0/VRSync", "ListingDataFeed");
            $doc->appendChild($raiz);
            $raiz->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
            //$raiz->setAttributeNS('http://www.vivareal.com/schemas/1.0/VRSync', 'xsi:schemaLocation', 'http://www.vivareal.com/schemas/1.0/VRSync http://xml.vivareal.com/vrsync.xsd');
//        $raiz->setAttributeNS('http://www.vivareal.com/schemas/1.0/VRSync', '', 'http://xml.vivareal.com/vrsync.xsd');
//            $raiz->setAttributeNS('http://www.vivareal.com/schemas/1.0/VRSync', 'schemaLocation', 'http://xml.vivareal.com/vrsync.xsd');




            $Header = $doc->createElement("Header");
            $raiz->appendChild($Header);

            $Provider = $doc->createElement("Provider");
            $Provider->appendChild($doc->createTextNode($this->vivaconfigs->Provider_txf));
            $Header->appendChild($Provider);

            $Email = $doc->createElement("Email");
            $Email->appendChild($doc->createTextNode($this->vivaconfigs->Email_txf));
            $Header->appendChild($Email);




            $lista = $doc->createElement("Listings");
            $raiz->appendChild($lista);



            foreach ($produtos as $produto) {



                // Elemento Produto

                $prod = $doc->createElement("Listing");

                // Cria um Atributo
//            $codigo = $doc->createAttribute("codigo");
                // Criando os Elementos Filhos do Elemento Produto
                $ListingID = $doc->createElement("ListingID");
                $Title = $doc->createElement("Title");
                $TransactionType = $doc->createElement("TransactionType");
                $Featured = $doc->createElement("Featured");
                $Media = $doc->createElement("Media");
                $Details = $doc->createElement("Details");
                $Location = $doc->createElement("Location");
                $ContactInfo = $doc->createElement("ContactInfo");

                // Recupera os dados do Array de Produtos
//            $codigo->appendChild($doc->createTextNode($produto['codigo']));
                $ListingID->appendChild($doc->createTextNode($produto['ListingID']));
                $Title->appendChild($doc->createCDATASection($produto['Title']));
                $TransactionType->appendChild($doc->createTextNode($produto['TransactionType']));
                $Featured->appendChild($doc->createTextNode($produto['Featured']));

//            $Media->appendChild($doc->createTextNode('Media'));
//            ver($produto);
                $i = 0;
                foreach ($produto['Media'] as $media) {
                    $i = $i + 1;

                    $Item = $doc->createElement("Item");
                    $Item->appendChild($doc->createTextNode($media));
                    $Media->appendChild($Item);
                    if ($i == 1) {
                        $primary = $doc->createAttribute("primary");
                        $primary->appendChild($doc->createTextNode("true"));
                        $Item->appendChild($primary);
                    }
                    $medium = $doc->createAttribute("medium");
                    $medium->appendChild($doc->createTextNode("image"));
                    $Item->appendChild($medium);
                }

                /* PROPRIEDADES DO DETAIL */
                $PropertyType = $doc->createElement("PropertyType");
                $PropertyType->appendChild($doc->createTextNode($produto['Details']['PropertyType']));
                $Details->appendChild($PropertyType);

                $Description = $doc->createElement("Description");
                $Description->appendChild($doc->createCDATASection($produto['Details']['Description']));
//            $cdata_value = $xml->createCDATASection( 'John Smith' );
//	$xml->createElement( 'name', $cdata_value );
                $Details->appendChild($Description);


                if ($produto['TransactionType'] == 'For Sale') {

                    //  ver('chegou');
                    $ListPrice = $doc->createElement("ListPrice");
//                    if ($produto['ListingID'] == '181') {
//                        
//                        ver($produto['Details']['ListPrice']);
//                        
//                    }

                    $ListPrice->appendChild($doc->createTextNode($produto['Details']['ListPrice']));
                    $Details->appendChild($ListPrice);

                    $currency = $doc->createAttribute("currency");

                    $currency->appendChild($doc->createTextNode("BRL"));
                    $ListPrice->appendChild($currency);
                } else {
//                ver($produto);

                    $RentalPrice = $doc->createElement("RentalPrice");
                    $RentalPrice->appendChild($doc->createTextNode($produto['Details']['RentalPrice']));
                    $Details->appendChild($RentalPrice);

                    $currency = $doc->createAttribute("currency");
                    $currency->appendChild($doc->createTextNode("BRL"));
                    $RentalPrice->appendChild($currency);

                    $period = $doc->createAttribute("period");
                    $period->appendChild($doc->createTextNode($produto['Details']['period']));
                    $RentalPrice->appendChild($period);
                }








                if ($produto['Details']['LivingArea']) {



                    $LivingArea = $doc->createElement("LivingArea");
                    $LivingArea->appendChild($doc->createTextNode($produto['Details']['LivingArea']));
                    $Details->appendChild($LivingArea);

                    $unidade = $doc->createAttribute("unit");
                    $unidade->appendChild($doc->createTextNode("square metres"));
                    $LivingArea->appendChild($unidade);
                }

                if ($produto['Details']['LotArea']) {
                    $LotArea = $doc->createElement("LotArea");
                    $LotArea->appendChild($doc->createTextNode($produto['Details']['LotArea']));
                    $Details->appendChild($LotArea);


                    $unidade = $doc->createAttribute("unit");
                    $unidade->appendChild($doc->createTextNode("square metres"));
                    $LivingArea->appendChild($unidade);
                }



                $Bedrooms = $doc->createElement("Bedrooms");
                $Bedrooms->appendChild($doc->createTextNode($produto['Details']['Bedrooms']));
                $Details->appendChild($Bedrooms);

//                if($produto['ListingID']==193){
//                 
//                    ver($produto);
//                }

                $Bathrooms = $doc->createElement("Bathrooms");
                $Bathrooms->appendChild($doc->createTextNode($produto['Details']['Bathrooms']));
                $Details->appendChild($Bathrooms);

                if ($produto['Details']['Garage']) {
                    $Garage = $doc->createElement("Garage");
                    $Garage->appendChild($doc->createTextNode($produto['Details']['Garage']));
                    $Details->appendChild($Garage);

                    $type = $doc->createAttribute("type");
                    $type->appendChild($doc->createTextNode("Parking Space"));
                    $Garage->appendChild($type);
                }

                $Suites = $doc->createElement("Suites");
                $Suites->appendChild($doc->createTextNode($produto['Details']['Suites']));
                $Details->appendChild($Suites);

                /* FIM DAS PROPRIEDADES DETAIL */


                /* PROPRIEDADAES LOCATION */
                $Country = $doc->createElement("Country");
                $Country->appendChild($doc->createTextNode($produto['Location']['Country']));
                $Location->appendChild($Country);


                $displayAddress = $doc->createAttribute("displayAddress");
                $displayAddress->appendChild($doc->createTextNode(retorna_exibicao_endereco($this->vivaconfigs->Tipo_endereco_sel)));
                $Location->appendChild($displayAddress);


                $abreviacao1 = $doc->createAttribute("abbreviation");
                $abreviacao1->appendChild($doc->createTextNode("BR"));
                $Country->appendChild($abreviacao1);


                $State = $doc->createElement("State");
                $State->appendChild($doc->createTextNode($produto['Location']['State']));
                $Location->appendChild($State);

                $abbreviation = $doc->createAttribute("abbreviation");
                $abbreviation->appendChild($doc->createTextNode(retorna_abreviacao($produto['Location']['State'])));
                $State->appendChild($abbreviation);


                $City = $doc->createElement("City");
                $City->appendChild($doc->createTextNode($produto['Location']['City']));
                $Location->appendChild($City);


                $Zone = $doc->createElement("Zone");
                $Zone->appendChild($doc->createTextNode($produto['Location']['Zone']));
                $Location->appendChild($Zone);

                $PostalCode = $doc->createElement("PostalCode");
                $PostalCode->appendChild($doc->createTextNode($produto['Location']['PostalCode']));
                $Location->appendChild($PostalCode);

                $Neighborhood = $doc->createElement("Neighborhood");
                $Neighborhood->appendChild($doc->createTextNode($produto['Location']['Neighborhood']));
                $Location->appendChild($Neighborhood);

                /* FIM DAS PROPRIEDADAES LOCATION */

                /* PROPRIEDADAES CONTACT INFO */

                $Name = $doc->createElement("Name");
                $Name->appendChild($doc->createTextNode($produto['ContactInfo']['Name']));
                $ContactInfo->appendChild($Name);

                $Email = $doc->createElement("Email");
                $Email->appendChild($doc->createTextNode($produto['ContactInfo']['Email']));
                $ContactInfo->appendChild($Email);

                $Website = $doc->createElement("Website");
                $Website->appendChild($doc->createTextNode($produto['ContactInfo']['Website']));
                $ContactInfo->appendChild($Website);

                $Logo = $doc->createElement("Logo");
                $Logo->appendChild($doc->createTextNode($produto['ContactInfo']['Logo']));
                $ContactInfo->appendChild($Logo);


//            $ContactInfo->appendChild($doc->createTextNode('ContactInfo'));


                /* FIM DAS PROPRIEDADAES CONTACT INFO */


                // Incluir atributo código no elemento 'produto'
//            $prod->appendChild($codigo);
                // Adicionar os Elementos '$ListingID,$Title,$TransactionType$Featured
                $prod->appendChild($ListingID);
                $prod->appendChild($Title);
                $prod->appendChild($TransactionType);
                $prod->appendChild($Featured);
                $prod->appendChild($Media);
                $prod->appendChild($Details);
                $prod->appendChild($Location);
                $prod->appendChild($ContactInfo);


                // Inclui o elemento 'produto' no elemento raiz
                $lista->appendChild($prod);
            }

            #cabeçalho da página
//        header("Content-Type: text/xml");
            // Salva a estrutura do XML

            $var = $doc->saveXML();
            $txt = str_replace('xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"', 'xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.vivareal.com/schemas/1.0/VRSync  http://xml.vivareal.com/vrsync.xsd"', $var);
            $myfile = fopen("vivareal.xml", "w") or die("Unable to open file!");
            fwrite($myfile, $txt);
            fclose($myfile);

            // Gera um documento XML com a estrutura definida
//        $doc->save('vivareal.xml');
            echo "<br><br>*******************************************<br>";
            echo "********* XML Gerado Com sucesso ***********";
            echo "<br>*******************************************<br>";
            echo "{$cont} imóveis adicionados ao arquivo";
            die();
        } else {
            unlink('vivareal.xml');
            die('nenhum imovel anunciado');
        }
    }

}

?>