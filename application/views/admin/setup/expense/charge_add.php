<div class="block-flat">
    <form class="form-horizontal frmContent" id="charge" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="CHARGE_ID" id="CHARGE_ID"
                   value="<?php echo $charges->CHARGE_ID; ?>"/>
        <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group">
            <label class="col-sm-3 control-label">Charge Name <span style="color: red">*</span></label>

            <div class="col-sm-7">
                <input type="text" id="CHARGE_NAME" name="CHARGE_NAME" class="form-control required"
                       value="<?php echo ($ac_type == 2) ? $charges->CHARGE_NAME : ''; ?>"
                       placeholder="eg. Admission Fee"/>
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- Admission Fee, Lab Fee etc.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Application Fee</label>

            <div class="col-lg-9">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $charges->IS_APP_FEE : '';
                $checked = ($ac_type == 2) ? (($charges->IS_APP_FEE == '1') ? TRUE : FALSE) : '';
                ?>
                <label class="control-label">
                    <?php
                    $data = array(
                        'name' => 'IS_APP_FEE',
                        'id' => 'IS_APP_FEE',
                        'class' => 'checkBoxStatus',
                        'value' => $ACTIVE_STATUS,
                        'checked' => $checked,
                    );
                    echo form_checkbox($data);
                    ?>
                </label>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Tuition Fee</label>

            <div class="col-lg-9">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $charges->IS_TUTOIN_FEE : '';
                $checked = ($ac_type == 2) ? (($charges->IS_TUTOIN_FEE == '1') ? TRUE : FALSE) : '';
                ?>
                <label class="control-label">
                    <?php
                    $data = array(
                        'name' => 'IS_TUTOIN_FEE',
                        'id' => 'IS_TUTOIN_FEE',
                        'class' => 'checkBoxStatus',
                        'value' => $ACTIVE_STATUS,
                        'checked' => $checked,
                    );
                    echo form_checkbox($data);
                    ?>
                </label>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Redundant</label>

            <div class="col-lg-9">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $charges->REDUNDENT : '';
                $checked = ($ac_type == 2) ? (($charges->REDUNDENT == '1') ? TRUE : FALSE) : '';
                ?>
                <label class="control-label">
                    <?php
                    $data = array(
                        'name' => 'REDUNDENT',
                        'id' => 'REDUNDENT',
                        'class' => 'checkBoxStatus',
                        'value' => $ACTIVE_STATUS,
                        'checked' => $checked,
                    );
                    echo form_checkbox($data);
                    ?>
                </label>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-9">
                <span class="modal_msg pull-left"></span>
                <?php
                if ($ac_type == 2) {
                    ?>
                    <span class="btn btn-primary btn-sm formSubmit" data-action="setup/updateCharge"
                          data-su-action="setup/chargeById">Update</span>
                <?php } else {
                    ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createCharge"
                           data-su-action="setup/getCharge" data-type="list" value="submit">
                <?php }
                ?>
                <input type="reset" class="btn btn-default btn-sm" value="Reset">
                <span class="loadingImg"></span>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).on('click', '.checkBoxStatus', function () {
        var IS_APP_FEE = ($(this).is(':checked')) ? 1 : 0;
        $("#IS_APP_FEE").val(IS_APP_FEE);
    });
</script>
<script>
    $(document).on('click', '.checkBoxStatus', function () {
        var IS_TUTOIN_FEE = ($(this).is(':checked')) ? 1 : 0;
        $("#IS_TUTOIN_FEE").val(IS_TUTOIN_FEE);
    });
</script>
<script>
    $(document).on('click', '.checkBoxStatus', function () {
        var REDUNDENT = ($(this).is(':checked')) ? 1 : 0;
        $("#REDUNDENT").val(REDUNDENT);
    });
</script>