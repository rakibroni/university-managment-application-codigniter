<?php if ($previlages->READ == 1) { ?>
<table class="table table-bordered gridTable"  table-title="Batch List" table-msg="All batch list">
    <thead>
        <tr>
            <th>SL</th>
            <th>Name</th>
            <th>Description</th> 
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($batch)): $sn = 1; ?>
            <?php foreach ($batch as $row) { ?>
            <tr class="gradeX" id="row_<?php echo $row->BATCH_ID; ?>">
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <span><?php echo $sn++; ?></span><span class="hidden"
                    id="loader_<?php echo $row->BATCH_ID; ?>"></span></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->BATCH_TITLE; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->BATCH_DESC; ?></td> 

                    <td class="text-center" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                        <?php if ($previlages->UPDATE == 1) { ?>
                        <a class="label label-default openModal" id="<?php echo $row->BATCH_ID; ?>"
                         title="Update Batch Information" data-action="setup/batchFormUpdate" data-type="edit"><i
                         class="fa fa-pencil"></i>
                     </a>
                     <?php
                 }
                 if ($previlages->DELETE == 1) {
                    ?>
                    <a class="label label-danger deleteItem" id="<?php echo $row->BATCH_ID; ?>"
                     title="Click For Delete" data-type="delete" data-field="BATCH_ID" data-tbl="aca_batch"><i
                     class="fa fa-times"></i></a>
                     <?php
                 }

                 if ($previlages->STATUS == 1) {
                    ?>
                    <a class="itemStatus" id="<?php echo $row->BATCH_ID; ?>"
                     data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="BATCH_ID"
                     data-field="ACTIVE_STATUS" data-tbl="aca_batch" data-su-url="setup/batchById">
                     <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Active">Active</span>' ?>
                 </a>
                 <?php } ?>
             </td>
         </tr>
         <?php } ?>
     <?php endif; ?>
 </tbody>

</table>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>

