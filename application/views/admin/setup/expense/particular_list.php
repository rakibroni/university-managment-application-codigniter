<?php if ($previlages->READ == 1) { ?>
    <table class="table table-striped table-bordered table-hover gridTable">
        <thead>
        <tr>
            <th>SN</th>
            <th>Session</th>
            <th>Semester</th>
            <th>Program</th>
            <th>Department</th>
            <th>Faculty</th>
            <th>Particular Name</th>
            <th>Amount(BDT)</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($particular)): ?>
            <?php $sn = 1; ?>
            <?php foreach ($particular as $row) { ?>
                <tr class="gradeX" id="row_<?php echo $row->P_PARTICULAR_ID; ?>">
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                        <span><?php echo $sn++; ?></span><span class="hidden"
                                                               id="loader_<?php echo $row->P_PARTICULAR_ID; ?>"></span>
                    </td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->SESSION_NAME; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->SEMESTER; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->PROGRAM; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->DEPARTMENT; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->FACULTY; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->PARTICULER; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo number_format($row->PARTICULAR_AMOUNT, 2); ?></td>
                    <td style="width: 140px" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                        <?php if ($previlages->DELETE == 1) { ?>
                            <a class="label label-danger deleteItem" id="<?php echo $row->P_PARTICULAR_ID; ?>"
                               title="Click For Delete" data-action="setup/deleteDegree" data-type="delete"
                               data-field="P_PARTICULAR_ID" data-tbl="ac_program_particulars"><i
                                    class="fa fa-times"></i></a>
                        <?php }
                        if ($previlages->STATUS == 1) { ?>
                            <a class="itemStatus" id="<?php echo $row->P_PARTICULAR_ID; ?>"
                               data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="P_PARTICULAR_ID"
                               data-field="ACTIVE_STATUS" data-tbl="ac_program_particulars"
                               data-su-url="setup/particulerById">
                                <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Inactive">Active</span>' ?>
                            </a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        <?php endif; ?>
        </tbody>
        <tfoot>
        <tr>
            <th>SN</th>
            <th>Particular Name</th>
            <th>Amount(BDT)</th>
            <th>Semester</th>
            <th>Session</th>
            <th>Program</th>
            <th>Department</th>
            <th>Faculty</th>
            <th>Action</th>
        </tr>
        </tfoot>
    </table>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>
