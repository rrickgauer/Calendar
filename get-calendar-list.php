<?php

include_once('functions.php');

$pdo = dbConnect();

$sql = "SELECT yearweek(current_date()) as 'weeknum'";
$results = $pdo->query($sql);
$date = $results->fetch(PDO::FETCH_ASSOC);


echo '<div class="table-responsive">';


if (isset($_GET['weeknum'])) {
   $weekn = $_GET['weeknum'];
   $sql = "SELECT Items.id, Items.class_id, Items.name, date_format(Items.date_due, '%M %D %Y') as 'date_due', Items.type, Items.completed, Classes.id as 'cid', Classes.dept, Classes.number, Classes.section, Classes.title, Classes.color, dayofweek(Items.date_due) as \"weekday\" from Items left JOIN Classes on Items.class_id=Classes.id where yearweek(Items.date_due)=$weekn group by Items.id order by Items.date_due, Classes.title, Items.type";

   echo "<table class=\"table table-sm\" id=\"list-calendar-table\" data-yearweek=\"$weekn\">";


} else {
   $sql = "SELECT Items.id, Items.class_id, Items.name, date_format(Items.date_due, '%M %D %Y') as 'date_due', Items.type, Items.completed, Classes.id as 'cid', Classes.dept, Classes.number, Classes.section, Classes.title, Classes.color, dayofweek(Items.date_due) as \"weekday\" from Items left JOIN Classes on Items.class_id=Classes.id where yearweek(CURRENT_DATE()) = yearweek(Items.date_due) group by Items.id order by Items.date_due, Classes.title, Items.type";

   echo "<table class=\"table table-sm\" id=\"list-calendar-table\" data-yearweek=\"" . $date['weeknum'] . "\">";

}


$results = $pdo->query($sql);

$curDay = 0;
while($row = $results->fetch(PDO::FETCH_ASSOC))
{

   if ($row['weekday'] != $curDay) {
      $curDay = $row['weekday'];

      if ($curDay == 1) {
         $dayName = 'Sunday';
      } else if ($curDay == 2) {
         $dayName = 'Monday';
      } else if ($curDay == 3) {
         $dayName = 'Tuesday';
      } else if ($curDay == 4) {
         $dayName = 'Wednsday';
      } else if ($curDay == 5) {
         $dayName = 'Thursday';
      } else if ($curDay == 6) {
         $dayName = 'Friday';
      } else if ($curDay == 7) {
         $dayName = 'Saturday';
      }

      echo '<tr class="list-table-date-row">';
      echo '<th colspan="4">' . $dayName . '<div class="float-right">' . $row['date_due'] . '</div></th></tr>';
   }

   echo '<tr class="item-row">';
   $displayTitle = $row['dept'] . ' ' . $row['number'];
   echo '<td><a href="class.php?cid=' . $row['cid'] . '">' . $displayTitle   . '</td>';

   $name = $row['name'];
   $itemID = $row['id'];

   // item name
   if ($row['completed'] == 'y') {
      echo "<td class=\"text-line pointer\" onclick=\"gotoItem($itemID)\">$name</td>";
   } else {
      echo "<td class=\"pointer\" onclick=\"gotoItem($itemID)\">$name</td>";
   }

   if ($row['type'] == 'assignment') {
      $badgeClass = 'badge-assignment';
   } else if ($row['type'] == 'exam') {
      $badgeClass = 'badge-exam';
   } else if ($row['type'] == 'project') {
      $badgeClass = 'badge-project';
   } else if ($row['type'] == 'quiz') {
      $badgeClass = 'badge-quiz';
   } else {
      $badgeClass = 'badge-other';
   }

   echo "<td><span class=\"badge $badgeClass\">" . $row['type'] . '</span></td>';

  if ($row['completed'] == 'y') {
    echo "<td><button class=\"btn btn-sm btn-secondary float-right\" onclick=\"updateItem($itemID)\">Completed</button></td>";
  } else {
    echo "<td><button class=\"btn btn-sm btn-primary float-right\" onclick=\"updateItem($itemID)\">Complete</button></td>";
  }


   $completed = $row['completed'];
   echo '</tr>';


}


?>


</table>
</div>
