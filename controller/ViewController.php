<?php
namespace Controller;

class ChangeView {
    private $layoutView;
    private $addView;

    public function __construct(\View\LayoutView $lView, \View\AddMemberView $aView) {
        $this->layoutView = $lView;
        $this->addView = $aView;
    }

    public function renderHTMLView() {
         if($this->layoutView->wantToAddNewMember()) {
               return $this->addView->renderMemberFormHTML();         
            }  
    }
 
} 