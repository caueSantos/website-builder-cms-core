<?phpif (!defined('BASEPATH'))    exit('No direct script access allowed');if (!function_exists('status_jogo')) {    function status_aposta($jogo) {        if (!$jogo->Palpite[0]) {            return '<img src="imagens/icones/nao-apostou.png" data-toggle="tooltip" title="Não Apostou">';        }        if ($jogo->Casa_gols_txf == '' && $jogo->Fora_gols_txf == '') {            return '<img src="imagens/icones/aguardando-aposta.png" data-toggle="tooltip" title="Aguardando Resultado">';        }        if ($jogo->Casa_gols_txf > $jogo->Fora_gols_txf) {            $coluna = 1;        }        if ($jogo->Casa_gols_txf == $jogo->Fora_gols_txf) {            $coluna = 2;        }        if ($jogo->Fora_gols_txf > $jogo->Casa_gols_txf) {            $coluna = 3;        }        if ($jogo->Palpite[0]) {            if ($jogo->Palpite[0]->Coluna_txf == $coluna) {                return '<img src="imagens/icones/acertou-aposta.png" data-toggle="tooltip" title="Acertou">';            } else {                return '<img src="imagens/icones/errou-aposta.png" data-toggle="tooltip" title="Errou">';            }        }    }}if (!function_exists('status_aposta_usuario')) {    function status_aposta_usuario($jogo, $id_usuario) {        $palpite = executa_sql("select * from palpites where Jogos_for=$jogo->Id_int and Users_for=$id_usuario");        if ($jogo->Casa_gols_txf == '' && $jogo->Fora_gols_txf == '') {            return '<img src="imagens/icones/aguardando-aposta.png" data-toggle="tooltip" title="Aguardando Resultado">';        }        if ($jogo->Casa_gols_txf > $jogo->Fora_gols_txf) {            $coluna = 1;        }        if ($jogo->Casa_gols_txf == $jogo->Fora_gols_txf) {            $coluna = 2;        }        if ($jogo->Fora_gols_txf > $jogo->Casa_gols_txf) {            $coluna = 3;        }        if ($palpite[0]) {            if ($palpite[0]->Coluna_txf == $coluna) {                return '<img src="imagens/icones/acertou-aposta.png" data-toggle="tooltip" title="Acertou">';            } else {                return '<img src="imagens/icones/errou-aposta.png" data-toggle="tooltip" title="Errou">';            }        } else {            return '<img src="imagens/icones/nao-apostou.png" data-toggle="tooltip" title="Não Apostou">';        }    }}if (!function_exists('imagem_usuario')) {    function imagem_usuario($usuario) {        $ci = &get_instance();        $app = $ci->smarty->tpl_vars['app']->value;//        ver();        if ($usuario->Imagens[0]->Caminho_txf) {            return $app->Url_cliente . $app->Pasta_painel . $usuario->Imagens[0]->Caminho_txf;        } else {            if ($usuario->Foto_txf) {                return $usuario->Foto_txf;            } else {                return 'imagens/icones/sem-imagem.png';            }        }    }}if (!function_exists('pontos_aposta')) {    function pontos_aposta($jogo) {//ver($jogo);        if ($jogo->Casa_gols_txf == '' && $jogo->Fora_gols_txf == '') {            return 0;        }        if ($jogo->Casa_gols_txf > $jogo->Fora_gols_txf) {            $coluna = 1;        }        if ($jogo->Casa_gols_txf == $jogo->Fora_gols_txf) {            $coluna = 2;        }        if ($jogo->Fora_gols_txf > $jogo->Casa_gols_txf) {            $coluna = 3;        }        if ($jogo->Palpite[0]) {            if ($jogo->Palpite[0]->Coluna_txf == $coluna) {                return 1;            } else {                return 0;            }        }    }}if (!function_exists('pontos_aposta_usuario')) {    function pontos_aposta_usuario($jogo, $id_usuario) {        $palpite = executa_sql("select * from palpites where Jogos_for=$jogo->Id_int and Users_for=$id_usuario");//ver($jogo);        if ($jogo->Casa_gols_txf == '' && $jogo->Fora_gols_txf == '') {            return 0;        }        if ($jogo->Casa_gols_txf > $jogo->Fora_gols_txf) {            $coluna = 1;        }        if ($jogo->Casa_gols_txf == $jogo->Fora_gols_txf) {            $coluna = 2;        }        if ($jogo->Fora_gols_txf > $jogo->Casa_gols_txf) {            $coluna = 3;        }        if ($palpite[0]) {            if ($palpite[0]->Coluna_txf == $coluna) {                return 1;            } else {                return 0;            }        }    }}if (!function_exists('pontos_aposta_admin')) {    function pontos_aposta_admin($jogo, $palpite) {//ver($jogo);        if ($jogo->Casa_gols_txf == '' && $jogo->Fora_gols_txf == '') {            return 0;        }        if ($jogo->Casa_gols_txf > $jogo->Fora_gols_txf) {            $coluna = 1;        }        if ($jogo->Casa_gols_txf == $jogo->Fora_gols_txf) {            $coluna = 2;        }        if ($jogo->Fora_gols_txf > $jogo->Casa_gols_txf) {            $coluna = 3;        }        if ($palpite) {            if ($palpite->Coluna_txf == $coluna) {                return 1;            } else {                return 0;            }        }    }}if (!function_exists('retorna_nome_palpite')) {    function retorna_nome_palpite($palpite = null) {//ver($jogo);        switch ($palpite->Coluna_txf) {            case 1:                return '1';                break;            case 2:                return 'M';                break;            case 3:                return '2';                break;        }    }}if (!function_exists('verifica_liberacao')) {    function verifica_liberacao($rodada = null) {        $date_time = retorna_date_time();        if ($rodada == null) {            return false;            die('sem rodada');        }        if ($rodada->Data_inicio_dat <= $date_time) {            if ($rodada->Data_fim_dat >= $date_time) {                return 'ok';            } else {                return 'encerrada';            }        } else {            return 'aguarde';        }    }}