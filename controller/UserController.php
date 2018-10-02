<?php
namespace Controller;
require_once('model/MemberListHandler.php');

  class UserController {

    private $memberList;
    private $addMemberView;

    public function __construct(\Model\MemberListHandler $memberList, \View\AddMemberView $aView){
      $this->memberList = $memberList; 
      $this->addMemberView = $aView; 
      $this->registerButtonClicked(); 
    }

    public function registerButtonClicked(){
      if(!$this->addMemberView->clickedButton()){
        return;
      }
      $newMember = $this->memberList->registerMember($this->addMemberView->getName(), $this->addMemberView->getPersonalNumber());
      $allMembers = json_decode(file_get_contents($this->memberList->getfile()), true);
      
      array_push($allMembers, (array)$newMember);
      $json = json_encode($allMembers, JSON_PRETTY_PRINT);
      $this->memberList->writeToMemberFile($this->memberList->openFile(), $json);
      
    } 

  /*  public function registerMember($name, $personalNumber){

      try {

        echo '<h2>Member registred successfully!</h2>';   
        $this->memberList->registerMember($name, $personalNumber);
        return $this->memberList->getMemberList();
      } catch (Exception $e){
        echo 'Member not registred, error: ', $e->getMessage(), "\n"; 
      }
  
    } */

    // GENERATE ARRAY OF ALL MEMBERS ID
    private function getMemberIds() {
      $memberData = $this->memberList->generateMembersArray();
      $memberIds = array();
      foreach($memberData as $key => $value) {
          foreach($value as $k => $v) {
              if($k == "Id") {
                  array_push($memberIds, $v);
              }
          }
      }
      return $memberIds;
   }

    public function deleteMemberFromFile() {
      $idList = $this->getMemberIds();
      foreach($idList as $value) {
          if(isset($_GET["delete$value"])) {
          $newFileContent = $this->memberList->deleteMember($value);
          $json = json_encode($newFileContent, JSON_PRETTY_PRINT);
          $this->memberList->writeToMemberFile($this->memberList->openFile(), $json);
          }
      }
  }

  public function changeMemberInformation() {
      $idList = $this->getMemberIds();
      foreach($idList as $value) {
          if(isset($_GET["change$value"])) {
              $this->addMemberView->renderChangeMemberFormHTML();
            if($this->addMemberView->changeButtonClicked()) {
              $newFileContent = $this->memberList->changeMember($value, $this->addMemberView->getName(), $this->addMemberView->getPersonalNumber());
              $json = json_encode($newFileContent, JSON_PRETTY_PRINT);
              $this->memberList->writeToMemberFile($this->memberList->openFile(), $json);
            }
          }
      }
  }

  public function viewMemberInformation() {
    $idList = $this->getMemberIds();            
    $text = "";

    foreach($idList as $value) {                
      if(isset($_GET["view$value"])) {
        $memberInfo = $this->memberList->viewMember($value);
        foreach($memberInfo as $key => $val) {
          if($key == "Boats" ) {
            $text .= "<br><li><b>$key: </b></li>";
            foreach($val as $k => $v) {
                $boats = "";
                foreach($v as $key => $value) {
                    $boats .= "<p><u>$key: </u> $value</p>";
                    $boats .= "\n";
                }
                $boats .= "------------";
                $text .= $boats;
            }
          } else {
            $text .= "<br><li><b>$key: </b>$val </li>";
          }  
        }                    
        return $text;
      }                       
    }
  }
}