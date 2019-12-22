<?php include_once('functions.php'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <?php include('header.php'); ?>

  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
  <title>Test</title>
</head>

<body>
  <?php include('navbar.php'); ?>

  <div class="container-fluid">
    <h1>Test</h1>


    <form class="form" action="test.php" method="post">

      <select class="js-example-basic-multiple" name="lists[]" multiple="multiple" style="width: 100%">
        <?php
        $pdo = dbConnect();
        $sql = "SELECT Lists.id, Lists.title FROM Lists ORDER BY Lists.title";
        $results = $pdo->query($sql);
        while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
          $id = $row['id'];
          $title = $row['title'];
          echo "<option value=\"$id\">$title</option>";
        }
        ?>
      </select>

      <br><br><input type="submit" value="submit" class="btn btn-primary">

    </form>



    <?php

    if(isset($_POST['lists'])) {

      $count = 0;

      while ($count < count($_POST['lists'])) {
        echo $_POST['lists'][$count] . '<br>';
        $count++;
      }
    }




    ?>











  </div>


  <script>
    $(document).ready(function() {
      $('.js-example-basic-multiple').select2();
    });
  </script>
</body>






</html>
