<?php
    $sn = 1;
    foreach ($applicant as $row):
        ?>
        <tr class="gradeX" id="row_<?php echo $row->APPLICANT_ID; ?>" >
            <td <?php echo ($row->PASSED == 0) ? "" : "class='inactive'"; ?>>
                <span class="hidden" id="loader_<?php echo $row->APPLICANT_ID; ?>"></span>
                <?php if($row->PASSED == 0): ?>
                    <input type="checkbox" class="form-control required check" name="chkApplicant[]" value="<?php echo $row->APPLICANT_ID; ?>"/>
                <?php endif; ?>
                </td>
            <td <?php echo ($row->PASSED == 0) ? "" : "class='inactive'"; ?>><?php echo $row->ROLL_NO ?></td>
            <td <?php echo ($row->PASSED == 0) ? "" : "class='inactive'"; ?>> 
                <div class="feed-element">
                    <a class="pull-left" href="#">
                        <img class="img-circle" src="<?php echo base_url().'upload/applicant_photo/'.$row->STUD_PHOTO; ?>" alt="image">
                    </a>
                    <div class="media-body ">
                    <a href="#"><?php echo $row->FULL_NAME_EN?></a>
                    </div>
                </div>
            </td>
            <td <?php echo ($row->PASSED == 0) ? "" : "class='inactive'"; ?>><?php echo $row->LKP_NAME; ?></td>
            <td <?php echo ($row->PASSED == 0) ? "" : "class='inactive'"; ?>><?php echo $row->MOBILE_NO; ?></td>
            <td <?php echo ($row->PASSED == 0) ? "" : "class='inactive'"; ?>><a href="#"><span class='text-primary'><i class='fa fa-envelope-o'></i></span>&nbsp; <?php echo $row->EMAIL_ADRESS; ?></a></td>
            <td <?php echo ($row->PASSED == 0) ? "" : "class='inactive'"; ?>> <?php echo $row->PROGRAM_NAME."<br><i>".$row->SESSION_NAME."</i>"; ?></td>
            <td <?php echo ($row->PASSED == 0) ? "" : "class='inactive'"; ?>>
                <?php if($row->PASSED == 0): ?>
                    <a class="label label-primary applicantApprove" data-applicant="<?php echo $row->APPLICANT_ID; ?>" title="Click For Approved">Approve</a> || <a class="label label-danger applicantReject" data-applicant="<?php echo $row->APPLICANT_ID; ?>" title="Click For Reject">Reject</a>
                    <span class="approvedSuccess_<?php echo $row->APPLICANT_ID; ?>"></span>
                <?php else: ?>
                    <span class="label label-primary">Approved</span>
                <?php endif; ?>                                                    
            </td>
        </tr>
    <?php
    endforeach;
    ?>