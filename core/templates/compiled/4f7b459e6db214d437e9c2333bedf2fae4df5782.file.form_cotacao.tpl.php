<?php /* Smarty version Smarty-3.1.12, created on 2021-01-07 20:04:24
         compiled from "core\templates\producao\hubvet\site\blocos\cotacao\form_cotacao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:167125ff78568dafa29-03013737%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4f7b459e6db214d437e9c2333bedf2fae4df5782' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\cotacao\\form_cotacao.tpl',
      1 => 1604788187,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '167125ff78568dafa29-03013737',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tpl' => 0,
    'assunto' => 0,
    'envia_email' => 0,
    'tipo_lead' => 0,
    'tabela' => 0,
    'app' => 0,
    'emails' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ff78568e3ad15_00362191',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ff78568e3ad15_00362191')) {function content_5ff78568e3ad15_00362191($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['tpl'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['tpl']->value)===null||$tmp==='' ? false : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars['assunto'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['assunto']->value)===null||$tmp==='' ? false : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars['envia_email'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['envia_email']->value)===null||$tmp==='' ? false : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars['tipo_lead'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['tipo_lead']->value)===null||$tmp==='' ? false : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars['tabela'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['tabela']->value)===null||$tmp==='' ? false : $tmp), null, 0);?>

<form class="form-generico" onsubmit="return false" novalidate>

  <div class="row">

    <div class="col-12 col-lg-6">

      <div class="form-secao">

        <h3 class="title fz-24 fw-700 text-body-quaternary mb-30">
          Informações Pessoais
        </h3>

        <div class="form-lands-group">
          <input name="Nome_txf"
                 placeholder="Digite seu nome*"
                 type="text"
                 class="form-control form-lands"
                 required="required"
          />
          <div class="form-lands-feedback invalid-feedback fz-12">
            Por favor, escolha um nome válido.
          </div>
        </div>

        <div class="form-lands-group">
          <input name="Telefone_txf"
                 placeholder="Digite seu telefone*"
                 type="text"
                 class="form-control form-lands phone-mask"
                 required="required"
          />
          <div class="form-lands-feedback invalid-feedback fz-12">
            Por favor, escolha um telefone válido.
          </div>
        </div>

        <div class="form-lands-group">
          <input name="Email_txf"
                 placeholder="Digite seu e-mail*"
                 type="email"
                 class="form-control form-lands"
                 required="required"
          />
          <div class="form-lands-feedback invalid-feedback fz-12">
            Por favor, escolha um email válido.
          </div>
        </div>

      </div>

      <hr class="mb-30 mt-20"/>

      <div class="form-secao">

        <h3 class="title fz-24 fw-700 text-body-quaternary mb-30">
          Endereço
        </h3>

        <div class="form-lands-group">
          <input name="Cep_txf"
                 placeholder="CEP*"
                 type="text"
                 id="busca-cep-avalie"
                 class="form-control form-lands cep-mask"
                 required="required"
          />
          <div class="form-lands-feedback invalid-feedback fz-12">
            Por favor, escolha um CEP válido.
          </div>
        </div>

        <div class="form-lands-group">
          <select name="Estado_txf"
                  data-placeholder="Estado*"
                  type="text"
                  id="estados-avalie"
                  class="custom-select form-lands"
                  required="required"
          ></select>
          <div class="form-lands-feedback invalid-feedback fz-12">
            Por favor, escolha um estado válido.
          </div>
        </div>

        <div class="form-lands-group">
          <input name="Cidade_txf"
                 placeholder="Cidade*"
                 type="text"
                 class="form-control form-lands"
                 required="required"
          />
          <div class="form-lands-feedback invalid-feedback fz-12">
            Por favor, escolha uma cidade válida.
          </div>
        </div>

        <div class="form-lands-group">
          <input name="Bairro_txf"
                 placeholder="Bairro*"
                 type="text"
                 class="form-control form-lands"
                 required="required"
          />
          <div class="form-lands-feedback invalid-feedback fz-12">
            Por favor, escolha um bairro válido.
          </div>
        </div>

        <div class="form-lands-group">
          <input name="Endereco_txf"
                 placeholder="Endereço*"
                 type="text"
                 class="form-control form-lands"
                 required="required"
          />
          <div class="form-lands-feedback invalid-feedback fz-12">
            Por favor, escolha um endereço válido.
          </div>
        </div>

        <div class="row">

          <div class="col-lg-6">

            <div class="form-lands-group">
              <input name="Numero_txf"
                     placeholder="Número*"
                     type="text"
                     class="form-control form-lands"
                     required="required"
              />
              <div class="form-lands-feedback invalid-feedback fz-12">
                Por favor, escolha um número válido.
              </div>
            </div>

          </div>

          <div class="col-lg-6">
            <div class="form-lands-group">
              <input name="Complemento_txf"
                     placeholder="Complemento"
                     type="text"
                     class="form-control form-lands"
              />
            </div>
          </div>

        </div>

      </div>

    </div>

    <div class="col-12 col-lg-6">

      <div class="form-secao">

        <h3 class="title fz-24 fw-700 text-body-quaternary mb-30">
          Número de Ambientes
        </h3>

        <div class="row">
          <div class="col-6">

            <div class="form-lands-group">
              <input name="Quartos_txf"
                     placeholder="Quartos*"
                     type="text"
                     class="form-control form-lands"
                     required="required"
              />
              <div class="form-lands-feedback invalid-feedback fz-12">
                Por favor, escolha uma quantidade de quartos válida.
              </div>
            </div>

          </div>

          <div class="col-6">

            <div class="form-lands-group">
              <input name="Banheiros_txf"
                     placeholder="Banheiros*"
                     type="text"
                     class="form-control form-lands"
                     required="required"
              />
              <div class="form-lands-feedback invalid-feedback fz-12">
                Por favor, escolha uma quantidade de banheiros válida.
              </div>
            </div>

          </div>

          <div class="col-6">

            <div class="form-lands-group">
              <input name="Garagem_txf"
                     placeholder="Vagas de garagem*"
                     type="text"
                     class="form-control form-lands"
                     required="required"
              />
              <div class="form-lands-feedback invalid-feedback fz-12">
                Por favor, escolha uma quantidade de vagas válida.
              </div>
            </div>

          </div>

          <div class="col-6">

            <div class="form-lands-group">
              <select name="Mobiliado_txf"
                      data-placeholder="Está mobiliado"
                      type="text"
                      class="custom-select form-lands"
                      required="required"
              >
                <option value="Não mobiliado">Não mobiliado</option>
                <option value="Mobiliado">Mobiliado</option>
              </select>
            </div>

          </div>
        </div>

      </div>

      <hr class="mb-30 mt-20"/>

      <div class="form-secao">

        <h3 class="title fz-24 fw-700 text-body-quaternary mb-30">
          Descrição do Imóvel
        </h3>

        <div class="form-lands-group">
          <textarea
            style="min-height: 140px;"
            placeholder="Digite sua mensagem"
            name="Mensagem_txa"
            class="form-lands"
          ></textarea>
        </div>
      </div>

      <button class="btn-lands btn-block btn-secondary mt-10" type="submit">
        Enviar
      </button>

      <div class="fz-14 text-right mt-15">(*) Campos obrigatórios</div>

    </div>

  </div>

  <input value="<?php echo $_smarty_tpl->tpl_vars['app']->value->Lands_id;?>
" name="Lands_id" type="hidden"/>

  <?php if ($_smarty_tpl->tpl_vars['tpl']->value){?>
  <input value="<?php echo $_smarty_tpl->tpl_vars['tpl']->value;?>
" name="Tpl_txf" type="hidden"/>
  <?php }?>

  <?php if ($_smarty_tpl->tpl_vars['envia_email']->value){?>

  <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['envia_email']->value;?>
" name="Envia_email_txf"/>

  <?php if ($_smarty_tpl->tpl_vars['assunto']->value){?>
  <input type="hidden" name="Titulo_txf" value="<?php echo $_smarty_tpl->tpl_vars['assunto']->value;?>
"/>
  <input value="<?php echo $_smarty_tpl->tpl_vars['assunto']->value;?>
" name="Assunto_txf" type="hidden"/>
  <?php }?>

  <input type="hidden" name="Destinatario_txf" value="<?php echo $_smarty_tpl->tpl_vars['emails']->value[0]->Email_txf;?>
"/>

  <?php if ($_smarty_tpl->tpl_vars['tipo_lead']->value){?>
  <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['tipo_lead']->value;?>
" name="Tipo_lead_txf"/>
  <?php }?>

  <?php }?>

  <?php if ($_smarty_tpl->tpl_vars['tabela']->value){?>
  <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['tabela']->value;?>
" name="Tabela_txf"/>
  <?php }?>

  <input type="hidden" value="SIM" name="Permite_duplo_cadastro_txf"/>

</form>
<?php }} ?>