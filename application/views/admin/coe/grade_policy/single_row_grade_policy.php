<?php if ($previlages->READ == 1) { ?>
    <?php foreach ($grade_policy as $row) { ?>
        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span><?php echo $sn++; ?></span><span
                class="hidden" id="loader_<?php echo $row->GR_POLICY_ID; ?>"></span></td>
        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->GR_POLICY_NAME; ?></td>
        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->GR_POLICY_DESC; ?></td>
        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo date('d-M-Y', strtotime($row->START_DATE)); ?></td>
        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo date('d-M-Y', strtotime($row->END_DATE)); ?></td>
        <td style="width: 140px" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
            <?php if ($previlages->UPDATE == 1) { ?>
                <a class="label label-default openModal" id="<?php echo $row->GR_POLICY_ID; ?>"
                   title="Update Grade Policy" data-action="Coe/gradePolicyFormUpdate" data-type="edit"><i
                        class="fa fa-pencil"></i></a>
            <?php
            }
            if ($previlages->DELETE == 1) {
                ?>
                <a class="label label-danger deleteItem" id="<?php echo $row->GR_POLICY_ID; ?>" title="Click For Delete"
                   data-type="delete" data-field="GR_POLICY_ID" data-tbl="exam_grade_policy"><i class="fa fa-times"></i></a>
            <?php
            }

            if ($previlages->STATUS == 1) {
                ?>
                <a class="itemStatus" id="<?php echo $row->GR_POLICY_ID; ?>"
                   data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="GR_POLICY_ID"
                   data-field="ACTIVE_STATUS" data-tbl="exam_grade_policy" data-su-url="Coe/gradePolicyById">
                    <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Active">Active</span>' ?>
                </a>
            <?php
            }
            ?>
        </td>
    <?php } ?>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>
