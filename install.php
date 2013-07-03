<?php

include('./includes/config.php');

if ($db_type == 'sqlite') {
	$sql = "CREATE TABLE IF NOT EXISTS servers (
		id integer PRIMARY KEY,
		name varchar(65) NOT NULL,
		url varchar(65) NOT NULL,
		location varchar(65) NOT NULL,
		host varchar(65) NOT NULL,
		type varchar(65) NOT NULL
		)";
} else if ($db_type == 'mysql') {
	$sql = "CREATE TABLE IF NOT EXISTS servers (
		id int(1) NOT NULL AUTO_INCREMENT,
		name varchar(65) NOT NULL,
		url varchar(65) NOT NULL,
		location varchar(65) NOT NULL,
		host varchar(65) NOT NULL,
		type varchar(65) NOT NULL,
		PRIMARY KEY (id)
		)";
} else if ($db_type == 'pgsql') {

	$pg_version = $db->getAttribute(PDO::ATTR_CLIENT_VERSION);
	if ($pg_version < 9) {
		die("PostgreSQL 8.4 and older are not supported");
	} else {
		$sql = "CREATE TABLE IF NOT EXISTS servers (
			id SERIAL, name varchar(65) NOT NULL,
			url varchar(65) NOT NULL,
			location varchar(65) NOT NULL,
			host varchar(65) NOT NULL,
			type varchar(65) NOT NULL,
			PRIMARY KEY (id)
			)";
		}
		
} else {
	die('Database Not supported');
}
		
try{
	$query = $db->prepare($sql);
	$query->execute();
	echo 'Installazione riuscita <br />';
	echo 'Cancella il file install.php';
}
catch(PDOException $e){
die('Query failed: ' . $e->getMessage());
}

?>