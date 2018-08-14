<style>
    .select2-container {
        z-index: 999999;
    }
</style>
<div class="block-flat">
    <form class="form-horizontal frmContent" id="" action="" method="post">
        <?php
        if ($ac_type == "edit") {
            ?>
            <input type="hidden" name="BR_ID" class="rowID" value="<?php echo $previous_info->BR_ID ?>"/>
        <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group">
            <label class="col-lg-3 control-label">Building Type<span class="text-danger">*</span></label>

            <div class="col-lg-5">
                <?php if ($ac_type == "edit"): // if the form action is EDIT ?>
                    <select
                        class="select2DropdownModal select2Dropdown faculty_dropdown form-control commonClass required"
                        name="BR_TYPE_ID" id="BR_TYPE_ID" data-tags="true" data-placeholder="Select Building Type"
                        data-allow-clear="true">
                        <option>Select Building Type</option>
                        <?php foreach ($building as $row): ?>
                            <option
                                value="<?php echo $row->BR_TYPE_ID; ?>" <?php echo ($previous_info->BR_TYPE_ID == $row->BR_TYPE_ID) ? 'selected' : ''; ?>><?php echo $row->BR_TYPE_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php else: // if the form action is VIEW ?>
                    <select class="select2Dropdown faculty_dropdown form-control commonClass required" name="BR_TYPE_ID"
                            id="BR_TYPE_ID" data-tags="true" data-placeholder="Select Building Type"
                            data-allow-clear="true">
                        <option value="">Select Building Type</option>
                        <?php foreach ($building as $row): ?>
                            <option value="<?php echo $row->BR_TYPE_ID; ?>"><?php echo $row->BR_TYPE_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Building <span class="text-danger">*</span></label>

            <div class="col-lg-5">
                <?php if ($ac_type == "edit"): // if the form action is EDIT ?>
                    <select
                        class="select2DropdownModal select2Dropdown faculty_dropdown form-control commonClass required"
                        name="PARENT" id="PARENT" data-tags="true" data-placeholder="Select Building"
                        data-allow-clear="true">
                        <option>Select Building Type<span class="text-danger">*</span></option>
                        <?php foreach ($room as $row): ?>
                            <option
                                value="<?php echo $row->BR_ID; ?>" <?php echo ($previous_info->BR_ID == $row->BR_ID) ? 'selected' : ''; ?>><?php echo $row->BR_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php else: // if the form action is VIEW ?>
                    <select class="select2Dropdown faculty_dropdown form-control commonClass required" name="PARENT"
                            id="PARENT" data-tags="true" data-placeholder="Select Building" data-allow-clear="true">
                        <option value="">Select Building Type</option>
                        <?php foreach ($room as $row): ?>
                            <option value="<?php echo $row->BR_ID; ?>"><?php echo $row->BR_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Room No <span class="text-danger">*</span></label>

            <div class="col-lg-5">
                <input type="text" name="BR_CODE" class="required"
                       value="<?php echo ($ac_type == 'edit') ? $previous_info->BR_CODE : '' ?>" class="form-control">
                <span class="validation"></span>
                <span class="help-block m-b-none">e.g:- 1001.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Room Name <span class="text-danger">*</span></label>

            <div class="col-lg-5">
                <input type="text" name="BR_NAME" class="required"
                       value="<?php echo ($ac_type == 'edit') ? $previous_info->BR_NAME : '' ?>" class="form-control">
                <span class="validation"></span>
                <span class="help-block m-b-none">e.g:- COMPUTER LAB.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Active?</label>

            <div class="col-lg-5">
                <?php
                $ACTIVE_STATUS = ($ac_type == "edit") ? $previous_info->ACTIVE_STATUS : '';
                $checked = ($ac_type == "edit") ? (($previous_info->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
                ?>
                <label class="control-label">
                    <?php
                    $data = array(
                        'name' => 'status',
                        'id' => 'status',
                        'class' => 'checkBoxStatus',
                        'value' => $ACTIVE_STATUS,
                        'checked' => $checked
                    );
                    echo form_checkbox($data);
                    ?>
                </label>

            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-10">
                <span class="modal_msg pull-left"></span>
                <?php if ($ac_type == "edit") { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateRoom"
                           data-su-action="setup/roomById" value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createRoom"
                           data-su-action="setup/roomList" data-type="list" value="submit">
                <?php
                }
                ?>
                <input type="reset" class="btn btn-default btn-sm" value="Reset">
                <span class="loadingImg"></span>
            </div>
        </div>
    </form>
</div>
<div class="hr-line-dashed"></div>
</form>
</div>
<script>
    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });
</script>