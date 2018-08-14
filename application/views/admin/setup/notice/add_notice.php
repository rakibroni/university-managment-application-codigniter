<form class="form-horizontal" action="<?php echo base_url(); ?>setup/saveNotice" method="post"
      enctype="multipart/form-data">
    <div class="ibox-title">
        <h5>Create Notice</h5>

        <div class="ibox-tools">
            <a href="<?php echo base_url() ?>setup/notice">
                <button class="btn btn-primary btn-xs" type="button"><i class="fa fa-arrow-left"></i> Back</button>
            </a>
        </div>
    </div>
    
    <div class="ibox-content">
        <div class="form-group">
            <label class="col-lg-2 control-label">Notice Title</label>

            <div class="col-lg-8">
                <input type="text" id="NOTICE_TITLE" name="NOTICE_TITLE" class="form-control required" value=""
                       placeholder="Notice Title">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">Description</label>

            <div class="col-lg-8">
                <textarea name="NOTICE_DESCRIPTION" class="redactor"> </textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">Upload File</label>

            <div class="col-lg-3">
                <input type="file" name="N_ATTACHMENT">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">From Date</label>

            <div class="col-lg-2">
                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" value=""
                                                                                                class="form-control datepicker"
                                                                                                name="START_DATE">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">To Date</label>

            <div class="col-lg-2">
                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" value=""
                                                                                                class="form-control datepicker"
                                                                                                name="END_DATE">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">Is Active ?</label>

            <div class="col-lg-10">

                <label class="control-label">
                    <?php
                    $data = array(
                        'name' => 'ACTIVE_STATUS',
                        'id' => 'status',
                        'class' => 'checkBoxStatus',
                        'value' => 1,
                        'checked' => 'checked'
                    );
                    echo form_checkbox($data);
                    ?>
                </label>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <input type="submit" class="btn btn-primary btn-sm " value="submit">
                <input type="reset" class="btn btn-default btn-sm" value="Reset">
                <span class="loadingImg"></span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</form>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/redactor/redactor.css"/>
<script src="<?php echo base_url(); ?>assets/redactor/redactor.min.js"></script>
<script>
    $(function () {
        $(function () {
            $(".datepicker").datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: '1950:+0'
            });
        });
    });
</script>
<script>
    $('.redactor').redactor();

    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });
    $(document).on('change', '#FACULTY', function () {
        var faculty_id = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>setup/depByFacId',
            data: {faculty_id: faculty_id},
            success: function (data) {
                $('#DEPARTMENT').html(data);
                $('#PROGRAM').html("");
            }
        });
    });
    $(document).on('change', '#DEPARTMENT', function () {
        var dep_id = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>setup/proByDepId',
            data: {dep_id: dep_id},
            success: function (data) {
                $('#PROGRAM').html(data);
            }
        });
    });
    $(document).on('click', '.notice_for', function () {
        var notice_for = $(this).val();
        if (notice_for == 'S') {
            $('#student_info').show();
        } else {
            $('#student_info').hide();
        }
    });
</script>