<?php
namespace Controller;

class ManageMember {
    private $member;
    private $view;
    private $file = "members.json";

    public function __construct(\Model\Member $member, \View\AddMemberView $view) {
        $this->member = $member;
        $this->view = $view;
    }

    public function createNewMember() {
        //TODO: snygga till
        if($this->view->clickedButton()){
            //$allMembers = array();
            $jsondata = file_get_contents($this->file);
            $allMembers = json_decode($jsondata, true);

        
            $newMember = $this->member->addMember($this->view->getName(), $this->view->getPersonalNumber(), $this->member->generateMemberID());
            array_push($allMembers, $newMember);
            $json = json_encode($allMembers, JSON_PRETTY_PRINT);
            $this->writeToMemberFile($this->openFile(), $json);
        }
    }
    
    
    public function openFile() {
        $file = fopen($this->file , 'w');
        return $file;
    }
    
    public function writeToMemberFile($file, $member) {
        fwrite($file , $member);
        fclose($file);
    }
}