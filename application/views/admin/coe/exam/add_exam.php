<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<style>
    .datepicker.dropdown-menu {
        z-index: 9999 !important;
    }
    .select2-container {
        z-index: 999999;
    }
    .pop-width {
        width: 25% !important;
    }
</style>
<form class="form-horizontal frmContent" id="exam" method="post">
    <div class="block-flat">
        <?php if ($ac_type == "edit") { ?>
            <input type="hidden" name="examId" class="rowID" value="<?php echo $previous_info->EXAM_ID; ?>" />
        <?php } ?>
        <span class="frmMsg"></span>

        <div class="form-group">
            <label class="col-lg-3 control-label">Exam Type<span class="text-danger">*</span></label>

            <div class="col-lg-4">
                <select name="EX_TYPE_ID" id="EX_TYPE_ID" class="form-control">
                    <option>-Select-</option>
                    <?php foreach ($exam_type as $row): ?>
                        <option
                            value="<?php echo $row->EX_TYPE_ID ?>" <?php if (!empty($previous_info->EX_TYPE_ID)) echo ($row->EX_TYPE_ID == $previous_info->EX_TYPE_ID) ? 'selected' : '' ?>><?php echo $row->EX_TYPE_NAME ?></option>
                    <?php endforeach; ?>
                </select>
                <span class="help-block m-b-none ">e.g. Final Exam.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Exam Name<span class="text-danger">*</span></label>

            <div class="col-lg-8">
                <input type="text" id="EX_TITLE" name="EX_TITLE"
                       value="<?php echo ($ac_type == "edit") ? $previous_info->EX_TITLE : '' ?>"
                       class="form-control required" placeholder="Enter Exam Name">

                <span class="validation"></span>
                <span class="help-block m-b-none ">e.g. Final Exam.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label"><span>Description</span></label>

            <div class="col-lg-8">
                <textarea class="form-control"
                          name="EX_DESC"><?php echo ($ac_type == "edit") ? $previous_info->EX_DESC : ''; ?></textarea>
                <span class="validation"></span>
                <span class="help-block m-b-none">e.g. Final Exam Description here.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Start Date<span class="text-danger">*</span></label>

            <div class="col-lg-3">
                <div id="data_1">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="EX_DT_FROM" class="form-control required"
                               value="<?php echo ($ac_type == "edit") ? date('d/m/Y', strtotime($previous_info->EX_DT_FROM)) : '' ?>">
                    </div>
                </div>
                <span class="validation"></span>
                <span class="help-block m-b-none ">e.g.  2/10/2015</span>
            </div>
            <label class="col-lg-2 control-label">End Date<span class="text-danger">*</span></label>

            <div class="col-lg-3">
                <div id="data_2">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="EX_DT_TO" class="form-control required"
                               value="<?php echo ($ac_type == "edit") ? date('d/m/Y', strtotime($previous_info->EX_DT_TO)) : '' ?>">
                    </div>
                </div>
                <span class="validation"></span>
                <span class="help-block m-b-none ">e.g.  05/10/2015</span>
            </div>
        </div>


        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label"><span>Session</span></label>

            <div class="col-lg-4">
                <select class="form-control" name="SESSION_ID">
                    <option value="">-Select-</option>
                    <?php foreach ($session as $row): ?>
                        <option
                            value="<?php echo $row->SESSION_ID ?>" <?php if ($ac_type == "edit") echo ($previous_info->SESSION_ID == $row->SESSION_ID) ? 'selected' : '' ?>><?php echo $row->SESSION_NAME ?></option>
                    <?php endforeach; ?>
                </select>
                <span class="validation"></span>
                <span class="help-block m-b-none">e.g. Final Exam Description here.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <label class="col-lg-6 control-label"><span>Select multiple program :</span></label>

        <div class="form-group">

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-xs-5">
                        <label>All Program</label>
                        <select name="from[]" id="search" class="form-control" size="8" multiple="multiple">
                            <?php foreach ($program as $row): ?>
                                <option value="<?php echo $row->PROGRAM_ID ?>"><?php echo $row->PROGRAM_NAME ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-xs-2">
                        <label> </label>
                        <button type="button" id="search_rightAll" class="btn btn-block"><i
                                class="glyphicon glyphicon-forward"></i></button>
                        <button type="button" id="search_rightSelected" class="btn btn-block"><i
                                class="glyphicon glyphicon-chevron-right"></i></button>
                        <button type="button" id="search_leftSelected" class="btn btn-block"><i
                                class="glyphicon glyphicon-chevron-left"></i></button>
                        <button type="button" id="search_leftAll" class="btn btn-block"><i
                                class="glyphicon glyphicon-backward"></i></button>
                    </div>

                    <div class="col-xs-5">
                        <label>Selected Program</label>
                        <select name="PROGRAM_ID[]" id="search_to" class="form-control" size="8" multiple="multiple">
                            <?php if ($ac_type == "edit")
                                $previous_program = $this->db->query("select a.PROGRAM_ID, b.PROGRAM_NAME from exam_programs a
                                            left join program b on a.PROGRAM_ID = b.PROGRAM_ID
                                            where a.EXAM_ID=$previous_info->EXAM_ID")->result();
                            foreach ($previous_program as $row): ?>
                                <option value="<?php echo $row->PROGRAM_ID ?>" selected><?php echo $row->PROGRAM_NAME ?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-3 control-label">Active?</label>

            <div class="col-lg-8">
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
                <span class="help-block m-b-none">click for active status.</span>
            </div>
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <div class="col-lg-offset-3 col-lg-10">
            <!--<span class="modal_msg pull-left"></span>-->
            <?php if ($ac_type == "edit") { ?>
                <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="Coe/updateExam"
                       data-su-action="Coe/examById" value="Update">
            <?php } else { ?>
                <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="Coe/createExam"
                       data-su-action="Coe/examList" data-type="list" value="Submit">
            <?php
            }
            ?>
            <input type="reset" class="btn btn-default btn-sm" value="Reset">
            <span class="loadingImg"></span>
        </div>
    </div>
</form>

<!-- Data picker -->
<script src="<?php echo base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/js/multiselect.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.checkBoxStatus', function () {
            var status = ($(this).is(':checked')) ? 1 : 0;
            $("#status").val(status);
        });
        /* start Previous Date Disable in calendar*/
        var nowDate = new Date();
        var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
        $('#data_1 .input-group.date').datepicker({
            startDate: today
        });
        $('#data_2 .input-group.date').datepicker({
            startDate: today
        });
        /*End Previous Date Disable in calendar*/

        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
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
        $('#search').multiselect({
            search: {
                left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
                right: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
            }
        });

    });
</script>
