<?php if (!empty($expensesList)): ?>
    <table class="table table-striped table-bordered table-hover gridTable" style="width:60%">
        <thead>
        <tr>
            <th>SN</th>
            <th>Particular Name</th>
            <th>Amount(BDT)</th>
            <th>Start Date</th>
            <th>End Date</th>
        </tr>
        </thead>
        <tbody>
        <?php $sn = 1; ?>
        <?php foreach ($expensesList as $row) { ?>
            <tr>
                <td><span><?php echo $sn++; ?></span></td>
                <td> <?php echo $row->CHARGE_NAME; ?></td>
                <td> <?php echo number_format($row->AMOUNT, 2); ?></td>
                <td> <?php echo $row->START_DATE; ?></td>
                <td> <?php echo $row->END_DATE; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="text-danger">Particulars not set yet</p>
<?php endif; ?>