<style>
    .select2-container {
        z-index: 999999;
    }
</style>
<form class="form-horizontal frmContent" id="grade" method="post">
    <div class="block-flat">
        <?php if ($ac_type == 2) { ?>
            <input type="hidden" name="gradeId" class="rowID" value="<?php echo $grade->GR_ID; ?>"/>
        <?php } ?>
        <span class="frmMsg"></span>

        <div class="form-group">
            <label class="col-lg-3 control-label">Degree</label>

            <div class="col-lg-8">
                <?php if ($ac_type == 2): // if the form action is EDIT ?>
                    <select class="select2Dropdown form-control required" name="DEGREE_ID" id="DEGREE_ID"
                            data-tags="true" data-placeholder="Select Degree" data-allow-clear="true">
                        <option value="">Select Degree</option>
                        <?php foreach ($degree as $row): ?>
                            <option
                                value="<?php echo $row->DEGREE_ID; ?>" <?php echo ($grade->DEGREE_ID == $row->DEGREE_ID) ? 'selected' : ''; ?>><?php echo $row->DEGREE_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php else: // if the form action is VIEW ?>
                    <select class="select2Dropdown form-control required" name="DEGREE_ID" id="DEGREE_ID"
                            data-tags="true" data-placeholder="Select Degree" data-allow-clear="true">
                        <option value="">Select Degree</option>
                        <?php foreach ($degree as $row): ?>
                            <option value="<?php echo $row->DEGREE_ID; ?>"><?php echo $row->DEGREE_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
                <span class="validation"></span>
                <span class="help-block m-b-none ">e.g. Graduate Program.</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Grade Policy</label>

            <div class="col-lg-8">
                <?php if ($ac_type == 2): // if the form action is EDIT ?>
                    <select class="select2Dropdown form-control required" name="GR_POLICY_ID" id="GR_POLICY_ID"
                            data-tags="true" data-placeholder="Select Grade Policy" data-allow-clear="true">
                        <option value="">Select Grade Policy</option>
                        <?php foreach ($grade_policy as $row): ?>
                            <option
                                value="<?php echo $row->GR_POLICY_ID; ?>" <?php echo ($grade->GR_POLICY_ID == $row->GR_POLICY_ID) ? 'selected' : ''; ?>><?php echo $row->GR_POLICY_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php else: // if the form action is VIEW ?>
                    <select class="select2Dropdown form-control required" name="GR_POLICY_ID" id="GR_POLICY_ID"
                            data-tags="true" data-placeholder="Select Grade Policy" data-allow-clear="true">
                        <option value="">Select Grade Policy</option>
                        <?php foreach ($grade_policy as $row): ?>
                            <option
                                value="<?php echo $row->GR_POLICY_ID; ?>"><?php echo $row->GR_POLICY_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
                <span class="validation"></span>
                <span class="help-block m-b-none ">e.g. Exam Administration .</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-3 control-label">Marks From</label>

            <div class="col-lg-3">
                <div id="data_1">
                    <div class="input-group date">
                        <input type="number" min="0.00" max="100" step="0.10" name="GR_MARKS_FROM" class="form-control"
                               value="<?php echo ($ac_type == 2) ? $grade->GR_MARKS_FROM : '' ?>" placeholder='00.00'>
                    </div>
                </div>
                <span class="validation"></span>
                <span class="help-block m-b-none ">e.g.  60.00</span>
            </div>
            <label class="col-lg-2 control-label">Marks To</label>

            <div class="col-lg-3">
                <div id="data_1">
                    <div class="input-group date">
                        <input type="number" min="0.00" max="100" step="0.10" name="GR_MARKS_TO" class="form-control"
                               value="<?php echo ($ac_type == 2) ? $grade->GR_MARKS_TO : '' ?>" placeholder='00.00'>
                    </div>
                </div>
                <span class="validation"></span>
                <span class="help-block m-b-none ">e.g. 64.00</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-3 control-label">Letter Grade</label>

            <div class="col-lg-3">
                <div id="data_1">
                    <div class="input-group date">
                        <input type="text" name="GR_LETTER" class="form-control required"
                               value="<?php echo ($ac_type == 2) ? $grade->GR_LETTER : '' ?>">
                    </div>
                </div>
                <span class="validation"></span>
                <span class="help-block m-b-none ">e.g.  A</span>
            </div>
            <label class="col-lg-2 control-label">Grade Point</label>

            <div class="col-lg-3">
                <div id="data_1">
                    <div class="input-group date">
                        <input type="number" min="0.00" max="5" step="0.10" id="GRADE_POINT" name="GRADE_POINT"
                               class="form-control" value="<?php echo ($ac_type == 2) ? $grade->GRADE_POINT : '' ?>"
                               placeholder='00.00'>
                    </div>
                </div>
                <span class="validation"></span>
                <span class="help-block m-b-none ">e.g.  3.50</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-3 control-label">Active?</label>

            <div class="col-lg-8">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $grade->ACTIVE_STATUS : '';
                $checked = ($ac_type == 2) ? (($grade->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
                <span class="help-block m-b-none">click for active status.</span>
            </div>
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <div class="col-lg-offset-3 col-lg-10">
            <!--<span class="modal_msg pull-left"></span>-->
            <?php if ($ac_type == 2) { ?>
                <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="Coe/updateGrade"
                       data-su-action="Coe/gradeById" value="Update">
            <?php } else { ?>
                <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="Coe/createGrade"
                       data-su-action="Coe/gradeList" data-type="list" value="Submit">
            <?php
            }
            ?>
            <input type="reset" class="btn btn-default btn-sm" value="Reset">
            <span class="loadingImg"></span>
        </div>
    </div>
</form>


<script type="text/javascript">

    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked')) ? 1 : 0;
        $("#status").val(status);

    });
    $(document).ready(function () {
        $("#GRADE_POINT").html("00.00");
    });
</script>
