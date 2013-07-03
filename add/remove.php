<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
include('../includes/config.php');

$server = $_POST['server'];

try{
	$query = $db->prepare("DELETE FROM servers WHERE id = ?");
	$query->execute(array($server));
}
catch(PDOException $e){
	die('Query failed: ' . $e->getMessage());
}

echo "<a href='.'>go back</a>";


?> 
