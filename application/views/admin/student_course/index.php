<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Student's Courses</h5>
                    <?php
                    //print_r($std_current);
                    $semesterId = array();
                    foreach ($semester as $key => $sem) {
                        array_push($semesterId, $sem->LKP_ID);
                    }
                    for ($i = 0; $i < sizeof($semesterId); $i++) {
                        if ($semesterId[$i] == 99) {

                            $semesterId[$i + 1];
                        }
                    }
                    ?>
                </div>
                <div class="ibox-content">
                    <form id="offerType" class="form-horizontal" action="">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Offer Type</label>

                                <div class="col-md-4">
                                    <input type="radio" name="student_courses" class="student_courses" value="F"
                                           checked>&nbsp; Fixed Credits &nbsp;
                                    <input type="radio" name="student_courses" class="student_courses" value="O">&nbsp;
                                    Open Credits
                                </div>
                                <div class="col-md-2">
                                    <i class="fa fa-info-circle pointer2" data-content="Select Course Type"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div id="semester_courses" class="toggle-div panel panel-default">

                                <div class="form-group panel-body">
                                    <div class="col-md-12">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="flexy">

                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th><input type="checkbox" id="checkAll"
                                                                   class="check clickcheck" name="selectAll"></th>
                                                        <th>Title</th>
                                                        <th>Code</th>
                                                        <th>Credit</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if (!empty($open_credits)): ?>
                                                        <?php $sn = 1; ?>
                                                        <?php foreach ($open_credits as $row) { ?>
                                                            <tr>
                                                                <td><input type="checkbox"
                                                                           value="<?php echo $row->OFFERED_COURSE_ID ?>"
                                                                           class="checkbox-primary check clickcheck"
                                                                           id="chkCourses" name="chkCourses[]"/></td>
                                                                <td><?php echo $row->COURSE_TITLE; ?></td>
                                                                <td><?php echo $row->COURSE_CODE; ?></td>
                                                                <td><?php echo $row->CREDIT; ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div id="fixed_courses" class="toggle-div1 panel panel-default">
                                <div class="form-group panel-body">
                                    <label class="col-md-3 control-label">Semester</label>

                                    <div class="col-md-3">
                                        <select class="form-control is_required_o" name="semester" id="semester">
                                            <option value="">-Select-</option>
                                            <?php foreach ($semester as $row) { ?>
                                                <option
                                                    value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <i class="fa fa-info-circle pointer2" data-content="Select Semester"
                                           data-placement="right" data-toggle="popover" data-container="body"
                                           data-original-title="" title="Help"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label"></label>

                                    <div class="col-md-8">
                                        <table id="semesterCourses">
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <span class="modal_msg pull-left"></span>
                                    <input type="button" value="submit" class="btn btn-primary btn-sm" id="formSubmit">
                                    <input type="reset" value="Reset" class="btn btn-default btn-sm">
                                    <span class="loadingImg"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .flexy {
        display: block;
        width: 90%;
        border: 1px solid #eee;
        max-height: 200px;
        overflow: auto;
    }

    .toggle-div {
        display: none;
        padding: 10px;
        border-radius: 10px;
    }

    .toggle-div-course {
        display: none;
        background-color: #FCF8E3;
        padding: 10px;
        border-radius: 10px;
        width: 400px;
    }

    .toggle-div1 {
        padding: 10px;
        border-radius: 10px;
    }
</style>
<script>
    $(document).on("click", ".student_courses", function () {
        var is_local = $(this).val();
        if (is_local == 'O') {
            $('#semester_courses').show();
            $('#fixed_courses').hide();
        } else {
            $('#semester_courses').hide();
            $('#fixed_courses').show();
        }
    });
    $("#checkAll").click(function () {
        $(".check").prop('checked', $(this).prop('checked'));
    });
    $(document).ready(function () {
        $('#semester').change(function () {
            var semester = $(this).val();
            var faculty = 2;
            var deptId = 1;
            var programId = 12;
            var url = '<?php echo site_url('admin/getSemesterCourse'); ?>';
            $.ajax({
                type: "POST",
                url: url,
                data: {facultyId: faculty, deptId: deptId, programId: programId, semesterId: semester},

                dataType: 'html',
                success: function (data) {
                    $('#semesterCourses').html(data);
                }
            });
        });
    });
    $("#checkAllC").click(function () {
        $(".checkS").prop('checked', $(this).prop('checked'));
    });
    $("#formSubmit").click(function () {
        var dataInfo = $("#offerType").serialize();
        var url = '<?php echo site_url('admin/addOfferCourse'); ?>';
        $.ajax({
            type: "POST",
            url: url,
            data: dataInfo,
            dataType: 'html',
            success: function (data) {
                $('#msg').html(data);
            }
        });
    });
</script>