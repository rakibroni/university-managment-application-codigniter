<div class="block-flat">
    <form class="form-horizontal frmContent" id="eventType" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" name="eventTypeId" class="rowID" value="<?php echo $eventType->E_TYPE_ID; ?>"/>
        <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div>
            <?php
            //var_dump($eventType); exit;
            ?>
        </div>
        <div class="form-group"><label class="col-lg-3 control-label">Event Type<span
                    class="text-danger">*</span></label>

            <div class="col-lg-8">
                <input type="text" id="eventName" name="eventType"
                       value="<?php echo ($ac_type == 2) ? $eventType->E_TYPE_NAME : '' ?>"
                       class="form-control required" placeholder="Enter Event Type">
                <span class="validation"></span>
                <span class="help-block m-b-none ">Example:- event type name here.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label"><span>Description</span></label>

            <div class="col-lg-8">
                <textarea class="redactor"
                          name="content"><?php echo ($ac_type == 2) ? $eventType->E_DESC : ''; ?></textarea>
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- event description.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-3 control-label">Active?</label>

            <div class="col-lg-8">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $eventType->ACTIVE_STATUS : '';
                $checked = ($ac_type == 2) ? (($eventType->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
            <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateEventType"
                   data-su-action="setup/eventTypeById" value="Update">
        <?php } else { ?>
            <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createEventType"
                   data-su-action="setup/eventTypeList" data-type="list" value="Submit">
        <?php
        }
        ?>
        <input type="reset" class="btn btn-default btn-sm" value="Reset">
        <span class="loadingImg"></span>
    </div>
</div>
</form>
</div>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/redactor/redactor.css"/>
<script src="<?php echo base_url(); ?>assets/redactor/redactor.min.js"></script>
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
