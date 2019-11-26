<?php

include_once('functions.php');

$pdo = dbConnect();

// prepare the sql update statement
$sql = $pdo->prepare('DELETE FROM Terms WHERE Terms.id=:termID');


// filter, sanitize, and bind the termID
$termID = filter_input(INPUT_GET, 'termID', FILTER_SANITIZE_NUMBER_INT);
$sql->bindParam(':termID', $termID, PDO::PARAM_INT);

$sql->execute();

$sql = null;
$pdo = null;

printSetTerms($_GET['setID']);
exit;

?>
