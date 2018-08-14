<style>
    .error {
        border-color: #EBCCD1;
        color: #B94A48;
    }
</style>

<div class="widget fluid">
    <div class="whead"><h6>Create Module</h6>

        <div class="clear"></div>
    </div>
    <?php echo form_open(); ?>
    <div class="formRow">
        <div class="grid3"><label>Module Name</label></div>
        <div class="grid5"><input type="text" name="txtModuleName" value="<?php echo set_value('txtModuleName'); ?>"
                                  placeholder="Enter Module Name"/></div>
        <div class="grid4"><?php echo form_error('txtModuleName', '<div class="error">', '</div>'); ?></div>
        <div class="clear"></div>
    </div>
    <div class="formRow wFooter">
        <input type="submit" name="submitModule" class="buttonS bGreen formSubmit" value="Submit"/>

        <div class="clear"></div>
    </div>
    <?php echo form_close(); ?>
</div>