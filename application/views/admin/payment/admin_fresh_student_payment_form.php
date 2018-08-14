<div class="ibox float-e-margins">
    <!--    <div class="ibox-title">-->
    <!--        <div class="col-md-9"><b>Payment Details</b></div>-->
    <!--        <div class="col-md-3 has-success">-->
    <!--            <select class="form-control " id="YSESSION_ID">-->
    <!--                <option value="">-- Select Session --</option>-->
    <!--                --><?php //if (!empty($session)): foreach ($session as $row): ?>
    <!--                    <option value="--><?php //echo $row->YSESSION_ID ?><!--">--><?php //echo $row->SESSION_NAME ?><!--</option>-->
    <!--                --><?php //endforeach; endif; ?>
    <!--            </select>-->
    <!--        </div>-->
    <!--    </div>-->
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
                    </div>
                    <div class="col-md-6">

                        <div class="panel panel-primary">
                            <div id="" class="panel-collapse collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <div id="pDetails">
                                        <table class="table table-bordered">
                                            <tr class="info">
                                                <td colspan="7"><b class="text-warning">Payment Details</b></td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-4">Particular</th>
                                                <th>Amount</th>
                                            </tr>
                                            <?php $total_tuition=0; $total=0; foreach ($semester_wise_payment as $row): ?>
                                                <tr>
                                                    <td><?php echo $row->AC_NAME; ?></td>
                                                    <td><?php echo ($row->AC_NO == 4) ? $total = $row->AMOUNT * $tot_credit : $total = $row->AMOUNT ?></td>
                                                    <?php $total_tuition += $total; ?>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td ><b>Total Amount</b></td>
                                                <td><b><?php echo $total_tuition; ?> BDT.</b></td>
                                            </tr>


                                        </table>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<!---->
<!--                <center>-->
<!--                    <!--                <button class="btn btn-sm btn-danger  ">Make Payment</button>-->
<!--                    <input type="button" data-action="finance/createVoucher" data-su-action="finance/myFunction"-->
<!--                           data-param="--><?php //echo $student_info->STUDENT_ID; ?><!--" data-view-div="pDetails"-->
<!--                           id="hostel_bill_generate_btn" class="btn btn-danger btn-sm form_submit" value="Make Payment">-->
<!--                </center>-->
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