<?php

class Connection {

    public $config;
    private $host;
    private $dbname;
    private $password;
    private $username;
    public $conn;

    function __construct() {
        $this->config = unserialize(CONFIG);
        $this->host = $this->config['host'];
        $this->dbname = $this->config['dbname'];
        $this->password = $this->config['password'];
        $this->username = $this->config['username'];
    }

    public function connect()
    {
        $this->conn  = new MySQLi($this->host, $this->username, $this->password, $this->dbname);

        if(!$this->conn) {
            return false;
        } else {
            return true;
        }
    }   
}