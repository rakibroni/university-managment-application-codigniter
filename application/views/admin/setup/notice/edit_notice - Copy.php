<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/jquery-ui.datepicker.css" rel="stylesheet">
<div class="row">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Edit Notice</h5>

            <div class="ibox-tools">
                <a href="<?php echo base_url() ?>setup/notice">
                    <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-arrow-left"></i> Back</button>
                </a>
            </div>
        </div>
        <div class="block-flat">
            <div class="col-md-12">
                <div class="ibox-content">
                    <span class="frmMsg"></span>

                    <form class="form-horizontal" id="" action="<?php echo base_url(); ?>setup/updateNotice"
                          method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label class="col-lg-2 control-label"><span>Notice For</span></label>

                            <div class="col-lg-6">
                                <input type="radio" name="NOTICE_FOR" class="notice_for"
                                       value="A" <?php echo ($previous_info->NOTICE_FOR == 'A') ? 'checked' : ''; ?>>&nbsp;&nbsp;&nbsp;
                                All&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="NOTICE_FOR" class="notice_for"
                                       value="T" <?php echo ($previous_info->NOTICE_FOR == 'T') ? 'checked' : ''; ?>>&nbsp;&nbsp;&nbsp;Teacher&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="NOTICE_FOR" class="notice_for"
                                       value="S"  <?php echo ($previous_info->NOTICE_FOR == 'S') ? 'checked' : ''; ?>>&nbsp;&nbsp;Student
                            </div>
                        </div>
                        <div id="student_info" style="display: none">
                            <div class="form-group">
                                <label class="col-lg-2 control-label"><span>Faculty</span></label>

                                <div class="col-lg-3">
                                    <select name="FACULTY" id="FACULTY" class="form-control">
                                        <option value="">-select-</option>
                                        <?php foreach ($faculty as $row): ?>
                                            <option
                                                value="<?php echo $row->FACULTY_ID ?>" <?php echo ($previous_info->FACULTY_ID == $row->FACULTY_ID) ? 'selected' : '' ?>><?php echo $row->FACULTY_NAME ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group"><label
                                    class="col-lg-2 control-label"><span>Department</span></label>

                                <div class="col-lg-3">
                                    <select name="DEPARTMENT" id="DEPARTMENT" class="form-control">
                                        <option value="">-select-</option>
                                        <?php foreach ($department as $row): ?>
                                            <option
                                                value="<?php echo $row->DEPT_ID ?>" <?php echo ($previous_info->DEPT_ID == $row->DEPT_ID) ? 'selected' : '' ?>><?php echo $row->DEPT_NAME ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label"><span>Program</span></label>

                                <div class="col-lg-3">
                                    <select name="PROGRAM" id="PROGRAM" class="form-control">
                                        <option value="">-select-</option>
                                        <?php foreach ($program as $row): ?>
                                            <option
                                                value="<?php echo $row->PROGRAM_ID ?>" <?php echo ($previous_info->PROGRAM_ID == $row->PROGRAM_ID) ? 'selected' : '' ?>><?php echo $row->PROGRAM_NAME ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Notice Title</label>

                            <div class="col-lg-7">
                                <input type="text" id="NOTICE_TITLE" name="NOTICE_TITLE" class="form-control "
                                       value="<?php echo $previous_info->NOTICE_TITLE; ?>" placeholder="Notice Title">
                                <input type="hidden" id="NOTICE_ID" name="NOTICE_ID"
                                       value="<?php echo $previous_info->NOTICE_ID; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Description</label>

                            <div class="col-lg-7">
                                <textarea name="NOTICE_DESCRIPTION"
                                          class="redactor"> <?php echo $previous_info->NOTICE_DESCRIPTION; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Upload File</label>

                            <div class="col-lg-3">
                                <input type="file" name="NOTICE_FILE">
                                <?php echo $previous_info->NOTICE_FILE; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">From Date</label>

                            <div class="col-lg-2">
                                <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" class="form-control datepicker" name="START_DATE"
                                           value="<?php echo $previous_info->START_DATE; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">To Date</label>

                            <div class="col-lg-2">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control datepicker" name="END_DATE"
                                           value="<?php echo $previous_info->END_DATE; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Is Active ?</label>

                            <div class="col-lg-10">
                                <?php
                                $ACTIVE_STATUS = $previous_info->ACTIVE_STATUS;
                                $CHECKED = ($previous_info->ACTIVE_STATUS == 1) ? TRUE : FALSE;
                                ?>
                                <label class="control-label">
                                    <?php
                                    $data = array(
                                        'name' => 'ACTIVE_STATUS',
                                        'id' => 'status',
                                        'class' => 'checkBoxStatus',
                                        'value' => $ACTIVE_STATUS,
                                        'checked' => $CHECKED
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

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/redactor/redactor.css"/>
<script src="<?php echo base_url(); ?>assets/redactor/redactor.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>
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