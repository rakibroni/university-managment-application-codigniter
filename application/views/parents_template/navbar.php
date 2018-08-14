<?php
$controller = $this->uri->segment(1);
$action = $this->uri->segment(2);
$user_session = $this->session->userdata('parents_logged_in');
?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav sidebar-menu" id="side-menu">
            <!--Parents navbar -->
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span>  <!--  <img alt="image" class="img-circle" src="<?php /*echo base_url(); */ ?>assets/img/profile_small.jpg" />--></span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"></strong></span></a>
                </div>
                <div class="logo-element">KYAU</div>
            </li>
            <li class=""><a href="<?php echo base_url('parents/index'); ?>"> <i class="fa fa-dashboard"></i> <span
                        class="nav-label">Dashboard</span></a></li>
           <!-- <li class=""><a href="<?php /*echo base_url('parents/profile'); */?>"><i class="fa fa-user "></i> <span
                        class="nav-label">Profile</span> </a></li>
            <li class=""><a href="<?php /*echo base_url('parents/announcement'); */?>"><i class="fa fa-th-large "></i> <span
                        class="nav-label">Announcement</span> </a></li>
            <li class=""><a href="<?php /*echo base_url('parents/index'); */?>"><i class="fa fa-th-large "></i> <span
                        class="nav-label">Grade History</span> </a></li>
            <li class=""><a href="<?php /*echo base_url('parents/index'); */?>"><i class="fa fa-pencil  "></i> <span
                        class="nav-label">Attendance History</span> </a></li>
            <li class=""><a href="<?php /*echo base_url('parents/index/'); */?>"><i class="fa fa-calendar"></i> <span
                        class="nav-label">My Calender</span> </a></li>-->
            <li class=""><a href="<?php echo base_url('common/studentCurriculms'); ?>"><i class="fa fa-list-alt  "></i> <span
                        class="nav-label">Curriculum</span> </a></li>
            <li class=""><a href="<?php echo base_url('common/classSchedule'); ?>"><i class="fa fa-clock-o "></i> <span
                        class="nav-label">Class Schedule</span> </a></li>
            <li class=""><a href="<?php echo base_url('common/examSchedule'); ?>"><i class="fa fa-clock-o "></i> <span
                        class="nav-label">Exam Schedule</span> </a></li>
            <li class=""><a href="<?php echo base_url(); ?>common/allSemesterExpense"><i class="fa fa-usd "></i> <span
                        class="nav-label">Finance</span> </a></li>


            <!--end parents navber menu -->
        </ul>
    </div>
</nav>