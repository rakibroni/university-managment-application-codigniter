<form id="frmContent" method="post">

    <div class="">
        <div class="ibox-content">
            <div class="col-md-4">
                <label class="control-label">Registration Period<span class="text-danger">*</span></label>

                <div class="col-md-12">
                    <select class=" form-control" name="REG_PERIOD_ID" id="REG_PERIOD_ID"
                            data-tags="true" data-placeholder="Select Reg. Period" data-allow-clear="true">
                        <option value="">Select Registration Period</option>

                        <?php   foreach ($reg_periods as $row): ?>
                            <option
                                value="<?php echo $row->REG_PERIOD_ID ?>"><?php echo $row->RP_TITLE ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <span class="validation"></span>
            </div>
            <?php $this->load->view("common/faculty_dept_program"); ?>
            <?php //$this->load->view("common/semester_session"); ?>
            <div class="col-md-12">
                <div class="form-group" style="padding-top: 5px;">
                    <span class="modal_msg pull-left"></span>
                    <input type="button" class="btn btn-primary btn-sm formOffer" value="submit">
                    <input type="reset" class="btn btn-default btn-sm" value="Reset">
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>All Student Registration List</h5>
            </div>
            <div class="ibox-content">
                <div class="table-responsive contentArea" id="academicList">
                    <?php $this->load->view("academic/academic_list"); ?>
                </div>
            </div>
        </div>
    </div>

</form>

<script type="text/javascript">
    $(document).ready(function () {
        $('.gridTable').dataTable( {
          "columns": [
            null,
            null,
            null,
            null,
            null,
            null,
            { "width": "20%" }
          ]
        } );
        $(document).on("click", ".formOffer", function () {
            var is_valid = 0;
            var reg_period = $("#REG_PERIOD_ID").val();
            var session = $("#SESSION_ID").val();
            var semester = $("#SEMESTER_ID").val();
            var faculty = $("#FACULTY_ID").val();
            var dept = $("#DEPT_ID").val();
            var program = $("#PROGRAM_ID").val();
            if (reg_period == '') {
                if (reg_period == '') {
                    alert('Registration Period Select !!');
                } 
            } else {
                var frmContent = $("#frmContent").serialize();
                var action_url = '<?php echo site_url('academic/newRegistration') ?>';
                $.ajax({
                    type: "POST",
                    url: action_url,
                    data: frmContent,
                    dataType: 'html',
                    beforeSend: function () {
                        $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                    },
                    success: function (data) {

                        $(".loadingImg").html("");
                        $('#academicList').html(data);
                    }
                });
            }
        });

        $(document).on("click", ".formOfferapprov", function () {
            if (!$('#frmContent input[type="checkbox"]').is(':checked')) {
                alert("Please Select at least one course.");
                return false;
            } else {
                if (confirm("Are You Sure?")) {
                    var data = $("#frmContent").serialize();
                    var action_url = '<?php echo site_url('academic/approveRegistration') ?>';
                    $.ajax({
                        type: "POST",
                        url: action_url,
                        data: data,
                        beforeSend: function () {
                            $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                        },
                        success: function (data) {
                            if (data == "app") {
                                alert("Program wise particulars chargs can't setup. Please first particulars setup");
                            } else {
                                $(".loadingImg").html("");
                                $('#approve_success').html(data);
                            }
                        }
                    });
                }
            }
        });
    });


</script>