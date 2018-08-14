<h4 class="green">Payments</h4>
<div class="ibox-content">
    <div class="table-responsive contentArea">

        <table width="50%" class="table table-striped table-bordered table-hover gridTable">
            <tbody>



            <tr>
                <th>Recipient</th>
                <?php $rec= ($payment->DEPOSITE_RECIEPT !='')? 'upload/bank_deposit_no/'.$payment->DEPOSITE_RECIEPT : '' ;?>
                <td><img src="<?php echo base_url($rec) ?>" width="50px"/></td>
            </tr>
            <tr>
                <th>Deposit No.</th>
                <td><?php echo ($payment->DEPOSITE_ID !='')?$payment->DEPOSITE_ID : ''  ?></td>
            </tr>

            </tbody>
        </table>
    </div>
</div>