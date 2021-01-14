<?php /* Smarty version Smarty-3.1.12, created on 2021-01-12 09:40:04
         compiled from "core\templates\producao\hubvet\site\blocos\parceiros\parceiros-lista.tpl" */ ?>
<?php /*%%SmartyHeaderCode:284355ffd8a946d4ba1-06109021%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4360baeee61b42273e3f5e864ce36bb57ffe55b5' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\parceiros\\parceiros-lista.tpl',
      1 => 1610265627,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '284355ffd8a946d4ba1-06109021',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tipo' => 0,
    'parceiros' => 0,
    'titulos' => 0,
    'parceiro' => 0,
    'icone' => 0,
    'painel' => 0,
    'assets' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ffd8a9471b593_84039557',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ffd8a9471b593_84039557')) {function content_5ffd8a9471b593_84039557($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['tipo'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['tipo']->value)===null||$tmp==='' ? 1 : $tmp), null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['parceiros']->value[0]){?>
<section class="parceiros-lista <?php if ($_smarty_tpl->tpl_vars['tipo']->value==1){?>bg-primary<?php }else{ ?>bg-dark-grey<?php }?> pt-40 pb-20 pt-md-70 pb-md-50">

  <div class="container">

    <div class="title-group text-center text-white">
      <h1 class="title fz-40 lh-12 fw-400 <?php if ($_smarty_tpl->tpl_vars['tipo']->value==2){?>text-primary<?php }?>">
        <?php echo titulo('parceiros_secao','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>

      </h1>
      <?php if (titulo('parceiros_secao','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>
      <div class="texto fz-18 mt-15 lh-15">
        <?php echo titulo('parceiros_secao','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>

      </div>
      <?php }?>
    </div>

    <div class="row justify-content-center mt-60">

      <?php  $_smarty_tpl->tpl_vars['parceiro'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['parceiro']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['parceiros']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['parceiro']->key => $_smarty_tpl->tpl_vars['parceiro']->value){
$_smarty_tpl->tpl_vars['parceiro']->_loop = true;
?>
      <?php $_smarty_tpl->tpl_vars['icone'] = new Smarty_variable($_smarty_tpl->tpl_vars['parceiro']->value->Imagens[0], null, 0);?>
      <div class="col-6 col-md-2 pl-15 pr-15 pl-md-25 pr-md-25">
        <a
          href="<?php if ($_smarty_tpl->tpl_vars['parceiro']->value->Link_txf&&is_url($_smarty_tpl->tpl_vars['parceiro']->value->Link_txf)){?><?php echo $_smarty_tpl->tpl_vars['parceiro']->value->Link_txf;?>
<?php }else{ ?>javascript:void(0);<?php }?>"
          class="link-item d-block text-center tn-ease mb-50 hover hover-opacity-reverse"
          title="<?php echo $_smarty_tpl->tpl_vars['parceiro']->value->Nome_txf;?>
"
          target="_blank"
        >
          <div class="mx-auto" style="height: 60px">
            <figure class="imagem" style="height: 60px">
              <?php if ($_smarty_tpl->tpl_vars['icone']->value){?>
              <img style="height: auto; max-height: 60px; width: auto; max-width: 100%;"
                   alt="<?php echo $_smarty_tpl->tpl_vars['parceiro']->value->Nome_txf;?>
" src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['icone']->value->Caminho_txf;?>
"
                   class="align-center"/>
              <?php }else{ ?>
              <img style="height: auto; max-height: 60px; width: auto; max-width: 100%;"
                   class="align-center"
                   alt="<?php echo $_smarty_tpl->tpl_vars['parceiro']->value->Nome_txf;?>
" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/indisponivel-quadrada.png"/>
              <?php }?>
            </figure>
          </div>
        </a>
      </div>
      <?php } ?>

    </div>

  </div>

</section>
<?php }?>
<?php }} ?>