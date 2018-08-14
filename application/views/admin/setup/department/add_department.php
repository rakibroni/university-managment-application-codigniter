<style>
    .select2-container {
        z-index: 999999;
    }
</style>
<div class="block-flat">
    <form class="form-horizontal frmContent" id="department" method="post">
        <?php
        if ($ac_type == "edit") {
            ?>
            <input type="hidden" class="rowID" name="txtDepartmentId" value="<?php echo $department->DEPT_ID ?>"/>
        <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group">
            <label class="col-lg-3 pop-width control-label">Faculty<span
                    class="text-danger">*</span></label>

            <div class="col-lg-7">
                <?php if ($ac_type == "edit"): // if the form action is EDIT ?>
                    <select
                        class="select2DropdownModal select2Dropdown faculty_dropdown form-control commonClass required"
                        name="FACULTY_ID" id="FACULTY_ID" data-tags="true" data-placeholder="Select Faculty"
                        data-allow-clear="true">
                        <option>Select Faculty</option>
                        <?php foreach ($faculty as $row): ?>
                            <option
                                value="<?php echo $row->FACULTY_ID; ?>" <?php echo ($department->FACULTY_ID == $row->FACULTY_ID) ? 'selected' : ''; ?>><?php echo $row->FACULTY_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="FAC_DEPT_ID" value="<?php echo ($department->FAC_DEPT_ID !='') ? $department->FAC_DEPT_ID : ''  ?>">
                <?php else: // if the form action is VIEW ?>
                    <select class="select2Dropdown faculty_dropdown form-control commonClass" name="FACULTY_ID"
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
            <label class="col-lg-3 control-label">Department<span class="text-danger">*</span></label>

            <div class="col-lg-7">
                <input type="text" id="deptFullName" name="deptFullName" class="form-control required"
                       value="<?php echo ($ac_type == 'edit') ? $department->DEPT_NAME : ''; ?>"
                       placeholder="Enter Department Name">
                <span class="validation"></span>
                <span class="help-block m-b-none ">Example:- Computer Science and Engineering.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Short Name<span class="text-danger">*</span></label>

            <div class="col-lg-7">
                <input type="text" id="deptShortName" name="deptShortName" class="form-control required"
                       value="<?php echo ($ac_type == 'edit') ? $department->DEPT_ABBR : ''; ?>"
                       placeholder="Enter Department Short Name">
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- CSE.</span>
            </div>
        </div>       
         <div class="form-group">
            <label class="col-lg-3 control-label">User Define SL. No.<span class="text-danger">*</span></label>

            <div class="col-lg-7">
                <input type="text" id="UD_SLNO" name="UD_SLNO" class="form-control required"
                       value="<?php echo ($ac_type == 'edit') ? $department->UD_SLNO : ''; ?>"
                       placeholder="Enter User define serial no">
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- 1.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Active ?</label>

            <div class="col-lg-7">
                <?php
                $ACTIVE_STATUS = ($ac_type == "edit") ? $department->ACTIVE_STATUS : '';
                $checked = ($ac_type == "edit") ? (($department->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-9">
                <span class="modal_msg pull-left"></span>
                <?php if ($ac_type == "edit") { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateDepartment"
                           data-su-action="setup/departmentList" data-type="list" value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createDepartment"
                           data-su-action="setup/departmentList" data-type="list" value="submit">
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
