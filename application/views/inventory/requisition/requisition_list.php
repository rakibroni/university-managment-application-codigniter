<?php if ($previlages->READ == 1) { ?>
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
        <?php if (!empty($requisition_info)): ?>
            <?php $sn = 1; ?>
            <?php foreach ($requisition_info as $row) { ?>
            <tr class="gradeX" id="row_<?php echo $row->REQ_MST_ID; ?>">
                <td>
                    <span><?php echo $sn++; ?></span><span class="hidden"
                    id="loader_<?php echo $row->REQ_CHD_ID; ?>"></span></td>
                    <td><?php echo $row->REQ_NO; ?></td>
                    <td><?php echo date('d-M-Y', strtotime($row->REQ_DT)); ?></td>
                    <td><?php echo date('d-M-Y', strtotime($row->REQ_RECEIVE_DT)); ?></td>
                    <td><?php echo ($row->REQ_FOR == 'P') ? "Pesonal" : "Department"; ?></td>
                    <td><?php echo $row->LKP_NAME; ?></td>
                    <td><?php echo $row->REMARKS; ?></td>
                    <td>
                        <?php 
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
                            ?>
                            <a class="label label-success openBigModal" id="<?php echo $row->REQ_MST_ID; ?>"
                               title="View Complete Requisition Information" data-action="inventory/showCompleterequisition"
                               data-type="edit"><i class="fa fa-eye"></i>
                           </a>
                           <?php }else{?>
                            <?php if ($previlages->UPDATE == 1) { ?>
                           <a class="label label-default openBigModal" id="<?php echo $row->REQ_MST_ID; ?>"
                               title="Update Requisition Information" data-action="inventory/requisitionFormUpdate"
                               data-type="edit"><i class="fa fa-pencil"></i></a>&nbsp;<a class="label label-info" target="_blank" href="<?php echo base_url();?>/inventory/requisitionPdf/<?php echo $row->REQ_MST_ID ?>"><i class="fa fa-print"></i>
                            </a>
                               <?php } ?>
                                <?php } ?>
                               <?php

                               if (1) {
                                ?>
                        <!--<a class="label label-danger deleteThis" data_id="<?php echo $row->REQ_MST_ID; ?>"
                         ><i
                         class="fa fa-times"></i></a> -->
                         <?php
                     }

                     if (1) {
                        ?>
                     <!--   <a class="itemStatus" id="<?php echo $row->REQ_MST_ID; ?>"
                         data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="REQ_CHD_ID"
                         data-field="ACTIVE_STATUS" data-tbl="inv_requisition_chd" data-su-url="inventory/requisitionById">
                         <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Inactive">Active</span>' ?>
                     </a>-->
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
