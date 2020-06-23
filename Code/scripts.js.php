<?php

header("Content-type: application/javascript", true);


$c = '';
$require = explode("\n", file_get_contents('./dist/js/require'));
foreach ($require as $i => $file) {
    if ($file != '') {
        $b = './dist/js/';
        $f = $b . $file . '.js';
        $c .= file_get_contents($f);
    }
}


$b = './modules/';
$d = scandir($b);

foreach ($d as $i => $s) {

    if ($s != '.' && $s != '..') {
        $f = $b . $s . '/script.js';
        if (file_exists($f)) {
            $c .= file_get_contents($f);
        }
    }
}

echo $c;
// file_put_contents('app.min.js', $c);
