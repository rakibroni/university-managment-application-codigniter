
<div class="block-flat">
    <form class="form-horizontal frmContent" id="exam_grade" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="txtexam_gradeId" value="<?php echo $exam_grade_sheet->EXAM_GRADE_SHEET_ID ?>"/>
            <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group"> 
           <label class="col-lg-4 control-label">Degree<span
            class="text-danger">*</span></label>
            <div class="col-lg-6">
                <select class="form-control required" name="DEGREE_ID" id="DEGREE_ID" >
                    <option value="">--- Select Degree ---</option>
                    <?php foreach ($ins_degree as $row) { ?> 
                    <option value="<?php echo $row->DEGREE_ID ?>"><?php echo $row->DEGREE_NAME ?></option>
                    <?php } ?>
                </select> 
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-lg-4 control-label">Department<span
                class="text-danger">*</span></label>

                <div class="col-lg-6">
                    <select class="form-control required select2Dropdown" name="dept_id" id="dept_id"
                    >
                    <?php
                    if ($ac_type == 2): ?>  // if the form action is EDIT
                    <option value="">--- Select department ---</option>
                    <?php foreach ($ins_dept as $row):
                    ?>
                    <option
                    value="<?php echo $row->DEPT_ID ?>" <?php  echo ($exam_grade_sheet->DEPT_ID == $row->DEPT_ID) ? 'selected' : '' ?>><?php echo $row->DEPT_NAME ?></option>
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
        <div class="form-group"><label class="col-lg-4 control-label">Exam Type<span
            class="text-danger">*</span></label>
            <div class="col-lg-6">
                <select class="Degrees_dropdown form-control required" name="EXAM_TYPE_ID" id="EXAM_TYPE_ID"
                data-tags="true" data-placeholder="Select Department" data-allow-clear="true">
                <?php
                if ($ac_type == 2): ?>  // if the form action is EDIT
                <option value="">--- Select Exam Type ---</option>
                <?php foreach ($exam_type as $row):
                ?>
                <option
                value="<?php echo $row->DEPT_ID ?>" <?php  echo ($exam_grade_sheet->DEPT_ID == $row->DEPT_ID) ? 'selected' : '' ?>><?php echo $row->DEPT_NAME ?></option>
                <?php
                endforeach;
                    else: // if the form action is VIEW
                    ?>
                    <option value="">--- Select Exam Type ---</option>
                    <?php
                    foreach ($exam_type as $row):
                        ?>
                    <option value="<?php echo $row->EXAM_TYPE_ID ?>"><?php echo $row->EXAM_TITLE ?></option>
                    <?php
                    endforeach;
                    endif; ?>
                </select>
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>




        <div class="form-group">
            <div class="col-lg-12">
                <div id="charge_table">
                    <table class="table table-bordered">
                        <tr>
                            <td class="col-md-1 text-center"><input type="checkbox" name="" id="checkAll"> #</td>
                            <td class="col-md-3"><b>Exam Marks Type</b></td>
                            <td class="col-md-1 text-center"><b>Percentage</b></td>
                        </tr>
                        <?php foreach ($exam_marks_type as $row):?>
                            <tr>
                                <td class="text-center"><input name="mark_type[]"  value="<?php echo $row->EXAM_MARKS_TYPE_ID ?>" type="checkbox" class="checked"</td>
                                <td><?php echo $row->MARKS_TITLE ?></td>
                                <td>
                                    <input type="number" id="MARK_PERCENTAGE" name="MARK_PERCENTAGE_<?php echo $row->EXAM_MARKS_TYPE_ID ?>" class="form-control text-center" value="" placeholder="">
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </table>
                </div>
                <span class="validation"></span>
            </div>
        </div>



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
                <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="exam/updateGrade"
                data-su-action="exam/gradeById" value="Update">
                <?php } else { ?>
                <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="exam/createGradeSheet"
                data-su-action="exam/gradeSheetList" data-type="list" value="submit">
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

    $("#checkAll").click(function(){
        $('.checked').not(this).prop('checked', this.checked);
    });
 
</script>