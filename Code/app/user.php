<?php

class User extends Shop {

    public function __construct() {
        $this->table = 'users';
        $user = session()->get('user') ?? null;
        $this->data = @$user;
        $this->id = @$user['id'];
        $this->role = @$user['role'];
        $this->logged = $user ? true : false;

        $this->roles = [
            'client' => [
                'title' => 'Clients',
                'type' => 'client',
            ],
            'delivery' => [
                'title' => 'Delivery',
                'type' => 'delivery',
            ],
            'magazine' => [
                'title' => 'Magaziners',
                'type' => 'magazine',
            ],
            'admin' => [
                'title' => 'Admins',
                'type' => 'admin',
            ],
        ];
    }

    public function pass($par) {
        return md5($par . config('hash'));
    }

    public function username($par) {
        $this->where['username'] = $par;
        return $this;
    }

    public function email($par) {
        $this->where['email'] = $par;
        return $this;
    }

    public function hash($par) {
        $this->where['hash'] = $par;
        return $this;
    }

    public function id($par) {
        $this->where['id'] = $par;
        return $this;
    }

    public function role($par) {
        $this->where['role'] = $par;
        return $this;
    }

    public function self() {
        $this->where['id'] = user()->id;
        return $this;
    }

    public function password($par) {
        $this->where['password'] = $this->pass($par);
        return $this;
    }

    public function login($user) {
        session()->set('user', $user);
    }

    public function mustLogin() {
        if (!$this->logged) {
            redirect('login');
            die();
        }
    }

    public function mustAdmin() {
        if ($this->role != 'admin') {
            $this->logout();
            redirect('login');
            die();
        }
    }

    public function mustMagazine() {
        if ($this->role != 'magazine') {
            $this->logout();
            redirect('login');
            die();
        }
    }

    public function mustDelivery() {
        if ($this->role != 'delivery') {
            $this->logout();
            redirect('login');
            die();
        }
    }


    public function logout() {
        session()->unset('user');
    }

    public function data() {
        return session()->get('user') ?? false;
    }

    public function logged() {
        if ($this->data()) return true;
        else return false;
    }

    public function new($data) {
        db()->add('users', $data);
    }

    public function roles() {
        foreach ($this->roles as $i => $s) {
            $r[$i] = $s;
            $r[$i]['users'] = users()->count(['role' => $s['type']]);
        }
        return $r;
    }

    public function rolesOption() {
        $a = [];
        foreach ($this->roles as $i => $s) {
            $a[$i] = $s['title'];
        }
        return $a;
    }
}



function user() {
    return new User;
}

function users() {
    return new User;
}

twig()->addGlobal('user', user()->data);
