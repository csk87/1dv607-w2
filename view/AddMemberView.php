<?php

namespace View;

class AddMemberView {
    
    private static $name = 'AddMemberView::name';
    private static $personalNumber = 'AddMemberView::personalNumber';
    private static $register = 'AddMemberView::register';
    
    private $memberName = ''; 
    private $memberPersonalNumber = null;


    public function __construct() {
    

    }

    public function renderMemberFormHTML() {
        echo '
        <h3>Enter member information<h3>
        <form method="post"> 
        <label for="">Name :</label>
        <input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->memberName .'" />
        <br>
        <label for="">Personal number:</label>
        <input type="text" id="' . self::$personalNumber . '" name="' . self::$personalNumber . '" value="' . $this->memberPersonalNumber . '" />
        <br>
        <input type="submit" name="' . self::$register .'" value="Register" />
        </form>
        ';
    } 
    
   public function clickedButton(){
    if(isset($_POST[self::$register])){
        return true;
    }
   }

    public function getName() {
        if(isset($_POST[self::$name]))
        return $_POST[self::$name];
    }
    public function getPersonalNumber() {
        if(isset($_POST[self::$personalNumber]))
        return $_POST[self::$personalNumber];
    }
}