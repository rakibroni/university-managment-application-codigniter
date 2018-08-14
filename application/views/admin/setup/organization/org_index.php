<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/jquery-ui.datepicker.css" rel="stylesheet">
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
    <h5>Add Organization</h5>

  </div>
  <div class="ibox-content">
  <div class="col-md-5">
     <form id="emp_form" class="form-horizontal" action="<?php echo site_url('setup/saveOrg'); ?>" method="post"  enctype="multipart/form-data"> 


      <div class="form-group">
        <label  for="ORG_NAME" class="col-md-5 control-label">Organization Name <span class="red">*</span></label>

        <div class="col-md-5">
        <input type="hidden" name="ORG_ID" value="<?php    if(!empty($organization_info->ORG_ID)){echo $organization_info->ORG_ID;}   ?>">
          <input type="text" name="ORG_NAME" id="ORG_NAME"
          value="<?php    if(!empty($organization_info->ORG_NAME)){echo $organization_info->ORG_NAME;}   ?>"
          class="form-control " placeholder="Organization Name" >
          <span class="red"><?php echo form_error('ORG_NAME'); ?></span>
        </div>
        <div class="col-md-2">
          <i class="fa fa-info-circle pointer2" data-content=" "
          data-placement="right" data-toggle="popover" data-container="body"
          data-original-title="" title="Help"></i>
        </div>
      </div>

      <div class="form-group">
        <label  for="ABBR" class="col-md-5 control-label">Short Name <span class="red">*</span></label>

        <div class="col-md-5">
          <input type="text" name="ABBR" id="ABBR"
          value="<?php    if(!empty($organization_info->ABBR)){echo $organization_info->ABBR;}   ?>"
          class="form-control " placeholder="Organization Short Name" >
          <span class="red"><?php echo form_error('ABBR'); ?></span>
        </div>
        <div class="col-md-2">
          <i class="fa fa-info-circle pointer2" data-content=" "
          data-placement="right" data-toggle="popover" data-container="body"
          data-original-title="" title="Help"></i>
        </div>
      </div> 

      <div class="form-group">
        <label  for="SLOGAN" class="col-md-5 control-label">Slogan</label>

        <div class="col-md-5">
          <input type="text" name="SLOGAN" id="SLOGAN"
          value="<?php if(!empty($organization_info->SLOGAN)){echo $organization_info->SLOGAN;}   ?>"
          class="form-control " placeholder="Slogan" >
          <span class="red"><?php echo form_error('SLOGAN'); ?></span>
        </div>
        <div class="col-md-2">
          <i class="fa fa-info-circle pointer2" data-content=" "
          data-placement="right" data-toggle="popover" data-container="body"
          data-original-title="" title="Help"></i>
        </div>
      </div>

      <div class="form-group">
        <label  for="REG_NO" class="col-md-5 control-label">Registration No.</label>

        <div class="col-md-5">
          <input type="text" name="REG_NO" id="REG_NO"
          value="<?php if(!empty($organization_info->REG_NO)){echo $organization_info->REG_NO;}   ?>"
          class="form-control " placeholder="Registration No." >
          <span class="red"><?php echo form_error('REG_NO'); ?></span>
        </div>
        <div class="col-md-2">
          <i class="fa fa-info-circle pointer2" data-content=" "
          data-placement="right" data-toggle="popover" data-container="body"
          data-original-title="" title="Help"></i>
        </div>
      </div>

      <div class="form-group">
        <label  for="PHONE" class="col-md-5 control-label">Phone</label>

        <div class="col-md-5">
          <input type="text" name="PHONE" id="PHONE"
          value="<?php if(!empty($organization_info->PHONE)){echo $organization_info->PHONE;}   ?>"
          class="form-control " placeholder="Phone" >
          <span class="red"><?php echo form_error('PHONE'); ?></span>
        </div>
        <div class="col-md-2">
          <i class="fa fa-info-circle pointer2" data-content=" "
          data-placement="right" data-toggle="popover" data-container="body"
          data-original-title="" title="Help"></i>
        </div>
      </div>

      <div class="form-group">
        <label  for="EMAIL" class="col-md-5 control-label">Email</label>

        <div class="col-md-5">
          <input type="text" name="EMAIL" id="EMAIL"
          value="<?php if(!empty($organization_info->EMAIL)){echo $organization_info->EMAIL;}   ?>"
          class="form-control " placeholder="Email" >
          <span class="red"><?php echo form_error('EMAIL'); ?></span>
        </div>
        <div class="col-md-2">
          <i class="fa fa-info-circle pointer2" data-content=" "
          data-placement="right" data-toggle="popover" data-container="body"
          data-original-title="" title="Help"></i>
        </div>
      </div>

      <div class="form-group">
        <label  for="WEBSITE" class="col-md-5 control-label">Website</label>

        <div class="col-md-5">
          <input type="text" name="WEBSITE" id="WEBSITE"
          value="<?php if(!empty($organization_info->WEBSITE)){echo $organization_info->WEBSITE;}   ?>"
          class="form-control " placeholder="Website" >
          <span class="red"><?php echo form_error('WEBSITE'); ?></span>
        </div>
        <div class="col-md-2">
          <i class="fa fa-info-circle pointer2" data-content=" "
          data-placement="right" data-toggle="popover" data-container="body"
          data-original-title="" title="Help"></i>
        </div>
      </div>

      <div class="form-group">
        <label  for="DSCP" class="col-md-5 control-label">Description</label>

        <div class="col-md-5">
         <textarea class="form-control" name="DSCP"><?php if(!empty($organization_info->DSCP)){echo $organization_info->DSCP;}   ?></textarea>
       </div>
       <div class="col-md-2">
        <i class="fa fa-info-circle pointer2" data-content=" "
        data-placement="right" data-toggle="popover" data-container="body"
        data-original-title="" title="Help"></i>
      </div>
    </div>

    <div class="form-group">
      <label  for="LOGO" class="col-md-5 control-label">Logo <span class="red">*</span></label>

      <div class="col-md-5">
       <input type="file" class="form-control" name="LOGO">
     </div>
     <div class="col-md-2">
      <i class="fa fa-info-circle pointer2" data-content=" "
      data-placement="right" data-toggle="popover" data-container="body"
      data-original-title="" title="Help"></i>
    </div>
  </div>
 <?php if ($previlages->CREATE == 1) { ?>
  <div class="form-group">

   <input type="submit" class="btn btn-sm btn-primary pull-right" value="Submit">

 </div> 
 <?php } ?>
</form>

</div>
<div class="col-md-7">

  <table class="table table-bordered">
    <thead>
      <th>SL</th>
      <th>Name</th>
      <th>Short Name</th>
      <th>Logo</th>
      <th>Phone</th>
      <th>Email</th>
      <th>Action</th>
    </thead>
    <?php $sl=1; foreach($organization as $row): ?>
    <tr>
      <td><?php echo $sl++ ?></td>
      <td><?php echo $row->ORG_NAME ?></td>
      <td><?php echo $row->ABBR ?></td>
      <td><img style="width: 70px" src="<?php echo base_url('upload/organization/logo/'.$row->LOGO);?>"></td>
      <td><?php echo $row->PHONE ?></td>
      <td><?php echo $row->EMAIL ?></td>
      <td><?php if ($previlages->UPDATE == 1) { ?><a href="<?php echo site_url('setup/editOrg/'.$row->ORG_ID)  ?>">Edit</a><?php } ?></td>
    </tr>
  <?php endforeach; ?>
</table>
</div> 
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
  $(function () {
    $(".datepicker").datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: '1950:+0'
    });
  });

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
          if (image.height > 300 && image.width > 300) {
            alert("Dimension prefarable 300 X 300 px ");
          } else if (fsize > 102400) {
            alert("Size should not exceed 100 KB ");
          } else {
            $('#img_id').attr('src', e.target.result);
            $('#p_img_id').attr('src', e.target.result);

          }
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
              if (image.height > 80 && image.width > 300) {
                alert("Dimension prefarable 300 X 80 px ");
              } else if (fsize > 61440) {
                alert("Size should not exceed 60 KB ");
              } else {
                $('#sig_id').attr('src', e.target.result);
                $('#p_sig_id').attr('src', e.target.result);
              }
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
        '<select class="form-control" name="DEPT_ID_' + counter + '"  >' +
        '<option value="">-Select-</option>' +
        <?php foreach ($dept as $row) { ?>
          '<option value="<?php echo $row->DEPT_ID ?>"><?php echo $row->DEPT_NAME ?></option>' +
          <?php } ?>
          '</select> ' +
          '</td>' +
          '<td>' +
          '<select class="form-control" name="DESIG_ID_' + counter + '"  >' +
          '<option value="">-Select-</option>' +
          <?php foreach ($designation as $row) { ?>
            '<option value="<?php echo $row->DESIG_ID ?>"><?php echo $row->DESIGNATION ?></option>' +
            <?php } ?>
            '</select> ' +
            '</td>' +
            '<td>' +
            '<input type="hidden" name="designation_counter[]" value="' + counter + '" ><input type="checkbox" value="1" name="DEFAULT_FG_' + counter + '"  >' +
            '</td>' +
            '<td class="text-center">' +
            '<span class="btn btn-xs btn-danger" id="remove_tr"><i style="cursor:pointer" class="fa fa-times" > Remove</i></span>' +
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