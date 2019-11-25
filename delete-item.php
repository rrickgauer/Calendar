<?php

include_once('functions.php');

$pdo = dbConnect();

$sql = $pdo->prepare('DELETE FROM Items WHERE id=:id');
$id = filter_input(INPUT_GET , 'id', FILTER_SANITIZE_NUMBER_INT);
$sql->bindParam(':id', $id, PDO::PARAM_INT);
$sql->execute();

$sql = null;
$pdo = null;

$location = 'Location: class.php?cid=' . $_GET['classID'];

header($location);
exit;


?>
