  
    <form id="resident_application_remark_form" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        
            <div class="form-group">
                <label class="col-lg-2 control-label">Remarks</label>
                <div class="col-lg-8"> 
                    <textarea name="REMARK_DEPT_HEAD" class="form-control" rows="5" > </textarea>  
                <input type="hidden" name="APP_ID" value="<?php echo $application_id ?>">             
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">Status</label>
                <div class="col-lg-5"> 
                   <select class="form-control" name="APPROVE_BY_DEPT_HEAD_STATUS"  >
                       <option value="1">Approved</option>
                       <option value="0">Reject</option>
                   </select>            
                </div>
            </div>
             <div class="form-group">
                <label class="col-lg-2 control-label"></label>
                <div class="col-lg-10"> 
                     <input type="button" class="btn btn-primary btn-sm form_submit" data-action="teacher/saveResidentAppAprvByDeptHead"
                           data-su-action="teacher/residentAppAprv" data-type="list" value="Submit">              
                </div>
            </div> 
    </form>
 