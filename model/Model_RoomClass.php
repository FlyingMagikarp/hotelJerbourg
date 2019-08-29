<?php

class Model_RoomClass
{
    public $id;
    public $class;

    public function __construct($id, $class){
        $this->id = $id;
        $this->class = $class;
    }
}