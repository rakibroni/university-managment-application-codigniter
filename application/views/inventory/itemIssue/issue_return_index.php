<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Issue List</h5>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">

            <table class="table table-bordered gridTable"  table-title="Requisition List" table-msg="All Requisition list">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Issue No</th>
                        <th>Issue Date</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sn = 1; ?>
                   <?php foreach ($allIssue as $row) {

                    ?>
                 
                    <tr class="<?php //echo $status;?>">
                        <td><span><?php echo $sn++; ?></span></td>
                        <td><?php echo $row->ISSUE_NO; ?></td>
                        <td><?php echo date('d-M-Y', strtotime($row->ISSUE_DT)); ?></td>
                        
                        <td><?php echo $row->REMARKS; ?></td>
                        <?php //echo $total->TOTAL_ISSUE; ?>
                        <td>
                            <?php 
                           //  if($totalReq->TOTAL_REQUIREMENT_QTY==$totalIssue->TOTAL_ISSUED_QTY){
                            ?>
                            
                               <?php //}else{?>
                               <a class="label label-info openBigModal"
                               title="Issue Return" data-action="inventory/createIssueReturn/<?php echo $row->ISSUE_MST_ID ?>"
                               data-type="edit">Return</a>

                               &nbsp;<a class="label label-info" target="_blank" href="<?php echo base_url();?>/inventory/returnIssueItemPdf/<?php echo $row->ISSUE_MST_ID ?>"><i class="fa fa-print"></i>
                            </a>
                              <?php // } ?>
                           </td>
                       </tr>

                       <?php } ?>
                   </tbody>

               </table>



    </div>

</div>
</div>
