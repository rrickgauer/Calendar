<?php

include_once('functions.php');
deleteTodoListItem($_GET['itemID']);
updateTodoListLastUpdated($_GET['listID']);
printListItems($_GET['listID']);

?>

<script>
   $("#add-item-text").focus();
</script>
