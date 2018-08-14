<link href="<?php echo base_url(); ?>assets/css/plugins/select2/select2.min.css" rel="stylesheet"/>
<style>
    .sub-header {
        color: #FF4F57;
        font-size: 16px;
    }

    .navbar-default .navbar-nav > li > a {
        color: #000;

    }

    .dropdown-menu li, .dropdown-menu a {
        font-size: 12px;

    }

    .dropdown-menu li {
        color: #333 !important;
           padding: 0px 5px 0px 8px;

    }

    .dropdown-menu a {
        color: #443266 !important;

    }

    .dropdown-menu li ul li:hover {
        background-color: #428BCA;
    }
</style>
<?php
$under_graduate = $this->db->query("select * from ins_program WHERE DEGREE_ID=3")->result();
$post_graduate= $this->db->query("select * from ins_program WHERE DEGREE_ID=4")->result();
$phd = $this->db->query("select * from ins_program WHERE DEGREE_ID=3")->result();
$department = $this->db->query("select * from ins_dept")->result();
$staff_dept = $this->db->query("select * from ins_dept ")->result();
?>
<div class="">
    <div class="container">
        <div class="navbar navbar-default yamm">
            <div class="navbar-header">
                <button type="button" data-toggle="collapse" data-target="#navbar-collapse-grid" class="navbar-toggle">
                    <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div id="navbar-collapse-grid" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown"><a href="<?php echo site_url('portal/index'); ?>">Home</a></li>
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle">About Us<b
                                class="caret"></b></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a tabindex="-1" href="<?php echo site_url('portal/management'); ?>"> Management </a>
                            </li>
                            <li><a tabindex="-1" href="<?php echo site_url('portal/mission_vision'); ?>"> Mission &
                                    Vision </a></li>
                            <li><a tabindex="-1" href="<?php echo site_url('portal/background_history'); ?>"> Background
                                    History </a></li>
                            <li class="divider"></li>
                            <li><a tabindex="-1" href="<?php echo site_url('portal/gallery'); ?>">Gallery </a></li>
                        </ul>
                    </li>
                    <li class="dropdown yamm-fw"><a href="#" data-toggle="dropdown" class="dropdown-toggle">Academic<b
                                class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li class="col-sm-4">
                                <ul class="list-unstyled">
                                    <li><p class="sub-header"><strong>Under Graduate</strong></p></li>

                                    <?php foreach ($under_graduate as $row): ?>
                                        <li>
                                            <a href="#"><?php echo $row->PROGRAM_NAME ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                    <li class="divider"></li>
                                </ul>
                            </li>
                            <li class="col-sm-4">
                                <ul class="list-unstyled">
                                    <li><p class="sub-header"><strong>Post Graduate</strong></p></li>
                                    <?php foreach ($post_graduate as $row): ?>
                                        <li>
                                            <a href="#"><?php echo $row->PROGRAM_NAME ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                    <li class="divider"></li>
                                </ul>
                            </li>
                            <li class="col-sm-4">
                                <ul class="list-unstyled">
                                    <li><p class="sub-header"><strong>Diploma</strong></p></li>
                                    
                                    <li class="divider"></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    
                   
                    <li class="dropdown"><a href="<?php echo  site_url('portal/blog'); ?>">Blog</a></li>
                    <li class="dropdown"><a href="<?php echo site_url('portal/contact'); ?>">Contact</a></li>
                    <li class="dropdown"><a href="<?php echo site_url('portal/signUp'); ?>">Apply Now</a></li>
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle">Login as<b
                                class="caret"></b></a>
                        <ul role="menu" class="dropdown-menu">

                            <li><a tabindex="-1" href="<?php echo site_url('auth/studentLogin'); ?>"> Student</a></li>
                            <li><a tabindex="-1" href="<?php echo site_url('auth/parentsLogin'); ?>"> Parents </a></li>
                            <li><a tabindex="-1" href="<?php echo site_url('portal/login'); ?>"> Applicant </a></li>
                            <li class="divider"></li>
                            <li><a tabindex="-1" href="<?php echo site_url('auth/login'); ?>"> Administrative </a></li>

                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<link href="http://localhost/eums/assets/css/bootstrap.min.css" rel="stylesheet">

<script>
    /*  var ofs = 0;
     var el = document.getElementById('apply_now');

     window.setInterval(function () {
     el.style.background = 'rgba(255,0,0,' + Math.abs(Math.sin(ofs)) + ')';
     ofs += 0.01;
     }, 10); */
    $(document).ready(function () {
        $(document).on('click', '.yamm .dropdown-menu', function (e) {
            e.stopPropagation()
        });
        var viewportWidth = $(window).width();
        if (viewportWidth > 768) {
            $('.navbar .dropdown').hover(function () {
                $(this).find('.dropdown-menu').first().stop(true, true).delay(250).slideDown();
            }, function () {
                $(this).find('.dropdown-menu').first().stop(true, true).delay(100).slideUp()
            });
        } else {
            return false;
        }
    });
</script>
<script src="<?php echo base_url(); ?>assets/js/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>