<?php
include_once('functions.php');
$counts = getClassItemCounts($_GET['classID'])->fetch(PDO::FETCH_ASSOC);
echo json_encode($counts);
?>
