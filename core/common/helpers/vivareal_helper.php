<?php

if (!function_exists('retorna_tipo_transacao')) {

    function retorna_tipo_transacao($imovel) {
//        $retorno = "For Sale";
        switch ($imovel->Operacao_sel) {
            case 'venda':
            case 'Venda':
            case 'VENDA':
                $retorno = "For Sale";
                break;

            default:
                $retorno = "For Rent";
                break;
        }
//        if ($imovel->Operacao_sel == 'venda') {
//            $retorno = "For Sale";
//            return "For Sale";
//        } else {
//            
//        }
//        if ($imovel->Operacao_sel == 'aluguel') {
//            $retorno = "For Rent";
//        }

        return $retorno;
    }

}

if (!function_exists('retorna_titulo')) {

    function retorna_titulo($imovel) {
        return "{$imovel->Tipo_imovel_sel} em {$imovel->Cidade_sel} / $imovel->Estado_sel";
    }

}

if (!function_exists('retorna_imagens')) {

    function retorna_imagens($imovel) {

        $CI = & get_instance();
        $app = $CI->model_banco->app;

        $item = array();
        foreach ($imovel->Imagens as $imagem) {
            $item[] = $app->Url_cliente . $app->Pasta_painel . $imagem->Caminho_txf;
        }
        return $item;
    }

}

if (!function_exists('retorna_description')) {

    function retorna_description($imovel) {

        $descricao = " " . strip_tags($imovel->Descricao_txa);
        $descricao = html_entity_decode($descricao);
//        $descricao=  htmlspecialchars($descricao);
//        ver($descricao,1);
        return $descricao;
//          return $imovel->Tipo_imovel_sel." em ".$imovel->Cidade_sel." / ".$imovel->Estado_sel;
    }

}


if (!function_exists('retorna_tipo_anuncio')) {

    function retorna_tipo_anuncio($imovel) {
        switch ($imovel->Tipo_anuncio_hid) {
            case 'normal':
                return "false";
                break;
            case 'destaque':
                return "true";
                break;
            default:
                die("Tipo de anuncio inválida no imóvel de ID= {$imovel->Id_int}");
                break;
        }
    }

}

if (!function_exists('retorna_periodo_valor')) {

    function retorna_periodo_valor($imovel) {
        switch ($imovel->Periodo_valor_sel) {
            case 'mensal':
                return "Monthly";
                break;
            case 'Mensal':
                return "Monthly";
                break;
            case 'diária':
                return "Daily";
                break;
            case 'diaria':
                return "Daily";
                break;
            case 'Diária':
                return "Daily";
                break;
            default:
                return "";
                break;
        }
    }

}
if (!function_exists('trata_cep')) {

    function trata_cep($cep) {

        $cep = str_replace("-", "", $cep);
        $cep = str_replace(" ", "", $cep);

        if ($cep != '') {
            $cep = mascara($cep, 'cep2');
            return $cep;
        } else {
            return '';
        }
    }

}

if (!function_exists('retorna_location')) {

    function retorna_location($imovel) {
        $location = array();
        if ($imovel->Pais_sel) {
            if ($imovel->Pais_sel != 'Brasil') {
                die("Esta integracao comporta apenas imoveis no brasil");
            }
            $location['Country'] = $imovel->Pais_sel;
        } else {
            $location['Country'] = 'Brasil';
        }

        $location['State'] = $imovel->Estado_sel;
        //attr currency="BRL"
        $location['City'] = $imovel->Cidade_sel;
        $location['Zone'] = $imovel->Zona_sel;
        $location['PostalCode'] = trata_cep($imovel->Cep_txf);
        $location['Neighborhood'] = $imovel->Bairro_sel;



        return $location;
    }

}

if (!function_exists('retorna_contact_info')) {

    function retorna_contact_info($config) {
        $contact = array();

        $contact['Name'] = $config->Provider_txf;
        $contact['Email'] = $config->Email_txf;
        $contact['Website'] = $config->Website_txf;
        $contact['Logo'] = $config->Logo_txf;




        return $contact;
    }

}

if (!function_exists('retorna_abreviacao')) {

    function retorna_abreviacao($valor) {

        if (strlen($valor) > 2) {

            die('Estado deve ser cadastrado somente com sigla');
        } else {
            return $valor;
        }
    }

}

if (!function_exists('retorna_exibicao_endereco')) {

    function retorna_exibicao_endereco($valor) {

        switch ($valor) {
            case 'completo':
                return "All";
                break;
            case 'bairro':
                return "Neighborhood";
                break;
            case 'rua':
                return "Street";
                break;

            default:

                return "Neighborhood";

                // die("tipo de exibicao de endereco = '{$valor}' nao permitido pelo viva real, altere na tabela de configuracao do vivareal do seu site!");
                break;
        }
    }

}




if (!function_exists('retorna_detalhes')) {

    function retorna_detalhes($imovel) {
        $detalhes = array();
        $detalhes['PropertyType'] = retorna_PropertyType($imovel);
        $detalhes['Description'] = retorna_description($imovel);
        //attr currency="BRL"
        //   ver($imovel->Valor_txf);

        if ($imovel->Operacao_sel == 'venda') {
            $detalhes['ListPrice'] = $imovel->Valor_txf;
        } else {
            $detalhes['RentalPrice'] = $imovel->Valor_txf;
            $detalhes['period'] = retorna_periodo_valor($imovel);
        }

        //attr unit="square metres"

        if ($imovel->Metragem_txf) {
            $detalhes['LivingArea'] = retorna_metragem($imovel->Metragem_txf);
        }
        if ($imovel->Metragem_total_txf) {
            $detalhes['LotArea'] = retorna_metragem($imovel->Metragem_total_txf);
        }
//        $detalhes['PropertyType'] = 'Residential / Apartament';
        $detalhes['Bedrooms'] = retorna_quartos($imovel);
        $detalhes['Bathrooms'] = retorna_banheiros($imovel);
        $detalhes['Garage'] = retorna_garagens($imovel);
        $detalhes['Suites'] = retorna_suites($imovel);

        return $detalhes;
    }

}

if (!function_exists('retorna_metragem')) {

    function retorna_metragem($valor) {
        $valor = doubleval($valor);
//        ver($valor, 1);
        $retorno = round($valor);
//        ver($retorno);
        return $retorno;
//        return number_format( $valor [1] );
    }

}

if (!function_exists('retorna_garagens')) {

    function retorna_garagens($imovel) {
        if ($imovel->Garagem_sel) {
//            ver($imovel->Garagem_sel, 1);
            $garagens = $imovel->Garagem_sel;
        } else {
            $garagens = 0;
        }
        return $garagens;
    }

}
if (!function_exists('retorna_banheiros')) {

    function retorna_banheiros($imovel) {
        if ($imovel->Banheiros_sel) {
            $banheiros = $imovel->Banheiros_sel;
        } else {
            if ($imovel->Suites_sel) {
                $banheiros = $imovel->Suites_sel;
            } else {
                $banheiros = 0;
            }
        }
        return $banheiros;
    }

}

if (!function_exists('retorna_suites')) {

    function retorna_suites($imovel) {
        if ($imovel->Suites_sel) {
            $quartos = $imovel->Suites_sel;
        } else {
            $quartos = 0;
        }
        return $quartos;
    }

}

if (!function_exists('retorna_quartos')) {

    function retorna_quartos($imovel) {
        if ($imovel->Quartos_sel) {
            $quartos = $imovel->Quartos_sel;
        } else {
            $quartos = 0;
        }
        return $quartos;
    }

}

if (!function_exists('retorna_PropertyType')) {

    function retorna_PropertyType($imovel) {

        switch ($imovel->Tipo_imovel_sel) {
            case 'Apartamento':
                return "Residential / Apartment";
                break;
            case 'Casa':
                return "Residential / Home";
                break;
            case 'Chácara':
                return "Residential / Farm Ranch";
                break;
            case 'Casa de Condomínio':
                return "Residential / Condo";
                break;
            case 'Casa em Condomínio':
                return "Residential / Condo";
                break;

            case 'Casa em condomínio':
                return "Residential / Condo";
                break;


            case 'Flat':
                return "Residential / Flat";
                break;
            case 'Terreno Residencial':
                return "Residential / Land Lot";
                break;
            case 'Lote':
                return "Residential / Land Lot";
                break;
            case 'Sobrado':
                return "Residential / Sobrado";
                break;
            case 'Cobertura':
                return "Residential / Penthouse";
                break;
             case 'Cobertura duplex':
                return "Residential / Penthouse";
                break;
            case 'Cobertura Duplex':
                return "Residential / Penthouse";
                break;
            case 'Kitnet':
                return "Residential / Kitnet";
                break;
            case 'Consultório':
                return "Commercial / Consultorio";
                break;
            case 'Sala Comercial':
                return "Commercial / Office";
                break;
            case 'Área Rural':
                return "Commercial / Agricultural";
                break;
              case 'Área rural':
                return "Commercial / Agricultural";
                break;
            case 'Sitio':
                return "Commercial / Agricultural";
                break;
            case 'Sítio':
                return "Commercial / Agricultural";
                break;
            case 'Fazenda':
                return "Commercial / Agricultural";
                break;
            case 'Galpão':
                return "Commercial / Industrial";
                break;
            case 'Depósito':
                return "Commercial / Industrial";
                break;
             case 'Barracão':
                return "Commercial / Industrial";
                break;
            case 'Deposito':
                return "Commercial / Industrial";
                break;
            case 'Armazém':
                return "Commercial / Industrial";
                break;
            case 'Armazem':
                return "Commercial / Industrial";
                break;
            case 'Imóvel Comercial':
                return "Commercial / Loja";
                break;
            case 'Lote':
                return "Commercial / Land Lot";
                break;
            case 'Terreno':
                return "Commercial / Land Lot";
                break;
            case 'Terreno em Condomínio':
                return "Residential / Land Lot";
                break;
            case 'Terreno em condomínio':
                return "Residential / Land Lot";
                break;
            case 'Terreno em Condominio':
                return "Residential / Land Lot";
                break;
            case 'Terreno Comercial':
                return "Commercial / Land Lot";
                break;
            case 'Ponto Comercial':
                return "Commercial / Business";
                break;
            case 'Edifício Residencial':
                return "Commercial / Residential Income";
                break;

            default:
                echo "Tipo de imóvel {$imovel->Tipo_imovel_sel} do imóvel id= {$imovel->Id_int} nao aceito pelo viva real<br>";
                return "Residential / Apartment";
                //die("Tipo de imóvel {$imovel->Tipo_imovel_sel} do imóvel id= {$imovel->Id_int} nao aceito pelo viva real");
                break;
        }
    }

}




    