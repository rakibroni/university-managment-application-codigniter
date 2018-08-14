<div class="block-flat">
    <form class="form-horizontal frmContent" id="district" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="POLICY_ID" value="<?php echo $app_policy->POLICY_ID ?>"/>
        <?php
        }
        ?>
        <span class="frmMsg"></span>
        <div class="form-group">
            <label class="col-lg-3 control-label">Policy Name<span style="color: red"> *</span></label>
            <div class="col-lg-7">
                <input type="text" id="POLICY_NAME" name="POLICY_NAME" value="<?php echo ($ac_type == 2) ? $app_policy->POLICY_NAME : '' ?>" class="form-control required" placeholder="Enter app policy name">
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Policy Description<span style="color: red"> *</span></label>
            <div class="col-lg-7">
                <input type="text" id="POLICY_DESC" name="POLICY_DESC" value="<?php echo ($ac_type == 2) ? $app_policy->POLICY_DESC : '' ?>" class="form-control required" placeholder="Enter app policy description">
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-3 control-label">Policy Flag</label>
            <div class="col-lg-7">
                <?php
                $POLICY_FLAG = ($ac_type == 2) ? $app_policy->POLICY_FLAG : '';
                $checked = ($ac_type == 2) ? (($app_policy->POLICY_FLAG == '1') ? TRUE : FALSE) : '';
                ?>
                <label class="control-label">
                    <?php
                    $data = array(
                        'name' => 'POLICY_FLAG',
                        'id' => 'POLICY_FLAG',
                        'class' => '',
                        'value' => $POLICY_FLAG,
                        'checked' => $checked,
                    );
                    echo form_checkbox($data);
                    ?>
                </label>
                <span class="help-block m-b-none">Example click checkbox .</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-3 control-label">Active?</label>
            <div class="col-lg-7">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $app_policy->ACTIVE_FLAG : '';
                $checked = ($ac_type == 2) ? (($app_policy->ACTIVE_FLAG == '1') ? TRUE : FALSE) : '';
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
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateAppPolicy" data-su-action="setup/appPolicyById" value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createAppPolicy" data-su-action="setup/appPolicyList" data-type="list" value="submit">
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
    $(document).on('click', '#POLICY_FLAG', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#POLICY_FLAG").val(status);
    });
</script>