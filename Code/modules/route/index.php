<?php


function get($par) {
    if ($par == 1) $par = 'a';
    if ($par == 2) $par = 'b';
    if ($par == 3) $par = 'c';
    if ($par == 4) $par = 'd';
    if ($par == 5) $par = 'e';
    if ($par == 6) $par = 'f';
    if ($par == 7) $par = 'g';
    return @$_GET[$par];
}

function _get($par) {

    $full_url = fullUrl();

    $pp = ex('?', $full_url);

    $gets = [];

    if (@$pp[1] && @$pp[0]) {

        $url = $pp[1];

        $and = explode('&', $url);


        if (@$and[1]) {

            foreach ($and as $i => $s) {

                $ex = explode('=', $s);
                if (@$ex[0] && @$ex[1]) $gets[$ex[0]] = $ex[1];
            }
        } else {
            $ex = explode('=', $url);
            if (@$ex[0] && @$ex[1]) $gets[$ex[0]] = $ex[1];
        }
    }

    return @$gets[$par];
}


function redirect($url = null, $host = url, $s = 0) {

    echo '<script> setTimeout(function () { window.location="' . $host . $url . '"; }, ' . $s . '000); </script>';
}


function _redirect($url = null, $s = 0) {

    echo '<script> setTimeout(function () { window.location="' . $url . '"; }, ' . $s . '000); </script>';
}


function refresh($s = 0) {

    echo '<script> setTimeout(function () { location.reload(); }, ' . $s . '000); </script>';
}

function Slugify($text = null) {
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}


function page($url = null) {

    if (@$_POST) return false;


    $full_url = fullUrl();
    $pp = ex('?', $full_url);

    if (@$pp[1] && @$pp[0]) $full_url = $pp[0];


    $ex = ex('/', $url);

    $a = replace(url, '', $full_url);

    $rex = ex('/', $a);

    foreach ($ex as $i => $s) {

        if (@$rex[$i] != $s && $s != '$') return false;
    }

    if (count($ex) != count($rex)) return false;

    return true;
}

f()->dir(('pages/'));
