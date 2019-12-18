<?php


include_once('functions.php');

// if name is not set return to todo list page
if (isset($_POST['list-name']) == false) {
   header('Location: todo-lists.php');
   exit;
}

// add new list to the database
$name = $_POST['list-name'];
$newID = insertTodoList($_POST['list-name']);

// if user does not want to add items from other lists go to new list page
if (isset($_POST['lists']) == false || count($_POST['lists']) == 0) {
    $location = "Location: todo-lists.php?listID=$newID";
    header($location);
    exit;
}


// add items from selected lists
$pdo = dbConnect();
$sql = "insert into ListItems (list_id, text, completed) SELECT $newID, text, completed from ListItems where";

if (count($_POST['lists']) == 1) {
    $sql = $sql . ' list_id=' . $_POST['lists'][0];
} else {

    $sql = $sql . ' list_id=' . $_POST['lists'][0];

    $count = 1;
    while ($count < count($_POST['lists'])) {

        $listID = $_POST['lists'][$count];

        $sql = $sql . ' OR list_id=' . $listID;
        $count++;
    }
}

$results = $pdo->exec($sql);
$pdo = null;
$sql = null;
$location = "Location: todo-lists.php?listID=$newID";
header($location);
exit;


?>
