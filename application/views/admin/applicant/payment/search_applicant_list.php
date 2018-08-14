<?php if (!empty($applicant)): ?>
    <table class="table table-striped table-bordered table-hover gridTable">
        <thead>
            <tr>
                <th>SN</th>
                <th>Student Name</th>
                <th>Reg</th>
                <th>Mobile No</th>
                <th>Program Name</th>
                <th>Session Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sn = 1;
            foreach ($applicant as $row):
                ?>
                <tr class="gradeX" id="row_<?php echo $row->STUDENT_ID; ?>">
                    <td><span><?php echo $sn++; ?></span></td>
                    <td>
                        <?php $stud_photo = ($row->PHOTO != '') ? 'upload/student/photo/' . $row->PHOTO : 'assets/img/default.png' ?>
                        <img class="img-circle" src="<?php echo base_url($stud_photo); ?>" alt="" style="width: 30px;">
                        <?php echo $row->FULL_NAME_EN ?>
                    </td>
                    <td><?php echo $row->REGISTRATION_NO ?></td>
                    <td><?php echo $row->MOBILE_NO; ?></td>
                    <td><?php echo $row->PROGRAM_SHORT_NAME; ?></td>
                    <td>
                        <?php echo $row->SEMESTER_NAME; ?><br/>
                        <?php echo $row->SESSION_NAME; ?>
                    </td>
                    <td>
                        <a target="_blank" class="label label-danger" href="<?php echo site_url('payment/applicant_payment/' . $row->STUDENT_ID); ?>" title="Click For Payment">payment</a>
                    </td>
                </tr>
                <?php
            endforeach;
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th>SN</th>
                <th>Student Name</th>
                <th>Reg</th>
                <th>Mobile No</th>
                <th>Program Name</th>
                <th>Session Name</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>

<?php else: ?>
    <h3 class="text-danger text-center ">No data found !!</h3>
<?php endif; ?>