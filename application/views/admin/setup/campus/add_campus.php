<style>
    .select2-container {
        z-index: 999999;
    }

    .pop-width {
        width: 25% !important;
    }
</style>
<div class="block-flat">
    <form class="form-horizontal frmContent" id="Campus" method="post">
        <?php
        if ($ac_type == "edit") {
            ?>
            <input type="hidden" class="rowID" name="txtcampusId" value="<?php echo $campus_info->CAMPUS_ID; ?>"/>
            <?php
        }
        ?>

        <div class="form-group">
            <label class="col-lg-4 control-label">Organization Name<span class="text-danger">*</span></label>
            <div class="col-lg-6">
                <select class="Organization_dropdown form-control required" name="ORG_ID" id="ORG_ID"
                        data-tags="true" data-placeholder="Select Organization" data-allow-clear="true">
                    <?php
                    if ($ac_type == "edit"): // if the form action is EDIT
                        foreach ($org_type as $row):
                            ?>
                            <option
                                value="<?php echo $row->ORG_ID ?>" <?php echo ($campus_info->ORG_ID == $row->ORG_ID) ? 'selected' : '' ?>><?php echo $row->ORG_NAME; ?></option>
                            <?php
                        endforeach;
                    else: // if the form action is VIEW
                        ?>
                        <option value="">Select Organization</option>
                        <?php
                        foreach ($org_type as $row):
                            ?>
                            <option value="<?php echo $row->ORG_ID ?>"><?php echo $row->ORG_NAME ?></option>
                            <?php
                        endforeach;
                    endif; ?>
                </select>
                <span class="validation"></span>
            </div>
        </div>

        <div class="hr-line-dashed"></div>


        <div class="form-group">
            <label class="col-md-4 control-label">Campus Name<span class="text-danger">*</span></label>

            <div class="col-md-6">
                <input type="text" id="campusName" name="campusName" class="form-control required"
                       value="<?php echo ($ac_type == 'edit') ? $campus_info->CAMPUS_NAME : ''; ?>"
                       placeholder="Campus Name">
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
            <label class="col-lg-4 control-label">Campus Type<span class="text-danger">*</span></label>
            <div class="col-lg-6">
                <select class="Campus_Type_dropdown form-control required" name="CAMPUS_TYPE_ID" id="CAMPUS_TYPE_ID"
                        data-tags="true" data-placeholder="Select Campus Type" data-allow-clear="true">
                    <?php
                    if ($ac_type == "edit"): // if the form action is EDIT
                        foreach ($campus_type as $row):
                            ?>
                            <option
                                value="<?php echo $row->LKP_ID ?>" <?php echo ($campus_info->CAMPUS_TYPE == $row->LKP_ID) ? 'selected' : '' ?>><?php echo $row->LKP_NAME; ?></option>
                            <?php
                        endforeach;
                    else: // if the form action is VIEW
                        ?>
                        <option value="">Select Campus Type</option>
                        <?php
                        foreach ($campus_type as $row):
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
                          name="description"><?php echo ($ac_type == 'edit') ? $campus_info->CAMPUS_DESC : ''; ?></textarea>
                <span class="validation"></span>
            </div>
        </div>

        <div class="hr-line-dashed"></div>


        <div class="form-group"><label class="col-md-4 control-label">Active?</label>

            <div class="col-md-6">
                <?php
                $ACTIVE_STATUS = ($ac_type == "edit") ? $campus_info->ACTIVE_STATUS : '';
                $checked = ($ac_type == "edit") ? (($campus_info->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
                <span class="help-block m-b-none">Click on checkbox for active status.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-lg-offset-4 col-lg-10">
                <?php if ($ac_type == "edit") { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateCampus"
                           data-su-action="setup/campusById" value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createCampus"
                           data-su-action="setup/campusList" data-type="list" value="Submit">
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
</script>
<script>
    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked')) ? 1 : 0;
        $("#status").val(status);


    });
    $(".select2DropdownMulti").select2({
        tags: true
    });
</script>