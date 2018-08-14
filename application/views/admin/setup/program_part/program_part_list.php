<table class="table table-striped table-bordered table-hover gridTable">
    <thead>
    <tr>
        <th>SN</th>
        <th>Program Part Name</th>
        <th>Program</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>

    <tbody>
    <!-- <?php var_dump($program_part); ?> -->
    <?php if (!empty($program_part)): ?>
        <?php $sn = 1; ?>
        <?php foreach ($program_part as $row) { ?>
            <tr class="gradeX">
                <td><?php echo $sn++; ?></td>
                <td><?php echo $row->PROGRAM_NAME; ?></td>
                <td><?php echo $row->PR_PART_NAME; ?></td>
                <td><?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>'; ?> </td>
                <td>
                    <a class="dialogLink" title="View Department Information" data-targer="#basicModal"
                       data-remote="<?php echo site_url("setup/view_department/$row->PR_PART_ID"); ?>"><span
                            class="label label-info"><i class="fa fa-eye"></i></span></a> <a class="label label-default"
                                                                                             href="<?php echo site_url("setup/edit_department/$row->PR_PART_ID"); ?>"><i
                            class="fa fa-pencil"></i></a>
                </td>
            </tr>
        <?php } ?>
    <?php endif; ?>

    </tbody>
    <tfoot>
    <tr>
        <th>SN</th>
        <th>Name</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </tfoot>
</table>