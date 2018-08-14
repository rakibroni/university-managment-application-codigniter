<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/jquery-ui.datepicker.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/bootstrap-multiselect.css" rel="stylesheet">
<div class="col-md-3">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div class="file-manager">
                <h5>Show:</h5>
                <a class="file-control active" href="#">Ale</a>
                <a class="file-control" href="#">Documents</a>
                <a class="file-control" href="#">Audio</a>
                <a class="file-control" href="#">Images</a>

                <div class="hr-line-dashed"></div>
                <a class="btn btn-primary btn-block" href="<?php echo base_url(); ?>teacher/addCourseContent"> Add New </a>
                <div class="hr-line-dashed"></div>
                <a class="btn btn-primary btn-block" id="btnDisCr" href="#"> Distributed </a>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-9 animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
            <form id="contentForm" method="post">
                <?php
                $i = 1;
                foreach ($course_content as $cc):
                    ?>
                    <div class="file-box">
                        <div class="file">
                            <input type="checkbox" class="pull-right C_CONTENT_ID" name="corConId[]"
                                   value="<?php echo $cc->C_CONTENT_ID ?>">
                            <?php
                            $url = '';
                            if (!empty($cc->CONTENT_URI)) {
                                $url = 'upload/course_content/' . $cc->CONTENT_URI;
                            }
                            ?>
                            <a href="<?php echo base_url($url); ?>" target="_blank">
                                <span class="corner"></span>

                                <div class="icon">
                                    <i class="<?php $file_parts = pathinfo($cc->CONTENT_URI);
                                    if ($file_parts["extension"] == "pdf") {
                                        echo "fa fa-file-pdf-o";
                                    } else if ($file_parts["extension"] == "doc" || "docx") {
                                        echo 'fa fa-file-word-o';
                                    }?>"></i>
                                </div>
                                <div class="file-name">
                                    <?php echo $cc->CONTENT_TITLE ?>
                                    <br/>
                                    <small>
                                        Added: <?php echo date('M - d - Y', strtotime($cc->CREATE_DATE)) ?></small>
                                    <i class="fa fa-download pull-right"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </form>
        </div>
    </div>
</div>
<div class="modal inmodal contentModal">
    <div class="modal-dialog">
        <div class="modal-content animated">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title">Distribute Course Content</h4>
                <small class="font-bold"></small>
            </div>
            <div class="modal-body" id="disBody">
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-white closeModal" type="button">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/bootstrap-multiselect.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
    $(document).ready(function () {
        $('.file-box').each(function () {
            animationHover(this, 'pulse');
        });
    });
    jQuery('[data-dismiss="modal"]').on('click', function () {
        jQuery('.modal').hide();
        jQuery('.modal-backdrop').hide();
    });
    $(document).on('click', '#btnDisCr', function () {
        if ($('input[name="corConId[]"]:checked').is(':checked') == false) {
            alert("Please select at least one content to distribute");
        } else {

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>teacher/addConDis',
                data: $('#contentForm').serialize(),
                success: function (data) {
                    $('.contentModal').show();
                    $("#disBody").html(data);
                }
            });

        }
    });

    $(function () {
        $(function () {
            $(".datepicker").datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: '1950:+0'
            });
        });
    });
    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });
    $(document).on('change', '#FACULTY_ID', function () {
        $('#PROGRAM_ID').html("");
        $('#COURSE_ID').html("");
        var faculty_id = $(this).val();

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>common/departmentByFaculty',
            data: {faculty_id: faculty_id},
            beforeSend: function () {
                $("#DEPARTMENT_ID").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $('#DEPARTMENT_ID').html(data);
            }
        });
    });
    $(document).on('change', '#DEPARTMENT_ID', function () {
        var department_id = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>common/programByDepartment',
            data: {department_id: department_id},
            beforeSend: function () {
                $("#PROGRAM_ID").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $('#PROGRAM_ID').html(data);
            }
        });
    });
    $(document).on('change', '#PROGRAM_ID', function () {
        var PROGRAM_ID = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>teacher/getCourseByProgramFromCourseOffer',
            data: {PROGRAM_ID: PROGRAM_ID},
            beforeSend: function () {
                $("#COURSE_ID").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $('#COURSE_ID').html(data);
            }
        });
    });
    $(document).on('submit', '#conDis', function () {
        if (!$('.C_CONTENT_ID').is(':checked')) {
            alert("Please Select at least one course note.If empty please insert course note");
            return false;
        }
    });
</script>