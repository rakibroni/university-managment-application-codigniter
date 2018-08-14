<div class="block-flat">
    <form class="form-horizontal frmContent" id="event" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" name="txtEventId" class="rowID" value="<?php echo $event->EVENT_ID; ?>"/>
        <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group"><label class="col-lg-2 control-label">Event Name</label>

            <div class="col-lg-10">
                <input type="text" id="eventName" name="eventName"
                       value="<?php echo ($ac_type == 2) ? $event->EVENT_TITLE : '' ?>" class="form-control required"
                       placeholder="Enter Event Name">
                <span class="validation"></span>
                <span class="help-block m-b-none ">Example:- Event text here.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-2 control-label">Active?</label>

            <div class="col-lg-10">
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
                    echo form_checkbox($data); ?>
                </label>
                <span class="help-block m-b-none">Example click checkbox .</span>
            </div>
        </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
        <!--<span class="modal_msg pull-left"></span>-->
        <?php if ($ac_type == 2) { ?>
            <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="admin/updateEvent"
                   data-su-action="setup/facultyById" value="Update">
        <?php } else { ?>
            <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="admin/createEvent"
                   data-su-action="setup/facultyList" data-type="list" value="Submit">
        <?php
        }
        ?>
        <input type="reset" class="btn btn-default btn-sm" value="Reset">
        <span class="loadingImg"></span>
    </div>
</div>
</form>
</div>
<script>
    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });
</script>