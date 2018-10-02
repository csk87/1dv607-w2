<?php

//view
require_once('view/LayoutView.php');
require_once('view/AddMemberView.php');
require_once('view/ListMembersView.php');

//model
require_once('model/MemberListHandler.php');

//controll
require_once('controller/ViewController.php');
require_once('controller/UserController.php');


//create model objects
$memberHandler = new \Model\MemberListHandler();

//create view objects
$layoutView = new \View\LayoutView();
$addMemberView = new \View\AddMemberView();
$listMembersView = new \View\ListMembersView($memberHandler);

//create controller objects
$userController = new \Controller\UserController($memberHandler, $addMemberView);
$viewController = new \Controller\ViewController($layoutView, $addMemberView, $listMembersView);

//render view
$layoutView->renderView($userController);
$viewController->displayChoosenView();
