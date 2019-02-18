<?php
 use Parse\ParseUser;
// include all the class file whihc need for this controller
if(isset($_POST['postValue'])){
   
    require_once '../class/classCommon.php';
    $commonModel = new oskar\common;
    
    $data = $_POST['postValue'];
    $email = $data['email'];
    $password = $data['password'];
    try {                    
            $user = ParseUser::logIn($email, $password);
            if($user->isAdmin == true){
                $loginData['status'] = true;
            }else{
                $loginData['status'] = false;
                $loginData['message'] = 'Your are not authorize to login here.';
            }
        }
        //catch exception
        catch(Exception $e) {                   
            $loginData['status'] = false;
            $loginData['message'] =  $e->getMessage();
        }
    echo json_encode($loginData);
}else{
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 Not Found</h1>";
    echo "The page that you have requested could not be found.";
    exit();
}