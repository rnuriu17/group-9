<?php

class Order extends Shop {

    public function __construct() {
        $this->table = 'orders';
        $this->where['user'] = user()->id;
        $this->where['status[!]'] = 'deleted';
        $this->where['ORDER'] = ['id' => 'DESC'];
    }

    public function new() {
        $hash = code(10);

        $data = [];
        $total = 0;
        foreach (cart()->get() as $ci => $cs) {
            $p = product()->id($ci)->get();
            $data['products'][$ci] = $p;
            $total = $total + ($p['price'] * $cs);
        }

        $this->add(
            [
                'hash' => $hash,
                'user' => user()->id,
                'time' => time(),
                'user_data' => user()->data(),
                'ip' => $_SERVER['REMOTE_ADDR'],
                'products' => cart()->get(),
                'products_data' => $data,
                'total' => $total,
                'status' => 'pending',
                'log' => '',
            ]
        );
        return $hash;
    }


    public function all() {
        unset($this->where['user']);
        return $this;
    }


    public function pending() {
        $this->where['status'] = 'pending';
        return $this;
    }


    public function id($par) {
        $this->where['id'] = $par;
        return $this;
    }

    public function hash($par) {
        $this->where['hash'] = $par;
        return $this;
    }
}



function order() {
    return new Order();
}


function orders() {
    return new Order();
}
