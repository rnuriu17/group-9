<?php

function exists($par = null) {
    return file_exists($par);
}

function jcontents($par = null) {
    return jdecode(file_get_contents($par));
}

function ucontents($par = null) {
    return file_get_contents($par);
}

function contents($file) {
    if (exists($file)) {
        return file_get_contents($file);
    }

    return false;
}

function put($file, $content = null, $flag = null) {
    return file_put_contents($file, $content, $flag);
}

function d($par = null) {
    return $_SERVER['DOCUMENT_ROOT'] . '/' . $par;
}

function p($par = null) {
    echo '<pre>';
    print_r($par);
    echo '</pre>';
}

function pp($par = null) {
    echo '<!----' . "\n";
    print_r($par);
    echo "\n" . ' --->';
}

function r($par = null) {
    $par = replace('.php', '', $par);
    $f = d() . $par . '.php';
    if (exists($f)) {
        require $f;
    }
}

function merge(...$arr) {
    return array_merge(...$arr);
}


function ex($a = null, $b = null) {
    $ex = explode($a, $b);
    if (is_array($ex)) {
        return explode($a, $b);
    } else {
        return [];
    }
}
function exf($a = null, $b = null) {
    $ex = explode($a, $b);
    return $ex[0] ?? null;
}
function exn($a = null, $b = null) {
    $ex = explode($a, $b);
    if (is_array($ex)) {
        return end($ex);
    } else {
        return null;
    }
}
function exc($a = null, $b = null) {
    return count(ex($a, $b));
}

function upper($par) {
    return strtoupper($par);
}

function lower($par) {
    return strtolower($par);
}

function chash($length = 6) {
    return substr(md5(time() . rand(1, 199999) . uniqid()), 0, $length);
}

function replace($a, $b, $c) {
    return str_replace($a, $b, $c);
}

function br($par) {
    echo $par . '<br>';
}

function nn($par) {
    echo "\n" . $par . "\n";
}

function jencode($par = null) {
    return json_encode($par);
}
function jdecode($par = null, $flag = true) {
    return json_decode($par, $flag);
}

function alert($par) {
    echo '<div style="
        position: fixed;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        background: #333;
        color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: lighter;
        z-index: 9999;
        font-family: Helvetica;
        font-size: 2em;
    "><span>' . $par . '</span></div>';
    die();
}
