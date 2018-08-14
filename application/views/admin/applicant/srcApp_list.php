<table class="table table-striped table-bordered table-hover gridTable">
    <thead>
    <tr>
        <th>SN</th>
        <th>Student ID</th>
        <th>Name</th>
        <th>Roll</th>
        <th>Faculty</th>
        <th>Department</th>
        <th>Program</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($srcApplican)): ?>
        <?php $sn = 1; ?>
        <?php foreach ($srcApplican as $row) { ?>
            <tr class="gradeX" id="row_<?php echo $row->STUDENT_ID; ?>">
                <td><span><?php echo $sn++; ?></span><span class="hidden"
                                                           id="loader_<?php echo $row->STUDENT_ID; ?>"></span></td>
                <td><?php echo $row->STUDENT_ID; ?></td>
                <td><?php echo $row->FULL_NAME_EN; ?></td>
                <td><?php echo $row->ROLL_NO; ?></td>
                <td><?php echo $row->FACULTY_NAME; ?></td>
                <td><?php echo $row->DEPT_NAME; ?></td>
                <td><?php echo $row->PROGRAM_NAME; ?></td>
                <td>
                    <a class="label label-info openBigModal" id="<?php echo $row->STUDENT_ID; ?>"
                       data-action="admin/applicantDetails" data-type="edit" title="View Applicant Information"><i
                            class="fa fa-eye"></i></a>
                    <a class="label label-default openModal " id="<?php echo $row->STUDENT_ID; ?>"
                       data-action="admin/applicanStuUpdate" data-type="edit" title="Update Applicant Information"><i
                            class="fa fa-pencil"></i></a>
                    <a class="label label-danger deleteItem" id="<?php echo $row->STUDENT_ID; ?>" data-action=""
                       data-type="delete" data-field="STUDENT_ID" data-tbl=""><i class="fa fa-times"></i></a>
                </td>
            </tr>
        <?php } ?>
    <?php endif; ?>
    </tbody>
    <tfoot>
    <tr>
        <th>SN</th>
        <th>Student ID</th>
        <th>Name</th>
        <th>Roll</th>
        <th>Faculty</th>
        <th>Department</th>
        <th>Program</th>
        <th>Action</th>
    </tr>
    </tfoot>
</table>