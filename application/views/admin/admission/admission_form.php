<link href="<?php echo base_url(); ?>assets/keyboard/keyboard.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url()?>/assets/css/plugins/jQueryUI/jquery-ui.css">

    <style>
        .flexy {
            display: block;
            width: 90%;
            border: 1px solid #eee;
            max-height: 200px;
            overflow: auto;
        }

        .avatar-zone {
            width: 140px;
            height: 200px;

        }

        .overlay-layer {
            width: 180px;
            height: 40px;
            position: absolute;
            margin-top: -40px;
            opacity: 0.5;
            background-color: #000000;
            z-index: 0;
            font-size: 15px;
            color: #FFFFFF;
            text-align: center;
            line-height: 40px;

        }  
        .avatar-zone-sig {
            width: 140px;
            height: 92px;

        }

        .overlay-layer-sig {
            width: 180px;
            height: 40px;
            position: absolute;
            margin-top: -40px;
            opacity: 0.5;
            background-color: #000000;
            z-index: 0;
            font-size: 15px;
            color: #FFFFFF;
            text-align: center;
            line-height: 40px;
        }

        .upload_btn {
            position: absolute;
            width: 200px;
            height: 40px;
            margin-top: -40px;
            z-index: 10;
            opacity: 0;
        }

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

        .toggle-div {
            display: none;
            background-color: #FCF8E3;
            padding: 10px;
            border-radius: 10px;
        }

        .toggle-div-course {
            display: none;
            background-color: #FCF8E3;
            padding: 10px;
            border-radius: 10px;
            width: 400px;
        }

        .toggle-div1 {
            background-color: #FCF8E3;
            padding: 10px;
            border-radius: 10px;
        }
    </style>
    <link href="<?php echo base_url(); ?>assets/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
    <div id="admission_form_div">
        <div class="ibox float-e-margins">

            <div class="ibox-title">
                <h5>Admission Form</h5>

                <div class="ibox-tools">

                </div>
            </div>
            <form id="admission_form" class="form-horizontal" action="" method="post"  enctype="multipart/form-data">
                <?php 
                $applicant_summary=$this->session->userdata('applicant_summary');
                $app_academic_sess_array=$this->session->userdata('app_academic_sess_array');

                ?>
                <div class="">
                    <div class="ibox-content">
                        <strong>NOTE : </strong> All <span class="red">*</span> field are required.
                        <h4 style="color:green">Personal Information</h4>

                        <div class="div-background">
                            <div class="col-md-7">
                                <div class="form-group">
                                 <label class="col-md-5 control-label " for="FIRST_NAME" >Degree <span class="text-danger">*</span></label>
                                 <div class="col-md-5">
                                    <select class="form-control" name="DEGREE_ID"   id="DEGREE_ID">
                                        <option value="">-Select-</option>
                                        <?php foreach ($degree as $row) { ?>
                                        <option value="<?php echo $row->DEGREE_ID ?>"><?php echo $row->DEGREE_NAME ?></option>
                                        <?php } ?>
                                    </select> 
                                 </div>
                                 <br clear="all"/>
                             </div>     
                                <div class="form-group">
                                 <label class="col-md-5 control-label " for="FIRST_NAME" >Program <span class="text-danger">*</span></label>
                                 <div class="col-md-5">
                                    <select class="form-control" name="PROGRAM_ID"   id="PROGRAM_ID">
                                        <option value="">-Select-</option>
                                        
                                    </select> 
                                 </div>
                                 <br clear="all"/>
                             </div>     

                             <div class="form-group">
                                <label class="col-md-5 control-label">Full Name <span class="text-danger">*</span></label>
                                <div class="col-md-5 ">

                                    <input type="text" name="FULL_NAME"  value="<?php echo set_value('FULL_NAME'); ?>"   class="form-control" id="FULL_NAME" placeholder="Full Name"/>
                                     
                                    <div class="text-danger">
                                     <?php echo form_error('FULL_NAME'); ?>
                                 </div>

                             </div>
                              <div class="col-md-2">
                                <i class="fa fa-info-circle pointer2" data-content="* (As per Certificate of SSC/ Equivalent Examination)"
                                data-placement="right" data-toggle="popover" data-container="body"
                                data-original-title="" title="Help"></i>
                            </div>
                             <br clear="all"/>
                         </div>
                         <div class="form-group">
                            <label  for="FULL_NAME_BN" class="col-md-5 control-label">নাম ( বাংলা ) <span class="red">*</span></label>

                            <div class="col-md-5">
                                <input type="text" name="FULL_NAME_BN" id="FULL_NAME_BN"
                                value="<?php  set_value('FULL_NAME_BN') ?>"
                                class="form-control keyboardInput" placeholder="বাংলা নাম" >
                                <span class="red"><?php echo form_error('FULL_NAME_BN'); ?></span>
                            </div>
                            <div class="col-md-2">
                                <i class="fa fa-info-circle pointer2" data-content="বাংলায় আপনার  নাম লিখুন"
                                data-placement="right" data-toggle="popover" data-container="body"
                                data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 control-label" for="GENDEN">Gender<span class="text-danger">*</span></label>
                            <div class="col-md-5 ">
                                <input type="radio" name="GENDER" class="gender required" value="M" data-value="Male" checked="checked"/> Male
                                &nbsp;&nbsp;
                                <input type="radio" name="GENDER" class="gender required" value="F" data-value="Female"/> Female
                                &nbsp;&nbsp;
                                <input type="radio" name="GENDER" class="gender required" value="O" data-value="Others"/> Others
                            </div>
                            <br clear="all"/>
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 control-label">Mobile No <span class="text-danger">*</span></label>
                            <!--            <div class="row">-->
                            <!--                <div class="col-md-1" style="width:6.333333% !important ; padding-right:2px !important;">-->
                            <!--                    <input type="text" class="form-control text-right" style="padding:3px !important;" placeholder="+88" readonly="readonly" />-->
                            <!--                </div>-->
                            <div class="col-md-5">
                                <input type="text" name="MOBILE_NO" id="MOBILE_NO" value="<?php echo set_value('MOBILE_NO'); ?>" maxlength="11" class="form-control numericOnly" placeholder="01XXXXXXXXX"/>
                                <div class="text-danger">
                                 <?php echo form_error('MOBILE_NO'); ?>
                             </div>
                         </div>
                         <!--         </div>-->
                     </div> 
                     <div class="form-group">
                        <label class="col-md-5 control-label" >Email<span class="text-danger">*</span></label>
                        <div class="col-md-5">                                 
                            <input type="text" name="EMAIL" id="EMAIL" value="<?php echo set_value('EMAIL'); ?>" id=""  class="form-control" placeholder="user@mydomain.com"/>
                            <div class="text-danger">
                             <?php echo form_error('EMAIL'); ?>
                         </div>
                     </div>
                     <br clear="all"/>
                 </div>
                 <div class="form-group">
                    <label class="col-md-5 control-label" >Date of  Birth<span class="text-danger">*</span></label>
                    <div class="col-md-5 ">
                    <input type="text" name="DATE_OF_BIRTH"  class="form-control" data-mask="99/99/9999" placeholder="dd/mm/yyyy">
                        
                        <div class="text-danger">
                         <?php echo form_error('DATE_OF_BIRTH'); ?>
                     </div>
                 </div>
             </div>



             <div class="form-group">
                <label for="PLACE_OF_BIRTH" class="col-md-5 control-label">Place of Birth <span class="red">*</span></label>

                <div class="col-md-5"> 
                    <input type="text" name="PLACE_OF_BIRTH" id="PLACE_OF_BIRTH"
                    class="form-control" value="<?php echo isset( $applicant_summary['PLACE_OF_BIRTH']) ? $applicant_summary['PLACE_OF_BIRTH'] : set_value('PLACE_OF_BIRTH') ?>"
                    placeholder="Place of Birth">


                    <span class="red"><?php echo form_error('PLACE_OF_BIRTH'); ?></span>
                </div>
                <div class="col-md-2">
                    <i class="fa fa-info-circle pointer2"
                    data-content="Enter the name of place where are you born" data-placement="right"
                    data-toggle="popover" data-container="body" data-original-title=""
                    title="Help"></i>
                </div>
            </div>
            <div class="form-group">
                <label for="BLOOD_GRP" class="col-md-5 control-label">Blood Group </label>
                <div class="col-md-5">

                    <select id="BLOOD_GRP" name="BLOOD_GRP" class="form-control">
                        <option value="">-Select-</option>
                        <?php foreach ($blood_group as $row): ?>
                            <option value="<?php echo $row->LKP_ID ?>" <?php echo ( $applicant_summary['BLOOD_GRP'] == $row->LKP_ID) ? 'selected' : set_value('BLOOD_GRP') ?>><?php echo $row->LKP_NAME ?></option>
                        <?php endforeach; ?>
                    </select>

                    <span class="red"><?php echo form_error('BLOOD_GRP'); ?></span>
                </div>
                <div class="col-md-2">
                    <i class="fa fa-info-circle pointer2" data-content="Select your blood group"
                    data-placement="right" data-toggle="popover" data-container="body"
                    data-original-title="" title="Help"></i>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-5 control-label">Marital Status <span class="red">*</span></label>

                <div class="col-md-5">
                    <select class="form-control" name="MARITAL_STATUS" id="MARITAL_STATUS" >
                        <option value="">-Select-</option>
                        <?php foreach ($merital_status as $row): ?>
                            <option
                            value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="red"><?php echo form_error('MARITAL_STATUS'); ?></span>
                </div>
                <div class="col-md-2">
                    <i class="fa fa-info-circle pointer2"
                    data-content="Please select your merital status" data-placement="right"
                    data-toggle="popover" data-container="body" data-original-title=""
                    title="Help"></i>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-5 control-label">Nationality <span class="red">*</span></label>

                <div class="col-md-5">
                    <select class="form-control" name="NATIONALITY" id="NATIONALITY" >
                        <option value="">-Select-</option>
                        <?php foreach ($nationality as $row) { ?>
                        <option
                        value="<?php echo $row->id ?>" <?php echo ($row->id == 15) ? 'selected' : ''; ?>><?php echo $row->nationality ?></option>
                        <?php } ?>
                    </select>
                    <span class="red"><?php echo form_error('NATIONALITY'); ?></span>
                </div>
                <div class="col-md-2">
                    <i class="fa fa-info-circle pointer2" data-content="Select your nationality"
                    data-placement="right" data-toggle="popover" data-container="body"
                    data-original-title="" title="Help"></i>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-5 control-label">National ID</label>

                <div class="col-md-5">
                    <input type="text" name="NATIONAL_ID" id="NATIONAL_ID"
                    value="<?php echo isset( $applicant_summary['NATIONAL_ID']) ? $applicant_summary['NATIONAL_ID'] : set_value('NATIONAL_ID') ?>"
                    class="form-control" placeholder="National ID">
                    <span class="red"><?php echo form_error('NATIONAL_ID'); ?></span>
                </div>
                <div class="col-md-2">
                    <i class="fa fa-info-circle pointer2"
                    data-content="Please enter your natinal indentity number here"
                    data-placement="right" data-toggle="popover" data-container="body"
                    data-original-title="" title="Help"></i>
                </div>
            </div> 
            <div class="form-group">
                <label class="col-md-5 control-label">Birth Certificate</label>

                <div class="col-md-5">
                    <input type="text" name="BIRTH_CERTIFICATE" id="BIRTH_CERTIFICATE"
                    value="<?php echo isset( $applicant_summary['BIRTH_CERTIFICATE']) ? $applicant_summary['BIRTH_CERTIFICATE'] : set_value('BIRTH_CERTIFICATE') ?>"
                    class="form-control numbersOnly" placeholder="Birth Certificate">
                    <span class="red"><?php echo form_error('BIRTH_CERTIFICATE'); ?></span>
                </div>
                <div class="col-md-2">
                    <i class="fa fa-info-circle pointer2"
                    data-content="Please enter your birth certificate number here"
                    data-placement="right" data-toggle="popover" data-container="body"
                    data-original-title="" title="Help"></i>
                </div>
            </div>



            <div class="form-group">
                <label class="col-md-5 control-label">Religion <span class="red">*</span></label>
                <div class="col-md-5">
                    <select class="form-control" name="RELIGION_ID" id="RELIGION_ID" >
                        <option value="">-Select-</option>
                        <?php foreach ($religion as $row): ?>
                            <option
                            value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="red"><?php echo form_error('RELIGION'); ?></span>
                </div>
                <div class="col-md-2">
                    <i class="fa fa-info-circle pointer2" data-content="Select your religion"
                    data-placement="right" data-toggle="popover" data-container="body"
                    data-original-title="" title="Help"></i>
                </div>
            </div>                              
            <div class="form-group">
                <label class="col-md-5 control-label">Height</label>

                <div class="col-md-1" style="padding-right: 0;">
                    <input type="text" name="HEIGHT_FEET" id="HEIGHT_FEET" value="<?php echo isset( $applicant_summary['HEIGHT_FEET']) ? $applicant_summary['HEIGHT_FEET'] : set_value('HEIGHT_FEET') ?>" class="form-control numbersOnly" placeholder="e.g: 5.8">
                </div>
                <div class="col-md-1">
                    Ft.
                </div>
                <div class="col-md-1" style="padding-right: 0;">
                    <input type="text" name="HEIGHT_CM" id="HEIGHT_CM" value="<?php echo isset( $applicant_summary['HEIGHT_CM']) ? $applicant_summary['HEIGHT_CM'] : set_value('HEIGHT_CM') ?>"  class="form-control numbersOnly" placeholder="e.g: 176.78">
                </div>
                <div class="col-md-1">
                    Cm.
                </div>
                <div class="col-md-1">
                    <i class="fa fa-info-circle pointer2" data-content="Please input your hieght"
                    data-placement="right" data-toggle="popover" data-container="body"
                    data-original-title="" title="Help"></i>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-5 control-label">Weight</label>

                <div class="col-md-1" style="padding-right: 0;">
                    <input type="text" name="WEIGHT_KG" id="WEIGHT_KG" value="<?php echo isset( $applicant_summary['WEIGHT_KG']) ? $applicant_summary['WEIGHT_KG'] : set_value('WEIGHT_KG') ?>"
                    class="form-control numbersOnly" placeholder="Weight">
                </div>
                <div class="col-md-1">
                    Kg
                </div>
                <div class="col-md-2" style="padding-right: 0;">
                    <input type="text" name="WEIGHT_LBS" id="WEIGHT_LBS" value="<?php echo isset( $applicant_summary['WEIGHT_LBS']) ? $applicant_summary['WEIGHT_LBS'] : set_value('WEIGHT_LBS') ?>"
                    class="form-control numbersOnly" placeholder="Weight">
                </div>
                <div class="col-md-1">
                    Pound
                </div>
                <div class="col-md-1">
                    <i class="fa fa-info-circle pointer2" data-content="please input your weight"
                    data-placement="right" data-toggle="popover" data-container="body"
                    data-original-title="" title="Help"></i>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="" style="margin-right: 60px">
                <div class="form-group col-md-12">
                    <label class="control-label">Your Photo  <span class="red">*</span></label>
                </div>
                <div class="form-group col-md-12">
                    <div class="col-md-3">
                        <div class="avatar-zone">
                            <img id="img_id" src="<?php echo base_url('upload/default/default_pic.png'); ?>"
                            alt="select photo" style="width: 180px;
                            height: 160px;"/>
                        </div>
                        <div class="overlay-layer">Choose File</div>
                        <input type='file' style="cursor: pointer;" name="photo" id="propic" onchange="upload_img(this);" class="upload_btn"
                        >
                    </div>
                </div>

            </div>    
            <div class="" style="margin-right: 60px">
                <div class="form-group col-md-12">
                    <label class="control-label">Your Signature  <span class="red">*</span></label>
                </div>
                <div class="form-group col-md-12">
                    <div class="col-md-3">
                        <div class="avatar-zone-sig">
                            <img id="sig_id" src="<?php echo base_url('upload/default/default_sign.png'); ?>"
                            alt="select photo"  style="width: 180px;
                            height: 50px;"/>
                        </div>
                        <div class="overlay-layer-sig">Choose File</div>
                        <input type='file' style="cursor: pointer;" name="signature" id="sigpic" onchange="upload_img_sig(this);" class="upload_btn"
                        >
                    </div>
                </div>
              <!--   <div class="form-group col-md-12">
                    <b>Instruction:</b>
                    <br>
                    <span  class="text-info">
                        -> Your Photo, Signature Photo format must be .gif, .jpg, .jpeg or .png<br>
                        -> Size should not exceed 100 KB for Photo and 60 KB for Signature<br>
                        -> Dimension prefarable 300 X 300 px for Photo and 300 X 80 px for Signature
                    </span><br>
                    For image resize <a href="http://picresize.com/" target="_blank"
                    style="color:#18A689">Click Here</a>

                </div> -->
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <br><br>
    <h4 style="color:green">Family and Others Information</h4>

    <div class="div-background">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-5 control-label">Father's Name <span class="red">*</span></label>

                <div class="col-md-5">
                    <input type="text" name="FATHER_NAME" id="FATHER_NAME"
                    value="<?php echo isset( $applicant_summary['FATHER_NAME']) ? $applicant_summary['FATHER_NAME'] : set_value('FATHER_NAME') ?>" class="form-control"
                    placeholder="Father's Name" >
                    <span class="red"><?php echo form_error('FATHER_NAME'); ?></span>
                </div>
                <div class="col-md-2">
                    <i class="fa fa-info-circle pointer2"
                    data-content="Please enter your father's name here" data-placement="right"
                    data-toggle="popover" data-container="body" data-original-title=""
                    title="Help"></i>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-5 control-label">Father's Occupation</label>

                <div class="col-md-5">
                    <select class="form-control" name="FATHER_OCU" id="FATHER_OCU">
                        <option value="">-Select-</option>
                        <?php foreach ($occupation as $row) { ?>
                        <option
                        value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <i class="fa fa-info-circle pointer2"
                    data-content="Please enter your father occupation here" data-placement="right"
                    data-toggle="popover" data-container="body" data-original-title=""
                    title="Help"></i>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-5 control-label">Father's Mobile </label>

                <div class="col-md-5">
                    <input type="text" name="FATHER_PHN" id="FATHER_PHN" value="<?php echo isset( $applicant_summary['FATHER_PHN']) ? $applicant_summary['FATHER_PHN'] : set_value('FATHER_PHN') ?>"
                    class="form-control numbersOnly" placeholder="Ex: 017XXXXXXXX">
                </div>
                <div class="col-md-2">
                    <i class="fa fa-info-circle pointer2"
                    data-content="Please enter your father's  mobile no here" data-placement="right"
                    data-toggle="popover" data-container="body" data-original-title=""
                    title="Help"></i>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-5 control-label" >Father's Email </label>

                <div class="col-md-5">
                    <input type="text" name="FATHER_EMAIL" id="FATHER_EMAIL"
                    value="<?php echo isset( $applicant_summary['FATHER_EMAIL']) ? $applicant_summary['FATHER_EMAIL'] : set_value('FATHER_EMAIL') ?>"
                    class="form-control checkEmail" placeholder="Father's Email">
                    <span class="red father_email_validation"></span>
                </div>                                    
                <div class="col-md-2">
                    <i class="fa fa-info-circle pointer2"
                    data-content="Please enter your father's valid email address here"
                    data-placement="right" data-toggle="popover" data-container="body"
                    data-original-title="" title="Help"></i>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-5 control-label">Father's Work Adderss </label>

                <div class="col-md-5">
                    <textarea id="FATHER_WORK_ADRESS" class="form-control" rows="4"  name="FATHER_WORK_ADRESS"></textarea>
                </div>
                <div class="col-md-2">
                    <i class="fa fa-info-circle pointer2"
                    data-content="Enter your father work name and address" data-placement="right"
                    data-toggle="popover" data-container="body" data-original-title=""
                    title="Help"></i>
                </div>
            </div>

        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-5 control-label">Mother's Name <span class="red">*</span></label>

                <div class="col-md-5">
                    <input type="text" name="MOTHER_NAME" id="MOTHER_NAME"
                    value="<?php echo isset( $applicant_summary['MOTHER_NAME']) ? $applicant_summary['MOTHER_NAME'] : set_value('MOTHER_NAME') ?>" class="form-control"
                    placeholder="Mother's Name" >
                    <span class="red"><?php echo form_error('MOTHER_NAME'); ?></span>
                </div>
                <div class="col-md-2">
                    <i class="fa fa-info-circle pointer2"
                    data-content="Please enter your mother's name here" data-placement="right"
                    data-toggle="popover" data-container="body" data-original-title=""
                    title="Help"></i>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-5 control-label">Mother's Occupation</label>

                <div class="col-md-5">
                    <select class="form-control" name="MOTHER_OCU" id="MOTHER_OCU">
                        <option value="">-Select-</option>
                        <?php foreach ($occupation as $row) { ?>
                        <option
                        value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <i class="fa fa-info-circle pointer2"
                    data-content="Please enter your mother's occupation here" data-placement="right"
                    data-toggle="popover" data-container="body" data-original-title=""
                    title="Help"></i>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-5 control-label">Mother's Mobile</label>

                <div class="col-md-5">
                    <input type="text" name="MOTHER_PHN" id="MOTHER_PHN" value="<?php echo isset( $applicant_summary['MOTHER_PHN']) ? $applicant_summary['MOTHER_PHN'] : set_value('MOTHER_PHN') ?>"
                    class="form-control numbersOnly" placeholder="Ex: 017XXXXXXXX">
                </div>

                <div class="col-md-1">
                    <i class="fa fa-info-circle pointer2"
                    data-content="Please enter your mother's valid mobile no here"
                    data-placement="right" data-toggle="popover" data-container="body"
                    data-original-title="" title="Help"></i>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-5 control-label">Mother's Email </label>

                <div class="col-md-5">
                    <input type="text" name="MOTHER_EMAIL" id="MOTHER_EMAIL"
                    value="<?php echo isset( $applicant_summary['MOTHER_EMAIL']) ? $applicant_summary['MOTHER_EMAIL'] : set_value('MOTHER_EMAIL') ?>"
                    class="form-control checkEmail" placeholder="Mother's Email">
                    <span class="red mother_email_validation"></span>
                </div>

                <div class="col-md-1">
                    <i class="fa fa-info-circle pointer2"
                    data-content="Please enter your mother's valid email address here"
                    data-placement="right" data-toggle="popover" data-container="body"
                    data-original-title="" title="Help"></i>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-5 control-label">Mother's Work Adderss </label>

                <div class="col-md-5">
                    <textarea id="MOTHER_WORK_ADDRESS" class="form-control" rows="4" name="MOTHER_WORK_ADDRESS"></textarea>
                </div>
                <div class="col-md-2">
                    <i class="fa fa-info-circle pointer2"
                    data-content="Enter your mother work name and address" data-placement="right"
                    data-toggle="popover" data-container="body" data-original-title=""
                    title="Help"></i>
                </div>
            </div>

        </div>

        <div class="clearfix"></div>

        <div id="present_address" class="toggle-div1">
            <div  class="col-md-6">
                <div class="form-group">
                 <label class="col-md-4 control-label">Present Address <span class="red">*</span></label>
             </div>
             <div class="form-group">
                <label class="col-md-5 control-label">Division</label>

                <div class="col-md-5">
                    <select name="DIVISION_ID" id="DIVISION_ID" class="form-control" >
                        <option value="">-Select-</option>
                        <?php foreach ($division as $rd) { ?>
                        <option
                        value="<?php echo $rd->DIVISION_ID ?>"><?php echo $rd->DIVISION_ENAME ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <i class="fa fa-info-circle pointer2" data-content="Select division name"
                    data-placement="right" data-toggle="popover" data-container="body"
                    data-original-title="" title="Help"></i>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-5 control-label">District</label>

                <div class="col-md-5">
                    <select name="DISTRICT_ID" id="DISTRICT_ID" class="form-control" >
                        <option value="">-Select-</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <i class="fa fa-info-circle pointer2" data-content="Select district name"
                    data-placement="right" data-toggle="popover" data-container="body"
                    data-original-title="" title="Help"></i>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-5 control-label">Upazila/Thana</label>

                <div class="col-md-5">
                    <select name="THANA_ID" id="THANA_ID" class="form-control" >
                        <option value="">-Select-</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <i class="fa fa-info-circle pointer2" data-content="Select upazila or thana name"
                    data-placement="right" data-toggle="popover" data-container="body"
                    data-original-title="" title="Help"></i>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-5 control-label">Police Station</label>

                <div class="col-md-5">
                    <select name="POLICE_STATION_ID" id="POLICE_STATION_ID" class="form-control"
                    >
                    <option value="">-Select-</option>
                </select>
            </div>
            <div class="col-md-2">
                <i class="fa fa-info-circle pointer2" data-content="Select police station"
                data-placement="right" data-toggle="popover" data-container="body"
                data-original-title="" title="Help"></i>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-5 control-label">Union/Ward No.</label>

            <div class="col-md-5">
                <select name="UNION_ID" id="UNION_ID" class="form-control" >
                    <option value="">-Select-</option>
                </select>
            </div>
            <div class="col-md-2">
                <i class="fa fa-info-circle pointer2" data-content="Select ward or union"
                data-placement="right" data-toggle="popover" data-container="body"
                data-original-title="" title="Help"></i>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-5 control-label">Post office</label>

            <div class="col-md-5">
                <select name="POST_OFFICE_ID" id="POST_OFFICE_ID" class="form-control">
                    <option value="">-Select-</option>
                </select>
            </div>
            <div class="col-md-2">
                <i class="fa fa-info-circle pointer2" data-content="Select post office"
                data-placement="right" data-toggle="popover" data-container="body"
                data-original-title="" title="Help"></i>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-5 control-label">Vill/House no/Road no</label>

            <div class="col-md-5">
                <input type="text" name="VILLAGE" id="VILLAGE" value="" class="form-control"
                />
            </div>
            <div class="col-md-2">
                <i class="fa fa-info-circle pointer2"
                data-content="Enter your village,house or road no here" data-placement="right"
                data-toggle="popover" data-container="body" data-original-title=""
                title="Help"></i>
            </div>
        </div>
    </div>
    <div  class="col-md-6">
       <div class="form-group">
         <label class="col-md-4 control-label">Permanent Address : <span class="red">*</span></label>
         <div class="col-md-8">
             Same as present address?
             <input type="radio" name="same_as_present" class="same_as_present"
             value="YES" >&nbsp; Yes &nbsp;
             <input type="radio" name="same_as_present" class="same_as_present"
             value="NO" checked>&nbsp; No &nbsp;

         </div>
     </div>
     <div id="permanent_address">
         <div class="form-group">
            <label class="col-md-5 control-label">Division</label>

            <div class="col-md-5">
                <select name="P_DIVISION_ID" id="P_DIVISION_ID" class="form-control permanent_address_class">
                    <option value="">-Select-</option>
                    <?php foreach ($division as $rd) { ?>
                    <option
                    value="<?php echo $rd->DIVISION_ID ?>"><?php echo $rd->DIVISION_ENAME ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2">
                <i class="fa fa-info-circle pointer2" data-content="Select division name"
                data-placement="right" data-toggle="popover" data-container="body"
                data-original-title="" title="Help"></i>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-5 control-label">District</label>

            <div class="col-md-5">
                <select name="P_DISTRICT_ID" id="P_DISTRICT_ID" class="form-control permanent_address_class">
                    <option value="">-Select-</option>
                </select>
            </div>
            <div class="col-md-2">
                <i class="fa fa-info-circle pointer2" data-content="Select district name"
                data-placement="right" data-toggle="popover" data-container="body"
                data-original-title="" title="Help"></i>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-5 control-label">Upazila/Thana</label>

            <div class="col-md-5">
                <select name="P_THANA_ID" id="P_THANA_ID" class="form-control permanent_address_class">
                    <option value="">-Select-</option>
                </select>
            </div>
            <div class="col-md-2">
                <i class="fa fa-info-circle pointer2" data-content="Select upazila or thana name"
                data-placement="right" data-toggle="popover" data-container="body"
                data-original-title="" title="Help"></i>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-5 control-label">Police Station</label>

            <div class="col-md-5">
                <select name="P_POLICE_STATION_ID" id="P_POLICE_STATION_ID" class="form-control permanent_address_class">
                    <option value="">-Select-</option>
                </select>
            </div>
            <div class="col-md-2">
                <i class="fa fa-info-circle pointer2" data-content="Select police station"
                data-placement="right" data-toggle="popover" data-container="body"
                data-original-title="" title="Help"></i>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-5 control-label">Union/Ward No.</label>

            <div class="col-md-5">
                <select name="P_UNION_ID" id="P_UNION_ID" class="form-control permanent_address_class">
                    <option value="">-Select-</option>
                </select>
            </div>
            <div class="col-md-2">
                <i class="fa fa-info-circle pointer2" data-content="Select ward or union"
                data-placement="right" data-toggle="popover" data-container="body"
                data-original-title="" title="Help"></i>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-5 control-label">Post office</label>

            <div class="col-md-5">
                <select name="P_POST_OFFICE_ID" id="P_POST_OFFICE_ID" class="form-control permanent_address_class">
                    <option value="">-Select-</option>
                </select>
            </div>
            <div class="col-md-2">
                <i class="fa fa-info-circle pointer2" data-content="Select post office"
                data-placement="right" data-toggle="popover" data-container="body"
                data-original-title="" title="Help"></i>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-5 control-label">Vill/House no/Road no</label>

            <div class="col-md-5">
                <input type="text" name="P_VILLAGE" id="P_VILLAGE" value="" class="form-control "/>
            </div>
            <div class="col-md-2">
                <i class="fa fa-info-circle pointer2"
                data-content="Enter your village,house or road no here" data-placement="right"
                data-toggle="popover" data-container="body" data-original-title=""
                title="Help"></i>
            </div>
        </div>  
    </div>  
</div>
<div class="clearfix"></div>
</div>
<br>

<div class="form-group">
    <label class="col-md-3 control-label">Local Emergency Guardian </label>

    <div class="col-md-3">
        <input type="radio" name="local_emergency_guardian" class="local_emergency_guardian"
        value="F" checked>&nbsp; Father &nbsp;
        <input type="radio" name="local_emergency_guardian" class="local_emergency_guardian"
        value="M">&nbsp; Mother &nbsp;
        <input type="radio" name="local_emergency_guardian" class="local_emergency_guardian"
        value="O">&nbsp; Others
    </div>
    <div class="col-md-2">
        <i class="fa fa-info-circle pointer2" data-content="Select your local guardian here"
        data-placement="right" data-toggle="popover" data-container="body"
        data-original-title="" title="Help"></i>
    </div>
</div>
<div id="local_guardian" class="toggle-div">
    <div class="form-group">
        <label class="col-md-3 control-label">Local Guardian Name</label>

        <div class="col-md-3">
            <input type="text" name="LOCAL_GAR_NAME" id="LOCAL_GAR_NAME" value=""
            class="form-control" placeholder="Local Guardian Name">
        </div>
        <div class="col-md-3">
            <i class="fa fa-info-circle pointer2" data-content="Enter your Local Guardian Name"
            data-placement="right" data-toggle="popover" data-container="body"
            data-original-title="" title="Help"></i>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Local Guardian Relation</label>

        <div class="col-md-3">
            <select class="form-control " id="LOCAL_GAR_RELATION" name="LOCAL_GAR_RELATION"
            id="LOCAL_GAR_RELATION">
            <option value="">-Select-</option>
            <?php foreach ($relation as $row) { ?>
            <option
            value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-3">
        <i class="fa fa-info-circle pointer2"
        data-content="Select your Local Guardian relation" data-placement="right"
        data-toggle="popover" data-container="body" data-original-title=""
        title="Help"></i>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 control-label">Local Guardian Address </label>

    <div class="col-md-3">
        <textarea class="form-control " id="LOCAL_GAR_ADDRESS" 
        name="LOCAL_GAR_ADDRESS"><?php echo set_value('LOCAL_GAR_ADDRESS'); ?></textarea>

    </div>
    <div class="col-md-3">
        <i class="fa fa-info-circle pointer2"
        data-content="Enter your local guardian address here" data-placement="right"
        data-toggle="popover" data-container="body" data-original-title=""
        title="Help"></i>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 control-label">Local Guardian Mobile</label>

    <div class="col-md-3">
        <input type="text" name="LOCAL_GAR_PHN" id="LOCAL_GAR_PHN" value=""
        class="form-control  numbersOnly" placeholder="Mobile">
    </div>

    <div class="col-md-1">
        <i class="fa fa-info-circle pointer2"
        data-content="Please enter your Local Guardian  mobile no here"
        data-placement="right" data-toggle="popover" data-container="body"
        data-original-title="" title="Help"></i>
    </div>
</div>                    
</div>              

</div>
<br><br>
<h4 style="color: green">Academic Information</h4>

<div class="div-background">
    <div class="form-group">
        <div class="col-md-12">
            <table id="academic_list" class="table table-bordered dataTable">
                <thead>
                    <tr>
                        <th width="15%">Exam Name</th>
                        <th width="5%">Year</th>
                        <th width="10%">Board</th>
                        <th width="15%">Group</th>
                        <th width="5%">CGPA</th>
                        <th width="5%">GPA/CGPA With out additional</th>
                        <th width="45%">Institute Name</th>
                    </tr>
                </thead>
                <tbody> 
                    <tr>
                        <td>
                            <select name="EXAM_NAME[1]" class="form-control" id="EXAM_NAME_S">
                                <option value="">-Select-</option>
                                <?php foreach ($exam_name as $row) { ?>
                                <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                <?php } ?>
                            </select> 
                        </td>
                        <td>
                            <input style="width: 50px"  type="text" name="PASSING_YEAR[1]" id="PASSING_YEAR_S" class=" form-control " id="PASSING_YEAR" placeholder="Year" >
                        </td>
                        <td>
                            <select class="form-control " name="BOARD[1]"  id="BOARD_S" >
                                <option value="">-Select-</option>
                                <?php foreach ($board_name as $row) { ?>
                                <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                <?php } ?>
                            </select> 
                        </td>
                        <td>
                            <select class="form-control " name="GROUP[1]"  id="GROUP_S">
                                <option value="">-Select-</option>
                                <?php foreach ($group_name as $row) { ?>
                                <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td>
                           <input style="width: 50px" type="text" name="GPA[1]" id="GPA_S" class="form-control numbersOnly " placeholder="CGPA" >
                       </td>    
                       <td>
                           <input style="width: 50px" type="text" name="GPAWA[1]" id="GPAWA_S"  class="form-control numbersOnly " placeholder="CGPA" >
                       </td>
                       <td>
                        <input type="text" name="INSTITUTE[1]" class="form-control " id="INSTITUTE_S" placeholder="Institute Name" >

                    </td>  
                </tr>
                <tr>
                    <td>
                        <select class="form-control" name="EXAM_NAME[2]"  id="EXAM_NAME_H">
                            <option value="">-Select-</option>
                            <?php foreach ($exam_name as $row) { ?>
                            <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                            <?php } ?>
                        </select> 
                    </td>
                    <td>
                        <input style="width: 50px"  type="text" name="PASSING_YEAR[2]" id="PASSING_YEAR_H" class="form-control  " id="PASSING_YEAR" placeholder="Year" >
                    </td>
                    <td>
                        <select class="form-control " name="BOARD[2]"  id="BOARD_H" >
                            <option value="">-Select-</option>
                            <?php foreach ($board_name as $row) { ?>
                            <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                            <?php } ?>
                        </select> 
                    </td>
                    <td>
                        <select class="form-control " name="GROUP[2]"  id="GROUP_H">
                            <option value="">-Select-</option>
                            <?php foreach ($group_name as $row) { ?>
                            <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td>
                       <input style="width: 50px" type="text" name="GPA[2]" id="GPA_H" class="form-control  " placeholder="CGPA" >
                   </td>    
                   <td>
                       <input style="width: 50px" type="text" name="GPAWA[2]" id="GPAWA_H"  class="form-control  " placeholder="CGPA" >
                   </td>
                   <td>
                    <input type="text" name="INSTITUTE[2]" class="form-control " id="INSTITUTE_H" placeholder="Institute Name" >
                </td> 
            </tr>
            <?php //if($applicant_user[0]->DEGREE_ID !=3): ?>
           
            <tr id="posgraduate_div">
                <td>
                    <select class="form-control" name="EXAM_NAME[3]"   id="EXAM_NAME_G">
                        <option value="">-Select-</option>
                        <?php foreach ($exam_name as $row) { ?>
                        <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                        <?php } ?>
                    </select> 
                </td>
                <td>
                    <input style="width: 50px"  type="text" name="PASSING_YEAR[3]" id="PASSING_YEAR_G" class=" form-control numbersOnly " id="PASSING_YEAR" placeholder="Year" >
                </td>
                <td>
                    <select class="form-control " name="BOARD[3]"  id="BOARD_G" >
                        <option value="">-Select-</option>
                        <?php foreach ($board_name as $row) { ?>
                        <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                        <?php } ?>
                    </select> 
                </td>
                <td>
                    <select class="form-control " name="GROUP[3]"  id="GROUP_G">
                        <option value="">-Select-</option>
                        <?php foreach ($group_name as $row) { ?>
                        <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td>
                   <input style="width: 50px" type="text" name="GPA[3]" id="GPA_G" class="form-control numbersOnly " placeholder="CGPA" >
               </td>    
               <td>
                   <input style="width: 50px" type="text" name="GPAWA[3]" id="GPAWA_G"  class="form-control numbersOnly " placeholder="CGPA" >
               </td>
               <td>
                <input type="text" name="INSTITUTE[3]" class="form-control " id="INSTITUTE_G" placeholder="Institute Name" >
            </td> 
        </tr>
        <?php //endif; ?>
        



    </tbody>
</table>
</div>
</div>
</div>
<br><br> 

<h4 style="color:green">Others Information</h4>

<div class="div-background"  >

    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label">1. Annual Income of Parent/Parents or guardian <span class="red">*</span></label>
        </div>    
        <div class="col-md-4"> 
            <input type="text" name="ANNUAL_INCOME" id="ANNUAL_INCOME"  class="form-control"> 
            <span class="red"><?php echo form_error(''); ?></span>
        </div>
        <div class="col-md-2">BDT. 
            <i class="fa fa-info-circle pointer2" data-content="Please enter annual income in Bangladeshi taka."
            data-placement="right" data-toggle="popover" data-container="body"
            data-original-title="" title="Help"></i>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group"> 
            <div class="col-md-5">
                <label>2. Scholarships receive in the past ?</label>
            </div>
            <div class="col-md-1">
                <input id="scholarship_id" class="SCHOLARSHIP" name="SCHOLARSHIP" value="YES" type="radio">&nbsp; Yes
            </div>
            <div class="col-md-1">
                <input id="scholarship_id" class="SCHOLARSHIP" name="SCHOLARSHIP" value="NO" type="radio" checked>&nbsp; No
            </div> 

        </div>
        <div class="form-group"> 
            <div class="col-md-4 scholarships" style="display:none;">
                <input id="SCHOLARSHIP_DESC" name="SCHOLARSHIP_DESC" type="text" class="form-control"
                placeholder="">
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-5">
                <label>3. Were you expelled from any institution before ?</label>
            </div>
            <div class="col-md-1">
                <input id="expelled_id" class="EXPELLED" name="EXPELLED" value="YES" type="radio">&nbsp; Yes
            </div>
            <div class="col-md-1">
                <input id="expelled_id" class="EXPELLED" name="EXPELLED" value="NO" type="radio" checked>&nbsp; No
            </div>

        </div>    
        <div class="form-group expelled_div" style="display: none">
            <div class="col-md-6">
             <textarea id="EXPELLED_DESC" name="EXPELLED_DESC" rows="6" type="text" class="form-control"
             placeholder=""></textarea>                         
         </div>
     </div>
 </div>
 <div class="col-md-12">
    <div class="form-group">
        <div class="col-md-5">
            <label>4. Were you ever arrested by law enforcement agency ?</label>
        </div>
        <div class="col-md-1">
            <input id="arrested_id" class="ARRESTED" name="ARRESTED" value="YES" type="radio">&nbsp; Yes
        </div>
        <div class="col-md-1">
            <input id="arrested_id" class="ARRESTED" name="ARRESTED" value="NO" type="radio" checked>&nbsp; No
        </div>

    </div>
    <div class="form-group arrested_div" style="display:none;">
        <div class="col-md-6" >
            <textarea id="ARRESTED_DESC" name="ARRESTED_DESC" rows="6"  class="form-control"
            placeholder=""></textarea>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-5">
                <label>5. Were you ever convicted by any court in Bangladesh of any other country ?</label>
            </div>
            <div class="col-md-1">
                <input id="convicted_id" class="CONVICTED" name="CONVICTED" value="YES" type="radio">&nbsp; Yes
            </div>
            <div class="col-md-1">
                <input id="convicted_id" class="CONVICTED" name="CONVICTED" value="NO" type="radio" checked>&nbsp; No
            </div>

        </div>        
        <div class="form-group convicted_div" style="display:none;">
            <div class="col-md-6" >
                <textarea id="CONVICTED_DESC" name="CONVICTED_DESC" rows="6" class="form-control"></textarea>
            </div>

        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-5">
                <label>6. Did you apply Khwaja Yunus Ali University Before ?</label>
            </div>
            <div class="col-md-1">
                <input id="apply_before_id" class="APPLY_BEFORE" name="APPLY_BEFORE" value="YES" type="radio">&nbsp; Yes
            </div>
            <div class="col-md-1">
                <input id="apply_before_id" class="APPLY_BEFORE" name="APPLY_BEFORE" value="NO" type="radio" checked>&nbsp; No
            </div>

        </div>      
        <div class="form-group apply_before_div" style="display:none;">
           <div class="col-md-2" >
            <input id="APPLY_SEMESTER" name="APPLY_SEMESTER" type="text" class="form-control"
            placeholder="Semester">
        </div>
        <div class="col-md-2" >
            <input id="APPLY_YEAR" name="APPLY_YEAR" type="text" class="form-control"
            placeholder="Year">
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <div class="col-md-5">
            <label>7. Do you have any siblings currently enrolled at KYAU ?</label>
        </div>
        <div class="col-md-1">
            <input id="siblin" class="SIBLING_EXIST" name="SIBLING_EXIST" value="YES" type="radio">&nbsp; Yes
        </div>
        <div class="col-md-1">
            <input id="siblin" class="SIBLING_EXIST" name="SIBLING_EXIST" value="NO" type="radio" checked>&nbsp; No
        </div>

    </div>
    <div class="form-group">
        <div class="col-md-4 sibId" style="display:none;">
            <input id="SBLN_ROLL_NO" name="SBLN_ROLL_NO" type="text" class="form-control"
            placeholder="ID Number of your Sibling">
        </div>
    </div>
</div>

</div> 
<div class="clearfix"></div>
</div> 
<br><br> 
<div class="form-group">
    <div class="col-sm-3  pull-right">

     <a href="#" class="btn btn-default" id="admission_form_btn">Next</a> 
     <!-- <input type="submit" class="btn btn-white" value="submit"> -->
     <input type="reset" class="btn btn-white" value="Reset">
 </div>
</div>
<!-- Modal -->
<div id="admissionModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>My Profile</h3>
            </div>
            <div class="modal-body">
                <?php $this->load->view('admin/admission/admission_form_preview'); ?>
            </div>
            <div class="modal-footer"> 
                <a href="#" class="btn" data-dismiss="modal">Back</a>
                <input type="submit" class="btn btn-primary" id="admission_form_submit" value="Submit">
            </div>
        </div>
    </div>
</div>
<!-- test -->

</div>

</div>
</form>
</div>

</div>
 <script src="<?php echo base_url(); ?>assets/js/plugins/jasny/jasny-bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/keyboard/keyboard.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
<script>
    $.validator.addMethod("isNIDValid", function(value) {
        var NidValid = false;
        var UserNID = value;
        if (UserNID.length == 0 || UserNID.length == 13 || UserNID.length == 17)
        {
            NidValid = true;
        }
        return NidValid;
    }, 'National ID Not Valid');
    $.validator.addMethod("isMoblieValid", function(value) {
        var MobileValid = false;
        var UserMobile = value;
        if (UserMobile.length == 0 || UserMobile.length == 11)
        {
            MobileValid = true;
        }
        return MobileValid;
    }, 'Mobile number not valid');

    $.validator.addMethod('filesize', function (value, element, param) {

        return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than {0}');


    $("#admission_form").validate({
        rules: {

           DEGREE_ID: {required:true},
           PROGRAM_ID: {required:true},
           FULL_NAME: {required:true},
           EMAIL: {required:true,email: true},
           MOBILE_NO: {required:true},
           DATE_OF_BIRTH: {required:true},
           FULL_NAME_BN: {required:true},
           NATIONALITY: {required:true},
           photo: {required: true, filesize: 102400},
           signature: {required:true},
           RELIGION_ID: {required:true},
           MARITAL_STATUS: {required:true},
           FATHER_NAME: {required:true},
           MOTHER_NAME: {required:true},
           FATHER_EMAIL: {email: true},
           MOTHER_EMAIL: {email: true},
           PLACE_OF_BIRTH: {required:true},
           NATIONAL_ID: {number:true, isNIDValid:true},
           BIRTH_CERTIFICATE: {number:true},
           HEIGHT_FEET: {number:true},
           WEIGHT_KG: {number:true},              
           FATHER_PHN: {number:true,isMoblieValid:true},
           MOTHER_PHN: {number:true,isMoblieValid:true},
           LOCAL_GAR_PHN: {number:true,isMoblieValid:true},
           MARITAL_STATUS: {required:true},
           ANNUAL_INCOME: {number:true,required:true},
           DIVISION_ID: {required:true},
           DISTRICT_ID: {required:true},
           THANA_ID: {required:true},
           POLICE_STATION_ID: {required:true},
           UNION_ID: {required:true},
           VILLAGE: {required:true},       
           P_DIVISION_ID: {required:true},
           P_DISTRICT_ID: {required:true},
           P_THANA_ID: {required:true},
           P_POLICE_STATION_ID: {required:true},
           P_UNION_ID: {required:true},
           P_VILLAGE: {required:true},
           SCHOLARSHIP_DESC: {required:true},
           EXPELLED_DESC: {required:true},
           ARRESTED_DESC: {required:true},
           CONVICTED_DESC: {required:true},
           APPLY_SEMESTER: {required:true},
           APPLY_YEAR: {number:true,required:true},
           SBLN_ROLL_NO: {number:true,required:true},
           'EXAM_NAME[1]': {required:true},
           'PASSING_YEAR[1]': {number:true,required:true,maxlength: 4,minlength: 4},
           'BOARD[1]': {required:true},
           'GROUP[1]': {required:true},
           'GPA[1]': {number:true,required:true},
           'GPAWA[1]': {number:true,required:true},
           'INSTITUTE[1]': {required:true},

           'EXAM_NAME[2]': {required:true},
           'PASSING_YEAR[2]': {number:true,required:true,maxlength: 4,minlength: 4},
           'BOARD[2]': {required:true},
           'GROUP[2]': {required:true},
           'GPA[2]': {number:true,required:true},
           'GPAWA[2]': {number:true,required:true},
           'INSTITUTE[2]': {required:true},

           'EXAM_NAME[3]': {required:true},
           'PASSING_YEAR[3]': {number:true,required:true,maxlength: 4,minlength: 4},
           'BOARD[3]': {required:true},
           'GROUP[3]': {required:true},
           'GPA[3]': {number:true,required:true},
           'GPAWA[3]': {number:true,required:true},
           'INSTITUTE[3]': {required:true},




       },
       messages: {  
           FULL_NAME_BN: "Bangla name required",
           photo: "Photo required",
           signature: "Signature required",
           NATIONALITY: "Nationality required",
           RELIGION_ID: "Religion required",
           MARITAL_STATUS: "Marital status required",
           FATHER_NAME: "Father name required",
           MOTHER_NAME: "Mother name required",      
           PLACE_OF_BIRTH: "Place of birth field is required",
           NATIONAL_ID: "Required valid national ID",
           BIRTH_CERTIFICATE: "Required valid birth certificate no",
           MARITAL_STATUS: "Marital status required",
           HEIGHT_FEET: "Number only",
           WEIGHT_KG: "Number only",
       }
   });

    /*    $("#admission_form").validate({debug: true});
    $("#admission_form").valid();*/

    $('#admission_form_submit').on('click', function (e) {
        $("#admission_form").submit();
        $('#admissionModal').modal('hide');
    });

    $('#admission_form_btn').on('click',function(){

      if($("#admission_form").valid()) {
            //personal information 
            $("#datepicker").hide();         
            $("#P_FULL_NAME").text($("#FULL_NAME").val());             
            $("#P_MOBILE_NO").text($("#MOBILE_NO").val());             
            $("#P_EMAIL").text($("#EMAIL").val());             
            $("#P_DATE_OF_BIRTH").text($("#datepicker").val());             
            $("#P_FULL_NAME_BN").text($("#FULL_NAME_BN").val());
            $("#P_PLACE_OF_BIRTH").text($("#PLACE_OF_BIRTH").val());
            //$("#P_GENDER").text($('input[name=GENDER]:checked').val());
            $("#P_GENDER").text($("input[name=GENDER]:checked").attr("data-value"));
            var blood_group = $("#BLOOD_GRP option:selected").text() == "-Select-" ? '' : $("#BLOOD_GRP option:selected").text();
            $("#P_BLOOD_GROUP").text(blood_group);          
              var program_id = $("#PROGRAM_ID option:selected").text() == "-Select-" ? '' : $("#PROGRAM_ID option:selected").text();
            $("#P_PROGRAM_ID").text(program_id);
            var marital_status = $("#MARITAL_STATUS option:selected").text() == "-Select-" ? '' : $("#MARITAL_STATUS option:selected").text();
            $("#P_MARITAL_STATUS").text(marital_status);
            var religion = $("#RELIGION_ID option:selected").text() == "-Select-" ? '' : $("#RELIGION_ID option:selected").text();
            $("#P_RELIGION_ID").text(religion);
            $("#P_BIRTH_CERTIFICATE").text($("#BIRTH_CERTIFICATE").val());
            $("#P_NATIONAL_ID").text($("#NATIONAL_ID").val());
            $("#P_HEIGHT_FEET").text($("#HEIGHT_FEET").val());
            $("#P_HEIGHT_CM").text($("#HEIGHT_CM").val());
            $("#P_WEIGHT_KG").text($("#WEIGHT_KG").val());
            $("#P_WEIGHT_LBS").text($("#WEIGHT_LBS").val());


           //parents information
           $("#P_MOTHER_NAME").text($("#MOTHER_NAME").val());
           $("#P_MOTHER_PHN").text($("#MOTHER_PHN").val());
           $("#P_MOTHER_EMAIL").text($("#MOTHER_EMAIL").val());
           $("#P_MOTHER_WORK_ADDRESS").text($("#MOTHER_WORK_ADDRESS").val());
           var mother_ocu = $("#MOTHER_OCU option:selected").text() == "-Select-" ? '' : $("#MOTHER_OCU option:selected").text();
           $("#P_MOTHER_OCU").text(mother_ocu);

           $("#P_FATHER_NAME").text($("#FATHER_NAME").val());
           $("#P_FATHER_PHN").text($("#FATHER_PHN").val());
           $("#P_FATHER_EMAIL").text($("#FATHER_EMAIL").val());
           $("#P_FATHER_WORK_ADRESS").text($("#FATHER_WORK_ADRESS").val());
           var father_ocu = $("#FATHER_OCU option:selected").text() == "-Select-" ? '' : $("#FATHER_OCU option:selected").text();
           $("#P_FATHER_OCU").text(father_ocu);

           //local guardian
           var local_emergency_guardian=$('input[name=local_emergency_guardian]:checked', '#admission_form').val();
          // alert(local_emergency_guardian);
          if($("#DEGREE_ID").val() == 4){
            $("#preview_post_graduate_tr").show();
            
            }else{
            $("#preview_post_graduate_tr").hide();    
            }         
         if(local_emergency_guardian == 'F'){
            $("#local_guardian_div").show();
            $("#local_guardian_val").html("Father");
            $("#others_gurdian_info").hide();
        }

        if(local_emergency_guardian == 'M'){
            $("#local_guardian_div").show();
            $("#local_guardian_val").html(" Mother");
            $("#others_gurdian_info").hide();
        }

        if(local_emergency_guardian == 'O'){
            $("#others_gurdian_info").show();
            $("#local_guardian_div").hide();
            
            
            $("#P_LOCAL_GAR_NAME").text($("#LOCAL_GAR_NAME").val());
            $("#P_LOCAL_GAR_ADDRESS").text($("#LOCAL_GAR_ADDRESS").val());
            $("#P_LOCAL_GAR_PHN").text($("#LOCAL_GAR_PHN").val());
            $("#P_LOCAL_GAR_RELATION").text($("#LOCAL_GAR_RELATION option:selected").text());
        }

           //present address
           $("#Pr_DIVISION_ID").text($("#DIVISION_ID option:selected").text());
           $("#Pr_DISTRICT_ID").text($("#DISTRICT_ID option:selected").text());
           $("#Pr_POLICE_STATION_ID").text($("#POLICE_STATION_ID option:selected").text());
           $("#Pr_POST_OFFICE_ID").text($("#POST_OFFICE_ID option:selected").text());
           $("#Pr_THANA_ID").text($("#THANA_ID option:selected").text());
           $("#Pr_UNION_ID").text($("#UNION_ID option:selected").text());
           $("#Pr_VILLAGE_WARD").text($("#VILLAGE").val());
           
           var same_as_present=$('input[name=same_as_present]:checked', '#admission_form').val()

           if(same_as_present =='NO'){
               //permanent address
               $("#Pr_P_DIVISION_ID").text($("#P_DIVISION_ID option:selected").text());
               $("#Pr_P_DISTRICT_ID").text($("#P_DISTRICT_ID option:selected").text());
               $("#Pr_P_POLICE_STATION_ID").text($("#P_POLICE_STATION_ID option:selected").text());
               $("#Pr_P_POST_OFFICE_ID").text($("#P_POST_OFFICE_ID option:selected").text());
               $("#Pr_P_THANA_ID").text($("#P_THANA_ID option:selected").text());
               $("#Pr_P_UNION_ID").text($("#P_UNION_ID option:selected").text());
               $("#Pr_P_VILLAGE_WARD").text($("#P_VILLAGE").val());
           }else{
            $("#Pr_P_DIVISION_ID").text($("#DIVISION_ID option:selected").text());
            $("#Pr_P_DISTRICT_ID").text($("#DISTRICT_ID option:selected").text());
            $("#Pr_P_POLICE_STATION_ID").text($("#POLICE_STATION_ID option:selected").text());
            $("#Pr_P_POST_OFFICE_ID").text($("#POST_OFFICE_ID option:selected").text());
            $("#Pr_P_THANA_ID").text($("#THANA_ID option:selected").text());
            $("#Pr_P_UNION_ID").text($("#UNION_ID option:selected").text());
            $("#Pr_P_VILLAGE_WARD").text($("#VILLAGE").val());
        }


           //academic information 
           $("#P_EXAM_NAME_S").text($("#EXAM_NAME_S option:selected").text());
           $("#P_PASSING_YEAR_S").text($("#PASSING_YEAR_S").val());
           $("#P_BOARD_S").text($("#BOARD_S option:selected").text());
           $("#P_GROUP_S").text($("#GROUP_S option:selected").text());
           $("#P_GPA_S").text($("#GPA_S").val());
           $("#P_GPAWA_S").text($("#GPAWA_S").val());
           $("#P_INSTITUTE_S").text($("#INSTITUTE_S").val());

           $("#P_EXAM_NAME_H").text($("#EXAM_NAME_H option:selected").text());
           $("#P_PASSING_YEAR_H").text($("#PASSING_YEAR_H").val());
           $("#P_BOARD_H").text($("#BOARD_H option:selected").text());
           $("#P_GROUP_H").text($("#GROUP_H option:selected").text());
           $("#P_GPA_H").text($("#GPA_H").val());
           $("#P_GPAWA_H").text($("#GPAWA_H").val());
           $("#P_INSTITUTE_H").text($("#INSTITUTE_H").val());

           $("#P_EXAM_NAME_G").text($("#EXAM_NAME_G option:selected").text());
           $("#P_PASSING_YEAR_G").text($("#PASSING_YEAR_G").val());
           $("#P_BOARD_G").text($("#BOARD_G option:selected").text());
           $("#P_GROUP_G").text($("#GROUP_G option:selected").text());
           $("#P_GPA_G").text($("#GPA_G").val());
           $("#P_GPAWA_G").text($("#GPAWA_G").val());
           $("#P_INSTITUTE_G").text($("#INSTITUTE_G").val());

            //others information
            $("#P_ANNUAL_INCOME").text($("#ANNUAL_INCOME").val());
            $("#P_SCHOLARSHIP").text($("input[name='SCHOLARSHIP']:checked").val());
            $("#P_SCHOLARSHIP_DESC").text($("#SCHOLARSHIP_DESC").val());
            $("#P_EXPELLED").text($("input[name='EXPELLED']:checked").val());
            $("#P_EXPELLED_DESC").text($("#EXPELLED_DESC").val());
            $("#P_ARRESTED").text($("input[name='ARRESTED']:checked").val());
            $("#P_ARRESTED_DESC").text($("#ARRESTED_DESC").val());
            $("#P_CONVICTED").text($("input[name='CONVICTED']:checked").val());
            $("#P_CONVICTED_DESC").text($("#CONVICTED_DESC").val());
            $("#P_APPLY_BEFORE").text($("input[name='APPLY_BEFORE']:checked").val());
            $("#P_APPLY_SEMESTER").text($("#APPLY_SEMESTER").val());
            $("#P_APPLY_YEAR").text($("#APPLY_YEAR").val());
            $("#P_SIBLING_EXIST").text($("input[name='SIBLING_EXIST']:checked").val());
            $("#P_SBLN_ROLL_NO").text($("#SBLN_ROLL_NO").val());

            $('#admissionModal').modal({
                show: true
            });

        }else{

        }
    });

    //This function  is use for student image preview before upload
    function upload_img(input) {
        var fileTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (input.files && input.files[0]) {
        var extension = input.files[0].name.split('.').pop().toLowerCase(),  //file extension from input file
        isSuccess = fileTypes.indexOf(extension) > -1;
        var fsize = $('#propic')[0].files[0].size;
        if (isSuccess) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var image = new Image();
                image.src = reader.result;

                image.onload = function () {
                     
                        $('#img_id').attr('src', e.target.result);
                        $('#p_img_id').attr('src', e.target.result);

                   
                };
            }
            reader.readAsDataURL(input.files[0]);
        }else{
            alert("This file type does not support");
        }
    }
}     
    //This function  is use for student image preview before upload
    function upload_img_sig(input) {
        var fileTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (input.files && input.files[0]) {
            var extension = input.files[0].name.split('.').pop().toLowerCase(),  //file extension from input file
            isSuccess = fileTypes.indexOf(extension) > -1;
            var fsize = $('#sigpic')[0].files[0].size;
            if (isSuccess) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var image = new Image();
                    image.src = reader.result;

                    image.onload = function () {
                         
                            $('#sig_id').attr('src', e.target.result);
                            $('#p_sig_id').attr('src', e.target.result);
                         
                    };
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                alert("This file type does not support");
            }
        }
    }

    $(document).on("click", ".same_as_present", function () {
      var same_as_present = $('input[name=same_as_present]:checked').val();

      if(same_as_present == 'YES'){
        $('#permanent_address').find('input, textarea, button, select').attr('disabled',true);
        $('#permanent_address').find('select').val('');
        $('#permanent_address').find('input').val('');
    }else{
        $('#permanent_address').find('input, textarea, button, select').attr('disabled',false);
    }

});
    $(document).on("change", "#DIVISION_ID", function () {
        $("#THANA_ID").val("");
        $("#POLICE_STATION_ID").val("");
        $("#POST_OFFICE_ID").val("");
        $("#UNION_ID").val("");
        var DIVISION_ID = $(this).val();

        $.ajax({
            type: 'POST',
            url: '<?php echo site_url()?>/common/dis_by_div_id',
            data: {DIVISION_ID: DIVISION_ID},
            success: function (data) {
                $("#DISTRICT_ID").html(data)
            }
        });
    });    
    $(document).on("change", "#DEGREE_ID", function () {

        var DEGREE_ID = $(this).val();

        $.ajax({
            type: 'POST',
            url: '<?php echo site_url()?>/common/program_by_degree_id',
            data: {DEGREE_ID: DEGREE_ID},
            success: function (data) {
                $("#PROGRAM_ID").html(data);
                if(DEGREE_ID == 3 || DEGREE_ID == 5){
                    $("#posgraduate_div").toggle();    
                }else{
                    $("#posgraduate_div").show();
                }
                
            }
        });
    });
    $(document).on("change", "#DISTRICT_ID", function () {
        $("#THANA_ID").val("");
        $("#POLICE_STATION_ID").val("");
        $("#POST_OFFICE_ID").val("");
        $("#UNION_ID").val("");
        var DISTRICT_ID = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url()?>/common/up_thana_by_dis_id',
            data: {DISTRICT_ID: DISTRICT_ID},
            success: function (data) {
                $("#THANA_ID").html(data)
            }
        });

    });
    $(document).on("change", "#THANA_ID", function () {
        var THANA_ID = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url()?>/common/union_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#UNION_ID").html(data)
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url()?>/common/police_station_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#POLICE_STATION_ID").html(data)
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url()?>/common/post_office_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#POST_OFFICE_ID").html(data)
            }
        });
    });
    $(document).on("change", "#P_DIVISION_ID", function () {
        $("#P_THANA_ID").val("");
        $("#P_POLICE_STATION_ID").val("");
        $("#P_POST_OFFICE_ID").val("");
        $("#P_UNION_ID").val("");
        var DIVISION_ID = $(this).val();

        $.ajax({
            type: 'POST',
            url: '<?php echo site_url()?>/common/dis_by_div_id',
            data: {DIVISION_ID: DIVISION_ID},
            success: function (data) {
                $("#P_DISTRICT_ID").html(data)
            }
        });
    });
    $(document).on("change", "#P_DISTRICT_ID", function () {
        $("#P_THANA_ID").val("");
        $("#P_POLICE_STATION_ID").val("");
        $("#P_POST_OFFICE_ID").val("");
        $("#P_UNION_ID").val("");
        var DISTRICT_ID = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url()?>/common/up_thana_by_dis_id',
            data: {DISTRICT_ID: DISTRICT_ID},
            success: function (data) {
                $("#P_THANA_ID").html(data)
            }
        });

    });
    $(document).on("change", "#P_THANA_ID", function () {
        var THANA_ID = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url()?>/common/union_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#P_UNION_ID").html(data)
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url()?>/common/police_station_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#P_POLICE_STATION_ID").html(data)
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url()?>/common/post_office_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#P_POST_OFFICE_ID").html(data)
            }
        });
    });
    $(document).on("click", ".local_emergency_guardian", function () {
        var is_local = $(this).val();
        if (is_local == 'O') {
            $('#local_guardian').show();
            $('#finance_guardian').show();
        } else {
            $('#local_guardian').hide();
            $('#finance_guardian').hide();
        }
    }); 
    $(document).on('click', '#siblin', function () {
        if ($('input[name="SIBLING_EXIST"]:checked').val() == "YES") {
            $('.sibId').show();
        } else {
            $('.sibId').hide();
        }
    });
    $(document).on('click', '#scholarship_id', function () {
        if ($('input[name="SCHOLARSHIP"]:checked').val() == "YES") {
            $('.scholarships').show();
        } else {
            $('.scholarships').hide();
        }
    });
    $(document).on('click', '#expelled_id', function () {
        if ($('input[name="EXPELLED"]:checked').val() == "YES") {
            $('.expelled_div').show();
        } else {
            $('.expelled_div').hide();
        }
    });
    $(document).on('click', '#arrested_id', function () {
        if ($('input[name="ARRESTED"]:checked').val() == "YES") {
            $('.arrested_div').show();
        } else {
            $('.arrested_div').hide();
        }
    });
    $(document).on('click', '#convicted_id', function () {
        if ($('input[name="CONVICTED"]:checked').val() == "YES") {
            $('.convicted_div').show();
        } else {
            $('.convicted_div').hide();
        }
    });
    $(document).on('click', '#apply_before_id', function () {
        if ($('input[name="APPLY_BEFORE"]:checked').val() == "YES") {
            $('.apply_before_div').show();
        } else {
            $('.apply_before_div').hide();
        }
    });

    $('#WEIGHT_KG').on('blur', function () {
        var pound = parseFloat("2.20462");
        var total = ($(this).val() * pound);
        var n = total.toFixed(2);
        $("#WEIGHT_LBS").val(n);

    });
    $('#WEIGHT_LBS').on('blur', function () {
        var kg = parseFloat("0.453592");
        var total = ($(this).val() * kg);
        var n = total.toFixed(2);
        $("#WEIGHT_KG").val(n)
    });
    $('#HEIGHT_FEET').on('blur', function () {
        var cm = parseFloat("30.48");
        var total = ($(this).val() * cm);
        var n = total.toFixed(2);
        $("#HEIGHT_CM").val(n);

    });
    $('#HEIGHT_CM').on('blur', function () {
        var ft = parseFloat("0.0328084");
        var total = ($(this).val() * ft);
        var n = total.toFixed(2);
        $("#HEIGHT_FEET").val(n)
    });
     $( "#date_of_birth_datepicker" ).datepicker({                
                changeMonth: true, 
                changeYear: true, 
                dateFormat: 'dd-mm-yy', 
                defaultDate: '',
                yearRange: "-100:+0",

         }).attr('readonly', 'readonly');


</script>
