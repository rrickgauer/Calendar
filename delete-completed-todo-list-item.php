<?php

include_once('functions.php');




include_once('functions.php');

$pdo = dbConnect();

$sql = $pdo->prepare('DELETE FROM ListItems WHERE completed="y" AND list_id=:listID');

$listID = filter_input(INPUT_GET , 'listID', FILTER_SANITIZE_NUMBER_INT);
$sql->bindParam(':listID', $listID, PDO::PARAM_INT);
$sql->execute();

$sql = null;
$pdo = null;



printListItems($listID);
exit;




?>
