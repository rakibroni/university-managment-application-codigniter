<div class="block-flat">
    <form class="form-horizontal frmContent" id="" action="<?php echo base_url(); ?>setup/updateRoom" method="post">
        <span class="frmMsg"></span>

        <div class="form-group">
            <label class="col-lg-3 control-label">Building Type</label>

            <div class="col-lg-5">
                <select name="BR_TYPE_ID" class="form-control">
                    <option>-select-</option>
                    <?php foreach ($buildings as $row): ?>
                        <option
                            value="<?php echo $row->BR_TYPE_ID ?>" <?php echo ($previous_info->BR_TYPE_ID == $row->BR_TYPE_ID) ? 'selected' : ''; ?>><?php echo $row->BR_TYPE_NAME ?></option>

                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Building</label>

            <div class="col-lg-5">
                <select name="PARENT" class="form-control">
                    <option>-select-</option>
                    <?php foreach ($rooms as $row): ?>
                        <option
                            value="<?php echo $row->BR_ID ?>" <?php echo ($previous_info->PARENT == $row->BR_ID) ? 'selected' : ''; ?>><?php echo $row->BR_NAME ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Room No.</label>

            <div class="col-lg-5">
                <input type="text" name="BR_CODE" value="<?php echo $previous_info->BR_CODE ?>" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Room Name</label>

            <div class="col-lg-5">
                <input type="text" name="BR_NAME" value="<?php echo $previous_info->BR_NAME ?>" class="form-control">
                <input type="hidden" name="BR_ID" value="<?php echo $previous_info->BR_ID ?>">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Active?</label>

            <div class="col-lg-5">
                <?php
                $ACTIVE_STATUS = $previous_info->ACTIVE_STATUS;
                $checked = ($previous_info->ACTIVE_STATUS == 1) ? 'checked' : '';
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
        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-10">
                <input type="submit" class="btn btn-primary btn-sm" value="submit">
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