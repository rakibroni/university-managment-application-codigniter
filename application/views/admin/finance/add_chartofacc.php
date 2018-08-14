<div class="block-flat">
    <form class="form-horizontal" id="account_head_form" action="" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" name="AC_NO" class="rowID" value="<?php echo $ac_head->AC_NO ?>"/>
            <?php
        }  else {?>
            <input type="hidden" class="form-control" name="parent_id" id="parent_id" value="<?php echo $parent_id; ?>">
        <?php }
        ?>
        <span class="frmMsg"></span>
        <div class="form-group">
            <label class="col-lg-4 control-label">Account Name<span class="text-danger">*</span></label>
            <div class="col-md-6">
                <input type="text" class="form-control required" name="AC_NAME" value="<?php echo $ac_type == 2 ? $ac_head->AC_NAME : ''?>">
                <span class="validation"></span>
            </div>
        </div>

        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-4 control-label">Account Code</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="AC_NO_UD" value="<?php echo $ac_type == 2 ? $ac_head->AC_NO_UD : ''?>">
                <span class="validation"></span>
            </div>
        </div>  
        <div class="hr-line-dashed"></div>
        <div class="form-group" id="BILLING_TYPE">
            <label class="col-lg-4 control-label">Bill Type</label>
            <div class="col-lg-6">
                <select class="Building_Type_dropdown form-control" name="BILLING_TYPE" id="BILLING_TYPE"
                        data-tags="true" data-placeholder="Select Bill Type" data-allow-clear="true">
                            <?php
                            if ($ac_type == "2"):
                                foreach ($bill_type as $row):
                                    ?>
                            <option
                                value="<?php echo $row->ABBR ?>" <?php echo ($ac_head->BILLING_TYPE == $row->ABBR) ? 'selected' : '' ?>><?php echo $row->LKP_NAME; ?></option>
                                <?php
                            endforeach;
                        else: // if the form action is VIEW
                            ?>
                        <option value="">--Select--</option>
                        <?php
                        foreach ($bill_type as $row):
                            ?>
                            <option value="<?php echo $row->ABBR ?>"><?php echo $row->LKP_NAME ?></option>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </select>
                <span class="validation"></span>
            </div>
        </div>   
        <div class="hr-line-dashed"></div>

        <div class="form-group">
            <label class="col-lg-4 control-label">Is Transection?</label>

            <div class="col-lg-6">

                <label class="control-label">
                    <?php
                    $checked = ($ac_type == 2) ? (($ac_head->TRANS_FLAG == '1') ? TRUE : FALSE) : '';
                    $data = array(
                        'name' => 'TRANS_FLAG',
                        'id' => 'TRANS_FLAG',
                        'checked' => $checked
                    );
                    echo form_checkbox($data);
                    ?>
                </label>

            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
            <label class="col-lg-4 control-label">Active?</label>

            <div class="col-lg-6">
                <?php
                $BUILDING_ACTIVE_STATUS = ($ac_type == 2) ? $ac_head->ACTIVE_STATUS : '';
                $checked = ($ac_type == 2) ? (($ac_head->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
                ?>
                <label class="control-label">
                    <?php
                    $data = array(
                        'name' => 'status',
                        'id' => 'status',
                        'class' => 'checkBoxStatus',
                        'value' => $BUILDING_ACTIVE_STATUS,
                        'checked' => $checked
                    );
                    echo form_checkbox($data);
                    ?>
                </label>

            </div>
        </div>  

        <div class="form-group">
            <div class="col-lg-offset-4 col-lg-8">
                <span class="modal_msg pull-left"></span>
                <?php if ($ac_type == 2) { ?>
                    <input type="button" class="btn btn-primary btn-sm form_submit" data-action="finance/updateAccHead"
                           data-su-action="finance/chartOfAccount" value="Update">
                       <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm form_submit" data-action="finance/createAccHead"
                           data-su-action="finance/chartOfAccount" data-type="list" value="submit">
                           <?php
                       }
                       ?>
                <input type="reset" class="btn btn-default btn-sm" value="Reset">
                <span class="loadingImg"></span>
            </div>
        </div>
    </form>
</div>
<div class="hr-line-dashed"></div>
</form>
</div>
<script>
    $(document).on('click', '.checkBoxStatus', function() {
        var status = ($(this).is(':checked')) ? 1 : 0;
        $("#status").val(status);
    });
</script>