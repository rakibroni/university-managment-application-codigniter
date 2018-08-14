<?php
$stu_session = $this->session->userdata('stu_logged_in');
$stu_id = $stu_session["STUDENT_ID"];
//$user_type = $stu_session["USER_TYPE"];
?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav sidebar-menu" id="side-menu">

            <li class="nav-header" style="padding: 10px 20px 10px 30px;">
                <div class="dropdown profile-element">
                    <?php $photo = ($stu_session['PHOTO'] != '' ? 'upload/student/photo/' . $stu_session['PHOTO'] : 'assets/img/default.png') ?>
                    <img style="width: 60px" alt="image" class="img-small img-circle" src="<?php  echo base_url($photo); ?>" />
                </div>
                <span style="text-align: center;color: #ffffff;"><b><?php  echo $stu_session['FULL_NAME_EN'] ?></b></span>
            </li>
            <li class="">
             <a href="<?php echo site_url(); ?>/student/index"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard </span></a>
         </li>

         <li class="">
            <a href="<?php echo site_url(); ?>/student/coursesAndResult"><i class="glyphicon glyphicon-list"></i> <span class="nav-label">Courses and Results</span></a>
        </li>
        <li class="">
            <a href="<?php echo site_url(); ?>/student/studentCurriculum"><i class="fa fa-bolt"></i> <span class="nav-label">Course Curriculum</span></a>
        </li>
        <li class="">
            <a href="<?php echo site_url(); ?>/student/studentDetails"><i class="fa fa-user"></i> <span class="nav-label">Profile</span></a>
        </li>        
        <li class="">
            <a href="<?php echo site_url(); ?>/student/studentPayment"><i class="fa fa-dollar"></i> <span class="nav-label">Payment</span></a>
        </li>
        <li class="">
          <a href="#"><i class="fa fa-clock-o"></i> <span class="nav-label">Others</span><span  class="fa arrow"></span></a>
           <ul class="nav nav-second-level collapse" style="height: 0px;">
                <li><a href="<?php  echo site_url(); ?>/student/residentApplication">Application For Resident</a></li>
                <li class="">
                    <a href="<?php  echo site_url(); ?>/student/libraryMemberApplication">Application For Library Member</a>
               </li>

                <li class="">
                    <a href="<?php  echo site_url(); ?>/student/libraryMemberItemBorrowHistory">Item Borrow History</a>
               </li>
            </ul>
        </li>

       



        

    <!--            <li class="">-->
        <!--                <a href="#"><i class="fa fa-clock-o"></i> <span class="nav-label">Schedule</span><span-->
            <!--                        class="fa arrow"></span></a>-->
            <!--                <ul class="nav nav-second-level collapse" style="height: 0px;">-->
                <!--                    <li><a href="--><?php //echo base_url(); ?><!--common/classSchedule">Class Schedule</a></li>-->
                <!--                    <li><a href="--><?php //echo base_url(); ?><!--common/examSchedule">Exam Schedule </a></li>-->
                <!--                </ul>-->
                <!--            </li>-->
                <!--            <li class="">-->
                    <!--                <a href="#"><i class="fa fa-dollar"></i> <span class="nav-label">Fees & Payment</span><span-->
                        <!--                        class="fa arrow"></span></a>-->
                        <!--                <ul class="nav nav-second-level collapse" style="height: 0px;">-->
                            <!--                    <li><a href="--><?php //echo base_url(); ?><!--common/allSemesterExpense">Payment History</a></li>-->
                            <!--                    <li><a href="--><?php //echo base_url(); ?><!--student/studentDepositBtn">Bank Deposit </a></li>-->
                            <!--                </ul>-->
                            <!--            </li>-->
                            <!--            <li class="">-->
                                <!--                <a href="#"><i class="fa fa-building"></i> <span class="nav-label">Academic</span><span-->
                                    <!--                        class="fa arrow"></span></a>-->
                                    <!--                <ul class="nav nav-second-level collapse" style="height: 0px;">-->
                                        <!--                    <li><a href="--><?php //echo base_url(); ?><!--student/currentRegCourse">Courses & Result</a></li>-->
                                        <!--                    <li><a href="--><?php //echo base_url(); ?><!--student/registraredCourseBySemester">Course Content</a></li>-->
                                        <!--                    <li><a href="--><?php //echo base_url(); ?><!--common/studentCurriculms">My Curriculums</a></li>-->
                                        <!--                    <li><a href="--><?php //echo base_url(); ?><!--student/assignmentList">Assignment</a></li>-->
                                        <!--                </ul>-->
                                        <!--            </li>-->
<!--            <li class="">
                <a href="#"><i class="fa fa-table"></i> <span class="nav-label">Reports</span><span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse" style="height: 0px;">
                    <li><a href="#">Grades ( By Curriculum ) </a></li>
                    <li><a href="#">Grades ( By Semester ) </a></li>
                </ul>
            </li>-->
<!--            <li class="">
                <a href="#"><i class="fa fa-book"></i> <span class="nav-label">Library</span><span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse" style="height: 0px;">
                    <li><a href="#">Search Books </a></li>
                    <li><a href="#">Current Borrows</a></li>
                    <li><a href="#">Borrow History</a></li>
                    <li><a href="#">Financial</a></li>
                </ul>
            </li>-->
            <!--            <li class="">-->
                <!--                <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Others</span><span-->
                    <!--                        class="fa arrow"></span></a>-->
                    <!--                <ul class="nav nav-second-level collapse" style="height: 0px;">-->
                        <!--                    <li><a href="--><?php //echo base_url(); ?><!--student/applicationForm">Application Forms</a></li>-->
                        <!--                    <li><a href="--><?php //echo base_url(); ?><!--common/allBlogPost">Blog</a></li>-->
                        <!--                    <li><a href="--><?php //echo base_url(); ?><!--student/studentNotice">Notice</a></li>-->
                        <!--                </ul>-->
                        <!--            </li>-->
                        <!--            <li class="">-->
                            <!--                <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Registration</span><span-->
                                <!--                        class="fa arrow"></span></a>-->
                                <!--                <ul class="nav nav-second-level collapse" style="height: 0px;">-->
                                    <!--                    <li><a href="--><?php //echo base_url(); ?><!--student/studentSemesterCourse">Semester Registration </a></li>-->
                                    <!--                    --><?php
//
//
//                    //if(!empty($reg_period))  :      ?>
<!--                    <li><a href="--><?php //echo base_url(); ?><!--student/examRegistration">Exam Registration</a></li>-->
<!--                    --><?php ////endif; ?>
<!--                </ul>-->
<!--            </li>-->


</ul>

</div>
</nav>