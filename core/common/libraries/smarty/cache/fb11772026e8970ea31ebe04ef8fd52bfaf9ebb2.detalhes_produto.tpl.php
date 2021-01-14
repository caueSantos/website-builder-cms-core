<?php /*%%SmartyHeaderCode:14347073575132b5a2a2b174-61725723%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fb11772026e8970ea31ebe04ef8fd52bfaf9ebb2' => 
    array (
      0 => 'application/views/templates/padrao/detalhes_produto.tpl',
      1 => 1361306856,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14347073575132b5a2a2b174-61725723',
  'variables' => 
  array (
    'menu_produtos' => 0,
    'menu_esq' => 0,
    'subcategoria_produtos' => 0,
    'menu' => 0,
    'arr' => 0,
    'produto' => 0,
    'detalhes_produto' => 0,
    'imagens_produto' => 0,
    'value' => 0,
    'link_atual' => 0,
    'videos_produto' => 0,
    'contato' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5132b5a2c4e8d4_42076743',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5132b5a2c4e8d4_42076743')) {function content_5132b5a2c4e8d4_42076743($_smarty_tpl) {?><style type="text/css">
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
var produtoEnviado = $('#produto').val();
var assuntoEnviado = $('#assunto').val();
jQuery.post('post/orcamento', { nome:nomeEnviado, email:emailEnviado, cidade:cidadeEnviado, estado:estadoEnviado, fone:foneEnviado, mensagem: mensagemEnviado, destinatario: destinatarioEnviado , assunto : assuntoEnviado, produto : produtoEnviado},
function(data) {
$('#res').fadeIn(3000).html(data);
},'html');
		
};	
envia();	
}

})
jQuery('#fone').mask('(99)9999-9999');
})

</script>
<h1>Detalhes do Produto</h1>
<div id="coluna_auxiliar">
            <ul id="menu_vertical">
            <li>
                <a href="produtos/aplicador_de_pinus">Aplicador de Pinus</a>
                <ul> 
                                                                                                                        <li>
                                <a href="produtos/aplicador_de_pinus/marca_aplicador_pinus">Marca aplicador pinus</a>
                                <ul>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </ul>
                            </li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </ul>
            </li>
        </ul>
            <ul id="menu_vertical">
            <li>
                <a href="produtos/bobinas">Bobinas</a>
                <ul> 
                                                                                                                                                                    <li>
                                <a href="produtos/bobinas/relogio_ponto">Relógio Ponto</a>
                                <ul>
                                                                                                                                                                                                                                                                                    <li>
                                                <a href="detalhes_produto/68/55mm_x_30_mts_-_off_set">55mm x 30 mts - OFF SET</a>
                                            </li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </ul>
                            </li>
                                                                                                                            <li>
                                <a href="produtos/bobinas/cupom_fiscal">Cupom Fiscal</a>
                                <ul>
                                                                                                                                                                                                                                                                                                                                                                <li>
                                                <a href="detalhes_produto/69/80mm_x_40mts_-_termica">80mm x 40mts - Térmica</a>
                                            </li>
                                                                                                                                                                                                            <li>
                                                <a href="detalhes_produto/67/80mmx30mts_-_termica">80mmx30mts - Térmica</a>
                                            </li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </ul>
                            </li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </ul>
            </li>
        </ul>
            <ul id="menu_vertical">
            <li>
                <a href="produtos/etiquetadoras">Etiquetadoras</a>
                <ul> 
                                                                                                                                                                                                                                                                                                        <li>
                                <a href="produtos/etiquetadoras/mc_len">MC LEN</a>
                                <ul>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <li>
                                                <a href="detalhes_produto/59/ml_-_8500">ML - 8500</a>
                                            </li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </ul>
                            </li>
                                                                                                                            <li>
                                <a href="produtos/etiquetadoras/fixxar">FIXXAR</a>
                                <ul>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <li>
                                                <a href="detalhes_produto/58/mx_5500_-_plus">MX 5500 - Plus</a>
                                            </li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </ul>
                            </li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </ul>
            </li>
        </ul>
            <ul id="menu_vertical">
            <li>
                <a href="produtos/etiquetas">Etiquetas</a>
                <ul> 
                                                                                                                                                                                                                                                                                                                                                                                                <li>
                                <a href="produtos/etiquetas/filizola_toledo">Filizola / Toledo</a>
                                <ul>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <li>
                                                <a href="detalhes_produto/65/60x60mm_-_filizola_toledo">60x60mm - Filizola / Toledo</a>
                                            </li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <li>
                                                <a href="detalhes_produto/64/60x50mm_-_filizola_toledo"> 60x50mm - Filizola / Toledo</a>
                                            </li>
                                                                                                                                                                                                            <li>
                                                <a href="detalhes_produto/61/60x25mm_-_filizola_toledo">60x25mm - Filizola / Toledo</a>
                                            </li>
                                                                                                                                                                                                            <li>
                                                <a href="detalhes_produto/62/60x30mm_-_filizola_toledo">60x30mm - Filizola / Toledo</a>
                                            </li>
                                                                                                                                                                                                            <li>
                                                <a href="detalhes_produto/63/60x40mm_-_filizola_toledo">60x40mm - Filizola / Toledo</a>
                                            </li>
                                                                                                                                                                                                                                                                                                                                                </ul>
                            </li>
                                                                                                                            <li>
                                <a href="produtos/etiquetas/mx_5500">MX 5500</a>
                                <ul>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <li>
                                                <a href="detalhes_produto/75/mx_5500_-_21x11cm">MX 5500 - 2.1x1.1cm</a>
                                            </li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </ul>
                            </li>
                                                                                                                            <li>
                                <a href="produtos/etiquetas/pico_1_l">Pico 1 L</a>
                                <ul>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <li>
                                                <a href="detalhes_produto/76/25x12cm_-_pico_1l">2.5x1.2cm - Pico 1L</a>
                                            </li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </ul>
                            </li>
                                                                                                                            <li>
                                <a href="produtos/etiquetas/pico_2l">Pico 2L</a>
                                <ul>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <li>
                                                <a href="detalhes_produto/77/31x19cm_-_pico_2l">3.1x1.9cm - Pico 2L</a>
                                            </li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </ul>
                            </li>
                                                                                                                            <li>
                                <a href="produtos/etiquetas/champion">Champion</a>
                                <ul>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <li>
                                                <a href="detalhes_produto/78/21x12cm_-_champion">2.1x1.2cm -  Champion</a>
                                            </li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </ul>
                            </li>
                                                                                                                            <li>
                                <a href="produtos/etiquetas/gondolas">Gôndolas</a>
                                <ul>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <li>
                                                <a href="detalhes_produto/66/90x30mm_-_amarela">90x30mm - Amarela</a>
                                            </li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </ul>
                            </li>
                                                                                                                                                                                                                                                                                                                                                                                </ul>
            </li>
        </ul>
            <ul id="menu_vertical">
            <li>
                <a href="produtos/ribbons">Ribbons</a>
                <ul> 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <li>
                                <a href="produtos/ribbons/resina">Resina</a>
                                <ul>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </ul>
                            </li>
                                                                                                                            <li>
                                <a href="produtos/ribbons/cera">Cera</a>
                                <ul>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </ul>
                            </li>
                                                                                                        </ul>
            </li>
        </ul>
            <ul id="menu_vertical">
            <li>
                <a href="produtos/tinteiros">Tinteiros</a>
                <ul> 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <li>
                                <a href="produtos/tinteiros/marca_rolete">Marca Rolete</a>
                                <ul>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </ul>
                            </li>
                                                            </ul>
            </li>
        </ul>
    </div>
<div id="conteudo2">
    <div id="detalhes_produto">
        <div id="coluna_foto">
            <div id="embala_produto_int">
                <a href="painel/img/arts_etiquetas/74_produtos_11263.jpg" rel='prettyPhoto[1]'><img src="painel/img/arts_etiquetas/74_produtos_11263.jpg" /></a>
            </div>
            <div id="mini"> 
                                    <div id="embala_mini"><a href="painel/img/arts_etiquetas/74_produtos_11263.jpg" rel='prettyPhoto[1]'><img src="painel/img/arts_etiquetas/74_produtos_11263.jpg" /></a></div>
                                    </div> 
        </div>
        <div id="coluna_descricao">
            <h3> 
                Sem Nome
            </h3>
            <div id="descricao_produto_int">
                <p><strong>Cod. Ref.: </strong>Sem Referência</p>
                <p>  Sem Descrição</p>
                <a href="http://www.artsbobinaseetiquetas.com.br/detalhes_produto/74/#conteudo_abas"  onclick="aba4()"><img src="imagens/solicite_orcamento.png" /></a>
            </div>
        </div>
    </div>
    <div id="abas">
        <ul>
            <li class="ativo" onclick="aba1(this)" style="cursor: pointer">Detalhes</li>
            <li class="inativo" onclick="aba2(this)" style="cursor: pointer">Dados Técnicos</li>
            <li class="inativo" onclick="aba3(this)" style="cursor: pointer">Vídeos</li>
        </ul>
        <div id="conteudo_abas">
            <div id="aba1">Detalhes Indisponíveis</div>
            <div id="aba2">Dados Técnicos Indisponíveis</div>
            <div id="aba3">
                                                        Nenhum Vídeo Disponível
                            </div>

            <div id="aba4">
                <div id='res'>
                    <div id="nome_produto"> - Sem Nome </div>
                   
                    <p>
                        <label for='nome'>Nome: </label>
                        <input  name="nome" type="text" class="nomemail valida"  id="nome" tabindex="1"  />
                    </p>
                    <p>
                        <input name="assunto" id="assunto" type="hidden" value="Orçamento enviado pelo site" />
                        <input name="produto" id="produto" type="hidden" value=" - Sem Nome " />
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
                    <input name="destinatario" type="hidden" id="destinatario" value="contato@artsbobinaseetiquetas.com.br, felipe.macedo@landsdigital.com.br " />
                    <p style="width:400px;">
                        <input type="submit" value="" class="bt_enviar" id="submit" tabindex="7" />
                    </p>
                </div>

            </div>
        </div>
    </div>

</div>
<div style="clear: both"></div><?php }} ?>