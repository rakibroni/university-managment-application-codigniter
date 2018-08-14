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

<?php if (!empty($user_details)) { ?>
    <div class="row animated fadeInRight">
        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Profile</h5>
                </div>
                <div>
                    <div class="ibox-content no-padding border-left-right">
                        <img src="<?php echo base_url() ?>upload/<?php echo $user_details->USER_IMG ?>"
                             class="img-responsive" alt="image">
                    </div>
                    <div class="ibox-content profile-content">
                        <h4><strong><?php echo $user_details->FULL_NAME ?></strong></h4>

                        <p><i class="fa fa-map-marker"></i> <?php echo $user_details->PRE_ADDRESS ?> </p>
                        <hr/>
                        <p>
                        <table class="">
                            <tbody>
                            <tr>
                                <th width="40%">Faculty</th>
                                <td width="60%"><?php echo $user_details->faculty ?></td>
                            </tr>
                            <tr>
                                <th>Department</th>
                                <td><?php echo $user_details->department ?></td>
                            </tr>
                            <tr>
                                <th>Designation</th>
                                <td><?php echo $user_details->DESIGNATION ?></td>
                            </tr>
                            <tr>
                                <th>User Group</th>
                                <td><?php echo $user_details->USER_GRP_NAME ?></td>
                            </tr>
                            <tr>
                                <th>Group Level</th>
                                <td><?php echo $user_details->USER_GRP_LVL_NAME ?></td>
                            </tr>
                            </tbody>
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
                                    <th width="40%">First Name</th>
                                    <td width="60%">: <?php echo $user_details->FIRST_NAME ?></td>
                                </tr>
                                <tr>
                                    <th>Middle Name</th>
                                    <td>: <?php echo $user_details->MIDDLE_NAME ?></td>
                                </tr>
                                <tr>
                                    <th>Last Name</th>
                                    <td>: <?php echo $user_details->LAST_NAME ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>: <?php echo $user_details->EMAIL ?></td>
                                </tr>
                                <tr>
                                    <th>Alternative Email</th>
                                    <td>: <?php echo $user_details->ALT_EMAIL ?></td>
                                </tr>
                                <tr>
                                    <th>National ID</th>
                                    <td>: <?php echo $user_details->NID ?></td>
                                </tr>
                                <tr>
                                    <th>Date of Birth</th>
                                    <td>: <?php echo date('d-M-Y', strtotime($user_details->DOB)) ?></td>
                                </tr>
                                <tr>
                                    <th>Age</th>
                                    <td>: <?php echo $user_details->AGE ?></td>
                                </tr>
                                <tr>
                                    <th>Blood Group</th>
                                    <td>: <?php echo $user_details->BLOOD_GROUP ?></td>
                                </tr>
                                <tr>
                                    <th>Height</th>
                                    <td>: <?php echo $user_details->HEIGHT_FEET ?> Ft</td>
                                </tr>
                                <tr>
                                    <th>Weight</th>
                                    <td>: <?php echo $user_details->WEIGHT_KG ?> kg</td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td>: <?php
                                        if ($user_details->GENDER == 'M') {
                                            echo "Male";
                                        } else if ($user_details->GENDER == 'F') {
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
                                        if ($user_details->RELIGION == 'I') {
                                            echo "Islam";
                                        } else if ($user_details->RELIGION == 'H') {
                                            echo "Hinddusm";
                                        } else if ($user_details->RELIGION == 'C') {
                                            echo "Cristitan";
                                        } else if ($user_details->RELIGION == 'B') {
                                            echo "Buddho";
                                        } else {
                                            echo "Others";
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nationality</th>
                                    <td>: <?php echo $user_details->NATIONALITES ?></td>
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
                                    <th width="40%">Father's Name</th>
                                    <td width="60%">: <?php echo $user_details->FATHERS_NAME ?></td>
                                </tr>
                                <tr>
                                    <th>Mother's Name</th>
                                    <td>: <?php echo $user_details->MOTHERS_NAME ?></td>
                                </tr>
                                <tr>
                                    <th>Home Phone</th>
                                    <td>: <?php echo $user_details->HOME_PHONE ?></td>
                                </tr>
                                <tr>
                                    <th>Mobile</th>
                                    <td>: <?php echo $user_details->MOBILE ?></td>
                                </tr>
                                <tr>
                                    <th>Marital Status</th>
                                    <td>: <?php echo ($user_details->MARITAL_STATUS == '1') ? 'Yes' : 'No'; ?></td>
                                </tr>
                                <tr>
                                    <th>Spouse Name</th>
                                    <td>: <?php echo $user_details->SPOUSE_NAME ?></td>
                                </tr>
                                <tr>
                                    <th>Place of Birth</th>
                                    <td>: <?php echo $user_details->PLACE_OF_BIRTH ?></td>

                                </tr>
                                <tr>
                                    <th>Passport No.</th>
                                    <td>: <?php echo $user_details->PASSPORT_NO ?></td>
                                </tr>
                                <tr>
                                    <th>Passport Issue date</th>
                                    <td>: <?php echo date('d-M-Y', strtotime($user_details->DATE_OF_ISSUE)) ?></td>
                                </tr>
                                <tr>
                                    <th>Passport Issue Place</th>
                                    <td>: <?php echo $user_details->PLACE_OF_ISSUE ?></td>
                                </tr>
                                <tr>
                                    <th>Passport Expire Date</th>
                                    <td>: <?php echo date('d-M-Y', strtotime($user_details->EXPIRE_DATE)) ?></td>
                                </tr>
                                <tr>
                                    <th>Present Address</th>
                                    <td>: <?php echo $user_details->PRE_ADDRESS ?></td>
                                </tr>
                                <tr>
                                    <th>Permanent Address</th>
                                    <td>: <?php echo $user_details->PER_ADDRESS ?></td>
                                </tr>
                                <tr>
                                    <th>Contact Person</th>
                                    <td>: <?php echo $user_details->CONTACT_PERSON ?></td>
                                </tr>
                                <tr>
                                    <th>Contact Person Address</th>
                                    <td>: <?php echo $user_details->CONTACT_PERSON_ADD ?></td>
                                </tr>
                                <tr>
                                    <th>Contact Person Phone</th>
                                    <td>: <?php echo $user_details->CONTACT_PERSON_PHN ?></td>
                                </tr>
                                <tr>
                                    <th>Relation</th>
                                    <td>: <?php echo $user_details->RELATION ?></td>
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
                                    <th width="40%">Faculty :</th>
                                    <td width="60%">: <?php echo $user_details->faculty ?></td>
                                </tr>
                                <tr>
                                    <th>Department</th>
                                    <td>: <?php echo $user_details->department ?></td>
                                </tr>
                                <tr>
                                    <th>User Group</th>
                                    <td>: <?php echo $user_details->USER_GRP_NAME ?></td>
                                </tr>
                                <tr>
                                    <th>Group Level</th>
                                    <td>: <?php echo $user_details->USER_GRP_LVL_NAME ?></td>
                                </tr>
                                <tr>
                                    <th>Designation</th>
                                    <td>: <?php echo $user_details->DESIGNATION ?></td>
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