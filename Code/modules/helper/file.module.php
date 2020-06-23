<?php

class File {

    public $fileContent, $to;

    public function copy($file) {
        $this->fileContent = contents($file);
        return $this;
    }

    public function paste($to) {
        $this->to = $to;
        return $this;
    }

    public function once() {
        if (!exists($this->to)) put($this->to, $this->fileContent);
    }

    public function always() {
        put($this->to, $this->fileContent);
    }

    public function dir($par = null) {
        if (exc('/', $par) > 1) {
            $folders = ex('/', $par);
            $folders = array_slice($folders, 0, -1);
            $g = '';
            foreach ($folders  as $i => $s) {
                $g .= $s . '/';
                if (!exists(d() . $g)) mkdir(d() . $g);
            }
        }
    }

    public function create($par = null) {
        $this->dir($par);
        if (!exists($par)) touch($par);
    }
}


function f() {
    return new File;
}
