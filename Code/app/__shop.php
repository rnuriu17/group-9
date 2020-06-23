<?php
class Shop {

    public function __construct() {
    }

    function add($data = null) {
        $r = db()->add($this->table, $data);
        return $r;
    }

    function delete($where = null) {
        if (!$where) $where = $this->where ?? [];
        $r = db()->delete($this->table, $where);
        return $r;
    }

    function get($where = null) {
        if (!$where) $where = $this->where ?? [];
        $r = db()->get($this->table, '*', $where);
        return $r;
    }

    function list($where = null, $key = 'id') {
        if (!$where) $where = $this->where ?? [];
        $r = db()->select($this->table, '*', $where);
        $l = [];
        foreach ($r as $i => $s) {
            $l[$s[$key]] = $s;
        }
        return $l;
    }

    function update($data, $where = null) {
        if (!$where) $where = $this->where ?? [];
        $r = db()->update($this->table, $where, $data);
        return $r;
    }

    function count($where = null) {
        if (!$where) $where = $this->where ?? [];
        $r = db()->count($this->table, $where);
        return $r;
    }
}

function shop() {
    return new Shop;
}
