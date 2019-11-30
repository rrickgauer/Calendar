<?php

   include_once('functions.php');
   $setID = $_GET['setID'];

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<?php include('header.php'); ?>

	<!-- Select2 library -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
	<title>Exam</title>
</head>

<body>
	<?php include('navbar.php'); ?>
	<div class="container-fluid">

		<h1>Exam</h1>





      <?php

      $termIDs = getRandomSetTermIDArray($setID);


      ?>





















	</div>


	<script>
		$(document).ready(function() {
			$('.js-example-basic-single').select2();
		});
	</script>

</body>

</html>
