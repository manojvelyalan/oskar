<?php
use oskar\common;
use \Parse\ParseUser;
if(isset($_POST['postValue'])){
    require_once '../class/classCommon.php';
    $commonModel = new common;
    $data = $_POST['postValue'];
    $result = $commonModel->createOrUpdateCustomer($data);        
    echo json_encode($result);
}else{
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 Not Found</h1>";
    echo "The page that you have requested could not be found.";
    exit();
}


