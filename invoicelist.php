<?php
use \Parse\ParseUser;

require_once 'class/classCommon.php';
$commonModel = new oskar\common;
$currentUser = ParseUser::getCurrentUser();
if(!is_object($currentUser)){
        header('Location:login');
}
 $allInvoice = $commonModel->getInvoiceList();
 $title = "List All Invoice";
 require_once 'view/invoicelist.php';

