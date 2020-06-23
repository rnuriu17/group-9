<?php


class FDB {

    public $seperator;

    public function __construct() {
        $this->seperator = "\t==\t";
    }

    public function data($file = null) {
        f()->create($file . '.fdb');
        $data = ex("\n", contents($file . '.fdb'));
        $data = is_array($data) ? $data : [];
        $output = [];
        foreach ($data as $di => $ds) {
            if (trim($ds)) {
                $e = ex($this->seperator, $ds);
                if (trim(@$e[0]) && trim(@$e[1])) $output[@$e[0]] = @$e[1];
            }
        }
        return $output;
    }

    public function format($par = array()) {
        $output = '';
        foreach ($par as $i => $s) {
            if (trim($i) && trim($s)) $output .= "$i" . $this->seperator . "$s\n";
        }
        return $output;
    }

    public function add($file = null, $par = null, $val = null) {
        $data = $this->data($file);
        $data = array_merge($data, [$par => $val]);
        put(d($file . '.fdb'), $this->format($data));
    }
    public function addOnce($file = null, $par = null, $val = null) {
        $data = $this->data($file);
        if (!@$data[$par]) {
            $data = array_merge($data, [$par => $val]);
            put(d($file . '.fdb'), $this->format($data));
        }
    }
}


function fdb() {
    return new FDB;
}
