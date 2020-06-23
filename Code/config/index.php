<?php

if (exists(d('config/live.fdb'))) {
    define('env', 'live');
} else if (d('config/dev.fdb')) {
    define('env', 'dev');
} else die('no config.');
