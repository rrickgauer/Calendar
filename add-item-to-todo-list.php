<?php

include_once('functions.php');

$pdo = dbConnect();

// create sql statement
$sql = $pdo->prepare('INSERT INTO ListItems (list_id, text) VALUES (:list_id, :text)');

// filter and bind listID
$listID = filter_input(INPUT_GET , 'listID', FILTER_SANITIZE_NUMBER_INT);
$sql->bindParam(':list_id', $listID, PDO::PARAM_INT);

// filter and bind text
$text = filter_input(INPUT_GET , 'text', FILTER_SANITIZE_STRING);
$sql->bindParam(':text', $text, PDO::PARAM_STR);

// execute sql statement
$sql->execute();

// close connections
$sql = null;
$pdo = null;

?>





