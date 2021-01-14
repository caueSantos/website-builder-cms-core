<?php /* Smarty version Smarty-3.1.12, created on 2020-11-07 06:26:51
         compiled from "core\templates\producao\zehimoveis\site\blocos\empreendimentos\form-interessado.tpl" */ ?>
<?php /*%%SmartyHeaderCode:204695fa65a4b5e0901-22267363%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0a25f366a608cf1b481230f22631c540d588f707' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\blocos\\empreendimentos\\form-interessado.tpl',
      1 => 1604626071,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '204695fa65a4b5e0901-22267363',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'titulos' => 0,
    'tipo_contato' => 0,
    'emails' => 0,
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fa65a4b5f91d4_07223423',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fa65a4b5f91d4_07223423')) {function content_5fa65a4b5f91d4_07223423($_smarty_tpl) {?><section class="pt-50 pt-md-90">  <div class="container text-center">    <div class="row justify-content-center">      <div class="col-md-5">        <div class="title-group">          <h1 class="title text-body-quaternary fz-32 lh-12 fw-700">            <?php echo titulo('entre_contato_simples','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
          </h1>          <?php if (titulo('entre_contato_simples','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>          <div class="texto fz-16 mt-10 lh-15">            <?php echo titulo('entre_contato_simples','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
          </div>          <?php }?>        </div>        <div class="mt-40">          <form class="form-contato" onsubmit="return false">            <div class="form-lands-group">              <input placeholder="Digite seu nome" class="form-lands" name="Nome_txf" type="text" required/>            </div>            <div class="form-lands-group">              <input placeholder="Digite seu email*" class="form-lands" name="Email_txf" type="text" required/>            </div>            <div class="form-lands-group">              <input placeholder="Digite seu telefone*" class="form-lands phone-mask" name="Telefone_txf" type="text" required/>            </div>            <div class="form-lands-group">    <textarea style="min-height: 140px;" placeholder="Digite sua mensagem" name="Mensagem_txa"              class="form-lands"></textarea>            </div>            <input name="Tipo_contato_txf" type="hidden" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['tipo_contato']->value)===null||$tmp==='' ? 'CONTATO' : $tmp);?>
"/>            <input name="Destinatario_txf" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['emails']->value[0]->Email_txf;?>
"/>            <input id='lands_id' value="<?php echo $_smarty_tpl->tpl_vars['app']->value->Lands_id;?>
" name="Lands_id" type="hidden"/>            <button class="btn-lands btn-secondary btn-block" type="submit">              Enviar mensagem            </button>          </form>        </div>      </div>    </div>  </div></section><?php }} ?>