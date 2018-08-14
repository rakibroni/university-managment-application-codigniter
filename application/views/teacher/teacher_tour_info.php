<h4 class="green">Tour and Travels Information</h4>
<div class="ibox-content">
    <?php if (!empty($tour)) { ?>
        <div class="table-responsive contentArea">
            <table class="table table-striped table-bordered table-hover gridTable">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Traveling Area</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Purpose</th>
                </tr>
                </thead>
                <tbody>
                <?php $sl = 0;
                foreach ($tour as $row): $sl++; ?>
                    <tr>
                        <td><?php echo $sl; ?></td>
                        <td><?php echo $row->WHERE; ?></td>
                        <td><?php echo date('d-M-Y', strtotime($row->FROM_DT)); ?></td>
                        <td><?php echo date('d-M-Y', strtotime($row->TO_DT)); ?></td>
                        <td><?php echo $row->PURPOSE; ?></td>


                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    <?php } else {
        echo "No data found";
    } ?>
</div>