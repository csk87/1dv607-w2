<?php
namespace Model;

Class Member {
    private $name;
    private $personalNumber;
    private $memberId = 1;
    private $member = array();
    private $allMembers = array();

    public function generateMemberID() {
        // $number = Count($this->allMembers);
        // $this->memberId = $number + 1;
        return $this->memberId;
    }
    public function addMember($name, $pNumber, $id) {
        $this->name = $name;
        $this->personalNumber = $pNumber;
        $this->memberId = $id;

        $this->member = array(
            'Name' => $this->name,
            'PersonalNumber' => $this->personalNumber,
            'ID' => $this->memberId
        );
        

        //array_push($this->allMembers, $this->member);
        return $this->member;
    }

    public function changeMember($newName, $newNumber, $newId) {
        $this->name = $newName;
        $this->personalNumber = $newNumber;
        $this->memberId = $newId;
    }
    public function getAllMembers($file) {
        array_push($this->allMembers, file_get_contents($file));
        return $this->allMembers;
    }

    public function deleteMember() {
        file_put_contents($this->file, "");
        file_put_contents($this->file, $this->allMembers);
    }
}