<?php

require '../Controller.php';
include '../res/head.php';
include '../View/Nav.php';

class View_RoomOverview
{
    public $controller;

    public function __construct(){
        $this->controller = new Controller();
    }

    public function getRooms(){
        return $this->controller->getRooms();
    }

    public function getClasses(){
        return $this->controller->getClasses();
    }

    public function checkRoomStatus($roomID){
        return $this->controller->checkRoomStatus($roomID);
    }

}

$self = new View_RoomOverview();
$roomData = $self->getRooms();
$classes = $self->getClasses();
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
    <a href="/hotelJerbourg/View/View_GuestNew.php"><button>New Guest</button></a>
    <table>
        <tr>
            <th>ID</th>
            <th>Room Number</th>
            <th>Class</th>
            <th>Status</th>
        </tr>
        <?php for($i = 0;$i<sizeof($roomData);$i++): ?>
            <tr>
                <td><?php echo $roomData[$i]->id ?></td>
                <td><?php echo $roomData[$i]->number ?></td>
                <td><?php echo $classes[$roomData[$i]->class-1]->class ?></td>
                <td><?php echo $self->checkRoomStatus($roomData[$i]->id); ?></td>
            </tr>
        <?php endfor; ?>
    </table>
</div>
<script src="../js/jquery.min.js"></script>

</body>
</html>