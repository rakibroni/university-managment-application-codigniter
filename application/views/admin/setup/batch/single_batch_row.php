 
<?php if (!empty($batch)) { ?>
<td <?php echo ($batch->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span></span><span class="hidden"
 id="loader_<?php echo $batch->BATCH_ID; ?>"></span>
</td>
<td <?php echo ($batch->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $batch->BATCH_TITLE; ?></td>
<td <?php echo ($batch->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $batch->BATCH_DESC; ?></td> 
<td <?php echo ($batch->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
 <?php if ($previlages->UPDATE == 1) { ?>
 <a class="label label-default openModal" id="<?php echo $batch->BATCH_ID; ?>"
   title="Update Batch Information" data-action="setup/batchFormUpdate" data-type="edit"><i
   class="fa fa-pencil"></i></a>
   <?php
 }
 if ($previlages->DELETE == 1) {
  ?>
  <a class="label label-danger deleteItem" id="<?php echo $batch->BATCH_ID; ?>" title="Click For Delete"
   data-type="delete" data-field="BATCH_ID" data-tbl="aca_batch"><i class="fa fa-times"></i></a>
   <?php
 }

 if ($previlages->STATUS == 1) {
  ?>
  <a class="itemStatus" id="<?php echo $batch->BATCH_ID; ?>" data-status="<?php echo $batch->ACTIVE_STATUS ?>"
   data-fieldId="BATCH_ID" data-field="ACTIVE_STATUS" data-tbl="aca_batch"
   data-su-url="setup/batchById">
   <?php echo ($batch->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Active">Active</span>' ?>
 </a>

</td>
<?php } ?>
<?php } ?>
