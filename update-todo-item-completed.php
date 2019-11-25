<?php

include_once('functions.php');
updateTodoListItemComplete($_GET['itemID'], $_GET['completed']);
updateTodoListLastUpdated($_GET['listID']);
printListItems($_GET['listID']);

?>

<script>
   $("#add-item-text").focus();
</script>
