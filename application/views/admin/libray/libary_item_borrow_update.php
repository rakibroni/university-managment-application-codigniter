<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/jquery-ui.datepicker.css" rel="stylesheet">


<link href="<?php echo base_url(); ?>assets/css/plugins/steps/jquery.steps.css" rel="stylesheet">

<style type="text/css">

</style>

<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>Epdate Library Member  </h5>
    <a class="btn btn-primary btn-xs pull-right " href="<?php echo site_url()?>/library/applicationForLibraryMember"">Back </a>
  </div>
  <div class="ibox-content">

   <form id="item_form" class="form-horizontal" action="<?php echo site_url()?>/library/libraryItemUpdateSave" method="post"  enctype="multipart/form-data">

    <div id="example-basic">
    
      <section>
       <div class="">
        <div class="">
        
          <h4 style="color:green">Library Item Borrow Update</h4>

          <div class="">
            <div class="col-md-9">

				    <?php $itemBorrowId = $this->uri->segment(3);   ?>
       
            <input type="hidden" name="itemBorrowId" value="<?php echo $itemBorrowId; ?>">
              <div class="form-group">
                <label for="ITEM_NAME" class="col-md-5 control-label">Member No</label>
                <div class="col-md-5">
                  <input type="text" name="MEMBER_NO" id="MEMBER_NO"
                  class="form-control"  value="<?php echo $library_member_info->MEMBER_NO ?>"
                  placeholder="MEMBER NO">
                  <span class="red"><?php  //echo form_error('MEMBER_NO'); ?></span>
                </div>
              </div>

               <div class="form-group">
                <label for="ITEM_NAME" class="col-md-5 control-label">Member Name</label>
                <div class="col-md-5">
                  <input type="text" name="FULL_NAME_EN" id="FULL_NAME_EN"
                  class="form-control"  value="<?php echo $library_member_info->FULL_NAME_EN ?>"
                  placeholder="MEMBER Name">
                  <span class="red"><?php  //echo form_error('MEMBER_NO'); ?></span>
                </div>
              </div>

               <div class="form-group">
                <label for="ITEM_NAME" class="col-md-5 control-label">Member Depertment</label>
                <div class="col-md-5">
                  <input type="text" name="DEPT_NAME" id="DEPT_NAME"
                  class="form-control"  value="<?php echo $library_member_info->DEPT_NAME ?>"
                  placeholder="MEMBER Depertment">
                  <span class="red"><?php  //echo form_error('MEMBER_NO'); ?></span>
                </div>
              </div>

               <div class="form-group">
                <label for="ITEM_NAME" class="col-md-5 control-label">Member Mobile</label>
                <div class="col-md-5">
                  <input type="text" name="MOBILE_NO" id="MOBILE_NO"
                  class="form-control"  value="<?php echo $library_member_info->MOBILE_NO ?>"
                  placeholder="MEMBER Mobile">
                  <span class="red"><?php  //echo form_error('MEMBER_NO'); ?></span>
                </div>
              </div>

               <div class="form-group">
                <label for="ITEM_NAME" class="col-md-5 control-label">Item Name </label>
                <div class="col-md-5">
                  <input type="text" name="ITEM_NAME" id="ITEM_NAME"
                  class="form-control"  value="<?php echo $library_member_info->ITEM_NAME ?>"
                  placeholder="Item Name">
                  <span class="red"><?php  //echo form_error('MEMBER_NO'); ?></span>
                </div>
              </div>
               <div class="form-group">
                <label for="ITEM_NAME" class="col-md-5 control-label">Item Stock Id</label>
                <div class="col-md-5">
                  <input type="text" name="STOCK_ID" id="STOCK_ID"
                  class="form-control"  value="<?php echo $library_member_info->STOCK_ID ?>"
                  placeholder="Item NO">
                  <span class="red"><?php  //echo form_error('MEMBER_NO'); ?></span>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-5 control-label">Item Status </label>
                <div class="col-md-5">

                  <select id="ACTIVE_STATUS" name="ACTIVE_STATUS" class="form-control">
                    <option value="">-Select-</option>
                  
                    	<?php if($library_member_info->ACTIVE_STATUS == 1 ){ ?>

                        <option value="1" selected> ITEM OUTSIDE LIBRARY </option>
						            <option value="0" > ITEM IN LIBRARY</option>
                        <?php } else { ?>
                        <option value="1" > ITEM OUTSIDE LIBRARY </option>
                        <option value="0" selected> ITEM IN LIBRARY</option>

                        <?php } ?>
                   
                  </select>

                  <span class="red"></span>
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


  </script>
