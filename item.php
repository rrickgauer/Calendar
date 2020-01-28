<?php include('functions.php'); ?>
<?php

$itemID = $_GET['id'];
$pdo = dbConnect();

$sql = $pdo->prepare('SELECT Items.id, Items.class_id, Items.name, Items.type, DATE_FORMAT(Items.date_assigned, "%a, %b %D, %Y") as "date_assigned", Items.date_assigned as "date_assigned_default", DATE_FORMAT(Items.date_due, "%a, %b %D, %Y") as "date_due", Items.date_due as "date_due_default" , Items.completed, Items.notes, Classes.id, Classes.dept, Classes.number, Classes.section, Classes.title FROM Items LEFT JOIN Classes on Items.class_id=Classes.id WHERE Items.id=:id group by Items.id');


$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$sql->bindParam(':id', $id, PDO::PARAM_INT);
$sql->execute();
$row = $sql->fetch(PDO::FETCH_ASSOC);

$name                = $row['name'];
$type                = $row['type'];
$dateAssigned        = $row['date_assigned'];
$dateDue             = $row['date_due'];
$completed           = $row['completed'];
$notes               = $row['notes'];
$classID             = $row['class_id'];
$classDept           = $row['dept'];
$classNumber         = $row['number'];
$classSection        = $row['section'];
$className           = $row['dept'] . ' ' . $row['number'] . ' ' . ' - ' . $row['title'];
$classLink           = 'class.php?cid=' . $row['class_id'];
$dateAssignedDefault = $row['date_assigned_default'];
$dateDueDefault      = $row['date_due_default'];


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <?php include('header.php'); ?>
    <title>Item</title>
  </head>

  <body>

    <?php include('navbar.php'); ?>
    <div class="container">

      <!-- Alerts user that the item was added to a todo list -->
      <div class="alert alert-success alert-dismissible fade show" role="alert" id="item-added-to-list-alert">
        <strong>Item added!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div class="card" data-itemid="<?php echo $id; ?>" id="item-card" data-itemname="<?php echo $name; ?>">

        <div class="card-header">
          <h4>
            <?php echo $name; ?>
            <!-- dropdown menu -->
            <div class="float-right">
              <div class="dropdown dropleft">
                <ion-icon name="more" data-toggle="dropdown" class="hover-blue"></ion-icon>
                <div class="dropdown-menu">
                  <div class="pointer dropdown-header" data-toggle="modal" data-target="#update-item-modal">
                    <ion-icon name="create"></ion-icon> edit info
                  </div>
                  <div class="dropdown-divider"></div>
                  <div onclick="deleteItem(<?php echo $itemID; ?>)" class="pointer dropdown-header">
                    <ion-icon name="trash"></ion-icon> delete item
                  </div>
                  <div class="dropdown-header pointer" data-toggle="modal" data-target="#addTodoListModal">
                    <ion-icon name="add-circle"></ion-icon> add to list
                  </div>
                </div>
              </div>
            </div>
          </h4>
        </div>

        <div class="card-body custom-bg-white">
          <table class="table">
            <?php

                  // determine which class to use for the type badge
                  if ($type == 'assignment') {
                     $badgeClass = 'badge-assignment';
                  } else if ($type == 'exam') {
                     $badgeClass = 'badge-exam';
                  } else if ($type == 'project') {
                     $badgeClass = 'badge-project';
                  } else if ($type == 'quiz') {
                     $badgeClass = 'badge-quiz';
                  } else {
                     $badgeClass = 'badge-other';
                  }

                  // decide which completed tab to print
                  if ($completed == 'y') {
                     $completedBadge = '<ion-icon name="checkmark-circle" class="green"></ion-icon>';
                  } else {
                     $completedBadge = '<ion-icon name="close-circle" class="red"></ion-icon>';
                  }
               ?>


            <!-- type -->
            <tr>
              <th>Type</th>
              <td>
                <span class="badge <?php echo $badgeClass; ?>">
                  <?php echo $type; ?>
                </span>
              </td>
            </tr>

            <!-- date due -->
            <tr>
              <th>Date due</th>
              <td><?php echo $dateDue; ?></td>
            </tr>

            <!-- date assigned -->
            <tr>
              <th>Date assigned</th>
              <td><?php echo $dateAssigned; ?></td>
            </tr>

            <!-- completed -->
            <tr>
              <th>Completed</th>
              <td><?php echo $completedBadge ?></td>
            </tr>

            <!-- class link -->
            <tr>
              <th>Class</th>
              <td>
                <a href="<?php echo $classLink; ?>">
                  <?php echo $className; ?>
                </a>
              </td>
            </tr>

            <!-- notes -->
            <tr>
              <th>Notes</th>
              <td>
                <!-- number of rows that the notes text area has -->
                <?php $numRows = substr_count($notes, "\n"); ?>
                <textarea class="form-control" rows="<?php echo $numRows; ?>" id="comment" readonly><?php echo $notes; ?></textarea>
              </td>
            </tr>
          </table>

        </div>

        <div class="card-footer custom-bg-white">
          <div class="float-right">
            <?php
            if ($completed == 'n')
               echo "<a href=\"completed-item.php?itemID=$itemID\"><button class=\"btn btn-primary\">Complete</button></a>";
            else
               echo "<a href=\"uncomplete-item.php?itemID=$itemID\"><button class=\"btn btn-secondary\">Completed</button></a>";
            ?>
          </div>

        </div>
      </div>

    </div>

    <!-- update item info modal -->
    <div id="update-item">

      <!-- Modal -->
      <div class="modal fade" id="update-item-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">

            <div class="modal-header card-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit item</h5>
              <button type="button" class="close custom-text-white" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">

              <?php $actionLink = 'edit-item.php?id=' . $id;  ?>
              <form class="form" name="upate-form" id="update-form" method="post" action="<?php echo $actionLink; ?>">

                <!-- class -->
                <div class="form-group row">
                  <label for="class" class="col-form-label font-weight-bold">Class:</label>
                  <select class="form-control" name="class" id="update-item-form-class">
                    <?php include_once('classes-select.php'); ?>
                  </select>
                </div>

                <!-- name -->
                <div class="form-group row">
                  <label for="name" class="col-form-label font-weight-bold">Name:</label>
                  <input type="text" name="name" id="update-item-form-name" class="form-control" required value="<?php echo $name; ?>">
                </div>

                <!-- assignment type -->
                <div class="form-group row">
                  <label for="type" class="col-form-label font-weight-bold">Type:</label>
                  <select class="form-control" name="type" id="update-item-form-type">
                    <option <?php if ($type == 'assignment') {echo 'selected';} ?> value="assignment">Assignment</option>
                    <option <?php if ($type == 'exam') {echo 'selected';} ?> value="exam">Exam</option>
                    <option <?php if ($type == 'project') {echo 'selected';} ?> value="project">Project</option>
                    <option <?php if ($type == 'quiz') {echo 'selected';} ?> value="quiz">Quiz</option>
                    <option <?php if ($type == 'other') {echo 'selected';} ?> value="other">Other</option>
                  </select>
                </div>

                <!-- date assigned -->
                <div class="form-group row">
                  <label for="date-assigned" class="col-form-label font-weight-bold">Date assigned:</label>
                  <input class="flatpickr flatpickr-input active form-control" type="text" readonly="readonly" id="update-item-form-date-assigned" name="date-assigned">
                </div>

                <script type="">
                  // date assigned datepicker
            flatpickr("#update-item-form-date-assigned", {
               altInput: true,
               altFormat: "F j, Y",
               dateFormat: "Y-m-d",
               defaultDate: "<?php echo $dateAssignedDefault; ?>"
            });
         </script>

                <!-- date due -->
                <div class="form-group row">
                  <label for="date-due" class="col-form-label font-weight-bold">Due date:</label>
                  <input class="flatpickr flatpickr-input active form-control" type="text" readonly="readonly" id="update-item-form-date-due" name="date-due">
                </div>

                <script>
                  // date due datepicker
                  flatpickr("#update-item-form-date-due", {
                    altInput: true,
                    altFormat: "F j, Y",
                    dateFormat: "Y-m-d",
                    defaultDate: "<?php echo $dateDueDefault; ?>",
                  });
                </script>

                <!-- completed -->
                <div class="form-group row">
                  <label for="completed" class="col-form-label font-weight-bold">Completed:</label>
                  <div class="form-check-inline">
                    <label class="form-check-label" for="radio1">
                      <input type="radio" class="form-check-input" id="update-item-form-completed-no" name="completed" value="n" <?php if ($completed == 'n') echo 'checked'; ?>>No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label" for="radio2">
                      <input type="radio" class="form-check-input" id="update-item-form-completed-yes" name="completed" value="y" <?php if ($completed == 'y') echo 'checked'; ?>>Yes
                    </label>
                  </div>
                </div>

                <!-- notes -->
                <div class="form-group row">
                  <label for="notes" class="col-form-label font-weight-bold">Notes:</label>
                  <textarea class="form-control" rows="5" id="update-item-form-notes" name="notes"><?php echo $notes; ?></textarea>
                </div>

              </form>
            </div>


            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" form="update-form">Save</button>
            </div>


          </div>
        </div>
      </div>
    </div>


    <!-- add item to todo list modal -->
    <div class="modal fade" id="addTodoListModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <!-- header -->
          <div class="modal-header">
            <h5 class="modal-title custom-text-white">Add to list</h5>
            <button type="button" class="close custom-text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <!-- body -->
          <div class="modal-body">

            <?php
                  $sql = 'SELECT * FROM Lists order by title';
                  $results = $pdo->query($sql);
               ?>

            <form class="form">

              <input class="form-control" id="itemToListName" type="text" name="text" value="<?php echo $name; ?>">

              <div class="form-group">
                <label for="list" class="col-form-label font-weight-bold">List:</label>
                <select class="form-control" name="list" id="list">
                  <?php
                     while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
                        $id = $row['id'];
                        $title = $row['title'];

                        echo "<option value=\"$id\">$title</option>";
                     }
                   ?>
                </select>
              </div>
            </form>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="addItemToListButton">Add to list</button>
          </div>
        </div>
      </div>
    </div>


    <script>
      $(document).ready(function() {
        $("#item-added-to-list-alert").hide();
      });

      function deleteItem(itemID) {
        if (confirm("Are you sure you want to delete?")) {
          var link = 'delete-item.php?id=' + itemID + '&classID=<?php echo $classID; ?>';
          window.location.href = link;
        }
      }

      // see add-item-to-todolist.php
      $("#addItemToListButton").click(function() {
        var listID = $("#list").val();
        var text = $("#itemToListName").val();

        var fileName = "add-item-to-todo-list.php?listID=" + listID + "&text=" + text;
        var xhttp = new XMLHttpRequest();

        xhttp.open("GET", fileName, true);
        xhttp.send();

        $('#addTodoListModal').modal('hide');
        $("#item-added-to-list-alert").show();

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
    </script>


  </body>

</html>
