<?php
require 'backend/session.php';
require 'backend/classes/tasks.php';

$task = new Tasks();
$task->seed(intval($_GET['amount']));

header("Location: index.php");