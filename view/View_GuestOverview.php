<?php

require '../Controller.php';
include '../res/head.php';
include '../View/Nav.php';

class View_GuestOverview
{
    public $controller;

    public function __construct(){
        $this->controller = new Controller();
    }

    public function getGuests(){
        return $this->controller->getGuests();
    }

}

$self = new View_GuestOverview();
$guestData = $self->getGuests();
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
            <th>Lastname</th>
            <th>Firstname</th>
        </tr>
        <?php for($i = 0;$i<sizeof($guestData);$i++): ?>
            <tr>
                <td><?php echo $guestData[$i]->id ?></td>
                <td><?php echo $guestData[$i]->lastname ?></td>
                <td><?php echo $guestData[$i]->firstname ?></td>

                <!--<td><a href="#"><img class="icon" src="../res/icon/edit.png"></a></td>
                <td><a href="#"><img class="icon" src="../res/icon/delete.png"></a></td>-->
            </tr>
        <?php endfor; ?>
    </table>
</div>
<script src="../js/jquery.min.js"></script>

</body>
</html>