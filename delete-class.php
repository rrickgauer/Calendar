<?php

include_once('functions.php');

$pdo = dbConnect();

$sql = $pdo->prepare('DELETE FROM Classes WHERE id=:classID');

$classID = filter_input(INPUT_GET , 'classID', FILTER_SANITIZE_NUMBER_INT);
$sql->bindParam(':classID', $classID, PDO::PARAM_INT);
$sql->execute();

$sql = null;
$pdo = null;


header('Location: calendar-list.php');
exit;

?>
