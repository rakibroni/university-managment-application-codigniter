<table class="table table-striped table-bordered table-hover gridTable">
    <thead>
    <tr>
        <th>SN</th>
        <th>Title</th>
        <th>description</th>
        <th>Start</th>
        <th>End</th>
        <th>Semester</th>
        <th></th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($reg_period)): ?>
        <?php $sn = 1; ?>
        <?php foreach ($reg_period as $row) { ?>
            <tr class="gradeX" id="row_<?php echo $row->REG_PERIOD_ID; ?>">
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <span><?php echo $sn++; ?></span><span class="hidden"
                                                           id="eventLoad_<?php echo $row->REG_PERIOD_ID; ?>"></span>
                </td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->RP_TITLE; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->RP_DESC; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo date('d-M-Y', strtotime($row->FROM_DT)); ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo date('d-M-Y', strtotime($row->TO_DT)); ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->LKP_NAME; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <?php 
                        echo $row->DEPT_NAME;
                        if ($row->PROGRAM_NAME == '') {
                            echo "All Program";
                        } else {
                            echo  "<br><i>".$row->PROGRAM_NAME."</i>";
                        }
                         echo "<br><i>".$row->SESSION_NAME."</i>"; 
                    ?>
                </td>
                <td style="width: 140px" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <a class="label label-info openModal" id="<?php echo $row->REG_PERIOD_ID; ?>"
                       data-action="setup/regPeriodInfo" data-type="edit" title="View Registration Period"><i
                            class="fa fa-eye"></i></a>
                    <?php if ($previlages->UPDATE == 1) { ?>
                        <a class="label label-default openModal" id="<?php echo $row->REG_PERIOD_ID; ?>"
                           title="Update Registration Period Information" data-action="setup/regPeriodFormUpdate"
                           data-type="edit"><i class="fa fa-pencil"></i></a>
                    <?php
                    }
                    if ($previlages->DELETE == 1) {
                        ?>
                        <a class="label label-danger deleteItem" id="<?php echo $row->REG_PERIOD_ID; ?>"
                           title="Click For Delete" data-type="delete" data-field="REG_PERIOD_ID"
                           data-tbl="reg_crs_reg_period"><i class="fa fa-times"></i></a>
                    <?php
                    }

                    if ($previlages->STATUS == 1) {
                        ?>
                        <a class="itemStatus" id="<?php echo $row->REG_PERIOD_ID; ?>"
                           data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="REG_PERIOD_ID"
                           data-field="ACTIVE_STATUS" data-tbl="reg_crs_reg_period" data-su-url="setup/regPeriodById">
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
        <th>Semester</th>
        <th></th>
        <th>Action</th>
    </tr>
    </tfoot>
</table>