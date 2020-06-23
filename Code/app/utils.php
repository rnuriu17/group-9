<?php

function timo() {
    return time() . '-' . rand(1, 10000);
}

function code($l = 5) {
    $md = md5(time() . uniqid() . rand(1, 10000));
    return upper(substr(sha1($md) . $md, 0, $l));
}
