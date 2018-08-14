<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Students Marks List</h5>
        <?php if ($previlages->CREATE == 1) { ?>
            <div class="ibox-tools">
                            <span title="Create Students Marks" class="btn btn-primary btn-xs pull-right openModal"
                                  data-action="Coe/marksForm"> Add New </span>
            </div>
        <?php } ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php $this->load->view("admin/coe/student_marks/marks_list"); ?>
        </div>
    </div>
</div>

<script>
    $(document).on("click", ".btnSubmit", function () {
        var is_valid = 0;
        var empty_marks = 0;
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
        if (!$('#marks input[type="checkbox"]').is(':checked')) {
            alert("Select at least one course !!.");
            is_valid = 1;
        }
        $('#marks input[type="checkbox"]').each(function () {
            if ($(this).is(':checked')) {
                var id = $(this).val();
                var marks = $("#marks_" + id).val();
                if (marks == "") {
                    is_valid = 1;
                    empty_marks = 1;
                }
            }
        });
        if (empty_marks == 1) {
            alert("Enter Marks !!");
        }
        if (is_valid == 0) {
            if (confirm("Are You Sure?")) {
                var frmContent = $(".frmContent").serialize();
                var action_uri = $(this).attr("data-action");
                var type = $(this).attr("data-type");
                var success_action_uri = $(this).attr("data-su-action");
                var ac_type = $(this).attr("");
                var param = "";
                if (type != "list") {
                    param = $(".rowID").val();
                }
                var sn = $("#loader_" + param).siblings("span").text();
                $.ajax({
                    type: "post",
                    data: frmContent,
                    url: "<?php echo site_url(); ?>/" + action_uri,
                    beforeSend: function () {
                        $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                    },
                    success: function (data) {
                        $(".loadingImg").html("");
                        $(".frmMsg").html(data);
                        $.ajax({
                            type: "post",
                            data: {param: param},
                            url: "<?php echo site_url(); ?>/" + success_action_uri,
                            beforeSend: function () {
                                if (type != "list") {
                                    $("#loader_" + param).removeClass("hidden").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' style='width:10px;' />").siblings("span").addClass("hidden");
                                }
                            },
                            success: function (data1) {
                                //$(".loadingImg").html("");
                                if (type == "list") {
                                    $(".contentArea").html(data1);
                                    $(".gridTable").dataTable();
                                } else if (type == "msg") {
                                    $('#rinci').html(response).modal();
                                } else {
                                    $("#loader_" + param).addClass("hidden").html("").siblings("span").removeClass("hidden");
                                    $("#row_" + param).html(data1);
                                    $("#loader_" + param).siblings("span").html(sn);
                                }
                            }
                        });
                    }
                });
            } else {
                return false;
            }
        } else {
            return false;
        }
    });
</script>