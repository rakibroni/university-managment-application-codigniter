<div class="card">
    <div class="card-body card-padding">
        <?php echo form_open("securityAccess/createLevel"); ?>
        <input type="hidden" name="txtGroupId" id="txtGroupId" value="<?php echo $user_group_id; ?>"/>

        <p class="m-b-25 m-t-25 c-black f-500">Create new Level</p>

        <div class="form-group fg-float">
            <div class="fg-line">
                <input type="text" class="input-sm form-control fg-input" name="txtLevelName"/>
            </div>
            <label class="fg-label">Enter Level Name Here</label>
        </div>
        <button class="btn btn-primary btn-sm m-t-10 waves-effect waves-button waves-float" type="submit">Submit
        </button>
        <?php echo form_close(); ?>
    </div>
</div>