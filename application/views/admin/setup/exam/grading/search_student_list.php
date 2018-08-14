<input type="hidden" name="" value="<?php echo $mark_type_id . ' hello'; ?>">
<?php if ($student_list) { ?>

    <table class="table table-responsive table-bordered table-hover" style="border-collapse:collapse;">

        <tr class="info">
            <th class="col-md-2">Reg. No.</th>
            <th class="col-md-3">Name</th>
            <th class="col-md-2 text-center">Allocated Mark</th>
            <th class="col-md-2 text-center">Obtained Mark</th>
            <th class="col-md-2 text-center">Grace Mark</th>
            <th class="col-md-2 text-center">Remarks</th>
        </tr>

        <tbody>
        <?php foreach ($student_list as $stu_list): ?>
            <input type="hidden" name="STUDENT_ID[]" value="<?php echo $stu_list->STUDENT_ID; ?>">
            <input type="hidden" name="COURSE_FOR[]" value="<?php echo $stu_list->COURSE_FOR; ?>">
            <tr>
                <td data-toggle="collapse"
                    data-target="#student_<?php echo $stu_list->STUDENT_ID ?>"><?php echo $stu_list->REGISTRATION_NO ?></td>
                <td data-toggle="collapse"
                    data-target="#student_<?php echo $stu_list->STUDENT_ID ?>"><?php echo $stu_list->FULL_NAME_EN ?></td>


                <?php

                $stu_mark_info = $this->db->get_where('exam_student_marks a',
                    array('a.STUDENT_ID' => $stu_list->STUDENT_ID, 'a.COURSE_ID' => $stu_list->COURSE_ID,
                        'a.SESSION_ID' => $stu_list->SESSION_ID, 'a.DEPT_ID' => $stu_list->DEPT_ID, 'a.BATCH_ID' => $stu_list->BATCH_ID, 'a.MARKS_TYPE_ID' => $mark_type_id))->row();

                //                echo "<pre>"; print_r($stu_mark_info); exit;

                ?>

                <td data-toggle="collapse" data-target="#student_<?php echo $stu_list->STUDENT_ID ?>">
                    <input <?php if (!empty($stu_mark_info->REVIEW_STATUS) && $stu_mark_info->REVIEW_STATUS != 0) : ?> readonly <?php endif; ?>
                            class="form-control text-center allocatedMark" name="ALLOCATED_MARKS[]"
                            value="<?php if (!empty($stu_mark_info->ALLOCATION_MARKS)) {
                                echo $stu_mark_info->ALLOCATION_MARKS;
                            } ?>">
                </td>


                <td data-toggle="collapse" data-target="#student_<?php echo $stu_list->STUDENT_ID ?>">

                    <input type="hidden" name="PERCENTAGE_VAL" value="<?php echo $percentage_val; ?>">
                    <input type="hidden" name="MARK_ID[]" value="<?php if (!empty($stu_mark_info->EX_MARKS_ID)) {
                        echo $stu_mark_info->EX_MARKS_ID;
                    } ?>">
                    <input <?php if (!empty($stu_mark_info->REVIEW_STATUS) && $stu_mark_info->REVIEW_STATUS != 0) : ?> readonly <?php endif; ?>
                            class="form-control text-center" name="mark[]"
                            value="<?php if (!empty($stu_mark_info->OBTAIN_MARKS)) {
                                echo $stu_mark_info->OBTAIN_MARKS;
                            } ?>"></td>

                <td data-toggle="collapse" data-target="#student_<?php echo $stu_list->STUDENT_ID ?>">
                    <input <?php if (!empty($stu_mark_info->REVIEW_STATUS) && $stu_mark_info->REVIEW_STATUS != 0) : ?> readonly <?php endif; ?>
                            class="form-control text-center" name="GRACE_MARKS[]"
                            value="<?php if (!empty($stu_mark_info->GRACE_MARKS)) {
                                echo $stu_mark_info->GRACE_MARKS;
                            } ?>">
                </td>


                <td>
                    <input <?php if (!empty($stu_mark_info->REVIEW_STATUS) && $stu_mark_info->REVIEW_STATUS != 0) : ?> readonly <?php endif; ?>
                            name="REMARKS[]" class="form-control col-md-6"
                            value="<?php if (!empty($stu_mark_info->REMARKS)) {
                                echo $stu_mark_info->REMARKS;
                            } ?>"></td>

            </tr>
            <?php

            ?>

        <?php endforeach; ?>
        </tbody>
    </table>


    <input type="button" class="btn btn-warning btn-sm form_submit pull-right" id=""
           data-param="" value="Submit"
           data-action="exam/studentMarksInsert"
           data-su-action="exam/loadStudentListWithMarks" data-view-div="studentList">
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


    //    $(document).on('keyup','.allocatedMark', function(){
    //
    //        var allocate_mark = $('.allocatedMark').val();
    //
    //        $('.allocatedMark').val(allocate_mark);
    //
    //    });

</script>