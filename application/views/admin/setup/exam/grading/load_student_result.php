<?php if ($student_marks) { ?>

    <table class="table table-responsive table-striped table-hover" style="border-collapse:collapse;">

        <tr class="info">
            <th class="col-md-2">Reg. No.</th>
            <th class="col-md-3">Name</th>
            <th class="col-md-3">Allocated Mark</th>
            <th class="col-md-3">Obtained Mark</th>
            <th class="col-md-3">Grace Mark</th>
            <th class="text-center col-md-2">Mark</th>
            <th>Remark</th>
        </tr>

        <tbody>
        <?php foreach ($student_marks as $stu_list): ?>

            <input type="hidden" name="STUDENT_ID[]" value="<?php echo $stu_list->STUDENT_ID;?>"

            <tr>
                <td data-toggle="collapse"
                    data-target="#student_<?php echo $stu_list->STUDENT_ID ?>"><?php echo $stu_list->REGISTRATION_NO ?></td>
                <td data-toggle="collapse"
                    data-target="#student_<?php echo $stu_list->STUDENT_ID ?>"><?php echo $stu_list->FULL_NAME_EN ?></td>
                <td class="text-center" data-toggle="collapse"
                    data-target="#student_<?php echo $stu_list->STUDENT_ID ?>"><?php echo $stu_list->ALLOCATION_MARKS ?></td>

                <td class="text-center" data-toggle="collapse"
                    data-target="#student_<?php echo $stu_list->STUDENT_ID ?>"><?php echo $stu_list->OBTAIN_MARKS ?></td>

                <td class="text-center" data-toggle="collapse"
                    data-target="#student_<?php echo $stu_list->STUDENT_ID ?>"><?php echo $stu_list->GRACE_MARKS ?></td>

                <td class="text-center" data-toggle="collapse" data-target="#student_<?php echo $stu_list->STUDENT_ID ?>"><?php echo $stu_list->MARKS ?></td>
                <td data-toggle="collapse" data-target="#student_<?php echo $stu_list->STUDENT_ID ?>"><?php echo $stu_list->REMARKS ?></td>
            </tr>
            <?php

            ?>

        <?php endforeach; ?>
        </tbody>
    </table>

    <div class="clearfix"></div>
<?php } else {
    echo '<p class="text-warning">No Student Found</p>';
} ?>

<script type="text/javascript">
    $('.collapse').on('show.bs.collapse', function () {
        // $('.collapse.in').collapse('hide');
    });
    $("#checkAllBox").click(function () {
        $(".check").prop('checked', $(this).prop('checked'));
    });

    $(document).ready(function () {
        $(".gridTable").dataTable();
    });

</script>