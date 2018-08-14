<?php if (!empty($applicant)): ?>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="table-responsive">
            <div class="ibox-tools">
                <span id="upgrade_success" class="text-success"></span>
                <input type="button" class="btn btn-primary btn-sm formUpgrade" value="All Upgrade">
            </div>
            <form action="" id="semesterUp">
                <table class="table table-striped table-bordered table-hover gridTable">
                    <thead>
                    <tr>
                        <th><input type="checkbox" id="checkAll"></th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Semester</th>
                        <th>Session</th>
                        <th>Program</th>
                        <th>Department</th>
                        <th>Faculty</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sn = 1;
                    foreach ($applicant as $row):
                        ?>
                        <tr class="gradeX" id="row_<?php echo $row->STUDENT_ID; ?>">
                            <td><input type="checkbox" class="form-control required check" name="chkStudent[]"
                                       value="<?php echo $row->STUDENT_ID; ?>"/></td>
                            <td><?php echo $row->STUDENT_ID ?></td>
                            <td><?php echo $row->FULL_NAME_EN?></td>
                            <td><?php echo $row->LKP_NAME; ?></td>
                            <td><?php echo $row->SESSION_NAME . " (" . $row->YEAR_SETUP_TITLE . ")"; ?></td>
                            <td><?php echo $row->PROGRAM_NAME; ?></td>
                            <td><?php echo $row->DEPT_NAME; ?></td>
                            <td><?php echo $row->FACULTY_NAME; ?></td>
                            <td>
                                <a class="label label-danger semUpgrade" data-student="<?php echo $row->STUDENT_ID; ?>"
                                   title="Semester Upgrade to click here">upgrade</a>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>SN</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Semester</th>
                        <th>Session</th>
                        <th>Program</th>
                        <th>Department</th>
                        <th>Faculty</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
<?php else: ?>
    <h3 class="text-danger text-center ">No data found !!</h3>
<?php endif; ?>

<script type="text/javascript">
    $("#checkAll").click(function () {
        $(".check").prop('checked', $(this).prop('checked'));
    });
</script> 