<?php

include_once('functions.php');

$pdo = dbConnect();
$sql = $pdo->prepare('DELETE FROM Sets WHERE id=:setID');

// filter, sanitize, and bind the termID
$setID = filter_input(INPUT_GET, 'setID', FILTER_SANITIZE_NUMBER_INT);
$sql->bindParam(':setID', $setID, PDO::PARAM_INT);

$sql->execute();

$sql = null;
$pdo = null;

header('Location: sets.php');
exit;
?>
