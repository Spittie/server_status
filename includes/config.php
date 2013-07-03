<?php

// PostgreSQL is, currently, not supported
// 9.1 might work, but it's not tested

$db_type = ''; //mysql, pgsql or sqlite

// Only for sqlite
// Insert the full path, should be outside of your public directory
// Webserver need to be able to write in it
$db_path = '/srv/http/server_status/db/db.sdb';

// Only for mysql/pgsql
$host = 'localhost';
$user = '';
$pass = '';
$data = '';
$port = 3306; // 3306 for MySQL, 5432 for PostgreSQL (by default)

$sSetting['refresh'] = "10000";

if ($db_type == '') {
	die('Please configure your shit');
}

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

if ($db_type == 'sqlite') {
$sql = "CREATE TABLE IF NOT EXISTS servers (
		id integer PRIMARY KEY,
		name varchar(65) NOT NULL,
		url varchar(65) NOT NULL,
		location varchar(65) NOT NULL,
		host varchar(65) NOT NULL,
		type varchar(65) NOT NULL
		)";
} else {
$sql = "CREATE TABLE IF NOT EXISTS servers (
		id int(1) NOT NULL AUTO_INCREMENT,
		name varchar(65) NOT NULL,
		url varchar(65) NOT NULL,
		location varchar(65) NOT NULL,
		host varchar(65) NOT NULL,
		type varchar(65) NOT NULL,
		PRIMARY KEY (id)
		)";
}
		
try{
	$query = $db->prepare($sql);
	$query->execute();
}
catch(PDOException $e){
	die('Query failed: ' . $e->getMessage());
}

$template = "./templates/default/";
?>