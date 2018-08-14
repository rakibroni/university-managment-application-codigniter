<div class="block-flat">
    <form class="form-horizontal frmContent" id="district" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="BANK_BRANCH_ID" value="<?php echo $bank_branch->BANK_BRANCH_ID ?>"/>
        <?php
        }
        ?>
        <span class="frmMsg"></span>
        <div class="form-group">
            <label class="col-lg-3 control-label">Bank Name<span style="color: red"> *</span></label>
            <div class="col-lg-7">
                <select class="form-control" name="BANK_ID">
                    <option value="">-Select-</option>
                    <?php foreach($bank as $row): ?>
                    <option value="<?php echo $row->BANK_ID ?>"  <?php if(!empty( $bank_branch->BANK_ID))echo ($row->BANK_ID == $bank_branch->BANK_ID)?'selected':'' ;?>><?php echo $row->BANK_NAME ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Bank Branch Name<span style="color: red"> *</span></label>
            <div class="col-lg-7">
                <input type="text" id="BANK_BRANCH_NAME" name="BANK_BRANCH_NAME" value="<?php echo ($ac_type == 2) ? $bank_branch->BANK_BRANCH_NAME : '' ?>" class="form-control required" placeholder="Enter Bank Branch Name">
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- DBBL.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Bank Address<span style="color: red"> *</span></label>
            <div class="col-lg-7">
                <input type="text" id="ADDRESS" name="ADDRESS" value="<?php echo ($ac_type == 2) ? $bank_branch->ADDRESS : '' ?>" class="form-control required" placeholder="Enter Bank address">
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- </span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-3 control-label">Active?</label>
            <div class="col-lg-7">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $bank_branch->ACTIVE_STATUS : '';
                $checked = ($ac_type == 2) ? (($bank_branch->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
            <div class="col-lg-offset-2 col-lg-10">
                <span class="modal_msg pull-left"></span>
                <?php if ($ac_type == 2) { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateBankBranch" data-su-action="setup/bankBranchById" value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createBankBranch" data-su-action="setup/bankBranchList" data-type="list" value="submit">
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