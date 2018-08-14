<div class="block-flat">
    <form class="form-horizontal frmContent" id="inventory" method="post" action="<?php echo base_url('inventory/editPurchaseOrder/'.$pOrder->PO_MST_ID) ?>">
        <span class="frmMsg"></span>
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div id="" class="panel-collapse collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr class="info">
                                <td colspan="10"><b class="text-warning">Purchase Order Details Info</b></td>
                            </tr>
                            <tr>
                                <th>PO No : </th>
                                <td><b><?php echo $pOrder->PO_NO; ?></b></td>
                                <th>Purchase Date : </th>
                                <td><input type="text" value="<?php echo $pOrder->PO_DATE; ?>" required="required" class="datepicker form-control" name="PO_DATE"></td>
                                <th>Remarks : </th>
                                <td>
                                 <textarea  class="form-control" name="REMARKS"><?php echo $pOrder->REMAREK;?></textarea>
                             </td>
                         </tr>
                     </table>
                 </div>
             </div>
         </div>
         <div class="panel panel-primary">
            <div id="" class="panel-collapse collapse in" aria-expanded="true">
                <div class="panel-body">
                  <table id="myTable" class=" table order-list">  

                    <tbody>
                        <tr class="info">
                            <td>Select Itme</td>
                            <td>Qty</td>     
                            <td>Select Supplier</td>           
                            <td class="text-center">
                             <button  class="btn btn-success btn-xs" id="addrow" title="Add More" type="button"><i class="glyphicon glyphicon-plus"></i></button>
                         </td>
                     </tr>
                     <?php foreach ($poDetails as $key => $value) {
                                    # code...
                        ?>
                        <tr>
                            <input type="hidden" value="<?php echo $value->PO_MST_ID;?>" name="PO_MST_ID[]">
                            <input type="hidden" value="<?php echo $value->PO_CHD_ID;?>" name="PO_CHD_ID[]">
                            <td class="col-sm-5">
                                <select class="Item_dropdown form-control" name="ITEM_ID[]" id="ITEM_ID"
                                data-tags="true" data-placeholder="Select Particulars Name" data-allow-clear="true" required="required">
                                <option value="">-Select-</option>
                                <?php
                                foreach ($item_info as $row):
                                    ?>
                                    <option value="<?php echo $row->ITEM_ID ?>"
                                        <?php if($value->ITEM_ID==$row->ITEM_ID) echo 'selected="selected"'?>
                                        >
                                        <?php echo $row->ITEM_NAME."(".$row->UNIT_NAME.")"; ?>

                                    </option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </td>
                        <td class="col-sm-3">
                            <input type="text" value="<?php echo $value->ORDER_QTY; ?>" name="ORDER_QTY[]" id="ORDER_QTY_P" required="required"  class="form-control text-center"/>
                        </td>
                        <td class="col-sm-5">
                            <!-- <input type="text" name="name" class="form-control" /> -->
                            <select class="Item_dropdown form-control required" name="SUPPLIER_ID[]" id="SUPPLIER_ID"
                            data-tags="true" data-placeholder="Select Particulars Name" data-allow-clear="true" required="required">
                            <option value="">-Select-</option>
                            <?php
                            foreach ($supplier as $sup):
                                ?>
                                <option value="<?php echo $sup->SUPPLIER_ID ?>"
                                    <?php if($value->SUPPLIER_ID==$sup->SUPPLIER_ID) echo 'selected="selected"' ?>
                                    >
                                    <?php echo $sup->FULL_ENAME; ?>
                                </option>
                                <?php
                            endforeach;
                            ?>
                        </select>
                    </td>
                    <td>
                        <button value="<?php echo $value->PO_CHD_ID;?>" class="btn btn-danger btn-xs ibtnDel deletePOrderDetails" title="Delete" id="" type="button"><i class="glyphicon glyphicon-remove"></i></button>
                    </td>

                </tr>
                <?php } ?>
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
<script>
 $(document).ready(function () {
    var counter = 0;

    $("#addrow").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";
        cols += '<td><input type="hidden" value="<?php echo $value->PO_MST_ID;?>" name="PO_MST_ID[]"><select class="form-control" required="required" name="ITEM_ID[]" id="ITEM_ID_' + counter + '"  >' +
        '<option value="">-Select-</option>' +
        <?php foreach ($item_info as $row) { ?>
            '<option value="<?php echo $row->ITEM_ID ?>"><?php echo $row->ITEM_NAME."       (".$row->UNIT_NAME.")"; ?></option>' +
            <?php } ?>
            '</select> </td>';
            cols += '<td><input type="text" required="required" class="form-control text-center" name="ORDER_QTY[]" id="ORDER_QTY_' + counter + '"/></td>';
            cols += '<td><select class="form-control" required="required" name="SUPPLIER_ID[]" id="SUPPLIER_ID_' + counter + '"  >' +
            '<option value="">-Select-</option>' +
            <?php foreach ($supplier as $sup) { ?>
                '<option value="<?php echo $sup->SUPPLIER_ID ?>"><?php echo $sup->FULL_ENAME;?></option>' +
                <?php } ?>
                '</select> </td>';
                cols += '<td class="text-center"><button class="btn btn-danger btn-xs ibtnDel" title="Delete" id="" type="button"><i class="glyphicon glyphicon-remove"></i></button></td>';
                newRow.append(cols);
                $("table.order-list").append(newRow);
                counter++;
            });

    $("table.order-list").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();       
        counter -= 1
    });


});

 $(document).on('click','.deletePOrderDetails',function(){
    var po_de_id=$(this).val();
    if(confirm('Are You Want To Delete?')){
        $.ajax({
            type:'post',
            url:'<?php echo site_url('inventory/deletePerOrderDetials'); ?>',
            data:{po_de_id:po_de_id},
            success:function(data){

            }
        })
    }else{
        return false;
    }
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

</script>
<script>


    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });
</script>
<script type="text/javascript">


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