<?php

include_once('functions.php');

$pdo = dbConnect();
$sql = $pdo->prepare('UPDATE Items SET name=:name, class_id=:classID, type=:type, date_assigned=:dateAssigned, date_due=:dateDue, completed=:completed, notes=:notes WHERE id=:itemID');

// filter and bind item id
$itemID = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
$sql->bindParam(':itemID', $itemID, PDO::PARAM_INT);

// filter and bind name
$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
$sql->bindParam(':name', $name, PDO::PARAM_STR);

// filter and bind class id
$classID = filter_var($_POST['class'], FILTER_SANITIZE_NUMBER_INT);
$sql->bindParam(':classID', $classID, PDO::PARAM_INT);

// filter and bind type
$type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
$sql->bindParam(':type', $type, PDO::PARAM_STR);

// filter and bind date assigned
$dateAssigned = filter_var($_POST['date-assigned'], FILTER_SANITIZE_STRING);
$sql->bindParam(':dateAssigned', $dateAssigned, PDO::PARAM_STR);

// filter and bind date due
$dateDue = filter_var($_POST['date-due'], FILTER_SANITIZE_STRING);
$sql->bindParam(':dateDue', $dateDue, PDO::PARAM_STR);


// filter and bind completed
$completed = filter_var($_POST['completed'], FILTER_SANITIZE_STRING);
$sql->bindParam(':completed', $completed, PDO::PARAM_STR);

// filter and bind notes
$notes = filter_var($_POST['notes'], FILTER_SANITIZE_STRING);
$sql->bindParam(':notes', $notes, PDO::PARAM_STR);


$sql->execute();
$pdo = null;
$sql = null;


//$result = $pdo->exec($sql);

if (isset($_GET['classID'])) {
   $location = "Location: class.php?cid=" . $_GET['classID'];
} else {
   $location = "Location: item.php?id=$itemID";
}
header($location);
exit;

?>
