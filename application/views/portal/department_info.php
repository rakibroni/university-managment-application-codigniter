<style type="text/css">
    .panel-body {
        border: 1px solid #1AB394;
    }

</style>
<div class="row">
    <div>
        <h3><a>Department of <?php echo $department->DEPT_NAME; ?></a></h3>

        <div class="hr-line-dashed"></div>
        <br/>
    </div>
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-3"><i class="fa fa-eye"></i>Instruction</a></li>
            <li class=""><a data-toggle="tab" href="#tab-4"><i class="fa fa-book"></i>Course Offered</a></li>
            <span class="pull-right"><li class=""><a
                        href="<?php echo base_url() ?>portal/admissionForm/<?php echo $degree; ?>"><span
                            class="btn btn-danger m-r-sm"><i class="fa fa-laptop"></i>Apply</span></a></li></span>
        </ul>
        <div class="tab-content">
            <div id="tab-3" class="tab-pane active">
                <div class="panel-body">
                    <h3>Admission Requirements for Undergraduate Programs</h3></br>
                    <ul>
                        <li>

                            Minimum GPA of 3.50 in SSC/Equivalent and HSC/Equivalent separately (including additional
                            subject) and a total GPA 8.0
                        </li>
                        <li>
                            Minimum GPA of 2.5 in O-Levels in five subjects and A-Levels in two subjects and total GPA
                            6.0 according to BRAC University scale (A=5, B=4, C=3 and D=2). Subjects with E Grade will
                            not be considered

                        </li>
                        <li>
                            Candidates who have completed higher secondary education (12 years of schooling) under a
                            system different from SSC & HSC or O & A-Levels will have to get approval of the Admission
                            Committee of the University

                        </li>
                        <li>
                            Candidates who have passed from abroad have to submit verified/attested copies of previous
                            academic documents from their institute/Foreign Ministry & Equivalence Certificate from
                            Secondary & Higher Secondary Education Board, Dhaka

                        </li>
                    </ul>
                    <h3>Subject requirements for particular program</h3>
                    <ul>
                        <li>
                            Candidates for Engineering and Physical Sciences (EEE, ECE, CSE, APE & PHY) must have
                            minimum B grade in Physics & Mathematics at HSC or minimum C grade in Physics & Mathematics
                            at A-Levels. Candidates for BSc in Computer Science and BSc in Mathematics must have minimum
                            B grade in Mathematics at HSC or minimum C grade in Mathematics at A-Levels
                        </li>
                        <li>
                            Candidates for BSc in Electronic & Communication Engineering and Electrical & Electronic
                            Engineering having Physics and Mathematics but not Chemistry at HSC or A-Levels must take a
                            remedial course on Chemistry in addition to the courses required for the program

                        </li>
                        <li>
                            Candidates for BSc in Biotechnology and Microbiology should have minimum C grade in Biology
                            and Chemistry at HSC/A-levels. Candidates not having Mathematics at HSC/A-levels must take a
                            remedial course on Mathematics in addition to the courses required for the program

                        </li>
                        <li>
                            Candidates for Bachelor of Pharmacy (Hons) should have minimum B grade in Biology and
                            Chemistry at HSC and SSC levels and C grade in Biology and Chemistry at A and O-Levels.
                            Candidates not having Mathematics at HSC/A-Levels must take a remedial course on Mathematics
                            in addition to the courses required for the program

                        </li>
                    </ul>
                </div>
            </div>
            <div id="tab-4" class="tab-pane">
                <div class="panel-body">
                    <?php $course_offer = $this->utilities->getOfferedCoursesWithProgram($program); ?>
                    <?php if (!(empty($course_offer))): ?>
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Course Code</th>
                                <th>Course Title</th>
                                <th>CREDIT</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $credit = 0; ?>
                            <?php foreach ($course_offer as $row) { ?>
                                <tr>
                                    <td><span class="label label-primary"><?php echo $row->COURSE_CODE; ?></span></td>
                                    <td><?php echo $row->COURSE_TITLE; ?></td>
                                    <td><?php echo $row->CREDIT; ?></td>
                                    <?php
                                    $credit += $row->CREDIT;
                                    ?>
                                </tr>
                            <?php } ?>
                            <tr class="alert alert-info">
                                <td></td>
                                <td>Total Credit</td>
                                <td><span class="badge badge-primary"><?php echo $credit; ?></span></td>


                            </tr>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <span class='text-danger'>Course Offered Not assign !! </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>
