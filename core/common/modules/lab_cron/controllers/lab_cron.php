<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class lab_cron extends lands_core {

    public $arquivos;
    public $diretorio = '../sincro/';

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
        switch ($this->pagina_atual) {
            case 'cron':
//                $this->checa_login('cron');


                $base = $this->app->Url_cliente;
                foreach ($this->uri->segments as $key => $value) {
                    $base.=$value . '/';
                }
                $config->per_page = 15;
                $config->base_url = $base;

                $config->page_query_string = TRUE;
                $valor = $this->mbc->super_paginacao("sincro_log", "order by Data_dat DESC", $config, null);

                //$log = $this->mbc->executa_sql("select * from sincro_log ");

                $this->smarty->assign('logs', $valor);
//                      ver($valor);
//                $log = $this->mbc->executa_sql("select * from sincro_log order by Data_dat DESC");
//                ver($log);
//                $this->smarty->assign('logs', $log);
                break;

            case 'labcloud':

//ver('chegou');
                echo "Sincronizando com a Plataforma Labcloud, pode demorar alguns minutos<br>";
                $data_inicio = date('Y-m-d H:i:s');
                $dados['Acao_txf'] = "Iniciando o cron as {$data_inicio}";
                $dados['Data_dat'] = $data_inicio;
//                $this->mbc->db_insert('controle', $dados);
                $this->sincro_labcloud();

                $data_fim = date('Y-m-d H:i:s');
                $dados['Data_dat'] = $data_fim;
                $diferenca = data_diferenca($data_inicio, $data_fim);

                $tempo = gmdate("H:i:s", $diferenca->total_sec);
                $texto = "Processo concluído em $tempo";
                echo $texto . "<br>";
                $dados['Acao_txf'] = $texto;
                $this->mbc->db_insert('controle', $dados);
                echo "<br><a href='{$this->app->Url_cliente}'>VOLTAR</a><br>";
                die();
                break;
            case 'labcloud_geral':
                echo "Sincronizando com a Plataforma Labcloud, pode demorar alguns minutos<br>";
                $data_inicio = date('Y-m-d H:i:s');
                $dados['Acao_txf'] = "Iniciando o cron COMPLETO as {$data_inicio}";
                $dados['Data_dat'] = $data_inicio;
                $this->mbc->db_insert('controle', $dados);
                $this->sincro_labcloud_geral();
                $data_fim = date('Y-m-d H:i:s');
                $dados['Data_dat'] = $data_fim;
                $diferenca = data_diferenca($data_inicio, $data_fim);
                //$texto = "Processo COMPLETO concluído em {$diferenca->total_hour} horas, {$diferenca->total_min} minutos e {$diferenca->total_sec} segundos";
                $tempo = gmdate("H:i:s", $diferenca->total_sec);
                $texto = "Processo COMPLETO concluído em $tempo";
                echo "$texto<br>";
                $dados['Acao_txf'] = $texto;
                $this->mbc->db_insert('controle', $dados);
                echo "<br><a href='{$this->app->Url_cliente}'>VOLTAR</a><br>";
                die();
                break;
            case 'sincro':
                $this->le_pasta();
                $this->sincroniza();

                if ($this->mbc->campoexiste('Enviado_sel', 'cadastros')) {
                    $this->sincro_cadastro();
                }

                echo "<br><a href='{$this->app->Url_cliente}'>VOLTAR</a><br>";
                die();
                redirect($this->app->Url_cliente);
                break;
            case 'cadastro':
                $this->sincro_cadastro();
                die();
                break;
        }
    }

    /* SINCRONIZA OS ARQUIVOS .CLI */

    function sincro_cli($geral = false) {

        $arquivos = $this->le_pasta_cli();

        if ($geral == false) {
            $arquivos_ignorados = $this->mbc->executa_sql("select * from sincro_ignore where Extensao_txf='CLI'");
            $array_ignorados = array();
            foreach ($arquivos_ignorados as $result) {
                $array_ignorados[] = $result->Arquivo_txf;
            }
            $arquivos = array_diff($arquivos, $array_ignorados);
        }

        $array_sincro = array();
        $headers = array("x-api-key: tantofaz", "x-lab-id: {$this->app->id_lab}");
        $resultados_cli = super_request("resultados_laboratorio", 'GET', false, $headers);

        foreach ($resultados_cli as $result) {
            $array_sincro[] = substr($result->Referencia_txf, 1) . '.CLI';
        }

 
        $sincronizar = array_diff($arquivos, $array_sincro);
        
        
        
        
        
//        ver($arquivos);
//        ver($array_sincro);

        $i = 0;
        if ($sincronizar) {
            foreach ($sincronizar as $arq) {

                $i = $i + 1;

                $lines = file($this->diretorio . $arq, FILE_IGNORE_NEW_LINES);
                $resultado = new stdClass();
                $resultado_login = new stdClass();

                $resultado->Nome_txf = $arq;
                $resultado->Descricao_txf = utf8_encode($lines[1]);
                $nome_array = explode(': ', $resultado->Descricao_txf);

                $animal_array = explode(' ', $nome_array[1]);
                $animal = $animal_array[0];
                $proprietario = $nome_array[2];


                $resultado->Animal_txf = $animal;
                $resultado->Proprietario_txf = $proprietario;
                $resultado->Ficha_txf = utf8_encode($lines[5]);
                $resultado->Arquivo_txf = utf8_encode($lines[5]) . '.pdf';
                $resultado->Data_dat = formata_data_sql($lines[7]) . " " . date("H:i:s", filemtime($this->diretorio . $arq));
                $resultado->Login_txf = utf8_encode($lines[3]);
                $resultado->Senha_txf = utf8_encode($lines[4]);
                $resultado->Referencia_txf = utf8_encode($lines[5]);

                
                
                $extensao = substr($arq, -3);
                switch ($extensao) {
                    case 'CLI':
                        
                       
                        $resultado_login->Tipo_sel = 'clinica';

                        $resultado_postado = super_request("resultados", 'POST', $resultado, $headers);

                        if ($resultado_postado->Id_int) {
                            /* REMOVE OS ARQUIVOS DA FILA DE IGNORAR */
                            if ($geral == TRUE) {
                                $existe = $this->mbc->executa_sql("select * from sincro_ignore where Arquivo_txf='{$arq}'");
                                if (is_array($existe)) {
                                    $this->mbc->db_delete("sincro_ignore", "Id_int", $existe[0]->Id_int);
                                    echo "Removendo $arq do sincro ignore<br>";
                                }
                            }
                            echo "{$i} - $resultado->Nome_txf enviado com sucesso!<br>";
                        } else {
                            if ($geral == false) {
                                $existe = $this->mbc->executa_sql("select * from sincro_ignore where Arquivo_txf='{$arq}'");
                                if (!is_array($existe)) {
                                    $array_arq['Arquivo_txf'] = $arq;
                                    $array_arq['Extensao_txf'] = 'CLI';
                                    $this->mbc->db_insert('sincro_ignore', $array_arq);
                                }
                            }
                            echo "{$i} - $resultado->Nome_txf não postado! $resultado_postado ( <b>Login:</b> $resultado->Login_txf / <b>Senha:</b> $resultado->Senha_txf )<br>";
                        }

                        break;
                }
            }
        } else {
            echo "Nenhum arquivo .CLI para sincronizar";
        }
    }

    function sincro_sli_novo() {
 

        $arquivos = $this->le_pasta_sli();
        $array_sincro = array();
        $headers = array("x-api-key: tantofaz", "x-lab-id: {$this->app->id_lab}");

//        die('Processo interrompido');

//        ver('teste');
        $resultados_logins = super_request("resultados_sli", 'GET', false, $headers);
        
        
//ver($resultados_logins);
        foreach ($resultados_logins as $arquivo) {
            $array_sincro[] = $arquivo->Referencia_txf;
        }


        $sincronizar = array_diff($arquivos, $array_sincro);
     
        if ($sincronizar) {
            
            $i = 0;

            // para arquivo, le os dados e envia para o labcloud
            foreach ($sincronizar as $arq) {

                if (file_exists($this->diretorio . $arq)) {
                    echo "<br>arqvuivo {$this->diretorio}{$arq} existe<br>";

                    $i = $i + 1;

                    $lines = file($this->diretorio . $arq, FILE_IGNORE_NEW_LINES);
//  ver($lines)                     ;
                    if ($lines[0]) {
                        $resultado = new stdClass();
                        $resultado->Referencia_txf = $arq;
                        $resultado->Descricao_txf = utf8_encode($lines[1]);
                        $nome_array = explode(': ', $resultado->Descricao_txf);
                        $animal_array = explode(' ', $nome_array[1]);
                        $animal = $animal_array[0];
                        $proprietario = $nome_array[2];
                        $resultado->Animal_txf = $animal;
                        $resultado->Proprietario_txf = $proprietario;
                        $resultado->Ficha_txf = utf8_encode($lines[5]);
                        $resultado->Arquivo_txf = utf8_encode($lines[5]) . '.pdf';
                        $resultado->Data_dat = formata_data_sql($lines[7]);
                        $resultado->Login_txf = utf8_encode($lines[3]);
                        $resultado->Senha_txf = utf8_encode($lines[4]);
                        $resultado->Nome_txf = utf8_encode($lines[5]);
                        $arquivo->Data_sincro_dat = date('Y-m-d H:i:s');
                        $extensao = substr($arq, -3);

                        switch ($extensao) {
                            case 'SLI':
                                 
                                $resultado_bd = super_request("resultados_sli", 'POST', $resultado, $headers);
//                                ver($resultado_bd);
                                if ($resultado_bd) {
                                    echo "Resultado {$resultado_bd->Nome_txf} {$resultado_bd->Descricao_txf} enviado com sucesso!<br>";
//                                    ver('chegou');
                                } else {
                                    echo "Erro {$resultado->Nome_txf} {$resultado->Descricao_txf}<br>";
//                                    ver($resultado,1);
//                                    ver('chegou mas não sincronizou');
                                }
                                break;
                        }
                        if ($i == 25) {
                            break;
                        }
                    }
                } else {
                    echo "arquivo <b>nao existe</b> <br>";
                }
            }
        } else {
            echo "Nenhum arquivo .SLI para sincronizar<br>";
        }
        echo "<br> $i resultados .SLI inseridos";
        die();
    }

    function sincro_sli($geral = false) {

        if ($_REQUEST['geral']) {
            $geral = TRUE;
        }

        $arquivos = $this->le_pasta_sli();

        if ($geral == false) {
            $arquivos_ignorados = $this->mbc->executa_sql("select * from sincro_ignore where Extensao_txf='SLI'");
            $array_ignorados = array();
            foreach ($arquivos_ignorados as $result) {
                $array_ignorados[] = $result->Arquivo_txf;
            }
            $arquivos = array_diff($arquivos, $array_ignorados);
        }

        $array_sincro = array();
        $headers = array("x-api-key: tantofaz", "x-lab-id: {$this->app->id_lab}");
        $resultados_logins = super_request("resultados_logins", 'GET', false, $headers);
        foreach ($resultados_logins as $arquivo) {
            $array_sincro[] = $arquivo->Referencia_txf;
        }
        $sincronizar = array_diff($arquivos, $array_sincro);
        $i = 0;
        foreach ($sincronizar as $arq) {
            $i = $i + 1;


            $lines = file($this->diretorio . $arq, FILE_IGNORE_NEW_LINES);
            $resultado = new stdClass();
            $resultado_login = new stdClass();
            $resultado->Nome_txf = $arq;
            $resultado->Descricao_txf = utf8_encode($lines[1]);
            $nome_array = explode(': ', $resultado->Descricao_txf);
            $animal_array = explode(' ', $nome_array[1]);
            $animal = $animal_array[0];
            $proprietario = $nome_array[2];
            $resultado->Animal_txf = $animal;
            $resultado->Proprietario_txf = $proprietario;
            $resultado->Ficha_txf = utf8_encode($lines[5]);
            $resultado->Arquivo_txf = utf8_encode($lines[5]) . '.pdf';
            $resultado->Data_dat = formata_data_sql($lines[7]);
            $resultado->Login_txf = utf8_encode($lines[3]);
            $resultado->Senha_txf = utf8_encode($lines[4]);
            $resultado->Referencia_txf = utf8_encode($lines[5]);
            $resultado_login->Login_txf = utf8_encode($lines[3]);
            $resultado_login->Senha_txf = utf8_encode($lines[4]);
            $resultado_login->Referencia_txf = utf8_encode($arq);
            $arquivo->Data_sincro_dat = date('Y-m-d H:i:s');
            $extensao = substr($arq, -3);

            switch ($extensao) {

                case 'SLI':
                    $resultado_login->Tipo_sel = 'usuario';

                    $resultado_bd = super_request("resultado_referencia/{$resultado->Referencia_txf}", 'GET', null, $headers);


                    if ($resultado_bd) {
//                         ver($resultado);
                        $resultado_login->Resultados_for = $resultado_bd->Id_int;
                        $resultado_login_inserido = super_request("resultado_login", 'POST', $resultado_login, $headers);

                        /* REMOVE OS ARQUIVOS DA FILA DE IGNORAR */
                        if ($geral == TRUE) {
                            $existe = $this->mbc->executa_sql("select * from sincro_ignore where Arquivo_txf='{$arq}'");
                            if (is_array($existe)) {
                                $this->mbc->db_delete("sincro_ignore", "Id_int", $existe[0]->Id_int);
                                echo "Removendo $arq do sincro ignore<br>";
                            }
                        }
                        echo "{$i} - Login para o resultado $resultado_bd->Id_int -> $resultado->Nome_txf enviado com sucesso!<br>";
                    } else {
                        if ($geral == false) {
                            $existe = $this->mbc->executa_sql("select * from sincro_ignore where Arquivo_txf='{$arq}'");
                            if (!is_array($existe)) {
                                $array_arq['Arquivo_txf'] = $arq;
                                $array_arq['Extensao_txf'] = 'SLI';
//                                $this->mbc->db_insert('sincro_ignore', $array_arq);
                            }
                        }

                        echo "{$i} - $resultado->Nome_txf não encontrado!  ( <b>Login:</b> $resultado->Login_txf / <b>Senha:</b> $resultado->Senha_txf )<br>";
                    }
                    break;
            }
        }
    }

    function sincro_vet() {

        // le os arquivos .VET da pasta
        $arquivos = $this->le_pasta_vet();
        $array_sincro = array();
        $headers = array("x-api-key: tantofaz", "x-lab-id: {$this->app->id_lab}");

        // busca resultados existentes do LabCloud
        $resultados_vet = super_request("resultados_vet", 'GET', false, $headers);

        //monta array de referencias
        foreach ($resultados_vet as $arquivo) {
            $array_sincro[] = $arquivo->Referencia_txf;
        }

        // compara os arquivos da pasta com os resultados do labcloud para ver o q deve ser sincronizado
        $sincronizar = array_diff($arquivos, $array_sincro);



        $i = 0;

        // para arquivo, le os dados e envia para o labcloud
        foreach ($sincronizar as $arq) {
            $i = $i + 1;


            $lines = file($this->diretorio . $arq, FILE_IGNORE_NEW_LINES);
//            ver($lines);
            $resultado = new stdClass();

            $resultado->Referencia_txf = $arq;
            $resultado->Descricao_txf = utf8_encode($lines[1]);
            $nome_array = explode(': ', $resultado->Descricao_txf);

            $animal_array = explode(' ', $nome_array[1]);
            $animal = $animal_array[0];
            $proprietario = $nome_array[2];


            $resultado->Animal_txf = $animal;
            $resultado->Proprietario_txf = $proprietario;
            $resultado->Ficha_txf = utf8_encode($lines[5]);
            $resultado->Arquivo_txf = utf8_encode($lines[5]) . '.pdf';
            $resultado->Data_dat = formata_data_sql($lines[7]);


            $resultado->Login_txf = utf8_encode($lines[3]);
            $resultado->Senha_txf = utf8_encode($lines[4]);
            $resultado->Nome_txf = utf8_encode($lines[5]);
            $arquivo->Data_sincro_dat = date('Y-m-d H:i:s');

            $extensao = substr($arq, -3);


            switch ($extensao) {

                case 'VET':

                    $resultado_bd = super_request("resultados_vet", 'POST', $resultado, $headers);


                    if ($resultado_bd) {
                        echo "Resultado {$resultado_bd->Nome_txf} {$resultado_bd->Descricao_txf} enviado com sucesso!<br>";
                    } else {
                        echo "Erro {$resultado->Nome_txf} {$resultado->Descricao_txf}<br>";
                    }
                    break;
            }
        }
        echo "<br> $i resultados .VET inseridos";
    }

    function sincro_labcloud() {

        if (!$this->app->id_lab) {
            die('acesso inválido, aplicativo sem id do laboratório');
        }

        $this->sincro_cli();
        $this->sincro_sli_novo();
        $this->sincro_vet();
    }

    function sincro_labcloud_geral() {

        if (!$this->app->id_lab) {
            die('acesso inválido, aplicativo sem id do laboratório');
        }
        $this->sincro_cli(TRUE);
//        $this->sincro_sli(TRUE);
    }

    function sincro_cadastro() {
        $where = "where Email_txf!=''";

        if ($this->uri->segment(2)) {
            $id = $this->uri->segment(2);
            $where.=" and Id_int={$id}";
        } else {
            $where.=" and Enviado_sel='NAO' and  Login_txf!='' and Senha_txf!='' ";
        }
        $sql = "select * from cadastros $where";


        $cadastros = $this->mbc->executa_sql($sql);
        if ($cadastros) {
            foreach ($cadastros as $cadastro) {
                if ($this->envia_senha($cadastro)) {
                    $array = array();
                    $array['Enviado_sel'] = 'SIM';
                    $this->mbc->updateTable('cadastros', $array, 'Id_int', $cadastro->Id_int);
                    echo "Enviado Email para {$cadastro->Email_txf} <br>";
                }
            }
        } else {
            echo "Nenhum email a ser enviado";
        }
    }

    function envia_senha($cadastro) {


        $this->load->model('model_mail');
        //$cadastro->Nome_txf . $cadastro->Nome_fantasia_txf
        $email['Destinatario_txf'] = $cadastro->Email_txf;
        $email['Nome_txf'] = $this->app->Nome_app_txf;
        $email['Assunto_txf'] = "Senha de Acesso ao Sistema";
        $email['Email_txf'] = $this->cliente->Email_txf;

//ver($this->app);
        $this->smarty->assign('cadastro', $cadastro);
        if (file_exists(COMMONPATH . "../templates/{$this->app->Template_txf}/email/senha.tpl")) {
            $caminho = COMMONPATH . "../templates/{$this->app->Template_txf}/email/senha.tpl";
        } else {
            $caminho = COMMONPATH . "../templates/padrao/email/senha.tpl";
        }
        $email['Mensagem_txa'] = $this->smarty->fetch($caminho);

        return $this->model_mail->envia_email($email, 'boolean');


        //   return $enviou;
        //envia_email_tpl
    }

    function le_pasta() {
        $lista_arquivos = $this->sdir($this->diretorio, '*.CLI|*.SLI|*.VET');
        //   $lista_arquivos = $this->sdir($this->diretorio, '*.CLI|*.SLI');
//        foreach ($lista_arquivos as $ar) {
//            if (substr($ar, 0, 6) != "~ftpb_") {
//                $arqs[] = $ar;
//            }
//        }

        $this->arquivos = $lista_arquivos;
        return $this->arquivos;
    }

    function le_pasta_cli() {
        $lista_arquivos = $this->sdir($this->diretorio, '*.CLI');
        $this->arquivos = $lista_arquivos;
        return $this->arquivos;
    }

    function le_pasta_sli() {
        $lista_arquivos = $this->sdir($this->diretorio, '*.SLI');
        $this->arquivos = $lista_arquivos;
        return $this->arquivos;
    }

    function le_pasta_vet() {
        $lista_arquivos = $this->sdir($this->diretorio, '*.VET');
        $this->arquivos = $lista_arquivos;
        return $this->arquivos;
    }

    function sincroniza() {
        $array_sincro = array();
        $arquivos_sincronizados = $this->mbc->executa_sql("select * from sincro");
//ver($this->arquivos);

        foreach ($arquivos_sincronizados as $arquivo) {
            $array_sincro[] = $arquivo->Arquivo_txf;
        }



        $sincronizar = array_diff($this->arquivos, $array_sincro);


        $arquivos = array();
        foreach ($sincronizar as $arq) {
            $lines = file($this->diretorio . $arq, FILE_IGNORE_NEW_LINES);
            $arquivo = new stdClass();
            $arquivo->Arquivo_txf = $arq;
            $arquivo->Extensao_txf = substr($arq, -3);
            $arquivo->Descricao_txf = utf8_encode($lines[1]);
            $arquivo->Pdf_txf = utf8_encode($lines[5]) . '.pdf';
            $arquivo->Usuario_txf = utf8_encode($lines[3]);
            $arquivo->Senha_txf = utf8_encode($lines[4]);
            $arquivo->Data_dat = formata_data_sql($lines[7]);
            $arquivo->Data_sincro_dat = date('Y-m-d H:i:s');

            switch ($arquivo->Extensao_txf) {
                case 'CLI':
                    $sql = "select * from cadastros where Login_txf='{$arquivo->Usuario_txf}' and Senha_txf='{$arquivo->Senha_txf}' limit 1";

                    $cadastro = $this->mbc->executa_sql($sql);

                    if ($cadastro) {
                        $arquivo->Cadastros_for = $cadastro[0]->Id_int;
                        $arquivos[] = $arquivo;
                    } else {
                        $mensagem = "{$arquivo->Arquivo_txf} nao sincronizado por falta de usuario {$arquivo->Usuario_txf} e senha {$arquivo->Senha_txf}<br>";
                        $this->insere_log($arquivo, 'ERRO', $mensagem);
                    }
                    break;
                case 'VET':

                    $arquivos[] = $arquivo;
                    break;

                case 'SLI':
                    $arquivos[] = $arquivo;
                    break;
            }
        }
        $this->insere_sincro($arquivos);

        /* DELETA OS ARQUIVOS DA BASE DE DADOS QUE NÃO ESTÃO MAIS PRESENTES */
        $dessincronizar = array_diff($array_sincro, $this->arquivos);

        foreach ($dessincronizar as $arq_desc) {
            $arquivo_desc = $this->mbc->executa_sql("select * from sincro where Arquivo_txf='{$arq_desc}'");
            if ($arquivo_desc[0]) {
                $this->mbc->db_delete('sincro', 'Id_int', $arquivo_desc[0]->Id_int);
                $mensagem = "{$arquivo_desc[0]->Arquivo_txf} excluído <br>";
                $this->insere_log($arquivo_desc[0], 'OK', $mensagem);
            }
        }
    }

    function insere_log($arquivo, $tipo = 'ERRO', $mensagem = '') {
        if (!$mensagem) {
            $mensagem = "{$arquivo->Arquivo_txf} sincronizado <br>";
        }
        $log = new stdClass();
        $log->Arquivo_txf = $arquivo->Arquivo_txf;
        $log->Tipo_sel = $tipo;
        $log->Data_dat = date('Y-m-d H:i:s');
        $log->Mensagem_txf = $mensagem;
        $registros_antigos = $this->mbc->executa_sql("select * from sincro_log where Arquivo_txf='{$arquivo->Arquivo_txf}'");
        if (!$registros_antigos[0]) {
            $this->mbc->db_insert("sincro_log", $log);
        } else {
            $updateArr = object_to_array($log);
            $this->mbc->updateTable('sincro_log', $updateArr, 'Id_int', $registros_antigos[0]->Id_int);
        }
    }

    function insere_sincro($arquivos, $tabela = 'sincro') {
        $total = count($arquivos);
        if (is_array($arquivos)) {
            foreach ($arquivos as $arquivo) {
                echo "{$arquivo->Arquivo_txf} sincronizado!<br>";
                if ($this->mbc->db_insert($tabela, $arquivo)) {
                    $this->insere_log($arquivo, 'OK');
                }
            }
        }
        echo "Total de $total Arquivos Sincronizados<br>";
    }

    function sdir($path = '.', $masks = '*', $nocache = 0) {
        static $dir = array(); // cache result in memory 
        if (!isset($dir[$path]) || $nocache) {
            $dir[$path] = scandir($path);
        }

        $masks = explode("|", $masks);
        foreach ($dir[$path] as $i => $entry) {
            if ($entry != '.' && $entry != '..') {
                foreach ($masks as $mask) {
                    if (fnmatch($mask, $entry)) {
                        $sdir[] = $entry;
                    }
                }
            }
        }




        return $sdir;
    }

}

?>