<style>
    .panel-heading .accordion-toggle h4:after {
        /* symbol for "opening" panels */
        font-family: 'Glyphicons Halflings';
        content: "\e114";
        float: right;
        color: #fff;
        overflow: no-display;
    }

    .panel-heading .accordion-toggle.collapsed h4:after {
        content: "\e080";
    }

    a.accordion-toggle {
        outline: none;
        color: #fff;
    }
</style>
<?php
if (!empty($student_info)) {
    ?>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="col-lg-12">
            <div class="panel-body padding_0">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                <h4 class="panel-title">
                                    <?php echo $student_info->FULL_NAME_EN; ?> - <?php echo $student_info->SESSION_ID; ?>
                                </h4>
                            </a>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse">
                            <div class="panel-body">
                                <address>
                                    <strong>Faculty:</strong> <?php echo $student_info->FACULTY_NAME; ?><br/>
                                    <strong>Department:</strong> <?php echo $student_info->DEPT_NAME; ?><br/>
                                    <strong>Program:</strong> <?php echo $student_info->PROGRAM_NAME; ?><br/>
                                    <strong>Session:</strong> <?php echo $student_info->SESSION_ID; ?><br/>
                                    <strong>Semester:</strong> <?php echo $student_info->SEMESTER_SL_NO; ?>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form id="frmPayment" action="<?php echo base_url(); ?>/payment/doPayment" method="post">
            <div class="col-lg-4 tooltip-demo">
                <div class="ibox float-e-margins">
                    <div class="ibox-content" style="padding: 3px;">
                        <h2>Particulars</h2>
                        <hr style="margin: 0;"/>
                        <h4>Semester</h4>
                        <div class="">
                            <select name="cmbSemester" class="form-control" id="cmbSemester" style="background: #1AB394; color: #fff;">
                                <option value="">Select Semester</option>
                                <option value="all">All</option>
                                <?php
                                foreach ($semesters as $semester) {
                                    $selected = ($student_info->SEMESTER_SL_NO == $semester->SEMESTER_SL_NO) ? "selected='selected'" : "";
                                    ?>
                                    <option value="<?php echo $semester->SEMESTER_SL_NO ?>" data-session="<?php echo $semester->SESSION_ID ?>" <?php echo $selected; ?> data-numb="<?php echo $semester->NUMB_LKP ?>">
                                        <?php echo $semester->LKP_NAME . ' - ' . ' - ' . $semester->SESSION_NAME . ' - ' . $semester->DINYEAR; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <ul class="todo-list m-t small-list" id="expenseList">
                            <?php
                            $this->load->view("admin/payment/stu_expense_details", true);
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="wrapper wrapper-content animated fadeInRight" style="padding:0;">
                    <div class="ibox-content">
                        <div>
                            <div></div>
                            <div class="col-sm-6">
                                <?php
                                if (!empty($student_info)) {
                                    ?>
                                    <input type="hidden" value="<?php echo $student_info->STUDENT_ID; ?>" name="txtStudent" id="txtStudent"/>
                                    <input type="hidden" value="<?php echo $student_info->REGISTRATION_NO; ?>" name="txtRollNo" id="txtRollNo"/>
                                    <input type="hidden" value="<?php echo $student_info->FACULTY_ID; ?>" name="txtFaculty" id="txtFaculty"/>
                                    <input type="hidden" value="<?php echo $student_info->DEPT_ID; ?>" name="txtDept" id="txtDept"/>
                                    <input type="hidden" value="<?php echo $student_info->PROGRAM_ID; ?>" name="txtProgram" id="txtProgram"/>
                                    <input type="hidden" value="<?php echo $student_info->SESSION_ID; ?>" name="txtSession" id="txtSession"/>
                                    <input type="hidden" value="<?php echo $student_info->SEMESTER_SL_NO; ?>" name="txtSemister" id="txtSemister"/>
                                <?php } ?>
                            </div>
                            <br clear="all"/>
                        </div>
                        <div class="table-responsive m-t">
                            <table class="table invoice-table table-bordered" id="invoice">
                                <thead>
                                    <tr style="border-bottom:1px solid #333;">
                                        <th>Particular Name <span id="loading_img_top"></span></th>
                                        <th>Due</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" id="loading_img" style="background:#F5F5F6;"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /table-responsive -->
                        <table class="table invoice-total ">
                            <tbody>
                                <tr>
                                    <td><strong>Total :</strong></td>
                                    <td class="text-danger" id="grand_total">00.00</td>
                                </tr>
                                <tr>
                                    <td><strong>Grand Total :</strong></td>
                                    <td class="text-danger" id="due_amt"><?php //echo $total_due;   ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Payment :</strong></td>
                                    <td class="text-danger" style="background-color:#F3F3F4;">
                                        <input type="text" name="txtPayment[]" id="txtPayment" placeholder="00.00" style="width:80px; text-align:right;"/>
                                    </td>
                                </tr>
                                <!-- <tr>
                                            <td><strong>Payment(Cheque ) :</strong></td>
                                            <td class="text-danger" style="background-color:#F3F3F4;"><input type="text" name="txtPayment[]" id="txtPayment" placeholder="00.00" style="width:80px; text-align:right;" /></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Payment(Card) :</strong></td>
                                            <td class="text-danger" style="background-color:#F3F3F4;"><input type="text" name="txtPayment[]" id="txtPayment" placeholder="00.00" style="width:80px; text-align:right;" /></td>
                                        </tr>-->
                                <tr>
                                    <td><strong>Due Amount :</strong></td>
                                    <td class="text-danger"  id="due_amt"><?php //echo $total_due;  ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Return :</strong></td>
                                    <td class="text-danger" id="return_amt">00.00</td>
                                </tr>
                            </tbody>
                        </table>
                        <div>
                            <strong>Remarks</strong>
                            <textarea rows="2" class="form-control" name="txtRemarks"></textarea>
                        </div>
                        <hr/>
                        <div class="text-right">
                            <input type="button" class="btn btn-primary" id="btnPayment" value="Make A Payment"/>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <br clear="all"/>
    </div>
    <?php
} else {
    ?>
    <div class="col-lg-12">
        <div class="panel-body padding_0">
            <div class="panel-group" id="accordion">
                <div class="panel panel-primary">
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <address>
                                Payment Information Not Found.
                            </address>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>

<script>
    $(document).ready(function() {
        $("#semester_due").html($("#total_amt").text());

        $(document).on("change", "#cmbSemester", function() {
            var semester = $(this).val();
            if (semester != "") {
                var semester_name = $(this).find("option:selected").text();
                if (semester != "") {
                    $("#invoice tbody").html("");
                    $("#loading_img_top").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' style='width:10px;' />");
                    if (semester == "all") {
                        var txtStudent = $("#txtStudent").val();
                        var txtFaculty = $("#txtFaculty").val();
                        var txtDept = $("#txtDept").val();
                        var txtProgram = $("#txtProgram").val();
                        var semester_id = $("#txtSemister").val();
                        $.ajax({
                            type: "post",
                            url: "<?php echo site_url('finance/getAllSemesterExpenses'); ?>/",
                            data: {
                                semester_id: semester_id,
                                txtStudent: txtStudent,
                                txtFaculty: txtFaculty,
                                txtDept: txtDept,
                                txtProgram: txtProgram
                            },
                            beforeSend: function() {
                                //$("#loading_img").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' style='width:10px;' />");
                            },
                            success: function(data) {
                                $("#loading_img_top").html("");
                                $("#expenseList").html(data);
                                // getting all completed semesters details of a student
                                $(".expense_name").each(function() {
                                    var semester_seq = $(this).attr("data-seq");
                                    var semester_name = $(this).val();
                                    var dueAmt = $("#expense_amt_" + semester_seq).val();
                                    var payAmt = $("#pay_amt_" + semester_seq).val();
                                    var expense_ttl_amt_ = $("#expense_ttl_amt_" + semester_seq).val();
                                    // generating the list
                                    $("#invoice tbody").append("<tr id='row_" + semester_seq + "'>"
                                            + "<td class='text-navy'>"
                                            + "<span class='glyphicon glyphicon-remove-sign text-danger'></span> <strong>" + semester_name + "</strong>"
                                            + "<input type='hidden' class='expense_id' value='" + semester_seq + "' name='txtExpenseId[]' />"
                                            + "<input type='hidden' id='item_amt_" + semester_seq + "' value='" + dueAmt + "' class='expense_rate' name='txtExpenseRate[]' />"
                                            + "</td>"
                                            + "<td id='total_" + semester_seq + "'>" + (parseFloat(dueAmt)).toFixed(2) + "</td></tr>");
                                });
                                var total = 0;
                                $('.expense_rate').each(function() {
                                    total += parseFloat($(this).val());
                                });
                                $('#grand_total').html(total.toFixed(2));// Update the total

                                var payment = $("#txtPayment").val();
                                if (payment > total) {
                                    $('#return_amt').html((payment - total).toFixed(2));// Update the Due Amount
                                    $('#due_amt').html("00.00");
                                } else {
                                    $('#due_amt').html((total - payment).toFixed(2));// Update the Due Amount
                                    $('#return_amt').html("00.00");
                                }
                            }
                        });
                    } else {
                        var txtStudent = $("#txtStudent").val();
                        var txtFaculty = $("#txtFaculty").val();
                        var txtDept = $("#txtDept").val();
                        var txtProgram = $("#txtProgram").val();
                        var txtSession = $('option:selected', this).attr("data-session");
                        var txtSemesterSeq = $('option:selected', this).attr("data-numb");
                        $.ajax({
                            type: "post",
                            url: "<?php echo site_url('finance/getExpenseDetailsBySemester'); ?>/",
                            data: {
                                semester: semester,
                                txtStudent: txtStudent,
                                txtFaculty: txtFaculty,
                                txtDept: txtDept,
                                txtProgram: txtProgram,
                                txtSession: txtSession,
                                txtSemesterSeq: txtSemesterSeq
                            },
                            beforeSend: function() {
                                //$("#loading_img").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' style='width:10px;' />");
                            },
                            success: function(data) {
                                $("#loading_img_top").html("");
                                $("#expenseList").html(data);
                                //
                                var isFirstTime = $("#txtIsFirstTime").val();
                                if (isFirstTime == 0) {
                                    var dueAmt = $("#total_amt").val();
                                    var payAmt = $("#pay_amt_" + txtSemesterSeq).val();
                                    var ttl_amt = $("#ttl_amt_" + txtSemesterSeq).val();
                                    $("#invoice tbody").html("<tr id='row_" + txtSemesterSeq + "'>"
                                            + "<td class='text-navy'>"
                                            + "<strong>" + semester_name + "</strong>"
                                            + "<input type='hidden' class='expense_id' value='" + txtSemesterSeq + "' name='txtExpenseId[]' />"
                                            + "<input type='hidden' id='item_amt_" + txtSemesterSeq + "' value='" + dueAmt + "' class='expense_rate' name='txtExpenseRate[]' />"
                                            + "</td>"
                                            + "<td id='total_" + txtSemesterSeq + "'>" + (parseFloat(dueAmt)).toFixed(2) + "</td></tr>");
                                    var total = 0;
                                    $('.expense_rate').each(function() {
                                        total += parseFloat($(this).val());
                                    });
                                    $('#grand_total').html(total.toFixed(2));// Update the total

                                    var payment = $("#txtPayment").val();
                                    if (payment > total) {
                                        $('#return_amt').html((payment - total).toFixed(2));// Update the Due Amount
                                        $('#due_amt').html("00.00");
                                    } else {
                                        $('#due_amt').html((total - payment).toFixed(2));// Update the Due Amount
                                        $('#return_amt').html("00.00");
                                    }
                                }
                            }
                        });
                    }
                }
            }
        });
        
        
        
        $(document).on("click", ".expense", function() {
            $('#due_amt').html("00.00");
            $('#return_amt').html("00.00");
            var expense_id = $(this).val();
            var faculty = $("#txtFaculty").val();
            var department = $("#txtDept").val();
            var session = $("#txtSession").val();
            var program = $(this).attr("data-pro");
            var semester = $(this).attr("data-sem");
            if ($(this).is(":checked")) {
                var checkData = $("#invoice tbody").find("#row_" + expense_id + " td .expense_id").val();
                if (checkData == expense_id) {
                    alert("");
                } else {
                    $.ajax({
                        type: "post",
                        url: "<?php echo site_url('finance/getExpenseDetails'); ?>/",
                        data: {
                            expense_id: expense_id,
                            program: program,
                            semester: semester,
                            faculty: faculty,
                            department: department,
                            session: session
                        },
                        beforeSend: function() {
                            $("#loading_img").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' style='width:10px;' />");
                        },
                        success: function(data) {
                            $("#loading_img").html("");
                            $("#invoice tbody").append(data);

                            var total = 0;
                            $('.expense_rate').each(function() {
                                total += parseFloat($(this).val());
                            });
                            $('#grand_total').html(total.toFixed(2));// Update the total

                            var payment = $("#txtPayment").val();
                            if (payment > total) {
                                $('#return_amt').html((payment - total).toFixed(2));// Update the Due Amount
                                $('#due_amt').html("00.00");
                            } else {
                                $('#due_amt').html((total - payment).toFixed(2));// Update the Due Amount
                                $('#return_amt').html("00.00");
                            }
                        }
                    })
                }
            } else {
                var amount = $(this).attr("data-amt");
                var total = 0;
                $('.expense_rate').each(function() {
                    total += parseFloat($(this).val());
                });
                $('#grand_total').html((total - amount).toFixed(2));// Update the total
                var payment = $("#txtPayment").val();
                var grand_total = $('#grand_total').html();
                if (payment > grand_total) {
                    $('#return_amt').html((payment - grand_total).toFixed(2));// Update the Due Amount
                    $('#due_amt').html("00.00");
                } else {
                    $('#due_amt').html((grand_total - payment).toFixed(2));// Update the Due Amount
                    $('#return_amt').html("00.00");
                }
                $("#invoice tbody").find("#row_" + expense_id).remove();
            }
        });
        $(document).on("input", "#txtPayment", function() {
            this.value = this.value.replace(/[^0-9.]/g, '');
            var total = 0;
            $('.expense_rate').each(function() {
                total += parseFloat($(this).val());
            });
            if ($(this).val() > total) {
                $('#return_amt').html(($(this).val() - total).toFixed(2));// Update the Due Amount
                $('#due_amt').html("00.00");
            } else {
                $('#due_amt').html((total - $(this).val()).toFixed(2));// Update the Due Amount
                $('#return_amt').html("00.00");
            }
        });
        $(document).on("input", ".txtItemQty", function(event) {
            this.value = this.value.replace(/[^0-9]/g, '');
            var expense_id = $(this).attr("id");
            var qty = $(this).val();
            var unit_price = parseFloat($("#item_amt_" + expense_id).val());
            $("#amt_" + expense_id).val((qty * unit_price).toFixed(2));
            $("#total_" + expense_id).text((qty * unit_price).toFixed(2));
            var total = 0;
            $('.expense_rate').each(function() {
                total += parseFloat($(this).val());
            });
            $('#grand_total').html(total.toFixed(2));// Update the total
            var payment = $("#txtPayment").val();
            if (payment > total) {
                $('#return_amt').html((payment - total).toFixed(2));// Update the Due Amount
                $('#due_amt').html("00.00");
            } else {
                $('#due_amt').html((total - payment).toFixed(2));// Update the Due Amount
                $('#return_amt').html("00.00");
            }
        });
        $(document).on("click", "#btnPayment", function() {
            if (confirm("Are You Sure?")) {
                $("#frmPayment").submit();
            }
        });

    });
</script>




<!--<div class="ibox float-e-margins">
    <div class="ibox-title">
        <div class="col-md-9"><b>Payment Details</b></div>
    </div>
    <div class="ibox-content"> 
<?php echo form_open('', array('id' => 'paymentReceipt')); ?>
        <div id="semester_wise_payment_details">
            <div class="panel-body">
                <div class="col-md-8">
                     <div class="panel panel-primary">             
                        <div id="" class="panel-collapse collapse in" aria-expanded="true">
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Session</th>
                                        <th>:</th>
                                        <td><?php echo $session_name->SESSION_NAME ?></td>
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
                                        <td><?php echo $student_info->PROGRAM_NAME ?></td>
                                    </tr>
                                </table>                             
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-primary">             
                        <div id="" class="panel-collapse collapse in" aria-expanded="true">
                            <div class="panel-body">
                                <table class="table table-bordered">
                                <tr class="info">
                                    <th class="text-center">#</th>
                                    <th>Code</th>
                                    <th>Course</th>
                                    <th class="text-center">Credit</th>
                                </tr>
<?php
$total_credit = 0;
foreach ($semester_wise_course as $key => $value) {
    $total_credit += $value->CREDIT;
    ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $key + 1 ?></td>
                                                    <td><?php echo $value->COURSE_CODE ?></td>
                                                    <td><?php echo $value->COURSE_TITLE ?></td>
                                                    <td class="text-center"><?php echo $value->CREDIT ?></td>
                                                </tr>
<?php } ?>
                                    <tr>
                                        <td colspan="3" style="text-align: right;"><b>Total</b></td>
                                        <td class="text-center"><b><?php echo $total_credit ?></b></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"  >
                    <div class="panel panel-warning">             
                        <div id="" class="panel-collapse collapse in" aria-expanded="true">
                            <div class="panel-body">
                                <table class="table">
<?php
$total = 0;
foreach ($charge_info as $key => $value) {
    $total += ($value->CHARGE_NAME == 'Tuition Fee') ? $value->AMOUNT * $total_credit : $value->AMOUNT;
    ?>
                                                <tr>
                                                    <td><?php echo $value->CHARGE_NAME ?></td>
                                                    <td>
                                                        <span class="badge badge-peimary pull-right">
    <?php echo ($value->CHARGE_NAME == 'Tuition Fee') ? number_format($value->AMOUNT * $total_credit, 2) : number_format($value->AMOUNT, 2) ?>
                                                        </span>
                                                    </td>
                                                </tr>
<?php } ?>
                                    <tr>
                                        <td><span class="text-success"><b> Total</b></span> </td>
                                        <td><span class="badge badge-peimary pull-right"><?php echo number_format($total, 2) ?> .BDT</span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-danger">             
                        <div id="" class="panel-collapse collapse in" aria-expanded="true">
                            <div class="panel-body">
                            <h4>Money Collection Info</h4>
                                <table class="table">
                                    <tr>
                                        <td>Receipt No</td>
                                        <td><input type="ibox-title" class="form-control" required="required" name="receipt_no" autocomplete="off"></td>
                                    </tr>
                                    <tr>
                                        <td>Receipt Date</td>
                                        <td><input type="ibox-title" class="form-control" required="required" name="receipt_date" autocomplete="off"></td>
                                    </tr>
                                    <tr>
                                        <td>Bank TRX No</td>
                                        <td><input type="ibox-title" class="form-control" required="required" name="trx_no" autocomplete="off"></td>
                                    </tr>
                                    <tr>
                                        <td>Amount</td>
                                        <td><input type="ibox-title" class="form-control" required="required" name="amount" autocomplete="off"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            <center>
                <input type="submit" class="btn btn-sm btn-danger" value="Make Payment">
                 <button type="submit" class="btn btn-sm btn-danger  "></button> 
            </center>
            <div class="clearfix"></div>
        </div>
<?php echo form_close(); ?>
    </div>  
</div>-->