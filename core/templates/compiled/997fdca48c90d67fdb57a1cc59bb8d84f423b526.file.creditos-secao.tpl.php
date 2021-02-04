<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 02:57:36
         compiled from "core\templates\producao\hubvet\site\blocos\global\creditos-secao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9159601b7ec0b1df90-88516895%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '997fdca48c90d67fdb57a1cc59bb8d84f423b526' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\global\\creditos-secao.tpl',
      1 => 1610319343,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9159601b7ec0b1df90-88516895',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'creditos_secao' => 0,
    'credito' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b7ec0b40b88_17765661',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b7ec0b40b88_17765661')) {function content_601b7ec0b40b88_17765661($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['creditos_secao']->value[0]){?><?php $_smarty_tpl->tpl_vars['credito'] = new Smarty_variable($_smarty_tpl->tpl_vars['creditos_secao']->value[0], null, 0);?><section class="creditos-secao bg-primary text-white pt-40 pb-40 pt-md-70 pb-md-80">  <div class="container">    <div class="row justify-content-center">      <div class="col-12 col-md-8">        <div class="text-center">          <h1 class="title fw-700 fz-34">            <?php echo $_smarty_tpl->tpl_vars['credito']->value->Titulo_txf;?>
          </h1>          <div class="texto lh-18 fz-16 mt-15">            <?php echo $_smarty_tpl->tpl_vars['credito']->value->Texto_txa;?>
          </div>          <?php if (is_url($_smarty_tpl->tpl_vars['credito']->value->Botao_link_txf)&&$_smarty_tpl->tpl_vars['credito']->value->Botao_texto_txf){?>          <div class="botao mt-40">            <a target="_blank" class="btn-lands btn-accent" href="<?php echo gera_link($_smarty_tpl->tpl_vars['credito']->value->Botao_link_txf,true);?>
">              <?php echo $_smarty_tpl->tpl_vars['credito']->value->Botao_texto_txf;?>
            </a>          </div>          <?php }?>        </div>      </div>    </div>  </div></section><?php }?><?php }} ?>