<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<script type="text/javascript">
    $(function () {
        /*  $('#SEMESTER_ID').multiselect({
         includeSelectAllOption: true
         });*/
        $('#btnSelected').click(function () {
            var selected = $("#lstFruits option:selected");
            var message = "";
            selected.each(function () {
                message += $(this).text() + " " + $(this).val() + "\n";
            });
            alert(message);
        });
    });
</script>
<div class="row">
    <form class="form-horizontal" id="conDis" action="<?php echo base_url(); ?>teacher/saveConDis" method="post"
          enctype="multipart/form-data">
        <div class="col-md-12">
            <div class="ibox-content">
                <span class="frmMsg"></span>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Session</label>
                    <div class="col-lg-5">
                        <select name="SESSION_ID" id="SESSION_ID" class="form-control">
                            <?php foreach ($session as $row): ?>
                                <option
                                    value="<?php echo $row->SESSION_ID; ?>"><?php echo $row->SESSION_NAME; ?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Faculty</label>

                    <div class="col-lg-6">
                        <select name="FACULTY_ID" id="FACULTY_ID" class="form-control">
                            <option>-Select-</option>
                            <?php foreach ($faculty as $row): ?>
                                <option
                                    value="<?php echo $row->FACULTY_ID; ?>"><?php echo $row->FACULTY_NAME; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Department</label>
                    <div class="col-lg-6">
                        <select name="DEPARTMENT_ID" id="DEPARTMENT_ID" class="form-control">
                            <option>-Select-</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Program</label>
                    <div class="col-lg-7">
                        <select name="PROGRAM_ID" ID="PROGRAM_ID" class="form-control">
                            <option>-Select-</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Course</label>
                    <div class="col-lg-7">
                        <select name="COURSE_ID" ID="COURSE_ID" class="form-control">
                            <option>-Select-</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Semester</label>
                    <div class="col-lg-5">
                        <select name="SEMESTER_ID" id="SEMESTER_ID" class="form-control">
                            <option>-Select-</option>
                            <?php foreach ($semester as $row): ?>
                                <option value="<?php echo $row->LKP_ID ?>"> <?php echo $row->LKP_NAME ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Batch</label>
                    <div class="col-lg-5">
                        <select name="BATCH_ID" id="BATCH_ID" class="form-control">
                            <option>-Select-</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Start Date</label>

                    <div id="data_1">
                        <div class="input-group date col-lg-3">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" name="START_DATE"  class="form-control"  value="">
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">End Date</label>

                    <div id="data_1">
                        <div class="input-group date col-lg-3">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" name="END_DATE"  class="form-control" value="">
                        </div>
                    </div>
                </div>
                <?php foreach ($corConId as $key => $value): ?>
                    <input type="hidden" value="<?php echo $value ?>" name="CONTENT_ID[]">
                <?php endforeach; ?>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Active?</label>

                    <div class="col-lg-5">

                        <label class="control-label">
                            <?php
                            $data = array(
                                'name' => 'status',
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
                    <div class="col-lg-offset-3 col-lg-10">
                        <span class="modal_msg pull-left"></span>
                        <input type="submit" class="btn btn-primary btn-sm" value="submit">
                        <input type="reset" class="btn btn-default btn-sm" value="Reset">
                        <span class="loadingImg"></span>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


<script src="<?php echo base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script>
    $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });
    $(document).on('change', '#PROGRAM_ID', function () {
        var program_id = $("#PROGRAM_ID").val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>common/programWiseBatch",
            data: {program_id: program_id},
            success: function (data) {
                $("#BATCH_ID").html(data);
            }
        });
    });
</script>