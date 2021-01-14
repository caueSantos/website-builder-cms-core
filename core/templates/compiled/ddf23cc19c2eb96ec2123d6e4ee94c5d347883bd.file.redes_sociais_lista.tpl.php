<?php /* Smarty version Smarty-3.1.12, created on 2020-09-05 15:54:39
         compiled from "core\templates\producao\abseg\site\blocos\global\redes_sociais_lista.tpl" */ ?>
<?php /*%%SmartyHeaderCode:152855f53deeff00119-58688479%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ddf23cc19c2eb96ec2123d6e4ee94c5d347883bd' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\blocos\\global\\redes_sociais_lista.tpl',
      1 => 1593929906,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '152855f53deeff00119-58688479',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'redes_sociais' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f53deeff2af10_71318214',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f53deeff2af10_71318214')) {function content_5f53deeff2af10_71318214($_smarty_tpl) {?><div class="redes-sociais">    <ul class="horizontal-list d-inline-block">        <?php if ($_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Facebook_txf){?>            <li>                <a target="_blank" title="Acesse nosso Facebook" href="<?php echo $_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Facebook_txf;?>
">                    <i class="fab fa-facebook"></i>                </a>            </li>        <?php }?>        <?php if ($_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Twitter_txf){?>            <li>                <a target="_blank" title="Acesse nosso Twitter" href="<?php echo $_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Twitter_txf;?>
">                    <i class="fab fa-twitter"></i>                </a>            </li>        <?php }?>        <?php if ($_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Linkedin_txf){?>            <li>                <a target="_blank" title="Acesse nosso Linkedin" href="<?php echo $_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Linkedin_txf;?>
">                    <i class="fab fa-linkedin"></i>                </a>            </li>        <?php }?>        <?php if ($_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Instagram_txf){?>            <li>                <a target="_blank" title="Acesse nosso Instagram" href="<?php echo $_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Instagram_txf;?>
">                    <i class="fab fa-instagram"></i>                </a>            </li>        <?php }?>        <?php if ($_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Pinterest_txf){?>            <li>                <a target="_blank" title="Acesse nosso Pinterest" href="<?php echo $_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Pinterest_txf;?>
">                    <i class="fab fa-pinterest"></i>                </a>            </li>        <?php }?>        <?php if ($_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Youtube_txf){?>            <li>                <a target="_blank" title="Acesse nosso Youtube" href="<?php echo $_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Youtube_txf;?>
">                    <i class="fab fa-youtube"></i>                </a>            </li>        <?php }?>    </ul></div><?php }} ?>