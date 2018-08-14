<h4 class="green">Medical Information</h4>
<div class="ibox-content">
    <?php if (!empty($medical_info)) { ?>
        <div class="table-responsive contentArea">
            <table class="table table-striped table-bordered table-hover gridTable">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Disease Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Treating Doctor</th>

                </tr>
                </thead>
                <tbody>
                <?php $sl = 0;
                foreach ($medical_info as $row): $sl++; ?>
                    <tr>
                        <td><?php echo $sl; ?></td>
                        <td><?php echo $row->DISEASE_NAME; ?></td>

                        <td><?php echo date('d-M-Y', strtotime($row->START_DT)); ?></td>
                        <td><?php echo date('d-M-Y', strtotime($row->END_DT)); ?></td>
                        <td><?php echo $row->DOCTOR_NAME; ?></td>

                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    <?php } else {
        echo "No data found";
    } ?>

</div>