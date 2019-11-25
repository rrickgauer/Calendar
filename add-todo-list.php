<?php


include_once('functions.php');

if (isset($_POST['list-name']) == false) {
   header('Location: todo-lists.php');
   exit;
}

$name = $_POST['list-name'];
$newID = insertTodoList($_POST['list-name']);

$location = "Location: todo-lists.php?listID=$newID";
header($location);
exit;





?>
