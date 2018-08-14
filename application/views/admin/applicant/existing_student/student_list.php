<?php if (!empty($applicant)): ?>
    <table class="table table-striped table-bordered table-hover gridTable">
        <thead>
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Roll</th>
    <!--            <th>Semester</th>
                <th>Session</th>-->
                <th>Program</th>
                <th>Department</th>
                <th>Payment</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sn = 1;
            foreach ($applicant as $row):
                ?>
                <tr class="gradeX" id="row_<?php echo $row->STUDENT_ID; ?>">
                    <td>
                        <span><?php echo $sn++; ?></span><span class="hidden" id="loader_<?php echo $row->STUDENT_ID; ?>"></span>
                    </td>
                    <td>
                        <div class="feed-element">
                            <div class="media-body ">
                                <a class="openBigModal" id="<?php echo $row->STUDENT_ID; ?>"
                                   data-action="admin/applicantDetails" data-type="edit" title="Student Details">
                                       <?php $stud_photo = ($row->PHOTO != '') ? 'upload/student/photo/' . $row->PHOTO : 'assets/img/default.png' ?>
                                    <img class="img-circle" src="<?php echo base_url($stud_photo); ?>" alt="image">
                                    <?php echo $row->FULL_NAME_EN ?>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td><?php echo $row->REGISTRATION_NO ?></td>
                    <td><?php //echo $row->LKP_NAME;  ?></td>
                    <td><?php //echo $row->SESSION_NAME;  ?></td>
                    <td><?php echo $row->PROGRAM_NAME; ?></td>
                    <td><?php echo $row->DEPT_NAME; ?></td>
                    <td><?php echo $row->FACULTY_NAME; ?></td>
                    <td>
<!--                        <a href="<?php echo site_url('finance/admittedStudentPayment/' . $row->STUDENT_ID . '/' . $row->PROGRAM_ID); ?>" target="_blank" class="btn btn-xs btn-danger">Pay >></a>-->
<!--                        <a href="<?php echo site_url(); ?>/student/printId/<?php echo $row->STUDENT_ID; ?>" target="_blank" class="btn btn-primary btn-xs"><i class="fa fa-file-pdf-o"></i> Print</a>-->
                        <a  href="<?php echo site_url('payment/existing_students/' . $row->STUDENT_ID); ?>" target="_blank" class="btn btn-xs btn-danger">Payment</a>
                    </td>
                </tr>
                <?php
            endforeach;
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Roll</th>
<!--                <th>Semester</th>
                <th>Session</th>-->
                <th>Program</th>
                <th>Department</th>
                <th>Payment</th>
            </tr>
        </tfoot>
    </table>
<?php else: ?>
    <h3 class="text-danger text-center ">No data found !!</h3>
<?php endif; ?>