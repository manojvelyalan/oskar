<?php
namespace oskar;



// autoload all the class which required for parse sdk..
require $_SERVER['DOCUMENT_ROOT'].'/ziqitza/autoload.php';
//require $_SERVER['DOCUMENT_ROOT'].'/autoload.php';
use Parse\ParseClient;

// Inetialize the parse settings 
// we are usign back4app as third party vendor which will set up the parse server.


class parseSettings{
     // application id.. we will get it from back4app dashboard..
    
    const app_id  =  "F3qSntRJOfe1J7QyFLOVUHtMmwGhnTlJwWPddDUH";
    // const app_id  =  "EuMZVJoegRlTeOYzRY6pSGIwIIyAPpoB7yfOrzCV";
    
    // for calling the rest api we need rest key, this also we will get it from nack4app dashboard..
    
    const rest_key = "Pypvjr7ibCGkpFoNn6RiNOURoqtNWTJbGbe7l4hU";
    //const rest_key = "v0alAvD3MBUhJy8ceaV0nWaFMHJEdjaA7II7W9Wl";
    // masker key which used performing all admin kind operation..Masterkey will get in back4pp dashboard..
    
    const master_key = "xLUhiTtgwR1cFkzvaNbJIxtV73zkLhzQUio1v0Ly";
    //const master_key = "S0Q2QRG6MVZGZfDOWDr59cMYKIR8IE7pgd6lOGMm";
    
    public static function parseInetialization(){   
        //Inetialze the Parseclient for processing the request..
        session_start();
        ParseClient::initialize(self::app_id, self::rest_key, self::master_key );
        ParseClient::setServerURL('https://parseapi.back4app.com/',"/");
    }
}



