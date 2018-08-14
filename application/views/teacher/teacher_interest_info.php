<h4 class="green">Interest Information</h4>
<div class="ibox-content">
    <?php if (!empty($interest)) { ?>
        <div class="table-responsive contentArea">
            <table class="table table-striped table-bordered table-hover gridTable">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Interest Type</th>
                    <th>Interest Subject</th>


                </tr>
                </thead>
                <tbody>
                <?php $sl = 0;
                foreach ($interest as $row): $sl++; ?>
                    <tr>
                        <td><?php echo $sl; ?></td>
                        <td><?php echo $row->itn; ?></td>
                        <td><?php echo $row->INTERESR_SUBJECT; ?></td>

                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    <?php } else {
        echo "No data found";
    } ?>

</div>