<?php
require 'backend/session.php';

session_destroy();

header("location: login.php");