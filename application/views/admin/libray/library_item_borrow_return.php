<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/jquery-ui.datepicker.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/plugins/steps/jquery.steps.css" rel="stylesheet">

<style type="text/css">

</style>

<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>Return Item Borrow </h5>
  </div>
  <div class="ibox-content">

   <form id="item_form" class="form-horizontal" action="libraryItemBorrowReturen" method="post"  enctype="multipart/form-data">
    <?php
    $applicant_summary=$this->session->userdata('applicant_summary');
    $app_academic_sess_array=$this->session->userdata('app_academic_sess_array');

    ?>
    <div id="example-basic">
    
      <section>
       <div class="">
        <div class="">
          
          <h4 style="color:green">Item Borrow Information</h4>

          <div class="">
            <div class="col-md-9">

               <div class="form-group">
                <label class="col-md-5 control-label">Item Stock No<span class="red">*</span></label>

                <div class="col-md-5">
                  <input type="text" name="STOCK_ID" id="STOCK_ID"
                  value=""
                  class="form-control" placeholder="Item Stock No" required onchange="libraryItem()">
                  <span class="red"><?php echo form_error('STOCK_ID'); ?></span>
                </div>

                <div class="clearfix"></div>

<!--                 <label class="col-md-5 control-label">Item Status </label>
                <div class="col-md-5">

                  <select id="ACTIVE_STATUS" name="ACTIVE_STATUS" class="form-control">
                    <option value="">-Select-</option>
                    <option value="1" selected> Item Outside Library </option>
                    <option value="0" > Item In Library</option>
                  </select>

                  <span class="red"></span>
                </div> -->


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


<!-- Student and book details -->

<div class="">
  <div class="col-md-12" style="padding-right: 0px !important;padding-left: 0px !important; width: 101%; margin-top: 1%;">

    <div class="form-group  col-md-12"  id="libraryItem">  </div>

  </div>

  <div class="clearfix"></div>
</div>
<!-- End student and book Details -->
</div>
<script src="<?php echo base_url(); ?>assets/js/plugins/staps/jquery.steps.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
<script>



function libraryItem() {
  var stockID = $( "#STOCK_ID" ).val();
    $.ajax({

    type: 'POST',
    url: '<?php echo base_url(); ?>Library/libraryItemBorrowDetails',
    data: {stockID : stockID},
    success: function (data) {
      $("#libraryItem").html(data)

    }
    
  });
 
  

}

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
  
    
    

    // get batch by change program
    $(document).on('change', '#PROGRAM_ID', function () {});
    $("#example-basic").steps({
      headerTag: "h3",
      bodyTag: "section",
      transitionEffect: "slideLeft",
      enableFinishButton: false,
      enableCancelButton: false,
      autoFocus: true
    });




  </script>