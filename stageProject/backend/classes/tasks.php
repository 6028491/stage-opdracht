<?php

require 'conn.php';

class Tasks extends Database{
    
    public function __construct() {
        parent::__construct();
    }

    public function get($page = 0){
        $offset = 10 * $page;
        $stmt = $this->conn->prepare("SELECT id, title, description, status, priority FROM tasks ORDER BY priority asc LIMIT 10 OFFSET :pageNumber");
        $stmt->bindValue(':pageNumber', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;
    }

    public function create($name, $description, $status = 3, $priority = 0){
        $stmt = $this->conn->prepare("INSERT INTO tasks(title, description, status, priority) VALUES (:title, :description, :status, :priority)");
        $stmt->bindParam(':title', $name);
        $stmt->bindParam(':description',$description);
        $stmt->bindValue(':status', (int)$status, PDO::PARAM_INT);
        $stmt->bindValue(':priority', (int)$priority, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function update($id, $name, $description, $status, $priority){
        $stmt = $this->conn->prepare("UPDATE tasks SET title = :title, description = :description, status = :status, priority = :priority WHERE id = :id");
        $stmt->bindParam(":title", $name);
        $stmt->bindParam(':description',$description);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':priority',$priority);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function updateStatus($id, $status){
        $stmt = $this->conn->prepare("UPDATE tasks SET status = :status WHERE id = :id");
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function delete($id){
        $stmt = $this->conn->prepare("DELETE FROM tasks WHERE id = :id");
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        header("Location: tasks.php");
    }

    public function seed($amount = 10){
        for($i = 1; $i <= $amount; $i++){
            $stmt = $this->conn->prepare("INSERT INTO tasks(title, description, status, priority) VALUES ('$i', '$i', 3, 5)");
            $stmt->execute();
        }
    }
}
