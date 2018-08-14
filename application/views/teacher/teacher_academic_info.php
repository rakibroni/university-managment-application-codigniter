<h4 class="green">Academic Information</h4>
<div class="ibox-content">
    <?php if (!empty($academic)) { ?>
        <div class="table-responsive contentArea">
            <table class="table table-striped table-bordered table-hover gridTable">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Exam</th>
                    <th>Year</th>
                    <th>Board</th>
                    <th>Group</th>
                    <th>Institute</th>
                    <th>Certificate</th>
                </tr>
                </thead>
                <tbody>
                <?php $sl = 0;
                foreach ($academic as $row): $sl++; ?>
                    <tr>
                        <td><?php echo $sl; ?></td>
                        <td><?php echo $row->ed; ?></td>
                        <td><?php echo $row->PASSING_YEAR; ?></td>
                        <td><?php echo $row->br; ?></td>
                        <td><?php echo $row->mg; ?></td>
                        <td><?php echo $row->INSTITUTION; ?></td>
                        <td><?php echo $row->ACHIEVEMENT; ?></td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    <?php } else {
        echo "No data found";
    } ?>
</div>