<?php if ($previlages->READ == 1) { ?>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span><?php echo $sn++; ?></span><span
            class="hidden" id="loader_<?php echo $row->C_CAT_ID; ?>"></span></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->CAT_NAME; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->CAT_DESC; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span
            style=" background-color: <?php echo $row->CAT_COLOR; ?>;"><?php echo $row->CAT_COLOR; ?></span></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->SEQUENCE; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
        <?php if ($previlages->UPDATE == 1) { ?>
            <a class="label label-default openModal" id="<?php echo $row->C_CAT_ID; ?>"
               title="Update Degree Information" data-action="Course/courseCatFormUpdate" data-type="edit"><i
                    class="fa fa-pencil"></i></a>
        <?php
        }
        if ($previlages->DELETE == 1) {
            ?>
            <a class="label label-danger deleteItem" id="<?php echo $row->C_CAT_ID; ?>" title="Click For Delete"
               data-type="delete" data-field="C_CAT_ID" data-tbl="aca_course_category"><i class="fa fa-times"></i></a>
        <?php
        }

        if ($previlages->STATUS == 1) {
            ?>
            <a class="itemStatus" id="<?php echo $row->C_CAT_ID; ?>" data-status="<?php echo $row->ACTIVE_STATUS ?>"
               data-fieldId="C_CAT_ID" data-field="ACTIVE_STATUS" data-tbl="aca_course_category"
               data-su-url="Course/courseCategoryById">
                <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Inactive">Active</span>' ?>
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