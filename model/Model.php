<?php

require 'Model_Guest.php';
require 'Model_Reservation.php';
require 'Model_Room.php';
require 'Model_RoomClass.php';

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


    //Guest
    //add new Guest
    public function addGuest($guest){
        $conn = $this->dbConnection();

        $sql = "INSERT INTO guest (firstname, lastname) VALUES ('".$guest->firstname."','".$guest->lastname."')";
        $conn->query($sql);

        $conn->close();
    }

    //get all Guests
    public function getGuests(){
        $conn = $this->dbConnection();

        $sql = "SELECT * FROM guest";
        $results = $conn->query($sql);

        $conn->close();
        return $results;
    }


    //Room
    //get all rooms
    public function getRooms(){
        $conn = $this->dbConnection();

        $sql = "SELECT * FROM room";
        $results = $conn->query($sql);

        $conn->close();
        return $results;
    }

    //get single room using id
    public function getRoom($id){

    }

    //get room classes
    public function getClasses(){
        $conn = $this->dbConnection();

        $sql = "SELECT * FROM roomClass";
        $results = $conn->query($sql);

        $conn->close();
        return $results;
    }

    //check room status
    public function checkRoomStatus($roomID){
        $conn = $this->dbConnection();

        $sql = "SELECT * FROM reservation WHERE RoomID ='".$roomID."' AND Active = true";
        $results = $conn->query($sql);

        $conn->close();
        return $results;
    }
}
