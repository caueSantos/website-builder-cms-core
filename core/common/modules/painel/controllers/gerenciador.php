<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once(COMMONPATH . 'core/lands_painel.php');

class gerenciador extends lands_painel {

    public $modulo = 'gerenciador';
    public $configuracoes;
    public $conexao_painel;
    public $menu_tabelas;
    public $conexao_cliente;

//    public $versao;

    function __construct() {
        parent::__construct();
        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);


        $this->abre_gerenciador();
    }

    function index() {


        $funcao = $this->pagina_atual;
        if ($this->uri->segment($this->app->Segmento_padrao_txf + 2)) {
            $funcao = ($this->uri->segment($this->app->Segmento_padrao_txf + 2));
        }
        if (!method_exists(__CLASS__, $funcao)) {

            $this->carrega_pagina($this->pagina_atual);
        } else {
//executa uma funcao que deve ser programa nesta classe.
            $this->$funcao();
        }
    }

    function conecta_ftp($dados) {

        $this->load->library('ftp');
        $config['hostname'] = $dados->Ftp_host_txf;
        $config['username'] = $dados->Ftp_usuario_txf;
        $config['password'] = $dados->Ftp_senha_txf;


        $config['debug'] = FALSE;
        return $this->ftp->connect($config);
    }

    function post() {


        if ($this->uri->segment(4)) {
            $segmento_post = $this->uri->segment(4);
        } else {
            die('tipo de post nao passado');
        }

        switch ($segmento_post) {

            case 'inserir_editar':
                $this->inserir_editar();
                break;
            case 'clonar':
//                $id_tabela = $_POST['idtabela'];
//                $id_registro = $_POST['id'];
//                $tabela = $_POST['tabela'];
//                $campo = $_POST['campo'];
//                $this->mt->atualiza_tabela('imagens');
//                $this->carrega_dados_imagem($id_tabela, $id_registro, $tabela, $campo);
//                $tpl = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, $this->modulo . '/tipos', 'img');
                echo "clonando registro {$_POST['Id_int']}";
                $dados = array_to_object($_POST);
                $this->conecta_model_tabela($this->configuracoes);
                $this->mt->inicializa($this->app, $this->cliente, $this->modulo, $this->configuracoes);
                $qtd = $_POST['Quantidade'];

                for ($i = 1; $i <= $qtd; $i++) {
                    if ($this->conecta_ftp($this->configuracoes)) {
                        //   echo "conectou";
                    } else {
                        die("erro ao conectar no ftp");
                    }

                    $salvou = $this->mt->clonar_registro($dados);
                }

                if (isset($_POST['Id_objeto_con']) && ($_POST['Tabela_con'])) {
                    $vin = new stdClass();
                    $vin->tipo = 'vin';
                    $vin->Id_objeto_con = $_POST['Id_objeto_con'];
                    $vin->Tabela_con = $_POST['Tabela_con'];
                    $this->smarty->assign("vin", $vin);
                }


                if ($salvou) {
                    $this->smarty->assign("mensagem", "salvou_ok");
                } else {
                    $this->smarty->assign("mensagem", "salvou_erro");
                }
                $this->model_smarty->render_ajax_modular('mensagens', $this->app->Template_txf, $this->modulo);

                die();


                break;
            case 'abre_imagens':
                $id_tabela = $_POST['idtabela'];
                $id_registro = $_POST['id'];
                $tabela = $_POST['tabela'];
                $campo = $_POST['campo'];

                $this->carrega_dados_imagem($id_tabela, $id_registro, $tabela, $campo);
                $tpl = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, $this->modulo . '/tipos', 'img');

                echo $tpl;
                die();


                break;
            case 'abre_videos':
                $id_tabela = $_POST['idtabela'];
                $id_registro = $_POST['id'];
                $tabela = $_POST['tabela'];
                $campo = $_POST['campo'];




                $this->carrega_dados_video($id_tabela, $id_registro, $tabela, $campo);
                $tpl = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, $this->modulo . '/tipos', 'vid');

                echo $tpl;
                die();
                break;
            case 'abre_arquivos':
                $id_tabela = $_POST['idtabela'];
                $id_registro = $_POST['id'];
                $tabela = $_POST['tabela'];
                $campo = $_POST['campo'];



                $this->carrega_dados_arquivo($id_tabela, $id_registro, $tabela, $campo);

                $tpl = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, $this->modulo . '/tipos', 'arq');

                echo $tpl;
                die();
                break;
            case 'file_upload':
                //Id_arquivo_con
                //Campo_sel
                //Tabela_con

                $tabela = $_POST['Tabela_con'];
                $id_objeto_con = $_POST['Id_arquivo_con'];
                $campo = $_POST['Campo_sel'];
                $ordem = $_POST['Ordem_int'];
                $this->conecta_model_tabela($this->configuracoes);
                $arquivos = $this->mt->envia_arquivo($_FILES, $tabela, $id_objeto_con, $ordem, $campo);

//                    $this->conecta_model_gerenciador($this->conexao_painel);
//                $config_tabela = $this->painel_model_gerenciador->busca_configuracoes_tabela($id_tabela);

                if ($this->conecta_ftp($this->configuracoes)) {
                    //   echo "conectou";
                } else {
                    die("erro ao conectar no ftp");
                }

//                $pasta = $this->db->database;
                $pasta_painel = $this->app->Pasta_painel;
//                $pasta = $tabela;
                $dir = FCPATH . $pasta_painel . '/';
                $dir = str_replace('//', '/', $dir);
                $dir_temp = $dir;
                $arq = $dir . $arquivos->Caminho_txf;

                if (file_exists($arq)) {
                    // echo "arquivo existe<br>";
                }




                $new_dir = $this->configuracoes->Ftp_caminho_txf;
                $new_dir.='/';
                $new_dir = str_replace('//', '/', $new_dir);
                $banco = $this->mt->db->database;
                $pasta_cliente = "$new_dir/arquivos/{$banco}/";
                $pasta_cliente = str_replace('//', '/', $pasta_cliente);

                $lista = $this->ftp->list_files($pasta_cliente);

                if (!isset($lista[0])) {
                    echo ('Criando pasta ' . $pasta_cliente . ' no cliente<br>');
//                    die("vai criar o subdiretorio {$pasta_cliente}");
                    $this->ftp->cria_subdiretorio('/', $pasta_cliente);
                }


                $arq2 = $new_dir . $arquivos->Caminho_txf;
                $this->ftp->upload($arq, $arq2, 'binary', 0775);
                unlink($arq);
                break;

            case 'image_upload':
                //Id_imagem_con
                //Campo_sel
                //Tabela_con

                $tabela = $_POST['Tabela_con'];
                $id_objeto_con = $_POST['Id_imagem_con'];
                $campo = $_POST['Campo_sel'];
                $ordem = $_POST['Ordem_int'];
                $this->conecta_model_tabela($this->configuracoes);
                $imagens = $this->mt->envia_imagem($_FILES, $tabela, $id_objeto_con, $ordem, $campo);

//                    $this->conecta_model_gerenciador($this->conexao_painel);
//                $config_tabela = $this->painel_model_gerenciador->busca_configuracoes_tabela($id_tabela);

                if ($this->conecta_ftp($this->configuracoes)) {
                    //   echo "conectou";
                } else {
                    die("erro ao conectar no ftp");
                }

//                $pasta = $this->db->database;
                $pasta_painel = $this->app->Pasta_painel;
//                $pasta = $tabela;
                $dir = FCPATH . $pasta_painel . '/';
                $dir = str_replace('//', '/', $dir);
                $dir_temp = $dir;
                $arq = $dir . $imagens->Caminho_txf;


                $new_dir = $this->configuracoes->Ftp_caminho_txf;
                $new_dir.='/';
                $new_dir = str_replace('//', '/', $new_dir);
                $arq2 = $new_dir . $imagens->Caminho_txf;
                $mensagem = '';
                $msg = '';
                $diretorio = $dir . 'img/' . $this->mt->db->database;
                if (file_exists($arq)) {
                    // echo "arquivo existe<br>";
                    if ($_POST['transparencia'] == 'false') {
                        $formato = 'jpg';
                    } else {
                        $formato = '';
                    }

                    if ($_POST['naocompactar'] == 'true') {
                        $compactar = FALSE;
                    } else {
                        $compactar = TRUE;
                    }

                    if ($compactar) {
                        $compactacao = null;
                        if ($_POST['compactacao']) {
                            $compactacao = $_POST['compactacao'];
                        }

                        $resultado1 = $this->mt->compacta_imagem($arq, $diretorio, $formato, $compactacao);

                        $resultado = array_to_object($resultado1);
                        if ($resultado->status == 'success') {
                            if ($resultado->data->original->size > $resultado->data->compressed->size) {

                                $imagem_original = $resultado->data->original->image;
                                $antes = formataBytes($resultado->data->original->size);
                                $depois = formataBytes($resultado->data->compressed->size);
                                $mensagem = "Compactou de {$antes} para {$depois}";
                                //echo $mensagem;
                                if (unlink($imagem_original)) {
                                    $arq = $resultado->data->compressed->image;
                                } else {
                                    $mensagem = "Erro ao excluir imagem original";
                                }
                            } else {
                                $mensagem = "Imagem compactada ficou maior que a original<br>";
                                $imagem_compactada = $resultado->data->compressed->image;
                                if (unlink($imagem_compactada)) {
                                    $mensagem.= "Excluiu imagem compactada";
                                } else {
                                    $mensagem = "Erro ao excluir imagem original";
                                }
                            }
                        } else {
                            $mensagem = "";
                            $res = json_encode($resultado);
                            echo "<script>console.log(JSON.stringify('{$res}'));</script>";
                        }
                    }
                    $this->ftp->upload($arq, $arq2, 'binary', 0775);
                    unlink($arq);
                    $msg = 'enviou_ok';
                } else {
                    $msg = 'enviou_erro';
                }
//                        $this->smarty->assign('resultado', $resultado);
                $this->smarty->assign('mensagem', $msg);
                $this->smarty->assign('msg', $mensagem);
                $this->model_smarty->render_ajax_modular('mensagens_compactacao', $this->app->Template_txf, $this->modulo);


                break;

            case 'envia_video':

                $tabela = $_POST['Tabela_con'];
                $id_objeto_con = $_POST['Id_video_con'];
                $campo = $_POST['Campo_sel'];
                $id_tabela = $_POST['id_tabela'];
                $id_registro = $_POST['id_registro'];
                $ordem = $_POST['Ordem_int'];
                $arquivo = $_POST;

                $this->conecta_model_tabela($this->configuracoes);
                $this->mt->inicializa($this->app, $this->cliente, $this->modulo, $this->configuracoes);
                $salvou = $this->mt->envia_video($arquivo, $id_registro, $ordem, $campo);

//                if ($salvou) {
//                    $this->smarty->assign("mensagem", "salvou_ok");
//                } else {
//                    $this->smarty->assign("mensagem", "salvou_erro");
//                }
//                $this->model_smarty->render_ajax_modular('mensagens', $this->app->Template_txf, $this->modulo);
//                $this->carrega_dados_video($id_tabela, $id_registro, $tabela, $campo);
//                $this->model_smarty->render_ajax_modular('videos', $this->app->Template_txf, $this->modulo);


                break;

            case 'atualiza_imagens':
                $tabela = $_POST['Tabela_con'];
                $id_objeto_con = $_POST['Id_imagem_con'];
                $campo = $_POST['Campo_sel'];
                $id_tabela = $_POST['id_tabela'];
                $id_registro = $_POST['id_registro'];
                $this->carrega_dados_imagem($id_tabela, $id_registro, $tabela, $campo);
                $this->model_smarty->render_ajax_modular('imagens', $this->app->Template_txf, $this->modulo);

                break;
            case 'atualiza_videos':
                $tabela = $_POST['Tabela_con'];
                $id_objeto_con = $_POST['Id_video_con'];
                $campo = $_POST['Campo_sel'];
                $id_tabela = $_POST['id_tabela'];
                $id_registro = $_POST['id_registro'];


                $this->carrega_dados_video($id_tabela, $id_registro, $tabela, $campo);

                $this->model_smarty->render_ajax_modular('videos', $this->app->Template_txf, $this->modulo);

                break;
            case 'atualiza_arquivos':

                $tabela = $_POST['Tabela_con'];
                $id_objeto_con = $_POST['Id_arquivo_con'];
                $campo = $_POST['Campo_sel'];
                $id_tabela = $_POST['id_tabela'];
                $id_registro = $_POST['id_registro'];
                $this->carrega_dados_arquivo($id_tabela, $id_registro, $tabela, $campo);
                $this->model_smarty->render_ajax_modular('arquivos', $this->app->Template_txf, $this->modulo);

                break;

            case 'ordena_imagens':
                $tabela = $_POST['Tabela_con'];
                $id_objeto_con = $_POST['Id_imagem_con'];
                $campo = $_POST['Campo_sel'];
                $ordenacao = $_POST['Ordenacao'];
                $this->conecta_model_tabela($this->configuracoes);
                $this->mt->ordena_imagens($tabela, $id_objeto_con, $ordenacao, $campo);
                $this->smarty->assign("mensagem", "salvou_ok");
                $this->model_smarty->render_ajax_modular('mensagens', $this->app->Template_txf, $this->modulo);
                break;
            case 'ordena_arquivos':
                $tabela = $_POST['Tabela_con'];
                $id_objeto_con = $_POST['Id_arquivo_con'];
                $campo = $_POST['Campo_sel'];
                $ordenacao = $_POST['Ordenacao'];
                $this->conecta_model_tabela($this->configuracoes);
                $this->mt->ordena_arquivos($tabela, $id_objeto_con, $ordenacao, $campo);
                $this->smarty->assign("mensagem", "salvou_ok");
                $this->model_smarty->render_ajax_modular('mensagens', $this->app->Template_txf, $this->modulo);
                break;
            case 'ordena_videos':
                $tabela = $_POST['Tabela_con'];
                $id_objeto_con = $_POST['Id_video_con'];
                $campo = $_POST['Campo_sel'];
                $ordenacao = $_POST['Ordenacao'];
                $this->conecta_model_tabela($this->configuracoes);
                $this->mt->ordena_videos($tabela, $id_objeto_con, $ordenacao, $campo);
                $this->smarty->assign("mensagem", "salvou_ok");
                $this->model_smarty->render_ajax_modular('mensagens', $this->app->Template_txf, $this->modulo);
                break;

            case 'exclui_imagens':
                $imagenspost = $_POST['imagens'];
                $this->exclui_imagens($imagenspost);
                $this->smarty->assign("mensagem", "salvou_ok");
                $this->model_smarty->render_ajax_modular('mensagens', $this->app->Template_txf, $this->modulo);

                break;
            case 'exclui_arquivos':
                $arquivos = $_POST['arquivos'];
                $this->exclui_arquivos($arquivos);
                $this->smarty->assign("mensagem", "salvou_ok");
                $this->model_smarty->render_ajax_modular('mensagens', $this->app->Template_txf, $this->modulo);

                break;

            case 'exclui_videos':

                $videos = $_POST['videos'];

                foreach ($videos as $reg) {
                    $this->mt->excluir_registro('videos', $reg);
                }

                break;



            case 'excluir_registros':

                //tabela
                //ids
                $tabela = $_POST['tabela'];
                $id_tabela = $_POST['id_tabela'];
                $id_modulo = $_POST['id_modulo'];
                $registros = $_POST['registros'];
                $this->conecta_model_gerenciador($this->conexao_painel);
                $config_tabela = $this->painel_model_gerenciador->busca_configuracoes_tabela($id_tabela);
//                $this->smarty->assign('config_tabela', $config_tabela);

                $this->conecta_model_tabela($this->configuracoes);

                /* APAGA AS IMAGENS DO REGISTRO */
                foreach ($registros as $registro) {
                    $imagens = $this->mt->busca_lista_imagens($tabela, $registro);
                    $array_img = array();
                    if ($imagens[0]) {
                        foreach ($imagens as $imagem) {
                            $array_img[] = $imagem->Id_int;
                        }
                        $this->exclui_imagens($array_img);
                    }
                }

                /* APAGA OS VINS DO REGISTRO */
                foreach ($registros as $registro) {
                    $campos_vins = $this->mt->busca_vins_cliente($tabela, $config_tabela, $registro);
                    
                    if (is_array($campos_vins)) {
                        foreach ($campos_vins as $campo_vin) {
                            $tabvin = $campo_vin->Tabela_vin;
                            $idvin = $registro;

                            $registros_vin = $this->mt->executa_sql("select * from $tabvin where Tabela_con='{$tabela}' and Id_objeto_con={$idvin}; ");
                           
                            if (is_array($registros_vin)) {
                                foreach ($registros_vin as $vin) {
                
                                    $this->mt->excluir_registro($tabvin, $vin->Id_int);
                                }
                            }

                            //
                        }
                    }
                }


                $excluiu = $this->mt->excluir_registros($tabela, $registros);

                if (isset($_POST['tabelavin']) && isset($_POST['idvin'])) {
                    $vin = new stdClass();
                    $vin->tipo = 'vin';
                    $vin->Id_objeto_con = $_POST['idvin'];
                    $vin->Tabela_con = $_POST['tabelavin'];

                    $this->smarty->assign("vin", $vin);
                }

                if ($excluiu) {
                    $this->smarty->assign("mensagem", "salvou_ok");
                } else {
                    $this->smarty->assign("mensagem", "salvou_erro");
                }
                $this->model_smarty->render_ajax_modular('mensagens', $this->app->Template_txf, $this->modulo);




                break;

            case 'abre_tabela':

                $vinculo = FALSE;
                $id_tabela = $_POST['id_tabela'];
                if ($_POST['tipo']) {
                    $tipo = 'vin';
                    $vinculo = new stdClass();
                    $vinculo->tipo = 'vin';
                } else {
                    $tipo = 'normal';
                }


                if (isset($_POST['idvin'])) {
                    $id_vin = $_POST['idvin'];
                    $this->smarty->assign("idvin", $id_vin);
                    $tipo = 'vin';
                    $vinculo->id_vin = $id_vin;
                }
                if (isset($_POST['tabelavin'])) {
                    $tabelavin = $_POST['tabelavin'];
                    $this->smarty->assign("tabelavin", $tabelavin);
                    $vinculo->tabelavin = $tabelavin;
                }


                $this->smarty->assign("tipo", $tipo);
                $this->abre_tabela($id_tabela, FALSE, $vinculo);



                $itens = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, $this->modulo . '/blocos', 'corpo_tabela');
                echo $itens;
                die();

                break;


            case 'inserir_registro':

                $tabela = $_POST['nome_tabela'];
                $acao = 'update';
                $this->smarty->assign('acao', $acao);
                $id_tabela = $_POST['id_tabela'];
                $this->conecta_model_gerenciador($this->conexao_painel);
                $config_tabela = $this->painel_model_gerenciador->busca_configuracoes_tabela($id_tabela);
                $this->smarty->assign('config_tabela', $config_tabela);
                $this->conecta_model_tabela($this->configuracoes);
                $this->mt->inicializa($this->app, $this->cliente, $this->modulo, $this->configuracoes);
                $dados = $_POST;
                
                $salvou = $this->mt->salva_novo_registro($tabela, $dados);
$evento=new stdClass();
$evento->acao='editar';
$evento->id=$salvou->Id_int;
$evento->tabela=$tabela;
$evento->titulo="Editar $tabela";
$this->smarty->assign('evento',$evento);

                if (isset($_POST['Id_objeto_con']) && ($_POST['Tabela_con'])) {
                    $vin = new stdClass();
                    $vin->tipo = 'vin';
                    $vin->Id_objeto_con = $_POST['Id_objeto_con'];
                    $vin->Tabela_con = $_POST['Tabela_con'];

                    $this->smarty->assign("vin", $vin);
                }

                if ($salvou) {
                    $this->smarty->assign("mensagem", "salvou_ok");
                } else {
                    $this->smarty->assign("mensagem", "salvou_erro");
                }
                $this->model_smarty->render_ajax_modular('mensagens', $this->app->Template_txf, $this->modulo);
//                $id = $registro->Id_int;
//
//                $lista_campos = $this->mt->monta_formulario($tabela, $config_tabela, $id);
//                $this->smarty->assign("lista_campos", $lista_campos);
//
//                $lista_imagens = $this->mt->busca_imagens($tabela, $config_tabela, $id);
//                $this->smarty->assign("lista_imagens", $lista_imagens);
//
//                $this->model_smarty->render_ajax_modular('formulario', $this->app->Template_txf, $this->modulo);
                die();
                break;
            case 'salvar':
                $dados = $_POST;

                $tipo_banco = $dados['type'];
                $tabela = $dados['tabela'];
                $campo = $dados['campo'];
                $valor = $dados['valor'];
                $id = $dados['id'];
                $this->conecta_model_tabela($this->configuracoes);
                $this->mt->inicializa($this->app, $this->cliente, $this->modulo, $this->configuracoes);
                $salvou = $this->mt->salvar_registro($tabela, $campo, $valor, $id, $tipo_banco);

                if (isset($_POST['tabelavin']) && isset($_POST['idvin'])) {
                    $vin = new stdClass();
                    $vin->tipo = 'vin';
                    $vin->Id_objeto_con = $_POST['idvin'];
                    $vin->Tabela_con = $_POST['tabelavin'];

                    $this->smarty->assign("vin", $vin);
                }

                if ($salvou) {
                    $this->smarty->assign("mensagem", "salvou_ok");
                } else {
                    $this->smarty->assign("mensagem", "salvou_erro");
                }
                $this->model_smarty->render_ajax_modular('mensagens', $this->app->Template_txf, $this->modulo);
                break;
            case 'salvar_select':
                $dados = $_POST;
                $this->conecta_model_tabela($this->configuracoes);
                $this->mt->inicializa($this->app, $this->cliente, $this->modulo, $this->configuracoes);

                $salvou = $this->mt->salvar_registro_completo('selects_checkboxes', $dados);
                if ($salvou) {
                    $this->smarty->assign("mensagem", "salvou_ok");
                } else {
                    $this->smarty->assign("mensagem", "salvou_erro");
                }
                $this->model_smarty->render_ajax_modular('mensagens', $this->app->Template_txf, $this->modulo);
                break;
            case 'excluir_select':

                $dados = $_POST;
                $this->conecta_model_tabela($this->configuracoes);
                $this->mt->inicializa($this->app, $this->cliente, $this->modulo, $this->configuracoes);

                $salvou = $this->mt->excluir_selects($dados);
                if ($salvou) {
                    $this->smarty->assign("mensagem", "salvou_ok");
                } else {
                    $this->smarty->assign("mensagem", "salvou_erro");
                }
                $this->model_smarty->render_ajax_modular('mensagens', $this->app->Template_txf, $this->modulo);
                break;
            case 'busca_select':
                $dados = $_POST;
                $this->conecta_model_tabela($this->configuracoes);
                $this->mt->inicializa($this->app, $this->cliente, $this->modulo, $this->configuracoes);


                $id_modal = "modal-{$dados['Campo_tabela_sel']}-remover";
                $this->smarty->assign('id_modal', $id_modal);

///fecha_modal('#modal-{$campo->Field}-remover')

                $opcoes = $this->mt->busca_selects($dados);
                $this->smarty->assign('opcoes', $opcoes);

                $this->model_smarty->render_ajax_modular('exclui_select', $this->app->Template_txf, $this->modulo);
                break;
            case 'abre_tabela_ajax':
                $vinculo = null;
                $id_tabela = $this->uri->segment(5);
                if ($this->uri->segment(6) && $this->uri->segment(7)) {
                    $tabelavin = $this->uri->segment(6);
                    $id_vin = $this->uri->segment(7);
                    $vinculo = new stdClass();
                    $vinculo->tipo = 'vin';
                    $vinculo->tabelavin = $tabelavin;
                    $vinculo->id_vin = $id_vin;
                }

                $this->abre_tabela($id_tabela, 'ajax', $vinculo);

                break;
            default:
                die('tipo de post invalido');
                break;
        }
    }

    function inserir_editar() {

        //pega os principais dados do post
        $tabela = $_POST['tabela'];
        $id = $_POST['Id_int'];
        $id_tabela = $_POST['id_tabela'];
        $id_modulo = $_POST['id_modulo'];
        $this->smarty->assign('id_registro', $id);

        // se vier com o Id int é porque está atualizando..
        if ($_POST['Id_int']) {
            $acao = 'update';
        } else {
            $acao = 'insert';
        }
        $this->smarty->assign('acao', $acao);

        //define se esta editando a tabela principal ou  um campo VIN
        if (isset($_POST['tipo'])) {
            $tipo = 'vin';
        } else {
            $tipo = 'normal';
        }
        $this->smarty->assign("tipo", $tipo);

        //se for vin, da uma assign no id
        if (isset($_POST['idvin'])) {
            $id_vin = $_POST['idvin'];
            $this->smarty->assign("idvin", $id_vin);
            $tipo = 'vin';
        }
        //grada o nomoe databela vind se vier no post
        if (isset($_POST['tabelavin'])) {
            $tabelavin = $_POST['tabelavin'];
            $this->smarty->assign("tabelavin", $tabelavin);
        }

        //busca as configuracoes da tabela a ser aberta
        $this->conecta_model_gerenciador($this->conexao_painel);
        $config_tabela = $this->painel_model_gerenciador->busca_configuracoes_tabela($id_tabela);
        $this->smarty->assign('config_tabela', $config_tabela);
        $this->smarty->assign('tabela', $config_tabela);

        //conecta na base do cliente
        $this->conecta_model_tabela($this->configuracoes);
        $this->mt->inicializa($this->app, $this->cliente, $this->modulo, $this->configuracoes);

        //busca a lista de campos para montar o form de edição
        $lista_campos = $this->mt->monta_formulario($tabela, $config_tabela, $id);
        $this->smarty->assign("lista_campos", $lista_campos);

        //busca os campos imagem para montar a aba
        $campos_imagem = $this->mt->busca_campos_imagem($tabela, $config_tabela);
        $this->smarty->assign("campos_imagem", $campos_imagem);

        //busca os campos arquivos para montar a aba
        $campos_arquivo = $this->mt->busca_campos_arquivo($tabela, $config_tabela);
        $this->smarty->assign("campos_arquivo", $campos_arquivo);


        //busca os campos video para montar a aba
        $campos_video = $this->mt->busca_campos_video($tabela, $config_tabela);
        $this->smarty->assign("campos_video", $campos_video);


        //busca a lista de campos vin
        $lista_vins = $this->mt->busca_vins_cliente($tabela, $config_tabela, $id);

        //conecta novamente na base do painel, e para cada campo vin, busca o id da configuração da tabela
        $this->conecta_model_gerenciador($this->conexao_painel);
        foreach ($lista_vins as $vin) {
            $id_tabela_vin = $this->painel_model_gerenciador->busca_id_tabela($vin->Tabela_vin, $id_modulo);
            if ($id_tabela_vin) {
                $vin->Id_tabela = $id_tabela_vin;
            } else {
                echo "Criando configurações para a tabela '$vin->Tabela_vin'";
                $this->load->model('painel_model_migracao');

                $dados = new stdClass();
                $dados->Modulos_gc_for = $id_modulo;
                $dados->Sessao_sel = 'default';
                $dados->Tabela_txf = $vin->Tabela_vin;
                $dados->Limite_txf = '';
                $dados->Nivel_sel = 3;

                $dados->Label_txf = $vin->Tabela_vin;


                $this->painel_model_migracao->insere_atualiza_config($dados);
                $this->inserir_editar();
            }
        }
        $this->smarty->assign("lista_vins", $lista_vins);

        //renderiza o bloco de edição de registro
        $this->model_smarty->render_ajax_modular('inserir_editar', $this->app->Template_txf, $this->modulo);
    }

    function exclui_imagens($imagenspost) {
        $this->conecta_ftp($this->configuracoes);
        $this->conecta_model_tabela($this->configuracoes);
        $imagens = array();
        foreach ($imagenspost as $imagem) {
            $img = $this->mt->executa_sql("select * from imagens where Id_int={$imagem}");
            if ($img[0]) {
                $imagens[] = $img[0];
            }
        }

        foreach ($imagens as $imagem) {
            $new_dir = $this->configuracoes->Ftp_caminho_txf;
            $new_dir.='/';
            $new_dir = str_replace('//', '/', $new_dir);
            $arq2 = $new_dir . $imagem->Caminho_txf;

            $this->ftp->delete_file($arq2);
            $this->mt->excluir_registro('imagens', $imagem->Id_int);
        }
    }

    function exclui_arquivos($arquivospost) {
        $this->conecta_ftp($this->configuracoes);

        $arquivos = array();
        $this->conecta_model_tabela($this->configuracoes);
        foreach ($arquivospost as $arquivo) {
            $arq = $this->mt->executa_sql("select * from arquivos where Id_int={$arquivo}");
            if ($arq[0]) {
                $arquivos[] = $arq[0];
            }
        }



        foreach ($arquivos as $arquivo) {
            $new_dir = $this->configuracoes->Ftp_caminho_txf;
            $new_dir.='/';
            $new_dir = str_replace('//', '/', $new_dir);
            $arq2 = $new_dir . $arquivo->Caminho_txf;

            $this->ftp->delete_file($arq2);
            $this->mt->excluir_registro('arquivos', $arquivo->Id_int);
        }
    }

    function carrega_dados_imagem($id_tabela, $id_registro, $tabela, $campo) {
        $this->conecta_model_gerenciador($this->conexao_painel);
        $config_tabela = $this->painel_model_gerenciador->busca_configuracoes_tabela($id_tabela);
        $this->smarty->assign('config_tabela', $config_tabela);

        $this->conecta_model_tabela($this->configuracoes);
        $this->mt->atualiza_tabela('imagens');
        $this->smarty->assign('id_registro', $id_registro);
        $lista_imagens = $this->mt->busca_imagens($tabela, $config_tabela, $id_registro, $campo);
        return $lista_imagens;
    }

    function carrega_dados_video($id_tabela, $id_registro, $tabela, $campo) {
        $this->conecta_model_gerenciador($this->conexao_painel);
        $config_tabela = $this->painel_model_gerenciador->busca_configuracoes_tabela($id_tabela);
        $this->smarty->assign('config_tabela', $config_tabela);

        $this->conecta_model_tabela($this->configuracoes);

        $this->mt->atualiza_tabela('videos');
        $this->smarty->assign('id_registro', $id_registro);
        $lista_videos = $this->mt->busca_videos($tabela, $config_tabela, $id_registro, $campo);

        return $lista_videos;
    }

    function carrega_dados_arquivo($id_tabela, $id_registro, $tabela, $campo) {
        $this->conecta_model_gerenciador($this->conexao_painel);
        $config_tabela = $this->painel_model_gerenciador->busca_configuracoes_tabela($id_tabela);
        $this->smarty->assign('config_tabela', $config_tabela);




        $this->conecta_model_tabela($this->configuracoes);
        $this->mt->atualiza_tabela('arquivos');
        $this->smarty->assign('id_registro', $id_registro);
        $lista_arquivos = $this->mt->busca_arquivos($tabela, $config_tabela, $id_registro, $campo);
        return $lista_arquivos;
    }

    function abre_gerenciador() {
        $this->conecta_mbc($this->app->Conexoes_for);
//            $dominio = $this->cliente_logado->Dominio_txf;
        if ($this->uri->segment(2)) {
            $this->id_modulo = $this->uri->segment(2);
            $this->load->model('painel_model_gerenciador');
            $configuracoes = $this->painel_model_gerenciador->busca_configuracoes($this->id_modulo);

//        $configuracoes = 
            if ($configuracoes) {
                $this->configuracoes = $configuracoes;
                $this->smarty->assign('configuracoes', $this->configuracoes);
                $this->load->model('painel_model_gerenciador');
                $this->painel_model_gerenciador->inicializa($this->app, $this->cliente, $this->configuracoes);
                $this->smarty->assign('id_modulo', $this->id_modulo);

                $this->verifica_seguranca_modulo();
            } else {
                
            }


            $this->conecta_model_tabela($this->configuracoes);
            $this->conexao_cliente = $this->config_conexao($this->configuracoes);
            $this->conexao_painel = $this->dados_conexao;
            $this->painel_model_gerenciador->troca_conexao($this->conexao_painel);
            $this->monta_menu_tabelas();
        } else {

            $this->load->model('painel_model_gerenciador');
//                        
            $modulos_gc = $this->painel_model_gerenciador->busca_modulos($this->usuario);
            $this->smarty->assign('modulos_gc', $modulos_gc);
        }
    }

    function verifica_seguranca_modulo() {
        if ($this->configuracoes->Usuarios_for != $this->usuario->Id_int && $this->usuario->Tipo != 'admin') {
            die('acesso invalido ao modulo');
        }

        if ($this->painel_model_gerenciador->versao != 'nova') {
            echo ('este módulo ainda nao possui configuracoes no novo painel, você poderá realizar a conversão do seu painel para a nova versão em breve');
            die();
        }
    }

    function monta_menu_tabelas() {
        $menu = $this->painel_model_gerenciador->busca_sessoes_menu();


        $this->conecta_model_tabela($this->configuracoes);


        $menu_tabelas = $this->mt->valida_tabelas($menu);

        $this->smarty->assign("menu_tabelas", $menu_tabelas);
    }

    function abre_tabela($id_tabela, $tipo = FALSE, $vinculo = FALSE) {

        $this->smarty->assign('id_tabela', $id_tabela);
        $this->conecta_model_gerenciador($this->conexao_painel);
        $config_tabela = $this->painel_model_gerenciador->busca_configuracoes_tabela($id_tabela);
        $this->smarty->assign('tabela', $config_tabela);
        $this->conecta_model_tabela($this->configuracoes);
        $this->mt->atualiza_tabela('imagens');

        $this->mt->abre_tabela($config_tabela, $vinculo);
        if ($tipo == 'ajax') {
            $this->model_smarty->render_ajax_modular('tabela', $this->app->Template_txf, $this->modulo);
        }
    }

    function switch_pagina() {
        $this->smarty->assign('titulo_pagina', ucfirst($this->pagina_atual));
        switch ($this->pagina_atual) {
            case 'tabela':
                $id_tabela = $this->uri->segment(4);


                $this->abre_tabela($id_tabela);
                break;



            default:
                break;
        }
    }

}

