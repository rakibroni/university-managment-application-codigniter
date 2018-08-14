 <!doctype html>
<html>
<head>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>resources/assets/css/modules/materialadmin/css/theme-default/bootstrap.css"/>

       <link rel="stylesheet" href="http://localhost/kyau_ums/assets/datatables2/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/kyau_ums/assets/datatables2/buttons.bootstrap.min.css">
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

        table, th, td {
         /*   border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;*/
            

            border-bottom: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
            text-align: left;

        }
        table {
            width: 100%;
        }
        .header{
            text-align: center;
            line-height: 3px;
            font-size: 10px;
        }
        .libriansignature{
            text-align: right;
            margin-top: -55px;
        }
        .rules{
            margin-top: 30px;
        }
        .rules  p{
            line-height: 1px;
        }
    </style>
</head>
<body>
<div id="printBox">




 <div class="ibox float-e-margins">


        <div class="ibox-content">
            <div id="printArea" class="table-responsive contentArea">


    <div class="header">
    

        <div style=" ">
            <h2>Library Membership Form</h2>
            <h5>(For Member)</h5>
            <h2>Library , Khwaja Yunus Ali University</h2>
            <h5>Enayetpur , Siranjgonj - 6751</h5>

        </div>
       
 </div>
     
  <!-- Start  -->
  
       <div class="col-md-12">


        <div id="" class="panel-collapse collapse in" aria-expanded="true">
            <div class="panel-body">
               <div id="printArea" class="table-responsive contentArea">
             <table id="myTable" class="table order-list">

                <tbody>
     
                        <tr>
                            <th>Member Id</th>
                            <td>:</td>
                            <td><?php echo ($student_details->STUDENT_ID !='')? " $student_details->STUDENT_ID " :"" ?></td>
                        </tr>
                        <tr>
                            <th> Name</th>
                            <td>:</td>
                            <td><?php echo ($student_details->FULL_NAME_EN !='')? " $student_details->FULL_NAME_EN " :"" ?></td>
                        </tr>
                         <tr>
                            <th>Section Name</th>
                            <td>:</td>
                            <td><?php echo ($student_details->section_name !='')? " $student_details->section_name " :"" ?></td>
                        </tr>
                         <tr>
                            <th>Batch Name</th>
                            <td>:</td>
                            <td><?php echo ($student_details->BATCH_TITLE !='')? " $student_details->BATCH_TITLE " :"" ?></td>
                        </tr>
                        <tr>
                            <th>Department</th>
                            <td>:</td>
                            <td><?php echo ($student_details->DEPT_NAME !='')? " $student_details->DEPT_NAME " :"" ?></td>
                        </tr>
                        <tr>
                            <th>Program</th>
                            <td>:</td>
                            <td><?php echo ($student_details->PROGRAM_NAME !='')? " $student_details->PROGRAM_NAME " :"" ?></td>

                        </tr>

                        <tr>
                            <th>Present Address</th>
                            <td>:</td>
                            <td><?php echo ($local_present_adddress->uni !='')? "                   $local_present_adddress->uni , $local_present_adddress->thn , $local_present_adddress->DIST_NAME  " :"" ?></td>
                        </tr>
                        <tr>
                            <th>Perment  Address</th>
                            <td>:</td>
                            <td><?php echo ($local_permanent_adddress->uni !='')? "                 $local_permanent_adddress->uni , $local_permanent_adddress->thn ,$local_permanent_adddress->DIST_NAME  " :"" ?></td>
                        </tr>
                      
                        <tr>
                            <th>Mobile</th>
                            <td>:</td>
                            <td><?php echo ($student_details->MOBILE_NO !='')? " $student_details->MOBILE_NO " :"" ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>:</td>
                            <td><?php echo ($student_details->EMAIL_ADRESS !='')? " $student_details->EMAIL_ADRESS " :"" ?></td>
                        </tr>
                        <tr>
                            <th>Gender </th>
                            <td>:</td>
                            <td><?php echo ($student_details->GENDER !='')? " $student_details->GENDER " :"" ?></td>
                        </tr>

                        <tr>
                            <th>Membership No </th>
                            <td>:</td>
                            <td><?php echo ($library_member_info->MEMBER_NO !='')? " $library_member_info->MEMBER_NO " :"" ?></td>
                        </tr>

                        <tr>
                          <?php
                              $t = strtotime($library_member_info->START_DT);
                              $START_DT = date('d/m/y',$t);
                              
                            ?>


                            <th>Date </th>
                            <td>:</td>
                            <td><?php echo ($START_DT !='')? " $START_DT " :"" ?></td>
                        </tr>


                </tbody>



        </table>


        <div class="rules">
          
           <h3 > Rules </h3>
             
           <h5 style="margin-left:2%;"> 
           <?php         
               $terms_and_condition='';
                $i=1;
               foreach($library_policy as $row):
                   $terms_and_condition .= '<p >'. $i++ .'. '. $row->LKP_NAME.'</p>';
               endforeach;
                echo $terms_and_condition; 
            ?>
          </h5>                
            <h5>I agree to obey the library rules. </h5>
        </div>




   <div class="row" style="margin-top:20px;">
       <div class="membersignature" >
       <img
                    style=" border-radius: 3px;margin-bottom: 0px;padding: 0px ;width: 70px"
                    src="<?php echo base_url(); ?>upload/default/default_sign.png">
       <h5> Signature of Member</h5>

       </div>
       <div class="libriansignature" >
       <img
                    style=" border-radius: 3px;margin-bottom: 0px;padding: 0px ;width: 70px"
                    src="<?php echo base_url(); ?>upload/default/default_sign.png">
       <h5> Signature of Librarian (In-Charge)</h5>
       </div>
  </div>

</div>
    </div>
</div>

</div>


  <!-- End --> 

            </div>
        </div>
    </div>

<!-- Second -->























</div>
<!--<div id="footer">-->
<!--    --><?php //echo $html_footer; ?>
<!--</div>-->
</body>
</html>   



































