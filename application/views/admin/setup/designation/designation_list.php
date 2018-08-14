<?php if ($previlages->READ == 1) { ?>
    <table class="table table-striped table-bordered table-hover gridTable">
        <thead>
        <tr>
            <th>SL</th>
            <th>Designation</th>            
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($designation)): $sn = 1; ?>
            <?php foreach ($designation as $row) { ?>
                <tr class="gradeX" id="row_<?php echo $row->DESIG_ID; ?>">
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                        <span><?php echo $sn++; ?></span><span class="hidden"
                                                               id="loader_<?php echo $row->DESIG_ID; ?>"></span>
                    </td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->DESIGNATION; ?></td>
                   
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                        <?php if ($previlages->UPDATE == 1) { ?>
                            <a class="label label-default openModal" id="<?php echo $row->DESIG_ID; ?>"
                               title="Update Designation" data-action="setup/designationFormUpdate" data-type="edit"><i
                                    class="fa fa-pencil"></i></a>
                        <?php
                        }
                        if ($previlages->DELETE == 1) {
                            ?>
                            <a class="label label-danger deleteItem" id="<?php echo $row->DESIG_ID; ?>"
                               title="Click For Delete" data-type="delete" data-field="DESIG_ID"
                               data-tbl="hr_desig"><i class="fa fa-times"></i></a>
                        <?php
                        }

                        if ($previlages->STATUS == 1) {
                            ?>
                            <a class="itemStatus" id="<?php echo $row->DESIG_ID; ?>"
                               data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="DESIG_ID"
                               data-field="ACTIVE_STATUS" data-tbl="hr_desig" data-su-url="setup/designationById">
                                <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Active">Active</span>' ?>
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
            <th>SL</th>
            <th>Designation</th>
            
            <th>Actions</th>
        </tr>
        </tfoot>
    </table>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>