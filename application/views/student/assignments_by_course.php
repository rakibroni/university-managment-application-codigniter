

<?php if (!empty($assignments_by_course)): ?>

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Assignment Title</th>
                <th>Assignment Description</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($assignments_by_course as $row) { ?>
                <tr>
                    <td><?php echo $row->ASSIGN_TITLE ?></td>
                    <td><?php echo $row->ASSIGN_DESC; ?></td>
                    <td><?php echo date('d-M-y',strtotime($row->START_DATE)); ?></td>
                    <td><?php echo date('d-M-y',strtotime($row->END_DATE)); ?></td>

                </tr>
            <?php } ?>
            </tbody>
        </table>

<?php else: ?>
    <div class='text-danger'>No Assignment Available.</div>
<?php endif; ?>

