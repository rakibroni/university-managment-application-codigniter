<style>
    .red {
        color: red
    }

    .pointer2 {
        cursor: pointer;
    }

    .div-background {
        background-color: #D9E0E7;
        padding: 20px;
        border-radius: 10px
    }
</style>

<?php if (!empty($applecent_details)) { ?>
    <div class="row animated fadeInRight">
        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Profile</h5>
                </div>
                <div>
                    <div class="ibox-content no-padding border-left-right">
                        <img src="<?php echo base_url() ?>upload/<?php echo $applecent_details->PHOTO ?>"
                             class="img-responsive" alt="image">
                    </div>
                    <div class="ibox-content profile-content">
                        <h4><strong><?php echo $applecent_details->STUDENT_NAME ?></strong></h4>

                        <p><i class="fa fa-map-marker"></i> <?php echo $applecent_details->PRES_ADDRESS ?> </p>
                        <h5>

                        </h5>

                        <p>
                        <table class="">
                            <!--                            <tbody>
                                <tr>
                                    <th width="40%">Faculty</th>
                                    <td width="60%">: <?php echo $applecent_details->faculty ?></td>                                         
                                </tr>
                                <tr>
                                    <th>Department</th>
                                    <td>: <?php echo $applecent_details->department ?></td>                                         
                                </tr>
                                <tr>
                                    <th>User Group</th>
                                    <td>: <?php echo $applecent_details->USER_GRP_NAME ?></td>                                         
                                </tr>
                                <tr>
                                    <th>Group Level</th>
                                    <td>: <?php echo $applecent_details->USER_GRP_LVL_NAME ?></td>                                         
                                </tr>
                                <tr>
                                    <th>Designation</th>
                                    <td>: <?php echo $applecent_details->DESIGNATION ?></td>                                         
                                </tr>  
                            </tbody>-->
                        </table>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Details</h5>

                </div>
                <div class="ibox-content">
                    <div class="div-background">
                        <div class="feed-activity-list">
                            <h4 style="color:green">Basic Information</h4>
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th>Name ( English )</th>
                                    <td>: <?php echo $applecent_details->STUDENT_NAME ?></td>
                                </tr>
                                <tr>
                                    <th>নাম ( বাংলা )</th>
                                    <td>: <?php echo $applecent_details->STUDENT_NAME_BN ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>: <?php echo $applecent_details->EMAIL ?></td>
                                </tr>
                                <tr>
                                    <th>Mobile</th>
                                    <td>: <?php echo $applecent_details->PHONE ?></td>
                                </tr>
                                <tr>
                                    <th>National ID</th>
                                    <td>: <?php echo $applecent_details->NID ?></td>
                                </tr>
                                <tr>
                                    <th>Date of Birth</th>
                                    <td>: <?php echo date('d-M-Y', strtotime($applecent_details->DOB)) ?></td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td>: <?php
                                        if ($applecent_details->GENDER == 'M') {
                                            echo "Male";
                                        } else if ($applecent_details->GENDER == 'F') {
                                            echo "Female";
                                        } else {
                                            echo "Others";
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Religion</th>
                                    <td>:
                                        <?php
                                        if ($applecent_details->RELIGION == 'I') {
                                            echo "Islam";
                                        } else if ($applecent_details->RELIGION == 'H') {
                                            echo "Hinddusm";
                                        } else if ($applecent_details->RELIGION == 'C') {
                                            echo "Cristitan";
                                        } else if ($applecent_details->RELIGION == 'B') {
                                            echo "Buddho";
                                        } else {
                                            echo "Others";
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nationality</th>
                                    <td>: <?php echo $applecent_details->NATIONALITY ?></td>
                                </tr>
                                <tr>
                                    <th>Passport No</th>
                                    <td>: <?php echo $applecent_details->PASSPORT ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>

                    <div class="div-background">
                        <div class="feed-activity-list">
                            <h4 style="color:green">Family and Address</h4>
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th>Father's Name</th>
                                    <td>: <?php echo $applecent_details->FATHER ?></td>
                                </tr>
                                <tr>
                                    <th width="40%">Father's Occupation</th>
                                    <td width="60%">: <?php echo $applecent_details->FATHER_OCU ?></td>
                                </tr>
                                <tr>
                                    <th width="40%">Father's Mobile</th>
                                    <td width="60%">: <?php echo $applecent_details->FATHER_PHN ?></td>
                                </tr>
                                <tr>
                                    <th width="40%">Father's Email</th>
                                    <td width="60%">: <?php echo $applecent_details->FATHER_EMAIL ?></td>
                                </tr>
                                <tr>
                                    <th>Mother's Name</th>
                                    <td>: <?php echo $applecent_details->MOTHER ?></td>
                                </tr>
                                <tr>
                                    <th width="40%">Mother's Occupation</th>
                                    <td width="60%">: <?php echo $applecent_details->MOTHER_OCU ?></td>
                                </tr>
                                <tr>
                                    <th width="40%">Mother's Mobile</th>
                                    <td width="60%">: <?php echo $applecent_details->MOTHER_PHN ?></td>
                                </tr>
                                <tr>
                                    <th width="40%">Mother's Email</th>
                                    <td width="60%">: <?php echo $applecent_details->MOTHER_EMAIL ?></td>
                                </tr>
                                <tr>
                                    <th>Present Address</th>
                                    <td>: <?php echo $applecent_details->PRES_ADDRESS ?></td>
                                </tr>
                                <tr>
                                    <th>Permanent Address</th>
                                    <td>: <?php echo $applecent_details->PARM_ADDRESS ?></td>
                                </tr>
                                <tr>
                                    <th>Local Guardian Name</th>
                                    <td>: <?php echo $applecent_details->LOCAL_GAR_NAME ?></td>
                                </tr>
                                <tr>
                                    <th>Local Guardian Relation</th>
                                    <td>: <?php echo $applecent_details->LOCAL_GAR_RELATION ?></td>
                                </tr>
                                <tr>
                                    <th>Local Guardian Address</th>
                                    <td>: <?php echo $applecent_details->LOCAL_GAR_ADDRESS ?></td>
                                </tr>
                                <tr>
                                    <th>Local Guardian Mobile</th>
                                    <td>: <?php echo $applecent_details->LOCAL_GAR_PHN ?></td>
                                </tr>
                                <tr>
                                    <th>Emergency Contact Person</th>
                                    <td>: <?php echo $applecent_details->EMER_PER_NAME ?></td>
                                </tr>
                                <tr>
                                    <th>Emergency Person Relation</th>
                                    <td>: <?php echo $applecent_details->EMER_PER_RELATION ?></td>
                                </tr>
                                <tr>
                                    <th>Emergency Contact Person Address</th>
                                    <td>: <?php echo $applecent_details->EMER_PER_ADDRESS ?></td>
                                </tr>
                                <tr>
                                    <th>Emergency Contact Person Mobile</th>
                                    <td>: <?php echo $applecent_details->EMER_PER_PHN ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>

                    <div class="div-background">
                        <div class="feed-activity-list">
                            <h4 style="color:green">Academic Information</h4>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Exam Name</th>
                                    <th>Board</th>
                                    <th>Group</th>
                                    <th>Year</th>
                                    <th>CGPA</th>
                                    <th>Institute</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($academic_details)): ?>
                                    <?php $sn = 1; ?>
                                    <?php foreach ($academic_details as $row) { ?>
                                        <tr>
                                            <td><?php echo $sn++; ?></td>
                                            <td><?php echo $row->EXAM_NAME; ?></td>
                                            <td><?php echo $row->BOARD; ?></td>
                                            <td><?php echo $row->GROUP_NAME; ?></td>
                                            <td><?php echo $row->PASSING_YEAR; ?></td>
                                            <td><?php echo $row->GPA; ?></td>
                                            <td><?php echo $row->INSTITUTE; ?></td>
                                        </tr>
                                    <?php } ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>

                    <div class="div-background">
                        <div class="feed-activity-list">
                            <h4 style="color:green">Department Information</h4>
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th width="40%">Admission Year</th>
                                    <td width="60%">: <?php echo $applecent_details->ADMISSION_YEAR ?></td>
                                </tr>
                                <tr>
                                    <th>Session</th>
                                    <td>: <?php echo $applecent_details->SESSION ?></td>
                                </tr>
                                <tr>
                                    <th>Faculty</th>
                                    <td>: <?php echo $applecent_details->FACULTY ?></td>
                                </tr>
                                <tr>
                                    <th>Department</th>
                                    <td>: <?php echo $applecent_details->DEPT_ID ?></td>
                                </tr>
                                <tr>
                                    <th>Program</th>
                                    <td>: <?php echo $applecent_details->PROGRAM_ID ?></td>
                                </tr>
                                <tr>
                                    <th>Semester</th>
                                    <td>: <?php echo $applecent_details->SEMESTER ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>

                    <div class="div-background">
                        <div class="feed-activity-list">
                            <h4 style="color:green">Payment Information</h4>
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th width="40%">Bank Receipt No.</th>
                                    <td width="60%">: <?php echo $applecent_details->BANK_RECEIPT ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>

                    <div class="div-background">
                        <div class="feed-activity-list">
                            <h4 style="color:green">Other Information</h4>
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th width="40%">Guardians Income</th>
                                    <td width="60%">: <?php echo $applecent_details->GAR_INCOME_STATUS ?></td>
                                </tr>
                                <tr>
                                    <th width="40%">Weaver Percentage</th>
                                    <td width="60%">: <?php echo $applecent_details->WEAVER_PERCENTAGE ?></td>
                                </tr>
                                <tr>
                                    <th width="40%">Weaver Reason</th>
                                    <td width="60%">: <?php echo $applecent_details->WEAVER_REASON ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>

                    <div class="div-background">
                        <div class="feed-activity-list">
                            <h4 style="color:green">Access Information</h4>
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th width="40%">Application sl no</th>
                                    <td width="60%">: <?php echo $applecent_details->APPLICATION_SL ?></td>
                                </tr>
                                <tr>
                                    <th>Existing Reg No</th>
                                    <td>: <?php echo $applecent_details->EXISTING_REG_NO ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php } ?>