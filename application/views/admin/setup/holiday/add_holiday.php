<link href="<?php echo base_url(); ?>assets/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<style>
    .datepicker.dropdown-menu {
        z-index: 9999 !important;
    }
</style>
<form class="form-horizontal frmContent" id="event" method="post">
    <div class="block-flat">
        <?php if ($ac_type == 2) { ?>
            <input type="hidden" name="eventId" class="rowID" value="<?php echo $event->EVENT_ID; ?>"/>
        <?php } ?>
        <span class="frmMsg"></span>

        <div>

        </div>
        <div class="form-group"><label class="col-lg-2 control-label">Type *</label>

            <div class="col-lg-4">
                <!--<input type="text" id ="eventName" name="eventName" value="<?php echo ($ac_type == 2) ? $event->EVENT_TITLE : '' ?>" class="form-control required" placeholder="Select Event Type">-->
                <?php //echo form_dropdown("cmbEvents", $eventType, ($ac_type == 2) ? $event->E_TYPE_ID : '', "class='form-control required' id='cmbEvents'") ?>
                <select class="form-control" name="cmbHoliday">
                    <option value="G">Government Holiday</option>
                    <option value="F">Festival holiday</option>
                    <option value="N">National holiday</option>
                </select>
                <span class="validation"></span>
                <span class="help-block m-b-none">e.g.  Select Holiday type.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-2 control-label">Title *</label>

            <div class="col-lg-6">
                <input type="text" id="eventName" name="holidayTitle"
                       value="<?php echo ($ac_type == 2) ? $event->E_TITLE : '' ?>" class="form-control required"
                       placeholder="Enter Holiday Name">
                <span class="validation"></span>
                <span class="help-block m-b-none ">e.g.  Weekend text here.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-2 control-label">Form *</label>

            <div class="col-lg-3">
                <div id="data_1">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text"
                                                                                                    name="fromDate"
                                                                                                    class="form-control required"
                                                                                                    value="<?php echo ($ac_type == 2) ? date('d/m/Y', strtotime($event->START_DT)) : '' ?>">
                        <span class="validation"></span>
                    </div>
                </div>
                <span class="help-block m-b-none ">e.g.  2/10/2015</span>
            </div>
            <label class="col-lg-2 control-label">TO *</label>

            <div class="col-lg-3">
                <div id="data_1">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text"
                                                                                                    name="toDate"
                                                                                                    class="form-control required"
                                                                                                    value="<?php echo ($ac_type == 2) ? date('d/m/Y', strtotime($event->END_DT)) : '' ?>">
                        <span class="validation"></span>
                    </div>
                </div>
                <span class="help-block m-b-none ">e.g.  05/10/2015</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-2 control-label"><span>Description</span></label>

            <div class="col-lg-9">
                <textarea class="redactor"
                          name="content"><?php echo ($ac_type == 2) ? $event->E_DESC : ''; ?></textarea>
                <span class="validation"></span>
                <span class="help-block m-b-none">e.g. Holiday description text here.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-2 control-label">Active?</label>

            <div class="col-lg-9">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $event->ACTIVE_STATUS : '';
                $checked = ($ac_type == 2) ? (($event->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
            <!--<span class="modal_msg pull-left"></span>-->
            <?php if ($ac_type == 2) { ?>
                <input type="button" class="btn btn-primary btn-sm formSubmitEvent" data-action="setup/updateEvent"
                       data-su-action="setup/eventById" value="Update">
            <?php } else { ?>
                <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createHoliday"
                       data-su-action="setup/holidayList" data-type="list" value="Submit">
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

<script type="text/javascript">
    $(document).ready(
        function () {
            $('.redactor').redactor();
        }
    );
</script>
<script>
    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked')) ? 1 : 0;
        $("#status").val(status);


        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });
    });
</script>
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