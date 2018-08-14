<?php $stu_session = $this->session->userdata('stu_logged_in'); ?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                    <!--                        <img  style="width: 100px" alt="image" class="img-small" src="<?php echo base_url(); ?>upload/existing_studnet_photo/<?php echo $stu_session['STUD_PHOTO'] ?>" />-->
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"></strong></span></a>
                </div>
                <div class="logo-element">KYAU</div>
            </li>


            <li><a href="<?php echo base_url(); ?>teacher/index"><i class="fa fa-star"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li><a href="<?php echo base_url(); ?>teacher/profile"><i class="fa fa-star"></i> <span class="nav-label">View Profile</span></a>
            </li>
            <li><a href="<?php echo base_url(); ?>teacher/addTeacher"><i class="fa fa-star"></i> <span
                        class="nav-label">Edit Profile</span></a></li>
            <li><a href="<?php echo base_url(); ?>teacher/teacherList"><i class="fa fa-star"></i> <span
                        class="nav-label">Faculty</span></a></li>

            <li class="">
                <a href="#"><i class="fa fa-star"></i> <span class="nav-label">Study Material</span><span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse" style="height: 0px;">
                    <li><a href="<?php echo base_url(); ?>teacher/courseContent"> <span
                                class="nav-label">Distribute</span></a></li>
                    <li><a href="<?php echo base_url(); ?>teacher/contentDisList"></i>Distribute List</a></li>


                </ul>
            </li>
            <li><a href="#"><i class="fa fa-star"></i> <span class="nav-label">Exam</span></a></li>
            <li><a href="<?php echo base_url(); ?>teacher/test"><i class="fa fa-star"></i> <span class="nav-label">Library</span></a>
            </li>
            <li><a href="<?php echo base_url(); ?>teacher/trClassSchedule"><i class="fa fa-star"></i> <span
                        class="nav-label">Class Schedule</span></a></li>
            <li><a href="#"><i class="fa fa-star"></i> <span class="nav-label">To do</span></a></li>
        </ul>

    </div>
</nav>