<?php
include('../includes/config.php');

$name = $_POST['name'];
$url = $_POST['url'];
$location = $_POST['location'];
$host = $_POST['host'];
$type = $_POST['type'];

try{
	if ($db_type == 'sqlite') {
		$query = $db->prepare("INSERT INTO servers (name, url, location, host, type) VALUES (?, ?, ?, ?, ?)");
	} else {
		$query = $db->prepare("INSERT INTO servers (id, name, url, location, host, type) VALUES (DEFAULT, ?, ?, ?, ?, ?)");
	}
	$query->execute(array($name, $url, $location, $host, $type));
}
catch(PDOException $e){
	die('Query failed: ' . $e->getMessage());
}

echo "<a href='.'>go back</a>";


?>