<?php

f()->dir('posts/');


function _post($par) {

    if (@$_POST['__type'] == $par) return true;
    else return false;
}

function post($par) {
    return @$_POST[$par];
}

function action($par) {
    return @$_GET['action'] == $par ? true : false;
}

function _action() {
    return @$_GET['action'];
}


function posts($exclude = null) {
    if (is_array($exclude)) {
        $posts = [];
        foreach ($_POST as $i => $s) {
            if (in_array($i, $exclude)) continue;
            $posts[$i] = $s;
        }
        return $posts;
    } else return $_POST;
}
