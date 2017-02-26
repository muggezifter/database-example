<?php
require "vendor/autoload.php";

use Illuminate\Database\Capsule\Manager;

$dbconfig = parse_ini_file('config/db.ini');

$manager = new Manager();
$manager->addConnection($dbconfig);

$manager->bootEloquent();
