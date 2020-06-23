<?php
class Session {

    public function get($par = null) {
        return @$_SESSION[$par] ? @$_SESSION[$par] : false;
    }

    public function set($par, $val) {
        $_SESSION[$par] = $val;
    }

    public function unset($par) {
        unset($_SESSION[$par]);
    }
}


function session() {
    $session = new Session;
    return $session;
}
