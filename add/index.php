<html>
<head>
	<title>Add server</title>
</head>
<body>
	<h2>Add server</h2><br />
	<form action="add.php" method="post">
		Nome: <input type="text" name="name"><br />
		URL: <input type="text" name="url"><br />
		Location: <input type="text" name="location"><br />
		Host: <input type="text" name="host"><br />
		Type: <input type="text" name="type"><br />
		<input type="submit">
	</form>
	<br /><br />
	
	<h2>Remove server</h2><br />
	<form action="remove.php" method="post">
	<?php
		include('../includes/config.php');

		try{
			$query = $db->prepare("SELECT * FROM servers ORDER BY id");
			$query->execute();
		}
		catch(PDOException $e){
			die('Query failed: ' . $e->getMessage());
		}
		while($result = $query->fetchObject()){
			echo $result->id;
			echo " <input type='submit' name='server' value='$result->id'> Delete </input>";
			echo "<br />";
		}
	?>
	</form>

</body>
</html>
