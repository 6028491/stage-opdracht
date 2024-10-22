<?php
require 'backend/session.php';
require 'backend/classes/user.php';
if(isset($_POST['submit'])){
    if(empty($_POST['newPassword'])){
        $newPassword = false;
    } else {
        $newPassword = $_POST['newPassword'];
    }
    $user = new User();

    $try = $user->update($_SESSION['UID'], $_POST['username'], $_POST['password'], $newPassword, $_POST['email']);
    if($try){
        header('Location: logout.php');
    }else {
        header('Location: account.php');
    }

}