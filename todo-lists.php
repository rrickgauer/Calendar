<?php include_once('functions.php'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<?php include('header.php'); ?>
	<link rel="stylesheet" type="text/css" href="todo-style.css">
	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Todo's</title>
</head>

<body>
	<?php include('navbar.php'); ?>
	<div class="wrapper">

		<!-- sidebar -->
		<nav id="sidebar">
			<div class="sidebar-header">
				<h5>Lists
					<div class="float-right align-vertical">
						<a href="#" data-toggle="modal" data-target="#new-todo-list-modal" id="new-list">
							<ion-icon name="add" class="hover-blue" data-toggle="tooltip" data-placement="top" title="New list"></ion-icon>
						</a>
					</div>
				</h5>
			</div>

			<ul class="list-unstyled components">
				<?php printTodoListGroup(); ?>
			</ul>

		</nav>

		<!-- list card  -->
		<div id="content">
			<div class="container-fluid">

				<button type="button" id="sidebarCollapse" class="btn btn-primary">
					Lists <ion-icon name="folder"></ion-icon>
				</button>

				<div id="todo-list-section">

					<?php
                        if (isset($_GET['listID']))
                           printListItems($_GET['listID']);
                     ?>

				</div>
			</div>
		</div>


		<!-- new todo list modal -->
		<div class="modal fade" id="new-todo-list-modal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header card-header">
						<h5 class="modal-title" id="exampleModalLabel">New List</h5>
						<button type="button" class="close custom-text-white" data-dismiss="modal">&times;</button>
					</div>

					<div class="modal-body custom-bg-white">

						<form class="form" method="post" id="new-todo-form" name="new-todo-list-form" action="add-todo-list.php">
							<input type="text" name="list-name" id="new-todo-name-input" placeholder="List name" class="form-control" required autofocus>
						</form>

					</div>

					<div class="modal-footer custom-bg-white">
						<input type="submit" value="Create" form="new-todo-list-form" onclick="addList()" class="btn btn-primary">
					</div>
				</div>
			</div>
		</div>


		<!-- edit todo list name -->
		<div class="modal fade" id="update-todo-list-name-modal">
			<div class="modal-dialog">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header card-header">
						<h4 class="modal-title">Edit name</h4>
						<button type="button" class="close custom-text-white" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body custom-bg-white">
						<form class="form" action="update-todo-list-name.php?listID=<?php echo $_GET['listID']; ?>" method="post" id="update-todo-list-name-form">
							<input type="text" name="update-todo-list-title" class="form-control">
						</form>
					</div>

					<!-- Modal footer -->
					<div class="modal-footer custom-bg-white">
						<button type="button" class="btn btn-primary" onclick="saveTodoListName()">Save</button>
					</div>

				</div>
			</div>
		</div>

	</div>




	<script>
		// executes addTodoItem when enter is pressed
		$(document).on("keypress", "#add-item-text", function(e) {
			if (e.keyCode == 13) {
				e.preventDefault();
				addTodoItem();
			}
		});

		function addTodoItem() {
			// update list card
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					var e = this.responseText;
					$("#todo-list-section").html(e);
				}
			};


			var listID = $("#todo-list-card").attr("data-listid");
			var text = $("#add-item-text").val();

			xhttp.open("GET", "add-todo-item.php?listID=" + listID + "&text=" + text, true);
			xhttp.send();

			$("#add-item-text").focus();
		}

		function updateComplete(checkbox) {
			// update list card
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					var e = this.responseText;
					$("#todo-list-section").html(e);
				}
			};

			var listID = $("#todo-list-card").attr("data-listid");
			var itemID = $(checkbox).closest("tr").attr("data-itemID");

			if (checkbox.checked == true) {
				var completed = 'y';
			} else {
				var completed = 'n';
			}


			var link = 'update-todo-item-completed.php?listID=' + listID + '&itemID=' + itemID + '&completed=' + completed;

			xhttp.open("GET", link, true);
			xhttp.send();
		}



		function deleteTodoListItem(item) {

			if (confirm("Are you sure you want to delete?")) {
				// update list card
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						var e = this.responseText;
						$("#todo-list-section").html(e);
					}
				};

				var listID = $("#todo-list-card").attr("data-listid");
				var itemID = $(item).closest("tr").attr("data-itemID");

				var link = 'delete-todo-item.php?listID=' + listID + '&itemID=' + itemID;

				xhttp.open("GET", link, true);
				xhttp.send();
			}
		}

		function completeAllListItems() {

			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					var e = this.responseText;
					$("#todo-list-section").html(e);
				}
			};

			var listID = $("#todo-list-card").attr("data-listid");

			var link = 'complete-all-list-items.php?listID=' + listID;

			xhttp.open("GET", link, true);
			xhttp.send();
		}

		function incompleteAllListItems() {

			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					var e = this.responseText;
					$("#todo-list-section").html(e);
				}
			};

			var listID = $("#todo-list-card").attr("data-listid");

			var link = 'incomplete-all-list-items.php?listID=' + listID;

			xhttp.open("GET", link, true);
			xhttp.send();
		}

		function addList() {
			$("#new-todo-form").submit();
		}

		function updateListName() {
			var listName = $("#list-title").text();
			$("input[name=update-todo-list-title]").val(listName);
		}

		function saveTodoListName() {
			$("#update-todo-list-name-form").submit();
		}

		function deleteTodoList(listID) {
			if (confirm("Are you sure you want to delete this list?")) {
				var link = 'delete-todo-list.php?listID=' + listID;
				window.location.href = link;
			}
		}

		function deleteCompletedListItems() {


			// update list card
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					var e = this.responseText;
					$("#todo-list-section").html(e);
				}
			};


			var listID = $("#todo-list-card").attr("data-listid");

			xhttp.open("GET", "delete-completed-todo-list-item.php?listID=" + listID, true);
			xhttp.send();

		}



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
			$("#todo-navbar-link").addClass("custom-bg-grey");
		});
	</script>



</body>

</html>
