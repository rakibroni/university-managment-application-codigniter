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

   <form id="item_form" class="form-horizontal" action="<?php echo site_url()?>/library/libraryMemberUpdateSave" method="post"  enctype="multipart/form-data">

    <div id="example-basic">
    
      <section>
       <div class="">
        <div class="">
        
          <h4 style="color:green">Library Member Application Update</h4>

          <div class="">
            <div class="col-md-9">

				    <?php $MEBBER_ID = $this->uri->segment(3);  ?>
         


       
            <input type="hidden" name="MEBBER_ID" value="<?php echo $MEBBER_ID; ?>">
              <div class="form-group">
                <label for="ITEM_NAME" class="col-md-5 control-label">Membership No</label>
                <div class="col-md-5">
                  <input type="text" name="MEMBER_NO" id="MEMBER_NO"
                  class="form-control"  value="<?php echo $library_member_info[0]->MEMBER_NO ?>"
                  placeholder="MEMBER NO">
                  <span class="red"><?php  //echo form_error('MEMBER_NO'); ?></span>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-5 control-label">Member Status </label>
                <div class="col-md-5">

                  <select id="ACTIVE_STATUS" name="ACTIVE_STATUS" class="form-control">
                    <option value="">-Select-</option>
                    <?php foreach ($library_member_info as $row):  ?>
                    	<?php if($row->ACTIVE_STATUS == 0 ){ ?>

                        <option value="0" selected> Membership Active </option>
						<option value="1" > Membership Deactive</option>
                        <?php } else { ?>
                        <option value="0" > Membership Active </option>
                        <option value="1" selected> Membership Deactive</option>

                        <?php } ?>
                    <?php endforeach; ?>
                  </select>

                  <span class="red"></span>
                </div>
           
              </div>

<!--               <div class="form-group">
                    <label class="col-md-5 control-label">Join Date</label>
                    <?php
                   // $t = strtotime($library_member_info[0]->START_DT);
                    //var_dump($t);
                   // $START_DT = date('m/d/y',$t);
                    ?>

                    <div class="col-md-5">
                        <input type="text" name="START_DT" id="START_DT"
                               value="<?php// echo $START_DT ?>"
                               class="form-control datepicker " placeholder="START Date">
                        <span class="red"><?php// echo form_error('HIRE_DATE'); ?></span>
                    </div>
                </div> -->


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
