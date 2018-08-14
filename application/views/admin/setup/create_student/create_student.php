<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Student login Information</h5>
                    <!--?php if ($previlages->CREATE == 1) { ?-->
                    <div class="ibox-tools">

                    </div>
                    <!--?php } ?-->
                </div>
                <div class="ibox-content">

                    <form class="form-horizontal" id="studnet_log_info" method="post">

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Roll No.<span style="color: red"> *</span></label>

                            <div class="col-lg-3">
                                <input type="text" id="" name="ROLL_NO" value="" class="form-control required"
                                       placeholder="Roll No." required>
                                <span id="duplicate" style="color: red;"></span>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="col-lg-3 control-label">Email<span style="color: red"> *</span></label>

                            <div class="col-lg-3 ">
                                <input type="email" id="EMAIL" name="EMAIL" value=""
                                       class="form-control  has-error required" placeholder="Email" required>
                                <span style="color: red" id="errMsg"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label"></label>
                            <input type="reset" value="Reset" class="btn btn-sm btn-default">
                            <input type="submit" value="Submit" id="create_student" class="btn btn-sm badge-primary">
                            <span id="cr_stu"></span>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#studnet_log_info').submit(function () {
            if (confirm('Are you sure want to save ?')) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>admin/saveStudent',
                    data: $(this).serialize(),
                    beforeSend: function () {

                        $('#cr_stu').html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                    },
                    success: function (data) {
                        if (data == 'Y') {
                            location.reload();
                        } else if (data == 'D') {
                            $("#duplicate").html("Already Exist");
                        }
                    }
                });
                return false;
            }
        });
        $('#EMAIL').on('blur', function () {
            var str = $(this).val();
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (!re.test(str)) {
                $("#errMsg").html('Please input valid email address');
            } else {
                $("#errMsg").html('');
            }

        });
    });
</script>
