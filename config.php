<?php

$dotenv = \Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

return [
	'database' => [
		'host' => $_ENV['DB_HOST'],
		'connection' => $_ENV['DB_CONNECTION'],
		'name' => $_ENV['DB_NAME'],
		'username' => $_ENV['DB_USERNAME'],
		'password' => $_ENV['DB_PASSWORD'],
		'options' => [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		]
	],
	'POSTS_PER_PAGE' => 10
];