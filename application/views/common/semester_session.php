<?php if ($dimention == "vertical") : ?>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <label class="col-md-4 control-label">Semester <span class="text-danger">*</span></label>

        <div class="col-lg-5">
            <?php if ($ac_type == "edit"): // if the form action is EDIT ?>
                <select class="select2Dropdown form-control required" name="SEMESTER_ID" id="SEMESTER_ID"
                        data-tags="true" data-placeholder="Select Semester" data-allow-clear="true">
                    <option value="">Select Semester</option>
                    <?php foreach ($semester as $row): ?>
                        <option
                            value="<?php echo $row->SEMESTER_ID; ?>" <?php echo ($previous_info->SEMESTER_ID == $row->SEMESTER_ID) ? 'selected' : ''; ?>><?php echo $row->SEMESTER_NAME; ?></option>
                    <?php endforeach; ?>
                </select>
            <?php else: // if the form action is VIEW ?>
                <select class="select2Dropdown form-control required" name="SEMESTER_ID" id="SEMESTER_ID"
                        data-tags="true" data-placeholder="Select Semester" data-allow-clear="true">
                    <option value="">Select Semester</option>
                    <?php foreach ($semester as $row): ?>
                        <option value="<?php echo $row->SEMESTER_ID ?>"><?php echo $row->SEMESTER_NAME ?></option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>
            <span class="validation"></span>
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <label class="col-md-4 control-label">Session <span class="text-danger">*</span></label>

        <div class="col-lg-5">
            <?php if ($ac_type == "edit"): // if the form action is EDIT ?>
                <select class="select2Dropdown form-control required" name="SESSION_ID" id="SESSION_ID" data-tags="true"
                        data-placeholder="Select Session" data-allow-clear="true">
                    <option value="">Select Session</option>
                    <?php foreach ($session as $row): ?>
                        <option
                            value="<?php echo $row->SESSION_ID; ?>" <?php echo ($previous_info->SESSION_ID == $row->SESSION_ID) ? 'selected' : ''; ?>><?php echo $row->SESSION_NAME; ?></option>
                    <?php endforeach; ?>
                </select>
            <?php else: // if the form action is VIEW ?>
                <select class="select2Dropdown form-control required" name="SESSION_ID" id="SESSION_ID" data-tags="true"
                        data-placeholder="Select Session" data-allow-clear="true">
                    <option value="">Select Session</option>
                    <?php foreach ($session as $row) { ?>
                        <option
                            value="<?php echo $row->SESSION_ID; ?>"><?php echo $row->SESSION_NAME; ?></option>
                    <?php } ?>
                </select>
            <?php endif; ?>
            <span class="validation"></span>
        </div>
    </div>
<?php else: ?>
    <div class="col-md-4">
        <div class="col-md-12">
            <label class="control-label">Semester <span class="text-danger">*</span></label>
            <select class="select2Dropdown form-control required" name="SEMESTER_ID" id="SEMESTER_ID" data-tags="true"
                    data-placeholder="Select Semester" data-allow-clear="true">
                <option value="">Select Semester</option>
                <?php foreach ($semester as $row): ?>
                    <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="col-md-12">
            <label class="control-label">Session <span class="text-danger">*</span></label>
            <select class="select2Dropdown form-control" name="SESSION_ID" id="SESSION_ID" data-tags="true"
                    data-placeholder="Select Session" data-allow-clear="true">
                <option value="">Select Session</option>
                <?php foreach ($session as $nn) { ?>
                    <option
                        value="<?php echo $nn->SESSION_ID; ?>"><?php echo $nn->SESSION_NAME; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
<?php endif; ?>