<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_face.php');

class embando extends lands_face {
 
    public $modulo = 'hiperofertas';
    public $namespace_cliente = '';
    public $namespace_promocao = '';
    public $promocao = '';
    public $inscricao = '';
    public $usuario = '';
    public $admin = '';
    public $admin_geral;
    public $configuracoes;

//https://www.facebook.com/search/results/?q=Luisa%20Piucco%20Mota
    public function __construct() {

        parent::__construct();
//        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);
//        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);
        $this->conecta_mbc($this->app->Conexoes_for);
        $this->carrega_obrigatorios();
        $this->load->database('default', null, true);
        $this->load->helper('embando');
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

    function carrega_promocao() {
        
    }

## OVERRIDE ##

    function carrega_obrigatorios() {
//carrega lista de emrpesas
        $empresas = $this->mbc->buscar_completo("empresas", "where Ativo_sel='SIM' order by Nome_txf");
        if (isset($empresas[0]->Id_int)) {
            $this->smarty->assign('empresas', $empresas);
        }
//        } else {
//            die('Nenhuma empresa no momento');
//        }

//seta usuario
        $this->carrega_configuracoes();
        $this->configura_usuario();
        $this->carrega_admin_geral();
        $this->carrega_anuncios();
    }

    function carrega_anuncios() {
        $where = "where Ativo_sel='SIM' and Data_inicio_dat<=CURRENT_DATE()  and Data_fim_dat >= CURRENT_DATE() order by RAND();";
        $anuncios = $this->mbc->buscar_completo('anuncios', $where, 'Imagem_ico');
        $this->smarty->assign('anuncios', $anuncios);
        $this->model_smarty->carrega_bloco('anuncios_direita', 'anuncios_direita', $this->app->Template_txf);
        $anuncios_mobile = $this->mbc->buscar_completo('anuncios', $where, 'Imagem_mobile_ico');
        $this->smarty->assign('anuncios_mobile', $anuncios_mobile);
        $this->model_smarty->carrega_bloco('anuncios_mobile', 'anuncios_mobile', $this->app->Template_txf);
    }

    function carrega_configuracoes() {
        $configuracoes = $this->mbc->buscar_tudo("configuracoes");
        $this->configuracoes = $configuracoes[0];
        $this->smarty->assign('configuracoes', $this->configuracoes);
    }

    function configura_usuario() {
        $id = $this->user_profile['id'];
        $usuario = $this->mbc->buscar_completo("usuarios", "where Facebook_id_txf='{$id}'");

        $usuario[0]->Foto_txf = $this->user_profile['picture']['data']['url'];



        if (!isset($usuario[0]->Id_int)) {
            $this->usuario = $this->insere_usuario();
        } else {
            $this->usuario = $usuario[0];
        }
        $this->smarty->assign('usuario', $this->usuario);
    }

    function atualiza_usuario($dados = null) {
        if (!isset($dados)) {
            $dados = $_POST;
            unset($dados['Facebook_id_txf']);
        }
        $dados['Ultima_atualizacao_dat'] = retorna_date_time();
        $this->mbc->updateTable('usuarios', $dados, 'Facebook_id_txf', $this->usuario->Facebook_id_txf);
    }

    function insere_usuario() {
        $user_temp = array_to_object($this->user_profile);
        $usuario_inserir['Facebook_id_txf'] = $user_temp->id;
        $usuario_inserir['Nome_txf'] = $user_temp->name;
        $usuario_inserir['Email_txf'] = $user_temp->email;
        $usuario_inserir['Sexo_txf'] = $user_temp->gender;
        $usuario_inserir['Perfil_txf'] = $user_temp->link;
        $this->mbc->db_insert('usuarios', $usuario_inserir);
        $usuario = $this->mbc->buscar_completo("usuarios", "where Facebook_id_txf='{$user_temp->id}'");
        if (!isset($usuario[0]->Id_int)) {
//     $usuario = $this->mbc->buscar_completo("usuarios", "where Facebook_id_txf='764064293669850'");
            die('nao criou usuario');
        }
        return $usuario[0];
    }

    function insere_registro($tabela, $registro) {

        $registro = object_to_array($registro);
        if (!$tabela) {
            die('sem tabela');
        }if (!$registro) {
            die('sem registro');
        }
        unset($registro['Id_int']);

        $hora = date('H');
        $hora = $hora + 5;
        $dia = date('Y-m-d');
        $hora = $hora . date(':i:s');
        $registro['Data_dat'] = $dia;
        $registro['Data_hora_dat'] = $dia . ' ' . $hora;

        return $this->mbc->db_insert($tabela, $registro);
    }

    function switch_pagina() {
        $this->smarty->assign('titulo_pagina', ucfirst($this->pagina_atual));
        $this->conecta_mbc($this->app->Conexoes_for);


        switch ($this->pagina_atual) {
            case 'promocoes':



                $objeto = $this->mbc->valores_paginacao_generic($this->app, $this->pagina_atual, 'promocoes', "where Ativo_sel='SIM' order by Id_int desc", (intval($this->uri->segment(2) > 0)) ? intval($this->uri->segment(2)) : '1', $this->configuracoes->Qtd_promocoes_geral_txf, '');
                $this->smarty->assign('promocoes', $objeto->registros);
                if (isset($objeto->paginacao)) {
                    $this->smarty->assign('paginacao', $objeto->paginacao);
                }
                $this->model_smarty->carrega_bloco('promocoes', 'promocoes', $this->app->Template_txf);
                break;
                case 'promocoes_ativas':
                    $data_atual=date('Y-m-d');
                    $where="where Ativo_sel='SIM' and ( Inicio_dat<='$data_atual' and Fim_dat>='$data_atual') order by Id_int desc";
                    
                $objeto = $this->mbc->valores_paginacao_generic($this->app, $this->pagina_atual, 'promocoes',$where, (intval($this->uri->segment(2) > 0)) ? intval($this->uri->segment(2)) : '1', $this->configuracoes->Qtd_promocoes_geral_txf, '');
                 
                $this->smarty->assign('promocoes', $objeto->registros);
                if (isset($objeto->paginacao)) {
                    $this->smarty->assign('paginacao', $objeto->paginacao);
                }
                $this->model_smarty->carrega_bloco('promocoes', 'promocoes', $this->app->Template_txf);
                break;
            case 'empresas':
                $this->carrega_empresa('TODAS');
                $this->model_smarty->carrega_bloco('divulgue', 'divulgue', $this->app->Template_txf);
                break;
            case 'sobre':
                $this->carrega_empresa('TODAS');
                $this->model_smarty->carrega_bloco('divulgue', 'divulgue', $this->app->Template_txf);
                break;
            case 'contato':
                $this->carrega_empresa('TODAS');
                $this->model_smarty->carrega_bloco('formulario_contato', 'formulario_contato', $this->app->Template_txf);
                break;
            case 'minhas_ofertas':
                $objeto = $this->mbc->valores_paginacao_generic($this->app, $this->pagina_atual, 'inscricoes', "where Facebook_id_txf='{$this->usuario->Facebook_id_txf}' order by Data_dat desc, Nome_txf", (intval($this->uri->segment(2) > 0)) ? intval($this->uri->segment(2)) : '1', $this->configuracoes->Qtd_promocoes_usuario_txf, '');

                foreach ($objeto->registros as $inscricao) {
                    $inscricao->Promocao = $this->mbc->buscar_completo("promocoes", "where Namespace_empresa_sel='{$inscricao->Namespace_empresa_txf}' and Namespace_promocao_txf='{$inscricao->Namespace_promocao_txf}'",'Miniatura_ico');
                    $inscricao->Empresa = $this->mbc->buscar_completo("empresas", "where Namespace_txf='{$inscricao->Namespace_empresa_txf}'");
                }

                $this->smarty->assign('inscricoes', $objeto->registros);
                if (isset($objeto->paginacao)) {
                    $this->smarty->assign('paginacao', $objeto->paginacao);
                }


                $this->model_smarty->carrega_bloco('minhas_ofertas', 'minhas_ofertas', $this->app->Template_txf);
                $this->model_smarty->carrega_bloco('meus_dados', 'meus_dados', $this->app->Template_txf);


                break;
                 case 'minha_conta':

                
                break;
            
            case 'privacidade':
                break;
            case 'debug':
                break;
            case 'configuracoes':
                $this->verifica_admin_geral();

                $this->model_smarty->carrega_bloco('lista_empresas', 'lista_empresas', $this->app->Template_txf);
                break;

            case 'admin_empresas':
                $this->verifica_admin_geral();

                $this->model_smarty->carrega_bloco('lista_empresas', 'lista_empresas', $this->app->Template_txf);
                break;

            default:
                $this->carrega_namespace_empresa();
                break;
        }
        $this->model_smarty->carrega_bloco('social', 'social', $this->app->Template_txf);
    }

    function carrega_namespace_empresa() {
        $this->namespace_empresa = $this->uri->segment($this->app->Segmento_padrao_txf);
        $this->smarty->assign('namespace_empresa', $this->namespace_empresa);
        if (($this->uri->segment($this->app->Segmento_padrao_txf + 1)) && (!is_numeric($this->uri->segment($this->app->Segmento_padrao_txf + 1)))) {
            $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
        } else {
            $this->pagina_atual = 'empresa';
        }

        $this->carrega_empresa();
        $this->carrega_admin();



        $this->switch_pagina_empresa($this->pagina_atual);
    }

    function carrega_admin_geral() {
        $sql = "select * from administradores where ( Ativo_sel='SIM' and  Namespace_empresa_sel='TODAS')";
        $admin = $this->mbc->executa_sql($sql);
        if (isset($admin[0]->Id_int)) {
            foreach ($admin as $adm) {
                $adm_id = explode('/', $adm->Usuario_sel);
                $adm->Nome_txf = $adm_id[0];
                $adm->Facebook_id_txf = $adm_id[1];
                if ($adm->Facebook_id_txf == $this->usuario->Facebook_id_txf) {
                    $this->smarty->assign('admin_geral', $adm);
                    $this->admin_geral = $adm;
                    $this->model_smarty->carrega_bloco('admin_geral', 'admin_geral', $this->app->Template_txf);
                }
            }
        }
//        ver($this->admin_geral,1);
        return $admin;
    }

    function carrega_admin() {
        $sql = "select * from administradores where ( Ativo_sel='SIM' and  Namespace_empresa_sel='TODAS')";
        if (isset($this->namespace_empresa)) {
            $sql.=" or ( Ativo_sel='SIM' and Namespace_empresa_sel='{$this->namespace_empresa}' )";
        }

        $admin = $this->mbc->executa_sql($sql);


        if (isset($admin[0]->Id_int)) {
            foreach ($admin as $adm) {
                $adm_id = explode('/', $adm->Usuario_sel);
                $adm->Nome_txf = $adm_id[0];
                $adm->Facebook_id_txf = $adm_id[1];
                if ($adm->Facebook_id_txf == $this->usuario->Facebook_id_txf) {
                    $this->smarty->assign('admin', $adm);
                    $this->admin = $adm;
                    $this->model_smarty->carrega_bloco('admin', 'admin', $this->app->Template_txf);
                }
            }
        }
        return $admin;
    }

    function carrega_empresa($namespace = null) {
        if (isset($namespace)) {
            $this->namespace_empresa = $namespace;
        }
        //$empresa = $this->mbc->buscar_completo("empresas", "where  Ativo_sel='SIM' and  Namespace_txf='{$this->namespace_empresa}'");
        $empresa = $this->mbc->buscar_completo("empresas", "where  Namespace_txf='{$this->namespace_empresa}'");

        if (isset($empresa[0]->Id_int)) {

            $empresa[0]->Enderecos = $this->mbc->executa_sql("select * from enderecos where Id_objeto_con={$empresa[0]->Id_int}");

            $this->empresa = $empresa[0];

            $this->smarty->assign('empresa', $empresa[0]);
            $this->model_smarty->carrega_bloco('logo_empresa', 'logo_empresa', $this->app->Template_txf);
            $this->model_smarty->carrega_bloco('fanpage', 'fanpage', $this->app->Template_txf);
            $this->model_smarty->carrega_bloco('contato', 'contato', $this->app->Template_txf);
            $this->model_smarty->carrega_bloco('formulario_contato', 'formulario_contato', $this->app->Template_txf);
            $this->model_smarty->carrega_bloco('cabecalho', 'cabecalho', $this->app->Template_txf);
        } else {
            die('sem empresa');
        }
    }

    function verifica_admin_geral() {

        if (!$this->admin_geral) {
            redirect($this->app->Url_cliente . "acesso_negado");
        }
    }

    function verifica_admin() {
        if (!$this->admin) {
            redirect($this->app->Url_cliente . $this->namespace_empresa . "/acesso_negado");
        }
    }

    function switch_pagina_empresa($pagina) {

        $this->smarty->assign('pagina_atual', $pagina);


        switch ($pagina) {

            case 'empresa':
                $objeto = $this->mbc->valores_paginacao_generic($this->app, $this->namespace_empresa, 'promocoes', "where Ativo_sel='SIM' and Namespace_empresa_sel='{$this->namespace_empresa}' order by Id_int desc", (intval($this->uri->segment(2) > 0)) ? intval($this->uri->segment(2)) : '1', $this->configuracoes->Qtd_promocoes_empresa_txf, '');


                $this->smarty->assign('promocoes', $objeto->registros);
                if (isset($objeto->paginacao)) {
                    $this->smarty->assign('paginacao', $objeto->paginacao);
                }

                $this->model_smarty->carrega_bloco('promocoes', 'promocoes', $this->app->Template_txf);
                break;
            case 'admin':
                $this->verifica_admin();

                $objeto = $this->mbc->valores_paginacao_generic($this->app, $this->namespace_empresa, 'promocoes', "where Namespace_empresa_sel='{$this->namespace_empresa}' order by Fim_dat desc", (intval($this->uri->segment(3) > 0)) ? intval($this->uri->segment(3)) : '1', $this->configuracoes->Qtd_promocoes_admin_txf, 'admin');
                foreach ($objeto->registros as $promocao) {
                    $sql = "select COUNT(*) as total, t.* from inscricoes t where t.Namespace_empresa_txf='{$promocao->Namespace_empresa_sel}' and t.Namespace_promocao_txf='{$promocao->Namespace_promocao_txf}' ";
                    $inscricoes = $this->mbc->executa_sql($sql);
                    $promocao->Total_inscritos_txf = $inscricoes[0]->total;
                    $sql2 = "select COUNT(*) as total, t.* from acessos t where t.Namespace_empresa_txf='{$promocao->Namespace_empresa_sel}' and t.Namespace_promocao_txf='{$promocao->Namespace_promocao_txf}' ";
                    $acessos = $this->mbc->executa_sql($sql2);
                    $promocao->Total_acessos_txf = $acessos[0]->total;
                }
                $this->smarty->assign('promocoes', $objeto->registros);
                if (isset($objeto->paginacao)) {
                    $this->smarty->assign('paginacao', $objeto->paginacao);
                }
                $this->model_smarty->carrega_bloco('promocoes_admin', 'promocoes_admin', $this->app->Template_txf);
                break;
            case 'inscricoes_sorteio':
                $this->verifica_admin();
                $segment2 = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
                if (!$segment2) {
                    die('Faltando Id da promocao.');
                }
                $promocao = $this->mbc->buscar_completo("promocoes", "where Id_int=$segment2");
                $this->smarty->assign('promocao', $promocao);
                $this->promocao = $promocao[0];
                $inscricoes = $this->mbc->executa_sql("select * from inscricoes  where Namespace_empresa_txf='{$this->promocao->Namespace_empresa_sel}' and Namespace_promocao_txf='{$this->promocao->Namespace_promocao_txf}' order by Status_sel desc, Nome_txf");
                $this->smarty->assign('inscricoes', $inscricoes);
                $sorteios = $this->mbc->executa_sql("select s.*, s.Id_int as Id_sorteio,  i.* from sorteios s  left outer join inscricoes i on i.Id_int=s.Inscricao_int where s.Namespace_empresa_txf='{$this->promocao->Namespace_empresa_sel}' and s.Namespace_promocao_txf='{$this->promocao->Namespace_promocao_txf}' order by s.Id_int , Nome_txf");
                $this->smarty->assign('sorteios', $sorteios);
                $this->model_smarty->carrega_bloco('inscritos_sorteio', 'inscritos_sorteio', $this->app->Template_txf);
                $this->model_smarty->carrega_bloco('admin_sorteio', 'admin_sorteio', $this->app->Template_txf);
                break;
            case 'lista_acessos':
                $this->verifica_admin();
                $segment2 = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
                if (!$segment2) {
                    die('Faltando Id da promocao.');
                }
                $promocao = $this->mbc->buscar_completo("promocoes", "where Id_int=$segment2");
                $this->promocao = $promocao[0];
                $this->smarty->assign('promocao', $promocao);
//                        $sql2 = "select COUNT(*) as Total_txf ,u.Email_txf,u.Telefone_txf, t.* from acessos t 
//                            left outer join usuarios u on t.Facebook_id_txf=u.Facebook_id_txf 
//                            where t.Namespace_empresa_txf='{$this->promocao->Namespace_empresa_sel}' 
//                                and t.Namespace_promocao_txf='{$this->promocao->Namespace_promocao_txf}' 
//                                    group by Facebook_id_txf order by Total_txf desc , Data_hora_dat  ";

                $sql2 = "select COUNT(*) as Total_txf ,u.Email_txf,u.Telefone_txf, t.*, o.Obs_txf, o.Id_int as Id_observacao from acessos t 
                            left outer join usuarios u on t.Facebook_id_txf=u.Facebook_id_txf 
                            left outer join acessos_obs o on t.Facebook_id_txf=o.Facebook_id_txf 
                            where t.Namespace_empresa_txf='{$this->promocao->Namespace_empresa_sel}' 
                                and t.Namespace_promocao_txf='{$this->promocao->Namespace_promocao_txf}' 
                                    group by Facebook_id_txf order by Total_txf desc , Data_hora_dat  ";




                $acessos = $this->mbc->executa_sql($sql2);


                $acessos_total = $this->mbc->executa_sql("SELECT *   FROM acessos where Namespace_empresa_txf='{$this->promocao->Namespace_empresa_sel}' and Namespace_promocao_txf='{$this->promocao->Namespace_promocao_txf}'");
                $administradores = $this->carrega_admin();
                foreach ($administradores as $administrador) {
                    $admins[$administrador->Facebook_id_txf] = $administrador->Nome_txf;
                }
                foreach ($acessos as $acesso) {
                    if (isset($admins[$acesso->Facebook_id_txf])) {
                        $acesso->Tipo_txf = 'admin';
                    } else {
                        $acesso->Tipo_txf = 'usuario';
                    }
                }
                $acessos_unicos = count($acessos);
                $this->smarty->assign('acessos', $acessos);
                $this->smarty->assign('acessos_unicos', $acessos_unicos);
                $this->smarty->assign('acessos_total', count($acessos_total));
                if (is_lands()) {
                    $this->model_smarty->carrega_bloco('ferramentas_acessos', 'ferramentas_acessos', $this->app->Template_txf);
                }

                $this->model_smarty->carrega_bloco('acessos', 'acessos', $this->app->Template_txf);
                $this->model_smarty->carrega_bloco('totalizadores_acessos', 'totalizadores_acessos', $this->app->Template_txf);
                break;
            case 'erro':
                $segment2 = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
                if (!$segment2) {
                    die('Faltando Id da promocao.');
                }
                $promocao = $this->mbc->buscar_completo("promocoes", "where Id_int=$segment2");
                $this->promocao = $promocao[0];
                $this->smarty->assign('promocao', $promocao);
                $this->model_smarty->carrega_bloco('promocao', 'promocao', $this->app->Template_txf);
                $this->model_smarty->carrega_bloco('erro', 'erro', $this->app->Template_txf);
                break;
            case 'bloqueado':
                $segment2 = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
                if (!$segment2) {
                    die('Faltando Id da promocao.');
                }
                $promocao = $this->mbc->buscar_completo("promocoes", "where Id_int=$segment2");
                $this->promocao = $promocao[0];
                $this->smarty->assign('promocao', $promocao);
                $this->model_smarty->carrega_bloco('promocao', 'promocao', $this->app->Template_txf);
                $this->model_smarty->carrega_bloco('bloqueado', 'bloqueado', $this->app->Template_txf);
                break;
            case 'acesso_negado':
                break;
            case 'encerrada':
                $segment2 = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
                if (!$segment2) {
                    die('Faltando Id da promocao.');
                }
                $promocao = $this->mbc->buscar_completo("promocoes", "where Id_int=$segment2");
                $this->promocao = $promocao[0];
                $this->smarty->assign('promocao', $promocao);
                $this->model_smarty->carrega_bloco('promocao', 'promocao', $this->app->Template_txf);
                $this->model_smarty->carrega_bloco('encerrada', 'encerrada', $this->app->Template_txf);

                if ($this->promocao->Tipo_sel == 'sorteio') {
                    $inscricoes = $this->mbc->executa_sql("select * from inscricoes  where Namespace_empresa_txf='{$this->promocao->Namespace_empresa_sel}' and Namespace_promocao_txf='{$this->promocao->Namespace_promocao_txf}' order by Status_sel desc, Nome_txf");
                    $this->smarty->assign('inscricoes', $inscricoes);
                    $this->model_smarty->carrega_bloco('inscritos_sorteio', 'inscritos_sorteio', $this->app->Template_txf);

                    $sorteios = $this->mbc->executa_sql("select s.*, s.Id_int as Id_sorteio,  i.* from sorteios s  left outer join inscricoes i on i.Id_int=s.Inscricao_int where s.Namespace_empresa_txf='{$this->promocao->Namespace_empresa_sel}' and s.Namespace_promocao_txf='{$this->promocao->Namespace_promocao_txf}' order by s.Id_int , Nome_txf");
                    $this->smarty->assign('sorteios', $sorteios);
                    $this->model_smarty->carrega_bloco('promocao_sorteios', 'promocao_sorteios', $this->app->Template_txf);
                }
                break;
            case 'aguarde':
                $segment2 = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
                if (!$segment2) {
                    die('Faltando Id da promocao.');
                }
                $promocao = $this->mbc->buscar_completo("promocoes", "where Id_int=$segment2");
                $this->promocao = $promocao[0];
                $this->smarty->assign('promocao', $promocao);
                $this->model_smarty->carrega_bloco('promocao', 'promocao', $this->app->Template_txf);
                $this->model_smarty->carrega_bloco('aguarde', 'aguarde', $this->app->Template_txf);
                break;
            case 'sexo_invalido':
                $segment2 = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
                if (!$segment2) {
                    die('Faltando Id da promocao.');
                }
                $promocao = $this->mbc->buscar_completo("promocoes", "where Id_int=$segment2");
                $this->promocao = $promocao[0];
                $this->smarty->assign('promocao', $promocao);
                $this->model_smarty->carrega_bloco('promocao', 'promocao', $this->app->Template_txf);
                $this->model_smarty->carrega_bloco('sexo_invalido', 'sexo_invalido', $this->app->Template_txf);
                break;
            case 'duplicado':
                $segment2 = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
                if (!$segment2) {
                    die('Faltando Id da promocao.');
                }
                $promocao = $this->mbc->buscar_completo("promocoes", "where Id_int=$segment2");
                $this->promocao = $promocao[0];
                $this->smarty->assign('promocao', $promocao);
                $this->smarty->assign('titulo_inscricao', 'Inscrição já realizada');
                $this->model_smarty->carrega_bloco('promocao', 'promocao', $this->app->Template_txf);
                $this->busca_inscricao($promocao);


//                if ($this->promocao->Gera_pagto_sel == 'SIM') {
//                    $this->busca_configuracoes_pagto();
//                }

                if ($this->promocao->Tipo_sel == 'download') {
                    $this->model_smarty->carrega_bloco('download', 'download', $this->app->Template_txf);
                }

                if ($this->promocao->Tipo_sel == 'sorteio') {
                    $inscricoes = $this->mbc->executa_sql("select * from inscricoes  where Namespace_empresa_txf='{$this->promocao->Namespace_empresa_sel}' and Namespace_promocao_txf='{$this->promocao->Namespace_promocao_txf}' order by Status_sel desc, Nome_txf");
                    $this->smarty->assign('inscricoes', $inscricoes);
                    $this->model_smarty->carrega_bloco('inscritos_sorteio', 'inscritos_sorteio', $this->app->Template_txf);

                    $sorteios = $this->mbc->executa_sql("select s.*, s.Id_int as Id_sorteio,  i.* from sorteios s  left outer join inscricoes i on i.Id_int=s.Inscricao_int where s.Namespace_empresa_txf='{$this->promocao->Namespace_empresa_sel}' and s.Namespace_promocao_txf='{$this->promocao->Namespace_promocao_txf}' order by s.Id_int , Nome_txf");
                    $this->smarty->assign('sorteios', $sorteios);
                    $this->model_smarty->carrega_bloco('promocao_sorteios', 'promocao_sorteios', $this->app->Template_txf);
                }





                break;
            case 'sucesso':
                $segment2 = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
                if (!$segment2) {
                    die('Faltando Id da promocao.');
                }
                $promocao = $this->mbc->buscar_completo("promocoes", "where Id_int=$segment2");
                $this->promocao = $promocao[0];
                $this->smarty->assign('promocao', $promocao);



                $this->smarty->assign('titulo_inscricao', 'Inscrição realizada');
                $this->model_smarty->carrega_bloco('promocao', 'promocao', $this->app->Template_txf);
                $this->busca_inscricao($promocao);

//                if ($this->promocao->Gera_pagto_sel == 'SIM') {
//                    $this->busca_configuracoes_pagto();
//                }

                if ($this->promocao->Tipo_sel == 'download') {
                    $this->model_smarty->carrega_bloco('download', 'download', $this->app->Template_txf);
                }

                if ($this->promocao->Tipo_sel == 'sorteio') {
                    $inscricoes = $this->mbc->executa_sql("select * from inscricoes  where Namespace_empresa_txf='{$this->promocao->Namespace_empresa_sel}' and Namespace_promocao_txf='{$this->promocao->Namespace_promocao_txf}' order by Status_sel desc, Nome_txf");
                    $this->smarty->assign('inscricoes', $inscricoes);
                    $this->model_smarty->carrega_bloco('inscritos_sorteio', 'inscritos_sorteio', $this->app->Template_txf);

                    $sorteios = $this->mbc->executa_sql("select s.*, s.Id_int as Id_sorteio,  i.* from sorteios s  left outer join inscricoes i on i.Id_int=s.Inscricao_int where s.Namespace_empresa_txf='{$this->promocao->Namespace_empresa_sel}' and s.Namespace_promocao_txf='{$this->promocao->Namespace_promocao_txf}' order by s.Id_int , Nome_txf");
                    $this->smarty->assign('sorteios', $sorteios);
                    $this->model_smarty->carrega_bloco('promocao_sorteios', 'promocao_sorteios', $this->app->Template_txf);
                }

                break;
            case 'imprime_inscricoes':
                $this->verifica_admin();
                $segment2 = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
                if (!$segment2) {
                    die('Faltando Id da promocao.');
                }
                $promocao = $this->mbc->buscar_completo("promocoes", "where Id_int=$segment2");
                $this->smarty->assign('promocao', $promocao);
                $this->promocao = $promocao[0];
                $inscricoes = $this->mbc->executa_sql("select * from inscricoes  where Namespace_empresa_txf='{$this->promocao->Namespace_empresa_sel}' and Namespace_promocao_txf='{$this->promocao->Namespace_promocao_txf}' order by Status_sel desc, Nome_txf");
                $this->smarty->assign('inscricoes', $inscricoes);

                $totalizadores = $this->mbc->executa_sql("select  COUNT(t.Status_sel) as total, t.Status_sel from inscricoes t  where t.Namespace_empresa_txf='{$this->promocao->Namespace_empresa_sel}' and t.Namespace_promocao_txf='{$this->promocao->Namespace_promocao_txf}' group by Status_sel order by t.Status_sel desc, t.Nome_txf");
                $this->smarty->assign('totalizadores', $totalizadores);
//ver($totalizadores);
                $this->model_smarty->carrega_bloco('totalizadores', 'totalizadores', $this->app->Template_txf);

                $this->model_smarty->carrega_bloco('impressao_topo', 'impressao_topo', $this->app->Template_txf);

                break;
            case 'imprime_acessos':
                $this->verifica_admin();
                $segment2 = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
                if (!$segment2) {
                    die('Faltando Id da promocao.');
                }
                $promocao = $this->mbc->buscar_completo("promocoes", "where Id_int=$segment2");
                $this->promocao = $promocao[0];
                $this->smarty->assign('promocao', $promocao);
//                $sql2 = "select COUNT(*) as Total_txf , t.* from acessos t where t.Namespace_empresa_txf='{$this->promocao->Namespace_empresa_sel}' and t.Namespace_promocao_txf='{$this->promocao->Namespace_promocao_txf}' group by Facebook_id_txf order by Total_txf desc , Data_hora_dat  ";

                $sql2 = "select COUNT(*) as Total_txf ,u.Email_txf,u.Telefone_txf, t.*, o.Obs_txf, o.Id_int as Id_observacao from acessos t 
                            left outer join usuarios u on t.Facebook_id_txf=u.Facebook_id_txf 
                            left outer join acessos_obs o on t.Facebook_id_txf=o.Facebook_id_txf 
                            where t.Namespace_empresa_txf='{$this->promocao->Namespace_empresa_sel}' 
                                and t.Namespace_promocao_txf='{$this->promocao->Namespace_promocao_txf}' 
                                    group by Facebook_id_txf order by Total_txf desc , Data_hora_dat  ";


                $acessos = $this->mbc->executa_sql($sql2);
                $acessos_total = $this->mbc->executa_sql("SELECT *   FROM acessos where Namespace_empresa_txf='{$this->promocao->Namespace_empresa_sel}' and Namespace_promocao_txf='{$this->promocao->Namespace_promocao_txf}'");
                $administradores = $this->carrega_admin();
                foreach ($administradores as $administrador) {
                    $admins[$administrador->Facebook_id_txf] = $administrador->Nome_txf;
                }
                foreach ($acessos as $acesso) {
                    if (isset($admins[$acesso->Facebook_id_txf])) {
                        $acesso->Tipo_txf = 'admin';
                    } else {
                        $acesso->Tipo_txf = 'usuario';
                    }
                }
                $acessos_unicos = count($acessos);
                $this->smarty->assign('acessos', $acessos);
                $this->smarty->assign('acessos_unicos', $acessos_unicos);
                $this->smarty->assign('acessos_total', count($acessos_total));
                $this->model_smarty->carrega_bloco('impressao_topo', 'impressao_topo', $this->app->Template_txf);
//                        $this->model_smarty->carrega_bloco('acessos', 'acessos', $this->app->Template_txf);
//                        $this->model_smarty->carrega_bloco('totalizadores_acessos', 'totalizadores_acessos', $this->app->Template_txf);
                break;
            case 'exportar_acessos':

                $this->verifica_admin();
                $segment2 = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
                if (!$segment2) {
                    die('Faltando Id da promocao.');
                }
                $promocao = $this->mbc->buscar_completo("promocoes", "where Id_int=$segment2");
                $this->promocao = $promocao[0];
                $this->smarty->assign('promocao', $promocao);

                $sql2 = "select COUNT(*) as Total , t.Namespace_promocao_txf as Promocao, t.Nome_txf as Nome, CONCAT('http://facebook.com/',t.Facebook_id_txf) as Facebook from acessos t where t.Namespace_empresa_txf='{$this->promocao->Namespace_empresa_sel}' and t.Namespace_promocao_txf='{$this->promocao->Namespace_promocao_txf}' group by Facebook_id_txf order by Total desc, Data_hora_dat  ";
                $acessos = $this->mbc->executa_sql($sql2);



                $query = $this->mbc->db->query($sql2);


                $datahora = date('d-m-Y-H-i-s');
                header("Content-type: text/csv");
                header("Content-Disposition: attachment; filename=promocao-cod-{$segment2}-{$datahora}.csv");
                header("Pragma: no-cache");
                header("Expires: 0");

                $delimiter = ";";
                $newline = "\r\n";


                $this->load->dbutil();

                echo $this->dbutil->csv_from_result($query, $delimiter, $newline);
                die();

                break;
            case 'imprime_ticket':
                $segment2 = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
                if (!$segment2) {
                    die('Faltando Id da promocao.');
                }
                $promocao = $this->mbc->buscar_completo("promocoes", "where Id_int=$segment2");
                $this->smarty->assign('promocao', $promocao);
                $this->promocao = $promocao[0];
                $inscricao = $this->mbc->executa_sql("select * from inscricoes where Facebook_id_txf='" . $this->fbuser . "'  and Namespace_empresa_txf='{$promocao[0]->Namespace_empresa_sel}' and Namespace_promocao_txf='{$promocao[0]->Namespace_promocao_txf}' limit 1");
                $this->smarty->assign('inscricao', $inscricao[0]);
                $this->model_smarty->carrega_bloco('impressao_topo', 'impressao_topo', $this->app->Template_txf);
                $this->model_smarty->carrega_bloco('regulamento', 'regulamento', $this->app->Template_txf);
                $this->model_smarty->carrega_bloco('ticket', 'ticket', $this->app->Template_txf);
                if (!isset($inscricao[0]->Id_int)) {
                    redirect($this->app->Url_cliente . "erro/" . $promocao[0]->Id_int);
                }
                break;
            case 'imprime_ticket_admin':

                $id = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
                if (!$id) {
                    die('Faltando Id da promocao.');
                }
                $inscricao = $this->mbc->executa_sql("select * from inscricoes where Id_int={$id} limit 1");
                $this->smarty->assign('inscricao', $inscricao[0]);
                $promocao = $this->mbc->buscar_completo("promocoes", "where Namespace_empresa_sel='{$inscricao[0]->Namespace_empresa_txf}' and Namespace_promocao_txf='{$inscricao[0]->Namespace_promocao_txf}'");
                $this->smarty->assign('promocao', $promocao);
                $this->promocao = $promocao[0];
                $this->model_smarty->carrega_bloco('impressao_topo', 'impressao_topo', $this->app->Template_txf);
                $this->model_smarty->carrega_bloco('regulamento', 'regulamento', $this->app->Template_txf);
                $this->model_smarty->carrega_bloco('ticket', 'ticket', $this->app->Template_txf);
                if (!isset($inscricao[0]->Id_int)) {
                    redirect($this->app->Url_cliente . $this->namespace_empresa . "/erro/" . $promocao[0]->Id_int);
                }
                break;
            case 'inscricoes':
                $this->verifica_admin();
                $segment2 = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
                if (!$segment2) {
                    die('Faltando Id da promocao.');
                }
                $promocao = $this->mbc->buscar_completo("promocoes", "where Id_int=$segment2");
                $this->smarty->assign('promocao', $promocao);
                $this->promocao = $promocao[0];
                $wherepost = '';
                if ($_POST['Valor_txf']) {
                    $wherepost.=" and ( ";
                    $valor = $_POST['Valor_txf'];
                    $wherepost.=" Email_txf LIKE '%{$valor}%' or";
                    $wherepost.=" Nome_txf LIKE '%{$valor}%' or";
                    $wherepost.=" Telefone_txf LIKE '%{$valor}%' ";
                    $wherepost.=" ) ";


                    //Nome_txf	Email_txf	Telefone_txf
                }
                $inscricoes = $this->mbc->executa_sql("select * from inscricoes  where Namespace_empresa_txf='{$this->promocao->Namespace_empresa_sel}' and Namespace_promocao_txf='{$this->promocao->Namespace_promocao_txf}' {$wherepost} order by Status_sel desc, Nome_txf");
                $status = $this->mbc->executa_sql("select * from status where Id_objeto_con={$promocao[0]->Id_int} order by Ordenacao_txf");

                if (!isset($status[0]->Id_int)) {
                    
                    $status[1]->Nome_txf = 'AGUARDANDO';
                    $status[3]->Nome_txf = 'COMPARECEU';
                    
                }


                $this->smarty->assign('status', $status);

                $status_pagto = $this->mbc->executa_sql("select * from status_pagto ");

                if (!isset($status[0]->Id_int)) {
                    
                    $status[1]->Nome_txf = 'AGUARDANDO';
                    $status[3]->Nome_txf = 'COMPARECEU';
                    
                }

                $this->smarty->assign('status_pagto', $status_pagto);
                $this->smarty->assign('inscricoes', $inscricoes);

//                if ($this->promocao->Gera_pagto_sel == 'SIM') {
//                    $this->busca_configuracoes_pagto(TRUE);
//                }

                if ($_POST) {

                    $this->model_smarty->render_bloco('inscritos', $this->app->Template_txf);
                    die();
                } else {

                    $this->model_smarty->carrega_bloco('inscritos', 'inscritos', $this->app->Template_txf);

                    $totalizadores = $this->mbc->executa_sql("select  COUNT(t.Status_sel) as total, t.Status_sel from inscricoes t  where t.Namespace_empresa_txf='{$this->promocao->Namespace_empresa_sel}' and t.Namespace_promocao_txf='{$this->promocao->Namespace_promocao_txf}' group by Status_sel order by t.Status_sel desc, t.Nome_txf");
                    $this->smarty->assign('totalizadores', $totalizadores);
//ver($totalizadores);
                    $this->model_smarty->carrega_bloco('totalizadores', 'totalizadores', $this->app->Template_txf);
                }



                break;
            default:
                $this->namespace_promocao = $pagina;
                $this->smarty->assign('namespace_promocao', $this->namespace_promocao);
                $this->abre_promocao();
                break;
        }
        $this->model_smarty->carrega_bloco('social', 'social', $this->app->Template_txf);
        $this->grava_log_acesso();
    }

    function busca_configuracoes_pagto($admin = null) {
        $promocao_configs = $this->mbc->buscar_completo("promocoes_configs", "where Namespace_empresa_sel='{$this->promocao->Namespace_empresa_sel}' and Namespace_promocao_txf='{$this->promocao->Namespace_promocao_txf}'");
        $this->promocao_configs = $promocao_configs[0];
        $this->smarty->assign('promocao_configs', $promocao_configs);
        $pagamentos_permitidos = explode(',', $promocao_configs[0]->Pagamentos_permitidos_txf);
        foreach ($pagamentos_permitidos as $pagamentos) {
            $temp = $this->mbc->buscar_completo($pagamentos, "where Namespace_empresa_sel='{$this->promocao_configs->Namespace_cedente_sel}'");
            if (isset($temp[0])) {
                $pagto = str_replace('boleto_', '', $pagamentos);
                $boleto[$pagto] = $temp[0];
            }
        }
        $this->boleto = $boleto;
        $this->smarty->assign('boleto', $boleto);
        if (!$admin) {
            $this->model_smarty->carrega_bloco('efetuar_pagamento', 'efetuar_pagamento', $this->app->Template_txf);
        }
    }

    function busca_inscricao($promocao) {
        $inscricao = $this->mbc->executa_sql("select * from inscricoes where Facebook_id_txf='" . $this->fbuser . "'  and Namespace_empresa_txf='{$promocao[0]->Namespace_empresa_sel}' and Namespace_promocao_txf='{$promocao[0]->Namespace_promocao_txf}' limit 1");
        if (isset($inscricao[0])) {
            $this->inscricao = $inscricao[0];
        }

        $this->smarty->assign('inscricao', $inscricao[0]);
        $this->model_smarty->carrega_bloco('inscricao', 'inscricao', $this->app->Template_txf);
    }

    function abre_promocao() {

        $promocao = $this->mbc->buscar_completo("promocoes", "where Namespace_empresa_sel='{$this->namespace_empresa}' and Namespace_promocao_txf='{$this->namespace_promocao}'");

        if (!isset($promocao[0]->Id_int)) {
            die('promocao nao encontrada');
        } else {
            $id_promocao = $promocao[0]->Id_int;
            $this->smarty->assign('promocao', $promocao);

            if (!$this->admin) {
                $this->verifica_seguranca_promocao($promocao);
            }
            $promocao[0]->Campos = array();
            $promocao[0]->Campos = $this->mbc->executa_sql("select c.* from checkboxes cb left outer join campos c on cb.Id_chb_con=c.Id_int where cb.Tabela_chb_con='campos' and cb.Id_objeto_con={$id_promocao} ");


            $this->pagina_atual = 'promocao';
            $this->smarty->assign('pagina_atual', $this->pagina_atual);
            $this->promocao = $promocao;

            $this->model_smarty->carrega_bloco('promocao', 'promocao', $this->app->Template_txf);
            $this->model_smarty->carrega_bloco('galeria', 'galeria', $this->app->Template_txf);

            $this->carrega_bloco_formulario();
        }
    }

    function verifica_seguranca_promocao($promocao) {
        $this->carrega_model('model_hiperofertas');
        $this->model_hiperofertas->inicializa($promocao);

        if ($this->model_hiperofertas->verifica_inscricao_dupla($this->fbuser, $promocao[0]->Id_int)) {
            redirect($this->app->Url_cliente . $this->namespace_empresa . "/duplicado/" . $promocao[0]->Id_int);
        }

        if ($this->model_hiperofertas->verifica_usuario_bloqueado($this->fbuser)) {
            redirect($this->app->Url_cliente . $this->namespace_empresa . "/bloqueado/" . $promocao[0]->Id_int);
        }

        if ($this->model_hiperofertas->verifica_promocao_encerrada($promocao)) {
            redirect($this->app->Url_cliente . $this->namespace_empresa . "/encerrada/" . $promocao[0]->Id_int);
        }

        if ($this->model_hiperofertas->verifica_promocao_nao_iniciada($promocao)) {
            redirect($this->app->Url_cliente . $this->namespace_empresa . "/aguarde/" . $promocao[0]->Id_int);
        }
//        if ($this->model_hiperofertas->verifica_sexo_invalido($this->user_profile, $promocao)) {
//            redirect($this->app->Url_cliente . $this->namespace_empresa . "/sexo_invalido/" . $promocao[0]->Id_int);
//        }
    }

    function carrega_bloco_formulario() {

        if ($this->promocao[0]->Bloco_formulario_txf == 'padrao') {
            $this->model_smarty->carrega_tpl_modulo($this->app->Template_txf, 'formularios', 'padrao', 'formulario');
        } else {
            $this->model_smarty->carrega_tpl_modulo($this->app->Template_txf, 'formularios/' . $this->namespace_empresa, $this->promocao[0]->Bloco_formulario_txf, 'formulario');
        }
    }

    function enviar() {
        $this->conecta_mbc($this->app->Conexoes_for);
        $segmento = (int) $this->app->Segmento_padrao_txf;
        $segmento = $segmento + 1;
        switch ($this->uri->segment($segmento)) {
            case 'inscricao':

                $this->atualiza_usuario();

                $this->namespace_empresa = $_POST['Namespace_empresa_txf'];
                $this->namespace_promocao = $_POST['Namespace_promocao_txf'];
                $promocao = $this->mbc->buscar_completo("promocoes", "where Namespace_empresa_sel='{$this->namespace_empresa}' and Namespace_promocao_txf='{$this->namespace_promocao}'");
//$_POST['Destinatario_txf']=$this->
                $id_promocao = $promocao[0]->Id_int;
                $this->carrega_model('model_hiperofertas');
                $this->model_hiperofertas->inicializa($promocao);
//                        if(!$this->admin){
                if ($this->model_hiperofertas->verifica_promocao_encerrada($promocao)) {
                    redirect($this->app->Url_cliente . $this->namespace_empresa . '/encerrada/' . $id_promocao);
                }
//                        }
                $inseriu = $this->model_hiperofertas->insere_inscricao();
                $this->smarty->assign('promocao_inscricao', $promocao);
                if ($inseriu['resultado'] == 'ok') {
                    $this->load->model('model_formulario');
                    $this->model_formulario->envia_formulario($this->app, 'email_inscricao');

                    redirect($this->app->Url_cliente . $this->namespace_empresa . '/sucesso/' . $id_promocao);
                } else {
                    if ($inseriu['resultado'] == 'erro') {
                        redirect($this->app->Url_cliente . $this->namespace_empresa . '/erro/' . $id_promocao);
                    }
                    if ($inseriu['resultado'] == 'duplicado') {
                        redirect($this->app->Url_cliente . $this->namespace_empresa . '/duplicado/' . $id_promocao);
                    }
                    if ($inseriu['resultado'] == 'bloqueado') {
                        redirect($this->app->Url_cliente . $this->namespace_empresa . '/bloqueado/' . $id_promocao);
                    }
                }
                break;
            case 'troca_status':
                $id_promocao = $_POST['Id_promocao'];
                $promocao = $this->mbc->buscar_completo("promocoes", "where Id_int={$id_promocao}");
                $this->namespace_empresa = $promocao[0]->Namespace_empresa_sel;

                $this->carrega_model('model_hiperofertas');
                $this->model_hiperofertas->inicializa($promocao);
                $this->model_hiperofertas->atualiza_registro();
                redirect($this->app->Url_cliente . $this->namespace_empresa . '/inscricoes/' . $id_promocao);
                break;
            case 'cancelar_inscricao':
                $id_inscricao = $_POST['Id_inscricao'];
                $inscricao = $this->mbc->buscar_completo("inscricoes", "where Id_int={$id_inscricao}");
                $id_promocao = $_POST['Id_promocao'];
                $promocao = $this->mbc->buscar_completo("promocoes", "where Id_int={$id_promocao}");
                $this->smarty->assign('inscricao', $inscricao);
                $this->smarty->assign('promocao', $promocao);
                $this->load->model('model_formulario');

                // deleta registro

                if ($this->mbc->db_delete('inscricoes', 'Id_int', $id_inscricao)) {

                    $this->model_formulario->envia_formulario($this->app, 'email_cancelamento');
                }
                redirect($this->app->Url_cliente . 'minhas_ofertas');
                break;


            case 'obs':

                $id_promocao = $_POST['Id_promocao'];
                $promocao = $this->mbc->buscar_completo("promocoes", "where Id_int={$id_promocao}");
                $this->namespace_empresa = $promocao[0]->Namespace_empresa_sel;

                $this->conecta_mbc($this->app->Conexoes_for);
                if ($_POST['Id_observacao']) {
                    //atualiza
                    $id_observacao = $_POST['Id_observacao'];
                    $this->mbc->updateTable('acessos_obs', $_POST, 'Id_int', $id_observacao);
                } else {
                    //insere
                    $this->mbc->db_insert('acessos_obs', $_POST);
                }

                redirect($this->app->Url_cliente . $this->namespace_empresa . '/lista_acessos/' . $_POST['Id_promocao']);
                break;

            case 'sorteio':
                
                $id_promocao = $_POST['Id_promocao'];
                $promocao = $this->mbc->buscar_completo("promocoes", "where Id_int={$id_promocao}");
                $this->namespace_empresa = $promocao[0]->Namespace_empresa_sel;
                $this->promocao = $promocao[0];
                $sql = "select *, Id_int as Inscricao_int from inscricoes 
                              where Namespace_empresa_txf='{$this->promocao->Namespace_empresa_sel}' 
                              and Namespace_promocao_txf='{$this->promocao->Namespace_promocao_txf}' 
                              and Id_int NOT IN 
                              ( select Inscricao_int from sorteios 
                              where Namespace_empresa_txf='{$this->promocao->Namespace_empresa_sel}'  
                              and Namespace_promocao_txf='{$this->promocao->Namespace_promocao_txf}' ) order by RAND() limit 1";


                $inscricoes = $this->mbc->executa_sql($sql);

                if (!$inscricoes[0]) {
                    die('Todos os inscritos ja foram sorteados;');
                }

                $this->insere_registro('sorteios', $inscricoes[0]);

                redirect($this->app->Url_cliente . $this->namespace_empresa . '/inscricoes_sorteio/' . $id_promocao);
                break;

            case 'troca_status_sorteio':
                $id_promocao = $_POST['Id_promocao'];
                $promocao = $this->mbc->buscar_completo("promocoes", "where Id_int = {$id_promocao}");
                $this->namespace_empresa = $promocao[0]->Namespace_empresa_sel;

                $this->carrega_model('model_hiperofertas');

                $this->model_hiperofertas->inicializa($promocao);
                $this->model_hiperofertas->atualiza_registro();
                redirect($this->app->Url_cliente . $this->namespace_empresa . '/inscricoes_sorteio/' . $id_promocao);
                break;
            case 'altera_registro':
                $this->altera_registro();
//                        redirect($this->app->Url_cliente . $this->namespace_empresa . '/inscricoes/' . $id_promocao);
                break;

  case 'minha_conta':

                $id = $_POST['Id_int'];

                if ($this->mbc->updateTable('usuarios', $_POST, 'Id_int', $id)) {
                    $this->smarty->assign('mensagem', 'atualizacao_ok');
                    $this->model_smarty->render_ajax('mensagens_cadastro', $this->app->Template_txf);
                    die();
                } else {
                    $this->smarty->assign('mensagem', 'atualizacao_erro');
                    $this->model_smarty->render_ajax('mensagens_cadastro', $this->app->Template_txf);
                    die();
                }


                break;

            case 'altera_usuario':
                $this->conecta_mbc($this->app->Conexoes_for);
                $this->altera_registro();
                $id = $_POST['Id_int'];
                $sql = "select * from usuarios where Id_int = {$id}";
                $this->configura_usuario();
                break;
            case 'download':
                $this->conecta_mbc($this->app->Conexoes_for);
                if (!$_POST['Id_int']) {
                    die('Acesso invalido');
                }
                $id = $_POST['Id_int'];
                $promocao = $this->mbc->buscar_completo("promocoes", "where Id_int = {$id}");
                $arquivo = $promocao[0]->Arquivos[0];

                $link = $this->app->Pasta_painel;
                $link.=$arquivo->Caminho_txf;
                redirect($link);
                die();
                break;

            default:
                break;
        }
    }

    function altera_registro() {
        $this->carrega_model('model_hiperofertas');
//            $this->model_hiperofertas->inicializa($promocao);
        if ($this->model_hiperofertas->atualiza_registro()) {
            $this->smarty->assign('mensagem', 'atualizacao_ok');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
        } else {
            $this->smarty->assign('mensagem', 'atualizacao_erro');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
        }
    }

    function grava_log_acesso($pagina = null) {
        //    if ($_SERVER['REMOTE_ADDR'] != IP_LANDS) {
        $array['Facebook_id_txf'] = $this->fbuser;
        $array['Nome_txf'] = $this->fb_name;
        if (!isset($pagina)) {
            $array['Pagina_txf'] = $this->pagina_atual;
        } else {
            $array['Pagina_txf'] = $pagina;
        }
        $array['Namespace_empresa_txf'] = $this->namespace_empresa;
        $array['Namespace_promocao_txf'] = $this->namespace_promocao;
        if (isset($this->promocao)) {
            $array['Id_promocao_txf'] = $this->promocao->Id_int;
        }

        $hora = date('H');
        $hora = $hora + 5;
        $dia = date('Y-m-d');
        $hora = $hora . date(':i:s');
        $array['Data_dat'] = $dia;
        $array['Data_hora_dat'] = $dia . ' ' . $hora;
        $this->mbc->db_insert('acessos', $array);
    }

}

