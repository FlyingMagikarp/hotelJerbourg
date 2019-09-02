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


    //Reservation
    //get all reservations
    public function getReservations(){
        $conn = $this->dbConnection();

        //$sql = "SELECT * FROM reservation WHERE Inactive = false AND Cancelled = false";
        $sql = "SELECT * FROM reservation";
        $results = $conn->query($sql);

        $conn->close();
        return $results;
    }

    //get reservation by id
    public function getReservationWithId($id){
        $conn = $this->dbConnection();

        $sql = "SELECT * FROM reservation WHERE Cancelled = false AND ID = '".$id."'";
        $results = $conn->query($sql);

        $conn->close();
        return $results;
    }

    //get all reservations by guestId
    public function countReservationsWithGuestId($guestid){
        $conn = $this->dbConnection();

        $sql = "SELECT GuestID, COUNT(ID) AS count FROM reservation WHERE Cancelled = false AND Paid = true AND GuestID = '".$guestid."'";
        $results = $conn->query($sql);

        $conn->close();
        return $results;
    }

    //add new Reservation
    public function addReservation($reservation){
        $conn = $this->dbConnection();

        $sql = "INSERT INTO reservation (RoomID, GuestID, DateReservation, DateStart, DateEnd, Paid, Cancelled, Active, Inactive) VALUES ('".$reservation->roomID."','".$reservation->guestID."','".$reservation->dateReservation."','".$reservation->dateStart."','".$reservation->dateEnd."',false,false,false,false)";
        $conn->query($sql);

        $conn->close();
    }

    //toggle paid
    public function reservationTogglePaid($value,$id){
        $conn = $this->dbConnection();

        $conn = $this->dbConnection();
        $sql = "UPDATE reservation SET Paid = '".$value."' WHERE ID = '".$id."'";
        $conn->query($sql);
    }

    //toggle cancelled
    public function reservationToggleCancelled($value,$id){
        $conn = $this->dbConnection();

        $conn = $this->dbConnection();
        $sql = "UPDATE reservation SET Cancelled = '".$value."' WHERE ID = '".$id."'";
        $conn->query($sql);
    }

    //toggle active
    public function reservationToggleActive($value,$id){
        $conn = $this->dbConnection();

        $conn = $this->dbConnection();
        $sql = "UPDATE reservation SET Active = '".$value."' WHERE ID = '".$id."'";
        $conn->query($sql);
    }

    //toggle inactive
    public function reservationToggleInactive($value,$id){
        $conn = $this->dbConnection();

        $conn = $this->dbConnection();
        $sql = "UPDATE reservation SET Inactive = '".$value."' WHERE ID = '".$id."'";
        $conn->query($sql);
    }

    public function getReservationsByClassAndMonth($class,$startdate,$enddate){
        $conn = $this->dbConnection();

        $sql = "SELECT * FROM reservation as r JOIN room as c on r.RoomID = c.ID WHERE Cancelled = false AND Paid = true AND c.Class = '".$class."' AND DateStart < '".$enddate."' AND DateStart >= '".$startdate."'";
        $results = $conn->query($sql);

        $conn->close();
        return $results;
    }
}
