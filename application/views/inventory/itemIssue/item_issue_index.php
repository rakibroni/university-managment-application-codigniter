<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Requisition List</h5>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">

            <table class="table table-bordered gridTable"  table-title="Requisition List" table-msg="All Requisition list">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Requisition No</th>
                        <th>Requisition Date</th>
                        <th>Requisition Receive Date</th>
                        <th>Requisition For</th>
                        <th>Requisition Type</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sn = 1; ?>
                    <?php foreach ($requisition_info as $row) {
                       $totalReq=$this->db->query("SELECT SUM(rc.REQUIREMENT_QTY) TOTAL_REQUIREMENT_QTY
                        FROM inv_requisition_mst rm
                        LEFT JOIN inv_requisition_chd rc ON rm.REQ_MST_ID=rc.REQ_MST_ID
                        WHERE rm.REQ_MST_ID='$row->REQ_MST_ID'")->row();
                       $totalIssue=$this->db->query(" SELECT SUM(ich.ISSUED_QTY) TOTAL_ISSUED_QTY
                        FROM inv_requisition_mst rm
                        LEFT JOIN inv_requisition_chd rc ON rm.REQ_MST_ID=rc.REQ_MST_ID
                        LEFT JOIN inv_issue_chd ich ON ich.REQ_CHD_ID=rc.REQ_CHD_ID
                        WHERE rm.REQ_MST_ID='$row->REQ_MST_ID'")->row();
                       if($totalReq->TOTAL_REQUIREMENT_QTY==$totalIssue->TOTAL_ISSUED_QTY){
                        echo $status='danger';
                    }else{
                        echo $status='';
                    }
                    ?>
                    <tr class="<?php echo $status;?>" id="row_<?php echo $row->REQ_MST_ID; ?>">
                        <td>
                            <span><?php echo $sn++; ?></span>
                            <span class="hidden" id="loader_<?php echo $row->REQ_CHD_ID; ?>"></span>
                        </td>
                        <td><?php echo $row->REQ_NO; ?></td>
                        <td><?php echo date('d-M-Y', strtotime($row->REQ_DT)); ?></td>
                        <td><?php echo date('d-M-Y', strtotime($row->REQ_RECEIVE_DT)); ?></td>
                        <td><?php echo ($row->REQ_FOR == 'P') ? "Pesonal" : "Department"; ?></td>
                        <td><?php echo $row->LKP_NAME; ?></td>
                        <td><?php echo $row->REMARKS; ?></td>
                        <?php //echo $total->TOTAL_ISSUE; ?>
                        <td>
                            <?php 
                             if($totalReq->TOTAL_REQUIREMENT_QTY==$totalIssue->TOTAL_ISSUED_QTY){
                            ?>
                            <a class="label label-success openBigModal" id="<?php echo $row->REQ_MST_ID; ?>"
                               title="Show Complete Issue Item" data-action="inventory/showCompleteIssueItem/<?php echo $row->REQ_MST_ID ?>"
                               data-type="edit"><i class="fa fa-eye"></i></a>
                               <?php }else{?>
                                <a class="label label-success openBigModal" id="<?php echo $row->REQ_MST_ID; ?>"
                               title="Issue Item" data-action="inventory/issueItemCreate/<?php echo $row->REQ_MST_ID ?>"
                               data-type="edit"><i class="fa fa-eye"></i> Issue</a>
                               &nbsp;<a class="label label-info" target="_blank" href="<?php echo base_url();?>/inventory/createIssueItemPdf/<?php echo $row->REQ_MST_ID ?>"><i class="fa fa-print"></i>
                            </a>
                              <?php  } ?>
                           </td>
                       </tr>

                       <?php } ?>
                   </tbody>

               </table>


               <script>
                $(document).on('click', '.deleteThis', function () {

                  var m_id = $(this).attr("data_id");

                  var r = confirm("Are you sure, want to delete?");

                  if(r == true)
                  {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo site_url() ?>/inventory/deleteMasterRow',
                        data: {m_id: m_id},
                        success: function (data) {
                           if (data == "Y") {
                            $("#row_" + m_id).remove();
                        } else {
                            alert("Row Delete Field");
                        }

                    }      

                });

                }    

            });
        </script>

    </div>

</div>
</div>
