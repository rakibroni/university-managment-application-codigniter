<div class="block-flat">
    <form class="form-horizontal frmContent" id="district" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="txtDistrictId" value="<?php echo $district->DISTRICT_ID ?>"/>
        <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group"><label class="col-lg-3 control-label">Division Name<span
                    style="color: red"> *</span></label>

            <div class="col-lg-5">
                <?php echo form_dropdown("division", $division, ($ac_type == 2) ? $district->DIVISION_ID : '', "class='form-control required' id='division'") ?>

                <span class="validation"></span>
                <span class="help-block m-b-none">Example:-Division Name (Dhaka) text here.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group"><label class="col-lg-3 control-label">District Name<span
                    style="color: red"> *</span></label>

            <div class="col-lg-7">
                <input type="text" id="districtName" name="districtName"
                       value="<?php echo ($ac_type == 2) ? $district->DISTRICT_ENAME : '' ?>"
                       class="form-control required" placeholder="Enter District Name">
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- District Name (Gazipur) text here.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-3 control-label">Active?</label>

            <div class="col-lg-7">
                <?php
                $ACTIVE_FLAG = ($ac_type == 2) ? $district->ACTIVE_FLAG : '';
                $checked = ($ac_type == 2) ? (($district->ACTIVE_FLAG == '1') ? TRUE : FALSE) : '';
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
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateDistrict"
                           data-su-action="setup/districtById" value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createDistrict"
                           data-su-action="setup/districtList" data-type="list" value="submit">
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