<div class="block-flat">
    <form class="form-horizontal frmContent" id="emailTemp" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="txtemailTemId" value="<?php echo $email_template->EMAIL_TEMPLATE_ID ?>"/>
            <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group"><label class="col-lg-3 control-label">Email Subject<span
            class="text-danger">*</span></label>

            <div class="col-lg-8">
                <input type="text" id="emailSubName" name="emailSubName"
                value="<?php echo ($ac_type == 2) ? $email_template->EMAIL_SUBJECT : '' ?>" class="form-control required"
                placeholder="Enter Email Subject Name">
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-3 control-label">Email Body<span
            class="text-danger">*</span></label>

            <div class="col-lg-8">
              <textarea class="col-md-12 redactor required"
              name="emailBody"><?php echo ($ac_type == 2) ? $email_template->EMAIL_BODY : ''; ?></textarea>
              <span class="validation"></span>
          </div>
      </div>
        <div class="hr-line-dashed"></div>
      <div class="form-group"><label class="col-lg-3 control-label">Active?</label>

        <div class="col-lg-8">
            <?php
            $ACTIVE_STATUS = ($ac_type == 2) ? $email_template->ACTIVE_STATUS : '';
            $checked = ($ac_type == 2) ? (($email_template->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
            <span class="help-block m-b-none">Example click checkbox .</span>
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <div class="col-lg-offset-3 col-lg-10">
            <span class="modal_msg pull-left"></span>
            <?php if ($ac_type == 2) { ?>
            <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateEmailTemplate"
            data-su-action="setup/emailTemplateById" value="Update">
            <?php } else { ?>
            <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createEmailTemplate"
            data-su-action="setup/emailTemplateList" data-type="list" value="submit">
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
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });
</script>
