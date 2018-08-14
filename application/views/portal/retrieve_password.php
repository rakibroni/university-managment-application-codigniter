<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <div class="blog-post-container">

                <div class="ibox-content">
                    <div>
                        <h4>Forgot Password</h4>
                        <hr>
                        <div class="col-md-12">
                            <p class="text-justify">To retrive your password, please fill up the following fields</p>
                        </div>
                        <hr>
                        <div class="col-md-12 text-msg"><span class="msg text-danger"></span></div>
                        <div class="col-md-6">
                            <form class="m-t" role="form" method="post"
                                  action="<?php echo site_url() ?>/portal/applicantForgotPassword">

                                <?php if (!empty(validation_errors())) : ?>
                                    <div class="alert alert-danger col-md-8">
                                        <span class="text-center"><?php echo validation_errors(); ?></span>
                                    </div>
                                <?php endif; ?>

                                <div class="col-md-8 form-group">
                                    <input type="email" name="EMAIL" value="" id="EMAIL"
                                           class="form-control login-form required"
                                           placeholder="Email Address" required>

                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" maxlength="4" size="4" name="PHONE" id="PHONE"
                                           class="form-control login-form required"
                                           placeholder="Last 4 digit of phone number" required>
                                </div>

                                <div class="col-md-8 form-group">
                                    <input type="submit" class="btn btn-primary block full-width btn-xs formSubmit"
                                           value="Submit">
                                </div>
                            </form>
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