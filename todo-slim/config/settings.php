<?php


return static function() {
	return [
		'di_compilation_path' => __DIR__ . '/../var/cache',
        'display_error_details' => false,
		'log_errors' => true,
		'db' => [
			'name' => 'todo_laravel',
			'host' => 'localhost',
			'username' => 'root',
			'password' => 'root'
		]
	];
};