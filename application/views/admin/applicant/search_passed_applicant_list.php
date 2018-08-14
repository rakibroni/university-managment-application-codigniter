<?php if (!empty($applicant)): ?>
    <table class="table table-striped table-bordered table-hover gridTable">
        <thead>
            <tr>
                <th>SN</th>
                <th>Roll</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Mobile No</th>
                <th>Email</th>
                <th>Session</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    $sn = 1;
                    foreach ($applicant as $row):
                        ?>
                        <tr class="gradeX" id="row_<?php echo $row->APPLICANT_ID; ?>" >
                            <td>
                                <?php echo $sn++; ?>                                                        
                            </td>
                            <td><?php echo $row->ROLL_NO ?></td>
                            <td>
                                <div class="feed-element">

                                    <div class="media-body ">
                                        <a  class="applicant_details" type="button"
                                            data-user-id="<?php echo $row->APPLICANT_ID ?>" data-toggle="modal"
                                            data-target="#applicant_modal">
                                            <?php $stud_photo=($row->STUD_PHOTO != '')?'upload/applicant_photo/'.$row->STUD_PHOTO :'assets/img/default.png' ?>
                                            <img class="img-circle" src="<?php echo base_url($stud_photo); ?>" alt="image">
                                            <?php echo $row->FULL_NAME_EN?></a>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo $row->LKP_NAME; ?></td>
                            <td><?php echo $row->MOBILE_NO; ?></td>
                            <td> <a href="#"><span class='text-primary'><i class='fa fa-envelope-o'></i></span>&nbsp; <?php echo $row->EMAIL_ADRESS; ?></a></td>
                            <td> <?php echo $row->SESSION_NAME; ?></td>
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
                <th>Session</th>
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
<script>
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