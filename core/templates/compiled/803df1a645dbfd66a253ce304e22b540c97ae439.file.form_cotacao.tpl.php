<?php /* Smarty version Smarty-3.1.12, created on 2020-09-13 17:57:07
         compiled from "core\templates\producao\diagnostico\site\blocos\cotacao\form_cotacao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:299615f5e87a38aaa85-94152990%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '803df1a645dbfd66a253ce304e22b540c97ae439' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\blocos\\cotacao\\form_cotacao.tpl',
      1 => 1599130540,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '299615f5e87a38aaa85-94152990',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'layout' => 0,
    'cols' => 0,
    'estados_civis' => 0,
    'estado' => 0,
    'solucoes' => 0,
    'solucoes_lista' => 0,
    'solucao' => 0,
    'app' => 0,
    'emails' => 0,
    'pagina_atual' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f5e87a38dfac4_12594855',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f5e87a38dfac4_12594855')) {function content_5f5e87a38dfac4_12594855($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['layout']->value==2){?><?php $_smarty_tpl->tpl_vars['cols'] = new Smarty_variable('col-12 col-md-6', null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['cols'] = new Smarty_variable('col-12', null, 0);?><?php }?><form class="form-matricula" data-tipo="matricula" onsubmit="return false">  <div class="row">    <div class="<?php echo $_smarty_tpl->tpl_vars['cols']->value;?>
">      <input name="Nome_txf"             placeholder="Ex: João da Silva"             type="text"             class="form-lands"             required="required"      />      <input name="Email_txf"             placeholder="Ex: contato@email.com.br"             type="email"             class="form-lands"             required="required"      />      <input name="Telefone_txf"             placeholder="Ex: (99) 99999 9999"             type="text"             class="form-lands phone-mask"             required="required"      />      <input name="Cep_txf"             placeholder="CEP"             type="text"             class="form-lands cep-mask"             required="required"      />      <input name="Cpf_txf"             placeholder="CPF"             type="text"             class="form-lands cpf-mask"             required="required"      />      <?php $_smarty_tpl->tpl_vars['estados_civis'] = new Smarty_variable(array('Solteiro','Casado','Viúvo','Separado','Divorciado'), null, 0);?>      <div class="select-lands">        <select          data-placeholder="Estado Civil"          required          name="Estado_civil_txf"          class="form-lands formulario required"        >          <option></option>          <?php  $_smarty_tpl->tpl_vars['estado'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['estado']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['estados_civis']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['estado']->key => $_smarty_tpl->tpl_vars['estado']->value){
$_smarty_tpl->tpl_vars['estado']->_loop = true;
?>          <option value="<?php echo $_smarty_tpl->tpl_vars['estado']->value;?>
">            <?php echo $_smarty_tpl->tpl_vars['estado']->value;?>
          </option>          <?php } ?>        </select>      </div>    </div>    <div class="<?php echo $_smarty_tpl->tpl_vars['cols']->value;?>
">      <div class="fz-16 fw-600 mb-15 lh-1">Tipo do seguro</div>      <div class="mb-15">        <div class="form-lands-radio custom-control custom-radio custom-control-inline">          <input value="Novo seguro" checked type="radio" id="novo-seg" name="Tipo_seguro_txf" class="custom-control-input" required>          <label class="custom-control-label" for="novo-seg">Novo seguro</label>        </div>        <div class="form-lands-radio custom-control custom-radio custom-control-inline">          <input value="Renovação" type="radio" id="renovar" name="Tipo_seguro_txf" class="custom-control-input" required>          <label class="custom-control-label" for="renovar">Renovação</label>        </div>      </div>      <?php if ($_smarty_tpl->tpl_vars['solucoes']->value[0]){?>      <input type="hidden" name="Seguro_escolhido_txf" value="<?php echo $_smarty_tpl->tpl_vars['solucoes']->value[0]->Nome_tit;?>
">      <?php }else{ ?>      <div class="select-lands mt-15">        <select          id="select-tipo-seguro"          data-placeholder="Escolha o tipo do seguro"          required          name="Seguro_escolhido_txf"          class="form-lands formulario required"        >          <option></option>          <?php  $_smarty_tpl->tpl_vars['solucao'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['solucao']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['solucoes_lista']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['solucao']->key => $_smarty_tpl->tpl_vars['solucao']->value){
$_smarty_tpl->tpl_vars['solucao']->_loop = true;
?>          <option data-id="<?php echo $_smarty_tpl->tpl_vars['solucao']->value->Id_int;?>
" value="<?php echo $_smarty_tpl->tpl_vars['solucao']->value->Nome_tit;?>
">            <?php echo $_smarty_tpl->tpl_vars['solucao']->value->Nome_tit;?>
          </option>          <?php } ?>        </select>      </div>      <?php }?>      <div class="extra"></div>    </div>  </div>  <input value="<?php echo $_smarty_tpl->tpl_vars['app']->value->Lands_id;?>
" name="Lands_id" type="hidden"/>  <input value="matricula" name="Tpl_txf" type="hidden"/>  <input type="hidden" name="Titulo_txf" value="AB•Seg - Sua simulação foi enviada!"/>  <input value="AB•Seg - Sua simulação foi enviada!" name="Assunto_txf" type="hidden"/>  <input type="hidden" value="SIM" name="Envia_email_txf"/><!--  <input type="hidden" name="Destinatario_txf" value="<?php echo $_smarty_tpl->tpl_vars['emails']->value[0]->Email_txf;?>
"/>-->  <input type="hidden" name="Destinatario_txf" value="asdas"/>  <input type="hidden" value="SIM" name="Permite_duplo_cadastro_txf"/>  <input type="hidden" value="_matricula" name="Tabela_txf"/>  <input type="hidden" value="matricula" name="Tipo_lead_txf"/>  <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='solucoes'){?>  <button class="btn-lands btn-block btn-accent tt-upper" type="submit">    Enviar  </button>  <?php }else{ ?>  <button class="btn-lands btn-block btn-grey btn-outline tt-upper" type="submit">    Enviar  </button>  <?php }?></form><script>  window.solucoes = <?php echo json_encode($_smarty_tpl->tpl_vars['solucoes_lista']->value);?>
</script><script>  $(function () {    var paginaAtual = window.utils.paginaAtual;    var segmento2 = window.utils.segmentos[1] || null;    if (paginaAtual === 'solucoes' && segmento2) {      var solucao = window.solucoes.find(function (item) {        return item.Nome_url === segmento2;      });      if (solucao) {        carregaInputs(solucao);      }    } else {      $('body').on('select2:select', '#select-tipo-seguro', function (e) {        var $option = $("option:selected", this),          dataId = $option.data('id');        var solucao = window.solucoes.find(function (item) {          return parseInt(item.Id_int) === parseInt(dataId);        });        if (solucao) {          carregaInputs(solucao);        }      });    }    function carregaInputs(solucao) {      var inputs = solucao.inputs,        $tplList = $('<div/>');      $.each(inputs, function (i, input) {        var $tpl = $('<input data-json="true"/>');        $tpl.attr('name', input.Nome_txf || '');        $tpl.attr('type', input.Tipo_txf || 'text');        $tpl.attr('placeholder', input.Label_txf || '');        $tpl.attr('id', input.Id_txf || 'extra-input-' + input.Id_int);        $tpl.attr('class', 'form-lands ' + (input.Classe_txf || ''));        $tpl.attr('required', input.Obrigatorio_sel && input.Obrigatorio_sel === 'SIM');        $tplList.append($tpl);      });      $('.form-matricula .extra').html($tplList);      aplicarMascaras();    }  });</script><?php }} ?>