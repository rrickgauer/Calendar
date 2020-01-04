<?php include_once('functions.php'); ?>
<section id="top-navbar">
  <div class="container-fluid">
    <nav class="navbar navbar-toggleable-sm navbar-expand-sm">
      <!-- <div class="navbar-brand"></div> -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <ion-icon name="menu" class="custom-text-white"></ion-icon>
      </button>


      <!-- Links -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="nav navbar-nav">
          <li class="nav-item nav-link-hover" id="home-navbar-link"><a class="nav-link " href="home.php">Home</a></li>

          <li class="nav-item dropdown" id="class-navbar-link">
            <a class="nav-link dropdown-toggle nav-link-hover" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Classes</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <h6 class="dropdown-header">Summer 2019</h6>
              <?php printClassLinks("sum19"); ?>
              <div class="dropdown-divider"></div>
              <h6 class="dropdown-header">Fall 2019</h6>
              <?php printClassLinks("f19"); ?>
              <div class="dropdown-divider"></div>
              <h6 class="dropdown-header">Spring 2020</h6>
              <?php printClassLinks("s20"); ?>
            </div>
          </li>

          <li class="nav-item nav-link-hover" id="add-item-navbar-link"><a class="nav-link " href="add-item.php">Add Item</a></li>
          <li class="nav-item nav-link-hover" id="add-class-navbar-link"><a class="nav-link nav-link-hover" href="add-class.php">Add Class</a></li>
          <li class="nav-item nav-link-hover dropdown" id="todo-navbar-link"><a href="todo-lists.php" class="nav-link nav-link-hover">Todo's</a></li>
          <li class="nav-item nav-link-hover" id="calendar-navbar-link"><a class="nav-link nav-link-hover" href="calendar-list.php">Calendar</a></li>
          <!-- <li class="nav-item nav-link-hover" id="sets-navbar-link"><a class="nav-link nav-link-hover" href="sets.php">Study Sets</a></li> -->
          <li class="nav-item nav-link-hover" id="groceries-navbar-link"><a class="nav-link nav-link-hover" href="groceries.php">Groceries</a></li>
          <!-- <li class="nav-item nav-link-hover" id="test-navbar-link"><a class="nav-link nav-link-hover" href="test.php">Test Page</a></li> -->

        </ul>
      </div>
    </nav>
  </div>
</section>
