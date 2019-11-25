<?php

include_once('functions.php');

$pdo = dbConnect();

//$sql = "select * from Classes where id=" . $_GET['q'];

$sql = $pdo->prepare('SELECT * FROM Classes WHERE id=:id');
$id = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_NUMBER_INT);
$sql->bindParam(':id', $id, PDO::PARAM_INT);
$sql->execute();

$row = $sql->fetch(PDO::FETCH_ASSOC);

$dept = $row['dept'];
$number = $row['number'];
$section = $row['section'];
$title = $row['title'];
$building = $row['building'];
$room = $row['room'];

echo "<div class=\"modal-header\">
         <h4 class=\"modal-title\">$title</h4>
         <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
      </div>

<!-- Modal body -->
<div class=\"modal-body\">
   <table>

      <tr>
         <th>Department</th>
         <td>$dept</td>
      </tr>

      <tr>
         <th>Number</th>
         <td>$number</td>
      </tr>

      <tr>
         <th>Section</th>
         <td>$section</td>
      </tr>

      <tr>
         <th>Title</th>
         <td>$title</td>
      </tr>

      <tr>
         <th>Building</th>
         <td>$building</td>
      </tr>

      <tr>
         <th>Room</th>
         <td>$room</td>
      </tr>


   </table>
</div>";










?>
