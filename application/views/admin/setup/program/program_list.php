<?php if ($previlages->READ == 1) { ?>
    <table class="table table-striped table-bordered table-hover gridTable">
        <thead>
        <tr>
            <th>SL</th>
            <th>Program Name</th>
            <th>Degree Name</th>
            <th>Department</th>
            <th>Faculty</th>
            <th>User Define SL No.</th>
            
            <th>Total Semester</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($program)): $sn = 1; ?>
            <?php foreach ($program as $row) { ?>
                <tr class="gradeX" id="row_<?php echo $row->PROGRAM_ID; ?>">
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                        <span><?php echo $sn++; ?></span><span class="hidden" id="loader_<?php echo $row->PROGRAM_ID; ?>"></span></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->PROGRAM_NAME; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->DEGREE_NAME; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->DEPT_NAME; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->FACULTY_NAME; ?></td>                    
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->UD_SLNO; ?></td>                    
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->TOTAL_SESSION; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                        <?php if ($previlages->UPDATE == 1) { ?>
                            <a class="label label-default openModal" id="<?php echo $row->PROGRAM_ID; ?>"
                               title="Update Program Information" data-action="setup/programFormUpdate"
                               data-type="edit"><i class="fa fa-pencil"></i></a>
                        <?php
                        }
                        if ($previlages->DELETE == 1) {
                            ?>
                            <a class="label label-danger deleteItem" id="<?php echo $row->PROGRAM_ID; ?>"
                               title="Click For Delete" data-type="delete" data-field="PROGRAM_ID" data-tbl="ins_program"><i
                                    class="fa fa-times"></i></a>
                        <?php
                        }

                        if ($previlages->STATUS == 1) {
                            ?>
                            <a class="itemStatus" id="<?php echo $row->PROGRAM_ID; ?>"
                               data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="PROGRAM_ID"
                               data-field="ACTIVE_STATUS" data-tbl="ins_program" data-su-url="setup/programById">
                                <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Active">Active</span>' ?>
                            </a>
                        <?php
                        }
                        ?>
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