<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<style>
    .datepicker.dropdown-menu {
        z-index: 9999 !important;
    }

    .activeClass {
        background: #32cd32;
    }

    .select2-container {
        z-index: 999999;
    }

    .pop-width {
        width: 25% !important;
    }
</style>
<form class="form-horizontal frmContent" id="regPeriod" method="post">
    <div class="block-flat">
        <?php if ($ac_type == "edit") { ?>
            <input type="hidden" name="previous_infoId" class="rowID"
                value="<?php echo $previous_info->REG_PERIOD_ID; ?>" />
        <?php } ?>
        <span class="frmMsg"></span>
        <?php $this->load->view("common/faculty_dept_program"); ?>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-md-4 control-label">Upcoming Semester <span class="text-danger">*</span></label>

            <div class="col-lg-5">
                <?php if ($ac_type == "edit"): // if the form action is EDIT ?>
                    <select class="select2Dropdown form-control required" name="SEMESTER_ID" id="SEMESTER_ID"
                        data-tags="true" data-placeholder="Select Semester" data-allow-clear="true">
                        <option value="">Select Semester</option>
                        <?php foreach ($semester as $row): ?>
                            <option
                                value="<?php echo $row->SEMESTER_ID; ?>" <?php echo ($previous_info->SEMESTER_ID == $row->SEMESTER_ID) ? 'selected' : ''; ?>><?php echo $row->SEMESTER_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php else: // if the form action is VIEW ?>
                    <select class="select2Dropdown form-control required" name="SEMESTER_ID" id="SEMESTER_ID"
                        data-tags="true" data-placeholder="Select Semester" data-allow-clear="true">
                        <option value="">Select Semester</option>
                        <?php foreach ($semester as $row): ?>
                            <option value="<?php echo $row->SEMESTER_ID ?>"><?php echo $row->SEMESTER_NAME ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-md-4 control-label">Upcoming Session <span class="text-danger">*</span></label>

            <div class="col-lg-5">
                <?php if ($ac_type == "edit"): // if the form action is EDIT ?>
                    <select class="select2Dropdown form-control required" name="SESSION_ID" id="SESSION_ID"
                        data-tags="true"
                        data-placeholder="Select Session" data-allow-clear="true">
                        <option value="">Select Session</option>
                        <?php foreach ($session as $row): ?>
                            <option
                                value="<?php echo $row->SESSION_ID; ?>" <?php echo ($previous_info->SESSION_ID == $row->SESSION_ID) ? 'selected' : ''; ?>><?php echo $row->SESSION_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php else: // if the form action is VIEW ?>
                    <select class="select2Dropdown form-control required" name="SESSION_ID" id="SESSION_ID" data-tags="true"
                        data-placeholder="Select Session" data-allow-clear="true">
                        <option value="">Select Session</option>
                        <?php foreach ($session as $row) { ?>
                            <option
                                value="<?php echo $row->SESSION_ID; ?>"><?php echo $row->SESSION_NAME; ?></option>
                        <?php } ?>
                    </select>
                <?php endif; ?>
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-md-4 control-label">Title<span class="text-danger">*</span></label>

            <div class="col-lg-8">
                <input type="text" id="title" name="title"
                    value="<?php echo ($ac_type == 'edit') ? $previous_info->RP_TITLE : '' ?>"
                    class="form-control required" placeholder="Enter Registration Period Title">
                <span class="validation"></span>
                <span class="help-block m-b-none ">e.g. Semester Admission .</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-md-4 control-label"><span>Description</span></label>

            <div class="col-lg-8">
                <textarea class="redactor"
                    name="description"><?php echo ($ac_type == 'edit') ? $previous_info->RP_DESC : ''; ?></textarea>
                <span class="validation"></span>
                <span class="help-block m-b-none">e.g. Registration period description text here.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-md-2 control-label">Start Date<span
                    class="text-danger">*</span></label>

            <div class="col-md-4">
                <div id="data_1">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text"
                            name="startDate"
                            class="form-control required"
                            value="<?php echo ($ac_type == 'edit') ? date('d/m/Y', strtotime($previous_info->FROM_DT)) : $current_date ?>">
                    </div>
                </div>
                <span class="help-block m-b-none ">e.g.  2/10/2015</span>
            </div>
            <label class="col-lg-2 control-label">End Date<span class="text-danger">*</span></label>

            <div class="col-md-4">
                <div id="data_1">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text"
                            name="endDate"
                            class="form-control required"
                            value="<?php echo ($ac_type == 'edit') ? date('d/m/Y', strtotime($previous_info->TO_DT)) : $current_date ?>">
                    </div>
                </div>
                <span class="help-block m-b-none ">e.g.  05/10/2015</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-md-4 control-label">Active?</label>

            <div class="col-lg-7">
                <?php
                $ACTIVE_STATUS = ($ac_type == "edit") ? $previous_info->ACTIVE_STATUS : '';
                $checked = ($ac_type == "edit") ? (($previous_info->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
                <span class="help-block m-b-none">click on checkbox for active status.</span>
            </div>
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <div class="col-lg-offset-4 col-lg-10">
            <!--<span class="modal_msg pull-left"></span>-->
            <?php if ($ac_type == "edit") { ?>
                <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateRegPeriod"
                    data-su-action="setup/regPeriodById" value="Update">
            <?php } else { ?>
                <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createRegPeriod"
                    data-su-action="setup/regPeriodList" data-type="list" value="Submit">
            <?php
            }
            ?>
            <input type="reset" class="btn btn-default btn-sm" value="Reset">
            <span class="loadingImg"></span>
        </div>
    </div>
</form>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/redactor/redactor.css" />
<script src="<?php echo base_url(); ?>assets/redactor/redactor.min.js"></script>
<!-- Data picker -->
<script src="<?php echo base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(document).ready(
        function () {
            $('.redactor').redactor();
        }
    );
    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked')) ? 1 : 0;
        $("#status").val(status);
    });
    $(document).ready(function () {
        $('.clockpicker').clockpicker();

        /* start Previous Date Disable in calendar*/
        var nowDate = new Date();
        var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
        $('#data_1 .input-group.date').datepicker({
            startDate: today,
            defaultDate: new Date()
        });
        $('#data_2 .input-group.date').datepicker({
            startDate: today
        });
        /*End Previous Date Disable in calendar*/

        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            todayHighlight: true,
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });
        $('#data_2 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });
        $('.inline_date').datepicker({
            multidate: true,
            todayHighlight: true,
            minDate: 0,
        });

    });
</script>

