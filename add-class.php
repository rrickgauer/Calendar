<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
	<?php include('header.php'); ?>
	<title>Add class</title>

</head>

<body>


	<?php include('navbar.php'); ?>

	<div class="container-fluid">

		<h1>Add class</h1>

		<form action="insert-class.php" method="POST">

			<div class="form-row">
				<!-- department -->
				<div class="form-group col-md-4">
					<label for="dept" class="col-form-label font-weight-bold">Department:</label>
					<select class="form-control" id="dept" name="dept" required autofocus><?php include('depts-select.php'); ?></select>
				</div>

				<!-- number -->
				<div class="form-group col-md-4">
					<label for="number" class="col-form-label font-weight-bold">Number:</label>
					<input type="number" name="number" id="number" class="form-control" required>
				</div>

				<!-- section -->
				<div class="form-group col-md-4">
					<label for="section" class="col-form-label font-weight-bold">Section:</label>
					<input type="number" name="section" id="section" class="form-control" required>
				</div>
			</div>

			<!-- title -->
			<div class="form-group">
				<label for="title" class="col-form-label font-weight-bold">Title:</label>
				<input type="text" name="title" id="title" class="form-control" required>
			</div>

			<div class="form-row">

				<!-- building -->
				<div class="form-group col-sm-6">
					<label for="building" class="col-form-label font-weight-bold">Building:</label>
					<select class="form-control" name="building" id="building">
						<?php include('building-select.php'); ?>
					</select>
				</div>

				<!-- room number -->
				<div class="form-group col-sm-6">
					<label for="room" class="col-form-label font-weight-bold">Room:</label>
					<input type="number" name="room" id="room" class="form-control" required>
				</div>
			</div>

			<!-- meeting days -->
			<div class="form-group">
				<label for="days[]" class="font-weight-bold">Meeting days:</label>
				<div class="form-check form-check-inline">
					<input type="checkbox" class="form-check-input" name="days[]" value="mon" id="mon">
					<label class="form-check-label" for="mon">Monday</label>
				</div>
				<div class="form-check form-check-inline">
					<input type="checkbox" class="form-check-input" name="days[]" value="tues" id="tues">
					<label class="form-check-label" for="tues">Tuesday</label>
				</div>
				<div class="form-check form-check-inline">
					<input type="checkbox" class="form-check-input" name="days[]" value="wed" id="wed">
					<label class="form-check-label" for="wed">Wednesday</label>
				</div>
				<div class="form-check form-check-inline">
					<input type="checkbox" class="form-check-input" name="days[]" value="thurs" id="thurs">
					<label class="form-check-label" for="thurs">Thursday</label>
				</div>
				<div class="form-check form-check-inline">
					<input type="checkbox" class="form-check-input" name="days[]" value="fri" id="fri">
					<label class="form-check-label" for="fri">Friday</label>
				</div>
			</div>

			<div class="form-row">

				<!-- time start -->
				<div class="form-group col-sm-6">
					<label for="time-start" class="col-form-label font-weight-bold">Start time:</label>
					<input type="time" name="time-start" id="time-start" class="form-control">
				</div>

				<!-- time end -->
				<div class="form-group col-sm-6">
					<label for="time-end" class="col-form-label font-weight-bold">End time:</label>
					<input type="time" name="time-end" id="time-end" class="form-control">
				</div>
			</div>

			<div class="form-row">

				<!-- professor first name -->
				<div class="form-group col-sm-6">
					<label for="prof-first" class="col-form-label font-weight-bold">Professor first:</label>
					<input type="text" name="prof-first" id="prof-first" class="form-control">
				</div>

				<!-- professor last name -->
				<div class="form-group col-sm-6">
					<label for="prof-last" class="col-form-label font-weight-bold">Professor last:</label>
					<input type="text" name="prof-last" id="prof-last" class="form-control">
				</div>
			</div>

			<!-- professor email -->
			<div class="form-group">
				<label for="prof-email" class="col-form-label font-weight-bold">Professor email:</label>
				<input type="email" name="prof-email" id="prof-email" class="form-control">
			</div>

			<!-- term -->
			<div class="form-group">
				<label for="term" class="col-form-label font-weight-bold">Term:</label>
				<select class="form-control" id="term" name="term">
					<option value="sum19">Summer 2019</option>
					<option value="f19">Fall 2019</option>
					<option value="s20">Spring 2020</option>
				</select>
			</div>

			<div class="float-right">
				<input type="submit" value="Submit" class="btn btn-primary">
			</div>
		</form>

	</div>

	<script>
		$(document).ready(function() {
			$("#add-class-navbar-link").addClass("custom-bg-grey");
		});
	</script>

</body>

</html>
