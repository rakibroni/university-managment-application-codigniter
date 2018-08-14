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
            <h4 style="width:100%;text-align:center; margin:10px 0 -10 0; line-height:18px;"><?php echo ($emp_personal_info->FULL_ENAME !='')? " $emp_personal_info->FULL_ENAME " :"" ?> Profile</h4><br>
            <div class="row">
              <p class="info" style="padding:3px 0px 3px 10px;"><b>Personal Information</b></p>
              <table class="table table-bordered">    
                <tr>
                    <td class="bgColor"><b>Name in English  </b> </td>
                    <td><b>: </b> </td>
                    <td><span><?php echo ($emp_personal_info->FULL_ENAME !='')? " $emp_personal_info->FULL_ENAME " :"" ?></span>  </td> 
                     <td  style="padding-left: 240px;" rowspan="7">
                    <?php if (!empty($emp_personal_info->EMP_IMG)) { ?>           
                        <div class="avatar-zone">
                            <center>
                               <?php $photo=($emp_personal_info->EMP_IMG !='')? "upload/employee/photo/".$emp_personal_info->EMP_IMG: 'upload/default/default_pic.png' ?>
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
                    <td><span style="font-family:nikosh;"><?php echo ($emp_personal_info->FULL_BNAME !='')? " $emp_personal_info->FULL_BNAME " :"" ?></span></td>
                </tr>
                <tr>
                    <td style="" ><b>Father Name</b></td>
                    <td ><b>: </b> </td>
                    <td><span><?php echo ($emp_personal_info->FATHER_NAME !='')? " $emp_personal_info->FATHER_NAME " :"" ?></span></td>
                </tr>
                <tr>
                    <td><b>Mother Name</b> </td>
                    <td><b>: </b> </td>
                    <td> <span><?php echo ($emp_personal_info->MOTHER_NAME !='')? " $emp_personal_info->MOTHER_NAME " :"" ?></span></td>
                </tr>
                <tr>
                    <?php
                    $t = strtotime($emp_personal_info->DOB);
                    $formattedDOB = date('d/m/y',$t);
                    ?>
                    <td><b>Date of Birth</b> </td>
                    <td><b>: </b> </td>
                    <td><span><?php echo ($formattedDOB !='')? " $formattedDOB " :"" ?></span></td>
                </tr>
                <tr>
                    <td><b>Place of Birth</b> </td>
                    <td><b>: </b> </td>
                    <td> <span><?php echo ($emp_personal_info->PLACE_OF_BIRTH !='')? " $emp_personal_info->PLACE_OF_BIRTH " :"" ?></span> </td> 
                </tr>
                <tr>
                    <td><b>Mobile No.</b> </td>
                    <td><b>: </b> </td>
                    <td><span><?php echo ($emp_personal_info->MOBILE !='')? " $emp_personal_info->MOBILE " :"" ?></span></td>

                </tr>

                <tr>
                    <td><b>Email </b> </td>
                    <td><b> : </b> </td>
                    <td><span><?php echo ($emp_personal_info->EMAIL !='')? " $emp_personal_info->EMAIL " :"" ?></span></td>
                </tr>
                <tr>
                    <td><b>Nationality </b> </td>
                    <td><b> : </b> </td>
                    <td><span><?php echo ($emp_personal_info->LKP_NATIONALITY !='')? " $emp_personal_info->LKP_NATIONALITY " :"" ?></span></td>
                    <td  style="padding-left: 240px;" rowspan="7">
                        <?php if (!empty($emp_personal_info->EMP_SIG)) { ?>
                        <div class="avatar-zone-sig">
                            <center> </center><?php $photo=($emp_personal_info->EMP_SIG !='')? "upload/employee/signature/".$emp_personal_info->EMP_SIG : 'upload/employee/signature/default_sign.png' ?>
                            <img style="width: 130px; height: 50px;" src="<?php echo base_url($photo); ?>" class="img-responsive" alt="">
                        </div>
                        <b>Signature</b> 
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                  <td><b>National ID</b> </td>
                  <td><b> : </b> </td>
                  <td><span><?php echo ($emp_personal_info->NATIONAL_ID !='')? " $emp_personal_info->NATIONAL_ID " :"" ?></span></td>
              </tr>
              <tr> 
                <td><b>Religion</b> </td>
                <td><b> : </b> </td>
                <td><span id="P_RELIGION_ID"><?php echo ($emp_personal_info->LKP_RELIGION !='')? " $emp_personal_info->LKP_RELIGION " :"" ?></span></td>
            </tr> 
            <tr>
                <td><b>Blood Group </b> </td>
                <td><b> : </b> </td>
                <td><span id="P_BIRTH_CERTIFICATE"><?php echo ($emp_personal_info->BLOOD_GROUP !='')? " $emp_personal_info->BLOOD_GROUP " :"" ?></span></td>
            </tr>
            <tr>
                <td><b>Marital Status</b> </td>
                <td><b> : </b> </td>
                <td><span id="P_NATIONAL_ID"><?php echo ($emp_personal_info->MARITAL_STATUS !='')? " $emp_personal_info->MARITAL_STATUS " :"" ?></span></td>
            </tr>
            <tr>
                <td><b>Bio-matric ID</b> </td>
                <td><b> : </b> </td>
                <td><span id="P_HEIGHT_FEET"> <?php echo ($emp_personal_info->BIOMETRIC_ID !='')? " $emp_personal_info->BIOMETRIC_ID " :"" ?></td>
                </tr>
                <tr>
                   <?php
                   $t = strtotime($emp_personal_info->JOIN_DATE);
                   $formattedDOB = date('d/m/y',$t);
                   ?>
                   <td><b>Join Date </b> </td>
                   <td><b>: </b> </td>
                   <td><span id="P_WEIGHT_KG"> <?php echo ($formattedDOB !='')? " $formattedDOB " :"" ?></span></td>
               </tr>
               <tr>
                <td><b>Height</b> </td>
                <td><b> : </b> </td>
                <td><span id="P_HEIGHT_FEET"> <?php echo ($emp_personal_info->HEIGHT_FEET !='')? " $emp_personal_info->HEIGHT_FEET Feet" :"";?></td>
                </tr>
                <tr>
                    <td><b>Weight</b> </td>
                    <td><b> : </b> </td>
                    <td><span id="P_HEIGHT_FEET"> <?php echo ($emp_personal_info->WEIGHT_KG !='')? " $emp_personal_info->WEIGHT_KG Kg." :"" ?></td>
                    </tr>
                </table>




            </div>    
            <div class="clearfix"></div>

            <div class="row">
                <p class="info" style="padding:3px 0px 3px 10px;"><b>Desigation Information</b></p>
               <div class="ibox-content">
                <?php if (!empty($emp_designation_info)) { ?>
                <div class="table-responsive contentArea">
                    <table class="table table-striped table-bordered table-hover" width="100%" style="border: 1px solid #C0C0C0; text-align: center;
                    padding: 8px;">
                    <tr class="info">
                        <th>SL</th>
                        <th>Department  Name</th>
                        <th>Desigation </th>
                        <th>Default</th>
                    </tr>
                    <tbody>
                        <?php $sl = 0;
                        foreach ($emp_designation_info as $row): $sl++; ?>
                        <tr>
                            <td><?php echo $sl; ?></td>
                            <td><?php echo $row->DEPT_NAME; ?></td>
                            <td><?php echo $row->DESIGNATION; ?></td>
                            <td> <?php 
                                if($row->DEFAULT_FG==1){
                                echo "Yes";
                            }
                            else{
                            echo "No";
                        }
                        ?></td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
    <?php } else {
    echo "No data found";
} ?>
</div>

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
