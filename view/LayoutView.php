<?php
namespace View;

Class LayoutView {
    private $add = "add";
    private $change= "change";


    public function renderView($memberController, $AddMemberView) {
        echo '<!DOCTYPE html>
        <html>
          <head>
            <meta charset="utf-8">
            <title>Member register</title>
          </head>
          <body>
            <h1>Workshop 2 - Member register</h1>       
            
                <a href="?add">Add member</a>
                <br>
                <a href="?compactList">View members compact</a>
                <br>
                <a href="?verboseList">View members verbose</a>
                <br>
                <a href="?change">Change members information</a>
           </body>
        </html>
      ';
    }

    public function wantToAddNewMember() {
        return isset($_GET[$this->add]);
    }
}