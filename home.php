<?php
include('functions.php');
$itemTypeCounts = getViewItemTypeCounts();
$itemTypeCounts = $itemTypeCounts->fetch(PDO::FETCH_ASSOC);

$summaryCounts = getHomePageSummaryCounts();
$summaryCounts = $summaryCounts->fetch(PDO::FETCH_ASSOC);
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


    <h1 class="custom-font">Personal Calendar</h1>



    <div class="row">

      <div class="col-sm-12 col-md-6">
        <div class="card home-page-card">
          <div class="card-header">
            <h2>Data summary</h2>
          </div>

          <div class="card-body custom-bg-white">
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="card">
                  <div class="card-body">
                    <h3><?php echo $summaryCounts['items']; ?></h3>
                    <p>Class items</p>
                  </div>
                </div>

                <div class="card">
                  <div class="card-body">
                    <h3><?php echo $summaryCounts['lists']; ?></h3>
                    <p>Todo lists</p>
                  </div>
                </div>
              </div>

              <div class="col-sm-12 col-md-6">
                <div class="card">
                  <div class="card-body">
                    <h3><?php echo $summaryCounts['classes']; ?></h3>
                    <p>Classes</p>
                  </div>
                </div>

                <div class="card">
                  <div class="card-body">
                    <h3><?php echo $summaryCounts['list_items']; ?></h3>
                    <p>Todo list items</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="col-sm-12 col-md-6">
        <!-- item type count chart -->
        <div class="card">
          <div class="card-header">
            <h2>Class items breakdown</h2>
          </div>
          <div class="card-body custom-bg-white">
            <canvas id="item-type-count-chart"></canvas>
          </div>
        </div>
      </div>


    </div>










  </div>
  <script src="home-js.js"></script>
</body>

</html>
