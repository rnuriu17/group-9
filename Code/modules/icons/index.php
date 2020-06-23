<?php


function icon($par, $data = null) {
    return '<div class="_icn">
    ' . str_replace('<svg ', '<svg style="' . $data . '" ', contents(d('dist/icons/' . $par . '.svg'))) . '
    </div>';
}

f()->dir('dist/icons/');
