<?php /* Smarty version Smarty-3.1.12, created on 2021-02-02 00:33:49
         compiled from "core\templates\producao\hubvet\site\blocos\trabalhe-conosco\lista.tpl" */ ?>
<?php /*%%SmartyHeaderCode:165236018ba0dce2179-58742934%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ea53d6ae07cd0e7d2cbcf0e33307d18cf06977d' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\trabalhe-conosco\\lista.tpl',
      1 => 1584564590,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '165236018ba0dce2179-58742934',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'vagas' => 0,
    'vaga' => 0,
    'app' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_6018ba0dcfed80_30980678',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6018ba0dcfed80_30980678')) {function content_6018ba0dcfed80_30980678($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['vagas']->value[0]){?>
    <?php  $_smarty_tpl->tpl_vars['vaga'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['vaga']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['vagas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['vaga']->key => $_smarty_tpl->tpl_vars['vaga']->value){
$_smarty_tpl->tpl_vars['vaga']->_loop = true;
?>
        <div class="trabalhe-item">    
            <div class="container">        
                <div class="row">
                    <div class="col-lg-auto" style="max-width: 40%;">
                        <div class="v-meio">
                            <strong><?php echo $_smarty_tpl->tpl_vars['vaga']->value->Nome_tit;?>
</strong>                   
                        </div>
                    </div>
                    <div class="col-lg col-txt">
                        <div class="v-meio">
                            <span><?php echo $_smarty_tpl->tpl_vars['vaga']->value->Descricao_txa;?>
</span>
                        </div>
                    </div>
                    <div class="col-lg-auto">
                        <div class="v-meio">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
trabalhe-conosco/<?php echo $_smarty_tpl->tpl_vars['vaga']->value->Nome_url;?>
" class="btn btn-x btn-block">Candidate-se à vaga</a>
                        </div>
                    </div>
                </div>        
            </div>
        </div>
    <?php } ?>

<?php }else{ ?>
    
        <section id="sem-vagas">
            <article class="top">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div>
                                <h1 class="titulo-vaga">Não temos vagas</h1>
                                <div class="texto-vaga">Não temos vagas no momento, mas você pode deixar o seu currículo e assim que surgir uma oportunidade, ele será avaliado pela nossa equipe responsável</div>
                            </div>

                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                          <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/trabalhe-conosco/form_trabalhe_conosco.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

                        </div>
                    </div>
                </div>
            </article>
        </section>
   

<?php }?>
<?php }} ?>