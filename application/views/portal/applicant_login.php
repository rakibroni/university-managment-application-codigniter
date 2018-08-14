<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <div class="blog-post-container">

                <div class="ibox-content">
                    <div>
                        <h4>Applicant Sign In</h4>
                        <hr>
                        <div class="col-md-12">
                            <p class="text-justify">If you have already registered, please enter your username and password below to log
                                in.</p>
                            </div>
                            <hr>
                            <div class="col-md-12 text-msg"><span class="msg text-danger"></span></div>

                            <div class="col-md-6">
                                <form class="m-t" role="form" method="post" action="<?php echo site_url()?>/portal/applicantLogin">

                                    <?php if(!empty($msg)) :?>
                                        <div class="alert alert-success col-md-8">
                                            <span class="text-center"><?php echo $msg; ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <div class="col-md-8 form-group">
                                        <input type="text" name="EMAIL" value="" id="EMAIL" class="form-control login-form required"
                                        placeholder="Email Address" required="required">
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="password" name="PASSWORD" value="" id="PASSWORD"
                                        class="form-control login-form required" placeholder="Password" required="required">
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="submit" class="btn btn-primary block full-width btn-xs formSubmit" value="Login">
                                        <a href="<?php echo site_url()?>/portal/forgotPassword">
                                            <small>Forgot password? </small>
                                        </a>
                                    </div>
                                </form>

<!--                                <form role="form" method="post" action="--><?php //echo base_url()?><!--Portal/resetApplicantPassword">-->
<!--                                    -->
<!--                                </form>-->
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- /.blog-post-container -->
            </div>
            <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->


    </div>