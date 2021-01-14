<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class whmcs extends lands_core {

    public $projetos;
    public $clientes;
    public $usuarios;
    public $tarefas;
    public $tickets;

    public function __construct() {
        $this->load->library('session');
        parent::__construct();

        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);
        $this->checa_login($this->pagina_atual);
        $this->usuario = $this->session->userdata['usuario'];
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

        $this->conecta_mbc($this->app->Conexoes_for);
        $this->carrega_defaults();


        switch ($this->pagina_atual) {


            case 'agenda':


                if ($this->usuario->Nivel_sel < 4) {
                    redireciona($this->app->Url_cliente . 'eventools');
                }

//cria variaveis para os botoes
                $this->busca_usuarios();
                $tck = $this->busca_tickets_novo(FALSE);

                $this->smarty->assign('tck', $tck);

                $this->busca_clientes_projetos();
                if ((!$_POST['tarefas'] && !$_POST['tickets']) || ($_POST['tarefas'] && $_POST['tickets'])) {
                    $this->busca_tarefas();
                    $this->busca_tickets_novo();
                } else {
                    if ($_POST['tarefas']) {
                        $this->busca_tarefas();
                    }
                    if ($_POST['tickets']) {
                        $this->busca_tickets_novo();
                    }
                }

                $this->totalizadores();
                $this->model_smarty->carrega_bloco('filtros_agenda', 'filtros_agenda', $this->app->Template_txf);
                $this->model_smarty->carrega_bloco('agenda', 'agenda', $this->app->Template_txf);
                break;
            case 'overview':


                if ($this->usuario->Nivel_sel < 4) {
                    redireciona($this->app->Url_cliente . 'eventools');
                }

//cria variaveis para os botoes
                $usuarios = $this->busca_usuarios();


                $tck = $this->busca_tickets_novo();
                foreach ($usuarios as $usuario) {
                    $usuario->tickets = $this->busca_tickets_usuario($usuario->id);
                    if($usuario->tickets){
                        $usuarios_com_tickets[]=$usuario;
                    }
                }
                

                $tickets_avulsos = $this->busca_tickets_usuario();

              
//                ver($tickets_avulsos);
//                ver($usuarios);
//
//                ver($tck);


                $this->smarty->assign('lista_usuarios', $usuarios_com_tickets);
                $this->smarty->assign('tickets_avulsos', $tickets_avulsos);

//                $this->busca_clientes_projetos();
//                if ((!$_POST['tarefas'] && !$_POST['tickets']) || ($_POST['tarefas'] && $_POST['tickets'])) {
//                    $this->busca_tarefas();
//                    $this->busca_tickets_novo();
//                } else {
//                    if ($_POST['tarefas']) {
//                        $this->busca_tarefas();
//                    }
//                    if ($_POST['tickets']) {
//                        $this->busca_tickets_novo();
//                    }
//                }
//
//                $this->totalizadores();
//                $this->model_smarty->carrega_bloco('filtros_agenda', 'filtros_agenda', $this->app->Template_txf);
//                $this->model_smarty->carrega_bloco('agenda', 'agenda', $this->app->Template_txf);
                break;

            case 'eventools':

                $this->busca_usuarios('eventools');
                $this->busca_tarefas('eventools', $this->id_projeto_eventools);
                $this->totalizadores();
                $this->model_smarty->carrega_bloco('agenda', 'agenda', $this->app->Template_txf);
                break;
            case 'financeiro':

                $this->busca_remessas();




                break;



            case 'altera_data':

                $id = $_POST['id'];
                $dias = $_POST['dias'];
                if ($_POST['tipo'] == 'tarefa') {
                    $acao = $this->mbc->executa_sql("select action_id,date_start, date_finish from tbladdon_wbteampro_action where action_id=$id");
                    $acao[0]->date_finish = varia_data($dias, $acao[0]->date_finish, "Y-m-d");
                    $acao[0] = object_to_array($acao[0]);
                    if ($this->mbc->updateTable('tbladdon_wbteampro_action', $acao[0], 'action_id', $id)) {
                        print_r('ok');
                    } else {
                        print_r('erro');
                    }
                } else {
                    print_r('voce não pode musar a data de um ticket');
                }
                die();
                break;
        }
    }

    function busca_remessas() {

        $remessas = $this->mbc->executa_sql("select * from remessas order by Data_dat desc");
//        $path = $_SERVER['DOCUMENT_ROOT'] . '/central/modules/gateways/boleto/';
//        foreach ($arquivos as $arquivo) {
//            $data_modificacao = filemtime($path . '/' . $arquivo->Arquivo_remessa_txf);
//            $arquivo->Data_arquivo = date('Y-m-d H:i:s', $data_modificacao);
//        }
//        sorteia_array_objetos($arquivos, array('Data_arquivo' => SORT_DESC));

        $this->smarty->assign('remessas', $remessas);
    }

    function busca_arquivos() {

        $arquivos = $this->mbc->executa_sql("select * from boletos where Arquivo_remessa_txf!='' and  Arquivo_remessa_txf is not null  group by Arquivo_remessa_txf order by Data_dat desc");
        $path = $_SERVER['DOCUMENT_ROOT'] . '/central/modules/gateways/boleto/';
        foreach ($arquivos as $arquivo) {
            $data_modificacao = filemtime($path . '/' . $arquivo->Arquivo_remessa_txf);
            $arquivo->Data_arquivo = date('Y-m-d H:i:s', $data_modificacao);
        }
        sorteia_array_objetos($arquivos, array('Data_arquivo' => SORT_DESC));

        $this->smarty->assign('arquivos', $arquivos);
    }

    function enviar($param = null) {



//        if (!isset($_REQUEST['Lands_id'])) {
//            die('Acesso invalido, Lands_id não foi definido');
//        }

        $segmento = (int) $this->app->Segmento_padrao_txf;
        $segmento = $segmento + 1;


        if ($this->uri->segment($segmento)) {
            $segmento_post = $this->uri->segment($segmento);
        } else {
            $segmento_post = $this->uri->segment($this->app->Segmento_padrao_txf);
        }

//ver($_POST);

        switch ($segmento_post) {

            case 'arquivos':
                $this->busca_remessas();


                $this->model_smarty->render_ajax('remessas', $this->app->Template_txf);

                die('');
                break;
            case 'boletos_erros':

                $sql = "select * from boletos_erros";

                $boletos = $this->mbc->executa_sql($sql);
                $this->smarty->assign('boletos_erros', $boletos);
                $this->model_smarty->render_ajax('boletos_erros', $this->app->Template_txf);

                die('');
                break;
            case 'busca':
                $valor = $_POST['valor'];
                $boletos = $this->mbc->get_busca('boletos', $valor);



                $this->smarty->assign('boletos', $boletos);
                $this->model_smarty->render_ajax('busca', $this->app->Template_txf);

                die('');
                break;
            case 'lista_retornos':

                $sql = "select * from retornos order by Id_int desc";

                $retornos = $this->mbc->executa_sql($sql);
                $this->smarty->assign('retornos', $retornos);
                $this->model_smarty->render_ajax('retornos', $this->app->Template_txf);

                die('');
                break;
            case 'exclui_remessa':

                $id_remessa = $this->uri->segment(3);
                $remessa = $this->mbc->executa_sql("select * from remessas where Id_int=$id_remessa");
                if ($remessa[0]) {
                    if ($remessa[0]->Enviada_sel == 'SIM') {
                        die('remessa ja enviada');
                    } else {

                        $boletos = $this->mbc->executa_sql("select * from boletos where Arquivo_remessa_txf='{$remessa[0]->Arquivo_txf}'");

                        foreach ($boletos as $boleto) {
                            $array['Remessa_sel'] = 'NAO';
                            $array['Arquivo_remessa_txf'] = "";
                            $this->mbc->updateTable("boletos", $array, 'Id_int', $boleto->Id_int);
                        }
                        $this->mbc->db_delete("remessas", "Id_int", $remessa[0]->Id_int);
                        redirect('financeiro');
                    }
                } else {
                    echo('remessa nao encontrada');
                }



                break;
            case 'nota':



                $dados = array();
                $dados['notes'] = $_POST['notes'];
                $id = $_POST['id'];

                if ($this->mbc->updateTable("tblinvoices", $dados, 'id', $id)) {

                    $mensagem = 'ok';
                } else {
                    $mensagem = 'erro';
                }
                $this->smarty->assign("mensagem", $mensagem);
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                die();

                break;

            case 'ignorar_boleto':

                $id_remessa = $this->uri->segment(3);
                $boleto = $this->mbc->executa_sql("select * from boletos where Id_int=$id_remessa");
                if ($boleto[0]) {
                    $array['Ignorar_sel'] = 'SIM';
                    $array['Remessa_sel'] = 'NAO';
                    $this->mbc->updateTable("boletos", $array, 'Id_int', $boleto[0]->Id_int);
                    echo("boleto {$boleto[0]->Id_int} ignorado");
                    redireciona("https://www.landshosting.com.br/central/modules/gateways/boleto/remessa.php");
                } else {
                    die('boleto nao encontrado');
                }
                break;
            case 'excluir_boleto':

                if ($_POST['id_boleto']) {
                    $ib_boleto = $_POST['id_boleto'];
//                    ver($_POST);
                    $boleto = $this->mbc->executa_sql("select * from boletos where Id_int=$ib_boleto");
                    if ($boleto[0]) {

                        $array['Arquivo_remessa_txf'] = '';
                        $array['Ignorar_sel'] = 'NAO';
                        $array['Remessa_sel'] = 'NAO';

                        $this->mbc->updateTable("boletos", $array, 'Id_int', $boleto[0]->Id_int);
                        echo("boleto {$boleto[0]->Id_int} excluido");
                        $this->carrega_boletos($_POST['arquivo'], $_POST['id_remessa']);
//                    redireciona("https://www.landshosting.com.br/central/modules/gateways/boleto/remessa.php");
                    } else {
                        die('boleto nao encontrado');
                    }
                } else {
                    die('id do boleto nao enviado');
                }
                break;
            case 'baixar_remessa':

                $id_remessa = $this->uri->segment(3);
                $boleto = $this->mbc->executa_sql("select * from remessas where Id_int=$id_remessa");
                if ($boleto[0]) {
                    $array['Enviada_sel'] = 'SIM';
                    $array['Data_atualizacao_dat'] = date('Y-m-d H:i:s');
                    $this->mbc->updateTable("remessas", $array, 'Id_int', $boleto[0]->Id_int);
                    echo("remessa {$boleto[0]->Id_int} enviada");
                    redirect('financeiro');
                } else {
                    die('boleto nao encontrado');
                }
                break;
            case 'confirmar_boleto':

                $id_remessa = $this->uri->segment(3);
                $boleto = $this->mbc->executa_sql("select * from boletos where Id_int=$id_remessa");
                if ($boleto[0]) {
                    $array['Ignorar_sel'] = 'NAO';
                    $array['Remessa_sel'] = 'NAO';
                    $this->mbc->updateTable("boletos", $array, 'Id_int', $boleto[0]->Id_int);
                    echo("boleto {$boleto[0]->Id_int} confirmado");
                    redireciona("https://www.landshosting.com.br/central/modules/gateways/boleto/remessa.php");
                } else {
                    die('boleto nao encontrado');
                }
                break;

            case 'boletos':
                $arquivo = $_POST['arquivo'];
                $id_remessa = $_POST['Id_int'];

                $this->carrega_boletos($arquivo, $id_remessa);

                die('');
                break;
            case 'boletos_retornos':

                $arquivo = $_POST['arquivo'];
                $id = $_POST['Id_int'];

                $sql = "select b.*, f.notes from boletos b left outer join tblinvoices f on f.id=b.Numero_txf where  Arquivo_retorno_txf='{$arquivo}'";

                $boletos = $this->mbc->executa_sql($sql);


                $sql2 = "select * from retornos where  Id_int='{$id}'";

                $retornos = $this->mbc->executa_sql($sql2);
                if ($retornos[0]->Id_int) {
                    $this->smarty->assign('retorno', $retornos[0]);
                }

                foreach ($boletos as $boleto) {
                    $boleto->Retorno = json_decode($boleto->Retorno_jso);
                    $boleto->Objeto = json_decode($boleto->Boleto_jso);
                    $boleto->data_boleto = $boleto->Objeto->data_original;
                    $boleto->situacao = $boleto->Retorno->valores->situacao;
                    $arquivo->Boletos[] = $boleto;
                }
                sorteia_array_objetos($boletos, array('situacao' => SORT_ASC, 'data_boleto' => SORT_DESC));

                $this->smarty->assign('boletos', $boletos);
                $this->model_smarty->render_ajax('lista_boletos_retornos', $this->app->Template_txf);

                die('');
                break;
            case 'retornos':


                if ($_FILES['Arquivos_arq']['name']) {




                    if (isset($_POST['pasta'])) {
                        $pasta_painel = $_POST['pasta'];
                    } else {
                        $pasta_painel = $this->app->Pasta_painel;
                    }



                    $name = $_FILES['Arquivos_arq']['name']; //Atribui uma array com os nomes dos arquivos à variável
                    $tmp_name = $_FILES['Arquivos_arq']['tmp_name']; //Atribui uma array com os nomes temporários dos arquivos à variável
                    $extensoes = explode(',', $_REQUEST['Extensoes_txf']);


                    if ($name) {

                        $ext = pathinfo($name, PATHINFO_EXTENSION);

                        if ($this->analisa_tipos($ext, $extensoes)) {
                            $new_name = $name[0];

                            $path = $_SERVER['DOCUMENT_ROOT'] . '/central/modules/gateways/boleto/retorno/arquivos/';

                            $arquivo = $path . $new_name;
//ver($arquivo);
//                            $caminho_relativo = 'arquivos/' . $pasta . '/' . $new_name;
//                            $caminho_relativo = str_replace('//', '/', $caminho_relativo);


                            move_uploaded_file($tmp_name[0], $arquivo);
                            if (file_exists($arquivo)) {

                                echo "Upload ok";
                            } else {

                                echo "Upload erro";
                            }
                        } else {
                            die('tipo de arquivo inválido inválido');
                            return false;
                        }
                    } else {
                        die('arquivo sem nome');
                    }
                } else {
                    die('sem arquivo');
                }

                break;
        }
    }

    function analisa_tipos($ext, $tipos = null) {
        if (!$tipos) {
            $tipos = array("ret", "txt");
        }
        return true;
        if (in_array($ext, $tipos)) {

            return true;
        } else {
            return false;
        }
    }

    function carrega_boletos($arquivo, $id_remessa) {
        $arquivo = $_POST['arquivo'];
        $id_remessa = $_POST['Id_int'];
        $this->smarty->assign('$id_remessa', $id_remessa);
        $sql = "select * from boletos where  Arquivo_remessa_txf='{$arquivo}'";

        $boletos = $this->mbc->executa_sql($sql);

        $sql2 = "select * from remessas where  Id_int='{$id_remessa}'";

        $remessas = $this->mbc->executa_sql($sql2);
        if ($remessas[0]->Id_int) {
            $this->smarty->assign('remessa', $remessas[0]);
        }

        foreach ($boletos as $boleto) {
            $boleto->Objeto = json_decode($boleto->Boleto_jso);
            $boleto->data_boleto = $boleto->Objeto->data_original;
            $arquivo->Boletos[] = $boleto;
        }

        sorteia_array_objetos($boletos, array('data_boleto' => SORT_DESC));

        $this->smarty->assign('boletos', $boletos);
        $this->model_smarty->render_ajax('lista_boletos', $this->app->Template_txf);
    }

    function carrega_defaults() {
        $whmcs_url = "https://www.landshosting.com.br/central/admin/";
        $this->smarty->assign('whmcs_url', $whmcs_url);
        $this->id_projeto_eventools = 274;
    }

    function busca_tickets_usuario($id = FALSE) {
        $where_tickets = '';

        if ($id) {
            $where_tickets.=" and t.flag='{$id}' ";
        } else {
            $where_tickets.=" and t.flag='0' ";
        }

        $sql = "select t.*, u.firstname, u.lastname, c.companyname, c.id as idcliente from tbltickets t
                          left outer join tbladmins u on u.id = t.flag
left outer join tblclients c on c.id=t.userid
                          where t.status!='Closed'     $where_tickets";
//                                   echo $sql."<br>";

        $tickets = $this->mbc->executa_sql($sql);
        $this->tickets = $tickets;
        $this->smarty->assign('tickets', $tickets);
        return $tickets;
    }

    function busca_tickets_novo($filtra = TRUE) {
        $where_tickets = '';
        if ($filtra) {
            if ($_POST) {
                if ($_POST['flag']) {
                    $where_tickets .= "and t.flag='{$_POST['flag']}'";
                    $id = $_POST['flag'];
                }
            }
//            if ($_POST['userid']) {
//                $where_tickets.= " and t.userid='{$_POST['userid']}' ";
//                $idcliente = $_POST['userid'];
//            }
        } else {
            $where_tickets.=" and (u.firstname='' or u.firstname is null) ";
        }

        $sql = "select t.*, u.firstname, u.lastname, c.companyname, c.id as idcliente from tbltickets t
                          left outer join tbladmins u on u.id = t.flag
left outer join tblclients c on c.id=t.userid
                          where t.status!='Closed'     $where_tickets";
//                                   echo $sql."<br>";

        $tickets = $this->mbc->executa_sql($sql);
        $this->tickets = $tickets;
        $this->smarty->assign('tickets', $tickets);
        return $tickets;
    }

//    function busca_projetos() {
//        $sql = "select * from tbladdon_wbteampro_project ";
//        $where = "where project_complete!=100 and project_function='default' and project_status='executando' ";
//        if ($_POST['project_id']) {
//            $where.= "and project_id='{$_POST['project_id']}'";
//        }
//
//        $order = "order by project_name";
//        $sql_final = $sql . $where . $order;
//        $projetos = $this->mbc->executa_sql($sql_final);
//        $this->smarty->assign('projetos', $projetos);
//        $this->projetos = $projetos;
//        return $projetos;
//    }

    function busca_clientes_projetos() {
        $sql = "select c.*
                  from tblclients c 
                  left outer join tbladdon_wbteampro_project p on p.client_userid=c.id ";


        $where = " where p.project_complete!=100 and p.project_function='default' and p.project_status='executando'  ";
//        $where.=" and v.fieldid=12 ";
//        if ($_POST['idcliente']) {
//            $where.= "and c.id='{$_POST['idcliente']}' ";
//        } else {
//            $where.="";
//        }
        $order = "group by c.id  order by  companyname   ";
        $sql_final = $sql . $where . $order;



        $clientes = $this->mbc->executa_sql($sql_final);

        $this->smarty->assign('clientes', $clientes);
        $this->clientes = $clientes;




        return $clientes;
    }

    function busca_tarefas($eventools = null) {
        $where_project = '';
        if ($eventools) {
            $where_project.=" and ( p.project_id='{$this->id_projeto_eventools}' ) ";
        } else {
            $where_project.=" and ( p.project_id!='{$this->id_projeto_eventools}' ) ";
        }
        if ($_POST['tipo'] == 'gerente') {
            $tipo = 'gerente';
        } else {
            $tipo = 'designado';
        }

        $where = '';
        $debug_filtro = '';
        if ($_POST['project_id']) {
            $where.= " and p.project_id='{$_POST['project_id']}' ";
        }
        if ($_POST['idcliente']) {
            $where.= " and c.id={$_POST['idcliente']} ";
        }
        if ($_POST['data_final']) {
            $where.= " and a.date_finish<='{$_POST['data_final']}'";
            $data = $_POST['data_final'];
        }


        if ($_POST['assigned_adminid']) {
            if ($tipo == 'designado') {
                $where.= " and a.assigned_adminid='{$_POST['assigned_adminid']}'";
            } else {
                $where.= " and a.manager_adminid='{$_POST['assigned_adminid']}'";
            }

            $id = $_POST['assigned_adminid'];
            foreach ($this->usuarios as $usuario) {
                if ($usuario->id == $id) {
                    $debug_filtro.="[ usuario = {$usuario->firstname} ]";
                    $nome_usuario = $usuario->firstname;
                    $id_usuario = $usuario->id;
                    $this->smarty->assign('nome_usuario', $nome_usuario);
                    $this->smarty->assign('id_usuario', $id_usuario);
                }
            }
        }

        $sql = "select u.firstname,u.lastname, 
            p.project_name,p.client_userid, 
            c.companyname, c.id as id_cliente, 
            a.* from tbladdon_wbteampro_action a 
                                    left outer join tbladmins u on u.id=a.assigned_adminid
                                    left outer join tbladdon_wbteampro_project p on p.project_id=a.project_id
                                    left outer join tblclients c on p.client_userid=c.id 
                                    where a.level_children=0 and a.action_complete!=100 
                                    and p.project_complete!=100 
                                    and p.project_function='default' 
                                    and p.project_status='executando' 
                                    {$where} {$where_project}
                                    order by p.date_finish";
//                                               

        $tarefas = $this->mbc->executa_sql($sql);
//                                    ver($tarefas);
        foreach ($tarefas as $tarefa) {
            $mae = $this->mbc->executa_sql("select * from tbladdon_wbteampro_action where action_id={$tarefa->parent_action_id}");
            if ($mae[0]) {
                $tarefa->mae = $mae[0]->action_name;
            } else {
                $tarefa->mae = '';
            }
        }
        sorteia_array_objetos($tarefas, array('date_finish' => SORT_ASC));


        $this->smarty->assign('tarefas', $tarefas);
        $this->tarefas = $tarefas;
        $this->smarty->assign('debug_filtro', $debug_filtro);

        return $tarefas;
    }

    function totalizadores() {
        $totalizador = new stdClass();
        $totalizador->Tarefas->Atrasadas = 0;
        $totalizador->Tarefas->Hoje = 0;

        $totalizador->Tarefas->Futuras = 0;
        $totalizador->Tarefas->Total = 0;
        $totalizador->Tickets->Total = 0;
        $data_atual = date('Y-m-d');
        foreach ($this->tarefas as $tarefa) {
            if ($tarefa->date_finish < $data_atual) {
                $totalizador->Tarefas->ListaAtrasadas[] = $tarefa;
                $totalizador->Tarefas->Atrasadas = $totalizador->Tarefas->Atrasadas + 1;
            }
            if ($tarefa->date_finish == $data_atual) {
                $totalizador->Tarefas->ListaHoje[] = $tarefa;
                $totalizador->Tarefas->Hoje = $totalizador->Tarefas->Hoje + 1;
            }
            if ($tarefa->date_finish > $data_atual) {
                $totalizador->Tarefas->ListaFuturas[] = $tarefa;
                $totalizador->Tarefas->Futuras = $totalizador->Tarefas->Futuras + 1;
            }
            $totalizador->Tarefas->Total = $totalizador->Tarefas->Total + 1;
        }

        foreach ($this->tickets as $ticket) {
            $totalizador->Tickets->Lista[] = $ticket;
            $totalizador->Tickets->Total = $totalizador->Tickets->Total + 1;
        }

        $this->smarty->assign('totalizador', $totalizador);
    }

    function busca_usuarios($eventools = null) {
        $where = '';
        if ($eventools) {
            $where.=" and ( id=1 or id=7  or id=38  ) ";
        }
        $sql = "select * from tbladmins where disabled = 0 $where";
        $usuarios = $this->mbc->executa_sql($sql);
        $this->smarty->assign('usuarios', $usuarios);
        $this->usuarios = $usuarios;
        return $usuarios;
    }

}

?>