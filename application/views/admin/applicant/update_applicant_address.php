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
        <span data-action="admin/applicantAddressInfo" id="update_address_cancel_btn"
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
                       data-action="admin/updateApplicantAddressInfo/<?php echo $local_present_adddress->APPLICANT_ID; ?>"
                       data-param="<?php echo $local_present_adddress->APPLICANT_ID; ?>"
                       data-su-action="admin/applicantAddressInfo" value="Update">

            </div>
        </div>
    </form>
</div>

<script>

    $("#applicant_address_form").validate({
        rules: {

            DIVISION_ID: {required:true},
            DISTRICT_ID: {required:true},
            THANA_ID: {required:true},
            POLICE_STATION_ID: {required:true},
            UNION_ID: {required:true},
            VILLAGE: {required:true},
            P_DIVISION_ID: {required:true},
            P_DISTRICT_ID: {required:true},
            P_THANA_ID: {required:true},
            P_POLICE_STATION_ID: {required:true},
            P_UNION_ID: {required:true},
            P_VILLAGE: {required:true}
        },

        messages: {

            DIVISION_ID: "Required field",
            DISTRICT_ID: "Required field",
            THANA_ID: "Required field",
            POLICE_STATION_ID: "Required field",
            UNION_ID: "Required field",
            VILLAGE: "Required field",
            P_DIVISION_ID: "Required field",
            P_DISTRICT_ID: "Required field",
            P_THANA_ID: "Required field",
            P_POLICE_STATION_ID: "Required field",
            P_UNION_ID: "Required field",
            P_VILLAGE: "Required field"
        }
    });


    
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
            url: '<?php echo site_url()?>/common/dis_by_div_id',
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
            url: '<?php echo site_url()?>/common/up_thana_by_dis_id',
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
            url: '<?php echo site_url()?>/common/union_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#UNION_ID").html(data)
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url()?>/common/police_station_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#POLICE_STATION_ID").html(data)
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url()?>/common/post_office_by_thana_id',
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
            url: '<?php echo site_url()?>/common/dis_by_div_id',
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
            url: '<?php echo site_url()?>/common/up_thana_by_dis_id',
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
            url: '<?php echo site_url()?>/common/union_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#P_UNION_ID").html(data)
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url()?>/common/police_station_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#P_POLICE_STATION_ID").html(data)
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url()?>/common/post_office_by_thana_id',
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
            url: "<?php echo site_url()?>//" + action_uri,
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