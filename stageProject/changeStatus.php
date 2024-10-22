<?php

require 'backend/session.php';
require 'backend/classes/tasks.php';

$tasks = new Tasks();

$tasks->updateStatus($_GET['id'], $_GET['status']);
header("Location: tasks.php");