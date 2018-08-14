<table class="table table-striped table-bordered table-hover gridTable">
    <thead>
    <tr>
        <th>SN</th>
        <th>POLICY NAME</th>
        <th>POLICY DESC</th>
        <th>POLICY FLAG</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $sn = 0;
    foreach ($app_policy as $row) {
        $sn = $sn + 1;
        ?>
        <tr class="gradeX" id="row_<?php echo $row->POLICY_ID; ?>">
            <td <?php echo ($row->ACTIVE_FLAG == 1) ? "" : "class='inactive'"; ?>><span><?php echo $sn; ?></span><span
                    class="hidden" id="loader_<?php echo $row->POLICY_ID; ?>"></span></td>
            <td <?php echo ($row->ACTIVE_FLAG == 1) ? "" : "class='inactive'"; ?>><?php echo $row->POLICY_NAME; ?></td>
            <td <?php echo ($row->ACTIVE_FLAG == 1) ? "" : "class='inactive'"; ?>><?php  echo $row->POLICY_DESC;  ?></td>
            <td <?php echo ($row->ACTIVE_FLAG == 1) ? "" : "class='inactive'"; ?>><?php  echo ($row->POLICY_FLAG == 1)?"YES":"NO";  ?></td>
            <td <?php echo ($row->ACTIVE_FLAG == 1) ? "" : "class='inactive'"; ?>>
                <a class="label label-default openModal" id="<?php echo $row->POLICY_ID; ?>"
                   title="Update app policy  Information" data-action="setup/appPolicyFormUpdate" data-type="edit"><i
                        class="fa fa-pencil"></i></a>
                <a class="label label-danger deleteItem" id="<?php echo $row->POLICY_ID; ?>" title="Click For Delete"
                   data-type="delete" data-field="POLICY_ID" data-tbl="app_polciy"><i class="fa fa-times"></i></a>

                <a class="itemStatus" id="<?php echo $row->POLICY_ID; ?>"
                   data-status="<?php echo $row->ACTIVE_FLAG ?>" data-fieldId="POLICY_ID" data-field="ACTIVE_FLAG"
                   data-tbl="app_policy" data-su-url="setup/appPolicyById">
                    <?php echo ($row->ACTIVE_FLAG == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Inactive">Active</span>' ?> </a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
