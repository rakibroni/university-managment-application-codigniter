<div class="ibox float-e-margins">
    <div class="ibox-title">
        <div class="col-md-9"><b>Member Application</b></div>
    </div>    
    <form id="resident_application_form" class="form-horizontal" action="<?php echo site_url(); ?>/student/libraryMemberApplicationSave" method="post" enctype="multipart/form-data">
        <div class="ibox-content">
    
            <div class="form-group">
             
                <div class="col-lg-12"> 
               <?php 
                   $memberCheck=$member[0]->ACTIVE_STATUS;
                   if($memberCheck==1){ ?>

                      <h2 style="text-align: center;"> Your library member  application send .  Please  Wait for Approve . </h2>
                   <?php } else{ ?>
                      <h2 style="text-align: center;"> Already library member .  </h2>
                   <?php } ?>

                                   
                </div>
            </div>
   
  
        <div class="clearfix"></div>

    </form>

</div>  
</div>  
