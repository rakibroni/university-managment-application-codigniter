<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Purchase Order List</h5>
        <?php //if ($previlages->CREATE == 1) { ?>
        <!--<div class="ibox-tools">
            <span title="Create Purchage Order" class="btn btn-primary btn-xs pull-right openBigModal"
            data-action="inventory/createPurchaseOrder"> Add New </span>
        </div>-->
        <?php //} ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">

            <table class="table table-bordered gridTable"  table-title="Requisition List" table-msg="All Requisition list">
                <thead>
                    <tr>
                        <th>SN</th>                             
                        <th>Purchase order No</th>                   
                        <th>Purchase order Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($poLIst)): ?>
                        <?php $sn = 1; ?>
                        <?php 
                        //echo '<pre>';print_r($poLIst);exit;
                        foreach ($poLIst as $row) {
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
                         <tr class="<?php echo $status;?>">
                            <td><?php echo $sn; ?></td>
                            <td><?php echo $row->PO_NO; ?></td>
                            <td><?php echo date('d-M-Y',strtotime($row->PO_DATE)); ?></td>                                   
                            <?php //echo $totalRe->TOTAL_RECEIVE; ?>
                            <td>
                                <?php 
                                 if($orderQty->ORDER_QTY==$totalRe->TOTAL_RECEIVE){
                                ?>
                                <a class="label label-success openBigModal" title="
                                Receive Purchase Order" data-type="edit" data-action="inventory/completeRePurchageOrder/<?php echo $row->PO_MST_ID ?>">
                                <i class="fa fa-eye"></i>
                            </a>
                                <?php }else{ ?>
                                <a class="label label-success openBigModal" title="
                                Receive Purchase Order" data-type="edit" data-action="inventory/receivePurchageOrder/<?php echo $row->PO_MST_ID ?>">
                                <i class="fa fa-cog"></i> PO Receive
                            </a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php $sn++; } ?>
                    <?php 

                endif; 
                ?>
            </tbody>

        </table>

    </div>

</div>
</div>
