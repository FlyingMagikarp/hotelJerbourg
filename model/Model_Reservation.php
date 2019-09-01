<?php

class Model_Reservation
{
    public $id;
    public $roomID;
    public $guestID;
    public $dateReservation;
    public $dateStart;
    public $dateEnd;
    public $paid;
    public $cancelled;
    public $active;
    public $inactive;

    public function __construct($roomID, $guestID, $dateReservation, $dateStart, $dateEnd, $id = 0, $paid = false, $cancelled = false, $active = false, $inactive = false)
    {
        $this->id = $id;
        $this->roomID = $roomID;
        $this->guestID = $guestID;
        $this->dateReservation = $dateReservation;
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
        $this->paid = $paid;
        $this->cancelled = $cancelled;
        $this->active = $active;
        $this->inactive = $inactive;
    }

}