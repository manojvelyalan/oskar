function checkRequeredValue(requiredValue){
    var status = true;
    for(i=0;i<requiredValue.length;i++){        
        if( $("#"+requiredValue[i]).val() === ""){
            $("#"+requiredValue[i]+"Error").html("Please enter the value.");  
            $("#"+requiredValue[i]+"Error").removeClass("d-none");
            $("#"+requiredValue[i]).focus();
            status = false;
            break;
        }else{
            $("#"+requiredValue[i]+"Error").removeClass("d-none").addClass("d-none");
        } 
    }
    return status;
}
function checkEmail(email){
     var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
    if (filter.test(email)) {
        return true;
    }else {
        return false;
    }
}
function checkPasswordLength(password){
    if(password.length >= 8){
        return true;
    }else{
        return false;
    }
}

