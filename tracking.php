<?php
use \Parse\ParseUser;

require_once 'class/classCommon.php';
$commonModel = new oskar\common;
$currentUser = ParseUser::getCurrentUser();
if(!is_object($currentUser)){
        header('Location:login');
}
 $user = $commonModel->getAllUsers();
 $usersJson =  json_encode($user);
 $title = "User Tracking";
 
 require_once 'view/tracking.php';