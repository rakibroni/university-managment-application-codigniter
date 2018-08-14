<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Purchase List</h5>
        <?php if ($previlages->CREATE == 1) { ?>
        <div class="ibox-tools">
            <span title="Create Purchage Order" class="btn btn-primary btn-xs pull-right openBigModal"
            data-action="inventory/createPurchaseOrder"> Add New </span>
        </div>
        <?php } ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php if ($previlages->READ == 1) { ?>
            <table class="table table-bordered gridTable"  table-title="Requisition List" table-msg="All Requisition list">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Purchase order Date</th>
                        <th>Purchase order No</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($poLIst)): ?>
                        <?php $sn = 1; ?>
                        <?php foreach ($poLIst as $row) { 
                            $orderQty=$this->db->query("SELECT SUM(pch.ORDER_QTY) ORDER_QTY
                                FROM inv_po_mst pom
                                LEFT JOIN inv_po_chd pch ON pch.PO_MST_ID=pom.PO_MST_ID
                                WHERE pom.PO_MST_ID='$row->PO_MST_ID'
                                ")->row();
                            $totalRe=$this->db->query("SELECT SUM(prc.RECEIVE_QTY) TOTAL_RECEIVE
                                FROM inv_po_mst pom
                                LEFT JOIN inv_po_chd pch ON pch.PO_MST_ID=pom.PO_MST_ID
                                LEFT JOIN inv_pr_chd prc ON prc.PO_CHD_ID=pch.PO_CHD_ID
                                WHERE pom.PO_MST_ID='$row->PO_MST_ID'
                                ")->row();
                            if($orderQty->ORDER_QTY==$totalRe->TOTAL_RECEIVE){
                                $status="danger";
                            } else{
                               $status='';
                           }

                           ?>
                           <tr class="<?php //echo $status;?>">
                            <td><?php echo $sn;?></td>
                            <td><?php echo date('d-M-Y',strtotime($row->PO_DATE)); ?></td>
                            <td><?php echo $row->PO_NO; ?></td>
                            <td>
                                <?php if($orderQty->ORDER_QTY==$totalRe->TOTAL_RECEIVE){?><a class="label label-success openBigModal" title="View Completed Purchage Order" data-type="edit" data-action="inventory/showCompletePurchageOrder/<?php echo $row->PO_MST_ID ?>">
                                    <i class="fa fa-eye"></i>
                                </a>                    
                                <?php     } else{ ?>
                                <?php if ($previlages->UPDATE == 1) { ?>
                                <a class="label label-default openBigModal" title="Edit Purchage Order" data-type="edit" data-action="inventory/editPurchageOrder/<?php echo $row->PO_MST_ID ?>">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <?php } ?>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php $sn++; } ?>
                        <?php 
                        
                    endif; 
                    ?>
                </tbody>

            </table>
            <?php
        } else {
            echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
        }
        ?>
    </div>

</div>
</div>
