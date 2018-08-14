<style>
    .select2-container {
        z-index: 999999;
    }
</style>
<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<form class="form-horizontal frmContent" id="grade" method="post">
    <div class="block-flat">
        <?php if ($ac_type =='edit') { ?>
            <input type="hidden" name="ERP_ID" class="rowID" value="<?php echo $previous_info->ERP_ID; ?>"/>
        <?php } ?>
        <span class="frmMsg"></span>

        <div class="form-group">
            <label class="col-lg-3 control-label">Exam</label>

            <div class="col-lg-8">

                    <select class="select2Dropdown form-control required" name="EXAM_ID" id="EXAM_ID"
                            data-tags="true" data-placeholder="Select Exam" data-allow-clear="true">
                        <option value="">Select Degree</option>
                        <?php foreach ($exam as $row): ?>
                            <option
                                value="<?php echo $row->EXAM_ID; ?>" <?php if(!empty($previous_info->EXAM_ID)) echo ($previous_info->EXAM_ID == $row->EXAM_ID)?'selected':''; ?>><?php echo $row->EX_TITLE; ?></option>
                        <?php endforeach; ?>
                    </select>

                <span class="validation"></span>
                <span class="help-block m-b-none ">e.g. Graduate Program.</span>
            </div>
        </div>


        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Start Date<span class="text-danger">*</span></label>

            <div class="col-lg-3">
                <div id="data_1">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="ERP_DT_FROM" class="form-control "
                               value="<?php echo ($ac_type == "edit") ? date('d/m/Y', strtotime($previous_info->ERP_DT_FROM)) : '' ?>">
                    </div>
                </div>
                <span class="validation"></span>

            </div>
            <label class="col-lg-2 control-label">End Date<span class="text-danger">*</span></label>

            <div class="col-lg-3">
                <div id="data_2">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="ERP_DT_TO" class="form-control required"
                               value="<?php echo ($ac_type == "edit") ? date('d/m/Y', strtotime($previous_info->ERP_DT_TO)) : '' ?>">
                    </div>
                </div>
                <span class="validation"></span>

            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-3 control-label">Active?</label>

            <div class="col-lg-8">
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
                <span class="help-block m-b-none">click for active status.</span>
            </div>
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <div class="col-lg-offset-3 col-lg-10">
            <!--<span class="modal_msg pull-left"></span>-->
            <?php if ($ac_type == 'edit') { ?>
                <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="Coe/updateExRgPeriod"
                       data-su-action="Coe/exRgPeriodById" value="Update">
            <?php } else { ?>
                <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="Coe/createExRgPeriod"
                       data-su-action="Coe/exRgPeriodList" data-type="list" value="Submit">
            <?php
            }
            ?>
            <input type="reset" class="btn btn-default btn-sm" value="Reset">
            <span class="loadingImg"></span>
        </div>
    </div>
</form>

<script src="<?php echo base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
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
        /*End Previous Date Disable in calendar*/

        $(document).on('click', '.checkBoxStatus', function () {
            var status = ($(this).is(':checked')) ? 1 : 0;
            $("#status").val(status);

        });
    });
</script>
