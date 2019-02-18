<?php require_once 'header.php';?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
             <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h2>Create Customer</h2>
                      
                      <form class="forms-sample">
                            <div id="createStatus" class="d-none"></div>
                            <div class="form-group row">
                                <label for="inputCustomerCode" class="col-sm-3 col-form-label">Customer Code</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="customerCode" placeholder="Enter Customer Code">
                                  <span class="text-danger d-none" id="customerCodeError"></span>
                                </div>                       
                            </div>
                            <div class="form-group row">
                              <label for="inputFullName" class="col-sm-3 col-form-label">Full Name</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" id="fullName" placeholder="Enter Full Name">
                                <span class="text-danger d-none" id="fullNameError"></span>
                              </div>
                            </div>
                                                     
                            <div class="form-group row">
                                <label for="inputMobile" class="col-sm-3 col-form-label">Mobile</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="mobile" placeholder="Enter Mobile">
                                    <span class="text-danger d-none" id="mobileError"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputTRN" class="col-sm-3 col-form-label">TRN Number</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="trn" placeholder="Enter TRN Number">
                                    <span class="text-danger d-none" id="trnError"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputGroup" class="col-sm-3 col-form-label">Group</label>
                                <div class="col-sm-9">
                                    <select name="group" id="group" class="form-control">
                                        <option value="">Select Group</option>
                                        <?php for($i=0;$i<count($groups);$i++){?>
                                        <option value="<?=$groups[$i]->getObjectId();?>"><?=$groups[$i]->name ;?></option>
                                        <?php  } ?>
                                    </select>
                                    <span class="text-danger d-none" id="groupError"></span>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success mr-2" id="createCustomer">Create <i id="createCustomer-FA"></i></button>
                            <a href="listallcustomer" class="btn btn-light">Cancel</a>
                            
                      </form>
                    </div>
                  </div>
                </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <?php include_once("footer.php") ?>
       <script src="js/common.js"></script>
<script type="text/javascript">
    $("#createCustomer").click(function(){
        $("#createCustomer-FA").addClass("fa fa-spinner fa-spin");
        var requiredValue = ['customerCode','fullName','mobile','trn','group'];
        var postValue = {};
        if(checkRequeredValue(requiredValue)){
            if($.isNumeric($("#mobile").val())){
                $.each(requiredValue,function(i,value){
                        postValue[value] = $("#"+value).val();
                });
                postValue['customerId'] = "";
                $.post("call/createcustomer",{postValue:postValue},function(result){
                    var resultData = $.parseJSON(result);
                    $("#createStatus").html(resultData.message);
                    $("#createStatus").removeClass("d-none").addClass((resultData.status)?"alert alert-success":"alert alert-danger");       
                    $("#createCustomer-FA").removeClass("fa fa-spinner fa-spin");
                });
            }else{
                $("#mobileError").html("Enter only numeric value");
                $("#mobileError").removeClass("d-none");
                $("#createCustomer-FA").removeClass("fa fa-spinner fa-spin");
            }
        }else{
            $("#createCustomer-FA").removeClass("fa fa-spinner fa-spin");
        }
    });
</script>