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




		<table class="table table-striped">
			<thead>
				<tr>

					<th>Term</th>
					<th>Definition</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

				<?php

                $pdo = dbConnect();
                $sql = 'SELECT * FROM Terms where set_id=14';
                $results = $pdo->query($sql);

                while ($row = $results->fetch(PDO::FETCH_ASSOC)) {

                    $termID = $row['id'];
                    $term = $row['term'];
                    $definition = $row['definition'];

                    echo '<tr>';


                    //echo "<td>$term</td>";

                    echo "<td><input type=\"text\" value=\"$term\" class=\"form-control\"></td>";

                    echo "<td><textarea class=\"form-control\">$definition</textarea></td>";

                    echo "<td><button type=\"button\" class=\"btn btn-primary edit-term-btn\" data-termid=\"$termID\" data-term=\"$term\" data-definition=\"$definition\">Edit</button></td>";


                    echo '</tr>';
                }





                ?>







			</tbody>


		</table>


		<button type="button" class="btn btn-primary">Edit</button>







	</div>



</body>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal">
	Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="editTermModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

                <form class="form" action="update-term.php" method="post" name="updateTermForm" id="updateTermForm">
                    <input type="text" name="term" class="form-control" id="term">
                    <textarea name="definition" rows="6" class="form-control" id="definition"></textarea>
                    <input type="text" name="termID" value="" readonly id="termID" hidden>
                </form>



			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" form="updateTermForm" id="updateTermSaveButton">Save</button>
			</div>
		</div>
	</div>
</div>

</html>

<script>

$(".edit-term-btn").click(function() {


    var term = $(this).data("term");
    var definition = $(this).data("definition");
    var termID = $(this).data("termid");

    $("#term").val(term);
    $("#definition").val(definition);
    $("#termID").val(termID);

    alert(termID);
    $("#editTermModal").modal('show');
});

$("#updateTermSaveButton").click(function() {

    $("#updateTermForm").submit();
});

</script>
