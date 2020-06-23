<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$b = './modules/';
$f = scandir($b);


if (file_exists('vendor/autoload.php')) require 'vendor/autoload.php';

foreach ($f as $i => $s) {
    if ($s == '.' || $s == '..') continue;
    $d = $b . $s;
    $r = $b . $s . '/index.php';
    if (file_exists($r)) $order[@file_get_contents($b . $s . '/order')][] = $r;

    foreach (scandir($d) as $ds) {
        $ex = explode('.module.', $ds);
        $isModule = @$ex[0] && @$ex[1] == 'php' ? true : false;
        $r = $d . '/' . $ds;
        if ($isModule) $order[@file_get_contents($b . $s . '/order')][] = $r;
    }
}


$b = './app/';
if (file_exists($b)) {
    $f = scandir($b);

    foreach ($f as $i => $s) {
        if ($s == '.' || $s == '..') continue;
        $d = $b . $s;

        if (is_dir($d)) {
            foreach (scandir($d) as $ds) {
                $rr = $d . '/' . $ds;
                $order[1950][] = $rr;
            }
        } else {
            $order[1950][] = $d;
        }
    }
}
ksort($order);


foreach ($order as $i => $s) {

    foreach ($s as $p) require $p;
}
