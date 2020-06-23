<?php


function _url() {
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/";
    return $actual_link;
}


function fullUrl() {
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    return $actual_link;
}


function requestUri() {
    $actual_link = $_SERVER['REQUEST_URI'];
    return $actual_link;
}

define('url', _url());
define('full_url', fullUrl());
define('request_uri', requestUri());

function url($par = null) {
    return url . $par;
}
