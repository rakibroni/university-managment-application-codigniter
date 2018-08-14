<?php if ($previlages->READ == 1) { ?>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span></span><span class="hidden"
                                                                                            id="loader_<?php echo $row->SES_YEAR_ID; ?>"></span><?php echo $row->SES_YEAR_ID; ?>
    </td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->SESSION_NAME.'-'.$row->YEAR_SETUP_TITLE; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo ($row->IS_CURRENT =='1')?'Current Session':''; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php  echo ($row->IS_ADMISSION =='1')?'Current Admission Session':''; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
        <?php if ($previlages->UPDATE == 1) { ?>
            <a class="label label-default openModal" id="<?php echo $row->SES_YEAR_ID; ?>"
               title="Update Year Setup Information" data-action="setup/sessionYearFormUpdate" data-type="edit"><i
                    class="fa fa-pencil"></i></a>
        <?php
        }
        if ($previlages->DELETE == 1) {
            ?>
            <a class="label label-danger deleteItem" id="<?php echo $row->SES_YEAR_ID; ?>" title="Click For Delete"
               data-type="delete" data-field="SES_YEAR_ID" data-tbl="session_year"><i class="fa fa-times"></i></a>
        <?php
        }

        if ($previlages->STATUS == 1) {
            ?>
            <a class="itemStatus" id="<?php echo $row->SES_YEAR_ID; ?>" data-status="<?php echo $row->ACTIVE_STATUS ?>"
               data-fieldId="SES_YEAR_ID" data-field="ACTIVE_STATUS" data-tbl="session_year"
               data-su-url="setup/sessionYearById">
                <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Active">Active</span>' ?>
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