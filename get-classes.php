<?php

include('functions.php');

$pdo = dbConnect();
$sql = "select id, dept, number, section, title from Classes;";
$results = $pdo->query($sql);

while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
   $href = 'class.php?cid=' . $row['id'];
   $display = $row['dept'] . ' ' . $row['number'] . ' - ' . $row['title'];
   echo "<a href=\"$href\" class=\"nav-link\">$display</a>";
}

?>
