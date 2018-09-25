<?php
//var_dump($_GET);
//var_dump($_POST);
require_once('view/LayoutView.php');
require_once('view/AddMemberView.php');
require_once('model/Member.php');
require_once('controller/ViewController.php');
require_once('controller/MemberController.php');

//create view objects
$layoutView = new \View\LayoutView();
$addMemberView = new \View\AddMemberView();

$member = new \Model\Member();

// create controller objects
$viewController = new \Controller\ChangeView($layoutView, $addMemberView);
$memberController = new \Controller\ManageMember($member, $addMemberView);
$memberController->createNewMember();

$layoutView->renderView($memberController, $addMemberView);

$viewController->renderHTMLView();
