<div class="block-flat">
    <form class="form-horizontal frmContent" id="union" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="txtUnionId" value="<?php echo $union->UNION_ID ?>"/>
        <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group"><label class="col-lg-3 control-label">Thana Name<span
                    style="color: red"> *</span></label>

            <div class="col-lg-5">
                <?php echo form_dropdown("thana", $thana, ($ac_type == 2) ? $union->THANA_ID : '', "class='form-control required' id='thana'") ?>
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- Thana Name (Uttara) text here.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-3 control-label">Union Name<span
                    style="color: red"> *</span></label>

            <div class="col-lg-7">
                <input type="text" id="unionName" name="unionName"
                       value="<?php echo ($ac_type == 2) ? $union->UNION_NAME : '' ?>" class="form-control required"
                       placeholder="Enter Union Name">
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- Union Name (Hons) text here.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-3 control-label">Active?</label>

            <div class="col-lg-7">
                <?php
                $ACTIVE_FLAG = ($ac_type == 2) ? $union->ACTIVE_FLAG : '';
                $checked = ($ac_type == 2) ? (($union->ACTIVE_FLAG == '1') ? TRUE : FALSE) : '';
                ?>
                <label class="control-label">
                    <?php
                    $data = array(
                        'name' => 'status',
                        'id' => 'status',
                        'class' => 'checkBoxStatus',
                        'value' => $ACTIVE_FLAG,
                        'checked' => $checked,
                    );
                    echo form_checkbox($data);
                    ?>
                </label>
                <span class="help-block m-b-none">Example click checkbox .</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <span class="modal_msg pull-left"></span>
                <?php if ($ac_type == 2) { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateUnion"
                           data-su-action="setup/unionById" value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createUnion"
                           data-su-action="setup/unionList" data-type="list" value="submit">
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
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });
</script>