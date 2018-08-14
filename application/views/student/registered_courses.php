<div class="wrapper wrapper-content">
    <div class="">
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                   <b>Courses</b>


                    <div class="col-md-6 pull-right">
                        <select id="SESSION_ID" class=" form-control" >
                            <option value="0">-Session-</option>
                            <?php foreach ($session_info as $row): ?>
                                <option
                                    value="<?php echo $row->SESSION_ID ?>" <?php echo ($sem_session->SEM_SESSION == $row->SESSION_ID) ? 'selected' : '' ?>><?php echo $row->SESSION_NAME ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>
                <div class="ibox-content">
                    <div class="file-manager">

                        <ul style="padding: 0" class="folder-list"> 
                            <span id="course_list">
                                <?php foreach ($current_reg_course as $rc): ?>
                                    <li style="background-color: lightyellow;padding: 4px"><span
                                            class="courseList pointer" data-course-id="<?php echo $rc->COURSE_ID ?>"><i
                                                class="fa fa-folder "></i> <span class="label label-info"
                                                                                 style="padding: 1px !important"><b><?php echo $rc->COURSE_CODE ?></span>&nbsp;&nbsp;<?php echo $rc->COURSE_TITLE ?></b></span>
                                    </li>
                                <?php endforeach; ?>
                            </span>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div >
                        <?php
                        if (!empty($all_course_content)) {
                            foreach ($all_course_content as $row):
                                ?>
                                <div class="file-box">
                                    <div class="file">
                                        <a href="<?php echo base_url() ?>upload/course_content/<?php echo $row->CONTENT_URI ?>"
                                           target="_blank">
                                            <span class="corner"></span>

                                            <div class="icon">
                                                <i class="<?php $file_parts = pathinfo($row->CONTENT_URI);
                                                if ($file_parts["extension"] == "pdf") {
                                                    echo "fa fa-file-pdf-o";
                                                } else if ($file_parts["extension"] == "doc" || "docx") {
                                                    echo 'fa fa-file-word-o';
                                                } else {
                                                    echo "fa fa-file";
                                                }?>"></i>
                                            </div>
                                            <div class="file-name">
                                                <?php echo $row->CONTENT_TITLE;?>
                                                <br>
                                                <small>
                                                    Added:  <?php echo date('d-M-Y', strtotime($row->CREATE_DATE)) ?></small>
                                                <i class="fa fa-download pull-right"></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php
                            endforeach;
                        } else { ?>



                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Course Content</h5>

                                <div class="ibox-tools"></div>
                            </div>
                            <div class="ibox-content" id="file_content">
                            <?php  echo "Click a course to view content"; ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.file-box').each(function () {
            animationHover(this, 'pulse');
        });
    });
    $(document).on('click', '.courseList', function () {
        var course_id = $(this).attr("data-course-id");
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>student/conByCorss',
            data: {course_id: course_id},
            beforeSend: function () {
                $("#file_content").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $("#file_content").html(data);
            }
        });
    });
    $(document).on('change', '#SESSION_ID', function () {
        var session_id = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>student/coursesBySession',
            data: {session_id: session_id},
            beforeSend: function () {
                $("#course_list").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                if (data) {
                    $("#course_list").html(data);
                } else {
                    $("#course_list").html("Please select session to view course list");
                }
            }
        });
    });
</script>