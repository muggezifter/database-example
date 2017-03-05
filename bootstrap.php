<?php
require "vendor/autoload.php";

use Illuminate\Database\Capsule\Manager;

// get connection info from ini file
$dbconfig = parse_ini_file('config/db.ini');

// boot eloquent
$manager = new Manager();
$manager->addConnection($dbconfig);
$manager->bootEloquent();
