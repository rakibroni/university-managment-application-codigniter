<?php if ($previlages->READ == 1) { ?>
    <table class="table table-bordered table-hover gridTable">
        <thead>
        <tr>
            <th>SN</th>
            <th>Name</th>
            <th>Description</th>
            <th>Color</th>
            <th>Sequence</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($courseCategory)): ?>
            <?php $sn = 1; ?>
            <?php foreach ($courseCategory as $row) { ?>
                <tr class="gradeX" id="row_<?php echo $row->C_CAT_ID; ?>">
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                        <span><?php echo $sn++; ?></span><span class="hidden"
                                                               id="loader_<?php echo $row->C_CAT_ID; ?>"></span></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->CAT_NAME; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->CAT_DESC; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span
                            style=" background-color: <?php echo $row->CAT_COLOR; ?>;"
                            class="label"><?php echo $row->CAT_COLOR; ?></span></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->SEQUENCE; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                        <?php if ($previlages->UPDATE == 1) { ?>
                            <a class="label label-default openModal" id="<?php echo $row->C_CAT_ID; ?>"
                               title="Update Degree Information" data-action="Course/courseCatFormUpdate"
                               data-type="edit"><i class="fa fa-pencil"></i></a>
                        <?php
                        }
                        if ($previlages->DELETE == 1) {
                            ?>
                            <a class="label label-danger deleteItem" id="<?php echo $row->C_CAT_ID; ?>"
                               title="Click For Delete" data-type="delete" data-field="C_CAT_ID"
                               data-tbl="aca_course_category"><i class="fa fa-times"></i></a>
                        <?php
                        }

                        if ($previlages->STATUS == 1) {
                            ?>
                            <a class="itemStatus" id="<?php echo $row->C_CAT_ID; ?>"
                               data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="C_CAT_ID"
                               data-field="ACTIVE_STATUS" data-tbl="aca_course_category"
                               data-su-url="Course/courseCategoryById">
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
        <tfoot>
        <tr>
            <th>SN</th>
            <th>Name</th>
            <th>Description</th>
            <th>Color</th>
            <th>Sequence</th>
            <th>Action</th>
        </tr>
        </tfoot>
    </table>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>