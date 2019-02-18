<?php require_once 'header.php';?>
      <div class="main-panel">
        <div class="content-wrapper">
            <div id="deleteStatus" class="d-none"></div>
            <div class=" grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h2>Invoice List</h2>
                  <span class="pull-right"><a href="createinvoice" class="btn btn-primary text-uppercase">Create Invoice</a></span>
                  <div class="table-responsive pt-4">
                      <?php if($allInvoice != false){ ?>
                            <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice Number</th>
                                    <th>Customer Name</th>                                                                
                                    <th>Country</th>
                                    <th>Created By</th>
                                    <th>Created Date</th> 
                                    <th>PDF Link</th>
                                    <th></th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $c= 0;for($i=0;$i<count($allInvoice);$i++){ $invoiceId =$allInvoice[$i]->getObjectId(); ?>
                                    <tr id="row_<?=$invoiceId;?>">
                                        <td><?=++$c;?></td>
                                        <td><?= sprintf('%06d',$allInvoice[$i]->number);?></td>
                                        <td><?=($allInvoice[$i]->customer != "")?ucwords($allInvoice[$i]->customer->name):"-";?></td>                                  
                                        <td><?=($allInvoice[$i]->country != "")?ucwords($allInvoice[$i]->country->name):"-";?></td>  
                                        <td><?=($allInvoice[$i]->createdBy != "")?ucwords($allInvoice[$i]->createdBy->firstName." ".$allInvoice[$i]->createdBy->lastName):"-";?></td>                                       
                                        <td><?=$allInvoice[$i]->getCreatedAt()->format("d- M- Y");?></td> 
                                        <td><?=($allInvoice[$i]->pdfLink != "")?'<a href="'.$allInvoice[$i]->pdfLink.'" class="btn btn-success" target="_blank"><i class="fa fa-download" ></i></a>':"-";?></td>
                                        <td><button class="btn btn-danger delete" type="button" id="<?=$invoiceId;?>"><i class="fa fa-trash-o" id="FA_<?=$invoiceId?>" ></i></button></td>             
                                    </tr>
                                <?php } ?>
                                      
                            </tbody>
                        </table>
                        
                        <?php } else{?>
                        <div class="alert alert-danger"><p>No Invoice(s) are available.</p></div>
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
        postValue['type'] = 2;
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