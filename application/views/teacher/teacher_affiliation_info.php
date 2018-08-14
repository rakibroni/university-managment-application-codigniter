<h4 class="green">Affiliation Information</h4>
<div class="ibox-content">
    <?php if (!empty($affilication)) { ?>
        <div class="table-responsive contentArea">
            <table class="table table-striped table-bordered table-hover gridTable">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Organization Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>

                </tr>
                </thead>
                <tbody>
                <?php $sl = 0;
                foreach ($affilication as $row): $sl++; ?>
                    <tr>
                        <td><?php echo $sl; ?></td>
                        <td><?php echo $row->AF_NAME; ?></td>
                        <td><?php echo date('d-M-Y', strtotime($row->AF_NAME)); ?></td>
                        <td><?php echo date('d-M-Y', strtotime($row->END_DT)); ?></td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    <?php } else {
        echo "No data found";
    } ?>
</div>