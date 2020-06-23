<?php

if (exists(d('config/live.php'))) {
    define('env', 'live');
    r('config/live.php');
} else if (d('config/dev.php')) {
    define('env', 'dev');
    r('config/dev.php');
} else die('no config.');
