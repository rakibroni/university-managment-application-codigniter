<style type="text/css">
.cursor-not-allow{
    pointer-events: none !important;
}
</style>
<div class="block-flat">
    <form class="form-horizontal frmContent" id="inventory" method="post"
    action="<?php echo base_url('inventory/insertIssueReturn/'.$issueItem->ISSUE_MST_ID) ?>">   <span class="frmMsg"></span>
    <div class="col-md-12">
      <div class="panel panel-primary">
        <div id="" class="panel-collapse collapse in" aria-expanded="true">
            <div class="panel-body">
                <table class="table table-bordered">
                    <tr class="info">
                        <td colspan="10"><b class="text-warning">Requisition Details Info</b></td>
                    </tr>
                    <tr>
                        <td>Issue No : </td>
                        <td><b><?php echo $issueItem->ISSUE_NO;?></b>
                        </td>
                        <td>Issue Return No</td>
                        <td>
                            <?php
                            $count=count($pIssReNo);
                            foreach($pIssReNo as $key => $pissue){ ?>
                           <?php 
                            if($key==$count-1){
                             echo $pissue->ISSUE_RET_NO.'.'; 
                          }else{
                           echo $pissue->ISSUE_RET_NO.','; 
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
                    <td>Returnd Qty</td>
                    <td>Return Qty</td>
                </tr>

                <?php foreach ($issueItDe as $req_row) : ?>
                    <tr>
                     <input type="hidden" value="<?php //echo $req_row->REQ_MST_ID; ?>" name="REQ_MST_ID[]">
                     <input type="hidden" value="<?php echo $req_row->ISSUE_CHD_ID; ?>" name="ISSUE_CHD_ID[]">
                     <td class="col-sm-3">
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
                    <input  style="text-align: center;" type="input" name="ISSUED_QTY_P[]" value="<?php echo $req_row->ISSUED_QTY; ?>" class="form-control cursor-not-allow getIssuedQty"/>
                </td>
                <td class="col-sm-2">
                    <?php
                    $issQty=$this->db->query("SELECT SUM(ichd.ISSUED_RET_QTY) ISSUED_RET_QTY FROM inv_issue_return_chd ichd WHERE ichd.ISSUE_CHD_ID='$req_row->ISSUE_CHD_ID'")->row();
                    if(isset($issQty->ISSUED_RET_QTY)){
                        ?>
                        <input  style="text-align: center;" type="input" value="<?php echo $issQty->ISSUED_RET_QTY; ?>" class="form-control cursor-not-allow getPreviousReQty"/>
                        <?php } ?>
                    </td>
                    <td class="col-sm-4">
                     <input  style="text-align: center;" type="input" name="ISSUED_RET_QTY[]" class="form-control getIssueReQty"/>
                 </td>

             </tr>

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
    $(document).on('focusout mouseover','.getIssueReQty',function(){
        $pd=$(this).parents("tr:first");
        var issueReQty=$pd.find("input.getIssueReQty").val();
        var issuedQty=$pd.find("input.getIssuedQty").val();
        var prQty=$pd.find("input.getPreviousReQty").val();
        var sumPreCurQ=Number(issueReQty)+Number(prQty);
        var curQ=Number(issuedQty)-Number(sumPreCurQ);
        var curReQ=Number(issuedQty)-Number(prQty);
        var issueQ=Number(issuedQty);
        if(issueQ<sumPreCurQ){
         alert('Not Greater Than  ' +curReQ);
         $('.getIssueReQty').val('');
         $('.getIssueReQty').focus();
         return false;
     }else{

     }
 })
</script>