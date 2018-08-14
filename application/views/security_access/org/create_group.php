<div class="card">
    <div class="card-body card-padding">
        <?php echo form_open("setup/addNewGroup"); ?>
        <input type="hidden" name="txtOrgId" value="<?php echo $hid; ?>"/>

        <div class="form-group">
            <label>Enter Group Name Here</label>
            <input type="text" class="form-control" name="txtGroupName" value="<?php echo set_value('txtGroupName'); ?>"
                   required="required"/>
        </div>
        <p class="m-b-25 m-t-25 c-black f-500">Create new group for organization where user will be assigned later.</p>
        <button class="btn btn-primary btn-sm m-t-10 waves-effect waves-button waves-float" type="submit">Submit
        </button>
        <?php echo form_close(); ?>
    </div>
</div>