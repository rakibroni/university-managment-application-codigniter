<?php 
$data['emp_id']= $mst_leave_info->EMP_ID; 
$this->load->view("teacher/leave/leave_history",$data); 
?>
<div class="block-flat">
    <div class="col-md-12">
      <div class="panel panel-primary">
        <div id="" class="panel-collapse collapse in" aria-expanded="true">
            <div class="panel-body">
                <table class="table table-bordered">
                    <tr class="info">
                        <td colspan="6"><b class="text-warning">Leave Request Details Info</b></td>
                    </tr>
                    <tr>
                        <th>From</th>
                        <th>:</th>
                        <td><?php echo $mst_leave_info->LEAVE_FORM;?></td>
                        <th>To</th>
                        <th>:</th>
                        <td><?php echo $mst_leave_info->LEAVE_TO;?></td>

                    </tr>
                    <tr>
                        <th>Reason</th>
                        <th>:</th>
                        <td> <?php echo $mst_leave_info->LEAVE_REASON;?>
                   </td>
                   <th>Emergency Contact</th>
                   <th>:</th>
                   <td><?php echo $mst_leave_info->EMR_CONTACT;?></td>
            </tr>
            <tr>
                <th>Address During leave</th>
                <th>:</th>
                <td colspan="4"><?php echo $mst_leave_info->ADDRESS_DURING_LEAVE;?></td>
            </tr>
        </table>
    </div>
</div>
</div>

<div class="panel panel-primary">
    <div id="" class="panel-collapse collapse in" aria-expanded="true">
        <div class="panel-body">
           <table id="myTable" class="table order-list">
            <thead>
            </thead>
            <tbody>
                <tr class="info">
                    <th>Leave Type</th>
                    <th>Days</th>
                </tr>

                <?php foreach ($leave_info as $leave_row) : ?>
                    <tr>
                        <td class="col-sm-5">
                           <?php echo $leave_row->TYPE_NAME;?>
                        </td>
                        <td class="col-sm-3">
                           <?php echo $leave_row->NO_OF_DAYS;?>
                        </td>
                    </tr>
              <?php endforeach; ?>

          </tbody>

      </table>
  </div>
</div>
</div>
</div>

<div class="clearfix"></div>