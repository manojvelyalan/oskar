<?php
namespace oskar;

require_once 'classParseSettings.php';
use Parse\ParseException;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParsePush;
use Parse\ParseCloud;
use Parse\ParseUser;
use Parse\ParseFile;
class common{
    
    public function __construct() {
       $parseModel = new \oskar\parseSettings;
       $parseModel->parseInetialization();
    }
    
    public function getAllCustomer(){
        $query = new ParseQuery("Customer");
        $query->equalTo('isDelete', false);
        $query->includeKey("group");
        $query->includeKey("group.city");
        $query->ascending('name');
        $result = $query->find();
        if(count($result) > 0){
            return $result;
        }else{
            return false;
        }
    }
    
    public function getAllUsers(){
        $locationArray = [];
        $query = new ParseQuery("_User");        
        $result = $query->find();
        if(count($result) > 0){
            for($i =  0;$i<count($result);$i++){
                $data[$i]['fullName'] = ucwords($result[$i]->firstName." ".$result[$i]->lastName);
                $data[$i]['img'] = $result[$i]->profilePic;
                for($c = 0; $c <count($result[$i]->locations);$c++){
                    $location['lat'] = $result[$i]->locations[$c]->getLatitude();
                    $location['long'] = $result[$i]->locations[$c]->getLongitude();
                    array_push($locationArray, $location);
                }
                $data[$i]['location'] = $locationArray;                
            }
            return $data;
        }else{
            return false;
        }
    }
    public function deleteRow($id,$class){
        $deleteObject = new ParseObject($class,$id);
        $deleteObject->set("isDelete",true);
        try{
            $deleteObject->save(true);
            $result['status'] = true;
            $result['message'] = "Successfully deleted the row";
           
        } catch (ParseException $ex) {
            $result['status'] = false;
            $result['message'] = "Something went wrong. Please try after sometime.".$ex->getMessage();
        }
        return $result;
    }
    public function getAllGroup(){
        $query = new ParseQuery("Groups");
        $result = $query->find();
        if(count($result) > 0){
            return $result;
        }else{
            return false;
        }
    }
    public function createOrUpdateCustomer($data){
        $group = new ParseObject("Groups",$data['group']);
        if($data['customerId'] != ""){
            $customerObject = new ParseObject("Customer",$data['customerId']);
        }else{
            $customerObject = new ParseObject("Customer");
        }
        $customerObject->set("code",$data['customerCode']);
        $customerObject->set("name",$data['fullName']);
        $customerObject->set("phone",$data['mobile']);
        $customerObject->set("status","1");
        $customerObject->set("trnNumber",$data['trn']);
        $customerObject->set("group",$group);
        
        $customerObject->set("isDelete",false);
        try{
            $customerObject->save();
            $result['status'] = true;
            $status = ($data['customerId'] != "")?"updated":"created";
            $result['message'] = "Successfully $status the customer";
           
        } catch (ParseException $ex) {
            $result['status'] = false;
            $result['message'] = "Something went wrong. Please try after sometime. ".$ex->getMessage();;
        }
        return $result;
    }
    public function createOrUpdateInvoice($data){
        
        if($data['invoiceId'] != ""){
            $invoiceObject = new ParseObject("Invoices",$data['invoiceId']);
        }else{
            $invoiceObject = new ParseObject("Invoices");
        }
        $customer = new ParseObject("Customer",$data['customer']);
        $country = new ParseObject("Country",$data['country']);
        $invoiceNumber = self::getInvoiceNumber();
        $invoiceObject->set("customer",$customer);
        $invoiceObject->set("country",$country);
        $invoiceObject->set("number","$invoiceNumber");       
        $invoiceObject->set("isDelete",false);
        try{
            $invoiceObject->save();
            $result['status'] = true;
            $status = ($data['invoiceId'] != "")?"updated":"created";
            $result['message'] = "Successfully $status the invoice";
           
        } catch (ParseException $ex) {
            $result['status'] = false;
            $result['message'] = "Something went wrong. Please try after sometime. ".$ex->getMessage();;
        }
        return $result;
    }
    public static function getInvoiceNumber(){
        $query = new ParseQuery("Invoices");
        $query->descending("createdAt");
        $query->limit(1);
        $result = $query->find();
        return $result[0]->number + 1;
    }
    public function getInvoiceList(){
        $query = new ParseQuery("Invoices");
        $query->equalTo('isDelete', false);
        $query->includeKey("customer");
        $query->includeKey("createdBy");
        $query->includeKey("country");
        $result = $query->find();
        if(count($result) > 0){
            return $result;
        }else{
            return false;
        }
    }
    public function getAllCountry(){
        $query = new ParseQuery("Country");
        $result = $query->find();
        if(count($result) > 0){
            return $result;
        }else{
            return false;
        }
    }
}