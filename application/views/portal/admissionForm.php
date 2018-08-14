<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/jquery-ui.datepicker.css" rel="stylesheet">

<style>
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

    #foreign {
        display: none;
    }
</style>

<link href="<?php echo base_url(); ?>assets/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
<style type="text/css">
    /* Admission banner */
    .admisstion_banner {
        padding-top: 80px;
        background-image: url("<?php echo base_url(); ?>assets/img/admission-banner.jpg");
        background-size: 100%;
        padding-bottom: 100px;
    }


</style>
<section class="admisstion_banner"></section>

<section class="features" style="background:#f3f3f4;">
    <div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">
            <div class="col-lg-2">

            </div>
            <div class="col-lg-8">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="pull-left">
                            <h2>
                                Application Form
                            </h2>
                        </div>
                        <div class="pull-right"><a
                                href="<?php echo base_url(); ?>portal/portalDegree/<?php echo $degree_id; ?>"
                                class="badge badge-danger"><i class="fa fa-arrow-circle-left"></i> Previous </a></div>

                        <form id="form" action="<?php echo base_url(); ?>portal/addAdmission" method="post"
                              class="wizard-big">
                            <h1>Personal Info</h1>
                            <fieldset>
                                <h2>
                                    Applicant's personal Information
                                </h2>

                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="col-lg-12">
                                            <div class="col-lg-12">
                                                <div style="width:200px; height:200px; background:none;">
                                                    <img id="img_id"
                                                         src="<?php echo base_url('assets/img/default.png'); ?>"
                                                         alt="your image"
                                                         style="height:120px;width: 120px; margin-bottom:20px; "/>
                                                    <input type='file' name="applican_pic" onchange="upload_img(this);"
                                                           src="" style="border:0px;">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="col-lg-12">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Name (English) <span class="red">*</span></label>
                                                    <input id="firstName" name="firstName" type="text"
                                                           class="form-control" placeholder="First Name" required>
                                                    <span class="firstName_validation red"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <br><i class="fa fa-info-circle pointer2"
                                                           data-content="First Name required" data-placement="right"
                                                           data-toggle="popover" data-container="body"
                                                           data-original-title="" title="Help"></i>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <input id="middleName" name="middleName" type="text"
                                                           class="form-control" placeholder="Middle Name">
                                                    <span class="middleName_validation red"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <input id="lastName" name="lastName" type="text"
                                                           class="form-control" placeholder="Last Name" required>
                                                    <span class="lastName_validation red"></span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-9">
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <label> নাম (বাংলায় ) </label>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <input id="bnName" name="namebn" type="text"
                                                               class="form-control" placeholder="পূর্ণ নাম">
                                                        <span class="bnName_validation red"></span>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <span class="pointer"><i class="fa fa-keyboard-o"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <br><i class="fa fa-info-circle pointer2"
                                                           data-content="বাংলায়  আপনার পূর্ণ নাম পূরণ করূন"
                                                           data-placement="right" data-toggle="popover"
                                                           data-container="body" data-original-title=""
                                                           title="Help"></i>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label>Gender <span class="red">*</span></label>
                                                    <select class="form-control m-b" name="gender" required>
                                                        <option value="">Select</option>
                                                        <option value="1">Male</option>
                                                        <option value="2">Female</option>
                                                        <option value="3">Others</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <br><i class="fa fa-info-circle pointer2"
                                                           data-content="Please select your gender"
                                                           data-placement="right" data-toggle="popover"
                                                           data-container="body" data-original-title=""
                                                           title="Help"></i>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Religion <span class="red">*</span></label>
                                                    <select class="form-control" name="religion" id="RELIGION" required>
                                                        <option value="">-Select-</option>
                                                        <?php
                                                        foreach ($religion as $relInfo):
                                                            ?>
                                                            <option
                                                                value="<?php echo $relInfo->RELIGION_ID; ?>"><?php echo $relInfo->RELIGION_NAME; ?></option>
                                                        <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-5"></div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <br><i class="fa fa-info-circle pointer2"
                                                           data-content="Please select your religion here"
                                                           data-placement="right" data-toggle="popover"
                                                           data-container="body" data-original-title=""
                                                           title="Help"></i>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Marital Status <span class="red">*</span></label>
                                                    <select class="form-control" name="religion" id="RELIGION" required>
                                                        <option value="">-Select-</option>
                                                        <?php
                                                        foreach ($maritals as $mariInfo):
                                                            ?>
                                                            <option
                                                                value="<?php echo $mariInfo->MARITAL_ID; ?>"><?php echo $mariInfo->MARITAL_NAME; ?></option>
                                                        <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-5"></div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <br><i class="fa fa-info-circle pointer2"
                                                           data-content="Please select your religion here"
                                                           data-placement="right" data-toggle="popover"
                                                           data-container="body" data-original-title=""
                                                           title="Help"></i>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Contact No. <span class="red">*</span></label>
                                                    <input id="contactNo" name="contactNo1" type="text"
                                                           class="form-control" placeholder="First Contact No." required
                                                           onKeypress="return isNumberKey(event)">
                                                    <span class="contact_validation red"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <br><input id="contactNo2" name="contactNo2" type="text"
                                                               class="form-control" placeholder="Second Contact No."
                                                               onKeypress="return isNumberKey(event)">
                                                    <span class="contact2_validation red"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-1">

                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <br><i class="fa fa-info-circle pointer2"
                                                           data-content="Please enter your contact number here"
                                                           data-placement="right" data-toggle="popover"
                                                           data-container="body" data-original-title=""
                                                           title="Help"></i>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class=" control-label">Date of Birth<span
                                                            class="red">*</span></label>

                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-calendar"></i></span>
                                                        <input type="text" name="DOB" id="DOB"
                                                               class="form-control datepicker"
                                                               value="<?php echo set_value('DOB'); ?>">
                                                    </div>
                                                    <span
                                                        class="red"><?php //echo form_error('DOB');                                         ?></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">

                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <br><i class="fa fa-info-circle pointer2"
                                                           data-content="Please enter your birth date here"
                                                           data-placement="right" data-toggle="popover"
                                                           data-container="body" data-original-title=""
                                                           title="Help"></i>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Nationality <span class="red">*</span></label>

                                                    <select class="form-control m-b" name="nationality">
                                                        <option value="18">Bangladeshi</option>
                                                        <?php
                                                        foreach ($country as $countryInfo):
                                                            ?>
                                                            <option
                                                                value="<?php echo $countryInfo->ID; ?>"><?php echo $countryInfo->NAME; ?></option>
                                                        <?php
                                                        endforeach;
                                                        ?>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>National ID</label>
                                                    <input id="nationalID" name="nationalID" type="text"
                                                           class="form-control" onKeypress="return isNumberKey(event)">
                                                    <span class="nationalID_validation red"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-1"></div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <br><i class="fa fa-info-circle pointer2"
                                                           data-content="Please select your nationality here"
                                                           data-placement="right" data-toggle="popover"
                                                           data-container="body" data-original-title=""
                                                           title="Help"></i>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4">
                                                <label>Passport No. </label>
                                                <input id="userName" name="passportNo" type="text" class="form-control"
                                                       placeholder="Passport Number"
                                                       onKeypress="return isNumberKey(event)">
                                            </div>
                                            <div class="col-lg-5">

                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <br><i class="fa fa-info-circle pointer2"
                                                           data-content="Please enter your first name here"
                                                           data-placement="right" data-toggle="popover"
                                                           data-container="body" data-original-title=""
                                                           title="Help"></i>

                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="col-lg-12">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Foreign Student </label>
                                                    <div class="col-md-3">
                                                        <input id="foreignStudent" name="foreign" type="checkbox" class="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>-->

                                        <div class="col-lg-12 foreign">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Passport Issue Date</label>

                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-calendar"></i></span>
                                                        <input type="text" name="passportIssue" id="PASSISSU"
                                                               class="form-control datepicker"
                                                               value="<?php echo set_value('PASSISSU'); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <label>Passport Validity Date</label>

                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-calendar"></i></span>
                                                    <input type="text" name="passportVality" id="PASSVAL"
                                                           class="form-control datepicker"
                                                           value="<?php echo set_value('DOB'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-1"></div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <br><i class="fa fa-info-circle pointer2"
                                                           data-content="Please enter your passport number and passport validity date here"
                                                           data-placement="right" data-toggle="popover"
                                                           data-container="body" data-original-title=""
                                                           title="Help"></i>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Birth Place </label>
                                                    <input id="" name="birthCity" type="text" class="form-control"
                                                           placeholder="City">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <label>&nbsp; </label>
                                                <br><!--<input id="userName" name="birthCountry" type="text" class="form-control foreign" placeholder="Country">-->
                                                <select class="form-control m-b" name="birthCountry">
                                                    <option value="">(Select Country)</option>
                                                    <?php
                                                    foreach ($country as $countryInfo):
                                                        ?>
                                                        <option
                                                            value="<?php echo $countryInfo->ID; ?>"><?php echo $countryInfo->NAME; ?></option>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-1"></div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <br><i class="fa fa-info-circle pointer2"
                                                           data-content="Please enter your birth place here"
                                                           data-placement="right" data-toggle="popover"
                                                           data-container="body" data-original-title=""
                                                           title="Help"></i>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Email <span class="red">*</span></label>
                                                    <input id="email" name="email" type="text"
                                                           class="form-control required">
                                                    <span class="email_validation red"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-5"></div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <br><i class="fa fa-info-circle pointer2"
                                                           data-content="Please enter your email address here"
                                                           data-placement="right" data-toggle="popover"
                                                           data-container="body" data-original-title=""
                                                           title="Help"></i>

                                                </div>
                                            </div>
                                        </div>

                                        <!--<div class="col-lg-12">
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <label>Present Address <span class="red">*</span></label>
                                                    <textarea class="col-lg-12 presentAddr required" name="presentAdd" id="presentAdd"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-1"></div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <br><i class="fa fa-info-circle pointer2" data-content="Please enter your present address here" data-placement="right" data-toggle="popover" data-container="body"  data-original-title="" title="Help"></i>

                                                </div>
                                            </div>
                                        </div>-->
                                        <div class="col-lg-12">
                                            <div id="present_address" class="toggle-div1">
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label">Present Address</label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label">Division</label>

                                                    <div class="col-md-4">
                                                        <select name="DIVISION_ID" id="DIVISION_ID"
                                                                class="form-control">
                                                            <option value="">-Select-</option>
                                                            <?php foreach ($division as $rd) { ?>
                                                                <option
                                                                    value="<?php echo $rd->DIVISION_ID ?>"><?php echo $rd->DIVISION_ENAME ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-5"></div>
                                                    <div class="col-md-3">
                                                        <i class="fa fa-info-circle pointer2"
                                                           data-content="Select division name" data-placement="right"
                                                           data-toggle="popover" data-container="body"
                                                           data-original-title="" title="Help"></i>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-12 control-label">District</label>

                                                    <div class="col-md-4">
                                                        <select name="DISTRICT_ID" id="DISTRICT_ID"
                                                                class="form-control">
                                                            <option value="">-Select-</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-5"></div>
                                                    <div class="col-md-3">
                                                        <i class="fa fa-info-circle pointer2"
                                                           data-content="Select district name" data-placement="right"
                                                           data-toggle="popover" data-container="body"
                                                           data-original-title="" title="Help"></i>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label">Upazila/Thana</label>

                                                    <div class="col-md-4">
                                                        <select name="THANA_ID" id="THANA_ID" class="form-control">
                                                            <option value="">-Select-</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-5"></div>
                                                    <div class="col-md-3">
                                                        <i class="fa fa-info-circle pointer2"
                                                           data-content="Select upazila or thana name"
                                                           data-placement="right" data-toggle="popover"
                                                           data-container="body" data-original-title=""
                                                           title="Help"></i>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label">Police Station</label>

                                                    <div class="col-md-4">
                                                        <select name="POLICE_STATION_ID" id="POLICE_STATION_ID"
                                                                class="form-control">
                                                            <option value="">-Select-</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-5"></div>
                                                    <div class="col-md-3">
                                                        <i class="fa fa-info-circle pointer2"
                                                           data-content="Select police station" data-placement="right"
                                                           data-toggle="popover" data-container="body"
                                                           data-original-title="" title="Help"></i>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label">Union/Ward No.</label>

                                                    <div class="col-md-4">
                                                        <select name="UNION_ID" id="UNION_ID" class="form-control">
                                                            <option value="">-Select-</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-5"></div>
                                                    <div class="col-md-3">
                                                        <i class="fa fa-info-circle pointer2"
                                                           data-content="Select ward or union" data-placement="right"
                                                           data-toggle="popover" data-container="body"
                                                           data-original-title="" title="Help"></i>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label">Post office</label>

                                                    <div class="col-md-4">
                                                        <select name="POST_OFFICE_ID" id="POST_OFFICE_ID"
                                                                class="form-control">
                                                            <option value="">-Select-</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-5"></div>
                                                    <div class="col-md-3">
                                                        <i class="fa fa-info-circle pointer2"
                                                           data-content="Select post office" data-placement="right"
                                                           data-toggle="popover" data-container="body"
                                                           data-original-title="" title="Help"></i>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label">Vill/House no/Road no</label>

                                                    <div class="col-md-8">
                                                        <input type="text" name="VILLAGE" id="VILLAGE" value=""
                                                               class="form-control"/>
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-3">
                                                        <i class="fa fa-info-circle pointer2"
                                                           data-content="Enter your village,house or road no here"
                                                           data-placement="right" data-toggle="popover"
                                                           data-container="body" data-original-title=""
                                                           title="Help"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="col-lg-12">
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <div class="col-lg-10">
                                                        <label>Permanent Address &nbsp;( Same as Present <input id="sameAddr" name="sameAddress" value="1" type="checkbox" > ) </label>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <textarea class="col-lg-12" id="parmanentAdd" name="parmanentAdd" ></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-1"></div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <br><i class="fa fa-info-circle pointer2" data-content="Please enter your parmanent address here if present address and permanent address same then select the 'Same as Present'" data-placement="right" data-toggle="popover" data-container="body"  data-original-title="" title="Help"></i>
                                                </div>
                                            </div>
                                        </div>-->
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="col-md-12 control-label">Permanent Address <span
                                                        class="red">*</span></label>

                                                <div class="col-md-4"> Same as present address ?</div>
                                                <div class="col-md-2">
                                                    <div class="col-lg-4">
                                                        <input id="PARM_ADDRESS_YES" name="PARM_ADDRESS" value="1"
                                                               type="radio">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        Yes
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="col-lg-4">
                                                        <input id="PARM_ADDRESS_NO" name="PARM_ADDRESS" value="0"
                                                               type="radio">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        No
                                                    </div>
                                                </div>
                                                <div class="col-md-1"></div>
                                                <div class="col-md-3">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Enter your Permanent address here"
                                                       data-placement="right" data-toggle="popover"
                                                       data-container="body" data-original-title="" title="Help"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div id="permanent_address" class="toggle-div" style="display:none">
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label">Division</label>

                                                    <div class="col-md-4">
                                                        <select name="P_DIVISION_ID" id="P_DIVISION_ID"
                                                                class="form-control">
                                                            <option value="">-Select-</option>
                                                            <?php foreach ($division as $rd) { ?>
                                                                <option
                                                                    value="<?php echo $rd->DIVISION_ID ?>"><?php echo $rd->DIVISION_ENAME ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-5"></div>
                                                    <div class="col-md-3">
                                                        <i class="fa fa-info-circle pointer2"
                                                           data-content="Select division name" data-placement="right"
                                                           data-toggle="popover" data-container="body"
                                                           data-original-title="" title="Help"></i>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label">District</label>

                                                    <div class="col-md-4">
                                                        <select name="P_DISTRICT_ID" id="P_DISTRICT_ID"
                                                                class="form-control">
                                                            <option value="">-Select-</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-5"></div>
                                                    <div class="col-md-3">
                                                        <i class="fa fa-info-circle pointer2"
                                                           data-content="Select district name" data-placement="right"
                                                           data-toggle="popover" data-container="body"
                                                           data-original-title="" title="Help"></i>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label">Upazila/Thana</label>

                                                    <div class="col-md-4">
                                                        <select name="P_THANA_ID" id="P_THANA_ID" class="form-control">
                                                            <option value="">-Select-</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-5"></div>
                                                    <div class="col-md-3">
                                                        <i class="fa fa-info-circle pointer2"
                                                           data-content="Select upazila or thana name"
                                                           data-placement="right" data-toggle="popover"
                                                           data-container="body" data-original-title=""
                                                           title="Help"></i>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label">Police Station</label>

                                                    <div class="col-md-4">
                                                        <select name="P_POLICE_STATION_ID" id="P_POLICE_STATION_ID"
                                                                class="form-control">
                                                            <option value="">-Select-</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-5"></div>
                                                    <div class="col-md-3">
                                                        <i class="fa fa-info-circle pointer2"
                                                           data-content="Select police station" data-placement="right"
                                                           data-toggle="popover" data-container="body"
                                                           data-original-title="" title="Help"></i>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label">Union/Ward No.</label>

                                                    <div class="col-md-4">
                                                        <select name="P_UNION_ID" id="P_UNION_ID" class="form-control">
                                                            <option value="">-Select-</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-5"></div>
                                                    <div class="col-md-3">
                                                        <i class="fa fa-info-circle pointer2"
                                                           data-content="Select ward or union" data-placement="right"
                                                           data-toggle="popover" data-container="body"
                                                           data-original-title="" title="Help"></i>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label">Post office</label>

                                                    <div class="col-md-4">
                                                        <select name="P_POST_OFFICE_ID" id="P_POST_OFFICE_ID"
                                                                class="form-control">
                                                            <option value="">-Select-</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-5"></div>
                                                    <div class="col-md-3">
                                                        <i class="fa fa-info-circle pointer2"
                                                           data-content="Select post office" data-placement="right"
                                                           data-toggle="popover" data-container="body"
                                                           data-original-title="" title="Help"></i>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label">Vill/House no/Road no</label>

                                                    <div class="col-md-8">
                                                        <input type="text" name="" value="" class="form-control"/>
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-3">
                                                        <i class="fa fa-info-circle pointer2"
                                                           data-content="Enter your village,house or road no here"
                                                           data-placement="right" data-toggle="popover"
                                                           data-container="body" data-original-title=""
                                                           title="Help"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </fieldset>
                            <h1>Parents Info</h1>
                            <fieldset>
                                <h2>Parents Information</h2>

                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-9">
                                        <div class="col-lg-12">
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <label>Father's Name <span class="red">*</span></label>
                                                    <input id="fatherName" name="fatherName" type="text"
                                                           class="form-control required">
                                                    <span class="fatherName_validation red"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <br><i class="fa fa-info-circle pointer2"
                                                           data-content="Please enter your first name here"
                                                           data-placement="right" data-toggle="popover"
                                                           data-container="body" data-original-title=""
                                                           title="Help"></i>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Father's NID No. <span class="red">*</span></label>
                                                    <input id="fatherNationalID" name="fatherNID" type="text"
                                                           class="form-control required"
                                                           onKeypress="return isNumberKey(event)">
                                                    <span class="father_nationalID_validation red"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <br><i class="fa fa-info-circle pointer2"
                                                           data-content="Please enter your first name here"
                                                           data-placement="right" data-toggle="popover"
                                                           data-container="body" data-original-title=""
                                                           title="Help"></i>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Father's Contact <span class="red">*</span></label>
                                                    <input id="fatherContact" name="fatherContact" type="text"
                                                           class="form-control required"
                                                           onKeypress="return isNumberKey(event)">
                                                    <span class="father_contact_validation red"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <br><i class="fa fa-info-circle pointer2"
                                                           data-content="Please enter your first name here"
                                                           data-placement="right" data-toggle="popover"
                                                           data-container="body" data-original-title=""
                                                           title="Help"></i>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label>Father's Email </label>
                                                    <input id="fatherEmail" name="fatherEmail" type="text"
                                                           class="form-control">
                                                    <span class="father_email_validation red"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <br><i class="fa fa-info-circle pointer2"
                                                           data-content="Please enter your first name here"
                                                           data-placement="right" data-toggle="popover"
                                                           data-container="body" data-original-title=""
                                                           title="Help"></i>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label>Father's Occupation <span class="red">*</span></label>

                                                    <select class="form-control m-b required" name="fatherOccupation">
                                                        <option value="">Select</option>
                                                        <?php
                                                        foreach ($occupation as $occInfo):
                                                            ?>
                                                            <option
                                                                value="<?php echo $occInfo->LKP_ID; ?>"><?php echo $occInfo->LKP_NAME; ?></option>
                                                        <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <br><i class="fa fa-info-circle pointer2"
                                                           data-content="Please enter your first name here"
                                                           data-placement="right" data-toggle="popover"
                                                           data-container="body" data-original-title=""
                                                           title="Help"></i>

                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-12">
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <label>Mother's Name <span class="red">*</span></label>
                                                    <input id="motherName" name="motherName" type="text"
                                                           class="form-control required">
                                                    <span class="motherName_validation red"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <br><i class="fa fa-info-circle pointer2"
                                                           data-content="Please enter your first name here"
                                                           data-placement="right" data-toggle="popover"
                                                           data-container="body" data-original-title=""
                                                           title="Help"></i>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Mother's NID No. <span class="red">*</span></label>
                                                    <input id="mothrNationalID" name="motherNID" type="text"
                                                           class="form-control required"
                                                           onKeypress="return isNumberKey(event)">
                                                    <span class="mother_nationalID_validation red"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <br><i class="fa fa-info-circle pointer2"
                                                           data-content="Please enter your first name here"
                                                           data-placement="right" data-toggle="popover"
                                                           data-container="body" data-original-title=""
                                                           title="Help"></i>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Mother's Contact <span class="red">*</span></label>
                                                    <input id="motherContact" name="motherContact" type="text"
                                                           class="form-control required"
                                                           onKeypress="return isNumberKey(event)">
                                                    <span class="mother_contact_validation red"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <br><i class="fa fa-info-circle pointer2"
                                                           data-content="Please enter your first name here"
                                                           data-placement="right" data-toggle="popover"
                                                           data-container="body" data-original-title=""
                                                           title="Help"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label>Mother's Email </label>
                                                    <input id="motherEmail" name="motherEmail" type="text"
                                                           class="form-control">
                                                    <span class="mother_email_validation red"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <br><i class="fa fa-info-circle pointer2"
                                                           data-content="Please enter your first name here"
                                                           data-placement="right" data-toggle="popover"
                                                           data-container="body" data-original-title=""
                                                           title="Help"></i>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label>Mother's Occupation <span class="red">*</span></label>
                                                    <select class="form-control m-b required" name="motherOccupation">
                                                        <option value="">Select</option>
                                                        <?php
                                                        foreach ($occupation as $occInfo):
                                                            ?>
                                                            <option
                                                                value="<?php echo $occInfo->LKP_ID; ?>"><?php echo $occInfo->LKP_NAME; ?></option>
                                                        <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <br><i class="fa fa-info-circle pointer2"
                                                           data-content="Please enter your first name here"
                                                           data-placement="right" data-toggle="popover"
                                                           data-container="body" data-original-title=""
                                                           title="Help"></i>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-12">
                                            <div class="col-lg-10">
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <label>Emergency Contact Person <span
                                                                class="red">*</span></label>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="col-lg-4">
                                                            <input id="emergencyCon" name="emergencyPer" value="f"
                                                                   type="radio"></div>
                                                        <div class="col-lg-8">
                                                            Father
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="col-lg-4">
                                                            <input id="emergencyCon" name="emergencyPer" value="m"
                                                                   type="radio"></div>
                                                        <div class="col-lg-8">
                                                            Mother
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <div class="col-lg-2">
                                                            <input id="emergencyCon" name="emergencyPer" value="g"
                                                                   type="radio"></div>
                                                        <div class="col-lg-8">
                                                            Guardian
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="guardian" style="display:none">
                                            <div class="emergency">
                                                <div class="col-lg-12">
                                                    <div class="col-lg-5">
                                                        <div class="form-group">
                                                            <label>Relation with Guardian </label>
                                                            <input id="emergencyPer" name="gourdianRelation" type="text"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3"></div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>&nbsp;</label>
                                                            <br><i class="fa fa-info-circle pointer2"
                                                                   data-content="Please enter your first name here"
                                                                   data-placement="right" data-toggle="popover"
                                                                   data-container="body" data-original-title=""
                                                                   title="Help"></i>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="col-lg-8">
                                                        <div class="form-group">
                                                            <label>Guardian Name </label>
                                                            <input id="userName" name="gourdianName" type="text"
                                                                   class="form-control ">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>&nbsp;</label>
                                                            <br><i class="fa fa-info-circle pointer2"
                                                                   data-content="Please enter your first name here"
                                                                   data-placement="right" data-toggle="popover"
                                                                   data-container="body" data-original-title=""
                                                                   title="Help"></i>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="col-lg-5">
                                                        <div class="form-group">
                                                            <label>Guardian Contact </label>
                                                            <input id="userName" name="gourdianContact" type="text"
                                                                   class="form-control ">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3"></div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>&nbsp;</label>
                                                            <br><i class="fa fa-info-circle pointer2"
                                                                   data-content="Please enter your first name here"
                                                                   data-placement="right" data-toggle="popover"
                                                                   data-container="body" data-original-title=""
                                                                   title="Help"></i>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="col-lg-5">
                                                        <div class="form-group">
                                                            <label>Guardian's Email </label>
                                                            <input id="userName" name="gourdianEmail" type="text"
                                                                   class="form-control ">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3"></div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>&nbsp;</label>
                                                            <br><i class="fa fa-info-circle pointer2"
                                                                   data-content="Please enter your first name here"
                                                                   data-placement="right" data-toggle="popover"
                                                                   data-container="body" data-original-title=""
                                                                   title="Help"></i>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="col-lg-5">
                                                        <div class="form-group">
                                                            <label>Guardian's Occupation</label>
                                                            <select class="form-control m-b" name="gourdianOccupation">
                                                                <option value="">Select</option>
                                                                <?php
                                                                foreach ($occupation as $occInfo):
                                                                    ?>
                                                                    <option
                                                                        value="<?php echo $occInfo->LKP_ID; ?>"><?php echo $occInfo->LKP_NAME; ?></option>
                                                                <?php
                                                                endforeach;
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3"></div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>&nbsp;</label>
                                                            <br><i class="fa fa-info-circle pointer2"
                                                                   data-content="Please enter your first name here"
                                                                   data-placement="right" data-toggle="popover"
                                                                   data-container="body" data-original-title=""
                                                                   title="Help"></i>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!--<div class="col-lg-12">
                                                    <div class="col-lg-8">
                                                        <div class="form-group">
                                                            <label>Guardian's Address </label>
                                                            <textarea class="col-lg-12" name="gourdianAddress"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>&nbsp;</label>
                                                            <br><i class="fa fa-info-circle pointer2" data-content="Please enter your first name here" data-placement="right" data-toggle="popover" data-container="body"  data-original-title="" title="Help"></i>

                                                        </div>
                                                    </div>
                                                </div>-->
                                                <div class="col-lg-12">
                                                    <div class="toggle-div1">
                                                        <div class="form-group">
                                                            <label class="col-md-12 control-label">Address</label>
                                                            <label class="col-md-12 control-label">Division</label>

                                                            <div class="col-md-4">
                                                                <select name="DIVISION_ID" id="G_DIVISION_ID"
                                                                        class="form-control">
                                                                    <option value="">-Select-</option>
                                                                    <?php foreach ($division as $rd) { ?>
                                                                        <option
                                                                            value="<?php echo $rd->DIVISION_ID ?>"><?php echo $rd->DIVISION_ENAME ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4"></div>
                                                            <div class="col-md-4">
                                                                <i class="fa fa-info-circle pointer2"
                                                                   data-content="Select division name"
                                                                   data-placement="right" data-toggle="popover"
                                                                   data-container="body" data-original-title=""
                                                                   title="Help"></i>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-12 control-label">District</label>

                                                            <div class="col-md-4">
                                                                <select name="DISTRICT_ID" id="G_DISTRICT_ID"
                                                                        class="form-control">
                                                                    <option value="">-Select-</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4"></div>
                                                            <div class="col-md-4">
                                                                <i class="fa fa-info-circle pointer2"
                                                                   data-content="Select district name"
                                                                   data-placement="right" data-toggle="popover"
                                                                   data-container="body" data-original-title=""
                                                                   title="Help"></i>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-12 control-label">Upazila/Thana</label>

                                                            <div class="col-md-4">
                                                                <select name="THANA_ID" id="G_THANA_ID"
                                                                        class="form-control">
                                                                    <option value="">-Select-</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4"></div>
                                                            <div class="col-md-4">
                                                                <i class="fa fa-info-circle pointer2"
                                                                   data-content="Select upazila or thana name"
                                                                   data-placement="right" data-toggle="popover"
                                                                   data-container="body" data-original-title=""
                                                                   title="Help"></i>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-12 control-label">Police
                                                                Station</label>

                                                            <div class="col-md-4">
                                                                <select name="POLICE_STATION_ID"
                                                                        id="G_POLICE_STATION_ID" class="form-control">
                                                                    <option value="">-Select-</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4"></div>
                                                            <div class="col-md-4">
                                                                <i class="fa fa-info-circle pointer2"
                                                                   data-content="Select police station"
                                                                   data-placement="right" data-toggle="popover"
                                                                   data-container="body" data-original-title=""
                                                                   title="Help"></i>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-12 control-label">Union/Ward
                                                                No.</label>

                                                            <div class="col-md-4">
                                                                <select name="UNION_ID" id="G_UNION_ID"
                                                                        class="form-control">
                                                                    <option value="">-Select-</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4"></div>
                                                            <div class="col-md-4">
                                                                <i class="fa fa-info-circle pointer2"
                                                                   data-content="Select ward or union"
                                                                   data-placement="right" data-toggle="popover"
                                                                   data-container="body" data-original-title=""
                                                                   title="Help"></i>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-12 control-label">Post office</label>

                                                            <div class="col-md-4">
                                                                <select name="POST_OFFICE_ID" id="G_POST_OFFICE_ID"
                                                                        class="form-control">
                                                                    <option value="">-Select-</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4"></div>
                                                            <div class="col-md-4">
                                                                <i class="fa fa-info-circle pointer2"
                                                                   data-content="Select post office"
                                                                   data-placement="right" data-toggle="popover"
                                                                   data-container="body" data-original-title=""
                                                                   title="Help"></i>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-12 control-label">Vill/House no/Road
                                                                no</label>

                                                            <div class="col-md-8">
                                                                <input type="text" name="VILLAGE" id="VILLAGE" value=""
                                                                       class="form-control"/>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <i class="fa fa-info-circle pointer2"
                                                                   data-content="Enter your village,house or road no here"
                                                                   data-placement="right" data-toggle="popover"
                                                                   data-container="body" data-original-title=""
                                                                   title="Help"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <h1>Academic Info</h1>
                            <fieldset>
                                <!--<h2>Academic Information</h2>-->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-lg-4">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Name of Exam <span class="red">*</span></label>
                                                    <select class="form-control m-b examName" name="examTitle">
                                                        <option value="">(Select One)</option>
                                                        <option value="1">S.S.C</option>
                                                        <option value="2">H.S.C</option>
                                                        <option value="3">O Level</option>
                                                        <option value="3">A Level</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Board <span class="red">*</span></label>
                                                    <select class="form-control m-b examBoard" name="examBoard">
                                                        <option value="">Select</option>
                                                        <option value="1">Dhaka</option>
                                                        <option value="2">Rajshahi</option>
                                                        <option value="3">Shylet</option>
                                                        <option value="4">Chittagong</option>
                                                        <option value="5">Khulna</option>
                                                        <option value="6">Borishal</option>
                                                        <option value="7">Rangpur</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Group <span class="red">*</span></label>
                                                    <select class="form-control m-b examGroup" name="examGroup">
                                                        <option value="">Select</option>
                                                        <option value="1">Science</option>
                                                        <option value="2">Arts</option>
                                                        <option value="2">Business</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Year <span class="red">*</span></label>
                                                    <!--<select class="form-control m-b passYear" name="account">
                                                        <option value="">2013</option>
                                                        <option value="">2012</option>
                                                        <option value="">2011</option>
                                                        <option value="">2010</option>
                                                        <option value="">2009</option>
                                                        <option value="">2008</option>
                                                        <option value="">2007</option>
                                                        <option value="">2006</option>
                                                        <option value="">2005</option>
                                                        <option value="">2004</option>
                                                        <option value="">2003</option>
                                                        <option value="">2002</option>
                                                        <option value="">2001</option>
                                                    </select>-->
                                                    <input id="userName" name="examYear" type="text"
                                                           class="form-control examYear">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>GPA <span class="red">*</span></label>
                                                    <input id="userName" name="examGPA" type="text"
                                                           class="form-control examGPA">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Institute <span class="red">*</span></label>
                                                    <input id="userName" name="examInstitute" type="text"
                                                           class="form-control examInstitute">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-w-sm btn-warning" id="addExam">
                                                        <b>+</b> Add
                                                    </button>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-8">
                                            <div class="ibox float-e-margins">
                                                <div class="ibox-title">
                                                    <h5>Exam Table </h5>

                                                    <div class="ibox-tools">
                                                        <a class="collapse-link">
                                                            <i class="fa fa-chevron-up"></i>
                                                        </a>
                                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                            <i class="fa fa-wrench"></i>
                                                        </a>

                                                        <a class="close-link">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="ibox-content">

                                                    <table class="table table-striped exam-table">
                                                        <thead>
                                                        <tr>
                                                            <th>Exam</th>
                                                            <th>Board</th>
                                                            <th>Group</th>
                                                            <th>Year</th>
                                                            <th>GPA</th>
                                                            <th>Institute</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-8">
                                        <div class="col-lg-12">
                                            <div class="form-group">

                                                <div class="ibox-title">
                                                    <h5 class="col-lg-12">English Proficiency </h5>

                                                    <div class="col-lg-3 gnIelts">
                                                        <div class="col-lg-3">
                                                            <input id="engIel" name="engProficiency" value=""
                                                                   type="checkbox">
                                                        </div>
                                                        <div class="col-lg-9">
                                                            IELTS
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <div class="col-lg-3">
                                                            <input id="engTof" name="engTof" value="" type="checkbox">
                                                        </div>
                                                        <div class="col-lg-9">
                                                            TOFEL
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <div class="col-lg-3">
                                                            <input id="engSat" name="engSat" value="" type="checkbox">
                                                        </div>
                                                        <div class="col-lg-9">
                                                            SAT
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="col-lg-3">
                                                            <input id="engGre" name="engGre" value="" type="checkbox">
                                                        </div>
                                                        <div class="col-lg-9">
                                                            GRE
                                                        </div>
                                                    </div>
                                                    <div class="ibox-content">
                                                        <table class="table">
                                                            <div class="col-lg-3 formIelts" style="display:none;">
                                                                <div class="form-group">
                                                                    <label>IELTS Score</label>
                                                                    <input id="userName" name="ieltsScore" type="text"
                                                                           class="form-control">
                                                                    <label>Test Date</label>

                                                                    <div class="input-group date">
                                                                        <span class="input-group-addon"><i
                                                                                class="fa fa-calendar"></i></span>
                                                                        <input type="text" name="IELTS_DATE"
                                                                               id="IELTS_DATE"
                                                                               class="form-control datepicker"
                                                                               value="<?php echo set_value('IELTS_DATE'); ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 formTofel" style="display:none;">
                                                                <div class="form-group">
                                                                    <label>Tofel Score</label>
                                                                    <input id="userName" name="tofelScore" type="text"
                                                                           class="form-control">
                                                                    <label>Test Date</label>

                                                                    <div class="input-group date">
                                                                        <span class="input-group-addon"><i
                                                                                class="fa fa-calendar"></i></span>
                                                                        <input type="text" name="TOFEL_DATE"
                                                                               id="TOFEL_DATE"
                                                                               class="form-control datepicker"
                                                                               value="<?php echo set_value('TOFEL_DATE'); ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 formSAT" style="display:none;">
                                                                <div class="form-group">
                                                                    <label>SAT Score</label>
                                                                    <input id="userName" name="satScore" type="text"
                                                                           class="form-control">
                                                                    <label>Test Date</label>

                                                                    <div class="input-group date">
                                                                        <span class="input-group-addon"><i
                                                                                class="fa fa-calendar"></i></span>
                                                                        <input type="text" name="SAT_DATE" id="SAT_DATE"
                                                                               class="form-control datepicker"
                                                                               value="<?php echo set_value('DOB'); ?>">
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 formGRE" style="display:none;">
                                                                <div class="form-group">
                                                                    <label>GRE Score</label>
                                                                    <input id="userName" name="greScore" type="text"
                                                                           class="form-control">
                                                                    <label>Test Date</label>

                                                                    <div class="input-group date">
                                                                        <span class="input-group-addon"><i
                                                                                class="fa fa-calendar"></i></span>
                                                                        <input type="text" name="GRE_DATE" id="GRE_DATE"
                                                                               class="form-control datepicker"
                                                                               value="<?php echo set_value('DOB'); ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <h1>Finance & Others Info</h1>
                            <fieldset>
                                <h2>Source of Finance</h2>

                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-9">
                                        <div class="col-lg-12">
                                            <div class="col-lg-10">
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <label>Family Income (Annual)</label>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="col-lg-1">
                                                            <input id="emergencyCon" name="familyIncomeRange" value="f"
                                                                   type="radio"></div>
                                                        <div class="col-lg-11">
                                                            < 1,00,000 BDT
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="col-lg-1">
                                                            <input id="emergencyCon" name="familyIncomeRange" value="m"
                                                                   type="radio"></div>
                                                        <div class="col-lg-11">
                                                            1,00,000 BDT to 5,00,000 BDT
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="col-lg-1">
                                                            <input id="emergencyCon" name="familyIncomeRange" value="a"
                                                                   type="radio"></div>
                                                        <div class="col-lg-11">
                                                            5,00,000 BDT to 10,00,000 BDT
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="col-lg-1">
                                                            <input id="emergencyCon" name="familyIncomeRange" value="m"
                                                                   type="radio"></div>
                                                        <div class="col-lg-11">
                                                            10,00,000 BDT to 20,00,000 BDT
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="col-lg-1">
                                                            <input id="emergencyCon" name="familyIncomeRange" value="m"
                                                                   type="radio"></div>
                                                        <div class="col-lg-11">
                                                            > 20,00,000 BDT
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <label>Student's Source of Finance</label>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="col-lg-3">
                                                            <input id="source" name="source" value="f" type="radio">
                                                        </div>
                                                        <div class="col-lg-9">
                                                            Parents
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="col-lg-3">
                                                            <input id="emergencyCon" name="source" value="m"
                                                                   type="radio"></div>
                                                        <div class="col-lg-9">
                                                            Guardian
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="col-lg-3">
                                                            <input id="emergencyCon" name="source" value="a"
                                                                   type="radio"></div>
                                                        <div class="col-lg-9">
                                                            Self
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="col-lg-3">
                                                            <input id="emergencyCon" name="source" value="m"
                                                                   type="radio"></div>
                                                        <div class="col-lg-9">
                                                            Scholarship
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="col-lg-3">
                                                            <input id="emergencyCon" name="source" value="sp"
                                                                   type="radio" id="spouse"></div>
                                                        <div class="col-lg-9">
                                                            Spouse
                                                        </div>
                                                    </div>
                                                    <div class="form-group spouseInfo col-lg-12" style="display:none;">
                                                        <div class="col-lg-6">
                                                            <label>Spouse Name</label>
                                                            <input id="" name="spouseName" value="" type="text">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label>Spouse Contact</label>
                                                            <input id="" name="spouseContact" value="" type="text">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label>Spouse Occupation</label>
                                                            <input id="" name="spouseOccupation" value="" type="text">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-12">
                                                <label>Do you have any work experience?</label>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="col-lg-3">
                                                    <input id="workEx" name="workExp" value="y" type="radio"></div>
                                                <div class="col-lg-9">
                                                    Yes
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="col-lg-3">
                                                    <input id="workEx" name="workExp" value="n" type="radio"></div>
                                                <div class="col-lg-9">
                                                    No
                                                </div>
                                            </div>
                                            <div class="col-lg-12 workExper" style="display:none;">
                                                <div class="form-group">
                                                    <div class="col-lg-3">
                                                        <label>Work Experience</label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <span id="addExperience" class="pointer btn-warning">&nbsp;&nbsp;<i
                                                                class="fa fa-plus-circle"></i> More&nbsp;&nbsp; </span>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <div class="col-lg-6">
                                                                    <label>Organization</label>
                                                                    <input id="" name="orgName" type="text"
                                                                           placeholder="Name"
                                                                           class="form-control orgName">
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <label>Designation</label>
                                                                    <input id="" name="desig" type="text"
                                                                           placeholder="Designation Name"
                                                                           class="form-control desig">
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <label>From Date</label>

                                                                    <div class="input-group date">
                                                                        <span class="input-group-addon"><i
                                                                                class="fa fa-calendar"></i></span>
                                                                        <input type="text" name="FROM_DATE"
                                                                               id="FROM_DATE"
                                                                               class="form-control datepicker fromDate"
                                                                               value="<?php echo set_value('DOB'); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <label>To Date</label>

                                                                    <div class="input-group date">
                                                                        <span class="input-group-addon"><i
                                                                                class="fa fa-calendar"></i></span>
                                                                        <input type="text" id="TO_DATE" name="TO_DATE"
                                                                               class="form-control datepicker toDate"
                                                                               value="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <label>Supervisor</label>
                                                                    <input id="" name="supervisor" type="text"
                                                                           placeholder="Contact No."
                                                                           class="form-control supervisor">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="ibox float-e-margins">
                                                            <div class="ibox-title">
                                                                <h5>Experience Table </h5>

                                                                <div class="ibox-tools">
                                                                    <a class="collapse-link">
                                                                        <i class="fa fa-chevron-up"></i>
                                                                    </a>
                                                                    <a class="dropdown-toggle" data-toggle="dropdown"
                                                                       href="#">
                                                                        <i class="fa fa-wrench"></i>
                                                                    </a>

                                                                    <a class="close-link">
                                                                        <i class="fa fa-times"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="ibox-content">

                                                                <table class="table table-striped experience-table">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>Org</th>
                                                                        <th>Designation</th>
                                                                        <th>Date</th>
                                                                        <th>Supervisor</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-12">
                                                <label>Did you appear for KYAU Admission test before?</label>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="col-lg-3">
                                                    <input id="admiTest" name="adTest" value="y" type="radio"></div>
                                                <div class="col-lg-9">
                                                    Yes
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="col-lg-3">
                                                    <input id="admiTest" name="adTest" value="n" type="radio"></div>
                                                <div class="col-lg-9">
                                                    No
                                                </div>
                                            </div>
                                            <div class="col-lg-4 adRollNo" style="display:none;">
                                                <div class="form-group">
                                                    <input id="rollNo" name="addmissionRoll" type="text"
                                                           class="form-control" placeholder="Roll No.">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-12">
                                                <label>Were you Registered of KYAU before?</label>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="col-lg-3">
                                                    <input id="regist" name="registered" value="y" type="radio"></div>
                                                <div class="col-lg-9">
                                                    Yes
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="col-lg-3">
                                                    <input id="regist" name="registered" value="n" type="radio"></div>
                                                <div class="col-lg-9">
                                                    No
                                                </div>
                                            </div>
                                            <div class="col-lg-4 adIdNo" style="display:none;">
                                                <div class="form-group">
                                                    <input id="idNo" name="idNum" type="text" class="form-control"
                                                           placeholder="ID Number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-12">
                                                <label>Do you have any siblings currently enrolled at KYAU ?</label>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="col-lg-3">
                                                    <input id="siblin" name="siblings" value="y" type="radio"></div>
                                                <div class="col-lg-9">
                                                    Yes
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="col-lg-3">
                                                    <input id="siblin" name="siblings" value="n" type="radio"></div>
                                                <div class="col-lg-9">
                                                    No
                                                </div>
                                            </div>
                                            <div class="col-lg-4 sibId" style="display:none;">
                                                <div class="form-group">
                                                    <input id="sibId" name="sibidNum" type="text" class="form-control"
                                                           placeholder="ID Number of your Sibling">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-12">
                                                <label>Did you discontinue any graduate/undergraduate program in any
                                                    other university?</label>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="col-lg-3">
                                                    <input id="discon" name="discontinue" value="y" type="radio"></div>
                                                <div class="col-lg-9">
                                                    Yes
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="col-lg-3">
                                                    <input id="discon" name="discontinue" value="n" type="radio"></div>
                                                <div class="col-lg-9">
                                                    No
                                                </div>
                                            </div>
                                            <div class="disconCoz" style="display:none;">
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <!--<input id="" name="disconDet" type="text" class="form-control" placeholder="Discountinue Details">-->
                                                        <label>Reason for Discontinuation</label>
                                                        <textarea class="col-lg-8" name="discontinueReason"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <label>Name of the Program</label>
                                                        <input id="" name="disconProg" type="text" class="form-control"
                                                               placeholder="Program name">
                                                    </div>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <label>Name of University</label>
                                                        <input id="" name="disconUni" type="text" class="form-control"
                                                               placeholder="Program name">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-12">
                                                <label>Are you suffering from any contagious/infectious
                                                    diseases? </label>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="col-lg-3">
                                                    <input id="suffer" name="sufferInf" value="y" type="radio"></div>
                                                <div class="col-lg-9">
                                                    Yes
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="col-lg-3">
                                                    <input id="suffer" name="sufferInf" value="n" type="radio"></div>
                                                <div class="col-lg-9">
                                                    No
                                                </div>
                                            </div>
                                            <div class="sufferInfo" style="display:none;">
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <label>Attach medical records. </label>
                                                        <input type='file' name="sufferInfo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-12">
                                                <label>Do you have any physical or mental disability? </label>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="col-lg-3">
                                                    <input id="disability" name="disable" value="y" type="radio"></div>
                                                <div class="col-lg-9">
                                                    Yes
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="col-lg-3">
                                                    <input id="disability" name="disable" value="n" type="radio"></div>
                                                <div class="col-lg-9">
                                                    No
                                                </div>
                                            </div>
                                            <div class="disableInfo" style="display:none;">
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <label>Attach relevant documents. </label>
                                                        <input type='file' name="disableInfo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-12">
                                                <label>Have you ever been convicted of any criminal offences? </label>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="col-lg-3">
                                                    <input id="offences" name="crimOffen" value="y" type="radio"></div>
                                                <div class="col-lg-9">
                                                    Yes
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="col-lg-3">
                                                    <input id="offences" name="crimOffen" value="n" type="radio"></div>
                                                <div class="col-lg-9">
                                                    No
                                                </div>
                                            </div>
                                            <div class="offenceInfo" style="display:none;">
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <label>Attach relevant documents. </label>
                                                        <input type='file' name="offenceInfo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
    </div>

</section>
<section id="contact" class="gray-section contact">
    <?php $this->load->view("template/footer"); ?>
</section>
<script src="<?php echo base_url(); ?>assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>

<script>
    $(function () {
        $(function () {
            $(".datepicker").datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: '1950:+0'
            });
        });
    });
    $("#datepicker").datepicker({
        changeMonth: true,
        changeYear: true
    });


    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }


    $(document).on('click', '#MARITAL_STATUS', function () {
        $("#SN").toggle();
    });

    //VALIDATION-----------
    $(document).on('blur', '#firstName', function () {
        var str = $(this).val();
        if (str.length < 3) {
            $(".firstName_validation").html('Minimum three characters.');
        } else {
            $(".firstName_validation").html('');
        }
    });

    $(document).on('blur', '#middleName', function () {
        var str = $(this).val();
        if (str.length < 3) {
            $(".middleName_validation").html('Minimum three characters.');
        } else {
            $(".middleName_validation").html('');
        }
    });

    $(document).on('blur', '#lastName', function () {
        var str = $(this).val();
        if (str.length < 3) {
            $(".lastName_validation").html('Minimum three characters.');
        } else {
            $(".lastName_validation").html('');
        }
    });

    $(document).on('blur', '#bnName', function () {
        var str = $(this).val();
        if (str.length < 3) {
            $(".bnName_validation").html('Minimum three characters.');
        } else {
            $(".bnName_validation").html('');
        }
    });

    $(document).on('blur', '#fatherName', function () {
        var str = $(this).val();
        if (str.length < 3) {
            $(".fatherName_validation").html('Minimum three characters.');
        } else {
            $(".fatherName_validation").html('');
        }
    });

    $(document).on('blur', '#motherName', function () {
        var str = $(this).val();
        if (str.length < 3) {
            $(".motherName_validation").html('Minimum three characters.');
        } else {
            $(".motherName_validation").html('');
        }
    });

    $(document).on('blur', '#contactNo', function () {
        var str = $(this).val();
        if (str.length == '11') {
            $(".contact_validation").html('');
        } else {
            $(".contact_validation").html('Invalid Contact No.');
        }
    });

    $(document).on('blur', '#contactNo2', function () {
        var str = $(this).val();
        if (str.length == '11') {
            $(".contact2_validation").html('');
        } else {
            $(".contact2_validation").html('Invalid Contact No.');
        }
    });

    $(document).on('blur', '#fatherContact', function () {
        var str = $(this).val();
        if (str.length == '11') {
            $(".father_contact_validation").html('');
        } else {
            $(".father_contact_validation").html('Invalid Contact No.');
        }
    });

    $(document).on('blur', '#motherContact', function () {
        var str = $(this).val();
        if (str.length == '11') {
            $(".mother_contact_validation").html('');
        } else {
            $(".mother_contact_validation").html('Invalid Contact No.');
        }
    });


    $(document).on('click', '#foreignStudent', function () {
        $('.foreign').toggle();
    });


    $(document).on('blur', '#email', function () {
        var str = $(this).val();
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(str)) {
            $(".email_validation").html('Invalid Email Address');
        } else {
            $(".email_validation").html('');
        }

    });

    $(document).on('blur', '#fatherEmail', function () {
        var str = $(this).val();
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(str)) {
            $(".father_email_validation").html('Invalid Email Address');
        } else {
            $(".father_email_validation").html('');
        }

    });

    $(document).on('blur', '#motherEmail', function () {
        var str = $(this).val();
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(str)) {
            $(".mother_email_validation").html('Invalid Email Address');
        } else {
            $(".mother_email_validation").html('');
        }

    });

    $(document).on('blur', '#nationalID', function () {
        var str = $(this).val();
        if (str.length == '13' || str.length == '17') {
            $(".nationalID_validation").html('');
        } else {

            $(".nationalID_validation").html('Invalid National ID Number');
        }
    });

    $(document).on('blur', '#fatherNationalID', function () {
        var str = $(this).val();
        if (str.length == '13' || str.length == '17') {
            $(".father_nationalID_validation").html('');
        } else {

            $(".father_nationalID_validation").html('Invalid National ID Number');
        }
    });


    $(document).on('blur', '#mothrNationalID', function () {
        var str = $(this).val();
        //alert(str.length);
        if (str.length == '13' || str.length == '17') {
            $(".mother_nationalID_validation").html('');
        } else {

            $(".mother_nationalID_validation").html('Invalid National ID Number');
        }
    });

    $(document).on('click', '#sameAddr', function () {
        if ($('input[name="sameAddress"]:checked').val() == 1) {
            var addValue = $('textarea#presentAdd').val();
            $('textarea#parmanentAdd').val(addValue);
        } else {
            $('textarea#parmanentAdd').val('');
        }
    });

    $(document).on('click', '#diffGuardian', function () {
        $('.guardian').toggle();
    });

    $(document).on('click', '#engIel', function () {
        $('.formIelts').toggle();
    });

    $(document).on('click', '#engTof', function () {
        $('.formTofel').toggle();
    });

    $(document).on('click', '#engSat', function () {
        $('.formSAT').toggle();
    });

    $(document).on('click', '#engGre', function () {
        $('.formGRE').toggle();
    });

    $(document).on('click', '#emergencyCon', function () {
        if ($('input[name="emergencyPer"]:checked').val() == "g") {
            $('.guardian').show();
        } else {
            $('.guardian').hide();
        }
    });

    $(document).on('click', '#addExam', function () {
        var exam = $('.examName :selected').text();
        var exam_val = $('.examName :selected').val();

        var examBrd = $('.examBoard :selected').text();
        var examBrd_val = $('.examBoard :selected').val();

        var examGrp = $('.examGroup :selected').text();
        var examGrp_val = $('.examGroup :selected').val();

        var examYr = $('.examYear').val();
        var examGp = $('.examGPA').val();
        var examIns = $('.examInstitute').val();

        $(".exam-table tbody").append(
            '<tr>'
            + '<td>' + exam + '</td>'
            + '<td>' + examBrd + '</td>'
            + '<td>' + examGrp + '</td>'
            + '<td>' + examYr + '</td>'
            + '<td>' + examGp + '</td>'
            + '<td>' + examIns + '</td>'
            + '</tr>'
        );
    });
    $(document).on('click', '#addExperience', function () {
        var org = $('.orgName').val();
        var desg = $('.desig').val();
        var sup = $('.supervisor').val();
        var todate = $('.toDate').val();
        var fromdate = $('.fromDate').val();
        $(".experience-table tbody").append(
            '<tr>'
            + '<td>' + org + '</td>'
            + '<td>' + desg + '</td>'
            + '<td>' + todate + '<br>' + fromdate + '</td>'
            + '<td>' + sup + '</td>'
            + '</tr>'
        );
    });

    $(document).on('click', '#spouse', function () {
        if ($('input[name="source"]:checked').val() == "sp") {
            $('.spouseInfo').show();
        } else {
            $('.spouseInfo').hide();
        }
    });

    $(document).on('click', '#workEx', function () {
        if ($('input[name="workExp"]:checked').val() == "y") {
            $('.workExper').show();
        } else {
            $('.workExper').hide();
        }
    });

    $(document).on('click', '#admiTest', function () {
        if ($('input[name="adTest"]:checked').val() == "y") {
            $('.adRollNo').show();
        } else {
            $('.adRollNo').hide();
        }
    });

    $(document).on('click', '#regist', function () {
        if ($('input[name="registered"]:checked').val() == "y") {
            $('.adIdNo').show();
        } else {
            $('.adIdNo').hide();
        }
    });

    $(document).on('click', '#siblin', function () {
        if ($('input[name="siblings"]:checked').val() == "y") {
            $('.sibId').show();
        } else {
            $('.sibId').hide();
        }
    });

    $(document).on('click', '#discon', function () {
        if ($('input[name="discontinue"]:checked').val() == "y") {
            $('.disconCoz').show();
        } else {
            $('.disconCoz').hide();
        }
    });

    $(document).on('click', '#suffer', function () {
        if ($('input[name="sufferInf"]:checked').val() == "y") {
            $('.sufferInfo').show();
        } else {
            $('.sufferInfo').hide();
        }
    });

    $(document).on('click', '#disability', function () {
        if ($('input[name="disable"]:checked').val() == "y") {
            $('.disableInfo').show();
        } else {
            $('.disableInfo').hide();
        }
    });

    $(document).on('click', '#offences', function () {
        if ($('input[name="crimOffen"]:checked').val() == "y") {
            $('.offenceInfo').show();
        } else {
            $('.offenceInfo').hide();
        }
    });

    function upload_img(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img_id').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).ready(function () {
        $("#wizard").steps();
        $("#form").steps({
            bodyTag: "fieldset",
            onStepChanging: function (event, currentIndex, newIndex) {
                // Always allow going backward even if the current step contains invalid fields!
                if (currentIndex > newIndex) {
                    return true;
                }

                // Forbid suppressing "Warning" step if the user is to young
                if (newIndex === 3 && Number($("#age").val()) < 18) {
                    return false;
                }

                var form = $(this);

                // Clean up if user went backward before
                if (currentIndex < newIndex) {
                    // To remove error styles
                    $(".body:eq(" + newIndex + ") label.error", form).remove();
                    $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                }

                // Disable validation on fields that are disabled or hidden.
                form.validate().settings.ignore = ":disabled,:hidden";

                // Start validation; Prevent going forward if false
                return form.valid();
            },
            onStepChanged: function (event, currentIndex, priorIndex) {
                // Suppress (skip) "Warning" step if the user is old enough.
                if (currentIndex === 2 && Number($("#age").val()) >= 18) {
                    $(this).steps("next");
                }

                // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                if (currentIndex === 2 && priorIndex === 3) {
                    $(this).steps("previous");
                }
            },
            onFinishing: function (event, currentIndex) {
                var form = $(this);

                // Disable validation on fields that are disabled.
                // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                form.validate().settings.ignore = ":disabled";

                // Start validation; Prevent form submission if false
                return form.valid();
            },
            onFinished: function (event, currentIndex) {
                var form = $(this);

                // Submit form input
                form.submit();
            }
        }).validate({
            errorPlacement: function (error, element) {
                element.before(error);
            },
            rules: {
                confirm: {
                    equalTo: "#password"
                }
            }
        });
    });


    $(document).on("click", "#PRES_ADDRESS", function () {
        $("#present_address").toggle();
    });

    $(document).on("click", "#PARM_ADDRESS_YES", function () {
        $("#permanent_address").hide();
    });
    $(document).on("click", "#PARM_ADDRESS_NO", function () {
        $("#permanent_address").show();
    });

    $(document).on("change", "#DIVISION_ID", function () {
        $("#THANA_ID").val("");
        $("#POLICE_STATION_ID").val("");
        $("#POST_OFFICE_ID").val("");
        $("#UNION_ID").val("");
        var DIVISION_ID = $(this).val();

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admission/dis_by_div_id',
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
            url: '<?php echo base_url(); ?>admission/up_thana_by_dis_id',
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
            url: '<?php echo base_url(); ?>admission/union_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#UNION_ID").html(data)
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admission/police_station_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#POLICE_STATION_ID").html(data)
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admission/post_office_by_thana_id',
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
            url: '<?php echo base_url(); ?>admission/dis_by_div_id',
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
            url: '<?php echo base_url(); ?>admission/up_thana_by_dis_id',
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
            url: '<?php echo base_url(); ?>admission/union_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#P_UNION_ID").html(data)
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admission/police_station_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#P_POLICE_STATION_ID").html(data)
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admission/post_office_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#P_POST_OFFICE_ID").html(data)
            }
        });
    });


    $(document).on("change", "#G_DIVISION_ID", function () {
        $("#P_THANA_ID").val("");
        $("#P_POLICE_STATION_ID").val("");
        $("#P_POST_OFFICE_ID").val("");
        $("#P_UNION_ID").val("");
        var DIVISION_ID = $(this).val();

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admission/dis_by_div_id',
            data: {DIVISION_ID: DIVISION_ID},
            success: function (data) {
                $("#G_DISTRICT_ID").html(data)
            }
        });
    });
    $(document).on("change", "#G_DISTRICT_ID", function () {
        $("#G_THANA_ID").val("");
        $("#G_POLICE_STATION_ID").val("");
        $("#G_POST_OFFICE_ID").val("");
        $("#G_UNION_ID").val("");
        var DISTRICT_ID = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admission/up_thana_by_dis_id',
            data: {DISTRICT_ID: DISTRICT_ID},
            success: function (data) {
                $("#G_THANA_ID").html(data)
            }
        });

    });

    $(document).on("change", "#G_THANA_ID", function () {
        var THANA_ID = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admission/union_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#G_UNION_ID").html(data)
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admission/police_station_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#G_POLICE_STATION_ID").html(data)
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admission/post_office_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#G_POST_OFFICE_ID").html(data)
            }
        });
    });
</script>
