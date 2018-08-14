<div class="block-flat">
    <form class="form-horizontal frmContent" id="inventory" method="post" action="<?php //echo base_url('inventory/createPurchaseOrderReceive/'.$pOrder->PO_MST_ID) ?>">
        <span class="frmMsg"></span>
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div id="" class="panel-collapse collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="col-sm-3">  
                            <table class="table table-bordered">
                                <tr class="info">
                                    <td colspan="5"><b class="text-warning">Purchase Order Details</b></td>
                                </tr>
                                <tr>
                                    <th>PO No:</th>
                                    <td><b>
                                     <!--<a class="label label-default openBigModal" data-action="inventory/receivePurchageOrder/<?php //echo $pOrder->PO_MST_ID?>"> <?php //echo $pOrder->PO_NO; ?>
                                     </a>-->
                                     <?php echo $pOrder->PO_NO; ?>
                                 </b></td>
                             </tr>
                             <tr>
                                <th>Date: </th>
                                <td><?php //echo $pOrder->PO_DATE; ?></td>
                            </tr>
                            <tr>
                                <th>Remarks:</th>
                                <td>
                                 <?php //echo $pOrder->REMAREK;?>
                             </td>
                         </tr>
                     </table>
                 </div>
                 <div class="col-sm-2">  
                    <table class="table table-bordered">
                        <tr class="info">
                            <td colspan="5"><b class="text-warning">
                            Receive Order No</b></td>
                        </tr>
                        <tr>
                            <th>Receive No:</th>
                            <td>
                               <?php foreach($p_r as $pr){ ?>
                               <b>
                                 <a class="label label-default openBigModal" data-action="inventory/showReceivePurchageOrder/<?php //echo $pOrder->PO_MST_ID?>"> <?php //echo $pr->PR_MST_NO; ?>
                                     </a>
                               
                                    
                                </b>
                               <?php } ?>
                           </td>
                       </tr>
                   </table>
               </div>
              <div class="col-sm-2">  
                <table class="table table-bordered">
                    <tr class="info">
                        <td colspan="8"><b class="text-warning">
                        Receive Order Info</b></td>
                    </tr>
                    <tr>

                        <td>
                           lll
                       </td>

                   </tr>
               </table>
           </div>
       </div>
   </div>
</div>
<div class="panel panel-primary">
    <div id="" class="panel-collapse collapse in" aria-expanded="true">
        <div class="panel-body">
          <table id="myTable" class=" table order-list"> 
            <tbody>
                <tr class="info">
                    <td>Select Item</td>   
                    <td>Select Supplier</td>                             
                    <td>Order Qty</td>   
                    <td>Reveive Qty</td> 
                </tr>
                <?php foreach ($poDetails as $key => $value) {?>
                <tr>
                    <input type="hidden" value="<?php echo $value->PO_MST_ID;?>" name="PO_MST_ID[]">
                    <input type="hidden" value="<?php echo $value->PO_CHD_ID;?>" name="PO_CHD_ID[]">
                    <td class="col-sm-4">
                        <select class="Item_dropdown form-control" name="ITEM_ID[]" id="ITEM_ID"
                        data-tags="true" data-placeholder="Select Particulars Name" data-allow-clear="true" required="required">
                        <?php
                        foreach($po_details as $itma){ ?>
                        <option  value="<?php echo $itm->ITEM_ID; ?>" <?php if($value->ITEM_ID==$itma->ITEM_ID) echo 'selected="selected"'?>>
                            <?php echo $itma->ITEM_ID;?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td class="col-sm-4">
                        <select readonly="readonly" class="Item_dropdown form-control required" name="SUPPLIER_ID[]" id="SUPPLIER_ID"
                        data-tags="true" data-placeholder="Select Particulars Name" data-allow-clear="true" required="required">
                        <?php foreach ($supplier as $sup): ?>
                            <option  value="<?php echo $sup->SUPPLIER_ID ?>"
                                <?php if($value->SUPPLIER_ID==$sup->SUPPLIER_ID) echo 'selected="selected"' ?>
                                >
                                <?php echo $sup->FULL_ENAME; ?>
                            </option>
                            <?php
                        endforeach;
                        ?>
                    </select>
                </td>
                <td class="col-sm-2">
                    <input type="text" readonly="readonly" value="<?php echo $value->ORDER_QTY; ?>" name="ORDER_QTY[]" id="ORDER_QTY_P" required="required"  class="form-control text-center"/>
                </td>
                <td class="col-sm-3">
                    <input type="text" name="RECEIVE_QTY[]" id="RECEIVE_QTY" required="required"  class="form-control text-center"/>
                </td>

            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>


</form>
</div>
<script>


 $( function() {
    $( ".datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'dd-mm-yy' ,
      yearRange: "-50:+0",
      autoclose:true,
      startDate: '-0d',
  });
} );


 function calculateRow(row) {
    var price = +row.find('input[name^="price"]').val();

}

function calculateGrandTotal() {
    var grandTotal = 0;
    $("table.order-list").find('input[name^="price"]').each(function () {
        grandTotal += +$(this).val();
    });
    $("#grandtotal").text(grandTotal.toFixed(2));
}
</script>