<?php if ($previlages->READ == 1) { ?>
    <table class="table table-striped table-bordered table-hover gridTable">
        <thead>
        <tr>
            <th>SL</th>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($accessory)): $sn = 1; ?>
            <?php foreach ($accessory as $row) { ?>
                <tr class="gradeX" id="row_<?php echo $row->BR_ACCESSORY_ID; ?>">
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                        <span><?php echo $sn++; ?></span><span class="hidden"
                                                               id="loader_<?php echo $row->BR_ACCESSORY_ID; ?>"></span>
                    </td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->ACCESSORY_NAME; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->ACCESSORY_DESC; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                        <?php if ($previlages->UPDATE == 1) { ?>
                            <a class="label label-default openModal" id="<?php echo $row->BR_ACCESSORY_ID; ?>"
                               title="Update Accessory Information" data-action="setup/accessoryFormUpdate"
                               data-type="edit"><i class="fa fa-pencil"></i></a>
                        <?php
                        }
                        if ($previlages->DELETE == 1) {
                            ?>
                            <a class="label label-danger deleteItem" id="<?php echo $row->BR_ACCESSORY_ID; ?>"
                               title="Click For Delete" data-type="delete" data-field="BR_ACCESSORY_ID"
                               data-tbl="sc_accessories"><i class="fa fa-times"></i></a>
                        <?php
                        }

                        if ($previlages->STATUS == 1) {
                            ?>
                            <a class="itemStatus" id="<?php echo $row->BR_ACCESSORY_ID; ?>"
                               data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="BR_ACCESSORY_ID"
                               data-field="ACTIVE_STATUS" data-tbl="sc_accessories" data-su-url="setup/accessoriesById">
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
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        </tfoot>
    </table>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>