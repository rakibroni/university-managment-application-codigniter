<?php
if (isset($_POST['param'])) {
    $PROGRAM_ID = $_POST['param'];
}
?>
<div class="wrapper wrapper-content">
    <div class="row">

        <?php $course_offer = $this->utilities->getOfferedCoursesWithProgram($PROGRAM_ID); ?>
        <?php if (!(empty($course_offer))): ?>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Course Code</th>
                    <th>Course Title</th>
                    <th>CREDIT</th>
                </tr>
                </thead>
                <tbody>
                <?php $credit = 0; ?>
                <?php foreach ($course_offer as $row) { ?>
                    <tr>
                        <td><span class="label label-primary"><?php echo $row->COURSE_CODE; ?></span></td>
                        <td><?php echo $row->COURSE_TITLE; ?></td>
                        <td><?php echo $row->CREDIT; ?></td>
                        <?php
                        $credit += $row->CREDIT;
                        ?>
                    </tr>
                <?php } ?>
                <tr class="alert alert-info">
                    <td></td>
                    <td>Total Credit</td>
                    <td><span class="badge badge-primary"><?php echo $credit; ?></span></td>


                </tr>
                </tbody>
            </table>
        <?php else: ?>
            <span class='text-danger'>Course Offered Not assign !! </span>
        <?php endif; ?>

    </div>
</div>