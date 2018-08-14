<div class="block-flat">
    <form class="form-horizontal frmContent" id="department" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="txtcourseCategoryId"
                   value="<?php echo $courseCategory->C_CAT_ID ?>"/>
        <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group">
            <label class="col-lg-3 control-label">Name*</label>

            <div class="col-lg-5">
                <input type="text" id="catName" name="catName" class="form-control required"
                       value="<?php echo ($ac_type == 2) ? $courseCategory->CAT_NAME : ''; ?>"
                       placeholder="Enter Category Name">
                <span class="validation"></span>
                <span class="help-block m-b-none ">Example:- Fundamental text here .</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Description*</label>

            <div class="col-lg-8">
                <input type="text" id="description" name="description" class="form-control required"
                       value="<?php echo ($ac_type == 2) ? $courseCategory->CAT_DESC : ''; ?>"
                       placeholder="Enter Description">
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- Fundamental description text here .</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Color*</label>

            <div class="col-lg-4">
                <input type="color" id="color" name="color" class="form-control required"
                       value="<?php echo ($ac_type == 2) ? $courseCategory->CAT_COLOR : '#ff0000'; ?>">
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- color  here .</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Sequence*</label>

            <div class="col-lg-2">
                <input type="text" id="sequence" name="sequence" class="form-control required"
                       value="<?php echo ($ac_type == 2) ? $courseCategory->SEQUENCE : ''; ?>">
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:-1,2.</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Is Active ?</label>

            <div class="col-lg-9">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $courseCategory->ACTIVE_STATUS : '';
                $checked = ($ac_type == 2) ? (($courseCategory->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
            <div class="col-lg-offset-3 col-lg-9">
                <span class="modal_msg pull-left"></span>
                <?php if ($ac_type == 2) { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit"
                           data-action="Course/updateCourseCategory" data-su-action="Course/courseCategoryById"
                           value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit"
                           data-action="Course/createCourseCategory" data-su-action="Course/courseCategoryList"
                           data-type="list" value="submit">
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
<script>
    $(document).on('click', '.checkBoxOffice', function () {
        var office = ($(this).is(':checked')) ? 1 : 0;
        $("#office").val(office);
    });
</script>