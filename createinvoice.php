<?php
use \Parse\ParseUser;

require_once 'class/classCommon.php';
$commonModel = new oskar\common;
$currentUser = ParseUser::getCurrentUser();
if(!is_object($currentUser)){
        header('Location:login');
}
 $customers = $commonModel->getAllCustomer();
 $country = $commonModel->getAllCountry();
 $title = "Create Invoice";
 require_once 'view/createinvoice.php';