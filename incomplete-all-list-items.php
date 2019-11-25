<?php

include_once('functions.php');

$pdo = dbConnect();

$sql = $pdo->prepare('UPDATE ListItems SET completed="n" WHERE list_id=:listID');

$listID = filter_input(INPUT_GET , 'listID', FILTER_SANITIZE_NUMBER_INT);
$sql->bindParam(':listID', $listID, PDO::PARAM_INT);
$sql->execute();

$sql = null;
$pdo = null;

printListItems($listID);
exit;
?>

