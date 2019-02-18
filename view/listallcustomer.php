<?php require_once 'header.php';?>
      <div class="main-panel">
        <div class="content-wrapper">
            <div id="deleteStatus" class="d-none"></div>
            <div class=" grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h2>Customer List</h2>
                  <span class="pull-right"><a href="createcustomer" class="btn btn-primary text-uppercase">Create Customer</a></span>
                  <div class="table-responsive pt-4">
                      <?php if($allCustomer != false){ ?>
                            <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer Code</th>
                                    <th>Name</th>                                                                
                                    <th>Phone</th>
                                    <th>TRN Number</th>
                                    <th>Group Name</th>
                                    <th>Area</th>
                                    <th>City</th>
                                    <th>Note</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $c= 0;for($i=0;$i<count($allCustomer);$i++){ $allCustomerId =$allCustomer[$i]->getObjectId(); ?>
                                    <tr id="row_<?=$allCustomerId;?>">
                                        <td><?=++$c;?></td>
                                        <td><?=$allCustomer[$i]->code;?></td>
                                        <td><?=($allCustomer[$i]->name != "")?$allCustomer[$i]->name:"-";?></td>                                  
                                        <td><?=($allCustomer[$i]->phone != "")?$allCustomer[$i]->phone:"-";?></td>  
                                        <td><?=($allCustomer[$i]->trnNumber != "")?$allCustomer[$i]->trnNumber:"-";?></td> 
                                        <td><?=($allCustomer[$i]->group->name != "")?$allCustomer[$i]->group->name:"-";?></td> 
                                        <td><?=($allCustomer[$i]->group->area != "")?$allCustomer[$i]->group->area:"-";?></td> 
                                          <td><?=($allCustomer[$i]->group->city->name != "")?$allCustomer[$i]->group->city->name:"-";?></td>
                                        <td><?=($allCustomer[$i]->note != "")?$allCustomer[$i]->note:"-";?></td>
                                        <td><?=$allCustomer[$i]->getCreatedAt()->format("d- M- Y");?></td> 
                                        <td><button class="btn btn-danger delete" type="button" id="<?=$allCustomerId;?>"><i class="fa fa-trash-o" id="FA_<?=$allCustomerId?>" ></i></button></td>             
                                    </tr>
                                <?php } ?>
                                      
                            </tbody>
                        </table>
                        
                        <?php } else{?>
                        <div class="alert alert-danger"><p>No Customers are available.</p></div>
                        <?php } ?>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <?php include_once("footer.php") ?>
        
<script type="text/javascript">
    $(".delete").click(function(){
        var idValue = $(this).attr("id");
        var postValue = {};
        $("#deleteStatus").removeClass("alert alert-danger").addClass("d-none");
        $("#FA_"+idValue).removeClass("fa-trash").addClass("fa-spinner fa-spin");
        postValue['id'] = idValue;
        postValue['type'] = 1;
        $.post("call/delete",{postValue:postValue},function(resultValue){
            var resultData = $.parseJSON(resultValue);
            $("#deleteStatus").html(resultData.message);
            if(resultData.status){
                $("#deleteStatus").removeClass("d-none").addClass("alert alert-success");
                $("#row_"+idValue).hide();             
            }else{
                $("#deleteStatus").removeClass("d-none").addClass("alert alert-danger");
                $("#FA_"+idValue).removeClass("fa-spinner fa-spin").addClass("fa-trash");
            }
        });
    });
</script>