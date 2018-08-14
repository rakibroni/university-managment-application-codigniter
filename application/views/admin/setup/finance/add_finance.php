<div class="block-flat">
    <form class="form-horizontal frmContent" id="charge" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="txtchargeId" value="<?php echo $charge->CHARGE_ID ?>"/>
            <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group"><label class="col-lg-4 control-label">Charge Name<span
                        class="text-danger">*</span></label>

            <div class="col-lg-6">
                <input type="text" id="chargeName" name="chargeName"
                       value="<?php echo ($ac_type == 2) ? $charge->CHARGE_NAME : '' ?>" class="form-control required"
                       placeholder="Enter charge Name">
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- Admission Fee </span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-4 control-label">Application Fee?</label>

            <div class="col-lg-6">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $charge->IS_APP_FEE : '';
                $checked = ($ac_type == 2) ? (($charge->IS_APP_FEE == '1') ? TRUE : FALSE) : '';
                ?>
                <label class="control-label">
                    <?php
                    $data = array(
                        'name' => 'app_fee',
                        'id' => 'app_fee',
                        'class' => 'checkBoxStatus',
                        'value' => $ACTIVE_STATUS,
                        'checked' => $checked,
                    );
                    echo form_checkbox($data);
                    ?>
                </label>
                <!-- <span class="help-block m-b-none">Example click checkbox .</span> -->
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group"><label class="col-lg-4 control-label">Tuition Fee?</label>

            <div class="col-lg-6">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $charge->IS_TUTOIN_FEE : '';
                $checked = ($ac_type == 2) ? (($charge->IS_TUTOIN_FEE == '1') ? TRUE : FALSE) : '';
                ?>
                <label class="control-label">
                    <?php
                    $data = array(
                        'name' => 'tution_fee',
                        'id' => 'tution_fee',
                        'class' => 'checkBoxStatus',
                        'value' => $ACTIVE_STATUS,
                        'checked' => $checked,
                    );
                    echo form_checkbox($data);
                    ?>
                </label>
                <!-- <span class="help-block m-b-none">Example click checkbox .</span> -->
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-4 control-label">Active?</label>

            <div class="col-lg-6">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $charge->ACTIVE_STATUS : '';
                $checked = ($ac_type == 2) ? (($charge->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
        <div class="form-group">
            <div class="col-lg-offset-4 col-lg-8">
                <span class="modal_msg pull-left"></span>
                <?php if ($ac_type == 2) { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="finance/updateFinance"
                           data-su-action="finance/financeById" value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="finance/createFinance"
                           data-su-action="finance/financeList" data-type="list" value="submit">
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
    $(document).on('click', '#tution_fee', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#tution_fee").val(status);
    });

    $(document).on('click', '#app_fee', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#app_fee").val(status);
    });

    $(document).on('click', '#status', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });
</script>