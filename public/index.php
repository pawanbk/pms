<?php
session_start();
include_once(__DIR__.'/../vendor/autoload.php');
include_once(__DIR__.'/../vendor/phpMailer/phpMailer/src/PHPMailer.php');

use core\Dotenv;
use core\Database;
use core\Application;

(new Dotenv(__DIR__.'/../.env'))->load();
require (__DIR__.'/../core/Config.php');

$app = new Application(dirname(__DIR__));

include_once(__DIR__.'/../app/routes/web.php');

$app->run();

?>