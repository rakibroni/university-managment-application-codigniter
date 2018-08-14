<div class="block-flat">
    <form class="form-horizontal frmContent" id="" action="<?php echo base_url(); ?>setup/updateBuilding" method="post">
        <?php if (!empty($building)): ?>
            <span class="frmMsg"></span>
            <div class="form-group">
                <label class="col-lg-3 control-label">Building Name</label>

                <div class="col-lg-5">
                    <input type="text" id="building_name" name="building_name"
                           value="<?php echo $building->BR_TYPE_NAME ?>" class="form-control required">
                    <input type="hidden" name="BR_TYPE_ID" value="<?php echo $building->BR_TYPE_ID ?>"
                           class="form-control required">
                    <span class="validation"></span>

                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Building Short Name</label>

                <div class="col-lg-5">
                    <input type="text" id="building_name" name="building_name_s"
                           value="<?php echo $building->BR_SHORT_NAME ?>" class="form-control required">
                    <span class="validation"></span>

                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Active?</label>

                <div class="col-lg-5">
                    <?php
                    $ACTIVE_STATUS = $building->ACTIVE_STATUS;
                    $checked = ($building->ACTIVE_STATUS == 1) ? 'checked' : '';
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
                    <input type="submit" class="btn btn-primary btn-sm" value="Update">
                </div>
            </div>
        <?php endif; ?>
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