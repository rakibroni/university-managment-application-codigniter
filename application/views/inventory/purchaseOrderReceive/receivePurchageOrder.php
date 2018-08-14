<style type="text/css">
.curson-not-allowed{
 pointer-events: none !important;
}
</style>
<div class="block-flat">
  <form class="form-horizontal frmContent" id="inventory" method="post" action="<?php echo base_url('inventory/createPurchaseOrderReceive/'.$pOrder->PO_MST_ID) ?>">
    <span class="frmMsg"></span>
    <div class="col-md-12">
      <div class="panel panel-primary">
        <div id="" class="panel-collapse collapse in" aria-expanded="true">
          <div class="panel-body">
            <div class="col-sm-6">  
              <table class="table table-bordered">
                <tr class="info">
                  <td colspan="5"><b class="text-warning">Purchase Order Details</b></td>
                </tr>
                <tr>
                  <th>PO No:</th>
                  <td><b>
                                     <!--<a class="label label-default openBigModal" data-action="inventory/receivePurchageOrder/<?php echo $pOrder->PO_MST_ID?>">
                                     </a>-->
                                     <?php echo $pOrder->PO_NO; ?>
                                   </b></td>
                                 </tr>
                                 <tr>
                                  <th>Date: </th>
                                  <td><?php echo date('d-M-Y',strtotime($pOrder->PO_DATE)); ?></td>
                                </tr>
                                <tr>
                                  <th>Remarks:</th>
                                  <td>
                                   <?php echo $pOrder->REMAREK;?>
                                 </td>
                               </tr>
                             </table>
                           </div>
                           <div class="col-sm-6">  
                            <table class="table table-bordered">
                              <tr class="info">
                                <td colspan="5"><b class="text-warning">
                                Received Order No</b></td>
                              </tr>
                              <tr>
                                <th>Receive No:</th>
                                <td>
                                 <?php 
                                 $count=count($p_r);
                                 foreach($p_r as $key => $pr){ ?>
                                 <b class="getPrMSTNO">
                                  <?php 
                                  if($key==($count-1)){
                                    echo $pr->PR_MST_NO.'.';    
                                  }else{
                                    echo $pr->PR_MST_NO.',';

                                  }
                                  ?>

                                </b>
                                <?php } ?>
                              </td>
                            </tr>
                          </table>
                        </div>
             <!-- <div class="col-sm-2">  
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
             </div>-->
           </div>
         </div>
       </div>
       <div class="panel panel-primary">
        <div id="" class="panel-collapse collapse in" aria-expanded="true">
          <div class="panel-body">
            <table id="myTable" class=" table order-list"> 
             <span class="showReceiveQty" style="margin-left: 650px; color: red;"  ></span>
             <tbody>
              <tr class="info">
                <td>Select Item</td>   
                <td>Select Supplier</td>                             
                <td>Order Qty</td>  
                <td>Received Qty</td> 
                <td>Reveive Qty</td> 
                <td>Unit Price</td> 
                <td>Total Price</td> 
                <td>Remarks</td> 
              </tr>
              <?php 
              $total_row=0; 
              foreach ($poDetails as $key => $value) {
                $total_row++;
                ?>
                <tr>
                  <input type="hidden" id="PO_MST_ID" value="<?php echo $value->PO_MST_ID;?>" name="PO_MST_ID[]">
                  <input type="hidden" value="<?php echo $value->PO_CHD_ID;?>" name="PO_CHD_ID[]">
                  <td class="col-sm-3">
                    <select class="Item_dropdown form-control curson-not-allowed" name="ITEM_ID[]" id="ITEM_ID"
                    data-tags="true" data-placeholder="Select Particulars Name" data-allow-clear="true" required="required">
                    <?php
                    foreach($item as $itm){ ?>
                    <option  value="<?php echo $itm->ITEM_ID; ?>" <?php if($value->ITEM_ID==$itm->ITEM_ID) echo 'selected="selected"'?>>
                      <?php echo $itm->ITEM_NAME;?></option>
                      <?php } ?>
                    </select>
                  </td>
                  <td class="col-sm-3">
                    <select  class="Item_dropdown form-control required curson-not-allowed" name="SUPPLIER_ID[]" id="SUPPLIER_ID"
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
                <td style="width: 70px;" class="col-sm-2">
                  <input type="text" value="<?php echo $value->ORDER_QTY; ?>" name="ORDER_QTY[]" id="ORDER_QTY_P" required="required"  class="form-control text-center curson-not-allowed getOrderQty"/>
                </td>
                <td style="width: 70px;" class="col-sm-2">
                  <input type="text"  name="RECEIVED_QTY" value="<?php echo $value->RECEIVE_QTY; ?>"  class="form-control text-center curson-not-allowed getRecevedQty"/>
                </td>                

                <td style="width: 100px;" class="col-sm-2">
                 <?php
                 $poOrder=$this->db->query("SELECT poc.ORDER_QTY FROM inv_po_chd poc WHERE poc.PO_MST_ID='$value->PO_MST_ID'")->row();
                 $prReceive=$this->db->query("SELECT SUM(prc.RECEIVE_QTY) RECEIVE_QTY FROM inv_pr_chd prc WHERE prc.PO_CHD_ID='$value->PO_CHD_ID'")->row();
            // $orderQ= $poOrder->ORDER_QTY;
             //$receiveQ= $prReceive->RECEIVE_QTY;
                 $orderQ=$value->ORDER_QTY.'<br>';
                 $receiveQ=$value->RECEIVE_QTY.'<br>';
                 if($orderQ == $receiveQ){
                  ?>
                  <input type="text"  style="background-color: #ccf5ff;" name="RECEIVE_QTY[]" id="RECEIVE_QTY_I" class="form-control text-center getReceiveQty curson-not-allowed"/>
                  <?php }else{?>
                  <input type="input" name="RECEIVE_QTY[]" id="RECEIVE_QTY_ID_<?php echo $total_row;?>"  class="form-control text-center getReceiveQty receiveQt" value="" />

                  <?php }
                  ?>

                </td>              

                <td style="width: 70px;" class="col-sm-3">
                 <?php
                 $poOrder=$this->db->query("SELECT poc.ORDER_QTY FROM inv_po_chd poc WHERE poc.PO_MST_ID='$value->PO_MST_ID'")->row();
                 $prReceive=$this->db->query("SELECT SUM(prc.RECEIVE_QTY) RECEIVE_QTY FROM inv_pr_chd prc WHERE prc.PO_CHD_ID='$value->PO_CHD_ID'")->row();
            // $orderQ= $poOrder->ORDER_QTY;
             //$receiveQ= $prReceive->RECEIVE_QTY;
                 $orderQ=$value->ORDER_QTY.'<br>';
                 $receiveQ=$value->RECEIVE_QTY.'<br>';
                 if($orderQ == $receiveQ){
                  ?>
                  <input type="text" name="UNIT_PRICE[]" style="background-color: #ccf5ff;"  class="form-control getUnitPrice" id="unit_price_<?php echo $total_row;?>">
                  <?php }else{?>
                  <input type="text" name="UNIT_PRICE[]"  class="form-control getUnitPrice" id="unit_price_<?php echo $total_row;?>">
                  <?php } ?>
                </td>
                <td style="width: 70px;" class="col-sm-3">
                  <input type="text" readonly="readonly" name="" class="form-control sumTotalPrice" id="total_price_<?php echo $total_row;?>" >

                </td>
                <td style="width: 100px;" class="col-sm-3">
                  <input type="text" name="REMARKS[]" class="form-control">
                </td>
              </tr>

              <?php } ?>
              <input type="hidden" id="total_row" value="<?php echo $total_row?>">
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
        <input type="submit" class="btn btn-primary btn-sm " id="checkOrderQty" value="submit">
        <span class="loadingImg"></span>
      </div>
    </div>
  </section>


</form>
</div>
<script>
  $(document).on('keyup','.getUnitPrice',function(){
    $pd= $(this).parents("tr:first");
    $getUnitPrice=$pd.find("input.getUnitPrice").val();
    $receiveQt=$pd.find("input.receiveQt").val();
    $('.receiveQt').each(function () {
      var unitPrice = $pd.find("input.getUnitPrice").val();
      totalTaka = (Number(unitPrice)*Number($receiveQt));
      $tkValence=$pd.find("input.sumTotalPrice").val(totalTaka);
    });
  });

  $(document).on('keyup','.receiveQt',function(){
    $pd= $(this).parents("tr:first");
    $getUnitPrice=$pd.find("input.getUnitPrice").val();
    $receiveQt=$pd.find("input.receiveQt").val();
    $('.receiveQt').each(function () {
      var unitPrice = $pd.find("input.getUnitPrice").val();
      totalTaka = (Number(unitPrice)*Number($receiveQt));
      $tkValence=$pd.find("input.sumTotalPrice").val(totalTaka);
    });
  });


  $(document).on("focusout mouseout", ".getReceiveQty", function() {
    $pb=$(this).parents("tr:first");
    var getReceiveQty=$pb.find("input.getReceiveQty").val();
    var getRecevedQty=$pb.find("input.getRecevedQty").val();
    var getOrderQty=$pb.find("input.getOrderQty").val();
    var sumR=Number(getReceiveQty)+Number(getRecevedQty);
    var sumC=Number(getOrderQty)-Number(getRecevedQty);
        //  alert(sumR)
        var orderQ=Number(getOrderQty);
        if(orderQ<sumR ){
          alert('Not Greater Than ' +sumC);
          $('.getReceiveQty').val('');
          $('#PO_MST_ID').focus();
          return false;
        }else{
         $('.showReceiveQty').html('');  
       }

     });


  $(document).on('click','.getPrMSTNO_pp',function(){
    var id=$(this).text();
    //alert()
    $.ajax({
      type:'POST',
      url:'<?php echo site_url('inventory/showReceivePurchageOrder');?>',
      data:{prid : id},
      succuss:function(data){

      }
    })

  })

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

  function updatesum() {
    var totalFields = $("#total_row").val();
    alert(totalFields)
    for(var i=1; i <= totalFields; i++){
      alert(i)
      document.getElementById("total_price_"+i).value = ( document.getElementById("unit_price_"+i).value * document.getElementById("RECEIVE_QTY_ID_"+i).value);
    }
    return false; }

  </script>