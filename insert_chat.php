<?php

include('db-connection.php');

session_start();

$data = array(
	':from_user'		=>	$_SESSION["id"],
	'to_user'			=> $_POST['to_user_id'],
	':msg'		=>	$_POST['chat_message'],
	':status'			=>	'1'
);

$query = "
INSERT INTO chat
(from_user, to_user, msg, status) 
VALUES (:from_user, :to_user, :msg, :status)
";

$statement = $pdo->prepare($query);

if($statement->execute($data))
{
	echo fetch_user_chat_history($_SESSION['id'], $_POST['to_user_id'], $pdo);
}

?>