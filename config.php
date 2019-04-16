<?php

$db = parse_url(getenv('DATABASE_URL'));

return [
	'database' => [
		'connection' => 'pgsql:host=' . $db['host'] . ';port=' . $db['port'],
		'name' => ltrim($db['path'], '/'),
		'username' => $db['user'],
		'password' => $db['pass'],
		'options' => [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		]
	]
];