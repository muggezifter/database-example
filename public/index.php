<?php

require "../bootstrap.php";

use Wordpress\User;


$users = User::all();

echo "<ol>";
foreach ($users as $user) {
	
	echo "<li>".$user->user_nicename."</li>";
	
	
}
echo "</ol>";
