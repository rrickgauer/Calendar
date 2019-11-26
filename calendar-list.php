<?php include_once('functions.php'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<?php include_once('header.php'); ?>
	<link rel="stylesheet" type="text/css" href="calendar-style.css">
	<title>Calendar List</title>
</head>

<body>
	<?php include('navbar.php'); ?>
	<div class="container-fluid">

		<div class="card">
			<div class="card-header">

				<div class="row">

					<div class="col-sm-10">
						<div class="btn-group">
							<button type="button" class="btn btn-primary" id="previousWeekButton">
								<ion-icon name="arrow-round-back"></ion-icon>
							</button>
							<button type="button" class="btn btn-primary" id="nextWeekButton">
								<ion-icon name="arrow-round-forward"></ion-icon>
							</button>
						</div>
						<button type="button" class="btn btn-primary" id="todayButton">today</button>
					</div>

					<div class="col-sm-2">
						<div class="dropdown">
							<button class="btn btn-primary dropdown-toggle" type="button" id="typeDropDownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Filter
							</button>
							<div class="dropdown-menu" aria-labelledby="typeDropDownMenuButton">
								<button type="button" class="calendar-type-btn dropdown-item btn-primary-selected custom-text-white" id="all-button" onclick="showAll()">All</button>
								<button type="button" class="calendar-type-btn dropdown-item" id="assignments-button" onclick="showAssignments()">Assigments</button>
								<button type="button" class="calendar-type-btn dropdown-item" id="exams-button" onclick="showExams()">Exams</button>
								<button type="button" class="calendar-type-btn dropdown-item" id="projects-button" onclick="showProjects()">Projects</button>
								<button type="button" class="calendar-type-btn dropdown-item" id="quizzes-button" onclick="showQuizzes()">Quizzes</button>
								<button type="button" class="calendar-type-btn dropdown-item" id="other-button" onclick="showOther()">Other</button>
							</div>
						</div>
					</div>


				</div>
			</div>
		</div>


		<div class="card-body custom-bg-white">
			<?php include('get-calendar-list.php'); ?>
		</div>



		<!-- end card -->
	</div>

	</div>

	<script>
		function showAll() {
			$("tr").show();
			$(".calendar-type-btn").removeClass("btn-primary-selected");
			$(".calendar-type-btn").removeClass("custom-text-white");
			$("#all-button").addClass("btn-primary-selected");
			$("#all-button").addClass("custom-text-white");
		}

		function showAssignments() {
			$(".item-row").hide();
			$(".badge-assignment").closest("tr").show();
			$(".calendar-type-btn").removeClass("btn-primary-selected");
			$(".calendar-type-btn").removeClass("custom-text-white");
			$("#assignments-button").addClass("btn-primary-selected");
			$("#assignments-button").addClass("custom-text-white");
		}

		function showExams() {
			$(".item-row").hide();
			$(".badge-exam").closest("tr").show();
			$(".calendar-type-btn").removeClass("btn-primary-selected");
			$(".calendar-type-btn").removeClass("custom-text-white");
			$("#exams-button").addClass("btn-primary-selected");
			$("#exams-button").addClass("custom-text-white");
		}

		function showProjects() {
			$(".item-row").hide();
			$(".badge-project").closest("tr").show();
			$(".calendar-type-btn").removeClass("btn-primary-selected");
			$(".calendar-type-btn").removeClass("custom-text-white");
			$("#projects-button").addClass("btn-primary-selected");
			$("#projects-button").addClass("custom-text-white");
		}

		function showQuizzes() {
			$(".item-row").hide();
			$(".badge-quiz").closest("tr").show();
			$(".calendar-type-btn").removeClass("btn-primary-selected");
			$(".calendar-type-btn").removeClass("custom-text-white");
			$("#quizzes-button").addClass("btn-primary-selected");
			$("#quizzes-button").addClass("custom-text-white");
		}

		function showOther() {
			$(".item-row").hide();
			$(".badge-other").closest("tr").show();
			$(".calendar-type-btn").removeClass("btn-primary-selected");
			$(".calendar-type-btn").removeClass("custom-text-white");
			$("#other-button").addClass("btn-primary-selected");
			$("#other-button").addClass("custom-text-white");
		}

		$("#nextWeekButton").on("click", function() {

			// updated the selected dropdown menu classes to all
			$(".calendar-type-btn").removeClass("btn-primary-selected");
			$(".calendar-type-btn").removeClass("custom-text-white");
			$("#all-button").addClass("btn-primary-selected");
			$("#all-button").addClass("custom-text-white");

			// add 1 to the current yearweek being displayed
			var weekNumber = $("#list-calendar-table").attr("data-yearweek");
			var nextWeekNumber = parseInt(weekNumber) + 1;

			// create xhttp object
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					var table = this.responseText;
					$(".card-body").html(table);
				}
			};


			//alert("get-calendar-list.php?weeknum=" + nextWeekNumber);
			xhttp.open("GET", "get-calendar-list.php?weeknum=" + nextWeekNumber, true);
			xhttp.send();
		});

		$("#previousWeekButton").on("click", function() {

			// updated the selected dropdown menu classes to all
			$(".calendar-type-btn").removeClass("btn-primary-selected");
			$(".calendar-type-btn").removeClass("custom-text-white");
			$("#all-button").addClass("btn-primary-selected");
			$("#all-button").addClass("custom-text-white");

			// add 1 to the current yearweek being displayed
			var weekNumber = $("#list-calendar-table").attr("data-yearweek");
			var nextWeekNumber = parseInt(weekNumber) - 1;

			// create xhttp object
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					var table = this.responseText;
					$(".card-body").html(table);
				}
			};

			//alert("get-calendar-list.php?weeknum=" + nextWeekNumber);
			xhttp.open("GET", "get-calendar-list.php?weeknum=" + nextWeekNumber, true);
			xhttp.send();
		});

		$("#todayButton").on("click", function() {

			// updated the selected dropdown menu classes to all
			$(".calendar-type-btn").removeClass("btn-primary-selected");
			$(".calendar-type-btn").removeClass("custom-text-white");
			$("#all-button").addClass("btn-primary-selected");
			$("#all-button").addClass("custom-text-white");

			// create xhttp object
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					var table = this.responseText;
					$(".card-body").html(table);
				}
			};

			//alert("get-calendar-list.php?weeknum=" + nextWeekNumber);
			xhttp.open("GET", "get-calendar-list.php", true);
			xhttp.send();
		});

		function gotoItem(itemID) {
			window.location.href = 'item.php?id=' + itemID;
		}

		// set the background on the navbar to selected
		$(document).ready(function() {
			$("#calendar-navbar-link").addClass("custom-bg-grey");
		});
	</script>

</body>

</html>
