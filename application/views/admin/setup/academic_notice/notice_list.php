<?php if ($previlages->READ == 1) { ?>
    <table class="table table-striped table-bordered table-hover gridTable">
        <thead>
        <tr>
            <th>SN</th>
            <th>Notice For</th>
            <th>Notice title</th>
            <th>Description</th>
            <th>Attachment</th>
            <th>From Date</th>
            <th>To Date</th>
            <th>Faculty</th>
            <th>Department</th>
            <th>Program</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0;
        foreach ($notice as $row):$i++
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php if ($row->NOTICE_FOR == 'S') {
                        echo 'Student';
                    } else if ($row->NOTICE_FOR == 'T') {
                        echo "Teacher";
                    } else {
                        echo "All";
                    } ?></td>
                <td><?php echo $row->NOTICE_TITLE ?></td>
                <td><?php echo $row->NOTICE_DESCRIPTION ?></td>
                <td><a href="<?php echo base_url(); ?>upload/notice/<?php echo $row->NOTICE_FILE ?>" alt="Not available"
                       target="_blank"><?php echo $row->NOTICE_FILE ?></a></td>
                <td><?php echo date('d-M-Y', strtotime($row->START_DATE)) ?></td>
                <td><?php echo date('d-M-Y', strtotime($row->END_DATE)) ?></td>

                <td><?php echo $row->FACULTY_NAME ?></td>
                <td><?php echo $row->DEPT_NAME ?></td>
                <td><?php echo $row->PROGRAM_NAME ?></td>
                <td><?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Active</span>' : '<span class="label label-danger" title="Click For Active">Inactive</span>' ?></td>
                <td>

                    <?php if ($previlages->UPDATE == 1) { ?>
                        <a class="label label-default "
                           href="<?php echo base_url(); ?>setup/editNotice/<?php echo $row->NOTICE_ID; ?>"><i
                                class="fa fa-pencil"></i></a>
                    <?php
                    }
                    if ($previlages->DELETE == 1) {
                        ?>
                        <a class="label label-danger deleteItem" id="<?php echo $row->NOTICE_ID; ?>"
                           title="Click For Delete" data-type="delete" data-field="NOTICE_ID" data-tbl="notice"><i
                                class="fa fa-times"></i></a>
                    <?php
                    }
                    ?>



                    <?php ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
        <tr>
            <th>SN</th>
            <th>Notice For</th>
            <th>Notice title</th>
            <th>Description</th>
            <th>From Date</th>
            <th>To Date</th>
            <th>File</th>
            <th>Faculty</th>
            <th>Department</th>
            <th>Program</th>
            <th>Action</th>
        </tr>
        </tfoot>
    </table>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>
 