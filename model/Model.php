<?php

class Model
{

    public function __construct()
    {

    }


    // Connection Stuff
    public function dbConnection(){
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'hotelJerbourg';

        $conn = new mysqli($servername,$username,$password,$dbname);
        $conn->set_charset('utf8');
        return $conn;
    }

    // db test function
    public function testDB(){
        $conn = $this->dbConnection();
        return "test";
    }

}
