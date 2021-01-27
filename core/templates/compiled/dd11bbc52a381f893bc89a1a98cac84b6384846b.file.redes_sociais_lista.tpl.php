<?php /* Smarty version Smarty-3.1.12, created on 2021-01-26 17:49:42
         compiled from "core\templates\producao\hubvet\site\blocos\global\redes_sociais_lista.tpl" */ ?>
<?php /*%%SmartyHeaderCode:247776010725695a803-72619664%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dd11bbc52a381f893bc89a1a98cac84b6384846b' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\global\\redes_sociais_lista.tpl',
      1 => 1604377159,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '247776010725695a803-72619664',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'mostra_label' => 0,
    'vertical' => 0,
    'mostra_contato' => 0,
    'redes_sociais' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601072569d3575_98401080',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601072569d3575_98401080')) {function content_601072569d3575_98401080($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['mostra_label'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['mostra_label']->value)===null||$tmp==='' ? false : $tmp), null, 0);?><div class="redes-sociais">  <ul class="<?php if ($_smarty_tpl->tpl_vars['vertical']->value){?>vertical-list d-block<?php }else{ ?>horizontal-list d-inline-block<?php }?>">    <?php if (!$_smarty_tpl->tpl_vars['mostra_contato']->value){?>    <?php if ($_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Facebook_txf){?>    <li>      <a target="_blank" title="Acesse nosso Facebook" href="<?php echo $_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Facebook_txf;?>
">        <i class="fab fa-facebook"></i>        <?php if ($_smarty_tpl->tpl_vars['mostra_label']->value){?><span class="pl-10">Facebook</span><?php }?>      </a>    </li>    <?php }?>    <?php if ($_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Twitter_txf){?>    <li>      <a target="_blank" title="Acesse nosso Twitter" href="<?php echo $_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Twitter_txf;?>
">        <i class="fab fa-twitter"></i>        <?php if ($_smarty_tpl->tpl_vars['mostra_label']->value){?><span class="pl-10">Twitter</span><?php }?>      </a>    </li>    <?php }?>    <?php if ($_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Linkedin_txf){?>    <li>      <a target="_blank" title="Acesse nosso Linkedin" href="<?php echo $_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Linkedin_txf;?>
">        <i class="fab fa-linkedin"></i>        <?php if ($_smarty_tpl->tpl_vars['mostra_label']->value){?><span class="pl-10">Linkedin</span><?php }?>      </a>    </li>    <?php }?>    <?php if ($_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Instagram_txf){?>    <li>      <a target="_blank" title="Acesse nosso Instagram" href="<?php echo $_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Instagram_txf;?>
">        <i class="fab fa-instagram"></i>        <?php if ($_smarty_tpl->tpl_vars['mostra_label']->value){?><span class="pl-10">Instagram</span><?php }?>      </a>    </li>    <?php }?>    <?php if ($_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Pinterest_txf){?>    <li>      <a target="_blank" title="Acesse nosso Pinterest" href="<?php echo $_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Pinterest_txf;?>
">        <i class="fab fa-pinterest"></i>        <?php if ($_smarty_tpl->tpl_vars['mostra_label']->value){?><span class="pl-10">Pinterest</span><?php }?>      </a>    </li>    <?php }?>    <?php if ($_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Youtube_txf){?>    <li>      <a target="_blank" title="Acesse nosso Youtube" href="<?php echo $_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Youtube_txf;?>
">        <i class="fab fa-youtube"></i>        <?php if ($_smarty_tpl->tpl_vars['mostra_label']->value){?><span class="pl-10">Youtube</span><?php }?>      </a>    </li>    <?php }?>    <?php if ($_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Telegram_txf){?>    <li>      <a target="_blank" title="Acesse nosso Telegram" href="<?php echo $_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Telegram_txf;?>
">        <i class="fab fa-telegram-plane"></i>        <?php if ($_smarty_tpl->tpl_vars['mostra_label']->value){?><span class="pl-10">Telegram</span><?php }?>      </a>    </li>    <?php }?>    <?php }?>    <?php if ($_smarty_tpl->tpl_vars['mostra_contato']->value){?>    <?php if ($_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Whatsapp_txf){?>    <li>      <a target="_blank" title="Converse conosco via whatsapp" href="<?php echo $_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Whatsapp_txf;?>
">        <i style="color: #25D366" class="fz-30 fab fa-whatsapp"></i>        <?php if ($_smarty_tpl->tpl_vars['mostra_label']->value){?><span class="pl-10">Whatsapp</span><?php }?>      </a>    </li>    <?php }?>    <?php if ($_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Skype_txf){?>    <li>      <a target="_blank" title="Converse conosco via skype" href="<?php echo $_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Skype_txf;?>
">        <i style="color: #00AFF0" class="fz-30 fab fa-skype"></i>        <?php if ($_smarty_tpl->tpl_vars['mostra_label']->value){?><span class="pl-10">Skype</span><?php }?>      </a>    </li>    <?php }?>    <?php }?>  </ul></div><?php }} ?>