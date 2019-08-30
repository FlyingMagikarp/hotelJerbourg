<?php

require 'Model/Model.php';

class Controller{

    public $model;

    public function __construct(){
        $this->model = new Model();
    }


    //Guest
    //add new guest
    public function addGuest($guest){
        $this->model->addGuest($guest);
    }

    //Get all guests
    public function getGuests(){
        $dataDB = $this->model->getGuests();
        $dataArray = array();
        while($row = $dataDB->fetch_assoc()){
            $guest = new Model_Guest($row['Firstname'],$row['Lastname'],$row['ID']);
            array_push($dataArray,$guest);
        }
        return $dataArray;
    }


    //Room
    //get all rooms
    public function getRooms(){
        $dataDB = $this->model->getRooms();
        $dataArray = array();
        while($row = $dataDB->fetch_assoc()){
            $room = new Model_Room($row['ID'],$row['Number'],$row['Class'],$row['Price']);
            array_push($dataArray,$room);
        }
        return $dataArray;
    }

    //get room Classes
    public function getClasses(){
        $dataDB = $this->model->getClasses();
        $dataArray = array();
        while($row = $dataDB->fetch_assoc()){
            $class = new Model_RoomClass($row['ID'],$row['Class']);
            array_push($dataArray,$class);
        }
        return $dataArray;
    }

    //check room status
    public function checkRoomStatus($roomID){
        $dataDB = $this->model->checkRoomStatus($roomID);

        if($dataDB->fetch_assoc()==NULL){
            return "Free";
        } else {
            return "Booked";
        }
    }
}