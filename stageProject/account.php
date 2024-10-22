<?php
require 'backend/session.php';
require 'backend/classes/user.php';

$user = new User();
$data = $user->get($_SESSION['UID'])[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <form action="editAccount.php" method="post">
            <label for="username">username:</label>
            <input type="text" name="username" placeholder="username" value="<?php echo $data['username']?>"><br>
            <label for="username">email:</label>
            <input type="email" name="email" value="<?php echo $data['email']?>"><br>
            <label for="username">password:</label>
            <input type="password" name="password" id="password"><br>
            <label for="username">new password:</label>
            <input type="password" name="newPassword" id="newPassword"><br>
            <input type="submit" name="submit">
        </form>
        <br><br>
        <a href="index.php">return</a>
    </main>
</body>
</html>