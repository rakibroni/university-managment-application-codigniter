<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

<div class="block-flat">
    <form class="form-horizontal frmContent" id="exam_grade" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="txtexam_gradeId"
                   value="<?php echo $exam_grade_sheet->EXAM_GRADE_SHEET_ID ?>"/>
            <?php
        }
        ?>
        <span class="frmMsg"></span>


        <div class="form-group"><label class="col-lg-4 control-label">Degree<span
                        class="text-danger">*</span></label>

       
            <div class="col-lg-6">
                <select class="Degrees_dropdown form-control required" name="DEGREE_ID" id="DEGREE_ID"
                        data-tags="true" data-placeholder="Select Degree" data-allow-clear="true">
                    <?php
                    if ($ac_type == 2): ?>  // if the form action is EDIT
                        <option value="">--- Select department ---</option>
                        <?php foreach ($ins_degree as $row):
                            ?>
                            <option
                                    value="<?php echo $row->DEGREE_ID ?>" <?php echo ($exam_grade_sheet->DEGREE_ID == $row->DEGREE_ID) ? 'selected' : '' ?>><?php echo $row->DEGREE_NAME ?></option>
                            <?php
                        endforeach;
                    else: // if the form action is VIEW
                        ?>
                        <option value="">--- Select department ---</option>
                        <?php
                        foreach ($ins_dept as $row):
                            ?>
                            <option value="<?php echo $row->DEPT_ID ?>"><?php echo $row->DEPT_NAME ?></option>
                            <?php
                        endforeach;
                    endif; ?>
                </select>
                <span class="validation"></span>
            </div>
        </div>        
        <div class="form-group"><label class="col-lg-4 control-label">Department<span
                        class="text-danger">*</span></label>

       
            <div class="col-lg-6">
                <select class="Degrees_dropdown form-control required" name="dept_id" id="dept_id"
                        data-tags="true" data-placeholder="Select Department" data-allow-clear="true">
                    <?php
                    if ($ac_type == 2): ?>  // if the form action is EDIT
                        <option value="">--- Select department ---</option>
                        <?php foreach ($ins_dept as $row):
                            ?>
                            <option
                                    value="<?php echo $row->DEPT_ID ?>" <?php echo ($exam_grade_sheet->DEPT_ID == $row->DEPT_ID) ? 'selected' : '' ?>><?php echo $row->DEPT_NAME ?></option>
                            <?php
                        endforeach;
                    else: // if the form action is VIEW
                        ?>
                        <option value="">--- Select department ---</option>
                        <?php
                        foreach ($ins_dept as $row):
                            ?>
                            <option value="<?php echo $row->DEPT_ID ?>"><?php echo $row->DEPT_NAME ?></option>
                            <?php
                        endforeach;
                    endif; ?>
                </select>
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group"><label class="col-lg-4 control-label">Exam Type<span
                        class="text-danger">*</span></label>

            <div class="col-lg-6">
                <select class="form-control required" name="EXAM_TYPE_ID" id="EXAM_TYPE_ID"
                        data-tags="true" data-placeholder="Select Exam Type" data-allow-clear="true">
                    <?php
                    if ($ac_type == 2): ?>  // if the form action is EDIT
                        <option value="">--- Select Exam Type ---</option>
                        <?php foreach ($exam_type as $row):
                            ?>
                            <option
                                    value="<?php echo $row->EXAM_TYPE_ID ?>" <?php echo ($exam_grade_sheet->EXAM_TYPE_ID == $row->EXAM_TYPE_ID) ? 'selected' : '' ?>><?php echo $row->EXAM_TITLE ?></option>
                            <?php
                        endforeach;
                    else: // if the form action is VIEW
                        ?>
                        <option value="">--- Select Exam Type ---</option>
                        <?php
                        foreach ($exam_marks_type as $row):
                            ?>
                            <option value="<?php echo $row->EXAM_MARKS_TYPE_ID ?>"><?php echo $row->MARKS_TITLE ?></option>
                            <?php
                        endforeach;
                    endif; ?>
                </select>
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>      
          <div class="form-group"><label class="col-lg-4 control-label">Marks Type<span
                        class="text-danger">*</span></label>

            <div class="col-lg-6">
                <select class="form-control required" name="exam_marks_type" id="exam_marks_type"
                        data-tags="true" data-placeholder="Select Exam Type" data-allow-clear="true">
                    <?php
                    if ($ac_type == 2): ?>  // if the form action is EDIT
                        <option value="">--- Select Exam Type ---</option>
                        <?php foreach ($exam_marks_type as $row):
                            ?>
                            <option
                                    value="<?php echo $row->EXAM_MARKS_TYPE_ID ?>" <?php echo ($exam_grade_sheet->EXAM_MARKS_TYPE_ID == $row->EXAM_MARKS_TYPE_ID) ? 'selected' : '' ?>><?php echo $row->MARKS_TITLE ?></option>
                            <?php
                        endforeach;
                    else: // if the form action is VIEW
                        ?>
                        <option value="">--- Select Exam Type ---</option>
                        <?php
                        foreach ($exam_marks_type as $row):
                            ?>
                            <option value="<?php echo $row->EXAM_MARKS_TYPE_ID ?>"><?php echo $row->MARKS_TITLE ?></option>
                            <?php
                        endforeach;
                    endif; ?>
                </select>
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group"><label class="col-lg-4 control-label">Percentage<span
                        class="text-danger">*</span></label>
            <div class="col-lg-3">
                <input type="text" name="exam_marks_percentage" class="form-control required"
                       value="<?php echo ($ac_type == 2) ? $exam_grade_sheet->MARKS_PER : '' ?>">
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div> 

        <div class="form-group"><label class="col-lg-4 control-label">Active?</label>

            <div class="col-lg-6">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $exam_grade_sheet->ACTIVE_STATUS : '';
                $checked = ($ac_type == 2) ? (($exam_grade_sheet->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="exam/updateGradeSheet"
                           data-su-action="exam/gradeSheetById" value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="exam/createGradeSheet"
                           data-su-action="exam/" data-type="list" value="submit">
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