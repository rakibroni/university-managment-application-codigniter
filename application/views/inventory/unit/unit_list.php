<?php if ($previlages->READ == 1) { ?>

<table class="table table-bordered gridTable"  table-title="Unit List" table-msg="All Unit list">
    <thead>
        <tr>
            <th>SN</th>
            <th>Name</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($unit)): ?>
            <?php $sn = 1; ?>
            <?php foreach ($unit as $row) { ?>
            <tr class="gradeX" id="row_<?php echo $row->UNIT_ID; ?>">
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <span><?php echo $sn++; ?></span><span class="hidden"
                    id="loader_<?php echo $row->UNIT_ID; ?>"></span></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->UNIT_NAME; ?></td>
                     <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->DESC; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                         <?php if ($previlages->UPDATE == 1) { ?>
                        <a class="label label-default openModal" id="<?php echo $row->UNIT_ID; ?>"
                         title="Update Unit Information" data-action="inventory/unitFormUpdate"
                         data-type="edit"><i class="fa fa-pencil"></i></a>
                         <?php
                     }
                     if ($previlages->DELETE == 1) {
                        ?>
                        <a class="label label-danger deleteItem" id="<?php echo $row->UNIT_ID; ?>"
                         title="Click For Delete" data-type="delete" data-field="UNIT_ID" data-tbl="inv_unit"><i
                         class="fa fa-times"></i></a>
                        <?php
                     }

                     if ($previlages->STATUS == 1) {
                        ?>
                        <a class="itemStatus" id="<?php echo $row->UNIT_ID; ?>"
                         data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="UNIT_ID"
                         data-field="ACTIVE_STATUS" data-tbl="inv_unit" data-su-url="inventory/unitById">
                         <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Inactive">Active</span>' ?>
                     </a>
                     <?php
                 }
                 ?>
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