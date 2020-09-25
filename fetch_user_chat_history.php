<?php

//fetch_user_chat_history.php

include('db-connection.php');

session_start();

echo fetch_user_chat_history($_SESSION['id'], $_POST['to_user_id'], $pdo);

?>