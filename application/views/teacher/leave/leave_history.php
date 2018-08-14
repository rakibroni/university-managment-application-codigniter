
<div class="panel panel-primary">
    <div id="" class="panel-collapse collapse in" aria-expanded="true">
        <div class="panel-body">
            <div id="pDetails">
                <table class="table table-bordered">
                    <tr class="info">
                        <td colspan="7"><b class="text-warning">Leave History</b></td>
                    </tr>
                    <tr>
                        <th class="col-md-3 text-center">Leave Type</th>
                        <th class="col-md-3 text-center">Total Leave</th>
                        <th class="col-md-3 text-center">Enjoyed Leave</th>
                    </tr>
                    <?php
                    foreach ($leaveType as $row):
                        ?>
                        <tr>
                            <td class="text-center">
                               <?php echo $row->TYPE_NAME; ?>
                           </td>
                           <td class="text-center"><?php echo $row->TOTAL_DAYS; ?></td>
                           <td class="text-center"><?php echo $this->teacher_model->getEmpWiseLeave($emp_id,$row->LEAVE_TYPE_ID)->total_leave ?></td>
                       </tr> 
                       <?php
                   endforeach;
                   ?>
               </table>
           </div>
       </div>
   </div>
</div>