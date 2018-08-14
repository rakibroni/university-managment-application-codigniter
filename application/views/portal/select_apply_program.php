<link rel="stylesheet" href="<?php echo base_url()?>/assets/css/plugins/jQueryUI/jquery-ui.css">
<form class="form-horizontal">
    <div class="col-md-12">
        <div class="widget-main">
            <div class="widget-inner shortcode-typo">
                <div class="row">

                    <div class="col-md-3"></div>
                    <div class="col-md-7 form-horizontal  bd-col">

                        <div class="ibox-content">
                        <h3 class="text-center">Sign Up</h3>            
<!--                             <div class="form-group">
                 <label class="col-md-3 control-label " for="FIRST_NAME" >Program <span class="text-danger">*</span></label>
                 <div class="col-md-5">
                     <select class="form-control" name="PROGRAM_ID" id="PROGRAM_ID">
                         <option value="">--Select--</option>
                         <?php  if(!empty($program)): foreach ($program as $row): ?>
                             <option value="<?php echo $row->PROGRAM_ID; ?>"> <?php echo $row->PROGRAM_NAME; ?></option>
                         <?php endforeach; endif;?>
                     </select>
                 </div>
                 <br clear="all"/>
             </div>   -->             
                            <div class="form-group">
                                <label class="col-md-3 control-label " for="FIRST_NAME" >Full Name <span class="text-danger">*</span></label>
                                <div class="col-md-5 ">
                                    <div class="fg-line">
                                        <input type="text" name="FIRST_NAME"  class="form-control uppercase" id="" placeholder="Full Name"/>
                                    </div>
                                </div>
                                <br clear="all"/>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="GENDEN">Gender<span class="text-danger">*</span></label>
                                <div class="col-md-8 ">
                                    <input type="radio" name="GENDER" class="gender required" value="4" checked="checked"/> Male
                                    &nbsp;&nbsp;
                                    <input type="radio" name="GENDER" class="gender required" value="5"/> Female
                                    &nbsp;&nbsp;
                                    <input type="radio" name="GENDER" class="gender required" value="207"/> Others
                                </div>
                                <br clear="all"/>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label commonClass" for="MOBILE_NO">Mobile No <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-1" style="width:6.333333% !important ; padding-right:2px !important;">

                                        <input type="text"  class="form-control text-right" style="padding:3px !important;" placeholder="+88" readonly="readonly" />
                                    </div>
                                    <div class="col-md-4">

                                        <input type="text" name="MOBILE_NO" class="form-control numericOnly" placeholder="Mobile no"/>
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-md-3 control-label" >Email<span class="text-danger">*</span></label>
                                <div class="col-md-5">                                 
                                    <input type="text" name="EMAIL" id=""  class="form-control" placeholder="Email"/>
                                    
                                </div>
                                <br clear="all"/>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="DATE_OF_BIRTH">Date of  Birth<span class="text-danger">*</span></label>
                                <div class="col-md-5 ">
                                    <input type="text" name="" id="datepicker" class="form-control" readonly="readonly" placeholder="dd/mm/yy">
                                </div>
                            </div>
                            <br clear="all"/>

                            <div class="form-group">
                                <div class="col-md-3"></div>
                                <div class="col-md-2">
                                    <input type="button" id="formSubmit" class="btn btn-primary btn-sm formSubmit" value="Sign Up">
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
        $('.uppercase').keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });
    });
    $( function() {
        $( "#datepicker" ).datepicker({
          changeMonth: true,
          changeYear: true,
          dateFormat: 'dd-mm-yy' ,
          yearRange: "-50:+0",
      });
    } );
</script>