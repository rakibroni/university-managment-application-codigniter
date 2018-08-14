<link href="<?php echo base_url(); ?>assets/css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">
<div class="wrapper wrapper-content animated fadeInRight">
    <?php //var_dump($applicant); exit; ?>
    <div class="row">
        <div class="col-lg-8">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Personal Information</h5>

                        <div class="ibox-tools">
                        </div>
                    </div>
                    <div>
                        <table class="table table-bordered white-bg">
                            <thead>
                            <tr>
                                <th width="35%">Title</th>
                                <th width="65%">Data</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <span class="pie">Name ( English )</span>
                                </td>
                                <td>
                                    <span class="pie"><?php echo $applicant[0]->FULL_NAME_EN; ?> </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="pie">নাম ( বাংলা )</span>
                                </td>
                                <td>
                                    <span class="pie"><?php echo $applicant[0]->FULL_NAME_BN ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="pie">Date of Birth</span>
                                </td>
                                <td>
                                    <span
                                        class="pie"><?php echo date('d-M-Y', strtotime($applicant[0]->DATH_OF_BIRTH)) ?></span>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <span class="pie">Blood Group</span>
                                </td>
                                <td>
                                        <span class="pie">
                                            <?php
                                            echo $applicant[0]->blood;
                                            ?>
                                        </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="pie">Gender</span>
                                </td>
                                <td>
                                    <span
                                        class="pie"><?php echo ($applicant[0]->GENDER == 'M') ? 'Male' : 'Female'; ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="pie">Marital Status</span>
                                </td>
                                <td>
                                        <span class="pie">
                                            <?php
                                            echo $applicant[0]->marital;
                                            ?>
                                        </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="pie">Nationality</span>
                                </td>
                                <td>
                                        <span class="pie">
                                            <?php
                                            echo $applicant[0]->nationality;
                                            ?>
                                        </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="pie">National ID</span>
                                </td>
                                <td>
                                    <span class="pie"><?php echo $applicant[0]->NATIONAL_ID; ?> </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="pie">Passport No</span>
                                </td>
                                <td><?php echo $applicant[0]->PASSPORT_NO; ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="pie">Email</span>
                                </td>
                                <td>
                                        <span class="pie">
                                            <?php
                                            if (!empty($email)) {
                                                foreach ($email as $emailList):
                                                    echo $emailList->CONTACTS . '<br>';
                                                endforeach;
                                            }
                                            ?>
                                        </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="pie">Contact</span>
                                </td>
                                <td>
                                        <span class="pie">
                                            <?php
                                            foreach ($contact as $conList):
                                                echo $conList->CONTACTS . '<br>';
                                            endforeach;
                                            ?>
                                        </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="pie">Religion</span>
                                </td>
                                <td>
                                        <span class="pie">
                                            <?php
                                            echo $applicant[0]->relegion;
                                            ?>
                                        </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="pie">Height</span>
                                </td>
                                <td>
                                        <span class="pie"><?php
                                            if (!empty($applicant[0]->HEIGHT_CM)) {
                                                echo $applicant[0]->HEIGHT_CM . ' (CM)';
                                            }
                                            ?> </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="pie">Weight</span>
                                </td>
                                <td>
                                    <span
                                        class="pie"><?php if (!empty($applicant[0]->WEIGHT_KG)) echo $applicant[0]->WEIGHT_KG . 'Kg'; ?> </span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Family Information</h5>

                    </div>
                    <div>
                        <table class="table table-bordered white-bg">
                            <thead>
                            <tr>
                                <th colspan="3">Father's Info</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td width="35%">
                                    <span class="pie">Father's Name</span>
                                </td>
                                <td width="65%">
                                    <span class="pie"> <?php echo $applicant[0]->FATHER_NAME; ?></span>
                                </td>
                                <?php
                                if (!empty($fathersInfo->PARENT_PHOTO)) {
                                    $f_p = 'upload/existing_studnet_photo/parent/' . $fathersInfo->PARENT_PHOTO;
                                } else {
                                    $f_p = 'assets/img/default.png';
                                }
                                ?>
                                <td rowspan="4"><img src="<?php echo base_url($f_p); ?>" width="90px" height="100px">
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <span class="pie">Father's Occupation</span>
                                </td>
                                <td>
                                        <span class="pie">
                                            <?php
                                            echo $fathersInfo->OCCUPATION_NAME;
                                            ?>
                                        </span>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="pie">Father's Contact</span>
                                </td>
                                <td>
                                        <span class="pie" style="float:left;margin-right:20px;">
                                            <?php
                                            foreach ($father_contact as $conList):
                                                echo $conList->CONTACTS . '<br>';
                                            endforeach;
                                            ?>
                                        </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="pie">Father's Email</span>
                                </td>
                                <td>
                                        <span class="pie"> 
                                            <?php
                                            if (!empty($father_email)) {
                                                foreach ($father_email as $fatherEmailList):
                                                    echo $fatherEmailList->CONTACTS . '<br>';
                                                endforeach;
                                            }
                                            ?>
                                        </span>
                                </td>
                            </tr>
                            </tbody>
                            <thead>
                            <tr>
                                <th colspan="3">Mother's Info</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td width="35%">
                                    <span class="pie">Mother's Name</span>
                                </td>
                                <td width="65%">
                                    <span class="pie"><?php echo $applicant[0]->MOTHER_NAME; ?> </span>
                                </td>
                                <?php
                                if (!empty($motherInfo->PARENT_PHOTO)) {
                                    $m_p = 'upload/existing_studnet_photo/parent/' . $motherInfo->PARENT_PHOTO;
                                } else {
                                    $m_p = 'assets/img/default.png';
                                }
                                ?>
                                <td rowspan="4"><img src="<?php echo base_url($m_p); ?>" width="90px" height="100px">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="pie">Mother's Occupation</span>
                                </td>
                                <td>
                                        <span class="pie"> 
                                            <?php
                                            echo $motherInfo->OCCUPATION_NAME;
                                            ?>
                                        </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="pie">Mother's Contact</span>
                                </td>
                                <td>
                                        <span class="pie" style="float:left;margin-right:20px;">
                                            <?php
                                            foreach ($mother_contact as $conList):
                                                echo $conList->CONTACTS . '<br>';
                                            endforeach;
                                            ?>
                                        </span>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="pie">Mother's Email</span>
                                </td>
                                <td>
                                        <span class="pie">
                                            <?php //echo $motherInfo->EMAIL_ADRESS; ?>
                                            <?php
                                            if (!empty($mother_email)) {
                                                foreach ($mother_email as $motherEmailList):
                                                    echo $motherEmailList->CONTACTS . '<br>';
                                                endforeach;
                                            }
                                            ?>
                                        </span>
                                </td>
                            </tr>
                            </tbody>
                            <?php
                            if (!empty($spouse)):
                                ?>
                                <thead>
                                <tr>
                                    <th colspan="3">Spouse Information</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <span class="pie">Spouse Name</span>
                                    </td>
                                    <td>
                                        <span class="pie"><?php echo $spouse->SFULL_NAME; ?></span>
                                    </td>
                                </tr>
                                </tbody>
                            <?php
                            endif;
                            ?>
                            <?php
                            if (!empty($addrInfo)) {
                                ?>
                                <thead>
                                <tr>
                                    <th colspan="3">Present Address</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td colspan="3">
                                            <span class="pie" style="margin-right:50px;">
                                                Division: <?php echo $addrInfo[0]->DIVIS_NAME; ?>
                                            </span> 
                                            <span class="pie">
                                                District: <?php echo $addrInfo[0]->DIST_NAME; ?>
                                            </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <span class="pie"
                                              style="margin-right:15px;">Upazila/Thana: <?php echo $addrInfo[0]->thn; ?></span>
                                        <span class="pie">Police Station: <?php echo $addrInfo[0]->PLOSC; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="pie">Union/Ward No.</span>
                                    </td>
                                    <td colspan="2">
                                        <span class="pie"><?php echo $addrInfo[0]->uni; ?> </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="pie">Post office</span>
                                    </td>
                                    <td colspan="2">
                                        <span class="pie"><?php echo $addrInfo[0]->POSTO; ?> </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="pie">Vill/House no/Road no</span>
                                    </td>
                                    <td colspan="2">
                                            <span class="pie">
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
                                            </span>
                                    </td>
                                </tr>
                                </tbody>

                                <thead>
                                <tr>
                                    <th colspan="3">Permanent Address</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="3">
                                            <span class="pie" style="margin-right:50px;">Division:
                                                <?php
                                                if (!empty($parAddrInfo)) {
                                                    echo $parAddrInfo->DIVIS_NAME;
                                                } else {
                                                    echo $addrInfo[0]->DIVIS_NAME;
                                                }
                                                ?>
                                            </span>
                                            <span class="pie">District:
                                                <?php
                                                if (!empty($parAddrInfo)) {
                                                    echo $parAddrInfo->DIST_NAME;
                                                } else {
                                                    echo $addrInfo[0]->DIST_NAME;
                                                }
                                                ?>
                                            </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                            <span class="pie" style="margin-right:30px;">Upazila/Thana:
                                                <?php
                                                if (!empty($parAddrInfo)) {
                                                    echo $parAddrInfo->thn;
                                                } else {
                                                    echo $addrInfo[0]->thn;
                                                }
                                                ?>
                                            </span>
                                            <span class="pie">Police Station:
                                                <?php
                                                if (!empty($parAddrInfo)) {
                                                    echo $parAddrInfo->PLOSC;
                                                } else {
                                                    echo $addrInfo[0]->PLOSC;
                                                }
                                                ?>
                                            </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="pie">Union/Ward No.</span>
                                    </td>
                                    <td colspan="2">
                                            <span class="pie">
                                                <?php
                                                if (!empty($parAddrInfo)) {
                                                    echo $parAddrInfo->uni;
                                                } else {
                                                    echo $addrInfo[0]->uni;
                                                }
                                                ?> 
                                            </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="pie">Post office</span>
                                    </td>
                                    <td colspan="2">
                                            <span class="pie">
                                                <?php
                                                if (!empty($parAddrInfo)) {
                                                    echo $parAddrInfo->POSTO;
                                                } else {
                                                    echo $addrInfo[0]->POSTO;
                                                }
                                                ?> 
                                            </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="pie">Vill/House no/Road no</span>
                                    </td>
                                    <td colspan="2">
                                            <span class="pie">
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
                                            </span>
                                    </td>
                                </tr>
                                </tbody>
                            <?php
                            }
                            ?>
                            <?php
                            if (!empty($guardianInfo)) {
                                ?>
                                <thead>
                                <tr>
                                    <th colspan="2">Local Guardian's Info</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td>
                                        <span class="pie">Relation with Local Guardian</span>
                                    </td>
                                    <td>
                                        <span class="pie"><?php echo $guardianInfo->relation; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="pie">Contact</span>
                                    </td>
                                    <td>
                                            <span class="pie" style="float:left;margin-right:20px;">
                                                <?php
                                                foreach ($guardian_contact as $conList):
                                                    echo $conList->CONTACTS . '<br>';
                                                endforeach;
                                                ?>
                                            </span>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="pie">Address</span>
                                    </td>
                                    <td>
                                        <span class="pie"><?php echo $guardianInfo->ADDRESS; ?></span>
                                    </td>
                                </tr>

                                </tbody>
                            <?php
                            }
                            ?>
                            <thead>
                            <tr>
                                <th colspan="3">Financial Info</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <span class="pie">Guardian's Income (Yearly)</span>
                                </td>
                                <td colspan="2">
                                    <span class="pie"><?php echo $applicant[0]->FMLY_INCOME; ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="pie">Source of Finance</span>
                                </td>
                                <td colspan="2">
                                        <span class="pie"><?php
                                            if ($applicant[0]->SSOF_FINANC == 's') {
                                                echo "Self";
                                            } else if ($applicant[0]->SSOF_FINANC == 'f') {
                                                echo "Father";
                                            } else if ($applicant[0]->SSOF_FINANC == 'a') {
                                                echo "Guardian";
                                            }
                                            ?>
                                        </span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Academic Information</h5>
                    </div>
                    <div>
                        <table class="table table-bordered white-bg">
                            <thead>
                            <tr>
                                <th>Exam Name</th>
                                <th>Year</th>
                                <th>Board</th>
                                <th>Group</th>
                                <th>CGPA</th>
                                <th>Institute</th>
                                <th>Certificate</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (!empty($academic)) {
                                foreach ($academic as $academicInfo):
                                    ?>
                                    <tr>
                                        <td>
                                            <span class="pie"><?php echo $academicInfo->deg; ?></span>
                                        </td>
                                        <td>
                                            <span class="pie"><?php echo $academicInfo->PASSING_YEAR; ?></span>
                                        </td>
                                        <td>
                                            <span class="pie"><?php echo $academicInfo->board; ?></span>
                                        </td>
                                        <td>
                                            <span class="pie"><?php echo $academicInfo->grp; ?></span>
                                        </td>
                                        <td>
                                            <span class="pie"><?php echo $academicInfo->RESULT_GRADE; ?></span>
                                        </td>
                                        <td>
                                            <span class="pie"><?php echo $academicInfo->INSTITUTION; ?></span>
                                        </td>
                                        <td>
                                                <span class="pie">
                                                    <div class="lightBoxGallery">
                                                        <a href="<?php echo base_url() ?>upload/academin_certificate/<?php echo $academicInfo->ACHIEVEMENT; ?>"
                                                           title="Image from Unsplash" data-gallery=""><img
                                                                src="<?php echo base_url() ?>upload/academin_certificate/<?php echo $academicInfo->ACHIEVEMENT; ?>"
                                                                width="80" height="50" class="img-responsive"
                                                                alt="Certificate Image"></a>

                                                        <div id="blueimp-gallery" class="blueimp-gallery">
                                                            <div class="slides"></div>
                                                            <h3 class="title"></h3>
                                                            <a class="prev">‹</a>
                                                            <a class="next">›</a>
                                                            <a class="close">×</a>
                                                            <a class="play-pause"></a>
                                                            <ol class="indicator"></ol>
                                                        </div>
                                                    </div>
                                                </span>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                            } else {
                                echo "No academic result found";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Medical Information</h5>
                    </div>
                    <div>
                        <table class="table table-bordered white-bg">
                            <thead>
                            <tr>
                                <th>Substance</th>
                                <th>Currently Used?</th>
                                <th>Previously Used?</th>
                                <th>Type/amount/<br>frequency</th>
                                <th>How long year?</th>
                                <th>If stopped when?</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($medical as $medicalInfo):
                                ?>
                                <tr>
                                    <td>
                                        <span class="pie"><?php echo $medicalInfo->substances; ?></span>
                                    </td>
                                    <td>
                                        <span
                                            class="pie"><?php echo ($medicalInfo->CURRENTLY_USED == '1') ? 'Yes' : 'No'; ?></span>
                                    </td>
                                    <td>
                                        <span
                                            class="pie"><?php echo ($medicalInfo->PREVIOUSLY_USED == '1') ? 'Yes' : 'No'; ?></span>
                                    </td>
                                    <td>
                                        <span class="pie"><?php echo $medicalInfo->TYPE_AMOUNT_FREQUENCY; ?></span>
                                    </td>
                                    <td>
                                        <span class="pie"><?php echo $medicalInfo->DURATION . ' Years'; ?></span>
                                    </td>
                                    <td>
                                        <span
                                            class="pie"><?php echo $this->utilities->formatDate('d-m-Y', $medicalInfo->STOP_DT); ?></span>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                            </tbody>
                            <?php
                            if (!empty($disease)):
                                ?>
                                <thead>
                                <tr>
                                    <th colspan="2">Disease Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th colspan="2">Treating Doctor</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($disease as $diseaseInfo):
                                    ?>
                                    <tr>
                                        <td colspan="2">
                                            <span class="pie"><?php echo $diseaseInfo->DISEASE_NAME; ?></span>
                                        </td>
                                        <td>
                                            <span
                                                class="pie"><?php echo date('d-M-Y', strtotime($diseaseInfo->START_DT)); ?></span>
                                        </td>
                                        <td>
                                            <span
                                                class="pie"><?php echo date('d-M-Y', strtotime($diseaseInfo->END_DT)); ?></span>
                                        </td>
                                        <td colspan="2">
                                            <span class="pie"><?php echo $diseaseInfo->DOCTOR_NAME; ?></span>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                                </tbody>
                            <?php
                            endif;
                            ?>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Others Information</h5>
                    </div>
                    <div>
                        <table class="table table-bordered white-bg">

                            <thead>
                            <tr>
                                <th colspan="2">Waiver Info</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td>
                                    <span class="pie">Waiver (%)</span>
                                </td>
                                <td>
                                    <span class="pie"><?php if (!empty($waiver)) {
                                            echo $waiver->PERCENTAGE;
                                        } ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="pie">Waiver Reason</span>
                                </td>
                                <td>
                                    <span class="pie"><?php if (!empty($waiver)) {
                                            echo $waiver->REASON;
                                        } ?></span>
                                </td>
                            </tr>
                            </tbody>


                            <thead>
                            <tr>
                                <th colspan="2">Siblings Info</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td width="35%">
                                    <span class="pie"> Currently Enrolled</span>
                                </td>
                                <td width="65%">
                                        <span class="pie"><?php if (!empty($sibling)) {
                                                echo "Yes";
                                            } else {
                                                echo "No";
                                            } ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="pie">ID No.</span>
                                </td>
                                <td>
                                        <span class="pie"><?php if (!empty($sibling)) {
                                                echo $sibling->SBLN_ROLL_NO;
                                            } ?></span>
                                </td>
                            </tr>
                            </tbody>


                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Profile</h5>
                    </div>
                    <div>
                        <div class="ibox-content no-padding border-left-right" align="center">
                            <img
                                src="<?php echo base_url() ?>upload/existing_studnet_photo/<?php echo $applicant[0]->STUD_PHOTO; ?>"
                                width="150" height="180" class="img-responsive" alt="Student's Photo">
                        </div>
                        <br>
                        <?php
                        //var_dump($course); exit;
                        if (!empty($course->OFFERED_COURSE_ID)) {
                            $courseOffer = $this->db->query("SELECT o.FACULTY_ID,
                                             (SELECT f.FACULTY_NAME FROM faculty f WHERE f.FACULTY_ID = o.FACULTY_ID)faculty,
                                             (SELECT p.PROGRAM_NAME FROM program p WHERE p.PROGRAM_ID = o.PROGRAM_ID)program,
                                             (SELECT d.DEPT_NAME FROM department d WHERE d.DEPT_ID = o.DEPT_ID)dept FROM aca_course_offer o WHERE o.OFFERED_COURSE_ID = '$course->OFFERED_COURSE_ID'")->row();
                        }
                        //var_dump($courseOffer); exit;
                        ?>
                        <table class="table table-bordered white-bg">
                            <thead>
                            <tr>
                                <th width="100%">Current Course Information</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td>
                                    <span class="pie"><b>Faculty</b></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                        <span class="pie"><?php
                                            if (!empty($courseOffer->faculty) && isset($courseOffer)): echo $courseOffer->faculty;
                                            endif;
                                            ?>&nbsp;</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="pie"><b>Department</b></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span
                                        class="pie"><?php if (!empty($courseOffer->dept) && isset($courseOffer)) echo $courseOffer->dept; ?>
                                        &nbsp;</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="pie"><b>Program</b></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span
                                        class="pie"><?php if (!empty($courseOffer->program) && isset($courseOffer)) echo $courseOffer->program; ?>
                                        &nbsp;</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span
                                        class="pie"><b>Semester</b>: <?php if (!empty($course->semester) && isset($courseOffer)) echo $course->semester; ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span
                                        class="pie"><b>Session</b>: <?php if (!empty($course->session) && isset($courseOffer)) echo $course->session; ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="pie"><b>Course List</b></span>
                                </td>
                            </tr>
                            <?php
                            //var_dump($courseList);
                            if (!empty($courseList) && !empty($courseOffer)):
                                ?>
                                <?php
                                foreach ($courseList as $corList):
                                    ?>
                                    <tr>
                                        <td>
                                            <span class="pie"><?php echo $corList->course_code; ?>
                                                : &nbsp;&nbsp;<?php echo $corList->course; ?>&nbsp;</span>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                            endif;
                            ?>

                            </tbody>

                        </table>
                        <br>
                        <table class="table table-bordered white-bg">
                            <thead>
                            <tr>
                                <th width="100%">Admission Information</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td width="100%">
                                    <span class="pie"><b>Admission
                                            Date</b>: <?php if (!empty($admission->CREATE_DATE)) echo date('d-M-Y', strtotime($admission->CREATE_DATE)); ?></span>
                                </td>
                            </tr>
                            <!--<tr>
                                <td>
                                    <span class="pie">&nbsp;</span>
                                </td>
                            </tr>-->
                            <tr>
                                <td>
                                    <span class="pie"><b>Faculty</b></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span
                                        class="pie"><?php if (!empty($admission->faculty)) echo $admission->faculty; ?>
                                        &nbsp;</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="pie"><b>Department</b></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="pie"><?php if (!empty($admission->dept)) echo $admission->dept; ?>
                                        &nbsp;</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="pie"><b>Program</b></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span
                                        class="pie"><?php if (!empty($admission->program)) echo $admission->program; ?>
                                        &nbsp;</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span
                                        class="pie"><b>Semester</b>: <?php if (!empty($admission->semester)) echo $admission->semester; ?></span>
                                </td>
                            </tr>
                            <!--<tr>
                                <td>
                                    <span class="pie">&nbsp;</span>
                                </td>
                            </tr>-->
                            <tr>
                                <td>
                                    <span
                                        class="pie"><b>Session</b>: <?php if (!empty($admission->session)) echo $admission->session; ?></span>
                                </td>
                            </tr>
                            <!--<tr>
                                <td>
                                    <span class="pie">&nbsp;</span>
                                </td>
                            </tr>-->
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    /* Local style for demo purpose */

    .lightBoxGallery {
        text-align: center;
    }

    .lightBoxGallery img {
        margin: 5px;
    }

</style>

<script src="<?php echo base_url(); ?>assets/js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>