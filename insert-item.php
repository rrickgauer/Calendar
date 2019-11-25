<?php

session_start();

include_once('functions.php');


$pdo = dbConnect();
$sql = $pdo->prepare('INSERT INTO Items (class_id, name, type, date_assigned, date_due, completed, notes) values (:class, :name, :type, :date_assigned, :date_due, :completed, :notes)');

// filter and bind class id
$class = filter_input(INPUT_POST, 'class', FILTER_SANITIZE_NUMBER_INT);
$sql->bindParam(':class', $class, PDO::PARAM_INT);

// filter and bind name
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$sql->bindParam(':name', $name, PDO::PARAM_STR);

// filter and bind name
$type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
$sql->bindParam(':type', $type, PDO::PARAM_STR);

// filter and bind date assigned
$date_assigned = filter_input(INPUT_POST, 'date-assigned', FILTER_SANITIZE_STRING);
$sql->bindParam(':date_assigned', $date_assigned, PDO::PARAM_STR);

// filter and bind date due
$date_due = filter_input(INPUT_POST, 'date-due', FILTER_SANITIZE_STRING);
$sql->bindParam(':date_due', $date_due, PDO::PARAM_STR);

// filter and bind date due
$date_due = filter_input(INPUT_POST, 'date-due', FILTER_SANITIZE_STRING);
$sql->bindParam(':date_due', $date_due, PDO::PARAM_STR);

// filter and bind completed
$completed = filter_input(INPUT_POST, 'completed', FILTER_SANITIZE_STRING);
$sql->bindParam(':completed', $completed, PDO::PARAM_STR);

// filter and bind notes
$notes = filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_STRING);
$sql->bindParam(':notes', $notes, PDO::PARAM_STR);

$sql->execute();

if (isset($_GET['classID'])) {
   $location = 'Location: class.php?cid=' . $_GET['classID'];
} else {

   // get the id of the item added and go to that item's page
   $sql = $pdo->prepare('SELECT LAST_INSERT_ID() as "id" FROM Items');
   $sql->execute();
   $row = $sql->fetch(PDO::FETCH_ASSOC);
   $newID = $row['id'];
   $location = "Location: item.php?id=$newID";
}

header($location);
exit;

?>
