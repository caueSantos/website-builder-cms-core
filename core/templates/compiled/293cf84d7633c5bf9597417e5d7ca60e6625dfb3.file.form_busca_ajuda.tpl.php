<?php /* Smarty version Smarty-3.1.12, created on 2021-01-26 03:28:47
         compiled from "core\templates\producao\hubvet\site\blocos\ajuda\form_busca_ajuda.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24986600fa88f015643-53103308%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '293cf84d7633c5bf9597417e5d7ca60e6625dfb3' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\ajuda\\form_busca_ajuda.tpl',
      1 => 1611635582,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24986600fa88f015643-53103308',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url_principal' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_600fa88f01b570_34043936',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_600fa88f01b570_34043936')) {function content_600fa88f01b570_34043936($_smarty_tpl) {?><form
  autocomplete="off"
  class="busca form-busca"
  method="POST"
  action="<?php echo $_smarty_tpl->tpl_vars['url_principal']->value;?>
busca"
  data-tpl="mini"
  data-autocomplete="#retorno-personalizado-topo"
>

  <div class="form-lands-group form-autocomplete mb-0">
    <input
      name="valor"
      autocomplete="off"
      class="form-lands form-outline form-dark mb-0"
      type="text"
      placeholder="<?php echo trans('ajuda_form_busca');?>
"
    />
    <input type="hidden" name="Tabelas_txf" value="ajuda">
    <input type="hidden" name="Campos_txf" value="Nome_txf,Link_txf,Descricao_txf">
    <div id="retorno-personalizado-topo" class="form-lands-autocomplete br-1"
         style="display: none; max-height: 300px; overflow-y: auto"></div>
  </div>

</form>

<?php }} ?>