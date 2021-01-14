<?php /* Smarty version Smarty-3.1.12, created on 2020-10-21 22:59:35
         compiled from "core\templates\producao\vet_life\site\blocos\global\redes_sociais_lista.tpl" */ ?>
<?php /*%%SmartyHeaderCode:277935f90d9771ef628-76669484%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cb5b0436e4f0a4d999be44dfa91f9c775220e0d6' => 
    array (
      0 => 'core\\templates\\producao\\vet_life\\site\\blocos\\global\\redes_sociais_lista.tpl',
      1 => 1600061538,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '277935f90d9771ef628-76669484',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'mostra_contato' => 0,
    'redes_sociais' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f90d977239be3_66691856',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f90d977239be3_66691856')) {function content_5f90d977239be3_66691856($_smarty_tpl) {?><div class="redes-sociais">  <ul class="horizontal-list d-inline-block">    <?php if (!$_smarty_tpl->tpl_vars['mostra_contato']->value){?>    <?php if ($_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Facebook_txf){?>    <li>      <a target="_blank" title="Acesse nosso Facebook" href="<?php echo $_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Facebook_txf;?>
">        <i class="fab fa-facebook"></i>      </a>    </li>    <?php }?>    <?php if ($_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Twitter_txf){?>    <li>      <a target="_blank" title="Acesse nosso Twitter" href="<?php echo $_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Twitter_txf;?>
">        <i class="fab fa-twitter"></i>      </a>    </li>    <?php }?>    <?php if ($_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Linkedin_txf){?>    <li>      <a target="_blank" title="Acesse nosso Linkedin" href="<?php echo $_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Linkedin_txf;?>
">        <i class="fab fa-linkedin"></i>      </a>    </li>    <?php }?>    <?php if ($_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Instagram_txf){?>    <li>      <a target="_blank" title="Acesse nosso Instagram" href="<?php echo $_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Instagram_txf;?>
">        <i class="fab fa-instagram"></i>      </a>    </li>    <?php }?>    <?php if ($_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Pinterest_txf){?>    <li>      <a target="_blank" title="Acesse nosso Pinterest" href="<?php echo $_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Pinterest_txf;?>
">        <i class="fab fa-pinterest"></i>      </a>    </li>    <?php }?>    <?php if ($_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Youtube_txf){?>    <li>      <a target="_blank" title="Acesse nosso Youtube" href="<?php echo $_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Youtube_txf;?>
">        <i class="fab fa-youtube"></i>      </a>    </li>    <?php }?>    <?php if ($_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Telegram_txf){?>    <li>      <a target="_blank" title="Acesse nosso Telegram" href="<?php echo $_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Telegram_txf;?>
">        <i class="fab fa-telegram-plane"></i>      </a>    </li>    <?php }?>    <?php }?>    <?php if ($_smarty_tpl->tpl_vars['mostra_contato']->value){?>    <?php if ($_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Whatsapp_txf){?>    <li>      <a target="_blank" title="Converse conosco via whatsapp" href="<?php echo $_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Whatsapp_txf;?>
">        <i style="color: #25D366" class="fz-30 fab fa-whatsapp"></i>      </a>    </li>    <?php }?>    <?php if ($_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Skype_txf){?>    <li>      <a target="_blank" title="Converse conosco via skype" href="<?php echo $_smarty_tpl->tpl_vars['redes_sociais']->value[0]->Skype_txf;?>
">        <i style="color: #00AFF0" class="fz-30 fab fa-skype"></i>      </a>    </li>    <?php }?>    <?php }?>  </ul></div><?php }} ?>