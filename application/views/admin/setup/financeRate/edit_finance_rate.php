<style>
    .select2-container {
        z-index: 999999;
    }
</style>
<div class="block-flat">
    <form class="form-horizontal frmContent" id="financeRate" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="txtRateId" value="<?php echo $financeRate->RATE_ID ?>"/>
        <?php
        }
        ?>
        <span class="frmMsg"></span>
        <div class="hr-line-dashed"></div>
         <div class="form-group">
            <label class="col-lg-3 control-label">Academic Session<span class="text-danger">*</span></label>
              <div class="col-lg-5">
                <select class="Degrees_dropdown form-control required" name="SESSION_ID" id="SESSION_ID"
                        data-tags="true" data-placeholder="Select Session" data-allow-clear="true">
                    <?php
                    if ($ac_type == 2): // if the form action is EDIT
                        foreach ($ins_session as $row):
                            ?>
                            <option
                                value="<?php echo $row->YSESSION_ID ?>" <?php echo ($financeRate->SESSION_ID == $row->SESSION_ID) ? 'selected' : '' ?>><?php echo $row->SESSION_NAME ?></option>
                        <?php
                        endforeach;
                    else: // if the form action is VIEW
                        ?>
                        <option value="">Select Session</option>
                        <?php
                        foreach ($ins_session as $row):
                            ?>
                            <option value="<?php echo $row->YSESSION_ID ?>"><?php echo $row->SESSION_NAME ?></option>
                        <?php
                        endforeach;
                    endif; ?>
                </select>
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Program<span class="text-danger">*</span></label>

            <div class="col-lg-5">
                <select class="Degrees_dropdown form-control required" name="PROGRAM_ID" id="PROGRAM_ID"
                        data-tags="true" data-placeholder="Select Program" data-allow-clear="true">
                    <?php
                    if ($ac_type == 2): // if the form action is EDIT
                        foreach ($program as $row):
                            ?>
                            <option
                                value="<?php echo $row->PROGRAM_ID ?>" <?php echo ($financeRate->PROGRAM_ID == $row->PROGRAM_ID) ? 'selected' : '' ?>><?php echo $row->PROGRAM_NAME ?></option>
                        <?php
                        endforeach;
                    else: // if the form action is VIEW
                        ?>
                        <option value="">Select Program</option>
                        <?php
                        foreach ($program as $row):
                            ?>
                            <option value="<?php echo $row->PROGRAM_ID ?>"><?php echo $row->PROGRAM_NAME ?></option>
                        <?php
                        endforeach;
                    endif; ?>
                </select>
                <span class="validation"></span>
            </div>
        </div>
         <div class="hr-line-dashed"></div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Account Name<span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="Degrees_dropdown form-control required" name="AC_NO" id="AC_NO"
                        data-tags="true" data-placeholder="Select Charge" data-allow-clear="true">
                    <?php
                    if ($ac_type == 2): // if the form action is EDIT
                        foreach ($charge as $row):
                            ?>
                            <option
                                value="<?php echo $row->AC_NO ?>" <?php echo ($financeRate->AC_NO == $row->AC_NO) ? 'selected' : '' ?>><?php echo $row->AC_NAME ?></option>
                        <?php
                        endforeach;
                    else: // if the form action is VIEW
                        ?>
                        <option value="">Select Charge</option>
                        <?php
                        foreach ($ac_AC_NAME as $row):
                            ?>
                            <option value="<?php echo $row->AC_NO ?>"><?php echo $row->AC_NAME ?></option>
                        <?php
                        endforeach;
                    endif; ?>
                </select>
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 pop-width control-label">Amount <span class="text-danger">*</span></label>
             <div class="col-lg-5">
                <input type="text" id="AMOUNT" name="AMOUNT" class="form-control required"
                       value="<?php echo ($ac_type == 2) ? $financeRate->AMOUNT : ''; ?>"
                       placeholder="Enter Amount">
                <span class="validation"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Is Active ?</label>

            <div class="col-lg-8">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $financeRate->ACTIVE_STATUS : '';
                $checked = ($ac_type == 2) ? (($financeRate->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
            <div class="col-lg-offset-3 col-lg-8">
                <span class="modal_msg pull-left"></span>
                <?php if ($ac_type == 2) { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="finance/updateFinanceRate"
                           data-su-action="finance/financeRateById" value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="finance/createFinanceRate"
                           data-su-action="finance/financeRateList" data-type="list" value="submit">
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
        var status = ($(this).is(':checked')) ? 1 : 0;
        $("#status").val(status);
    });
</script>
