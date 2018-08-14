<?php if ($previlages->READ == 1) { ?>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span><?php echo $sn++; ?></span><span
            class="hidden" id="loader_<?php echo $row->ADMISSION_ID; ?>"></span></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->ADM_TITLE; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->ADM_DESC; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo date('d-M-Y', strtotime($row->ADM_TEST_DT))." ". $row->ADM_TEST_TIME;; ?></td>
    <td
        <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>> 
        <?php echo $row->PROGRAM_NAME."<br><i>".$row->DEPT_NAME." || ". $row->SESSION_NAME."</i>"; ?>
    </td>
    <td style="width: 140px" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
        <a class="label label-info openModal" id="<?php echo $row->ADMISSION_ID; ?>"
           data-action="setup/#" data-type="edit" title="View Applicant Registration Period"><i
                class="fa fa-eye"></i></a>
        <?php if ($previlages->UPDATE == 1) { ?>
            <a class="label label-default openBigModal" id="<?php echo $row->ADMISSION_ID; ?>"
               title="Update Registration Period Information" data-action="setup/applicantRegPeriodFormUpdate"
               data-type="edit"><i class="fa fa-pencil"></i></a>
        <?php
        }
        if ($previlages->DELETE == 1) {
            ?>
            <a class="label label-danger deleteItem" id="<?php echo $row->ADMISSION_ID; ?>"
               title="Click For Delete" data-type="delete" data-field="ADMISSION_ID"
               data-tbl="adm_admission_info"><i class="fa fa-times"></i></a>
        <?php
        }

        if ($previlages->STATUS == 1) {
            ?>
            <a class="itemStatus" id="<?php echo $row->ADMISSION_ID; ?>"
               data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="ADMISSION_ID"
               data-field="ACTIVE_STATUS" data-tbl="adm_admission_info" data-su-url="setup/admissionInfoById">
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
