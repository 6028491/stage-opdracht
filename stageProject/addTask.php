<?php
require 'backend/session.php';
require 'backend/classes/tasks.php';
if(isset($_POST['submit'])){
    $task = new Tasks();
    $task->create($_POST['name'], $_POST['description'],3, $_POST['priority']);
    // header("Location: addTask.php");
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
        <input type="text" name="name" placeholder="name"> <br>
        <input type="text" name="description" placeholder="description"><br>
        <select name="priority" id="">
            <option value="0">highest</option>
            <option value="1">high</option>
            <option value="2">medium</option>
            <option value="3">low</option>
            <option value="4">neglegible</option>    
        </select><br>
        <input type="submit" name="submit">
    </form>
    <br><br>
    <a href="index.php">return</a>
</body>

</html>