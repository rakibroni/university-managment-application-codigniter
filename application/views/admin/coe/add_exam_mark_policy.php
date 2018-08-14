<style>
    .select2-container {
        z-index: 999999;
    }

</style>

<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Exam Mark Distribution </h5>

        <div class="ibox-tools">

        </div>

    </div>
    <div class="ibox-content">
        <form id="exam_policy_form">
            <div class="row">
                <div class="col-md-6">
                    <div class="table-responsive contentArea">

                        <div style="margin-bottom: 20px">
                            <?php $this->load->view("common/faculty_dept_program"); ?>
                        </div>

                    </div>
                    <input type="button" name="" value="Submit" id="ex_policy_btn"
                           class="btn btn-sm btn-primary">
                </div>
                <div class="col-md-6">
                    <div id="dis_mark_tbl"></div>


                </div>
            </div>
        </form>

    </div>

</div>

<script src="<?php echo base_url(); ?>assets/js/multiselect.min.js"></script>

<script>
    $(document).ready(function () {
        $('#multiselect').multiselect();
        $("#ex_policy_btn").on('click', function (e) {
            e.preventDefault();
            if (confirm("Are You Sure?")) {
            var count_checked = $("[name='MARKS_TYPE_ID[]']:checked").length; // count the checked rows
            if (count_checked == 0) {
                alert("Please select any marks type to insert .");
                return false;
            } else {
                var form_data = $("#exam_policy_form");
                var tot_marks = 0;
                $(".marks_percentage").filter(':visible').each(function ()  {
                    tot_marks += parseInt($(this).val()) || 0;
                });
                if (tot_marks == 100) {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url()?>coe/saveDistributeMarks',
                        data: form_data.serialize(),
                        success: function (data) {
                            if (data == 'Y') {
                                alert("Insert data successfully");
                            } else if (data == 'D') {
                                alert("This program already exits");
                            }
                        }
                    });

                } else {
                    alert("Total marks percentage less than or greater than 100");
                }
            }

            }
        });

        $("#PROGRAM_ID").on('change', function () {
            var PROGRAM_ID = $(this).val();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>coe/distributeMarksPolicy',
                data: {PROGRAM_ID: PROGRAM_ID},
                success: function (data) {
                    $('#dis_mark_tbl').html(data);
                }
            });
        });

    });
</script>
