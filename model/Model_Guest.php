<?php

class Model_Guest
{
    public $id;
    public $firstname;
    public $lastname;

    public function __construct($firstname,$lastname,$id=0){
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

}