<link rel="stylesheet" href="<?php echo base_url()?>/assets/css/plugins/jQueryUI/jquery-ui.css">

<form class="form-horizontal" method="post" action="<?php echo site_url()?>/Portal/signUpForm/<?php echo   $programs->PROGRAM_ID ?>/<?php echo  $ADM_PRG_ID ?>"  >
    <div class="col-md-12">
        <div class="widget-main">
            <div class="widget-inner shortcode-typo">
                <div class="row">

                    <div class="col-md-3"></div>
                    <div class="col-md-7 form-horizontal  bd-col">

                        <div class="ibox-content">
                            <h3 class="text-center">Sign Up </h3>            
                             <div class="form-group">
                 <label class="col-md-3 control-label " for="FIRST_NAME" >Program <span class="text-danger">*</span></label>
                 <div class="col-md-6">
                     <input class="form-control" type="hidden" name="PROGRAM_ID" id="PROGRAM_ID"  value="<?php echo $programs->PROGRAM_ID ?>">
                     <input   type="hidden" name="ADM_PRG_ID" id="ADM_PRG_ID"  value="<?php echo $ADM_PRG_ID?>">
                     <b><?php echo $programs->PROGRAM_NAME ?></b>
                     <div class="text-danger">
                 </div>
                 </div>
                 <br clear="all"/>
             </div>     

             <div class="form-group">
                <label class="col-md-3 control-label">Full Name <span class="text-danger">*</span></label>
                <div class="col-md-6 ">

                    <input type="text" name="FULL_NAME"  value="<?php echo set_value('FULL_NAME'); ?>"   class="form-control" id="" placeholder="Full Name"/>
                    <span style="font-size: 11px">* (As per Certificate of SSC/ Equivalent Examination) </span>
                    <div class="text-danger">
                     <?php echo form_error('FULL_NAME'); ?>
                 </div>

             </div>
             <br clear="all"/>
         </div>
         <div class="form-group">
            <label class="col-md-3 control-label" for="GENDEN">Gender<span class="text-danger">*</span></label>
            <div class="col-md-8 ">
                <input type="radio" name="GENDER" class="gender required" value="M" checked="checked"/> Male
                &nbsp;&nbsp;
                <input type="radio" name="GENDER" class="gender required" value="F"/> Female
                &nbsp;&nbsp;
                <input type="radio" name="GENDER" class="gender required" value="O"/> Others
            </div>
            <br clear="all"/>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Mobile No <span class="text-danger">*</span></label>
<!--            <div class="row">-->
<!--                <div class="col-md-1" style="width:6.333333% !important ; padding-right:2px !important;">-->
<!--                    <input type="text" class="form-control text-right" style="padding:3px !important;" placeholder="+88" readonly="readonly" />-->
<!--                </div>-->
                <div class="col-md-6">
                <input type="text" name="MOBILE_NO" value="<?php echo set_value('MOBILE_NO'); ?>" maxlength="11" class="form-control numericOnly" placeholder="01XXXXXXXXX"/>
                    <div class="text-danger">
                     <?php echo form_error('MOBILE_NO'); ?>
                 </div>
             </div>
<!--         </div>-->
     </div> 
     <div class="form-group">
        <label class="col-md-3 control-label" >Email<span class="text-danger">*</span></label>
        <div class="col-md-6">                                 
            <input type="text" name="EMAIL" value="<?php echo set_value('EMAIL'); ?>" id=""  class="form-control" placeholder="user@mydomain.com"/>
            <div class="text-danger">
             <?php echo form_error('EMAIL'); ?>
         </div>
     </div>
     <br clear="all"/>
 </div>
 <div class="form-group">
    <label class="col-md-3 control-label" >Date of  Birth<span class="text-danger">*</span></label>
    <div class="col-md-6 ">
        <input type="text" name="DATE_OF_BIRTH"  value="<?php echo set_value('DATE_OF_BIRTH'); ?>" id="datepicker" class="form-control" readonly="readonly" placeholder="dd/mm/yy">
        <div class="text-danger">
         <?php echo form_error('DATE_OF_BIRTH'); ?>
     </div>
 </div>
</div>
<br clear="all"/>

<div class="form-group">
    <div class="col-md-3"></div>
    <div class="col-md-2">
        <input type="submit" id="formSubmit" class="btn btn-primary btn-sm formSubmit" value="Sign Up">
    </div>
    <div class="col-md-2">
        <span class="loadingImg"></span>
    </div>
</div>
</div>
</div>  
</div>
<div class="col-md-2"></div>
</div>
</div>
</div>
</div>
</form>
</div>
<script type="text/javascript">

    $(document).ready(function () {

        $('body').on('keyup', '.numericOnly', function () {
            var val = $(this).val();
            $(this).val(val.replace(/[^\d]/g, ''));
        });
        
    });
    $( function() {
        $( "#datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy' ,
            yearRange: '1980:2000'
      });
    } );
</script>