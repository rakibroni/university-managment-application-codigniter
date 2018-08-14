    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Libary Member List </h5>

            <div class="ibox-tools">
                    
            </div>

        </div>

        <div class="ibox-content">
            <div id="printArea" class="table-responsive contentArea">
            <table class="table table-striped table-bordered table-hover gridTable">
                <thead>
                    <tr>
                        <th>FULL NAME</th>
                        <th>MEMBER TYPE</th>
                        <th>REMARKS</th>
                        <th>STATUS</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($libray_member)): ?>
                        <?php $sn = 1; ?>
                        <?php foreach ($libray_member as $row) { ?>
                            <?php //var_dump($row); ?>

                    <tr class="gradeX" id="row_<?php echo $row->MEBBER_ID; ?>">
                            <td <?php echo ($row->ACTIVE_STATUS == 0) ? "" : "class='inactive'"; ?>>
                                <?php echo $row->FULL_NAME_EN; ?>
                            </td>

                        <td <?php echo ($row->ACTIVE_STATUS == 0) ? "" : "class='inactive'"; ?>>

                                <a class="pull-left applicant_modal_member"    type="button"
                                data-user-id="<?php echo $row->MEBBER_ID ?>" data-toggle="modal"
                                data-target="#applicant_modal_member">

                                    <?php $member_type= $row->MEMBER_TYPE; 
                                 
                                       if ($member_type=='s') {
                                       echo "Student";
                                    }
                                    else{
                                        
                                        echo "Teacher";
                                    }
                                  
                                     ?>

                            </a>
                        </td>

                        <td <?php echo ($row->ACTIVE_STATUS == 0) ? "" : "class='inactive'"; ?>>

                            <a class="pull-left applicant_details"    type="button"
                            data-user-id="<?php echo $row->MEBBER_ID ?>" data-toggle="modal"
                            data-target="#applicant_modal_member">
                            <?php echo $row->REMARKS; ?>

                            </a>
                        </td>

                        <td <?php echo ($row->ACTIVE_STATUS == 0) ? "" : "class='inactive'"; ?>>
                            <a class="pull-left applicant_details"    type="button"
                            data-user-id="<?php echo $row->MEBBER_ID ?>" data-toggle="modal"
                            data-target="#applicant_modal_member">
                            <?php $member_status= $row->ACTIVE_STATUS; 
                                    if ($member_status==1) {
                                       echo "Waiting for Approve";
                                    }
                                    else{
   
                                        echo "Memeber";
                                    }

                            ?>
                            </a>
                        </td>

                        <td <?php echo ($row->ACTIVE_STATUS == 0) ? "" : "class='inactive'"; ?>>
         
                          <a class="label label-danger" data-type="edit" href="<?php echo site_url()?>/library/libraryMemberUpdate/<?php echo $row->MEBBER_ID; ?>" ><i class="fa fa-pencil"></i>
                          </a>

                            <a class="label label-default" data-type="edit" href="<?php echo site_url()?>/library/libraryMemberPrint/<?php echo $row->MEBBER_ID; ?>" ><i class="fa fa-print"></i>
                          </a>


                        </td>
                
                    </tr>
                            <?php } ?>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                        <th>FULL NAME</th>
                        <th>MEMBER TYPE</th>
                        <th>REMARKS</th>
                        <th>STATUS</th>
                        <th>Action</th>

                        </tr>
                    </tfoot>
                </table>
                        
                <div class="modal inmodal fade" id="applicant_modal_member" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                <h4 class="modal-title">Library Member Details</h4>
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
                        var MEBBER_ID = $(this).attr('data-user-id');


                        $.ajax({
                            type: 'post',
                            url: '<?php echo site_url()?>/library/libraryMemberModel',
                            data: {MEBBER_ID: MEBBER_ID},
                            success: function (data) {
                                $("#applicant_modal_member .modal-body").html(data);
                            }
                        });
                    });
                </script> 

            </div>
        </div>
    </div>
