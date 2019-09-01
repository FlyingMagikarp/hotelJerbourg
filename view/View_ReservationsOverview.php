<?php

require '../Controller.php';
include '../res/head.php';
include '../View/Nav.php';

class View_ReservationsOverview
{
    public $controller;

    public function __construct(){
        $this->controller = new Controller();
    }

    public function getReservations(){
        return $this->controller->getReservations();
    }

    public function getGuestWithId($id){
        return $this->controller->getGuestWithId($id);
    }

    public function getRoomWithId($id){
        return $this->controller->getRoomWithId($id);
    }
}


$self = new View_ReservationsOverview();
$reservationsData = $self->getReservations();
?>

<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
<div class="wrapper">
    <div class="navbar">
        <?php echo getNavbar(); ?>
    </div>
    <a href="/hotelJerbourg/View/View_ReservationNew.php"><button>New Reservation</button></a>
    <table>
        <tr>
            <th>ID</th>
            <th>Lastname</th>
            <th>Firstname</th>
            <th>Room</th>
            <th>Booking Date</th>
            <th>From</th>
            <th>To</th>
            <th>Paid</th>
            <th>Cancelled</th>
            <th>Active</th>
            <th>Inactive</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <?php for($i = 0;$i<sizeof($reservationsData);$i++): ?>
        <?php
            $tmpGuest = $self->getGuestWithId($reservationsData[$i]->guestID);
            $tmpRoom = $self->getRoomWithId($reservationsData[$i]->roomID);

            ?>
            <tr>
                <td><?php echo $reservationsData[$i]->id ?></td>
                <td><?php echo $tmpGuest->lastname ?></td>
                <td><?php echo $tmpGuest->firstname ?></td>
                <td><?php echo $tmpRoom->number ?></td>
                <td><?php echo $reservationsData[$i]->dateReservation ?></td>
                <td><?php echo $reservationsData[$i]->dateStart ?></td>
                <td><?php echo $reservationsData[$i]->dateEnd ?></td>
                <td><?php echo ($reservationsData[$i]->paid) ? "yes" : "no"; ?></td>
                <td><?php echo ($reservationsData[$i]->cancelled) ? "yes" : "no"; ?></td>
                <td><?php echo ($reservationsData[$i]->active) ? "yes" : "no"; ?></td>
                <td><?php echo ($reservationsData[$i]->inactive) ? "yes" : "no"; ?></td>
                <td>toggle<?php  ?></td>
                <td>toggle<?php  ?></td>
                <td>toggle<?php  ?></td>
                <td>toggle<?php  ?></td>
            </tr>
        <?php endfor; ?>
    </table>
</div>
<script src="../js/jquery.min.js"></script>

</body>
</html>