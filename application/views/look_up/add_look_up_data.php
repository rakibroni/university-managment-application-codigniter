<div class="block-flat">
    <div class="header">
        <!--        <h3>Add <i><?php echo $name; ?></i></h3>-->
    </div>
    <br>

    <form class="form-horizontal lookUpFrmContent" id="groups" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="LKP_ID" id="LKP_ID" value="<?php echo $look_up_id ?>"/>
            <input type="hidden" class="rowID" name="GRP_ID" id="GRP_ID" value="<?php echo $look_group_up_id ?>"/>
        <?php } else {
            ?>
            <input type="hidden" class="rowID" name="GRP_ID" id="GRP_ID" value="<?php echo $id ?>"/>
        <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group">
            <label class="col-sm-3 control-label">Name <span style="color: red">*</span></label>

            <div class="col-sm-5">
                <input type="text" id="LKP_NAME" name="LKP_NAME" class="form-control required"
                       value="<?php echo ($ac_type == 2) ? $previousInfo->LKP_NAME : ''; ?>" placeholder="Enter Name">

                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- LookUP Data here.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Active?</label>

            <div class="col-sm-7">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $previousInfo->ACT_FG : '1';
                $checked = ($ac_type == 2) ? (($previousInfo->ACT_FG == '1') ? TRUE : FALSE) : 'TRUE';
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
            <div class="col-lg-offset-3 col-lg-10">
                <span class="modal_msg pull-left"></span>
                <?php
                if ($ac_type == 2) {
                    ?>
                    <span class="btn btn-primary btn-sm lookUpFormSubmit" data-action="lookUp/updateLookUpData"
                          data-su-action="lookUp/lookUpById">Update</span>
                <?php } else {
                    ?>
                    <input type="button" class="btn btn-primary btn-sm lookUpFormSubmit"
                           data-action="lookUp/saveLookUpData" data-su-action="lookUp/getLookUpData" data-type="lookup"
                           value="submit">
                <?php }
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