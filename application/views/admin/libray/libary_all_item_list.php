<?php ?>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Libary All Item List </h5>
            <barcode code="A34698735B" type="CODABAR" />
            
            <div class="ibox-tools">
                    
            </div>

        </div>

        <div class="ibox-content">
            <div id="printArea" class="table-responsive contentArea">
            <table class="table table-striped table-bordered table-hover gridTable">
                <thead>
                    <tr> 
                        <th>Item ID</th>
                        <th>Item Name</th>
                        <th>Item Department</th>
                        <th>Item Invoice ID</th>
                        <th>Barcode</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($libray_all_stock_item)): ?>
                        <?php $sn = 1; ?>
                        <?php foreach ($libray_all_stock_item as $row) { //var_dump($row); ?>

                    <tr class="gradeX" id="row_<?php echo $row->LIB_STOCK_ID; ?>">

                        <td>

                           <a class="pull-left item_history_details" type="button"
                            data-user-id="<?php echo $row->SKU ?>" data-toggle="modal"
                            data-target="#item_history_modal">
                            <?php echo $row->LIB_STOCK_ID; ?>
                            </a>

                        </td>

                        <td >
                          <a class="pull-left item_history_details" type="button"
                            data-user-id="<?php echo $row->SKU ?>" data-toggle="modal"
                            data-target="#item_history_modal">

                            <?php echo $row->ITEM_NAME; ?>

                          </a>
                        </td>

                        <td >

                         <a class="pull-left item_history_details" type="button"
                            data-user-id="<?php echo $row->SKU ?>" data-toggle="modal"
                            data-target="#item_history_modal">

                         <?php echo $row->LKP_NAME; ?>

                         </a>
                        
                        </td>

                       <td>  
                         <a class="pull-left item_history_details" type="button"
                            data-user-id="<?php echo $row->SKU ?>" data-toggle="modal"
                            data-target="#item_history_modal">

                            <?php echo $row->LIB_INVOICE_ID; ?>
                         </a>
                        </td>


                       <td>   
                          <a class="pull-left item_history_details" type="button"
                            data-user-id="<?php echo $row->SKU ?>" data-toggle="modal"
                            data-target="#item_history_modal">
                            <?php echo $row->SKU; ?>
                          </a>

                        </td>
                
                    </tr>
                            <?php } ?>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>

                        <th>Item ID</th>
                        <th>Item Name</th>
                        <th>Item Department</th>
                        <th>Item Invoice ID</th>
                        <th>Barcode</th>
                       

                        </tr>
                    </tfoot>
                </table>




                        
                <div class="modal inmodal fade" id="item_history_modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                <h4 class="modal-title">Library Item Details</h4>
                            </div>
                            <div class="modal-body"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal">Close </button>
                            </div>
                        </div>
                    </div>
                </div>

                <script type="text/javascript">
                    $(".item_history_details").on("click", function () {
                        var skuCode = $(this).attr('data-user-id');
                        $.ajax({
                            type: 'post',
                            url: '<?php echo site_url()?>/library/libraryItemHistory',
                            data: {skuCode: skuCode},
                            success: function (data) {
                                $("#item_history_modal .modal-body").html(data);
                            }
                        });
                    });
                </script> 

            </div>
        </div>
    </div>





