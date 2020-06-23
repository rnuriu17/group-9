<?php

use Kreait\Firebase\Factory;
use Kreait\Firebase;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

use Kreait\Firebase\Messaging\AndroidConfig;
use Kreait\Firebase\Messaging\ApnsConfig;
use Kreait\Firebase\Messaging\RawMessageFromArray;
use Firebase\Auth\Token\Exception\InvalidToken;

class FB {

    public $db, $auth;

    public function __construct() {
        $factory = (new Factory)->withServiceAccount(d(config('firebase_config_file')));
        $this->db = $factory->createDatabase();
        $this->auth = $factory->createAuth();
    }

    public function code($l = 5) {
        $md = md5(time() . uniqid() . rand(1, 10000));
        return upper(substr(sha1($md) . $md, 0, $l));
    }

    public function get($par) {
        // try {
        $reference = $this->db->getReference($par);
        $snapshot = $reference->getSnapshot();
        $value = $snapshot->getValue();
        return $value;
        // } catch (\Exception $e) {
        //     $c = $this->code(6);
        //     jdb()->set('exceptions/fb/get/' . $c, $e);
        //     js()->alert('İşlemi gerçekleştirirken bir sorun oluştu. Hata kodu: GET_' . $c);
        //     die();
        //     return false;
        // }
    }

    public function add($par, $data = null) {
        // try {
        $this->db->getReference($par)->set($data);
        // return true;
        // } catch (\Exception $e) {
        //     $c = $this->code(6);
        //     jdb()->set('exceptions/fb/add/' . $c, $e);
        //     js()->alert('İşlemi gerçekleştirirken bir sorun oluştu. Hata kodu: ADD_' . $c);
        //     die();
        //     return false;
        // }
    }

    public function set($par, $data = null) {
        // try {
        $this->db->getReference($par)->set($data);
        //     return true;
        // } catch (\Exception $e) {
        //     $c = $this->code(6);
        //     jdb()->set('exceptions/fb/add/' . $c, $e);
        //     js()->alert('İşlemi gerçekleştirirken bir sorun oluştu. Hata kodu: ADD_' . $c);
        //     die();
        //     return false;
        // }
    }

    public function delete($par) {
        // try {
        $this->db->getReference($par)->remove();
        //     return true;
        // } catch (\Exception $e) {
        //     jdb()->set('exceptions/fb/delete/' . time(), $e);
        //     return false;
        // }
    }
}


function fb() {
    return new FB;
}
