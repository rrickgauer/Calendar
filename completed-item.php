<?php

include_once('functions.php');

$pdo = dbConnect();

$sql = $pdo->prepare('UPDATE Items SET completed="y" WHERE id=:itemID');
$itemID =  filter_input(INPUT_GET, 'itemID', FILTER_SANITIZE_NUMBER_INT);
$sql->bindParam(':itemID', $itemID, PDO::PARAM_INT);

$sql->execute();

if (isset($_GET['classID'])) {
   $classID = $_GET['classID'];
   $location = "Location: class.php?cid=$classID";
} else {
   $location = "Location: item.php?id=$itemID";
}

header($location);










?>
