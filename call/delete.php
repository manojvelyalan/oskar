<?php
 use Parse\ParseUser;
// include all the class file whihc need for this controller
if(isset($_POST['postValue'])){
   
    require_once '../class/classCommon.php';
    $commonModel = new oskar\common;
    $data = $_POST['postValue'];
    switch($data['type']){
        case"1":
            $result = $commonModel->deleteRow($data['id'],"Customer");
            break;   
        case"2":
            $result = $commonModel->deleteRow($data['id'],"Invoices");
            break; 
    }   
    echo json_encode($result);
}else{
    header("Location:../notauthorize");
}