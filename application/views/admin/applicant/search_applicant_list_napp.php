<?php if (!empty($applicant)): ?>
    <table class="table table-striped table-bordered table-hover gridTable">
        <thead>
            <tr>
                <th><input type="checkbox" id="scheckAll"></th>
                <th>Roll</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Mobile No</th>
                <th>Email</th>
                <th></th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="approveApplicant">
                <?php
                    $sn = 1;
                    foreach ($applicant as $row):
                        ?>
                        <tr class="gradeX" id="row_<?php echo $row->APPLICANT_ID; ?>">
                            <td><input type="checkbox" class="form-control required check" name="chkApplicant[]" value="<?php echo $row->APPLICANT_ID; ?>"/></td>
                            <td><?php echo $row->ROLL_NO ?></td>
                            <td>
                                <div class="feed-element">
                                    <a class="pull-left applicant_details"    type="button"
                                       data-user-id="<?php echo $row->APPLICANT_ID ?>" data-toggle="modal"
                                       data-target="#applicant_modal">
                                        <img class="img-circle" src="<?php echo base_url().'upload/applicant_photo/'.$row->STUD_PHOTO; ?>" alt="image">
                                        <?php echo $row->FULL_NAME_EN?>
                                    </a>

                                </div>
                            </td>
                            <td><?php echo $row->LKP_NAME; ?></td>
                            <td><?php echo $row->MOBILE_NO; ?></td>
                            <td><a href="#"><span class='text-primary'><i class='fa fa-envelope-o'></i></span>&nbsp; <?php echo $row->EMAIL_ADRESS; ?></a></td>
                            <td> <?php echo $row->PROGRAM_NAME."<br><i>".$row->SESSION_NAME."</i>"; ?></td>
                            <td>
                                <a class="label label-primary applicantApprove" data-applicant="<?php echo $row->APPLICANT_ID; ?>" title="Click For Approved">Approve</a>|| <a class="label label-danger applicantReject" data-applicant="<?php echo $row->APPLICANT_ID; ?>" title="Click For Reject">Reject</a>
                                <span class="approvedSuccess_<?php echo $row->APPLICANT_ID; ?>"></span>                                
                            </td>
                        </tr>
                    <?php
                    endforeach;
                ?>
            </tbody>
            <tfoot>
            <tr>
                <th>SN</th>
                <th>Roll</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Mobile No</th>
                <th>Email</th>
                <th></th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>

<?php else: ?>
    <h3 class="text-danger text-center ">No data found !!</h3>
<?php endif; ?>

<div class="modal inmodal fade" id="applicant_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Applicant Details</h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#scheckAll").click(function () {
        $(".check").prop('checked', $(this).prop('checked'));
    });
    $(".applicant_details").on("click", function () {
        var applicant_id = $(this).attr('data-user-id');

        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>admin/applicantModal',
            data: {applicant_id: applicant_id},
            success: function (data) {
                $("#applicant_modal .modal-body").html(data);
            }
        });
    });
</script>