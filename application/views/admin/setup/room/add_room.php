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
            <input type="hidden" name="ROOM_ID" class="rowID" value="<?php  echo $previous_info->ROOM_ID ?>"/>
            <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group">
            <label class="col-lg-4 control-label">Campus Name<span class="text-danger">*</span></label>

            <div class="col-lg-6">
                <?php if ($ac_type == "edit"): // if the form action is EDIT ?>
                    <select
                        class="form-control commonClass required"
                        name="CAMPUS_ID" id="CAMPUS_ID" data-tags="true" data-placeholder="Select Campus Name"
                        data-allow-clear="true">
                        <option>Select Campus Name</option>
                        <?php foreach ($campus as $row): ?>
                            <option
                                value="<?php echo $row->CAMPUS_ID; ?>" <?php echo ($previous_info->CAMPUS_ID == $row->CAMPUS_ID) ? 'selected' : ''; ?>><?php echo $row->CAMPUS_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php else: // if the form action is VIEW ?>
                    <select class="form-control commonClass required" name="CAMPUS_ID"
                            id="CAMPUS_ID" data-tags="true" data-placeholder="Select Campus Name"
                            data-allow-clear="true">
                        <option value="">-- Select Campus Name --</option>
                        <?php foreach ($campus as $row): ?>
                            <option value="<?php echo $row->CAMPUS_ID; ?>"><?php echo $row->CAMPUS_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-4 control-label">Building Name <span class="text-danger">*</span></label>

            <div class="col-lg-6">
                <?php if ($ac_type == "edit"): // if the form action is EDIT ?>
                    <select
                        class="form-control commonClass required"
                        name="BUILDING_ID" id="BUILDING_ID" data-tags="true" data-placeholder="Select Building Name"
                        data-allow-clear="true">
                        <option>Select Building Name<span class="text-danger">*</span></option>
                        <?php foreach ($building as $row): ?>
                            <option
                                value="<?php echo $row->BUILDING_ID; ?>" <?php echo ($previous_info->BUILDING_ID == $row->BUILDING_ID) ? 'selected' : ''; ?>><?php echo $row->BUILDING_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php else: // if the form action is VIEW ?>
                    <select class="form-control commonClass required" name="BUILDING_ID"
                            id="BUILDING_ID" data-tags="true" data-placeholder="Select Building Name" data-allow-clear="true">

                        <option value="">-- Select Building Name --</option>

                    </select>
                <?php endif; ?>
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-4 control-label">Floor <span class="text-danger">*</span></label>

            <div class="col-lg-6">
                <?php if ($ac_type == "edit"): // if the form action is EDIT ?>
                    <select
                        class="form-control commonClass required"
                        name="FLOOR_ID" id="FLOOR_ID" data-tags="true" data-placeholder="Select Floor"
                        data-allow-clear="true">
                        <option>-- Select Floor --<span class="text-danger">*</span></option>
                        <?php foreach ($floor as $row): ?>
                            <option
                                value="<?php echo $row->FLOOR_SL_NO; ?>" <?php echo ($previous_info->FLOOR_ID == $row->FLOOR_SL_NO) ? 'selected' : ''; ?>><?php echo $row->FLOOR_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php else: // if the form action is VIEW ?>
                    <select class="form-control commonClass required" name="FLOOR_ID"
                            id="FLOOR_ID"  data-tags="true" data-placeholder="Select Building" data-allow-clear="true">
                        <option value="">-- Select Floor --</option>
                         <?php foreach ($building_floor as $row): ?>
                            <option value="<?php echo $row->FLOOR_SL_NO; ?>"><?php echo $row->FLOOR_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-4 control-label">Room No <span class="text-danger">*</span></label>

            <div class="col-lg-6">
                <input type="text" name="ROOM_NO"
                       value="<?php echo ($ac_type == 'edit') ? $previous_info->ROOM_NO : '' ?>" class="form-control required">
                <span class="validation"></span>
                <span class="help-block m-b-none">e.g:- 1001.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-4 control-label">Room Name <span class="text-danger">*</span></label>

            <div class="col-lg-6">
                <input type="text" name="ROOM_NAME"
                       value="<?php echo ($ac_type == 'edit') ? $previous_info->ROOM_NAME : '' ?>" class="form-control required">
                <span class="validation"></span>
                <span class="help-block m-b-none">e.g:- COMPUTER LAB.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-4 control-label">Room Type <span class="text-danger">*</span></label>

            <div class="col-lg-6">
                <?php if ($ac_type == "edit"): // if the form action is EDIT ?>
                    <select
                        class="form-control commonClass required"
                        name="ROOM_TYPE_ID" id="ROOM_TYPE_ID" data-tags="true" data-placeholder="Select Room Type"
                        data-allow-clear="true">
                        <option>-- Select Room Type --<span class="text-danger">*</span></option>
                        <?php foreach ($room_type as $row): ?>
                            <option
                                value="<?php echo $row->LKP_ID; ?>" <?php echo ($previous_info->ROOM_TYPE == $row->LKP_ID) ? 'selected' : ''; ?>><?php echo $row->LKP_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php else: // if the form action is VIEW ?>
                    <select class="form-control commonClass required" name="ROOM_TYPE_ID"
                            id="ROOM_TYPE_ID"  data-tags="true" data-placeholder="Select Room Type" data-allow-clear="true">
                        <option value="">-- Select Room Type --</option>
                        <?php foreach ($room_type as $row): ?>
                            <option value="<?php echo $row->LKP_ID; ?>"><?php echo $row->LKP_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
            <label class="col-md-4 control-label"><span>Description</span></label>

            <div class="col-md-6">
                <textarea class="col-md-12"
                          name="description"><?php echo ($ac_type == 'edit') ? $previous_info->DESC : ''; ?></textarea>
                <span class="validation"></span>
            </div>
        </div>

        <div class="hr-line-dashed"></div>

        <div class="form-group">
            <label class="col-lg-4 control-label">Active?</label>

            <div class="col-lg-6">
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
            <div class="col-lg-offset-4 col-lg-8">
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

    $(document).on('change', '#CAMPUS_ID', function () {
        var campus_id = $(this).val();
        var url = '<?php echo site_url('common/buildingNameByCampus'); ?>';

        $.ajax({
            type: 'POST',
            url: url,
            data: {campus_id: campus_id},
            success: function (data) {
                $('#BUILDING_ID').html(data);
            }
        });

    });

</script>