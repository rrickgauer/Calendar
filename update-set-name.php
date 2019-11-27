<?php

include_once('functions.php');

// prepare sql statement
$pdo = dbConnect();
$sql = $pdo->prepare('UPDATE Sets SET name = :name WHERE id=:setID');

// filter, sanitize, and bind the setID
$setID = filter_input(INPUT_GET, 'setID', FILTER_SANITIZE_NUMBER_INT);
$sql->bindParam(':setID', $setID, PDO::PARAM_INT);


// filter, sanitize, and bind the name
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$sql->bindParam(':name', $name, PDO::PARAM_STR);

// exeucte sql statement
$sql->execute();

// close the connections
$sql = null;
$pdo = null;

// go back to sets.php
$location = "Location: sets.php?setID=$setID";
header($location);
exit;
?>
