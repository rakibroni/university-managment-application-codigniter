<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

<div class="block-flat">
    <form class="form-horizontal frmContent" id="exam_grade" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="txtexam_gradeId" value="<?php echo $exam_grade->GR_ID ?>"/>
            <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group"><label class="col-lg-4 control-label">Grade Policy<span
                        class="text-danger">*</span></label>

            <div class="col-lg-6">
                <select class="Degrees_dropdown form-control required" name="GR_POLICY_ID" id="GR_POLICY_ID"
                        data-tags="true" data-placeholder="Select Session" data-allow-clear="true">
                    <?php
                    if ($ac_type == 2): ?>  // if the form action is EDIT
                        <option value="">Select Grade Policy</option>
                        <?php foreach ($exam_policy as $row):
                            ?>
                            <option
                                    value="<?php echo $row->GR_POLICY_ID ?>" <?php echo ($exam_grade->GR_POLICY_ID == $row->GR_POLICY_ID) ? 'selected' : '' ?>><?php echo $row->GR_POLICY_NAME ?></option>
                            <?php
                        endforeach;
                    else: // if the form action is VIEW
                        ?>
                        <option value="">Select Grade Policy</option>
                        <?php
                        foreach ($exam_policy as $row):
                            ?>
                            <option value="<?php echo $row->GR_POLICY_ID ?>"><?php echo $row->GR_POLICY_NAME ?></option>
                            <?php
                        endforeach;
                    endif; ?>
                </select>
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group"><label class="col-lg-4 control-label">Marks From<span
                        class="text-danger">*</span></label>
            <div class="col-lg-2">
                <input type="number" name="mark_start" class="form-control required"
                       value="<?php echo ($ac_type == 2) ? $exam_grade->GR_MARKS_FROM : '' ?>">
                <span class="validation"></span>
            </div>
            <div class="col-lg-1 text-center">
                <span><b>To</b><span
                            class="text-danger">*</span></span>
            </div>

            <div class="col-lg-2">
                <input type="number" name="mark_end" class="form-control  required"
                       value="<?php echo ($ac_type == 2) ? $exam_grade->GR_MARKS_TO : '' ?>">
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group"><label class="col-lg-4 control-label">Grade Letter<span
                        class="text-danger">*</span></label>
            <div class="col-lg-2">
                <input type="text" name="grade_letter" class="form-control required"
                       value="<?php echo ($ac_type == 2) ? $exam_grade->GR_LETTER : '' ?>">
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group"><label class="col-lg-4 control-label">Grade Point<span
                        class="text-danger">*</span></label>
            <div class="col-lg-2">
                <input type="number" name="grade_point" class="form-control required"
                       value="<?php echo ($ac_type == 2) ? $exam_grade->GRADE_POINT : '' ?>">
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group"><label class="col-lg-4 control-label">Active?</label>

            <div class="col-lg-6">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $exam_grade->GRADE_ACTIVE_STATUS : '';
                $checked = ($ac_type == 2) ? (($exam_grade->GRADE_ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="exam/updateGrade"
                           data-su-action="exam/gradeById" value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="exam/createGrade"
                           data-su-action="exam/gradeList" data-type="list" value="submit">
                    <?php
                }
                ?>
                <input type="reset" class="btn btn-default btn-sm" value="Reset">
                <span class="loadingImg"></span>
            </div>
        </div>
    </form>
</div>

<script src="<?php echo base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script>
    $(function () {
        $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy',
            yearRange: "-50:+0",
            autoclose: true,
            startDate: '-0d',
        });
    });

    $(document).on('click', '#status', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });
</script>