<div class="block-flat">
    <form class="form-horizontal frmContent" id="inventory" method="post"
    action="<?php echo base_url('inventory/updateRequisition/'.$mst_data_info->REQ_MST_ID) ?>">
    <?php
    if ($ac_type == 2) {
        ?>
        <input type="hidden" class="rowID" name="mstId" value="<?php  echo $mst_data_info->REQ_MST_ID ?>"/>
        <?php
    }
    ?>
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
                        <th>Requisition No</th>
                        <th>:</th>
                        <td><b><?php echo $mst_data_info->REQ_NO;?></b></td>
                        <th>Requisition Date</th>
                        <th>:</th>
                        <td><input required="required" type="text" name="REQ_DT" class="form-control datepicker required" value="<?php echo date('d-m-Y',strtotime($mst_data_info->REQ_DT))  ?>" >
                        </td>
                        

                    </tr>
                    <tr>
                        <th>Received Date</th>
                        <th>:</th>
                        <td><input required="required" type="text" name="REQ_RECEIVE_DT" class="form-control datepicker" value="<?php echo   date('d-m-Y',strtotime($mst_data_info->REQ_RECEIVE_DT)); ?>"></td>
                        <th>Requisition Type</th>
                        <th>:</th>
                        <td> <select required="required" class="form-control commonClass required" name="REQ_TYPE"
                            id="REQUISITION_TYPE_ID"  data-tags="true" data-placeholder="Select Requisition Type" data-allow-clear="true">
                            <option value="">--Select--</option>
                            <?php foreach ($requisition_type as $row): ?>
                             <option
                             value="<?php echo $row->LKP_ID ?>" <?php echo ($mst_data_info->REQ_TYPE == $row->LKP_ID) ? 'selected' : '' ?>><?php echo $row->LKP_NAME; ?></option>
                         <?php endforeach; ?>
                     </select>
                 </td>
             </tr>
             <tr>
                 <th>Requisition For</th>
                 <th>:</th>
                 <td> <input required="required" type="radio" value="P"<?php echo ($mst_data_info->REQ_FOR=='P')?'checked':'' ?> name="REQ_FOR" class="requisition_for_status">            
                    Personal
                    <br>
                    <input required="required" type="radio" value="D" <?php echo ($mst_data_info->REQ_FOR=='D')?'checked':'' ?> class="requisition_for_status" name="REQ_FOR">            
                Department</td>
                <th>Remarks</th>
                <th>:</th>
                <td colspan="4">
                    <textarea name="REMARKS" class="form-control"><?php echo $mst_data_info->REMARKS ?></textarea>

                </td>
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
                    <td>Requisitin Qty</td>
                    <td class="text-center">
                        <button  class="btn btn-success btn-xs" id="addrow" title="Add More" type="button"><i class="glyphicon glyphicon-plus"></i></button>

                    </td>
                </tr>

                <?php foreach ($req_info as $req_row) : ?>
                    <tr>
                       <input type="hidden" value="<?php echo $req_row->REQ_MST_ID; ?>" name="REQ_MST_ID[]">
                       <input type="hidden" value="<?php echo $req_row->REQ_CHD_ID; ?>" name="REQ_CHD_ID[]">
                       <td class="col-sm-5">


                        <select required="required" class="Item_dropdown form-control required" name="ITEM_ID[]" id="ITEM_NAME"
                        data-tags="true" data-placeholder="Select Particulars Name" data-allow-clear="true">
                        <?php
                                if ($ac_type == 2): // if the form action is EDIT
                                foreach ($item_info as $row):
                                    ?>
                                    <option
                                    value="<?php echo $row->ITEM_ID ?>" <?php echo ($req_row->ITEM_ID == $row->ITEM_ID) ? 'selected' : '' ?>><?php echo $row->ITEM_NAME . " (" . $row->UNIT_NAME . ")"; ?></option>
                                    <?php
                                endforeach;
                                else: // if the form action is VIEW
                                ?>
                                <option value="">Select</option>
                                <?php
                                foreach ($item_info as $row):
                                    ?>
                                    <option value="<?php echo $row->ITEM_ID ?>"><?php echo $row->ITEM_NAME . " (" . $row->UNIT_NAME . ")"; ?></option>
                                    <?php
                                endforeach;
                                endif; ?>
                            </select>


                        </td>
                        <td class="col-sm-3">
                            <input required="required" style="text-align: center;" type="text" name="REQUIREMENT_QTY[]" value="<?php echo $req_row->REQUIREMENT_QTY; ?>" class="form-control"/>
                        </td>

                        <td class="col-sm-3 text-center">
                         <button value="<?php echo $req_row->REQ_CHD_ID;?>" class="btn btn-danger btn-xs ibtnDel deleteReqDetails" title="Delete" id="" type="button"><i class="glyphicon glyphicon-remove"></i></button>

                     </td>

                 </tr>
                 <?php
                 if ($ac_type == 2) {
                  ?>
                  <input type="hidden" class="rowID" name="txtReqId[]" value="<?php  echo $req_row->REQ_CHD_ID ?>"/>
                  <?php
              }
              ?>
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
<script>
    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var counter = 0;

        $("#addrow").on("click", function () {
            var newRow = $("<tr>");
            var cols = "";


            cols += '<td><input type="hidden" value="<?php echo $req_row->REQ_MST_ID; ?>" name="REQ_MST_ID_C[]"><select class="form-control" name="ITEM_ID[]" id="ITEM_NAME_' + counter + '"  >' +
            '<option value="">-Select-</option>' +
            <?php foreach ($item_info as $row) { ?>
                '<option value="<?php echo $row->ITEM_ID ?>"><?php echo $row->ITEM_NAME . "       (" . $row->UNIT_NAME . ")"; ?></option>' +
                <?php } ?>
                '</select> </td>';
                cols += '<td><input style="text-align:center;" type="text" class="form-control" name="REQUIREMENT_QTY[]" id="REQUIREMENT_' + counter + '"/></td>';


                cols += '<td class="text-center"><button class="btn btn-danger btn-xs ibtnDel" title="Delete" id="" type="button"><i class="glyphicon glyphicon-remove"></i></button></td></td>';
                newRow.append(cols);
                $("table.order-list").append(newRow);
                counter++;
            });


        $("table.order-list").on("click", ".ibtnDel", function (event) {
            $(this).closest("tr").remove();
            counter -= 1
        });


    });


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

    $(document).on('click','.deleteReqDetails',function(){
        if(confirm('Are You Want To Delete?')){
            var re_id=$(this).val();
            $.ajax({
                type:'post',
                url:'<?php echo site_url('inventory/deleteRequiDetials'); ?>',
                data:{re_id:re_id},
                success:function(data){

                }
            })
        }else{

            return false;

        }
    });

</script>