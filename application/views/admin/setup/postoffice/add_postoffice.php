<div class="block-flat">
    <form class="form-horizontal frmContent" id="postoffice" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="txtPostofficeId"
                   value="<?php echo $postoffice->POST_OFFICE_ID ?>"/>
        <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group"><label class="col-lg-4 control-label">District<span style="color: red"> *</span></label>

            <div class="col-lg-5">
                <?php echo form_dropdown("district", $district, ($ac_type == 2) ? $postoffice->DISTRICT_ID : '', "class='form-control required' id='district'") ?>
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- Select District here.</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-4 control-label">Thana Name<span style="color: red"> *</span></label>

            <div class="col-lg-5">
                <select class="select2_demo_1 form-control required" name="thana" id="thana">
                    <?php
                    if ($ac_type == 2) { ?>
                        <option
                            value="<?php echo $postoffice->THANA_ID; ?>"><?php echo $postoffice->THANA_ENAME; ?></option>
                    <?php } else { ?>
                        <option value="">Select Thana</option>
                    <?php
                    }
                    ?>
                </select>
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- Select Thana here.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-4 control-label">Post Office Name<span style="color: red"> *</span></label>

            <div class="col-lg-7">
                <input type="text" id="PostofficeName" name="PostofficeName"
                       value="<?php echo ($ac_type == 2) ? $postoffice->POST_OFFICE_ENAME : '' ?>"
                       class="form-control required" placeholder="Enter Post Office  Name">
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- Post Office  Name (Hons) text here.</span>
            </div>
        </div>

        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-4 control-label">Post Code<span
                    style="color: red"> *</span></label>

            <div class="col-lg-4">
                <input type="text" id="PostcodeName" name="PostcodeName"
                       value="<?php echo ($ac_type == 2) ? $postoffice->POST_CODE : '' ?>" class="form-control required"
                       placeholder="Enter Post Code">
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- Post Code(1703) Number here.</span>
            </div>
        </div>

        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-4 control-label">Active?</label>

            <div class="col-lg-7">
                <?php
                $ACTIVE_FLAG = ($ac_type == 2) ? $postoffice->ACTIVE_FLAG : '';
                $checked = ($ac_type == 2) ? (($postoffice->ACTIVE_FLAG == '1') ? TRUE : FALSE) : '';
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
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updatePostoffice"
                           data-su-action="setup/postofficeById" value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createPostoffice"
                           data-su-action="setup/postofficeList" data-type="list" value="submit">
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
    $(document).ready(function () {

        $('#district').change(function () {
            var district_id = $(this).val();
            var url = '<?php echo site_url('setup/ajax_get_district') ?>';
            $.ajax({
                type: "POST",
                url: url,
                data: {district: district_id},
                dataType: 'html',
                success: function (data) {
                    $('#thana').html(data);
                }
            });
        });
    });
</script>