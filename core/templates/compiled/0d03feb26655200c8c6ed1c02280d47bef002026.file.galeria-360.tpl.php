<?php /* Smarty version Smarty-3.1.12, created on 2020-12-12 13:52:43
         compiled from "core\templates\producao\hubvet\site\blocos\imoveis\galeria-360.tpl" */ ?>
<?php /*%%SmartyHeaderCode:63095fd4e74b417727-58994329%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0d03feb26655200c8c6ed1c02280d47bef002026' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\imoveis\\galeria-360.tpl',
      1 => 1604744352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '63095fd4e74b417727-58994329',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'id' => 0,
    'mapas' => 0,
    'mapa' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fd4e74b4c45e8_64902664',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd4e74b4c45e8_64902664')) {function content_5fd4e74b4c45e8_64902664($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['id'] = new Smarty_variable((('galeria-').(rand())).(rand()), null, 0);?>
<section class="galeria-360" id="galeria-360-<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
  <div class="container">
    <div class="row no-gutters">

      <div class="col-lg-12">

        <div class="owl-carousel carousel-360"
             data-owl-carousel
             data-owl-items="1"
             data-rwd="1-1-1"
             data-owl-loop="true"
             data-owl-autoplay="false"
             data-owl-margin="15"
             data-owl-dots="true"
             data-owl-nav="false"
             data-owl-autoplay-hover-pause="true"
             data-owl-dots-container="#galeria-360-<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
 .owl-dots"
        >
          <?php  $_smarty_tpl->tpl_vars['mapa'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['mapa']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['mapas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['mapa']->key => $_smarty_tpl->tpl_vars['mapa']->value){
$_smarty_tpl->tpl_vars['mapa']->_loop = true;
?>
          <?php if ($_smarty_tpl->tpl_vars['mapa']->value->Link_360_txf){?>
          <div class="item overflow-hidden br-2">
            <div class="aspect aspect-21-9 br-2 overflow-hidden bg-body-light">
              <figure class="aspect-item image-layer">
                <iframe
                  class="inner-item img-fit"
                  src="https://www.google.com/maps/embed?pb=<?php echo $_smarty_tpl->tpl_vars['mapa']->value->Link_360_txf;?>
"
                  frameborder="0"
                  style="border:0;"
                  allowfullscreen=""
                  aria-hidden="false"
                  tabindex="0"
                ></iframe>
              </figure>
            </div>
          </div>
          <?php }?>
          <?php } ?>
        </div>

        <div class="rounded-dots d-block text-center mt-30">
          <div class="owl-dots fz-18"></div>
        </div>

      </div>

    </div>

  </div>

</section>
<?php }} ?>