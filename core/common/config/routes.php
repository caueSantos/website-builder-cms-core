<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function eh_lands() {
    if ($_SERVER['REMOTE_ADDR'] == '45.229.106.60') {
        return true;
    } else {
        return false;
    }
}

function ve($var = null, $encerrar = '0') {


    if ($_SERVER['REMOTE_ADDR'] == '45.229.106.60') {


        echo '<br>******************** debug *******************<br>';

        echo '        <br><br><pre>';
        if ($var) {
            print_r($var);
        } else {
            print_r('empty');
        }

        echo '    <br>    <br></pre><br>*************** encerrou o debug ***************<br><br><br>';
        if ($encerrar == '0')
            die('programa encerrado propositalmente');
    }
}

$route['autoriza_mautic'] = "mautic/index/$1";

$route['robots.txt'] = 'robots/robots/index/$1';

$tipo_app = TIPO_APP;

switch ($tipo_app) {
    case 'config':
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['adminer'] = 'adminer';
        $route['ws/(:any)'] = 'ws/index/$1';
        $route['ws'] = 'ws';


        $route['login/(:any)'] = "login/$1";
        $route['login'] = "login";
        $route['logout'] = "login/logout";
        $route['backup'] = 'backup';
        $route['backup/(:any)'] = 'backup/index/$1';
        $route['default_controller'] = "config/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "config/index/$1";
        break;
    case 'site_simples':
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['minhafesta'] = 'minhafesta';
        $route['minhafesta/(:any)'] = 'minhafesta/index/$1';
        $route['sim'] = 'sim';
        $route['sim/(:any)'] = 'sim/index/$1';
        $route['boleto/(:any)'] = "boleto/index/$1";
        $route['boleto'] = "boleto";
        $route['ws/(:any)'] = 'ws/index/$1';
        $route['ws'] = 'ws';
        $route['atualize'] = 'atualize';
        $route['stats/(:any)'] = 'stats/$1';
        $route['stats'] = 'stats';
        $route['face/(:any)'] = 'face/$1';
        $route['face'] = 'face';
        $route['adminer'] = 'adminer';
        $route['(:any)/config'] = 'config/$1';
        $route['config/(:any)'] = 'config/$1';
        $route['login/(:any)'] = "login/$1";
        $route['config'] = "config";
        $route['login'] = "login";
        $route['admin'] = "admin";
        $route['arquivos/(:any)'] = "arquivos/index/$1";
        $route['arquivos'] = "arquivos";
        $route['default_controller'] = "site_simples/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "site_simples/index/$1";
        break;
    case 'suporte_lands':
        $route['super_ajax/(:any)'] = 'super_ajax/index/$1';
        $route['super_ajax'] = 'super_ajax';
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['post_ajax/(:any)/(:any)'] = 'post_ajax/router';
        $route['post_ajax/(:any)'] = 'post_ajax/router';
        $route['post_ajax'] = 'post_ajax';
        $route['atualize'] = 'atualize';
        $route['login/(:any)'] = "login/$1";
        $route['login'] = "login";
        $route['logout'] = "login/logout";
        $route['default_controller'] = "suporte_lands/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "suporte_lands/index/$1";
        break;

    case 'site':
        $route['super_ajax/(:any)'] = 'super_ajax/index/$1';
        $route['super_ajax'] = 'super_ajax';
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['post_ajax/(:any)/(:any)'] = 'post_ajax/router';
        $route['post_ajax/(:any)'] = 'post_ajax/router';
        $route['post_ajax'] = 'post_ajax';
        $route['minhafesta'] = 'minhafesta';
        $route['minhafesta/(:any)'] = 'minhafesta/index/$1';
        $route['restrita'] = 'restrita';
        $route['restrita/(:any)'] = 'restrita/index/$1';
        $route['relatorios'] = 'relatorios';
        $route['relatorios/(:any)'] = 'relatorios/index/$1';
        $route['rest'] = 'rest';
        $route['rest/(:any)'] = 'rest/$1';
        $route['ws/(:any)'] = 'ws/index/$1';
        $route['ws'] = 'ws';

        $route['cron_solution/(:any)'] = 'cron_solution/index/$1';
        $route['cron_solution'] = 'cron_solution';


        $route['atualize'] = 'atualize';
        $route['stats/(:any)'] = 'stats/$1';
        $route['stats'] = 'stats';
        $route['face/(:any)'] = 'face/$1';
        $route['face'] = 'face';
        $route['adminer'] = 'adminer';
        $route['(:any)/config'] = 'config/$1';
        $route['config/(:any)'] = 'config/$1';
        $route['config'] = "config";

        $route['login/(:any)'] = "login/$1";
        $route['login'] = "login";
        $route['logout'] = "login/logout";

                $route['mercadolivre/(:any)'] = "mercadolivre/index/$1";
        $route['mercadolivre'] = 'mercadolivre';


        $route['exportar'] = 'frontend/exportar/index/$1';
        $route['exportar/(:any)'] = 'frontend/exportar/index/$1';

        $route['admin'] = "admin";
        $route['resultados_exames'] = "modulo_exames/index/$1";
        $route['arquivos/(:any)'] = "arquivos/index/$1";
        $route['arquivos'] = "arquivos";
        $route['default_controller'] = "frontend/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "frontend/index/$1";
        break;

    case 'smtpreport':
        $route['login/(:any)'] = "login/$1";
        $route['login'] = "login";
        $route['logout'] = "login/logout";
        $route['default_controller'] = "smtpreport/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "smtpreport/index/$1";
        break;

    case 'mautic':
//        $route['login/(:any)'] = "login/$1";
//        $route['login'] = "login";
//        $route['logout'] = "login/logout";
        $route['default_controller'] = "mautic/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "mautic/index/$1";
        break;

    case 'laboratorio_humano':

        $route['rest'] = 'rest_lab';
        $route['rest/(:any)'] = 'rest_lab/$1';
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['post_ajax/(:any)/(:any)'] = 'post_ajax/router';
        $route['post_ajax/(:any)'] = 'post_ajax/router';
        $route['login/(:any)'] = "login/$1";
        $route['login'] = "login";
        $route['logout'] = "login/logout";
        $route['default_controller'] = "frontend/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "frontend/index/$1";
        break;
    case 'opencart_img':
        $route['login/(:any)'] = "login/$1";
        $route['login'] = "login";
        $route['default_controller'] = "opencart_img/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "opencart_img/index/$1";
        break;
    case 'imobiliaria':
        $route['super_ajax/(:any)'] = 'super_ajax/index/$1';
        $route['super_ajax'] = 'super_ajax';
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['post_ajax/(:any)/(:any)'] = 'post_ajax/router';
        $route['post_ajax/(:any)'] = 'post_ajax/router';
        $route['post_ajax'] = 'post_ajax';

        $route['importar'] = 'imobiliaria/importar/index/$1';
        $route['importar/(:any)'] = 'imobiliaria/importar/index/$1';

        $route['vivareal'] = 'imobiliaria/vivareal/index/$1';
        $route['vivareal/(:any)'] = 'imobiliaria/vivareal/index/$1';

        $route['ingaia'] = 'imobiliaria/ingaia/index/$1';
        $route['ingaia/(:any)'] = 'imobiliaria/ingaia/index/$1';


        $route['relatorios'] = 'relatorios';
        $route['relatorios/(:any)'] = 'relatorios/index/$1';
        $route['atualize'] = 'atualize';
        $route['stats/(:any)'] = 'stats/$1';
        $route['stats'] = 'stats';
        $route['adminer'] = 'adminer';
        $route['login/(:any)'] = "login/$1";
        $route['login'] = "login";
        $route['logout'] = "login/logout";
        $route['admin'] = "admin";
        $route['default_controller'] = "imobiliaria/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "imobiliaria/index/$1";
        break;
    case 'garagem':
        $route['super_ajax/(:any)'] = 'super_ajax/index/$1';
        $route['super_ajax'] = 'super_ajax';
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['post_ajax/(:any)/(:any)'] = 'post_ajax/router';
        $route['post_ajax/(:any)'] = 'post_ajax/router';
        $route['post_ajax'] = 'post_ajax';


        $route['relatorios'] = 'relatorios';
        $route['relatorios/(:any)'] = 'relatorios/index/$1';
        $route['atualize'] = 'atualize';
        $route['stats/(:any)'] = 'stats/$1';
        $route['stats'] = 'stats';
        $route['adminer'] = 'adminer';
        $route['login/(:any)'] = "login/$1";
        $route['login'] = "login";
        $route['logout'] = "login/logout";
        $route['admin'] = "admin";
        $route['default_controller'] = "garagem/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "garagem/index/$1";
        break;

    case 'rest_server':
        $route['default_controller'] = "rest";
        $route['(:any)'] = "rest/index/$1";
        break;
    case 'lab_ws':
        $route['default_controller'] = "rest_lab";
        $route['(:any)'] = "rest_lab/index/$1";
        break;
    case 'lab_cron':
        $route['login/(:any)'] = "login/$1";
        $route['login'] = "login";
        $route['logout'] = "login/logout";

        $route['default_controller'] = "lab_cron/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "lab_cron/index/$1";
        break;
    case 'lafi_agenda':
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['post_ajax/(:any)/(:any)'] = 'post_ajax/router';
        $route['post_ajax/(:any)'] = 'post_ajax/router';
        $route['post_ajax'] = 'post_ajax';
        $route['relatorios'] = 'relatorios';
        $route['relatorios/(:any)'] = 'relatorios/index/$1';
        $route['ws/(:any)'] = 'ws/index/$1';
        $route['ws'] = 'ws';
        $route['atualize'] = 'atualize';
        $route['login/(:any)'] = "login/$1";
        $route['login'] = "login";
        $route['logout'] = "login/logout";
        $route['admin'] = "admin";
        $route['default_controller'] = "lafi_agenda/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "lafi_agenda/index/$1";
        break;
    case 'hotsite':
        $route['super_ajax/(:any)'] = 'super_ajax/index/$1';
        $route['super_ajax'] = 'super_ajax';
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['relatorios'] = 'relatorios';
        $route['relatorios/(:any)'] = 'relatorios/index/$1';
        $route['atualize'] = 'atualize';
        $route['login/(:any)'] = "login/$1";
        $route['login'] = "login";
        $route['logout'] = "login/logout";
        $route['admin'] = "admin";
        $route['default_controller'] = "hotsite/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "hotsite/index/$1";
        break;
    case 'assinaturas':
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['relatorios'] = 'relatorios';
        $route['relatorios/(:any)'] = 'relatorios/index/$1';
        $route['admin'] = "admin";
        $route['default_controller'] = "assinaturas/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "assinaturas/index/$1";
        break;
    case 'mala_direta':
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['relatorios'] = 'relatorios';
        $route['relatorios/(:any)'] = 'relatorios/index/$1';
        $route['admin'] = "admin";
        $route['default_controller'] = "landsmail/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "landsmail/index/$1";
        break;

    case 'landing':
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';

        $route['ws/(:any)'] = 'ws/index/$1';
        $route['ws'] = 'ws';

        $route['admin'] = "admin";
        $route['default_controller'] = "landing/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "landing/index/$1";
        break;

//    case 'mercado_livre':
//        $route['post/(:any)/(:any)'] = 'post/router';
//        $route['post/(:any)'] = 'post/router';
//        $route['post'] = 'post';
//        $route['relatorios'] = 'relatorios';
//        $route['relatorios/(:any)'] = 'relatorios/index/$1';
//        $route['admin'] = "admin";
//        $route['default_controller'] = "mercadolivre/index/$1";
//        $route['404_override'] = '';
//        $route['(:any)'] = "mercadolivre/index/$1";
//        break;
    case 'site_multi':
        //  ve('dd');
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['ws/(:any)'] = 'ws/index/$1';
        $route['ws'] = 'ws';
        $route['atualize'] = 'atualize';
        $route['stats/(:any)'] = 'stats/$1';
        $route['stats'] = 'stats';
        $route['face/(:any)'] = 'face/$1';
        $route['face'] = 'face';
        $route['adminer'] = 'adminer';
        $route['(:any)/config'] = 'config/$1';
        $route['config/(:any)'] = 'config/$1';
        $route['config'] = "config";
        $route['admin'] = "admin";
        $route['(:any)/relatorios'] = 'relatorios/index/$1';
        $route['(:any)/relatorios/(:any)'] = 'relatorios/index/$1';
        $route['login'] = 'login';
        $route['login/(:any)'] = 'login/$1';
        $route['arquivos/(:any)'] = "arquivos/index/$1";
        $route['arquivos'] = "arquivos";
        $route['default_controller'] = "frontend_multi/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "frontend_multi/index/$1";
        break;
    case 'blog':
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['adminer'] = 'adminer';
        $route['ws/(:any)'] = 'ws/index/$1';
        $route['ws'] = 'ws';
        $route['(:any)/config'] = 'config/$1';
        $route['config/(:any)'] = 'config/$1';
        $route['default_controller'] = "blog/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "blog/index/$1";
        break;
    case 'painel':
//        $route['post/(:any)/(:any)'] = 'post/router';
//        $route['post/(:any)'] = 'post/router';
//        $route['post'] = 'post';



        $route['gerenciador'] = 'painel/gerenciador/index/$1';
        $route['gerenciador/(:any)'] = 'painel/gerenciador/index/$1';


        $route['migracao/(:any)'] = 'painel/migracao/index/$1';
        $route['migracao'] = 'painel/migracao/index/$1';


//        $route['gerenciador/(:any)/(:any)'] = 'painel/gerenciador/index/$1';
//        $route['gerenciador/(:any)/(:any)/(:any)'] = 'painel/gerenciador/index/$1';
        $route['logout'] = 'painel/login/logout';
        $route['login'] = 'painel/login';
        $route['login/(:any)'] = 'painel/login/$1';

        $route['backup'] = 'backup';
        $route['backup/(:any)'] = 'backup/index/$1';
        $route['default_controller'] = "painel/principal/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "painel/principal/index/$1";
        break;
    case 'ws':
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['consultar'] = 'consultar';
        $route['consultar/(:any)'] = 'consultar/index/$1';
        $route['acao'] = 'acao';
        $route['acao/(:any)'] = 'acao/index/$1';
        $route['sim'] = 'sim';
        $route['sim/(:any)'] = 'sim/index/$1';
        $route['ws/(:any)'] = 'ws/index/$1';
        $route['ws'] = 'ws';
        $route['atualize'] = 'atualize';
        $route['stats/(:any)'] = 'stats/$1';
        $route['stats'] = 'stats';
        $route['face/(:any)'] = 'face/$1';
        $route['face'] = 'face';
        $route['adminer'] = 'adminer';
        $route['(:any)/config'] = 'config/$1';
        $route['config/(:any)'] = 'config/$1';
        $route['login/(:any)'] = "login/$1";
        $route['config'] = "config";
        $route['login'] = "login";
        $route['admin'] = "admin";
        $route['arquivos/(:any)'] = "arquivos/index/$1";
        $route['arquivos'] = "arquivos";
        $route['default_controller'] = "webservice/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "webservice/index/$1";
        break;
    case 'blog_avancado':
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['adminer'] = 'adminer';
        $route['admin'] = "admin";
        $route['ws/(:any)'] = 'ws/index/$1';
        $route['ws'] = 'ws';
        $route['(:any)/config'] = 'config/$1';
        $route['config/(:any)'] = 'config/$1';
        $route['relatorios'] = 'relatorios';
        $route['relatorios/(:any)'] = 'relatorios/index/$1';


        $route['gerenciador'] = 'painel/gerenciador/index/$1';
        $route['gerenciador/(:any)'] = 'painel/gerenciador/index/$1';

        $route['exportar'] = 'blog_avancado/exportar/index/$1';
        $route['exportar/(:any)'] = 'blog_avancado/exportar/index/$1';
        $route['importar'] = 'blog_avancado/importar/index/$1';
        $route['importar/(:any)'] = 'blog_avancado/importar/index/$1';

        $route['default_controller'] = "blog_avancado/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "blog_avancado/index/$1";
        break;
    case 'blog_lafi':
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['adminer'] = 'adminer';
        $route['ws/(:any)'] = 'ws/index/$1';
        $route['ws'] = 'ws';
        $route['(:any)/config'] = 'config/$1';
        $route['config/(:any)'] = 'config/$1';
        $route['relatorios'] = 'relatorios';
        $route['relatorios/(:any)'] = 'relatorios/index/$1';
        $route['login/(:any)'] = "login/$1";
        $route['login'] = "login";
        $route['logout'] = "login/logout";
        $route['default_controller'] = "blog_lafi/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "blog_lafi/index/$1";
        break;
    case 'blog_espaco_orante':
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['adminer'] = 'adminer';
        $route['ws/(:any)'] = 'ws/index/$1';
        $route['ws'] = 'ws';
        $route['(:any)/config'] = 'config/$1';
        $route['config/(:any)'] = 'config/$1';
        $route['default_controller'] = "espaco_orante/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "espaco_orante/index/$1";
        break;
    case 'revendedores':
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['ws/(:any)'] = 'ws/index/$1';
        $route['ws'] = 'ws';
        $route['atualize'] = 'atualize';
        $route['stats/(:any)'] = 'stats/$1';
        $route['stats'] = 'stats';
        $route['face/(:any)'] = 'face/$1';
        $route['face'] = 'face';
        $route['adminer'] = 'adminer';
        $route['(:any)/config'] = 'config/$1';
        $route['config/(:any)'] = 'config/$1';
        $route['login/(:any)'] = "login/$1";
        $route['config'] = "config";
        $route['login'] = "login";
        $route['admin'] = "admin";
        $route['arquivos/(:any)'] = "arquivos/index/$1";
        $route['arquivos'] = "arquivos";
        $route['default_controller'] = "sistema_revendedores/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "sistema_revendedores/index/$1";
        break;
    case 'camara':
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['ws/(:any)'] = 'ws/index/$1';
        $route['ws'] = 'ws';
        $route['login'] = "login";
        $route['admin'] = "admin";
        $route['default_controller'] = "camara/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "camara/index/$1";
        break;
    case 'whmcs':
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['ws/(:any)'] = 'ws/index/$1';
        $route['ws'] = 'ws';
        $route['login/(:any)'] = "login/$1";
        $route['login'] = "login";

        $route['hubspot'] = 'whmcs/hubspot/index/$1';
        $route['hubspot/(:any)'] = 'whmcs/hubspot/index/$1';
        $route['default_controller'] = "whmcs/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "whmcs/index/$1";
        break;
    case 'exames':
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['ws/(:any)'] = 'ws/index/$1';
        $route['ws'] = 'ws';
        $route['login/(:any)'] = "login/$1";
        $route['logout'] = "login/logout";
        $route['config'] = "config";
        $route['login'] = "login";
        $route['admin'] = "admin";
        $route['default_controller'] = "modulo_exames/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "modulo_exames/index/$1";
        break;
    case 'app_lab':
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['restrita'] = 'app_lab';
        $route['restrita/(:any)'] = 'app_lab/index/$1';
        $route['login/(:any)'] = "login/$1";
        $route['logout'] = "login/logout";
        $route['login'] = "login";
        $route['admin'] = "admin";
        $route['default_controller'] = "app_lab/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "app_lab/index/$1";
        break;

    case 'app_generico':
        $route['super_ajax/(:any)'] = 'super_ajax/index/$1';
        $route['super_ajax'] = 'super_ajax';
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['login/(:any)'] = "login/$1";
        $route['logout'] = "login/logout";
        $route['login'] = "login";
        $route['admin'] = "admin";
        $route['default_controller'] = "apps/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "apps/index/$1";
        break;
    case 'tecmin_integracao':
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['login/(:any)'] = "login/$1";
        $route['logout'] = "login/logout";
        $route['login'] = "login";

        $route['default_controller'] = "tecmin_integracao/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "tecmin_integracao/index/$1";
        break;
    case 'autogestor':
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['login/(:any)'] = "login/$1";
        $route['logout'] = "login/logout";
        $route['login'] = "login";

        $route['default_controller'] = "autogestor/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "autogestor/index/$1";
        break;
    case 'labcloud':

        $route['rest'] = 'rest';
        $route['rest/(:any)'] = 'rest/$1';
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['post_ajax/(:any)/(:any)'] = 'post_ajax/router';
        $route['post_ajax/(:any)'] = 'post_ajax/router';
        $route['post_ajax'] = 'post_ajax';
        $route['ws/(:any)'] = 'ws/index/$1';
        $route['ws'] = 'ws';
        $route['atualize'] = 'atualize';
        $route['login/(:any)'] = "login/$1";
        $route['login'] = "login";
        $route['default_controller'] = "labcloud/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "labcloud/index/$1";
        break;
    case 'landspay':
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';

        $route['admin'] = 'landspay/admin/index/$1';
        $route['admin/(:any)'] = 'landspay/admin/index/$1';

        $route['boleto/(:any)'] = "boleto/index/$1";
        $route['boleto'] = "boleto";
        $route['login/(:any)'] = "login/$1";
        $route['login'] = "login";
        $route['default_controller'] = "landspay/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "landspay/index/$1";
        break;
    case 'landspayv2':
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';

        $route['cron/(:any)'] = 'landspayv2/cron/index/$1';
        $route['cron'] = 'landspayv2/cron/index/$1';

        $route['admin'] = 'landspayv2/admin/index/$1';
        $route['admin/(:any)'] = 'landspayv2/admin/index/$1';


        $route['ws'] = 'landspayv2/webservice/$1';
        $route['ws/(:any)'] = 'landspayv2/webservice/$1';



        $route['boleto/(:any)'] = "boleto/index/$1";
        $route['boleto'] = "boleto";
        $route['login/(:any)'] = "login/$1";
        $route['login'] = "login";
        $route['default_controller'] = "landspayv2/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "landspayv2/index/$1";
        break;
    case 'blog_hiperofertas':
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['adminer'] = 'adminer';
        $route['ws/(:any)'] = 'ws/index/$1';
        $route['ws'] = 'ws';
        $route['(:any)/config'] = 'config/$1';
        $route['config/(:any)'] = 'config/$1';
        $route['relatorios'] = 'relatorios';
        $route['relatorios/(:any)'] = 'relatorios/index/$1';
        $route['default_controller'] = "blog_hiperofertas/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "blog_hiperofertas/index/$1";
        break;
    case 'hiperofertas':
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['default_controller'] = "hiperofertas/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "hiperofertas/index/$1";
        break;
    case 'embando':
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['default_controller'] = "embando/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "embando/index/$1";
        break;
    case 'eventools':
        $route['atualize'] = 'atualize';
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['ws/(:any)'] = 'ws/index/$1';
        $route['ws'] = 'ws';
        $route['cron/(:any)'] = 'eventos/cron_eventos/index/$1';
        $route['cron'] = 'eventos/cron_eventos/index/$1';

        $route['login/(:any)'] = "login/$1";
        $route['login'] = "login";
        $route['default_controller'] = "eventos/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "eventos/index/$1";
        break;
    case 'bolao':
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['post_ajax/(:any)/(:any)'] = 'post_ajax/router';
        $route['post_ajax/(:any)'] = 'post_ajax/router';
        $route['post_ajax'] = 'post_ajax';
        $route['relatorios'] = 'relatorios';
        $route['relatorios/(:any)'] = 'relatorios/index/$1';
        $route['admin'] = 'bolao_admin';
        $route['admin/(:any)'] = 'bolao_admin/index/$1';
        $route['ws/(:any)'] = 'ws/index/$1';
        $route['ws'] = 'ws';
        $route['atualize'] = 'atualize';
        $route['login/(:any)'] = "login/$1";
        $route['login'] = "login";
        $route['default_controller'] = "bolao/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "bolao/index/$1";
        break;
    case 'pitacos':
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['post_ajax/(:any)/(:any)'] = 'post_ajax/router';
        $route['post_ajax/(:any)'] = 'post_ajax/router';
        $route['post_ajax'] = 'post_ajax';
        $route['relatorios'] = 'relatorios';
        $route['relatorios/(:any)'] = 'relatorios/index/$1';
//        $route['admin'] = 'pitacos_admin';
//        $route['admin/(:any)'] = 'pitacos_admin/index/$1';

        $route['admin'] = 'pitacos/admin';
        $route['admin/(:any)'] = 'pitacos/admin/index/$1';

//        $route['ws'] = 'pitacos/ws';
//        $route['ws/(:any)'] = 'pitacos/ws/index/$1';

        $route['ws/(:any)'] = "pitacos/webservice/$1";
        $route['ws'] = "pitacos/webservice/$1";


        $route['atualize'] = 'atualize';
        $route['login/(:any)'] = "login/$1";
        $route['login'] = "login";
        $route['default_controller'] = "pitacos/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "pitacos/index/$1";
        break;
    case 'core_novo':
        $route['post/(:any)/(:any)'] = 'post/router';
        $route['post/(:any)'] = 'post/router';
        $route['post'] = 'post';
        $route['post_ajax/(:any)/(:any)'] = 'post_ajax/router';
        $route['post_ajax/(:any)'] = 'post_ajax/router';
        $route['post_ajax'] = 'post_ajax';
        $route['minhafesta'] = 'minhafesta';
        $route['minhafesta/(:any)'] = 'minhafesta/index/$1';
        $route['restrita'] = 'restrita';
        $route['restrita/(:any)'] = 'restrita/index/$1';
        $route['sim'] = 'sim';
        $route['sim/(:any)'] = 'sim/index/$1';
        $route['ws/(:any)'] = 'ws/index/$1';
        $route['ws'] = 'ws';






        $route['atualize'] = 'atualize';
        $route['stats/(:any)'] = 'stats/$1';
        $route['stats'] = 'stats';
        $route['face/(:any)'] = 'face/$1';
        $route['face'] = 'face';
        $route['adminer'] = 'adminer';
        $route['(:any)/config'] = 'config/$1';
        $route['config/(:any)'] = 'config/$1';
        $route['login/(:any)'] = "login/$1";
        $route['config'] = "config";
        $route['login'] = "login";
        $route['admin'] = "admin";
        $route['arquivos/(:any)'] = "arquivos/index/$1";
        $route['arquivos'] = "arquivos";
        $route['default_controller'] = "frontend/index/$1";
        $route['404_override'] = '';
        $route['(:any)'] = "frontend/index/$1";
        break;
    default:
        die("tipo de app {$tipo_app} nao configurado");
        break;
}





/* End of file routes.php */
/* Location: ./application/config/routes.php */
