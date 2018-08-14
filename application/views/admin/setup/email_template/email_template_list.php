<?php if ($previlages->READ == 1) { ?>

<table class="table table-bordered gridTable"  table-title="Degree List" table-msg="All Degree list">
    <thead>
        <tr>
            <th>SN</th>
            <th>Email Subject</th>
            <th>Email Body</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($email_template)): ?>
            <?php $sn = 1; ?>
            <?php foreach ($email_template as $row) { ?>
            <tr class="gradeX" id="row_<?php echo $row->EMAIL_TEMPLATE_ID; ?>">
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <span><?php echo $sn++; ?></span><span class="hidden"
                    id="loader_<?php echo $row->EMAIL_TEMPLATE_ID; ?>"></span></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->EMAIL_SUBJECT; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->EMAIL_BODY; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                        <?php if ($previlages->UPDATE == 1) { ?>
                        <a class="label label-default openModal" id="<?php echo $row->EMAIL_TEMPLATE_ID; ?>"
                         title="Update Email Template Information" data-action="setup/emilTemplateFormUpdate"
                         data-type="edit"><i class="fa fa-pencil"></i></a>
                         <?php
                     }
                     if ($previlages->DELETE == 1) {
                        ?>
                        <a class="label label-danger deleteItem" id="<?php echo $row->EMAIL_TEMPLATE_ID; ?>"
                         title="Click For Delete" data-type="delete" data-field="EMAIL_TEMPLATE_ID" data-tbl="aca_email_template"><i
                         class="fa fa-times"></i></a>
                         <?php
                     }

                     if ($previlages->STATUS == 1) {
                        ?>
                        <a class="itemStatus" id="<?php echo $row->EMAIL_TEMPLATE_ID; ?>"
                         data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="EMAIL_TEMPLATE_ID"
                         data-field="ACTIVE_STATUS" data-tbl="aca_email_template" data-su-url="setup/emailTemplateById">
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