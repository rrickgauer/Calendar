<?php
session_start();

if (!isset($_POST['dept']) ||
  !isset($_POST['number']) ||
  !isset($_POST['section']) ||
  !isset($_POST['title']) ||
  !isset($_POST['building']) ||
  !isset($_POST['room']) ||
  !isset($_POST['time-start']) ||
  !isset($_POST['time-end']) ||
  !isset($_POST['prof-first']) ||
  !isset($_POST['prof-last']) ||
  !isset($_POST['prof-email']) ||
  !isset($_POST['term']))
{
  header('Location: add-class.php');
  exit;
}

include_once('functions.php');
$newID = insertClass($_POST);

$location = "Location: class.php?cid=$newID";
header($location);
exit;

?>
