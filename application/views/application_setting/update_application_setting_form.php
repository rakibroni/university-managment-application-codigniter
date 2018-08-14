 <form class="form-horizontal" id="" action="<?php echo base_url(); ?>applicationSetting/updateApplicationSetting" method="post"
  enctype="multipart/form-data">
   <input type="text" value="<?php echo $pid ?>" name="APPLICATION_SETT_ID">
  <div class="col-md-12">
    <div class="col-md-6">
        <span class="frmMsg"></span>
        <div class="form-group">
            <label class="col-lg-4 control-label">Application Theme<span class="text-danger">*</span></label>
            <div class="col-lg-6">

                <input type="text" value="<?php echo $application_sett->APPLICATION_THEME ?>" name="APPLICATION_THEME" placeholder="Application Theme" class="col-md-12 form-control">
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-4 control-label">Logo Background<span class="text-danger">*</span></label>

            <div class="col-lg-6">
                <input type="text" value="<?php echo $application_sett->LOGO_BACKGROUND ?>"  name="LOGO_BACKGROUND" placeholder="Logo Background" class="col-md-12 form-control">
                <span class="validation"></span>
                <span class="help-block m-b-none "></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-md-4 control-label"><span>Menue Background Color</span></label>
            <div class="col-md-6">
                <input type="text" value="<?php echo $application_sett->ON_CLICK_M_B_C ?>" name="ON_CLICK_M_B_C" placeholder="Menue Background Color" class="col-md-12 form-control">
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-md-4 control-label"><span> Mouse Over Menue Color</span></label>

            <div class="col-md-6">
                <input type="text" value="<?php echo $application_sett->ON_MOUSE_O_M_C ?>" name="ON_MOUSE_O_M_C" placeholder="Mouse Over Menue Color" class="col-md-12 form-control">
                <span class="validation"></span>
            </div>
        </div>

        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-md-4 control-label"><span>Menue Font Active Color</span></label>

            <div class="col-md-6">
                <input type="text" value="<?php echo $application_sett->MENUE_FONT_A_C ?>" name="MENUE_FONT_A_C" placeholder="Menue Font Active Color" class="col-md-12 form-control">
                <span class="validation"></span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="col-lg-4 control-label">Sidebar Menue Color<span class="text-danger">*</span></label>
            <div class="col-lg-6">
               <input type="text" value="<?php echo $application_sett->SIDEBER_M_C ?>" name="SIDEBER_M_C" placeholder="Sidebar Menue Color" class="col-md-12 form-control">
               <span class="validation"></span>
           </div>
       </div>
       <div class="hr-line-dashed"></div>
       <div class="form-group">
        <label class="col-md-4 control-label"><span>Open Menue Background Color</span></label>
        <div class="col-md-6">
            <input type="text" value="<?php echo $application_sett->OPEN_M_B_C ?>" name="OPEN_M_B_C" placeholder="Open Menue Background Color" class="col-md-12 form-control">
            <span class="validation"></span>
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <label class="col-md-4 control-label"><span>Menue Font Color</span></label>

        <div class="col-md-6">
            <input type="text" value="<?php echo $application_sett->MENUE_FONT_C ?>" name="MENUE_FONT_C" placeholder="Menue Font Color" class="col-md-12 form-control">
            <span class="validation"></span>
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <label class="col-md-4 control-label"><span>Menue Font Hover Color</span></label>

        <div class="col-md-6">
            <input type="text" value="<?php echo $application_sett->MENUE_FONT_H_C ?>" name="MENUE_FONT_H_C" placeholder="Menue Font Hover Color" class="col-md-12 form-control">
            <span class="validation"></span>
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <label class="col-md-4 control-label"><span>Data Table Header Color</span></label>

        <div class="col-md-6">
            <input type="text" value="<?php echo $application_sett->ON_CLICK_T_H_C ?>" name="ON_CLICK_T_H_C" placeholder="Data Table Header Color" class="col-md-12 form-control">
            <span class="validation"></span>
        </div>
    </div>
</div>
</div>
<div class="block-flat">
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <label class="col-lg-4 control-label">Active?</label>
        <div class="col-lg-6">            
            <label class="control-label">
               <?php
               $data = array(
                'name' => 'status',
                'id' => 'status',
                'class' => 'checkBoxStatus',
                'value' => 1,
                'checked' => 'checked'
            );
               echo form_checkbox($data);
               ?>
           </label>

       </div>
   </div>
   <div class="form-group">
    <div class="col-lg-offset-4 col-lg-8">
        <span class="modal_msg pull-left"></span>   
        <button type="submit" class="btn btn-sm btn-success">Save</button>    
        <!--<input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateBuilding"
            data-su-action="setup/buildingById" value="Update">    
            <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createBuilding"
            data-su-action="setup/buildingList" data-type="list" value="submit">        -->  
            <input type="reset" class="btn btn-default btn-sm" value="Reset">
            <span class="loadingImg"></span>
        </div>
    </div>
</form>
</div>
<div class="hr-line-dashed"></div>
</form>
<script>
    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });
</script>