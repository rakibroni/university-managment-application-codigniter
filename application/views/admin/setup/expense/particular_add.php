<form class="form-horizontal frmContent" method="post">
    <div class="block-flat">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="txtParticularID" id="txtParticularID"
                   value="<?php echo $particular->P_PARTICULAR_ID; ?>"/>
        <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="row">
            <div class="col-lg-10">   
                <div class="form-group">
                    <label class="col-sm-4 control-label">Session <span style="color: red">*</span></label>

                    <div class="col-lg-8">
                        <?php
                        $sessionInfo = array('' => "Select Session");
                        foreach ($session as $row) {
                            if (!empty($row->SESSION_NAME)) {
                                $sessionInfo[$row->SESSION_ID] = $row->SESSION_NAME;
                            }
                        }
                        ?>
                        <?php echo form_dropdown("cmbSession", $sessionInfo, ($ac_type == 2) ? $particular->SESSION_ID : '', "class='form-control required' id='session'") ?>

                        <span class="validation"></span>
                        <span class="help-block m-b-none">Example:- Fall 2015-16.</span>
                    </div>
                </div>             
                <div class="form-group">
                    <label class="col-sm-4 control-label">Semester <span style="color: red">*</span></label>

                    <div class="col-sm-8">
                        <?php echo form_dropdown("cmbSemester", $semester, ($ac_type == 2) ? $particular->SEMESTER_ID : '', "class='form-control required' id='cmbSemester'") ?>
                        <span class="validation"></span>
                        <span class="help-block m-b-none">Example:- 1st Semester</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Faculty <span style="color: red">*</span></label>

                    <div class="col-sm-8">
                        <?php echo form_dropdown("cmbFaculty", $faculty, ($ac_type == 2) ? $particular->FACULTY_ID : '', "class='form-control required' id='faculty'") ?>
                        <span class="validation"></span>
                        <span class="help-block m-b-none">Example:- School of Science & Engg.</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Department <span style="color: red">*</span></label>

                    <div class="col-sm-8">
                        <select class="form-control required" name="department" id="department">
                            <?php if ($ac_type == 2) { ?>
                                <option
                                    value="<?php echo $particular->DEPT_ID; ?>"><?php echo $particular->DEPT_NAME; ?></option>
                            <?php } else { ?>
                                <option value="">Select Department</option>
                            <?php } ?>
                        </select>
                        <span class="validation"></span>
                        <span class="help-block m-b-none">Example:- Computer Science & Engg.</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Program <span style="color: red">*</span></label>

                    <div class="col-sm-8">
                        <select class="form-control required" name="program" id="program">
                            <?php if ($ac_type == 2) { ?>
                                <option
                                    value="<?php echo $particular->PROGRAM_ID; ?>"><?php echo $particular->PROGRAM_NAME; ?></option>
                            <?php } else { ?>
                                <option value="">Select Program</option>
                            <?php } ?>
                        </select>
                        <span class="validation"></span>
                        <span class="help-block m-b-none">Example:- B.Sc in Computer Science & Engg.</span>
                    </div>
                </div>               

            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <span id="chargeList"></span>
                <?php if ($ac_type == 2) { ?>
                    <table class="table table-bordered ">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll"></th>
                            <th>SN</th>
                            <th>Charge Name</th>
                            <th>Amount(BDT)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $sn = 1; ?>
                        <?php foreach ($chargeList as $row) { ?>
                            <tr>
                                <td><input type="checkbox" class="check" id="course_id" name="charge_id[]"
                                           value="<?php echo $row->CHARGE_ID; ?>"></td>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $row->CHARGE_NAME; ?></td>
                                <td><?php echo number_format($row->AMOUNT, 2); ?><input type="hidden"
                                                                                        name="charge_amount[]"
                                                                                        value="<?php echo $row->AMOUNT; ?>">
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>

                <?php } ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-9">
                <span class="modal_msg pull-left"></span>
                <?php if ($ac_type == 2) { ?>
                    <span type="button" class="btn btn-primary btn-sm ParSubmit" data-action="setup/updateParticular"
                          data-su-action="setup/particulerById">Update</span>
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm ParSubmit" data-action="setup/particularCharge"
                           data-su-action="setup/getParticular" data-type="list" value="submit">
                <?php } ?>
                <input type="reset" class="btn btn-default btn-sm" value="Reset">
                <span class="loadingImg"></span>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('change', '#faculty', function (event) {
            event.preventDefault();
            var selectedValue = $(this).val();
            var url = '<?php echo site_url('course/ajax_get_department') ?>';
            $.ajax({
                type: "POST",
                url: url,
                data: {selectedValue: selectedValue},
                dataType: 'html',
                success: function (data) {
                    $('#department').html(data);
                }
            });
        });
        $(document).on('change', '#department', function (event) {
            var selectedValue = $(this).val();
            var url = '<?php echo site_url('course/ajax_get_program') ?>';
            $.ajax({
                type: "POST",
                url: url,
                data: {selectedValue: selectedValue},
                dataType: 'html',
                success: function (data) {
                    $('#program').html(data);
                }
            });
        });
        $(document).on('change', '#program', function (event) {
            var faculty, dept, program,semester;
            faculty = $("#faculty").val();
            dept = $("#department").val();
            program = $("#program").val();
            semester = $("#cmbSemester").val();
            var url = '<?php echo site_url('setup/getChargeList') ?>';
            $.ajax({
                type: "POST",
                url: url,
                data: {faculty: faculty, dept: dept, program: program,semester:semester},
                dataType: 'html',
                beforeSend: function () {
                    $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $(".loadingImg").html("");
                    $('#chargeList').html(data);
                }
            });
        });
    });

</script>
<script type="text/javascript">
    $("#checkAll").click(function () {
        $(".check").prop('checked', $(this).prop('checked'));
    });
</script>

