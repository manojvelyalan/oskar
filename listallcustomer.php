<?php
use \Parse\ParseUser;

require_once 'class/classCommon.php';
$commonModel = new oskar\common;
$currentUser = ParseUser::getCurrentUser();
if(!is_object($currentUser)){
        header('Location:login');
}
 $allCustomer = $commonModel->getAllCustomer();
 $title = "List All Customer";
 require_once 'view/listallcustomer.php';

