<?php

$pdo = dbConnect();

$sql = "select Classes.id, Classes.dept, Classes.number, Classes.title from Classes ORDER BY dept asc, number asc";

$results = $pdo->query($sql);

while ($row = $results->fetch(PDO::FETCH_ASSOC))
{
   $c = $row['dept'] . ' ' . $row['number'] . ' - ' . $row['title'];

   if ($classID == $row['id']) {
      echo "<option selected value=\"" . $row['id'] . "\">" . $c . '</option>';
   } else {
      echo "<option value=\"" . $row['id'] . "\">" . $c . '</option>';
   }
}




?>
