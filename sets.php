<?php

	include_once('functions.php');

	if (isset($_GET['setID']))
		$setID = $_GET['setID'];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<?php include('header.php'); ?>
	<link rel="stylesheet" type="text/css" href="todo-style.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Study Sets</title>
</head>

<body>
	<?php include('navbar.php'); ?>
	<div class="wrapper">

		<!-- sidebar -->
		<nav id="sidebar">
			<div class="sidebar-header">
				<h5>Sets
					<div class="float-right align-vertical">
						<a href="#" data-toggle="modal" data-target="#new-set-modal" id="new-set">
							<ion-icon name="add" class="hover-blue" data-toggle="tooltip" data-placement="top" title="New set"></ion-icon>
						</a>

					</div>
				</h5>
			</div>

			<!-- Sets list side bar -->
			<ul class="list-unstyled components">
				<?php printSetSidebar(); ?>
			</ul>

		</nav>

		<!-- list card  -->
		<div id="content">
			<div class="container-fluid">

				<!-- show sets sidebar button -->
				<button type="button" id="sidebarCollapse" class="btn btn-primary">
					Sets <ion-icon name="folder"></ion-icon>
				</button><br><br>

				<!-- term/definition table -->
				<div id="terms-section">
					<?php if (isset($_GET['setID'])) printSetTerms($_GET['setID']); ?>
				</div>
			</div>
		</div>


	</div>

</body>

<!-- Edit Term modal -->
<div class="modal fade" id="editTermModal">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header card-header">
				<h5 class="custom-text-white">Edit</h5>
				<button type="button" class="close custom-text-white" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">

				<!-- update term form -->
				<form class="form" action="update-term.php?setID=<?php echo $setID; ?>" method="post" name="updateTermForm" id="updateTermForm">
					<input type="text" name="term" class="form-control" id="term" placeholder="Term"><br>
					<textarea name="definition" rows="6" class="form-control" id="definition" placeholder="Definition"></textarea>
					<input type="text" name="termID" readonly id="termID" hidden>
				</form>

			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" form="updateTermForm" id="updateTermSaveButton">Save</button>
			</div>
		</div>
	</div>
</div>

<!-- New set modal -->
<div class="modal fade" id="new-set-modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header card-header">
				<h5 class="custom-text-white">New set</h5>
				<button type="button" class="close custom-text-white" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">
				<form class="form" action="create-new-set.php" method="post" name="new-set-form" id="new-set-form">
					<input type="text" name="name" placeholder="Enter set name" class="form-control" required>
				</form>
			</div>

			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" form="new-set-form" id="submit-new-set-form-button">Save</button>
			</div>
		</div>
	</div>
</div>


<script>
	// collapses side nav
	$(document).ready(function() {
		$('#sidebarCollapse').on('click', function() {
			$('#sidebar').toggleClass('active');
		});
	});

	// sets the current side nav item to active
	$(document).ready(function() {
		var listID = $("#todo-list-card").data("listid");
		$("a[data-listid=" + listID + "]").closest("li").addClass("active");
	});

	// set the background on the navbar to selected
	$(document).ready(function() {
		$("#sets-navbar-link").addClass("custom-bg-grey");
	});

	// sets the edit term moal values
	$(".edit-term-btn").click(function() {

		// get the values of the selected term
		var term = $(this).data("term");
		var definition = $(this).data("definition");
		var termID = $(this).data("termid");

		// set the update form values to the selected data
		$("#term").val(term);
		$("#definition").val(definition);
		$("#termID").val(termID);

		// show the modal
		$("#editTermModal").modal('show');
	});


	// submits the update term modal
	$("#updateTermSaveButton").click(function() {
		$("#updateTermForm").submit();
	});

	$("#submit-new-set-form-button").click(function() {
		$("#new-set-form").submit();
	});
</script>

</html>
