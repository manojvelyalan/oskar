<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Oskar | Login</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="vendors/iconfonts/font-awesome/css/font-awesome.min.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>

 <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth  theme-one">
        <div class="row w-100">
          <div class="col-lg-10 mx-auto">
              <h2 class="text-center mb-4"> <img src="images/logo.png" alt="logo" /></h2>
          </div>
             <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper">
              <form action="#">
                  <div class="alert alert-danger d-none" id="loginError"></div>
                <div class="form-group">
                  <label class="label">Email</label>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Email" id="email">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>

                  </div>
                   <div class="text-danger d-none" id="emailError"></div>
                </div>
                <div class="form-group">
                  <label class="label">Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control" placeholder="*********" id="password">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                  <div class="text-danger d-none" id="passwordError"></div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary submit-btn btn-block" id="login" type="button">Login <i id="login-FA" ></i></button>
                </div>
                <!--<div class="form-group d-flex justify-content-between">
                  <a href="#" class="text-small forgot-password text-black">Forgot Password</a>
                </div>  -->
              </form>
            </div>
          </div>
        </div>
          
      </div>
        
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
    
  </div>

  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <script src="js/common.js"></script>
  <!-- endinject -->
</body>

</html>
<script type="text/javascript">
    $("#login").click(function(){
        $("#login-FA").addClass("fa fa-spinner fa-spin");
        var status = false;
        var requiredValue = [];
        requiredValue.push('email','password');
        status = checkRequeredValue(requiredValue);
        var postValue = {};
        if(status){
             if(checkEmail($('#email').val())){
                 if(checkPasswordLength($('#password').val())){
                    $.each(requiredValue,function(i,value){
                        postValue[value] = $("#"+value).val();
                    });

                    $.post("call/signup.php",{postValue:postValue},function(result){
                        var resultData = $.parseJSON(result);
                        if(resultData.status){
                            window.location.href = "listallcustomer";
                        }else{

                            $("#loginError").html(resultData.message)
                            $("#loginError").removeClass("d-none");
                            $("#login-FA").addClass("d-none");
                        }
                    });
                 }else{
                     $("#passwordError").html("Minimum password length should be 8 character");
                    $("#passwordError").removeClass("d-none");
                    $("#login-FA").removeClass("fa fa-spinner fa-spin");
                 }
             }else{
                $("#emailError").html("Please enter proper email format");
                $("#emailError").removeClass("d-none");
                $("#login-FA").removeClass("fa fa-spinner fa-spin");
             }
        }else{
            $("#login-FA").removeClass("fa fa-spinner fa-spin");
        }
    });
</script>
