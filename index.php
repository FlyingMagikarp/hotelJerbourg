<?php

    include 'res/head.php';
    include 'res/Nav.php';
    include 'model/Model.php';

    $controller = new Model();
    class Index{
        public $model;

            public function __construct(){
                $this->model = new Model();
            }

            public function getStations(){
                return $this->model->testDB();
            }

    }
    $self = new Index();
    $stations = $self->getStations();
?>
    <html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="functions.js"></script>
    </head>
    <body>
    <div class="navbar">
        <?php echo $stations; ?>
    </div>