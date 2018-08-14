<table class="table table-bordered">
    <tr class="info">
        <td colspan="7"><b class="text-warning">Payment Details</b>
            <input type="button" data-action="finance/createVoucher" data-su-action="finance/myFunction"
            data-param="<?php echo $student_info->STUDENT_ID; ?>" data-view-div="pDetails"
            id="hostel_bill_generate_btn" class="btn btn-danger btn-sm form_submit pull-right" value="Make Payment">
        </td>
    </tr>
    <tr>
        <th class="col-md-2">Particular</th>
        <th >Total Amount</th>
        <th>Discount Amount</th>
        <th>Net Amount</th>
        <th>Paid Amount</th>
        <th>Due Amount</th>
        <th>Pay Amount</th>
    </tr>

    <input type="hidden" name="studentId"
    value="<?php echo $student_info->STUDENT_ID; ?>">

    <?php 
                                                $total_amount='';//total_amount
                                                $total_dis_amount='';//total discount Amount
                                                $total_net_amount='';//bill amount have to pay
                                                $total_paid_amount='';//total paid amount 
                                                $total_due_amount='';//total due amount

                                                foreach ($semester_wise_payment as $row): 

                                                    ?>
                                                <input type="hidden" name="accountNo[]"
                                                value="<?php echo $row->AC_NO; ?>">
                                                <input type="hidden" name="billingChildId[]"
                                                value="<?php echo $row->BILLING_CHD_ID; ?>">
                                                <tr>
                                                    <td>
                                                        <?php echo (empty($row->BILLING_MONTH)) ? $row->AC_NAME : $row->AC_NAME . '&nbsp;' . '<span style="font-size: 10px;">' . '<mark>(' . date('M y', strtotime($row->BILLING_MONTH)) . ')</mark>' . '</span>'; ?>
                                                        
                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                        $total_amount +=$row->TOTAL_BILL;
                                                        echo number_format($row->TOTAL_BILL,2); 
                                                        ?>

                                                    </td>
                                                    <td class="text-center">
                                                        <?php 
                                                        $total_dis_amount +=$row->DISC_AMT;
                                                        echo ($row->DISC_AMT == 0) ? '' : number_format($row->DISC_AMT,2) ?>

                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                        $total_net_amount +=$row->BILL_AMT; 

                                                        echo ($row->BILL_AMT == 0) ? '' : number_format($row->BILL_AMT,2) ?>

                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                        $total_paid_amount += abs($row->PAID_AMT);

                                                        echo number_format(abs(($row->PAID_AMT == 0) ? '' : $row->PAID_AMT) ,2)?>

                                                    </td>
                                                    <td class="text-center">
                                                        <?php 
                                                        $total_due_amount += $row->BILL_AMT - abs($row->PAID_AMT);

                                                        echo number_format(($row->BILL_AMT - abs($row->PAID_AMT)),2)?></td>
                                                        <td>
                                                            <?php //if(($row->BILL_AMT - abs($row->PAID_AMT)) !=0): ?>
                                                            <input type="text" name="payAmount[]"
                                                            class="form-control text-center">
                                                            <?php //endif; ?>
                                                        </td>

                                                    </tr>
                                                <?php endforeach; ?>
                                                <tr>
                                                    <td>Total</td>
                                                    <td class="text-center"><b><?php echo number_format($total_amount,2); ?></b></td>
                                                    <td class="text-center"><b><?php echo number_format($total_dis_amount,2); ?></b></td>
                                                    <td class="text-center">
                                                        <b class="text-info"><?php echo number_format($total_net_amount,2); ?></b>
                                                    </td>
                                                    <td class="text-center">
                                                        <b class="text-success"><?php echo number_format($total_paid_amount,2); ?></b></td>
                                                        <td class="text-center"><b class="text-danger"><?php echo number_format($total_due_amount,2); ?></b></td>
                                                        <td></td>

                                                    </tr>
                                                </table>
                                                <div class="col-md-7">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>Payment Mode</th>
                                                            <th class="text-center">Payment Date</th>
                                                            <th class="text-center">SL No</th>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input type="radio" name="payment_mode" checked="checked" value="bank">Bank
                                                                &nbsp;&nbsp;<input type="radio" name="payment_mode" value="cash" >Cash
                                                            </td>
                                                            <td class="text-center" >  
                                                                <input type="text" name="payment_date" class="datepicker form-control text-center"> </td>

                                                                <td class="text-center">
                                                                    <input type="text" class="form-control text-center" name="payment_sl_no"></td>

                                                                </tr>
                                                            </table>
                                                        </div>

                                                         <script>
     $( function() {
         $( ".datepicker" ).datepicker({
             changeMonth: true,
             changeYear: true,
             dateFormat: 'dd-mm-yy' ,
             yearRange: "-50:+0",
             autoclose:true,
              
         });
     } );

     
 </script>