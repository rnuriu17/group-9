<?php


class M {

    public $folder;
    public function __construct($folder = null) {
        $this->folder = d() . 'modules/' . $folder;
    }

    public function file($par) {
        return $this->folder . $par;
    }
}


function m() {
    return new M;
}
