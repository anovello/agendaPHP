<?php

include_once('connection.php');

class ContactModel extends Connection{

    public $id;
    public $name;
    public $email;
    public $phone;
    public $user_id;

    public function get()
    {
        $this->connect();   
        $sql = "SELECT * FROM contact WHERE user_id = '".$this->user_id."' AND id = ".$this->id;
        $result = $this->conn->query($sql);
        
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc()) {
                $this->id = $row['id'];
                $this->name = $row['name'];
                $this->email = $row['email'];
                $this->phone = $row['phone'];
                $this->user_id = $row['user_id'];
            }

            $this->conn->close();
            return $this->toObject();
        } else {
            $this->conn->close();
            return false;
        }
    }

    public function getAll($page, $search)
    {
        $perPage = 10;

        $data = [
            'contacts' => [],
            'total' => 0,
            'total_pages' => 0
        ];
        $this->connect();
        
        $sql = "SELECT * FROM contact WHERE user_id = '".$this->user_id."' ";
        
        if ($search !== '')
        {
            $sql .= "AND ( name LIKE '%".$search."%' OR  email LIKE '%".$search."%' OR phone LIKE '%".$search."%') ";
        }

        $res = $this->conn->query($sql);
        $data['total'] = $res->num_rows;
        $data['total_pages'] = ceil($res->num_rows/$perPage);
        $data['next_page'] = $data['total_pages'] > intval($page) ? intval($page) + 1: intval($page);
        $data['page'] = intval($page);
        $sql .= "order by id asc LIMIT ".((intval($page) - 1) * $perPage) .",".$perPage;
        $result = $this->conn->query($sql);
        
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc()) {
                $data['contacts'][] = [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'] 
                ];
            }
        }
        
        $this->conn->close();
        
        return $data;
    }
    
    public function create()
    {
        $this->connect();
        
        $sql = "INSERT INTO contact (name, email, phone, user_id) VALUES ('".$this->name."', '".$this->email."', '".$this->phone."', '".$this->user_id."' )";
        
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
        
        $sql = "UPDATE contact SET name = '".$this->name."', email = '".$this->email."', phone = '".$this->phone."' WHERE id = ".$this->id;
        
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

    public function getEmail($email, $id)
    {
        $this->connect();
        $sql = "SELECT * FROM contact WHERE email = '".$email."' AND user_id = '".$this->user_id."' ";
        
        if ($id !== false)
        {
            $sql .= "AND id !=".$id;
        }

        $result = $this->conn->query($sql);
        $this->conn->close();
        
        if ($result->num_rows > 0)
        {
            return true;
        } else {
            return false;
        }
    }

    public function delete()
    {
        $this->connect();
        
        $sql = "DELETE FROM contact WHERE id = ".$this->id;
        
        if ($this->conn->query($sql) === TRUE) 
        {
            $this->conn->close();
            return true;
        } else {
            $this->conn->close();
            return false;
        }
    }

    public function toObject()
    {
        return (Object)[
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'user_id' => $this->user_id
        ];
    }
}