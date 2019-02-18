<?php require_once 'header.php';?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
             <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h2>Create Invoice</h2>
                      
                      <form class="forms-sample">
                            <div id="createStatus" class="d-none"></div>
                            <div class="form-group row">
                                <label for="inputCustomer" class="col-sm-3 col-form-label">Customer</label>
                                <div class="col-sm-9">
                                    <select name="customer" id="customer" class="form-control">
                                        <option value="">Select Customer</option>
                                        <?php for($i=0;$i<count($customers);$i++){?>
                                        <option value="<?=$customers[$i]->getObjectId();?>"><?=$customers[$i]->name ;?></option>
                                        <?php  } ?>
                                    </select>
                                    <span class="text-danger d-none" id="customerError"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputCountry" class="col-sm-3 col-form-label">Country</label>
                                <div class="col-sm-9">
                                    <select name="country" id="country" class="form-control">
                                        <option value="">Select Country</option>
                                        <?php for($i=0;$i<count($country);$i++){?>
                                        <option value="<?=$country[$i]->getObjectId();?>"><?=$country[$i]->name ;?></option>
                                        <?php  } ?>
                                    </select>
                                    <span class="text-danger d-none" id="countryError"></span>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success mr-2" id="createCustomer">Create <i id="createCustomer-FA"></i></button>
                            <a href="invoicelist" class="btn btn-light">Cancel</a>
                            
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
        var requiredValue = ['customer','country'];
        $("#createStatus").removeClass("alert alert-success alert-danger").addClass("d-none");
        var postValue = {};
        if(checkRequeredValue(requiredValue)){
            $.each(requiredValue,function(i,value){
                        postValue[value] = $("#"+value).val();
                });
                postValue['invoiceId'] = "";
                $.post("call/createinvoice",{postValue:postValue},function(result){
                    var resultData = $.parseJSON(result);
                    $("#createStatus").html(resultData.message);
                    $("#createStatus").removeClass("d-none").addClass((resultData.status)?"alert alert-success":"alert alert-danger");       
                    $("#createCustomer-FA").removeClass("fa fa-spinner fa-spin");
                });
        }else{
            $("#createCustomer-FA").removeClass("fa fa-spinner fa-spin");
        }
    });
</script>