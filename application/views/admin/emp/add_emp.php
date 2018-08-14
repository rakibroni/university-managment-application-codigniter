 
<link href="<?php echo base_url(); ?>assets/keyboard/keyboard.css" rel="stylesheet">

<link href="<?php echo base_url(); ?>assets/css/plugins/steps/jquery.steps.css" rel="stylesheet">

<style type="text/css">

  .wizard > .content > .body {
    position: relative;
    width: 100% !important;
  }
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

<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>Add Employee</h5>

  </div>
  <div class="ibox-content">

   <form id="emp_form" class="form-horizontal" action="" method="post"  enctype="multipart/form-data">
    <?php
    $applicant_summary=$this->session->userdata('applicant_summary');
    $app_academic_sess_array=$this->session->userdata('app_academic_sess_array');

    ?>
    <div id="example-basic">
      <h3>Personal Info</h3>
      <section>
       <div class="">
        <div class="">
          <strong>NOTE : </strong> All <span class="red">*</span> field are required.
          <h4 style="color:green">Personal Information</h4>

          <div class="">
            <div class="col-md-7">

              <div class="form-group">
                <label  for="FULL_NAME" class="col-md-5 control-label">Full Name <span class="red">*</span></label>

                <div class="col-md-5">
                  <input type="text" name="FULL_NAME" id="FULL_NAME"
                  value="<?php  set_value('FULL_NAME') ?>"
                  class="form-control " placeholder="Full Name" >
                  <span class="red"><?php echo form_error('FULL_NAME'); ?></span>
                </div>
                <div class="col-md-2">
                  <i class="fa fa-info-circle pointer2" data-content=" "
                  data-placement="right" data-toggle="popover" data-container="body"
                  data-original-title="" title="Help"></i>
                </div>
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
                <label for="FATHER_NAME" class="col-md-5 control-label">Father Name <span class="red">*</span></label>

                <div class="col-md-5">
                  <input type="text" name="FATHER_NAME" id="FATHER_NAME"
                  class="form-control"  value="<?php  set_value('FATHER_NAME') ?>"
                  placeholder="Father name">


                  <span class="red"><?php echo form_error('FATHER_NAME'); ?></span>
                </div>
                <div class="col-md-2">
                  <i class="fa fa-info-circle pointer2"
                  data-content="Enter the name of place where are you born" data-placement="right"
                  data-toggle="popover" data-container="body" data-original-title=""
                  title="Help"></i>
                </div>
              </div>
              <div class="form-group">
                <label for="MOTHER_NAME" class="col-md-5 control-label">Mother Name <span class="red">*</span></label>

                <div class="col-md-5">
                  <input type="text" name="MOTHER_NAME" id="MOTHER_NAME"
                  class="form-control" value="<?php  set_value('MOTHER_NAME') ?>"
                  placeholder="Mother name">


                  <span class="red"><?php echo form_error('MOTHER_NAME'); ?></span>
                </div>
                <div class="col-md-2">
                  <i class="fa fa-info-circle pointer2"
                  data-content="Enter the name of place where are you born" data-placement="right"
                  data-toggle="popover" data-container="body" data-original-title=""
                  title="Help"></i>
                </div>
              </div>
              <div class="form-group">
                <label for="DOB" class="col-md-5 control-label">Date of Birth <span class="red">*</span></label>

                <div class="col-md-5">
                  <input type="text" name="DOB" id="DOB"
                  class="form-control datepicker" value=" "
                  placeholder="Date of Birth">


                  <span class="red"><?php echo form_error('DOB'); ?></span>
                </div>
                <div class="col-md-2">
                  <i class="fa fa-info-circle pointer2"
                  data-content="Enter the name of place where are you born" data-placement="right"
                  data-toggle="popover" data-container="body" data-original-title=""
                  title="Help"></i>
                </div>
              </div>
              <div class="form-group">
                <label for="PLACE_OF_BIRTH" class="col-md-5 control-label">Place of Birth <span class="red">*</span></label>

                <div class="col-md-5">
                  <input type="text" name="PLACE_OF_BIRTH" id="PLACE_OF_BIRTH"
                  class="form-control" value=" "
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
                <label class="col-md-5 control-label">Mobile No <span class="text-danger">*</span></label>
                <div class="col-md-5">
                  <input type="text" name="MOBILE_NO" value="<?php echo set_value('MOBILE_NO'); ?>" maxlength="11" class="form-control numericOnly" placeholder="Mobile no"/>
                  <div class="text-danger">
                    <?php echo form_error('MOBILE_NO'); ?>
                  </div>
                </div>
                <div class="col-md-2">
                  <i class="fa fa-info-circle pointer2"
                  data-content="Enter your mobile number" data-placement="right"
                  data-toggle="popover" data-container="body" data-original-title=""
                  title="Help"></i>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-5 control-label" >Email <span class="text-danger">*</span></label>
                <div class="col-md-5">
                  <input type="email" name="EMAIL" value="<?php echo set_value('EMAIL'); ?>" id=""  class="form-control" placeholder="Email"/>
                  <div class="text-danger">
                    <?php echo form_error('EMAIL'); ?>
                  </div>
                </div>
                <div class="col-md-2">
                  <i class="fa fa-info-circle pointer2"
                  data-content="Enter your email" data-placement="right"
                  data-toggle="popover" data-container="body" data-original-title=""
                  title="Help"></i>
                </div>
              </div>

              <div class="form-group">
                <label for="BLOOD_GRP" class="col-md-5 control-label">Blood Group :</label>
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
                  class="form-control numbersOnly" placeholder="National ID">
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
                <label class="col-md-5 control-label">Bio-matric ID</label>

                <div class="col-md-5">
                  <input type="text" name="BIOMETRIC_ID" id="BIOMETRIC_ID"
                  value=""
                  class="form-control numbersOnly" placeholder="Bimatric id">
                  <span class="red"><?php echo form_error('BIOMETRIC_ID'); ?></span>
                </div>
                <div class="col-md-2">
                  <i class="fa fa-info-circle pointer2"
                  data-content="Please enter your natinal indentity number here"
                  data-placement="right" data-toggle="popover" data-container="body"
                  data-original-title="" title="Help"></i>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-5 control-label">Join Date</label>

                <div class="col-md-5">
                  <input type="text" name="JOIN_DATE" id="JOIN_DATE"
                  value=""
                  class="form-control datepicker " placeholder="Join Date">
                  <span class="red"><?php echo form_error('JOIN_DATE'); ?></span>
                </div>
                <div class="col-md-2">
                  <i class="fa fa-info-circle pointer2"
                  data-content="Please enter your natinal indentity number here"
                  data-placement="right" data-toggle="popover" data-container="body"
                  data-original-title="" title="Help"></i>
                </div>
              </div>



              <div class="form-group">
                <label class="col-md-5 control-label">Religion <span class="red">*</span></label>
                <div class="col-md-5">
                  <select  class="form-control" name="RELIGION_ID" id="RELIGION_ID" >
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
                  <label class="control-label">Photo</label>
                </div>
                <div class="form-group col-md-12">
                  <div class="col-md-3">
                    <div class="avatar-zone">
                      <img id="img_id" src="<?php echo base_url('assets/img/default.jpg'); ?>"
                      alt="select photo" style="width: 180px;
                      height: 160px;"/>
                    </div>
                    <div class="overlay-layer">Choose File</div>
                    <input type='file' style="cursor: pointer;" name="photo" id="propic" onchange="upload_img(this);" class="upload_btn"
                    >
                  </div>
                </div>
              </div>
              <div class="pull-right" style="margin-right: 60px">
                <div class="form-group col-md-12">
                  <label class="control-label">Signature</label>
                </div>
                <div class="form-group col-md-12">
                  <div class="col-md-3">
                    <div class="avatar-zone-sig">
                      <img id="sig_id" src="<?php echo base_url('assets/img/signature.jpg'); ?>"
                      alt="select photo"  style="width: 180px;
                      height: 50px;"/>
                    </div>
                    <div class="overlay-layer-sig">Choose File</div>
                    <input type='file' style="cursor: pointer;" name="signature" id="sigpic" onchange="upload_img_sig(this);" class="upload_btn"
                    >
                  </div>
                </div>
                <div class="form-group col-md-12">
                  <b>Instruction:</b><br>
                  <span  style="color:red;">
                    ->Photo, Signature Photo format must be .gif, .jpg, .jpeg or .png<br>
                    <!-- ->Size should not exceed 100 KB for Photo and 60 KB for Signature<br>
                    ->Dimension prefarable 300 X 300 px for Photo and 300 X 80 px for Signature -->
                  </span><br>
                 <!--  For image resize <a href="http://picresize.com/" target="_blank"
                  style="color:#18A689">Click Here</a> -->

                </div>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>





          <!-- Modal -->

          <!-- test -->

        </div>

      </div>
    </section>
    <h3>Deapartment</h3>
    <section>
      <table id="designation_list" class="table table-bordered dataTable">
        <thead>
          <tr>
            <th width="50%">Department</th>
            <th width="20%">Desigantion</th>
            <th width="5%">Default</th>
            <th width="25%" class="text-center"><span class="btn btn-xs btn-success"
              id="add_designation"><i
              style="cursor:pointer" class="fa fa-plus"> Add More</i></span></th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>


      </section>
      <h3>Final</h3>
      <section>
 <input type="submit" class="btn btn-primary" value="submit">
      </section>
    </div>
  </form>
  <div class="clearfix"></div>
</div>
</div>


<script src="<?php echo base_url(); ?>assets/js/plugins/staps/jquery.steps.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/keyboard/keyboard.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
<script>

  $("#emp_form").validate({
    rules: {

     FULL_NAME: {required:true},
     FATHER_NAME: {required:true},
     MOTHER_NAME: {required:true},
   },
   messages: {


     FULL_NAME: "Full name required",
     FATHER_NAME: "Father name required",
     MOTHER_NAME: "Mother name required",

   }
 });

  $('#admission_form_submit').on('click', function (e) {
    $("#admission_form").submit();
    $('#admissionModal').modal('hide');
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
      /*    if (image.height > 30000 && image.width > 30000) {
            alert("Dimension prefarable 300 X 300 px ");
          } else if (fsize > 102400) {
            alert("Size should not exceed 100 KB ");
          } else {*/
            $('#img_id').attr('src', e.target.result);
            $('#p_img_id').attr('src', e.target.result);

         /* }*/
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
              /*if (image.height > 8000 && image.width > 30000) {
                alert("Dimension prefarable 300 X 80 px ");
              } else if (fsize > 6144000) {
                alert("Size should not exceed 60 KB ");
              } else {*/
                $('#sig_id').attr('src', e.target.result);
                $('#p_sig_id').attr('src', e.target.result);
              /*}*/
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
        url: '<?php echo base_url(); ?>common/dis_by_div_id',
        data: {DIVISION_ID: DIVISION_ID},
        success: function (data) {
          $("#DISTRICT_ID").html(data)
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

    $('#WEIGHT_KG').on('keyup', function () {
      var pound = parseFloat("2.20462");
      var total = ($(this).val() * pound);
      var n = total.toFixed(2);
      $("#WEIGHT_LBS").val(n);

    });
    $('#WEIGHT_LBS').on('keyup', function () {
      var kg = parseFloat("0.453592");
      var total = ($(this).val() * kg);
      var n = total.toFixed(2);
      $("#WEIGHT_KG").val(n)
    });
    $('#HEIGHT_FEET').on('keyup', function () {
      var cm = parseFloat("30.48");
      var total = ($(this).val() * cm);
      var n = total.toFixed(2);
      $("#HEIGHT_CM").val(n);

    });
    $('#HEIGHT_CM').on('keyup', function () {
      var ft = parseFloat("0.0328084");
      var total = ($(this).val() * ft);
      var n = total.toFixed(2);
      $("#HEIGHT_FEET").val(n)
    });
    $(document).on("click", ".local_emergency_guardian", function () {
      var thisVal = $(this).val();
      if (thisVal == 'O') {
        $(".is_required_o").attr("required", "required");
      } else {
        $(".is_required_o").removeAttr("required");
      }
    });
    // get batch by change program
    $(document).on('change', '#PROGRAM_ID', function () {
      var program_id = $(this).val();
      var session_id = $("#SESSION").val();
      $.ajax({
        type: 'POST',
        url: '<?php echo site_url('common/batchByProgramId'); ?>',
        data: {program_id: program_id,session_id:session_id},
        success: function (data) {
          $('#BATCH_ID').html(data);
        }
      });
    });
    $("#example-basic").steps({
      headerTag: "h3",
      bodyTag: "section",
      transitionEffect: "slideLeft",
      enableFinishButton: false,
      enableCancelButton: false,
      autoFocus: true
    });


    var counter = 0;
    $(document).on('click', '#add_designation', function () {
        counter++;
        $("#designation_list tbody").append(' <tr>' +

            '<td>' +
            '<select class="form-control" name="DEPT_ID[]"  >' +
            '<option value="">-Select-</option>' +
            <?php foreach ($dept as $row) { ?>
            '<option value="<?php echo $row->DEPT_ID ?>"><?php echo $row->DEPT_NAME ?></option>' +
            <?php } ?>
            '</select> ' +
            '</td>' +
            '<td>' +
            '<select class="form-control" name="DESIG_ID[]"  >' +
            '<option value="">-Select-</option>' +
            <?php foreach ($designation as $row) { ?>
            '<option value="<?php echo $row->DESIG_ID ?>"><?php echo $row->DESIGNATION ?></option>' +
            <?php } ?>
            '</select> ' +
            '</td>' +
            '<td>' +
            '<select class="form-control from_yes" name="DEFAULT_FG[]"  >'+
                                         
                                        
                                            '<option value="1" >Yes</option>'+
                                            '<option value="0" >No</option>'+
                                        
                                    '</select>' +
            '</td>' +
            '<td class="text-center">' +
            '<span class="btn btn-xs btn-danger remove_tr" ><i style="cursor:pointer" class="fa fa-times" > Remove</i></span>' +
            '</td>' +
            '</tr>'
        );
    });



    $(document).on('click', '#remove_tr', function () {
        if (counter > 0) {
            $(this).closest('tr').remove();
            counter--;
        }
        return false;
    });

  </script>