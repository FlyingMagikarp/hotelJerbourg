<?php

require '../Controller.php';
include '../res/head.php';
include '../View/Nav.php';

class View_ReservationNew
{
    public $controller;

    public function __construct(){
        $this->controller = new Controller();
    }

    public function addReservation($reservation){
        $this->controller->addReservation($reservation);
    }

    public function getAvailableRooms(){
        return $this->controller->getRooms();
    }

    public function getGuests(){
        return $this->controller->getGuests();
    }
}

$self = new View_ReservationNew();
$roomData = $self->getAvailableRooms();
$guestData = $self->getGuests();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room = $_POST["room"];
    $guest = $_POST["guest"];
    $dateStart = $_POST["dateStart"];
    $dateEnd = $_POST["dateEnd"];
    $today = date('Y-m-d');

    $reservation = new Model_Reservation($room, $guest, $today, $dateStart, $dateEnd);
    $self->addReservation($reservation);

    //redirect back to overview
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
    <h1>New Guest</h1>
    <form name="newWorker" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
        <table>
            <tr>
                <td><label>Room: </label></td>
                <td><select class="form-control" id="room" name="room">
                    <?php for($i=0;$i<sizeof($roomData);$i++): ?>
                        <option value="<?php echo $roomData[$i]->id; ?>"><?php echo $roomData[$i]->number; ?></option>
                    <?php endfor; ?>
                </select></td>
            </tr>
            <tr>
                <td><label>Guest: </label></td>
                <td><select class="form-control" id="guest" name="guest">
                    <?php for($i=0;$i<sizeof($guestData);$i++): ?>
                        <option value="<?php echo $guestData[$i]->id; ?>"><?php echo $guestData[$i]->lastname." ".$guestData[$i]->firstname; ?></option>
                    <?php endfor; ?>
                </select></td>
            </tr>
            <tr>
                <td><label>From: </label></td>
                <td><input id="dateStart" name="dateStart" type="date" required /></td>
            </tr>
            <tr>
                <td><label>To: </label></td>
                <td><input id="dateEnd" name="dateEnd" type="date" required /></td>
            </tr>
        </table>
        <input type="submit">
        <input type="reset">
    </form>
</div>
<script src="../js/jquery.min.js"></script>

</body>
</html>
