<style type="text/css">
.cursor-not-allow{
    pointer-events: none !important;
}
</style>
<div class="block-flat">
    <form class="form-horizontal frmContent" id="inventory" method="post"
    action="<?php echo base_url('inventory/saveIssueItem/'.$mst_data_info->REQ_MST_ID) ?>">
    

    <input type="hidden" class="rowID" name="mstId" value="<?php  echo $mst_data_info->REQ_MST_ID ?>"/>

    <span class="frmMsg"></span>
    <div class="col-md-12">
      <div class="panel panel-primary">
        <div id="" class="panel-collapse collapse in" aria-expanded="true">
            <div class="panel-body">
                <table class="table table-bordered">
                    <tr class="info">
                        <td colspan="10"><b class="text-warning">Requisition Details Info</b></td>
                    </tr>
                    <tr>
                        <td>Requisition No : </td>
                        <td><b><?php echo $mst_data_info->REQ_NO;?></b>
                        </td>
                        <td>Issue No</td>
                        <td>
                            <?php
                            $count=count($previousIssue);
                            foreach($previousIssue as $key => $pissue){ ?>
                            <?php 
                            if($key==$count-1){
                                echo $pissue->ISSUE_NO.'.'; 
                            }else{
                                echo $pissue->ISSUE_NO.','; 
                            }
                            ?>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Remarks</td>
                        <td><textarea name="REMARKS"></textarea></td>                       
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
                        <td>Particulars Name</td>
                        <td>Demand Qty</td>
                        <td>Stock</td>
                        <td>Issued Qty</td>
                        <td>Issue Qty</td>
                    </tr>

                    <?php foreach ($req_info as $req_row) : ?>
                        <tr>
                         <input type="hidden" value="<?php echo $req_row->REQ_MST_ID; ?>" name="REQ_MST_ID[]">
                         <input type="hidden" value="<?php echo $req_row->REQ_CHD_ID; ?>" name="REQ_CHD_ID[]">
                         <td class="col-sm-4">
                            <select required="required" class="Item_dropdown form-control cursor-not-allow" name="ITEM_ID[]" id="ITEM_NAME"
                            data-tags="true" data-placeholder="Select Particulars Name" data-allow-clear="true">
                            <?php

                            foreach ($item_info as $row):
                                ?>
                                <option
                                value="<?php echo $row->ITEM_ID ?>" <?php echo ($req_row->ITEM_ID == $row->ITEM_ID) ? 'selected' : '' ?>><?php echo $row->ITEM_NAME . " (" . $row->UNIT_NAME . ")"; ?></option>
                                <?php
                            endforeach;
                                 // if the form action is VIEW
                            ?>

                            <?php
                            foreach ($item_info as $row):
                                ?>
                                <option value="<?php echo $row->ITEM_ID ?>"><?php echo $row->ITEM_NAME . " (" . $row->UNIT_NAME . ")"; ?></option>
                                <?php
                            endforeach;
                            ?>
                        </select>
                    </td>
                    <td class="col-sm-2">
                        <input style="text-align: center;" type="input" name="REQUIREMENT_QTY[]" value="<?php echo $req_row->REQUIREMENT_QTY; ?>" class="form-control cursor-not-allow demandQty"/>
                    </td>
                    <td class="col-sm-2">
                        <input style="text-align: center;" type="text" name="STOCK[]" value="<?php $stock_balance=$this->inventory_model->itemStock($req_row->ITEM_ID);
                          if(!empty($stock_balance->BALANCE)): 
                            echo $stock_balance->BALANCE ;
                            endif; ?>" class="form-control cursor-not-allow" readonly/>
                    </td>
                    
                    <td class="col-sm-2">
                        <input  style="text-align: center;" type="text" name="ISSUED_QTY_P[]" value="<?php echo $req_row->TOTAL_ISSUED_QTY; ?>" class="form-control cursor-not-allow getIssuedQty"/>

                    </td>
                    <td>
                        <?php
                        $demand=$this->db->query("SELECT rchd.REQUIREMENT_QTY FROM inv_requisition_chd rchd WHERE rchd.REQ_CHD_ID='$req_row->REQ_CHD_ID'")->row();
                        $issuedQty=$this->db->query("SELECT SUM(isse.ISSUED_QTY) TOTAL_ISSUED_QTY FROM inv_issue_chd isse WHERE isse.REQ_CHD_ID='$req_row->REQ_CHD_ID'")->row();
                        $demand=$req_row->REQUIREMENT_QTY.'<br>';
                        $toIsseQ=$req_row->TOTAL_ISSUED_QTY.'<br>';
                        if($demand == $toIsseQ){
                           ?>
                          <input readonly="readonly"  name="ISSUED_QTY[]" style="text-align: center; background-color: #ccf5ff;" type="text"   class="form-control getIssueQty"/>
                           <?php }else{?>
                           <input  style="text-align: center;" type="text" name="ISSUED_QTY[]" class="form-control getIssueQty"/>
                           <?php }
                           ?>
                       </td>

                </tr>
                <input type="hidden" class="rowID" name="txtReqId[]" value="<?php  echo $req_row->REQ_CHD_ID ?>"/>

            <?php endforeach; ?>

        </tbody>

    </table>
</div>
</div>
</div>
</div>

<section>
    <div class="form-group">
        <div class="col-lg-offset-5 col-lg-10">
            <span class="modal_msg pull-left"></span>
            <input type="submit" class="btn btn-primary btn-sm " value="submit">
            <span class="loadingImg"></span>
        </div>
    </div>
</section>
</form>
</div>

<script type="text/javascript">
    $(document).on('focusout mouseout','.getIssueQty',function(){
        $pd=$(this).parents("tr:first");
        var orderQ=$pd.find("input.demandQty").val();
        var issueQty=$pd.find("input.getIssueQty").val();
        var issuedQty=$pd.find("input.getIssuedQty").val();
        var sumIssudIssue=Number(issueQty)+Number(issuedQty);
        var comingQty=Number(orderQ)-Number(issuedQty);
        if(orderQ<sumIssudIssue){
            alert('Not Greater Than ' + comingQty);
            $('.getIssueQty').val('');
            $('.getIssueQty').focus();
            return false;
        }else{

        }
    })
</script>