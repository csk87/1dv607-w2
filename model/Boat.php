<?php

namespace Model;

class Boat {

    private $boatType = array("Sailboat", "Motorsailer", "Kayak/Canoe", "Other");
    private $length;
    private $boatId;



    /*========= GET Methods =========*/

    public function getLength() {
        return $this->length;
    }
    public function getBoatType() {
        return $this->boatType;
    }
    public function getBoatId() {
        return $this->boatId;
    }

}