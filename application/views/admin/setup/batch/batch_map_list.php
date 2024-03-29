<?php if ($previlages->READ == 1) { ?> 
    <table class="table table-striped table-bordered table-hover gridTable">
        <thead>
        <tr>
            <th>SL</th>
            <th>Name</th>            
            <th>Program</th> 
            <th>Session</th> 
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php  if (!empty($batch)): $sn = 1; ?>
            <?php foreach ($batch as $row) { ?>
                <tr class="gradeX" id="row_<?php echo $row->BATCH_PROG_ID; ?>">
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                        <span><?php echo $sn++; ?></span><span class="hidden"
                                                               id="loader_<?php echo $row->BATCH_PROG_ID; ?>"></span></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->BATCH_TITLE; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->PROGRAM_NAME; ?></td> 
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->SESSION_NAME; ?></td> 

                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                        
                            <!-- <a class="label label-default openModal" id="<?php echo $row->BATCH_PROG_ID; ?>"
                               title="Update Batch Information" data-action="setup/batchFormUpdate" data-type="edit"><i
                                    class="fa fa-pencil"></i></a> -->
                          <?php if ($previlages->DELETE == 1) {
                        ?>
                            <a class="label label-danger deleteItem" id="<?php echo $row->BATCH_PROG_ID; ?>"
                               title="Click For Delete" data-type="delete" data-field="BATCH_PROG_ID" data-tbl="aca_batch_prog"><i
                                    class="fa fa-times"></i></a>
                                     <?php
                                  }

                                ?>
                        
                           <!--  <a class="itemStatus" id="<?php echo $row->BATCH_PROG_ID; ?>"
                              data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="BATCH_PROG_ID"
                              data-field="ACTIVE_STATUS" data-tbl="aca_batch_prog" data-su-url="setup/batchById">
                               <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Active">Active</span>' ?>
                           </a> -->
                        
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