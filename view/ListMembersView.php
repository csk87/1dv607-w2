<?php

namespace View;

class ListMembersView {
    private $memberList;
    public function __construct(\Model\MemberListHandler $memberList) {
        $this->memberList = $memberList;

    }

    public function render($method) {
        echo '
        <h2>Members</h2>
        ' . $method . '
        ';
    } 

    public function getListView() {
        if(isset($_GET["compactList"])){
            echo $this->render($this->memberList->createCompactList());
        } else if(isset($_GET["verboseList"])) {
            echo $this->render($this->memberList->createVerboseList());

        } 
    }

}