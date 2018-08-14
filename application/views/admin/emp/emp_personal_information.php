<h4 class="green">Personal Information</h4>
<div class="ibox-content">
    <div class="table-responsive contentArea">
        <table class="table table-striped table-bordered table-hover gridTable">
            <tbody>
            <tr>

                <th>Full Name.</th>
                <td>:</td>
                <td><?php echo ($emp_info->FULL_ENAME !='')? " $emp_info->FULL_ENAME " :"" ?></td>
            </tr>
            <tr>

                <th>Full Name Bn</th>
                <td>:</td>
                <td><?php echo ($emp_info->FULL_BNAME !='')? " $emp_info->FULL_BNAME " :"" ?></td>
            </tr>
            <tr>

                <th>Father Name</th>
                <td>:</td>
                <td><?php echo ($emp_info->FATHER_NAME !='')? " $emp_info->FATHER_NAME " :"" ?></td>
            </tr>
            <tr>
                <th>Mother Name</th>
                <td>:</td>
                <td><?php echo ($emp_info->MOTHER_NAME !='')? " $emp_info->MOTHER_NAME " :"" ?></td>

            </tr>
            <tr>
                <?php
                $t = strtotime($emp_info->DOB);
                $formattedDOB = date('d/m/y',$t);
                ?>
                <th>Date of Birth</th>
                <td>:</td>
                <td><?php echo ($formattedDOB !='')? " $formattedDOB " :"" ?></td>
            </tr>
            <tr>
                <th>Place of Birth</th>
                <td>:</td>
                <td><?php echo ($emp_info->PLACE_OF_BIRTH !='')? " $emp_info->PLACE_OF_BIRTH " :"" ?></td>
            </tr>
            <tr>
                <th>Mobile No.</th>
                <td>:</td>
                <td><?php echo ($emp_info->MOBILE !='')? " $emp_info->MOBILE " :"" ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td>:</td>
                <td><?php echo ($emp_info->EMAIL !='')? " $emp_info->EMAIL " :"" ?></td>
            </tr>

            <tr>
                <th>Nationality</th>
                <td>:</td>
                <td><?php echo ($emp_info->LKP_NATIONALITY !='')? " $emp_info->LKP_NATIONALITY " :"" ?></td>
            </tr>
            <tr>
                <th>National ID</th>
                <td>:</td>
                <td><?php echo ($emp_info->NATIONAL_ID !='')? " $emp_info->NATIONAL_ID " :"" ?></td>
            </tr>
            <tr>
                <th>Religion</th>
                <td>:</td>
                <td><?php echo ($emp_info->LKP_RELIGION !='')? " $emp_info->LKP_RELIGION " :"" ?></td>
            </tr>
            <tr>
                <th>Blood Group</th>
                <td>:</td>
                <td><?php echo ($emp_info->BLOOD_GROUP !='')? " $emp_info->BLOOD_GROUP " :"" ?></td>
            </tr>

            <tr>
                <th>Marital Status</th>
                <td>:</td>
                <td><?php echo ($emp_info->MARITAL_STATUS !='')? " $emp_info->MARITAL_STATUS " :"" ?></td>
            </tr>

             <tr>
                <th>Bio-matric ID</th>
                <td>:</td>
                <td><?php echo ($emp_info->BIOMETRIC_ID !='')? " $emp_info->BIOMETRIC_ID " :"" ?></td>
            </tr>
            
            <tr>
                <th>Join Date</th>
                <td>:</td>
                <?php
                $t = strtotime($emp_info->JOIN_DATE);
                $formattedDOB = date('d/m/y',$t);
                ?>       
                <td><?php echo ($formattedDOB !='')? " $formattedDOB " :"" ?></td>
            </tr>

            
            <tr>
                <th>Height</th>
                <td>:</td>
                <td> <?php echo ($emp_info->HEIGHT_FEET !='')? " $emp_info->HEIGHT_FEET Feet" :"";?></td>
            </tr>
            <tr>
                <th>Weight</th>
                <td>:</td>
                <td><?php echo ($emp_info->WEIGHT_KG !='')? " $emp_info->WEIGHT_KG Kg." :"" ?></td>
            </tr>

            <tr>
                <th>Signature</th>
                <td>:</td>
                <td>
                 <?php $photo="upload/employee/signature/".$emp_info->EMP_SIG ; ?>    
                    <img style="width: 180px; height: 50px;" src="<?php echo base_url($photo); ?>" class="img-responsive" alt="">
                </td>
            </tr>

            </tbody>
        </table>
    </div>
</div>