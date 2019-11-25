<?php

include_once('functions.php');

//$itemID = $_GET['itemID'];

$pdo = dbConnect();

$sql = $pdo->prepare('UPDATE Items SET completed="n" WHERE id=:itemID');
$itemID = filter_input(INPUT_GET, 'itemID', FILTER_SANITIZE_NUMBER_INT);
$sql->bindParam(':itemID', $itemID, PDO::PARAM_INT);
$sql->execute();

$sql = null;
$pdo = null;



if (isset($_GET['classID'])) {
   $classID = $_GET['classID'];
   $location = "Location: class.php?cid=$classID";
} else {
   $location = "Location: item.php?id=$itemID";
}

header($location);
exit();

?>
