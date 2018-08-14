<?php
$total = 0;
if (!empty($expenses)):
    $i = 0;
    foreach ($expenses as $expense):
        ?>

        <?php
        $total += $expense->PARTICULAR_AMOUNT;
        $i++;
    endforeach;
endif;
?>

    <li>
        <div class="pull-right text-danger">Total = <strong><?php echo number_format($total, 2); ?></strong></div>
        <br clear="all"/></li>
<?php
$prevDue = 0;
$prevBalance = 0;
$prev_exp_amt = (!empty($prev_expenses) ? $prev_expenses->PARTICULAR_AMOUNT : "00.00");
$prev_semester_amt = (!empty($prevSemesterAmt) ? $prevSemesterAmt->DEBIT : "00.00");
if ($prev_exp_amt > $prev_semester_amt) {
    $prevDue = ($prev_exp_amt - $prev_semester_amt);
} else {
    $prevBalance = ($prev_semester_amt - $prev_exp_amt);
}
?>

    <li>
        <div class="pull-right text-navy">Amount Paid =
            <strong><?php echo number_format($totalPayment = (!empty($dueAmt)) ? $dueAmt->DEBIT : "0.00", 2); ?></strong>
        </div>
        <br clear="all"/></li>
    <li></li>
<?php
$std_expense = $total;
$amt = ($totalPayment > $std_expense) ? ($totalPayment - $std_expense) : ($std_expense - $totalPayment);
if ($totalPayment < $std_expense) {
    ?>
    <li>
        <div class="pull-right text-danger">
            Due = <strong><?php echo number_format($total_amt = ($std_expense - $totalPayment), 2); ?></strong>
            <input type="hidden" id="total_amt" value="<?php echo $total_amt; ?>"/>
        </div>
        <br clear="all"/></li>
<?php
} else {
    ?>
    <li>
        <div class="pull-right text-navy">
            Due = <strong><?php echo number_format($total_amt = ($totalPayment - $std_expense), 2); ?></strong>
            <input type="hidden" id="total_amt" value="<?php echo $total_amt; ?>"/>
        </div>
        <br clear="all"/></li>
<?php
}
?>
    <li style=" border-radius: 0;">
        <div class="pull-right text-danger">Previous Balance =
            <strong><?php echo number_format($prevBalance, 2); ?></strong></div>
        <br clear="all"/></li>
    <li style=" border-radius: 0;">
        <div class="pull-right text-danger">Previous Due = <strong><?php echo number_format($prevDue, 2); ?></strong>
        </div>
        <br clear="all"/></li>
    <li></li>
<?php
if (($total_amt + $prevDue) > $prevBalance) {
    ?>
    <li style="border-top:1px solid #000; border-radius: 0;">
        <div class="pull-right text-danger">Total Due =
            <strong><?php echo number_format((($total_amt + $prevDue) - $prevBalance), 2); ?></strong></div>
        <br clear="all"/></li>
<?php
} else {
    ?>
    <li style="border-top:1px solid #000; border-radius: 0;">
        <div class="pull-right text-navy">Net Due =
            <strong><?php echo number_format(($prevBalance - ($total_amt + $prevDue)), 2); ?></strong></div>
        <br clear="all"/></li>
<?php
}
?>