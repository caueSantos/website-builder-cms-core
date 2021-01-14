<?php /* Smarty version Smarty-3.1.12, created on 2020-12-11 00:54:02
         compiled from "core\templates\producao\zehimoveis\site\blocos\imoveis\imovel-item.tpl" */ ?>
<?php /*%%SmartyHeaderCode:58575fd2df4a35b097-35483196%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '63ad53c87c761f89a70b3eb9f5869beea8a28bab' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\blocos\\imoveis\\imovel-item.tpl',
      1 => 1604744353,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '58575fd2df4a35b097-35483196',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
    'imovel' => 0,
    'painel' => 0,
    'caracteristica' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fd2df4a395aa9_34463285',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd2df4a395aa9_34463285')) {function content_5fd2df4a395aa9_34463285($_smarty_tpl) {?><article class="imovel-item">

  <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
imoveis/<?php echo $_smarty_tpl->tpl_vars['imovel']->value->Nome_url;?>
"
     class="text-body-primary hover hover-scale-up hover-shadow d-block br-1 overflow-hidden"
     style="border: 1px solid #F0F0F8;">

    <div class="aspect aspect-4-3 overflow-hidden bg-body-light">
      <figure class="aspect-item">
        <img
          class="img-fit"
          src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['imovel']->value->Imagens[0]->Caminho_txf;?>
"
          alt="<?php echo strip_tags($_smarty_tpl->tpl_vars['imovel']->value->Nome_tit);?>
"
        />
      </figure>
    </div>

    <div class="pl-25 pr-25 pt-35 <?php if ($_smarty_tpl->tpl_vars['imovel']->value->Caracteristicas_vin){?>pb-20<?php }else{ ?>pb-35<?php }?>">

      <div class="title fz-18 fw-700 text-body-secondary" data-clamp="1">
        <?php echo $_smarty_tpl->tpl_vars['imovel']->value->Nome_tit;?>

      </div>

      <?php if ($_smarty_tpl->tpl_vars['imovel']->value->Nome_tit){?>
      <div class="desc mt-20" data-clamp="3">
        <?php echo corta_texto($_smarty_tpl->tpl_vars['imovel']->value->Descricao_txa,300,'...');?>

      </div>
      <?php }?>

      <?php if ($_smarty_tpl->tpl_vars['imovel']->value->Caracteristicas_vin){?>
      <div class="caracteristicas mt-30">
        <div class="row">
          <?php  $_smarty_tpl->tpl_vars['caracteristica'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['caracteristica']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['imovel']->value->Caracteristicas_vin; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['caracteristica']->key => $_smarty_tpl->tpl_vars['caracteristica']->value){
$_smarty_tpl->tpl_vars['caracteristica']->_loop = true;
?>
          <div class="col-12 col-lg-6 mb-15" title="<?php echo strip_tags($_smarty_tpl->tpl_vars['caracteristica']->value->Nome_tit);?>
">

            <div class="d-flex fill-height">

              <?php if ($_smarty_tpl->tpl_vars['caracteristica']->value->Imagens[0]){?>
              <div class="align-self-center mr-10" style="width: 24px;">
                <img style="width: auto; height: auto" src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['caracteristica']->value->Imagens[0]->Caminho_txf;?>
"
                     class="mx-auto pe-none d-block"/>
              </div>
              <?php }?>
              <div class="align-self-center fw-700 fz-14 lh-12">
                <?php echo $_smarty_tpl->tpl_vars['caracteristica']->value->Valor_min_txf;?>

                <?php if ($_smarty_tpl->tpl_vars['caracteristica']->value->Valor_max_txf){?>
                a <?php echo $_smarty_tpl->tpl_vars['caracteristica']->value->Valor_max_txf;?>

                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['caracteristica']->value->Sufixo_txf){?>
                <?php echo $_smarty_tpl->tpl_vars['caracteristica']->value->Sufixo_txf;?>

                <?php }?>
              </div>

            </div>

          </div>
          <?php } ?>
        </div>
      </div>
      <?php }?>

    </div>

  </a>

</article>
<?php }} ?>