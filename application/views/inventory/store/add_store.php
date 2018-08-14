<div class="block-flat">
    <form class="form-horizontal frmContent" id="inventory" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="txtStoreId" value="<?php echo $store->STORE_ID ?>"/>
            <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group"><label class="col-lg-3 control-label">Store Name<span
                        class="text-danger">*</span></label>

            <div class="col-lg-8">
                <input type="text" id="storeName" name="storeName"
                       value="<?php echo ($ac_type == 2) ? $store->STORE_NAME : '' ?>" class="form-control required"
                       placeholder="Enter Store Name">
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- Store Name.</span>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-3 control-label">Description</label>

            <div class="col-lg-8">
                <input type="text" id="description" name="description"
                       value="<?php echo ($ac_type == 2) ? $store->DESC : '' ?>" class="form-control"
                       placeholder="Enter Description">
                <span class="help-block m-b-none">Example:- Description.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-3 control-label">Active?</label>

            <div class="col-lg-8">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $store->ACTIVE_STATUS : '';
                $checked = ($ac_type == 2) ? (($store->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
                <span class="help-block m-b-none">Example click checkbox .</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-10">
                <span class="modal_msg pull-left"></span>
                <?php if ($ac_type == 2) { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateStore"
                           data-su-action="setup/storeById" value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createStore"
                           data-su-action="setup/storeList" data-type="list" value="submit">
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