    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Item List</h5>

            <div class="ibox-tools">
               
                <a   class="btn btn-primary btn-xs pull-right " href="<?php echo site_url()?>/library/addItem">Add New </a>
            </div>

        </div>

        <div class="ibox-content">
            <div id="printArea" class="table-responsive contentArea">
            <table class="table table-striped table-bordered table-hover gridTable">
                <thead>
                    <tr>
                        <th>ISBN NO</th>
                        <th>ITEM NAME</th>
                        <th>DEPARTMENT</th>
                        <th>BOOK CELL NO</th>
                        <th>BOOK TYPE </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($item_list)): ?>
                        <?php $sn = 1; ?>
                        <?php foreach ($item_list as $row) { ?>
                            <?php //var_dump($row); ?>

                    <tr class="gradeX" id="row_<?php echo $row->ITEM_ID; ?>">
                            <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                                <?php echo $row->ISBN_NO; ?>
                            </td>

                            <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>

                                <a class="pull-left applicant_details"    type="button"
                                data-user-id="<?php echo $row->ITEM_ID ?>" data-toggle="modal"
                                data-target="#applicant_modal">
                            <?php echo $row->ITEM_NAME ?>
                            </a>

                        </td>
                        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>

                            <a class="pull-left applicant_details"    type="button"
                            data-user-id="<?php //echo $row->EMP_ID ?>" data-toggle="modal"
                            data-target="#applicant_modal">
                            <?php echo $row->DEPARTMENT; ?>
                            </a>

                        </td>

                        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                            <a class="pull-left applicant_details"    type="button"
                            data-user-id="<?php //echo $row->EMP_ID ?>" data-toggle="modal"
                            data-target="#applicant_modal">
                            <?php echo $row->BOOK_CELL_NO; ?>
                            </a>
                        </td>

                        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                            <b> <?php echo $row->BOOK_TYPE_ID; ?> <br></b>
                        </td>

                        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
         
                                <a class="label label-default" data-type="edit" href="<?php echo site_url()?>/library/itemUpdate/<?php echo $row->ITEM_ID; ?>" ><i class="fa fa-pencil"></i></a>
                              
                                <a class="label label-danger deleteItem" id="<?php echo $row->ITEM_ID; ?>"
                                   title="Click For Delete" data-type="delete" data-field="ITEM_ID" data-tbl="lib_item"><i
                                   class="fa fa-times"></i></a>
                        </td>
                
                    </tr>
                            <?php } ?>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ISBN NO</th>
                            <th>ITEM NAME</th>
                            <th>DEPARTMENT</th>
                            <th>BOOK CELL NO</th>
                            <th>BOOK TYPE </th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
                        
                <div class="modal inmodal fade" id="applicant_modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                <h4 class="modal-title">Item Details</h4>
                            </div>
                            <div class="modal-body"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>


          <script type="text/javascript">
                    $(".applicant_details").on("click", function () {
                        var ITEM_ID = $(this).attr('data-user-id');


                        $.ajax({
                            type: 'post',
                            url: '<?php echo site_url()?>/library/itemModal',
                            data: {ITEM_ID: ITEM_ID},
                            success: function (data) {
                                $("#applicant_modal .modal-body").html(data);
                            }
                        });
                    });
                </script> 


            </div>
        </div>
    </div>
