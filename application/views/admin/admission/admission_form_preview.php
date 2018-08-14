<script src="<?php echo base_url(); ?>assets/js/printThis.js"></script>
<button id="print_grade_sheet_btn" class="btn btn-xs btn-danger pull-right"><i class="fa fa-print"></i>Print</button>
<div id="printablediv" class="ibox-content">
    <div class="row">
        
            <table class="table table-bordered">

                <tr class="info">
                    <td colspan="4"><b>Personal Info </b> </td>

                </tr>    
                <tr>
                    <td><b>Program </b> </td>
                    <td><b>: </b> </td>
                    <td><span id="P_PROGRAM_ID"></span></td>
                    <td rowspan="8">                   
                    <b>Photo :</b> 
                     <br><br>
                        <div class="avatar-zone">
                        <center><img id="p_img_id" src="<?php echo base_url('assets/img/default.jpg'); ?>"
                        alt="select photo" style="width: 180px;
                        height: 160px;"/></center>
                    </div>
                    

                    </td>
                </tr>        
                <tr>
                    <td><b>Name in English  </b> </td>
                    <td><b>: </b> </td>
                    <td><span id="P_FULL_NAME"></span>  </td>
                </tr>
                <tr>
                    <td><b>Name in Bangla  </b> </td>
                    <td><b>: </b> </td>
                    <td><span id="P_FULL_NAME_BN"></span></td>
                </tr>
                <tr>
                    <td><b>Mobile No. </b> </td>
                    <td><b>: </b> </td>
                    <td> <span id="P_MOBILE_NO"></span></td>
                </tr>
                <tr>
                    <td><b>Gender  </b> </td>
                    <td><b>: </b> </td>
                    <td><span id="P_GENDER"></span></td>
                </tr>
                <tr>
                    <td><b>Date of Birth  </b> </td>
                    <td><b>: </b> </td>
                    <td> <span id="P_DATE_OF_BIRTH"></span> </td>
                </tr>
                <tr>
                    <td><b>Email  </b> </td>
                    <td><b>: </b> </td>
                    <td><span id="P_EMAIL"></span></td>
                   
                </tr>

                <tr>
                    <td><b>Place of Birth  </b> </td>
                    <td><b> : </b> </td>
                    <td><span id="P_PLACE_OF_BIRTH"></span></td>
                </tr>
                <tr>
                    <td><b>Blood Group  </b> </td>
                    <td><b> : </b> </td>
                    <td><span id="P_BLOOD_GROUP"></span></td>
                     <td rowspan="7">
                     <b>Signature :</b> 
                     <br><br>
                        <div class="avatar-zone-sig">
                        <center> </center><img id="p_sig_id" src="<?php echo base_url('assets/img/signature.jpg'); ?>"
                        alt="select photo"  style="width: 180px;
                        height: 50px;"/>
                    </div>

                    
                    </td>
                </tr>
                <tr>
                  <td><b>Marital Status  </b> </td>
                  <td><b> : </b> </td>
                  <td><span id="P_MARITAL_STATUS"></span></td>
              </tr>
              <tr> 
                <td><b>Religion  </b> </td>
                <td><b> : </b> </td>
                <td><span id="P_RELIGION_ID"></span></td>
            </tr> 
            <tr>
                <td><b>Birth Certificate </b> </td>
                <td><b> : </b> </td>
                <td><span id="P_BIRTH_CERTIFICATE"></span></td>
            </tr>
            <tr>
                <td><b>National ID </b> </td>
                <td><b> : </b> </td>
                <td><span id="P_NATIONAL_ID"></span></td>
            </tr>
            <tr>
                <td><b>Height  </b> </td>
                <td><b> : </b> </td>
                <td><span id="P_HEIGHT_FEET">  </span> Ft. /<span id="P_HEIGHT_CM"> </span> CM</td>
            </tr>
            <tr>
                <td><b>Weight  </b> </td>
                <td><b>: </b> </td>
                <td><span id="P_WEIGHT_KG">  </span> KG. /<span id="P_WEIGHT_LBS"> </span> LBS</td>
            </tr>
        </table>


    
   
</div>    
<div class="clearfix"></div>

<div class="row" >
   <table class="table table-bordered">
    <tr class="info">
       <td colspan="6"><b>Familly Info</b></td>
   </tr>
   <tr>
    <td><b>Father's Name  </b></td>
    <td><b> : </b></td>
    <td><span id="P_FATHER_NAME"></span></td>
    <td><b>Mother's Name </b></td>
    <td><b>: </b></td>
    <td><span id="P_MOTHER_NAME"></span></td>
</tr>
<tr>
    <td><b>Father's Occupation  </b></td>
    <td><b> : </b></td>
    <td><span id="P_FATHER_OCU"></span></td>
    <td><b>Mother's Occupation  </b></td>
    <td><b> : </b></td>
    <td><span id="P_MOTHER_OCU"></span></td>
</tr>
<tr>
    <td><b>Father's Phone  </b></td>
    <td><b> : </b></td>
    <td><span id="P_FATHER_PHN"></span></td>
    <td><b>Mother's Phone  </b></td>
    <td><b> : </b></td>
    <td><span id="P_MOTHER_PHN"></span></td>
</tr>
<tr>
    <td><b>Father's Email  </b></td>
    <td><b> : </b></td>
    <td><span id="P_FATHER_EMAIL"></span></td>
    <td><b>Mother's Email  </b></td>
    <td><b>: </b></td>
    <td><span id="P_MOTHER_EMAIL"></span></td>
</tr>
<tr>
    <td><b>Father's Work Adderss  </b></td>
    <td><b> : </b></td>
    <td><span id="P_FATHER_WORK_ADRESS"></span></td>
    <td><b>Mother's Work Adderss  </b></td>
    <td><b> : </b></td>
    <td><span id="P_MOTHER_WORK_ADDRESS"></span></td>
</tr> 
</table> 
</div>
<div class="row">
<table class="table table-bordered">
<tr>
    <td>
        <table class="table table-bordered">
            <tr class="info">
                <td colspan="3"><b>Present Address</b></td>
            </tr>
            <tr>
                <td><b>Division </b></td>
                <td><b>:</b></td>
                <td><span id="Pr_DIVISION_ID"></span></td>
            </tr>
            <tr>
                <td><b>District </b></td>
                <td><b>:</b></td>
                <td><span id="Pr_DISTRICT_ID"></span></td>
            </tr>
            <tr>
                <td><b>Upazila/Thana </b></td>
                <td><b>:</b></td>
                <td><span id="Pr_THANA_ID"></span></td>
            </tr>
            <tr>
                <td><b>Police Station </b></td>
                <td><b>:</b></td>
                <td><span id="Pr_POLICE_STATION_ID"></span></td>
            </tr>
            <tr>
                <td><b>Union/Ward No. </b></td>
                <td><b>:</b></td>
                <td><span id="Pr_UNION_ID"></span></td>
            </tr>
            <tr>
                <td><b>Post Office </b></td>
                <td><b>:</b></td>
                <td><span id="Pr_POST_OFFICE_ID"></span></td>
            </tr>
            <tr>
                <td><b>Vill/House no/Road no </b></td>
                <td><b>:</b></td>
                <td><span id="Pr_VILLAGE_WARD"></span></td>
            </tr>
        </table>
    </td>

    <td>

       <div id="SAME_AS_PRESENT">
        <table class="table table-bordered">
            <tr class="info">
                <td colspan="3"><b>Permanent Address</b></td>
            </tr>
            <tr>
                <td><b>Division </b></td>
                <td><b>:</b></td>
                <td><span id="Pr_P_DIVISION_ID"></span></td>
            </tr>
            <tr>
                <td><b>District </b></td>
                <td><b>:</b></td>
                <td><span id="Pr_P_DISTRICT_ID"></span></td>
            </tr>
            <tr>
                <td><b>Upazila/Thana  </b></td>
                <td><b>:</b></td>
                <td><span id="Pr_P_THANA_ID"></span></td>
            </tr>
            <tr>
                <td><b>Police Station </b></td>
                <td><b>:</b></td>
                <td><span id="Pr_P_POLICE_STATION_ID"></span></td>
            </tr>
            <tr>
                <td><b>Union/Ward No. </b></td>
                <td><b>:</b></td>
                <td><span id="Pr_P_UNION_ID"></span></td>
            </tr>
            <tr>
                <td><b>Post Office </b></td>
                <td><b>:</b></td>
                <td><span id="Pr_P_POST_OFFICE_ID"></span></td>
            </tr> 
            <tr>
                <td><b>Vill/House no/Road no </b></td>
                <td><b>:</b></td>
                <td><span id="Pr_P_VILLAGE_WARD"></span></td>
            </tr>
        </table>

</div>
    </td>
    </tr>
    </table>

</div>
<br><br><br><br>
<div class="row" >
   <table class="table table-bordered">
    <tr class="info">
        <td colspan="7"><b> Academic Information</b></td>
    </tr>
    <tr>
        <td><b>Exam Name</b> </td>
        <td><b>Passing Year</b></td>
        <td><b>Board</b></td>
        <td><b>Group</b></td>
        <td><b>GPA</b></td>
        <td><b>GPA/CGPA With out additional</b></td>
        <td><b>Institute Name</b></td>
    </tr>
    <tr>
        <td><span id="P_EXAM_NAME_S"></span></td>
        <td><span id="P_PASSING_YEAR_S"></span></td>
        <td><span id="P_BOARD_S"></span></td>
        <td><span id="P_GROUP_S"></span></td>
        <td><span id="P_GPA_S"></span></td>
        <td><span id="P_GPAWA_S"></span></td>
        <td><span id="P_INSTITUTE_S"></span></td>
    </tr>
    <tr>
        <td><span id="P_EXAM_NAME_H"></span></td>
        <td><span id="P_PASSING_YEAR_H"></span></td>
        <td><span id="P_BOARD_H"></span></td>
        <td><span id="P_GROUP_H"></span></td>
        <td><span id="P_GPA_H"></span></td>
        <td><span id="P_GPAWA_H"></span></td>
        <td><span id="P_INSTITUTE_H"></span></td>
    </tr>
     
        <tr id="preview_post_graduate_tr" style="display: none">
            <td><span id="P_EXAM_NAME_G"></span></td>
            <td><span id="P_PASSING_YEAR_G"></span></td>
            <td><span id="P_BOARD_G"></span></td>
            <td><span id="P_GROUP_G"></span></td>
            <td><span id="P_GPA_G"></span></td>
            <td><span id="P_GPAWA_G"></span></td>
            <td><span id="P_INSTITUTE_G"></span></td>
        </tr>
    
</table>

</div>
<div class="row">   

    <table class="table table-bordered" id="local_guardian_div">
        <tr class="info">
            <td><b>Local Emergency Guardian :</b> <span id="local_guardian_val"></span></td>
        </tr>
    </table>
    <table class="table table-bordered" id="others_gurdian_info" style="display: none">
        <tr class="info">
            <td colspan="3"><b>Local Emergency Guardian </b> </td>
        </tr>
        <tr>
            <td><b> Guardian Name</b></td>
            <td><b> : </b></td>
            <td><span id="P_LOCAL_GAR_NAME"></span></td>
        </tr>
        <tr>
            <td><b> Relation</b></td>
            <td><b> : </b></td>
            <td><span id="P_LOCAL_GAR_RELATION"></span></td>
        </tr>
        <tr>
            <td><b> Mobile</b></td>
            <td><b> : </b></td>
            <td><span id="P_LOCAL_GAR_PHN"></span></td>
        </tr>
        <tr>
            <td><b> Address</b></td>
            <td><b> : </b></td>
            <td><span id="P_LOCAL_GAR_ADDRESS"></span></td>
        </tr>
    </table>
    
</div>
<div class="row"> 
    <table class="table table-bordered">
        <tr class="info">
            <td colspan="3"><b>Others Information</b> </td>
        </tr>
        <tr>
            <td><b>Annual Income</b></td>
            <td><b> : </b></td>
            <td><span id="P_ANNUAL_INCOME"></span> BDT.</td>
        </tr>
        <tr>
            <td><b>Scholarships receive in the past ?</b></td>
            <td><b> : </b></td>
            <td><span id="P_SCHOLARSHIP"></span></td>
        </tr>
        <tr>
            <td><b>Scholarships Description</b></td>
            <td><b> : </b></td>
            <td><span id="P_SCHOLARSHIP_DESC"></span></td>
        </tr>
        <tr>
            <td><b>Were you expelled from any institution before ?</b></td>
            <td><b> : </b></td>
            <td><span id="P_EXPELLED"></span></td>
        </tr>
        <tr>
            <td><b>Expelled Description</b></td>
            <td><b> : </b></td>
            <td><span id="P_EXPELLED_DESC"></span></td>
        </tr>
        <tr>
            <td><b>Were you ever arrested by law enforcement agency ?</b></td>
            <td><b> : </b></td>
            <td><span id="P_ARRESTED"></span></td>
        </tr>
        <tr>
            <td><b>Arrested Description</b></td>
            <td><b> : </b></td>
            <td><span id="P_ARRESTED_DESC"></span></td>
        </tr>
        <tr>
            <td><b>Were you ever convicted by any court in Bangladesh of any other country ?</b></td>
            <td><b> : </b></td>
            <td><span id="P_CONVICTED"></span></td>
        </tr>
        <tr>
            <td><b>Convicted Description</b></td>
            <td><b> : </b></td>
            <td><span id="P_CONVICTED_DESC"></span></td>
        </tr>
        <tr>
            <td><b>Did you apply Khwaja Yunus Ali University Before ?</b></td>
            <td><b> : </b></td>
            <td><span id="P_APPLY_BEFORE"></span></td>
        </tr>
        <tr>
            <td><b>Semester</b></td>
            <td><b> : </b></td>
            <td><span id="P_APPLY_SEMESTER"></span> <span id="P_APPLY_YEAR"></span></td>
        </tr>
        <tr>
            <td><b>Do you have any siblings currently enrolled at KYAU ?</b></td>
            <td><b> : </b></td>
            <td><span id="P_SIBLING_EXIST"></span></td>
        </tr>
        <tr>
            <td><b>Roll No.</b></td>
            <td><b> : </b></td>
            <td><span id="P_SBLN_ROLL_NO"></span></td>
        </tr>

    </table>
</div>
</div>

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