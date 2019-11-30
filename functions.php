<?php

// connects to DB
// returns the PDO connection
function dbConnect() {
  include('db-info.php');

  try {
    // connect to database
    $pdo = new PDO("mysql:host=$host;dbname=$dbName",$user,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;

  } catch(PDOexception $e) {
      return 0;
  }
}

// returns a string to include in the insert class sql stmt
// the string includes the days that the class is held
function getMeetingDaysInsertString($days) {
		$mon = "n";
		$tues = "n";
		$wed = "n";
		$thurs = "n";
		$fri = "n";


		$count = 0;
		while ($count < count($days))
		{
			if ($days[$count] == 'mon')
				$mon = "y";
			else if ($days[$count] == 'tues')
				$tues = "y";
			else if ($days[$count] == 'wed')
				$wed = "y";
			else if ($days[$count] == 'thurs')
				$thurs = "y";
			else if ($days[$count] == 'fri')
				$fri = "y";

			$count++;
		}

		$sql = " '$mon', '$tues', '$wed', '$thurs', '$fri');";

		return $sql;

}

// inserts a class into the DB
function insertClass($post) {
	$dept       = $post['dept'];         // department
	$number     = $post['number'];       // class number
	$section    = $post['section'];      // class section
	$title      = $post['title'];        // class title
   $building   = $post['building'];     // building location
	$room       = $post['room'];         // room number
	$time_start = $post['time-start'];   // time class starts
	$time_end   = $post['time-end'];     // time class ends
	$prof_first = $post['prof-first'];   // professor first name
	$prof_last  = $post['prof-last'];    // professor last name
	$prof_email = $post['prof-email'];   // professor email
	$term       = $post['term'];         // course term

	$sql1 = "INSERT INTO Classes (dept, number, section, title, building, room, time_start, time_end, prof_first, prof_last, prof_email, term, meets_mon, meets_tues, meets_wed, meets_thurs, meets_fri) values ('$dept', $number, $section, '$title', '$building', $room, '$time_start', '$time_end', '$prof_first', '$prof_last', '$prof_email', '$term',";


	if (isset($post['days']))
		$sql2 = getMeetingDaysInsertString($post['days']);
	else
		$sql2 = " 'n', 'n', 'n', 'n', 'n');";

	$sql = $sql1 . $sql2;

	$pdo = dbConnect();
	$n = $pdo->exec($sql);

   $results = $pdo->query('SELECT LAST_INSERT_ID() as "id" FROM Classes');
   $row = $results->fetch(PDO::FETCH_ASSOC);
   return $row['id'];
}

// returns all info about a class from given class id
function getClassInfo($id) {
   $pdo = dbConnect();

   $sql = $pdo->prepare('SELECT `id`, `dept`, `number`, `section`, upper(`title`) as "title", `building`, `room`, `meets_mon`, `meets_tues`, `meets_wed`, `meets_thurs`, `meets_fri`, time_format(`time_start`, "%h:%i%p") as "time_start", time_format(`time_end`, "%h:%i%p") as "time_end", upper(`prof_first`) as "prof_first", upper(`prof_last`) as "prof_last", lower(`prof_email`) as "prof_email", `prof_office_hours`, `term`, time_start as "time_start_original", time_end as "time_end_original", color from Classes WHERE id=:id');

   $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
   $sql->bindParam(':id', $id, PDO::PARAM_INT);
   $sql->execute();

   $result = $sql->fetch(PDO::FETCH_ASSOC);

   return $result;
}

// updates a class' info from given class id and array with updated info
function updateClass($classID, $post) {

   $days = $post['days'];

   // figure out which days meeting
   $mon   = "n";
   $tues  = "n";
   $wed   = "n";
   $thurs = "n";
   $fri   = "n";

   $count = 0;
   while ($count < count($days)) {
      if ($days[$count]      == 'mon')
         $mon = "y";
      else if ($days[$count] == 'tues')
         $tues = "y";
      else if ($days[$count] == 'wed')
         $wed = "y";
      else if ($days[$count] == 'thurs')
         $thurs = "y";
      else if ($days[$count] == 'fri')
         $fri = "y";

      $count++;
   }

   $pdo = dbConnect();


   $sql = $pdo->prepare('UPDATE Classes SET dept=:dept, number=:number, section=:section, title=:title, building=:building, room=:room, meets_mon=:mon, meets_tues=:tues, meets_wed=:wed, meets_thurs=:thurs, meets_fri=:fri, time_start=:time_start, time_end=:time_end, prof_first=:prof_first, prof_last=:prof_last, prof_email=:prof_email, term=:term, color=:color WHERE id=:classID');


   $dept       = filter_var($post['dept'], FILTER_SANITIZE_STRING);
   $number     = filter_var($post['number'], FILTER_SANITIZE_NUMBER_INT);
   $section    = filter_var($post['section'], FILTER_SANITIZE_NUMBER_INT);
   $title      = filter_var($post['title'], FILTER_SANITIZE_STRING);
   $building   = filter_var($post['building'], FILTER_SANITIZE_STRING);
   $room       = filter_var($post['room'], FILTER_SANITIZE_NUMBER_INT);
   $time_start = filter_var($post['time-start'], FILTER_SANITIZE_STRING);
   $time_end   = filter_var($post['time-end'], FILTER_SANITIZE_STRING);
   $prof_first = filter_var($post['prof-first'], FILTER_SANITIZE_STRING);
   $prof_last  = filter_var($post['prof-last'], FILTER_SANITIZE_STRING);
   $prof_email = filter_var($post['prof-email'], FILTER_SANITIZE_EMAIL);
   $term       = filter_var($post['term'], FILTER_SANITIZE_STRING);
   $color      = filter_var($post['color'], FILTER_SANITIZE_STRING);
   $classID    = filter_var($classID, FILTER_SANITIZE_NUMBER_INT);


   $sql->bindParam(':dept', $dept, PDO::PARAM_STR);
   $sql->bindParam(':number', $number, PDO::PARAM_INT);
   $sql->bindParam(':section', $section, PDO::PARAM_INT);
   $sql->bindParam(':title', $title, PDO::PARAM_STR);
   $sql->bindParam(':building', $building, PDO::PARAM_STR);
   $sql->bindParam(':room', $room, PDO::PARAM_INT);
   $sql->bindParam(':time_start', $time_start, PDO::PARAM_STR);
   $sql->bindParam(':time_end', $time_end, PDO::PARAM_STR);
   $sql->bindParam(':prof_first', $prof_first, PDO::PARAM_STR);
   $sql->bindParam(':prof_last', $prof_last, PDO::PARAM_STR);
   $sql->bindParam(':prof_email', $prof_email, PDO::PARAM_STR);
   $sql->bindParam(':term', $term, PDO::PARAM_STR);
   $sql->bindParam(':mon', $mon, PDO::PARAM_STR);
   $sql->bindParam(':tues', $tues, PDO::PARAM_STR);
   $sql->bindParam(':wed', $wed, PDO::PARAM_STR);
   $sql->bindParam(':thurs', $thurs, PDO::PARAM_STR);
   $sql->bindParam(':fri', $fri, PDO::PARAM_STR);
   $sql->bindParam(':color', $color, PDO::PARAM_STR);
   $sql->bindParam(':classID', $classID, PDO::PARAM_INT);

   $sql->execute();

   $pdo = null;
   $sql = null;

}


// prints the class links in the dropdown navbar menu from the given term
function printClassLinks($term) {
   $pdo = dbConnect();

   // display summer classes
   $sql = "SELECT id, dept, number FROM Classes where term=\"$term\"";

   $sql = $pdo->prepare('SELECT id, dept, number FROM Classes where term=:term ORDER BY dept, number');
   $term = filter_var($term, FILTER_SANITIZE_STRING);
   $sql->bindParam(':term', $term, PDO::PARAM_STR);
   $sql->execute();

   while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
     $link = "class.php?cid=" . $row['id'];
     $text = $row['dept'] . ' ' . $row['number'];
     echo "<a class=\"dropdown-item\" href=\"$link\">$text</a>";
   }

   $pdo = null;
   $sql = null;
}

// prints an item card
function printItemCard($itemID, $name, $class, $type, $dateAssigned, $dateDue, $completed, $notes) {

   if ($completed == 'y')
      $selector = 'item-completed';
   else if ($type == 'assignment')
      $selector = 'item-assignment';
   else if ($type == 'exam')
      $selector = 'item-exam';
   else if ($type == 'project')
      $selector = 'item-project';
   else if ($type == 'quiz')
      $selector = 'item-quiz';
   else
      $selector = 'item-other';


   if ($type        == 'assignment') {
      $typeClass = 'badge-assignment';
   } else if ($type == 'exam') {
      $typeClass = 'badge-exam';
   } else if ($type == 'project') {
      $typeClass = 'badge-project';
   } else if ($type == 'quiz') {
      $typeClass = 'badge-quiz';
   } else {
      $typeClass = 'badge-other';
   }

   // decide which completed tab to print
   if ($completed == 'y') {
      $completedBadge = '<ion-icon name="checkmark-circle" class="green"></ion-icon>';
   } else {
      $completedBadge = '<ion-icon name="close-circle" class="red"></ion-icon>';
   }



   echo "<div class=\"card h-100 $selector\">";

      echo "<div class=\"card-header\"><b>$name</b>
         <div class=\"float-right\">
            <a href=\"#\" class=\"custom-text-blue\" data-toggle=\"modal\" data-target=\"#update-item-modal\" onclick=\"getUpdateItemFormInfo($itemID)\">
               <ion-icon name=\"create\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edit item\"></ion-icon>
            </a>
            <a href=\"item.php?id=$itemID\" class=\"custom-text-blue\">
               <ion-icon name=\"open\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"See details\"></ion-icon>
            </a>
         </div>
      </div>";


      echo "<div class=\"card-body custom-bg-white\">
         <table class=\"table table-sm\">
            <tr>
               <th>Date Due</th>
               <td>$dateDue</td>
            </tr>

            <tr>
               <th>Type</th>
               <td>
                  <span class=\"badge $typeClass\">
                     $type
                  </span>
               </td>
            </tr>

            <tr>
               <th>Completed</th>
               <td>$completedBadge</td>
            </tr>

         </table>

      </div>";

      echo '<div class="card-footer custom-bg-white"><div class="float-right">';
         if ($completed == 'n')
            echo "<a href=\"completed-item.php?itemID=$itemID&classID=$class\"><button class=\"btn btn-primary\">Mark completed</button></a>";
         else
            echo "<a href=\"uncomplete-item.php?itemID=$itemID&classID=$class\"><button class=\"btn btn-secondary\">Mark incompleted</button></a>";
      echo '</div></div>';


   echo "</div>";
}

// returns the counts of all types of items including completed items
function getClassItemTypeCounts($classID) {

   $pdo = dbConnect();

   $classID = filter_var($classID, FILTER_SANITIZE_NUMBER_INT);

   $allCount        = "SELECT count(id) from Items where class_id=$classID and completed=\"n\"";
   $assignmentCount = " UNION ALL SELECT count(id) from Items where class_id=$classID and completed=\"n\" and type=\"assignment\"";
   $examCount       = " UNION ALL SELECT count(id) from Items where class_id=$classID and completed=\"n\" and type=\"exam\"";
   $projectCount    = " UNION ALL SELECT count(id) from Items where class_id=$classID and completed=\"n\" and type=\"project\"";
   $quizCount       = " UNION ALL SELECT count(id) from Items where class_id=$classID and completed=\"n\" and type=\"quiz\"";
   $otherCount      = " UNION ALL SELECT count(id) from Items where class_id=$classID and completed=\"n\" and type=\"other\"";
   $completedCount  = " UNION ALL SELECT count(id) from Items where class_id=$classID and completed=\"y\"";

   $sql = $allCount . $assignmentCount . $examCount . $projectCount . $quizCount . $otherCount . $completedCount;
   $results = $pdo->query($sql);

   return $results;
}

// prints a deck of item cards from the given items array
function printItemCards($items) {
   $count = 0;
   $rowCount = 0;

   echo "<div class=\"row\">";
   while ($count < sizeof($items)) {
      $i = $items[$count];
      if ($rowCount == 3) {
         echo "</div><br><div class=\"row\">";
         $rowCount = 0;
      }

      echo '<br><br>';
      echo "<div class=\"col-sm-12 col-md-4\">";
      printItemCard($i['id'], $i['name'], $i['class_id'], $i['type'], $i['date_assigned'], $i['date_due'], $i['completed'], $i['notes']);
      echo '</div>';

      $rowCount++;
      $count++;


   }

   echo '</div>';
}

// returns an array of arrays that is broken down into each itme type
function getItemCategoryArrays($classID) {

   $pdo = dbConnect();

   $sql = $pdo->prepare('SELECT id, class_id, name, type, DATE_FORMAT(date_due, "%a, %b %D, %Y") as "date_due", DATE_FORMAT(date_assigned, "%a, %b %D, %Y") as "date_assigned", completed, notes, date_due as "date_order" FROM Items WHERE class_id=:classID ORDER BY date_order asc');

   $classID = filter_var($classID, FILTER_SANITIZE_NUMBER_INT);
   $sql->bindParam(':classID', $classID, PDO::PARAM_INT);
   $sql->execute();

   $all = array();
   $completed = array();
   $assignments = array();
   $exams = array();
   $projects = array();
   $quizzes = array();
   $other = array();

   while ($item = $sql->fetch(PDO::FETCH_ASSOC))
   {
      // completed item
      if ($item['completed'] == 'y') {
         array_push($completed, $item);
      } else if ($item['type'] == 'assignment') {
         array_push($assignments, $item);
         array_push($all, $item);
      } else if ($item['type'] == 'exam') {
         array_push($exams, $item);
         array_push($all, $item);
      } else if ($item['type'] == 'project') {
         array_push($projects, $item);
         array_push($all, $item);
      } else if ($item['type'] == 'quiz') {
         array_push($quizzes, $item);
         array_push($all, $item);
      } else {
         array_push($other, $item);
         array_push($all, $item);
      }
   }

   $allItems = array();


   $allItems['all'] = $all;
   $allItems['assignments'] = $assignments;
   $allItems['exams'] = $exams;
   $allItems['projects'] = $projects;
   $allItems['quizzes'] = $quizzes;
   $allItems['other'] = $other;
   $allItems['completed'] = $completed;

   return $allItems;

   $pdo = null;
   $sql = null;
}

// prints out a list group of all the todo lists
function printTodoListGroup() {
   $pdo = dbConnect();
   $sql = "SELECT Lists.*, count(ListItems.id) as 'count', SUM(ListItems.completed = 'n') as 'incomplete' FROM Lists LEFT JOIN ListItems on Lists.id=ListItems.list_id group by Lists.id order by last_updated desc";
   $results = $pdo->query($sql);

   while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
      $listID = $row['id'];
      $title = $row['title'];
      $count = $row['count'];
      $incomplete = $row['incomplete'];

      echo "<li><a href=\"todo-lists.php?listID=$listID\" data-listid=\"$listID\">$title";

      echo "<div class=\"float-right\"><span class=\"badge badge-secondary\">$incomplete</span></div></a></li>";

   }
}

// prints a todo list
function printListItems($listID) {

   $pdo = dbConnect();
   // $sql = $pdo->prepare('SELECT title FROM Lists where id=:id');
   $sql = $pdo->prepare('select ListItems.*, Lists.title from ListItems left join Lists on ListItems.list_id=Lists.id where ListItems.list_id = :id group by ListItems.id order by ListItems.id desc');
   $listID = filter_var($listID, FILTER_SANITIZE_NUMBER_INT);
   $sql->bindParam(':id', $listID, PDO::PARAM_INT);
   $sql->execute();
   $data = $sql->fetchAll();

   if (empty($data)) {
      $sql = $pdo->prepare('SELECT title FROM Lists WHERE id=:id');
      $sql->bindParam(':id', $listID, PDO::PARAM_INT);
      $sql->execute();
      $row = $sql->fetch(PDO::FETCH_ASSOC);
      $listTitle = $row['title'];
   } else {
      $listTitle = $data[0]['title'];
   }



   echo "<div class=\"card\" id=\"todo-list-card\" data-listID=\"$listID\">

      <div class=\"card-header\">

      <h4><span id=\"list-title\">$listTitle</span>
         <div class=\"float-right\">
         <div class=\"dropdown dropleft\">
            <ion-icon name=\"more\" data-toggle=\"dropdown\" class=\"hover-blue\"></ion-icon>
            <div class=\"dropdown-menu\">
               <a class=\"dropdown-item\" href=\"#\" data-toggle=\"modal\" data-target=\"#update-todo-list-name-modal\" onclick=\"updateListName()\"><ion-icon name=\"create\"></ion-icon> Edit name</a>
               <div class=\"dropdown-divider\"></div>
               <a class=\"dropdown-item\" href=\"#\" onclick=\"deleteTodoList($listID)\"><ion-icon name=\"trash\"></ion-icon> Delete list</a>
               <div class=\"dropdown-divider\"></div>
                  <a class=\"dropdown-item\" href=\"#\" onclick=\"completeAllListItems()\"><ion-icon name=\"checkmark\"></ion-icon> Mark all complete</a>
                  <a class=\"dropdown-item\" href=\"#\" onclick=\"incompleteAllListItems()\"><ion-icon name=\"close\"></ion-icon> Mark all incomplete</a>
               <div class=\"dropdown-divider\"></div>
                  <a class=\"dropdown-item\" href=\"#\" onclick=\"deleteCompletedListItems()\"><ion-icon name=\"git-network\"></ion-icon> Delete completed items</a>
            </div>
         </div>
         </div>
      </h4>
      </div>
      </div>";


   // card body table
   echo
   "<div class=\"card-body custom-bg-white\" id=\"todo-list-card-body\">
      <div class=\"input-group\" id=\"add-item\">
         <input type=\"text\" placeholder=\"Add a todo\" aria-label=\"Todo item\" aria-describedby=\"add-item-button\" id=\"add-item-text\" class=\"form-control\" autofocus>
         <div class=\"input-group-append\">
            <button class=\"btn btn-primary\" type=\"button\" id=\"add-item-button\" onclick=\"addTodoItem()\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Add item\">
               <ion-icon name=\"add-circle\"></ion-icon>
            </button>
         </div>
      </div>
      <div class=\"section-border-line\"></div>
      <table class=\"table table-custom\" id=\"todo-list-table\">";

      $count = 0;

      while ($count < sizeof($data)) {

         $row = $data[$count];

         $completed = $row['completed'];
         $text = $row['text'];
         $id = $row['id'];

         echo "<tr data-itemID=\"$id\">";

         if ($completed == 'y') {
            echo "<td><div class=\"checkbox tiny\">
      			<div class=\"checkbox-container\">
      				<input type=\"checkbox\" onclick=\"updateComplete(this)\" checked/>
      				<div class=\"checkbox-checkmark\"></div>
      			</div>
      		</div></td>";

            //echo "<td><input type=\"checkbox\" class=\"todo-item-checkbox\" onclick=\"updateComplete(this)\" checked></td>";
            echo "<td class=\"todo-item-text text-line\">$text</td>";
         } else {
            echo "<td><div class=\"checkbox tiny\">
      			<div class=\"checkbox-container\">
      				<input type=\"checkbox\" onclick=\"updateComplete(this)\"/>
      				<div class=\"checkbox-checkmark\"></div>
      			</div>
      		</div></td>";
            echo "<td class=\"todo-item-text\">$text</td>";
         }

         echo "<td><a onclick=\"deleteTodoListItem(this)\" class=\"todo-item-close\"> <ion-icon name=\"close\"></ion-icon></td>";
         echo '</tr>';

         $count++;

      }







         echo '</table></div>';

   echo '</div>';

   $pdo = null;
   $sql = null;



}

// sets a todo list item as complete
function updateTodoListItemComplete($id, $completed) {
   $pdo = dbConnect();
   $sql = $pdo->prepare('UPDATE ListItems SET completed=:completed WHERE id=:id');

   // filter variables
   $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
   $completed = filter_var($completed, FILTER_SANITIZE_STRING);

   // bind the parameters
   $sql->bindParam(':id', $id, PDO::PARAM_INT);
   $sql->bindParam(':completed', $completed, PDO::PARAM_STR);

   // execute sql statement
   $sql->execute();

   // close the db connections
   $pdo = null;
   $sql = null;

}

// deletes a todo list item
function deleteTodoListItem($id) {

   $pdo = dbConnect();                                         // connect to db
   $sql = $pdo->prepare('DELETE FROM ListItems WHERE id=:id'); // prepare sql statement
   $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);          // sanitize input
   $sql->bindParam(':id', $id, PDO::PARAM_INT);                // bind parameters
   $sql->execute();                                            // execute sql statement
   $pdo = null;
   $sql = null;

}

//  updates list to most current updated time
function updateTodoListLastUpdated($id) {

   $pdo = dbConnect();
   $sql = $pdo->prepare('UPDATE Lists SET last_updated=CURRENT_TIMESTAMP() WHERE id=:id');
   $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);          // sanitize input
   $sql->bindParam(':id', $id, PDO::PARAM_INT);                // bind parameters
   $sql->execute();                                            // execute sql statement
   $pdo = null;
   $sql = null;

}

// inserts a todo list item
function insertTodoList($name) {

   $pdo = dbConnect();
   $sql = $pdo->prepare('INSERT INTO Lists (title) VALUES (:name)');
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $sql->bindParam(':name', $name, PDO::PARAM_STR);
   $sql->execute();

   $row = $pdo->query("SELECT id from Lists order by id desc limit 1")->fetch(PDO::FETCH_ASSOC);
   return $row['id'];

   $row = null;
   $sql = null;
   $pdo = null;

}

// prints an alert
function printAlert($message) {
   echo
   "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
      <strong>$message</strong>
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
      <span aria-hidden=\"true\">&times;</span>
      </button>
   </div>";
}

// prints all the set names into the side navbar on the sets page
function printSetSidebar() {

   $pdo = dbConnect();
   $sql = $pdo->prepare('SELECT Sets.id, Sets.name, COUNT(Terms.id) as "count" FROM Sets LEFT JOIN Terms on Sets.id=Terms.set_id GROUP BY Sets.id ORDER BY name');
   $sql->execute();

   while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
      $name = $row['name'];
      $id = $row['id'];
      $count = $row['count'];

      echo "<li><a href=\"sets.php?setID=$id\" data-setid=\"$id\">$name";
      echo "<div class=\"float-right\"><span class=\"badge badge-secondary\">$count</span></div></a></li>";
   }

   $sql = null;
}

// prints all the set terms given the set id
function printSetTerms($setID) {

    $setName = getSetName($setID);

   // initialize sql query
   $pdo = dbConnect();
   $sql = $pdo->prepare('SELECT * FROM Terms WHERE set_id = :setID ORDER BY id desc');
   $id = filter_var($setID, FILTER_SANITIZE_NUMBER_INT);          // sanitize input
   $sql->bindParam(':setID', $id, PDO::PARAM_INT);                // bind parameters
   $sql->execute();

   echo "<div class=\"card\" id=\"set-card\" data-setid=\"$setID\" data-setname=\"$setName\">";
  	echo "<div class=\"card-header\">";
   echo "<h4>$setName";

    // dropdown menu
    echo
    "<div class=\"float-right\">
    <div class=\"dropdown dropleft\">
       <ion-icon name=\"more\" data-toggle=\"dropdown\" class=\"hover-blue\"></ion-icon>
       <div class=\"dropdown-menu\">
          <a class=\"dropdown-item\" href=\"exam.php?setID=$setID\"><ion-icon name=\"copy\"></ion-icon> Exam</a>
          <div class=\"dropdown-divider\"></div>
          <a class=\"dropdown-item\" href=\"#\" data-toggle=\"modal\" data-target=\"#update-set-name-modal\" onclick=\"updateSetName()\"><ion-icon name=\"create\"></ion-icon> Edit name</a>
          <div class=\"dropdown-divider\"></div>
          <a class=\"dropdown-item\" href=\"#\" onclick=\"deleteSet($setID)\"><ion-icon name=\"trash\"></ion-icon> Delete set</a>
       </div>
    </div>
    </div>";

    echo '</h4></div>';

  	echo '<div class="card-body no-padding">';


   // print table
   echo
   "<table class=\"table\" id=\"set-table\">";


   echo "<thead>
       <tr>
           <th class=\"sets-th-1\"><input type=\"text\" id=\"new-term-input\" class=\"form-control\" placeholder=\"Term\" autofocus></th>
           <th><textarea name=\"name\" rows=\"1\" class=\"form-control\" placeholder=\"Definition\" id=\"new-definition-input\"></textarea></th>
           <th class=\"sets-th-3\"><button type=\"button\" class=\"btn btn-primary\" id=\"new-term-button\" onclick=\"addTerm()\">Add</button></th>
       </tr>
   </thead>";

     echo "<tbody>";

      while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
         $term = $row['term'];
         $definition = $row['definition'];
         $termID = $row['id'];

         echo "<tr>
                <td>$term</td>
                <td>$definition</td>
                <td><button type=\"button\" class=\"btn btn-secondary edit-term-btn\" data-termid=\"$termID\" data-term=\"$term\" data-definition=\"$definition\">Edit</button></td>
              </tr>";
      }


      echo "</tbody>
   </table>";

   echo '</div> </div>';


}

// updates a term and definition given the term id
function updateTerm($termID, $term, $definition) {

   // connect to database
   $pdo = dbConnect();

   // prepare the sql statement
   $sql = $pdo->prepare('UPDATE Terms SET term=:term, definition=:definition WHERE id=:termID');

   // filter, sanitize, and bind the term id
   $term = filter_var($term, FILTER_SANITIZE_STRING);
   $sql->bindParam(':term', $term, PDO::PARAM_STR);

   // filter, sanitize, and bind the term
   $definition = filter_var($definition, FILTER_SANITIZE_STRING);
   $sql->bindParam(':definition', $definition, PDO::PARAM_STR);

   // filter, sanitize, and bind the definition
   $termID = filter_var($termID, FILTER_SANITIZE_NUMBER_INT);
   $sql->bindParam(':termID', $termID, PDO::PARAM_INT);

   // execute the sql statement
   $sql->execute();

   // close sql connections
   $sql = null;
   $pdo = null;
}

// returns the set name from a given set id
function getSetName($setID) {

    // connect to database
    $pdo = dbConnect();

    // prepare the sql statement
    $sql = $pdo->prepare('SELECT Sets.name FROM Sets WHERE id=:setID LIMIT 1');

    // filter and bind the setID
    $setID = filter_var($setID, FILTER_SANITIZE_NUMBER_INT);
    $sql->bindParam(':setID', $setID, PDO::PARAM_INT);

    // execute and fetch results
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);

    // close connections
    $pdo = null;
    $sql = null;

    // return the set name
    return $result['name'];

}

// prints out all the terms in a set in a option and select form style
function printTermsExamSelect($setID) {

   // connect to database
   $pdo = dbConnect();

   // prepare sql statement
   $sql = $pdo->prepare('SELECT Terms.id, Terms.term FROM Terms WHERE Terms.set_id=:setID ORDER BY Terms.term asc');

   // filter and bind the set id
   $setID = filter_var($setID, FILTER_SANITIZE_NUMBER_INT);
   $sql->bindParam(':setID', $setID, PDO::PARAM_INT);

   // execute the sql statement
   $sql->execute();

   // initial select tag
   echo "<select class=\"js-example-basic-single form-control\">";

   // print out all the term
   while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
      $term = $row['term'];   // term
      $id = $row['id'];       // term id

      // print the output
      echo "<option value=\"$id\">$term</option>";
   }

   echo '</select>';   // endding select tag

   // close connections
   $pdo = null;
   $sql = null;
}

?>
