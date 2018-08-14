    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Library Membership From</h5>

            <div class="ibox-tools">
                <a   class="btn btn-primary btn-xs pull-right " href="<?php echo site_url()?>/library/applicationForLibraryMember">List </a>
            </div>

        </div>

        <div class="ibox-content">
            <div id="printArea" class="table-responsive contentArea">
      
  <!-- Start  -->

    <form class="form-horizontal frmContent" id="inventory" method="post" action="<?php echo base_url('library/libraryMemberPdf') ?>" target="_blank">
     
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
                            <td><?php echo ($local_present_adddress !='')? "                   $local_present_adddress->uni , $local_present_adddress->thn , $local_present_adddress->DIST_NAME  " :"" ?></td>
                        </tr>
                        <tr>
                            <th>Perment  Address</th>
                            <td>:</td>
                            <td><?php echo ($local_permanent_adddress !='')? "                 $local_permanent_adddress->uni , $local_permanent_adddress->thn ,$local_permanent_adddress->DIST_NAME  " :"" ?></td>
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


        <div>
          
           <h3 > Rules </h3>
             
           <h5 style="margin-left:2%"> &nbsp;&nbsp;&nbsp;   
           <?php         
               $terms_and_condition='';
                $i=1;
               foreach($library_policy as $row):
                   $terms_and_condition .= '<p>'. $i++ .'. '. $row->LKP_NAME.'</p>';
               endforeach;
                echo $terms_and_condition; 
            ?>
          </h5>                
            <p>I agree to obey the library rules. </p>
        </div>




   <div class="row" style="margin-top:50px;">
       <div class="col-sm-6" ><p> Signature of Member</p></div>
       <div class="col-sm-6" ><p> Signature of Librarian (In-Charge)</p></div>
  </div>

</div>
    </div>
</div>

</div>


<section>
    <div class="form-group">
        <div class="col-lg-offset-5 col-lg-10">
            <span class="modal_msg pull-left"></span>  

            <input type="hidden" name="STUDENT_ID" value="<?php echo $student_details->STUDENT_ID;  ?>">
            <input  type="submit" class="btn btn-primary btn-sm " value="Print Membership Form" >

           <!--   <a target="_blank" href="<?php //echo base_url();?>/employee/employeeCardPdf/<?php //$student_details->STUDENT_ID ?>" class="pull-right btn btn-xs btn-primary"><i class="fa fa-print "></i>  Print Membership Form </a>  
            <span class="loadingImg"></span> -->

        </div>
    </div>
</section>

</form>

  <!-- End --> 

            </div>
        </div>
    </div>

<!-- Second -->



