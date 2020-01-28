<?php

include_once('functions.php');
$itemID = $_GET['itemID'];

// check if item is completed
if (isItemCompleted($itemID)) {
  setItemIncomplete($itemID);
} else {
  setItemComplete($itemID);
}

include('get-calendar-list.php');
?>
