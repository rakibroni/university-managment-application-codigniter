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
            <input type="hidden" name="BR_ID" class="rowID" value="<?php // echo $previous_info->BR_ID ?>"/>
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
                                value="<?php echo $row->CAMPUS_ID; ?>" <?php echo ($previous_info->BR_TYPE_ID == $row->CAMPUS_ID) ? 'selected' : ''; ?>><?php echo $row->CAMPUS_NAME; ?></option>
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
                        <?php foreach ($room as $row): ?>
                            <option
                                value="<?php echo $row->BUILDING_ID; ?>" <?php echo ($previous_info->BR_ID == $row->BUILDING_ID) ? 'selected' : ''; ?>><?php echo $row->BUILDING_NAME; ?></option>
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
                        name="FLOOR_ID" id="FLOOR_IDvdv" data-tags="true" data-placeholder="Select Floor"
                        data-allow-clear="true">
                        <option>-- Select Floor --<span class="text-danger">*</span></option>
                        <?php foreach ($floor as $row): ?>
                            <option
                                value="<?php echo $row->BR_ID; ?>" <?php echo ($previous_info->BR_ID == $row->BR_ID) ? 'selected' : ''; ?>><?php echo $row->BR_NAME; ?></option>
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
            <label class="col-lg-4 control-label">Room No. <span class="text-danger">*</span></label>

            <div class="col-lg-6">
                <?php if ($ac_type == "edit"): // if the form action is EDIT ?>
                    <select
                        class="form-control commonClass required"
                        name="ROOM_NO" id="ROOM_NO" data-tags="true" data-placeholder="Select Room No."
                        data-allow-clear="true">
                        <option>-- Select Room No. --<span class="text-danger">*</span></option>
<!--                        --><?php //foreach ($floor as $row): ?>
<!--                            <option-->
<!--                                value="--><?php //echo $row->BR_ID; ?><!--" --><?php //echo ($previous_info->BR_ID == $row->BR_ID) ? 'selected' : ''; ?><!-->--><?php //echo $row->BR_NAME; ?><!--</option>-->
<!--                        --><?php //endforeach; ?>
                    </select>
                <?php else: // if the form action is VIEW ?>
                    <select class="form-control commonClass required" name="ROOM_NO"
                            id="ROOM_NO"  data-tags="true" data-placeholder="Select Room No." data-allow-clear="true">
                        <option value="">-- Select Room No. --</option>
                        <?php foreach ($room_no as $row): ?>
                            <option value="<?php echo $row->LKP_ID; ?>"><?php echo $row->LKP_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-4 control-label">Seat No</label>

            <div class="col-lg-6">
            <?php foreach($resident_seat as $row): ?>
                <input type="checkbox" name="SEAT_NO[]" value="<?php echo $row->SEAT_NO ?> " checked> <?php echo $row->SEAT_NAME ?> 
            <?php endforeach; ?>
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
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="admin/createRoomMapping"
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

    $(document).on('change', '#FLOOR_ID', function () {
        var campus_id = $('#CAMPUS_ID').val();
        var building_id = $('#BUILDING_ID').val();
        var floor_id = $(this).val();

        var url = '<?php echo site_url('common/roomNoByThisAttribute'); ?>';

        $.ajax({
            type: 'POST',
            url: url,
            data: {campus_id: campus_id, building_id:building_id, floor_id:floor_id },
            success: function (data) {
                $('#ROOM_NO').html(data);
            }
        });

    });

</script>