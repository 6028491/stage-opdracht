<?php
require_once "backend/classes/user.php";

// tiny bit of fancy logic ig
// session_start();

// if(isset($_SESSION['loggedIn'])){
//     if($_SESSION['loggedIn']){
//         header("Location: index.php");
//     }
// }


if (isset($_POST['submit'])) {

    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $user = new User();
        $user->login($_POST['username'], $_POST['password']);
    }

}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post">
        <input type="text" placeholder="username" name="username">
        <input type="password" placeholder="password" name="password">
        <input type="submit" name="submit">
    </form>


    <br><br>
    <a href="register.php">register instead</a>
</body>

</html>