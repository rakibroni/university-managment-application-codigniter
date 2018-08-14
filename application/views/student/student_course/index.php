<style type="text/css">
    .marquee {

        overflow: hidden;
        border: 1px solid #ccc;
        color: blue;
    }

    .notice_marquee {

        overflow: hidden;
        border: 1px solid #ccc;

    }

</style>

<?php
if ($std_current):
    $stu_id = $std_current->STUDENT_ID;
    $session = $std_current->SESSION_ID;
    $semester_id = $std_current->SEMISTER_ID;
    $faculty = $std_current->FACULTY_ID;
    $dept = $std_current->DEPT_ID;
    $program = $std_current->PROGRAM_ID;
    $offerType = $std_current->OFFER_TYPE;
    $semesterId = array();
    foreach ($semester as $key => $sem) {
        array_push($semesterId, $sem->LKP_ID);
    }
    for ($i = 0; $i < count($semesterId); $i++) {

        if ($semester_id == $semesterId[$i]) {
            $current_sem = $semesterId[$i + 1];
        }
    }
    /*Course Add into array*/
    $pre_course = array();
    $courseAdd = $this->db->query("SELECT * FROM reg_stu_crs_request
                                  WHERE STUDENT_ID = $stu_id AND SEMESTER_ID = $current_sem")->result();
    foreach ($courseAdd as $key => $cou) {
        array_push($pre_course, $cou->COURSE_ID);
    }
    $sem_name = $this->db->query("SELECT LKP_NAME FROM m00_lkpdata WHERE LKP_ID = $current_sem")->row();

    /*Admission date in withing date range*/
    $dataTime = $this->db->query("SELECT * from reg_crs_reg_period where now() >= FROM_DT and now() <= TO_DT and FACULTY_ID = $faculty AND DEPT_ID = $dept AND PROGRAM_ID = $program AND SEMESTER_ID = $current_sem AND SESSION_ID = $session")->row();
//echo "<pre>"; print_r($this->db->last_query()); exit; echo "</pre>";
    ?>
    <div class="wrapper wrapper-content animated fadeInRight">
        <?php if ($dataTime): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <?php
                            $start = date_create(date('Y-m-d'));
                            $end = date_create($dataTime->TO_DT);
                            $diff = date_diff($end, $start);
                            //print_r($diff);
                            ?>
                            <?php
                            if ($diff->days < 1) {

                                $start = date_create(date('Y-m-d h:i:sa'));
                                $end = date_create($dataTime->TO_DT);
                                $diff = date_diff($end, $start);
                                ?>
                                <span class="btn btn-outline btn-danger btn-xs pull-right"><span
                                        class="badge badge-danger"><b><?php echo $diff->h . ":" . $diff->i . ":" . $diff->s; ?> </b></span> Hours  remaining </span>
                            <?php
                            } else { ?>
                                <?php if ($diff->days == 1): ?>
                                    <span class="btn  btn-danger btn-xs pull-right"><span
                                            class="badge badge-danger"><b><?php echo $diff->days; ?> </b></span> day remaining </span>
                                <?php else: ?>
                                    <span class="btn  btn-danger btn-xs pull-right"><span
                                            class="badge badge-danger"><b><?php echo $diff->days; ?> </b></span> days remaining </span>
                                <?php endif; ?>
                            <?php }
                            ?>
                        </div>
                    </div>

                </div>
                <div class="ibox-content">
                    <form id="offerType" class="form-horizontal" action="">
                        <?php if ($offerType == 'O'): ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-8">
                                        <div class="flexy">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th><input type="checkbox" id="checkAll" class="check clickcheck"
                                                               name="selectAll"></th>
                                                    <th>Title</th>
                                                    <th>Code</th>
                                                    <th>Credit</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php if (!empty($courseType)): ?>
                                                    <?php $sn = 1; ?>
                                                    <?php foreach ($courseType as $row) {
                                                        $checked = (in_array($row->COURSE_ID, $pre_courses) ? "checked='checked'" : "");
                                                        ?>
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
                                    <input type="hidden" id="faculty" name="faculty" value="<?php echo $faculty; ?>">
                                    <input type="hidden" id="dept" name="dept" value="<?php echo $dept; ?>">
                                    <input type="hidden" id="program" name="program" value="<?php echo $program; ?>">
                                    <input type="hidden" id="offerType" name="offerType"
                                           value="<?php echo $offerType; ?>">
                                    <input type="hidden" id="semester" name="semester"
                                           value="<?php echo $current_sem; ?>">
                                    <input type="hidden" id="session" name="session" value="<?php echo $session; ?>">
                                    <input type="hidden" id="reg_period" name="reg_period"
                                           value="<?php echo $dataTime->REG_PERIOD_ID; ?>">

                                    <div class="form-group">
                                        <div class="col-lg-offset-1 col-lg-10">
                                            <span class="modal_msg pull-left"></span>
                                            <input type="button" value="submit" class="btn btn-primary btn-sm"
                                                   id="formSubmit">
                                            <input type="reset" value="Reset" class="btn btn-default btn-sm"><span
                                                id="success"></span>
                                            <span class="loadingImg"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="row">
                                <div class="ibox-title marquee">
                                    <a reg=""><?php echo $sem_name->LKP_NAME; ?> Admission is going now</a>&nbsp;&nbsp;|
                                    &nbsp;&nbsp;
                                    <?php
                                    if ($diff->days < 1) {

                                        $start = date_create(date('Y-m-d h:i:sa'));
                                        $end = date_create($dataTime->TO_DT);
                                        $diff = date_diff($end, $start);
                                        ?>
                                        <span class="btn btn-outline btn-danger btn-xs pull-right"><span
                                                class="badge badge-danger"><b><?php echo $diff->h . ":" . $diff->i . ":" . $diff->s; ?> </b></span> Hours  remaining </span>
                                    <?php
                                    } else { ?>
                                        <?php if ($diff->days == 1): ?>
                                            <a class="badge badge-danger"><b><?php echo $diff->days; ?> </b></a> day remaining
                                        <?php else: ?>
                                            <a class="badge badge-danger"><b><?php echo $diff->days; ?> </b></a> days remaining
                                        <?php endif; ?>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
            <?php else: ?>
                <div class="ibox-content">
                    <div class="alert alert-danger">
                        <b>Registration Date Over.</b>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <p></p>
<?php endif; ?>
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
<script src="<?php echo base_url(); ?>assets/js/jquery.marquee.min.js"></script>
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
    $("#formSubmit").click(function () {
        var is_valid = 0;
        var dataInfo = $("#offerType").serialize();
        var url = '<?php echo site_url('student/addOfferCourse'); ?>';
        if (!$('#offerType input[type="checkbox"]').is(':checked')) {
            alert("Please Select at least one course.");
            is_valid = 1;
        }
        if (is_valid == 0) {
            $.ajax({
                type: "POST",
                url: url,
                data: dataInfo,
                dataType: 'html',
                success: function (data) {
                    $('#msg').html(data);
                    $("#success").html(data);
                }
            });
        }
    });
    $('.marquee').marquee({
        direction: 'left',
        duration: 15000,
        pauseOnHover: true,
        allowCss3Support: false
    });
    $(document).on('click', '.notice_marque_fn', function () {
        $('.notice_marquee').marquee({
            delayBeforeStart: 0,
            direction: 'up',
            duration: 10000,
            pauseOnHover: true,
            allowCss3Support: false,
            duplicated: true
        });
    });
</script>