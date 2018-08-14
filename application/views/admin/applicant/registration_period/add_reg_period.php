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
            <input type="hidden" name="regPeriodId" class="rowID"
                   value="<?php echo $previous_info->ARP_ID; ?>"/>
        <?php } ?>
        <span class="frmMsg"></span>        
        <div class="form-group">
            <label class="col-lg-2 control-label">Title<span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <input type="text" id="title" name="title"
                       value="<?php echo ($ac_type == 'edit') ? $previous_info->ARP_TITLE : '' ?>"
                       class="form-control required" placeholder="Enter Registration Period Title">
                <span class="validation"></span>
                <span class="help-block m-b-none ">e.g. Fall Admission Period- 2016.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-2 control-label"><span>Description</span></label>
            <div class="col-lg-5">
                <textarea class="redactor"
                          name="description"><?php echo ($ac_type == 'edit') ? $previous_info->ARP_DESC : ''; ?></textarea>
                <span class="validation"></span>
                <span class="help-block m-b-none">e.g. Fall Admission Period- 2016 description text here.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-2 control-label">From Date<span class="text-danger">*</span></label>
            <div class="col-lg-2">
                <div id="data_1">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="startDate" class="form-control required" value="<?php echo ($ac_type == 'edit') ? date('d/m/Y', strtotime($previous_info->REG_PERIOD_DT_FROM)) : $current_date ?>">
                    </div>
                </div>
                <span class="help-block m-b-none ">e.g.  2/10/2015</span>
            </div>
            <label class="col-lg-2 control-label">To Date<span class="text-danger">*</span></label>
            <div class="col-lg-2">
                <div id="data_1">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="endDate" class="form-control required" value="<?php echo ($ac_type == 'edit') ? date('d/m/Y', strtotime($previous_info->REG_PERIOD_DT_TO)) : $current_date ?>">
                    </div>
                </div>
                <span class="help-block m-b-none ">e.g.  05/10/2015</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-2 control-label">Faculty<span class="text-danger">*</span></label>
            <div class="col-lg-4">
                <select class="form-control" name="FACULTY_ID" id="FACULTY_ID">
                    <option value="">-Select-</option>
                    <?php foreach ($faculty as $row): ?>
                        <option
                            value="<?php echo $row->FACULTY_ID ?>" <?php if ($ac_type == "edit") echo ($previous_info->FACULTY_ID == $row->FACULTY_ID) ? 'selected' : '' ?>><?php echo $row->FACULTY_NAME ?></option>
                    <?php endforeach; ?>
                </select>
                <span class="validation"></span>
                <span class="help-block m-b-none">e.g. Selech Faculty.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <label class="col-lg-6 control-label"><span>Select multiple program :</span></label>
        <div class="form-group">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-xs-5" style="margin-left:20px;">
                        <label>All Program</label>
                        <select name="from[]" id="search" class="form-control" size="8" multiple="multiple" >   
                            <?php if ($ac_type == "edit"){ ?>  
                                <?php 
                                    foreach ($program as $row):
                                        if ($row->FACULTY_ID == $previous_info->FACULTY_ID):
                                            ?>
                                            <option value="<?php echo $row->PROGRAM_ID ?>" <?php echo ($previous_info->PROGRAM_ID == $row->PROGRAM_ID) ? 'selected' : '' ?>><?php echo $row->PROGRAM_NAME ?></option>
                                        <?php
                                        endif;
                                    endforeach;
                                ?>
                            <?php } ?>                 
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
                    <div class="col-xs-4" >
                        <label>Selected Program</label>
                        <select name="PROGRAM_ID[]" id="search_to" class="form-control" size="8" multiple="multiple">
                            <?php if ($ac_type == "edit"){
                                $previous_program = $this->db->query("select a.PROGRAM_ID, b.PROGRAM_NAME from adm_passed_app_reg_period a
                                            left join program b on a.PROGRAM_ID = b.PROGRAM_ID
                                            where a.ARP_ID = $previous_info->ARP_ID")->result();
                                foreach ($previous_program as $row): ?>
                                <option value="<?php echo $row->PROGRAM_ID ?>" selected><?php echo $row->PROGRAM_NAME ?></option>
                                <?php endforeach; ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-3 control-label">Active?</label>
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
        <div class="col-lg-offset-2 col-lg-10">
            <input type="hidden" name ="SESSION_ID" value="<?php echo $session->SESSION_ID ?>">
            <!--<span class="modal_msg pull-left"></span>-->
            <?php if ($ac_type == "edit") { ?>
                <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateApplicantRegPeriod"
                       data-su-action="setup/applicantRegPeriodById" value="Update">
            <?php } else { ?>
                <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createApplicantRegPeriod"
                       data-su-action="setup/applicantRegPeriodList" data-type="list" value="Submit">
            <?php
            }
            ?>
            <input type="reset" class="btn btn-default btn-sm" value="Reset">
            <span class="loadingImg"></span>
        </div>
    </div>
</form>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/redactor/redactor.css"/>
<script src="<?php echo base_url(); ?>assets/redactor/redactor.min.js"></script>
<!-- Data picker -->
<script src="<?php echo base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/js/multiselect.min.js"></script>
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

        $('#search').multiselect({
            search: {
                left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
                right: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
            }
        });

        $('#FACULTY_ID').change(function () {
            var faculty = $(this).val();
            var dept_url = '<?php echo site_url('setup/programByFaculty') ?>';
            $.ajax({
                type: "POST",
                url: dept_url,
                data: {faculty: faculty},
                success: function (data) {
                    $('#search').html(data);
                }
            });
        });

    });

</script>

