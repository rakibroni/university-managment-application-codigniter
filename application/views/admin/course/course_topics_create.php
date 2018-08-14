<div class="block-flat">
    <form class="form-horizontal frmContent" id="course" method="post">
        <?php
        /*print_r($courseTopic);
        exit();*/
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="txtCourseTopicID" id="txtCourseTopicID" value="<?php echo $courseTopic->CRS_TOPIC_ID; ?>"/>
        <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="row">
            <div class="col-lg-12">
                <div class="form-group"><label class="col-lg-3 control-label"><span>Department</span>*</label>
                    <div class="col-lg-7">
                        <select class="select2Dropdown form-control" name="department" id="department" data-tags="true" data-placeholder="Select Department" data-allow-clear="true">
                            <option value="">Select Department</option>
                            <?php foreach ($department as $row): ?>
                                <?php if ($ac_type == 2) { ?>
                                    <option value="<?php echo $row->DEPT_ID; ?>" <?php echo ($courseTopic->DEPT_ID == $row->DEPT_ID) ? 'selected' : ''; ?>><?php echo $row->DEPT_NAME; ?></option>
                                <?php }else{ ?>
                                    <option value="<?php echo $row->DEPT_ID; ?>"><?php echo $row->DEPT_NAME; ?></option>
                                <?php } ?>
                            <?php endforeach; ?>
                        </select>                        
                        <span class="validation"></span>
                        <span class="help-block m-b-none">Example:- Business Administration.</span>
                    </div>
                </div>
                <div class="form-group"><label class="col-lg-3 control-label"><span>Course</span>*</label>

                    <div class="col-lg-9">
                        <select class="select2Dropdown form-control required" name="cmbCourses" id="cmbCourses" data-tags="true" data-placeholder="Select Course" data-allow-clear="true">
                            <?php if ($ac_type == 2) { ?>
                                <option
                                    value="<?php echo $courseTopic->COURSE_ID; ?>"><?php echo $courseTopic->COURSE_TITLE; ?></option>
                            <?php } else { ?>
                                <option value="">Select Course</option>
                            <?php
                            }
                            ?>
                        </select>
                        <span class="validation"></span>
                        <span class="help-block m-b-none">Example:- Principles of Management .</span>
                    </div>
                </div>
                <div class="form-group"><label class="col-lg-3 control-label"><span>Title</span>*</label>

                    <div class="col-lg-7">
                        <input type="text" id="topicTitle" name="topicTitle" class="form-control required"
                               value="<?php echo ($ac_type == 2) ? $courseTopic->TOPIC_TITLE : ''; ?>"
                               placeholder="Enter Topic Title">
                        <span class="validation"></span>
                        <span class="help-block m-b-none">Example:- Information text here.</span>
                    </div>
                </div>
                <div class="form-group"><label class="col-lg-3 control-label"><span>Topic Duration</span>*</label>

                    <div class="col-lg-7">
                        <div class="col-lg-7">
                            <input type="number" min="30" max="600" step="10" id="duration" name="duration"
                                   class="form-control required"
                                   value="<?php echo ($ac_type == 2) ? $courseTopic->TOPIC_DURATION : ''; ?>"
                                   placeholder="Enter Duraion Time">
                            <span class="validation"></span>
                            <span class="help-block m-b-none">Example:- 60 .</span>
                        </div>
                        <div class="col-lg-1"><span>Minutes</span></div>
                    </div>
                </div>
                <div class="form-group"><label class="col-lg-3 control-label"><span>Suggested Activities</span>*</label>

                    <div class="col-lg-7">
                        <input type="text" id="sugggestedAct" name="sugggestedAct" class="form-control required"
                               value="<?php echo ($ac_type == 2) ? $courseTopic->SUGGESTED_ACTIVITIES : ''; ?>"
                               placeholder="Enter Suggested Activities">
                        <span class="validation"></span>
                        <span class="help-block m-b-none">Example:- QUIZ, EXAM .</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><span>Description</span></label>

                    <div class="col-lg-9">
                        <textarea class="redactor"
                                  name="description"><?php echo ($ac_type == 2) ? $courseTopic->TOPIC_DESC : ''; ?></textarea>
                        <span class="validation"></span>
                        <span class="help-block m-b-none">Example:-  Programming Contest.</span>
                    </div>
                </div>

                <div class="form-group"><label class="col-lg-3 control-label">Active?</label>

                    <div class="col-lg-9">
                        <?php
                        $ACTIVE_STATUS = ($ac_type == 2) ? $courseTopic->ACTIVE_STATUS : '';
                        $checked = ($ac_type == 2) ? (($courseTopic->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
            </div>
        </div>
        <hr>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <span class="modal_msg pull-left"></span>
                <?php
                if ($ac_type == 2) {
                    ?>
                    <span class="btn btn-primary btn-sm formSubmit" data-action="course/updateCourseTopics"
                          data-su-action="course/courseTopicsById">Update</span>
                <?php } else {
                    ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit"
                           data-action="course/createCourseTopics" data-su-action="course/getCoursesTopics"
                           data-type="list" value="submit">
                <?php }
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

</script>
<script>
    $('#department').change(function () {
        var dept = $(this).val();
        var url = '<?php echo site_url('course/ajax_get_course') ?>';
        $.ajax({
            type: "POST",
            url: url,
            data: {dept: dept},
            dataType: 'html',
            success: function (data) {
                $('#cmbCourses').html(data);
            }
        });
    });
</script>
<style>
    .select2-container {
        z-index: 99999;
        width: 100% !important;
    }

    .pop-width {
        width: 25% !important;
    }

</style>