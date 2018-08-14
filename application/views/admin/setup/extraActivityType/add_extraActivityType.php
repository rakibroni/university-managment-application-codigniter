<div class="block-flat">
    <form class="form-horizontal frmContent" id="extraActivityType" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="txtExtraActivityType"
                   value="<?php echo $extraActivityType->ACTIVITY_TYPE_ID ?>"/>
        <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group"><label class="col-lg-4 control-label">Extra Activity Name<span
                    style="color: red"> *</span></label>

            <div class="col-lg-7">
                <input type="text" id="extraActivityTypeName" name="extraActivityTypeName"
                       value="<?php echo ($ac_type == 2) ? $extraActivityType->ACTIVITY_NAME : '' ?>"
                       class="form-control required" placeholder="Enter Extra Activity Name">
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:-Extra ActivityType Name(Drama).</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-4 control-label">Active?</label>

            <div class="col-lg-7">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $extraActivityType->ACTIVE_STATUS : '';
                $checked = ($ac_type == 2) ? (($extraActivityType->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
                    <input type="button" class="btn btn-primary btn-sm formSubmit"
                           data-action="setup/updateExtraActivityType" data-su-action="setup/extraActivityTypeById"
                           value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit"
                           data-action="setup/createExtraActivityType" data-su-action="setup/extraActivityTypeList"
                           data-type="list" value="submit">
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