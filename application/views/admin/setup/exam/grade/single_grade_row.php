<?php if ($previlages->READ == 1) { ?>
<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
  <span><?php echo $sn++; ?></span><span class="hidden"
  id="loader_<?php echo $row->GR_ID; ?>"></span>
</td>
<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->GR_POLICY_NAME; ?></td>
<td class="text-center" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->GR_MARKS_FROM.'% - '.$row->GR_MARKS_TO.'%'; ?></td>
<td class="text-center" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->GRADE_POINT; ?></td>
<td class="text-center" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->GR_LETTER; ?></td>
<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>

 <?php if ($previlages->UPDATE == 1) { ?>
 <a class="label label-default openModal" id="<?php echo $row->GR_ID; ?>"
   title="Update Exam Grade Information" data-action="exam/gradeFormUpdate"
   data-type="edit"><i class="fa fa-pencil"></i></a>
   <?php
 }
 if ($previlages->DELETE == 1) {
  ?>
  <a class="label label-danger deleteItem2" id="<?php echo $row->GR_ID; ?>"
   title="Click For Delete" data-type="delete" data-field="GR_ID"
   data-action="exam/deleteItem"
   data-tbl="exam_grade"><i
   class="fa fa-times"></i></a>
   <?php
 }
 if ($previlages->STATUS == 1) {
  ?>
  <a class="itemStatus2" id="<?php echo $row->GR_ID; ?>"
   data-status="<?php echo $row->GRADE_ACTIVE_STATUS ?>" data-fieldId="GR_ID"
   data-field="ACTIVE_STATUS" data-tbl="exam_grade" data-action="exam/statusItem"
   data-su-url="exam/gradeById">
   <?php echo ($row->GRADE_ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Inactive">Active</span>' ?>
 </a>
 <?php
}
?>
</td>
<?php
} else {
  echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>