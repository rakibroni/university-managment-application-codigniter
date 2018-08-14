<!-- <msdropdown> -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/msdropdown/css/msdropdown/dd.css"/>
<script src="<?php echo base_url() ?>assets/msdropdown/js/msdropdown/jquery.dd.js"></script>
<link href="<?php echo base_url(); ?>assets/css/plugins/chosen/chosen.css" rel="stylesheet">

<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Add committee member</h5>

        <div class="ibox-tools"></div>
    </div>
    <div class="ibox-content">
        <div class="col-md-6">
            <form class="form-horizontal" id="comMemForm" method="post">

                <span class="frmMsg"></span>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Committee Type Name<span style="color: red"> *</span></label>

                    <div class="col-lg-9">
                        <select class="form-control select2Dropdown" name="COM_ID" id="COM_ID">
                            <option value="">-Select-</option>
                            <?php foreach ($committee as $row): ?>
                                <option
                                    value="<?php echo $row->COM_ID ?>" <?php if (!empty($com_member->COM_ID)) echo ($com_member->COM_ID == $row->COM_ID) ? "selected" : ""; ?>><?php echo $row->COM_TITLE ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Committee Designation<span
                            style="color: red"> *</span></label>

                    <div class="col-lg-9">
                        <select class="form-control select2Dropdown" name="DESIGNATION_ID" id="">
                            <option value="">-Select-</option>
                            <?php foreach ($designations as $row): ?>
                                <option
                                    value="<?php echo $row->DESIGNATION_ID ?>" <?php if (!empty($com_member->DESIGNATION_ID)) echo ($com_member->DESIGNATION_ID == $row->DESIGNATION_ID) ? "selected" : ""; ?>><?php echo $row->DESIGNATION ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Teacher <span style="color: red"> *</span></label>

                    <div class="col-lg-9">
                        <select name="USER_ID" ID="USER_ID" style="width:250px;">
                            <option value="" data-description="Choos your teacher">Teacher</option>

                            <?php
                            foreach ($user as $row):
                                $tr_pic = 'assets/img/default.png';
                                if (!empty($row->USER_IMG)) $tr_pic = 'upload/faculty_teacher/' . $row->USER_IMG;
                                ?>
                                <option data-image="<?php echo base_url($tr_pic) ?>"
                                        data-description="E:<?php echo $row->EMAIL ?>"
                                        value="<?php echo $row->USER_ID ?>">
                                    <?php echo $row->FULL_NAME ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Responsibilities <span style="color: red"> *</span></label>

                    <div class="col-lg-9">
                        <textarea type="text" id="EX_COM_DESC" name="EX_COM_DESC" class="form-control required"
                                  placeholder="Description"><?php echo ($ac_type == 2) ? $com_member->EX_COM_DESC : '' ?></textarea>
                    </div>
                </div>

                <div class="hr-line-dashed"></div>

                <div class="form-group"><label class="col-lg-3 control-label">Active?</label>

                    <div class="col-lg-7">
                        <?php
                        $ACTIVE_STATUS = ($ac_type == 2) ? $com_member->ACTIVE_STATUS : '';
                        $checked = ($ac_type == 2) ? (($com_member->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
                        ?>
                        <label class="control-label">
                            <?php
                            $data = array(
                                'name' => 'status',
                                'id' => 'status',
                                'class' => 'checkBoxStatus',
                                'value' => $ACTIVE_STATUS,
                                'checked' => $checked,
                            );
                            echo form_checkbox($data);
                            ?>
                        </label>
                        <span class="help-block m-b-none">Example click checkbox .</span>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-10">
                        <span class="modal_msg pull-left"></span>
                        <input type="button" id="comMemBtn" class="btn btn-primary btn-sm" value="submit">
                        <input type="reset" class="btn btn-default btn-sm" value="Reset">
                        <span class="loadingImg"></span>
                    </div>
                </div>
            </form>

        </div>
        <div class="col-md-6">
            <div id="member_list">

            </div>
        </div>
        <div class="clearfix"></div>

    </div>

</div>

<script src="<?php echo base_url(); ?>assets/js/plugins/chosen/chosen.jquery.js"></script>
<script>
    var config = {
        '.chosen-select': {},
        '.chosen-select-deselect': {allow_single_deselect: true},
        '.chosen-select-no-single': {disable_search_threshold: 10},
        '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
        '.chosen-select-width': {width: "95%"}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });
    $(document).on('change', '#COM_ID', function () {
        var COM_ID = $(this).val();

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>setup/memberListByComId',
            data: {COM_ID: COM_ID},
            success: function (data) {
                $("#member_list").html(data);
            }
        });
    });
    $("#comMemBtn").on('click', function (e) {
        e.preventDefault();
        if (confirm("Are You Sure?")) {
            var form = $("#comMemForm").serialize();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url();?>setup/createComMem',
                data: form,
                success: function (data) {
                    if (data == 'Y') {
                        alert("Member Inserted Successfully");
                    } else {
                        alert("Member already Exits");
                    }
                }
            });
        }
    });


    //////////////////

    $(document).ready(function (e) {
        $("#USER_ID").msDropdown({roundedBorder: false});
    });


</script>