<?php

include_once('functions.php');



$pdo = dbConnect();

$sql = $pdo->prepare('SELECT * FROM Items WHERE id=:id');

$id = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_NUMBER_INT);
$sql->bindParam('id', $id, PDO::PARAM_INT);
$sql->execute();


$item = $sql->fetch(PDO::FETCH_ASSOC);

$classID = $item['class_id'];
$id = $item['id'];
$name = $item['name'];
$type = $item['type'];
$dateAssigned = $item['date_assigned'];
$dateDue = $item['date_due'];
$completed = $item['completed'];
$notes = $item['notes'];

$pdo = null;
$sql = null;

?>

<div class="modal-header card-header">
   <h4 class="modal-title" id="update-item-modal-heading">Update Item</h4>
   <button type="button" class="close custom-text-white" data-dismiss="modal">&times;</button>
</div>


<div class="modal-body custom-bg-white" id="update-item-modal-body">

   <?php $actionLink = 'edit-item.php?id=' . $id . '&classID=' . $classID; ?>

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
            <option <?php if ($type == 'exam') {echo 'selected';} ?>  value="exam">Exam</option>
            <option <?php if ($type == 'project') {echo 'selected';} ?>  value="project">Project</option>
            <option <?php if ($type == 'quiz') {echo 'selected';} ?>  value="quiz">Quiz</option>
            <option <?php if ($type == 'other') {echo 'selected';} ?>  value="other">Other</option>
         </select>
      </div>

      <!-- date assigned -->
      <div class="form-group row">
         <label for="date-assigned" class="col-form-label font-weight-bold">Date assigned:</label>
         <input class="flatpickr flatpickr-input active form-control" type="text" readonly="readonly" id="update-item-form-date-assigned" name="date-assigned">
      </div>

      <!-- date due -->
      <div class="form-group row">
         <label for="date-due" class="col-form-label font-weight-bold">Due date:</label>
         <input class="flatpickr flatpickr-input active form-control" type="text" readonly="readonly" id="update-item-form-date-due" name="date-due">
      </div>

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
               <input type="radio" class="form-check-input" id="update-item-form-completed-yes" name="completed" value="y"  <?php if ($completed == 'y') echo 'checked'; ?>>Yes
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


<div class="modal-footer custom-bg-white" id="update-item-modal-footer">

   <button type="submit" form="update-form" class="btn btn-primary">Save</button>
</div>

<script>


   // date assigned datepicker
   flatpickr("#update-item-form-date-assigned", {
      altInput: true,
      altFormat: "F j, Y",
      dateFormat: "Y-m-d",
      defaultDate: "<?php echo $dateAssigned; ?>",
   });

   // date due datepicker
   flatpickr("#update-item-form-date-due", {
      altInput: true,
      altFormat: "F j, Y",
      dateFormat: "Y-m-d",
      defaultDate: "<?php echo $dateDue; ?>",
   });

</script>
