<?php if (!empty($result)) { ?>
    <h3>Courses Offered View</h3>
    <table class="table table-striped table-bordered table-hover gridTable">
        <thead>
        <tr>
            <th>SN</th>
            <th>Faculty</th>
            <th>Department</th>
            <th>Program</th>
            <th>Courses</th>
            <th>Credit</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sn = 1;
        $i = 0;
        ?>
        <?php foreach ($result as $row) { ?>
            <tr class="gradeXX" id="row_<?php echo $row->OFFERED_COURSE_ID; ?>">
                <td><span><?php echo $sn++; ?></span><span class="hidden"
                                                           id="loader_<?php echo $row->OFFERED_COURSE_ID; ?>"></span>
                </td>
                <td><?php echo $row->FACULTY_NAME; ?></td>
                <td><?php echo $row->DEPT_NAME; ?></td>
                <td><?php echo $row->PROGRAM_NAME; ?></td>
                <td>
                    <a title="View Course List" class="badge badge-primary openOfferModal"
                       data-action="course/courseOfferDetails" data-program="<?php echo $row->PROGRAM_ID; ?>"
                       data-dept="<?php echo $row->DEPT_ID; ?>"
                       data-faculty="<?php echo $row->FACULTY_ID; ?>" data-offer-type="<?php echo $row->OFFER_TYPE; ?>"><?php echo $row->COUNTER; ?></a>
                </td>

                <td><span class="badge badge-primary"><?php echo $row->TOTAL_CREDIT; ?></span></td>
                <td>
                    <a data-action="course/courseOfferAdd" offerType="<?php echo $row->OFFER_TYPE; ?>"
                       data-faculty="<?php echo $row->FACULTY_ID; ?>" data-dept="<?php echo $row->DEPT_ID; ?>"
                       data-program="<?php echo $row->PROGRAM_ID; ?>" data-offer-type="<?php echo $row->OFFER_TYPE; ?>" title="Course Offer Create"
                       class="btn btn-primary btn-xs pull-right openOfferModal"> Add New </a>
                </td>
            </tr>
        <?php } ?>

        </tbody>
    </table>
<?php
} else
    echo "<span class='text-danger'>No Course Found.</span>";
?>
<script type="text/javascript">
    $(".gridTable").dataTable();
    $("#checkAllBox").click(function () {
        $(".check").prop('checked', $(this).prop('checked'));
    });
</script>