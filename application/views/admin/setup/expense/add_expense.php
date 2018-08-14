<div class="block-flat">
    <form class="form-horizontal frmContent" id="expense" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="RATE_ID" id="RATE_ID" value="<?php echo $expenses->RATE_ID; ?>"/>
        <?php
        }
        ?>
        <span class="frmMsg"></span>
        <?php //$this->load->view("common/faculty_dept_program"); ?>
        <div class="form-group">
            <label class="col-sm-3 control-label">Faculty <span style="color: red">*</span></label>

            <div class="col-sm-7">
                <?php echo form_dropdown("FACULTY_ID", $faculty, ($ac_type == 2) ? $expenses->FACULTY_ID : '', "class='form-control required' id='cmbFaculty'") ?>
                <span class="validation"></span>
                <span class="help-block m-b-none">Example: School of Science and Engineering</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Department <span style="color: red">*</span></label>

            <div class="col-sm-7">
                <?php if ($ac_type == 2) { ?>
                    <?php echo form_dropdown("DEPT_ID", $department, ($ac_type == 2) ? $expenses->DEPT_ID : '', "class='form-control required' id='department'") ?>
                <?php } else { ?>
                    <select class="form-control required" name="DEPT_ID" id="department" required="required">
                        <option value="">Select Department</option>
                    </select>
                <?php } ?>
                <span class="validation"></span>
                <span class="help-block m-b-none">Example: Computer Science & Engineering</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Program <span style="color: red">*</span></label>

            <div class="col-sm-7">
                <?php if ($ac_type == 2) { ?>
                    <?php echo form_dropdown("PROGRAM_ID", $program, ($ac_type == 2) ? $expenses->PROGRAM_ID : '', "class='form-control required' id='program'") ?>
                <?php } else { ?>
                    <select class="form-control required" name="PROGRAM_ID" id="program" required="required">
                        <option value="">Select Program</option>
                    </select>
                <?php } ?>

                <span class="validation"></span>
                <span class="help-block m-b-none">Example: B.Sc. in Computer Science & Engineering (CSE)</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Semester<span class="text-danger">*</span></label>

            <div class="col-sm-7">
                <!-- <select class="select2Dropdown form-control" name="SEMESTER_ID" id="SEMESTER_ID" data-tags="true" data-placeholder="Select Semester" data-allow-clear="true">
                    <option>Select Semester</option>
                    <?php //foreach ($semester as $row): ?>
                        <option value="<?php //echo $row->LKP_ID ?>"><?php //echo $row->LKP_NAME ?></option>
                    <?php //endforeach; ?>
                </select> -->
                <?php echo form_dropdown("SEMESTER_ID", $semester, ($ac_type == 2) ? $expenses->SEMISTER_ID : '', "class='form-control required' id='SEMESTER_ID'") ?>
                <span class="validation"></span>
                <span class="help-block m-b-none">e.g. 1st Semester </span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Charge Name <span class="text-danger">*</span></label>

            <div class="col-sm-7">
                <?php echo form_dropdown("CHARGE_NAME", $charge, ($ac_type == 2) ? $expenses->CHARGE_ID : '', "class='form-control required' id='CHARGE_NAME'") ?>
                <span class="validation"></span>
                <span class="help-block m-b-none">Example: Admission Fee, Lab Fee etc.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Amount (BDT)<span class="text-danger">*</span></label>

            <div class="col-sm-2">
                <input type="text" id="AMOUNT" name="AMOUNT" class="form-control required"
                       value="<?php echo ($ac_type == 2) ? $expenses->AMOUNT : ''; ?>" placeholder="eg. 5,000.00"/>
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Start Date <span class="text-danger">*</span></label>

            <div class="col-sm-4">
                <div id="data_1">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="START_DATE"
                               value="<?php echo ($ac_type == 2) ? date('d/m/Y', strtotime($expenses->START_DATE)) : ''; ?>"
                               class="form-control required" placeholder="eg. 06/10/2015"/>
                    </div>
                </div>
                <span class="validation"></span>
                <span class="help-block m-b-none">Example: 17/11/2015</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-3 control-label">End Date <span class="text-danger">*</span></label>

            <div class="col-sm-4">
                <div id="data_1">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="END_DATE"
                               value="<?php echo ($ac_type == 2) ? date('d/m/Y', strtotime($expenses->END_DATE)) : ''; ?>"
                               class="form-control required" placeholder="eg. 06/10/2015"/>
                    </div>
                </div>
                <span class="validation"></span>
                <span class="help-block m-b-none">Example: 17/11/2015</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-9">
                <span class="modal_msg pull-left"></span>
                <?php
                if ($ac_type == 2) {
                    ?>
                    <span class="btn btn-primary btn-sm formSubmit" data-action="setup/expenseUpdate"
                          data-su-action="setup/expanseById">Update</span>
                <?php } else {
                    ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/expenseCreate"
                           data-su-action="setup/getExpense" data-type="list" value="submit">
                <?php }
                ?>
                <input type="reset" class="btn btn-default btn-sm" value="Reset">
                <span class="loadingImg"></span>
            </div>
        </div>
    </form>
</div>

<!-- Data picker -->
<script src="<?php echo base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

<script>
    $(document).ready(function () {
        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('change', '#cmbFaculty', function (event) {
            event.preventDefault();
            var selectedValue = $(this).val();
            var url = '<?php echo site_url('course/ajax_get_department') ?>';
            $.ajax({
                type: "POST",
                url: url,
                data: {selectedValue: selectedValue},
                dataType: 'html',
                success: function (data) {
                    $('#department').html(data);
                }
            });
        });
        $(document).on('change', '#department', function (event) {
            var selectedValue = $(this).val();
            var url = '<?php echo site_url('course/ajax_get_program') ?>';
            $.ajax({
                type: "POST",
                url: url,
                data: {selectedValue: selectedValue},
                dataType: 'html',
                success: function (data) {

                    $('#program').html(data);
                }
            });
        });
    });
</script>
