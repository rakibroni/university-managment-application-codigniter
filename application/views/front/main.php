<?= $header; ?>
<body class="cssAnimate ct-headroom--scrollUpMenu">
<div class="ct-preloader">
    <div class="ct-preloader-content"></div>
</div>
<?php echo $main_menu; ?>


<div id="ct-js-wrapper" class="ct-pageWrapper">
    <div class="ct-navbarMobile">
        <a class="navbar-brand" href="<?php echo base_url(); ?>"><img
                src="<?= base_url(); ?>front/assets/images/demo-content/logo.png" alt="Website Logo"> </a>
        <button type="button" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <button type="button" class="ct-navbarCart--mobileIcon">
            <span class="sr-only">Toggle navigation</span>
            <span><i class="fa fa-shopping-cart"></i></span>
        </button>
    </div>
    <div class="ct-topBar text-center">
        <div class="container">
            <ul class="ct-panel--user list-inline text-uppercase pull-left">
                <li><a href="#" class="ct-js-login">login<i class="fa fa-lock"></i></a></li>
                <li><a href="#" class="ct-js-signup">sign up<i class="fa fa-user"></i></a></li>
            </ul>
            <div class="ct-widget--group pull-right">
                <ul class="ct-widget--socials list-inline text-uppercase">
                    <li><a href="https://www.facebook.com/createITpl"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com/createitpl"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="http://www.createit.pl/"><i class="fa fa-wordpress"></i></a></li>
                </ul>
                <!--
                <div class="btn-group">
                    <button type="button" class="btn btn-md dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="<?= base_url(); ?>front/assets/images/flags/png/england.png" alt="UK">English <i class="fa fa-angle-down"></i>
                    </button>
                    
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#"><img src="<?= base_url(); ?>front/assets/images/flags/png/england.png" alt="UK">English</a></li>
                        <li><a href="#"><img src="<?= base_url(); ?>front/assets/images/flags/png/de.png" alt="GER">German</a></li>
                        <li><a href="#"><img src="<?= base_url(); ?>front/assets/images/flags/png/pl.png" alt="PL">Polish</a></li>
                    </ul>
                   
                </div>
                 -->
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <?php echo $rest_menu; ?>
    <!-- Modal -->
    <div class="modal ct-js-searchModal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"><i class="fa fa-close"></i></span></button>
                    <h3 class="modal-title" id="myModalLabel">Search Results</h3>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>

    <div class="modal ct-modal ct-js-modal-login fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"><i class="fa fa-close"></i></span></button>
                    <h3 class="modal-title text-uppercase">Login</h3>
                </div>
                <div class="modal-body">
                    <form class="ct-u-paddingBottom100">
                        <div class="form-group ct-u-marginBottom50">
                            <input placeholder="E-mail" type="text" required="" name="field[]"
                                   class="form-control ct-input--type1 input-hg ct-u-marginBottom50" title="Login">
                            <input placeholder="Password" type="text" required="" name="field[]"
                                   class="form-control ct-input--type1 input-hg ct-u-marginBottom50" title="Password">

                            <div class="ct-checbox--custom">
                                <input id="remember" type="checkbox" name="remember" value="remember">
                                <label for="remember">remember me</label>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg text-uppercase"><span>Sign In</span>
                            </button>
                            <div class="ct-u-marginTop50">
                                <a href="#"><i class="fa fa-info-circle"></i> Forgot Password ?</a>
                                <a href="#"><i class="fa fa-long-arrow-right"></i> Register Now ?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal ct-modal ct-js-modal-signup fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"><i class="fa fa-close"></i></span></button>
                    <h3 class="modal-title text-uppercase">Signup</h3>
                </div>
                <div class="modal-body">
                    <form class="ct-u-paddingBottom100">
                        <div class="form-group ct-u-marginBottom50">
                            <div class="row">
                                <div class="col-md-6">
                                    <input placeholder="Name" type="text" required="" name="field[]"
                                           class="form-control ct-input--type1 input-hg ct-u-marginBottom50"
                                           title="Name">
                                    <input placeholder="Password" type="text" required="" name="field[]"
                                           class="form-control ct-input--type1 input-hg ct-u-marginBottom50"
                                           title="Password">
                                </div>
                                <div class="col-md-6">
                                    <input placeholder="Email" type="text" required="" name="field[]"
                                           class="form-control ct-input--type1 input-hg ct-u-marginBottom50"
                                           title="Email">
                                    <input placeholder="Repeat Password" type="text" required="" name="field[]"
                                           class="form-control ct-input--type1 input-hg ct-u-marginBottom50"
                                           title="Repeat">
                                </div>
                            </div>


                            <div class="ct-checbox--custom">
                                <input id="signup" type="checkbox" name="signup" value="signup">
                                <label for="signup">I agree with <a href="#" class="ct-u-textUnderline">The terms of
                                        use</a> </label>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg text-uppercase"><span>Sign Up</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php echo $slider;
    echo $top_content;
    echo $bottom_effect;
    echo $footer;
    ?>


</div>

<!-- JavaScripts -->

<script src="<?= base_url(); ?>front/assets/js/main-compiled.js"></script>


<!-- switcher -->
<script src="<?= base_url(); ?>/front/demo/js/demo.js"></script>
<script type="text/javascript">
    $('head').append('<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>front/demo/css/demo.css">');
    $('head').append('<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>/front/demo/generator.css">');
</script>


</body>

</html>