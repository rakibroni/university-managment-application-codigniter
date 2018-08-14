
<html>

    <?php if(!empty($semester_wise_course)) : ?>

    <table class="table table-striped table-bordered table-hover">
         
            <tr class="info">
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Total Marks</th>
                <th>Letter Grade</th>
                <th>Grade Point</th>
                <th>Credit</th>
            </tr>
        
        <tbody>
            <?php $total_credit_per_semester=0; ?>

            <?php foreach ($semester_wise_course as $rows) : ?>

                <tr>
                    <td><?php echo $rows->COURSE_CODE; ?></td>
                    <td><?php echo $rows->COURSE_TITLE; ?></td>
                    <td style='text-align: center'><?php echo $rows->MARKS; ?></td>
                    <td style='text-align: center'><?php echo $rows->GRADE_LETTER; ?></td>
                    <td style='text-align: center'><?php echo $rows->GRADE_POINT; ?></td>
                    <td style='text-align: center'><?php echo $rows->CREDIT; $total_credit_per_semester += $rows->CREDIT; ?></td>
                </tr>

            <?php endforeach; ?>
        <tr><td colspan='5' style='text-align: right'><b>Total  :</b></td><td style='text-align: center'><b><?php echo $total_credit_per_semester ?></b></td></tr>
        </tbody>
    </table>

    <?php else: ?>

        <span><?php echo 'No Data Found'; ?></span>

    <?php endif; ?>
</html>