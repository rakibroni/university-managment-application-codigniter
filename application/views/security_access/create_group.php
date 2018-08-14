<?php echo form_open("securityAccess/addNewGroup"); ?>
<input type="hidden" name="txtOrgId" value="<?php echo $hid; ?>"/>
<p class="m-b-25 m-t-25 c-black f-500">Create new group for organization where user will be assigned later.</p>
<div class="form-group">
    <label>Enter Group Name Here</label>
    <input type="text" class="form-control" name="txtGroupName" value="<?php echo set_value('txtGroupName'); ?>"
           required="required"/>
</div>
<button class="btn btn-primary" type="submit">Submit</button>
<?php echo form_close(); ?>
    
