<?php

require_once(COMMONPATH . 'models/model_banco_cliente.php');

class Model_pitacos extends Model_banco_cliente {

    public $db;
//  public $tabela_emails_proprietario = 'contato';
    public $usuario;

    function __construct() {

        parent::__construct();
        if ($this->session->userdata('usuario')) {
            $this->usuario = $this->session->userdata('usuario');
        }
    }

    function inicializa($app, $cliente = null) {
        $this->app = $app;
        if ($cliente) {
            $this->cliente = $cliente;
        }
    }

    function conta_apostadores($id_rodada) {
        $total = $this->mbc->executa_sql("select count(*) as total from palpites where Rodadas_for=$id_rodada group by Users_for");
        if ($total[0]->total) {
            return $total[0]->total;
        } else {
            return 0;
        }
    }

    function calcula_pontuacao_temporada() {
        
    }

    function insere_pontuacao_temporada($dados = null) {
        $id_rodada = $_POST['Rodadas_for'];
        $mes = $_POST['Mes_txf'];
        $ano = $_POST['Ano_txf'];

        $registros = $this->mbc->executa_sql("select * from ranking_temporada where Rodadas_for={$id_rodada}");
        if ($registros[0]) {
            foreach ($registros as $registro) {
                $this->mbc->deleteRow('ranking_temporada', 'Id_int', $registro->Id_int);
            }
        }
        $rodada_anterior = $this->mbc->executa_sql("select * from rodadas where Id_int< $id_rodada limit 1");


        $where = "where Rodadas_for={$id_rodada} ";
        $where.="order by Pontuacao_txf desc, Ultimo_palpite_dat";
        $sql = "select * from ranking $where";
        $users = $this->mbc->executa_sql($sql);


        $where = "where Rodadas_for={$id_rodada} ";
        $where.="group by Pontuacao_txf  order by Pontuacao_txf desc limit 5";
        $sql = "select Pontuacao_txf from ranking $where";
        $pontuacoes = $this->mbc->executa_sql($sql);


        foreach ($users as $user) {
//            echo $user->Users_for . " fez {$user->Pontuacao_txf} pontos <br>";
            if ($rodada_anterior[0]) {
                $posicao_anterior = $this->busca_pontuacao_rodada($rodada_anterior[0]->Id_int, $user->Users_for);
            } else {
                $posicao_anterior = 0;
            }
//            ver($posicao_anterior);
//             $user->Obs_txf = "Pontuação reduzida para 1 por ter ficado entre os dois primeiros na rodada anterior. Item 3.7 do regulamento.";
            unset($user->Id_int);

            if ($user->Pontuacao_txf === $pontuacoes[0]->Pontuacao_txf) {

                if ($posicao_anterior == 5 || $posicao_anterior == 4) {
                    $user->Pontuacao_txf = 1;
                    $user->Obs_txf = "Pontuação reduzida para 1 por ter ficado entre os dois primeiros na rodada anterior. Item 3.7 do regulamento.";
                } else {
                    $user->Pontuacao_txf = 5;
                }
//                echo "{$user->Users_for} fez {$user->Pontuacao_txf} == {$pontuacoes[0]->Pontuacao_txf}";
//                $user->Pontuacao_txf = 5;
                $user->Posicao_txf = 1;
                $user_insert = object_to_array($user);
//                echo "inseriu $user->Pontuacao_txf para o usuario $user->Users_for <br>";
                $this->mbc->db_insert('ranking_temporada', $user_insert);
            }
            if ($user->Pontuacao_txf === $pontuacoes[1]->Pontuacao_txf) {


                if ($posicao_anterior == 5 || $posicao_anterior == 4) {
                    $user->Pontuacao_txf = 1;
                    $user->Obs_txf = "Pontuação reduzida para 1 por ter ficado entre os dois primeiros na rodada anterior. Item 3.7 do regulamento.";
                } else {
                    $user->Pontuacao_txf = 4;
                }

//                echo "{$user->Users_for} fez {$user->Pontuacao_txf} == {$pontuacoes[1]->Pontuacao_txf}";
//                $user->Pontuacao_txf = 4;
                $user->Posicao_txf = 2;
                $user_insert = object_to_array($user);
//                echo "inseriu $user->Pontuacao_txf para o usuario $user->Users_for <br>";
                $this->mbc->db_insert('ranking_temporada', $user_insert);
            }
            if ($user->Pontuacao_txf === $pontuacoes[2]->Pontuacao_txf) {
                if ($posicao_anterior == 5 || $posicao_anterior == 4) {
                    $user->Pontuacao_txf = 1;
                    $user->Obs_txf = "Pontuação reduzida para 1 por ter ficado entre os dois primeiros na rodada anterior. Item 3.7 do regulamento.";
                } else {
                    $user->Pontuacao_txf = 3;
                }
                $user->Posicao_txf = 3;
                $user_insert = object_to_array($user);
//                echo "{$user->Users_for} fez {$user->Pontuacao_txf} == {$pontuacoes[2]->Pontuacao_txf}";
//                echo "inseriu $user->Pontuacao_txf para o usuario $user->Users_for <br>";
                $this->mbc->db_insert('ranking_temporada', $user_insert);
            }
            if ($user->Pontuacao_txf === $pontuacoes[3]->Pontuacao_txf) {
                if ($posicao_anterior == 5 || $posicao_anterior == 4) {
                    $user->Pontuacao_txf = 1;
                    $user->Obs_txf = "Pontuação reduzida para 1 por ter ficado entre os dois primeiros na rodada anterior. Item 3.7 do regulamento.";
                } else {
                    $user->Pontuacao_txf = 2;
                }
                $user->Posicao_txf = 4;
                $user_insert = object_to_array($user);
//                echo "inseriu $user->Pontuacao_txf para o usuario $user->Users_for <br>";
//                echo "{$user->Users_for} fez {$user->Pontuacao_txf} == {$pontuacoes[3]->Pontuacao_txf}";
                $this->mbc->db_insert('ranking_temporada', $user_insert);
            }
            if ($user->Pontuacao_txf === $pontuacoes[4]->Pontuacao_txf) {
                if ($posicao_anterior == 5 || $posicao_anterior == 4) {
                    $user->Pontuacao_txf = 1;
                    $user->Obs_txf = "Pontuação reduzida para 1 por ter ficado entre os dois primeiros na rodada anterior. Item 3.7 do regulamento.";
                } else {
                    $user->Pontuacao_txf = 1;
                }
                $user->Posicao_txf = 5;
                $user_insert = object_to_array($user);
//                echo "inseriu $user->Pontuacao_txf para o usuario $user->Users_for <br>";
//                echo "{$user->Users_for} fez {$user->Pontuacao_txf} == {$pontuacoes[4]->Pontuacao_txf}";
                $this->mbc->db_insert('ranking_temporada', $user_insert);
            }
        }
    }

    function busca_pontuacao_rodada($id_rodada, $id_usuario) {
        $sql = "select * from  ranking_temporada where Rodadas_for=$id_rodada and Users_for=$id_usuario";

        $posicao_anterior = $this->mbc->executa_sql($sql);
        if ($posicao_anterior[0]) {
            return $posicao_anterior[0]->Pontuacao_txf;
        } else {
            return false;
        }
    }

    function busca_posicao_rodada($id_rodada, $id_usuario) {
        $sql = "select * from  ranking_temporada where Rodadas_for=$id_rodada and Users_for=$id_usuario";

        $posicao_anterior = $this->mbc->executa_sql($sql);
        if ($posicao_anterior[0]) {
            return $posicao_anterior[0]->Posicao_txf;
        } else {
            return false;
        }
    }

    function esta_desafiando($id_rodada, $id_usuario) {
        $desafiando = $this->mbc->executa_sql("select * from desafios where Rodadas_for=$id_rodada and Desafiante_for=$id_usuario and Status_sel='aceito'");

        if ($desafiando[0]) {
            $total_desafiando = count($desafiando);
        } else {
            $total_desafiando = 0;
        }

        $desafiado = $this->mbc->executa_sql("select * from desafios where Rodadas_for=$id_rodada and Desafiado_for=$id_usuario and Status_sel='aceito'");
        if ($desafiado[0]) {
            $total_desafiado = count($desafiado);
        } else {
            $total_desafiado = 0;
        }

        $total = $total_desafiado + $total_desafiando;

        if ($total >= 3) {
            return TRUE;
        } else {
            return FALSE;
        }

        // select * from user u where not exists (select 1 from player p where p.user_id = u.id limit 1)
    }

    function busca_apostadores_desafio($id_rodada, $id_usuario) {
        //select * from user u where not exists (select 1 from player p where p.user_id = u.id limit 1)
        $apostadores = $this->mbc->executa_sql("select p.Users_for, u.* from palpites p left outer join users u on u.Id_int=p.Users_for where Rodadas_for={$id_rodada} and u.Id_int!=$id_usuario group by Users_for");
        $apostadores = $this->mbc->complementa_registros($apostadores, 'users');
        $lista_possiveis = array();
        foreach ($apostadores as $apostador) {
//            if (!$this->esta_desafiando($id_rodada, $apostador->Id_int) && !$this->ja_foi_convidado($id_rodada, $apostador->Id_int)) {
            if (!$this->esta_desafiando($id_rodada, $apostador->Id_int)) {
                $lista_possiveis[] = $apostador;
            }
        }
        return $lista_possiveis;
    }

    function busca_desafio($id_desafio) {
        $desafios = $this->mbc->buscar_completo("desafios", " where Id_int=$id_desafio");
        if ($desafios[0]) {
            foreach ($desafios as $desafio) {
                $desafio->Desafiante = $this->busca_usuario($desafio->Desafiante_for);
                $desafio->Desafiado = $this->busca_usuario($desafio->Desafiado_for);
            }
            return $desafios[0];
        } else {
            return false;
        }
    }

    function busca_desafios($id_rodada) {
        $desafios = $this->mbc->buscar_completo("desafios", " where Rodadas_for=$id_rodada and Status_sel='aceito'");
        foreach ($desafios as $desafio) {
            $desafio->Desafiante = $this->busca_usuario($desafio->Desafiante_for);
            $desafio->Desafiado = $this->busca_usuario($desafio->Desafiado_for);
        }
        return $desafios;
    }

    function busca_solicitacoes_desafios_usuario($id_usuario) {
        $desafios = $this->mbc->executa_sql("select d.*, r.Nome_txf from desafios d left outer join rodadas r on r.Id_int=d.Rodadas_for where  d.Status_sel='aguardando' and r.Status_sel='aberta' and (Desafiante_for={$id_usuario} or Desafiado_for={$id_usuario})");
        foreach ($desafios as $desafio) {
            $desafio->Desafiante = $this->busca_usuario($desafio->Desafiante_for);
            $desafio->Desafiado = $this->busca_usuario($desafio->Desafiado_for);
        }

        return $desafios;
    }

    function busca_solicitacoes_pendentes($id_usuario) {
        $desafios = $this->mbc->executa_sql("select d.*, r.Nome_txf from desafios d left outer join rodadas r on r.Id_int=d.Rodadas_for where  d.Status_sel='aguardando' and r.Status_sel='aberta' and  Desafiado_for={$id_usuario}");
        foreach ($desafios as $desafio) {
            $desafio->Desafiante = $this->busca_usuario($desafio->Desafiante_for);
            $desafio->Desafiado = $this->busca_usuario($desafio->Desafiado_for);
        }

        return $desafios;
    }

    function busca_desafios_usuario($id_usuario) {
        $desafios = $this->mbc->executa_sql("select d.*, r.Nome_txf from desafios d left outer join rodadas r on r.Id_int=d.Rodadas_for where  d.Status_sel='aceito' and (Desafiante_for={$id_usuario} or Desafiado_for={$id_usuario})");
        foreach ($desafios as $desafio) {
            $desafio->Desafiante = $this->busca_usuario($desafio->Desafiante_for);
            $desafio->Desafiado = $this->busca_usuario($desafio->Desafiado_for);
        }
        return $desafios;
    }

    function busca_notificacoes() {
        $notificacoes = new stdClass();
        $notificacoes->Desafios = $this->busca_solicitacoes_desafios_usuario($this->usuario->Id_int);
        return $notificacoes;
    }

    function verifica_limite_desafios($id_rodada, $id_usuario) {
        $sql = "select * from desafios where Rodadas_for=$id_rodada and  Status_sel='aceito' and ( Desafiante_for=$id_usuario  or Desafiado_for=$id_usuario)";
        $limites = $this->mbc->executa_sql($sql);
        if (count($limites) >= 3) {
            return true;
        } else {
            return false;
        }
    }

    function verifica_responder($dados) {
        $dados = array_to_object($dados);

        $resposta->status = 'success';
        $resposta->message = "Operação executada com sucesso!";

        if ($this->usuario->Id_int != $dados->Desafiado_for) {
            $resposta->status = 'error';
            $resposta->error = 'usuario';
            $resposta->message = "Você não pode responder por outra pessoa!";

            return $resposta;
        }

        $id_rodada = $dados->Rodadas_for;
        $id_desafiante = $dados->Desafiante_for;
        $id_desafiado = $dados->Desafiado_for;


        if ($dados->Status_sel == 'aceito') {
            if ($this->verifica_limite_desafios($id_rodada, $id_desafiante)) {
                $resposta->status = 'error';
                $resposta->error = 'limite';
                $resposta->message = "Desafiante já atingiu o limite de desafios!";
//                return $resposta;
            }
            if ($this->verifica_limite_desafios($id_rodada, $id_desafiado)) {
                $resposta->status = 'error';
                $resposta->error = 'limite';
                $resposta->message = "Desafiado já atingiu o limite de desafios!";
//                return $resposta;
            }
        }
//        ver($resposta);
//        ver('chegou');
        return $resposta;
    }

    function verifica_inserir($dados) {

        $resposta = new StdClass();
        $resposta->status = 'success';
        $resposta->message = 'ok';

        $id_rodada = $dados['Rodadas_for'];
        $id_desafiante = $dados['Desafiante_for'];
        $id_desafiado = $dados['Desafiado_for'];


        if ($dados->Status_sel == 'aceito') {
            if ($this->esta_desafiando($id_rodada, $id_desafiante)) {
                $resposta->status = 'error';
                $resposta->error = 'limite';
                if ($id_desafiante != $this->usuario->Id_int) {
                    $resposta->message = "Este usuário já atingiu o limite de desafios!";
                } else {
                    $resposta->message = "Você já atingiu o limite de desafios!";
                }
            }
        }

        if ($this->ja_foi_convidado($id_rodada, $id_desafiado)) {
            $resposta->status = 'error';
            $resposta->error = 'duplicidade';
            $resposta->message = "Você já convidou este usuário para um desafio";
        }
        return $resposta;
    }

    function ja_apostou($id_rodada, $id_usuario) {
        $sql = "select * from palpites where Rodadas_for=$id_rodada and  Users_for=$id_usuario";
        $ja_apostou = $this->mbc->executa_sql($sql);

        if ($ja_apostou[0]) {
            return true;
        } else {
            return false;
        }
    }

    function ja_foi_convidado($id_rodada, $id_usuario) {
        $sql = "select * from desafios where Rodadas_for=$id_rodada and  ( Status_sel='aguardando' or Status_sel='aceito' ) and (( Desafiante_for=$id_usuario and Desafiado_for={$this->usuario->Id_int}) or ( Desafiante_for={$this->usuario->Id_int} and Desafiado_for=$id_usuario))";
        $ja_foi_convidado = $this->mbc->executa_sql($sql);

        if ($ja_foi_convidado[0]) {
            return true;
        } else {
            return false;
        }
    }

    function insere_atualiza_desafio($dados) {
        if (is_object($dados)) {
            $array = object_to_array($dados);
        } else {
            $array = $dados;
        }


        if (isset($array['Id_int'])) {
            if ($array['Status_sel'] == 'negado') {
                return $this->mbc->db_delete("desafios", "Id_int", $array['Id_int']);
            }
            $array['Data_atualizacao_dat'] = date('Y-m-d H:i:s');
            return $this->mbc->updateTable('desafios', $array, 'Id_int', $array['Id_int'], TRUE);
        } else {
            $array['Data_dat'] = date('Y-m-d H:i:s');
            return $this->mbc->db_insert('desafios', $array, TRUE);
        }
    }

    function busca_usuario($id_usuario) {

        $usuario = $this->mbc->buscar_completo("users", "where Id_int=$id_usuario");
        if ($usuario[0]) {
            return $usuario[0];
        } else {
            return false;
        }
    }

    function busca_usuarios() {

        $usuarios = $this->mbc->buscar_completo("users");
        if ($usuarios[0]) {
            return $usuarios;
        } else {
            return false;
        }
    }

    function busca_usuarios_convite($id_rodada, $id_usuario) {
        $where = "";
        $where = "where Id_int!=$id_usuario order by Nome_txf";

        $usuarios = $this->mbc->buscar_completo("users", $where);
        $apostadores = $this->busca_apostadores($id_rodada);

        foreach ($usuarios as $key => $usuario) {
            $usuario->Convidado = FALSE;
            foreach ($apostadores as $apostador) {
                if ($apostador->Id_int == $usuario->Id_int) {
                    $usuario->Convidado = TRUE;
                    //   unset($usuarios[$key]);
                }
            }
        }
        if ($usuarios) {
            return $usuarios;
        } else {
            return false;
        }
    }

    function busca_apostadores($id_rodada) {
        $apostadores = $this->mbc->executa_sql("select p.Users_for, u.* from palpites p left outer join users u on u.Id_int=p.Users_for where Rodadas_for={$id_rodada} group by Users_for");
        if ($apostadores[0]) {
            $apostadores = $this->mbc->complementa_registros($apostadores, 'users');
            return $apostadores;
        } else {
            return FALSE;
        }
    }

    function busca_ultimos_pitacos($limite = null) {
        $wherelimite = "";
        if ($limite) {
            $wherelimite = " LIMIT $limite";
        }
        $sql = "select p.Users_for,p.Data_hora_dat, u.* from palpites p left outer join users u on u.Id_int=p.Users_for  group by Rodadas_for, Users_for order by p.Data_hora_dat desc $wherelimite";

        $apostadores = $this->mbc->executa_sql($sql);
        if ($apostadores[0]) {
            $apostadores = $this->mbc->complementa_registros($apostadores, 'users');
            return $apostadores;
        } else {
            return FALSE;
        }
    }

    function busca_id_rodada_encerrada() {

        $rodada_anterior = $this->mbc->buscar_tudo("rodadas", "where Status_sel='encerrada' and Visivel_sel='SIM'  order by Id_int desc");
        if ($rodada_anterior) {
            $id_rodada = $rodada_anterior[0]->Id_int;
            return $id_rodada;
        } else {
            return false;
        }
    }

    function busca_id_rodada_ativa() {
        $achou = 'NAO';
        $rodada_ativa = $this->mbc->buscar_tudo("rodadas", "where Status_sel='aberta' and Visivel_sel='SIM' and Data_fim_dat>=CURRENT_DATE() order by Id_int");
        if ($rodada_ativa[0]) {
            $achou = 'SIM';
        }

        if ($achou == 'NAO') {
            $rodada_ativa = $this->mbc->buscar_tudo("rodadas", "where Status_sel='aberta' and Visivel_sel='SIM' order by Id_int");
        }

        if ($rodada_ativa[0]->Id_int) {
            $id_rodada = $rodada_ativa[0]->Id_int;
            $tipo_rodada = 'aberta';
        } else {
            $rodada_anterior = $this->mbc->buscar_tudo("rodadas", "where Status_sel='encerrada' and Visivel_sel='SIM'  order by Id_int desc");
            $id_rodada = $rodada_anterior[0]->Id_int;
            $tipo_rodada = 'encerrada';
        }



        return $id_rodada;
    }

    function busca_rodada($id_rodada) {
        $where = "where Rodadas_for={$id_rodada}";
        $where_rodada = "where Id_int={$id_rodada}";
        $rodada = $this->mbc->buscar_tudo("rodadas", "$where_rodada");
        if ($rodada[0]) {
            $rodada[0]->Liberacao = verifica_liberacao($rodada[0]);
            return $rodada[0];
        } else {
            return false;
        }
    }

    function busca_rodadas() {

        $rodadas = $this->mbc->buscar_tudo("rodadas", "order by Id_int desc");

        foreach ($rodadas as $rod) {
            $rod->Liberacao = verifica_liberacao($rod);
        }

        return $rodadas;
    }

    function busca_rodadas_encerradas() {

        $rodadas = $this->mbc->buscar_tudo("rodadas", "where Status_sel='encerrada'  and Visivel_sel='SIM' order by Id_int desc");
        foreach ($rodadas as $rod) {
            $rod->Liberacao = verifica_liberacao($rod);
        }
        return $rodadas;
    }

    function busca_ranking($id_rodada) {
        $where_rodada = "where Id_int={$id_rodada}";
        $rodada = $this->mbc->buscar_completo("rodadas", "$where_rodada");


        $where = "where Rodadas_for={$id_rodada} ";
        $where.="group by Users_for order by Total desc, Ultimo_palpite_dat";
        $sql = "select *, Pontuacao_txf as Total from ranking $where";
        $ranking = $this->mbc->executa_sql($sql);


        $where = "where Rodadas_for={$id_rodada} ";
        $where.="group by Pontuacao_txf order by Pontuacao_txf desc limit 5";
        $sql = "select Pontuacao_txf from ranking $where";
        $melhores_ranking = $this->mbc->executa_sql($sql);




        foreach ($ranking as $rank) {
            $rank->Usuario = $this->mbc->buscar_completo("users", "where Id_Int={$rank->Users_for}");
            $temp = $this->mbc->executa_sql("select * from ranking_temporada where Users_for={$rank->Users_for} and Rodadas_for={$rank->Rodadas_for}");
            if ($temp[0]) {
                $rank->Temporada = $temp[0];
            }

            switch ($rank->Total) {
                case $melhores_ranking[0]->Pontuacao_txf:
                    $rank->Classe = "primeiro";
                    break;
                case $melhores_ranking[1]->Pontuacao_txf:
                    $rank->Classe = "segundo";
                    break;
                case $melhores_ranking[2]->Pontuacao_txf:
                    $rank->Classe = "terceiro";
                    break;
                case $melhores_ranking[3]->Pontuacao_txf:
                    $rank->Classe = "quarto";
                    break;
                case $melhores_ranking[4]->Pontuacao_txf:
                    $rank->Classe = "quinto";
                    break;
                default:
                    $rank->Classe = "";
                    break;
            }
        }

        return $ranking;
    }

    function busca_jogos_rodada($id_rodada) {

        $jogos_rodada = $this->mbc->executa_sql("select * from jogos where Rodadas_for=$id_rodada");

        foreach ($jogos_rodada as $jogo) {
            if ($jogo->Casa_gols_txf != '' && $jogo->Fora_gols_txf != '') {
                $jogo->Status = 'bloqueado';
            } else {
                $jogo->Status = 'liberado';
            }
            $jogo->Casa = $this->mbc->buscar_completo("times", "where Id_int={$jogo->Casa_sel}");
            $jogo->Fora = $this->mbc->buscar_completo("times", "where Id_int={$jogo->Fora_sel}");
        }

        return $jogos_rodada;
    }

    function busca_jogos_rodada_completo($id_rodada) {

        $where = "where Rodadas_for={$id_rodada}";
        $where_rodada = "where Id_int={$id_rodada}";
        $jogos_rodada = $this->mbc->buscar_tudo("jogos", "$where");
        if ($id_usuario) {
            $where_palpite = "where Users_for={$id_usuario}";
        }

        foreach ($jogos_rodada as $jogo) {
            if ($jogo->Casa_gols_txf != '' && $jogo->Fora_gols_txf != '') {
                $jogo->Status = 'bloqueado';
            } else {
                $jogo->Status = 'liberado';
            }
            $jogo->Casa = $this->mbc->buscar_completo("times", "where Id_int={$jogo->Casa_sel}");
            $jogo->Fora = $this->mbc->buscar_completo("times", "where Id_int={$jogo->Fora_sel}");
            if ($id_usuario) {
                $jogo->Palpite = $this->mbc->buscar_tudo("palpites", "$where_palpite and Jogos_for={$jogo->Id_int}");
            }
        }

        return $jogos_rodada;
    }

    function envia_email($email, $formulario = null, $copia_cliente = TRUE, $dados = null) {
        if (!isset($email['Nome_txf'])) {
            $email['Nome_txf'] = 'Email do Site ' . $this->app->Nome_app_txf;
        }
        if (!isset($email['Email_txf'])) {
            $email['Email_txf'] = 'contato@pitacosfc.com.br';
        }
        $email['Destinatario_txf'] = $email['Destinatario_txf'];
        $email['Assunto_txf'];
        if ($dados) {
            $this->smarty->assign('dados', $dados);
        }



        if (isset($formulario)) {
            if (!file_exists(COMMONPATH . "../templates/{$this->app->Template_txf}/email/{$formulario}.tpl")) {
                die('arquivo tpl do email nao existe');
            }
            $mensagem = $this->smarty->fetch(COMMONPATH . "../templates/{$this->app->Template_txf}/email/{$formulario}.tpl");

            //$mensagem = htmlspecialchars_decode($this->model_smarty->retorna_tpl('recuperacao_senha', $this->app->Template_txf));
            $email['Mensagem_txa'] = $mensagem;
        }

        $this->load->model('model_mail');
        $this->model_mail->inicializa($this->app, $this->cliente);
//             $enviou = $this->model_mail->envia_email($email, 'boolean');
        $enviou = $this->model_mail->envia_email_novo($email, $copia_cliente);

        return $enviou;
    }

}

