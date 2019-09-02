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

    public function togglePaid($value,$id){
        $this->controller->reservationTogglePaid($value,$id);
    }

    public function toggleCancelled($value,$id){
        $this->controller->reservationToggleCancelled($value,$id);
    }

    public function toggleActive($value,$id){
        $this->controller->reservationToggleActive($value,$id);
        if($value){
            $this->controller->reservationToggleInactive(false,$id);
        }
    }

    public function toggleInactive($value,$id){
        $this->controller->reservationToggleInactive($value,$id);
        if($value){
            $this->controller->reservationToggleActive(false,$id);
        }
    }
}


$self = new View_ReservationsOverview();
$reservationsData = $self->getReservations();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['setPaid'])) {
        if ($_POST['setPaid'] == 'true') {
            $self->togglePaid(false,$_POST['id']);
        } elseif ($_POST['setPaid'] == 'false') {
            $self->togglePaid(true,$_POST['id']);
        }
    }

    if(isset($_POST['setCancelled'])) {
        if ($_POST['setCancelled'] == 'true') {
            $self->toggleCancelled(false,$_POST['id']);
        } elseif ($_POST['setCancelled'] == 'false') {
            $self->toggleCancelled(true,$_POST['id']);
        }
    }

    if(isset($_POST['setActive'])) {
        if ($_POST['setActive'] == 'true') {
            $self->toggleActive(false,$_POST['id']);
        } elseif ($_POST['setActive'] == 'false') {
            $self->toggleActive(true,$_POST['id']);
        }
    }

    if(isset($_POST['setInactive'])) {
        if ($_POST['setInactive'] == 'true') {
            $self->toggleInactive(false,$_POST['id']);
        } elseif ($_POST['setInactive'] == 'false') {
            $self->toggleInactive(true,$_POST['id']);
        }
    }

    header("Location: View_ReservationsOverview.php");
    exit();
}
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
                <td>
                    <?php if($reservationsData[$i]->paid): ?>
                        <form name="setPaidFalse" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
                            <input name="id" value="<?php echo $reservationsData[$i]->id ?>" hidden><input name="setPaid" value="true" hidden><button type="submit" class="btn btn-sm btn-dark">Toggle Paid</button>
                        </form>
                    <?php else: ?>
                        <form name="setPaidTrue" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
                            <input name="id" value="<?php echo $reservationsData[$i]->id ?>" hidden><input name="setPaid" value="false" hidden><button type="submit" class="btn btn-sm btn-dark">Toggle Paid</button>
                        </form>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if($reservationsData[$i]->cancelled): ?>
                        <form name="setCancelledFalse" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
                            <input name="id" value="<?php echo $reservationsData[$i]->id ?>" hidden><input name="setCancelled" value="true" hidden><button type="submit" class="btn btn-sm btn-dark">Toggle Cancelled</button>
                        </form>
                    <?php else: ?>
                        <form name="setCancelledTrue" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
                            <input name="id" value="<?php echo $reservationsData[$i]->id ?>" hidden><input name="setCancelled" value="false" hidden><button type="submit" class="btn btn-sm btn-dark">Toggle Cancelled</button>
                        </form>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if($reservationsData[$i]->active): ?>
                        <form name="setActiveFalse" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
                            <input name="id" value="<?php echo $reservationsData[$i]->id ?>" hidden><input name="setActive" value="true" hidden><button type="submit" class="btn btn-sm btn-dark">Toggle Active</button>
                        </form>
                    <?php else: ?>
                        <form name="setActiveTrue" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
                            <input name="id" value="<?php echo $reservationsData[$i]->id ?>" hidden><input name="setActive" value="false" hidden><button type="submit" class="btn btn-sm btn-dark">Toggle Active</button>
                        </form>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if($reservationsData[$i]->inactive): ?>
                        <form name="setInactiveFalse" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
                            <input name="id" value="<?php echo $reservationsData[$i]->id ?>" hidden><input name="setInactive" value="true" hidden><button type="submit" class="btn btn-sm btn-dark">Toggle Inactive</button>
                        </form>
                    <?php else: ?>
                        <form name="setInactiveTrue" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
                            <input name="id" value="<?php echo $reservationsData[$i]->id ?>" hidden><input name="setInactive" value="false" hidden><button type="submit" class="btn btn-sm btn-dark">Toggle Inactive</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endfor; ?>
    </table>
</div>
<script src="../js/jquery.min.js"></script>

</body>
</html>