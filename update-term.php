<?php

include_once('functions.php');

// connect to database
$pdo = dbConnect();

// prepare the sql update statement
$sql = $pdo->prepare('UPDATE Terms SET Terms.term=:term, Terms.definition=:definition WHERE Terms.id=:termID');

// filter, sanitize, and bind the term
$term = filter_input(INPUT_POST, 'term', FILTER_SANITIZE_STRING);
$sql->bindParam(':term', $term, PDO::PARAM_STR);

// filter, sanitize, and bind the definition
$definition = filter_input(INPUT_POST, 'definition', FILTER_SANITIZE_STRING);
$sql->bindParam(':definition', $definition, PDO::PARAM_STR);

// filter, sanitize, and bind the termID
$termID = filter_input(INPUT_POST, 'termID', FILTER_SANITIZE_NUMBER_INT);
$sql->bindParam(':termID', $termID, PDO::PARAM_INT);

// execute the update statement
$sql->execute();

// close the connections
$sql = null;
$pdo = null;

// return to the working Set page
$setID = $_GET['setID'];
$location = "Location: sets.php?setID=$setID";
header($location);

?>
