<!-- VERTICAL FORM CONTROL SECTION START -->
<?php if ($dimention == "vertical") : ?>
    <div class="form-group">
        <label class="col-md-4  control-label">Faculty <span class="text-danger">*</span></label>

        <div class="col-md-8">
            <?php if ($ac_type == "edit"): // if the form action is EDIT ?>
                <select class="select2DropdownModal select2Dropdown faculty_dropdown form-control commonClass required"
                        name="FACULTY_ID" id="FACULTY_ID" data-tags="true" data-placeholder="Select Faculty"
                        data-allow-clear="true">
                    <option>Select Faculty</option>
                    <?php foreach ($faculty as $row): ?>
                        <option  value="<?php echo $row->FACULTY_ID; ?>" <?php echo ($previous_info->FACULTY_ID == $row->FACULTY_ID) ? 'selected' : ''; ?>><?php echo $row->FACULTY_NAME; ?></option>
                    <?php endforeach; ?>
                </select>
            <?php else: // if the form action is VIEW ?>
                <select class="select2Dropdown faculty_dropdown form-control commonClass required" name="FACULTY_ID"
                        id="FACULTY_ID" data-tags="true" data-placeholder="Select Faculty" data-allow-clear="true">
                    <option value="">Select Faculty</option>
                    <?php foreach ($faculty as $row): ?>
                        <option value="<?php echo $row->FACULTY_ID; ?>"><?php echo $row->FACULTY_NAME; ?></option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>
            <span class="validation"></span>
        </div>
        <br clear="all" />
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <label class="col-md-4 control-label">Department <span class="text-danger">*</span></label>

        <div class="col-md-8">
            <select class="select2Dropdown dept_dropdown form-control commonClass required" name="DEPT_ID" id="DEPT_ID"
                    data-tags="true" data-placeholder="Select Department" data-allow-clear="true">
                <?php
                if ($ac_type == "edit"): // if the form action is EDIT
                    foreach ($department as $row):
                        if ($row->FACULTY_ID == $previous_info->FACULTY_ID):
                            ?>
                            <option
                                value="<?php echo $row->DEPT_ID ?>" <?php echo ($previous_info->DEPT_ID == $row->DEPT_ID) ? 'selected' : '' ?>><?php echo $row->DEPT_NAME ?></option>
                        <?php
                        endif;
                    endforeach;
                else: // if the form action is VIEW
                    ?>
                    <option value="">Select Department</option>
                <?php endif; ?>
            </select>
            <span class="validation"></span>
        </div>
        <br clear="all" />
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <label class="col-md-4  control-label">Program <span class="text-danger">*</span></label><!-- pop-width  class remove -->

        <div class="col-md-8">
            <select class="select2Dropdown program_dropdown form-control commonClass required" name="PROGRAM_ID"
                    id="PROGRAM_ID" data-tags="true" data-placeholder="Select Program" data-allow-clear="true">
                <?php
                if ($ac_type == "edit"): // if the form action is EDIT
                    foreach ($program as $row):
                        if ($row->DEPT_ID == $previous_info->DEPT_ID):
                            ?>
                            <option
                                value="<?php echo $row->PROGRAM_ID ?>" <?php echo ($previous_info->PROGRAM_ID == $row->PROGRAM_ID) ? 'selected' : '' ?>><?php echo $row->PROGRAM_NAME ?></option>
                        <?php
                        endif;
                    endforeach;
                else: // if the form action is VIEW
                    ?>
                    <option value="">Select Program</option>
                <?php endif; ?>
            </select>
            <span class="validation"></span>
        </div>
        <br clear="all" />
    </div>
    <!-- VERTICAL FORM CONTROL SECTION END -->

    <!-- HORIZONTAL FORM CONTROL SECTION START -->
<?php elseif ($dimention == "horizental"): ?>
    <div class="col-md-4">
        <label class="col-md-12">Faculty <span class="text-danger">*</span></label>

        <div class="col-md-12">
            <?php if ($ac_type == "edit"): // if the form action is EDIT   ?>
                <select class="select2DropdownModal faculty_dropdown form-control commonClass col-md-12" name="FACULTY_ID"
                        id="FACULTY_ID" data-tags="true" data-placeholder="Select Faculty" data-allow-clear="true">
                    <option value="">Select Faculty</option>
                    <?php foreach ($faculty as $row): ?>
                        <option
                            value="<?php echo $row->FACULTY_ID; ?>" <?php echo ($previous_info->FACULTY_ID == $row->FACULTY_ID) ? 'selected' : ''; ?>><?php echo $row->FACULTY_NAME; ?></option>
                    <?php endforeach; ?>
                </select>
            <?php else: // if the form action is VIEW   ?>
                <select class="select2Dropdown faculty_dropdown form-control commonClass" name="FACULTY_ID"
                        id="FACULTY_ID" data-tags="true" data-placeholder="Select Faculty" data-allow-clear="true">
                    <option value="">Select Faculty</option>
                    <?php foreach ($faculty as $row): ?>
                        <option value="<?php echo $row->FACULTY_ID; ?>"><?php echo $row->FACULTY_NAME; ?></option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-4">
        <label class="col-md-12">Department <span class="text-danger">*</span></label>

        <div class="col-md-12">
            <select class="select2Dropdown dept_dropdown form-control commonClass" name="DEPT_ID" id="DEPT_ID"
                    data-tags="true" data-placeholder="Select Department" data-allow-clear="true">
                <?php
                if ($ac_type == "edit"): // if the form action is EDIT
                    foreach ($department as $row):
                        ?>
                        <option
                            value="<?php echo $row->DEPT_ID ?>" <?php echo ($previous_info->DEPT_ID == $row->DEPT_ID) ? 'selected' : '' ?>><?php echo $row->DEPT_NAME ?></option>
                    <?php
                    endforeach;
                else: // if the form action is VIEW
                    ?>
                    <option value="">Select Department</option>
                <?php endif; ?>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <label class="col-md-12">Program <span class="text-danger">*</span></label>

        <div class="col-md-12">
            <select class="select2Dropdown program_dropdown form-control commonClass" name="PROGRAM_ID" id="PROGRAM_ID"
                    data-tags="true" data-placeholder="Select Program" data-allow-clear="true">
                <?php
                if ($ac_type == "edit"): // if the form action is EDIT
                    foreach ($program as $row):
                        ?>
                        <option
                            value="<?php echo $row->PROGRAM_ID ?>" <?php echo ($previous_info->PROGRAM_ID == $row->PROGRAM_ID) ? 'selected' : '' ?>><?php echo $row->PROGRAM_NAME ?></option>
                    <?php
                    endforeach;
                else: // if the form action is VIEW
                    ?>
                    <option value="">Select Program</option>
                <?php endif; ?>
            </select>
        </div>
    </div>
<?php endif; ?>
<!-- HORIZONTAL FORM CONTROL SECTION END -->