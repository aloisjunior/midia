<?php
/**
 * Created by PhpStorm.
 * User: alois
 * Date: 28/09/2015
 * Time: 23:42
 */

if (!function_exists('mes_pt_br')) {
    /**
     * Converte data para formato pt-BR.
     *
     */
    function mes_pt_br($date = null)
    {


        $mes = date('m', strtotime($date));

        switch ($mes) {
            case 1:
                $mes = "Janeiro";
                break;
            case 2:
                $mes = "Fevereiro";
                break;
            case 3:
                $mes = "Março";
                break;
            case 4:
                $mes = "Abril";
                break;
            case 5:
                $mes = "Maio";
                break;
            case 6:
                $mes = "Junho";
                break;
            case 7:
                $mes = "Julho";
                break;
            case 8:
                $mes = "Agosto";
                break;
            case 9:
                $mes = "Setembro";
                break;
            case 10:
                $mes = "Outubro";
                break;
            case 11:
                $mes = "Novembro";
                break;
            case 12:
                $mes = "Dezembro";
                break;
        }

        return $mes;
    }
}

if (!function_exists('salvar_imagem')) {
    /**
     * Limpa link retirando acentos e espacos.
     *
     */
    function salvar_imagem($diretorio = null, $arquivo = null, $nome = null)
    {
        $file = $arquivo;
        $extension = $file->getClientOriginalExtension();

        $nome_arquivo = $nome . '.' . $extension;
        $link = 'uploads/' . $diretorio;

        if (file_exists($link . '/' . $nome_arquivo)) {
            File::delete($link . '/' . $nome_arquivo);
        }

        $file->move($link, $nome_arquivo);
        return $nome_arquivo;
    }
}

if (!function_exists('alterar_imagem')) {
    /**
     * Limpa link retirando acentos e espacos.
     *
     */
    function alterar_imagem($diretorio = null, $novoarquivo = null, $nomearquivonovo = null, $nomearquivoantigo = null)
    {
        File::delete('uploads/' . $diretorio . '/' . $nomearquivoantigo);

        $file = $novoarquivo;

        $file->move('uploads/' . $diretorio, $nomearquivonovo);
        return true;
    }
}


if (!function_exists('parseBladeCode')) {
    /**
     * compila variaveis blade
     *
     */
    function parseBladeCode($string, array $args = array())
    {

        $generated = \Illuminate\Support\Facades\Blade::compileString(html_entity_decode($string));

        //dd($generated);

        ob_start();
        extract($args, EXTR_SKIP);

        try {
            eval('?>' . $generated);
        } catch (\Exception $e) {
            ob_get_clean();
            throw $e;
        }

        $content = ob_get_clean();

        return $content;
    }
}

if (!function_exists('formataTag')) {
    /**
     * ajusta formato das tags
     *
     */
    function formataTag($string)
    {
        return \Illuminate\Support\Str::lower(trim($string));
    }
}

if (!function_exists('implodeArray')) {
    /**
     * ajusta formato das tags
     *
     */
    function implodeArray(Array $array)
    {
        return collect(array_flatten($array))->implode(',');
    }
}

if (!function_exists('toMoney')) {
    /**
     * ajusta formato de valores
     *
     */
    function toMoney($val, $symbol = '$', $r = 2)
    {
        $n = $val;
        $c = is_float($n) ? 1 : number_format($n, $r, ',', '.');
        $d = '.';
        $t = ',';
        $sign = ($n < 0) ? '-' : '';
        $i = $n = number_format(abs($n), $r, ',', '.');
        $j = (($j = strlen($i)) > 3) ? $j % 3 : 0;

        return $symbol . $sign . ($j ? substr($i, 0, $j) + $t : '') . preg_replace('/(\d{3})(?=\d)/', "$1" + $t, substr($i, $j));

    }
}

if (!function_exists('toNumberDB')) {
    /**
     * ajusta formato de valores para banco
     *
     */
    function toNumberDB($val, $r = 2)
    {
        $out = 0;

        if ((!is_null($val)) && ($val > 0)) {
            $n = str_replace('.', '', $val);
            $tmp = explode(',', $n);

            //dd($tmp);
            if ((count($tmp) == 1)) {
                $out = $tmp[0];
            } else {
                $out = number_format(($tmp[0] + ($tmp[1] / 100)), $r, '.', '');
            }
        }
        //dd($out);
        return $out;

    }
}

if (!function_exists('nl2br2')) {
    /**
     * faz quebra de linha no navegador
     *
     */
    function nl2br2($string)
    {
        $string = str_replace(array("\r\n", "\r", "\n"), "<br />", $string);
        return $string;
    }
}

if (!function_exists('get_enum_values')) {
    /**
     * faz quebra de linha no navegador
     *
     */

    function get_enum_values($table, $field)
    {
        $type = \Illuminate\Support\Facades\DB::statement("SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'")->row(0)->Type;
        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
        $enum = explode("','", $matches[1]);
        return $enum;
    }
}

if (!function_exists('codificar')) {
    /**
     * facade para rotina nativa de encriptação
     *
     */

    function codificar($valor)
    {
        try {
            $resultado = \Illuminate\Support\Facades\Crypt::encrypt($valor);
        } catch (\Exception $e) {
            $resultado = 0;
        }

        return $resultado;
    }
}

if (!function_exists('decodificar')) {
    /**
     * facade para rotina nativa de encriptação
     *
     */

    function decodificar($valor)
    {
        try {
            $resultado = \Illuminate\Support\Facades\Crypt::decrypt($valor);
        } catch (\Exception $e) {
            $resultado = 0;
        }

        return $resultado;
    }
}

if (!function_exists('listar_tags')) {
    /**
     * facade para rotina que lista campos taqs de uma tabela
     *
     */

    function listar_tags($lista, $campo_tag = 'tags')
    {
        $tags = array();

        $listatags = $lista;

//        dd($lista);

        if (count($listatags) > 0) {
            $tagstmp = array();

            foreach ($listatags as $reg) {
//                dd($reg);
                if (!(is_null($reg[$campo_tag])) && !(trim($reg[$campo_tag]) === '')) {
                    array_push($tagstmp, explode(",", $reg[$campo_tag]));
                }
            }

            foreach ($tagstmp as $tag) {
                $tags = array_merge($tags, $tag);
            }
            $tags = array_unique($tags);

            $final = array();

            foreach ($tags as $tag => $tmp) {
                $final[$tmp] = $tmp;
            }
            $tags = $final;
        }
        return array_unique($tags);
    }
}

if (!function_exists('formataTelefone')) {

    function formataTelefone($numero)
    {
        if (strlen($numero) == 10) {
            $novo = substr_replace($numero, '(', 0, 0);
            $novo = substr_replace($novo, '9', 3, 0);
            $novo = substr_replace($novo, ')', 3, 0);
        } else {
            $novo = substr_replace($numero, '(', 0, 0);
            $novo = substr_replace($novo, ')', 3, 0);
        }
        return $novo;
    }
}

if (!function_exists('mask')) {
    function mask($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '#') {
                if (isset($val[$k]))
                    $maskared .= $val[$k++];
            } else {
                if (isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }
}

if (!function_exists('somenteNumeros')) {
    function somenteNumeros($str)
    {
        return preg_replace("/[^0-9]/", "", $str);
    }
}


if (!function_exists('identifica_icone')) {
    /**
     * traz caminho do icone do tipo de arquivo de acordo com o arquivo
     *
     */
    function identifica_icone($arquivo)
    {
        $tmp = explode('.', $arquivo);

        $out = strtolower(end($tmp));

        $resultado = 'img/atonmidia/icons/filetype/' . $out . '.png';

        if (!file_exists($resultado)) {
            $resultado = 'img/atonmidia/icons/filetype/_blank.png';
        }

        return asset($resultado);
    }
}

if (!function_exists('getCDN')) {
    /**
     * traz caminho do icone do tipo de arquivo de acordo com o arquivo
     *
     */
    function getCDN($arquivo, $cdn = 'cdn2')
    {
        /*
         *  cdn2 => public
         *  cdn  => storage
         *
         * */
        $dev = env('APP_DEBUG', 'true') == 'true';


        if ($dev){
           return $arquivo;
        }else{
            $tamanho = strlen($arquivo);

            if ($arquivo[0] == '/'){
                $arquivo = substr($arquivo,1,$tamanho);
            }

//            echo('//'.$cdn.'.'.env('APP_DOMAIN').'/'.$arquivo);
            return '//'.$cdn.'.'.env('APP_DOMAIN').'/'.$arquivo;
        }

    }
}

if (!function_exists('is_str_contain')) {
    function is_str_contain($string, $keyword)
    {
        if (empty($string) || empty($keyword)) return false;
        $keyword_first_char = $keyword[0];
        $keyword_length = strlen($keyword);
        $string_length = strlen($string);

        // case 1
        if ($string_length < $keyword_length) return false;

        // case 2
        if ($string_length == $keyword_length) {
            if ($string == $keyword) return true;
            else return false;
        }

        // case 3
        if ($keyword_length == 1) {
            for ($i = 0; $i < $string_length; $i++) {

                // Check if keyword's first char == string's first char
                if ($keyword_first_char == $string[$i]) {
                    return true;
                }
            }
        }

        // case 4
        if ($keyword_length > 1) {
            for ($i = 0; $i < $string_length; $i++) {
                /*
                the remaining part of the string is equal or greater than the keyword
                */
                if (($string_length + 1 - $i) >= $keyword_length) {

                    // Check if keyword's first char == string's first char
                    if ($keyword_first_char == $string[$i]) {
                        $match = 1;
                        for ($j = 1; $j < $keyword_length; $j++) {
                            if (($i + $j < $string_length) && $keyword[$j] == $string[$i + $j]) {
                                $match++;
                            }
                            else {
                                return false;
                            }
                        }

                        if ($match == $keyword_length) {
                            return true;
                        }

                        // end if first match found
                    }

                    // end if remaining part
                }
                else {
                    return false;
                }

                // end for loop
            }

            // end case4
        }

        return false;
    }
}if (!function_exists('is_str_contain')) {
    function is_str_contain($string, $keyword)
    {
        if (empty($string) || empty($keyword)) return false;
        $keyword_first_char = $keyword[0];
        $keyword_length = strlen($keyword);
        $string_length = strlen($string);

        // case 1
        if ($string_length < $keyword_length) return false;

        // case 2
        if ($string_length == $keyword_length) {
            if ($string == $keyword) return true;
            else return false;
        }

        // case 3
        if ($keyword_length == 1) {
            for ($i = 0; $i < $string_length; $i++) {

                // Check if keyword's first char == string's first char
                if ($keyword_first_char == $string[$i]) {
                    return true;
                }
            }
        }

        // case 4
        if ($keyword_length > 1) {
            for ($i = 0; $i < $string_length; $i++) {
                /*
                the remaining part of the string is equal or greater than the keyword
                */
                if (($string_length + 1 - $i) >= $keyword_length) {

                    // Check if keyword's first char == string's first char
                    if ($keyword_first_char == $string[$i]) {
                        $match = 1;
                        for ($j = 1; $j < $keyword_length; $j++) {
                            if (($i + $j < $string_length) && $keyword[$j] == $string[$i + $j]) {
                                $match++;
                            }
                            else {
                                return false;
                            }
                        }

                        if ($match == $keyword_length) {
                            return true;
                        }

                        // end if first match found
                    }

                    // end if remaining part
                }
                else {
                    return false;
                }

                // end for loop
            }

            // end case4
        }

        return false;
    }
}

