<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



if (!function_exists('busca_produtos_oc')) {

    function busca_produtos_oc($conexao = null, $limit=null, $orderby='RAND()') {
        $sql = "select p.product_id,p.price,pd.name,p.image from product p 
left outer join product_description pd on pd.product_id=p.product_id
where  p.status=1 ";
        //left outer join product_image pi on pi.product_id=p.product_id
//         $sq.=" order by RAND()";
        if($orderby){
            $sql.=" order by $orderby";
        }
        
        if($limit){
            $sql.=" limit $limit";
        }
        
 
        $CI = & get_instance();
        if ($conexao) {

            conecta_mbc($conexao);
        }

        $produtos = $CI->mbc->executa_sql($sql);
        foreach ($produtos as $produto) {
            $produto->categorias = busca_categorias_produto_oc($produto->product_id, $conexao);
            $produto->descontos = busca_descontos_produto_oc($produto->product_id, $conexao);
        }

//        ver($produtos);

        return $produtos;
    }

}

if (!function_exists('busca_descontos_produto_oc')) {

    function busca_descontos_produto_oc($id_produto, $conexao = null) {
        $data = date('Y-m-d');
        $sql = "select * from product_discount where date_start<='$data' and date_end>='$data' and product_id=$id_produto";
//         $sq.=" order by RAND()";
//        ver($sql);
        $CI = & get_instance();
        if ($conexao) {
            conecta_mbc($conexao);
        }
        return $CI->mbc->executa_sql($sql);
    }

}



if (!function_exists('busca_produtos_categoria_oc')) {

    function busca_produtos_categoria_oc($id_categoria, $conexao = null, $limit=null, $orderby='RAND()') {
        $sql = "select p.product_id,p.price,pd.name,p.image from product p 
left outer join product_description pd on pd.product_id=p.product_id
left outer join product_to_category pc on pc.product_id=p.product_id
where p.status=1 and pc.category_id=$id_categoria ";
        //group by pc.product_id
       if($orderby){
            $sql.=" order by $orderby";
        }
        
          if($limit){
            $sql.=" limit $limit";
        }
 
        $CI = & get_instance();
        if ($conexao) {
            conecta_mbc($conexao);
        }

        $produtos = $CI->mbc->executa_sql($sql);
        foreach ($produtos as $produto) {
            $produto->categorias = busca_categorias_produto_oc($produto->product_id, $conexao);
            $produto->descontos = busca_descontos_produto_oc($produto->product_id, $conexao);
        }
        return $produtos;
    }

}

function conecta_mbc($id_conexao = null) {
    $CI = & get_instance();
    $CI->load->database('default', null, true);
    if (isset($id_conexao)) {
//utilizada para o metodo load_data(consultas_etc)
        $con = $CI->model_banco->executa_sql("select * from conexoes where Id_int =$id_conexao");
    }

    $dados = array(
        'hostname' => $con[0]->Servidor_txf,
        'username' => $con[0]->Usuario_txf,
        'password' => $con[0]->Senha_txp,
        'database' => $con[0]->Database_txf,
        'dbdriver' => 'mysql',
        'dbprefix' => '',
        'pconnect' => TRUE,
        'db_debug' => TRUE,
        'cache_on' => FALSE,
        'cachedir' => '',
        'char_set' => 'utf8',
        'dbcollat' => 'utf8_general_ci',
        'swap_pre' => '',
        'autoinit' => TRUE,
        'stricton' => FALSE
    );



//            ver($CI->dados_conexao);
    $CI->mbc = $CI->load->model('model_banco_cliente', 'mbc', $dados);
    $CI->mbc->db = $CI->load->database($dados, TRUE);
    $CI->mbc->seta_idioma('pt_BR');
}

if (!function_exists('busca_categorias_produto_oc')) {

    function busca_categorias_produto_oc($id_produto, $conexao = null) {
        $sql = "select cd.*,pc.product_id from category c
 left outer join category_description cd on cd.category_id=c.category_id 
right outer join product_to_category pc on pc.category_id=c.category_id
where pc.product_id = $id_produto order by c.parent_id";

        $CI = & get_instance();

        if ($conexao) {
            conecta_mbc($conexao);
        }

        $categorias = $CI->mbc->executa_sql($sql);

//{$subcategorias=executa_sql('select c.parent_id, cd.* from category c left outer join category_description cd on cd.category_id=c.category_id where parent_id!=0;')}
//        ver($categorias);

        return $categorias;
    }

}


if (!function_exists('busca_categorias_oc')) {

    function busca_categorias_oc() {
        $sql = "select cd.* from category c left outer join category_description cd on cd.category_id=c.category_id where parent_id=0;";

        $CI = & get_instance();

        $categorias = $CI->mbc->executa_sql($sql);

//{$subcategorias=executa_sql('select c.parent_id, cd.* from category c left outer join category_description cd on cd.category_id=c.category_id where parent_id!=0;')}
//        ver($categorias);

        return $categorias;
    }

}
