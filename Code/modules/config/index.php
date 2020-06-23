<?php
class C {

    public $folder;
    public function add($par = null, $val = null) {
        fdb()->addOnce('config/' . env, $par, $val);
    }

    function get($par) {
        $d = @fdb()->data('config/' . env)[$par];
        if (!@$d) $this->add($par, '--');
        return @$d;
    }
    public function version($par = null) {
        if (env == 'live') fdb()->addOnce('config/' . env, 'version', 1);
        else fdb()->add('config/' . env, 'version', time() . rand(1, 19999));
    }

    public function all() {
        return fdb()->data('config/' . env);
    }
}


function c() {
    return new C;
}

function config($par = null) {
    return c()->get($par);
}


f()->dir('config/');
f()->copy(m()->file('config/config.index.php'))->paste(d('config/index.php'))->once();
r('config/index');

c()->add('hash', upper(chash(10)));
c()->add('hash1', upper(chash(10)));
c()->add('hash2', upper(chash(10)));
c()->add('hash3', upper(chash(10)));
c()->add('hash4', upper(chash(10)));
c()->add('use_db', 'false');

c()->version();
