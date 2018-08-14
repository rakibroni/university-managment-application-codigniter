<link href="<?php echo base_url(); ?>assets/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<style>
    .datepicker.dropdown-menu {
        z-index: 9999 !important;
    }
</style>

<form class="form-horizontal frmContent" id="gradePolicy" method="post">
    <div class="block-flat">
        <?php if ($ac_type == 2) { ?>
            <input type="hidden" name="gradePolicyId" class="rowID" value="<?php echo $gradePolicy->GR_POLICY_ID; ?>"/>
        <?php } ?>
        <span class="frmMsg"></span>

        <div class="form-group">
            <label class="col-lg-3 control-label">Policy Name</label>

            <div class="col-lg-8">
                <input type="text" id="policyName" name="policyName"
                       value="<?php echo ($ac_type == 2) ? $gradePolicy->GR_POLICY_NAME : '' ?>"
                       class="form-control required" placeholder="Enter Policy Name">
                <span class="validation"></span>
                <span class="help-block m-b-none ">e.g. Exam Administration .</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label"><span>Description</span></label>

            <div class="col-lg-8">
                <textarea class="redactor"
                          name="description"><?php echo ($ac_type == 2) ? $gradePolicy->GR_POLICY_DESC : ''; ?></textarea>
                <span class="validation"></span>
                <span class="help-block m-b-none">e.g. Exam Administration here.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-3 control-label">Start Date</label>

            <div class="col-lg-3">
                <div id="data_1">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text"
                                                                                                    name="START_DATE"
                                                                                                    class="form-control"
                                                                                                    value="<?php echo ($ac_type == 2) ? date('d/m/Y', strtotime($gradePolicy->START_DATE)) : '' ?>">
                    </div>
                </div>
                <span class="help-block m-b-none ">e.g.  2/10/2015</span>
            </div>
            <label class="col-lg-2 control-label">End Date</label>

            <div class="col-lg-3">
                <div id="data_2">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text"
                                                                                                    name="END_DATE"
                                                                                                    class="form-control"
                                                                                                    value="<?php echo ($ac_type == 2) ? date('d/m/Y', strtotime($gradePolicy->END_DATE)) : '' ?>">
                    </div>
                </div>
                <span class="help-block m-b-none ">e.g.  05/10/2015</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-3 control-label">Active?</label>

            <div class="col-lg-8">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $gradePolicy->ACTIVE_STATUS : '';
                $checked = ($ac_type == 2) ? (($gradePolicy->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
            <?php if ($ac_type == 2) { ?>
                <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="Coe/updateGradePolicy"
                       data-su-action="Coe/gradePolicyById" value="Update">
            <?php } else { ?>
                <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="Coe/createGradePolicy"
                       data-su-action="Coe/gradePolicyList" data-type="list" value="Submit">
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

<!-- Clock picker -->
<script src="<?php echo base_url(); ?>assets/js/plugins/clockpicker/clockpicker.js"></script>
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
    });
</script>
