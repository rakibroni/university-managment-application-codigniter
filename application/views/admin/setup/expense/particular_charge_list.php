<?php if ($chargeList): ?>
    <table class="table table-bordered ">
        <thead>
        <tr>
            <th><input type="checkbox" id="checkAll"></th>
            <th>SN</th>
            <th>Charge Name</th>
            <th>Amount(BDT)</th>
        </tr>
        </thead>
        <tbody>
        <?php $sn = 1; ?>
        <?php foreach ($chargeList as $row) { ?>
            <tr>
                <td><input type="checkbox" class="check" id="course_id" name="charge_id[]"
                           value="<?php echo $row->CHARGE_ID; ?>"></td>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $row->CHARGE_NAME; ?></td>
                <td><?php echo number_format($row->AMOUNT, 2); ?><input type="hidden" name="charge_amount[]"
                                                                        value="<?php echo $row->AMOUNT; ?>"></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="text-danger">Academic Charge Rate Not Assign</p>
<?php endif; ?>
<hr>
<script type="text/javascript">
    $("#checkAll").click(function () {
        $(".check").prop('checked', $(this).prop('checked'));
    });
</script>