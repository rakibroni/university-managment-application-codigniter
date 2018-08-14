<!doctype html>
<html>
<head>

    <style type="text/css">
        #personal_info {
            border: 1px solid black;
            padding: 20px;
            border-radius: 10px
        }

        #aca_tbl th, #aca_tbl td {
            border: 1px solid black;
            padding: 5px;
        }

        #aca_tbl {
            border-collapse: collapse;
        }


    </style>
</head>
<body style="font-size: 12pt;">
<div id="printBox">
    <div style="width: 100%;border-bottom: 2px solid black">
        <div style="width:10%;float: left;"><img
                style=" border-radius: 3px;margin-bottom: 0px;padding: 0px ;width: 60px"
                src="<?php echo base_url(); ?>assets/img/logo/kyau_web.png"></div>
        <div style="width:80%;float: left;padding-top: 5px"><h2>Khwaja Yunus Ali University</h2></div>
        <div style="width:10%;float: left;margin-bottom: 0px;padding-top: 10px ;">
            <barcode code="User Code: 15000 " type="QR" size=".5" height=".5"/>
        </div>

    </div>
    <br>

    <h3 style="text-align: center">Student Profile</h3>
    <h4>Personal Information </h4>

    <div id="personal_info">
        <div style="float: left;width:55%">

            <table width="100%">
                <tr>
                    <td style="width: 30%">Roll No.</td>
                    <td style="width:5%">:</td>
                    <td style="width: 65%">  <?php echo $applicant[0]->ROLL_NO ?></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <td> <?php echo $applicant[0]->FULL_NAME_EN ?></td>
                </tr>
                <tr>
                    <td>Date of Birth</td>
                    <td>:</td>
                    <td>

                        <?php echo date('d-M-Y', strtotime($applicant[0]->DATH_OF_BIRTH)); ?>
                    </td>
                </tr>
                <tr>
                    <td>Blood Group</td>
                    <td>:</td>
                    <td> <?php echo $applicant[0]->blood; ?></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>:</td>
                    <td> <?php
                        if ($applicant[0]->GENDER == 'M') {
                            echo 'Male';
                        } else if ($applicant[0]->GENDER == 'F') {
                            echo "Female";
                        } else {
                            echo "";
                        }
                        ?></td>
                </tr>
                <tr>
                    <td>Marital Status</td>
                    <td>:</td>
                    <td>  <?php echo $applicant[0]->marital; ?></td>
                </tr>
                <tr>
                    <td>Nationality</td>
                    <td>:</td>
                    <td> <?php echo $applicant[0]->nationality; ?></td>
                </tr>
                <tr>
                    <td>National ID</td>
                    <td>:</td>
                    <td> <?php echo $applicant[0]->NATIONAL_ID; ?></td>
                </tr>
                <tr>
                    <td>Passport No.</td>
                    <td>:</td>
                    <td> <?php echo $applicant[0]->PASSPORT_NO ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td>
                        <?php
                        if (!empty($email)) {
                            foreach ($email as $emailList):
                                echo $emailList->CONTACTS . '<br>';
                            endforeach;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Contact</td>
                    <td>:</td>
                    <td>
                        <?php
                        foreach ($contact as $conList):
                            echo $conList->CONTACTS . '<br>';
                        endforeach;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Religion</td>
                    <td>:</td>
                    <td>
                        <?php
                        echo $applicant[0]->relegion;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Height</td>
                    <td>:</td>
                    <td>
                        <?php
                        if (!empty($applicant[0]->HEIGHT_CM)) {
                            echo $applicant[0]->HEIGHT_CM . ' (CM)';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Weight</td>
                    <td>:</td>
                    <td>
                        <?php if (!empty($applicant[0]->WEIGHT_KG)) echo $applicant[0]->WEIGHT_KG . 'Kg'; ?>
                    </td>
                </tr>
            </table>
        </div>
        <div style="float: left;width:40%">
            <img style="float: right"
                 src="<?php echo base_url() ?>upload/existing_studnet_photo/<?php echo $applicant[0]->STUD_PHOTO; ?>"
                 width="130" height="140" alt="Student's Photo">
        </div>

    </div>
    <h4>Family Information </h4>

    <div id="personal_info">
        <div style="float: left;width:49%;border-right: 1px solid black">
            <table width="100%">
                <tr>
                    <td>Photo</td>
                    <td>:</td>
                    <td>
                        <img
                            src="<?php echo base_url("upload/existing_studnet_photo/parent/thumbs/$fathersInfo->PARENT_PHOTO"); ?>"/>

                    </td>
                </tr>
                <tr>
                    <td style="">Father Name</td>
                    <td style="">:</td>
                    <td style=""> <?php echo $applicant[0]->FATHER_NAME; ?></td>
                </tr>
                <tr>
                    <td>Father Occupation</td>
                    <td>:</td>
                    <td>
                        <?php
                        echo $fathersInfo->f_occupation;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Father Contact</td>
                    <td>:</td>
                    <td>
                        <?php
                        foreach ($father_contact as $conList):
                            echo $conList->CONTACTS . '<br>';
                        endforeach;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Father Email</td>
                    <td>:</td>
                    <td>
                        <?php
                        if (!empty($father_email)) {
                            foreach ($father_email as $fatherEmailList):
                                echo $fatherEmailList->CONTACTS . '<br>';
                            endforeach;
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
        <div style="float: left;width:50%;">
            <table width="100%">
                <tr>
                    <td>Photo</td>
                    <td>:</td>
                    <td>
                        <img
                            src="<?php echo base_url("upload/existing_studnet_photo/parent/thumbs/$motherInfo->PARENT_PHOTO"); ?>"/>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49%">Mother Name</td>
                    <td style="width:1%">:</td>
                    <td style="width: 50%">  <?php echo $applicant[0]->MOTHER_NAME; ?></td>
                </tr>
                <tr>
                    <td>Mother Occupation</td>
                    <td>:</td>
                    <td>
                        <?php
                        echo $motherInfo->m_occupation;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Mother Contact</td>
                    <td>:</td>
                    <td>
                        <?php
                        foreach ($mother_contact as $conList):
                            echo $conList->CONTACTS . '<br>';
                        endforeach;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Mother Email</td>
                    <td>:</td>
                    <td>
                        <?php
                        if (!empty($mother_email)) {
                            foreach ($mother_email as $motherEmailList):
                                echo $motherEmailList->CONTACTS . '<br>';
                            endforeach;
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>

    </div>
    <br>
    <pagebreak></pagebreak>
    <div id="personal_info">
        <div style="float: left;width:49%;border-right: 1px solid black">
            <h4>Present Address</h4>

            <?php
            if (!empty($addrInfo)) {
                ?>
                <table width="100%">
                    <tr>
                        <td style="width: 49%">Division</td>
                        <td style="width:1%">:</td>
                        <td style="width: 50%"> <?php echo $addrInfo[0]->DIVIS_NAME; ?></td>
                    </tr>
                    <tr>
                        <td>District</td>
                        <td>:</td>
                        <td> <?php echo $addrInfo[0]->DIST_NAME; ?>   </td>
                    </tr>
                    <tr>
                        <td>Upazila/Thana</td>
                        <td>:</td>
                        <td> <?php echo $addrInfo[0]->thn; ?>  </td>
                    </tr>
                    <tr>
                        <td>Police Station</td>
                        <td>:</td>
                        <td> <?php echo $addrInfo[0]->PLOSC; ?>  </td>
                    </tr>
                    <tr>
                        <td>Union/Word No.</td>
                        <td>:</td>
                        <td> <?php echo $addrInfo[0]->uni; ?>  </td>
                    </tr>
                    <tr>
                        <td>Post Office</td>
                        <td>:</td>
                        <td> <?php echo $addrInfo[0]->POSTO; ?>  </td>
                    </tr>
                    <tr>
                        <td>Vill/House/Road no</td>
                        <td>:</td>
                        <td>
                            <?php
                            if (!empty($addrInfo->HOUSE_NO_NAME)) {
                                echo 'House - ' . $addrInfo->HOUSE_NO_NAME . '<br>';
                            }
                            if (!empty($addrInfo->ROAD_AVENO_NAME)) {
                                echo 'Road - ' . $addrInfo->HOUSE_NO_NAME . '<br>';
                            }
                            if (!empty($addrInfo->VILLAGE_WARD)) {
                                echo 'Word/Vill - ' . $addrInfo->VILLAGE_WARD;
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            <?php } ?>
        </div>
        <div style="float: left;width:50%;margin-left: 5px;">
            <h4>Permanent Address</h4>
            <table width="100%">
                <tr>
                    <td style="width: 49%">Division</td>
                    <td style="width:1%">:</td>
                    <td style="width: 50%">
                        <?php
                        if (!empty($parAddrInfo)) {
                            echo $parAddrInfo->DIVIS_NAME;
                        } else {
                            echo $addrInfo[0]->DIVIS_NAME;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>District</td>
                    <td>:</td>
                    <td>
                        <?php
                        if (!empty($parAddrInfo)) {
                            echo $parAddrInfo->DIST_NAME;
                        } else {
                            echo $addrInfo[0]->DIST_NAME;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Upazila/Thana</td>
                    <td>:</td>
                    <td>
                        <?php
                        if (!empty($parAddrInfo)) {
                            echo $parAddrInfo->thn;
                        } else {
                            echo $addrInfo[0]->thn;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Police Station</td>
                    <td>:</td>
                    <td>
                        <?php
                        if (!empty($parAddrInfo)) {
                            echo $parAddrInfo->PLOSC;
                        } else {
                            echo $addrInfo[0]->PLOSC;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Union/Word No.</td>
                    <td>:</td>
                    <td>
                        <?php
                        if (!empty($parAddrInfo)) {
                            echo $parAddrInfo->uni;
                        } else {
                            echo $addrInfo[0]->uni;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Post Office</td>
                    <td>:</td>
                    <td>
                        <?php
                        if (!empty($parAddrInfo)) {
                            echo $parAddrInfo->POSTO;
                        } else {
                            echo $addrInfo[0]->POSTO;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Vill/House/Road no</td>
                    <td>:</td>
                    <td>
                        <?php
                        if (!empty($parAddrInfo)) {

                            if (!empty($parAddrInfo->HOUSE_NO_NAME)) {
                                echo 'House - ' . $parAddrInfo->HOUSE_NO_NAME . '<br>';
                            }
                            if (!empty($parAddrInfo->ROAD_AVENO_NAME)) {
                                echo 'Road - ' . $parAddrInfo->HOUSE_NO_NAME . '<br>';
                            }
                            if (!empty($parAddrInfo->VILLAGE_WARD)) {
                                echo 'Word/Vill - ' . $parAddrInfo->VILLAGE_WARD;
                            }
                        } else {
                            if (!empty($addrInfo->HOUSE_NO_NAME)) {
                                echo 'House - ' . $addrInfo->HOUSE_NO_NAME . '<br>';
                            }
                            if (!empty($addrInfo->ROAD_AVENO_NAME)) {
                                echo 'Road - ' . $addrInfo->HOUSE_NO_NAME . '<br>';
                            }
                            if (!empty($addrInfo->VILLAGE_WARD)) {
                                echo 'Word/Vill - ' . $addrInfo->VILLAGE_WARD;
                            }
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <h4>Academic Information </h4>
    <table id="aca_tbl" width="100%">
        <thead>
        <tr>
            <th width="20%">Exam Name</th>
            <th width="5%">Year</th>
            <th width="5%">Board</th>
            <th width="10%">Group</th>
            <th width="10%">CGPA</th>
            <th width="40%">Institute</th>
            <th width="10%">Certificate</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($academic as $academicInfo):
            ?>
            <tr>
                <td><?php echo $academicInfo->deg; ?> </td>
                <td><?php echo $academicInfo->PASSING_YEAR; ?></td>
                <td><?php echo $academicInfo->board; ?></td>
                <td> <?php echo $academicInfo->grp; ?></td>
                <td> <?php echo $academicInfo->RESULT_GRADE; ?></td>
                <td><?php echo $academicInfo->INSTITUTION; ?> </td>
                <td><?php if (!empty($academicInfo->ACHIEVEMENT)) { ?><img
                        src="<?php echo base_url() ?>upload/academin_certificate/<?php echo $academicInfo->ACHIEVEMENT; ?>"
                        width="80" height="50" class="img-responsive" alt="Certificate Image"><?php
                    } else {
                        echo "";
                    }
                    ?></td>
            </tr>
        <?php
        endforeach;
        ?>
        </tbody>
    </table>
    <h4>Medical Information </h4>
    <table id="aca_tbl" width="100%">
        <thead>
        <tr>
            <th width="20%">Substance</th>
            <th width="20%">Currently Used?</th>
            <th width="20%">Previously Used?</th>
            <th width="20%">Type/amount/frequency</th>
            <th width="10%">How long year?</th>
            <th width="10%">If stopped when?</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($medical as $medicalInfo):
            ?>
            <tr>
                <td>
                    <?php echo $medicalInfo->substances; ?>
                </td>
                <td>
                    <?php echo ($medicalInfo->CURRENTLY_USED == '1') ? 'Yes' : 'No'; ?>
                </td>
                <td>
                    <?php echo ($medicalInfo->PREVIOUSLY_USED == '1') ? 'Yes' : 'No'; ?>
                </td>
                <td>
                    <?php echo $medicalInfo->TYPE_AMOUNT_FREQUENCY; ?>
                </td>
                <td>
                    <?php echo $medicalInfo->DURATION . ' Years'; ?>
                </td>
                <td>
                    <?php echo $this->utilities->formatDate('d-m-Y', strtotime($medicalInfo->STOP_DT)); ?>

                </td>
            </tr>
        <?php
        endforeach;
        ?>
        </tbody>
    </table>
    <h4>Disease Information </h4>
    <table id="aca_tbl" width="100%">
        <thead>
        <tr>
            <th width="30%">Disease Name</th>
            <th width="20%">Start Date</th>
            <th width="20%">End Date</th>
            <th width="30%">Treating Doctor</th>
        </tr>
        </thead>
        <?php
        if (!empty($disease)) {
            ?>
            <tbody>
            <?php
            foreach ($disease as $diseaseInfo):
                ?>
                <tr>
                    <td><?php echo $diseaseInfo->DISEASE_NAME; ?> </td>
                    <td>

                        <?php echo $this->utilities->formatDate('d-m-Y', strtotime($diseaseInfo->START_DT)); ?>
                    </td>
                    <td>

                        <?php echo $this->utilities->formatDate('d-m-Y', strtotime($diseaseInfo->END_DT)); ?>
                    </td>
                    <td><?php echo $diseaseInfo->DOCTOR_NAME; ?> </td>
                </tr>
            <?php
            endforeach;
            ?>
            </tbody>
        <?php
        } else {
            echo '<tr><td colspan="4">No Disease Found</td></tr>';
        }
        ?>
    </table>
    <pagebreak></pagebreak>
    <h4>Others Information </h4>

    <div id="personal_info">
        <div style="float: left;width:49%;border-right: 1px solid black">
            <?php
            if (!empty($waiver)):
            ?>
            <table width="100%">

                <tr>
                    <td>Waiver (%)</td>
                    <td>:</td>
                    <td>  <?php echo $waiver->PERCENTAGE; ?></td>
                </tr>
                <tr>
                    <td>Waiver Reason</td>
                    <td>:</td>
                    <td><?php echo $waiver->REASON; ?></td>
                </tr>
            </table>
        </div>
        <div style="float: left;width:50%;">
            <table width="100%">
                <tr>
                    <td style="width: 49%">Guardian's Income (Yearly)</td>
                    <td style="width:1%">:</td>
                    <td style="width: 50%">  <?php echo $applicant[0]->FMLY_INCOME; ?></td>
                </tr>
                <tr>
                    <td>Source of Finance</td>
                    <td>:</td>
                    <td>
                        <?php
                        if ($applicant[0]->SSOF_FINANC == 's') {
                            echo "Self";
                        } else if ($applicant[0]->SSOF_FINANC == 'f') {
                            echo "Father";
                        } else if ($applicant[0]->SSOF_FINANC == 'a') {
                            echo "Guardian";
                        }
                        ?>
                    </td>
                </tr>

            </table>
            <?php endif; ?>
        </div>
    </div>

    <h4>Current Course Information </h4>

    <div id="personal_info">
        <div style="float: left;width:100%">

            <table width="100%">
                <tr>
                    <td>Faculty</td>
                    <td>:</td>
                    <td>
                        <?php if (!empty($current_academic_info->FACULTY_NAME)) echo $current_academic_info->FACULTY_NAME ?>
                    </td>
                </tr>
                <tr>
                    <td>Department</td>
                    <td>:</td>
                    <td> <?php if (!empty($current_academic_info->DEPT_NAME)) echo $current_academic_info->DEPT_NAME ?></td>
                </tr>
                <tr>
                    <td>Program</td>
                    <td>:</td>
                    <td> <?php if (!empty($current_academic_info->PROGRAM_NAME)) echo $current_academic_info->PROGRAM_NAME ?></td>
                </tr>
                <tr>
                    <td>Semester</td>
                    <td>:</td>
                    <td><?php if (!empty($current_academic_info->SEMESTER_NAME)) echo $current_academic_info->SEMESTER_NAME ?> </td>
                </tr>
                <tr>
                    <td>Session</td>
                    <td>:</td>
                    <td> <?php if (!empty($current_academic_info->SESSION_NAME)) echo $current_academic_info->SESSION_NAME ?> </td>
                </tr>
                <tr>
                    <td>Course List</td>
                    <td>:</td>
                    <td>
                        <ol>
                            <?php
                            if (!empty($courseList)):
                                ?>
                                <?php
                                foreach ($courseList as $corList):
                                    ?>
                                    <tr>
                                        <td>
                                            <span class="pie"><?php echo $corList->COURSE_CODE; ?>
                                                : &nbsp;&nbsp;<?php echo $corList->COURSE_TITLE; ?>&nbsp;</span>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                            endif;
                            ?>
                        </ol>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <h4>Admission Information </h4>

    <div id="personal_info">
        <div style="float: left;width:100%">

            <table width="100%">
                <tr>
                    <td>Admission Info</td>
                    <td>:</td>
                    <td>
                        <?php if (!empty($admission->CREATE_DATE)) echo date('d-M-Y', strtotime($admission->CREATE_DATE)); ?>

                    </td>
                </tr>
                <tr>
                    <td>Faculty</td>
                    <td>:</td>
                    <td>
                        <?php if (!empty($admission->FACULTY_NAME)) echo $admission->FACULTY_NAME; ?>
                    </td>
                </tr>
                <tr>
                    <td>Department</td>
                    <td>:</td>
                    <td><?php if (!empty($admission->DEPT_NAME)) echo $admission->DEPT_NAME; ?></td>
                </tr>
                <tr>
                    <td>Program</td>
                    <td>:</td>
                    <td> <?php if (!empty($admission->PROGRAM_NAME)) echo $admission->PROGRAM_NAME; ?></td>
                </tr>
                <tr>
                    <td>Semester</td>
                    <td>:</td>
                    <td><?php if (!empty($admission->SEMESTER_NAME)) echo $admission->SEMESTER_NAME; ?></td>
                </tr>
                <tr>
                    <td>Session</td>
                    <td>:</td>
                    <td><?php if (!empty($admission->SESSION_NAME)) echo $admission->SESSION_NAME; ?></td>
                </tr>
                <tr>
                    <td>Batch</td>
                    <td>:</td>
                    <td><?php if (!empty($applicant[0]->batch)) echo $applicant[0]->batch; ?></td>
                </tr>

            </table>
        </div>
    </div>
</div>
</body>
</html>