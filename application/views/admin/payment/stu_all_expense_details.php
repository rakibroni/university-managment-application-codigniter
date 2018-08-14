<style>
    .ibox {
        margin-bottom: 0;
    }

    .ibox-title {
        padding: 5px;
        min-height: 30px;
    }
</style>
<?php
$total_due = 0;
$total_bal = 0;
$total_amt_bal = 0;
$total_amt_due = 0;
$i = 0;
if (!empty($expenses)):
    $i = 0;
    foreach ($expenses as $expense):
        $exp_cond = array(
            "FACULTY_ID" => $txtFaculty,
            "DEPT_ID" => $txtDept,
            "PROGRAM_ID" => $txtProgram,
            "SEMESTER_ID" => $expense->LKP_ID
        );
        $expense_heads = $this->utilities->findAllByAttributeWithJoin("ac_program_particulars", "ac_academic_charge", "PARTICULAR_ID", "CHARGE_ID", "CHARGE_NAME", $exp_cond);
        $dueAmt = $this->db->query("SELECT v.VOUCHER_NO, v.VOUCHER_DT, v.STUDENT_ID, v.ROLL_NO, v.REMARKS, l.TRX_CODE_NO, l.TRX_TRAN_NO, l.CR_AMT, sum(l.DR_AMT) DEBIT
                                                                FROM bm_vouchermst v INNER JOIN bm_vn_ledgers l ON v.VOUCHER_NO = l.VOUCHER_NO 
                                                                WHERE v.STUDENT_ID = '$txtStudent' AND v.SEMESTER_ID = $expense->LKP_ID AND l.TRX_CODE_NO = 'PM' GROUP BY v.STUDENT_ID")->row();
        ?>
        <div class="ibox float-e-margins">
            <div class="ibox-title" style="padding: 10px;">
                <h5><?php echo $expense->LKP_NAME; ?> - <?php echo $expense->SESSION; ?></h5>

                <div class="pull-left" id="total_label_<?php echo $i; ?>"></div>
                <input type="hidden" id="expense_<?php echo $i; ?>" data-seq="<?php echo $i; ?>"
                       value="<?php echo $expense->LKP_NAME; ?> - <?php echo $expense->SESSION; ?>"
                       class="expense_name"/>
                <input type="hidden" id="expense_amt_<?php echo $i; ?>" value="0.00" class="expense_amt"/>
                <input type="hidden" id="expense_ttl_amt_<?php echo $i; ?>" value="0.00"/>
                <input type="hidden" id="pay_amt_<?php echo $i; ?>" value="0.00"/>

                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <ul class="todo-list m-t small-list" id="expenseList">
                    <?php
                    $sem_total = 0;
                    if (!empty($expense_heads)):
                        $j = 0;
                        foreach ($expense_heads as $expense):
                            ?>
                            <li>
                                <?php
                                if (!empty($dueAmt) && $dueAmt->DEBIT == 0) {
                                    ?>
                                    <option value="<?php echo $semester->SEMESTER_ID ?>" <?php echo $selected; ?>
                                            data-numb="<?php echo $semester->NUMB_LKP ?>"><?php echo $semester->LKP_NAME ?></option>
                                <?php
                                }
                                ?>
                                <label for="checkbox<?php echo $j; ?>"><?php echo $expense->CHARGE_NAME; ?></label>

                                <div class="pull-right"
                                     style="font-size: 14px; margin-top: 4px;"><?php echo number_format($expense->PARTICULAR_AMOUNT, 2); ?></div>
                            </li>
                            <?php
                            $sem_total += $expense->PARTICULAR_AMOUNT;
                            $j++;
                        endforeach;
                    endif;
                    ?>
                    <li style="border-bottom:1px solid #000; background: none; border-radius: 0; padding: 0;"></li>
                    <li style=" border-radius: 0;border-top:1px solid #000;">
                        <div class="pull-right text-danger">Total =
                            <strong><?php echo number_format($sem_total, 2); ?></strong></div>
                        <br clear="all"/></li>
                    <li style=" border-radius: 0;">
                        <div class="pull-right text-danger">Payment = <strong
                                id="payment<?php echo $i; ?>"><?php echo number_format($totalPayment = (!empty($dueAmt) ? $dueAmt->DEBIT : 0), 2); ?></strong>
                        </div>
                        <br clear="all"/></li>
                    <li style="border-bottom:1px solid #000; background: none; border-radius: 0; padding: 0;"></li>
                    <?php
                    if ($totalPayment < $sem_total) {
                        ?>
                        <li style="border-top:1px solid #000; border-radius: 0; ">
                            <div class="pull-right" id="balance<?php echo $i; ?>"><span class="text-danger">Total Due = <strong
                                        id="total_amt"><?php echo number_format($total_amt_due = ($sem_total - $totalPayment), 2); ?></strong></span>
                            </div>
                            <br clear="all"/></li>
                        <?php
                        $total_due = $total_amt_due;
                    } else {
                        ?>
                        <li style="border-top:1px solid #000; border-radius: 0; ">
                            <div class="pull-right" id="balance<?php echo $i; ?>"><span class="text-navy">Total Balance = <strong
                                        id="total_amt"><?php echo number_format($total_amt_bal = ($totalPayment - $sem_total), 2); ?></strong></span>
                            </div>
                            <br clear="all"/></li>
                        <?php
                        $total_bal = $total_amt_bal;
                    }
                    ?>
                </ul>
                <script>
                    $("#total_label_<?php echo $i; ?>").html($("#balance<?php echo $i; ?>").html() + " BDT");
                    $("#expense_amt_<?php echo $i; ?>").val("<?php echo ($total_due != '') ? $total_due : 0; ?>");
                    $("#pay_amt_<?php echo $i; ?>").val("<?php echo $totalPayment; ?>");
                    $("#expense_ttl_amt_<?php echo $i; ?>").val("<?php echo $sem_total; ?>");
                </script>
            </div>
        </div>
        <?php
        $i++;
    endforeach;
    ?>
<?php
endif;
?>
<ul class="todo-list m-t small-list" id="expenseList" style="margin: 0;">
    <li style="border-bottom:1px solid #000; background: none; border-radius: 0; padding: 0;"></li>
    <li style=" border-radius: 0; border-top:1px solid #000;">
        <div class="pull-right text-danger">Net Total =
            <strong><?php echo number_format(($total_due - $total_bal), 2); ?> BDT</strong></div>
        <br clear="all"/></li>
</ul>
<script>
    // Collapse ibox function
    $('.collapse-link').click(function () {
        var ibox = $(this).closest('div.ibox');
        var button = $(this).find('i');
        var content = ibox.find('div.ibox-content');
        content.slideToggle(200);
        button.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
        ibox.toggleClass('').toggleClass('border-bottom');
        setTimeout(function () {
            ibox.resize();
            ibox.find('[id^=map-]').resize();
        }, 50);
    });
</script>