<?php
/*echo "<pre>";
print_r($previous_info);
exit()*/
?>
<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<div class="block-flat">
    <form class="form-horizontal frmContent" id="assign_dist" method="post">
        <?php
        if ($ac_type == 'edit') {
            ?>
            <input type="hidden" class="rowID" name="AS_DIST_ID" id="AS_DIST_ID"
                   value="<?php echo $previous_info->AS_DIST_ID ?>"/>
        <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group">
            <label class="col-lg-3 control-label">Course <span class="text-danger">*</span></label>

            <div class="col-lg-7">
                <?php if ($ac_type == 'edit'): ?>
                    <select class="select2DropdownAjax form-control required" name="COURSE_ID" id="COURSE_ID"
                            data-action="<?php echo base_url('common/getCourseList') ?>" data-tags="true"
                            data-placeholder="Select Course" data-allow-clear="true">
                        <option
                            value="<?php echo $previous_info->COURSE_ID; ?>"><?php echo $previous_info->COURSE_TITLE; ?></option>
                    </select>
                <?php endif; ?>
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- Computer Fundamental.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">assign_dist Title</label>

            <div class="col-lg-7">
                <select class="select2Dropdown form-control" name="ASSIGN_ID" id="ASSIGN_ID" data-tags="true"
                        data-placeholder="Select assign_dist" data-allow-clear="true">
                    <?php if ($ac_type == 'edit'): ?>
                        <option
                            value="<?php echo $previous_info->ASSIGN_ID ?>"><?php echo $previous_info->ASSIGN_TITLE; ?></option>
                    <?php else: ?>
                        <option>Select assign_dist Title</option>
                    <?php endif; ?>
                </select>
                <span class="help-block m-b-none">Example:- Operating System Concepts.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Session <span class="text-danger">*</span></label>
            <div class="col-lg-4">
                <select class="select2Dropdown form-control" name="SESSION_ID" id="SESSION_ID" data-tags="true"
                        data-placeholder="Select Session" data-allow-clear="true">
                    <?php foreach ($session as $row): ?>
                        <option
                            value="<?php echo $row->SESSION_ID; ?>" <?php echo ($previous_info->SESSION_ID == $row->SESSION_ID) ? 'selected' : ''; ?>><?php echo $row->SESSION_NAME; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <span class="help-block m-b-none">Example:- Fall(2015).</span>
        </div>
        <div class="hr-line-dashed"></div>
        <?php $this->load->view("common/faculty_dept_program"); ?>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Semester <span class="text-danger">*</span></label>
            <div class="col-lg-4">
                <select class="select2Dropdown form-control " name="SEMESTER_ID" id="SEMESTER_ID" data-tags="true"
                        data-placeholder="Select Semester" data-allow-clear="true">
                    <option value="">Select Semester</option>
                    <?php foreach ($semester as $row): ?>
                        <option
                            value="<?php echo $row->LKP_ID; ?>" <?php echo ($previous_info->SEMESTER_ID == $row->LKP_ID) ? 'selected' : ''; ?>><?php echo $row->LKP_NAME; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <span class="help-block m-b-none">Example:- 1st Semester.</span>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Start Date<span class="text-danger">*</span></label>

            <div class="col-lg-3">
                <div id="data_1">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text"
                                                                                                    name="startDate"
                                                                                                    class="form-control"
                                                                                                    value="<?php echo ($ac_type == 'edit') ? date('d/m/Y', strtotime($previous_info->START_DATE)) : '' ?>">
                    </div>
                </div>
                <span class="help-block m-b-none ">e.g.  05/10/2015</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">End Date<span class="text-danger">*</span></label>

            <div class="col-lg-3">
                <div id="data_1">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text"
                                                                                                    name="endDate"
                                                                                                    class="form-control"
                                                                                                    value="<?php echo ($ac_type == 'edit') ? date('d/m/Y', strtotime($previous_info->END_DATE)) : '' ?>">
                    </div>
                </div>
                <span class="help-block m-b-none ">e.g.  05/10/2015</span>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-3 control-label">Active?</label>

            <div class="col-lg-6">
                <?php
                $ACTIVE_STATUS = ($ac_type == 'edit') ? $previous_info->ACTIVE_STATUS : '';
                $checked = ($ac_type == 'edit') ? (($previous_info->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-8">
                <?php if ($ac_type == 'edit') { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateAssignDist"
                           data-su-action="setup/assignDistById" value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createAssignDist"
                           data-su-action="setup/assignDistList" data-type="list" value="Submit">
                <?php
                }
                ?>
                <input type="reset" class="btn btn-default btn-sm" value="Reset">
                <span class="loadingImg"></span>
            </div>
        </div>


    </form>
</div>
<!-- Data picker -->
<script src="<?php echo base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">

    $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });

    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked')) ? 1 : 0;
        $("#status").val(status);
    });

    $(document).ready(function () {
        $(document).on('change', '#COURSE_ID', function (event) {
            event.preventDefault();
            var COURSE_ID = $(this).val();
            var url = '<?php echo site_url('setup/ajax_get_assign_dist') ?>';
            $.ajax({
                type: "POST",
                url: url,
                data: {COURSE_ID: COURSE_ID},
                dataType: 'html',
                success: function (data) {
                    $('#ASSIGN_ID').html(data);
                }
            });
        });
    });
    $("#DIST_ID").click(function () {
        $(".distribution").toggle();
    });
</script>
<style>
    .select2-container {
        z-index: 99999;
        width: 100% !important;
    }

    .distribution {
        width: 100%;
        display: none;
    }

    .pop-width {
        width: 25% !important;
    }

</style>