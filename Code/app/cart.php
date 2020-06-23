<?php

class Cart {

    public function __construct() {
        $this->count = count($this->get());
    }

    public function get() {
        return is_array(session()->get('cart')) ? session()->get('cart') : [];
    }
    public function add($data = null, $amount = 1) {
        session()->set('cart', array_replace($this->get(), [$data => $amount]));
    }
    public function remove($id) {
        $a = $this->get();
        unset($a[$id]);
        session()->set('cart', $a);
    }

    public function update() {
        $count = count($this->get());
        echo js()->component('minicart-count', $count);
        if ($count <= 0) js()->hide('[c-minicart-count]');
        else js()->show('[c-minicart-count]');
        return true;
    }

    public function reset() {
        session()->set('cart', []);
    }
}



function cart() {
    return new Cart();
}


twig()->addGlobal('cart', cart()->get());
