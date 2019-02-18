<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>ZGMRAS | Create Project</title>
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
    <!-- partial:../../partials/_navbar.html -->
    <?php include_once("navbar.php") ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      <?php include_once("sidebar.php") ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
             <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h2>Create Project</h2>
                      
                      <form class="forms-sample">
                            <div id="projectStatus" class="d-none"></div>
                            <div class="form-group row">
                                <label for="inputProejctName" class="col-sm-3 col-form-label">Project Name</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="projectName" placeholder="Enter Project Name">
                                  <span class="text-danger d-none" id="projectNameError"></span>
                                </div>                       
                            </div>
                            <div class="form-group row">
                              <label for="inputContactName" class="col-sm-3 col-form-label">Contact Number</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" id="contactNumber" placeholder="Enter Contact Number">
                                <span class="text-danger d-none" id="contactNumberError"></span>
                              </div>
                            </div>
                            
                            <div class="form-group row">
                              <label for="days" class="col-sm-3 col-form-label">Days</label>
                              <div class="col-sm-9">
                                <select class="form-control" name="days" id="days">
                                    <option value="">Select Days</option>
                                    <?php for($i=1;$i<=7;$i++){?>
                                        <option value="<?=$i;?>"><?=$i;?></option>
                                    <?php } ?>
                                </select>
                                <span class="text-danger d-none" id="daysError"></span>
                              </div>
                            </div>
                            <div class="form-group row">
                                <label for="timings" class="col-sm-3 col-form-label">Timings</label>
                                <div class="col-sm-9"> 
                                  <select class="form-control" name="timings" id="timings">
                                      <option value="">Select Timings</option>
                                      <?php for($i=1;$i<=24;$i++){?>
                                          <option value="<?=$i;?>"><?=$i;?></option>
                                      <?php } ?>
                                  </select>
                                  <span class="text-danger d-none" id="timingsError"></span>
                                </div>
                            </div>
                          <div class="form-group row">
                                <label for="levels" class="col-sm-3 col-form-label">Levels</label>
                                <div class="col-sm-9"> 
                                    <select class="form-control" name="levels" id="levels">
                                        <option value="">Select Levels</option>
                                        <?php for($i=4;$i<=6;$i++){?>
                                            <option value="<?=$i;?>"><?=$i;?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="text-danger d-none" id="levelsError"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputLocation" class="col-sm-3 col-form-label">Location</label>
                                <div class="col-sm-9">
                                    <textarea id="location" placeholder="Enter Location" class="form-control" ></textarea>
                                    <span class="text-danger d-none" id="locationError"></span>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success mr-2" id="createProject">Create <i id="createProject-FA"></i></button>
                            <a href="projectlist" class="btn btn-light">Cancel</a>
                            
                      </form>
                    </div>
                  </div>
                </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <?php include_once("footer.php") ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <script src="js/common.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>
<script type="text/javascript">
    $("#createProject").click(function(){
        $("#createProject-FA").addClass("fa fa-spinner fa-spin");
        var requiredValue = ['projectName','contactNumber','location','days','timings','levels'];
        var postValue = {};
        if(checkRequeredValue(requiredValue)){
            if($.isNumeric($("#contactNumber").val())){
                $.each(requiredValue,function(i,value){
                        postValue[value] = $("#"+value).val();
                });
                postValue['projectId'] = "";
                $.post("call/createorupdateproject",{postValue:postValue},function(result){
                    var resultData = $.parseJSON(result);
                    $("#projectStatus").html(resultData.message);
                    $("#projectStatus").removeClass("d-none").addClass((resultData.status)?"alert alert-success":"alert alert-danger");       
                    $("#createProject-FA").removeClass("fa fa-spinner fa-spin");
                });
            }else{
                $("#contactNumberError").html("Enter only numeric value");
                $("#contactNumberError").removeClass("d-none");
                $("#createProject-FA").removeClass("fa fa-spinner fa-spin");
            }
        }else{
            $("#createProject-FA").removeClass("fa fa-spinner fa-spin");
        }
    });
</script>