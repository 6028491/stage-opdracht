<?php
require 'backend/session.php'; 
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
        <a href="tasks.php">tasks</a><br><br>
        <a href="addTask.php">add tasks</a><br><br>
        <a href="account.php">settings</a><br><br>
        <a href="logout.php">goofy logout button</a><br><br>

        <br><br>
        <form action="seedDB.php">
            <label for="amount">seed database</label>
            <input type="int" name="amount" placeholder="amount">
            <input type="submit" name="" id="">
        </form>
    </main>
</body>

</html>