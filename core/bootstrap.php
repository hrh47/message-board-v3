<?php

use App\Core\{App, Session};
use App\Core\Database\{QueryBuilder, Connection};

App::bind('config', require 'config.php');
App::bind('database', new QueryBuilder(
	Connection::make(App::get('config')['database'])
));
App::bind('session', Session::load());

function view($path, $data = [])
{
	extract($data);
	require "app/views/{$path}.view.php";
}

function redirect($path)
{
	header("Location: /{$path}");
}

function generateCsrfToken()
{
	return base64_encode(openssl_random_pseudo_bytes(32));
}

function flash($message, $type='danger')
{
	App::get('session')->addMessage($message, $type);
}

function getFlashedMessages()
{
	$messages = App::get('session')->get('flashed_messages');
	App::get('session')->unset('flashed_messages');
	return $messages;
}

