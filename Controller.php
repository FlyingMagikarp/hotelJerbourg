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

    public function getGuestWithId($id){
        $dataArray = $this->getGuests();
        $guest = 0;
        for($i=0;$i<sizeof($dataArray);$i++){
            if($dataArray[$i]->id==$id){
                $guest = $dataArray[$i];
            }
        }
        return $guest;
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

        if(!$dataDB || $dataDB->fetch_assoc()==NULL){
            return "Free";
        } else {
            return "Booked";
        }
    }

    public function getRoomWithId($id){
        $dataArray = $this->getRooms();
        $room = 0;
        for($i=0;$i<sizeof($dataArray);$i++){
            if($dataArray[$i]->id==$id){
                $room = $dataArray[$i];
            }
        }
        return $room;
    }


    //Reservations
    //get all reservations
    public function getReservations(){
        $dataDB = $this->model->getReservations();
        $dataArray = array();
        if($dataDB == false){
            return;
        }
        while($row = $dataDB->fetch_assoc()){
            $reservation = new Model_Reservation($row['RoomID'],$row['GuestID'],$row['DateReservation'],$row['DateStart'],$row['DateEnd'],$row['ID'],$row['Paid'],$row['Cancelled'],$row['Active'],$row['Inactive']);
            array_push($dataArray,$reservation);
        }
        return $dataArray;
    }

    //add new Reservation
    public function addReservation($reservation){
        $this->model->addReservation($reservation);
    }

    //toggle paid
    public function reservationTogglePaid($value,$id){
        $this->model->reservationTogglePaid($value,$id);
    }

    //toggle cancelled
    public function reservationToggleCancelled($value,$id){
        $this->model->reservationToggleCancelled($value,$id);
    }

    //toggle active
    public function reservationToggleActive($value,$id){
        $this->model->reservationToggleActive($value,$id);
    }

    //toggle inactive
    public function reservationToggleInactive($value,$id){
        $this->model->reservationToggleInactive($value,$id);
    }


    //Reports
    //best customers
    public function getCustomerReport(){
        $guestData = $this->getGuests();
        $reportData = array();
        for($i=0;$i<sizeof($guestData);$i++){
            $dataDB = $this->model->countReservationsWithGuestId($guestData[$i]->id);
            $tmp = $dataDB->fetch_assoc();
            array_push($reportData,$tmp);
        }


        usort($reportData, function($a, $b) {
            return $a['count'] - $b['count'];
        });

        $reportData = array_reverse($reportData);

        return $reportData;
    }

    //profits per class per month
    public function getProfitsPerClass(){
        $classes = $this->getClasses();
        $monthData = array(
            "2019-1-1",
            "2019-2-1",
            "2019-3-1",
            "2019-4-1",
            "2019-5-1",
            "2019-6-1",
            "2019-7-1",
            "2019-8-1",
            "2019-9-1",
            "2019-10-1",
            "2019-11-1",
            "2019-12-1",
            "2020-1-1",
        );
        $profitData = array();

        for($i=0;$i<sizeof($classes);$i++){
            $tmpArr = array($classes[$i]->id,0);
            $tmpProfitArr = array();
            for($j=0;$j<sizeof($monthData)-1;$j++){
                $tmpProfit = 0;
                $data = $this->model->getReservationsByClassAndMonth($classes[$i]->id,$monthData[$j],$monthData[$j+1]);
                $dataArray = array();
                while($row = $data->fetch_assoc()){
                    array_push($dataArray,$row);
                }
                if(sizeof($dataArray) == 0) {
                    $tmpProfit = 0;
                }else{
                    for ($k = 0; $k < sizeof($dataArray); $k++) {
                        $data = $dataArray[$k];
                        $startDat = new DateTime($data['DateStart']);
                        $endDat = new DateTime($data['DateEnd']);
                        $days = date_diff($startDat, $endDat)->format('%a');
                        $price = $data['Price'];
                        $total = $days * $price;
                        $tmpProfit += $total;
                    }
                }
                array_push($tmpProfitArr,$tmpProfit);
            }

            array_push($profitData,$tmpProfitArr);
        }

        return $profitData;
    }
}