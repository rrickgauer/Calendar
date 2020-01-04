<?php

include_once('functions.php');

$itemTypeCounts = getViewItemTypeCounts();
$itemTypeCounts = $itemTypeCounts->fetch(PDO::FETCH_ASSOC);
$response = json_encode($itemTypeCounts);
echo $response;
?>
