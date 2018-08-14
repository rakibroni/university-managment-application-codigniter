	<div class="ibox float-e-margins">
    <div class="ibox-title">
        <div class="col-md-9"><b>List of Item Borrow </b></div>
    </div>  		


            <table class="table table-striped table-bordered table-hover gridTable">
                <thead>
                    <tr> 
                        <th>Item No </th>
                        <th>Item Name</th>
                        <th>Borrow Date</th>
                        <th>Last Return Date</th>
                        <th>Return Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($dataStudentBorrowHistory)): ?>
                        <?php $sn = 1; ?>
                        <?php foreach ($dataStudentBorrowHistory as $row) { 
                            //var_dump($row);  die(); ?>

                    <tr class="gradeX" id="row_<?php echo $row->STOCK_ID; ?>">

                        <td>  
                            <?php echo $row->STOCK_ID; ?>
                        </td>

                        <td >
                            <?php echo $row->ITEM_NAME; ?>
                        </td>

                        <td >
                         <?php if ($row->BORROW_DT) {
                                $t = strtotime($row->BORROW_DT); 
                                $BORROW_DT = date('d/m/y',$t);  echo $BORROW_DT;
                                }

                           ?>                        
                        </td>

                         <td >
                         <?php if ($row->RETURN_DT) {
                                $t = strtotime($row->RETURN_DT); 
                                $RETURN_DT = date('d/m/y',$t);  echo $RETURN_DT;
                                }

                           ?>                        
                        </td>

                        <td>         
                            <?php

                            	if ($row->RETURN_RECIVE_DT) {
                            	
                                $test = strtotime($row->RETURN_RECIVE_DT); 
                                $RETURN_RECIVE_DT = date('d/m/y',$test);  
                                echo $RETURN_RECIVE_DT;

                            	}                            

                            ?>
                        </td>
                
                    </tr>
                            <?php } ?>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>

                        <th>Item No </th>
                        <th>Item Name</th>
                        <th>Borrow Date</th>
                        <th>Last Return Date</th>
                        <th>Return Date</th>
                       

                        </tr>
                    </tfoot>
            </table>

</div>  
