<?php if ($previlages->READ == 1) { ?>
    <table class="table table-striped table-bordered table-hover gridTable common_table">
        <thead>
        <tr>
            <th>SN</th>
            <th>Department</th>
            <th>Title</th>
            <th>Credit</th>
            <th>Category</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($courses)): ?>
            <?php $sn = 1; ?>
            <?php foreach ($courses as $row) { ?>
                <tr class="gradeX" id="row_<?php echo $row->COURSE_ID; ?>">
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                        <span><?php echo $sn++; ?></span><span class="hidden"
                                                               id="loader_<?php echo $row->COURSE_ID; ?>"></span></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->DEPT_NAME; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>

                        <?php if ($row->GLOBAL_FOR_INSTITUTE == 1){ ?>
                        <a data-action="course/courseDetails" course="<?php echo $row->COURSE_ID; ?>"
                           class="openCourseDetailsModal"
                           title="Course Details"><?php echo "<b>" . $row->COURSE_CODE . "&nbsp;: " . $row->COURSE_TITLE . "</a></b><br><i>Type: Global For Institute</i>"; ?>
                            <?php } else if ($row->GLOBAL_FOR_FACULTY == 1){ ?>
                            <a data-action="course/courseDetails" course="<?php echo $row->COURSE_ID; ?>"
                               class="openCourseDetailsModal"
                               title="Course Details"><?php echo "<b>" . $row->COURSE_CODE . "&nbsp;: " . $row->COURSE_TITLE . "</a></b><br><i>Type: Global For Faculty</i>"; ?>
                                <?php } else { ?>
                                <a data-action="course/courseDetails" course="<?php echo $row->COURSE_ID; ?>"
                                   class="openCourseDetailsModal"
                                   title="Course Details"><?php echo "<b>" . $row->COURSE_CODE . "&nbsp;: " . $row->COURSE_TITLE . "</a></b>"; ?>
                                    <?php } ?>
                    </td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->CREDIT; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->COURSE_CATEGORY; ?></td>
                    <td style="width: 140px" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                        <a class="label label-info openBigModal" id="<?php echo $row->COURSE_ID; ?>"
                           data-action="course/courseInfo" data-type="edit" title="Course Information"><i
                                class="fa fa-eye"></i></a>
                        <?php if ($previlages->UPDATE == 1) { ?>
                            <a class="label label-default openModal" id="<?php echo $row->COURSE_ID; ?>"
                               title="Update Course Information" data-action="course/courseFormUpdate" data-type="edit"><i
                                    class="fa fa-pencil"></i></a>
                        <?php
                        }
                        if ($previlages->DELETE == 1) { ?>
                            <a class="label label-danger deleteItem" id="<?php echo $row->COURSE_ID; ?>"
                               title="Click For Delete" data-action="setup/deleteDegree" data-type="delete"
                               data-field="COURSE_ID" data-tbl="aca_course"><i class="fa fa-times"></i></a>
                        <?php }
                        if ($previlages->STATUS == 1) { ?>
                            <a class="itemStatus" id="<?php echo $row->COURSE_ID; ?>"
                               data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="COURSE_ID"
                               data-field="ACTIVE_STATUS" data-tbl="aca_course" data-su-url="course/courseById">
                                <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive" >Inactive</span>' : '<span class="label label-danger" title="Click For Active" >Active</span>' ?>
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
            <th>Department</th>
            <th>Title</th>
            <th>Credit</th>
            <th>Category</th>
            <th>Action</th>
        </tr>
        </tfoot>
    </table>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>