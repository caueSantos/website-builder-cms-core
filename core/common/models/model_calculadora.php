<?php

 class Model_calculadora extends Model_banco {

     public $db;
     public $app;
     //PRAZOS
     private $prazo_prov = 5;
     private $prazo_def = 5;
     private $prazo_receb = 30;
     private $prazo_max_edital = 40;
    
     function __construct() {
         parent::__construct();
     }
    
     function inicializa($app, $cliente = null) {
         $this->app = $app;
         if ($cliente) {
             $this->cliente = $cliente;
    
             $textos = $this->executa_sql("select * from textos_calculadora");
             $this->smarty->assign('textos', $textos);
         }
     }

    public function converte_data($data, $formato = "Y-m-d") {
        $data = str_replace("/", "-", $data);
        return date($formato, strtotime($data));
    }

    public function eh_data($data, $formato = 'Y-m-d') {
        $d = DateTime::createFromFormat($formato, $data);
        return $d && $d->format($formato) == $data;
    }

    /**
     * Soma dias Ã  uma data qualquer
     *
     * @param type $data - A data que terÃ¡ dias adicionados
     * @param type $dias - Qnt de dias a serem adicionados
     * @return string - A nova data com os dias adicionados no formato
     * YYYY-MM-DD
     */
    public function soma_x_dias($data, $dias) {

        $data = $this->converte_data($data);

        $ano = substr($data, 0, 4);
        $mes = substr($data, 5, 2);
        $dia = substr($data, 8, 2);
        $dia += (int) $dias - 1;

        return date("Y-m-d", mktime(0, 0, 0, $mes, $dia, $ano));
    }

    /**
     * Calcula os dias corridos entre duas datas
     *
     * @param type $data_inicio - Data de inicio
     * @param type $data_fim - Data de fim
     * @return int - Rerorna os dias corridos entre as datas passadas
     */
    public function calcula_dias_corridos($data_inicio, $data_fim, $mostrar_negativo = false) {

        $i = strtotime($data_inicio);
        $f = strtotime($data_fim);

        $sinal = "";
        if ($i > $f) {
            $maior = $i;
            $menor = $f;
            if ($mostrar_negativo === true) {
                $sinal = "-";
            }
        } else {
            $maior = $f;
            $menor = $i;
        }

        $final = ($maior - $menor) / 86400; //86400 segundos em 1 dia;

        return $sinal . round($final);
    }

    /**
     * Soma dias uteis Ã  uma data qualquer
     *
     * @param string $data - A data que terÃ¡ dias adicionados
     * @param string $dias - Qnt de dias a serem adicionados
     * @return string - A nova data com os dias uteis adicionados no formato
     * YYYY-MM-DD
     */
    public function soma_x_dias_uteis($data, $dias) {

        $data = $this->converte_data($data);
        $data = $this->soma_x_dias($data, 0);

        $x = 0;
        while ($x < $dias) {
            $data = $this->soma_x_dias($data, 2);
            if ($this->eh_util($data) === true) {
                $x++;
            }
        }
        return $data;
    }

    /**
     * Calcula os dias uteis entre duas datas
     *
     * @param string $data_inicio - Data de inicio
     * @param string $data_fim - Data de fim
     * @return string - Rerorna os dias uteis entre as datas passadas
     */
    public function calcula_dias_uteis($data_inicio, $data_fim) {

        //dias nÃ£o Ãºteis(SÃ¡bado=6 Domingo=0)
        $fim_semana_dia = 0;

        //nÃºmero de dias entre a data inicial e a final
        $calc_dias = $this->calcula_dias_corridos($data_inicio, $data_fim);

        while ($data_inicio != $data_fim) {

            $dia_semana = date("w", $this->data_para_timestamp($data_inicio));
            $data_a = date("d/m", $this->data_para_timestamp($data_inicio));

            if ($dia_semana == 0 || $dia_semana == 6 || in_array($data_a, $this->feriados_ano(date("Y")))) {
                //Conta os sabados, domingos e feriados
                $fim_semana_dia++;
            }

            $data_inicio = $this->soma_x_dias($data_inicio, 1);
        }

        return round($calc_dias - $fim_semana_dia);
    }

    /**
     * Checa se o dia passado Ã© util ou nÃ£o
     *
     * @param string $data - Uma data qualquer
     * @return boolean - Retorna true caso o dia seja util OU retorna falso
     * caso o dia nÃ£o seja util
     */
    public function eh_util($data) {

        $dia_semana = (int) date("w", strtotime($data));
        $ano = date("Y", strtotime($data));

        // print_r($_POST);

        if ($dia_semana == 0 || $dia_semana == 6 || in_array($data, $this->feriados_ano($ano))) {
            return false;
        }
        return true;
    }

    /**
     * Calcula o prÃ³ximo dia util apÃ³s uma data passada
     *
     * @param string $data - Data que terÃ¡ um dia util adicionado
     * @param string $formato - Formato de saÃ­da da data(padrÃ£o: Y-m-d)
     * @return string - Retorna a nova data
     */
    public function proximo_dia_util($data) {

        $data = $this->converte_data($data);

        while (true) {
            $data = $this->soma_x_dias($data, 2);
            if ($this->eh_util($data) === true) {
                break;
            }
        }

        return $data;
    }

    public function dias_no_mes($data) {
        $data = date("Y-m", strtotime($data));
        $mes = substr($data, 5, 2);
        $ano = substr($data, 0, 4);
        return cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
    }

    public function listar_meses_entre_datas($data_inicio, $data_fim) {

        $data_inicio = $this->converte_data($data_inicio);
        $data_fim = $this->converte_data($data_fim);

        $meses = [];

        $start = new DateTime($data_inicio);
        $start->modify('first day of this month');
        $end = new DateTime($data_fim);
        $end->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 month');
        $period = new DatePeriod($start, $interval, $end);

        foreach ($period as $dt) {
            $meses[] = $dt->format("Y-m");
        }

        return $meses;
    }

    /**
     * Calcula os feriados de um determinado ano
     *
     * @param type $ano - Ano no formato YYYY, Caso nÃ£o seja informado
     * o ano atual Ã© passado
     * @return array - Retorna um array com todos os feriados
     */
    public function feriados_ano($ano = false) {

        if ($ano === false) {
            $ano = date("Y");
        }

        $ano = date("Y", strtotime($ano));

        $dia = 86400;

        $datas = array();
        $datas['pascoa'] = easter_date($ano);
        $datas['sexta_santa'] = $datas['pascoa'] - (2 * $dia);
        $datas['carnaval'] = $datas['pascoa'] - (47 * $dia);
        $datas['corpus_cristi'] = $datas['pascoa'] + (60 * $dia);

        $feriados = array(
            '01/01',
            '02/02', // Navegantes
            date('d/m', $datas['carnaval']),
            date('d/m', $datas['sexta_santa']),
            date('d/m', $datas['pascoa']),
            '21/04',
            '01/05',
            date('d/m', $datas['corpus_cristi']),
            '20/09', // RevoluÃ§Ã£o Farroupilha \m/
            '12/10',
            '02/11',
            '15/11',
            '25/12

            ',
        );

        return $feriados;
    }

    public function conta_dias($data) {

        $data = $this->converte_data($data);
        return date("d", strtotime($data));
    }

    public function contar_dias_atrasados($data_inicio, $data_fim) {

        $data_inicio = $this->converte_data($data_inicio);
        $data_fim = $this->converte_data($data_fim);
        $data_inicio = $this->proximo_dia_util($data_inicio);

        return $this->calcula_dias_corridos($data_inicio, $data_fim) + 1;
    }

    public function buscar_indice($cod_indice, $data_inicio, $data_fim = false) {

        $data_inicio = $this->converte_data($data_inicio);
        if ($data_fim !== false) {
            $data_fim = $this->converte_data($data_fim);
        } else {
            $data_fim = $data_inicio;
        }

        $url = "http://api.bcb.gov.br/dados/serie/bcdata.sgs." . $cod_indice . "/dados?formato=json";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "Lands Search/1.0");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $result = curl_exec($ch);
        curl_close($ch);

        if ($result == false) {
            die("Falha ao obter os dados...");
        }

        $indices = array_reverse(json_decode($result, true));


        $di = date("Y-m", strtotime($data_inicio));
        $df = date("Y-m", strtotime($data_fim));

        $val_indice = [];
        foreach ($indices as $data => $valor) {
            if($valor["valor"] == false){
                $valor["valor"] = 0;
            }
            $datas = date("Y-m", strtotime($this->converte_data($valor["data"])));
            if (strtotime($datas) <= strtotime($df)) {
                $val_indice[$datas] = $valor["valor"];
                if (strtotime($datas) == strtotime($di)) {
                    break;
                }
            }
        }

        return array_reverse($val_indice);
    }

    public function calcular_data() {

        /* $_POST = [
          "data_entrega_prod" => "31/03/2015",
          "tipo_prazo_prov" => "dia_util",
          "valor_prazo_prov" => "5",
          "tipo_prazo_def" => "",
          "valor_prazo_def" => "14/04/2017",
          "tipo_prazo_pag" => "dia_corre",
          "valor_prazo_pag" => "30"
          ]; */

        //ValidaÃ§ao bÃ¡sica dos campos do formulario
        $inputs = [];
        $arr = [];
        foreach ($_POST as $key => $value) {

            if (empty($value)) {
                $value = false;
            }

            $tipo = explode("tipo_", $key);
            $valor = explode("valor_", $key);
            if (count($valor) > 1) {
                if ($value !== false) {
                    try {
                        $x = new Datetime(str_replace("/", "-", $value));
                        $arr[$valor[1]]["valor"] = $value;
                    } catch (Exception $e) {
                        if (is_numeric($value) == true) {
                            $arr[$valor[1]]["valor"] = $value;
                        }
                    }
                }
            } elseif (count($tipo) > 1) {
                if (empty($value)) {
                    $value = "data";
                }
                $arr[$tipo[1]]["tipo"] = $value;
            } else {
                $arr[$key]["tipo"] = "data";
                $arr[$key]["valor"] = $value;
            }
        }
        foreach ($arr as $key => $value) {
            if (isset($value["valor"])) {
                if (!isset($value["tipo"])) {
                    $value["tipo"] = "data";
                }
                $inputs[$key] = $value;
            }
        }

        //checa se a primeira posicao do array e uma data
        try {

            $a = new Datetime(str_replace("/", "-", reset($inputs)["valor"]));

            $x = $inputs;
            //remove o primeiro indice
            unset($inputs[key($inputs)]);

            $calculos = [];
            $next = current($x);

            $i = 0;
            foreach ($inputs as $key => $value) {

                $calc = false;

                if (!empty($next)) {
                    $calc = ["valor_inicio" => $next["valor"]];
                }
                if ($i > 0) {
                    $calc = ["valor_inicio" => $next["calculo"]["resultado"]];
                }

                $calculos[$key] = [
                    "tipo" => $value["tipo"],
                    "valor" => $value["valor"],
                    "calculo" => $calc
                ];

                if (!empty($calculos[$key]["calculo"])) {

                    $resultado = 0;
                    $tipo_i = "data";
                    $tipo_f = $calculos[$key]["tipo"];
                    $valor_i = $calculos[$key]["calculo"]["valor_inicio"];
                    $valor_f = $calculos[$key]["valor"];

                    if ($tipo_i == "data") {
                        $valor_i = $this->proximo_dia_util($this->converte_data($valor_i));
                    }
                    if ($tipo_f == "data") {
                        $valor_f = $this->converte_data($valor_f);
                    }

                    if ($tipo_i == "data" && $tipo_f == "data") {
                        $resultado = $this->calcula_dias_corridos($valor_i, $valor_f) + 1;
                        // $calculos[$key]["oi"] = $resultado;
                        if (strlen($resultado) <= 2) {
                            $resultado = $valor_i;
                        } else {
                            $resultado = $this->soma_x_dias($valor_i, $resultado);
                        }
                    } elseif ($tipo_i == "data" && $tipo_f == "dia_corre") {
                        $resultado = $this->soma_x_dias($valor_i, $valor_f);
                    } elseif ($tipo_i == "data" && $tipo_f == "dia_util") {
                        $resultado = $this->soma_x_dias_uteis($valor_i, $valor_f);
                    }
                    $calculos[$key]["calculo"]["resultado"] = $resultado;
                }
                if ($i == 0) {
                    $next = current($calculos);
                } else {
                    $next = next($calculos);
                }

                $i++;
            }
            unset($calculos["calculo_a"]);
            return $calculos;
        } catch (Exception $e) {
            return false;
        }
    }

    public function correcao($valor_nota, $indice_correcao, $data_inicio, $data_fim) {

        try {

            $id = ["inpc" => 188, "ipca-e" => 433, "igpm" => 189];

            $atraso = $this->contar_dias_atrasados($data_inicio, $data_fim);
            $meses = $this->listar_meses_entre_datas($data_inicio, $data_fim);

            if (strtotime(date("Y-m", strtotime($this->converte_data($data_fim)))) == strtotime(date("Y-m", strtotime(date("Y-m"))))) {
                unset($meses[count($meses) - 1]);
            }

            //dias no mes
            $dias_no_mes = [];
            $dias_passados = [];
            foreach ($meses as $key => $value) {
                $dias_no_mes[$value] = $this->dias_no_mes($value);
                $dias_passados[$value] = $this->dias_no_mes($value);
            }
            if (count($dias_passados) < 1) {
                die("Erro ao realizar os cálculos! Cheque as informações e tente novamente...");
            }
            $dias_passados[array_keys($dias_passados)[0]] -= $this->conta_dias($data_inicio);
            $dias_passados[array_keys($dias_passados)[count($dias_passados) - 1]] = $this->conta_dias($data_fim);

            //indices de cada mes
            $indice_mes = [];
            $indice_porra = 0;
            $indice_d = [];
            $indices = $this->buscar_indice($id[$indice_correcao], $data_inicio, $data_fim);
            $indice_dia = ["total" => 0];
            $i = current($indices);
            foreach ($dias_passados as $key => $value) {
                $indice_mes[$key] = $i;
                $indice_porra += ($indice_mes[$key] / (int)$dias_no_mes[$key]);
                $indice_d[$key] = ($indice_mes[$key] / (int)$dias_no_mes[$key]);
                $indice_dia[$key] = ($indice_mes[$key] / (int) $dias_no_mes[$key]) * $dias_passados[$key];
                $indice_dia["total"] += $indice_dia[$key];
                $i = next($indices);
            }

            (float)$str = str_replace('.', '', $valor_nota); // remove o ponto
            (float)$str = str_replace(',', '.', $str); // troca a vírgula por ponto

            $correcao = $str * ($indice_dia["total"] / 100);
            $indice_porra = $indice_porra * $atraso;

            return [
                "valor" => $str,
                "atraso" => $atraso,
                "meses" => $meses,
                "dias_mes" => $dias_no_mes,
                "dias_passados" => $dias_passados,
                "indice_dia" => $indice_dia,
                "indice_mes" => $indice_mes,
                "correcao" => $correcao,
                "indice_porra" => $indice_porra,
                "indice_d" => $indice_d,
            ];

        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function info_correcao($valor_nota, $indice_correcao, $juros_ano, $data_inicio, $data_fim) {

        $data_inicio = $this->converte_data($data_inicio);
        $data_fim = $this->converte_data($data_fim);

        try {

            $cor = $this->correcao($valor_nota, $indice_correcao, $data_inicio, $data_fim);
            $meses = $cor["meses"];
            $dias_no_mes = $cor["dias_mes"];
            $dias_passados = $cor["dias_passados"];
            $indice_dia = $cor["indice_dia"];
            $indice_d = $cor["indice_d"];
            $indice_mes = $cor["indice_mes"];
            $correcao = $cor["correcao"];
            $atraso = $cor["atraso"];
            $valor = $cor["valor"];
            $indice_porra = $cor["indice_porra"];

            if (empty($juros_ano) || $juros_ano == 0) {
                $juros_ano = 6;
            }
            $juros_ano = str_replace("%", "", $juros_ano);


            $juros = $juros_ano;
            $taxa_valor_juros = (((($juros / 365) * $atraso) / 100) + 1);
            $valor_juros = $taxa_valor_juros * ($valor + $correcao);

            $valor_juros_sozinho = $valor_juros - ($valor + $correcao);

            $info = [
                "teste" => $valor,
                "data_inicio" => $data_inicio,
                "data_fim" => $data_fim,
                "dias_atraso" => $atraso,
                "meses_periodo" => $meses,
                "dias_nos_meses" => $dias_no_mes,
                "dias_passados_mes" => $dias_passados,
                "tipo_indice" => $indice_correcao,
                "indices_mes" => $indice_mes,
                "indice_dia" => $indice_dia,
                "indice_total" => $indice_dia["total"],
                "indice_total_porcento" => $indice_dia["total"] / 100,
                "valor_correcao" => $correcao,
                "valor_correcao_formato_br" => number_format($correcao, 2, ',', '.'),
                "valor_corrigido" => $valor + $correcao,
                "valor_corrigido_formato_br" => number_format($valor + $correcao, 2, ',', '.'),
                "juros_anual" => $juros,
                "juros_porcento" => $taxa_valor_juros,
                "valor_juros" => $valor_juros_sozinho,
                "valor_juros_formato_br" => number_format($valor_juros_sozinho, 2, ',', '.'),
                "valor_nota" => $valor,
                "valor_nota_formato_br" => number_format($valor, 2, ',', '.'),
                "valor_c_juros" => $valor_juros,
                "valor_c_juros_formato_br" => number_format($valor_juros, 2, ',', '.'),
                "valor_duvida" => $valor_juros - $valor,
                "valor_duvida_formato_br" => number_format($valor_juros - $valor, 2, ',', '.'),
                "indice_porra" => $indice_porra,
                "indice_d" => $indice_d
            ];

            return $info;

        } catch (Exception $e) {
            return "erro calculo composto";
        }
    }

    public function passo_final($data, $valor, $juros, $indice) {

        $data = $this->converte_data($data);
        $hoje = date("Y-m-d");

        $atraso = $this->contar_dias_atrasados($data, $hoje);
        $juros = str_replace("%", "", $juros);

        $correcao = $this->correcao($valor, $indice, $data, $hoje);

        $valor = str_replace('.', '', $valor); // remove o ponto
        $valor = str_replace(',', '.', $valor); // troca a vírgula por ponto

        $taxa_valor_juros = (((($juros / 365) * $atraso) / 100) + 1);
        $valor_juros = $taxa_valor_juros * $valor;

        $valor_juros_sozinho = $valor_juros - $valor;

        $info = [
            "data_pagamento" => $data,
            "data_hoje" => $hoje,
            "dias_atrasados" => $atraso,
            "juros_ano" => $juros,
            "juros_porcento" => $taxa_valor_juros,
            "valor_juros" => $valor_juros_sozinho,
            "valor_juros_formato_br" => number_format($valor_juros_sozinho, 2, ',', '.'),
            "valor_nota_c_juros" => ($valor + $valor_juros),
            "valor_nota_c_juros_formato_br" => number_format(($valor + $valor_juros), 2, ',', '.'),
        ];

        return $info;
    }

    public function calculadora_controller() {

        $inputs = $_POST;
        if (isset($inputs["calculo_a"]) && $inputs["calculo_a"] == true) {

            $a = $this->calcular_data();
            echo json_encode($a);

        } else if (isset($inputs["calculo_b"]) && $inputs["calculo_b"] == true) {

            $b = $this->info_correcao($inputs["valor_nota"], $inputs["indice_correcao"], $inputs["taxa_juros"], $inputs["data_inicio"], $inputs["data_fim"]);
            echo json_encode($b);

        } else if (isset($inputs["calculo_c"]) && $inputs["calculo_c"] == true) {

            $c = $this->info_correcao($inputs["valor_extra_nota"], $inputs["indice_2"],
                    $inputs["juros_ano_2"], $inputs["data_pag_2"], date("Y-m-d"));
            echo json_encode($c);

        } else if (isset($inputs["calculo_d"]) && $inputs["calculo_d"] == true) {

            echo "<pre>";
            print_r($this->calc_file(false, true));
            echo "</pre>";

        }
    }

}
