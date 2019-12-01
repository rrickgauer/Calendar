<?php include_once('functions.php'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<?php include('header.php'); ?>
	<title>Test</title>
</head>

<body>
	<?php include('navbar.php'); ?>

	<div class="container-fluid">
		<h1>Test</h1>


		<form class="form"> 
			<input type="text" id="name" class="form-control" placeholder="Name"> <br>
			<input type="number" id="price" class="form-control" placeholder="Price"> <br>
			<input type="number" id="quantity" class="form-control" placeholder="Quantity"> <br>
		</form>

		<br>

		<button class="btn btn-primary" id="add-item-button">Add Item</button>


		<button class="btn btn-success" type="button" data-toggle="collapse" data-target="#sum-section" aria-expanded="false" aria-controls="multiCollapseExample2">Show Sum</button>

		<div id="sum-section" class="collapse col-sm-12 col-md-4 col-lg-3">

			<div class="form-group">
				<label for="tax"><b>Tax:</b></label>
				<input type="number" class="form-control" id="tax" placeholder="Enter tax" value="0.1">
			</div>

			<div class="form-group">
				<label for="additional-funds"><b>Additional Funds:</b></label>
				<input type="number" class="form-control" id="additional-funds" placeholder="Enter additional funds" value="0">
			</div>

			<div class="form-group">
				<label for="sum"><b>Sum:</b></label>
				<input type="text" class="form-control" id="sum" value="0" readonly>
			</div>




		</div>


		<br><br>

		<table class="table table-sm">
			<thead>
				<tr>
					<th>Item</th>
					<th>Unit Price</th>
					<th>Quantity</th>
					<th>Total Cost</th>
				</tr>
			</thead>

			<tbody id="table-body">

			</tbody>
		</table>


	</div>



</body>

<script>

	function addRow(name, price, quantity, totalCost) {
		$('#table-body').append('<tr><td>' + name + '</td><td>' + price + '</td><td>' + quantity + '</td><td>' + totalCost + '</td></tr>');
	}

	$(document).ready(function() {

		$("#add-item-button").click(function() {

			var name = $("#name").val();
			var price = $("#price").val();
			var quantity = $("#quantity").val();
			var totalCost = price * quantity;

			addRow(name, price, quantity, totalCost);

			$("input").val('');
			


		});


	});





	



</script>




</html>
