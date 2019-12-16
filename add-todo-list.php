<?php


include_once('functions.php');

if (isset($_POST['list-name']) == false) {
   header('Location: todo-lists.php');
   exit;
}

$name = $_POST['list-name'];
$newID = insertTodoList($_POST['list-name']);

if (isset($_POST['lists']) == false || count($_POST['lists']) == 0) {
    $location = "Location: todo-lists.php?listID=$newID";
    header($location);
    exit;
}


$pdo = dbConnect();

$sql = "insert into ListItems (list_id, text, completed) SELECT 119, text, completed from ListItems where";

if (count($_POST['lists']) == 1) {
    $sql = $sql . ' list_id=' . $_POST['lists'][0];
} else {










}







?>
