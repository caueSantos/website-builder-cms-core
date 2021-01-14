<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_bolao.php');

class bolao extends lands_bolao {

    public function __construct() {
        parent::__construct();
//        $this->load->helper('tradutor');
        $this->load->model('model_bolao');
        $this->model_bolao->inicializa($this->app, $this->cliente);
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

    function atualiza_avatars() {
        $usuarios = $this->mbc->executa_sql("select * from users where Facebook_id_txf!='' ");
        foreach ($usuarios as $usuario) {
            $usuario->Foto_txf = "http://graph.facebook.com/{$usuario->Facebook_id_txf}/picture";
            $array['Foto_txf'] = $usuario->Foto_txf;
            echo "Atualizou foto de {$usuario->Nome_txf} <br>";
            $this->mbc->updateTable("users", $array, "Id_int", $usuario->Id_int);
        }



//    ver($usuarios);
    }

    function carrega_obrigatorios() {

        if (isset($this->session->userdata['usuario'])) {
            $usuario = $this->session->userdata['usuario'];
//            $usuario_novo = $this->mbc->executa_sql("select * from users where Id_int={$usuario->Id_int}");
            $usuario_novo = $this->mbc->buscar_completo("users", "where Id_int={$usuario->Id_int}");
            if ($usuario_novo[0]->Id_int) {

                $usuario = $usuario_novo[0];
                $this->usuario = $usuario;
            } else {
                $this->usuario = $this->session->userdata['usuario'];
            }


            $this->smarty->assign('usuario', $this->usuario);
        }

        $this->smarty->assign("requisicao", $_REQUEST);


        $this->carrega_anuncios();

        $emails = $this->mbc->buscar_completo('departamentos', "where Ativo_sel='SIM'");
        $this->smarty->assign('emails', $emails);
    }

    function carrega_anuncios() {



        $where = "where Ativo_sel='SIM' and Data_inicio_dat<=CURRENT_DATE()  and Data_fim_dat >= CURRENT_DATE()";
        $anuncios1 = $this->mbc->buscar_completo('anuncios', $where . " and Posicao_sel='1' limit 1");
        $this->smarty->assign('anuncios1', $anuncios1);
        $anuncios2 = $this->mbc->buscar_completo('anuncios', $where . " and Posicao_sel='2' limit 1");
        $this->smarty->assign('anuncios2', $anuncios2);
//        ver($anuncios2);
        $anuncios3 = $this->mbc->buscar_completo('anuncios', $where . " and Posicao_sel='3' limit 1");
        $this->smarty->assign('anuncios3', $anuncios3);
        $anuncios4 = $this->mbc->buscar_completo('anuncios', $where . " and Posicao_sel='4' limit 1");
        $this->smarty->assign('anuncios4', $anuncios4);
        $anuncios5 = $this->mbc->buscar_completo('anuncios', $where . " and Posicao_sel='5' limit 1");
        $this->smarty->assign('anuncios5', $anuncios5);
        $anuncios6 = $this->mbc->buscar_completo('anuncios', $where . " and Posicao_sel='6' limit 1");
        $this->smarty->assign('anuncios6', $anuncios6);
        $this->model_smarty->carrega_bloco('anuncios_direita', 'anuncios_direita', $this->app->Template_txf);



//
//            $anuncios_baixo1 = $this->mbc->buscar_completo('anuncios', $where . " and Posicao_sel='baixo1' order by RAND();");
//            $this->smarty->assign('anuncios_baixo1', $anuncios_baixo1);
//            $anuncios_baixo2 = $this->mbc->buscar_completo('anuncios', $where . " and Posicao_sel='baixo2' order by RAND();");
//            $this->smarty->assign('anuncios_baixo2', $anuncios_baixo2);
//            $anuncios_baixo3 = $this->mbc->buscar_completo('anuncios', $where . " and Posicao_sel='baixo3' order by RAND();");
//            $this->smarty->assign('anuncios_baixo3', $anuncios_baixo3);
//
//            $this->model_smarty->carrega_bloco('anuncios_baixo', 'anuncios_baixo', $this->app->Template_txf);


        $where = "where Tipo_sel='direita' and Ativo_sel='SIM' and Data_inicio_dat<=CURRENT_DATE()  and Data_fim_dat >= CURRENT_DATE()";
        $anuncios_mobile = $this->mbc->buscar_completo('anuncios', $where . "  order by RAND();");

        $this->smarty->assign('anuncios_mobile', $anuncios_mobile);
        $this->model_smarty->carrega_bloco('anuncios_mobile', 'anuncios_mobile', $this->app->Template_txf);
    }

    function checa_leitura_regulamento() {

        if ($this->pagina_atual != 'aceitar_regulamento') {
            if ($this->usuario) {

                if ($this->usuario->Leu_regulamento_sel == 'NAO') {
                    redirect("aceitar_regulamento/{$this->pagina_atual}");
                }
            }
        }
    }

    function busca_rodada_ativa() {
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

        $this->smarty->assign('rodada_ativa', $rodada_ativa);

        return $id_rodada;
    }

    function switch_pagina() {
        $this->conecta_mbc($this->app->Conexoes_for);
        $this->carrega_obrigatorios();
        $this->checa_leitura_regulamento();

        if ($this->pagina_atual != 'bloqueado') {
            if ($this->usuario) {
                $this->checa_bloqueio($this->usuario);
            }
        }

        if ($this->usuario->Id_int) {
            $notificacoes = $this->model_bolao->busca_notificacoes();
            $this->smarty->assign('notificacoes', $notificacoes);

            $cont_desafios = conta($notificacoes->Desafios, 'Desafiado_for', $this->usuario->Id_int);
            $this->total_desafios = $cont_desafios;
            $this->smarty->assign('total_desafios', $cont_desafios);
        }


        switch ($this->pagina_atual) {

            case 'inicio' :
                if (isset($this->session->userdata['aposta'])) {
                    $aposta_sessao = $this->session->userdata['aposta'];
                    $this->smarty->assign('aposta_sessao', $aposta_sessao);
                }
                $id_rodada = $this->busca_rodada_ativa();
                if ($id_rodada) {


                    if ($this->usuario) {
                        $this->buscar_rodada($id_rodada, $this->usuario->Id_int);
                    } else {
                        $this->buscar_rodada($id_rodada);
                    }
                }

                $outras_rodadas = $this->model_bolao->busca_rodadas_encerradas();
                //ver('chegou');
                if ($outras_rodadas) {
                    $ultimo_ranking = $this->buscar_ranking($outras_rodadas[0]->Id_int);
                    $nome_ultima = $outras_rodadas[0]->Nome_txf;
                    $this->smarty->assign('nome_ultima', $nome_ultima);
//                ver($ultimo_ranking);
                    $this->smarty->assign('outras_rodadas', $outras_rodadas);
                }


                break;

            case 'meus_desafios':
                if ($this->total_desafios != 0 && !$_REQUEST['mensagem']) {
                    $this->smarty->assign('mensagem', "Você possui desafios pendentes");
                }

                $todas_rodadas = $this->model_bolao->busca_rodadas();
                $meus_desafios = $this->model_bolao->busca_desafios_usuario($this->usuario->Id_int);
                foreach ($todas_rodadas as $rodada) {
                    foreach ($meus_desafios as $desafio) {
                        if ($desafio->Rodadas_for == $rodada->Id_int) {
                            $rodada->Desafios[] = $desafio;
                        }
                    }

                    $rodada->Jogos = $this->model_bolao->busca_jogos_rodada($rodada->Id_int);
                }
//                ver($todas_rodadas);

                $this->smarty->assign('todas_rodadas', $todas_rodadas);
                $this->smarty->assign('meus_desafios', $meus_desafios);

                $meus_desafios_pendentes = $this->model_bolao->busca_solicitacoes_desafios_usuario($this->usuario->Id_int);
                $this->smarty->assign('meus_desafios_pendentes', $meus_desafios_pendentes);
                break;
            case 'desafios':
                $this->checa_login('desafios');
                if ($this->total_desafios != 0) {
                    redireciona($this->app->Url_cliente . 'meus_desafios');
                }
                $todas_rodadas = $this->model_bolao->busca_rodadas_visiveis();
                if ($todas_rodadas) {
                    $this->smarty->assign('todas_rodadas', $todas_rodadas);
                    if ($this->uri->segment(2)) {
                        $id_rodada = $this->uri->segment(2);
                    } else {
                        $id_rodada = $todas_rodadas[0]->Id_int;
                    }
                    $desafios = $this->model_bolao->busca_desafios($id_rodada);
                    $this->smarty->assign('desafios', $desafios);

                    $rodada = $this->model_bolao->busca_rodada($id_rodada);
                    $this->smarty->assign('rodada', $rodada);

                    $ja_apostou = $this->model_bolao->ja_apostou($id_rodada, $this->usuario->Id_int);
                    $this->smarty->assign('ja_apostou', $ja_apostou);
                    if ($rodada->Liberacao == 'ok' && $rodada->Status_sel == 'aberta' && $ja_apostou) {

                        if ($this->usuario) {
                            if (!$this->model_bolao->esta_desafiando($id_rodada, $this->usuario->Id_int)) {

                                $lista_possiveis = $this->model_bolao->busca_apostadores_desafio($id_rodada, $this->usuario->Id_int);
                                foreach ($lista_possiveis as $possivel) {
                                    if ($this->model_bolao->ja_foi_convidado($id_rodada, $possivel->Id_int)) {
                                        $possivel->Convidado = TRUE;
                                    } else {
                                        $possivel->Convidado = FALSE;
                                    }
                                }

                                $this->smarty->assign('lista_possiveis', $lista_possiveis);
                            } else {

                                $this->smarty->assign('desafiando', 'Você já está participando de um desafio nesta rodada');
                            }
                        }
                    }


                    $jogos_rodada = $this->model_bolao->busca_jogos_rodada_completo($id_rodada);

                    $this->smarty->assign('jogos_rodada', $jogos_rodada);
                }
                break;
            case 'convites':
                $this->checa_login('convites');
                $todas_rodadas = $this->model_bolao->busca_rodadas();
                $this->smarty->assign('todas_rodadas', $todas_rodadas);
                if ($this->uri->segment(2)) {
                    $id_rodada = $this->uri->segment(2);
                } else {
                    $id_rodada = $todas_rodadas[0]->Id_int;
                }


                $rodada = $this->model_bolao->busca_rodada($id_rodada);
                $this->smarty->assign('rodada', $rodada);

                if ($rodada->Liberacao == 'ok' && $rodada->Status_sel == 'aberta') {
                    $lista_possiveis = $this->model_bolao->busca_usuarios_convite($id_rodada, $this->usuario->Id_int);
                    $this->smarty->assign('lista_possiveis', $lista_possiveis);
                }


                $jogos_rodada = $this->model_bolao->busca_jogos_rodada_completo($id_rodada);

                $this->smarty->assign('jogos_rodada', $jogos_rodada);
                break;
            case 'desafio':

                if ($this->uri->segment(2)) {
                    $id_desafio = $this->uri->segment(2);
                } else {
                    $id_desafio = $todas_rodadas[0]->Id_int;
                }
                $desafio = $this->model_bolao->busca_desafio($id_desafio);
                $this->smarty->assign('desafio', $desafio);
                $id_rodada = $desafio->Rodadas_for;
                if ($this->usuario) {
                    $this->buscar_rodada($id_rodada, $this->usuario->Id_int);
                } else {
                    $this->buscar_rodada($id_rodada);
                }
                break;

            case 'desafios_usuario':
                if ($this->uri->segment(2)) {
                    $id_usuario = $this->uri->segment(2);
                } else {
                    $id_usuario = $this->usuario->Id_int;
                }
                $usuario_desafio = $this->model_bolao->busca_usuario($id_usuario);
                $this->smarty->assign('usuario_desafio', $usuario_desafio);


                $todas_rodadas = $this->model_bolao->busca_rodadas();
                $meus_desafios = $this->model_bolao->busca_desafios_usuario($id_usuario);
                $pontuacao = 0;
                foreach ($todas_rodadas as $rodada) {
                    foreach ($meus_desafios as $desafio) {
                        if ($desafio->Rodadas_for == $rodada->Id_int) {
                            $rodada->Desafios[] = $desafio;

                            if ($desafio->Id_vencedor_for == $id_usuario) {
                                $pontuacao = $pontuacao + 1;
                            }
                        }
                    }

                    $rodada->Jogos = $this->model_bolao->busca_jogos_rodada($rodada->Id_int);
                }
//                ver($meus_desafios);


                $this->smarty->assign('pontuacao', $pontuacao);
                $this->smarty->assign('todas_rodadas', $todas_rodadas);
                $this->smarty->assign('meus_desafios', $meus_desafios);

                break;
            case 'responder_desafio':
                if ($this->uri->segment(2)) {
                    $id_desafio = $this->uri->segment(2);
                } else {
                    $id_desafio = $todas_rodadas[0]->Id_int;
                }
            

                $desafio = $this->model_bolao->busca_desafio($id_desafio);

                $this->smarty->assign('desafio', $desafio);
                if ($desafio) {

                    $rodada = $this->model_bolao->busca_rodada($desafio->Rodadas_for);
                    $this->smarty->assign('rodada', $rodada);
                }



                break;
            case 'premios' :
                $id_rodada = $this->busca_rodada_ativa();
                if ($id_rodada) {
                    $rodada = $this->mbc->buscar_completo('rodadas', "where Id_int={$id_rodada}");
                    $this->smarty->assign("rodada_atual", $rodada);

                    $mes = date('m');
                    $mes_atual = $this->mbc->buscar_completo('meses', "where Numero_txf={$mes}");
                    $this->smarty->assign("mes_atual", $mes_atual);

                    $temporada = date('Y');
                    $temporada_atual = $this->mbc->buscar_completo('temporadas', "where Ano_txf='{$temporada}'");
                    $this->smarty->assign("temporada_atual", $temporada_atual);
                }
                break;

            case 'meu-perfil' :

                $times = $this->mbc->buscar_completo("times", " order by Nome_txf");
                $this->smarty->assign('times', $times);

                if (!$this->usuario) {
                    redirect('login');
                }
                $base = $this->app->Url_cliente . $this->pagina_atual;
                $config = new stdClass();
                $config->base_url = $base;
                $config->per_page = 2;
                $config->uri_segment = 2;
                $where = "where Status_sel='encerrada' order by Id_int desc";
                $todas_rodadas = $this->mbc->super_paginacao('rodadas', $where, $config);
//                ver($todas_rodadas);
//                $todas_rodadas = $this->mbc->buscar_completo("rodadas", "where Status_sel='encerrada' order by Id_int desc");
                $this->smarty->assign('todas_rodadas', $todas_rodadas);



                foreach ($todas_rodadas->registros as $rodada) {

                    $palpites = $this->mbc->executa_sql("select * from palpites where Users_for={$this->usuario->Id_int} and Rodadas_for={$rodada->Id_int}");
                    $this->buscar_rodada($rodada->Id_int, $this->usuario->Id_int);
                    $bloco = new stdClass();
                    $bloco->Nome_txf = $rodada->Nome_txf;
                    $bloco->Usuario = $this->usuario->Id_int;
                    if ($palpites[0]) {
                        $bloco->Html_txf = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, 'blocos', 'rodada_dev');
//} else {
//    $bloco->Html_txf = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, 'blocos', 'rodada');
//}
                    } else {
                        $bloco->Html_txf = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, 'blocos', 'rodada_nao_jogada');
                    }
                    $blocos[] = $bloco;
                }
                $this->smarty->assign('blocos', $blocos);
                break;

            case 'perfil' :


                $base = $this->app->Url_cliente . $this->pagina_atual . '/' . $this->uri->segment(2);
                $config = new stdClass();
                $config->base_url = $base;
                $config->per_page = 2;
                $config->uri_segment = 3;
                $where = "where Status_sel='encerrada' and Visivel_sel='SIM' order by Id_int desc";
                $todas_rodadas = $this->mbc->super_paginacao('rodadas', $where, $config);


//                $todas_rodadas = $this->mbc->buscar_completo("rodadas", "where Status_sel='encerrada' order by Id_int desc");
                $this->smarty->assign('todas_rodadas', $todas_rodadas);


                if ($this->uri->segment(2)) {
                    $id_usuario = $this->uri->segment(2);
                } else {
                    if ($this->usuario) {
                        $id_usuario = $this->usuario->Id_int;
                    } else {
                        die('acesso invalido');
                    }
                }
                $usuario_selecionado = $this->mbc->buscar_completo("users", "where Id_int={$id_usuario}");

                if ($usuario_selecionado[0]) {
                    $this->smarty->assign('usuario_selecionado', $usuario_selecionado[0]);
                } else {
                    die('usuario inexistente');
                }


                foreach ($todas_rodadas->registros as $rodada) {
                    $palpites = $this->mbc->executa_sql("select * from palpites where Users_for={$id_usuario} and Rodadas_for={$rodada->Id_int}");
                    $this->buscar_rodada($rodada->Id_int, $id_usuario);


                    $bloco = new stdClass();
                    $bloco->Nome_txf = $rodada->Nome_txf;
                    $bloco->Usuario = $id_usuario;
                    if ($palpites[0]) {

//if (is_lands()) {
                        $bloco->Html_txf = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, 'blocos', 'rodada_dev');
//} else {
//    $bloco->Html_txf = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, 'blocos', 'rodada');
//}
                    } else {
                        $bloco->Html_txf = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, 'blocos', 'rodada_nao_jogada');
                    }
                    $blocos[] = $bloco;
                }
                $this->smarty->assign('blocos', $blocos);


                break;
            case 'rodadas' :


                $todas_rodadas = $this->mbc->buscar_completo("rodadas", "where Id_int is not null and Visivel_sel='SIM' order by Id_int desc");
                $this->smarty->assign('todas_rodadas', $todas_rodadas);

                if ($this->uri->segment(2)) {
                    $id_rodada = $this->uri->segment(2);
                } else {
                    $id_rodada = $todas_rodadas[0]->Id_int;
                }
                if ($id_rodada) {
                    if ($this->usuario) {
                        $this->buscar_rodada($id_rodada, $this->usuario->Id_int);
                    } else {
                        $this->buscar_rodada($id_rodada);
                    }
                }
                break;

            case 'rodadas_overview' :


                $todas_rodadas = $this->mbc->buscar_completo("rodadas", "where Id_int is not null and Visivel_sel='SIM' order by Id_int desc");
                $this->smarty->assign('todas_rodadas', $todas_rodadas);

                if ($this->uri->segment(2)) {
                    $id_rodada = $this->uri->segment(2);
                } else {
                    $id_rodada = $todas_rodadas[0]->Id_int;
                }
                if ($id_rodada) {
                    if ($this->usuario) {
                        $this->buscar_rodada_overview($id_rodada, $this->usuario->Id_int);
                    } else {
                        $this->buscar_rodada_overview($id_rodada);
                    }
                }
                break;


            case 'cadastro':
                $times = $this->mbc->buscar_completo("times", " order by Nome_txf");
                $this->smarty->assign('times', $times);
                break;
            case 'ranking' :
                $todas_rodadas = $this->mbc->buscar_tudo("rodadas", "where Status_sel='encerrada' and Visivel_sel='SIM' and Id_int is not null order by Id_int desc");
                if ($todas_rodadas[0]) {
                    $this->smarty->assign('todas_rodadas', $todas_rodadas);
                    if ($this->uri->segment(2)) {
                        $id_rodada = $this->uri->segment(2);
                    } else {
                        $id_rodada = $todas_rodadas[0]->Id_int;
                    }

                    $this->buscar_ranking($id_rodada);
                }
                break;

            case 'apostadores' :
                $todas_rodadas = $this->mbc->buscar_tudo("rodadas", "where Id_int is not null order by Id_int desc");
                if ($todas_rodadas[0]) {
                    $this->smarty->assign('todas_rodadas', $todas_rodadas);
                    if ($this->uri->segment(2)) {
                        $id_rodada = $this->uri->segment(2);
                    } else {

                        $id_rodada = $todas_rodadas[0]->Id_int;
                    }

                    $rodada = $this->mbc->buscar_tudo("rodadas", "where Id_int={$id_rodada}");
                    $this->smarty->assign('rodada', $rodada);

                    $sql = "select p.Users_for, p.Data_hora_dat, u.* from palpites p left outer join users u on u.Id_int=p.Users_for where Rodadas_for={$id_rodada} group by Users_for order by Nome_txf";

                    $apostadores = $this->mbc->executa_sql($sql);
                    if ($apostadores[0]) {
                        $this->smarty->assign('apostadores', $apostadores);
                    }



                    $this->model_smarty->carrega_bloco('apostadores', 'apostadores', $this->app->Template_txf);
                }
                break;
            case 'ranking_mensal' :
                $todos_meses = $this->mbc->buscar_tudo("ranking", "group by Mes_txf, Ano_txf order by Ano_txf desc, Mes_txf desc");
                if ($todos_meses[0]) {
                    $this->smarty->assign('todos_meses', $todos_meses);

                    if ($this->uri->segment(2)) {
                        $ano = $this->uri->segment(2);
                    } else {
                        $ano = $todos_meses[0]->Ano_txf;
                    }
                    $ano = urldecode($ano);
                    if ($this->uri->segment(3)) {
                        $mes = $this->uri->segment(3);
                    } else {
                        $mes = $todos_meses[0]->Mes_txf;
                    }
                    $this->buscar_ranking_mensal($ano, $mes);
                }
                break;

            case 'ranking_desafios' :

                $todos_meses = $this->mbc->buscar_tudo("ranking_desafios", "group by Mes_txf, Ano_txf order by Ano_txf desc, Mes_txf desc");
                if ($todos_meses[0]) {
                    $this->smarty->assign('todos_meses', $todos_meses);

                    if ($this->uri->segment(2)) {
                        $ano = $this->uri->segment(2);
                    } else {
                        $ano = $todos_meses[0]->Ano_txf;
                    }
                    if ($this->uri->segment(3)) {
                        $mes = $this->uri->segment(3);
                    } else {
                        $mes = $todos_meses[0]->Mes_txf;
                    }
                    $this->buscar_ranking_desafios($ano, $mes);
                }
                break;


            case 'ranking_temporada' :
                $todos_anos = $this->mbc->buscar_tudo("ranking_temporada", "group by Ano_txf order by Ano_txf desc");
                if ($todos_anos[0]) {
                    $this->smarty->assign('todos_anos', $todos_anos);

                    if ($this->uri->segment(2)) {
                        $ano = $this->uri->segment(2);
                    } else {
                        $ano = $todos_anos[0]->Ano_txf;
                    }

                    $ano = urldecode($ano);
//                    ver($ano);
                    $this->buscar_ranking_temporada($ano);
                }
                break;
        }
    }

    function buscar_rodada_overview($id_rodada, $id_usuario = null) {

        $where = "where Rodadas_for={$id_rodada}";
        $where_rodada = "where Id_int={$id_rodada}";
        $rodada = $this->mbc->buscar_tudo("rodadas", "$where_rodada");
        $rodada[0]->Liberacao = verifica_liberacao($rodada[0]);


        $apostadores = $this->mbc->executa_sql("select p.Users_for, u.* from palpites p left outer join users u on u.Id_int=p.Users_for where Rodadas_for={$rodada[0]->Id_int} group by Users_for");
        if ($apostadores) {
            $this->smarty->assign('apostadores', $apostadores);
        }

        $this->rodada = $rodada;
        $this->smarty->assign('rodada', $rodada);

        $titulo_ranking = "Ranking da " . $rodada[0]->Nome_txf;
        $this->smarty->assign('titulo_ranking', $titulo_ranking);

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
//            if($jogo->Status=='bloqueado'){
            $jogo->Apostas = $this->model_bolao->busca_apostas_jogo($jogo->Id_int);
//            }
        }
//        ver($jogos_rodada);
        $this->smarty->assign('jogos_rodada', $jogos_rodada);
//  if (is_lands()) {
        $this->model_smarty->carrega_bloco('rodada', 'rodada_overview', $this->app->Template_txf);
//} else {
//    $this->model_smarty->carrega_bloco('rodada', 'rodada', $this->app->Template_txf);
//}

        $this->model_smarty->carrega_bloco('resultados_rodada', 'resultados_rodada', $this->app->Template_txf);
    }

    function buscar_rodada($id_rodada, $id_usuario = null) {

        $where = "where Rodadas_for={$id_rodada}";
        $where_rodada = "where Id_int={$id_rodada}";
        $rodada = $this->mbc->buscar_tudo("rodadas", "$where_rodada");
        $rodada[0]->Liberacao = verifica_liberacao($rodada[0]);


        $apostadores = $this->mbc->executa_sql("select p.Users_for, u.* from palpites p left outer join users u on u.Id_int=p.Users_for where Rodadas_for={$rodada[0]->Id_int} group by Users_for");
        if ($apostadores) {
            $this->smarty->assign('apostadores', $apostadores);
        }

        $this->rodada = $rodada;
        $this->smarty->assign('rodada', $rodada);

        $titulo_ranking = "Ranking da " . $rodada[0]->Nome_txf;
        $this->smarty->assign('titulo_ranking', $titulo_ranking);

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
        $this->smarty->assign('jogos_rodada', $jogos_rodada);
//  if (is_lands()) {
        $this->model_smarty->carrega_bloco('rodada', 'rodada_dev', $this->app->Template_txf);
//} else {
//    $this->model_smarty->carrega_bloco('rodada', 'rodada', $this->app->Template_txf);
//}

        $this->model_smarty->carrega_bloco('resultados_rodada', 'resultados_rodada', $this->app->Template_txf);
    }

    function enviar() {

        if ($this->session->userdata['usuario']) {
            $this->usuario = $this->session->userdata['usuario'];
        }
//          ver($this->session->all_userdata());
//          if (isset($this->session->userdata['aposta'])) {
//              
//          }
        $segmento = (int) $this->app->Segmento_padrao_txf;
        $segmento = $segmento + 1;
        if ($this->uri->segment($segmento)) {
            $segmento_post = $this->uri->segment($segmento);
        } else {
            $segmento_post = $this->uri->segment($this->app->Segmento_padrao_txf);
        }
        switch ($segmento_post) {
            case 'palpites':

                if (!$_POST['Users_for']) {
                    $this->session->set_userdata('aposta', $_POST);
                    redireciona($this->app->Url_cliente . "login");
                } else {
                    if (isset($this->session->userdata['aposta'])) {
                        $this->session->unset_userdata('aposta');
                    }
                    $palpites = $_POST['palpites'];
                    $id_usuario = $_POST['Users_for'];
                    $id_rodada = $_POST['Rodadas_for'];

                    foreach ($palpites as $key => $value) {
                        $ja_palpitou = $this->mbc->executa_sql("select * from palpites where Users_for=$id_usuario and Jogos_for=$key and Rodadas_for=$id_rodada");
                        if (!$ja_palpitou[0]) {
                            $palpite = new stdClass();
                            $palpite->Jogos_for = $key;
                            $palpite->Coluna_txf = $value;
                            $palpite->Users_for = $id_usuario;
                            $palpite->Rodadas_for = $id_rodada;
                            $palpite->Data_hora_dat = retorna_date_time();
                            $palpites_inserir = object_to_array($palpite);
                            $this->mbc->db_insert("palpites", $palpites_inserir);
                        }
                    }
                    redireciona($this->app->Url_cliente . "rodadas/" . $id_rodada . "?mensagem=palpite_enviado");
                }

                break;
            case 'envia_desafio':

//ver($_POST);
                $where = "where Rodadas_for={$_POST['Rodadas_for']} and Desafiante_for={$_POST['Desafiante_for']} and Desafiado_for={$_POST['Desafiado_for']}";
                $sql = "select * from desafios $where";
//                ver($sql,1);
                $desafio_existente = $this->mbc->executa_sql($sql);

                if ($desafio_existente[0]) {
                    $this->smarty->assign('mensagem', 'salvo_erro');
                    $this->model_smarty->render_ajax('mensagens_novas', $this->app->Template_txf);
                    die();
                }

                /* VERIFICA DESAFIO NA RODADA ANTERIOR */
                $desafio_rodada_anterior = $this->model_bolao->busca_desafio_rodada_anterior($_POST['Rodadas_for'], $_POST['Desafiante_for'], $_POST['Desafiado_for']);
                if ($desafio_rodada_anterior[0]) {
                    $this->smarty->assign('mensagem', 'desafio_anterior');
                    $this->model_smarty->render_ajax('mensagens_novas', $this->app->Template_txf);
                    die();
                }


//              
                $desafio = $this->model_bolao->insere_atualiza_desafio($_POST);

                if ($desafio) {

                    $desafio->Desafiante = $this->model_bolao->busca_usuario($desafio->Desafiante_for);
                    $desafio->Desafiado = $this->model_bolao->busca_usuario($desafio->Desafiado_for);
                    $this->smarty->assign("desafio", $desafio);
                    if ($this->model_bolao->envia_email($_POST, 'desafio', TRUE, $desafio)) {
                        $this->smarty->assign('mensagem', 'desafio_ok');
                        $this->smarty->assign('redirect', "desafios/{$_POST['Rodadas_for']}");
                        $this->model_smarty->render_ajax('mensagens_novas', $this->app->Template_txf);
                    } else {
                        $this->smarty->assign('mensagem', 'email_erro');
                        $this->model_smarty->render_ajax('mensagens_novas', $this->app->Template_txf);
                    }
                } else {
                    $this->smarty->assign('mensagem', 'salvo_erro');
                    $this->model_smarty->render_ajax('mensagens_novas', $this->app->Template_txf);
                }


                break;
            case 'envia_convites':



                $rodada = $this->model_bolao->busca_rodada($_POST['Rodadas_for']);
                $this->smarty->assign('rodada', $rodada);

                $usuario = $this->model_bolao->busca_usuario($_POST['Users_for']);
                $this->smarty->assign('usuario', $usuario);
                $cont = 0;
                $dados = new StdClass();
                $dados->Remetente = $usuario;
                $dados->Rodada = $rodada;
                $email['Assunto_txf'] = $_POST['Assunto_txf'];
                if ($_POST['convidados']) {
                    $email['Nome_txf'] = $usuario->Nome_txf;
                    $email['Email_txf'] = $usuario->Email_txf;
                    $convites = $_POST['convidados'];

                    foreach ($convites as $convite) {
                        $destinatario = $this->model_bolao->busca_usuario($convite);
                        $dados->Destinatario = $destinatario;
                        $email['Destinatario_txf'] = $destinatario->Email_txf;
                        $enviou = $this->model_bolao->envia_email($email, 'convite', TRUE, $dados);
                        if ($enviou) {
                            $cont = $cont + 1;
                        }
                    }
                } else {
                    $total = 1;
                    $email['Nome_txf'] = $usuario->Nome_txf;
                    $email['Email_txf'] = $usuario->Email_txf;
                    $email['Destinatario_txf'] = $_POST['Destinatario_txf'];
                    $convites = $_POST['convidados'];
                    $destinatario = new stdClass();
                    $destinatario->Nome_txf = $_POST['Nome_txf'];
                    $destinatario->Email_txf = $_POST['Destinatario_txf'];
                    $email['Destinatario_txf'] = $destinatario->Email_txf;
                    $dados->Destinatario = $destinatario;
                    $enviou = $this->model_bolao->envia_email($email, 'convite', TRUE, $dados);
                    if ($enviou) {
                        $cont = $cont + 1;
                    }
                }

                $total = count($convites);
                $mensagem = "Convite enviado";

                $this->smarty->assign('icone', 'danger');
                $this->smarty->assign('tipo', 'success');
                $this->smarty->assign('texto', $mensagem);
                $this->smarty->assign('mensagem', 'custom');
                $this->smarty->assign('redirect', "rodadas/{$rodada->Id_int}");
                $this->model_smarty->render_ajax('mensagens_novas', $this->app->Template_txf);

                break;


            case 'responder_desafio':

                if (!$_POST['Id_int']) {
                    die('erro, id do desafio nao foi passado');
                }

//                ver($_POST);
//busca_solicitacoes_pendentes

                $verifica_responder = $this->model_bolao->verifica_responder($_POST);
                if ($verifica_responder->status == 'error') {
                    $this->smarty->assign('icone', 'danger');
                    $this->smarty->assign('tipo', 'error');
                    $this->smarty->assign('texto', $verifica_responder->message);
                    $this->smarty->assign('mensagem', 'custom');
                    $this->model_smarty->render_ajax('mensagens_novas', $this->app->Template_txf);
                    die();
                }



                $verifica = $this->model_bolao->verifica_inserir($_POST);
                if ($verifica->status == 'success') {
                    if ($this->model_bolao->insere_atualiza_desafio($_POST)) {
                        $this->smarty->assign('mensagem', 'salvo_ok');
//                        $this->smarty->assign('redirect', "desafios/{$_POST['Rodadas_for']}");
                        $this->smarty->assign('redirect', "meus_desafios?mensagem=nao");
                        $this->model_smarty->render_ajax('mensagens_novas', $this->app->Template_txf);
                    } else {
                        $this->smarty->assign('mensagem', 'salvo_erro');
                        $this->model_smarty->render_ajax('mensagens_novas', $this->app->Template_txf);
                    }
                } else {

                    $this->smarty->assign('icone', 'danger');
                    $this->smarty->assign('tipo', 'error');
                    $this->smarty->assign('texto', $verifica->message);
                    $this->smarty->assign('mensagem', 'custom');
                    $this->model_smarty->render_ajax('mensagens_novas', $this->app->Template_txf);
                }



                die();
                break;
            case 'filtro_desafio':
                $filtro = $_POST['Id_int'];
                redireciona($this->app->Url_cliente . "desafios/" . $filtro);
                break;
            case 'filtro_convites':
                $filtro = $_POST['Id_int'];
                redireciona($this->app->Url_cliente . "convites/" . $filtro);
                break;
            case 'filtro_rodadas':
                $id = $_POST['Id_int'];
                redireciona($this->app->Url_cliente . "rodadas/" . $id);
                break;
            case 'filtro_rodadas_overview':
                $id = $_POST['Id_int'];
                redireciona($this->app->Url_cliente . "rodadas_overview/" . $id);
                break;
            case 'filtro_ranking':
                $id = $_POST['Id_int'];
                redireciona($this->app->Url_cliente . "ranking/" . $id);
                break;
            case 'filtro_ranking_mensal':
                $filtro = $_POST['Id_int'];
                redireciona($this->app->Url_cliente . "ranking_mensal/" . $filtro);
                break;
            case 'filtro_ranking_desafios':
                $filtro = $_POST['Id_int'];
                redireciona($this->app->Url_cliente . "ranking_desafios/" . $filtro);
                break;

            case 'filtro_ranking_temporada':
                $filtro = $_POST['Id_int'];
                redireciona($this->app->Url_cliente . "ranking_temporada/" . $filtro);
                break;
            case 'filtro_apostadores':
                $id = $_POST['Id_int'];
                redireciona($this->app->Url_cliente . "apostadores/" . $id);
                break;
            case 'regulamento':
                $redirect = $_POST['Redirect_link'];
                $this->smarty->assign('redirect', $redirect);
                $objeto_update = $_POST;
                $this->mbc->updateTable('users', $objeto_update, 'Id_int', $objeto_update['Id_int']);

                $usuario = $this->mbc->executa_sql("select * from users where Id_int={$_POST['Id_int']}");
                $this->session->set_userdata('usuario', $usuario[0]);

                $objeto_update['Users_for'] = $_POST['Id_int'];
                unset($objeto_update['Id_int']);

                $this->mbc->db_insert("users_regulamento", $objeto_update);
                $email = $_POST;
                if (!isset($email['Assunto_txf'])) {
                    $email['Assunto_txf'] = 'Aceite de Regulamento ' . $this->app->Nome_app_txf;
                }
                $this->smarty->assign('post', $_POST);
                if ($this->envia_email($email, 'regulamento')) {
                    $this->smarty->assign('mensagem', 'regulamento_inserido');
                    $this->model_smarty->render_ajax('mensagens_cadastro', $this->app->Template_txf);
                } else {
                    $this->smarty->assign('mensagem', 'regulamento_erro');
                    $this->model_smarty->render_ajax('mensagens_cadastro', $this->app->Template_txf);
                }




                break;

            case 'minha_conta':

                $id = $_POST['Id_int'];


//VERIFICA SE FOI POSTADO ARQUIVOS NO POST
                if (isset($_FILES)) {


                    if ($_FILES['Imagem_ico']['name']) {

                        if (isset($_POST['pasta'])) {
                            $pasta_painel = $_POST['pasta'];
                        } else {
                            $pasta_painel = $this->app->Pasta_painel;
                        }



                        $name = $_FILES['Imagem_ico']['name']; //Atribui uma array com os nomes dos arquivos à variável
                        $tmp_name = $_FILES['Imagem_ico']['tmp_name']; //Atribui uma array com os nomes temporários dos arquivos à variável
                        $extensoes = explode(',', $_REQUEST['Extensoes_txf']);


                        if ($name) {

                            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

                            if (analisa_tipos($ext, $extensoes)) {
                                $new_name = 'users_' . date("YmdHis") . '.' . $ext;
                                $pasta = $this->mbc->db->database;
                                $dir = FCPATH . $pasta_painel . '/img/' . $pasta . '/';
                                $dir = str_replace('//', '/', $dir);
                                $arquivo = $dir . $new_name;

                                $caminho_relativo = 'img/' . $pasta . '/' . $new_name;
                                $caminho_relativo = str_replace('//', '/', $caminho_relativo);


                                move_uploaded_file($tmp_name, $arquivo);
                                if (file_exists($arquivo)) {

                                    $imagem = $imagem_existe = $this->mbc->executa_sql("select * from imagens where tabela_con='users' and Id_imagem_con={$_POST['Id_int']}");
                                    if ($imagem[0]) {

                                        $this->mbc->db_delete('imagens', 'Id_int', $imagem[0]->Id_int);
                                        unlink(FCPATH . $pasta_painel . $imagem[0]->Caminho_txf);
                                    }


                                    $arquivo_inserir['Tabela_con'] = 'users';
                                    $arquivo_inserir['Campo_sel'] = 'Imagem_ico';
                                    $arquivo_inserir['Caminho_txf'] = $caminho_relativo;
                                    $arquivo_inserir['Tipo_txf'] = $ext;
                                    $arquivo_inserir['Nome_txf'] = $name;
                                    $arquivo['Nome_txf'] = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($name));
                                    $arquivo_inserir['Data_int'] = time();


                                    $arquivo_inserir['Id_imagem_con'] = $_POST['Id_int'];
                                    $this->mbc->db_insert('imagens', $arquivo_inserir);
                                }
                            } else {
                                die('tipo de arquivo inválido inválido');
                                return false;
                            }
                        }
                    }
                }

                if ($this->mbc->updateTable('users', $_POST, 'Id_int', $id)) {
                    $this->smarty->assign('mensagem', 'atualizacao_ok');
                    $this->model_smarty->render_ajax('mensagens_cadastro', $this->app->Template_txf);
                    die();
                } else {
                    $this->smarty->assign('mensagem', 'atualizacao_erro');
                    $this->model_smarty->render_ajax('mensagens_cadastro', $this->app->Template_txf);
                    die();
                }


                break;
            case 'cadastro':

                if (!isset($_POST['Email_txf'])) {
                    die('campo email nao foi enviado');
                }
                $tabela = 'users';

//verifica se existe algum registro com o e-mail associado
                $email = $_POST['Email_txf'];
                $sql = "select * from $tabela where Email_txf = '$email'";
                $email_bd = $this->mbc->executa_sql($sql);
//ver($x);
                if (isset($email_bd[0]->Id_int)) {
                    $this->smarty->assign('mensagem', 'email_ja_existe');
                    $this->model_smarty->render_ajax('mensagens_cadastro', $this->app->Template_txf);
                    die();
                }

//insere registro
                if ($this->mbc->db_insert($tabela, $_POST)) {
                    $email = $_POST;
                    if (!isset($email['Assunto_txf'])) {
                        $email['Assunto_txf'] = 'Cadastro no Site ' . $this->app->Nome_app_txf;
                    }
                    $this->smarty->assign('cadastro', $_POST);
                    if ($this->envia_email($email, 'cadastro')) {

                        $this->smarty->assign('mensagem', 'cadastro_inserido');
                        $this->model_smarty->render_ajax('mensagens_cadastro', $this->app->Template_txf);
                    } else {

                        $this->smarty->assign('mensagem', 'cadastro_erro');
                        $this->model_smarty->render_ajax('mensagens_cadastro', $this->app->Template_txf);
                    }
                    die();
                } else {
                    ver("nao inseriu");
                    $this->smarty->assign('mensagem', 'cadastro_erro');
                    $this->model_smarty->render_ajax('mensagens_cadastro', $this->app->Template_txf);
                    die();
                }

                break;
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
        $this->model_smarty->carrega_bloco('ranking', 'ranking', $this->app->Template_txf);
    }

    function buscar_ranking_desafios($ano, $mes = null) {
        $where .= "where Ano_txf='{$ano}' ";
        if ($mes) {
            $where .= "and Mes_txf={$mes} ";
        }
//, Ultimo_palpite_dat
        $where.="group by Users_for order by Total desc, Ultimo_palpite_dat ";
        $this->smarty->assign('mes_ranking', $mes);
        $this->smarty->assign('ano_ranking', $ano);
        $nome_mes = retorna_nome_mes($mes);
        $titulo_ranking = "Ranking - " . $nome_mes . " de $ano";
        $this->smarty->assign('titulo_ranking', $titulo_ranking);

        $sql = "select Id_int, Users_for, Rodadas_for, SUM(Pontuacao_desafio_txf) as Total, MAX(Ultimo_palpite_dat) as Ultimo_palpite_dat from ranking_desafios $where";

        $ranking = $this->mbc->executa_sql($sql);
        foreach ($ranking as $rank) {
            $rank->Usuario = $this->mbc->buscar_completo("users", "where Id_Int={$rank->Users_for}");
        }


        $this->smarty->assign('ranking', $ranking);
        $this->model_smarty->carrega_bloco('ranking', 'ranking', $this->app->Template_txf);
    }

    function buscar_ranking_mensal($ano, $mes = null) {
        $where = "where Ano_txf='{$ano}' ";
        $where .= "and Mes_txf={$mes} ";
//, Ultimo_palpite_dat
        $where.="group by Users_for order by Total desc, Ultimo_palpite_dat ";
        $this->smarty->assign('mes_ranking', $mes);
        $this->smarty->assign('ano_ranking', $ano);
        $nome_mes = retorna_nome_mes($mes);
        $titulo_ranking = "Ranking - " . $nome_mes . " de $ano";
        $this->smarty->assign('titulo_ranking', $titulo_ranking);
        $sql = "select Id_int, Users_for, Rodadas_for, SUM(Pontuacao_txf) as Total, MAX(Ultimo_palpite_dat) as Ultimo_palpite_dat from ranking $where";

        $ranking = $this->mbc->executa_sql($sql);
        foreach ($ranking as $rank) {
            $rank->Usuario = $this->mbc->buscar_completo("users", "where Id_Int={$rank->Users_for}");
        }


        $this->smarty->assign('ranking', $ranking);
        $this->model_smarty->carrega_bloco('ranking', 'ranking', $this->app->Template_txf);
    }

    function buscar_ranking($id_rodada) {
        $where_rodada = "where Id_int={$id_rodada}";
        $rodada = $this->mbc->buscar_completo("rodadas", "$where_rodada");
        $this->smarty->assign('rodada', $rodada);

        $titulo_ranking = "Ranking - {$rodada[0]->Nome_txf}";
        $this->smarty->assign('titulo_ranking', $titulo_ranking);

        $where = "where Rodadas_for={$id_rodada} ";
        $where.="group by Users_for order by Total desc, Ultimo_palpite_dat";
        $sql = "select *, Pontuacao_txf as Total from ranking $where";
        $ranking = $this->mbc->executa_sql($sql);

//             $where = "where Rodadas_for={$id_rodada} ";
//        $where.="group by Users_for order by Pontuacao_txf desc, Ultimo_palpite_dat";
//        $sql = "select * from ranking $where";
//        $ranking = $this->mbc->executa_sql($sql);   


        $where = "where Rodadas_for={$id_rodada} ";
        $where.="group by Pontuacao_txf order by Pontuacao_txf desc limit 5";
        $sql = "select Pontuacao_txf from ranking $where";
        $melhores_ranking = $this->mbc->executa_sql($sql);
        $this->smarty->assign($melhores_ranking);



        foreach ($ranking as $rank) {
            $rank->Usuario = $this->mbc->buscar_completo("users", "where Id_Int={$rank->Users_for}");
            $temp = $this->mbc->executa_sql("select * from ranking_temporada where Users_for={$rank->Users_for} and Rodadas_for={$rank->Rodadas_for}");
            if ($temp[0]) {
                $rank->Temporada = $temp[0];
            }
//            switch ($rank->Temporada->Pontuacao_txf) {
//                case 5:
//                    $rank->Classe = "primeiro";
//                    break;
//                case 4:
//                    $rank->Classe = "segundo";
//                    break;
//                case 3:
//                    $rank->Classe = "terceiro";
//                    break;
//                case 2:
//                    $rank->Classe = "quarto";
//                    break;
//                case 1:
//                    $rank->Classe = "quinto";
//                    break;
//
//                default:
//                    $rank->Classe = "";
//                    break;
//            }
//ver($rank);
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

        $this->smarty->assign('ranking', $ranking);
        $this->model_smarty->carrega_bloco('ranking', 'ranking', $this->app->Template_txf);
        return $ranking;
    }

}

?>