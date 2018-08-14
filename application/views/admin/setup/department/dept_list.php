<?php if ($previlages->READ == 1) { ?>
    <table class="table table-striped table-bordered table-hover gridTable">
        <thead>
        <tr>
            <th>SN</th>
            <th>Short Name</th>
            <th>Department</th>
            <th>User Define SL No</th>
            <th>Faculty</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($department)): ?>
            <?php $sn = 1; ?>
            <?php foreach ($department as $row) { ?>
                <tr class="gradeX" id="row_<?php echo $row->DEPT_ID; ?>">
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                        <span><?php echo $sn++; ?></span><span class="hidden"
                                                               id="loader_<?php echo $row->DEPT_ID; ?>"></span></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->DEPT_ABBR; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->DEPT_NAME; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->UD_SLNO; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->FACULTY_NAME; ?></td>
                    <td class="text-center" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                        <?php if ($previlages->UPDATE == 1) { ?>
                            <a class="label label-default openModal" id="<?php echo $row->DEPT_ID; ?>"
                               title="Update Department Information" data-action="setup/departmentFormUpdate"
                               data-type="edit"><i class="fa fa-pencil"></i></a>
                        <?php
                        }  ?>

                    </td>
                </tr>
            <?php } ?>
        <?php endif; ?>

        </tbody>
         
    </table>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>