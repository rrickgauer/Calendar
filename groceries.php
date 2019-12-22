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
    <h1>Grocery Calculator</h1>

    <div class="row">

      <div id="add-item-section" class="col-sm-12 col-md-6">
        <form class="form">
          <input type="text" id="name" class="form-control item-input" placeholder="Name"> <br>
          <input type="number" id="price" class="form-control item-input" placeholder="Price"> <br>
          <input type="number" id="quantity" class="form-control item-input" placeholder="Quantity"> <br>
        </form>

        <button class="btn btn-primary" id="add-item-button">Add Item</button>
      </div>

      <div id="sum-results" class="col-sm-12 col-md-6">
        <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#sum-section" aria-expanded="false" aria-controls="multiCollapseExample2" id="show-sum-button">Show Sum</button>
        <div id="sum-section" class="collapse col-sm-12 col-md-4 col-lg-3">

          <div class="form-group">
            <label for="tax"><b>Tax:</b></label>
            <input type="number" class="form-control" id="tax" placeholder="Enter tax" value="0.1">
          </div>

          <div class="form-group">
            <label for="additional-funds"><b>Additional Funds:</b></label>
            <input type="text" class="form-control" id="additional-funds" placeholder="Enter additional funds" value="0">
          </div>

          <div class="form-group">
            <label for="sum"><b>Sum:</b></label>
            <input type="text" class="form-control" id="sum" value="0" readonly>
          </div>
        </div>
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
    $('#table-body').append('<tr><td>' + name + '</td><td>' + price + '</td><td>' + quantity + '</td><td class="item-total-cost">' + totalCost + '</td></tr>');
  }

  $(document).ready(function() {

    $("#add-item-button").click(function() {

      var name = $("#name").val();
      var price = $("#price").val();
      var quantity = $("#quantity").val();
      var totalCost = price * quantity;

      addRow(name, price, quantity, totalCost);
      $(".item-input").val('');

      updateSum();

    });

    $("#show-sum-button").click(function() {
      updateSum();
    });

  });


  function updateSum() {
    var amounts = document.getElementsByClassName("item-total-cost");

    var runningTotal = 0;

    for (var count = 0; count < amounts.length; count++) {
      runningTotal += parseFloat(amounts[count].innerText);
    }


    var tax = parseFloat(document.getElementById('tax').value);
    var additionalFunds = parseFloat(document.getElementById('additional-funds').value);

    var newSum = (tax * runningTotal) + runningTotal + additionalFunds;

    $("#sum").val('$' + newSum);
  }
</script>




</html>
