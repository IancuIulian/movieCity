<?php
declare(strict_types = 1);

require_once 'vendor/autoload.php';
require_once 'config.php';

$app      = new Application();
$response = $app->run();
echo $response;







