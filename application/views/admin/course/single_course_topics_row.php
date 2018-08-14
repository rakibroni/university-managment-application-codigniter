<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span><?php echo $sn++; ?></span><span
        class="hidden" id="loader_<?php echo $row->CRS_TOPIC_ID; ?>"></span></td>
<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->COURSE_TITLE; ?></td>
<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->TOPIC_TITLE; ?></td>
<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->TOPIC_DESC; ?></td>
<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->TOPIC_DURATION; ?></td>
<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->SUGGESTED_ACTIVITIES; ?></td>
<td style="width: 140px" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
    <a class="label label-default openModal" id="<?php echo $row->CRS_TOPIC_ID; ?>" title="Update Course Topic"
       data-action="course/courseTopicFormUpdate" data-type="edit"><i class="fa fa-pencil"></i></a>
    <a class="label label-danger deleteItem" id="<?php echo $row->CRS_TOPIC_ID; ?>" title="Click For Delete"
       data-action="course/deleteCourseTopics" data-type="delete" data-field="CRS_TOPIC_ID"
       data-tbl="aca_course_topics"><i class="fa fa-times"></i></a>
    <a class="itemStatus" id="<?php echo $row->CRS_TOPIC_ID; ?>" data-status="<?php echo $row->ACTIVE_STATUS ?>"
       data-fieldId="CRS_TOPIC_ID" data-field="ACTIVE_STATUS" data-tbl="aca_course_topics"
       data-su-url="course/courseTopicsById">
        <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive" >Inactive</span>' : '<span class="label label-danger" title="Click For Active" >Active</span>' ?>
    </a>

</td>