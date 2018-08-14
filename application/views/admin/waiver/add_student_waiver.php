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
                <h5>Student Waiver Genarate</h5>
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
                        <input type="button" class="btn btn-primary btn-sm my_submit"
                         value="Search">
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
                url: '<?php echo site_url() ?>/admin/waiverListOfStudent',
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

