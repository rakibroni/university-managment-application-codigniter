<link href="<?php echo base_url(); ?>assets/css/plugins/chosen/chosen.css" rel="stylesheet" />
<div class="">
    <form class="form-horizontal" id="course_mapping_form"   >
        <div class="col-md-6">
            <div class="ibox-title">
                <h5>Teacher Course Mapping </h5>
            </div>
            <div class="ibox-content">
                <?php $this->load->view("common/faculty_dept_program"); ?>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Course</label>
                    <div class="col-lg-7">
                        <select class="select2Dropdown  form-control required" name="COURSE_ID" ID="COURSE_ID_LIST"  data-tags="true" data-placeholder="Select Course" data-allow-clear="true">
                            <option>Select Course</option>
                        </select>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Teacher </label>
                    <div class="col-lg-4">
                        <select name="MODERATOR_ID[]" ID="MODERATOR_ID_LIST" data-placeholder="Select Teacher"
                                class="chosen-select" multiple style="width:350px;" tabindex="4">
                            <option>Select Teacher</option>
                        </select>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-lg-offset-4 col-lg-10">
                        <span class="modal_msg pull-left"></span>
                        <input type="button" id="course_mapping_btn" class="btn btn-primary btn-sm" value="submit">
                        <input type="reset" class="btn btn-default btn-sm" value="Reset">
                        <span class="loadingImg"></span>
                    </div>
                </div>
            </div>
        </div>
         <div class="col-md-6">
            <div class="ibox-title">
                <h5>Assigned Teacher </h5>
            </div>
            <div class="ibox-content">
                <div id="tr_list_by_course_id"></div>
            </div>
        </div>
    </form>
</div>
<script src="<?php echo base_url(); ?>assets/js/plugins/chosen/chosen.jquery.js"></script>
<script>
    var config = {
        '.chosen-select': {},
        '.chosen-select-deselect': {allow_single_deselect: true},
        '.chosen-select-no-single': {disable_search_threshold: 10},
        '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
        '.chosen-select-width': {width: "95%"}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
    $(document).on('change','#COURSE_ID_LIST', function () {
        var course_id = $(this).val();
        if(course_id != null) {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url();?>admin/trListByCourseId',
                data: {course_id: course_id},
                success: function (data) {
                    $('#tr_list_by_course_id').html(data);
                }
            });
        }
    });
    $(document).on('change', '#DEPT_ID', function () {
        var department_id = $(this).val();
        if(department_id != "") {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() ?>common/teacherByDepartment',
                data: {department_id: department_id},
                success: function (data) {
                    $('#MODERATOR_ID_LIST').html(data).trigger('chosen:updated');
                }
            });
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() ?>common/courseListByDepId',
                data: {department_id: department_id},
                success: function (data) {
                    $('#COURSE_ID_LIST').html(data);
                }
            });
        }
    });
    $(document).on('click','#course_mapping_btn', function(e){
        e.preventDefault();
        if (confirm("Are You Sure?")) {
            var form_data = $("#course_mapping_form");
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>admin/saveCourseMapping',
                data: form_data.serialize(),
                success: function (data) {
                    if(data == 'Y'){
                        alert("Course mapped successfully");
                        location.reload();
                    }
                }

            });
        }else{
            return false;
        }
    });
</script>