     <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Libary Borrow Item List  </h5> </br>

 
      

            <div class="ibox-tools">
                    
            </div>

        </div>


        <div class="ibox-content">
            <div id="printArea" class="table-responsive contentArea">
                       <p>Note:&nbsp;&nbsp;&nbsp;<span style="height: 15px; width: 15px; background-color: #F8D7DA;
            border-radius: 50%;display: inline-block;"></span> one day Remain &nbsp;&nbsp;&nbsp;
            <span style="height: 15px; width: 15px; background-color: #FFBCBC;
            border-radius: 50%;display: inline-block;"></span> Last day  &nbsp;&nbsp;&nbsp;
            <span style="height: 15px; width: 15px; background-color: #FFA3AB;
            border-radius: 50%;display: inline-block;"></span> Date over
              &nbsp;&nbsp;&nbsp;
            <span style="height: 15px; width: 15px; background-color: #7BDB91;
            border-radius: 50%;display: inline-block;"></span> More than one day remain</p>

            <table class="table table-striped table-bordered table-hover gridTable">
                <thead>
                    <tr>
                        <th>ISBN NO</th>
                        <th>ITEM NAME</th>
                        <th>STUDENT NAME</th>
                        <th>STUDENT MOBILE</th>
                        <th>RETURN DATE</th>
                        <th>DATE REMAIN</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                   
                <?php foreach ($libray_all_borrow_item as $row) { ?>
                    <?php // var_dump($row); 

                             $currentdates=date('Y-m-d');
                             $currentdatess = date_create($currentdates); 
                             $returnDate = date_create($row->RETURN_DT);                             
                             $diff=date_diff($currentdatess , $returnDate);
                             $dateDifference = $diff->format("%R%a"); 
                             //echo "<script> alert($dateDifference);</script>";
                            
                            //echo $dateDifference;

                             if($dateDifference > 1){


                             ?>


                       <tr style="background-color: #7BDB91;" class="gradeX" id="row_<?php echo $row->BORROWER_ID; ?>" >
                            <td>
                                <?php echo $row->STOCK_ID; ?>
                            </td>
                        <td>
                            <a class="pull-left applicant_details" type="button"
                            data-user-id="<?php echo $row->BORROWER_ID ?>" data-toggle="modal"
                            data-target="#applicant_moda">
                            <?php echo $row->ITEM_NAME; ?>

                            </a>
                        </td>
                        <td >
                            <a class="pull-left applicant_details"    type="button"
                            data-user-id="<?php echo $row->BORROWER_ID ?>" data-toggle="modal"
                            data-target="#applicant_moda">  
                            <?php echo $row->FULL_NAME_EN; ?>
          
                            </a>
                        </td>
                        <td>
                            <a class="pull-left applicant_details"    type="button"
                            data-user-id="<?php echo $row->BORROWER_ID ?>" data-toggle="modal"
                            data-target="#applicant_moda">  
                            <?php echo $row->MOBILE_NO; ?>
          
                            </a>
                        </td>

                        <td>
                            <a class="pull-left applicant_details"    type="button"
                            data-user-id="<?php echo $row->BORROWER_ID ?>" data-toggle="modal"
                            data-target="#applicant_moda">  
                     
                            <?php  $t = strtotime($row->RETURN_DT); 
                                $START_DT = date('d/m/y',$t);  echo $START_DT; ?>
          
                            </a>
                        </td>



                        <td>
                            <a class="pull-left applicant_details"    type="button"
                            data-user-id="<?php echo $row->BORROWER_ID ?>" data-toggle="modal"
                            data-target="#applicant_moda">  
                     
                            <?php 

                             $currentdates=date('Y-m-d');
                             $currentdatess = date_create($currentdates); 
                             $returnDate = date_create($row->RETURN_DT);                             
                             $diff=date_diff($currentdatess , $returnDate);
                             echo $diff->format("%R%a"); 

                               ?>
          
                            </a>
                        </td>



                        <td >        
                          <a class="label label-default" data-type="edit" href="<?php echo site_url()?>/library/libraryItemBorrowUpdate/<?php echo $row->BORROWER_ID; ?>" ><i class="fa fa-pencil"></i>
                          </a>

                   

                        </td>
                
                    </tr>

                    <?php } 
                             
                        if($dateDifference < 0){

                        ?>


                       <tr style="background-color: #FFA3AB;" class="gradeX" id="row_<?php echo $row->BORROWER_ID; ?>">
                            <td>
                                <?php echo $row->STOCK_ID; ?>
                            </td>
                        <td>
                            <a class="pull-left applicant_details" type="button"
                            data-user-id="<?php echo $row->BORROWER_ID ?>" data-toggle="modal"
                            data-target="#applicant_moda">
                            <?php echo $row->ITEM_NAME; ?>

                            </a>
                        </td>
                        <td >
                            <a class="pull-left applicant_details"    type="button"
                            data-user-id="<?php echo $row->BORROWER_ID ?>" data-toggle="modal"
                            data-target="#applicant_moda">  
                            <?php echo $row->FULL_NAME_EN; ?>
          
                            </a>
                        </td>
                        <td>
                            <a class="pull-left applicant_details"    type="button"
                            data-user-id="<?php echo $row->BORROWER_ID ?>" data-toggle="modal"
                            data-target="#applicant_moda">  
                            <?php echo $row->MOBILE_NO; ?>
          
                            </a>
                        </td>

                        <td>
                            <a class="pull-left applicant_details"    type="button"
                            data-user-id="<?php echo $row->BORROWER_ID ?>" data-toggle="modal"
                            data-target="#applicant_moda">  
                     
                            <?php  $t = strtotime($row->RETURN_DT); 
                                $START_DT = date('d/m/y',$t);  echo $START_DT; ?>
          
                            </a>
                        </td>



                        <td>
                            <a class="pull-left applicant_details"    type="button"
                            data-user-id="<?php echo $row->BORROWER_ID ?>" data-toggle="modal"
                            data-target="#applicant_moda">  
                     
                            <?php 

                             $currentdates=date('Y-m-d');
                             $currentdatess = date_create($currentdates); 
                             $returnDate = date_create($row->RETURN_DT);                             
                             $diff=date_diff($currentdatess , $returnDate);
                             echo $diff->format("%R%a"); 

                               ?>
          
                            </a>
                        </td>



                        <td >        
                          <a class="label label-default" data-type="edit" href="<?php echo site_url()?>/library/libraryItemBorrowUpdate/<?php echo $row->BORROWER_ID; ?>" ><i class="fa fa-pencil"></i>
                          </a>

                   

                        </td>
                
                    </tr>

                    <?php } ?>

                        <?php  
                             
                        if($dateDifference == 0){

                        ?>

                       <tr style="background-color: #FFBCBC;" class="gradeX" id="row_<?php echo $row->BORROWER_ID; ?>">
                            <td>
                                <?php echo $row->STOCK_ID; ?>
                            </td>
                        <td>
                            <a class="pull-left applicant_details" type="button"
                            data-user-id="<?php echo $row->BORROWER_ID ?>" data-toggle="modal"
                            data-target="#applicant_moda">
                            <?php echo $row->ITEM_NAME; ?>

                            </a>
                        </td>
                        <td >
                            <a class="pull-left applicant_details"    type="button"
                            data-user-id="<?php echo $row->BORROWER_ID ?>" data-toggle="modal"
                            data-target="#applicant_moda">  
                            <?php echo $row->FULL_NAME_EN; ?>
          
                            </a>
                        </td>
                        <td>
                            <a class="pull-left applicant_details"    type="button"
                            data-user-id="<?php echo $row->BORROWER_ID ?>" data-toggle="modal"
                            data-target="#applicant_moda">  
                            <?php echo $row->MOBILE_NO; ?>
          
                            </a>
                        </td>

                        <td>
                            <a class="pull-left applicant_details"    type="button"
                            data-user-id="<?php echo $row->BORROWER_ID ?>" data-toggle="modal"
                            data-target="#applicant_moda">  
                     
                            <?php  $t = strtotime($row->RETURN_DT); 
                                $START_DT = date('d/m/y',$t);  echo $START_DT; ?>
          
                            </a>
                        </td>



                        <td>
                            <a class="pull-left applicant_details"    type="button"
                            data-user-id="<?php echo $row->BORROWER_ID ?>" data-toggle="modal"
                            data-target="#applicant_moda">  
                     
                            <?php 

                             $currentdates=date('Y-m-d');
                             $currentdatess = date_create($currentdates); 
                             $returnDate = date_create($row->RETURN_DT);                             
                             $diff=date_diff($currentdatess , $returnDate);
                             echo $diff->format("%R%a"); 

                               ?>
          
                            </a>
                        </td>



                        <td >        
                          <a class="label label-default" data-type="edit" href="<?php echo site_url()?>/library/libraryItemBorrowUpdate/<?php echo $row->BORROWER_ID; ?>" ><i class="fa fa-pencil"></i>
                          </a>

                   

                        </td>
                
                    </tr>

                    <?php } ?>




                    <?php  
                             
                        if($dateDifference == 1){

                        ?>


                       <tr style="background-color: #F8D7DA;" class="gradeX" id="row_<?php echo $row->BORROWER_ID; ?>">
                            <td>
                                <?php echo $row->STOCK_ID; ?>
                            </td>
                        <td>
                            <a class="pull-left applicant_details" type="button"
                            data-user-id="<?php echo $row->BORROWER_ID ?>" data-toggle="modal"
                            data-target="#applicant_moda">
                            <?php echo $row->ITEM_NAME; ?>

                            </a>
                        </td>
                        <td >
                            <a class="pull-left applicant_details"    type="button"
                            data-user-id="<?php echo $row->BORROWER_ID ?>" data-toggle="modal"
                            data-target="#applicant_moda">  
                            <?php echo $row->FULL_NAME_EN; ?>
          
                            </a>
                        </td>
                        <td>
                            <a class="pull-left applicant_details"    type="button"
                            data-user-id="<?php echo $row->BORROWER_ID ?>" data-toggle="modal"
                            data-target="#applicant_moda">  
                            <?php echo $row->MOBILE_NO; ?>
          
                            </a>
                        </td>

                        <td>
                            <a class="pull-left applicant_details"    type="button"
                            data-user-id="<?php echo $row->BORROWER_ID ?>" data-toggle="modal"
                            data-target="#applicant_moda">  
                     
                            <?php  $t = strtotime($row->RETURN_DT); 
                                $START_DT = date('d/m/y',$t);  echo $START_DT; ?>
          
                            </a>
                        </td>



                        <td>
                            <a class="pull-left applicant_details"    type="button"
                            data-user-id="<?php echo $row->BORROWER_ID ?>" data-toggle="modal"
                            data-target="#applicant_moda">  
                     
                            <?php 

                             $currentdates=date('Y-m-d');
                             $currentdatess = date_create($currentdates); 
                             $returnDate = date_create($row->RETURN_DT);                             
                             $diff=date_diff($currentdatess , $returnDate);
                             echo $diff->format("%R%a"); 

                               ?>
          
                            </a>
                        </td>



                        <td >        
                          <a class="label label-default" data-type="edit" href="<?php echo site_url()?>/library/libraryItemBorrowUpdate/<?php echo $row->BORROWER_ID; ?>" ><i class="fa fa-pencil"></i>
                          </a>

                   

                        </td>
                
                    </tr>

                    <?php } ?>





                <?php } ?>


                </tbody>
                <tfoot>
                  <tr>
                    <th>ISBN NO</th>
                    <th>ITEM NAME</th>
                    <th>STUDENT NAME</th>
                    <th>STUDENT MOBILE</th>
                    <th>RETURN DATE</th>
                    <th>DATE REMAIN</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                </table>
                        
                <div class="modal inmodal fade" id="applicant_moda" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close </span>
                                </button>
                                <h4 class="modal-title"> ITEM BORROW DETAILS  </h4>
                            </div>
                            <div class="modal-body"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal">Close </button>
                            </div>
                        </div>
                    </div>
                </div>

                <script type="text/javascript">
                    $(".applicant_details").on("click", function () {
                        var itemUniqueId = $(this).attr('data-user-id');


                        $.ajax({
                            type: 'post',
                            url: '<?php echo site_url()?>/library/libraryBorrowModel',
                            data: {itemUniqueId: itemUniqueId},
                            success: function (data) {

                                $("#applicant_moda .modal-body").html(data);
                            }
                        });
                    });
                </script> 

            </div>
        </div>
    </div>
