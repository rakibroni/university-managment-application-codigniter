<div class="row border-bottom">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>

            <div role="search" class="navbar-form-custom">
                <div style="padding: 12px">
                    <h4 style="margin:0px !important;padding: 0px !important;"><?php echo $pageContentTitle; ?></h4>
                    <?php if (!empty($breadcrumbs)): ?>
                        <ul class="breadcrumb">
                            <li>You are here</li>
                            <?php
                            foreach ($breadcrumbs as $key => $value):
                                if ($value != '#'):
                                    ?>
                                    <li><a href="<?php echo site_url("$value"); ?>"><?php echo $key; ?></a></li>
                                <?php else: ?>
                                    <li class="active"><?php echo $key; ?></li>
                                <?php
                                endif;
                            endforeach;
                            ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <span class="m-r-sm text-muted welcome-message"> </span>
            </li>


            <li>
                <a href="<?php echo site_url('auth/stuLogout'); ?>">
                    <i class="fa fa-sign-out"></i> Log out
                </a>
            </li>

        </ul>

    </nav>
</div>
<div class="row wrapper border-bottom white-bg page-heading">

    <div class="col-md-4 ">
        <span class=" ">

</span>
    </div>
    <div class="col-md-4 ">
        <span class=" ">

</span>
    </div>
    <div class="col-md-4 ">
        <span class="pull-right ">
        <?php
        $stu_session = $this->session->userdata('stu_logged_in');
        $stu_id = $stu_session["STUDENT_ID"];
        //$student_info = $this->utilities->studentInfo($stu_id);


        if (!empty($student_info)):
            ?>
            <table style="padding:0px;font-size: x-small !important;" class="">
                <tr>
                    <th>Faculty</th>
                    <td> &nbsp;:&nbsp; </td>
                    <td> <?php echo $student_info->FACULTY_NAME ?></td>
                </tr>
                <tr>
                    <th>Dept</th>
                    <td> &nbsp;:&nbsp; </td>
                    <td> <?php echo $student_info->DEPT_NAME ?></td>
                </tr>
                <tr>
                    <th>Program</th>
                    <td> &nbsp;:&nbsp; </td>
                    <td> <?php echo $student_info->PROGRAM_NAME ?></td>
                </tr>
                <tr>
                    <th>Session</th>
                    <td> &nbsp;:&nbsp; </td>
                    <td> <?php echo $student_info->SESSION_NAME ?></td>
                </tr>
                <tr>
                    <th>Semester</th>
                    <td> &nbsp;:&nbsp; </td>
                    <td> <?php echo $student_info->semester ?></td>
                </tr>
            </table>

        <?php endif; ?>
</span>
    </div>
</div>