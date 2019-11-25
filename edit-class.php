<?php

include_once('functions.php');

$pdo = dbConnect();

$classID = $_GET['classID'];

updateClass($classID, $_POST);

$location = "Location: class.php?cid=$classID";
header($location);

?>
