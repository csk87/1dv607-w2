<?php
namespace View;

Class LayoutView {
    private $add = "add";
    private $start= "start";
    private $memberList;
    private $memberController;

    public function __construct() {
    }

    public function renderView($userController) {
        echo '<!DOCTYPE html>
        <html>
          <head>
            <meta charset="utf-8">
            <title>Member register</title>
          </head>
          <body>
            <h1>Workshop 2 - Member register</h1>       
                <a href="?start">Start</a>
                <br>
                <a href="?add">Add member</a>
                <br>
                <a href="?compactList">View members compact</a>
                <br>
                <a href="?verboseList">View members verbose</a>
                <br>
                ' . $userController->deleteMemberFromFile() . '
                ' . $userController->changeMemberInformation() . '
                ' . $userController->viewMemberInformation() . '
           </body>
        </html>
      ';
    }
    public function wantToAddNewMember() {
        return isset($_GET[$this->add]);
    }
    public function backToStart() {
      return isset($_GET[$this->start]);

    }

}