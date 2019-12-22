<?php

   include_once('functions.php');
   $setID = $_GET['setID'];

   $questionNumber = $_GET['q'];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <?php include('header.php'); ?>
  <title>Exam</title>
</head>

<body>
  <?php include('navbar.php'); ?>
  <div class="container-fluid">

    <h1>Exam</h1>


      <?php $termIDs = getRandomSetTermIDArray($setID); ?>




    <div id="question-section">


         <?php

         $termID = $termIDs[$questionNumber]['id'];
         $definition = $termIDs[$questionNumber]['definition'];


         // include("get-term-question.php?setID=$setID&termID=$termID&definition=$definition");

         include("get-term-question.php?termID=$termID");




         ?>






      </div>

      <button type="button" class="btn btn-primary" id="submit-answer-button">Submit</button>
      <button type="button" id="next-question-button" class="btn btn-primary">Next Question</button>





  </div>


  <script>

   var count = 0;
   var size = <?php echo count($termIDs); ?>;

      // sets the text of the correct answer green when submit button is clicked

      $("#submit-answer-button").click(function() {
        var correctInput = $("input[value^='c']").next().addClass("green");
      });









  </script>


</body>

</html>
