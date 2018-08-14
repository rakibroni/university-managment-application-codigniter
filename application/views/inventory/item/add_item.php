<style>
    .select2-container {
        z-index: 999999;
    }

    .pop-width {
        width: 25% !important;
    }
</style>
<div class="block-flat">
    <form class="form-horizontal frmContent" id="item" method="post">
        <?php
        if ($ac_type == "edit") {
            ?>
            <input type="hidden" class="rowID" name="txtitemId" value="<?php echo $item_info->ITEM_ID; ?>"/>
            <?php
        }  else {?>
            <input type="hidden" class="rowID" name="parent_id" value="<?php echo $parent_id; ?>"/>
        <?php }
        ?>
          <span class="frmMsg"></span>
         <div class="form-group">
            <label class="col-md-4 control-label">Item Name</label>

            <div class="col-md-6">
                <input type="text" id="ItemName" name="ItemName" class="form-control required"
                       value="<?php echo ($ac_type == 'edit') ? $item_info->ITEM_NAME : ''; ?>"
                       placeholder="Item Name">
            </div>
        </div>

        <div class="hr-line-dashed"></div>

        <div class="form-group">
            <label class="col-md-4 control-label">Code</label>

            <div class="col-md-6">
                <input type="text" id="code" name="code" class="form-control"
                       value="<?php echo ($ac_type == 'edit') ? $item_info->ITEM_CODE : ''; ?>"
                       placeholder="Item Code">
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
            <label class="col-lg-4 control-label">Unit Name</label>
            <div class="col-lg-6">
                <select class="item_dropdown form-control required" name="UNIT_ID" id="UNIT_ID"
                        data-tags="true" data-placeholder="Select Unit" data-allow-clear="true">
                    <?php
                    if ($ac_type == "edit"): // if the form action is EDIT
                        foreach ($unit as $row):
                            ?>
                            <option
                                value="<?php echo $row->UNIT_ID ?>" <?php echo ($item_info->UNIT_ID == $row->UNIT_ID) ? 'selected' : '' ?>><?php echo $row->UNIT_NAME; ?></option>
                            <?php
                        endforeach;
                    else: // if the form action is VIEW
                        ?>
                        <option value="">Select Unit</option>
                        <?php
                        foreach ($unit as $row):
                            ?>
                            <option value="<?php echo $row->UNIT_ID ?>"><?php echo $row->UNIT_NAME ?></option>
                            <?php
                        endforeach;
                    endif; ?>
                </select>
            </div>
        </div>

        <div class="hr-line-dashed"></div>

        <div class="form-group">
            <label class="col-md-4 control-label"><span>Description</span></label>

            <div class="col-md-6">
                <textarea class="col-md-12"
                          name="description"><?php echo ($ac_type == 'edit') ? $item_info->DESC : ''; ?></textarea>
            </div>
        </div>
<div class="hr-line-dashed"></div>


        <div class="form-group"><label class="col-md-4 control-label">Is Item?</label>

            <div class="col-md-6">
                <?php
                $IS_ITEM = ($ac_type == "edit") ? $item_info->IS_ITEM : '';
                $checked = ($ac_type == "edit") ? (($item_info->IS_ITEM == '1') ? TRUE : FALSE) : '';
                ?>
                <label class="control-label">
                    <?php
                    $data = array(
                        'name' => 'is_item',
                        'id' => 'is_item',
                        'class' => 'checkBoxStatus',
                        'value' => $IS_ITEM,
                        'checked' => $checked,
                    );
                    echo form_checkbox($data);
                    ?>
                </label>
                <span class="help-block m-b-none">Click on checkbox for This is item.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>


        <div class="form-group"><label class="col-md-4 control-label">Active?</label>

            <div class="col-md-6">
                <?php
                $ACTIVE_STATUS = ($ac_type == "edit") ? $item_info->ACTIVE_STATUS : '';
                $checked = ($ac_type == "edit") ? (($item_info->ACTIVE_STATUS == '1') ? TRUE : FALSE) : TRUE;
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
                <span class="help-block m-b-none">Click on checkbox for active status.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-lg-offset-4 col-lg-10">
                <?php if ($ac_type == "edit") { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="inventory/updateItem"
                           data-su-action="inventory/itemById" value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="inventory/createItem"
                           data-su-action="inventory/itemList" data-type="list" value="Submit">
                    <?php
                }
                ?>
                <input type="reset" class="btn btn-default btn-sm" value="Reset">
                <span class="loadingImg"></span>
            </div>
        </div>

    </form>
</div>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/redactor/redactor.css"/>
<script src="<?php echo base_url(); ?>assets/redactor/redactor.min.js"></script>

<script type="text/javascript">
    $(document).ready(
        function () {
            $('.redactor').redactor();
        }
    );
</script>
<script>
    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked')) ? 1 : 0;
        $("#status").val(status);


    });
    $(".select2DropdownMulti").select2({
        tags: true
    });
</script>