<table class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th class="col-md-1">SL</th>
        <th class="col-md-2">Registration No</th>
        <th class="col-md-2">Name</th>
        <th class="text-center col-md-2">Mark</th>
        <th class="text-center col-md-2">Grade point</th>
        <th class="text-center col-md-2">Grade Letter</th>
        <th class="text-center col-md-1">Course For</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($existing_student_list)): $sn = 1; ?>
        <?php foreach ($existing_student_list as $row) { ?>
            <tr class="gradeX" id=" ">

                <td><?php echo $sn++; ?></td>
                <td><?php echo $row->REGISTRATION_NO ?></td>
                <td><?php echo $row->FULL_NAME_EN ?></td>

                <?php
                $stu_mark_info = $this->db->get_where('exam_tabulation_sheet a',
                    array('a.STUDENT_ID' => $row->STUDENT_ID, 'a.COURSE_ID' => $COURSE_ID, 'a.SESSION_ID' => $SESSION_ID))->row();

                ?>

                <input type="hidden" name="STU_ID[]" value="<?php echo $row->STUDENT_ID; ?>">
                <input type="hidden" name="EX_TABULATION_SHEET_ID[]"
                       value="<?php if (!empty($stu_mark_info->EX_TABULATION_SHEET_ID)) {
                           echo $stu_mark_info->EX_TABULATION_SHEET_ID;
                       } ?>">

                <td class="text-center">
                    <input type="number" name="MARK[]" id="" value="<?php if (!empty($stu_mark_info->MARKS)) {
                        echo $stu_mark_info->MARKS;
                    } ?>" data-stu-id="<?php echo $row->STUDENT_ID; ?>" class="form-control text-center mark">
                </td>
                <td class="text-center"
                    id="grade_point_<?php echo $row->STUDENT_ID; ?>"><?php if (!empty($stu_mark_info)) {
                        echo $stu_mark_info->GRADE_POINT;
                    } ?></td>
                <td class="text-center"
                    id="grade_letter_<?php echo $row->STUDENT_ID; ?>"><?php if (!empty($stu_mark_info)) {
                        echo $stu_mark_info->GRADE_LETTER;
                    } ?></td>
                <td>
                    <select class="form-control" name="COURSE_FOR[]" id="COURSE_FOR">
                        <option value="F" <?php echo ((!empty($stu_mark_info)) && $stu_mark_info->COURSE_FOR == 'F') ? "Selected" : ''; ?>>
                            Final
                        </option>
                        <option value="I" <?php echo ((!empty($stu_mark_info)) && $stu_mark_info->COURSE_FOR == 'I') ? "Selected" : ''; ?>>
                            Improvement
                        </option>
                        <option value="R" <?php echo ((!empty($stu_mark_info)) && $stu_mark_info->COURSE_FOR == 'R') ? "Selected" : ''; ?>>
                            Retake
                        </option>
                    </select>
                </td>
            </tr>
        <?php } ?>
    <?php endif; ?>
    </tbody>
</table>

<script>
    $(document).ready(function () {

        $('.mark').on('keyup', function () {

            var STU_ID = $(this).attr("data-stu-id");

            if ($(this).val() == '') {
                var mark = 0;

            } else {

                var mark = $(this).val();
            }

            $.ajax({
                type: "post",
                dataType: 'json',
                url: "<?php echo site_url(); ?>/" + 'exam/calculateGradeLetter',
                data: {mark: mark},
                beforeSend: function () {

                    $("#grade_point_" + STU_ID).html("<img src='<?php echo base_url(); ?>assets/img/loader-small.gif' />");
                    $("#grade_letter_" + STU_ID).html("<img src='<?php echo base_url(); ?>assets/img/loader-small.gif' />");
                },
                success: function (data) {

                    $('#grade_point_' + STU_ID).html(data.GRADE_POINT);
                    $('#grade_letter_' + STU_ID).html(data.GR_LETTER);
                }
            });

        });

    });
</script>