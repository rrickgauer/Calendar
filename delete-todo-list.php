<?php

include_once('functions.php');

$pdo = dbConnect();

$sql = "DELETE FROM Lists where id=" . $_GET['listID'];
$results = $pdo->exec($sql);

header('Location: todo-lists.php');
exit;




?>
