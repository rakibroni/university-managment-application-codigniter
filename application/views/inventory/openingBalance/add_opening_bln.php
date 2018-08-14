<div class="block-flat">
    <form class="form-horizontal frmContent" id="faculty1" method="post">
       <?php
       if ($ac_type == 2) {
        ?>
        <input type="hidden" class="rowID" name="txtOpnBlnId" value="<?php echo $item_info->STOCK_ID ?>"/>
        <?php
    }
    ?>
    <span class="frmMsg"></span>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <table class="table table-bordered">
            <tr>
                <td class="col-md-3">Item Name</td>
                <td class="col-md-1 text-center">Quantity</td>
            </tr>
            <?php foreach ($item_name as $row):?>
                <tr>
                    <input  value="<?php echo $row->ITEM_ID?>" type="hidden" class="checked" name="ITEM_ID[]">
                    <td>
                        <?php echo $row->ITEM_NAME ?>
                    </td>
                    <td>
                        <input type="text" id="Quantity" name="Quantity[]" class="form-control text-center" value="" placeholder="" required>
                    </td>
                </tr>
            <?php endforeach;?>
        </table>
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

    </div>
</div><br>
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
<br>
</form>
</div>
<script>
    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });
</script>