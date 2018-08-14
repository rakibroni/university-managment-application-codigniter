<div class="block-flat">
    <form class="form-horizontal frmContent" id="inventory" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="txtOpnBlnId" value="<?php echo $item_info->STOCK_ID ?>"/>
            <?php
        }
        ?>
        <span class="frmMsg"></span>
        <div class="form-group"><label class="col-lg-3 control-label">Item Name<span
            class="text-danger">*</span></label>
            <div class="col-lg-8">
                <select class="item_dropdown form-control required" name="itemName" id="ITEM_ID"
                data-tags="true" data-placeholder="Select Item" data-allow-clear="true">
                <?php if ($ac_type==2) : ?>
                    <option value="">Select Item</option>
                    <?php foreach ($item_name as $row) : ?>
                        <option value="<?php echo $row->ITEM_ID ?>" <?php echo ($item_info->ITEM_ID == $row->ITEM_ID) ? 'selected' : '' ?>><?php echo $row->ITEM_NAME ?></option>
                        <?php
                    endforeach; 
                    else : ?>
                    <option value="">Select Item</option>
                    <?php foreach ($item_name as $row) : ?>
                        <option value="<?php echo $row->ITEM_ID ?>"><?php echo $row->ITEM_NAME ?></option>
                    <?php endforeach;
                    endif; ?>
                </select>
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-3 control-label">Quantity<span
            class="text-danger">*</span></label></label>

            <div class="col-lg-8">
                <input type="text" id="quantity" name="quantity"
                value="<?php echo ($ac_type == 2) ? $item_info->OPENING : '' ?>" class="form-control"
                placeholder="Enter Quantity">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-3 control-label">Active?</label>

            <div class="col-lg-8">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $item_info->ACTIVE_STATUS : '';
                $checked = ($ac_type == 2) ? (($item_info->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
                <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="inventory/updateOpeningBln"
                data-su-action="inventory/openingBlnById" value="Update">
                <?php } else { ?>
                <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="inventory/createOpeningBln"
                data-su-action="inventory/openingBlnList" data-type="list" value="submit">
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