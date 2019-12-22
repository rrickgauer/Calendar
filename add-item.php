<?php session_start(); ?>
<?php include('functions.php'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <?php include('header.php'); ?>
      <title>Add Item</title>
   </head>
   <body class="bottom-page-space">
      <?php include('navbar.php'); ?>


      <div class="container-fluid">


         <h1>Add item</h1>

         <form class="form" method="post" action="insert-item.php">

            <!-- name -->
            <div class="form-group">
          <label for="name" class="col-form-label font-weight-bold">Name:</label>
               <input type="text" name="name" id="name" class="form-control" required autofocus>
        </div>

            <div class="form-row">

               <!-- class -->
               <div class="form-group col-sm-6">
              <label for="class" class="col-form-label font-weight-bold">Class:</label>
            <select class="form-control" name="class" id="class">
                     <?php include('classes-select.php'); ?>
            </select>
            </div>


               <!-- assignment type -->
               <div class="form-group col-sm-6">
              <label for="type" class="col-form-label font-weight-bold">Type:</label>
                  <select class="form-control" name="type">
                     <option value="assignment">Assignment</option>
                     <option value="exam">Exam</option>
                     <option value="project">Project</option>
                     <option value="quiz">Quiz</option>
                     <option value="other">Other</option>
                  </select>
            </div>
            </div>

            <div class="form-row">

               <!-- date assigned -->
               <div class="form-group col-sm-6">
              <label for="date-assigned" class="col-form-label font-weight-bold">Date assigned:</label>
                <input class="flatpickr flatpickr-input active form-control" type="text" readonly="readonly" id="date-assigned" name="date-assigned" required>
            </div>

               <!-- date due -->
               <div class="form-group col-sm-6">
              <label for="date-due" class="col-form-label font-weight-bold">Due date:</label>
                  <input class="flatpickr flatpickr-input active form-control" type="text" readonly="readonly" id="date-due" name="date-due" required>
            </div>
            </div>

            <!-- completed -->
            <div class="form-group">
          <label for="completed" class="col-form-label font-weight-bold">Completed:</label>
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

             <!-- notes -->
             <div class="form-group">
          <label for="notes" class="col-form-label font-weight-bold">Notes:</label>
               <textarea class="form-control" rows="5" id="notes" name="notes"></textarea>
        </div>

            <div class="float-right">
               <input type="submit" value="Submit" class="btn btn-primary" id="submit">
            </div>
         </form>



      </div>

      

      <script>

         // date assigned datepicker
         flatpickr("#date-assigned", {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            defaultDate: "today"
         });

         // date due datepicker
         flatpickr("#date-due", {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
         });

         $(document).ready(function() {
            $("#add-item-navbar-link").addClass("custom-bg-grey");
         });




      </script>

   </body>
</html>
