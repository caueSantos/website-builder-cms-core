<?php /* Smarty version Smarty-3.1.12, created on 2020-09-18 14:26:46
         compiled from "core\templates\producao\diagnostico\site\blocos\solucoes\interna.tpl" */ ?>
<?php /*%%SmartyHeaderCode:175185f64edd6890f53-51539295%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2a3e9dd4aca0715bc08ede3816bf73ea4527354d' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\blocos\\solucoes\\interna.tpl',
      1 => 1600348255,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '175185f64edd6890f53-51539295',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'servicos' => 0,
    'servico' => 0,
    'titulos' => 0,
    'CAMINHO_TPL' => 0,
    'imagens' => 0,
    'painel' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f64edd68d0103_22947422',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f64edd68d0103_22947422')) {function content_5f64edd68d0103_22947422($_smarty_tpl) {?><main id="servico">  <?php $_smarty_tpl->tpl_vars['servico'] = new Smarty_variable($_smarty_tpl->tpl_vars['servicos']->value[0], null, 0);?>  <?php $_smarty_tpl->tpl_vars['imagens'] = new Smarty_variable(get_object($_smarty_tpl->tpl_vars['servico']->value->Imagens,'Campo_sel','==','Imagens_ico'), null, 0);?>  <?php $_smarty_tpl->tpl_vars['titulo'] = new Smarty_variable((('<strong>').($_smarty_tpl->tpl_vars['servico']->value->Nome_tit)).('</strong>'), null, 0);?>  <?php $_smarty_tpl->tpl_vars['subtitulo'] = new Smarty_variable(titulo('servicos_interna','sub',$_smarty_tpl->tpl_vars['titulos']->value), null, 0);?>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/head_interna.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  <div id="wrap" class="pt-40 pt-md-20">    <div class="container pb-60">      <div class="row justify-content-center">        <div class="col-12 col-md-8 text-center text-md-left">          <?php if ($_smarty_tpl->tpl_vars['imagens']->value[0]){?>          <section class="secao-imagem">            <div class="aspect aspect-21-9">              <figure class="imagem aspect-item">                <img alt="<?php echo $_smarty_tpl->tpl_vars['servico']->value->Nome_tit;?>
" src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['imagens']->value[0]->Caminho_txf;?>
" class="img-fit"/>              </figure>            </div>          </section>          <?php }?>          <?php if ($_smarty_tpl->tpl_vars['servico']->value->Texto_txa){?>          <div class="texto fz-18 lh-18 mt-25 pr-md-100">            <?php echo $_smarty_tpl->tpl_vars['servico']->value->Texto_txa;?>
          </div>          <?php }?>          <?php if ($_smarty_tpl->tpl_vars['servico']->value->Descricao_detalhada_txa){?>          <section class="caracteristicas-solucao mt-50 mt-md-60">            <h3 class="title fz-22 fw-600">              Descrição detalhada            </h3>            <div class="texto mt-15 lh-18 fz-18">              <?php echo $_smarty_tpl->tpl_vars['servico']->value->Descricao_detalhada_txa;?>
            </div>          </section>          <?php }?>        </div>      </div>    </div>    <?php if ($_smarty_tpl->tpl_vars['imagens']->value[1]){?>    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/solucoes/galeria_imagens.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php }?>    <?php if ($_smarty_tpl->tpl_vars['servico']->value->Videos[0]){?>    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/solucoes/galeria_videos.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php }?>  </div>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/noticias.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</main><?php }} ?>