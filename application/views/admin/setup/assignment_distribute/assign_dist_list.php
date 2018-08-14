<?php if ($previlages->READ == 1) { ?>
    <table class="table table-striped table-bordered table-hover gridTable">
        <thead>
        <tr>
            <th>SL</th>
            <th>Assignment</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Course</th>
            <th>Semester</th>
            <th></th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($assign_dist)): $sn = 1; ?>
            <?php foreach ($assign_dist as $row) { ?>
                <tr class="gradeX" id="row_<?php echo $row->AS_DIST_ID; ?>">
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                        <span><?php echo $sn++; ?></span><span class="hidden"
                                                               id="loader_<?php echo $row->AS_DIST_ID; ?>"></span></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->ASSIGN_TITLE; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo date('d-M-Y', strtotime($row->START_DATE)); ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo date('d-M-Y', strtotime($row->END_DATE)); ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->COURSE_TITLE . " (" . $row->COURSE_CODE . ")"; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->SEMESTER_NAME; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo  $row->PROGRAM_NAME."<br><i>".$row->SESSION_NAME."</i>"; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                        <?php if ($previlages->UPDATE == 1) { ?>
                           <!-- <a class="label label-default openModal" id="<?php /*echo $row->AS_DIST_ID; */?>"
                               title="Update Assignment Distribution" data-action="setup/assignDistFormUpdate"
                               data-type="edit"><i class="fa fa-pencil"></i></a>-->
                        <?php
                        }
                        if ($previlages->DELETE == 1) {
                            ?>
                            <a class="label label-danger deleteItem" id="<?php echo $row->AS_DIST_ID; ?>"
                               title="Click For Delete" data-type="delete" data-field="AS_DIST_ID"
                               data-tbl="aca_assignment_distribution"><i class="fa fa-times"></i></a>
                        <?php
                        }

                        if ($previlages->STATUS == 1) {
                            ?>
                            <a class="itemStatus" id="<?php echo $row->AS_DIST_ID; ?>"
                               data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="AS_DIST_ID"
                               data-field="ACTIVE_STATUS" data-tbl="aca_assignment_distribution"
                               data-su-url="setup/assignDistById">
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
        <tfoot>
        <tr>
            <th>SL</th>
            <th>Assignment</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Course</th>
            <th>Semester</th>
            <th></th>
            <th>Actions</th>
        </tr>
        </tfoot>
    </table>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>