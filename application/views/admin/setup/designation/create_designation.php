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
            <input type="hidden" class="rowID" name="txtDegnaionId" value="<?php echo $designation->DESIG_ID ?>"/>
        <?php
        }
        ?>
        <span class="frmMsg"></span>


       
        <div class="form-group">
            <label class="col-lg-3 control-label">Designation<span class="text-danger">*</span></label>

            <div class="col-lg-7">
                <input type="text" id="designation" name="designation" class="form-control required"
                       value="<?php echo ($ac_type == 'edit') ? $designation->DESIGNATION : ''; ?>"
                       placeholder="Enter Designation">
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- Lecturer, HR Executive .</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Is Active ?</label>

            <div class="col-lg-7">
                <?php
                $ACTIVE_STATUS = ($ac_type == "edit") ? $designation->ACTIVE_STATUS : '';
               // echo $ACTIVE_STATUS;
                $checked = ($ac_type == "edit") ? (($designation->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
                //echo $checked;
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
                   // var_dump($data);
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
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateDesignation"
                           data-su-action="setup/designationById" value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createDesignation"
                           data-su-action="setup/designationList" data-type="list" value="submit">
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