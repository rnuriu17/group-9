<?php

use Medoo\Medoo;

class DB {

    public $connection;

    public function __construct() {
        try {
            // Initialize
            $this->connection = new Medoo([
                'database_type' => config('db_type'),
                'database_name' => config('db_name'),
                'server' => config('db_server'),
                'username' => config('db_username'),
                'password' => config('db_password'),
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
            ]);
        } catch (PDOException $e) {
            alert('Error while connecting to database.<br>Please try again later.<br><br>' . $e);
        }
        $this->m = $this->connection;
    }

    function MedooTable($name, $cols = array()) {

        $Q = '';

        $database_name = config('db_name');

        $this->m->query("CREATE TABLE `$database_name`.`$name` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            PRIMARY KEY (`id`)
        ) ENGINE = InnoDB");
        $ii = 0;
        foreach (@$cols as $i => $s) {
            foreach (@$s as $q => $w) {
                $Q .= "ALTER TABLE `$name` ADD `$w` $i NULL DEFAULT NULL; ";
            }
        }

        $this->m->query($Q);
    }

    function MedooAddColumn($name, $col) {

        $Q = '';

        $ii = 0;

        $Q .= "ALTER TABLE `$name` ADD `$col` LONGTEXT NULL DEFAULT NULL;";

        $this->m->query($Q);
    }

    function MedooDropTable($name) {
        $this->m->query("DROP TABLE IF EXISTS `$name`;");
    }

    public function check($table, $data) {
        $select = $this->m->get($table, '*');

        $this->MedooTable($table);
        foreach ($data as $i => $s) {
            if (!@$select[$i]) {
                $this->MedooAddColumn($table, $i);
            }
        }
    }

    public function unserialize($list = array()) {
        foreach ($list ?? [] as $i => $s) {

            if (is_array($s) && count($s) > 0) {
                foreach ($s as $q => $w) {

                    if (is_array(@unserialize($w))) {
                        $w = unserialize($w);
                        foreach ($w as $p => $o) {
                            if (!is_array($o)) {
                                unset($w[$p]);
                                $w[$p] = $o;
                            }
                        }
                    }
                    $list[$i][$q] = $w;
                }
            } else {
                if (is_array(@unserialize($s))) {
                    $s = unserialize($s);
                    foreach ($s as $p => $o) {
                        if (!is_array($o)) {
                            unset($s[$p]);
                            $s[$p] = $o;
                        }
                    }
                }
                $list[$i] = $s;
            }
        }
        return $list;
    }

    public function add($table, $data) {
        $table = replace('/', '_', $table);
        $this->check($table, $data);
        $this->m->insert($table, $data);
    }

    public function delete($table, $where) {
        $table = replace('/', '_', $table);
        // $this->check($table, $where);
        $this->m->delete($table, $where);
    }
    public function update($table, $where = array(), $data = array()) {
        $table = replace('/', '_', $table);
        $this->check($table, $data);
        $this->m->update($table, $data, $where);
    }

    public function get($table, $columns = '*', $where = array()) {
        $table = replace('/', '_', $table);
        // $this->check($table, $where);
        $list = $this->m->get($table, $columns, $where);
        $list = $this->unserialize($list);
        return $list;
    }

    public function select($table, $columns = '*', $where = array()) {
        $table = replace('/', '_', $table);
        $list = $this->m->select($table, $columns, $where);
        $list = $this->unserialize($list);
        return $list;
    }

    public function count($table, $where = array()) {
        $table = replace('/', '_', $table);
        // $this->check($table, $where);
        return $this->m->count($table, $where);
    }
}

function db() {
    return new DB;
}

if (config('use_db') == 'true') {
    c()->add('db_type', 'mysql');
    c()->add('db_name', 'DATABASE_NAME');
    c()->add('db_server', 'localhost');
    c()->add('db_username', 'root');
    c()->add('db_password', '123123');
    c()->add('db_status', 'false');

    if (config('db_status') == 'false') {
        alert('Please configure the database.');
    }
}
