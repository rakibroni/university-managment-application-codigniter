<?php if ($previlages->READ == 1) { ?>

<table class="table table-bordered gridTable"  table-title="Degree List" table-msg="All Degree list">
    <thead>
        <tr>
            <th>SN</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($degree)): ?>
            <?php $sn = 1; ?>
            <?php foreach ($degree as $row) { ?>
            <tr class="gradeX" id="row_<?php echo $row->DEGREE_ID; ?>">
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <span><?php echo $sn++; ?></span><span class="hidden"
                    id="loader_<?php echo $row->DEGREE_ID; ?>"></span></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->DEGREE_NAME; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                        <?php if ($previlages->UPDATE == 1) { ?>
                        <a class="label label-default openModal" id="<?php echo $row->DEGREE_ID; ?>"
                         title="Update Degree Information" data-action="setup/degreeFormUpdate"
                         data-type="edit"><i class="fa fa-pencil"></i></a>
                         <?php
                     }
                     if ($previlages->DELETE == 1) {
                        ?>
                        <a class="label label-danger deleteItem" id="<?php echo $row->DEGREE_ID; ?>"
                         title="Click For Delete" data-type="delete" data-field="DEGREE_ID" data-tbl="ins_degree"><i
                         class="fa fa-times"></i></a>
                         <?php
                     }

                     if ($previlages->STATUS == 1) {
                        ?>
                        <a class="itemStatus" id="<?php echo $row->DEGREE_ID; ?>"
                         data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="DEGREE_ID"
                         data-field="ACTIVE_STATUS" data-tbl="ins_degree" data-su-url="setup/degreeById">
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