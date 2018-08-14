<div class="table-responsive">
    <?php if (!empty($course_offer)): ?>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>Course Code</th>
                <th>Course Title</th>
                <th>Total Course</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($course_offer as $row) { ?>
                <tr class="gradeX" id="row_<?php echo $row->COURSE_ID; ?>">
                    <td><?php echo $row->COURSE_CODE; ?></td>
                    <td><?php echo $row->COURSE_TITLE; ?></td>
                    <td><?php echo $row->CREDIT; ?></td>

                </tr>
            <?php } ?>

            </tbody>
        </table>
    <?php else: ?>
        <span class="text-danger"> Don't any course offer found !!</span>
    <?php endif; ?>
</div>