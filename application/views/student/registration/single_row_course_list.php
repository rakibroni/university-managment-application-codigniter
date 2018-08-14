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