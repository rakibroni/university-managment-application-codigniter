<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

<div class="block-flat">
    <form class="form-horizontal frmContent" id="exam_type" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="txtexam_typeId" value="<?php echo $exam_type->EXAM_TYPE_ID ?>"/>
            <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group"><label class="col-lg-4 control-label">Exam Title<span
                        class="text-danger">*</span></label>
            <div class="col-lg-6">
                <input type="text" name="exam_title" class="form-control required"
                       value="<?php echo ($ac_type == 2) ? $exam_type->EXAM_TITLE : '' ?>">
                <span class="validation"></span>
            </div>

        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group"><label class="col-lg-4 control-label">Description<span
                        class="text-danger">*</span></label>

            <div class="col-lg-6">
                <textarea id="exam_type_Desc" name="exam_type_Desc" class="form-control required"
                          placeholder="Enter Exam Type Description"><?php echo ($ac_type == 2) ? $exam_type->EX_DESC : '' ?></textarea>
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- </span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group"><label class="col-lg-4 control-label">Active?</label>

            <div class="col-lg-6">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $exam_type->ACTIVE_STATUS : '';
                $checked = ($ac_type == 2) ? (($exam_type->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="exam/updateExamType"
                           data-su-action="exam/examTypeById" value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="exam/createExamType"
                           data-su-action="exam/examTypeList" data-type="list" value="submit">
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
    $(document).on('click', '#status', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });
</script>