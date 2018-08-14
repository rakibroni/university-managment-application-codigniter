<div class="block-flat">

    <form class="form-horizontal frmContent" id="session" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="txtSessionId" value="<?php echo $session->SESSION_ID ?>"/>
        <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group"><label class="col-lg-3 control-label">Session Name</label>

            <div class="col-lg-5">
                <input type="text" id="sessionName" name="sessionName"
                       value="<?php echo ($ac_type == 2) ? $session->SESSION_NAME : '' ?>" class="form-control required"
                       placeholder="Session Name">
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- Spring.</span>
            </div>
        </div>

        <div class="form-group"><label class="col-lg-3 control-label">User Define SL. No.<span class="text-danger">*</span></label>
            <div class="col-lg-3">
                <input type="text" id="UD_SLNO" name="UD_SLNO"
                       value="<?php echo ($ac_type == 2) ? $session->UD_SLNO : '' ?>" class="form-control required">

            </div>
        </div>




        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <span class="modal_msg pull-left"></span>
                <?php if ($ac_type == 2) { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateSession"
                           data-su-action="setup/sessionById" value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createSession"
                           data-su-action="setup/sessionList" data-type="list" value="submit">
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
    $(document).on('click', '.checkBoxisCurrent', function () {
        var Current = ($(this).is(':checked') ) ? 1 : 0;
        $("#isCurrent").val(Current);
    });
    $(document).on('click', '.checkBoxIsAdmission', function () {
        var Admission = ($(this).is(':checked') ) ? 1 : 0;
        $("#isAdmission").val(Admission);
    });
    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });
</script>