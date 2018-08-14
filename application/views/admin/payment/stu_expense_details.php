<style>
    .empty_list {
        border-bottom: 1px solid #000;
        background: none;
        border-radius: 0;
        padding: 0;
    }

    .radius0 {
        border-radius: 0;
    }

    .payment-border {
        border-top: 1px solid #000;
    }
</style>
<?php
$expense_total = 0;
if (!empty($expenses)):
    $i = 0;
    foreach ($expenses as $expense):
        ?>
        <li>
            
            <label for="checkbox<?php echo $i; ?>"><?php echo $expense->AC_NAME; ?></label>
            <div class="pull-right" style="font-size: 14px; margin-top: 4px;">
                <?php echo number_format($expense->BILL_AMT, 2); ?>
            </div>
        </li>
        <?php
        $expense_total += $expense->BILL_AMT;
        $i++;
    endforeach;
endif;
?>
<li class="empty_list"></li>
<li class="payment-border radius0">
    <div class="pull-right text-danger">Total = <strong><?php echo number_format($expense_total, 2); ?></strong></div>
    <br clear="all"/>
</li>








<?php
$prevDue = 0;
$prevBalance = 0;
$total_amt_bal = 0;
$total_amt_due = 0;
$prev_exp_amt = (!empty($prev_expenses) ? $prev_expenses->AMOUNT : "00.00");
$prev_semester_amt = (!empty($prevSemesterAmt) ? $prevSemesterAmt->DEBIT : "00.00");
if ($prev_exp_amt > $prev_semester_amt) {
    $prevDue = ($prev_exp_amt - $prev_semester_amt);
} else {
    $prevBalance = ($prev_semester_amt - $prev_exp_amt);
}
?>
<li>
    <div class="pull-right text-navy">
        Amount Paid = <strong><?php echo number_format($totalPayment = (!empty($dueAmt)) ? $dueAmt->DEBIT : "0.00", 2); ?></strong>
    </div>
    <input type="hidden" id="pay_amt_<?php echo $semester_seq; ?>" value="<?php echo $totalPayment; ?>"/>
    <input type="hidden" id="ttl_amt_<?php echo $semester_seq; ?>" value="<?php echo $expense_total; ?>"/>
    <br clear="all"/>
</li>
<li style="border-bottom:1px solid #000; background: none; border-radius: 0; padding: 0;"></li>
<?php
$std_expense = $expense_total;
$amt = ($totalPayment > $std_expense) ? ($totalPayment - $std_expense) : ($std_expense - $totalPayment);
if ($totalPayment < $std_expense) {
    ?>
    <li class="payment-border radius0">
        <div class="pull-right text-danger">
            Due = <strong><?php echo number_format($total_amt_due = $amt, 2); ?></strong>
            <input type="hidden" id="total_amt" value="<?php echo $total_amt_due; ?>"/>
        </div>
        <br clear="all"/></li>
    <?php
} else {
    ?>
    <li class="payment-border radius0">
        <div class="pull-right text-navy">
            Balance = <strong><?php echo number_format($total_amt_bal = $amt, 2); ?></strong>
            <input type="hidden" id="total_amt" value="<?php echo $total_amt_bal; ?>"/>
        </div>
        <br clear="all"/>
    </li>
    <?php
}

if ($total_amt_bal > 0) {// if student has current semester extra balance
    if ($prevBalance >= 0) {
        $label = "Previous Balance";
        $net_amt_label = "Net Balance";
        $prev_amt_class = "text-success";
        $net_amt_label_class = "text-navy";
        // if student has previous semester balance
        $net_amt = ($total_amt_bal + $prevBalance);
    } else {
        $label = "Previous Due";
        $net_amt_label = ($total_amt_bal > $prevDue) ? "Net Due" : "Net Balance";
        $prev_amt_class = "text-danger";
        $net_amt_label_class = ($total_amt_bal > $prevDue) ? "text-danger" : "text-navy";
        // if student has previous semester due
        $net_amt = ($total_amt_bal > $prevDue) ? ($total_amt_bal - $prevDue) : ($prevDue - $total_amt_bal);
    }
} else {// if student has due to university
    if ($prevBalance >= 0) {
        $label = "Previous Balance";
        $net_amt_label = ($total_amt_due > $prevBalance) ? "Net Due" : "Net Balance";
        $prev_amt_class = "text-success";
        $net_amt_label_class = ($total_amt_due > $prevBalance) ? "text-danger" : "text-navy";
        // if student has previous semester balance
        $net_amt = ($total_amt_due > $prevBalance) ? ($total_amt_due - $prevBalance) : ($prevBalance - $total_amt_due);
    } else {
        $label = "Previous Due";
        $net_amt_label = "Net Due";
        $prev_amt_class = "text-danger";
        $net_amt_label_class = "text-danger";
        // if student has previous semester due
        $net_amt = ($total_amt_due + $prevDue);
    }
}
?>
<li class="radius0">
    <div class="pull-right <?php echo $prev_amt_class; ?>">
        <?php echo $label; ?> = <strong><?php echo number_format($prevBalance, 2); ?></strong>
    </div>
    <br clear="all"/>
</li>
<li class="empty_list">
    
</li>
<li class="payment-border radius0">
    <div class="pull-right <?php echo $net_amt_label_class; ?>">
        <?php echo $net_amt_label; ?> = <strong><?php echo number_format($net_amt, 2); ?></strong>
    </div>
    <br clear="all"/>
</li>