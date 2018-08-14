
    <form id="frmCourseOffer">
        <div class=" ">
            <div class="col-md-12 white-bg">
                <div class="form-horizontal  bd-col">
                    <label class="col-sm-2 control-label">Program</label>
                    <div class="col-md-5">
                        <select class="select2Dropdown form-control" name="PROGRAM_ID" id="PROGRAM_ID" data-tags="true"
                                data-placeholder="Select Program" data-allow-clear="true">
                            <option>Select Program</option>
                            <?php foreach ($semesterCourse as $row): ?>
                                <option data-program="<?php echo $row->PROGRAM_ID; ?>"
                                        data-faculty="<?php echo $row->FACULTY_ID; ?>"
                                        data-dept="<?php echo $row->DEPT_ID; ?>"
                                        data-session="<?php echo $row->SESSION_ID; ?>">
                                    <?php echo $row->PROGRAM_NAME; ?>
                                    <div>Session: <?php echo $row->SESSION_NAME ; ?></div>
                                    <div>Department: <?php echo $row->DEPT_NAME; ?></div>
                                    <div>Faculty: <?php echo $row->FACULTY_NAME; ?></div>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <br>
                </div>
                <div class="ibox float-e-margins">
                    <div class="listView"></div>
                    <div class="printView pull-right"></div>

                    <div class="ibox-content" id="courseList">
                        <span class="selected_course"></span>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <br clear="all"/>

<script type="text/javascript">
    $(document).ready(function () {

        $('#PROGRAM_ID').change(function () {
            var program = $('option:selected', this).attr("data-program");
            var dept = $('option:selected', this).attr("data-dept");
            var faculty = $('option:selected', this).attr("data-faculty");
            var session = $('option:selected', this).attr("data-session");
            var dept_url = '<?php echo site_url('course/semesterCourseList') ?>';
            $.ajax({
                type: "POST",
                url: dept_url,
                data: {program: program, dept: dept, faculty: faculty, session: session},
                dataType: 'html',
                beforeSend: function () {
                    $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $(".loadingImg").html("");
                    $(".listView").html("<div>").addClass('ibox-title');
                    $(".listView").html("<a href='<?php echo site_url('course/courseInformation'); ?>/" + program + "/" + dept + "/" + faculty + "/" + session + "' target='_blank' class='pull-right btn btn-primary btn-sm'><strong>PRINT</strong></a></div>");
                    //alert(program);
                    $('#courseList').html(data);
                }
            });
        });

    });

</script>
<style>
    .bd-col {
        padding-top: 12px;
        margin-bottom: 21px !important;
    }
</style>
