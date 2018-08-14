<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Issue List</h5>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">

            <table class="table table-bordered gridTable"  table-title="Requisition List" table-msg="All Requisition list">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Item</th>
                        <th>Stock Quantity </th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sn = 1; ?>
                   <?php foreach ($item_list as $row) {

                    ?>
                 
                    <tr class="<?php //echo $status;?>">
                        <td><span><?php echo $sn++; ?></span></td>
                        <td><?php echo $row->ITEM_NAME; ?></td>
                        <td class="text-center">
                        <?php  
                        $stock_balance=$this->inventory_model->itemStock($row->ITEM_ID);
                          if(!empty($stock_balance->BALANCE)): 
                            echo $stock_balance->BALANCE .' ('.$row->UNIT_NAME .')';
                            endif;
                        ?>
                          
                        </td>
                        
                       
                         
                       </tr>

                       <?php } ?>
                   </tbody>

               </table>



    </div>

</div>
</div>
