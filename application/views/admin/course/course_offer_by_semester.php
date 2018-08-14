

<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h3>Course Offer By Semester</h3>

    </div>
</div>
<div class="ibox-content">
    <form id="course_offer_form">
        <div class="col-lg-4"> 
            <div class="form-group">
                <?php
                if ($ac_type == 2) {

                    foreach ($course_offer as $row) {
                        $faculty_id = $row->FACULTY_ID;
                        $dept_id = $row->DEPT_ID;
                        $program_id = $row->PROGRAM_ID;
                        $semester_id = $row->LKP_NAME;
                    }
                }
                ?>
                <label class="control-label">Faculty</label>

                <div class="form-group">
                    <select class="form-control faculty_dropdown" name="FACULTY_ID" id="FACULTY_ID">
                        <option value="">--Select--</option>
                        <?php foreach ($faculty as $row): ?>
                            <option value="<?php echo $row->FACULTY_ID; ?>"><?php echo $row->FACULTY_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="validation"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">Department</label>

                <div class="form-group">
                    <select class="dept_dropdown form-control" name="DEPT_ID" id="DEPT_ID" >
                        <option value="">--Select--</option>                       
                    </select>
                    <span class="validation"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">Program</label>

                <div class="form-group">
                    <select class=" program_dropdown form-control" name="PROGRAM_ID" id="PROGRAM_ID">
                        <option value="">--Select--</option>                        
                    </select>
                    <span class="validation"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">Session</label>
                <div class="form-group">
                    <select class="form-control" name="YSESSION_ID" id="YSESSION_ID">
                        <option value="">--Select--</option>
                        <?php foreach ($offer_session as $row): ?>
                            <option value="<?php echo $row->YSESSION_ID; ?>"><?php echo $row->SESSION_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="validation"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">Offer Type</label>
                <div class="form-group">
                    <select class="form-control" name="OFFER_TYPE" id="OFFER_TYPE">
                        <option value="">--Select--</option>
                    </select>
                    <span class="validation"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">Same as any previous session : &nbsp;&nbsp;
                    <input checked="" value="YES" id="PREVIOUS_SESSION_STATUS" name="PREVIOUS_SESSION_STATUS" type="radio"> Yes &nbsp;&nbsp;
                    <input checked="checked" value="NO" id="PREVIOUS_SESSION_STATUS" name="PREVIOUS_SESSION_STATUS" type="radio"> No
                </label>
            </div>
            <div class="form-group" id="previous_session" style="display: none">
                <label class="control-label">Previous Session</label>
                <div class="form-group">
                    <select class="form-control" name="PREVIOUS_YSESSION" id="PREVIOUS_YSESSION">
                        <option value="">--Select--</option>
                        
                    </select>
                    <span class="validation"></span>
                </div>
            </div>
            <div class="form-group">
                <input type="button" style="display: none;" class="btn btn-warning" id="offer_same_as" value="Proceed">
                <input type="button" class="btn btn-primary pull-right" id="search_offer_template" value="Search">
            </div>
            
        </div>

        <div class="col-lg-8">
            <div class="ibox float-e-margins">
                <div class="listView"></div>
                <div class="ibox-content" id="courseList">
                    <span class="selected_course"></span>

                </div>

            </div>

        </div>
    </form>
    <div class="clearfix"></div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click','#PREVIOUS_SESSION_STATUS',function(){
            var status=$(this).val();
            if(status =='YES'){
                $("#previous_session").show();
                $("#offer_same_as").show();

                var url = '<?php echo site_url('course/sessionListAlreadyOffer') ?>';
                var program_id=$('#PROGRAM_ID').val();
                $.ajax({
                    type: "POST",
                    url: url,
                    data:{program_id:program_id},                
                    success: function (data) {
                        $('#PREVIOUS_YSESSION').html(data);
                    }
                });
            }else{
                $("#previous_session").hide();
                $("#offer_same_as").hide();
            }
        });
        //$("#course_offer_form input[type='radio']:checked").val();

        $('#search_offer_template').click(function () {
            var YSESSION_ID = $('#YSESSION_ID').val();
            var PREVIOUS_YSESSION = $('#PREVIOUS_YSESSION').val();
            var PROGRAM_ID = $('#PROGRAM_ID').val();
            var OFFER_TYPE = $("#OFFER_TYPE").val();
            var PREVIOUS_SESSION_STATUS =$('input[name=PREVIOUS_SESSION_STATUS]:checked').val();               
            //var flag = 1;
            if(PREVIOUS_SESSION_STATUS =='YES'){
             var  session=PREVIOUS_YSESSION;
         }else{
             var  session=YSESSION_ID;   
         }
         if(PREVIOUS_SESSION_STATUS){                
            var dept_url = '<?php echo site_url('course/getCourseByProgramFromCourseOffered') ?>';
            $.ajax({
                type: "POST",
                url: dept_url,
                data: {session: session, program_id: PROGRAM_ID, OfferType: OFFER_TYPE},
                dataType: 'html',
                beforeSend: function () {
                    $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $(".loadingImg").html("");
                    $('#courseList').html(data);
                }
            });
        }

    });

    $('#PROGRAM_ID').change(function () {
         
            var url = '<?php echo site_url('course/sessionListForCourseOffer') ?>';
            var program_id=$(this).val();
            $.ajax({
                type: "POST",
                url: url,
                data:{program_id:program_id},                
                success: function (data) {
                    $('#YSESSION_ID').html(data);
                }
            });
        });
   
    $('#YSESSION_ID').change(function () {
            var url = '<?php echo site_url('course/ajax_get_offer_type') ?>';             
            $.ajax({
                type: "POST",
                url: url,                
                dataType: 'html',
                success: function (data) {
                    $('#OFFER_TYPE').html(data);
                }
            });
        });
    });

    $(document).on("click", ".openOfferCourseModal", function () {
        $(".commonModal").modal();
        var title = $(this).attr("title");
        var action_uri = $(this).attr("data-action");
        var program_value = $(this).attr("data-program");
        var semester = $(this).attr("data-semester");
        var offerType = $(this).attr("offerType");
        var session = $(this).attr("session");

        $.ajax({
            type: "post",
            url: "<?php echo site_url(); ?>/" + action_uri,
            data: {program: program_value, semester: semester, offerType: offerType, session: session},
            beforeSend: function () {
                $(".commonModal .modal-title").html(title);
                $(".commonModal .modal-body").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $(".commonModal .modal-body").html(data);
            }
        });
    });
    $(document).on("click", ".semOfferedDeleteItem", function () {
        if (confirm("Are You Sure?")) {
            var program_value = $(this).attr("data-program");
            var semester = $(this).attr("data-semester");
            var offerType = $(this).attr("offerType");
            var item_id = $(this).attr("id");
            var data_field = $(this).attr("data-field");
            var data_tbl = $(this).attr("data-tbl");
            $.ajax({
                type: "post",
                url: '<?php echo site_url('Course/deleteItem'); ?>/',
                data: {item_id: item_id, data_field: data_field, data_tbl: data_tbl},
                success: function (data) {
                    if (data == "Y") {
                        $("#courseItem_" + item_id).parents('li').remove();
                    }
                }
            });
        } else {
            return false;
        }
    });
    $(document).on("click", "#offer_same_as", function () {
        if (confirm("Are You Sure?")) {
            var YSESSION_ID = $('#YSESSION_ID').val();
            var PREVIOUS_YSESSION = $('#PREVIOUS_YSESSION').val();
            var PROGRAM_ID = $('#PROGRAM_ID').val();
            var OFFER_TYPE = $("#OFFER_TYPE").val();            
            $.ajax({
                type: "POST",
                url: '<?php echo site_url('Course/previousSessionWiseCourseOffer'); ?>/',
                data: {YSESSION_ID: YSESSION_ID, PREVIOUS_YSESSION: PREVIOUS_YSESSION, PROGRAM_ID: PROGRAM_ID},
                success: function (data) {
                 if(data=='Y'){
                  var dept_url = '<?php echo site_url('course/getCourseByProgramFromCourseOffered') ?>';
                  $.ajax({
                    type: "POST",
                    url: dept_url,
                    data: {session: YSESSION_ID, program_id: PROGRAM_ID, OfferType: OFFER_TYPE},
                    dataType: 'html',
                    beforeSend: function () {
                        $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                    },
                    success: function (data) {
                        $(".loadingImg").html("");
                        $('#courseList').html(data);
                    }
                });
              }
          }
      });



        } else {
            return false;
        }
    });
</script>

