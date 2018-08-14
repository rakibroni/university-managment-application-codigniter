<div class="block-flat">
    <form class="form-horizontal frmContent" id="district" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="COM_ID" value="<?php echo $com_type->COM_ID ?>"/>
        <?php
        }
        ?>
        <span class="frmMsg"></span>
        <div class="form-group">
            <label class="col-lg-3 control-label">Committee Type Name<span style="color: red"> *</span></label>
            <div class="col-lg-7">
                <input type="text" id="COM_TITLE" name="COM_TITLE" value="<?php echo ($ac_type == 2) ? $com_type->COM_TITLE : '' ?>" class="form-control required" placeholder="Enter Committee Type Name">
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- .</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Description<span style="color: red"> *</span></label>
            <div class="col-lg-7">
                <textarea type="text" id="COM_DESC" name="COM_DESC"  class="form-control required" placeholder="Description"><?php echo ($ac_type == 2) ? $com_type->COM_DESC : '' ?></textarea>
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- .</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group"><label class="col-lg-3 control-label">Active?</label>
            <div class="col-lg-7">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $com_type->ACTIVE_STATUS : '';
                $checked = ($ac_type == 2) ? (($com_type->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateCommitteeType" data-su-action="setup/committeeTypeById" value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createCommitteeType" data-su-action="setup/committeeTypeList" data-type="list" value="submit">
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