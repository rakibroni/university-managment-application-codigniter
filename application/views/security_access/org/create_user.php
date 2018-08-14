<div class="wrapper">
    <div class="widget fluid">
        <?php echo form_open("admin/careProviders/createNewUser"); ?>
        <input type="hidden" name="txtOrgId" value="<?php echo $hid; ?>"/>

        <div class="formRow">
            <div class="grid3"><label>Group Name</label></div>
            <div class="grid9">
                <span class="grid5">
                    <?php echo form_dropdown('cmbGroupName', $groups, "", 'id="cmbGroupName" aria-required="true" class="select" style="min-width:200px;" required="required"'); ?>
                </span>
            </div>
            <div class="grid4"><?php echo form_error('txtPassword', '<div class="error">', '</div>'); ?></div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <div class="grid3"><label>Name</label></div>
            <div class="grid9">
                <span class="grid3"><input type="text" name="txtFirstName"
                                           value="<?php echo set_value('txtFirstName'); ?>"
                                           placeholder="Enter First Name" required="required"/></span>
                <span class="grid3"><input type="text" name="txtMiddleName"
                                           value="<?php echo set_value('txtMiddleName'); ?>"
                                           placeholder="Enter Middle Name"/></span>
                <span class="grid3"><input type="text" name="txtLastName"
                                           value="<?php echo set_value('txtLastName'); ?>" placeholder="Enter Last Name"
                                           required="required"/></span>
            </div>
            <div class="grid4"><?php echo form_error('txtGroupName', '<div class="error">', '</div>'); ?></div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <div class="grid3"><label>Email</label></div>
            <div class="grid9">
                <span class="grid5"><input type="text" name="txtEmail" value="<?php echo set_value('txtEmail'); ?>"
                                           placeholder="Enter Email" required="required"/></span>
            </div>
            <div class="grid4"><?php echo form_error('txtEmail', '<div class="error">', '</div>'); ?></div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <div class="grid3"><label>Login Name</label></div>
            <div class="grid9">
                <span class="grid5"><input type="text" name="txtLoginName"
                                           value="<?php echo set_value('txtLoginName'); ?>"
                                           placeholder="Enter Login Name" required="required"/></span>
            </div>
            <div class="grid4"><?php echo form_error('txtLoginName', '<div class="error">', '</div>'); ?></div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <div class="grid3"><label>Password</label></div>
            <div class="grid9">
                <span class="grid5"><input type="password" name="txtPassword"
                                           value="<?php echo set_value('txtPassword'); ?>" placeholder="Enter Password"
                                           required="required"/></span>
            </div>
            <div class="grid4"><?php echo form_error('txtPassword', '<div class="error">', '</div>'); ?></div>
            <div class="clear"></div>
        </div>
        <div class="formRow wFooter">
            <input type="submit" name="submitGroup" class="buttonS bGreen formSubmit" value="Submit"/>

            <div class="clear"></div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>