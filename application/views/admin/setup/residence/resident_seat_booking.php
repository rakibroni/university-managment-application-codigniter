<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<div class="ibox-content">
	<div class="col-md-12">
		<form id="seat_booking_form" class="form-horizontal ">
			<input type="hidden" name="SEAT_BOOK_ID" value="<?php echo $seat_book_id; ?>">
			<div class="form-group">
				<label class="col-lg-5 control-label">Applicant <span class="text-danger">*</span></label>
				<div class="col-lg-6">
					<select class="form-control " name="STUDENT_ID" id="STUDENT_ID">
						<option value="">--Select--</option>
						<?php foreach($resident_application as $row): ?>
							<option value="<?php echo $row->STUDENT_ID ?>"><?php echo $row->FULL_NAME_EN  .'-'.$row->REGISTRATION_NO ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>		
			<div class="form-group">
				<label class="col-lg-5 control-label">Allocation Start Date</label>
				<div class="col-lg-4">
					<input type="text" name="ALLOCATION_START_DT" class="form-control datepicker">
				</div>			
			</div>			
			<div class="form-group">
				<label class="col-lg-5 control-label">Allocation End Date</label>
				<div class="col-lg-4">
					<input type="text" name="ALLOCATION_END_DT" class="form-control datepicker">
				</div>			
			</div>			
			<div class="form-group">
				<label class="col-lg-5 control-label">Remarks</label>
				<div class="col-lg-4">
					<textarea class="form-control" name="REMARK"></textarea>
				</div>			
			</div>				
			<div class="form-group">
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
    });
</script>