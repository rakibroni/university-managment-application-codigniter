<table class="table table-striped table-bordered table-hover gridTable">
    <thead>
    <tr>
        <th>SN</th>
        <th>Student Id</th>
        <th>Semester</th>
        <th>Course Name</th>
        <th>Marks</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($marks)): $sn = 1; ?>
        <?php foreach ($marks as $row) { ?>
            <tr class="gradeX" id="row_<?php echo $row->EX_MARKS_ID; ?>">
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <span><?php echo $sn++; ?></span><span class="hidden"
                                                           id="loader_<?php echo $row->EX_MARKS_ID; ?>"></span></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->STUDENT_ID; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->SEMESTER_NAME; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo "<b>" . $row->COURSE_CODE . "</b> " . $row->COURSE_TITLE; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->MARKS; ?></td>
                <td style="width: 140px" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <?php if ($previlages->UPDATE == 1) { ?>
                        <a class="label label-default openModal" id="<?php echo $row->EX_MARKS_ID; ?>"
                           title="Update Student Marks" data-action="Coe/studentMarksFormUpdate" data-type="edit"><i
                                class="fa fa-pencil"></i></a>
                    <?php
                    }
                    if ($previlages->DELETE == 1) {
                        ?>
                        <a class="label label-danger deleteItem" id="<?php echo $row->EX_MARKS_ID; ?>"
                           title="Click For Delete" data-type="delete" data-field="EX_MARKS_ID"
                           data-tbl="exam_student_marks"><i class="fa fa-times"></i></a>
                    <?php
                    }
                    if ($previlages->STATUS == 1) {
                        ?>
                        <a class="itemStatus" id="<?php echo $row->EX_MARKS_ID; ?>"
                           data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="EX_MARKS_ID"
                           data-field="ACTIVE_STATUS" data-tbl="exam_student_marks" data-su-url="Coe/studentMarksById">
                            <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Active">Active</span>' ?>
                        </a>
                    <?php
                    }
                    ?>
                </td>
            </tr>
        <?php } ?>
    <?php endif; ?>
    </tbody>
    <tfoot>
    <tr>
        <th>SN</th>
        <th>Student Id</th>
        <th>Semester</th>
        <th>Course Name</th>
        <th>Marks</th>
        <th>Action</th>
    </tr>
    </tfoot>
</table>