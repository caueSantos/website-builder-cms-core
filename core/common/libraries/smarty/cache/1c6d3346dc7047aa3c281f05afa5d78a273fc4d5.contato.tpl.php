<?php /*%%SmartyHeaderCode:1611229912512fe72487f6a4-84787024%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1c6d3346dc7047aa3c281f05afa5d78a273fc4d5' => 
    array (
      0 => 'application/views/templates/padrao/contato.tpl',
      1 => 1360954713,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1611229912512fe72487f6a4-84787024',
  'variables' => 
  array (
    'contato' => 0,
    'fone' => 0,
    'val' => 0,
    'emails' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_512fe724924153_62266503',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_512fe724924153_62266503')) {function content_512fe724924153_62266503($_smarty_tpl) {?><style type="text/css">


    #conteudo_esquerda {
        padding-left:20px;
        float:left;
        width:460px;
    }
    #conteudo_esquerda p {
        padding-bottom:10px;

    }
    #conteudo_direita {
        float:left;
        width:460px;
    }
    #conteudo label {
        text-indent:10px;
        clear:both;
        font-size:12px;
        float:left;
        display:block;
        width:80px;
        border-bottom:1px solid #ccc;
        color:#1f77cc;
        height:25px;
        line-height:25px;
        font-weight:bold;
    }

    .bt_enviar {
        background-image: url(imagens/bt_enviar.jpg);
        width:100px;
        height:30px;
        border:none;
        float:right;
        cursor:pointer;
        outline:none;
    }
    .nomemail {
        padding:3px;
        font-size:11px;
        background-color:#fff;
        margin:2px;
        border:1px #ccc solid;
        width:310px;
        height:16px;
        font-size:12px;
        color:#666;
    }
    .caixa {
        font-family:Tahoma, Geneva, sans-serif;
        font:Tahoma, Geneva, sans-serif;
        font-size:12px;
        color:#666;
        padding:3px;
        overflow-x:hidden;
        overflow:visible;
        font-size:11px;
        background-color:#fff;
        margin:2px;
        border:1px #ccc solid;
        width:310px;
    }
    .mapa {
        padding:10px;
        border:1px #CCCCCC solid;
        width:360px;
        height:155px;
        background-color:#FFF;
        margin-bottom:20px;
        margin-top:20px;
    }
    .mapa small a {
        font-size:11px;
        color:#666;
        text-align:left
    }

    #atencao {
        font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
        font:"Trebuchet MS", Arial, Helvetica, sans-serif;
        font-size:12px;
        text-align:center;
        margin:auto;
        width:210px;
        color: #999900;
        outline:none;
        background-color: #ffffea;
        border:1px solid #999900;
        padding:10px;
        font-weight:bold;
        z-index:1;
    }

    #ok {
        cursor:pointer;
        margin-top:10px;
        border:none;
        background-image:url(../imagens/bt_fechar.jpg);
        width:83px;
        height:23px;
    }

    #enviado {
        font-size:14px;
        font-weight:bold;
        text-align:center;
        border:1px solid #009933;
        background-color:#e8ffe8;
        color:#009933;
        margin:10px;
        padding:10px;
        width:220px;
    }
    .ul_contato {
        list-style:none;
        padding:0;
        margin:0;
    }
    a.repre_link {
        text-decoration:none;
        color:#666;
    }
    a.repre_link:hover {
        color:#666;
        text-decoration:none;
    }
    .ul_contato a {
        text-decoration:none;
        color:#666;
    }
    .ul_contato a:hover {
        text-decoration:underline;
        color:#666;
    }

    h1 {
        padding:20px;
        padding-top:30px;
        margin-bottom:25px;
        padding-bottom:10px;
        border-bottom:2px solid #adca52;
        font:"Trebuchet MS", Arial, Helvetica, sans-serif;
        font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
        font-size:28px;
        font-weight:bold;
        color:#719600;

    }

    h2 {
        font-size:16px;
        padding-bottom:10px;
        color:#db0000;
    }

    #estado {
        padding:3px;
        font-size:11px;
        background-color:#fff;
        margin:2px;
        border:1px #ccc solid;
        height:22px;
        font-size:12px;
        color:#666;
    }
    /* CONTATO */


</style>
<script language="javascript" type="text/javascript">
    $(document).ready(function() {

    $('#submit').click(function(){
	
    var valores = new Array();
    var p = 0;
	
    $.each($('input.valida'),function(i){

    valores.push($(this).val());
	
    if($(this).val() == ''){	
    p = 1;
	
    $(this).focus(function() {
			
    jQuery(this).val('').css({
    border:'1px solid #ccc',
    background: '#FFFFE8'
});
		
})
p++;
$(this).css({
border:'1px solid #ff3333',
background:'#ffe2e2'
});
}	
});
	 
	 
$.each($('textarea.valida'),function(i){

valores.push($(this).val());
	
if($(this).val() == ''){	
p = 1;
$(this).focus(function() {
			
jQuery(this).val('').css({
border:'1px solid #ccc',
background: '#FFFFE8'
});
		
});
$(this).css({
border:'1px solid #ff3333',
background:'#ffe2e2'
});
} 
	
}); 
//alert(p);	
if(p == 0){
//alert(p);
jQuery('#nome, #email, #fone, #cidade, #estado,  #mensagem, #destinatario,').focus(function() {
jQuery(this).val('').css('backgroundColor', '#FFFFE8');
}).blur(function() {
jQuery(this).css('backgroundColor', '#fff');
});
	
function envia() {
jQuery('#nome, #email, #fone, #cidade, #estado, #mensagem, #destinatario').unbind('focus');
var nomeEnviado         = $('#nome').val();
var emailEnviado        = $('#email').val();
var cidadeEnviado        = $('#cidade').val();
var estadoEnviado        = $('#estado').val();
var foneEnviado         = $('#fone').val();
var mensagemEnviado     = $('#mensagem').val();
var destinatarioEnviado = $('#destinatario').val();
var assuntoEnviado = $('#assunto').val();
jQuery.post('post/contato', { nome:nomeEnviado, email:emailEnviado, cidade:cidadeEnviado, estado:estadoEnviado, fone:foneEnviado, mensagem: mensagemEnviado, destinatario: destinatarioEnviado , assunto : assuntoEnviado},
function(data) {
$('#res').animate({
marginLeft:100,marginTop:140},1000).fadeIn(3000).html(data);
},'html');
		
};	
envia();	
}

})
jQuery('#fone').mask('(99)9999-9999');
})

</script>
<h1>Contato</h1>
<div id='conteudo_esquerda'>
    <div id='res'>
        <p style="padding-bottom:20px;">Para maiores informações entre em contato conosco, retornaremos o mais breve possível.</p>
        <p>
            <label for='nome'>Nome: </label>
            <input  name="nome" type="text" class="nomemail valida"  id="nome" tabindex="1"  />
        </p>
        <p>
            <input name="assunto" id="assunto" type="hidden" value="Contato feito pelo site" />
            <label for='email'>E-mail:</label>
            <input name="email"  type="text" class="nomemail valida"  id="email" tabindex="2" />
        </p>
        <p>
            <label for='fone'>Telefone:</label>
            <input name="fone" style="width:130px;"type="text" class="nomemail valida"  id="fone" tabindex="3" />
        </p>
        <p>
            <label for='cidade'>Cidade: </label>
            <input name='cidade' type='text' class='nomemail valida' style="width:130px;" id='cidade' tabindex="4"/></p>
        <p><label for='estado'> Estado: </label>
            <select tabindex="5" name="estado" id="estado" size="1">
                <option value="">--</option>
                <option value="AC">AC</option>
                <option value="AL">AL</option>
                <option value="AM">AM</option>
                <option value="AP">AP</option>
                <option value="BA">BA</option>
                <option value="CE">CE</option>
                <option value="DF">DF</option>
                <option value="ES">ES</option>
                <option value="GO">GO</option>
                <option value="MA">MA</option>
                <option value="MG">MG</option>
                <option value="MS">MS</option>
                <option value="MT">MT</option>
                <option value="PA">PA</option>
                <option value="PB">PB</option>
                <option value="PE">PE</option>
                <option value="PI">PI</option>
                <option value="PR">PR</option>
                <option value="RJ">RJ</option>
                <option value="RN">RN</option>
                <option value="RO">RO</option>
                <option value="RR">RR</option>
                <option value="RS">RS</option>
                <option value="SC">SC</option>
                <option value="SE">SE</option>
                <option value="SP">SP</option>
                <option value="TO">TO</option>
            </select>
            </label>
        </p>
        <p>
            <label for='mensagem'>Mensagem:</label>
            <textarea rows="10"  name="mensagem" id="mensagem" class="caixa valida"  tabindex="6"> </textarea>
        </p>
        <input name="destinatario" type="hidden" id="destinatario" value="contatoteste@artsbobinaseetiquetas.com.br, felipe.macedo@landsdigital.com.br" />
        <p style="width:400px;">
            <input type="submit" value="" class="bt_enviar" id="submit" tabindex="7" />
        </p>
    </div>
</div>
<div id='conteudo_divisoria'></div>
<div id='conteudo_direita'>
    <h2>Endere&ccedil;o</h2>
    <p>
        R - Lages - Santa Catarina - CEP 88504011

    </p>
    <p class='mapa'>
        <iframe width="360" height="145" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com.br/maps?f=q&amp;source=s_q&amp;hl=pt-BR&amp;geocode=&amp;q=Rua+S%C3%A3o+Joaquim,+1111++lages&amp;aq=&amp;sll=-22.105999,-35.507812&amp;sspn=47.888676,93.076172&amp;vpsrc=0&amp;gl=br&amp;ie=UTF8&amp;hq=&amp;hnear=R.+S%C3%A3o+Joaquim,+1111+-+Copacabana,+Lages+-+Santa+Catarina,+88504-011&amp;t=m&amp;ll=-27.816684,-50.337038&amp;spn=0.011007,0.030813&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe>
        <br />
        <small><a style="font-size:14px" target="_blank" href="http://maps.google.com.br/maps?f=q&amp;source=s_q&amp;hl=pt-BR&amp;geocode=&amp;q=Rua+S%C3%A3o+Joaquim,+1111++lages&amp;aq=&amp;sll=-22.105999,-35.507812&amp;sspn=47.888676,93.076172&amp;vpsrc=0&amp;gl=br&amp;ie=UTF8&amp;hq=&amp;hnear=R.+S%C3%A3o+Joaquim,+1111+-+Copacabana,+Lages+-+Santa+Catarina,+88504-011&amp;t=m&amp;ll=-27.816684,-50.337038&amp;spn=0.011007,0.030813&amp;z=14&amp;iwloc=A&amp;output=embed">Exibir mapa ampliado</a></small> </p>
    <h2>Telefone</h2>
    <ul class='ul_contato'>
                            <li>(49)3225-1252</li>
                    <li> (49)3225-1252 </li>
        
    </ul>
    <h2 style="padding-top:20px;">E-mail</h2>
    <ul class='ul_contato'>
                            <li>contatoteste@artsbobinaseetiquetas.com.br</li>
                    <li> felipe.macedo@landsdigital.com.br</li>
        
    </ul>
</div>
<div style="height:20px;clear:both;"> </div>
<?php }} ?>