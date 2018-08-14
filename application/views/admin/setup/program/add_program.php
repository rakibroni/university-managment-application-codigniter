<style>
    .select2-container {
        z-index: 999999;
    }
</style>
<div class="block-flat">
    <form class="form-horizontal frmContent" id="program" method="post">
        <?php
        if ($ac_type == "edit") {
            ?>
            <input type="hidden" class="rowID" name="txtProgramId" value="<?php echo $program->PROGRAM_ID ?>"/>
        <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group">
            <label class="col-lg-3 control-label">Degrees<span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="Degrees_dropdown form-control required" name="DEGREE_ID" id="DEGREE_ID"
                        data-tags="true" data-placeholder="Select Degrees" data-allow-clear="true">
                    <?php
                    if ($ac_type == "edit"): // if the form action is EDIT
                        foreach ($degree as $row):
                            ?>
                            <option
                                value="<?php echo $row->DEGREE_ID ?>" <?php echo ($program->DEGREE_ID == $row->DEGREE_ID) ? 'selected' : '' ?>><?php echo $row->DEGREE_NAME ?></option>
                        <?php
                        endforeach;
                    else: // if the form action is VIEW
                        ?>
                        <option value="">Select Degree</option>
                        <?php
                        foreach ($degree as $row):
                            ?>
                            <option value="<?php echo $row->DEGREE_ID ?>"><?php echo $row->DEGREE_NAME ?></option>
                        <?php
                        endforeach;
                    endif; ?>
                </select>
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 pop-width control-label">Faculty <span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <?php if ($ac_type == "edit"): // if the form action is EDIT ?>
                    <select
                        class="faculty_dropdown form-control commonClass required"
                        name="FACULTY_ID" id="FACULTY_ID" data-tags="true" data-placeholder="Select Faculty"
                        data-allow-clear="true">
                        <option>Select Faculty</option>
                        <?php foreach ($faculty as $row): ?>
                            <option
                                value="<?php echo $row->FACULTY_ID; ?>" <?php echo ($program->FACULTY_ID == $row->FACULTY_ID) ? 'selected' : ''; ?>><?php echo $row->FACULTY_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php else: // if the form action is VIEW ?>
                    <select class=" faculty_dropdown form-control commonClass required" name="FACULTY_ID"
                            id="FACULTY_ID" data-tags="true" data-placeholder="Select Faculty" data-allow-clear="true">
                        <option value="">Select Faculty</option>
                        <?php foreach ($faculty as $row): ?>
                            <option value="<?php echo $row->FACULTY_ID; ?>"><?php echo $row->FACULTY_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 pop-width control-label">Department <span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <select class="dept_dropdown form-control commonClass required" name="DEPT_ID"
                        id="DEPT_ID" data-tags="true" data-placeholder="Select Department" data-allow-clear="true">
                    <?php
                    if ($ac_type == "edit"): // if the form action is EDIT
                        foreach ($department as $row): ?>
                          
                                <option
                                    value="<?php echo $row->DEPT_ID ?>" <?php echo ($program->DEPT_ID == $row->DEPT_ID) ? 'selected' : '' ?>><?php echo $row->DEPT_NAME ?></option>
                            <?php
                           
                        endforeach;
                    else: // if the form action is VIEW
                        ?>
                        <option value="">Select Department</option>
                    <?php endif; ?>
                </select>
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Program<span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" id="PROGRAM_NAME" name="PROGRAM_NAME" class="form-control required"
                       value="<?php echo ($ac_type == 'edit') ? $program->PROGRAM_NAME : ''; ?>"
                       placeholder="Enter Program Name">
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- B.sc in Computer Science & Engineering.</span>
            </div>
        </div>
 
        <div class="form-group">
            <label class="col-lg-3 control-label">Total Semester<span class="text-danger">*</span></label>

            <div class="col-lg-3">
                <input type="number" id="programName" name="TotalSemester" class="form-control required"
                       value="<?php echo ($ac_type == 'edit') ? $program->TOTAL_SESSION : ''; ?>"
                       placeholder="Total semester"/>
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- 12.</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">User Define Serial<span class="text-danger">*</span></label>

            <div class="col-lg-3">
                <input type="number" id="UD_SLNO" name="UD_SLNO" class="form-control required"
                       value="<?php echo ($ac_type == 'edit') ? $program->UD_SLNO : ''; ?>"
                        />
                <span class="validation"></span>
                
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Is Active ?</label>

            <div class="col-lg-8">
                <?php
                $ACTIVE_STATUS = ($ac_type == "edit") ? $program->ACTIVE_STATUS : '';
                $checked = ($ac_type == "edit") ? (($program->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-8">
                <span class="modal_msg pull-left"></span>
                <?php if ($ac_type == "edit") { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateProgram"
                           data-su-action="setup/programById" value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createProgram"
                           data-su-action="setup/programList" data-type="list" value="submit">
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
        $("#status").val(status);
    });
</script>