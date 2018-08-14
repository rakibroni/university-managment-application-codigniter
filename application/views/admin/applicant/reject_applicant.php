<form class="form-horizontal frmContent" id="event" method="post">
    <div class="block-flat">
        <span class="frmMsg"></span>
        <div class="form-group"><label class="col-lg-2 control-label">Remarks</label>
            <div class="col-lg-6">
                <input type="text" id="remarks" name="remarks" value="" class="form-control required"  placeholder="Enter Remarks">
                <span class="validation"></span>
                <span class="help-block m-b-none ">e.g. Remarks text here.</span>
            </div>
        </div>
    </div>        
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10"> 
            <input type="hidden" name="applicantId" id="applicantId" value="<?php echo $applicantId; ?>">
            <input type="button" class="btn btn-primary btn-sm formRejectSubmit" data-action="admin/createRejectRemark" value="Submit">    
            <input type="reset" class="btn btn-default btn-sm" value="Reset">
            <span class="loadingImg"></span>
        </div>
    </div>
</form>
