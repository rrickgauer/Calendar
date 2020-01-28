<?php
include('functions.php');
$summaryCounts = getHomePageSummaryCounts()->fetch(PDO::FETCH_ASSOC);
$classes = getAllClassData();
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
  <div class="container">

    <h1>Personal Calendar</h1>

        <!-- class cards -->
        <div class="card">
          <div class="card-header">
            <h2>Classes</h2>
          </div>

          <div class="card-body custom-bg-white">
            <?php

            $lineCount = 0;
            echo '<div class="card-deck">';

            while ($class = $classes->fetch(PDO::FETCH_ASSOC)) {

              if ($lineCount == 3) {
                echo '</div><div class="card-deck">';
                $lineCount = 0;
              }

              $id     = $class['id'];
              $dept   = $class['dept'];
              $number = $class['number'];
              $title  = $class['title'];
              $term   = $class['term'];
              $count  = $class['item_count'];

              if ($term == 'f19') {
                $termDisplay = 'Fall 2019';
              } else if ($term == 's20') {
                $termDisplay = 'Spring 2020';
              } else {
                $termDisplay = 'Summer 2019';
              }

              echo "<div class=\"card class-card-home\" data-id=\"$id\">";
              echo '<div class="card-body">';
              echo "<h5>$dept-$number: $title </h5>";
              echo '<p>';
              echo "<span class=\"badge badge-secondary\">$termDisplay</span> ";
              echo "<span class=\"badge badge-info\">$count items</span>";
              echo '</p>';
              echo '</div></div>';

              $lineCount++;
            }

            echo '</div>'
            ?>
          </div>
        </div>

        <br>

        <!-- data summary -->
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

        <br>
        
        <!-- item type count chart -->
        <div class="card">
          <div class="card-header">
            <h2>Class items breakdown</h2>
          </div>
          <div class="card-body custom-bg-white">
            <!-- see get-home-page-data.php -->
            <canvas id="item-type-count-chart"></canvas>
          </div>
        </div>



  </div>
  <script src="home-js.js"></script>
</body>

</html>
