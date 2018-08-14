<h4 class="green">Awards Information</h4>
<div class="ibox-content">
    <?php if (!empty($awards)) { ?>
        <div class="table-responsive contentArea">
            <table class="table table-striped table-bordered table-hover gridTable">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Awards Name</th>
                    <th>Receive From</th>
                    <th>Date</th>
                    <th>Description</th>

                </tr>
                </thead>
                <tbody>
                <?php $sl = 0;
                foreach ($awards as $row): $sl++; ?>
                    <tr>
                        <td><?php echo $sl; ?></td>
                        <td><?php echo $row->AW_REASON; ?></td>
                        <td><?php echo $row->AW_FROM; ?></td>
                        <td><?php echo date('d-M-Y', strtotime($row->AW_DATE)); ?></td>
                        <td><?php echo $row->DESCRIPTION; ?></td>

                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    <?php } else {
        echo "No data found";
    } ?>

</div>