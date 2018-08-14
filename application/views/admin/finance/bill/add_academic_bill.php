<style type="text/css">
    hr {
        margin-bottom: 0px !important;
        margin-top: 10px !important;
    }

    .alert {
        border: 1px solid transparent !important;
        border-radius: 4px !important;
        margin-bottom: 4px !important;
        padding: 6px !important;
    }
</style>
<div class="wrapper wrapper-content">

    <?php $this->load->view("student/common/student_common_js"); ?>

    <form id="existing_to_student_form" method="post">
        <div class="ibox float-e-margins">

            <div class="ibox-title">
                <h5>Academic Bill Generate</h5>
            </div>
            <div class="ibox-content">
                <div class="col-md-3">
                    <div class="form-group">
                        <select class="form-control" name="SESSION_ID" id="SESSION_ID">
                            <option value="">--Select Academic Session --</option>
                            <?php
                            foreach ($ins_session as $row):
                                ?>
                                <option value="<?php echo $row->YSESSION_ID ?>"><?php echo $row->SESSION_NAME ?></option>
                            <?php   endforeach;  ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <select class="form-control" name="PROGRAM_ID" id="PROGRAM_ID">
                            <option value="">--Select Program--</option>
                            <?php  foreach ($program as $row):  ?>
                                <option  value="<?php echo $row->PROGRAM_ID ?>" ><?php echo $row->PROGRAM_NAME ?></option>
                            <?php  endforeach;?>
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group bb">
                        <input type="button" class="btn btn-primary btn-sm my_submit" id="academic_bill_generate_btn"
                               data-param="" value="Search"
                               data-action="finance/academicBillingListOfStudent"
                               data-su-action="" data-view-div="acd_bill_view">
                    </div>
                </div>
                <div class="clearfix"></div>


                <div id="acd_bill_view">


                </div>

            </div>


            </form>
</div>

</div>
</form>
</div>


<script type="text/javascript">
    $(document).ready(function(){

        $("#existing_to_student_form").validate({
            rules: {

                ADA_SESSION_ID: {required: true},
                INS_SESSION_ID: {required: true},
                PROGRAM_ID: {required: true},
                BATCH_ID: {required: true},
                SECTION_ID: {required: true},
                "STUDENT_ID[]": {required: true},

            },
            messages: {
                ADA_SESSION_ID: "Required",
                INS_SESSION_ID: "Required",
                PROGRAM_ID: "Required",
                BATCH_ID: "Required",
                SECTION_ID: "Required",
                "STUDENT_ID[]": "Required one",

            }

        });



        $("#checkAll").click(function () {
            $('.STUDENT_ID').prop('checked', this.checked);
        });
    });

</script>

<script>
    $(document).on('click', '.my_submit', function () {

        var session_id = $('#SESSION_ID').val();
        var program_id = $('#PROGRAM_ID').val();

        if(session_id=='' || program_id=='')
        {
            alert("Please, fill up the required fields!");
        }
        else {
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url() ?>/finance/academicBillingListOfStudent',
                data: {SESSION_ID: session_id, PROGRAM_ID: program_id},
                beforeSend: function () {

                    $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $(".loadingImg").html("");
                    $('#acd_bill_view').html(data);
                }
            });
        }


    });

</script>

