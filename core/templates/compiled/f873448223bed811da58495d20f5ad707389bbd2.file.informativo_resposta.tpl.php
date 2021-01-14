<?php /* Smarty version Smarty-3.1.12, created on 2020-11-06 01:12:19
         compiled from "core\templates\producao\zehimoveis\site\ajax\informativo_resposta.tpl" */ ?>
<?php /*%%SmartyHeaderCode:153965fa4bf135c2ab9-33173795%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f873448223bed811da58495d20f5ad707389bbd2' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\ajax\\informativo_resposta.tpl',
      1 => 1584563992,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '153965fa4bf135c2ab9-33173795',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'mensagem' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fa4bf13682a57_05104245',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fa4bf13682a57_05104245')) {function content_5fa4bf13682a57_05104245($_smarty_tpl) {?><div id = "atencao">

    <?php if (($_smarty_tpl->tpl_vars['mensagem']->value['resposta']=='duplicado')){?>
        <script type="text/javascript" charset="utf-8">

            setTimeout(function () {
            swal({ title: "", text: "Email já cadastrado", type: "error" });
    }, 10);
        </script>
    <?php }?>
    <?php if (($_smarty_tpl->tpl_vars['mensagem']->value['resposta']=='ok')){?>
        <script type="text/javascript" charset="utf-8">

            setTimeout(function () {
            swal({ title: "", text: "Email cadastrado com sucesso!", type: "success" });
    }, 10);
        </script>
    <?php }?>
    <?php if ((!$_smarty_tpl->tpl_vars['mensagem']->value)){?>
        <script type="text/javascript" charset="utf-8">

            setTimeout(function () {
            swal({ title: "", text: "Envie um email válido!", type: "error" });
    }, 10);
        </script>
    <?php }?>
    

</div><?php }} ?>