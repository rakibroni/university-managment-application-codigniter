<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<div class="block-flat">
    <form class="form-horizontal frmContent" id="assignment" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="ASSIGN_ID" value="<?php echo $assignment->ASSIGN_ID ?>"/>
        <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group">
            <label class="col-md-4 control-label">Course <span class="text-danger">*</span></label>

            <div class="col-lg-8">
                <?php if ($ac_type == 2): ?>
                <?php if($flag == 'distribute'){ echo $assignment->COURSE_TITLE ;?> <input type="hidden" name="COURSE_ID" value="<?php echo  $assignment->COURSE_ID  ?>" ><?php }else{ ?>


                    <select class="select2DropdownAjax form-control required" name="COURSE_ID" id="COURSE_ID"
                            data-action="<?php echo base_url('common/getCourseList') ?>" data-tags="true"
                            data-placeholder="Select Course" data-allow-clear="true">
                        <option  value="<?php echo $assignment->COURSE_ID; ?>" ><?php echo $assignment->COURSE_TITLE; ?></option>
                    </select>
                        <span class="validation"></span>
                        <span class="help-block m-b-none">Example:- Computer Fundamental.</span>
                <?php }else: ?>
                    <select class="select2DropdownAjax form-control required" name="COURSE_ID" id="COURSE_ID"
                            data-action="<?php echo base_url('common/getCourseList') ?>" data-tags="true"
                            data-placeholder="Select Course" data-allow-clear="true">
                        <option value="">Select Course</option>
                    </select>
                    <span class="validation"></span>
                    <span class="help-block m-b-none">Example:- Computer Fundamental.</span>
                <?php endif; ?>

            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-md-4 control-label">Course Topic</label>

            <div class="col-lg-8">
                <?php if($flag == 'distribute'){ echo $assignment->TOPIC_TITLE ; }else{ ?>
                <select class="select2Dropdown form-control" name="TOPIC_ID" id="TOPIC_ID" data-tags="true"
                        data-placeholder="Select Topics" data-allow-clear="true">
                    <?php if ($ac_type == 2): ?>
                        <option  value="<?php echo $assignment->CRS_TOPIC_ID ?>"><?php echo $assignment->TOPIC_TITLE; ?></option>
                    <?php else: ?>
                        <option>Select Course Topic</option>
                        <span class="help-block m-b-none">Example:- Computer Lab.</span>
                    <?php endif;} ?>
                </select>

            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-md-4 control-label">Title<span class="text-danger">*</span></label>

            <div class="col-lg-8">
                <input type="text" id="ASSIGN_TITLE" name="ASSIGN_TITLE" class="form-control required"
                       value="<?php echo ($ac_type == 2) ? $assignment->ASSIGN_TITLE : ''; ?>"
                       placeholder="Assignment Title" <?php echo  ($flag == 'distribute') ? 'readonly' : '' ?>>
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- Operating System Concepts.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-md-4 control-label"><span>Description</span></label>

            <div class="col-lg-8">
                <?php if($flag == 'distribute'){ echo $assignment->ASSIGN_DESC ; }else{ ?>
                    <textarea class="redactor"
                              name="ASSIGN_DESC"><?php echo ($ac_type == 2) ? $assignment->ASSIGN_DESC : ''; ?>
                        <span class="validation"></span>
                <span class="help-block m-b-none">Example:- Short Description .</span>
                </textarea>
                <?php   }?>

            </div>
        </div>

        <?php if($flag == 'distribute'){ echo '<input type="hidden" name="status" value="1"> '; }else{ ?>

        <div class="form-group"><label class="col-md-4 control-label">Active?</label>

            <div class="col-lg-6">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $assignment->ACTIVE_STATUS : '';
                $checked = ($ac_type == 2) ? (($assignment->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
        <?php } ?>

        <?php if ($ac_type == 1) : ?>
            <div class="form-group"><label class="col-md-4 control-label">Distribution</label>

                <div class="col-lg-6">
                    <?php
                    $distribution = ($ac_type == 2) ? $assignment->ACTIVE_STATUS : '';
                    $checked = ($ac_type == 2) ? (($assignment->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
                    ?>
                    <label class="control-label">
                        <?php
                        $data = array(
                            'name' => 'DIST_ID',
                            'id' => 'DIST_ID',
                            'class' => 'checkBoxDistribute',
                            'value' => $distribution,
                            'checked' => $checked,
                        );
                        echo form_checkbox($data);
                        ?>
                    </label>
                    <span class="help-block m-b-none">click on checkbox for distribution.</span>
                </div>
            </div>
        <?php endif; ?>
        <div class="distribution">
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-md-4 control-label">Session <span class="text-danger">*</span></label>

                <div class="col-lg-4">
                    <select class="select2Dropdown form-control commonClass" name="SESSION_ID" id="SESSION_ID"
                            data-tags="true" data-placeholder="Select Session" data-allow-clear="true">
                        <option value="">Select Session</option>
                        <?php foreach ($session as $row): ?>
                            <option value="<?php echo $row->SESSION_ID; ?>"><?php echo $row->SESSION_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="validation"></span>
                    <span class="help-block m-b-none">Example:- Fall(2015).</span>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <?php $this->load->view("common/faculty_dept_program"); ?>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-md-4 control-label">Semester <span class="text-danger">*</span></label>

                <div class="col-lg-4">
                    <select class="select2Dropdown form-control commonClass" name="SEMESTER_ID" id="SEMESTER_ID"
                            data-tags="true" data-placeholder="Select Semester" data-allow-clear="true">
                        <option value="">Select Semester</option>
                        <?php foreach ($semester as $row): ?>
                            <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="validation"></span>
                    <span class="help-block m-b-none">Example:- 1st Semester.</span>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-md-4 control-label">Batch <span class="text-danger">*</span></label>

                <div class="col-lg-4">
                    <select class="select2Dropdown form-control commonClass" name="BATCH_ID" id="BATCH_ID"
                            data-tags="true" data-placeholder="Select Batch" data-allow-clear="true">
                        <option value="">Select Batch</option>

                    </select>
                    <span class="validation"></span>
                    <span class="help-block m-b-none">Example:- 1st Semester.</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Start Date<span class="text-danger">*</span></label>

                <div class="col-md-4">
                    <div id="data_1">
                        <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text"
                                                                                                        name="startDate"
                                                                                                        class="form-control commonClass"
                                                                                                        value="">
                        </div>
                    </div>
                    <span class="validation"></span>
                    <span class="help-block m-b-none ">e.g.  05/10/2015</span>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-md-4 control-label">End Date<span class="text-danger">*</span></label>

                <div class="col-md-4">
                    <div id="data_1">
                        <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" name="endDate" class="form-control commonClass" value="">
                        </div>
                    </div>
                    <span class="validation"></span>
                    <span class="help-block m-b-none ">e.g.  05/10/2015</span>
                </div>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-lg-offset-4 col-lg-8">
                <?php if ($ac_type == 2) { ?>
                    <?php if ($flag == 'distribute') { ?>
                        <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createAssignDist" data-su-action="setup/assignmentById" value="Distribute">
                    <?php } else { ?>
                        <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateAssignment" data-su-action="setup/assignmentById" value="Update">
                    <?php } ?>
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createAssignment" data-su-action="setup/assignmentList" data-type="list" value="Submit">
                <?php
                }
                ?>
                <input type="reset" class="btn btn-default btn-sm" value="Reset">
                <span class="loadingImg"></span>
            </div>
        </div>


    </form>
</div>
<?php if ($flag == 'distribute'): ?>
    <style>
        .distribution {
            width: 100%;
            display: block;
        }
    </style>
<?php else: ?>
    <style>
        .distribution {
            width: 100%;
            display: none;
        }
    </style>
<?php endif; ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/redactor/redactor.css"/>
<script src="<?php echo base_url(); ?>assets/redactor/redactor.min.js"></script>
<!-- Data picker -->
<script src="<?php echo base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(document).ready(
        function () {
            $('.redactor').redactor();
        }
    );
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
    $(document).on('click', '.checkBoxDistribute', function () {
        var distribute = ($(this).is(':checked')) ? 1 : 0;
        $("#DIST_ID").val(distribute);
        if (distribute == 1) {
            $(".commonClass").addClass("required");
        } else {
            $(".commonClass").removeClass("required");
        }
    });

    $(document).ready(function () {
        $(document).on('change', '#COURSE_ID', function (event) {
            event.preventDefault();
            var COURSE_ID = $(this).val();
            var url = '<?php echo site_url('setup/ajax_get_topics') ?>';
            $.ajax({
                type: "POST",
                url: url,
                data: {COURSE_ID: COURSE_ID},
                dataType: 'html',
                success: function (data) {
                    $('#TOPIC_ID').html(data);
                }
            });
        });
        // Autocomplete Dropdown Initialization - AJAX Example
        $(".select2DropdownAjax").each(function () {
            //$(document).on("click",".select2DropdownAjax",function(){
            var action_uri = $(this).attr("data-action");
            $(this).select2({
                ajax: {
                    url: action_uri,
                    dataType: 'json',
                    data: function (params) {
                        return {
                            term: params.term
                        }
                    },
                    results: function (data) {
                        var courseResults = [];
                        $.each(data, function (index, item) {
                            courseResults.push({
                                'id': item.id,
                                'text': item.text
                            });
                        });
                        return {
                            results: courseResults
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1
            });
        });
    });
    $("#DIST_ID").click(function () {
        $(".distribution").toggle();
    });
    $(document).on('change', '#PROGRAM_ID', function (event) {
        event.preventDefault();
        var program_id = $(this).val();
        var url = '<?php echo site_url('common/programWiseBatch') ?>';
        $.ajax({
            type: "POST",
            url: url,
            data: {program_id: program_id},
            dataType: 'html',
            success: function (data) {
                $('#BATCH_ID').html(data);
            }
        });
    });
</script>
<style>
    .select2-container {
        z-index: 99999;
        width: 100% !important;
    }
    .pop-width {
        width: 25% !important;
    }
    .select2-container {
        z-index: 999999;
    }

</style>