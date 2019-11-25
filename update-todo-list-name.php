<?php

include_once('functions.php');

$pdo = dbConnect();

$sql = $pdo->prepare('UPDATE Lists SET title=:name WHERE id=:listID');

// sanitize and bind listID
$listID = filter_input(INPUT_GET, 'listID', FILTER_SANITIZE_NUMBER_INT);
$sql->bindParam(':listID', $listID, PDO::PARAM_INT);

// sanitize and bind name
$name = filter_input(INPUT_POST, 'update-todo-list-title', FILTER_SANITIZE_STRING);
$sql->bindParam(':name', $name, PDO::PARAM_STR);

$sql->execute();
$sql = null;
$pdo = null;


// go back to the page
$location = "Location: todo-lists.php?listID=" . $listID;
header($location);


?>

<script>
   $("#add-item-text").focus();
</script>
