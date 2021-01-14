<?phpif (!defined('BASEPATH'))      exit('No direct script access allowed');require_once(COMMONPATH . 'core/lands_labcloud.php');class labcloud extends lands_labcloud {      public function __construct() {            parent::__construct();            $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);            $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);      }      function index() {            if (!method_exists(__CLASS__, $this->pagina_atual)) {                  $this->carrega_pagina($this->pagina_atual);            } else {                  $funcao_atual = $this->pagina_atual;//executa uma funcao que deve ser programa nesta classe.                  $this->$funcao_atual();            }      }      function switch_pagina() {            $this->conecta_mbc($this->app->Conexoes_for);            $this->busca_usuario();            if($this->usuario){                  $this->carrega_empresa($this->usuario->Namespace_empresa_sel);            }                                switch ($this->pagina_atual) {                  case 'inicio':                        break;                  case 'sobre':                        break;                  case 'tutorial':                        break;                  case 'meus_dados':                        $this->carrega_empresa($this->usuario->Namespace_empresa_sel);                        break;                  case 'acesso_invalido':                        break;                  case 'acesso_negado':                        break;                  case 'acesso_negado_admin':                        break;                  case 'admin':                        $this->carrega_namespace_empresa_admin();                        break;                  default:                        $this->carrega_namespace_empresa();                        break;            }            $this->model_smarty->carrega_bloco('navegacao', 'navegacao', $this->app->Template_txf);      }      function switch_pagina_admin($pagina) {            $this->smarty->assign('pagina_atual', $pagina);//     ver($this->usuario);            switch ($pagina) {                  case 'principal_admin':                        break;                  case 'admin_exames':                        $sql = "select * from exames_categorias where Namespace_empresa_sel='{$this->namespace_empresa}'  order by Categoria_txf";                        $exames_categorias = $this->mbc->executa_sql($sql);                        $this->smarty->assign('exames_categorias', $exames_categorias);                        $categoria = $this->uri->segment($this->app->Segmento_padrao_txf + 2);                        if ($categoria) {                              $and = " and Categoria_sel='{$categoria}'";                        } else {                              $and = '';                        }                        $exames = $this->mbc->executa_sql("select * from exames where Namespace_empresa_sel='{$this->namespace_empresa}'  $and");                        $this->smarty->assign('exames', $exames);                        break;                  case 'admin_configs_empresa':                        $temas = $this->mbc->buscar_completo("temas", "where Ativo_sel='SIM' order by Nome_txf");                        $this->smarty->assign('temas', $temas);                        $registro = $this->mbc->executa_sql("select * from empresas_configs where Namespace_empresa_sel='{$this->namespace_empresa}' ");                        $this->smarty->assign('registro', $registro[0]);                        $this->model_smarty->carrega_tpl_modulo($this->app->Template_txf, 'forms', $pagina, $pagina);                        break;                  default:                        die("pagina {$pagina} nao encontrada");                        break;            }      }      function switch_pagina_empresa($pagina) {            $this->smarty->assign('pagina_atual', $pagina);               $this->configura_usuario();            $this->checa_ativacao_usuario();            $this->verifica_autorizacao_modulo($pagina);            switch ($pagina) {                  case 'principal':                        break;                  case 'resultados':                        if (!$this->conecta_ftp($this->configuracoes_empresa)) {                              $this->smarty->assign('mensagem', 'ftp_erro');                              die('Erro de conexao');                              $this->model_smarty->render_ajax('msg_login', $this->app->Template_txf);                              die();                        }                        $pasta = $this->usuario->Usuario_txf . '-' . $this->usuario->Senha_txf;                        $pasta = $this->configuracoes_empresa->Ftp_path_txf . $pasta;//$list = $this->ftp->list_files($pasta);// $list = $this->ftp->get_filelist($pasta);                        $list = $this->ftp->lista_detalhada($pasta);                        $this->smarty->assign('resultados', $list);                        break;                  case 'exames':                        $sql = "select * from exames_categorias where Namespace_empresa_sel='{$this->namespace_empresa}' and Ativo_sel='SIM' order by Categoria_txf";                        $exames_categorias = $this->mbc->executa_sql($sql);                        $this->smarty->assign('exames_categorias', $exames_categorias);                        $categoria = $this->uri->segment($this->app->Segmento_padrao_txf + 2);                        if ($categoria) {                              $and = " and Categoria_sel='{$categoria}'";                        } else {                              $and = '';                        }                        $exames = $this->mbc->executa_sql("select * from exames where Namespace_empresa_sel='{$this->namespace_empresa}' and Ativo_sel='SIM' $and");                        $this->smarty->assign('exames', $exames);                        $this->model_smarty->carrega_bloco('exames_categorias', 'exames_categorias', $this->app->Template_txf);                        $this->model_smarty->carrega_bloco('exames_lista', 'exames_lista', $this->app->Template_txf);                        break;                  case 'filtro_exames':                        $valor = $_POST['busca'];                        $sql = "SELECT * FROM exames a  WHERE Namespace_empresa_sel='{$this->namespace_empresa}'                              and ((a.Categoria_sel LIKE '%$valor%')  OR (a.Exame_txf LIKE '%$valor%')    ) ";                        $exames = $this->mbc->executa_sql($sql);                        $this->smarty->assign('exames', $exames);                        $this->model_smarty->render_bloco('exames_lista', $this->app->Template_txf);                        die();                        break;            }            $this->grava_log_acesso();      }      function enviar() {            $this->conecta_mbc($this->app->Conexoes_for);            $this->configura_usuario();            $this->carrega_empresa($this->usuario->Namespace_empresa_sel);            $segmento = (int) $this->app->Segmento_padrao_txf;            $segmento = $segmento + 1;            $pagina = $this->uri->segment($segmento);            switch ($pagina) {                  case 'login':                        break;                  case 'altera_registro':                        $this->altera_registro();                        break;                  case 'cadastro':                        if (!isset($_POST['Id_int'])) {                              die('Id_int nao encontrado');                        }                        $id = $_POST['Id_int'];                        $tabela = 'usuarios';//verifica se a tabela existe                        if (!$this->mbc->tabelaexiste($tabela)) {                              $this->smarty->assign('tabela', $tabela);                              die('tabela nao existe');                        }//edita registro                        if ($this->mbc->updateTable($tabela, $_POST, 'Id_int', $id)) {                              $this->smarty->assign('mensagem', 'edicao_ok');                              $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);                              die();//envia email                        } else {                              $this->smarty->assign('mensagem', 'edicao_erro');                              $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);                              die();                        }                  case 'admin_exames':                        $this->altera_insere_registro();                        break;                  case 'admin_configs_empresa':                        $this->altera_insere_registro();                        redireciona($this->app->Url_cliente . 'admin');                        break;                  case 'padrao':                        $this->altera_insere_registro();                        break;                  case 'excluir':                        $this->exclui_registro();                        break;                  default:                        break;            }      }      function ajax() {            $this->conecta_mbc($this->app->Conexoes_for);            $this->configura_usuario();            $this->carrega_empresa($this->usuario->Namespace_empresa_sel);            $segmento = (int) $this->app->Segmento_padrao_txf;            $segmento = $segmento + 1;            $pagina = $this->uri->segment($segmento);            switch ($pagina) {                  case 'admin_exames':                            $sql = "select * from {$_POST['Tabela_txf']} where Id_int='{$_POST['Id_int']}'";                        $registro = $this->mbc->executa_sql($sql);                        $this->smarty->assign("registro", $registro[0]);                        $sql = "select * from exames_categorias where Namespace_empresa_sel='{$this->namespace_empresa}' and Ativo_sel='SIM' order by Categoria_txf";                        $exames_categorias = $this->mbc->executa_sql($sql);                        $this->smarty->assign('exames_categorias', $exames_categorias);                        echo $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, 'forms', $pagina);                        die();                        break;                  case 'excluir':                                                echo $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, 'forms', $pagina);                        die();                        break;                  default:                        break;            }      }}?>