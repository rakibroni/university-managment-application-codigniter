<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/jquery-ui.datepicker.css" rel="stylesheet">


<link href="<?php echo base_url(); ?>assets/css/plugins/steps/jquery.steps.css" rel="stylesheet">

<style type="text/css">

</style>

<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>Add Book </h5>


    <a class="btn btn-primary btn-xs pull-right " href="<?php echo site_url()?>/library/itemList"">Back </a>

  </div>
  <div class="ibox-content">

   <form id="item_form" class="form-horizontal" action="addItem" method="post"  enctype="multipart/form-data">
    <?php
    $applicant_summary=$this->session->userdata('applicant_summary');
    $app_academic_sess_array=$this->session->userdata('app_academic_sess_array');

    ?>
    <div id="example-basic">
      <h3>Book Information</h3>
      <section>
       <div class="">
        <div class="">
          <strong>NOTE : </strong> All <span class="red">*</span> field are required.
          

          <div class="">
            <div class="col-md-9">


              <div class="form-group">
                <label class="col-md-5 control-label">ISBN NO<span class="red">*</span></label>

                <div class="col-md-5">
                  <input type="text" name="ISBN_NO" id="ISBN_NO"
                  value=""
                  class="form-control" placeholder="ISBN NO">
                  <span class="red"><?php echo form_error('ISBN_NO'); ?></span>
                </div>
              
              </div>

              <div class="form-group">
                <label for="ITEM_NAME" class="col-md-5 control-label">Title / Book Name</label>
                <div class="col-md-5">
                  <input type="text" name="ITEM_NAME" id="ITEM_NAME"
                  class="form-control"  value="<?php  set_value('ITEM_NAME') ?>"
                  placeholder="Title">
                  <span class="red"><?php echo form_error('ITEM_NAME'); ?></span>
                </div>
              </div>

              <div class="form-group">
                <label for="FATHER_NAME" class="col-md-5 control-label">Sub Title</label>
                <div class="col-md-5">
                  <input type="text" name="SUB_TITLE" id="SUB_TITLE"
                  class="form-control"  value="<?php  set_value('SUB_TITLE') ?>"
                  placeholder="Sub Title">
                  <span class="red"><?php echo form_error('SUB_TITLE'); ?></span>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-5 control-label">Department</label>
                <div class="col-md-5">

                  <select id="DEPARTMENT" name="DEPARTMENT" class="form-control">
                    <option value="">-Select-</option>

                    <?php foreach ($department as $row): ?>
                      <option value="<?php echo $row->LKP_ID ?>" <?php //echo ( $applicant_summary['BLOOD_GRP'] == $row->LKP_ID) ? 'selected' : set_value('BLOOD_GRP') ?>><?php echo $row->LKP_NAME ?></option>
                    <?php endforeach; ?>

                    
                  </select>

                  <span class="red"></span>
                </div>
           
              </div>

              <div class="form-group">
                <label class="col-md-5 control-label" >Language </label>

                <div class="col-md-5">
                  <input type="text" name="LANGUAGE" value="<?php echo set_value('LANGUAGE'); ?>" id=""  class="form-control" placeholder="Language"/>
                 
                </div>

              </div>

              <div class="form-group">
                <label for="AUTHOR_ID" class="col-md-5 control-label">Author Name </label>
                <div class="col-md-5">
                  <select id="AUTHOR_ID" name="AUTHOR_ID" class="form-control">
                    <option value="">-Select-</option>
                    <?php foreach ($author as $row): ?>
                      <option value="<?php echo $row->AUTHOR_ID ?>" <?php //echo ( $applicant_summary['BLOOD_GRP'] == $row->LKP_ID) ? 'selected' : set_value('BLOOD_GRP') ?>><?php echo $row->AUTHOR_NAME ?></option>
                    <?php endforeach; ?>
                   
                  </select>
                </div>
              </div>

<!--        <div class="form-group">
                <label  for="EDITOR_NAME" class="col-md-5 control-label">Editor Name <span class="red">*</span></label>

                <div class="col-md-5">
                  <input type="text" name="EDITOR_NAME" id="EDITOR_NAME"
                  value="<?php  //set_value('EDITOR_NAME') ?>"
                  class="form-control " placeholder="Editor Name" >
                  
                </div>
              </div> 

-->

              <div class="form-group">
                <label for="EDITION_NO" class="col-md-5 control-label">Edition No </label>

                <div class="col-md-5">
                  <input type="text" name="EDITION_NO" id="EDITION_NO"
                  class="form-control" value="<?php  set_value('EDITION_NO') ?>"
                  placeholder="Edition No">
                  
                </div>
           
              </div>

              <div class="form-group">
                <label for="BOOK_CELL_NO" class="col-md-5 control-label">Book  cell no </label>

                <div class="col-md-5">
                  <input type="text" name="BOOK_CELL_NO" id="BOOK_CELL_NO"
                  class="form-control" value="<?php  set_value('BOOK_CELL_NO') ?>"
                  placeholder="Book cell no">
                  
                </div>         
              </div>

              <div class="form-group">
                <label for="BOOK_TYPE_ID" class="col-md-5 control-label">Book Type :</label>
                <div class="col-md-5">

                  <select id="BOOK_TYPE_ID" name="BOOK_TYPE_ID" class="form-control">
                    <option value="">-Select-</option>   
                    <?php foreach ($library_item_type as $row): ?>
                      <option value="<?php echo $row->LKP_ID ?>" <?php //echo ( $applicant_summary['BLOOD_GRP'] == $row->LKP_ID) ? 'selected' : set_value('BLOOD_GRP') ?>><?php echo $row->LKP_NAME ?></option>
                    <?php endforeach; ?>
                  </select>
                  <span class="red"></span>
                </div>
              </div>

              <div class="form-group">
                <label for="SUPPILER_ID" class="col-md-5 control-label">Suppiler Name :</label>
                <div class="col-md-5">

                  <select id="SUPPILER_ID" name="SUPPILER_ID" class="form-control">
                    <option value="">-Select-</option>
                   <?php foreach ($supplier as $row): ?>
                      <option value="<?php echo $row->SUPPLIER_ID ?>" <?php //echo ( $applicant_summary['BLOOD_GRP'] == $row->LKP_ID) ? 'selected' : set_value('BLOOD_GRP') ?>><?php echo $row->FULL_ENAME ?></option>
                    <?php endforeach; ?>
                  </select>

                  <span class="red"></span>
                </div>
              </div>

               <div class="form-group">
                <label class="col-md-5 control-label">Price </label>
                <div class="col-md-5">
                  <input type="text" name="PRICE" id="PRICE"
                  value=""
                  class="form-control numbersOnly" placeholder="Price">
                 
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-5 control-label"> Number of Page</label>

                <div class="col-md-5">
                  <input type="text" name="NUMBER_OF_PAGE" id="NUMBER_OF_PAGE"
                  value=""
                  class="form-control numbersOnly" placeholder="Nomber of Page">
                 
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-5 control-label"> Clue Page</label>

                <div class="col-md-5">
                  <input type="text" name="CLUE_PAGE" id="CLUE_PAGE"
                  value=""
                  class="form-control numbersOnly" placeholder="Clue Page">
                  
                </div>
              </div>

              <div class="form-group">
                <label for="PUBLISHER_ID" class="col-md-5 control-label">Publisher Name </label>
                <div class="col-md-5">
                  <select id="PUBLISHER_ID" name="PUBLISHER_ID" class="form-control">
                    <option value="">-Select-</option>
                   <?php foreach ($publisher as $row): ?>
                      <option value="<?php echo $row->PUBLISHER_NAME ?>" <?php //echo ( $applicant_summary['BLOOD_GRP'] == $row->LKP_ID) ? 'selected' : set_value('BLOOD_GRP') ?>><?php echo $row->PUBLISHER_NAME ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="PUBLICATION_YEAR" class="col-md-5 control-label">Publication Year </label>
                <div class="col-md-5">
                  <input type="text" name="PUBLICATION_YEAR" id="PUBLICATION_YEAR"
                  class="form-control numbersOnly"  value="<?php  set_value('PUBLICATION_YEAR') ?>"
                  placeholder="Publication Year">
                 
                </div>
              </div>

              <div class="form-group">
                <label for="PUBLICATION_PLACE" class="col-md-5 control-label">Publication Place </label>
                <div class="col-md-5">
                  <input type="text" name="PUBLICATION_PLACE" id="PUBLICATION_PLACE"
                  class="form-control"  value="<?php  set_value('PUBLICATION_PLACE') ?>"
                  placeholder="Publication Place">
                  <span class="red"><?php echo form_error('PUBLICATION_PLACE'); ?></span>
                </div>
              </div>

<!--               <div class="form-group">
                <label for="BOOK_SIZE" class="col-md-5 control-label">Book Size <span class="red">*</span></label>
                <div class="col-md-5">
                  <input type="text" name="BOOK_SIZE" id="BOOK_SIZE"
                  class="form-control"  value="<?php  //set_value('BOOK_SIZE') ?>"
                  placeholder="Book Size">
                  <span class="red"><?php //echo form_error('BOOK_SIZE'); ?></span>
                </div>
              </div> -->

            <div class="form-group">
                <label for="PDF_VERSION" class="col-md-5 control-label">PDF Version (If Available) </label>

                <div class="col-md-5">
                 <input class="form-control" name="PDF_VERSION" type="file">
               </div>
            </div>

            <div class="form-group">
                <label for="COVER_IMAGE" class="col-md-5 control-label">Cover Image <span class="red">*</span></label>

                <div class="col-md-5">
              
                 <input type='file' style="cursor: pointer;" name="COVER_IMAGE" id="COVER_IMAGE_ID" onchange="upload_img_sig(this);" class="upload_btn"
                    >
               </div>
            </div>

              <div class="form-group">
                <label for="COMMENT" class="col-md-5 control-label">Comment / Note <span class="red">*</span></label>

                <div class="col-md-5">
                  <textarea type="textarea" name="COMMENT" id="COMMENT"
                  class="form-control" value=" "
                  placeholder=" Comment / Note"></textarea>
                  <span class="red"><?php echo form_error('COMMENT'); ?></span>
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

      <section style="margin-left: 30.5%;">
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

  $("#item_form").validate({
    rules: {

     ISBN_NO: {required:true},
     
   },
   messages: {


     ISBN_NO: "ISBN NO required",
   

   }
 });

  $('#admission_form_submit').on('click', function (e) {
    $("#admission_form").submit();
    $('#admissionModal').modal('hide');
  });



//This function  is use for student image preview before upload
function COVER_IMAGE(input) {
  var fileTypes = ['jpg', 'jpeg', 'png', 'gif','pdf'];
  if (input.files && input.files[0]) {
    var extension = input.files[0].name.split('.').pop().toLowerCase(),  //file extension from input file
    isSuccess = fileTypes.indexOf(extension) > -1;
    var fsize = $('#COVER_IMAGE')[0].files[0].size; 
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
  var fileTypes = ['jpg', 'jpeg', 'png', 'gif','pdf'];
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