<link href="<?php echo base_url(); ?>assets/css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">

        <div class="col-lg-3">
            <div class="ibox-content">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Faculty</label>
                        <select name="FACULTY_ID" id="FACULTY_ID" class="form-control">
                            <option value="">-Select-</option>
                            <?php foreach ($faculty as $row): ?>
                                <option value="<?php echo $row->
                                FACULTY_ID ?>">
                                    <?php echo $row->FACULTY_NAME ?></option>
                            <?php endforeach; ?></select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Department</label>
                        <select class="form-control select2Dropdown" id="DEPARTMENT_ID">
                            <option value="">-Select-</option>

                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control" id="GENDER">
                            <option value="">-Select-</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                            <option value="O">Others</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Religion</label>
                        <select class="form-control" id="RELIGION">
                            <option value="">-Select-</option>
                            <?php foreach ($religion as $row): ?>
                                <option value="<?php echo $row->
                                LKP_ID ?>">
                                    <?php echo $row->LKP_NAME ?></option>
                            <?php endforeach; ?></select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Blood Group</label>
                        <select class="form-control" id="BLOOD_GROUP">
                            <option value="">-Select-</option>
                            <?php foreach ($blood_group as $row): ?>
                                <option value="<?php echo $row->
                                LKP_ID ?>">
                                    <?php echo $row->LKP_NAME ?></option>
                            <?php endforeach; ?></select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Merital Status</label>
                        <select class="form-control" id="MERITAL_STATUS">
                            <option value="">-Select-</option>
                            <?php foreach ($merital_status as $row): ?>
                                <option value="<?php echo $row->
                                LKP_ID ?>">
                                    <?php echo $row->LKP_NAME ?></option>
                            <?php endforeach; ?></select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Skills</label>
                        <select class="form-control js-data-example-ajax" id="SKILL_ID">
                            <option value="">-Select-</option>
                            <?php foreach ($skills as $row): ?>
                                <option value="<?php echo $row->
                                SKILL_ID ?>">
                                    <?php echo $row->NAME ?></option>
                            <?php endforeach; ?></select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Publishe</label>
                        <input type="text" class="form-control"></div>
                </div>
                <div class="col-md-2 pull-right" style="margin-right:25px">
                        <span id="btn_facult_search" class="btn btn-xs btn-success"> <i class="fa fa-search"></i>
                            Search
                        </span>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="ibox-content">
                    <span id="teacher_list">
                        <div class="table-responsive contentArea">
                            <table class="table table-striped table-bordered table-hover gridTable">
                                <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Designation</th>

                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($teachers)) {
                                    $sl = 1;
                                    foreach ($teachers as $row) { ?>
                                        <tr>
                                            <td>
                                                <?php echo $sl++; ?></td>
                                            <td class="text-center">
                                                <?php $tr_pic = 'assets/img/default.png';
                                                if (!empty($row->USER_IMG)) $tr_pic = 'upload/faculty_teacher/' . $row->USER_IMG; ?>
                                                <div class="lightBoxGallery">
                                                    <a href="<?php echo base_url($tr_pic); ?>
                                                    " title="Faculty Teacher Photo" data-gallery="">
                                                        <img width="30" src="<?php echo base_url($tr_pic); ?>"></a>

                                                </div>

                                            </td>
                                            <td>
                                                <?php echo $row->FULL_NAME ?></td>
                                            <td>
                                                <?php echo $row->DESIGNATION ?></td>

                                            <td class="text-center">
                                                <a class="btn btn-primary btn-xs teacher_details" type="button"
                                                   data-user-id="<?php echo $row->USER_ID ?>" data-toggle="modal"
                                                   data-target="#teacher_modal"> <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php }
                                } ?></tbody>
                                <tfoot>

                                </tfoot>
                            </table>
                        </div>
                    </span>
            </div>
        </div>

<div id="blueimp-gallery" class="blueimp-gallery">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
<div class="modal inmodal fade" id="teacher_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Teacher Details</h4>

            </div>
            <div class="modal-body"></div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
<script type="text/javascript">
    $(".teacher_details").on("click", function () {
        var teacher_id = $(this).attr('data-user-id');

        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>teacher/teacherModal',
            data: {teacher_id: teacher_id},
            success: function (data) {
                $("#teacher_modal .modal-body").html(data);
            }
        });
    });
    $("#FACULTY_ID").on("change", function () {
        var faculty_id = $("#FACULTY_ID").val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>common/departmentByFaculty',
            data: {faculty_id: faculty_id},
            success: function (data) {
                $("#DEPARTMENT_ID").html(data);
            }
        });
    });
    $("#btn_facult_search").on('click', function () {
        var department_id = $("#DEPARTMENT_ID").val();
        var GENDER = $("#GENDER").val();
        var RELIGION = $("#RELIGION").val();
        var BLOOD_GROUP = $("#BLOOD_GROUP").val();
        var MERITAL_STATUS = $("#MERITAL_STATUS").val();
        var SKILL_ID = $("#SKILL_ID").val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>common/teacherSearchList',
            data: {
                department_id: department_id,
                GENDER: GENDER,
                RELIGION: RELIGION,
                MERITAL_STATUS: MERITAL_STATUS,
                SKILL_ID: SKILL_ID,
                BLOOD_GROUP: BLOOD_GROUP
            },
            beforeSend: function () {
                $("#teacher_list").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $("#teacher_list").html(data);
            }
        });
    });


</script>