  <?php if ($previlages->READ == 1) { ?>
  <table class="table table-striped table-bordered table-hover gridTable">
    <thead>
        <tr>
            <th>SL</th>
            <th>Charge Name</th>
            <th>Amount</th>
            <th>Academic Session</th>
            <th>Program</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($financeRate)): $sn = 1; ?>
            <?php foreach ($financeRate as $row) { ?>
            <tr class="gradeX" id="row_<?php echo $row->RATE_ID; ?>">
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <span><?php echo $sn++; ?></span><span class="hidden" id="loader_<?php echo $row->RATE_ID; ?>"></span></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->AC_NAME; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->AMOUNT; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->SESSION_NAME; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->PROGRAM_NAME; ?></td>                                      
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                      <?php if ($previlages->UPDATE == 1) { ?>
                      <a class="label label-default openModal" id="<?php echo $row->RATE_ID; ?>"
                         title="Update Finance Rate Information" data-action="finance/financeRateEdit"
                         data-type="edit"><i class="fa fa-pencil"></i></a>
                         <?php
                     }
                     if ($previlages->DELETE == 1) {
                        ?>
                        
                        <a class="label label-danger deleteItem2" id="<?php echo $row->RATE_ID; ?>"
                         title="Click For Delete" data-type="delete" data-field="RATE_ID" data-tbl="fn_academic_charge_rate" data-action="finance/deleteItem"><i
                         class="fa fa-times"></i></a>
                         <?php
                     }

                     if ($previlages->STATUS == 1) {
                        ?>
                        <a class="itemStatus2" id="<?php echo $row->RATE_ID; ?>"
                         data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="RATE_ID"
                         data-field="ACTIVE_STATUS" data-tbl="fn_academic_charge_rate" data-su-url="finance/financeRateById" data-action="finance/statusItem">
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
 
</table>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>