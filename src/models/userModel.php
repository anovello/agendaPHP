<?php

include_once('connection.php');

class UserModel extends Connection{

    public $id;
    public $name;
    public $email;
    public $password;

    public function login()
    {
        $this->connect();
        $sql = "SELECT * FROM user WHERE email = '".$this->email."' AND password = '".md5($this->password)."'";
        $result = $this->conn->query($sql);

        if ( $result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) {
                $this->id = $row['id'];
                $this->name = $row['name'];
                $this->email = $row['email'];
            }

            $this->conn->close();
            return $this->toObject();
        } else {
            $this->conn->close();
            return false;
        } 
    }
    
    public function create()
    {
        $this->connect();
        $sql = "INSERT INTO user (name, email, password) VALUES ('".$this->name."', '".$this->email."', '".md5($this->password)."' )";

        if ($this->conn->query($sql) === TRUE) 
        {
            $this->id = $this->conn->insert_id;
            $this->conn->close();
            return true;
        } else {
            $this->conn->close();
            return false;
        }
    }

    public function update()
    {
        $this->connect();
        $sql = "UPDATE user SET name = '".$this->name."', password = '".md5($this->password)."' WHERE id = ".$this->id;

        if ($this->conn->query($sql) === TRUE) 
        {
            $this->conn->close();
            return true;
        } else {
            $this->conn->close();
            return false;
        }
    }

    public function getEmail($email)
    {
        $this->connect();
        $sql = "SELECT * FROM user where email = '".$email."'";
        $result = $this->conn->query($sql);
        $this->conn->close();

        if ($result->num_rows > 0)
        {
            return true;
        } else {
            return false;
        }
    }

    public function get()
    {
        $this->connect();
        $sql = "SELECT * FROM user where id = '".$this->id."'";
        $result = $this->conn->query($sql);
        $this->conn->close();

        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc()) {
                
                $this->id = $row['id'];
                $this->name = $row['name'];
                $this->email = $row['email'];
            }
        } else {
            return false;
        }
    }

    public function toObject()
    {
        return (Object)[
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email
        ];
    }
}