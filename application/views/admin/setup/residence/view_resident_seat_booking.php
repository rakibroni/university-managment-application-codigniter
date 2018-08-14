<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<div class="ibox-content">
	<div class="col-md-12">
		<form id="seat_booking_form" class="form-horizontal ">
			<input type="hidden" name="SEAT_BOOK_ID" value="<?php echo $seat_book_id; ?>">
			<div class="form-group">
				<label class="col-lg-5 control-label">Applicant Name <span class="text-danger">*</span></label>
				<div class="col-lg-6">
					<?php echo $seat_book_details->FULL_NAME_EN ?>
				</div>
			</div>		
			<div class="form-group">
				<label class="col-lg-5 control-label">Registration No <span class="text-danger">*</span></label>
				<div class="col-lg-6">
					<?php echo $seat_book_details->REGISTRATION_NO ?>
				</div>
			</div>		
			<div class="form-group">
				<label class="col-lg-5 control-label">Allocation Start Date</label>
				<div class="col-lg-4">
					<?php echo date('d-M-Y',strtotime($seat_book_details->ALLOCATION_START_DT)); ?>
				</div>			
			</div>			
			<div class="form-group">
				<label class="col-lg-5 control-label">Allocation End Date</label>
				<div class="col-lg-4">
					<?php echo date('d-M-Y',strtotime($seat_book_details->ALLOCATION_END_DT)); ?>
				</div>			
			</div>			
			<div class="form-group">
				<label class="col-lg-5 control-label">Remarks</label>
				<div class="col-lg-4">
					<?php echo $seat_book_details->REMARK ?>
				</div>			
			</div>				
			<div class="form-group">
				<label class="col-lg-8 control-label">Do you want to cancel this seat allocation</label>
				<div class="col-lg-4">
					<input type="checkbox" id="SEAT_CANCELATION" name="SEAT_CANCELATION">
				</div>			
			</div>				
			<div id="SEAT_CANCELATION_BTN" class="form-group" style="display: none">
				<label class="col-lg-5 control-label"></label>
				<div class="col-lg-4">
					<input type="button" class="btn btn-primary btn-sm form_submit" data-action="admin/saveResidentSeatBooking" data-su-action="admin/residentSeatBooking" data-type="list" value="Submit">
				</div>			
			</div>			
			 
		</form>
	</div>        
</div>
<div class="clearfix"></div>

<script src="<?php echo base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
	 $(function () {
        $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy',
            yearRange: "-50:+0",
            autoclose: true,
            startDate: '-0d',
        });

        $('#SEAT_CANCELATION').on('click',function(){
        	$("#SEAT_CANCELATION_BTN").toggle();
        });
    });
</script>