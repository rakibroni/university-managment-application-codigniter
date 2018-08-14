<style type="text/css">
    .cursor-not-allow{
        pointer-events: none !important;
    }
</style>

<style type="text/css">
    .info {
        background-color: #d9edf7;
    }

    .trinfo {
        background-color: skyblue;
    }
</style>

<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
        padding: 5px;
        text-align: left;    
    }
</style>
<?php
$organization_info=$this->utilities->findByAttribute('sa_organizations', array('STATUS' => 1));
$ABBR=$organization_info->ABBR;
$WEBSITE=$organization_info->WEBSITE;
$ORG_NAME=$organization_info->ORG_NAME;
$EMAIL=$organization_info->EMAIL;
$PHONE=$organization_info->PHONE;
$org_log= base_url('upload/organization/logo/'.$organization_info->LOGO); 
?>

<div style="width: 100%;border-bottom: 2px solid black;">
    <div style="width:10%;float: left;"><img
        style=" border-radius: 3px;margin-bottom: 0px;padding: 0px ;width: 60px"
        src="<?php echo base_url(); ?>assets/img/logo/kyau_web.png"></div>
        <div style="width:80%;float: left;padding-top: 5px"><h2>Khwaja Yunus Ali University</h2></div>
        <div style="width:10%;float: left;margin-bottom: 0px;padding-top: 10px ;"></div>
    </div>

    <h4 style="width:100%;text-align:center; margin:10px 0 0 0; line-height:18px;">Issue Return</h4>

    <div class="row">
      <p class="info" style="padding:3px 0px 3px 10px;"><b>Requisition Details Info</b></p>
      <table style="width:100%">
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

</table><br>
<div class="clearfix"></div>

<table id="myTable" border="1" rules="all" class="table table-striped table-bordered table-hover printable table-sm no-footer centered" cellspacing="0" width="100%" role="grid">
    <!--   <table id="myTable" class=" table order-list">  --> 

         <tbody>
                <tr class="trinfo">
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
                       <?php echo $req_row->ITEM_NAME ?>
                </td>
                <td class="col-sm-2" align="center">
                    <?php echo $req_row->REQUIREMENT_QTY; ?> (<?php echo $req_row->UNIT_NAME; ?>)
                </td>
                <td class="col-sm-2">
                   <?php $stock_balance=$this->inventory_model->itemStock($req_row->ITEM_ID);
                          if(!empty($stock_balance->BALANCE)): 
                            echo $stock_balance->BALANCE ;
                            endif; ?> (<?php echo $req_row->UNIT_NAME; ?>)
                </td>
                <td class="col-sm-2" align="center">
                   <?php echo $req_row->ISSUED_QTY; ?> (<?php echo $req_row->UNIT_NAME; ?>)
                </td>
                <td class="col-sm-2" align="center">
                    <?php
                    $issQty=$this->db->query("SELECT SUM(ichd.ISSUED_RET_QTY) ISSUED_RET_QTY FROM inv_issue_return_chd ichd WHERE ichd.ISSUE_CHD_ID='$req_row->ISSUE_CHD_ID'")->row();
                    if(isset($issQty->ISSUED_RET_QTY)){
                        ?>
                        <?php echo $issQty->ISSUED_RET_QTY; ?> (<?php echo $req_row->UNIT_NAME; ?>)
                        <?php } ?>
                    </td>
                    <td class="col-sm-4">
                    
                 </td>

             </tr>

         <?php endforeach; ?>

     </tbody>
</table>




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