<?php

include('db-connection.php');

session_start();

$data = array(
	':to_user'		=>	$_POST['to_user_id'],
	':from_user'		=>	$_SESSION['id'],
	':msg'		=>	$_POST['chat_message'],
	':status'			=>	'1'
);

$query = "
INSERT INTO log 
(to_user, from_user, msg, status) 
VALUES (:to_user, :from_user, :msg, :status)
";

$statement = $pdo->prepare($query);

if($statement->execute($data))
{
	echo fetch_user_chat_history($_SESSION['id'], $_POST['to_user_id'], $pdo);
}

?>