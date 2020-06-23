<?php

header("Content-type: text/css", true);

require 'vendor/autoload.php';


use ScssPhp\ScssPhp\Compiler;

$scss = new Compiler();

$b = './dist/css/';
$d = scandir($b);

foreach ($d as $i => $s) {

    if ($s != '.' && $s != '..') {

        $f = $b . $s;
        $ex = explode('.', $f);
        if (end($ex) == 'scss') {
            $c .= file_get_contents($f);
        }
    }
}

$b = './modules/';
$d = scandir($b);

foreach ($d as $i => $s) {

    if ($s != '.' && $s != '..') {
        $f = $b . $s . '/style.scss';
        if (file_exists($f)) {
            $c .= file_get_contents($f);
        }
    }
}

$c = str_replace('@mobile', '@media (max-width: 860px)', $c);
$c = str_replace('@m {', '@media (max-width: 860px) {', $c);
$c = str_replace('@center;', 'transform: translate(-50%, -50%); left: 50%; top: 50%;', $c);
$c = str_replace('@hcenter;', 'transform: translateX(-50%); left: 50%;', $c);
$c = str_replace('@vcenter;', 'transform: translateY(-50%); top: 50%;', $c);
$cc = $scss->compile($c);
echo $cc;
file_put_contents('style.min.css', $cc);
// echo '<script> setTimeout(function(){ location.reload(true); }, 1000);</script>';
