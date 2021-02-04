<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 02:58:44
         compiled from "core\templates\producao\hubvet\site\blocos\inicio\problemas-secao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14011601b7f049b2a08-82323398%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7d2fbc01ec80cecf74f3ec1dbfa3cf235214f825' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\inicio\\problemas-secao.tpl',
      1 => 1609723157,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14011601b7f049b2a08-82323398',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'problemas' => 0,
    'titulos' => 0,
    'problema' => 0,
    'key' => 0,
    'vin_count' => 0,
    'problema_divide' => 0,
    'item' => 0,
    'painel' => 0,
    'banner' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b7f04a10316_60263383',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b7f04a10316_60263383')) {function content_601b7f04a10316_60263383($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['problemas']->value[0]){?>
<section class="problemas pt-40 pt-md-80 pb-md-110 pb-80">

  <div class="container">

    <div class="title-group text-primary text-center">
      <h1 class="title fz-40 lh-12 fw-400">
        <?php echo titulo('problemas_secao','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>

      </h1>
      <?php if (titulo('problemas_secao','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>
      <div class="texto fz-18 mt-10 lh-15">
        <?php echo titulo('problemas_secao','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>

      </div>
      <?php }?>
    </div>

    <div class="row justify-content-center mt-40">

      <div class="col-12">

        <div class="lands-tabs">

          <ul class="nav nav-fill" role="tablist">
            <?php $_smarty_tpl->tpl_vars['key'] = new Smarty_variable(0, null, 0);?>
            <?php  $_smarty_tpl->tpl_vars['problema'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['problema']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['problemas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['problema']->key => $_smarty_tpl->tpl_vars['problema']->value){
$_smarty_tpl->tpl_vars['problema']->_loop = true;
?>
            <?php if ($_smarty_tpl->tpl_vars['problema']->value->Problemas_vin[0]){?>
            <li class="nav-item">
              <a class="<?php if ($_smarty_tpl->tpl_vars['key']->value==0){?>active<?php }?>"
                 id="problema-tab-<?php echo $_smarty_tpl->tpl_vars['problema']->value->Id_int;?>
"
                 data-toggle="tab"
                 href="#problema-<?php echo $_smarty_tpl->tpl_vars['problema']->value->Id_int;?>
"
                 role="tab"
                 aria-controls="home"
                 aria-selected="true"
              >
                <?php echo $_smarty_tpl->tpl_vars['problema']->value->Titulo_txf;?>

              </a>
            </li>
            <?php $_smarty_tpl->tpl_vars['key'] = new Smarty_variable($_smarty_tpl->tpl_vars['key']->value+1, null, 0);?>
            <?php }?>
            <?php } ?>
          </ul>

        </div>

      </div>

      <div class="col-12 col-md-10 mt-40 mt-md-80">
        <div class="tab-content" id="myTabContent">
          <?php $_smarty_tpl->tpl_vars['key'] = new Smarty_variable(0, null, 0);?>
          <?php  $_smarty_tpl->tpl_vars['problema'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['problema']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['problemas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['problema']->key => $_smarty_tpl->tpl_vars['problema']->value){
$_smarty_tpl->tpl_vars['problema']->_loop = true;
?>
          <?php if ($_smarty_tpl->tpl_vars['problema']->value->Problemas_vin[0]){?>
          <div
            class="tab-pane fade show <?php if ($_smarty_tpl->tpl_vars['key']->value==0){?>active<?php }?>"
            id="problema-<?php echo $_smarty_tpl->tpl_vars['problema']->value->Id_int;?>
"
            role="tabpanel"
            aria-labelledby="home-tab"
          >

            <?php $_smarty_tpl->tpl_vars['vin_count'] = new Smarty_variable(ceil(count($_smarty_tpl->tpl_vars['problema']->value->Problemas_vin)/2), null, 0);?>
            <?php $_smarty_tpl->tpl_vars['problema_divide'] = new Smarty_variable(array_chunk($_smarty_tpl->tpl_vars['problema']->value->Problemas_vin,$_smarty_tpl->tpl_vars['vin_count']->value), null, 0);?>

            <div class="row">

              <div class="col-md-4 pl-50">
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['problema_divide']->value[0]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                <div class="d-flex mb-30">
                  <div class="flex-shrink-1 align-items-center d-flex text-success">
                    <i class="fas fa-check-circle"></i>
                  </div>
                  <div class="flex-grow-1 pl-30 fz-14">
                    <?php echo $_smarty_tpl->tpl_vars['item']->value->Texto_txf;?>

                  </div>
                </div>
                <?php } ?>
              </div>

              <div class="col-md-4 d-none d-md-block">
                <?php if ($_smarty_tpl->tpl_vars['problema']->value->Imagens[0]){?>
                <div class="mt-10">
                  <figure class="imagem">
                    <img
                      src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['problema']->value->Imagens[0]->Caminho_txf;?>
"
                      title="<?php echo $_smarty_tpl->tpl_vars['problema']->value->Texto_txf;?>
"
                      alt="<?php echo $_smarty_tpl->tpl_vars['problema']->value->Texto_txf;?>
"
                      class="img-fluid"
                    />
                  </figure>
                </div>
                <?php }?>
              </div>

              <div class="col-md-4 pr-50">
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['problema_divide']->value[1]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                <div class="d-flex mb-30">
                  <div class="flex-shrink-1 align-items-center d-flex text-success">
                    <i class="fas fa-check-circle"></i>
                  </div>
                  <div class="flex-grow-1 pl-30 fz-14">
                    <?php echo $_smarty_tpl->tpl_vars['item']->value->Texto_txf;?>

                  </div>
                </div>
                <?php } ?>
              </div>

            </div>

          </div>
          <?php $_smarty_tpl->tpl_vars['key'] = new Smarty_variable($_smarty_tpl->tpl_vars['key']->value+1, null, 0);?>
          <?php }?>
          <?php } ?>
        </div>
      </div>

    </div>

    <div class="botao mt-30 text-center">
      <a href="<?php echo $_smarty_tpl->tpl_vars['banner']->value->Botao_Link_txf;?>
" target="_blank" class="btn-lands btn-primary text-white">
        <?php echo trans('problemas_secao_botao');?>

      </a>
    </div>

  </div>

</section>
<?php }?>
<?php }} ?>