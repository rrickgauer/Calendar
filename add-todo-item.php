<?php

include_once('functions.php');

$pdo = dbConnect();

// $listID = $_GET['listID'];
// $text = $_GET['text'];

// $sql = "INSERT INTO ListItems values (0, $listID, '$text', 'n')";

$sql = $pdo->prepare('INSERT INTO ListItems VALUES (0, :listID, :text, "n")');
$listID = filter_input(INPUT_GET, 'listID', FILTER_SANITIZE_NUMBER_INT);
$text = filter_input(INPUT_GET, 'text', FILTER_SANITIZE_STRING);

$sql->bindParam(':listID', $listID);
$sql->bindParam(':text', $text);

$result = $sql->execute();

//updateTodoListLastUpdated($_GET['listID']);
updateTodoListLastUpdated($listID);

printListItems($listID);

?>

<script>
   $("#add-item-text").focus();
</script>
