<?php

class Products extends Shop {

    public function __construct() {
        $this->table = 'products';
        $this->where['deleted'] = '';
        $this->where['ORDER'] = ['id' => 'DESC'];
    }

    public function new($data = null) {
        db()->add($this->table, $data);
    }

    public function id($par) {
        $this->where['id'] = $par;
        return $this;
    }

    public function remove($id) {
        return $this->update([
            'deleted' => 'yes'
        ], ['id' => $id]);
    }
}



function products() {
    return new Products();
}

function product() {
    return new Products();
}
