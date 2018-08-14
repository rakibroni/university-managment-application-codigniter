<table id="academic_list" class="table table-bordered dataTable">
    <tr class="info">
        <th>SL.</th>
        <th>Course Code</th>
        <th>Course Title</th>
        <th class="text-center">Credits</th>
        <th class="text-center">Course For</th>
        <th class="text-center">Action</th>
        <!--                                    <th>Result</th>-->
        <!--                                    <th>Result W/A</th>-->
    </tr>

    <tbody>

    <?php if (!empty($student_course_list)) : ?>
        <?php $sn = 1; ?>
        <?php foreach ($student_course_list as $row) : ?>

            <tr class="gradeX" id="row_<?php echo $row->STU_CRS_ID; ?>">
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <span><?php echo $sn++; ?></span><span class="hidden"
                                                           id="loader_<?php echo $row->STU_CRS_ID; ?>"></span>
                </td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->COURSE_CODE; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->COURSE_TITLE; ?></td>
                <td class="text-center" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->CREDIT; ?></td>
                <td class="text-center" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <?php if ($row->COURSE_FOR == 'F'): ?>
                        <?php echo 'Final';?>
                    <?php elseif ($row->COURSE_FOR == 'I') : ?>
                        <?php echo 'Improved'; ?>
                    <?php elseif ($row->COURSE_FOR == 'R') : ?>
                        <?php echo 'Retake'; ?>
                    <?php endif; ?>
                </td>
                <td class="text-center" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>

                    <a class="label label-danger deleteItem2" id="<?php echo $row->STU_CRS_ID; ?>"
                       title="Click For Delete" data-type="delete" data-field="STU_CRS_ID"
                       data-action="teacher/deleteItem"
                       data-tbl="student_courseinfo"><i
                            class="fa fa-times"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>

    <div class="ibox-tools">
        <a><span id="openCourseModal" title="Add Course" class="label label-primary label-sm pull-right glyphicon glyphicon-plus" data-program-id="<?php echo $program_id;?>" data-reg-id="<?php echo $stu_reg_no;?>"
                 data-action="teacher/newCourseFormInsert" data-session-id="<?php echo $session_id;?>"> Add New </span></a>
    </div>

</table>