<div class="ibox float-e-margins">
    <div class="ibox-title">
        <div class="col-md-9"><b>Member Application</b></div>
    </div>    
    <form id="resident_application_form" class="form-horizontal" action="<?php echo site_url(); ?>/student/libraryMemberApplicationSave" method="post" enctype="multipart/form-data">
        <div class="ibox-content">
    
            <div class="form-group">
                <label class="col-lg-2 control-label">Remarks</label>
                <div class="col-lg-4"> 
                    <textarea name="REMARKS" class="form-control"> </textarea>               
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label"></label>
                <div class="col-lg-4"> 
                  <p> <input type="checkbox" name="TERMS" value="1" required> I accept <a title="Library Member Policy" href="#" data-action="student/libraryMemberPolicy" class="openModal">terms and conditions.</a> </p>                 
              </div>
          </div>
          <input type="hidden" name="MEMBER_TYPE" value="s">
          <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
           <!--      <input type="button" class="btn btn-primary btn-sm fSubmit" data-action="student/libraryMemberApplicationSave" data-su-action="student/libraryMemberApplicationSave"  value="Submit" >
                <input type="reset" class="btn btn-default btn-sm" value="Reset">
                <span class="loadingImg"></span> -->

                <input type="submit">
            </div>
        </div>
        <div class="clearfix"></div>

    </form>

</div>  
</div>  
