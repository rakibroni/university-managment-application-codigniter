<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span><?php echo $sn++; ?></span><span
        class="hidden" id="loader_<?php echo $row->COURSE_ID; ?>"></span></td>
<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->DEPT_NAME; ?></td>
<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><a data-action="course/courseDetails"
                                                                           course="<?php echo $row->COURSE_ID; ?>"
                                                                           class="openCourseDetailsModal"
                                                                           title="Course Details"><?php echo "<b>" . $row->COURSE_CODE . "</b>&nbsp;: " . $row->COURSE_TITLE . "<br>"; ?></a>
</td>
<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->CREDIT; ?></td>
<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->COURSE_CATEGORY; ?></td>
<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
    <a class="label label-info openModal" id="<?php echo $row->COURSE_ID; ?>" data-action="course/courseInfo"
       data-type="edit" title="View Course Information"><i class="fa fa-eye"></i></a>
    <a class="label label-default openModal" id="<?php echo $row->COURSE_ID; ?>" title="Update Course Information"
       data-action="course/courseFormUpdate" data-type="edit"><i class="fa fa-pencil"></i></a>
    <a class="label label-danger deleteItem" id="<?php echo $row->COURSE_ID; ?>" title="Click For Delete"
       data-action="setup/deleteDegree" data-type="delete" data-field="COURSE_ID" data-tbl="aca_course"><i
            class="fa fa-times"></i></a>
    <a class="itemStatus" id="<?php echo $row->COURSE_ID; ?>" data-status="<?php echo $row->ACTIVE_STATUS ?>"
       data-fieldId="COURSE_ID" data-field="ACTIVE_STATUS" data-tbl="aca_course" data-su-url="course/courseById">
        <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive" >Inactive</span>' : '<span class="label label-danger" title="Click For Active" >Active</span>' ?>
    </a>
</td>