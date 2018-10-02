<?php
namespace Model;

Class Member {
    private $name;
    private $personalNumber;
    private $memberId;
    private $boatList = array(); 

    public function __construct($name, $personalNumber, $memberId) {
        $this->name = $name;
        $this->personalNumber = $personalNumber;
        $this->memberId = $memberId;
        $this->boatList;
    }

     /*========= GET Methods =========*/

    public function getName(){
        return $this->name;
    }

    public function getMemberId(){
        return $this->memberId;
    }

    public function getPersonalNumber(){
        return $this->personalNumber;
    }

    public function getBoatList(){
        return $this->boatList;
    }

}