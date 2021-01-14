<?php /*%%SmartyHeaderCode:2314850d8833056e9d7-81060133%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd7fd74b47df4b5e1dfa93989bf025b6d7eac6477' => 
    array (
      0 => 'application\\views\\templates\\blog_intensivodonto\\contato.tpl',
      1 => 1356364394,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2314850d8833056e9d7-81060133',
  'variables' => 
  array (
    'url' => 0,
    'retorno' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50d8833061fdd4_70297676',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50d8833061fdd4_70297676')) {function content_50d8833061fdd4_70297676($_smarty_tpl) {?>

<section id="content" class="clearfix">

    <div class="container clearfix">

        <h2>Contato e Localiza&ccedil;&atilde;o</h2><br>
        <hr />

    </div><!-- end .container -->

    <section id="map">
    </section><!-- end #map -->

    <div class="container clearfix">

        <div class="one-fourth">


        </div><!-- end .one-fourth -->

        <div class="three-fourth last">

            <h3>Mande seu contato</h3>

            <form action="http://localhost/smartysite/contato/post/" method="post" >
                                <p class="input-block">
                    <label for="contact-name"><strong>Nome</strong> (requirido)</label>
                    <input type="text" name="nome" class="obrigatorio" value="" id="contact-name" required>
                </p>

                <p class="input-block">
                    <label for="contact-email"><strong>Email</strong> (requirido)</label>
                    <input type="email" name="email" class="obrigatorio" value="" id="contact-email" required>
                </p>

                <p class="input-block">
                    <label for="contact-subject"><strong>Assunto</strong></label>
                    <input type="text" name="assunto" class="obrigatorio" value="" id="contact-subject">
                </p>

                <p class="textarea-block">
                    <label for="contact-message"><strong>Mensagem</strong> (requirido)</label>
                    <textarea name="mensagem" class="obrigatorio" id="contact-message" cols="88" rows="6" required></textarea>
                    <input type="hidden" name="destinatario" value="felipe.macedo@landsdigital.com.br" />
                </p>


                <input type="submit" value="Enviar contato">

                <div class="clear"></div>

            </form>

        </div><!-- end .three-fourth.last -->

    </div><!-- end .container -->

</section><!-- end #content --><?php }} ?>