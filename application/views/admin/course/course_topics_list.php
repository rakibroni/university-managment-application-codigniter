<?php if ($previlages->READ == 1) { ?>


    <table class="table table-striped table-bordered table-hover gridTable">
        <thead>
        <tr>
            <th>SN</th>
            <th>Course Name</th>
            <th>Topic Title</th>
            <th>Description</th>
            <th>Duration</th>
            <th>Activities</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($courseTopics)): ?>
            <?php $sn = 1; ?>
            <?php foreach ($courseTopics as $row) { ?>
                <tr class="gradeX" id="row_<?php echo $row->CRS_TOPIC_ID; ?>">
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                        <span><?php echo $sn++; ?></span><span class="hidden" id="loader_<?php echo $row->CRS_TOPIC_ID; ?>"></span>
                    </td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->COURSE_TITLE; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->TOPIC_TITLE; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->TOPIC_DESC; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->TOPIC_DURATION . " Min"; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->SUGGESTED_ACTIVITIES; ?></td>
                    <td style="width: 140px" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                        <a class="label label-info openModal" id="<?php echo $row->CRS_TOPIC_ID; ?>"
                           data-action="course/courseTopicInfo" data-type="edit" title="Course Topic Information"><i
                                class="fa fa-eye"></i></a>
                        <?php if ($previlages->UPDATE == 1) { ?>
                            <a class="label label-default openModal" id="<?php echo $row->CRS_TOPIC_ID; ?>"
                               title="Update Course Topic" data-action="course/courseTopicFormUpdate"
                               data-type="edit"><i class="fa fa-pencil"></i></a>
                        <?php
                        }
                        if ($previlages->DELETE == 1) { ?>
                            <a class="label label-danger deleteItem" id="<?php echo $row->CRS_TOPIC_ID; ?>"
                               title="Click For Delete" data-action="course/deleteCourseTopics" data-type="delete"
                               data-field="CRS_TOPIC_ID" data-tbl="aca_course_topics"><i class="fa fa-times"></i></a>
                        <?php }
                        if ($previlages->STATUS == 1) { ?>
                            <a class="itemStatus" id="<?php echo $row->CRS_TOPIC_ID; ?>"
                               data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="CRS_TOPIC_ID"
                               data-field="ACTIVE_STATUS" data-tbl="aca_course_topics"
                               data-su-url="course/courseTopicsById">
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
            <th>Course Name</th>
            <th>Topic Title</th>
            <th>Description</th>
            <th>Duration</th>
            <th>Activities</th>
            <th>Action</th>
        </tr>
        </tfoot>
    </table>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>