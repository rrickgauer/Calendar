<?php

   include_once('functions.php');
   $setID = $_GET['setID'];

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


		<div id="question-section">


			<?php

      $termIDs = getRandomSetTermIDArray($setID);

      $id = $termIDs[0]['id'];
      $definition = $termIDs[0]['definition'];


      echo "<p><b>Definition:</b> $definition</p>";
      echo "<p><b>ID:</b> $id</p>";


      $pdo = dbConnect();

      $sql = "SELECT Terms.term, \"c\" as \"value\" FROM Terms where Terms.id = $id union (select Terms.term, \"f\" from Terms where Terms.id!=$id and Terms.set_id=$setID order by rand() limit 3) order by rand()";

      $result = $pdo->query($sql);

      $answer1 = $result->fetch(PDO::FETCH_ASSOC);
      $answer2 = $result->fetch(PDO::FETCH_ASSOC);
      $answer3 = $result->fetch(PDO::FETCH_ASSOC);
      $answer4 = $result->fetch(PDO::FETCH_ASSOC);


      ?>


			<b>Select term:</b>
			<div class="form-check">
				<input class="form-check-input" type="radio" name="exampleRadios" id="radio1" value="<?php echo $answer1['value']; ?>">
				<label class="form-check-label" for="radio1">
					<?php echo $answer1['term']; ?>
				</label>
			</div>

			<div class="form-check">
				<input class="form-check-input" type="radio" name="exampleRadios" id="radio2" value="<?php echo $answer2['value']; ?>">
				<label class="form-check-label" for="radio2">
					<?php echo $answer2['term']; ?>
				</label>
			</div>

			<div class="form-check">
				<input class="form-check-input" type="radio" name="exampleRadios" id="radio3" value="<?php echo $answer3['value']; ?>">
				<label class="form-check-label" for="radio3">
					<?php echo $answer3['term']; ?>
				</label>
			</div>

			<div class="form-check">
				<input class="form-check-input" type="radio" name="exampleRadios" id="radio4" value="<?php echo $answer4['value']; ?>">
				<label class="form-check-label" for="radio4">
					<?php echo $answer4['term']; ?>
				</label>
			</div>

			<button type="button" class="btn btn-primary" id="submit-answer-button">Submit</button>


		</div>










	</div>


	<script>
		$(document).ready(function() {

			$("#submit-answer-button").click(function() {

				var correctInput = $("input[value^='c']").next().addClass("green");








			});

		});
	</script>


</body>

</html>
