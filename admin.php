<?php

use Admin\Admin;

require_once 'vendor/autoload.php';
require_once 'config.php';


$admin = new Admin();
$admin->run();