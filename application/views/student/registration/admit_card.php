<?php
$stu_session = $this->session->userdata('stu_logged_in');
$student_info = $this->utilities->studentInfo($stu_session["STUDENT_ID"]);
?>
<div class="ibox-title">
    <h5>Admit card.</h5>
    <span class="btn btn-sm btn-primary pull-right">Print</span>
</div>
<div class="ibox-content">
    <div style="margin:0 auto; width:675px;" id="printCard">

        <table class="table table-bordered">
            <tbody>
            <tr class="r0 lastrow">
                <div style="text-align:center;">
                    <img style="  border-radius: 3px; padding: 0px ;margin-right: 2px;width:80px; "
                         src="<?php echo base_url(); ?>assets/img/logo/kyau_web.png">
                   <h3>Khawaja Yunus Ali University</h3>
                </div>

                <h3 style="width:100%;text-align:center; margin:10px 0 0 0; line-height:18px;">ADMIT CARD
                </h3>
                <h5 style=" text-align:center; font-size:18px;line-height:18px;">Appearing Session : <b><?php echo $faculty_info->SESSION_NAME ?></b>
                </h5>
            </tr>
            <tr class="r0 lastrow">
                <td style="" class="cell c0">
                    <table class="table table-bordered">
                        <tbody>
                        <tr class="r0">
                        </tr>
                        <tr class="r1">
                            <td style="" class="cell c0"><b>Name :  </b></td>
                            <td style="" class="cell c1 lastcol"> <?php  echo  $stu_session["FULL_NAME_EN"]; ?></td>
                        </tr>
                        <tr class="r0">
                            <td style="" class="cell c0"><b>Father's Name :</b></td>
                            <td style="" class="cell c1 lastcol"><?php  echo  $stu_session["FATHER_NAME"]; ?></td>
                        </tr>
                        <tr class="r0">
                            <td style="" class="cell c0"><b>Mother's Name :</b></td>
                            <td style="" class="cell c1 lastcol"><?php  echo  $stu_session["MOTHER_NAME"]; ?></td>
                        </tr>
                        <tr class="r0">
                            <td style="" class="cell c0"><b>Faculty :</b></td>
                            <td style="" class="cell c1 lastcol"><?php  echo  $student_info->FACULTY_NAME; ?></td>
                        </tr>
                        <tr class="r1">
                            <td style="" class="cell c0"><b>Department :</b></td>
                            <td style="" class="cell c1 lastcol"><?php  echo  $student_info->DEPT_NAME; ?></td>
                        </tr>
                        <tr class="r0">
                            <td style="" class="cell c0"><b>Program:</b></td>
                            <td style="" class="cell c1 lastcol"><?php  echo  $student_info->PROGRAM_NAME; ?></td>
                        </tr>
                        <tr class="r0">
                            <td style="" class="cell c0"><b>Semester:</b></td>
                            <td style="" class="cell c1 lastcol"><?php  echo  $student_info->SEMESTER_NAME; ?></td>
                        </tr>
                        <tr class="r0">
                            <td style="" class="cell c0"><b>Course's :</b></td>
                            <td style="" class="cell c1 lastcol">
                                <ol>
                                    <?php foreach($reg_course as $row): ?>
                                    <li><?php echo $row->COURSE_TITLE.' ['.$row->COURSE_CODE.' ]' ?></li>
                                    <?php endforeach; ?>
                                </ol>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </td>
                <td style="" class="cell c1 lastcol">
                        <table class="table table-bordered">
                            <tbody>
                            <tr class="r0">
                                <td style="" class="cell c0 lastcol"><b>Roll No.</b><span
                                        style="float:right; margin-right:5px;"><?php echo $stu_session['ROLL_NO']; ?></span></td>
                            </tr>
                            <tr class="r1">
                                <td style="" class="cell c0 lastcol">
                                    <?php
                                    $p_p = 'assets/img/default.png';
                                    $s_p = 'upload/existing_studnet_photo/' . $stu_session["STUD_PHOTO"];
                                    if (!empty($stu_session['STUD_PHOTO'])) {
                                        $p_p = $s_p;
                                    }
                                    ?>
                                    <center><img width="150" height="180"
                                                 src="<?php echo base_url($p_p); ?>"
                                                 style="margin:0 auto"></center>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                </td>
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <tbody>
            <tr class="r0">
                <td style="" class="cell c0 lastcol"><b>Instructions to Candidates :</b></td>
            </tr>
            <tr class="r1">
                <td style="" class="cell c0 lastcol"><b>1. </b> Printed ‘Admit Card’ must be shown at the time of
                    entrance as well as during examination.
                </td>
            </tr>
            <tr class="r0">
                <td style="" class="cell c0 lastcol"><b>2. </b> Candidate must enter into the examination hall
                    before
                    08:30 AM.
                </td>
            </tr>
            <tr class="r1">
                <td style="" class="cell c0 lastcol"><b>3. </b> Should bring black ball point pen, 2B pencil,
                    sharpener
                    and eraser in the examination hall.
                </td>
            </tr>
            <tr class="r0">
                <td style="" class="cell c0 lastcol"><b>4. </b> Should not bring any of the electronic devices (even
                    in
                    off mode) like, mobile phone, calculator and any other electronic gadget in the examination
                    hall.
                </td>
            </tr>
            <tr class="r1">
                <td style="" class="cell c0 lastcol"><b>5. </b> Candidate shall abide by the instructions of the
                    Hall-in-charge, Invigilators and the KYAU administration.
                </td>
            </tr>
            <tr class="r0">
                <td style="" class="cell c0 lastcol"><b>6. </b> Violations of any of the above-mentioned
                    instructions
                    will lead to serious adverse disciplinary actions.
                </td>
            </tr>
            <tr class="r1">
                <td style="" class="cell c0 lastcol">
                    <!--<img width="150" height="80"
                         src="#bsmmu_nonresidency_2016/local/admission/img/controller_sign.jpg">
                    <img class="pull-right" width="150" height="80"
                         src="#bsmmu_nonresidency_2016/local/admission/img/controller_sign.jpg">-->
                </td>

            </tr>
            <tr class="r0 lastrow">
                <td style="" class="cell c0 lastcol">
                    <b style="font-size:12px;">Signature Of Examine</b>
                    <b style="font-size:12px;" class="pull-right">Controller of Examinations</b>
                </td>

            </tr>
            </tbody>
        </table>
        <div class="clearfix"></div>
    </div>

</div>
