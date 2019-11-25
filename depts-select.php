

<?php

include_once('functions.php');

$pdo = dbConnect();

$sql = "SELECT id FROM Depts";
$results = $pdo->query($sql);

while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
   $dept = $row['id'];
   echo "<option value=\"$dept\"";

   // check if dept is selected
   if (isset($selectedDept)) {
      if ($selectedDept == $dept)
         echo "selected";
      }

   echo ">$dept</option>";



}




?>
