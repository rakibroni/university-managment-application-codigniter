<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/jquery-ui.datepicker.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/keyboard/keyboard.css" rel="stylesheet">

<style>
    .flexy {
        display: block;
        width: 90%;
        border: 1px solid #eee;
        max-height: 200px;
        overflow: auto;
    }

    .avatar-zone {
        width: 140px;
        height: 200px;

    }

    .overlay-layer {
        width: 180px;
        height: 40px;
        position: absolute;
        margin-top: -40px;
        opacity: 0.5;
        background-color: #000000;
        z-index: 0;
        font-size: 15px;
        color: #FFFFFF;
        text-align: center;
        line-height: 40px;

    }

    .avatar-zone-sig {
        width: 140px;
        height: 92px;

    }

    .overlay-layer-sig {
        width: 180px;
        height: 40px;
        position: absolute;
        margin-top: -40px;
        opacity: 0.5;
        background-color: #000000;
        z-index: 0;
        font-size: 15px;
        color: #FFFFFF;
        text-align: center;
        line-height: 40px;
    }

    .upload_btn {
        position: absolute;
        width: 200px;
        height: 40px;
        margin-top: -40px;
        z-index: 10;
        opacity: 0;
    }

    .red {
        color: red
    }

    .pointer2 {
        cursor: pointer;
    }

    .div-background {
        background-color: #D9E0E7;
        padding: 20px;
        border-radius: 10px
    }

    .toggle-div {
        display: none;
        background-color: #FCF8E3;
        padding: 10px;
        border-radius: 10px;
    }

    .toggle-div-course {
        display: none;
        background-color: #FCF8E3;
        padding: 10px;
        border-radius: 10px;
        width: 400px;
    }

    .toggle-div1 {
        background-color: #FCF8E3;
        padding: 10px;
        border-radius: 10px;
    }
</style>
<link href="<?php echo base_url(); ?>assets/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">

<div class="ibox-title">
    <h5>Postal Address</h5>
    <?php // if ($applicant_info->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS != 1) : ?>
    <div class="ibox-tools">
        <span data-action="applicant/applicantAddressInfo" id="update_address_cancel_btn"
              class="btn btn-success btn-xs pull-right"
              applicant-data-id="<?php echo $local_present_adddress->APPLICANT_ID; ?>" role="button"><i
                    class="fa fa-mail-reply"></i> Back</span>
    </div>
    <?php // endif; ?>
</div>

<div class="ibox-content">
    <form id="applicant_address_form" class="form-horizontal fContent" method="post">
        <div class="div-background">
            <div id="present_address" class="toggle-div1">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Present Address <span class="red">*</span></label>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label">Division</label>

                        <div class="col-md-5">
                            <select name="DIVISION_ID" id="DIVISION_ID" class="form-control">
                                <option value="">-Select-</option>
                                <?php foreach ($division as $row): ?>
                                    <option value="<?php echo $row->DIVISION_ID ?>" <?php echo ($local_present_adddress->DIVISION_ID == $row->DIVISION_ID) ? 'selected' : set_value('DIVISION_ID') ?>><?php echo $row->DIVISION_ENAME ?></option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2" data-content="Select division name"
                               data-placement="right" data-toggle="popover" data-container="body"
                               data-original-title="" title="Help"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label">District</label>

                        <div class="col-md-5">
                            <select name="DISTRICT_ID" id="DISTRICT_ID" class="form-control">
                                <option value="">-Select-</option>
                                <?php foreach ($district as $row): ?>
                                    <option value="<?php echo $row->DISTRICT_ID ?>" <?php echo ($local_present_adddress->DISTRICT_ID == $row->DISTRICT_ID) ? 'selected' : set_value('DISTRICT_ID') ?>><?php echo $row->DISTRICT_ENAME ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2" data-content="Select district name"
                               data-placement="right" data-toggle="popover" data-container="body"
                               data-original-title="" title="Help"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label">Upazila/Thana</label>

                        <div class="col-md-5">
                            <select name="THANA_ID" id="THANA_ID" class="form-control">
                                <option value="">-Select-</option>
                                <?php foreach ($thana as $row): ?>
                                    <option value="<?php echo $row->THANA_ID ?>" <?php echo ($local_present_adddress->THANA_ID == $row->THANA_ID) ? 'selected' : set_value('THANA_ID') ?>><?php echo $row->THANA_ENAME ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2" data-content="Select upazila or thana name"
                               data-placement="right" data-toggle="popover" data-container="body"
                               data-original-title="" title="Help"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label">Police Station</label>

                        <div class="col-md-5">
                            <select name="POLICE_STATION_ID" id="POLICE_STATION_ID" class="form-control">
                                <option value="">-Select-</option>
                                <?php foreach ($police_station as $row): ?>
                                    <option value="<?php echo $row->POLICE_STATION_ID ?>" <?php echo ($local_present_adddress->POLICE_STATION_ID == $row->POLICE_STATION_ID) ? 'selected' : set_value('POLICE_STATION_ID') ?>><?php echo $row->PS_ENAME ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2" data-content="Select police station"
                               data-placement="right" data-toggle="popover" data-container="body"
                               data-original-title="" title="Help"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label">Union/Ward No.</label>

                        <div class="col-md-5">
                            <select name="UNION_ID" id="UNION_ID" class="form-control">
                                <option value="">-Select-</option>
                                <?php foreach ($ward_no as $row): ?>
                                    <option value="<?php echo $row->UNION_ID ?>" <?php echo ($local_present_adddress->UNION_ID == $row->UNION_ID) ? 'selected' : set_value('UNION_ID') ?>><?php echo $row->UNION_NAME ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2" data-content="Select ward or union"
                               data-placement="right" data-toggle="popover" data-container="body"
                               data-original-title="" title="Help"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label">Post office</label>

                        <div class="col-md-5">
                            <select name="POST_OFFICE_ID" id="POST_OFFICE_ID" class="form-control">
                                <option value="">-Select-</option>
                                <?php foreach ($post_office as $row): ?>
                                    <option value="<?php echo $row->POST_OFFICE_ID ?>" <?php echo ($local_present_adddress->POST_OFFICE_ID == $row->POST_OFFICE_ID) ? 'selected' : set_value('POST_OFFICE_ID') ?>><?php echo $row->POST_OFFICE_ENAME ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2" data-content="Select post office"
                               data-placement="right" data-toggle="popover" data-container="body"
                               data-original-title="" title="Help"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label">Vill/House no/Road no</label>

                        <div class="col-md-5">
                            <input type="text" name="VILLAGE" id="VILLAGE"
                                   value="<?php echo $local_present_adddress->VILLAGE_WARD; ?>" class="form-control"/>
                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2"
                               data-content="Enter your village,house or road no here" data-placement="right"
                               data-toggle="popover" data-container="body" data-original-title=""
                               title="Help"></i>
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Permanent Address : <span class="red">*</span></label>
                        <div class="col-md-8">
                            Same as present address?
                            <input type="radio" name="same_as_present" class="same_as_present"
                                   value="YES" <?php echo ($local_present_adddress->SAS_PSORPR == 'PS') ? "checked" : ""; ?> >&nbsp;
                            Yes &nbsp;
                            <input type="radio" name="same_as_present" class="same_as_present"
                                   value="NO" <?php echo ($local_present_adddress->SAS_PSORPR == '') ? "checked" : ""; ?> >&nbsp;
                            No &nbsp;

                        </div>
                    </div>


                    <!--Permanent Address-->

                    <?php if ($local_present_adddress->SAS_PSORPR == '') : ?>

                        <div id="permanent_address">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Division</label>

                                <div class="col-md-5">
                                    <select name="P_DIVISION_ID" id="P_DIVISION_ID" class="form-control ">
                                        <option value="">-Select-</option>
                                        <?php foreach ($division as $row): ?>
                                            <option value="<?php echo $row->DIVISION_ID ?>" <?php echo ($local_permanent_adddress->DIVISION_ID == $row->DIVISION_ID) ? 'selected' : set_value('DIVISION_ID') ?>><?php echo $row->DIVISION_ENAME ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <i class="fa fa-info-circle pointer2" data-content="Select division name"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label">District</label>

                                <div class="col-md-5">
                                    <select name="P_DISTRICT_ID" id="P_DISTRICT_ID" class="form-control ">
                                        <option value="">-Select-</option>
                                        <?php foreach ($district as $row): ?>
                                            <option value="<?php echo $row->DISTRICT_ID ?>" <?php echo ($local_permanent_adddress->DISTRICT_ID == $row->DISTRICT_ID) ? 'selected' : set_value('DISTRICT_ID') ?>><?php echo $row->DISTRICT_ENAME ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <i class="fa fa-info-circle pointer2" data-content="Select district name"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label">Upazila/Thana</label>

                                <div class="col-md-5">
                                    <select name="P_THANA_ID" id="P_THANA_ID" class="form-control ">
                                        <option value="">-Select-</option>
                                        <?php foreach ($thana as $row): ?>
                                            <option value="<?php echo $row->THANA_ID ?>" <?php echo ($local_permanent_adddress->THANA_ID == $row->THANA_ID) ? 'selected' : set_value('THANA_ID') ?>><?php echo $row->THANA_ENAME ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <i class="fa fa-info-circle pointer2" data-content="Select upazila or thana name"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label">Police Station</label>

                                <div class="col-md-5">
                                    <select name="P_POLICE_STATION_ID" id="P_POLICE_STATION_ID"
                                            class="form-control ">
                                        <option value="">-Select-</option>
                                        <?php foreach ($police_station as $row): ?>
                                            <option value="<?php echo $row->POLICE_STATION_ID ?>" <?php echo ($local_permanent_adddress->POLICE_STATION_ID == $row->POLICE_STATION_ID) ? 'selected' : set_value('POLICE_STATION_ID') ?>><?php echo $row->PS_ENAME ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <i class="fa fa-info-circle pointer2" data-content="Select police station"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label">Union/Ward No.</label>

                                <div class="col-md-5">
                                    <select name="P_UNION_ID" id="P_UNION_ID" class="form-control ">
                                        <option value="">-Select-</option>
                                        <?php foreach ($ward_no as $row): ?>
                                            <option value="<?php echo $row->UNION_ID ?>" <?php echo ($local_permanent_adddress->UNION_ID == $row->UNION_ID) ? 'selected' : set_value('UNION_ID') ?>><?php echo $row->UNION_NAME ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <i class="fa fa-info-circle pointer2" data-content="Select ward or union"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label">Post office</label>

                                <div class="col-md-5">
                                    <select name="P_POST_OFFICE_ID" id="P_POST_OFFICE_ID" class="form-control">
                                        <option value="">-Select-</option>
                                        <?php foreach ($post_office as $row): ?>
                                            <option value="<?php echo $row->POST_OFFICE_ID ?>" <?php echo ($local_permanent_adddress->POST_OFFICE_ID == $row->POST_OFFICE_ID) ? 'selected' : set_value('POST_OFFICE_ID') ?>><?php echo $row->POST_OFFICE_ENAME ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <i class="fa fa-info-circle pointer2" data-content="Select post office"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label">Vill/House no/Road no</label>

                                <div class="col-md-5">
                                    <input type="text" name="P_VILLAGE" id="P_VILLAGE"
                                           value="<?php echo $local_permanent_adddress->VILLAGE_WARD; ?>"
                                           class="form-control "/>
                                </div>
                                <div class="col-md-2">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Enter your village,house or road no here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                        </div>

                    <?php elseif ($local_present_adddress->SAS_PSORPR == 'PS') : ?>

                        <div id="permanent_address">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Division</label>

                                <div class="col-md-5">
                                    <select name="P_DIVISION_ID" id="P_DIVISION_ID" class="form-control ">
                                        <option value="">-Select-</option>
                                        <?php foreach ($division as $row): ?>
                                            <option value="<?php echo $row->DIVISION_ID ?>" <?php echo ($local_present_adddress->DIVISION_ID == $row->DIVISION_ID) ? 'selected' : set_value('DIVISION_ID') ?>><?php echo $row->DIVISION_ENAME ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <i class="fa fa-info-circle pointer2" data-content="Select division name"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label">District</label>

                                <div class="col-md-5">
                                    <select name="P_DISTRICT_ID" id="P_DISTRICT_ID" class="form-control ">
                                        <option value="">-Select-</option>
                                        <?php foreach ($district as $row): ?>
                                            <option value="<?php echo $row->DISTRICT_ID ?>" <?php echo ($local_present_adddress->DISTRICT_ID == $row->DISTRICT_ID) ? 'selected' : set_value('DISTRICT_ID') ?>><?php echo $row->DISTRICT_ENAME ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <i class="fa fa-info-circle pointer2" data-content="Select district name"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label">Upazila/Thana</label>

                                <div class="col-md-5">
                                    <select name="P_THANA_ID" id="P_THANA_ID" class="form-control ">
                                        <option value="">-Select-</option>
                                        <?php foreach ($thana as $row): ?>
                                            <option value="<?php echo $row->THANA_ID ?>" <?php echo ($local_present_adddress->THANA_ID == $row->THANA_ID) ? 'selected' : set_value('THANA_ID') ?>><?php echo $row->THANA_ENAME ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <i class="fa fa-info-circle pointer2" data-content="Select upazila or thana name"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label">Police Station</label>

                                <div class="col-md-5">
                                    <select name="P_POLICE_STATION_ID" id="P_POLICE_STATION_ID"
                                            class="form-control ">
                                        <option value="">-Select-</option>
                                        <?php foreach ($police_station as $row): ?>
                                            <option value="<?php echo $row->POLICE_STATION_ID ?>" <?php echo ($local_present_adddress->POLICE_STATION_ID == $row->POLICE_STATION_ID) ? 'selected' : set_value('POLICE_STATION_ID') ?>><?php echo $row->PS_ENAME ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <i class="fa fa-info-circle pointer2" data-content="Select police station"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label">Union/Ward No.</label>

                                <div class="col-md-5">
                                    <select name="P_UNION_ID" id="P_UNION_ID" class="form-control ">
                                        <option value="">-Select-</option>
                                        <?php foreach ($ward_no as $row): ?>
                                            <option value="<?php echo $row->UNION_ID ?>" <?php echo ($local_present_adddress->UNION_ID == $row->UNION_ID) ? 'selected' : set_value('UNION_ID') ?>><?php echo $row->UNION_NAME ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <i class="fa fa-info-circle pointer2" data-content="Select ward or union"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label">Post office</label>

                                <div class="col-md-5">
                                    <select name="P_POST_OFFICE_ID" id="P_POST_OFFICE_ID" class="form-control">
                                        <option value="">-Select-</option>
                                        <?php foreach ($post_office as $row): ?>
                                            <option value="<?php echo $row->POST_OFFICE_ID ?>" <?php echo ($local_present_adddress->POST_OFFICE_ID == $row->POST_OFFICE_ID) ? 'selected' : set_value('POST_OFFICE_ID') ?>><?php echo $row->POST_OFFICE_ENAME ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <i class="fa fa-info-circle pointer2" data-content="Select post office"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label">Vill/House no/Road no</label>

                                <div class="col-md-5">
                                    <input type="text" name="P_VILLAGE" id="P_VILLAGE"
                                           value="<?php echo $local_present_adddress->VILLAGE_WARD; ?>"
                                           class="form-control "/>
                                </div>
                                <div class="col-md-2">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Enter your village,house or road no here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                        </div>


                    <?php endif; ?>

                </div>
                <div class="clearfix"></div>
            </div>

        </div>

        <br>
        <div class="form-group">
            <div class="col-sm-3  pull-right">
                <input type="button" class="btn btn-primary btn-xs fSubmit pull-right"
                       data-action="applicant/updateApplicantAddressInfo"
                       data-su-action="applicant/applicantAddressInfo" value="Update">

            </div>
        </div>
    </form>
</div>


<script src="<?php echo base_url(); ?>assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/keyboard/keyboard.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
<script>

    $("#applicant_address_form").validate({
        rules: {

            DIVISION_ID: {required: true}
        },
        messages: {

            DIVISION_ID: "Division required"


        }
    });

    $('#admission_form_submit').on('click', function (e) {
        $("#admission_form").submit();
        $('#admissionModal').modal('hide');
    });

    $('#admission_form_btn').on('click', function () {

        if ($("#admission_form").valid()) {
            //personal information
            $("#P_FULL_NAME_EN").text($("#FULL_NAME_EN").val());
            $("#P_FULL_NAME_BN").text($("#FULL_NAME_BN").val());
            $("#P_PLACE_OF_BIRTH").text($("#PLACE_OF_BIRTH").val());
            var blood_group = $("#BLOOD_GRP option:selected").text() == "-Select-" ? '' : $("#BLOOD_GRP option:selected").text();
            $("#P_BLOOD_GROUP").text(blood_group);
            var marital_status = $("#MARITAL_STATUS option:selected").text() == "-Select-" ? '' : $("#MARITAL_STATUS option:selected").text();
            $("#P_MARITAL_STATUS").text(marital_status);
            var religion = $("#RELIGION_ID option:selected").text() == "-Select-" ? '' : $("#RELIGION_ID option:selected").text();
            $("#P_RELIGION_ID").text(religion);
            $("#P_BIRTH_CERTIFICATE").text($("#BIRTH_CERTIFICATE").val());
            $("#P_NATIONAL_ID").text($("#NATIONAL_ID").val());
            $("#P_HEIGHT_FEET").text($("#HEIGHT_FEET").val());
            $("#P_HEIGHT_CM").text($("#HEIGHT_CM").val());
            $("#P_WEIGHT_KG").text($("#WEIGHT_KG").val());
            $("#P_WEIGHT_LBS").text($("#WEIGHT_LBS").val());


            //parents information
            $("#P_MOTHER_NAME").text($("#MOTHER_NAME").val());
            $("#P_MOTHER_PHN").text($("#MOTHER_PHN").val());
            $("#P_MOTHER_EMAIL").text($("#MOTHER_EMAIL").val());
            $("#P_MOTHER_WORK_ADRESS").text($("#MOTHER_WORK_ADRESS").val());
            var mother_ocu = $("#MOTHER_OCU option:selected").text() == "-Select-" ? '' : $("#MOTHER_OCU option:selected").text();
            $("#P_MOTHER_OCU").text(mother_ocu);

            $("#P_FATHER_NAME").text($("#FATHER_NAME").val());
            $("#P_FATHER_PHN").text($("#FATHER_PHN").val());
            $("#P_FATHER_EMAIL").text($("#FATHER_EMAIL").val());
            $("#P_FATHER_WORK_ADRESS").text($("#FATHER_WORK_ADRESS").val());
            var father_ocu = $("#FATHER_OCU option:selected").text() == "-Select-" ? '' : $("#FATHER_OCU option:selected").text();
            $("#P_FATHER_OCU").text(father_ocu);

            //local guardian
            var local_emergency_guardian = $('input[name=local_emergency_guardian]:checked', '#admission_form').val();
            if (local_emergency_guardian == 'F') {
                $("#local_guardian_div").html("Father");
            } else if (local_emergency_guardian == 'M') {
                $("#local_guardian_div").html("Mother");
            } else {
                $("#P_LOCAL_GAR_NAME").text($("#LOCAL_GAR_NAME").val());
                $("#P_LOCAL_GAR_ADDRESS").text($("#LOCAL_GAR_ADDRESS").val());
                $("#P_LOCAL_GAR_PHN").text($("#LOCAL_GAR_PHN").val());
                $("#P_LOCAL_GAR_RELATION").text($("#LOCAL_GAR_RELATION option:selected").text());
            }

            //present address
            $("#Pr_DIVISION_ID").text($("#DIVISION_ID option:selected").text());
            $("#Pr_DISTRICT_ID").text($("#DISTRICT_ID option:selected").text());
            $("#Pr_POLICE_STATION_ID").text($("#POLICE_STATION_ID option:selected").text());
            $("#Pr_POST_OFFICE_ID").text($("#POST_OFFICE_ID option:selected").text());
            $("#Pr_THANA_ID").text($("#THANA_ID option:selected").text());
            $("#Pr_UNION_ID").text($("#UNION_ID option:selected").text());
            $("#Pr_VILLAGE_WARD").text($("#VILLAGE").val());

            var same_as_present = $('input[name=same_as_present]:checked', '#admission_form').val()

            if (same_as_present == 'NO') {
                //permanent address
                $("#Pr_P_DIVISION_ID").text($("#P_DIVISION_ID option:selected").text());
                $("#Pr_P_DISTRICT_ID").text($("#P_DISTRICT_ID option:selected").text());
                $("#Pr_P_POLICE_STATION_ID").text($("#P_POLICE_STATION_ID option:selected").text());
                $("#Pr_P_POST_OFFICE_ID").text($("#P_POST_OFFICE_ID option:selected").text());
                $("#Pr_P_THANA_ID").text($("#P_THANA_ID option:selected").text());
                $("#Pr_P_UNION_ID").text($("#P_UNION_ID option:selected").text());
                $("#Pr_P_VILLAGE_WARD").text($("#P_VILLAGE").val());
            } else {
                $("#SAME_AS_PRESENT").html("Same as Present address");
            }


            //academic information
            $("#P_EXAM_NAME_S").text($("#EXAM_NAME_S option:selected").text());
            $("#P_PASSING_YEAR_S").text($("#PASSING_YEAR_S").val());
            $("#P_BOARD_S").text($("#BOARD_S option:selected").text());
            $("#P_GROUP_S").text($("#GROUP_S option:selected").text());
            $("#P_GPA_S").text($("#GPA_S").val());
            $("#P_GPAWA_S").text($("#GPAWA_S").val());
            $("#P_INSTITUTE_S").text($("#INSTITUTE_S").val());

            $("#P_EXAM_NAME_H").text($("#EXAM_NAME_H option:selected").text());
            $("#P_PASSING_YEAR_H").text($("#PASSING_YEAR_H").val());
            $("#P_BOARD_H").text($("#BOARD_H option:selected").text());
            $("#P_GROUP_H").text($("#GROUP_H option:selected").text());
            $("#P_GPA_H").text($("#GPA_H").val());
            $("#P_GPAWA_H").text($("#GPAWA_H").val());
            $("#P_INSTITUTE_H").text($("#INSTITUTE_H").val());

            $("#P_EXAM_NAME_G").text($("#EXAM_NAME_G option:selected").text());
            $("#P_PASSING_YEAR_G").text($("#PASSING_YEAR_G").val());
            $("#P_BOARD_G").text($("#BOARD_G option:selected").text());
            $("#P_GROUP_G").text($("#GROUP_G option:selected").text());
            $("#P_GPA_G").text($("#GPA_G").val());
            $("#P_GPAWA_G").text($("#GPAWA_G").val());
            $("#P_INSTITUTE_G").text($("#INSTITUTE_G").val());

            //others information
            $("#P_ANNUAL_INCOME").text($("#ANNUAL_INCOME").val());
            $("#P_SCHOLARSHIP").text($("#SCHOLARSHIP").val());
            $("#P_SCHOLARSHIP_DESC").text($("#SCHOLARSHIP_DESC").val());
            $("#P_EXPELLED").text($("input[name='EXPELLED']:checked").val());
            $("#P_EXPELLED_DESC").text($("#EXPELLED_DESC").val());
            $("#P_ARRESTED").text($("input[name='ARRESTED']:checked").val());
            $("#P_ARRESTED_DESC").text($("#ARRESTED_DESC").val());
            $("#P_CONVICTED").text($("input[name='CONVICTED']:checked").val());
            $("#P_CONVICTED_DESC").text($("#CONVICTED_DESC").val());
            $("#P_APPLY_BEFORE").text($("input[name='APPLY_BEFORE']:checked").val());
            $("#P_APPLY_SEMESTER").text($("#APPLY_SEMESTER").val());
            $("#P_APPLY_YEAR").text($("#APPLY_YEAR").val());
            $("#P_SIBLING_EXIST").text($("input[name='SIBLING_EXIST']:checked").val());
            $("#P_SBLN_ROLL_NO").text($("#SBLN_ROLL_NO").val());

            $('#admissionModal').modal({
                show: true
            });

        } else {

        }
    });

    //This function  is use for student image preview before upload
    function upload_img(input) {
        var fileTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (input.files && input.files[0]) {
            var extension = input.files[0].name.split('.').pop().toLowerCase(),  //file extension from input file
                isSuccess = fileTypes.indexOf(extension) > -1;
            var fsize = $('#propic')[0].files[0].size;
            if (isSuccess) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var image = new Image();
                    image.src = reader.result;

                    image.onload = function () {
                        if (image.height > 300 && image.width > 300) {
                            alert("Dimension prefarable 300 X 300 px ");
                        } else if (fsize > 102400) {
                            alert("Size should not exceed 100 KB ");
                        } else {
                            $('#img_id').attr('src', e.target.result);
                            $('#p_img_id').attr('src', e.target.result);

                        }
                    };
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                alert("This file type does not support");
            }
        }
    }
    //This function  is use for student image preview before upload
    function upload_img_sig(input) {
        var fileTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (input.files && input.files[0]) {
            var extension = input.files[0].name.split('.').pop().toLowerCase(),  //file extension from input file
                isSuccess = fileTypes.indexOf(extension) > -1;
            var fsize = $('#sigpic')[0].files[0].size;
            if (isSuccess) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var image = new Image();
                    image.src = reader.result;

                    image.onload = function () {
                        if (image.height > 80 && image.width > 300) {
                            alert("Dimension prefarable 300 X 80 px ");
                        } else if (fsize > 61440) {
                            alert("Size should not exceed 60 KB ");
                        } else {
                            $('#sig_id').attr('src', e.target.result);
                            $('#p_sig_id').attr('src', e.target.result);
                        }
                    };
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                alert("This file type does not support");
            }
        }
    }

    $(document).on("click", ".same_as_present", function () {
        var same_as_present = $('input[name=same_as_present]:checked').val();

        if (same_as_present == 'YES') {
            $('#permanent_address').find('input, textarea, button, select').attr('disabled', true);
        } else {
            $('#permanent_address').find('input, textarea, button, select').attr('disabled', false);

            $("#P_DIVISION_ID").val("");
            $("#P_DISTRICT_ID").val("");
            $("#P_THANA_ID").val("");
            $("#P_POLICE_STATION_ID").val("");
            $("#P_UNION_ID").val("");
            $("#P_POST_OFFICE_ID").val("");
            $("#P_VILLAGE").val("");
        }

    });
    $(document).on("change", "#DIVISION_ID", function () {
        $("#THANA_ID").val("");
        $("#POLICE_STATION_ID").val("");
        $("#POST_OFFICE_ID").val("");
        $("#UNION_ID").val("");
        var DIVISION_ID = $(this).val();

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>common/dis_by_div_id',
            data: {DIVISION_ID: DIVISION_ID},
            success: function (data) {
                $("#DISTRICT_ID").html(data)
            }
        });
    });
    $(document).on("change", "#DISTRICT_ID", function () {
        $("#THANA_ID").val("");
        $("#POLICE_STATION_ID").val("");
        $("#POST_OFFICE_ID").val("");
        $("#UNION_ID").val("");
        var DISTRICT_ID = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>common/up_thana_by_dis_id',
            data: {DISTRICT_ID: DISTRICT_ID},
            success: function (data) {
                $("#THANA_ID").html(data)
            }
        });

    });
    $(document).on("change", "#THANA_ID", function () {
        var THANA_ID = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>common/union_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#UNION_ID").html(data)
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>common/police_station_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#POLICE_STATION_ID").html(data)
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>common/post_office_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#POST_OFFICE_ID").html(data)
            }
        });
    });
    $(document).on("change", "#P_DIVISION_ID", function () {
        $("#P_THANA_ID").val("");
        $("#P_POLICE_STATION_ID").val("");
        $("#P_POST_OFFICE_ID").val("");
        $("#P_UNION_ID").val("");
        var DIVISION_ID = $(this).val();

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>common/dis_by_div_id',
            data: {DIVISION_ID: DIVISION_ID},
            success: function (data) {
                $("#P_DISTRICT_ID").html(data)
            }
        });
    });
    $(document).on("change", "#P_DISTRICT_ID", function () {
        $("#P_THANA_ID").val("");
        $("#P_POLICE_STATION_ID").val("");
        $("#P_POST_OFFICE_ID").val("");
        $("#P_UNION_ID").val("");
        var DISTRICT_ID = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>common/up_thana_by_dis_id',
            data: {DISTRICT_ID: DISTRICT_ID},
            success: function (data) {
                $("#P_THANA_ID").html(data)
            }
        });

    });
    $(document).on("change", "#P_THANA_ID", function () {
        var THANA_ID = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>common/union_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#P_UNION_ID").html(data)
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>common/police_station_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#P_POLICE_STATION_ID").html(data)
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>common/post_office_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#P_POST_OFFICE_ID").html(data)
            }
        });
    });
    $(document).on("click", ".local_emergency_guardian", function () {
        var is_local = $(this).val();
        if (is_local == 'O') {
            $('#local_guardian').show();
            $('#finance_guardian').show();
        } else {
            $('#local_guardian').hide();
            $('#finance_guardian').hide();
        }
    });
    $(document).on('click', '#siblin', function () {
        if ($('input[name="SIBLING_EXIST"]:checked').val() == "YES") {
            $('.sibId').show();
        } else {
            $('.sibId').hide();
        }
    });
    $(document).on('click', '#scholarship_id', function () {
        if ($('input[name="SCHOLARSHIP"]:checked').val() == "YES") {
            $('.scholarships').show();
        } else {
            $('.scholarships').hide();
        }
    });
    $(document).on('click', '#expelled_id', function () {
        if ($('input[name="EXPELLED"]:checked').val() == "YES") {
            $('.expelled_div').show();
        } else {
            $('.expelled_div').hide();
        }
    });
    $(document).on('click', '#arrested_id', function () {
        if ($('input[name="ARRESTED"]:checked').val() == "YES") {
            $('.arrested_div').show();
        } else {
            $('.arrested_div').hide();
        }
    });
    $(document).on('click', '#convicted_id', function () {
        if ($('input[name="CONVICTED"]:checked').val() == "YES") {
            $('.convicted_div').show();
        } else {
            $('.convicted_div').hide();
        }
    });
    $(document).on('click', '#apply_before_id', function () {
        if ($('input[name="APPLY_BEFORE"]:checked').val() == "YES") {
            $('.apply_before_div').show();
        } else {
            $('.apply_before_div').hide();
        }
    });

    $('#WEIGHT_KG').on('keyup', function () {
        var pound = parseFloat("2.20462");
        var total = ($(this).val() * pound);
        var n = total.toFixed(2);
        $("#WEIGHT_LBS").val(n);

    });
    $('#WEIGHT_LBS').on('keyup', function () {
        var kg = parseFloat("0.453592");
        var total = ($(this).val() * kg);
        var n = total.toFixed(2);
        $("#WEIGHT_KG").val(n)
    });
    $('#HEIGHT_FEET').on('keyup', function () {
        var cm = parseFloat("30.48");
        var total = ($(this).val() * cm);
        var n = total.toFixed(2);
        $("#HEIGHT_CM").val(n);

    });
    $('#HEIGHT_CM').on('keyup', function () {
        var ft = parseFloat("0.0328084");
        var total = ($(this).val() * ft);
        var n = total.toFixed(2);
        $("#HEIGHT_FEET").val(n)
    });
    $(document).on("click", ".local_emergency_guardian", function () {
        var thisVal = $(this).val();
        if (thisVal == 'O') {
            $(".is_required_o").attr("required", "required");
        } else {
            $(".is_required_o").removeAttr("required");
        }
    });
    // get batch by change program
    $(document).on('change', '#PROGRAM_ID', function () {
        var program_id = $(this).val();
        var session_id = $("#SESSION").val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('common/batchByProgramId'); ?>',
            data: {program_id: program_id, session_id: session_id},
            success: function (data) {
                $('#BATCH_ID').html(data);
            }
        });
    });


    // Cancel Button

    $('#update_address_cancel_btn').click(function () {
        var APPLICANT_ID = $("#APPLICANT_ID").attr('applicant-data-id');
        var action_uri = $(this).attr('data-action');
        $.ajax({
            type: 'post',
            url: "<?php echo base_url(); ?>/" + action_uri,
            data: {APPLICANT_ID: APPLICANT_ID},
            beforeSend: function () {
                $(".profile-content").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $('.profile-content').html(data);
            }
        });
    });

</script>