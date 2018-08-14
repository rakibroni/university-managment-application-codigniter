<div class="block-flat">
    <form class="form-horizontal frmContent" id="course" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="txtCourseID" id="txtCourseID"
                   value="<?php echo $course->COURSE_ID; ?>"/>
        <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="row">
            <div class="col-lg-12">
                <div class="form-group"><label class="col-lg-3 control-label"><span>Department</span>*</label>

                    <div class="col-lg-8">
                        <?php echo form_dropdown("cmbDepartments", $departments, ($ac_type == 2) ? $course->DEPT_ID : '', "class='form-control required' id='cmbDepartments'") ?>
                        <span class="validation"></span>
                        <span class="help-block m-b-none">Example:- Computer Science & Engineering.</span>
                    </div>
                </div>
                <div class="form-group"><label class="col-lg-3 control-label"><span>Title</span>*</label>

                    <div class="col-lg-8">
                        <input type="text" id="courseTitle" name="courseTitle" class="form-control required"
                               value="<?php echo ($ac_type == 2) ? $course->COURSE_TITLE : ''; ?>"
                               placeholder="Enter Course Title">
                        <span class="validation"></span>
                        <span class="help-block m-b-none">Example:- Computer Fundamental.</span>
                    </div>
                </div>
                <div class="form-group"><label class="col-lg-3 control-label">
                        <samn>Code</samn>
                        *</label>

                    <div class="col-lg-4">
                        <input type="text" id="courseCode" name="courseCode" class="form-control required"
                               value="<?php echo ($ac_type == 2) ? $course->COURSE_CODE : ''; ?>"
                               placeholder="Enter Course Code">
                        <span class="validation"></span>
                        <span class="help-block m-b-none">Example:- CSE 101, ENG 101.</span>
                    </div>
                </div>
                <div class="form-group"><label class="col-lg-3 control-label"><span>Credit</span>*</label>

                    <div class="col-lg-4">
                        <input type="number" id="courseCredit" name="courseCredit" class="form-control required"
                               value="<?php echo ($ac_type == 2) ? $course->CREDIT : ''; ?>"
                               placeholder="Enter Course Credit">
                        <span class="validation"></span>
                        <span class="help-block m-b-none">Example:- 1.5, 3.0</span>
                    </div>
                </div>

                <div class="form-group"><label class="col-lg-3 control-label">Category</label>

                    <div class="col-lg-4">
                        <?php echo form_dropdown("cmbCategory", $category, ($ac_type == 2) ? $course->C_CAT_ID : '', "class='form-control' id='cmbCategory'") ?>
                        <span class="help-block m-b-none">Example:- GED, Core.</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><span>Description</span></label>

                    <div class="col-lg-9">
                        <textarea class="redactor"
                                  name="content"><?php echo ($ac_type == 2) ? $course->COURSE_DESC : ''; ?></textarea>
                        <span class="validation"></span>
                        <span class="help-block m-b-none">Example:- Course Description.</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><span>Books</span></label>

                    <div class="col-lg-9">
                        <textarea class="redactor"
                                  name="BOOKS"><?php echo ($ac_type == 2) ? $course->BOOKS : ''; ?></textarea>
                        <span class="validation"></span>
                        <span class="help-block m-b-none">Example:-  Introduction to Database Systems by CJ Date</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><span>Teaching Method</span></label>

                    <div class="col-lg-9">
                        <textarea class="redactor"
                                  name="TEACHING_METHOD"><?php echo ($ac_type == 2) ? $course->TEACHING_METHOD : ''; ?></textarea>
                        <span class="validation"></span>
                        <span class="help-block m-b-none">Example:- Teaching Method details.</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><span>Mission</span></label>

                    <div class="col-lg-9">
                        <textarea class="redactor"
                                  name="MISSION"><?php echo ($ac_type == 2) ? $course->MISSION : ''; ?></textarea>
                        <span class="validation"></span>
                        <span class="help-block m-b-none">Example:- Course Mission details.</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><span>Vision</span></label>

                    <div class="col-lg-9">
                        <textarea class="redactor"
                                  name="VISION"><?php echo ($ac_type == 2) ? $course->VISION : ''; ?></textarea>
                        <span class="validation"></span>
                        <span class="help-block m-b-none">Example:- Course Vision details.</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><span>Objective</span></label>

                    <div class="col-lg-9">
                        <textarea class="redactor"
                                  name="OBJECTIVE"><?php echo ($ac_type == 2) ? $course->OBJECTIVE : ''; ?></textarea>
                        <span class="validation"></span>
                        <span class="help-block m-b-none">Example:- Course Objective details.</span>
                    </div>
                </div>

                
                <div class="form-group"><label class="col-lg-3 control-label">Active?</label>

                    <div class="col-lg-9">
                        <?php
                        $ACTIVE_STATUS = ($ac_type == 2) ? $course->ACTIVE_STATUS : '';
                        $checked = ($ac_type == 2) ? (($course->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
                    <span class="btn btn-primary btn-sm formSubmit" data-action="course/updateCourse"
                          data-su-action="course/courseById">Update</span>
                <?php } else {
                    ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="course/createCourse"
                           data-su-action="course/getCourses" data-type="list" value="submit">
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
    $(document).on('click', '.checkBoxFaculty', function () {
        var Faculty = ($(this).is(':checked')) ? 1 : 0;
        $("#Faculty").val(Faculty);
    });
    $(document).on('click', '.checkBoxInstitute', function () {
        var Institute = ($(this).is(':checked')) ? 1 : 0;
        $("#Institute").val(Institute);
    });
</script>