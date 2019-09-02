<?php

require '../Controller.php';
include '../res/head.php';
include '../View/Nav.php';

class View_Reports
{
    public $controller;

    public function __construct(){
        $this->controller = new Controller();
    }

    public function getCustomerReport(){
        return $this->controller->getCustomerReport();
    }

    public function getGuestWithId($id){
        return $this->controller->getGuestWithId($id);
    }

    public function getClassReport(){
        return $this->controller->getProfitsPerClass();
    }

}

$self = new View_Reports();
$reportGuestData = $self->getCustomerReport();
$reportClassData = $self->getClassReport();

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
    <h1>Most Reservations</h1>
    <table>
        <tr>
            <th>Guest Lastname</th>
            <th>Firstname</th>
            <th>Reservations</th>
        </tr>
        <?php for($i=0;$i<sizeof($reportGuestData);$i++): ?>
        <tr>
            <td><?php echo $self->getGuestWithId($reportGuestData[$i]['GuestID'])->lastname ?></td>
            <td><?php echo $self->getGuestWithId($reportGuestData[$i]['GuestID'])->firstname ?></td>
            <td><?php echo $reportGuestData[$i]['count'] ?></td>
        </tr>
        <?php endfor; ?>
    </table>
    <br>
    <h1>Revenue per Class and Month</h1>
    <table>
        <tr>
            <th>Class</th>
            <th>January</th>
            <th>February</th>
            <th>March</th>
            <th>April</th>
            <th>May</th>
            <th>June</th>
            <th>July</th>
            <th>August</th>
            <th>September</th>
            <th>October</th>
            <th>November</th>
            <th>December</th>
        </tr>
        <?php for($i=0;$i<sizeof($reportClassData);$i++): ?>
            <tr>
                <td><?php echo $i+1; ?></td>
                <?php for($j=0;$j<sizeof($reportClassData[$i]);$j++): ?>
                <td><?php echo $reportClassData[$i][$j] ?></td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </table>
</div>
<script src="../js/jquery.min.js"></script>

</body>
</html>