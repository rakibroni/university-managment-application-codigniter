    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Add Library Stock Item List </h5>

            <div class="ibox-tools">
               
                <a   class="btn btn-primary btn-xs pull-right " href="<?php echo site_url()?>/library/listStock">List </a>
            </div>

        </div>

        <div class="ibox-content">
            <div id="printArea" class="table-responsive contentArea">
      
  <!-- Start  -->

    <form class="form-horizontal frmContent" id="inventory" enctype="multipart/form-data"method="post" action="<?php echo base_url('library/addStock') ?>" target="_blank">
     
       <div class="col-md-12">
      <div class="panel panel-primary">
      <div id="" class="panel-collapse collapse in" aria-expanded="true">
                  <div class="panel-body">
                      <table class="table table-bordered">
                          <tr class="info">
                              <td colspan="6"><b class="text-warning">Invoice Info</b></td>
                          </tr>

                          <tr>
                              <th>Invoice No</th>
                              <th>:</th>
                              <td><input type="text" name="INVOICE_NO" class="form-control " required="required"></td>

                               <th>Item Receive  Date</th>
                              <th>:</th>
                              <td><input type="text" name="RECEIVE_DATE" class="form-control datepicker" required="required"></td>
                          </tr>
                   

                           <tr>
                              <th>Supplier Name</th>
                              <th>:</th>
                            
                             <td class="col-sm-4">
                                 <select class="Item_dropdown form-control select2Dropdown" name="SUPPLIER_ID" id="SUPPLIER_ID" data-tags="true" data-placeholder="Select Particulars Name" data-allow-clear="true" >           
                                    <option value="">-Select-</option>

                                    <?php foreach ($supplier as $row) { ?>

                                     <option value="<?php echo $row->SUPPLIER_ID ?>"><?php echo $row->FULL_ENAME ?></option> 

                                    <?php } ?>

                                </select>
                            </td>


                             <th>Remarks </th>
                              <th>:</th>
                              <td><input type="text" name="REMARKS1" class="form-control " ></td>

                          </tr>

                        

                  </table>
              </div>
          </div>
        </div>

        <div id="" class="panel-collapse collapse in" aria-expanded="true">
            <div class="panel-body">
             <table id="myTable" class="table order-list">
                <thead>

                </thead>
                <tbody>
                    <tr class="info">
                        <td>Item Name</td>
                        <td>Quanlity</td>
                        <td>Remark</td>             
                        <td class="text-center">Action</td>
                    </tr>
               
                    <tr>
                        <td class="col-sm-8">
                            <!-- <input type="text" name="name" class="form-control" /> -->
                            <select class="form-control required select2Dropdown" name="ITEM_NAME_ID[]" id="ITEM_NAME"
                            data-tags="true" data-placeholder="Select Particulars Name" data-allow-clear="true" >
                            <option value="">-Select-</option>
                            <?php foreach ($item as $itemData){ ?>
                            <option value="<?php echo $itemData->ITEM_ID ?>" ><?php echo $itemData->ITEM_NAME ?></option> 
                          <?php } ?>
                        </select>
                    </td>
                    <td class="col-sm-2">
                        <input type="text" style="text-align:center;" name="QUENTITY[]"  class="form-control numbersOnly"  />
                    </td>

               
                    <td class="col-sm-1">
                        <input type="text" style="text-align:center;" name="REMARKS[]"  class="form-control "  />
                    </td>

                    <td class="col-sm-1 text-center">
                        <button  class="btn btn-success btn-xs" id="addReqRowTest" title="Add More" type="button"><i class="glyphicon glyphicon-plus"></i></button>                            
                    </td>

                </tr>
            </tbody>

        </table>
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

  <!-- End --> 

            </div>
        </div>
    </div>

<!-- Second -->


<script>
    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var counter = 0;

        $("#addReqRowTest").on("click", function () {
            var newRow = $("<tr>");
            var cols = "";
            cols += '<td><select  class="form-control select2Dropdown" name="ITEM_NAME_ID[]" id="ITEM_NAME_' + counter + '"  >' +
            '<option value="">-Select-</option>' +
                     <?php foreach ($item as $row) { ?>
                      '<option value="<?php echo $row->ITEM_ID ?>"><?php echo  $row->ITEM_NAME ; ?></option>' +
                      <?php } ?>
          
                '</select> </td>';
                cols += '<td><input required="required" type="text" style="text-align:center;" class="form-control" name="QUENTITY[]" id="REQUIREMENT_' + counter + '"/></td>';


    
 
                cols += '<td><input required="required" type="text" style="text-align:center;" class="form-control " name="REMARKS[]" id="REQUIREMENT_' + counter + '"/></td>';

                cols += '<td class="text-center"><button class="btn btn-danger btn-xs ibtnDel" title="Delete" id="" type="button"><i class="glyphicon glyphicon-remove"></i></button></td>';
                newRow.append(cols);
                $("table.order-list").append(newRow);
                counter++;
                $('.select2Dropdown').select2().trigger();
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