<?php include_once('functions.php'); ?>
<?php

$pdo = dbConnect();

$sql = 'SELECT id, dept, number, title, term FROM Classes ORDER BY term DESC, dept, number';
$results = $pdo->query($sql);
$sum19 = [];
$f19 = [];
$s20 = [];

while ($row = $results->fetch(PDO::FETCH_ASSOC)) {

   switch ($row['term']) {
      case 'sum19':
         array_push($sum19, $row);
         break;

      case 'f19':
         array_push($f19, $row);
         break;
      
      case 's20':
         array_push($s20, $row);
         break;
   }

}


?>
<!DOCTYPE html>
<html>
<head>
   <?php include('header.php'); ?>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
   <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

   <title>Test</title>
</head>
<body>

   <?php include('navbar.php'); ?>

   <div class="container-fluid">
      
      <h1>Test</h1>


      <div class="row">

         <div class="col-md-4">
            <h3>Summer 2019</h3>
            <div class="list-group list-group-flush">

            <?php

               $count = 0;

               while ($count < sizeof($sum19)) {

                  $item = $sum19[$count];
                  $id = $item['id'];
                  $dept = $item['dept'];
                  $number = $item['number'];
                  $title = $item['title'];

                  echo "<a href=\"class.php?cid=$id\" class=\"list-group-item list-group-item-action\">$dept $number - $title</a>";
                  $count++;
               }

            ?>
               
            </div>
         </div>



         <div class="col-md-4">
            <h3>Fall 2019</h3>
            <div class="list-group list-group-flush">

            <?php

               $count = 0;

               while ($count < sizeof($f19)) {

                  $item = $f19[$count];
                  $id = $item['id'];
                  $dept = $item['dept'];
                  $number = $item['number'];
                  $title = $item['title'];

                  echo "<a href=\"class.php?cid=$id\" class=\"list-group-item list-group-item-action\">$dept $number - $title</a>";
                  $count++;
               }

            ?>
               
            </div>


         </div>

         <div class="col-md-4">
            <h3>Spring 2020</h3>
            <div class="list-group list-group-flush">

            <?php

               $count = 0;

               while ($count < sizeof($s20)) {

                  $item = $s20[$count];
                  $id = $item['id'];
                  $dept = $item['dept'];
                  $number = $item['number'];
                  $title = $item['title'];

                  echo "<a href=\"class.php?cid=$id\" class=\"list-group-item list-group-item-action\">$dept $number - $title</a>";
                  $count++;
               }

            ?>
               
            </div>
         </div>

      </div>
   </div>



   

</body>
</html>
