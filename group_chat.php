<?php

//group_chat.php

include('db-connection.php');

session_start();

if($_POST["action"] == "insert_data")
{
	$data = array(
		':from_user'		=>	$_SESSION["id"],
		'to_user'			=> '0',
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
		echo fetch_group_chat_history($pdo);
	}

}

if($_POST["action"] == "fetch_data")
{
	echo fetch_group_chat_history($pdo);
}

?>