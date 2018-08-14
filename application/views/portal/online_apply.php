
<div class="col-md-12">
    <div class="widget-main">
        <div class="widget-inner shortcode-typo">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="course-post-title" style="color: #443266">Are you new Applicant ?</h4>
                            <hr class="hr">
                            <p class="text-justify">A student can apply either through our online application system or by collecting our
                                paper-based admission form from Admission Office. For online application students have
                                to go to the admission page in our website and click the link apply here Undergraduate
                                Program, Graduate Program, PHD Program. For customary application system, please follow
                                the steps mentioned below: </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="course-post-title" style="color: #443266">Academic programs</h4>
                            <hr class="hr">
                            <div class="" id="accordion">
                            <?php foreach ($degree as $row): ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="tabs_panels.html#<?php echo $row->DEGREE_ID ?>" aria-expanded="false" class="collapsed"><?php echo $row->DEGREE_NAME; ?></a>
                                            </h5>
                                        </div>
                                        <div id="<?php echo $row->DEGREE_ID ?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                        <?php 
                                            $degree_id=$row->DEGREE_ID;
                                            $programs=$this->utilities->currentOfferdProgramList($degree_id);
                                         ?>
                                            <div class="panel-body">
                                            <?php if(!empty($programs)): ?>
                                                <table class="table table-striped table-bordered table-hover gridTable">
                                                    <thead>
                                                    <tr>
                                                        <th>Program Name</th>
                                                        <th>Application</th>
                                                        <th>Exam Date</th>
                                                        <th>Exam Time</th>

                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <?php  foreach ($programs as $row) { ?>

                                                        <tr class="gradeX" id="row_<?php echo $row->PROGRAM_ID; ?>">
                                                            <td><b><?php echo $row->PROGRAM_NAME; ?></b></td>
                                                            <td>
                                                                <?php $dateStr = strtotime( $row->REG_PRG_SDT ); ?>
                                                                <?php echo date("d-M-Y", $dateStr ); ?>
                                                                <b><?php echo 'to'; ?></b>
                                                                <?php $dateStr = strtotime( $row->REG_PRG_EDT ); ?>
                                                                <?php echo date("d-M-Y", $dateStr ); ?>
                                                            </td>
                                                            <td>
                                                                <?php $dateStr = strtotime( $row->PRG_EXM_SDT ); ?>
                                                                <?php echo date("d-M-Y", $dateStr ); ?>
                                                                 
                                                            </td>
                                                            <td>
                                                                <?php $dateStr = strtotime( $row->PRG_EXM_STM ); ?>
                                                                <?php echo date("H:i:s", $dateStr ); ?>
                                                                <b><?php echo 'to'; ?></b>
                                                                <?php $dateStr = strtotime( $row->PRG_EXM_ETM ); ?>
                                                                <?php echo date("H:i:s", $dateStr ); ?>
                                                            </td>

                                                            <!-- Set Local Time -->
                                                            <?php date_default_timezone_set("Asia/Dhaka");?>
                                                            <?php $date_str = strtotime($row->REG_PRG_EDT); ?>
                                                            <?php $reg_end_date = date('Y-m-d', $date_str)?>
                                                            <?php $today = date("Y-m-d"); ?>

                                                            <?php if ($today <= $reg_end_date) : ?>
                                                            <td><a class="label label-success" data-type="edit" href="<?php echo site_url() . "/Portal/signUpForm/" . $row->PROGRAM_ID.'/'.$row->ADM_PRG_ID?>">Apply Now</a>
                                                            </td>
                                                            <?php else : ?>
                                                            <td><a id="over" class="label label-default" data-type="" href="#">Date Over</a>
                                                            </td>
                                                            <?php 
                                                            endif; ?>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                                <?php   else : echo "Programs Not Offered";
                                                     endif; ?>
                                            </div>
                                        </div>
                                    </div>
                            <?php endforeach;   ?>
                                   
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="course-post-title" style="color: #443266">Admission Instruction</h4>
                            <hr class="hr">
                            <p class="text-justify">A student must fulfill any of the following requirements for getting admission to an
                                undergraduate programme at the KYAU.The student must have at least 2nd division or a
                                minimum GPA of 2.5 or an equivalent grade separately in SSC and HSC or equivalent public
                                examinations. However, if a candidate has a minimum GPA of 2.0 in either of these
                                examinations, in that case, his/her cumulative GPA of the two examinations must be at
                                least 6.0.
                                A student should have at least 5 subjects in O-level and 2 subjects in A-level. Out of 7
                                subjects, s/he should have grade ‘B’ in 4 subjects and grade ’C’ in 3 subjects to the
                                minimum. </p>
                        </div>
                    </div>

                </div>
               
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Course Details</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '.formSubmit', function () {
        var isValid = 0;
        sEmail = $('#EMAIL').val();
        $('.required').each(function () {
            $(this).keyup(function () {
                $(this).css("border", "1px solid #ccc");
            });
            if ($(this).val() == "") {
                var label = $(this).parent().siblings("label").text();
                //alert(label + " Is Empty");
                $(this).siblings(".validation").html(label + " is required");
                $(this).css("border", "1px solid red");
                isValid = 1;
                //return false;
            } else {
                $(this).siblings(".validation").html("");
                $(this).css("border", "1px solid #ccc");
            }
        });

        if (isValid == 0) {
            if (validateEmail(sEmail)) {
                password = $("#PASSWORD").val();
                var action_uri = $(this).attr("data-action");
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url(); ?>/" + action_uri,
                    data: {Email: sEmail, password: password},
                    dataType: 'html',
                    beforeSend: function () {
                        $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                    },
                    success: function (data) {
                        $(".loadingImg").html("");
                        if(data == "Email and password don't match."){
                            $(".msg").html(data);
                        }else{
                            window.location = "<?php echo site_url(); ?>/Applicant/online_registration";
                        }
                    }
                });
            } else {
                alert('Invalid Email Address');
            }
        }

    });
    function validateEmail(sEmail) {
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (filter.test(sEmail)) {
            return true;
        }
        else {
            return false;
        }
    }
</script>