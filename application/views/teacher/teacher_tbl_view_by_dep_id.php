<?php if (!empty($teachers)) { ?>
    <div class="table-responsive contentArea">
        <table class="table table-striped table-bordered table-hover gridTable">
            <thead>
            <tr>
                <th>SN</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Designation</th>

                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $sl = 1;
            foreach ($teachers as $row) { ?>
                <tr>
                    <td><?php echo $sl++; ?></td>
                    <td class="text-center">
                        <?php $tr_pic = 'assets/img/default.png';
                        if (!empty($row->TEACHER_PHOTO)) $tr_pic = 'upload/faculty_teacher/' . $row->TEACHER_PHOTO; ?>
                        <div class="lightBoxGallery">
                            <a href="<?php echo base_url($tr_pic); ?>" title="Faculty Teacher Photo"
                               data-gallery=""><img width="30" src="<?php echo base_url($tr_pic); ?>"></a>

                        </div>

                    </td>
                    <td><?php echo $row->FULL_NAME ?></td>
                    <td><?php echo $row->DESIGNATION ?></td>

                    <td class="text-center"><a class="btn btn-primary btn-xs teacher_details"
                                               data-user-id="<?php echo $row->USER_ID ?>" type="button"
                                               data-toggle="modal" data-target="#teacher_modal"><i
                                class="fa fa-eye"></i></a></td>
                </tr>
            <?php } ?>

            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>
<?php } else {
    echo "Teacher's Not Found";
} ?>
<script type="text/javascript">

    $(".teacher_details").on("click", function () {
        var teacher_id = $(this).attr('data-user-id');

        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>teacher/teacherModal',
            data: {teacher_id: teacher_id},
            success: function (data) {
                $("#teacher_modal .modal-body").html(data);
            }
        });
    });
</script>