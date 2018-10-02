<?php
namespace Model;

require_once('model/Member.php');

class MemberListHandler {
  private $memberList = array();
  private $id = 0; 
  private $file = "members.json";
  private $memberListDecodedJSON = array();
  public function __construct(){
  }

  public function registerMember(String $name, String $personalNumber){

    $this->id = $this->generateMemberID();
    $newMember = new Member($name, $personalNumber, $this->id); 
    array_push($this->memberList, $newMember); 

    return [
      'Name' => $newMember->getName(),
      'PersonalNumber' => $newMember->getPersonalNumber(),
      'Id' => $newMember->getMemberId(),
      'Boats' => []
    ];
  }

  // GENERATE A MEMBER ID
  public function generateMemberID() {
    $fileContent = json_decode(file_get_contents($this->file), true);
    $number = 0;        
      foreach($fileContent as $key => $value) {
          foreach($value as $k => $v) {
              if($k == "Id" && $v >= $number) {
                  $number = $v + 1;
                  $this->id = $number;
              }
          }
      }
      return $this->id;
    } 


  public function generateMembersArray() {
      $fileContent = file_get_contents($this->file, 'r');
      $this->memberListDecodedJSON = json_decode($fileContent, true);
      return $this->memberListDecodedJSON;
  }

  public function createCompactList() {
    $array = $this->generateMembersArray(); 
    $row = "";
    $list = "";
    foreach ($array as $key => $value) {
      foreach($value as $key => $val) {
          if($key == "Name" || $key == "Id")
              $row .= "<b>$key:</b> $val, ";
          if($key == "Boats") {
              $count = count((array)$val);
              
              $row .= "<b>$key:</b> $count, ";
          }
      } 
      $list .= "<li>$row</li>\n";
      $row = "";
    }
    return $list;
  }

  public function createVerboseList() {
    $array = $this->generateMembersArray(); 
    $row = "";
    $list = "";
    foreach ($array as $key => $value) {   
      $idNumber = 0;                 
      foreach($value as $key => $val) {
          if(gettype($val) == "string") {                
          $row .= "<b>$key:</b> $val, ";
      } else if (gettype($val) == "integer"){
          $row .= "<b>$key:</b> $val, ";
          $idNumber = $val;
      } else {
          foreach($val as $key => $value) {
              $nr = $key + 1;
              $row .= "<b><u>Boat $nr:</u></b>";
              foreach($value as $key => $value) {
                  if($key == "Type" || $key == "Length")
                  $row .= " <b>$key:</b> $value ";
              }
          }
        }
      }

      $list .= "<li>$row</li>";
        if($key = "Id") {
            $list .=  "<a href='?view".$idNumber."'><button name=''>View</button></a> <a href='?change".$idNumber."'><button name=''>Change</button></a> <a href='?delete".$idNumber."'><button name=''>Delete</button></a>\n";
        }

      $row = "";
      $idNumber = 0;
    }
    return $list;
  }

  public function changeMember($id, $newName, $newNumber) {
    $fileContent = json_decode(file_get_contents($this->file), true);

    foreach($fileContent as $key => $value) {           
      if($value['Id'] == $id) {
        $fileContent[$key]['Name'] = $newName; 
        $fileContent[$key]['PersonalNumber'] = $newNumber;
      }           
    }          
    return $fileContent;
  }

  public function deleteMember($id) {
      $fileContent = json_decode(file_get_contents($this->file), true);
      $newContent = array();
      foreach($fileContent as $key => $value) {                 
        foreach($value as $k => $v) {
          if($k == "Id" && $v != $id) {
            array_push($newContent, $value);
          }           
        }
      }
      return $newContent;
    }

  public function viewMember($id) {

    $fileContent = json_decode(file_get_contents($this->file), true);

    foreach($fileContent as $key => $value) {
      if($value["Id"] == $id) {
          return $value;
      }
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

  /*========= GET Methods =========*/

  public function getMemberList() {
    return $this->memberList;
  }

  public function getFile() {
    return $this->file;
  }

}