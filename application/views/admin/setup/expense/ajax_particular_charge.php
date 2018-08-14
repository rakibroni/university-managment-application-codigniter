<table class="table table-striped table-bordered table-hover gridTable" style="width:30%">
    <thead>
    <tr>
        <th>SN</th>
        <th>Particular Name</th>
        <th>Amount(BDT)</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $sn = 1;
    if (!empty($chargeList)):
        foreach ($chargeList as $row) { ?>
            <tr>
                <td><span><?php echo $sn++; ?></span></td>
                <td> <?php echo $row->CHARGE_NAME; ?></td>
                <td> <?php echo number_format($row->PARTICULAR_AMOUNT, 2); ?></td>
            </tr>
        <?php
        }
    else: ?>
        <tr>
            <td colspan="3" class="text-danger">Particulars not set yet</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
