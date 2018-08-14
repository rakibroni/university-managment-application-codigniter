<style>
    .select2-container {
        z-index: 999999;
    }
</style>
<div class="block-flat">
    <form class="form-horizontal frmContent" id="br_accessory" method="post">
        <?php
        if ($ac_type == "edit") {
            ?>
            <input type="hidden" class="rowID" name="txtBrAccessoryId"
                   value="<?php echo $br_accessory->SC_BR_ACCESSORY_ID ?>"/>
        <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group">
            <label class="col-lg-3 control-label">Building Type <span class="text-danger">*</span></label>

            <div class="col-lg-5">
                <?php if ($ac_type == "edit"): // if the form action is EDIT ?>
                    <select class="select2Dropdown form-control required" name="BR_TYPE_ID" id="BR_TYPE_ID"
                            data-tags="true" data-placeholder="Select Building Type" data-allow-clear="true">
                        <option value="">Select Building Type</option>
                        <?php foreach ($building_type as $row): ?>
                            <option
                                value="<?php echo $row->BR_TYPE_ID; ?>" <?php echo ($br_accessory->BR_TYPE_ID == $row->BR_TYPE_ID) ? 'selected' : ''; ?>><?php echo $row->BR_TYPE_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php else: // if the form action is VIEW ?>
                    <select class="select2Dropdown form-control required" name="BR_TYPE_ID" id="BR_TYPE_ID"
                            data-tags="true" data-placeholder="Select Building Type" data-allow-clear="true">
                        <option value="">Select Building Type</option>
                        <?php foreach ($building_type as $row) { ?>
                            <option value="<?php echo $row->BR_TYPE_ID; ?>"><?php echo $row->BR_TYPE_NAME; ?></option>
                        <?php } ?>
                    </select>
                <?php endif; ?>
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- Academic Building.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Room<span class="text-danger">*</span></label>

            <div class="col-lg-5">
                <select class="select2Dropdown form-control required" name="ROOM_ID" id="ROOM_ID" data-tags="true"
                        data-placeholder="Select Room" data-allow-clear="true">
                    <?php if ($ac_type == "edit"): ?>
                        <option
                            value="<?php echo $br_accessory->BR_ID ?>"><?php echo $br_accessory->BR_NAME . " (" . $br_accessory->BR_CODE . ")"; ?></option>
                    <?php else: ?>
                        <option value="">Select Room</option>
                    <?php endif; ?>
                </select>
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- Computer Lab (101).</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Accessory<span class="text-danger">*</span></label>

            <div class="col-lg-5">
                <?php if ($ac_type == "edit"): // if the form action is EDIT ?>
                    <select class="select2Dropdown form-control required" name="BR_ACCESSORY_ID" id="BR_ACCESSORY_ID"
                            data-tags="true" data-placeholder="Select Building Type" data-allow-clear="true">
                        <option value="">Select Room Accessory</option>
                        <?php foreach ($accessory as $row): ?>
                            <option
                                value="<?php echo $row->BR_ACCESSORY_ID; ?>" <?php echo ($br_accessory->BR_ACCESSORY_ID == $row->BR_ACCESSORY_ID) ? 'selected' : ''; ?>><?php echo $row->ACCESSORY_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php else: // if the form action is VIEW ?>
                    <select class="select2Dropdown form-control required" name="BR_ACCESSORY_ID" id="BR_ACCESSORY_ID"
                            data-tags="true" data-placeholder="Select Building Type" data-allow-clear="true">
                        <option value="">Select Room Accessory</option>
                        <?php foreach ($accessory as $row) { ?>
                            <option
                                value="<?php echo $row->BR_ACCESSORY_ID; ?>"><?php echo $row->ACCESSORY_NAME; ?></option>
                        <?php } ?>
                    </select>
                <?php endif; ?>
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- Computer, Table.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label"><span>Quantity</span>*</label>

            <div class="col-lg-3">
                <input type="number" min="1" max="300" step="1" id="quantity" name="quantity"
                       class="form-control required"
                       value="<?php echo ($ac_type == 'edit') ? $br_accessory->ACCESSORY_QTY : ''; ?>"
                       placeholder="Quantity">
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- 2, 5.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-3 control-label">Active?</label>

            <div class="col-lg-8">
                <?php
                $ACTIVE_STATUS = ($ac_type == "edit") ? $br_accessory->ACTIVE_STATUS : '';
                $checked = ($ac_type == "edit") ? (($br_accessory->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
                <span class="help-block m-b-none">click on checkbox for active status.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <?php if ($ac_type == "edit") { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit"
                           data-action="setup/updateBrAccessories" data-su-action="setup/brAccessoriesById"
                           value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit"
                           data-action="setup/createBrAccessories" data-su-action="setup/brAccessoriesList"
                           data-type="list" value="Submit">
                <?php
                }
                ?>
                <input type="reset" class="btn btn-default btn-sm" value="Reset">
                <span class="loadingImg"></span>
            </div>
        </div>

    </form>
</div>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/redactor/redactor.css"/>
<script src="<?php echo base_url(); ?>assets/redactor/redactor.min.js"></script>
<script type="text/javascript">
    $(document).ready(
        function () {
            $('.redactor').redactor();
        }
    );
    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked')) ? 1 : 0;
        $("#status").val(status);
    });
    $(document).ready(function () {
        $(document).on('change', '#BR_TYPE_ID', function (event) {
            event.preventDefault();
            var buildingType = $(this).val();
            var url = '<?php echo site_url('setup/ajax_get_buildingRoom') ?>';
            $.ajax({
                type: "POST",
                url: url,
                data: {buildingType: buildingType},
                dataType: 'html',
                success: function (data) {
                    $('#ROOM_ID').html(data);
                }
            });
        });
    });
</script>
