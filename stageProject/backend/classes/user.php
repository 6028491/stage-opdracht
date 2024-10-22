<?php
require 'conn.php';

class User extends Database{
    public $username;
    public $email;
    private $password;

    public function __construct() {
         parent::__construct();
    }

    private function verify($username, $password){
        $stmt = $this->conn->prepare("SELECT username, password FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        $data = $stmt->fetchAll();
        if(!$data){
            return false;
        }
        if(password_verify($password, $data[0]['password'])){
            return true;
        } else {
            return false;
        }
    }

    public function create($username, $password, $email){
        try{
            $stmt = $this->conn->prepare("INSERT INTO users(username, password, email) VALUES (:username, :password, :email)");
            $stmt->bindParam(":username", $username);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bindParam(":password", $hashedPassword);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            return true;
        } catch(PDOException $e){
            return false;
        }
        
    }


    public function login($username, $password){
        if(!$this->verify($username, $password)){
            return false;
        } else {
            $stmt = $this->conn->prepare("SELECT id FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $data = $stmt->fetch();
            session_start();
            $_SESSION['loggedIn'] = true;
            $_SESSION['UID'] = $data['id'];
            header('Location: index.php');
        }
    }

    public function get($id){
        $stmt = $this->conn->prepare("SELECT username, password, email FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $data = $stmt->fetchAll();
        $data['password'] = '';
        return $data;
    }
    public function update($id, $newUsername, $password, $newPassword, $newEmail){
        $stmt = $this->conn->prepare("SELECT username FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $username = $stmt->fetch()["username"];
        if(!$this->verify($username, $password)){
            return false;
        }

        if($newPassword){
            $stmt = $this->conn->prepare("UPDATE users SET username = :newUsername, email = :newEmail, password = :newPassword WHERE id = :id");
            $stmt->bindParam(':newUsername', $newUsername);
            $stmt->bindParam(':newEmail', $newEmail);
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt->bindParam(":password", $hashedPassword);
            $stmt->bindValue(':id', $id);
        } else {
            $stmt = $this->conn->prepare("UPDATE users SET username = :newUsername, email = :newEmail WHERE id = :id");
            $stmt->bindParam(':newUsername', $newUsername);
            $stmt->bindParam(':newEmail', $newEmail);
            $stmt->bindValue(':id', $id);
        }
    
        $stmt->execute();
        return true;
    }

    public function delete($username, $email ,$password){
        if(!$this->verify($username, $password)){
            return false;
        }
        
        $stmt = $this->conn->prepare("DELETE FROM users WHERE username = :username AND email = :email");
        $stmt->bindParam(":username",$username);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
    }
    
}
