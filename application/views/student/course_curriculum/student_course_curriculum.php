<!--<style type="text/css">-->
<!--    table {-->
<!--        border-collapse: collapse;-->
<!--        width: 100%;-->
<!---->
<!--    }-->
<!---->
<!--    table, td, th {-->
<!--        border: 1px solid black;-->
<!--    }-->
<!---->
<!--</style>-->

<?php //$this->load->view("student/common/student_common_js"); ?>


<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Course Curriculum</h5>

        <span><a href="<?php  echo site_url(); ?>/common/coursecurriculum/<?php echo $session.'/'.$program.'/'.$offerType; ?>" target="_blank" class="btn btn-danger btn-xs pull-right "><i class="fa fa-file-pdf-o"></i> Print</a></span>

    </div>
    <div class="ibox-content">
        <?php if ($session_name != 'empty') : ?>

                        <div class="row">
                            <h4 style="width:100%;text-align:center; margin:10px 0 0 0; line-height:18px;">Course Curriculum</h4>
                            <h5 style="text-align: center"><b><span style="color: green;"><?php echo $session_name->SESSION_NAME; ?>  Course Curriculum</span></b>
                            </h5>

                        </div>
                        <div class="row">
                            <center>
                            <?php $total_credit = 0; $flag = 0; ?>

                            <?php foreach ($semester as $row): ?>

                                <?php $total_credit_per_semester = 0; ?>

                                            <?php
                                            $courseOffer = $this->db->query("SELECT a.SEM_COURSE_ID,
                                                                           a.FACULTY_ID,
                                                                           a.DEPT_ID,
                                                                           a.PROGRAM_ID,
                                                                           a.COURSE_ID,
                                                                           a.OFFERED_COURSE_ID,
                                                                           c.COURSE_CODE,
                                                                           c.CREDIT,
                                                                           c.COURSE_TITLE,
                                                                           a.SEMESTER_ID
                                                                           FROM aca_semester_course a
                                                                           LEFT JOIN aca_course_offer b
                                                                           ON a.OFFERED_COURSE_ID = b.OFFERED_COURSE_ID
                                                                           LEFT JOIN aca_course c ON b.COURSE_ID = c.COURSE_ID
                                                                           WHERE     a.PROGRAM_ID =$program
                                                                           AND b.OFFER_TYPE = '$offerType'
                                                                           AND a.SESSION_ID = '$session'
                                                                           AND a.SEMESTER_ID = $row->SL_NO")->result();
                                            foreach ($courseOffer as $rows)
                                            {
                                                $flag = $rows->SEMESTER_ID;
                                            }

                                            if($row->SL_NO != $flag)
                                            {
                                                break;
                                            }

                                            if(!empty($courseOffer)): ?>

                                                <p><b><?php echo $row->SEMESTER_NAME; ?></b></p>
                                                <?php

                                                echo "<table class=\"table \" style='width: 80%'>
                                                      <tr class='info'>
                                                        <th style='width: 20%'>Course Code</th>
                                                        <th style='width: 70%'>Course Name</th>
                                                        <th style='width: 30%'>Credit</th>
                                                      </tr>";

                                                foreach ($courseOffer as $rows) {
                                                    ?>
                                                    <tbody>
                                                    <tr>
                                                        <td><?php echo $rows->COURSE_CODE ?> </td>
                                                        <td><?php echo $rows->COURSE_TITLE ?></td>
                                                        <td style='text-align: center'><?php echo $rows->CREDIT; $total_credit_per_semester += $rows->CREDIT; ?></td>

                                                    </tbody>
                                                    <?php
                                                }

                                                echo "<tr><td colspan='2' style='text-align: right'><b>Total  :</b></td><td style='text-align: center'><b>$total_credit_per_semester</b></td></tr>";
                                                echo  "</table>";

                                                $total_credit += $total_credit_per_semester;

                                            else:

                                            {
                                                continue;
                                            }
                                            endif;

                                            ?>

                            <?php endforeach; ?><br>

                            <table class="table table-striped table-bordered table-hover">
                                <tr class="alert alert-info">
                                    <td style="text-align: center"><b>Total Credit : <?php echo $total_credit; ?></b></td>
                                </tr>
                            </table>
                            </center>
                        </div>
        <?php else: ?>
            <div class="alert alert-danger"><p class="text-center">No Data Found</p></div>
        <?php endif; ?>
    </div>
</div>

