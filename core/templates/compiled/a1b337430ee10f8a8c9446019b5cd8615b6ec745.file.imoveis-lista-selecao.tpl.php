<?php /* Smarty version Smarty-3.1.12, created on 2021-01-02 23:29:59
         compiled from "core\templates\producao\hubvet\site\blocos\inicio\imoveis-lista-selecao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:139445ff11e17742612-32167992%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a1b337430ee10f8a8c9446019b5cd8615b6ec745' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\inicio\\imoveis-lista-selecao.tpl',
      1 => 1607656688,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '139445ff11e17742612-32167992',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'imoveis_selecao' => 0,
    'caracteristicas_tipos' => 0,
    'imoveis_registros' => 0,
    'titulos' => 0,
    'CAMINHO_TPL' => 0,
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ff11e17760a48_62270361',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ff11e17760a48_62270361')) {function content_5ff11e17760a48_62270361($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['imoveis_registros'] = new Smarty_variable(monta_imoveis_zeh($_smarty_tpl->tpl_vars['imoveis_selecao']->value,$_smarty_tpl->tpl_vars['caracteristicas_tipos']->value), null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['imoveis_registros']->value){?>
<div class="imoveis-lista-selcao pt-60 pb-40 pb-lg-80">

  <div class="container">

    <div class="row justify-content-center">
      <div class="col-lg-8">

        <div class="title-group text-center">
          <h1 class="title text-primary fz-32 fw-700 lh-12">
            <?php echo titulo('imoveis_selecao_inicio','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>

          </h1>
          <?php if (titulo('imoveis_selecao_inicio','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>
          <div class="texto mt-5 lh-2 fz-16 fw-400">
            <?php echo titulo('imoveis_selecao_inicio','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>

          </div>
          <?php }?>
        </div>

      </div>
    </div>

    <div class="mt-30 mt-lg-60">
      <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/imoveis/imoveis-lista.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </div>

    <div class="botao text-center mt-30 mt-lg-0">
      <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente_linguagem;?>
imoveis" class="pl-lg-100 pr-lg-100 btn-lands btn-outline d-block d-lg-inline-block">
        Ver mais
      </a>
    </div>

  </div>

</div>
<?php }?>

<?php }} ?>