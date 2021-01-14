<?php /* Smarty version Smarty-3.1.12, created on 2020-10-18 19:20:56
         compiled from "core\templates\producao\vet_life\site\componentes\galeria_videos_carousel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:50115f8cb1b8e6c1c8-66226951%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '145233a745f80fc5c93c33d2b1b057c7fd2a7dab' => 
    array (
      0 => 'core\\templates\\producao\\vet_life\\site\\componentes\\galeria_videos_carousel.tpl',
      1 => 1599991199,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '50115f8cb1b8e6c1c8-66226951',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'itens' => 0,
    'nav' => 0,
    'dots' => 0,
    'videos' => 0,
    'id' => 0,
    'pagination' => 0,
    'item_class' => 0,
    'video' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f8cb1b8ec0637_87060629',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f8cb1b8ec0637_87060629')) {function content_5f8cb1b8ec0637_87060629($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['itens'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['itens']->value)===null||$tmp==='' ? '4-2-1' : $tmp), null, 0);?><?php $_smarty_tpl->tpl_vars['nav'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['nav']->value)===null||$tmp==='' ? false : $tmp), null, 0);?><?php $_smarty_tpl->tpl_vars['dots'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['dots']->value)===null||$tmp==='' ? false : $tmp), null, 0);?><?php $_smarty_tpl->tpl_vars['id'] = new Smarty_variable(('galeria-imagem-').(uniqid()), null, 0);?><?php if ($_smarty_tpl->tpl_vars['videos']->value[0]){?><div class="galeria" id="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">  <div class="owl-carousel carousel-galeria"       data-owl-carousel       data-owl-rwd="<?php echo $_smarty_tpl->tpl_vars['itens']->value;?>
"       data-owl-loop="true"       data-owl-autoplay="true"       data-owl-autoplay-timeout="6000"       data-owl-margin="30"       data-owl-dots="<?php if ($_smarty_tpl->tpl_vars['pagination']->value){?>true<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['dots']->value;?>
<?php }?>"       data-owl-nav="<?php echo $_smarty_tpl->tpl_vars['nav']->value;?>
"       data-owl-dots-container="#<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
 .owl-dots"       data-dot-class="owl-dot col-lg"       data-owl-nav-text="@icon:fas fa-chevron-left@ Anterior--Próximo @icon:fas fa-chevron-right@"       data-owl-nav-container="#<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
 .owl-nav"       data-owl-dots-each="1"  >    <?php  $_smarty_tpl->tpl_vars['video'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['video']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['videos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['video']->key => $_smarty_tpl->tpl_vars['video']->value){
$_smarty_tpl->tpl_vars['video']->_loop = true;
?>    <div class="item">      <a class="aspect aspect-3-2 d-block fancybox hover hover-opacity <?php echo $_smarty_tpl->tpl_vars['item_class']->value;?>
"         href="https://www.youtube.com/embed/<?php echo $_smarty_tpl->tpl_vars['video']->value->Endereco_txf;?>
"         data-fancybox="galeria-<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"      >        <figure class="imagem aspect-item">          <img            itemprop="image"            src="http://img.youtube.com/vi/<?php echo $_smarty_tpl->tpl_vars['video']->value->Endereco_txf;?>
/mqdefault.jpg"            alt="<?php echo $_smarty_tpl->tpl_vars['video']->value->Descricao_txf;?>
" title="<?php echo $_smarty_tpl->tpl_vars['video']->value->Descricao_txf;?>
"            class="img-fit"          />          <div class="bg-fake text-center">            <div class="d-block align-center" style="opacity: 0.9">              <div                class="bg-fake"                style="background: #fff;                      width: 40px;                      height: 40px;                      left: 50%;                      top: 50%;                      margin-left: -20px;                      margin-top: -20px;"              ></div>              <i style="color: #FF0000;" class="fab fa-youtube fz-70 lh-1"></i>            </div>          </div>        </figure>      </a>    </div>    <?php } ?>  </div>  <div class="carousel-super-nav mx-auto">    <?php if ($_smarty_tpl->tpl_vars['pagination']->value){?>    <div class="owl-nav mt-50 d-flex">      <div class="flex-grow-1">        <div class="owl-dots row no-gutters v-meio pl-40 pr-40">        </div>      </div>    </div>    <?php }?>    <?php if ($_smarty_tpl->tpl_vars['dots']->value&&!$_smarty_tpl->tpl_vars['pagination']->value){?>    <div class="rounded-dots d-block text-center mt-30">      <div class="owl-dots fz-18"></div>    </div>    <?php }?>  </div></div><?php }?><?php }} ?>