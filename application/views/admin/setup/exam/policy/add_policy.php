

<div class="block-flat">
    <form class="form-horizontal frmContent" id="grade_policy" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="txtgrade_policyId" value="<?php echo $grade_policy->GR_POLICY_ID ?>"/>
            <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group"><label class="col-lg-4 control-label">Name<span
                    class="text-danger">*</span></label>

            <div class="col-lg-6">
                <input type="text" id="grade_policy_Name" name="grade_policy_Name"
                       value="<?php echo ($ac_type == 2) ? $grade_policy->GR_POLICY_NAME : '' ?>" class="form-control required"
                       placeholder="Enter Exam Grade Policy Name">
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- </span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group"><label class="col-lg-4 control-label">Description<span
                    class="text-danger">*</span></label>

            <div class="col-lg-6">
                <textarea id="grade_policy_Desc" name="grade_policy_Desc" class="form-control required"
                          placeholder="Enter Exam Grade Policy Description"><?php echo ($ac_type == 2) ?  $grade_policy->GR_POLICY_DESC : '' ?></textarea>
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- </span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group"><label class="col-lg-4 control-label">Start Date<span
                    class="text-danger">*</span></label>
            <div class="col-lg-3">
                <input type="text" name="start_date" class="form-control datepicker required" value="<?php echo ($ac_type == 2) ? date('d-m-Y', strtotime($grade_policy->START_DATE))  : '' ?>">
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group"><label class="col-lg-4 control-label">End Date<span
                    class="text-danger">*</span></label>
            <div class="col-lg-3">
                <input type="text" name="end_date" class="form-control datepicker required" value="<?php echo ($ac_type == 2) ? date('d-m-Y', strtotime($grade_policy->END_DATE))  : '' ?>" >
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group"><label class="col-lg-4 control-label">Active?</label>

            <div class="col-lg-6">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $grade_policy->ACTIVE_STATUS : '';
                $checked = ($ac_type == 2) ? (($grade_policy->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
        <div class="form-group">
            <div class="col-lg-offset-4 col-lg-8">
                <span class="modal_msg pull-left"></span>
                <?php if ($ac_type == 2) { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="exam/updatePolicy"
                           data-su-action="exam/policyById" value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="exam/createPolicy"
                           data-su-action="exam/policyList" data-type="list" value="submit">
                    <?php
                }
                ?>
                <input type="reset" class="btn btn-default btn-sm" value="Reset">
                <span class="loadingImg"></span>
            </div>
        </div>
    </form>
</div>


