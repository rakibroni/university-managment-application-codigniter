<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

<div class="block-flat">
    <form class="form-horizontal frmContent" id="exam_application" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="txtexam_applicationId"
                   value="<?php echo $exam_application->EX_APP_ID ?>"/>
            <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group"><label class="col-lg-4 control-label">Title<span
                        class="text-danger">*</span></label>
            <div class="col-lg-5">
                <input type="text" id="exam_application_Name" name="exam_application_Name"
                       value="<?php echo ($ac_type == 2) ? $exam_application->EXAM_APP_TITLE : '' ?>"
                       class="form-control required"
                       placeholder="Enter Exam Application Title">
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- </span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
            <label class="col-lg-4 control-label">Academic Session<span class="text-danger">*</span></label>
            <div class="col-lg-5">

                <select class="form-control required SESSION_ID" name="INS_SESSION_ID" id="INS_SESSION_ID"
                        data-tags="true" data-placeholder="Select Institute Session" data-allow-clear="true">
                    <?php
                    if ($ac_type == 2): ?>  // if the form action is EDIT
                        <option value="">--- Select Academic Session ---</option>
                        <?php foreach ($session as $row):
                            ?>
                            <option
                                    value="<?php echo $row->YSESSION_ID ?>" <?php echo ($exam_application->SESSION_ID == $row->YSESSION_ID) ? 'selected' : '' ?>><?php echo $row->SESSION_NAME ?></option>
                            <?php
                        endforeach;
                    else: // if the form action is VIEW
                        ?>
                        <option value="">--- Select Academic Session ---</option>
                        <?php
                        foreach ($session as $row):
                            ?>
                            <option value="<?php echo $row->YSESSION_ID ?>"><?php echo $row->SESSION_NAME ?></option>
                            <?php
                        endforeach;
                    endif; ?>


                </select>

            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-4 control-label">Exam Type<span class="text-danger">*</span></label>
            <div class="col-lg-5">

                <select class="form-control required SESSION_ID" name="EXAM_TYPE_ID" id="EXAM_TYPE_ID"
                        data-tags="true" data-placeholder="Select Exam Type" data-allow-clear="true">

                    <?php
                    if ($ac_type == 2): ?>  // if the form action is EDIT
                        <option value="">--- Select Exam Type ---</option>
                        <?php foreach ($exam_type as $row):
                            ?>
                            <option
                                    value="<?php echo $row->EXAM_MARKS_TYPE_ID ?>" <?php echo ($exam_application->EXAM_MARKS_TYPE_ID == $row->EXAM_MARKS_TYPE_ID) ? 'selected' : '' ?>><?php echo $row->MARKS_TITLE ?></option>
                            <?php
                        endforeach;
                    else: // if the form action is VIEW
                        ?>
                        <option value="">--- Select Exam Type ---</option>
                        <?php
                        foreach ($exam_type as $row):
                            ?>
                            <option value="<?php echo $row->EXAM_MARKS_TYPE_ID ?>"><?php echo $row->MARKS_TITLE ?></option>
                            <?php
                        endforeach;
                    endif; ?>


                </select>

            </div>
        </div>


        <div class="hr-line-dashed"></div>

        <div class="form-group"><label class="col-lg-4 control-label">Start Date<span
                        class="text-danger">*</span></label>
            <div class="col-lg-3">
                <input type="text" name="start_date" class="form-control datepicker required"
                       value="<?php echo ($ac_type == 2) ? date('d-m-Y', strtotime($exam_application->START_DT)) : '' ?>">
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group"><label class="col-lg-4 control-label">End Date<span
                        class="text-danger">*</span></label>
            <div class="col-lg-3">
                <input type="text" name="end_date" class="form-control datepicker required"
                       value="<?php echo ($ac_type == 2) ? date('d-m-Y', strtotime($exam_application->END_DT)) : '' ?>">
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group"><label class="col-lg-4 control-label">Active?</label>

            <div class="col-lg-6">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $exam_application->EX_APP_ACTIVE_STATUS : '';
                $checked = ($ac_type == 2) ? (($exam_application->EX_APP_ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
                ?>
                <label class="control-label">
                    <?php
                    $data = array(
                        'name' => 'status',
                        'id' => 'status',
                        'class' => 'checkBoxStatus',
                        'value' => $ACTIVE_STATUS,
                        'checked' => $checked,
                    );
                    echo form_checkbox($data);
                    ?>
                </label>
                <span class="help-block m-b-none">Example click checkbox .</span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-4 col-lg-8">
                <span class="modal_msg pull-left"></span>
                <?php if ($ac_type == 2) { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit"
                           data-action="exam/updateExamApplication"
                           data-su-action="exam/examApplicationById" value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit"
                           data-action="exam/createExamApplication"
                           data-su-action="exam/examApplicationList" data-type="list" value="submit">
                    <?php
                }
                ?>
                <input type="reset" class="btn btn-default btn-sm" value="Reset">
                <span class="loadingIm   g"></span>
            </div>
        </div>
                    </form>
</div>

<script src="<?php echo base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script>
    $(function () {
        $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy',
            yearRange: "-50:+0",
            autoclose: true,
            startDate: '-0d',
        });
    });

    $(document).on('click', '#status', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });
</script>