<?php



$setID = $_GET['setID'];
$id = $_GET['termID'];



echo "<p><b>Definition:</b> $definition</p>";
echo "<p><b>ID:</b> $id</p>";


include_once('functions.php');

$pdo = dbConnect();

$sql = "SELECT Terms.term, \"c\" as \"value\" FROM Terms where Terms.id = $id union (select Terms.term, \"f\" from Terms where Terms.id!=$id and Terms.set_id=$setID order by rand() limit 3) order by rand()";

$result = $pdo->query($sql);

$answer1 = $result->fetch(PDO::FETCH_ASSOC);
$answer2 = $result->fetch(PDO::FETCH_ASSOC);
$answer3 = $result->fetch(PDO::FETCH_ASSOC);
$answer4 = $result->fetch(PDO::FETCH_ASSOC);



?>





<b>Select term:</b>
<div class="form-check">
   <input class="form-check-input" type="radio" name="exampleRadios" id="radio1" value="<?php echo $answer1['value']; ?>">
   <label class="form-check-label" for="radio1">
      <?php echo $answer1['term']; ?>
   </label>
</div>

<div class="form-check">
   <input class="form-check-input" type="radio" name="exampleRadios" id="radio2" value="<?php echo $answer2['value']; ?>">
   <label class="form-check-label" for="radio2">
      <?php echo $answer2['term']; ?>
   </label>
</div>

<div class="form-check">
   <input class="form-check-input" type="radio" name="exampleRadios" id="radio3" value="<?php echo $answer3['value']; ?>">
   <label class="form-check-label" for="radio3">
      <?php echo $answer3['term']; ?>
   </label>
</div>

<div class="form-check">
   <input class="form-check-input" type="radio" name="exampleRadios" id="radio4" value="<?php echo $answer4['value']; ?>">
   <label class="form-check-label" for="radio4">
      <?php echo $answer4['term']; ?>
   </label>
</div>
