<?php

class Pages extends Shop {

    public function __construct($page = null) {
        $this->table = 'pages';
        $this->page = $page;
        $this->where['page'] = $page;
    }

    public function email($par) {
        $this->where['email'] = $par;
        return $this;
    }

    public function new($data) {
        db()->add('pages', merge(['page' => $this->page], $data));
    }
}



function pa($par) {
    return new Pages($par);
}
