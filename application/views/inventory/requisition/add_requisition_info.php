

<div class="block-flat">
    <form class="form-horizontal frmContent" id="inventory" method="post" action="<?php echo base_url('inventory/createRequisition') ?>">
       <span class="frmMsg"></span>
       <div class="col-md-12">
        <div class="panel panel-primary">
            <div id="" class="panel-collapse collapse in" aria-expanded="true">
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr class="info">
                            <td colspan="6"><b class="text-warning">Requisition Details Info</b></td>
                        </tr>
                        <tr>
                            <th>Requisition Date</th>
                            <th>:</th>
                            <td><input id="test" type="text" name="REQ_DT" class="form-control datepicker " required="required"></td>
                            <th>Received Date</th>
                            <th>:</th>
                            <td><input type="text" name="REQ_RECEIVE_DT" class="form-control datepicker" required="required"></td>
                        </tr>
                        <tr>
                            <th>Requisition Type</th>
                            <th>:</th>
                            <td> <select class="form-control commonClass required" name="REQ_TYPE"
                                id="REQUISITION_TYPE_ID"  data-tags="true" data-placeholder="Select Requisition Type" data-allow-clear="true" required="required">
                                <option value="">-- Select--</option>
                                <?php foreach ($requisition_type as $row): ?>
                                    <option value="<?php echo $row->LKP_ID; ?>"><?php echo $row->LKP_NAME; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <th>Requisition For</th>
                        <th>:</th>
                        <td> <input type="radio" value="P" name="REQ_FOR" class="requisition_for_status" checked="checked" required="required">            
                            Personal
                            <input type="radio" value="D" class="requisition_for_status" name="REQ_FOR" required="required">            
                        Department</td>
                    </tr>
                    <tr>
                        <th>Remarks</th>
                        <th>:</th>
                        <td colspan="4"><input type="text" name="REMARKS" class="form-control"></td>
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
                        <td>Requirement</td>             
                        <td class="text-center">Action</td>
                    </tr>
                    <tr>
                        <td class="col-sm-5">
                            <!-- <input type="text" name="name" class="form-control" /> -->
                            <select class="Item_dropdown form-control required" name="ITEM_NAME[]" id="ITEM_NAME"
                            data-tags="true" data-placeholder="Select Particulars Name" data-allow-clear="true" required="required">
                            <option value="">-Select-</option>
                            <?php
                            foreach ($item_info as $row):
                                ?>
                                <option value="<?php echo $row->ITEM_ID ?>"><?php echo $row->ITEM_NAME."       (".$row->UNIT_NAME.")"; ?></option>
                                <?php
                            endforeach;
                            ?>
                        </select>
                    </td>
                    <td class="col-sm-3">
                        <input type="text" style="text-align:center;" name="REQUIREMENT[]"  class="form-control" required="required" />
                    </td>

                    <td class="col-sm-3 text-center">
                        <button  class="btn btn-success btn-xs" id="addReqRow" title="Add More" type="button"><i class="glyphicon glyphicon-plus"></i></button>                            
                    </td>

                </tr>
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

        $("#addReqRow").on("click", function () {
            var newRow = $("<tr>");
            var cols = "";
            cols += '<td><select required="required" class="form-control" name="ITEM_NAME[]" id="ITEM_NAME_' + counter + '"  >' +
            '<option value="">-Select-</option>' +
            <?php foreach ($item_info as $row) { ?>
                '<option value="<?php echo $row->ITEM_ID ?>"><?php echo $row->ITEM_NAME."       (".$row->UNIT_NAME.")"; ?></option>' +
                <?php } ?>
                '</select> </td>';
                cols += '<td><input required="required" type="text" style="text-align:center;" class="form-control" name="REQUIREMENT[]" id="REQUIREMENT_' + counter + '"/></td>';
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