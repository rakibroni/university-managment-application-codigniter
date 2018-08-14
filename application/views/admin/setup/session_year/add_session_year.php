<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<style>
    .datepicker.dropdown-menu {
        z-index: 9999 !important;
    }

    .select2-container {
        z-index: 999999;
    }
</style>
<form class="form-horizontal frmContent" id="year" method="post">
    <div class="block-flat">
        <?php
        if ($ac_type == "edit") {
            //var_dump($yearSetup); exit;
            ?>
            <input type="hidden" name="yearSetupId" class="rowID" value="<?php echo $sessionYear->YSESSION_ID; ?>"/>
        <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group"><label class="col-lg-3 control-label">SESSION<span class="text-danger">*</span></label>

            <div class="col-lg-5">
                <?php if ($ac_type == "edit"): // if the form action is EDIT ?>
                    <select
                        class="faculty_dropdown form-control commonClass required"
                        name="SESSION_ID" id="SESSION_ID" data-tags="true" data-placeholder="Select Session"
                        data-allow-clear="true">
                        <option>Select Session</option>
                        <?php foreach ($session as $row): ?>
                            <option
                                value="<?php echo $row->SESSION_ID; ?>" <?php echo ($sessionYear->SESSION_ID == $row->SESSION_ID) ? 'selected' : ''; ?>><?php echo $row->SESSION_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php else: // if the form action is VIEW ?>
                    <select class="faculty_dropdown form-control commonClass required" name="SESSION_ID"
                            id="SESSION_ID" data-tags="true" data-placeholder="Select Session" data-allow-clear="true">
                        <option value="">Select Session</option>
                        <?php foreach ($session as $row): ?>
                            <option value="<?php echo $row->SESSION_ID; ?>"><?php echo $row->SESSION_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- Select session.</span>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-3 control-label">YEAR<span class="text-danger">*</span></label>

            <div class="col-lg-5">
                <?php if ($ac_type == "edit"): // if the form action is EDIT ?>
                    <select
                        class="faculty_dropdown form-control commonClass required"
                        name="YEAR_SETUP_ID" id="YEAR_SETUP_ID" data-tags="true" data-placeholder="Select Year"
                        data-allow-clear="true">
                        <option>Select Year</option>
                        <?php foreach ($year as $row): ?>
                            <option
                                value="<?php echo $row->YEAR_TITLE; ?>" <?php echo ($sessionYear->DINYEAR == $row->YEAR_TITLE) ? 'selected' : ''; ?>><?php echo $row->YEAR_TITLE; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php else: // if the form action is VIEW ?>
                    <select class="form-control commonClass required"
                            name="YEAR_SETUP_ID" id="YEAR_SETUP_ID" data-tags="true" data-placeholder="Select Year"
                            data-allow-clear="true">
                        <option value="">Select Year</option>
                        <?php foreach ($year as $row): ?>
                            <option
                                value="<?php echo $row->YEAR_TITLE; ?>"><?php echo $row->YEAR_TITLE; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>

                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- Select Year.</span>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-3 control-label">User Define SL. No.<span class="text-danger">*</span></label>
            <div class="col-lg-2">
                <input type="text" id="UD_SLNO" name="UD_SLNO"
                value="<?php echo ($ac_type == "edit") ? $sessionYear->UD_SLNO : '' ?>" class="form-control required"
                 >
                
        </div>
        </div>
        <div class="form-group"><label class="col-lg-3 control-label">Is current?</label>

            <div class="col-lg-9">
                <?php
                $IS_CURRENT = ($ac_type == "edit") ? $sessionYear->IS_CURRENT : '0';
                $checked = ($ac_type == "edit") ? (($sessionYear->IS_CURRENT == '1') ? TRUE : FALSE) : '';
                ?>
                <label class="control-label">
                    <?php
                    $data = array(
                        'name' => 'IS_CURRENT',
                        'id' => 'IS_CURRENT',
                        'class' => 'checkBoxStatus',
                        'value' => $IS_CURRENT,
                        'checked' => $checked,
                    );
                    echo form_checkbox($data);
                    ?>
                </label>
                <span class="help-block m-b-none">click on checkbox for Current.</span>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-3 control-label">Is trimester?</label>

            <div class="col-lg-9">
                <?php
                $IS_TRIMESTER = ($ac_type == "edit") ? $sessionYear->TRIMESTER : '0';
                $checked = ($ac_type == "edit") ? (($sessionYear->TRIMESTER == '1') ? TRUE : FALSE) : '';
                ?>
                <label class="control-label">
                    <?php
                    $data = array(
                        'name' => 'IS_TRIMESTER',
                        'id' => 'IS_TRIMESTER',
                        'class' => 'checkBoxStatus',
                        'value' => $IS_TRIMESTER,
                        'checked' => $checked,
                    );
                    echo form_checkbox($data);
                    ?>
                </label>
                <span class="help-block m-b-none">click on checkbox for Trimester.</span>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-3 control-label">Is bysemester?</label>

            <div class="col-lg-9">
                <?php
                $IS_SEMESTER = ($ac_type == "edit") ? $sessionYear->SEMESTER : '0';
                $checked = ($ac_type == "edit") ? (($sessionYear->SEMESTER == '1') ? TRUE : FALSE) : '';
                ?>
                <label class="control-label">
                    <?php
                    $data = array(
                        'name' => 'IS_SEMESTER',
                        'id' => 'IS_SEMESTER',
                        'class' => 'checkBoxStatus',
                        'value' => $IS_SEMESTER,
                        'checked' => $checked,
                    );
                    echo form_checkbox($data);
                    ?>
                </label>
                <span class="help-block m-b-none">click on checkbox for Bysemester.</span>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-3 control-label">Is Active?</label>

            <div class="col-lg-9">
                <?php
                $ACTIVE_STATUS = ($ac_type == "edit") ? $sessionYear->ACTIVE_STATUS : '0';
                $checked = ($ac_type == "edit") ? (($sessionYear->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
                ?>
                <label class="control-label">
                    <?php
                    $data = array(
                        'name' => 'ACTIVE_STATUS',
                        'id' => 'ACTIVE_STATUS',
                        'class' => 'checkBoxStatus',
                        'value' => $ACTIVE_STATUS,
                        'checked' => $checked,
                    );
                    echo form_checkbox($data);
                    ?>
                </label>
                <span class="help-block m-b-none">click on checkbox for Current.</span>
            </div>
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
            <?php if ($ac_type == "edit") { ?>
                <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateSessionYear"
                       data-su-action="setup/sessionYearList" data-type="list" value="Update">
            <?php } else { ?>
                <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createSessionYear"
                       data-su-action="setup/sessionYearList" data-type="list" value="Submit">
            <?php
            }
            ?>
            <input type="reset" class="btn btn-default btn-sm" value="Reset">
            <span class="loadingImg"></span>
        </div>
    </div>
</form>
</div>
<script>
    $(document).on('click', '.checkBoxStatus', function () {

        var status = ($(this).is(':checked')) ? 1 : 0;
        $(this).val(status);
    });
</script>