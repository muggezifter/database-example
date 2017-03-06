<?php

require "../bootstrap.php";

use WordpressDB\User;
use WordpressDB\Post;

/**
 * quick and dirty 'routing', obviously this is not production code!
 */
if (isset($_GET['action'])) {
    // handle ajax calls
    switch ($_GET['action']) {
        case 'getposts':
            getPosts();
            break;
        case 'getpost':
            getPost();
            break;
        default:
            renderIndex();
    }
} else {
    renderIndex();
}

/**
 * get the posts
 */
function getPosts()
{
    // guard clause: userid sanity check
    if (!isValidId('userid')) {
        renderIndex();
        return;
    }
    // get published posts for post_author
    $posts = Post::posts()
        ->with('meta')
        ->published()
        ->where('post_author', $_GET['userid'])
        ->orderBy('ID', 'DESC')
        ->get()
        ->map(function($post) {
            return [
                'ID' =>$post['ID'],
                'post_title' => $post['post_title']
            ];
        })
        ->toArray();
    respondJson($posts);
}

/**
 * get a single post
 */
function getPost()
{
    // guard clause: userid sanity check
    if (!isValidId('postid')) {
        renderIndex();
        return;
    }
    $post = Post::where('ID', $_GET['postid'])
        ->with('user', 'meta')
        ->get()
        ->map(function($post) {
            return [
                'post_title' => $post['post_title'],
                'post_date_gmt' => $post['post_date_gmt'],
                'post_content' => $post['post_content'],
                'nickname' =>  $post['user']->nickname,
                'meta' => $post['meta']->toArray()
            ];
        })
        ->toArray();

    respondJson($post);
}

/**
 * get the users and render the page
 */
function renderIndex()
{
    $m = new Mustache_Engine([
        'loader' => new Mustache_Loader_FilesystemLoader('../templates'),
    ]);
    $users = User::with('meta')->get();
    echo $m->render('index', [
        'users' => $users->toArray(),
        'postslist' => file_get_contents('../templates/partials/postslist.mustache'),
        'postsmodal' => file_get_contents('../templates/partials/postmodal.mustache')
    ]);
}

/**
 * @param $param
 * @return bool
 *
 * validator for numeric parameters
 */
function isValidId($param)
{
    return isset($_GET[$param]) && is_numeric($_GET[$param]);
}

/**
 * @param array $data
 *
 * response function for ajax requests
 */
function respondJson(array $data)
{
    //sleep(3); //uncomment if you want to throttle for testing purposes
    header('Content-type: application/json');
    echo json_encode($data);
}



