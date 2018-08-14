<h4 class="green">Experience Information</h4>
<div class="ibox-content">
    <?php if (!empty($teacher_exp)) { ?>
        <div class="table-responsive contentArea">
            <table class="table table-striped table-bordered table-hover gridTable">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Exp Type</th>
                    <th>Designation</th>
                    <th>Institute</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <?php $sl = 0;
                foreach ($teacher_exp as $row): $sl++; ?>
                    <tr>
                        <td><?php echo $sl; ?></td>
                        <td><?php echo $row->exp_type_name; ?></td>
                        <td><?php echo $row->DESIGNATION; ?></td>
                        <td><?php echo $row->INSTITUTE; ?></td>
                        <td><?php echo date('d-M-Y', strtotime($row->START_DT)); ?></td>
                        <td><?php echo date('d-M-Y', strtotime($row->END_DT)); ?></td>
                        <td><?php echo $row->DESIGNATION; ?></td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    <?php } else {
        echo "No data found";
    } ?>
</div>