<?php if ($previlages->READ == 1) { ?>
<table class="table table-striped table-bordered table-hover gridTable">
    <thead>
    <tr>
        <th>SN</th>
        <th>Title</th>
        <th>description</th>
        <th>Start</th>
        <th>End</th>
        <th></th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($admissionPeriod)): ?>
        <?php $sn = 1; ?>
        <?php foreach ($admissionPeriod as $row) { ?>
            <tr class="gradeX" id="row_<?php echo $row->ARP_ID; ?>">
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <span><?php echo $sn++; ?></span><span class="hidden"
                                                           id="eventLoad_<?php echo $row->ARP_ID; ?>"></span>
                </td>                
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->ARP_TITLE; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->ARP_DESC; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo date('d-M-Y', strtotime($row->REG_PERIOD_DT_FROM)); ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo date('d-M-Y', strtotime($row->REG_PERIOD_DT_TO)); ?></td>
                <td
                    <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>> 
                    <?php echo $row->PROGRAM_NAME."<br><i>".$row->DEPT_NAME." || ". $row->SESSION_NAME."</i>"; ?>
                </td>
                <td style="width: 140px" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <a class="label label-info openModal" id="<?php echo $row->ARP_ID; ?>"
                       data-action="setup/#" data-type="edit" title="View Applicant Registration Period"><i
                            class="fa fa-eye"></i></a>
                    <?php if ($previlages->UPDATE == 1) { ?>
                        <a class="label label-default openBigModal" id="<?php echo $row->ARP_ID; ?>"
                           title="Update Registration Period Information" data-action="setup/applicantRegPeriodFormUpdate"
                           data-type="edit"><i class="fa fa-pencil"></i></a>
                    <?php
                    }
                    if ($previlages->DELETE == 1) {
                        ?>
                        <a class="label label-danger deleteItem" id="<?php echo $row->ARP_ID; ?>"
                           title="Click For Delete" data-type="delete" data-field="ARP_ID"
                           data-tbl="adm_passed_app_reg_period"><i class="fa fa-times"></i></a>
                    <?php
                    }

                    if ($previlages->STATUS == 1) {
                        ?>
                        <a class="itemStatus" id="<?php echo $row->ARP_ID; ?>"
                           data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="ARP_ID"
                           data-field="ACTIVE_STATUS" data-tbl="adm_passed_app_reg_period" data-su-url="setup/applicantRegPeriodById">
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
        <th>SN</th>
        <th>Title</th>
        <th>description</th>
        <th>Start</th>
        <th>End</th>
        <th></th>
        <th>Action</th>
    </tr>
    </tfoot>
</table>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>