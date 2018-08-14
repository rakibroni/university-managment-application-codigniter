<div class="block-flat">
    <form class="form-horizontal frmContent" id="district" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="BANK_ID" value="<?php echo $bank->BANK_ID ?>"/>
        <?php
        }
        ?>
        <span class="frmMsg"></span>
        <div class="form-group">
            <label class="col-lg-3 control-label">Bank Name<span style="color: red"> *</span></label>
            <div class="col-lg-7">
                <input type="text" id="BANK_NAME" name="BANK_NAME" value="<?php echo ($ac_type == 2) ? $bank->BANK_NAME : '' ?>" class="form-control required" placeholder="Enter Bank Name">
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- DBBL.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Bank Address<span style="color: red"> *</span></label>
            <div class="col-lg-7">
                <input type="text" id="ADDRESS" name="ADDRESS" value="<?php echo ($ac_type == 2) ? $bank->ADDRESS : '' ?>" class="form-control required" placeholder="Enter Bank address">
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- </span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-3 control-label">Active?</label>
            <div class="col-lg-7">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $bank->ACTIVE_STATUS : '';
                $checked = ($ac_type == 2) ? (($bank->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
            <div class="col-lg-offset-2 col-lg-10">
                <span class="modal_msg pull-left"></span>
                <?php if ($ac_type == 2) { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateBank" data-su-action="setup/bankById" value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createBank" data-su-action="setup/bankList" data-type="list" value="submit">
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