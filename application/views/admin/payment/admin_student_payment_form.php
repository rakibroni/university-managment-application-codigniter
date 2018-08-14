<div class="ibox float-e-margins">
    <div class="ibox-title">
     <div class="col-md-9"><b>Payment Details</b></div>
     <div class="col-md-3 has-success">
            <!-- <select class="form-control " id="YSESSION_ID">
                <option value="">-- Select Session --</option>
                <?php //if (!empty($session)): foreach ($session as $row): ?>
                       <option value="--><?php //echo $row->YSESSION_ID ?><!--"><?php //echo $row->SESSION_NAME ?><!--</option>
                   <?php //endforeach; endif; ?>
               </select> -->
           </div>
       </div>
       <div class="ibox-content">
        <div id="semester_wise_payment_details">
            <form class="form-horizontal frmContent" id="Campus" method="post">
                <div class="panel-body">
                <div class="col-md-12">
                                        <div class="panel panel-primary">
                                            <div id="" class="panel-collapse collapse in" aria-expanded="true">
                                                <div class="panel-body">
                                                    <table class="table table-bordered">
                                                        <tr class="info">
                                                            <td colspan="12"><b class="text-warning">Student Info</b></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Session</th>
                                                            <th>:</th>
                                                            <td><?php echo $student_info->current_session_name; ?></td>
                                                            <th>Name</th>
                                                            <th>:</th>
                                                            <td><?php echo $student_info->FULL_NAME_EN; ?></td>
                                                            <th>Registration No.</th>
                                                            <th>:</th>
                                                            <td><?php echo $student_info->REGISTRATION_NO; ?></td>
                                                            <th>Program</th>
                                                            <th>:</th>
                                                            <td><?php echo $student_info->PROGRAM_SHORT_NAME; ?></td>
                                                        </tr>
                                                        <tr>
                                                            
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                   <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div id="" class="panel-collapse collapse in" aria-expanded="true">
                            <div class="panel-body">
                                <div id="pDetails">
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

                                                            <input type="text" name="payAmount[]"
                                                            class="form-control text-center">
                                                            
                                                        </td>

                                                    </tr>
                                                <?php endforeach; ?>
                                                <tr>
                                                    <td>Total</td>
                                                    <td class="text-center"><b><?php if(!empty($total_amount)): echo number_format($total_amount,2); endif;?></b></td>
                                                    <td class="text-center"><b><?php if(!empty($total_dis_amount)): echo number_format($total_dis_amount,2); endif;?></b></td>
                                                    <td class="text-center">
                                                        <b class="text-info"><?php if(!empty($total_net_amount)): echo number_format($total_net_amount,2); endif;?></b>
                                                    </td>
                                                    <td class="text-center">
                                                        <b class="text-success"><?php if(!empty($total_paid_amount)): echo number_format($total_paid_amount,2); endif; ?></b></td>
                                                        <td class="text-center"><b class="text-danger"><?php if(!empty($total_due_amount)): echo number_format($total_due_amount,2); endif;?></b></td>
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
                                                    </div>


                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <!-- <div class="col-md-6">
                                        <div class="panel panel-primary">
                                            <div id="" class="panel-collapse collapse in" aria-expanded="true">
                                                <div class="panel-body">
                                                    <table class="table table-bordered">
                                                        <tr class="info">
                                                            <td colspan="6"><b class="text-warning">Student Info</b></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Session</th>
                                                            <th>:</th>
                                                            <td><?php echo $student_info->current_session_name; ?></td>
                                                            <th>Name</th>
                                                            <th>:</th>
                                                            <td><?php echo $student_info->FULL_NAME_EN; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Registration No.</th>
                                                            <th>:</th>
                                                            <td><?php echo $student_info->REGISTRATION_NO; ?></td>
                                                            <th>Program</th>
                                                            <th>:</th>
                                                            <td><?php echo $student_info->PROGRAM_SHORT_NAME; ?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="panel panel-primary">
                                            <div id="" class="panel-collapse collapse in" aria-expanded="true">
                                                <div class="panel-body">
                                                    <table class="table table-bordered">
                                                        <tr class="info">
                                                            <td colspan="4"><b class="text-warning">Course Info</b></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center">#</th>
                                                            <th>Code</th>
                                                            <th>Course</th>
                                                            <th class="text-center">Credit</th>
                                                        </tr>
                                                        <?php $sl = 1;
                                                        $tot_credit = 0;
                                                        foreach ($semester_regi_course as $row): ?>
                                                        <tr>
                                                            <td><?php echo $sl++ ?></td>
                                                            <td><?php echo $row->COURSE_CODE ?></td>
                                                            <td><?php echo $row->COURSE_TITLE ?></td>
                                                            <td class="text-center"><?php $tot_credit += $row->CREDIT;
                                                                echo $row->CREDIT; ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        <tr>
                                                            <td colspan="3"><b class="pull-right"> Total Credit : </b></td>
                                                            <td class="text-center"><b><?php echo $tot_credit; ?></b></td>
                                                        </tr>

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->


                                </div>


                            </form>

                            <div class="clearfix"></div>

                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(document).on("change", "#YSESSION_ID", function () {
                        var YSESSION_ID = $("#YSESSION_ID").val();
                        if (YSESSION_ID == '') {
                            $("#semester_wise_payment_details").html("<span class='text-warning'><b>No record found</b></sapn>");
                        } else {
                            $.ajax({
                                type: "POST",
                                data: {YSESSION_ID: YSESSION_ID},
                                url: "<?php echo site_url(); ?>/finance/paymentDetailsBySemester/<?php echo $student_id ?>",
                                beforeSend: function () {
                                    $("#semester_wise_payment_details").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                                },
                                success: function (data) {
                                    if (data) {
                                        $("#semester_wise_payment_details").html(data);
                                    } else {
                                        $("#semester_wise_payment_details").html("No record found");
                                    }

                                }
                            });
                        }
                    });

                </script>