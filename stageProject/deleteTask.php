<?php

require 'backend/session.php';
require 'backend/classes/tasks.php';

$tasks = new Tasks();

$tasks->delete($_GET['id']);