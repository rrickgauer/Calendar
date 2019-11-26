<?php

include_once('functions.php');

$pdo = dbConnect();


// prepare the sql update statement
$sql = $pdo->prepare('INSERT INTO Terms (set_id, term, definition) VALUES (:setID, :term, :definition)');


// filter, sanitize, and bind the termID
$setID = filter_input(INPUT_GET, 'setID', FILTER_SANITIZE_NUMBER_INT);
$sql->bindParam(':setID', $setID, PDO::PARAM_INT);


// filter, sanitize, and bind the term
$term = filter_input(INPUT_GET, 'term', FILTER_SANITIZE_STRING);
$sql->bindParam(':term', $term, PDO::PARAM_STR);

// filter, sanitize, and bind the definition
$definition = filter_input(INPUT_GET, 'definition', FILTER_SANITIZE_STRING);
$sql->bindParam(':definition', $definition, PDO::PARAM_STR);


// execute the update statement
$sql->execute();


printSetTerms($setID);

$pdo = null;
$sql = null;
exit;

?>
