<?php// var_dump($stock_item_list); ?> 
<?php// var_dump($datalibraryBorrowItemWise);  ?> 
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Library Stock Item List </h5>
        <?php //if ($previlages->CREATE == 1) { ?>
            <div class="ibox-tools">

            <a   class="btn btn-primary btn-xs pull-right " href="<?php echo site_url()?>/library/stock">Add New </a>
            </div>
        <?php //} ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
     
            <table class="table table-bordered gridTable"  table-title="Requisition List" table-msg="All Requisition list">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>ITEM NAME</th>
                        <th>TOTAL ITEM</th>
                        <th>ITEM ISSUE</th>
                        <th>ITEM IN STOCK</th>
                    </tr>
                </thead>
                <tbody>

                    <?php if (!empty($stock_item_list)): ?>
                        <?php $sn = 1; ?>
                        <?php foreach ($stock_item_list as $row) { 

                           
//var_dump($row);
                           

                         ?>
                        <tr class="gradeX" id="row_<?php //echo $row->LIB_ITEM_NUMBER; ?>">
                                <td>
                                <span><?php echo $sn++; ?></span>
                                <span class="hidden"
                                id="loader_<?php //echo $row->LIB_ITEM_NUMBER; ?>"></span>
                                </td>
                                <td><?php echo $row->ITEM_NAME; ?></td>

                                <td><?php echo $row->number_item; ?></td>
                               
                                <td><?php 
                                    if($row->test){ 
                                        echo $row->test; 
                                        }
                                        else{
                                        echo "0";
                                    }

                                         ?></td>

                                <td><?php                               
                                    $itemInLibrary=$row->number_item - $row->test;
                                    echo $itemInLibrary; 
                                    ?> 
                                </td>

                     </tr>
                     <?php     } ?>

                 <?php endif; ?>




             </tbody>
            </table>
            <?php
           
            ?>
            <script>
                $(document).on('click', '.deleteThis', function () {

                  var m_id = $(this).attr("id");
                 
                  var r = confirm("Are you sure, want to delete?");
                  if(r == true)
                  {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo site_url() ?>/library/deleteItemReceive',
                        data: {m_id: m_id},
                        success: function (data) {
                           if (data == "Y") {
                            $("#row_" + m_id).remove();
                        } else {
                            alert("Row Delete Field");
                        }
                        
                    }      

                });

                }    

            });
            </script>

        </div>

    </div>
</div>
