<style>
    .error {
        border-color: #EBCCD1;
        color: #B94A48;
    }
</style>
<div class="row">
    <?php echo form_open("securityAccess/update_module/" . $mod_id); ?>
    <div class="msg">
        <?php
        if (validation_errors() != false) {
            ?>
            <div class="alert alert-danger">
                <button data-dismiss="alert" class="close" type="button">×</button>
                <?php echo validation_errors(); ?>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="MODULE_NAME">Module Name</label>
        <div class="col-sm-8">
            <div class="fg-line">
                <input type="text" name="MODULE_NAME" class="form-control" id="MODULE_NAME"
                       value="<?php echo $mod_details->MODULE_NAME; ?>" placeholder="Enter Module Name"/>
            </div>
        </div>
        <br clear="all"/>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="MODULE_NAME_BN">Module Name Bangla</label>

        <div class="col-sm-8">
            <div class="fg-line">
                <input type="text" name="MODULE_NAME_BN" id="MODULE_NAME_BN" class="form-control"
                       value="<?php echo $mod_details->MODULE_NAME_BN; ?>" placeholder="Enter Module Bangla Name"/>
            </div>
        </div>
        <br clear="all"/>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="SL_NO">Serial No</label>

        <div class="col-sm-8">
            <div class="fg-line">
                <input type="text" name="SL_NO" id="SL_NO" class="form-control"
                       value="<?php echo $mod_details->SL_NO; ?>" placeholder="Enter Module Serial"/>
            </div>
        </div>
        <br clear="all"/>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="SL_NO">Module Icon</label>

        <div class="col-sm-8">
            <div class="fg-line">
                <input type="text" name="MODULE_ICON" id="MODULE_ICON" class="form-control"
                       value="<?php echo $mod_details->MODULE_ICON; ?>" placeholder="Enter Module Icon"/>
            </div>
        </div>
        <br clear="all"/>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="txtModLink">Active</label>

        <div class="col-sm-8">
            <div class="fg-line">
                <?php

                $chkStatus = array(
                    'name' => 'ACTIVE_STATUS',
                    'id' => 'ACTIVE_STATUS',
                    'value' => '1',
                    'style' => 'margin-right:5px',
                    'checked' => ($mod_details->ACTIVE_STATUS == 1) ? 'checked' : ''
                );
                echo form_checkbox($chkStatus);
                ?>
            </div>
        </div>
        <br clear="all"/>
    </div>
    <button class="col-sm-offset-3 btn btn-primary btn-sm " type="submit">Submit</button>
    <?php echo form_close(); ?>
</div>