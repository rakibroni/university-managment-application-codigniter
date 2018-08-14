
<?php 
$data['emp_id']= $emp_id; 
//$this->load->view("admin/leave_report/leave_history",$data); 
?>
<div class="panel panel-primary">
    <div id="" class="panel-collapse collapse in" aria-expanded="true">
        <div class="panel-body">
            <div id="pDetails">
            <?php
              foreach ($leaveType as $key => $row) { 
                //$leavChd = $this->utilities->findAllByAttribute('hr_leave_approved_chd', array('LEAVE_APPROVE_MST_ID' => $row->LEAVE_APPROVE_MST_ID ));
                $leavChd = $this->teacher_model->getAllLeaveTypeInfoDetails($emp_id);
                 
                ?>
                <table class="table table-bordered">
                    <tr>
                       <!--  <th class="col-md-3 text-center">Leave Type <?php echo $row->LEAVE_APPROVE_MST_ID?></th> -->
                        <td class="text-center">
                          <b><?php echo date('d-M-Y', strtotime($row->LEAVE_FORM)) . ' - ' . date('d-M-Y', strtotime($row->LEAVE_TO)); ?></b>
                        </td>
                    </tr>
                    <tr>
                    
                     <table class="table table-bordered">
                        <tr>
                           <th class="col-md-3 text-center">Type Name</th>
                         <th class="col-md-3 text-center">Days</th>
                    
                        </tr>
                        <?php foreach ($leavChd as $chdrow):?>

                        <tr>
                         <td class="text-center"><?php echo $chdrow->TYPE_NAME ?></td>
                         <td class="text-center"><?php echo $chdrow->NO_OF_DAYS ?></td>
                    
                        </tr>
                          <?php endforeach; ?>
                      </table>
                    
                    </tr>

                  </table>
              <?php }
            ?>

           </div>
       </div>
   </div>
</div>