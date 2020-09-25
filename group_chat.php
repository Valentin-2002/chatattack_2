<?php

//group_chat.php

include('db-connection.php');

session_start();

if($_POST["action"] == "insert_data")
{
	$data = array(
		':from_user'		=>	$_SESSION["id"],
		':msg'		=>	$_POST['chat_message'],
		':status'			=>	'1'
	);

	$query = "
	INSERT INTO log
	(from_user, msg, status) 
	VALUES (:from_user, :msg, :status)
	";

	$statement = $pdo->prepare($query);

	if($statement->execute($data))
	{
		echo fetch_group_chat_history($pdo);
	}

}

if($_POST["action"] == "fetch_data")
{
	echo fetch_group_chat_history($pdo);
}

?>