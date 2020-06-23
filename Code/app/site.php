<?php

class Site extends Shop {

    public function __construct() {
        $this->table = 'site';
        $this->title = ' | ' . $this->settings()['title'];
    }

    public function settings($data = null) {
        if (!$data) return jdb()->get('site');
        jdb()->set('site', $data);
    }
}



function site() {
    return new Site();
}


twig()->addGlobal('site', site()->settings());
