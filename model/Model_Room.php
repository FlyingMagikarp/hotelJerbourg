<?php

class Model_Room
{
    public $id;
    public $number;
    public $class;
    public $price;

    public function __construct($id,$number,$class,$price){
        $this->id = $id;
        $this->number = $number;
        $this->class = $class;
        $this->price = $price;
    }

}