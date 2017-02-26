<?php
require "vendor/autoload.php";

use Illuminate\Database\Capsule\Manager;

$manager = new Manager();

$dbconfig = parse_ini_file('config/db.ini');

$manager->addConnection($dbconfig);

$manager->bootEloquent();
