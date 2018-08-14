<div class="block-flat">
    <table>
        <tbody class="table table-responsive">
        <tr>
            <td><h5><b>Charge Name </b></h5></td>
            <td style="padding-left: 10px;">:</td>
            <td style="padding-left: 20px;"><?php echo $expenses->CHARGE_NAME; ?></td>
        </tr>
        <tr>
            <td><h5><b>Amount(BDT) </b></h5></td>
            <td style="padding-left: 10px;">:</td>
            <td style="padding-left: 20px;"><?php echo number_format($expenses->AMOUNT, 2); ?></td>
        </tr>
        <tr>
            <td><h5><b>Start Date</b></h5></td>
            <td style="padding-left: 10px;">:</td>
            <td style="padding-left: 20px;"><?php echo $expenses->START_DATE; ?></td>
        </tr>
        <tr>
            <td><h5><b>End Date </b></h5></td>
            <td style="padding-left: 10px;">:</td>
            <td style="padding-left: 20px;"><?php echo $expenses->END_DATE; ?></td>
        </tr>
        <tr>
            <td><h5><b>Faculty </b></h5></td>
            <td style="padding-left: 10px;">:</td>
            <td style="padding-left: 20px;"><?php echo $expenses->FACULTY; ?></td>
        </tr>
        <tr>
            <td><h5><b>Department </b></h5></td>
            <td style="padding-left: 10px;">:</td>
            <td style="padding-left: 20px;"><?php echo $expenses->DEPARTMENT; ?></td>
        </tr>
        <tr>
            <td><h5><b>Program </b></h5></td>
            <td style="padding-left: 10px;">:</td>
            <td style="padding-left: 20px;"><?php echo $expenses->PROGRAM; ?></td>
        </tr>
        <tr>
            <td><h5><b>Semester </b></h5></td>
            <td style="padding-left: 10px;">:</td>
            <td style="padding-left: 20px;"><?php echo $expenses->SEMESTER; ?></td>
        </tr>
        </tbody>
    </table>
</div>

