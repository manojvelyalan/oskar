<?php
use \Parse\ParseUser;

require_once 'class/classCommon.php';
$commonModel = new oskar\common;
$currentUser = ParseUser::getCurrentUser();
if(!is_object($currentUser)){
        header('Location:login');
}
$groups = $commonModel->getAllGroup();
$title = "Create Customers";
require_once 'view/createcustomer.php';
