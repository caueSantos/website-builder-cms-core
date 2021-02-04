<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 01:50:20
         compiled from "core\templates\producao\hubvet\site\blocos\ajuda\base.tpl" */ ?>
<?php /*%%SmartyHeaderCode:30834601b6efc03a006-05466550%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '723ecb1414c775e7e1dcaf0333eacc20dc90bd23' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\ajuda\\base.tpl',
      1 => 1611638745,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30834601b6efc03a006-05466550',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ajuda_itens' => 0,
    'ajuda_categorias' => 0,
    'titulos' => 0,
    'ajuda' => 0,
    'key' => 0,
    'categoria' => 0,
    'painel' => 0,
    'assets' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b6efc0aad05_40514136',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b6efc0aad05_40514136')) {function content_601b6efc0aad05_40514136($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['ajuda_itens']->value[0]&&$_smarty_tpl->tpl_vars['ajuda_categorias']->value[0]){?>
<?php $_smarty_tpl->tpl_vars['ajuda_categorias'] = new Smarty_variable(junta_registros($_smarty_tpl->tpl_vars['ajuda_categorias']->value,'Nome_url',$_smarty_tpl->tpl_vars['ajuda_itens']->value,'Categoria_ajuda_sel','Itens'), null, 0);?>
<section class="pt-50 pt-md-70 pb-md-20">

  <div class="container">

    <div class="row justify-content-center">

      <div class="col-12 col-md-8">

        <div class="title-group text-center">
          <h1 class="title fz-36 fw-400 lh-12 text-primary">
            <?php echo titulo('ajuda_interna_itens','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>

          </h1>
          <?php if (titulo('ajuda_interna_itens','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>
          <div class="texto fz-16 mt-20 lh-15">
            <?php echo titulo('ajuda_interna_itens','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>

          </div>
          <?php }?>
        </div>

      </div>

      <div class="col-12 text-center mt-30">

        <div class="lands-tabs lands-tabs-2">

          <ul class="nav nav-fill" role="tablist">
            <?php $_smarty_tpl->tpl_vars['key'] = new Smarty_variable(0, null, 0);?>
            <?php  $_smarty_tpl->tpl_vars['ajuda'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ajuda']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ajuda_categorias']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ajuda']->key => $_smarty_tpl->tpl_vars['ajuda']->value){
$_smarty_tpl->tpl_vars['ajuda']->_loop = true;
?>
            <?php if ($_smarty_tpl->tpl_vars['ajuda']->value->Itens[0]){?>
            <li class="nav-item">
              <a class="<?php if ($_smarty_tpl->tpl_vars['key']->value==0){?>active<?php }?>"
                 id="ajuda-tab-<?php echo $_smarty_tpl->tpl_vars['ajuda']->value->Id_int;?>
"
                 data-toggle="tab"
                 href="#ajuda-<?php echo $_smarty_tpl->tpl_vars['ajuda']->value->Nome_url;?>
"
                 role="tab"
                 aria-controls="home"
                 aria-selected="true"
              >
                <?php echo $_smarty_tpl->tpl_vars['ajuda']->value->Nome_tit;?>

              </a>
            </li>
            <?php $_smarty_tpl->tpl_vars['key'] = new Smarty_variable($_smarty_tpl->tpl_vars['key']->value+1, null, 0);?>
            <?php }?>
            <?php } ?>
          </ul>

        </div>

      </div>

      <div class="col-12 col-md-10 mt-40 mt-md-70">
        <div class="tab-content" id="myTabContent">
          <?php $_smarty_tpl->tpl_vars['key'] = new Smarty_variable(0, null, 0);?>
          <?php  $_smarty_tpl->tpl_vars['categoria'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['categoria']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ajuda_categorias']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['categoria']->key => $_smarty_tpl->tpl_vars['categoria']->value){
$_smarty_tpl->tpl_vars['categoria']->_loop = true;
?>
          <?php if ($_smarty_tpl->tpl_vars['categoria']->value->Itens[0]){?>
          <div
            class="tab-pane fade show <?php if ($_smarty_tpl->tpl_vars['key']->value==0){?>active<?php }?>"
            id="ajuda-<?php echo $_smarty_tpl->tpl_vars['categoria']->value->Nome_url;?>
"
            role="tabpanel"
            aria-labelledby="home-tab"
          >

            <div class="row justify-content-center">

              <?php  $_smarty_tpl->tpl_vars['ajuda'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ajuda']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['categoria']->value->Itens; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ajuda']->key => $_smarty_tpl->tpl_vars['ajuda']->value){
$_smarty_tpl->tpl_vars['ajuda']->_loop = true;
?>

              <div class="col-md-4 pb-50">

                <a
                  href="<?php echo gera_link($_smarty_tpl->tpl_vars['ajuda']->value->Link_txf,true);?>
"
                  target="_blank"
                  class="ajuda-item d-block text-center fill-height hover hover-scale-down text-body-primary text-primary-hover"
                >

                  <figure class="imagem">
                    <?php if ($_smarty_tpl->tpl_vars['ajuda']->value->Imagens[0]){?>
                    <img
                      src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['ajuda']->value->Imagens[0]->Caminho_txf;?>
"
                      title="<?php echo $_smarty_tpl->tpl_vars['ajuda']->value->Texto_txf;?>
"
                      alt="<?php echo $_smarty_tpl->tpl_vars['ajuda']->value->Texto_txf;?>
"
                      style="height: 32px; width: auto"
                    />
                    <?php }else{ ?>
                    <img
                      src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/ajuda-icone.png"
                      title="<?php echo $_smarty_tpl->tpl_vars['ajuda']->value->Texto_txf;?>
"
                      alt="<?php echo $_smarty_tpl->tpl_vars['ajuda']->value->Texto_txf;?>
"
                      style="height: 32px; width: auto"
                    />
                    <?php }?>
                  </figure>

                  <div class="title fw-700 mt-15">
                    <?php echo $_smarty_tpl->tpl_vars['ajuda']->value->Nome_txf;?>

                  </div>

                  <?php if ($_smarty_tpl->tpl_vars['ajuda']->value->Descricao_txa){?>
                  <div class="title fz-14 mt-10">
                    <?php echo $_smarty_tpl->tpl_vars['ajuda']->value->Descricao_txa;?>

                  </div>
                  <?php }?>

                </a>

              </div>

              <?php } ?>

            </div>

          </div>
          <?php $_smarty_tpl->tpl_vars['key'] = new Smarty_variable($_smarty_tpl->tpl_vars['key']->value+1, null, 0);?>
          <?php }?>
          <?php } ?>
        </div>
      </div>

    </div>

  </div>

</section>
<?php }?>
<?php }} ?>