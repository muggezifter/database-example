<?php

require "../bootstrap.php";

use Wordpress\User;

// quick and dirty 'routing', this is not production code!
if (isset($_GET['action'])) {
	// handle ajax calls
	switch($_GET['action']) {
		case 'getposts':
			echo "getposts";
			break;
		case 'getpost':
			echo "getpost";
			break;
		default:
			renderIndex();
	}
} else {
	renderIndex();
}


// get the users and render the page
function renderIndex() {
	$m = new Mustache_Engine([
	 'loader' => new Mustache_Loader_FilesystemLoader('../templates'),
   	]);
	$users = User::with('meta')->get();
	echo $m->render('index', ['users'=>$users->toArray()]);
}



