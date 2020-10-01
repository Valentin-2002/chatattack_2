<?php

include('db-connection.php');

if(isset($_POST["id"]))
{
	$query = "
	UPDATE chat
	SET status = '2' 
	WHERE id = '".$_POST["id"]."'
	";

	$statement = $pdo->prepare($query);

	$statement->execute();

}

?>