<?php
if (isset($_POST['submit'])) {
    require 'backend/classes/user.php';
    $user = new User();
    $created = $user->create($_POST['username'], $_POST['password'], $_POST['email']);
    if($created){
        $user->login($_POST['username'], $_POST['password']);
    } else{
        echo 'An erro has occured, try again';
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
    <form method="POST">
        <label for="username">username</label>
        <input type="text" name="username" placeholder="username"><br>
        <label for="password">password</label>
        <input type="password" name="password" placeholder="password"><br>
        <label for="email">email</label>
        <input type="email" name="email" placeholder="email"><br>
        <input type="submit" name="submit">
    </form>

    <a href="login.php">log in instead</a>
</body>

</html>