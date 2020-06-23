<?php


if (posts()) {

    $b = d('posts/');
    $f = scandir($b);
    foreach ($f as $____i => $____s) {
        if (@end(explode('.', $____s)) == 'php') {
            r('posts/' . $____s);
        }
        if (is_dir($b . $____s) && strlen($____s) > 2) {
            $ff = scandir($b . $____s);
            foreach ($ff as $____ii => $____ss) {
                if (@end(explode('.', $____ss)) == 'php') {
                    r('posts/' . $____s . '/' . $____ss);
                }
            }
        }
    }
}
