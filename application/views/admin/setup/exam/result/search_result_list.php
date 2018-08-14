
<?php if($student_list){?>

    <span><a href="<?php  echo site_url(); ?>/exam/resultPrint/<?php  echo $session_id.'/'.$program_id.'/'.$batch_id.'/'.$section_id.'/'.$course_id; ?>" target="_blank" class="btn btn-danger btn-xs pull-right "><i class="fa fa-file-pdf-o"></i> Print</a></span>
    <table class="table table-responsive" style="border-collapse:collapse;">

        <tr class="info">
<!--            <th><input type="checkbox" id="checkAllBox" > All</th>-->
            <th>Reg. No.</th>
            <th>Name</th>

            <?php foreach($exam_type as $row) : ?>
                <th class="text-center"><?php echo $row->EX_TITLE; ?></th>
            <?php endforeach; ?>
            <th class="text-center">Total Marks</th>
            <th class="text-center">Final Grade</th>
        </tr>

        <tbody>
        <?php  foreach($student_list as $stu_list): ?>
            <tr>
<!--                <td><input type="checkbox" class="check" name="STUDENT_ID[]" value="--><?php //echo $stu_list->STUDENT_ID ?><!--"></td>-->
                <td data-toggle="collapse" data-target="#student_<?php echo $stu_list->STUDENT_ID ?>"><?php echo $stu_list->REGISTRATION_NO ?></td>
                <td data-toggle="collapse" data-target="#student_<?php echo $stu_list->STUDENT_ID ?>"><?php echo $stu_list->FULL_NAME_EN ?></td>

                <?php foreach($exam_type as $row) : ?>
                    <input type="hidden" name="exam_type_id[]" value="<?php echo $row->EXAM_ID; ?>">
                    <input type="hidden" name="STU_ID[]" value="<?php echo $stu_list->STUDENT_ID ?>">
<!--                    <td><div class="has-success"><input name="exam_mark[]" class="form-control text-center"></div></td>-->
                    <td class="text-center">86</td>
                <?php endforeach; ?>
                <td class="text-center">93</td>
                <td class="text-center">A</td>
            </tr>
            <?php

            ?>

        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="clearfix"></div>
<?php }else{ echo '<p class="text-warning">No Student Found</p>';} ?>

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