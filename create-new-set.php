<?php

// this file inserts a new Study Set into the database
// then it retrieves the ID of the newly created set
// then it jumps to the newly created set page

include_once('functions.php');

// prepare sql statement
$pdo = dbConnect();
$sql = $pdo->prepare('INSERT INTO Sets (name) VALUES (:name)');

// filter and bind new set name
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$sql->bindParam(':name', $name, PDO::PARAM_STR);

// execute the insert statement
$sql->execute();

// get the id of this set that was just created
$row = $pdo->query("SELECT id from Sets order by id desc limit 1")->fetch(PDO::FETCH_ASSOC);
$newSetID = $row['id'];

// set the new location
$location = "Location: sets.php?setID=$newSetID";

// close the connections
$row = null;
$sql = null;
$pdo = null;

// go to the new set page
header($location);
exit;

?>
