<?php if ($applicantAdmit->APPROVE_FOR_ADMIT == 1) : ?>


    <!--    <link type="text/css" rel="stylesheet" href="--><?php //echo base_url(); ?><!--resources/assets/css/modules/materialadmin/css/theme-default/bootstrap.css"/>-->
    <style type="text/css">
        body {
            font-family: Verdana;
        }

        #footer {
            text-align: center;
        }

        .footer-text {
            text-align: center;
        }
    </style>

    <div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Admit Card</h5>

        <span><a href="<?php echo site_url(); ?>/applicant/applicant_admit_card_print" target="_blank"
                 class="btn btn-danger btn-xs pull-right "><i class="fa fa-file-pdf-o"></i> Print</a></span>

    </div>
    <div class="ibox-content">
        <div id="printBox">
            <!--    <h4 style="width:100%;text-align:center; margin:10px 0 0 0; line-height:18px;">ADMIT CARD</h4>-->

            <div style="margin:0 auto; width:675px;" id="printCard">
<!--                <div style="width: 100%;border-bottom: 2px solid black;">-->
<!--                    <div style="width:10%;float: left; padding-top: 10px;"><img-->
<!--                                style=" border-radius: 3px;margin-bottom: 0px;padding: 0px ;width: 60px"-->
<!--                                src="--><?php //echo base_url(); ?><!--assets/img/logo/kyau_web.png"></div>-->
<!--                    <div style="width:80%;float: left;padding-top: 5px"><h2>Khwaja Yunus Ali University</h2></div>-->
<!--                    <div style="width:10%;float: left;margin-bottom: 0px;padding-top: 10px ;"></div>-->
<!--                </div>-->
                <table class="table table-bordered">
                    <tbody>
                    <tr class="r0 lastrow">
                        <td style="" class="cell c0">
                            <table class="table table-bordered">
                                <tbody>
                                <tr class="r0">
                                    <td style="" class="cell c0 lastcol"><b>Roll No.</b></td>
                                    <td>
                                        <span style="float:left; margin-right:5px;"><?php echo $applicant->ADM_ROLL_NO; ?></span>
                                    </td>
                                </tr>
                                <tr class="r1">
                                    <td style="" class="cell c0"><b>Name : </b></td>
                                    <td style="" class="cell c1 lastcol"> <?php echo $applicant->FULL_NAME_EN; ?></td>
                                </tr>
                                <tr class="r0">
                                    <td style="" class="cell c0"><b>Faculty :</b></td>
                                    <td style="" class="cell c1 lastcol"><?php echo $applicant->FACULTY_NAME; ?></td>
                                </tr>
                                <tr class="r1">
                                    <td style="" class="cell c0"><b>Department :</b></td>
                                    <td style="" class="cell c1 lastcol"><?php echo $applicant->DEPT_NAME; ?></td>
                                </tr>
                                <tr class="r0">
                                    <td style="" class="cell c0"><b>Program:</b></td>
                                    <td style="" class="cell c1 lastcol"><?php echo $applicant->PROGRAM_NAME; ?></td>
                                </tr>
                                <tr class="r1">
                                    <td style="" class="cell c0"><b>Date :</b></td>
                                    <?php
                                    $newDate = date("d-M-Y", strtotime($exam_details->PRG_EXM_SDT));
                                    ?>
                                    <td style="" class="cell c1 lastcol"><?php echo $newDate; ?></td>
                                </tr>
                                <tr class="r0 lastrow">
                                    <td style="" class="cell c0"><b>Time :</b></td>
                                    <?php $newStartTime = date('h:i:s A', strtotime($exam_details->PRG_EXM_STM)) ?>
                                    <?php $newEndTime = date('h:i:s A', strtotime($exam_details->PRG_EXM_ETM)) ?>
                                    <td style=""
                                        class="cell c1 lastcol"><?php echo $newStartTime . ' - ' . $newEndTime ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                        <td style="" class="cell c1 lastcol">
                            <table class="table table-bordered">
                                <tbody>
                                <tr class="r0">
                                    <td style="" class="cell c0 lastcol">
                                        <?php $photo = ($applicant->PHOTO != '') ? "upload/applicant/photo/" . $applicant->PHOTO : 'upload/default/default_pic.png' ?>
                                        <center><img width="150" height="145"
                                                     src="<?php echo base_url($photo); ?>"
                                                     style="margin:0 auto;border: 1px solid black;"></center>
                                    </td>
                                </tr>
                                <tr class="r1">
                                    <td style="" class="cell c0 lastcol">
                                        <?php $photo = ($applicant->SIGNATURE_PHOTO != '') ? "upload/applicant/signature/" . $applicant->SIGNATURE_PHOTO : 'upload/default/default_sign.png' ?>
                                        <center>
                                            <img width="150" height="40"
                                                 src="<?php echo base_url($photo); ?>"
                                                 style="margin:0 auto; border: 1px solid black;"></center>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div style="width: 100%;border-bottom: 1px dotted black;"></div>
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
                            <!--                    <img width="150" height="80"-->
                            <!--                         src="#bsmmu_nonresidency_2016/local/admission/img/controller_sign.jpg">-->
                            <img class="pull-right" width="150" height="80"
                                 src="<?php echo base_url(); ?>upload/applicant/signature/default_sign.png">
                        </td>

                    </tr>
                    <tr class="r0 lastrow">
                        <td style="" class="cell c0 lastcol">
                            <!--                    <b style="font-size:12px;">Signature Of Examine</b>-->
                            <b style="font-size:12px;" class="pull-right">Controller of Examinations</b>
                        </td>

                    </tr>
                    </tbody>
                </table>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    </div>


    <!--<div id="footer">-->
    <!--    --><?php //echo $html_footer; ?>
    <!--</div>-->

<?php endif; ?>