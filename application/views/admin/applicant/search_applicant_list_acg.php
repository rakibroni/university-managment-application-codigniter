<?php if (!empty($applicant)): ?>
    <table class="table table-striped table-bordered table-hover gridTable">
        <thead>
            <tr>
                <th><input type="checkbox" id="checkAll"></th>
                <th>Roll</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Mobile No</th>
                <th>Email</th>
                <th>Session</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    $sn = 1;
                    foreach ($applicant as $row):
                        ?>
                        <tr class="gradeX" id="row_<?php echo $row->APPLICANT_ID; ?>" >
                            <td <?php echo ($row->ADMIT_CARD_GENERATED == 0) ? "" : "class='inactive'"; ?>>
                                <?php if($row->ADMIT_CARD_GENERATED == 0): ?>
                                    <input type="checkbox" class="form-control required check" name="chkApplicant[]" value="<?php echo $row->APPLICANT_ID; ?>"/>
                                <?php endif; ?>
                                </td>
                            <td <?php echo ($row->ADMIT_CARD_GENERATED == 0) ? "" : "class='inactive'"; ?>><?php echo $row->ROLL_NO ?></td>
                            <td <?php echo ($row->ADMIT_CARD_GENERATED == 0) ? "" : "class='inactive'"; ?>> 
                                <div class="feed-element">
                                    <a class="pull-left" href="#">
                                        <img class="img-circle" src="<?php echo base_url().'upload/applicant_photo/'.$row->STUD_PHOTO; ?>" alt="image">
                                    </a>
                                    <div class="media-body ">
                                    <a href="#"><?php echo $row->FULL_NAME_EN?></a>
                                    </div>
                                </div>
                            </td>
                            <td <?php echo ($row->ADMIT_CARD_GENERATED == 0) ? "" : "class='inactive'"; ?>><?php echo $row->LKP_NAME; ?></td>
                            <td <?php echo ($row->ADMIT_CARD_GENERATED == 0) ? "" : "class='inactive'"; ?>><?php echo $row->MOBILE_NO; ?></td>
                            <td <?php echo ($row->ADMIT_CARD_GENERATED == 0) ? "" : "class='inactive'"; ?>><a href="#"><span class='text-primary'><i class='fa fa-envelope-o'></i></span>&nbsp; <?php echo $row->EMAIL_ADRESS; ?></a></td>
                            <td <?php echo ($row->ADMIT_CARD_GENERATED == 0) ? "" : "class='inactive'"; ?>> <?php echo $row->SESSION_NAME; ?></td>
                            <td <?php echo ($row->ADMIT_CARD_GENERATED == 0) ? "" : "class='inactive'"; ?>>
                                <?php if($row->ADMIT_CARD_GENERATED == 0): ?>
                                    <a class="label label-primary applicantApprove" data-applicant="<?php echo $row->APPLICANT_ID; ?>" title="Click For Approved">Approve</a>
                                    <span class="approvedSuccess_<?php echo $row->APPLICANT_ID; ?>"></span>
                                <?php endif; ?>
                                
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
                <th>Session</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
<?php else: ?>
    <h3 class="text-danger text-center ">No data found !!</h3>
<?php endif; ?>

<script type="text/javascript">
    $("#checkAll").click(function () {
        $(".check").prop('checked', $(this).prop('checked'));
    });
</script>