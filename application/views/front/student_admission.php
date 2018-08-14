<div class="ct-site--map ct-u-backgroundGradient">
    <div class="container">
        <div class="ct-u-displayTableVertical text-capitalize">
            <div class="ct-u-displayTableCell">
                <span class="ct-u-textBig">
                    <?php echo $breadcrumbs; ?>
                </span>
            </div>
            <div class="ct-u-displayTableCell text-right">
                <span class="ct-u-textNormal ct-u-textItalic">
                    <a href="<?= base_url(); ?>">Home</a> / <a href="#"><?php echo $breadcrumbs; ?></a>
                </span>
            </div>
        </div>
    </div>
</div>
<section class="ct-u-paddingBoth50 ct-blog" itemscope itemtype="http://schema.org/Blog">
    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <article itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting" class="ct-article">

                    <div class="row">

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Select Program <span
                                    class="mandatory">*</span></label>

                            <div class="col-md-9 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <select class="form-control select" required>
                                        <option></option>
                                        <?php
                                        foreach ($degree as $rows) {
                                            ?>
                                            <option value="<?= $rows->DEGREE_ID ?>"><?= $rows->DEGREE_NAME; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <span class="help-block">Choose Your Program</span>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Applicant Name (Eng)<span class="mandatory">*</span></label>

                            <div class="col-md-4 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" required/>
                                </div>
                                <span class="help-block">Enter Applicant Name in English</span>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Applicant Name (Ban)</label>

                            <div class="col-md-4 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" required/>
                                </div>
                                <span class="help-block">Enter Applicant Name in Bangali</span>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Email Address <span
                                    class="mandatory">*</span></label>

                            <div class="col-md-4 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="emaik" class="form-control" required/>
                                </div>
                                <span class="help-block">Enter Applicant Email Address</span>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Phone Number <span
                                    class="mandatory">*</span></label>

                            <div class="col-md-4 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" required/>
                                </div>
                                <span class="help-block">Enter Applicant Name in Bangali</span>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Father's Name <span
                                    class="mandatory">*</span></label>

                            <div class="col-md-4 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" required/>
                                </div>
                                <span class="help-block">Enter Your Father's Name</span>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Mother's Name <span
                                    class="mandatory">*</span></label>

                            <div class="col-md-4 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" required/>
                                </div>
                                <span class="help-block">Enter Your Mother's Name</span>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Present Address <span
                                    class="mandatory">*</span></label>

                            <div class="col-md-4 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" required/>
                                </div>
                                <span class="help-block">Enter Your Present Address</span>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Permanent Address <span
                                    class="mandatory">*</span></label>

                            <div class="col-md-4 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" required/>
                                </div>
                                <span class="help-block">Enter Your Permanent Address</span>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Date Of Birth <span
                                    class="mandatory">*</span></label>

                            <div class="col-md-4 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon date_test0"><span class="fa fa-pencil"></span></span>
                                    <input id="date_test" type="text" class="form-control datepicker"
                                           value="12-02-2012 "/>
                                </div>
                                <span class="help-block">Select Your Date Of Birth</span>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Gender <span
                                    class="mandatory">*</span></label>

                            <div class="col-md-4 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <select class="form-control select" required>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                        <option value="3">Other</option>


                                    </select>
                                </div>
                                <span class="help-block">Choose Your Gender</span>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Blood Group <span class="mandatory">*</span></label>

                            <div class="col-md-4 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <select class="form-control select" required>
                                        <option value="A+">A Positive</option>
                                        <option value="A-">A Negative</option>
                                        <option value="B+">B Positive</option>
                                        <option value="A-">B Negative</option>
                                        <option value="O+">O Positive</option>
                                        <option value="O-">O Negative</option>
                                        <option value="AB+">AB Positive</option>
                                        <option value="AB-">AB Negative</option>

                                    </select>
                                </div>
                                <span class="help-block">Choose Your Blood Group</span>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Choose Photo <span
                                    class="mandatory">*</span></label>

                            <div class="col-md-4 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="file" class="file-class" style="height:35px;"/>
                                </div>
                                <span class="help-block">Upload Your Photo</span>

                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Father's Occupation<span
                                    class="mandatory">*</span></label>

                            <div class="col-md-3 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control "/>
                                </div>
                                <span class="help-block">Designation</span>

                            </div>
                            <div class="col-md-3 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control "/>
                                </div>
                                <span class="help-block">Phone Number</span>

                            </div>
                            <div class="col-md-4 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control "/>
                                </div>
                                <span class="help-block">Working Area</span>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Mothers's Occupation<span class="mandatory">*</span></label>

                            <div class="col-md-3 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control "/>
                                </div>
                                <span class="help-block">Designation</span>

                            </div>
                            <div class="col-md-3 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control "/>
                                </div>
                                <span class="help-block">Phone Number</span>

                            </div>
                            <div class="col-md-4 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control "/>
                                </div>
                                <span class="help-block">Working Area</span>

                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">PSC Examination<span
                                    class="mandatory">*</span></label>

                            <div class="col-md-3 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control "/>
                                </div>
                                <span class="help-block">Passing Year</span>

                            </div>
                            <div class="col-md-3 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control "/>
                                </div>
                                <span class="help-block">Board Name</span>

                            </div>
                            <div class="col-md-4 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control "/>
                                </div>
                                <span class="help-block">Roll Number</span>

                            </div>
                            <div class="col-md-2">

                            </div>
                            <div class="col-md-3 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control "/>
                                </div>
                                <span class="help-block">GPA</span>

                            </div>
                            <div class="col-md-3 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control "/>
                                </div>
                                <span class="help-block">Session</span>

                            </div>
                            <div class="col-md-4 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control "/>
                                </div>
                                <span class="help-block">Name Of Institute</span>

                            </div>

                        </div>


                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">JSC Examination<span
                                    class="mandatory">*</span></label>

                            <div class="col-md-3 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control "/>
                                </div>
                                <span class="help-block">Passing Year</span>

                            </div>
                            <div class="col-md-3 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control "/>
                                </div>
                                <span class="help-block">Board Name</span>

                            </div>
                            <div class="col-md-4 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control "/>
                                </div>
                                <span class="help-block">Roll Number</span>

                            </div>
                            <div class="col-md-2">

                            </div>
                            <div class="col-md-3 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control "/>
                                </div>
                                <span class="help-block">GPA</span>

                            </div>
                            <div class="col-md-3 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control "/>
                                </div>
                                <span class="help-block">Session</span>

                            </div>
                            <div class="col-md-4 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control "/>
                                </div>
                                <span class="help-block">Name Of Institute</span>

                            </div>

                        </div>


                    </div>

                </article>

            </div>
            <?php include('right_sidebar.php'); ?>
        </div>
    </div>
</section>