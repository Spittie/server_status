<?php

// PostgreSQL is, currently, not supported
// 9.1 might work, but it's not tested

$db_type = ''; //mysql, pgsql or sqlite

// Only for sqlite
// Insert the full path, should be outside of your public directory
// Webserver need to be able to write in it
$db_path = '';

// Only for mysql/pgsql
$host = 'localhost';
$user = '';
$pass = '';
$data = '';
$port = 3306; // 3306 for MySQL, 5432 for PostgreSQL (by default)

$sSetting['refresh'] = "10000";

try{
	if ($db_type == 'sqlite') {
		$dsn = "$db_type:$db_path";
		$db = new PDO($dsn);
	} else {
		$dsn = "$db_type:host=$host;port=$port;dbname=$data";
		$db = new PDO($dsn, $user, $pass);
	}
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    die('Connection failed: ' . $e->getMessage());
}

$template = "./templates/default/";
?>