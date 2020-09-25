<?php

include('db-connection.php');

session_start();

$query = "
UPDATE user 
SET last_activity = CURRENT_TIMESTAMP() 
WHERE id = '".$_SESSION["id"]."'
";

$statement = $pdo->prepare($query);

$statement->execute();

?>

