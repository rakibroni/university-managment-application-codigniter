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
    a.accordion-toggle{
        outline: none;
        color: #fff;
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="col-lg-12">
        <div class="panel-body padding_0">
            <div class="panel-group" id="accordion">
                <div class="panel panel-primary">
                    <div class="panel-heading">      
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <h4 class="panel-title"><?php echo $student_info->STUDENT_NAME; ?> (<?php echo $student_info->SESSION; ?>)</h4>
                        </a>      
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse">
                        <div class="panel-body">
                            <address>
                                Faculty: <?php echo $student_info->FACULTY; ?><br />
                                Department: <?php echo $student_info->DEPARTMENT; ?><br />
                                Program: <?php echo $student_info->PROGRAM; ?><br />
                                Session: <?php echo $student_info->SESSION; ?>
                            </address>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="ibox float-e-margins">
            <div class="ibox-content" style="padding: 3px;">
                <h2>Particulars</h2>
                <small>Session</small>
                <div class="">
                    <?php echo form_dropdown("cmbSession", $sessions, $student_info->SESSION_ID, "class='form-control navy-bg'") ?>
                </div>
                <ul class="todo-list m-t small-list">
                    <?php
                    if (!empty($expenses)):
                        $i = 0;
                        $total = 0;
                        foreach ($expenses as $expense):
                            ?>
                            <li>
                                <input type="checkbox" class="expense" id="checkbox<?php echo $i; ?>" data-amt="<?php echo $expense->PARTICULAR_AMOUNT; ?>" value="<?php echo $expense->PARTICULAR_ID; ?>">
                                <label for="checkbox<?php echo $i; ?>"><?php echo $expense->CHARGE_NAME; ?></label>
                                <div class="pull-right" style="font-size: 14px; margin-top: 4px;"><?php echo number_format($expense->PARTICULAR_AMOUNT, 2); ?></div>
                            </li>
                            <?php
                            $total += $expense->PARTICULAR_AMOUNT;
                            $i++;
                        endforeach;
                        ?>
                        <li><div class="pull-right text-danger">Total = <?php echo number_format($total, 2); ?></div><br clear="all" /></li>
                        <?php
                    endif;
                    ?>
                </ul>
            </div>
        </div>             
    </div>
    <div class="col-lg-8">
        <div class="wrapper wrapper-content animated fadeInRight" style="padding:0;">
            <div class="ibox-content">
                <form id="frmPayment" action="<?php echo base_url(); ?>/payment/doPayment" method="post">
                    <div>
                        <div class="col-sm-6">                   
                            <h3>
                                <span class="text-danger"><strong>DUE: </strong> 25,000.00 BDT</span><br/>
                                <span><strong>Due Date:</strong> March 24, 2014</span>
                            </h3>
                            <?php
                            if (!empty($student_info)) {
                                ?>                                
                                <input type="hidden" value="<?php echo $student_info->STUDENT_ID; ?>" name="txtStudent" />
                                <input type="hidden" value="<?php echo $student_info->ROLL_NO; ?>" name="txtRollNo" />
                                <input type="hidden" value="<?php echo $student_info->FACULTY_ID; ?>" name="txtFaculty" />
                                <input type="hidden" value="<?php echo $student_info->DEPT_ID; ?>" name="txtDept" />
                                <input type="hidden" value="<?php echo $student_info->PROGRAM_ID; ?>" name="txtProgram" />
                                <input type="hidden" value="<?php echo $student_info->SESSION_ID; ?>" name="txtSession" />
                                <input type="hidden" value="<?php echo $student_info->SEMISTER; ?>" name="txtSemister" />
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-sm-6 text-right">
                            <h4>Invoice No.</h4>
                            <h4 class="text-navy">INV-000567F7-00</h4>                        
                            <p>
                                <span><strong>Invoice Date:</strong> <?php echo date("d M,Y"); ?></span><br/>
                            </p>
                        </div>
                        <br clear="all" />
                    </div>

                    <div class="table-responsive m-t" style="background-color:#F3F3F4;">
                        <table class="table invoice-table" id="invoice">
                            <thead>
                                <tr>
                                    <th>Particular Name</th>
                                    <th>Quantity</th>
                                    <th>Unit Price (BDT)</th>
                                    <th>Total (BDT)</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr><td colspan="5" id="loading_img"></td></tr>
                            </tfoot>
                        </table>
                    </div><!-- /table-responsive -->

                    <table class="table invoice-total">
                        <tbody>
                            <tr>
                                <td><strong>Grand Total :</strong></td>
                                <td class="text-danger" id="grand_total">00.00</td>
                            </tr>
                            <tr>
                                <td><strong>Payment :</strong></td>
                                <td class="text-danger" style="background-color:#F3F3F4;"><input type="text" name="txtPayment[]" id="txtPayment" placeholder="00.00" style="width:80px; text-align:right;" /></td>
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
                                <td class="text-danger" id="due_amt">00.00</td>
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
                    </div><hr />
                    <div class="text-right">
                        <input type="button" class="btn btn-primary" id="btnPayment" value="Make A Payment" />
                    </div>
                </form>
            </div>            
        </div>
    </div>
    <br clear="all" />
</div>
<script>
    $(document).ready(function () {
        $(document).on("click", ".expense", function () {
            $('#due_amt').html("00.00");
            $('#return_amt').html("00.00");
            var expense_id = $(this).val();
            if ($(this).is(":checked")) {
                var checkData = $("#invoice tbody").find("#row_" + expense_id + " td .expense_id").val();
                if (checkData == expense_id) {
                    alert("");
                } else {
                    $.ajax({
                        type: "post",
                        url: "<?php echo site_url('payment/getExpenseDetails'); ?>/",
                        data: {expense_id: expense_id},
                        beforeSend: function () {
                            $("#loading_img").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' style='width:10px;' />");
                        },
                        success: function (data) {
                            $("#loading_img").html("");
                            $("#invoice tbody").append(data);

                            var total = 0;
                            $('.expense_rate').each(function () {
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
                $('.expense_rate').each(function () {
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
        $(document).on("input", "#txtPayment", function () {
            this.value = this.value.replace(/[^0-9.]/g, '');
            var total = 0;
            $('.expense_rate').each(function () {
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
        $(document).on("input", ".txtItemQty", function (event) {
            this.value = this.value.replace(/[^0-9]/g, '');
            var expense_id = $(this).attr("id");
            var qty = $(this).val();
            var unit_price = parseFloat($("#item_amt_" + expense_id).val());
            $("#amt_" + expense_id).val((qty * unit_price).toFixed(2));
            $("#total_" + expense_id).text((qty * unit_price).toFixed(2));
            var total = 0;
            $('.expense_rate').each(function () {
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
        $(document).on("click", "#btnPayment", function () {
            if (confirm("Are You Sure?")) {
                $("#frmPayment").submit();
            }
        });

    });
</script>