<?php

$router->get('', 'PostsController@index');
$router->post('posts', 'PostsController@addPost');
$router->post('comments', 'PostsController@addComment');

$router->get('login', 'UsersController@login');
$router->post('login', 'UsersController@loginUser');
$router->get('logout', 'UsersController@logout');
$router->get('register', 'UsersController@register');
$router->post('register', 'UsersController@registerUser');