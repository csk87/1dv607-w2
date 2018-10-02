<?php
namespace Controller;

class ViewController {
    private $layoutView;
    private $addView;
    private $listView;

    public function __construct(\View\LayoutView $lView, \View\AddMemberView $aView, \View\ListMembersView $listView) {
        $this->layoutView = $lView;
        $this->addView = $aView;
        $this->listView = $listView;
    }

    public function displayChoosenView() {
         if($this->layoutView->wantToAddNewMember()) {
               return $this->addView->renderMemberFormHTML();         
            } else if($this->listView->getListView()) {
                return $this->listView->render();
            } else if($this->layoutView->backToStart()) {
                return header('Location:'.$_SERVER['PHP_SELF']);         
             }  
    }
 
} 