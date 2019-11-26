<?php
   session_start();
   include('functions.php');
   $classInfo = getClassInfo($_GET['cid']);

   $htmlTitle = $classInfo['dept'] . ' ' . $classInfo['number'] . ' - ' . $classInfo['title'];

   // class information
   $classID = $_GET['cid'];
   $selectedDept = $classInfo['dept'];
   $number = $classInfo['number'];
   $section = $classInfo['section'];
   $title = $classInfo['title'];
   $building = $classInfo['building'];
   $room = $classInfo['room'];
   $time_start = $classInfo['time_start'];
   $time_end = $classInfo['time_end'];
   $prof_first = $classInfo['prof_first'];
   $prof_last = $classInfo['prof_last'];
   $prof_email = $classInfo['prof_email'];
   $term = $classInfo['term'];
   $meets_mon = $classInfo['meets_mon'];
   $meets_tues = $classInfo['meets_tues'];
   $meets_wed = $classInfo['meets_wed'];
   $meets_thurs = $classInfo['meets_thurs'];
   $meets_fri = $classInfo['meets_fri'];
   $color = $classInfo['color'];

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<?php include('header.php'); ?>
	<title><?php echo $htmlTitle; ?></title>
</head>

<body>
	<?php include('navbar.php'); ?>

	<div class="container">
		<?php
            if (isset($_SESSION['item-inserted-correctly'])) {
               if ($_SESSION['item-inserted-correctly'] == true) {
                  printAlert("Item added!");
                  unset($_SESSION['item-inserted-correctly']);
               }
            }
         ?>
	</div>

	<div class="container-fluid">

		<!-- class info card -->
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						<h4><?php echo $htmlTitle; ?>

							<div class="float-right">

								<div class="dropdown">
									<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									</button>

									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" href="#" data-toggle="modal" data-target="#add-item-modal">
											<ion-icon name="add" data-toggle="tooltip" data-placement="top" title="New item"></ion-icon>
											New item
										</a>

										<a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-update-class-info">
											<ion-icon name="create" data-toggle="tooltip" data-placement="top" title="Edit info"></ion-icon>
											Edit info
										</a>

										<a class="dropdown-item" href="#" onclick="deleteClass()">
											<ion-icon name="trash"></ion-icon>
											Delete class
										</a>

									</div>
								</div>

							</div>
						</h4>
					</div>
					<div class="card-body class-info-card">
						<table class="table table-sm class-info-table">
							<tbody>

                                <tr>
                                    <th>Section</th>
                                    <td><?php echo $section; ?></td>
                                </tr>

								<tr>
									<th>Location</th>
									<td><?php echo $classInfo['building'] . ' ' . $classInfo['room']; ?></td>
								</tr>
								<tr>
									<th>Days</th>
									<td>
										<?php
                                    if ($classInfo['meets_mon'] == 'y') {
                                       echo 'Monday ';
                                    } if ($classInfo['meets_tues'] == 'y') {
                                       echo 'Tuesday ';
                                    } if ($classInfo['meets_wed'] == 'y') {
                                       echo 'Wednesday ';
                                    } if ($classInfo['meets_thurs'] == 'y') {
                                       echo 'Thursday ';
                                    } if ($classInfo['meets_fri'] == 'y') {
                                       echo 'Friday ';
                                    }
                                 ?>
									</td>
								</tr>
								<tr>
									<th>Time</th>
									<td><?php echo $classInfo['time_start'] . ' - ' . $classInfo['time_end']; ?></td>
								</tr>
								<tr>
									<th>Professor</th>
									<td><?php echo $classInfo['prof_first'] . ' ' . $classInfo['prof_last']; ?></td>
								</tr>
								<tr>
									<th>Contact</th>
									<td><?php echo $classInfo['prof_email']; ?></td>
								</tr>
								<tr>
									<th>Term</th>
									<td><?php echo $classInfo['term']; ?></td>
								</tr>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<!-- Add item modal -->
		<div class="modal fade" tabindex="-1" role="dialog" id="add-item-modal">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">

					<div class="modal-header card-header">
						<h5 class="modal-title">New Item</h5>
						<button type="button" class="close custom-text-white" data-dismiss="modal">&times;</button>
					</div>

					<div class="modal-body custom-bg-white">

						<form action="insert-item.php?classID=<?php echo $classID; ?>" class="form" id="add-item-modal-form" name="add-item-modal-form" method="post">


							<!-- Class -->
							<div class="form-group row">
								<label for="class" class="col-form-label font-weight-bold">Class:</label>
								<select class="form-control" name="class" required><?php include('classes-select.php'); ?></select>
							</div>

							<!-- Name -->
							<div class="form-group row">
								<label for="name" class="col-form-label font-weight-bold">Name:</label>
								<input type="text" name="name" class="form-control" required>
							</div>

							<!-- type -->
							<div class="form-group row">
								<label for="type" class="col-form-label font-weight-bold">Type:</label>
								<select class="form-control" name="type">
									<option value="assignment">Assignment</option>
									<option value="exam">Exam</option>
									<option value="project">Project</option>
									<option value="quiz">Quiz</option>
									<option value="other">Other</option>
								</select>
							</div>

							<!-- Date assigned -->
							<div class="form-group row">
								<label for="date-assigned" class="col-form-label font-weight-bold">Date assigned:</label>
								<input class="flatpickr flatpickr-input active form-control" type="text" readonly="readonly" id="date-assigned-new" name="date-assigned">
							</div>

							<!-- Date Due -->
							<div class="form-group row">
								<label for="date-due" class="col-form-label font-weight-bold">Date due:</label>
								<input class="flatpickr flatpickr-input active form-control" type="text" readonly="readonly" id="date-due-new" name="date-due">
							</div>

							<!-- Completed -->
							<div class="form-group row">
								<label for="completed" class="col-form-label font-weight-bold">Completed: </label>
								<div class="form-check-inline">
									<label class="form-check-label" for="radio1">
										<input type="radio" class="form-check-input" id="radio1" name="completed" value="n" checked>No
									</label>
								</div>
								<div class="form-check-inline">
									<label class="form-check-label" for="radio2">
										<input type="radio" class="form-check-input" id="radio2" name="completed" value="y">Yes
									</label>
								</div>
							</div>

							<!-- Notes -->
							<div class="form-group row">
								<label for="botes" class="col-form-label font-weight-bold">Notes:</label>
								<textarea class="form-control" rows="5" name="notes"></textarea>
							</div>

						</form>

					</div>

					<div class="modal-footer custom-bg-white">
						<button type="submit" form="add-item-modal-form" class="btn btn-primary">Save</button>
					</div>
				</div>
			</div>
		</div>

		<!-- update class info modal -->
		<div class="modal" id="modal-update-class-info">
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header card-header">
						<h4 class="modal-title"><?php echo $htmlTitle; ?></h4>
						<button type="button" class="close custom-text-white" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body custom-bg-white">
						<form action="edit-class.php?classID=<?php echo $classID; ?>" method="POST" id="update-class-modal-form" name="update-class-modal-form">

							<!-- Dept -->
							<div class="form-group row">
								<label for="dept" class="col-form-label font-weight-bold">Department:</label>
								<select class="form-control" id="dept" name="dept" required><?php include_once('depts-select.php'); ?></select>
							</div>

							<!-- number -->
							<div class="form-group row">
								<label for="number" class="col-form-label font-weight-bold">Number:</label>
								<input type="number" name="number" id="number" class="form-control" required value="<?php echo $number; ?>">
							</div>

							<!-- section -->
							<div class="form-group row">
								<label for="section" class="col-form-label font-weight-bold">Section:</label>
								<input type="number" name="section" id="section" class="form-control" required value="<?php echo $section; ?>">
							</div>

							<!-- Title -->
							<div class="form-group row">
								<label for="title" class="col-form-label font-weight-bold">Title:</label>
								<input type="text" name="title" id="title" class="form-control" required value="<?php echo $title; ?>">
							</div>

							<!-- building -->
							<div class="form-group row">
								<label for="building" class="col-form-label font-weight-bold">Building:</label>
								<select class="form-control" name="building" id="building">
									<?php include('building-select.php'); ?>
								</select>
							</div>

							<!-- room -->
							<div class="form-group row">
								<label for="room" class="col-form-label font-weight-bold">Room:</label>
								<input type="number" name="room" id="room" class="form-control" required value="<?php echo $room; ?>">
							</div>

							<!-- meeting days -->
							<div class="row">
								<p class="font-weight-bold">Meeting days: </p>

								<div class="form-check form-check-inline">
									<input type="checkbox" class="form-check-input" name="days[]" value="mon" id="mon" <?php if ($meets_mon == 'y') echo 'checked'; ?>>
									<label class="form-check-label" for="mon">Monday</label>
								</div>
								<div class="form-check form-check-inline">
									<input type="checkbox" class="form-check-input" name="days[]" value="tues" id="tues" <?php if ($meets_tues == 'y') echo 'checked'; ?>>
									<label class="form-check-label" for="tues">Tuesday</label>
								</div>
								<div class="form-check form-check-inline">
									<input type="checkbox" class="form-check-input" name="days[]" value="wed" id="wed" <?php if ($meets_wed == 'y') echo 'checked'; ?>>
									<label class="form-check-label" for="wed">Wednesday</label>
								</div>
								<div class="form-check form-check-inline">
									<input type="checkbox" class="form-check-input" name="days[]" value="thurs" id="thurs" <?php if ($meets_thurs == 'y') echo 'checked'; ?>>
									<label class="form-check-label" for="thurs">Thursday</label>
								</div>
								<div class="form-check form-check-inline">
									<input type="checkbox" class="form-check-input" name="days[]" value="fri" id="fri" <?php if ($meets_fri == 'y') echo 'checked'; ?>>
									<label class="form-check-label" for="fri">Friday</label>
								</div>


							</div>

							<!-- start time -->
							<div class="form-group row">
								<label for="time-start" class="col-form-label font-weight-bold">Start time:</label>
								<input type="time" name="time-start" id="time-start" class="form-control" value="<?php echo $classInfo['time_start_original']; ?>">
							</div>

							<!-- end time -->
							<div class="form-group row" required>
								<label for="time-end" class="col-form-label font-weight-bold">End time:</label>
								<input type="time" name="time-end" id="time-end" class="form-control" value="<?php echo $classInfo['time_end_original']; ?>">
							</div>

							<!-- professor first name -->
							<div class="form-group row" required>
								<label for="prof-first" class="col-form-label font-weight-bold">Professor first:</label>
								<input type="text" name="prof-first" id="prof-first" class="form-control" value="<?php echo $prof_first; ?>">
							</div>

							<!-- professor last name -->
							<div class="form-group row" required>
								<label for="prof-last" class="col-form-label font-weight-bold">Professor last:</label>
								<input type="text" name="prof-last" id="prof-last" class="form-control" value="<?php echo $prof_last; ?>">
							</div>

							<!-- professor email -->
							<div class="form-group row" required>
								<label for="prof-email" class="col-form-label font-weight-bold">Professor email:</label>
								<input type="email" name="prof-email" id="prof-email" class="form-control" value="<?php echo $prof_email; ?>">
							</div>

							<!-- term -->
							<div class="form-group row" required>
								<label for="term" class="col-form-label font-weight-bold">Term:</label>
								<select class="form-control" id="term" name="term">
									<option value="sum19" <?php if ($term == 'sum19') echo " selected"; ?>>Summer 2019</option>
									<option value="f19" <?php if ($term == 'f19') echo " selected"; ?>>Fall 2019</option>
									<option value="s20" <?php if ($term == 's20') echo " selected"; ?>>Spring 2020</option>
								</select>
							</div>

							<!-- number -->
							<div class="form-group row">
								<label for="color" class="col-form-label font-weight-bold">Color:</label>
								<input type="color" name="color" id="color" class="form-control" value="<?php echo $color; ?>">
							</div>

						</form>

					</div>

					<!-- Modal footer -->
					<div class="modal-footer custom-bg-white">
						<button type="submit" form="update-class-modal-form" class="btn btn-primary">Save</button>
					</div>

				</div>
			</div>
		</div>

		<br>

		<!-- tabs -->
		<?php $itemCounts = getClassItemTypeCounts($classID); ?>
		<ul class="nav nav-tabs" id="myTab" role="tablist">

			<li class="nav-item">
				<a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">All
					<span class="badge badge-primary">
						<?php $counts = $itemCounts->fetch(PDO::FETCH_ASSOC);       // fetch new count   ?>
						<?php  echo $counts['count(id)'];                           // print count       ?>
					</span>
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link" id="assignment-tab" data-toggle="tab" href="#assignments" role="tab" aria-controls="assignments" aria-selected="false">Assignments
					<span class="badge badge-primary">
						<?php $counts = $itemCounts->fetch(PDO::FETCH_ASSOC);       // fetch new count   ?>
						<?php  echo $counts['count(id)'];                           // print count       ?>
					</span>
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link" id="exam-tab" data-toggle="tab" href="#exams" role="tab" aria-controls="exams" aria-selected="false">Exams
					<span class="badge badge-primary">
						<?php $counts = $itemCounts->fetch(PDO::FETCH_ASSOC);       // fetch new count   ?>
						<?php  echo $counts['count(id)'];                           // print count       ?>
					</span>
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link" id="project-tab" data-toggle="tab" href="#projects" role="tab" aria-controls="projects" aria-selected="false">Projects
					<span class="badge badge-primary">
						<?php $counts = $itemCounts->fetch(PDO::FETCH_ASSOC);       // fetch new count   ?>
						<?php  echo $counts['count(id)'];                           // print count       ?>
					</span>
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link" id="quiz-tab" data-toggle="tab" href="#quizzes" role="tab" aria-controls="quizzes" aria-selected="false">Quizzes
					<span class="badge badge-primary">
						<?php $counts = $itemCounts->fetch(PDO::FETCH_ASSOC);       // fetch new count   ?>
						<?php  echo $counts['count(id)'];                           // print count       ?>
					</span>
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link" id="other-tab" data-toggle="tab" href="#other" role="tab" aria-controls="other" aria-selected="false">Other
					<span class="badge badge-primary">
						<?php $counts = $itemCounts->fetch(PDO::FETCH_ASSOC);       // fetch new count   ?>
						<?php  echo $counts['count(id)'];                           // print count       ?>
					</span>
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link" id="completed-tab" data-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="false">Completed
					<span class="badge badge-primary">
						<?php $counts = $itemCounts->fetch(PDO::FETCH_ASSOC);       // fetch new count   ?>
						<?php  echo $counts['count(id)'];                           // print count       ?>
					</span>
				</a>
			</li>
		</ul>

		<?php $results = getItemCategoryArrays($classID); ?>

		<!-- tab content -->
		<div class="tab-content" id="myTabContent">

			<!-- all items -->
			<div class="tab-pane fade active show" id="all" role="tabpanel" aria-labelledby="all-tab">
				<?php printItemCards($results['all']); ?>
			</div>

			<!-- assignments -->
			<div class="tab-pane fade" id="assignments" role="tabpanel" aria-labelledby="assignment-tab">
				<?php printItemCards($results['assignments']); ?>
			</div>

			<!-- exams -->
			<div class="tab-pane fade" id="exams" role="tabpanel" aria-labelledby="exam-tab">
				<?php printItemCards($results['exams']); ?>
			</div>

			<!-- projects -->
			<div class="tab-pane fade" id="projects" role="tabpanel" aria-labelledby="project-tab">
				<?php printItemCards($results['projects']); ?>
			</div>

			<!-- quizzes -->
			<div class="tab-pane fade" id="quizzes" role="tabpanel" aria-labelledby="quiz-tab">
				<?php printItemCards($results['quizzes']); ?>
			</div>

			<!-- other -->
			<div class="tab-pane fade" id="other" role="tabpanel" aria-labelledby="other-tab">
				<?php printItemCards($results['other']); ?>
			</div>

			<!-- completed items -->
			<div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
				<?php printItemCards($results['completed']); ?>
			</div>
		</div>
		<br>



		<!-- Update item modal -->
		<div class="modal" id="update-item-modal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content" id="update-item-model-content">
					<!-- see get-item-info.php -->
				</div>
			</div>
		</div>

		<script>
			// tool tip for add item
			$(document).ready(function() {
				$('[data-toggle="tooltip"]').tooltip();
			});


			// updates the info in the update-item-info form modal
			function getUpdateItemFormInfo(classID) {
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						var e = this.responseText;
						$("#update-item-model-content").html(e);
					}
				};

				var id = $();
				xhttp.open("GET", "get-item-info.php?q=" + classID, true);
				xhttp.send();
			}

			function deleteClass() {

				if (confirm("Are you sure you want to delete this class?")) {
					var location = 'delete-class.php?classID=' + < ? php echo $classID; ? > ;
					window.location.href = location;
				}
			}

			// datepicker format
			flatpickr("#date-assigned-new", {
				altInput: true,
				altFormat: "F j, Y",
				dateFormat: "Y-m-d",
				defaultDate: "today"
			});

			flatpickr("#date-due-new", {
				altInput: true,
				altFormat: "F j, Y",
				dateFormat: "Y-m-d",
			});

			// set the background on the navbar to selected
			$(document).ready(function() {
				$("#class-navbar-link").addClass("custom-bg-grey");
			});
		</script>


		<!-- last div -->
	</div>

</body>

</html>