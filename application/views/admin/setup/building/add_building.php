<div class="block-flat">
    <form class="form-horizontal frmContent" id="" action="" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" name="BUILDING_ID" class="rowID" value="<?php echo $building->BUILDING_ID ?>"/>
            <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group">
            <label class="col-lg-4 control-label">Campus Name<span class="text-danger">*</span></label>
            <div class="col-lg-6">
                <select class="Campus_Type_dropdown form-control required" name="CAMPUS_ID" id="CAMPUS_ID"
                        data-tags="true" data-placeholder="Select Campus Name" data-allow-clear="true">
                    <?php
                    if ($ac_type == "2"):
                        foreach ($campus_info as $row):
                            ?>
                            <option
                                    value="<?php echo $row->CAMPUS_ID ?>" <?php echo ($building->CAMPUS_ID == $row->CAMPUS_ID) ? 'selected' : '' ?>><?php echo $row->CAMPUS_NAME; ?></option>
                            <?php
                        endforeach;
                    else: // if the form action is VIEW
                        ?>
                        <option value="">-- Select Campus Name --</option>
                        <?php
                        foreach ($campus_info as $row):
                            ?>
                            <option value="<?php echo $row->CAMPUS_ID ?>"><?php echo $row->CAMPUS_NAME ?></option>
                            <?php
                        endforeach;
                    endif; ?>
                </select>
                <span class="validation"></span>
            </div>
        </div>

        <div class="hr-line-dashed"></div>

        <div class="form-group">
            <label class="col-lg-4 control-label">Building Name<span class="text-danger">*</span></label>

            <div class="col-lg-6">
                <input type="text" id="building_name" name="BUILDING_NAME"
                       value="<?php echo ($ac_type == 2) ? $building->BUILDING_NAME : '' ?>"
                       class="form-control required">
                <span class="validation"></span>
                <span class="help-block m-b-none ">e.g.  Academic Building.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-4 control-label">Building Type<span class="text-danger">*</span></label>
            <div class="col-lg-6">
                <select class="Building_Type_dropdown form-control required" name="BUILDING_TYPE_ID"
                        id="BUILDING_TYPE_ID"
                        data-tags="true" data-placeholder="Select Building Type" data-allow-clear="true">
                    <?php
                    if ($ac_type == "2"):
                        foreach ($building_type as $row):
                            ?>
                            <option
                                    value="<?php echo $row->LKP_ID ?>" <?php echo ($building->BUILDING_TYPE == $row->LKP_ID) ? 'selected' : '' ?>><?php echo $row->LKP_NAME; ?></option>
                            <?php
                        endforeach;
                    else: // if the form action is VIEW
                        ?>
                        <option value="">-- Select Building Type --</option>
                        <?php
                        foreach ($building_type as $row):
                            ?>
                            <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                            <?php
                        endforeach;
                    endif; ?>
                </select>
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
            <label class="col-md-4 control-label"><span>Description</span></label>

            <div class="col-md-6">
                <textarea class="col-md-12"
                          name="description"><?php echo ($ac_type == '2') ? $building->DESC : ''; ?></textarea>
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
            <label class="col-lg-4 control-label">Active?</label>

            <div class="col-lg-6">
                <?php
                $BUILDING_ACTIVE_STATUS = ($ac_type == 2) ? $building->ACTIVE_STATUS : '';
                $checked = ($ac_type == 2) ? (($building->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
                ?>
                <label class="control-label">
                    <?php
                    $data = array(
                        'name' => 'status',
                        'id' => 'status',
                        'class' => 'checkBoxStatus',
                        'value' => $BUILDING_ACTIVE_STATUS,
                        'checked' => $checked
                    );
                    echo form_checkbox($data);
                    ?>
                </label>

            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-4 col-lg-8">
                <span class="modal_msg pull-left"></span>
                <?php if ($ac_type == 2) { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateBuilding"
                           data-su-action="setup/buildingById" value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createBuilding"
                           data-su-action="setup/buildingList" data-type="list" value="submit">
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