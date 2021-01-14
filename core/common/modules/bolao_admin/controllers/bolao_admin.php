<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class bolao_admin extends lands_core {

    public function __construct() {
        parent::__construct();
        $this->load->helper('tradutor');
        $this->load->helper('bolao');
        $this->carrega_model('model_bolao');
        $this->conecta_mbc(0);
        $this->app->Template_txf = $this->app->Template_txf . '/admin';
        $this->app->Url_cliente = $this->app->Url_cliente . 'admin/';
        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : 'admin');
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

    function checa_login() {

        if (isset($this->session->userdata['usuario'])) {

            $this->usuario = $this->session->userdata['usuario'];
            $this->smarty->assign('usuario', $this->usuario);
            if ($this->usuario->Tipo_sel == 'usuario') {

                $link = $this->app->Url_cliente . 'acesso_negado';
                redirect($link);
            }
            return true;
        } else {

            if (isset($_SERVER['redirect_link'])) {
                redirect("login?redirect_link=" . $this->app->Url_cliente . $this->pagina_atual);
            } else {
                redirect("login");
            }
        }
    }

     function buscar_ranking_temporada($ano) {
        $where = "where Ano_txf='{$ano}' ";
        $where.="group by Users_for order by Total desc";
        $this->smarty->assign('ano_ranking', $ano);
        $titulo_ranking = "Ranking  de $ano";
        $this->smarty->assign('titulo_ranking', $titulo_ranking);
        $sql = "select Id_int, Users_for, Rodadas_for, SUM(Pontuacao_txf) as Total, MAX(Ultimo_palpite_dat) as Ultimo_palpite_dat from ranking_temporada  $where";


        $ranking = $this->mbc->executa_sql($sql);

//        ver($ranking);

        foreach ($ranking as $rank) {
            $sql = "select SUM(Pontuacao_txf) as Total from ranking where Ano_txf='{$ano}' and Users_for={$rank->Users_for} group by Users_for order by Total desc";
            $total = $this->mbc->executa_sql($sql);
            $rank->Total_pontos = $total[0]->Total;
            $rank->Usuario = $this->mbc->buscar_completo("users", "where Id_Int={$rank->Users_for}");
        }
        sorteia_array_objetos($ranking, array('Total' => SORT_DESC, 'Total_pontos' => SORT_DESC, 'Ultimo_palpite_dat' => SORT_ASC));
//ver($ranking);


        $this->smarty->assign('ranking', $ranking);
//        ver($ranking);
//        $this->model_smarty->carrega_bloco('ranking', 'ranking', $this->app->Template_txf);
    }
    
    function carrega_obrigatorios() {
        if ($this->pagina_atual != 'acesso_negado') {
            $this->checa_login();
        }

        $meses = $this->mbc->buscar_tudo("meses", "where Id_int is not null order by Id_int");
        $this->smarty->assign('meses', $meses);
        $temporadas = $this->mbc->buscar_tudo("temporadas", "where Id_int is not null order by Id_int");
        $this->smarty->assign('temporadas', $temporadas);
        $this->smarty->assign('requisicao', $_REQUEST);
    }

    function switch_pagina() {
        $this->conecta_mbc($this->app->Conexoes_for);
        $this->carrega_obrigatorios();
         $this->smarty->assign('pagina_atual', $this->pagina_atual);
         
        switch ($this->pagina_atual) {
            case 'admin' :
                break;
            case 'rodadas' :

                $todas_rodadas = $this->mbc->buscar_tudo("rodadas", "where Id_int is not null order by Id_int desc");
                foreach ($todas_rodadas as $rodadas) {
                    $id_rodada = $rodadas->Id_int;
                    $apostadores = $this->mbc->executa_sql("select p.Users_for, u.Id_int from palpites p left outer join users u on u.Id_int=p.Users_for where Rodadas_for={$id_rodada} group by Users_for");
                    if ($apostadores[0]) {
                        $rodadas->Apostadores = $apostadores;
                    }
                }

                $this->smarty->assign('todas_rodadas', $todas_rodadas);


                break;
            case 'rodadas2' :

                $todas_rodadas = $this->mbc->buscar_tudo("rodadas", "where Id_int is not null order by Id_int desc");
                foreach ($todas_rodadas as $rodadas) {
                    $id_rodada = $rodadas->Id_int;
                    $apostadores = $this->mbc->executa_sql("select p.Users_for, u.Id_int from palpites p left outer join users u on u.Id_int=p.Users_for where Rodadas_for={$id_rodada} group by Users_for");
                    if ($apostadores[0]) {
                        $rodadas->Apostadores = $apostadores;
                    }
                }

                $this->smarty->assign('todas_rodadas', $todas_rodadas);
//                        ver($todas_rodadas);


                break;
            case 'teste_sendgrid':

//                ver('chegou');


                break;
            case 'anunciar_rodada' :

                $id_rodada = $this->uri->segment(3);
                $tipo = 'abertura';
                $this->envia_email_rodada($tipo, $id_rodada);

                break;
            case 'anunciar_ranking' :

                $id_rodada = $this->uri->segment(3);
                $tipo = 'ranking';
                $this->envia_email_rodada($tipo, $id_rodada);

                break;
            case 'meses' :
                $meses = $this->mbc->buscar_tudo("meses", "where Id_int is not null order by Id_int");
                $this->smarty->assign('meses', $meses);
                break;
            case 'times' :
                $times = $this->mbc->buscar_completo("times", "where Id_int is not null order by Nome_txf");
                $this->smarty->assign('times', $times);

                break;

            case 'editar_escudo' :
                $id = $this->uri->segment(3);

                $where = "where Id_int={$id}";
                $times = $this->mbc->buscar_completo("times", $where);
                $this->smarty->assign('times', $times);

                break;
            case 'temporadas' :
                $temporadas = $this->mbc->buscar_tudo("temporadas", "where Id_int is not null order by Id_int");
                $this->smarty->assign('temporadas', $temporadas);



                break;
            
                  case 'usuarios' :
                      
//                           
//        $where="group by Users_for order by Total desc, Ultimo_palpite_dat";
//        $sql = "select *, Pontuacao_txf as Total from ranking $where";
//                                 
////        $sql = "select u.*, p.Data_hora_dat from users u left outer join palpites p on p.Users_for=u.Id_int order by p.Data_hora_dat DESC";
//        
//          $usuarios = $this->mbc->executa_sql($sql);
//                $this->smarty->assign('usuarios', $usuarios);

         $todos_anos = $this->mbc->buscar_tudo("ranking_temporada", "group by Ano_txf order by Ano_txf desc");
                if ($todos_anos[0]) {
                    $this->smarty->assign('todos_anos', $todos_anos);

                    if ($this->uri->segment(3)) {
                        $ano = $this->uri->segment(3);
                    } else {
                        $ano = $todos_anos[0]->Ano_txf;
                    }

                    $ano = urldecode($ano);
                    
                    $this->buscar_ranking_temporada($ano);
                }



                break;
         
            case 'regulamento' :
                $regulamento = $this->mbc->buscar_tudo("regulamento", "where Id_int is not null order by Id_int limit 1");
                $this->smarty->assign('regulamento', $regulamento);



                break;


            case 'jogos_rodada' :
                $todas_rodadas = $this->mbc->buscar_completo("rodadas", "where Id_int is not null order by Id_int desc");
                $this->smarty->assign('todas_rodadas', $todas_rodadas);
                if ($this->uri->segment(3)) {
                    $id_rodada = $this->uri->segment(3);
                } else {
                    $id_rodada = $todas_rodadas[0]->Id_int;
                }

                $this->buscar_rodada($id_rodada);

                break;
        }
    }

    function envia_email_rodada($tipo, $id_rodada) {


        $dados = new stdClass();
        $dados->From = 'contato@bolaopapodecopa.com.br';
        $dados->FromName = ('Bolão Papo de Copa');


        $this->buscar_rodada($id_rodada);

        $destinatarios = $this->mbc->executa_sql("select * from users where Recebe_notificacoes_sel='SIM' and Bloqueado_sel='NAO' and Email_txf is not null order by Id_int desc");
        //Leu_regulamento_sel='SIM' and 
        //and Email_txf LIKE '%lands%'  
//ver(count($destinatarios));
//        $usuario_platon = new stdClass();
//        $usuario_platon->Nome_txf = 'Platon Teste';
//        $usuario_platon->Email_txf = 'platon.testes@hotmail.com';
//        $destinatarios[] = $usuario_platon;

        $caminho = COMMONPATH . "../templates/{$this->app->Template_txf}/email/{$tipo}.tpl";




//        $this->load->helper('mandrilla');
        switch ($tipo) {
            case 'abertura':
                if ($this->rodada->Anunciada_sel == 'NAO') {
                    $dados->Subject = ('Nova Rodada - Bolão Papo de Copa');
                    foreach ($destinatarios as $destinatario) {
                        $this->smarty->assign('destinatario_atual', $destinatario);

                        $mensagem = $this->smarty->fetch($caminho);
                        $dados->Body = ($mensagem);
                        //envia_email_mandrilla($dados, $destinatario->Email_txf);
                           $this->envia_email_aws($dados, $destinatario);
                           
//                        if (is_lands()) {
//                         
//                        } else {
//                            $this->envia_email_sendgrid($dados, $destinatario);
//                        }
                    }

                    $objeto_update['Anunciada_sel'] = 'SIM';
                    $this->mbc->updateTable('rodadas', $objeto_update, 'Id_int', $id_rodada);

                    die("Rodada anunciada com sucesso para " . count($destinatarios) . " usuarios");
                } else {
                    die('Rodada ja anunciada');
                }
                break;
            case 'ranking':
                if ($this->rodada->Ranking_anunciado_sel == 'NAO') {
                    $dados->Subject = ('Ranking - Bolão Papo de Copa');
                    foreach ($destinatarios as $destinatario) {
                        $this->smarty->assign('destinatario_atual', $destinatario);
                        $mensagem = $this->smarty->fetch($caminho);

                        $dados->Body = ($mensagem);
                        //  envia_email_mandrilla($dados, $destinatario->Email_txf);
                          $this->envia_email_aws($dados, $destinatario);
//                        if (is_lands()) {
//                         
//                            //   ver('chegou');
//                        } else {
//                            $this->envia_email_sendgrid($dados, $destinatario);
//                        }
                    }
                    die("Ranking anunciado com sucesso para " . count($destinatarios) . " usuarios");
                    $objeto_update['Ranking_anunciado_sel'] = 'SIM';
                    $this->mbc->updateTable('rodadas', $objeto_update, 'Id_int', $id_rodada);
                    die("Ranking anunciado com sucesso para " . count($destinatarios) . " usuarios");
                } else {
                    die('Ranking  ja anunciado');
                }
                break;
        }
    }

    function envia_email_aws($dados = null, $destinatario = null) {

        require (COMMONPATH . 'third_party/amazon_sdk/vendor/autoload.php');

        $sharedConfig = [
            'region' => 'us-east-1',
            'version' => 'latest',
            'credentials' => [
                'key' => 'AKIAIYUM2ZKXOQ3IIYMA',
                'secret' => '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'
            ]
        ];
 
// Create an SDK class used to share configuration across clients.
        $sdk = new Aws\Sdk($sharedConfig);

// Create an Amazon S3 client using the shared configuration data.
        $client = $sdk->createSes();



        try {
//            ver($destinatario->Email_txf);
            $result = $client->sendEmail([
//                'ConfigurationSetName' => 'ConfigSet',
                'Destination' => [ // REQUIRED
                    //   'BccAddresses' => ['<string>'],
                    // 'CcAddresses' => ['<string>'],
                    'ToAddresses' => [$destinatario->Email_txf],
                ],
                'Message' => [ // REQUIRED
                    'Body' => [ // REQUIRED
                        'Html' => [
                            'Charset' => 'UTF-8',
                            'Data' => $dados->Body, // REQUIRED
                    ],
//                        'Text' => [
//                            'Charset' => 'UTF-8',
//                            'Data' => 'Email de teste', // REQUIRED
//                    ],
                    ],
                    'Subject' => [ // REQUIRED
                        'Charset' => 'UTF-8',
                        'Data' => $dados->Subject, // REQUIRED
                ],
                ],
                //'ReplyToAddresses' => ['contato@bolaopapodecopa.com.br'],
                //'ReturnPath' => '<string>',
                //'ReturnPathArn' => '<string>',

                'Source' => '"bolaopapodecopa.com.br" <noreply@bolaopapodecopa.com.br>', // REQUIRED
                    //'SourceArn' => '<string>',
                    //  'Tags' => [
                    //    [
                    //      'Name' => '<string>', // REQUIRED
                    //    'Value' => '<string>', // REQUIRED
                    //],
//                ],
                    ]);
//ver($result);
            return $result;
//            ver($result);
        } catch (Exception $e) {
//            ver($e->getTrace());
            // output error message if fails
            echo $e->getMessage();
            echo "<br><br>";
//            ver($e->getMessage());
            error_log($e->getMessage());
        }
    }

    function envia_email_sendgrid($dados, $destinatario) {



// using SendGrid's PHP Library
// https://github.com/sendgrid/sendgrid-php
// If you are using Composer (recommended)
        require (COMMONPATH . 'third_party/sendgrid/vendor/autoload.php');

//        ver($dados,1);
//        ver($destinatario);
// If you are not using Composer
// require("path/to/sendgrid-php/sendgrid-php.php");
        $from = new SendGrid\Email("Bolão Papo de Copa", "webmaster@bolaopapodecopa.com.br");
        $subject = $dados->Subject;
        //$to = new SendGrid\Email("Vedana","gustavo.vedana@landsagenciaweb.com.br");
        $to = new SendGrid\Email($destinatario->Nome_txf, $destinatario->Email_txf);
        $content = new SendGrid\Content("text/html", $dados->Body);
        $mail = new SendGrid\Mail($from, $subject, $to, $content);
//                ver($_ENV);
//                $apiKey = getenv('SENDGRID_API_KEY');
        $apiKey = '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';
//                ver($apiKey);
        $sg = new \SendGrid($apiKey);

        $response = $sg->client->mail()->send()->post($mail);

        return $response->statusCode();
        //print_r($response->headers());
        //echo $response->body();
//die();
    }

    function buscar_rodada($id_rodada) {
        $where = "where Rodadas_for={$id_rodada}";
        $where_rodada = "where Id_int={$id_rodada}";
        $rodada = $this->mbc->buscar_completo("rodadas", "$where_rodada");
        $titulo_ranking = "Ranking da " . $rodada[0]->Nome_txf;
        $this->smarty->assign('titulo_ranking', $titulo_ranking);

        $jogos_rodada = $this->mbc->buscar_tudo("jogos", "$where");
        $cont = 0;
        $numero_jogos = count($jogos_rodada);


        foreach ($jogos_rodada as $jogo) {
            $jogo->Casa = $this->mbc->buscar_completo("times", "where Id_int={$jogo->Casa_sel}");
            $jogo->Fora = $this->mbc->buscar_completo("times", "where Id_int={$jogo->Fora_sel}");
            if ($jogo->Casa_gols_txf != '' && $jogo->Fora_gols_txf != '') {
                $cont = $cont + 1;
            }
        }
        if ($rodada[0]->Status_sel != 'encerrada') {
            if ($numero_jogos == $cont) {
                $rodada[0]->Status_sel = 'pronta';
            }
        }
        $this->rodada = $rodada[0];
        $this->smarty->assign('rodada', $rodada);

        $this->smarty->assign('jogos_rodada', $jogos_rodada);
    }

    function enviar() {

        $this->conecta_mbc($this->app->Conexoes_for);

        $segmento = (int) $this->app->Segmento_padrao_txf;
        $segmento = $segmento + 2;

        $pagina = $this->uri->segment($segmento);

        switch ($pagina) {
            case 'editar_rodada':
                $this->altera_insere_registro();
                break;
            case 'editar_mes':
                $this->altera_insere_registro();
                break;
            case 'editar_time':
                $this->altera_insere_registro();
                break;
            case 'editar_temporada':
                $this->altera_insere_registro();
                break;
            case 'editar_regulamento':
                $dados = $_POST;

                $this->mbc->updateTable($dados['Tabela_txf'], $_POST, 'Id_int', $dados['Id_int']);
                redirect($this->app->Url_cliente . "regulamento?mensagem=regulamento_alterado");
                break;
            case 'editar_jogo':
                $this->altera_insere_registro();
                break;
            case 'escudo':
                $this->enviar_escudo();
                break;
            case 'excluir':
                $this->exclui_registro();

                break;
            case 'filtro_rodadas':
                $id = $_POST['Id_int'];
                redireciona($this->app->Url_cliente . "jogos_rodada/" . $id);
                break;

            case 'encerrar_rodada':

                $id_rodada = $_POST['Rodadas_for'];
                $mes = $_POST['Mes_txf'];
                $ano = $_POST['Ano_txf'];
                $registros = $this->mbc->executa_sql("select * from ranking where Rodadas_for={$id_rodada}");
                if ($registros[0]) {
                    foreach ($registros as $registro) {
                        $this->mbc->deleteRow('ranking', 'Id_int', $registro->Id_int);
                    }
                }

                $users = $this->mbc->executa_sql("select Users_for, p.Data_hora_dat from palpites p left outer join users u on u.Id_int=p.Users_for where Rodadas_for=$id_rodada group by Users_for order by p.Data_hora_dat");


                foreach ($users as $user) {
                    $user->Pontuacao_desafio_txf = 0;
                    $user->Mes_txf = $mes;
                    $user->Ano_txf = $ano;
                    $user->Rodadas_for = $id_rodada;
                    $user->Ultimo_palpite_dat = $user->Data_hora_dat;



                    $palpites = $this->mbc->executa_sql("select * from palpites where Rodadas_for=$id_rodada and Users_for=$user->Users_for");
                    foreach ($palpites as $palpite) {
                        $jogo = $this->mbc->executa_sql("select * from jogos where Id_int=$palpite->Jogos_for");
                        $palpite->Pontuacao = pontos_aposta_admin($jogo[0], $palpite);
                        $user->Pontuacao_txf = $user->Pontuacao_txf + $palpite->Pontuacao;
                    }


                    $desafios = $this->model_bolao->busca_desafios_usuario($user->Users_for);
                    foreach ($desafios as $desafio) {

                        $palpites = $this->mbc->executa_sql("select * from palpites where Rodadas_for=$id_rodada and Users_for={$desafio->Desafiante->Id_int}");
                        foreach ($palpites as $palpite) {
                            $jogo = $this->mbc->executa_sql("select * from jogos where Id_int=$palpite->Jogos_for");
                            $palpite->Pontuacao = pontos_aposta_admin($jogo[0], $palpite);
                            $desafio->Pontuacao_desafiante_txf = $desafio->Pontuacao_desafiante_txf + $palpite->Pontuacao;
                        }

                        $palpites = $this->mbc->executa_sql("select * from palpites where Rodadas_for=$id_rodada and Users_for={$desafio->Desafiado->Id_int}");
                        foreach ($palpites as $palpite) {
                            $jogo = $this->mbc->executa_sql("select * from jogos where Id_int=$palpite->Jogos_for");
                            $palpite->Pontuacao = pontos_aposta_admin($jogo[0], $palpite);
                            $desafio->Pontuacao_desafiado_txf = $desafio->Pontuacao_desafiado_txf + $palpite->Pontuacao;
                        }

                        if ($desafio->Pontuacao_desafiado_txf == $desafio->Pontuacao_desafiante_txf) {
                            $desafio->Id_vencedor_for = 0;
                            $desafio->Vencedor_txf = 'nenhum';
                        }
                        if ($desafio->Pontuacao_desafiado_txf > $desafio->Pontuacao_desafiante_txf) {
                            $desafio->Id_vencedor_for = $desafio->Desafiado->Id_int;
                            $desafio->Vencedor_txf = 'desafiado';
                        }
                        if ($desafio->Pontuacao_desafiado_txf < $desafio->Pontuacao_desafiante_txf) {
                            $desafio->Id_vencedor_for = $desafio->Desafiante->Id_int;
                            $desafio->Vencedor_txf = 'desafiante';
                        }
                        if ($user->Users_for == $desafio->Id_vencedor_for) {
                            $user->Pontuacao_desafio_txf = $user->Pontuacao_desafio_txf + 1;
                        }

                        $desafio_array['Id_vencedor_for'] = $desafio->Id_vencedor_for;
                        $desafio_array['Vencedor_txf'] = $desafio->Vencedor_txf;
                        $this->mbc->updateTable('desafios', $desafio_array, 'Id_int', $desafio->Id_int);
                    }
                }


                foreach ($users as $user) {
                    unset($user->Id_int);
                    $user_insert = object_to_array($user);

                    $this->mbc->db_insert('ranking', $user_insert);
                    $this->mbc->db_insert('ranking_desafios', $user_insert);
                }

               
                
                    $this->model_bolao->insere_pontuacao_temporada_novo($_POST);
                    
//                     if(is_lands()){
//                } else {
//                    $this->model_bolao->insere_pontuacao_temporada($_POST);
//                }
                

//die();

                $rodada['Status_sel'] = 'encerrada';
                $this->mbc->updateTable('rodadas', $rodada, 'Id_int', $id_rodada);
                redirect($this->app->Url_cliente . '../ranking/' . $id_rodada);
                break;
            case 'filtro_rodadas':
                $id = $_POST['Id_int'];
                redireciona($this->app->Url_cliente . "jogos_rodada/" . $id);
                break;
        }
    }

    function insere_pontos_desafios($user) {

        ver($usuario);
    }

    function enviar_escudo() {
        $redirect_link = $_POST['redirect_link'];
        $pasta = $this->dados_conexao['database'];
        $this->app->Url_cliente = $this->app->Url_cliente . '../';
        $upload_path_url = $this->app->Url_cliente . $this->app->Pasta_painel . 'arquivos/' . $pasta . '/';

        $config['upload_path'] = FCPATH . $this->app->Pasta_painel . 'img/' . $pasta . '/';
//		$config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|png';
        $config['overwrite'] = TRUE;


        /* $config['max_size']	= '1000';
         * 
          $config['max_width']  = '1024';
          $config['max_height']  = '768'; */

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
            echo '<div id="status">error</div>';
            echo '<div id="message">' . $this->upload->display_errors() . '</div>';
        } else {


            $id = $_POST['Id_imagem_con'];
            $imagens = $this->mbc->executa_sql("select * from imagens where Id_imagem_con={$id}");
            if ($imagens[0]) {
                foreach ($imagens as $imagem) {
                    $this->mbc->db_delete('imagens', 'Id_int', $imagem->Id_int);
                }
            }


            $data = array('upload_data' => $this->upload->data());
            $arquivo['Nome_txf'] = $data['upload_data']['file_name'];
            $arquivo['Caminho_txf'] = 'img/' . $pasta . '/' . $arquivo['Nome_txf'];
            $arquivo['Descricao_txf'] = $_POST['Nome_txf'];
            $arquivo['Id_imagem_con'] = $id;
            $arquivo['Tabela_con'] = $_POST['Tabela_con'];


            $this->conecta_mbc($this->app->Conexoes_for);
            $this->mbc->db_insert('imagens', $arquivo);

            echo '<div id="status">success</div>';
//then output your message (optional)
            echo '<div id="message"> Escudo enviado com sucesso!</div>';
//pass the data to js
            echo '<div id="upload_data">' . json_encode($data) . '</div>';

            // redirecion($redirect_link);
        }
    }

    function ajax() {

        $this->conecta_mbc($this->app->Conexoes_for);

        $segmento = (int) $this->app->Segmento_padrao_txf;
        $segmento = $segmento + 2;

        $pagina = $this->uri->segment($segmento);

        switch ($pagina) {
            case 'editar_rodada':

                $sql = "select * from {$_POST['Tabela_txf']} where Id_int='{$_POST['Id_int']}'";

                $registro = $this->mbc->executa_sql($sql);
                $this->smarty->assign("registro", $registro[0]);

                $meses = $this->mbc->buscar_tudo("meses", "where Id_int is not null order by Id_int");
                $this->smarty->assign('meses', $meses);
                $temporadas = $this->mbc->buscar_tudo("temporadas", "where Id_int is not null order by Id_int");
                $this->smarty->assign('temporadas', $temporadas);


                echo $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, 'forms', $pagina);
                die();
                break;
            case 'editar_mes':

                $sql = "select * from {$_POST['Tabela_txf']} where Id_int='{$_POST['Id_int']}'";
                $registro = $this->mbc->executa_sql($sql);
                $this->smarty->assign("registro", $registro[0]);
                echo $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, 'forms', $pagina);
                die();
                break;
            case 'editar_time':

                $sql = "select * from {$_POST['Tabela_txf']} where Id_int='{$_POST['Id_int']}'";
                $registro = $this->mbc->executa_sql($sql);
                $this->smarty->assign("registro", $registro[0]);
                echo $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, 'forms', $pagina);
                die();
                break;

            case 'editar_escudo':
                $registro = $this->mbc->buscar_completo($_POST['Tabela_txf'], "where Id_int='{$_POST['Id_int']}'");
                $this->smarty->assign("registro", $registro[0]);
                echo $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, 'forms', $pagina);
                die();
                break;
            case 'editar_temporada':

                $sql = "select * from {$_POST['Tabela_txf']} where Id_int='{$_POST['Id_int']}'";
                $registro = $this->mbc->executa_sql($sql);
                $this->smarty->assign("registro", $registro[0]);
                echo $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, 'forms', $pagina);
                die();
                break;

            case 'editar_jogo':


                if ($_POST['Id_int']) {
                    $sql = "select * from {$_POST['Tabela_txf']} where Id_int='{$_POST['Id_int']}'";
                    $registro = $this->mbc->executa_sql($sql);
                    $this->smarty->assign("registro", $registro[0]);
                }

                $times = $this->mbc->buscar_completo("times", "order by Nome_txf");

                $this->smarty->assign("times", $times);

                echo $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, 'forms', $pagina);
                die();
                break;
            case 'excluir':

                echo $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, 'forms', $pagina);
                die();
                break;

            default:
                break;
        }
    }

    function altera_insere_registro() {

        $dados = $_POST;
        if (!$dados['Tabela_txf']) {

            die('Campo Tabela_txf nao encontrado');
        }



        if (!$dados['Id_int']) {
            if ($this->mbc->db_insert($dados['Tabela_txf'], $_POST)) {
                $this->smarty->assign('mensagem', 'inseriu_ok');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            } else {
                $this->smarty->assign('mensagem', 'inseriu_erro');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            }
        } else {
            if ($this->mbc->updateTable($dados['Tabela_txf'], $_POST, 'Id_int', $dados['Id_int'])) {
                $this->smarty->assign('mensagem', 'atualizacao_ok');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            } else {
                $this->smarty->assign('mensagem', 'atualizacao_erro');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            }
        }
    }

    function exclui_registro() {

        $dados = $_POST;
        if (!$dados['Tabela_txf']) {
            die('Campo Tabela_txf nao encontrado');
        }
        if (!$dados['Id_int']) {
            die('Id_in nao passado');
        }
        $tabela = $_POST['Tabela_txf'];
        $id = $_POST['Id_int'];


        $sql = "select * from $tabela where Id_int=$id";
        $registro = $this->mbc->executa_sql($sql);

        if ($registro[0]) {
            if ($this->mbc->db_delete($tabela, 'Id_int', $id)) {
                $this->smarty->assign('mensagem', 'excluiu_ok');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            } else {
                $this->smarty->assign('mensagem', 'excluiu_erro');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            }
        } else {
            $this->smarty->assign('mensagem', 'registro_inexistente');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
        }
    }

}

?>