<link href="<?php echo base_url(); ?>assets/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<style>
    .datepicker.dropdown-menu {
        z-index: 9999 !important;
    }
    .activeClass {
        background: #32cd32;
    }
    .select2-container {
        z-index: 999999;
    }
    .pop-width {
        width: 25% !important;
    }
    #admission_data_time{display: none;}
</style>
<form class="form-horizontal frmContent" id="regPeriod" method="post">
    <div class="block-flat">        
        <span class="frmMsg"></span>  
        <div class="form-group">       
           <label class="col-lg-3 control-label"></label>      
           <div class="col-lg-4 text-warning"><b> Curretn Admission Session : <?php echo $session->SESSION_NAME. "-" . $session->DINYEAR; ?></b></div>
       </div>
       <div class="hr-line-dashed"></div>      
       <div class="form-group">
        <label class="col-lg-3 control-label">Title<span class="text-danger">*</span></label>
        <div class="col-lg-5">
            <input type="text" id="title" name="title"
            value="<?php echo ($ac_type == 'edit') ? $previous_info->ARP_TITLE : '' ?>"
            class="form-control  " placeholder="Enter Registration Period Title">
            <span class="validation"></span>
            <span class="help-block m-b-none ">e.g. Fall Admission Period- 2016.</span>
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <label class="col-lg-3 control-label"><span>Description</span></label>
        <div class="col-lg-5">
            <textarea class="redactor" name="description"></textarea>
            <span class="validation"></span>
            <span class="help-block m-b-none">e.g. Fall Admission Period- 2016 description text here.</span>
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">            
        <label class="col-lg-3 control-label">Admission period:</label>
        <div class="col-lg-2">
            <input type="text" name="pFromDate"   class="form-control datepicker" readonly="readonly" placeholder="dd/mm/yy">            
            <span class="help-block m-b-none ">e.g.  05/10/2015</span>
        </div>
        <label class="col-lg-1 control-label">To<span class="text-danger">*</span></label>
        <div class="col-lg-2">
            <input type="text" name="pToDate" class="form-control   datepicker" value="" readonly="readonly">

            <span class="help-block m-b-none ">e.g.  05/10/2015</span>
        </div>
    </div>  
    <div class="hr-line-dashed"></div>
    <div class="form-group">            
        <label class="col-lg-3 control-label">Admission Date Time:</label>
        <div class="col-lg-5">
            <input type="radio" value="NOTSAME" name="date_time_status" class="date_time_status" checked="checked">            
            Individual
            &nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" value="SAME" class="date_time_status" name="date_time_status" >            
            Same
        </div>

    </div>
    <div class="hr-line-dashed"></div>   
    <div id="admission_data_time"> 
        <div class="form-group">            
            <label class="col-lg-3 control-label">Admission Date:</label>

            <div class="col-lg-2">

                <input type="text" name="tFromDateCommon" class="form-control datepicker  " value="">

                <span class="help-block m-b-none ">e.g.  05/10/2015</span>
            </div>
            <label class="col-lg-1 control-label">Time<span class="text-danger">*</span></label>
            <div class="col-lg-2">
                <div id="data_1">
                    <div class="input-group clockpicker" data-autoclose="true">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="timeFromCommon" class="form-control  " value="">
                    </div>
                </div>
                <span class="help-block m-b-none ">e.g.  9.30 am</span>
            </div>
            <label class="col-lg-1 control-label">To<span class="text-danger">*</span></label>
            <div class="col-lg-2">
                <div id="data_1">
                    <div class="input-group clockpicker" data-autoclose="true">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="timeToCommon" class="form-control  " value="">
                    </div>
                </div>
                <span class="help-block m-b-none ">e.g.  9.30 am</span>
            </div>
        </div>       
        <div class="hr-line-dashed"></div>   
    </div>     

    <div class="hr-line-dashed"></div>
    <table class="table" id="program_table">
       <thead>
           <th><input type="checkbox" id="checkAll"></th>
           <th>Program</th>
           <th>Date & Time</th>

       </thead>
       <tbody>
           <?php foreach ($program as $row) {?>
           <tr>
               <td><input value="<?php echo $row->PROGRAM_ID  ?>" type="checkbox" name="PROGRAM_ID[]" class="PROGRAM_ID"></td>
               <td><?php echo $row->PROGRAM_NAME  ?></td>

               <td>                
                <div class="form-group">            
                    <div class="col-lg-3">

                    <input type="text" name="tFromDate[]" class="form-control datepicker indtFromDate  " value="">

                    </div>
                    <label class="col-lg-1 control-label">Time</label>
                    <div class="col-lg-3">
                        <div id="data_1">
                            <div class="input-group clockpicker" data-autoclose="true">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" name="timeFrom[]" class="form-control indtimeFrom  " value="">
                            </div>
                        </div>

                    </div>
                    <label class="col-lg-1 control-label">To</label>
                    <div class="col-lg-3">
                        <div id="data_1">
                            <div class="input-group clockpicker" data-autoclose="true">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" name="timeTo[]" class="form-control indtimeTo  " value="">
                            </div>
                        </div>

                    </div>
                </div>  

            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<div class="form-group"><label class="col-lg-3 control-label">Active?</label>
    <div class="col-lg-7">

        <label class="control-label">
            <?php
            $data = array(
                'name' => 'status',
                'id' => 'status',
                'class' => 'checkBoxStatus',
                'value' => '',
                'checked' => '',
                );
            echo form_checkbox($data);
            ?>
        </label>
        <span class="help-block m-b-none">click on checkbox for active status.</span>
    </div>
</div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
        <!--<span class="modal_msg pull-left"></span>-->
        <input type="hidden" name="SESSION_ID" value="<?php echo $session->YSESSION_ID; ?>">

        <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createAdmissionInfo"
         data-type="list" value="Submit">

        <input type="reset" class="btn btn-default btn-sm" value="Reset">
        <span class="loadingImg"></span>
    </div>
</div>
</form>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/redactor/redactor.css"/>
<script src="<?php echo base_url(); ?>assets/redactor/redactor.min.js"></script>
<!-- Clock picker -->
<script src="<?php echo base_url(); ?>assets/js/plugins/clockpicker/clockpicker.js"></script>
<!-- Data picker -->
<script src="<?php echo base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/js/multiselect.min.js"></script>
<script type="text/javascript">
    $( function() {
        $( ".datepicker" ).datepicker({
          changeMonth: true,
          changeYear: true,
          dateFormat: 'dd-mm-yy' ,
          yearRange: "-50:+0",
          autoclose:true,
          startDate: '-0d',
      });
    } );
    $(document).ready(
        function () {
            $('.redactor').redactor();
        }
        );
    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked')) ? 1 : 0;
        $("#status").val(status);
    });
    $("#checkAll").click(function () {
     $('.PROGRAM_ID').prop('checked', this.checked);
 });
    $(document).on('click', '.date_time_status', function () {
        var date_time_status=$(this).val();
        if(date_time_status =='SAME'){
            $("#admission_data_time").show();
            $('#program_table td:nth-child(3)').hide();                
            $('#program_table td:nth-child(3),#program_table th:nth-child(3)').hide();// if your table has header(th), use this
           
        }else{
            $("#admission_data_time").hide();
            $('#program_table td:nth-child(3)').show();
            $('#program_table td:nth-child(3),#program_table th:nth-child(3)').show();
            
        }
    });
    $(document).ready(function () {
        $('.clockpicker').clockpicker();
        /*End Previous Date Disable in calendar*/
        $('#search').multiselect({
            search: {
                left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
                right: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
            }
        });

        $('#FACULTY_ID').change(function () {
            var faculty = $(this).val();
            var degree = $("#DEGREE_ID").val();
            if(degree ==''){
                alert("Please select degree");
                $(this).val("");
            }else{
             var dept_url = '<?php echo site_url('setup/programByFacultyDegree') ?>';
             $.ajax({
                type: "POST",
                url: dept_url,
                data: {faculty: faculty,degree: degree},
                success: function (data) {                     
                   $('#search').html(data);                    

               }
           });

         }

     });

        $('.clockpicker').clockpicker();
    });
</script>

