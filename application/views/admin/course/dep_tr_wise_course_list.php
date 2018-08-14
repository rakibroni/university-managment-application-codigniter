<div class="panel-group" id="accordion">
    <?php foreach ($teachers as $tr) { ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5 class="panel-title">
                <img style="width:20px;margin-right:10px"
                     src="<?php echo base_url() ?>upload/faculty_teacher/<?php echo $tr->TEACHER_PHOTO ?>">

                <a href="#teacher_<?php echo $tr->TEACHER_ID ?>" data-parent="#accordion"
                   data-teacher-id="<?php echo $tr->TEACHER_ID ?>" data-toggle="collapse"
                   class="teacher_id"><?php echo $tr->FULL_NAME_EN ?></a>

            </h5>
        </div>
        <div class="panel-collapse collapse" id="teacher_<?php echo $tr->TEACHER_ID ?>">
            <div class="panel-body">
                <ol>
                <span id="course_list_by_tr_id_<?php echo $tr->TEACHER_ID ?>">

                    </span>
                </ol>
            </div>
        </div>
    </div>
</div>
<?php } ?>


<script type="text/javascript">
    $(document).ready(function () {
        //$(document).on('mouseover','.teacher_id',function(){
        $('.teacher_id').on('click', function () {
            var teacher_id = $(this).attr('data-teacher-id');
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>common/courseListByTeahcerId',
                data: {teacher_id: teacher_id},
                success: function (data) {
                    $("#course_list_by_tr_id_" + teacher_id).html(data);

                }

            });
        });
    });
</script>
