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


$c = str_replace('@mobile', '@media (max-width: 860px)', $c);
$c = str_replace('@m {', '@media (max-width: 860px) {', $c);
echo $scss->compile($c);
