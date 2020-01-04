<?php
include('functions.php');
$itemTypeCounts = getViewItemTypeCounts();
$itemTypeCounts = $itemTypeCounts->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <?php include('header.php'); ?>
  <title>Home</title>
</head>

<body>
  <?php include('navbar.php'); ?>
  <div class="container-fluid">

    <h1>Home</h1>

    <div class="row">

      <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">

        <div class="card">
          <div class="card-header">
            <h2>Item types</h2>
          </div>

          <div class="card">
            <div class="card-body">
              <h3><?php echo $itemTypeCounts['count_assignments']; ?></h3>
              <p>Assignments</p>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <h3><?php echo $itemTypeCounts['count_exams']; ?></h3>
              <p>Exams</p>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <h3><?php echo $itemTypeCounts['count_projects']; ?></h3>
              <p>Projects</p>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <h3><?php echo $itemTypeCounts['count_quizzes']; ?></h3>
              <p>Quizzes</p>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <h3><?php echo $itemTypeCounts['count_other']; ?></h3>
              <p>Other</p>
            </div>
          </div>
        </div>
      </div>


    </div>










  </div>

  <script>
    // set the background on the navbar to selected
    $(document).ready(function() {
      $("#home-navbar-link").addClass("custom-bg-grey");
    });
  </script>

</body>

</html>
