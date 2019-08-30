<?php

require '../Controller.php';
include '../res/head.php';
include '../View/Nav.php';

class View_GuestNew
{
    public $controller;

    public function __construct(){
        $this->controller = new Controller();
    }

    public function addGuest($guest){
        $this->controller->addGuest($guest);
    }

}

$self = new View_GuestNew();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];

    $guest = new Model_Guest($firstname,$lastname);
    $self->addGuest($guest);
    //redirect back to overview
    header("Location: View_GuestOverview.php");
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
                <td><label>Firstname: </label></td>
                <td><input id="firstname" name="firstname" type="text" required /></td>
            </tr>
            <tr>
                <td><label>Lastname: </label></td>
                <td><input id="lastname" name="lastname" type="text" required /></td>
            </tr>
        </table>
        <input type="submit">
        <input type="reset">
    </form>
</div>
<script src="../js/jquery.min.js"></script>

</body>
</html>