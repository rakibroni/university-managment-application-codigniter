<?php if ($course) : ?>
    <div class="ibox-title">
        <strong>Course List </strong>
        <span class="loadingImg"></span>
    </div>
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>SN</th>
            <th>Title</th>
            <th></th>
            <th>Category</th>
            <th>Credit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php $credit = 0;
        $i = 1; ?>
        <?php foreach ($course as $row) { ?>
            <tr>
                <td><?php echo $i++ ?></td>

                <td><a data-action="course/courseDetails" course="<?php echo $row->COURSE_ID; ?>"
                       class="openCourseDetailsModal"
                       title="Course Details"><?php echo "<b>" . $row->COURSE_CODE . "</b>&nbsp;: " . $row->COURSE_TITLE . "<br>"; ?></a>
                </td>
                <td><span><i class="fa fa-square" style="color: <?php echo $row->CAT_COLOR; ?>"></i></span></td>
                <td><?php echo $row->CAT_NAME; ?></td>
                <td><span class="creditPre"><?php echo $row->CREDIT; ?></span></td>
                <td><a class="label label-danger deletePrerequisiteCourse" id="<?php echo $row->CRS_PREREQUISITE_ID; ?>"
                       data-type="delete" data-field="CRS_PREREQUISITE_ID" data-tbl="aca_crs_prerequisite"><i
                            class="fa fa-times"></i></a></td>
                <?php
                $credit += $row->CREDIT;
                ?>

            </tr>
        <?php } ?>
        <tr class="alert alert-info">
            <td></td>
            <td colspan="3">Total Credit</td>
            <td><span class="badge badge-primary totalCreditPre"><?php echo $credit; ?></span> <span
                    id="newPreSum"></span></td>
            <td></td>

        </tr>
        </tbody>
    </table>
<?php else: ?>
    <button class="btn btn-outline btn-danger" type="button">No Prerequisite Course</button>
<?php endif; ?>