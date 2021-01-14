<?php /* Smarty version Smarty-3.1.12, created on 2020-12-12 13:52:43
         compiled from "core\templates\producao\hubvet\site\blocos\global\entre-contato-simples.tpl" */ ?>
<?php /*%%SmartyHeaderCode:221725fd4e74b3d62b9-88503152%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cf36ad0d1693d88aab3432fde380ee15db7d5a35' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\global\\entre-contato-simples.tpl',
      1 => 1605585607,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '221725fd4e74b3d62b9-88503152',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'imovel' => 0,
    'empreendimento' => 0,
    'titulos' => 0,
    'tipo' => 0,
    'app' => 0,
    'emails' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fd4e74b3fbf15_22893860',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd4e74b3fbf15_22893860')) {function content_5fd4e74b3fbf15_22893860($_smarty_tpl) {?><?php if (!$_smarty_tpl->tpl_vars['imovel']->value){?><?php $_smarty_tpl->tpl_vars['imovel'] = new Smarty_variable($_smarty_tpl->tpl_vars['empreendimento']->value, null, 0);?><?php $_smarty_tpl->tpl_vars['tipo'] = new Smarty_variable('EMPREENDIMENTO', null, 0);?><?php }?><aside class="interessado-imovel">  <form class="form-interessado-imovel" onsubmit="return false;">    <div class="row justify-content-center">      <div class="col-12 col-lg-10 col-txt">        <div class="title-group">          <h1 class="title text-body-quaternary fz-24 lh-12 fw-700">            <?php echo titulo('entre_contato_simples','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
          </h1>          <?php if (titulo('entre_contato_simples','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>          <div class="texto fz-16 mt-10 lh-15">            <?php echo titulo('entre_contato_simples','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
          </div>          <?php }?>        </div>        <div class="row justify-content-center mt-30">          <div class="col-12">            <input              type="text" class="form-lands" name="Nome_txf"              placeholder="Digite seu nome*"              required            />          </div>          <div class="col-12">            <input              type="email" class="form-lands" name="Email_txf"              placeholder="Digite seu e-mail*"              required            />          </div>          <div class="col-12">            <input value="<?php if ($_smarty_tpl->tpl_vars['tipo']->value){?><?php echo $_smarty_tpl->tpl_vars['tipo']->value;?>
<?php }else{ ?>IMOVEL<?php }?>" name="Tipo_txf" type="hidden"/>            <input value="<?php echo $_smarty_tpl->tpl_vars['imovel']->value->Nome_tit;?>
" name="Imovel_txf" type="hidden"/>            <input value="<?php echo $_smarty_tpl->tpl_vars['app']->value->Lands_id;?>
" name="Lands_id" type="hidden"/>            <input value="imovel-interesse" name="Tpl_txf" type="hidden"/>            <input type="hidden" value="SIM" name="Envia_email_txf"/>            <input type="hidden" name="Titulo_txf" value="Zeh Imóveis - Você está interessado no imóvel <?php echo $_smarty_tpl->tpl_vars['imovel']->value->Nome_tit;?>
!"/>            <input value="Zeh Imóveis - Você está interessado no imóvel <?php echo $_smarty_tpl->tpl_vars['imovel']->value->Nome_tit;?>
!" name="Assunto_txf" type="hidden"/>            <input type="hidden" name="Destinatario_txf" value="<?php echo $_smarty_tpl->tpl_vars['emails']->value[0]->Email_txf;?>
"/>            <input type="hidden" value="_imovel_interesse" name="Tabela_txf"/>            <input type="hidden" value="SIM" name="Permite_duplo_cadastro_txf"/>            <button type="submit" class="btn-lands btn-secondary btn-block">Enviar</button>          </div>          <div class="col-12 text-center">            <div class="pt-15 pb-15">Ou</div>            <button type="button" class="btn-lands btn-primary btn-outline bs-0 pl-10 pr-10 btn-block"                    onclick="document.querySelector('.lands-whatsapp-fab').click()">              <i class="fab fa-whatsapp va-middle fz-18"></i>              <span class="pl-10 va-middle">                Entre em contato pelo WhatsApp              </span>            </button>          </div>        </div>      </div>    </div>  </form></aside><?php }} ?>