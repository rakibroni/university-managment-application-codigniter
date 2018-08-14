<?php if (!empty($applicant)): ?>
    <form id="frmCourseOffer">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="table-responsive">
                <div class="ibox-tools">
                    <input type="button" class="btn btn-primary btn-sm " id="formUpgrade" value="Upgrade">
                </div>
                <table class="table table-striped table-bordered table-hover gridTable">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th><input type="checkbox" id="checkAll" class="check" name="selectAll"></th>
                        <th>Name</th>
                        <th>Roll</th>
                        <th>Semester</th>
                        <th>Session</th>
                        <th>Program</th>
                        <th>Department</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sn = 1;
                    foreach ($applicant as $row):
                        ?>
                        <tr class="gradeX" id="row_<?php echo $row->STUDENT_ID; ?>">
                            <td><span><?php echo $sn++; ?></span><span class="hidden" id="loader_<?php echo $row->STUDENT_ID; ?>"></span></td>
                            <td><input type="checkbox" value="<?php echo $row->STUDENT_ID ?>" class="checkbox-primary check" id="chkStudent" name="chkStudent[]" checked/></td>
                            <td><?php echo $row->FULL_NAME_EN?></td>
                            <td><?php echo $row->ROLL_NO ?></td>
                            <td><?php echo $row->LKP_NAME; ?></td>
                            <td><?php echo $row->SESSION_NAME . " (" . $row->YEAR_SETUP_TITLE . ")"; ?></td>
                            <td><?php echo $row->PROGRAM_NAME; ?></td>
                            <td><?php echo $row->DEPT_NAME; ?></td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>SN</th>
                        <th></th>
                        <th>Name</th>
                        <th>Roll</th>
                        <th>Semester</th>
                        <th>Session</th>
                        <th>Program</th>
                        <th>Department</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </form>
<?php else: ?>
    <h3 class="text-danger text-center ">No data found !!</h3>
<?php endif; ?>

<script>
    $("#checkAll").click(function () {
        $(".check").prop('checked', $(this).prop('checked'));
    });
</script>