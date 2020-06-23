<?php


class JDB {

    public function data($file = null) {
        f()->create('_jdb/' . $file . '.jdb');
        $data = jcontents('_jdb/' . $file . '.jdb');
        $data = is_array($data) ? $data : [];
        return $data;
    }

    public function get($file = null) {
        if (exists('_jdb/' . $file . '.jdb')) {
            $data = jcontents('_jdb/' . $file . '.jdb');
            $data = is_array($data) ? $data : $data;
            return $data;
        } else return [];
    }

    public function dir($dir) {
        if (exists('_jdb/' . $dir)) {
            $a = scandir('_jdb/' . $dir);
            foreach ($a as $i => $s) {
                $e = exn('.', $s);
                if ($e == 'jdb') {
                    $q = replace('.jdb', '', $s);
                    if ($q) $d[$q] = jcontents('_jdb/' . $dir . '/' . $s);
                }
            }
        }
        return $d ?? [];
    }

    public function create($file = null, $data) {
        $this->set($file, $data);
    }

    public function set($file = null, $data) {
        f()->dir('_jdb/' . $file);
        $d = is_array($data) ? json_encode($data) : $data;
        put(d('_jdb/' . $file . '.jdb'), $d);
    }

    public function add($file = null, $par = null, $val = null) {
        $data = $this->data($file);
        $data = array_merge($data, [$par => $val]);
        put(d('_jdb/' . $file . '.jdb'), json_encode($data));
    }
    public function addOnce($file = null, $par = null, $val = null) {
        $data = $this->data($file);
        if (!@$data[$par]) {
            $data = array_merge($data, [$par => $val]);
            put(d('_jdb/' . $file . '.jdb'), json_encode($data));
        }
    }

    public function delete($file = null) {
        @unlink(d('_jdb/' . $file . '.jdb'));
    }
}


function jdb() {
    return new JDB;
}
