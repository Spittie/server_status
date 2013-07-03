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
	// PostgreSQL 8.4 (Debian 6 default) support
	// http://stackoverflow.com/questions/1766046/postgresql-create-table-if-not-exists
		$sql = "CREATE OR REPLACE FUNCTION create_mytable ()
			RETURNS void AS
			$_$
			BEGIN

			IF EXISTS (
				SELECT *
				FROM   pg_catalog.pg_tables 
				WHERE  schemaname = 'myschema'
				AND    tablename  = 'mytable'
				) THEN
			RAISE NOTICE 'Table already exists.';
			ELSE
			CREATE TABLE myschema.mytable (
					id int(1) NOT NULL AUTO_INCREMENT,
					name varchar(65) NOT NULL,
					url varchar(65) NOT NULL,
					location varchar(65) NOT NULL,
					host varchar(65) NOT NULL,
					type varchar(65) NOT NULL,
					PRIMARY KEY (id)
			);
			END IF;

			END;
			$_$ LANGUAGE plpgsql;
			SELECT create_mytable(); "
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