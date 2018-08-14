 
<div class="panel-body">
    <div class="col-md-8">
     <div class="panel panel-primary">             
        <div id="" class="panel-collapse collapse in" aria-expanded="true">
            <div class="panel-body">

                <table class="table table-bordered">
                    <tr>
                        <th>Session</th>
                        <th>:</th>
                        <td><?php echo $this->utilities->academicSessionById($student_info->SESSION_ID)->SESSION_NAME ?></td>
                        <th>Name</th>
                        <th>:</th>
                        <td><?php echo $student_info->FULL_NAME_EN ?></td>
                    </tr>
                    <tr>
                        <th>Registration No.</th>
                        <th>:</th>
                        <td><?php echo $student_info->REGISTRATION_NO ?></td>
                        <th>Program</th>
                        <th>:</th>
                        <td><?php echo $this->utilities->findByAttribute('ins_program',array('PROGRAM_ID'=>$student_info->PROGRAM_ID))->PROGRAM_SHORT_NAME; ?></td>
                    </tr>
                </table>                             
            </div>
        </div>
    </div>
    <div class="panel panel-primary">             
        <div id="" class="panel-collapse collapse in" aria-expanded="true">
            <div class="panel-body">
                <?php if(!empty($semester_wise_course)) : ?>

                    <table class="table table-striped table-bordered table-hover">

                        <tr class="info">
                            <th>#</th>
                            <th>Course Code</th>
                            <th>Course Name</th>                             
                            <th class="text-center">Credit</th>
                        </tr>

                        <tbody>
                            <?php $total_credit_per_semester=0; ?>

                            <?php $sl=1; foreach ($semester_wise_course as $rows) : ?>

                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><?php echo $rows->COURSE_CODE; ?></td>
                                <td><?php echo $rows->COURSE_TITLE; ?></td>                                    
                                <td style='text-align: center'><?php echo $rows->CREDIT; $total_credit_per_semester += $rows->CREDIT; ?></td>
                            </tr>

                        <?php endforeach; ?>
                        <tr><td colspan='3' style='text-align: right'><b>Total  :</b></td><td style='text-align: center'><b><?php echo $total_credit_per_semester ?></b></td></tr>
                    </tbody>
                </table>

            <?php else: ?>

                <span><?php echo 'No Data Found'; ?></span>

            <?php endif; ?>
        </div>
    </div>
</div>
</div>
<div class="col-md-4"  >
    <table class="table">
        <?php $sub_total=''; foreach($charge_rate as $charge_rate_row): ?>
            <tr>
                <td><?php echo  $charge_rate_row->CHARGE_NAME ?></td>
                <td>
                    <span class="badge badge-peimary pull-right">
                        <?php 
                            if( $charge_rate_row->CHARGE_NAME =='Tuition Fee') {
                                $total_fee=$total_credit_per_semester * $charge_rate_row->AMOUNT;
                            }else{
                                $total_fee=$charge_rate_row->AMOUNT;
                            } 
                            $sub_total +=$total_fee;
                            echo number_format( $total_fee ,2); 
                        ?> 
                    </span>
                </td>
            </tr>
        <?php endforeach; ?>

        <tr>
            <td><span class="text-success"><b> Total</b></span> </td>
            <td><span class="badge badge-peimary pull-right"><?php echo number_format( $sub_total ,2); ?></span></td>
        </tr>
        <tr>
            <td><span class="text-warning"><b> Deduction</b></span> </td>
            <td><span class="badge badge-peimary pull-right">0.00 </span></td>
        </tr>
        <tr>
            <td><span class="">  Prev. Balance </span> </td>
            <td><span class="badge badge-peimary pull-right">0.00 </span></td>
        </tr>
        <tr>
            <td><span class="text-success"><b>Net Total</b></span> </td>
            <td><span class="badge badge-peimary pull-right"><?php echo number_format( $sub_total ,2); ?> </span></td>
        </tr>
        <tr>
            <td><span class=""><b>Amount Paid</b></span> </td>
            <td><span class="badge badge-peimary pull-right">0.00</span></td>
        </tr>
        <tr>
            <td><span class="text-info"><b>Balance</b></span> </td>
            <td><span class="badge badge-peimary pull-right"><?php echo number_format( $sub_total ,2); ?> </span></td>
        </tr>
    </table>
</div>

</div>  
<center> <button class="btn btn-sm btn-danger  ">Make Payment</button></center>
<div class="clearfix"></div> 