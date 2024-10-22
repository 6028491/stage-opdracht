<?php
require 'backend/session.php';
require 'backend/classes/tasks.php';

$tasks = new Tasks();
if (isset($_GET['pageNumber'])) {
    $data = $tasks->get($_GET['pageNumber']);

    if (($_GET['pageNumber'] - 1) < 0) {
        $previous = 0;
    } else {
        $previous = $_GET['pageNumber'] - 1;
    }
    $next = $_GET['pageNumber'] + 1;
} else {
    $data = $tasks->get();
    $previous = 0;
    $next = 1;
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
    <?php
    foreach ($data as $task) {
        ?>

        <section>
            <article>
                <p><?php echo $task['title'] ?></p>
                <p><?php echo $task['description'] ?></p>

                <?php
                if ($task['status'] == 0) {
                    $status = 'done';
                } elseif ($task['status'] == 1) {
                    $status = 'doing';
                } else {
                    $status = 'to do';
                }
                ?>
                <b><?php echo $status ?></b><br>
                <a href="changeStatus.php?status=0&id=<?php echo $task['id']?>">done</a>
                <a href="changeStatus.php?status=1&id=<?php echo $task['id']?>">doing</a>
                <a href="changeStatus.php?status=2&id=<?php echo $task['id']?>">to do</a>
                <div>
                    <a href="deleteTask.php?id=<?php echo $task['id'] ?>">delete</a>
                </div>
            </article>

        </section>




        <?php
    }
    ?>

    <a href="?pageNumber=<?php echo $previous ?>">previous page</a>
    <a href="?pageNumber=<?php echo $next ?>">next page</a>

    <br><br>
    <a href="index.php">return</a>
</body>

</html>