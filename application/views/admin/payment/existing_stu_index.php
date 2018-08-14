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
/* echo "<pre>";
  print_r($allSession);
  exit(); */
if (!empty($student_info)) {
    ?>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="col-lg-12">
            <div class="panel-body padding_0">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion"
                               href="#collapseOne">
                                <h4 class="panel-title"><?php echo $student_info->FULL_NAME_EN; ?>
                                    - <?php echo $student_info->SESSION_ID; ?></h4>
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
        <form id="frmPayment" action="<?php echo site_url('payment/doPayment_existingStu'); ?>" method="post">
            <div class="col-lg-4 tooltip-demo">
                <div class="ibox float-e-margins">
                    <div class="ibox-content" style="padding: 3px;">
                        <h2>Particulars</h2>
                        <hr style="margin: 0;"/>
                        <h4>Semester</h4>
                        <?php
                        /*   $semArray = array();
                          $semName = array();
                          $slNo = array();
                          foreach ($allSemester as $sem) {
                          array_push($semArray, $sem->NUMB_LKP);
                          array_push($semName, $sem->LKP_NAME);
                          array_push($slNo, $sem->SL_NO);
                          }
                          for ($i=0; $i < sizeof($semArray) ; $i++) {
                          $semArray[$i];
                          if($semArray[$i] == $student_info->SEMESTER_SL_NO){
                          $Max_semester = $i;
                          }
                          }
                          foreach ($allSession as $sesId) {
                          $allSes[] = $sesId->SESSION_NAME;
                          $ses_id[] = $sesId->SESSION_ID;
                          } */
                        ?>
                        <div class="">
                            <select name="cmbSemester" class="form-control" id="cmbSemester" style="background: #1AB394; color: #fff;">
                                <option value="">Select Semester</option>
                                <option value="all">All</option>
                                <?php
                                foreach ($semesters as $semester) {
                                    $selected = ($student_info->SEMESTER_SL_NO == $semester->SEMESTER_SL_NO) ? "selected='selected'" : "";
                                    ?>
                                    <option value="<?php echo $semester->SEMESTER_SL_NO . "," . $semester->SESSION_ID?>" data-semester="<?php echo $semester->SEMESTER_SL_NO ?>"  data-session="<?php echo $semester->SESSION_ID ?>" <?php echo $selected; ?> data-numb="<?php echo $semester->NUMB_LKP ?>">
                                        <?php echo $semester->LKP_NAME . ' - ' . ' - ' . $semester->SESSION_NAME . ' - ' . $semester->DINYEAR; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>

    <!--                            <select name="cmbSemester" class="form-control" id="cmbSemester"  style="background: #1AB394; color: #fff;">
        <option value="" data-semester="">Select Semester</option>
        <option value="all" data-semester="all">All</option>
                            <?php
                            foreach ($semesters as $semester) {
                                for ($i = 0; $i < sizeof($semArray); $i++) {
                                    $selected = ($semArray[$i] == $semester->SEMESTER_ID) ? "selected='selected'" : "";
                                    if ($semArray[$i] <= $student_info->SEMISTER_ID) {
                                        echo $semArray[$i];
                                        ?>
                            <option value="<?php echo $semArray[$i] . "," . $ses_id[$Max_semester - $i] ?>" data-semester="<?php echo $semArray[$i] ?>" data-session="<?php echo $ses_id[$Max_semester - $i] ?>" <?php echo $selected; ?>
                                    data-numb="<?php echo $slNo[$i] ?>"><?php echo $semName[$i]; ?>
                                - <?php echo $allSes[$Max_semester - $i];
                        if (($Max_semester - $i) == 0) echo ' [current]'; ?></option>
                                        <?php
                                    }
                                }
                            }
                            ?>
    </select>-->
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
                                <tbody></tbody>
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
                                    <td class="text-danger"
                                        id="due_amt"><?php //echo $total_due;
                                ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Payment :</strong></td>
                                    <td class="text-danger" style="background-color:#F3F3F4;"><input type="text" name="txtPayment[]"  id="txtPayment"  placeholder="00.00"  style="width:80px; text-align:right;"/>
                                    </td>
                                </tr>
                                <!--                            <tr>
                                                                <td><strong>Payment(Cheque ) :</strong></td>
                                                                <td class="text-danger" style="background-color:#F3F3F4;"><input type="text" name="txtPayment[]" id="txtPayment" placeholder="00.00" style="width:80px; text-align:right;" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Payment(Card) :</strong></td>
                                                                <td class="text-danger" style="background-color:#F3F3F4;"><input type="text" name="txtPayment[]" id="txtPayment" placeholder="00.00" style="width:80px; text-align:right;" /></td>
                                                            </tr>-->
                                <tr>
                                    <td><strong>Due Amount :</strong></td>
                                    <td class="text-danger"
                                        id="due_amt"><?php //echo $total_due;
                                ?></td>
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
            var semester = $('option:selected', this).attr("data-semester");
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
                            url: "<?php echo site_url('payment/getAllSemesterExpenses'); ?>/",
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
                        var txtSemesterSeq = $('option:selected', this).attr("data-semester");
                        var semCurrent = $('option:selected', this).text();
                        $.ajax({
                            type: "post",
                            url: "<?php echo site_url('payment/getExpenseDetailsBySemester_existingStu'); ?>/",
                            data: {
                                semester: semester,
                                txtStudent: txtStudent,
                                txtFaculty: txtFaculty,
                                txtDept: txtDept,
                                txtProgram: txtProgram,
                                txtSession: txtSession,
                                txtSemesterSeq: txtSemesterSeq,
                                semCurrent: semCurrent
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
            var session = $("#cmbSemester").val();
            //alert(session);
            var program = $(this).attr("data-pro");
            var semester = $(this).attr("data-sem");
            var isCurrent = $("#cmbSemester").find("option:selected").text();
            if ($(this).is(":checked")) {
                var checkData = $("#invoice tbody").find("#row_" + expense_id + " td .expense_id").val();
                if (checkData == expense_id) {
                    alert("");
                } else {
                    $.ajax({
                        type: "post",
                        url: "<?php echo site_url('payment/getExpenseDetails_existingStu'); ?>/",
                        data: {
                            expense_id: expense_id,
                            program: program,
                            semester: semester,
                            faculty: faculty,
                            department: department,
                            session: session,
                            isCurrent: isCurrent
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