<?php /*%%SmartyHeaderCode:9709600425132bb5cdef242-62013210%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '481216988df04da393a7914555f7d67420a7a0c4' => 
    array (
      0 => '481216988df04da393a7914555f7d67420a7a0c4',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '9709600425132bb5cdef242-62013210',
  'variables' => 
  array (
    'menus_indisponiveis' => 0,
    'value_menus' => 0,
    'menu_arr' => 0,
    'menu_institucional' => 0,
    'menu' => 0,
    'menu_produtos' => 0,
    'menu_prod' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5132bb5cedcde4_57348230',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5132bb5cedcde4_57348230')) {function content_5132bb5cedcde4_57348230($_smarty_tpl) {?>    <ul id='menu'>
    <li><a href="inicio"  >Início</a></li>
    <li></li>
            <li>
            <a href="empresa" >Empresa</a>
                            <ul id="menu_produtos">
                                                    <li><a href="empresa/8/quem_somos" >Quem Somos</a></li>
                                    <li><a href="empresa/9/missao" >Missão</a></li>
                                    <li><a href="empresa/11/valores" >Valores</a></li>
                                    <li><a href="empresa/13/politica_de_qualidade" >Política de Qualidade</a></li>
                                                </ul>
                    <li>
                            <a href="produtos" >Produtos</a>
                            <ul id="menu_produtos">
                                                    <li><a href="produtos/aplicador_de_pinus" >Aplicador de Pinus</a></li>
                                    <li><a href="produtos/bobinas" >Bobinas</a></li>
                                    <li><a href="produtos/etiquetadoras" >Etiquetadoras</a></li>
                                    <li><a href="produtos/etiquetas" >Etiquetas</a></li>
                                    <li><a href="produtos/ribbons" >Ribbons</a></li>
                                    <li><a href="produtos/tinteiros" >Tinteiros</a></li>
                                                </ul>
                    </li>
                <li><a href="promocoes">Promoções</a></li>

                <li><a href="representantes" >Representantes</a></li>

                <li><a href="noticias" >Notícias</a></li>
        
        <li><a href="dicas" >Dicas</a></li>

            
        <li><a href="contato" >Contato</a></li>
    
</ul><?php }} ?>