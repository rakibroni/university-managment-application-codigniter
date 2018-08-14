<div class="block-flat">
    <form class="form-horizontal frmContent" id="faculty" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" name="txtFacultyId" class="rowID" value="<?php echo $faculty->FACULTY_ID; ?>"/>
            <?php
        }
        ?>
        <span class="frmMsg"></span>
        <div class="form-group"><label class="col-lg-4 control-label">Faculty Name<span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" id="facultyName" name="facultyName"
                value="<?php echo ($ac_type == 2) ? $faculty->FACULTY_NAME : '' ?>" class="form-control required"
                placeholder="Enter Faculty Name">
                <span class="validation"></span>
                <span class="help-block m-b-none ">Example:- Faculty of Bachelor of Arts.</span>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-4 control-label">User Define SL. No.<span class="text-danger">*</span></label>
            <div class="col-lg-2">
                <input type="text" id="UD_SLNO" name="UD_SLNO"
                value="<?php echo ($ac_type == 2) ? $faculty->UD_SLNO : '' ?>" class="form-control required"
                 >
                
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Active ?</label>
            <div class="col-lg-9">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $faculty->ACTIVE_STATUS : '';
                $checked = ($ac_type == 2) ? (($faculty->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
                        echo form_checkbox($data); ?>
                    </label>
                    <span class="help-block m-b-none">Example:- click checkbox .</span>
                </div>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-10">
                <span class="modal_msg pull-left"></span>
                <?php if ($ac_type == 2) { ?>
                <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateFaculty"
                data-su-action="setup/facultyById" value="Update">
                <?php } else { ?>
                <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createFaculty"
                data-su-action="setup/facultyList" data-type="list" value="submit">
                <?php
            }
            ?>
            <input type="reset" class="btn btn-default btn-sm" value="Reset">
            <span class="loadingImg"></span>
        </div>
    </div>
     <br>
</form>
</div>
<script>
    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });
</script>
<script>
    $(document).on('click', '.checkBoxOffice', function () {
        var office = ($(this).is(':checked')) ? 1 : 0;
        $("#ADMINISTRATION").val(office);
    });
</script>