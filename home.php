<?php
include('functions.php');
$itemTypeCounts = getViewItemTypeCounts();
$itemTypeCounts = $itemTypeCounts->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <?php include('header.php'); ?>

  <!-- Chart.JS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>

  <title>Home</title>
</head>

<body>
  <?php include('navbar.php'); ?>
  <div class="container-fluid">

    <h1>Home</h1>

    <div class="row">

      <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">

        <!-- item type count chart -->
        <div class="card">
          <div class="card-header">
            <h3>Items</h3>
          </div>
          <div class="card-body">
            <canvas id="item-type-count-chart"></canvas>
          </div>
        </div>

        
      </div>


    </div>










  </div>
 <script src="home-js.js"></script>
</body>

</html>
