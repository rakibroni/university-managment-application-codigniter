 
<link href='<?php echo base_url();?>assets/calendar/css/fullcalendar.css' rel='stylesheet' />
<link href="<?php echo base_url();?>assets/calendar/css/bootstrapValidator.min.css" rel="stylesheet" />        
<link href="<?php echo base_url();?>assets/calendar/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
<!-- Custom css  -->
<script src='<?php echo base_url();?>assets/calendar/js/moment.min.js'></script> 
<script src="<?php echo base_url();?>assets/calendar/js/bootstrapValidator.min.js"></script>
<script src="<?php echo base_url();?>assets/calendar/js/fullcalendar.min.js"></script>
<script src='<?php echo base_url();?>assets/calendar/js/bootstrap-colorpicker.min.js'></script> 
<script src='<?php echo base_url();?>assets/calendar/js/main.js'></script>
 
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
 
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Events</h5>

    </div>
    <div id="event_modal" class="ibox-content">
        <div class="table-responsive contentArea">
            <!-- Notification -->
            <div class="alert"></div>
            <div class="row">
                <div class="col-md-12">
                    <div id='calendar'></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
</div>


<div id="event_dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="error"></div>
                <form class="form-horizontal" id="crud-form">
                    <input type="hidden" id="start">
                    <input type="hidden" id="end">
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="title">Title</label>
                        <div class="col-md-4">
                            <input id="title" name="title" type="text" class="form-control input-md" />
                        </div>
                    </div>                            
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="description">Description</label>
                        <div class="col-md-4">
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="color">Color</label>
                        <div class="col-md-4">
                            <input id="color" name="color" type="text" class="form-control input-md" readonly="readonly" />
                            <span class="help-block">Click to pick a color</span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


