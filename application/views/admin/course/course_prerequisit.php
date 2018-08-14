<form id="frmCourseOffer">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Course Assign</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-4  b-r">
                    <div class="form-group">                         
                        <label class="control-label">Faculty</label>
                        <div class="form-group">
                            <select class="form-control faculty_dropdown" name="FACULTY_ID" id="FACULTY_ID">
                                <option value="">--Select--</option>
                                <?php foreach ($faculty as $row) {?>
                                <option value="<?php echo $row->FACULTY_ID ?>"><?php echo $row->FACULTY_NAME ?></option>
                                <?php } ?>
                            </select>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Offer Type</label>
                        <div class="form-group">
                            <select class="form-control required" name="OfferType" id="OfferType">
                                <option value="">Select Type</option>
                            </select>
                            <span class="validation"></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 b-r">
                    <div class="form-group">
                        <label class="control-label">Department</label>
                        <div class="form-group">
                            <select class="dept_dropdown form-control required" name="department" id="DEPT_ID">

                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="control-label">Program</label>
                        <div class="form-group">
                            <select class="program_dropdown form-control required" name="program" id="PROGRAM_ID">

                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="listView"></div>
        <div class="ibox-content">
            <div id="courseList"></div>
            <span class="selected_course"></span>
        </div>
    </div>
</form>
<style>
    .bigModal {
        overflow-y: scroll;
    }
    .commonModal {
        overflow-y: scroll;
    }
</style>
<script type="text/javascript">
    $(document).ready(function () {


        $('.program_dropdown').change(function () {
            var url = '<?php echo site_url('course/ajax_get_offer_type') ?>';
            $.ajax({
                type: "POST",
                url: url,
                dataType: 'html',
                success: function (data) {
                    $('#OfferType').html(data);
                }
            });
        });
        $('#OfferType').change(function () {
            var faculty = '';
            var dept = '';
            var program = '';
            faculty = $("#FACULTY_ID").val();
            dept = $("#DEPT_ID").val();
            program = $("#PROGRAM_ID").val();
            offer_type = $(this).val();
            if (faculty == '' || dept == '' || program == '') {
                alert('Must be select !!');
            } else {
                var url = '<?php echo site_url('course/getCourseOffered') ?>';

                $.ajax({
                    type: "POST",
                    url: url,
                    data: {faculty: faculty, dept: dept, program: program, offer_type: offer_type},
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
        $(document).on("click", "#btnSubmit", function () {

            var is_valid = 0;
            // var empty_duration = 0;
            var empty_seq = 0;
            $('.required').each(function () {
                $(this).keyup(function () {
                    $(this).css("border", "1px solid #ccc");
                });
                if ($(this).val() == "") {
                    var label = $(this).parent().siblings("label").text();
                    //alert(label + " Is Empty");
                    $(this).siblings(".validation").html(label + " is required");
                    $(this).css("border", "1px solid red");
                    is_valid = 1;
                } else {
                    $(this).css("border", "1px solid #ccc");
                }
            });
            if (!$('#frmCourseOffer input[type="checkbox"]').is(':checked')) {
                alert("Please Select at least one course.");
                is_valid = 1;
            }
            $('#frmCourseOffer input[type="checkbox"]').each(function () {
                if ($(this).is(':checked')) {
                    var id = $(this).val();
                    var category = $("#course_id_" + id).val();
                    // var duraion = $("#course_du_" + id).val();
                    if (category == "") {
                        is_valid = 1;
                        empty_seq = 1;
                    }
                    /*if (duraion == "") {
                     is_valid = 1;
                     empty_duration = 1;
                 }*/
             }
         });
            if (empty_seq == 1) {
                alert("Please Select Category");
            }
            /*if (empty_duration == 1) {
             alert("Can't Empty duration");
         }*/
         if (is_valid == 0) {
            $(".bigModal").modal();
            var frmCourseOffer = $("#frmCourseOffer").serialize();
            $.ajax({
                type: "POST",
                url: '<?php echo site_url('course/courseOfferPreview') ?>',
                data: frmCourseOffer,
                beforeSend: function () {
                    $(".modal-title").html("Preview");
                    $(".modal-body").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $(".modal-body").html(data);
                }
            });
        }

    });

    });
    //$('.redactor').redactor();

    $(document).on("click", ".openOfferModal", function () {

        $(".bigModal").modal();
        var action_uri = $(this).attr("data-action");
        var title = $(this).attr("data-title");

        //var param_value = $('#frmCourseOffer').serialize();
        var faculty_value = $(this).attr("faculty");

        var dept_value = $(this).attr("dept");
        var program_value = $(this).attr("program");
        var offerType = $(this).attr("offerType");

        $.ajax({
            type: "post",
            url: "<?php echo site_url(); ?>/" + action_uri,
            data: {faculty: faculty_value, dept: dept_value, program: program_value, offerType: offerType},
            beforeSend: function () {
                $(".bigModal .modal-title").html(title);
                $(".bigModal .modal-body").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $(".bigModal .modal-body").html(data);
            }
        });
    });
    $(document).on("click", ".openPreModal", function () {
        $(".commonModal").modal();
        var action_uri = $(this).attr("data-action");
        var title = $(this).attr("title");
        var faculty = $(this).attr("faculty");
        var dept = $(this).attr("dept");
        var program = $(this).attr("program");
        var course = $(this).attr("course");
        $.ajax({
            type: "post",
            url: "<?php echo site_url(); ?>/" + action_uri,
            data: {faculty: faculty, dept: dept, program: program, course: course},
            beforeSend: function () {
                $(".commonModal .modal-title").html(title);
                $(".commonModal .modal-body").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $(".commonModal .modal-body").html(data);
            }
        });
    });
    $(document).on("click", "#btnSubmitAdd", function () {
        var is_valid = 0;
        //var empty_duration = 0;
        var empty_cat = 0;
        if (!$('#CourseOfferNewAdd input[type="checkbox"]').is(':checked')) {
            alert("Please Select at least one course.");
            return false;
        }
        else {
            $('#CourseOfferNewAdd input[type="checkbox"]').each(function () {
                if ($(this).is(':checked')) {
                    var id = $(this).val();
                    var category = $("#course_cat_" + id).val();
                    var duraion = $("#c_course_du_" + id).val();
                    if (category == "") {
                        is_valid = 1;
                        empty_cat = 1;
                    }
                    /* if (duraion == "") {
                     is_valid = 1;
                     empty_duration = 1;
                 }*/
             }
         });
            if (empty_cat == 1) {
                alert("Please Select Category");
            }
            /* if (empty_duration == 1) {
             alert("Can't Empty duration");
         }*/
         if (is_valid == 0) {
            if (confirm("Are You Sure?")) {
                $(".bigModel").modal();
                var frmCourseOffer = $("#CourseOfferNewAdd").serialize();
                $.ajax({
                    type: "POST",
                    url: '<?php echo site_url('course/courseOfferUpdate') ?>',
                    data: frmCourseOffer,
                    beforeSend: function () {
                        $(".modal-title").html("Success Message");
                        $(".modal-body").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                    },
                    success: function (data) {
                        $(".modal-body").html(data);
                    }
                });
            } else {
                return false;
            }
        }
    }
});

    $(document).on("click", ".deleteCourseOffered", function () {


        swal({
            title: "Are you sure?",
            text: "You want to delete this data permanently!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () { 

            var item_id = $(".deleteCourseOffered").attr("id");
            var data_field = $(".deleteCourseOffered").attr("data-field");
            var data_tbl = $(".deleteCourseOffered").attr("data-tbl");

            $.ajax({
                type: "post",
                url: "<?php echo site_url('course/deleteCourseOffered'); ?>/",
                data: {item_id: item_id, data_field: data_field, data_tbl: data_tbl},
                beforeSend: function () {
                    $("#courseLoad_" + item_id).html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {

                }
            })
            .done(function(data) {
                swal("Canceled!", "Your order was successfully canceled!", "success");
                $('#row_'+item_id).remove();
              })
             .error(function(data) {
                swal("Oops", "We couldn't connect to the server!", "error");
              });
        });


    });
</script>
<style>
    .commonCourseModal {
        z-index: 999999999 !important;
    }
    .commonModal {
        z-index: 999999 !important;
    }
    .bigModal {
        overflow-y: scroll;
    }
    .commonModal {
        overflow-y: scroll;
    }
</style>