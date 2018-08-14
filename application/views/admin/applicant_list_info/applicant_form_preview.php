<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
    .info {
        background-color: #C0C0C0;
    }
</style>
<script src="<?php echo base_url(); ?>assets/js/printThis.js"></script>
</head>
<body>
    <div id="printablediv" class="ibox-content">
        <div style="width: 100%;border-bottom: 2px solid black;">
            <div style="width:10%;float: left;"><img
                style=" border-radius: 3px;margin-top: -20px;padding: 0px ;width: 60px"
                src="<?php echo base_url(); ?>assets/img/logo/kyau_web.png"></div>
                <div style="width:80%;float: left;padding-top: -20px"><h2>Khwaja Yunus Ali University</h2></div>
                <div style="width:10%;float: left;margin-bottom: 0px;padding-top: 10px ;"></div>
            </div>
            <h4 style="width:100%;text-align:center; margin:10px 0 -10 0; line-height:18px;"><?php echo $applicant_info->FULL_NAME_EN; ?> Profile</h4>
            <div class="row">
              <p class="info" style="padding:3px 0px 3px 10px;"><b>Personal Information</b></p>
              <table class="table table-bordered">    
                <tr>
                    <td class="bgColor"><b>Name in English  </b> </td>
                    <td><b>: </b> </td>
                    <td><span><?php echo $applicant_info->FULL_NAME_EN; ?></span>  </td> 
                    <td  style="padding-left: 150px;" rowspan="8">
                    <?php if (!empty($applicant_info->PHOTO)) { ?>           
                        <div class="avatar-zone">
                            <center>
                               <?php $photo=($applicant_info->PHOTO !='')? "upload/applicant/photo/".$applicant_info->PHOTO: 'upload/default/default_pic.png' ?>
                               <img id="p_img_id" src="<?php echo base_url($photo); ?>" class="img-responsive"
                               alt="select photo" style="width: 130px;
                               height: 140px;"/></center>
                           </div>
                           <?php } ?>
                       </td>
                   </tr>        
                    
                <tr>
                    <td><b>Name in Bangla  </b> </td>
                    <td><b>: </b> </td>
                    <td><span style="font-family:nikosh;"><?php echo $applicant_info->FULL_NAME_BN; ?></span></td>
                </tr>
                <tr>
                <td style="" ><b>Program  </b></td>
                    <td ><b>: </b> </td>
                    <td><span><?php echo $applicant_info->PROGRAM_NAME; ?></span></td>
                    </tr>
                <tr>
                    <td><b>Mobile No. </b> </td>
                    <td><b>: </b> </td>
                    <td> <span><?php echo $applicant_info->MOBILE_NO; ?></span></td>
                </tr>
                <tr>
                    <td><b>Gender  </b> </td>
                    <td><b>: </b> </td>
                    <td><span><?php if ($applicant_info->GENDER == 'M') {
                        echo "Male"; }
                        elseif ($applicant_info->GENDER == "F") {
                            echo "Female";
                        }else{
                            echo "Others";
                        }
                        ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Date of Birth  </b> </td>
                        <td><b>: </b> </td>
                        <td> <span><?php echo date('Y-m-d', strtotime($applicant_info->DATH_OF_BIRTH)) ?></span> </td> 
                    </tr>
                    <tr>
                        <td><b>Email  </b> </td>
                        <td><b>: </b> </td>
                        <td><span><?php echo $applicant_info->EMAIL_ADRESS; ?></span></td>

                    </tr>

                    <tr>
                        <td><b>Place of Birth  </b> </td>
                        <td><b> : </b> </td>
                        <td><span><?php echo $applicant_info->PLACE_OF_BIRTH; ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Blood Group  </b> </td>
                        <td><b> : </b> </td>
                        <td><span><?php echo ($applicant_info->LKP_BLOOD_GROUP !='')? " $applicant_info->LKP_BLOOD_GROUP " :"" ?></span></td>
                        <td  style="padding-left: 150px;" rowspan="7">
                            <?php if (!empty($applicant_info->SIGNATURE_PHOTO)) { ?>
                         <div class="avatar-zone-sig">
                            <center> </center><?php $photo=($applicant_info->SIGNATURE_PHOTO !='')? "upload/applicant/signature/".$applicant_info->SIGNATURE_PHOTO : 'upload/applicant/signature/default_sign.png' ?>
                            <img style="width: 130px; height: 50px;" src="<?php echo base_url($photo); ?>" class="img-responsive" alt="">
                        </div>
                        <b>Signature</b> 
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                  <td><b>Marital Status  </b> </td>
                  <td><b> : </b> </td>
                  <td><span><?php echo ($applicant_info->LKP_MARITAL_STATUS !='')? " $applicant_info->LKP_MARITAL_STATUS " :"" ?></span></td>
              </tr>
              <tr> 
                <td><b>Religion  </b> </td>
                <td><b> : </b> </td>
                <td><span id="P_RELIGION_ID"><?php echo ($applicant_info->LKP_RELIGION != '') ? " $applicant_info->LKP_RELIGION " : "" ?></span></td>
            </tr> 
            <tr>
                <td><b>Birth Certificate </b> </td>
                <td><b> : </b> </td>
                <td><span id="P_BIRTH_CERTIFICATE"><?php echo ($applicant_info->BIRTH_CERTIFICATE !='')? " $applicant_info->BIRTH_CERTIFICATE " :"" ?></span></td>
            </tr>
            <tr>
                <td><b>National ID </b> </td>
                <td><b> : </b> </td>
                <td><span id="P_NATIONAL_ID"><?php echo ($applicant_info->NATIONAL_ID !='')? " $applicant_info->NATIONAL_ID " :"" ?></span></td>
            </tr>
            <tr>
                <td><b>Height  </b> </td>
                <td><b> : </b> </td>
                <td><span id="P_HEIGHT_FEET"> <?php echo ($applicant_info->HEIGHT_FEET !='')? " $applicant_info->HEIGHT_FEET Feet" :"";?></td>
                </tr>
                <tr>
                    <td><b>Weight  </b> </td>
                    <td><b>: </b> </td>
                    <td><span id="P_WEIGHT_KG"> <?php echo ($applicant_info->WEIGHT_KG !='')? " $applicant_info->WEIGHT_KG Kg." :"" ?> </span></td>
                </tr>
            </table>




        </div>    
        <div class="clearfix"></div>

        <div class="row" style="padding-top: -10px;">
         <p class="info" style="padding:3px 0px 3px 10px;"><b>Familly Information</b></p>
         <table class="table table-bordered">
           <tr>
            <td><b>Father's Name  </b></td>
            <td><b> : </b></td>
            <td><span id="P_FATHER_NAME"><?php echo ($fathersInfo->GURDIAN_NAME != '') ? " $fathersInfo->GURDIAN_NAME " : "" ?></span></td>
            <td><b>Mother's Name </b></td>
            <td><b>: </b></td>
            <td><span id="P_MOTHER_NAME"><?php echo ($motherInfo->GURDIAN_NAME != '') ? " $motherInfo->GURDIAN_NAME " : "" ?></span></td>
        </tr>
        <tr>
            <td><b>Father's Occupation  </b></td>
            <td><b> : </b></td>
            <td><span id="P_FATHER_OCU"><?php echo ($fathersInfo->FATHER_OCCU != '') ? " $fathersInfo->FATHER_OCCU " : "" ?></span></td>
            <td><b>Mother's Occupation  </b></td>
            <td><b> : </b></td>
            <td><span id="P_MOTHER_OCU"><?php echo ($motherInfo->MOTHER_OCCU != '') ? " $motherInfo->MOTHER_OCCU " : "" ?></span></td>
        </tr>
        <tr>
            <td><b>Father's Phone  </b></td>
            <td><b> : </b></td>
            <td><span id="P_FATHER_PHN"><?php echo ($fathersInfo->MOBILE_NO != '') ? " $fathersInfo->MOBILE_NO " : "" ?></span></td>
            <td><b>Mother's Phone  </b></td>
            <td><b> : </b></td>
            <td><span id="P_MOTHER_PHN"> <?php echo ($motherInfo->MOBILE_NO != '') ? " $motherInfo->MOBILE_NO " : "" ?></span></td>
        </tr>
        <tr>
            <td><b>Father's Email  </b></td>
            <td><b> : </b></td>
            <td><span id="P_FATHER_EMAIL"><?php echo ($fathersInfo->EMAIL_ADRESS != '') ? " $fathersInfo->EMAIL_ADRESS " : "" ?></span></td>
            <td><b>Mother's Email  </b></td>
            <td><b>: </b></td>
            <td><span id="P_MOTHER_EMAIL"> <?php echo ($motherInfo->EMAIL_ADRESS != '') ? " $motherInfo->EMAIL_ADRESS " : "" ?></span></td>
        </tr>
        <tr>
            <td><b>Father's Work Adderss  </b></td>
            <td><b> : </b></td>
            <td><span id="P_FATHER_WORK_ADRESS"><?php echo ($fathersInfo->WORKING_ORG != '') ? " $fathersInfo->WORKING_ORG " : "" ?></span></td>
            <td><b>Mother's Work Adderss  </b></td>
            <td><b> : </b></td>
            <td><span id="P_MOTHER_WORK_ADDRESS"><?php echo ($motherInfo->WORKING_ORG != '') ? " $motherInfo->WORKING_ORG " : "" ?></span></td>
        </tr> 
    </table> 
</div>
<div class="row" style="padding-top: -10px;">
    <p class="info" style="padding:3px 0px 3px 10px;"><b>Address Information</b></p>
    <table class="table table-bordered">
        <tr>
            <td>
                <table class="table table-bordered">
                    <tr>
                        <td colspan="3"><b>Present Address:</b></td>
                    </tr>
                    <tr>
                        <td><b>Division </b></td>
                        <td><b>:</b></td>
                        <td><span id="Pr_DIVISION_ID"><?php if (!empty($local_present_adddress->DIVIS_NAME)) echo $local_present_adddress->DIVIS_NAME ?></span></td>
                    </tr>
                    <tr>
                        <td><b>District </b></td>
                        <td><b>:</b></td>
                        <td><span id="Pr_DISTRICT_ID"><?php if (!empty($local_present_adddress->DIST_NAME)) echo $local_present_adddress->DIST_NAME ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Upazila/Thana </b></td>
                        <td><b>:</b></td>
                        <td><span id="Pr_THANA_ID"><?php if (!empty($local_present_adddress->thn)) echo $local_present_adddress->thn ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Police Station </b></td>
                        <td><b>:</b></td>
                        <td><span id="Pr_POLICE_STATION_ID"><?php if (!empty($local_present_adddress->PLOSC)) echo $local_present_adddress->PLOSC ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Union/Ward No. </b></td>
                        <td><b>:</b></td>
                        <td><span id="Pr_UNION_ID"><?php if (!empty($local_present_adddress->uni)) echo $local_present_adddress->uni ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Post Office </b></td>
                        <td><b>:</b></td>
                        <td><span id="Pr_POST_OFFICE_ID"><?php if (!empty($local_present_adddress->POSTO)) echo $local_present_adddress->POSTO ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Vill/House no/Road no </b></td>
                        <td><b>:</b></td>
                        <td><span id="Pr_VILLAGE_WARD"><?php if (!empty($local_present_adddress->VILLAGE_WARD)) echo $local_present_adddress->VILLAGE_WARD ?></span></td>
                    </tr>
                </table>
            </td>

            <td>

               <div id="SAME_AS_PRESENT">
                <table class="table table-bordered">
                    <tr>
                        <td><b>Permanent Address:</b></td>
                    </tr>
                    <tr>
                        <td><b>Division </b></td>
                        <td><b>:</b></td>
                        <td><span id="Pr_P_DIVISION_ID"><?php if (!empty($local_permanent_adddress->DIVIS_NAME)) echo $local_permanent_adddress->DIVIS_NAME ?></span></td>
                    </tr>
                    <tr>
                        <td><b>District </b></td>
                        <td><b>:</b></td>
                        <td><span id="Pr_P_DISTRICT_ID"><?php if (!empty($local_permanent_adddress->DIST_NAME)) echo $local_permanent_adddress->DIST_NAME ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Upazila/Thana  </b></td>
                        <td><b>:</b></td>
                        <td><span id="Pr_P_THANA_ID"><?php if (!empty($local_permanent_adddress->thn)) echo $local_permanent_adddress->thn ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Police Station </b></td>
                        <td><b>:</b></td>
                        <td><span id="Pr_P_POLICE_STATION_ID"><?php if (!empty($local_permanent_adddress->PLOSC)) echo $local_permanent_adddress->PLOSC ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Union/Ward No. </b></td>
                        <td><b>:</b></td>
                        <td><span id="Pr_P_UNION_ID"><?php if (!empty($local_permanent_adddress->uni)) echo $local_permanent_adddress->uni ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Post Office </b></td>
                        <td><b>:</b></td>
                        <td><span id="Pr_P_POST_OFFICE_ID"><?php if (!empty($local_permanent_adddress->POSTO)) echo $local_permanent_adddress->POSTO ?></span></td>
                    </tr> 
                    <tr>
                        <td><b>Vill/House no/Road no </b></td>
                        <td><b>:</b></td>
                        <td><span id="Pr_P_VILLAGE_WARD"><?php if (!empty($local_permanent_adddress->VILLAGE_WARD)) echo $local_permanent_adddress->VILLAGE_WARD ?></span></td>
                    </tr>
                </table>

            </div>
        </td>
    </tr>
</table>
</div>
<div class="row" style="padding-top: -10px;">
 <p class="info" style="padding:3px 0px 3px 10px;"><b>Academic Information</b></p>
 <div class="ibox-content">
    <?php if (!empty($academic)) { ?>
    <div class="table-responsive contentArea">
        <table class="table table-striped table-bordered table-hover" width="100%" style="border: 1px solid #C0C0C0; text-align: center;
        padding: 8px;">
        <tr class="info">
            <th>SL</th>
            <th>Exam</th>
            <th>Year</th>
            <th>Board</th>
            <th>Group</th>
            <th>Institute</th>
            <th class="text-center">Result</th>
            <th class="text-center">Result W/A</th>
        </tr>
        <tbody>
            <?php $sl = 0;
            foreach ($academic as $row): $sl++; ?>
            <tr>
                <td><?php echo $sl; ?></td>
                <td><?php echo $row->ed; ?></td>
                <td><?php echo $row->PASSING_YEAR; ?></td>
                <td><?php echo $row->br; ?></td>
                <td><?php echo $row->mg; ?></td>
                <td><?php echo $row->INSTITUTION; ?></td>
                <td class="text-center"><?php echo $row->RESULT_GRADE; ?></td>
                <td class="text-center"><?php echo $row->RESULT_GRADE_WA; ?></td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>
</div>
<?php } else {
    echo "No data found";
} ?>
</div>

</div><br><br><br><br>
<div class="row">
 <p class="info" style="padding:3px 0px 3px 10px;"><b>Local Emergency Guardian</b></p>   
 <table class="table table-bordered" id="others_gurdian_info" style="display: none">
    <tr>
        <td><b> Guardian Name</b></td>
        <td><b> : </b></td>
        <td><span id="P_LOCAL_GAR_NAME"><?php echo ($local_guardian->GURDIAN_NAME != '') ? " $local_guardian->GURDIAN_NAME " : "" ?></span></td>
    </tr>
    <tr>
        <td><b> Relation</b></td>
        <td><b> : </b></td>
        <td><span id="P_LOCAL_GAR_RELATION"><?php echo ($local_guardian->RELATION_WITH_LOCAL_GUARDIAN != '') ? " $local_guardian->RELATION_WITH_LOCAL_GUARDIAN " : "" ?></span></td>
    </tr>
    <tr>
        <td><b> Mobile</b></td>
        <td><b> : </b></td>
        <td><span id="P_LOCAL_GAR_PHN"><?php echo ($local_guardian->MOBILE_NO != '') ? " $local_guardian->MOBILE_NO " : "" ?></span></td>
    </tr>
    <tr>
        <td><b> Address</b></td>
        <td><b> : </b></td>
        <td><span id="P_LOCAL_GAR_ADDRESS"> <?php echo ($local_guardian->ADDRESS != '') ? " $local_guardian->ADDRESS " : "" ?></span></td>
    </tr>
</table>

</div>
<div class="row"  style="padding-top: -10px;">
    <p class="info" style="padding:3px 0px 3px 10px;"><b>Others Information</b></p> 
    <table class="table table-bordered">
        <tr>
            <td><b>Annual Income</b></td>
            <td><b> : </b></td>
            <td><span id="P_ANNUAL_INCOME"></span><?php echo ($applicant_info->ANNUAL_INCOME !='')? " $applicant_info->ANNUAL_INCOME " :"" ?> BDT.</td>
        </tr>
        <tr>
            <td><b>Scholarships receive in the past ?</b></td>
            <td><b> : </b></td>
            <td><span id="P_SCHOLARSHIP"><?php echo ($applicant_info->SCHOLARSHIP !='NO')? " $applicant_info->SCHOLARSHIP_DESC " : "NO" ?></span></td>
        </tr>
        <tr>
            <td><b>Were you expelled from any institution before ?</b></td>
            <td><b> : </b></td>
            <td><span id="P_EXPELLED"><?php echo ($applicant_info->EXPELLED !='NO')? " $applicant_info->EXPELLED_DESC " : "NO" ?></span></td>
        </tr>
        <tr>
            <td><b>Were you ever arrested by law enforcement agency ?</b></td>
            <td><b> : </b></td>
            <td><span id="P_ARRESTED"><?php echo ($applicant_info->ARRESTED !='NO')? " $applicant_info->ARRESTED_DESC " :"NO" ?></span></td>
        </tr>
        <tr>
            <td><b>Arrested Description</b></td>
            <td><b> : </b></td>
            <td><span id="P_ARRESTED_DESC"><?php echo ($applicant_info->ARRESTED_DESC !='NO')? " $applicant_info->ARRESTED_DESC " :"NO" ?></span></td>
        </tr>
        <tr>
            <td><b>Were you ever convicted by any court in Bangladesh of any other country ?</b></td>
            <td><b> : </b></td>
            <td><span id="P_CONVICTED"><?php echo ($applicant_info->CONVICTED !='NO')? " $applicant_info->CONVICTED_DESC " :"NO" ?></span></td>
        </tr>
        <tr>
            <td><b>Did you apply Khwaja Yunus Ali University Before ?</b></td>
            <td><b> : </b></td>
            <td><span id="P_APPLY_BEFORE"><?php echo ($applicant_info->APPLY_BEFORE !='NO')? " $applicant_info->APPLY_SEMESTER ".' '." $applicant_info->APPLY_YEAR " :"NO" ?></span></td>
        </tr>
        <tr>
            <td><b>Semester</b></td>
            <td><b> : </b></td>
            <td><span id="P_APPLY_SEMESTER"></span> <?php echo ($applicant_info->APPLY_SEMESTER !='NO')? " $applicant_info->APPLY_SEMESTER " :"NO" ?><span id="P_APPLY_YEAR"></span></td>
        </tr>
        <tr>
            <td><b>Do you have any siblings currently enrolled at KYAU ?</b></td>
            <td><b> : </b></td>
            <td><span id="P_SIBLING_EXIST"><?php echo ($applicant_info->SIBLING_EXIST !='NO')? " $applicant_info->SBLN_ROLL_NO " :"NO" ?></span></td>
        </tr>

    </table>
</div>
</div>
<!--<div id="footer">-->
    <!--    --><?php //echo $html_footer; ?>
    <!--</div>-->
</body>
</html>
<script type="text/javascript">
    $(document).ready(function(){

        $( "#print_grade_sheet_btn" ).click(function() {
          $('#printablediv').printThis({
                    header: "<center><h2><b>Student Information</b></h2></center>",               // prefix to html
                    footer: null,  

                });
      });

    });
</script>
