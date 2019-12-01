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
