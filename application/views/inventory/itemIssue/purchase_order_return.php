<style type="text/css">
.cursor-not-allow{
    pointer-events: none !important;
}
</style>
<div class="block-flat">
    <form class="form-horizontal frmContent" id="inventory" method="post"
    action="<?php echo base_url('inventory/insertOrderReturn/'.$allPurO->PR_MST_ID) ?>">   <span class="frmMsg"></span>
    <div class="col-md-12">
      <div class="panel panel-primary">
        <div id="" class="panel-collapse collapse in" aria-expanded="true">
            <div class="panel-body">
                <table class="table table-bordered">
                    <tr class="info">
                        <td colspan="10"><b class="text-warning">Requisition Details Info</b></td>
                    </tr>
                    <tr>
                        <td>Order No : </td>
                        <td><b><?php echo $allPurO->PR_MST_NO;?></b>
                        </td>
                        <td>Order Return No</td>
                        <td>
                            <?php
                            $count=count($orderReceiveNo);
                            foreach($orderReceiveNo as $key => $pissue){ ?>
                           <?php 
                           if($key==$count-1){
                          echo $pissue->PR_RET_MST_NO.'.'; 
                          }else{
                           echo $pissue->PR_RET_MST_NO.','; 
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
                    <td>Select Item</td>   
                    <td>Select Supplier</td>                             
                    <td>Order Qty</td>  
                    <td>Received Qty</td> 
                    <td>Returned Qty</td> 
                    <td>Return Qty</td> 
                </tr>
                <?php foreach ($porder as $req_row) : ?>
                 <tr>
                    <input type="hidden" value="<?php echo $req_row->PO_CHD_ID;?>" name="PO_CHD_ID[]">
                    <td class="col-sm-3">
                        <select class="Item_dropdown form-control cursor-not-allow" name="ITEM_ID[]" id="ITEM_ID"
                        data-tags="true" data-placeholder="Select Particulars Name" data-allow-clear="true" required="required">
                        <?php
                        foreach($item_info as $itm){ ?>
                        <option  value="<?php echo $itm->ITEM_ID; ?>" <?php if($req_row->ITEM_ID==$itm->ITEM_ID) echo 'selected="selected"'?>>
                            <?php echo $itm->ITEM_NAME;?>   <?php echo $itm->UNIT_NAME;?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td class="col-sm-3">
                        <select  class="Item_dropdown form-control required cursor-not-allow" name="SUPPLIER_ID[]" id="SUPPLIER_ID"
                        data-tags="true" data-placeholder="Select Particulars Name" data-allow-clear="true" required="required">
                        <?php foreach ($supplier as $sup): ?>
                            <option  value="<?php echo $sup->SUPPLIER_ID ?>"
                                <?php if($req_row->SUPPLIER_ID==$sup->SUPPLIER_ID) echo 'selected="selected"' ?>
                                >
                                <?php echo $sup->FULL_ENAME; ?>
                            </option>
                            <?php
                        endforeach;
                        ?>
                    </select>
                </td>
                <td class="col-sm-2">
                    <input type="text" value="<?php echo $req_row->ORDER_QTY; ?>" name="ORDER_QTY[]" id="ORDER_QTY_P"  class="form-control text-center cursor-not-allow getOrderQty"/>
                </td>
                <td class="col-sm-2">
                    <input type="text"  name="RECEIVED_QTY" value="<?php echo $req_row->RECEIVE_QTY; ?>"  class="form-control text-center cursor-not-allow getOrderRecevedQty"/>
                </td>                
                 <td class="col-sm-2">       
                 <?php 
                 $re="SELECT SUM(rc.RET_RECEIVE_QTY) RET_RECEIVE_QTY FROM inv_pr_return_chd rc WHERE rc.PR_CHD_ID=?";
                 $reQty=$this->db->query($re,array($req_row->PO_CHD_ID))->row();
                 ?>     
                    <input type="input" name="" id="RET_RECEIVE_QTY"  class="form-control text-center cursor-not-allow getReturndQty" value="<?php echo $reQty->RET_RECEIVE_QTY; ?>" />
                </td>
                <td class="col-sm-4">            
                    <input type="input" name="RET_RECEIVE_QTY[]" id="RET_RECEIVE_QTY"  class="form-control text-center getReceiveQty" value="" />
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
    $(document).on('focusout','.getReceiveQty',function(){
        $pd=$(this).parents("tr:first");
        var issueReQty=$pd.find("input.getReceiveQty").val();
        var getReturndQty=$pd.find("input.getReturndQty").val();
        var getOrderRecevedQty=$pd.find("input.getOrderRecevedQty").val();
        var sumPreCuR=Number(issueReQty)+Number(getReturndQty);
        var minusQty=Number(getOrderRecevedQty)-Number(getReturndQty);
        var receivedQ=Number(getOrderRecevedQty);
        if(receivedQ<sumPreCuR){
         alert('Not Greater Than  ' + minusQty);
         $('.getReceiveQty').val('');
         $('.getReceiveQty').focus();
         return false;
     }else{

     }
 });
</script>