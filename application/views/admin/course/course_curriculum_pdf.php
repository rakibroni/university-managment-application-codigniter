<!doctype html>
<html>
<head>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>resources/assets/css/modules/materialadmin/css/theme-default/bootstrap.css"/>
    <style type="text/css">
        body {
            font-family: Verdana;
        }
        #footer {
            text-align: center;
        }
        .footer-text {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            border: .5px solid black;
        }

        table, td, th {
            border: 1px solid black;
        }
    </style>
</head>
<body>
<div id="printBox">
    <div style="width: 100%;border-bottom: 2px solid black;">
        <div style="width:10%;float: left;"><img
                style=" border-radius: 3px;margin-bottom: 0px;padding: 0px ;width: 60px"
                src="<?php echo base_url(); ?>assets/img/logo/kyau_web.png"></div>
        <div style="width:80%;float: left;padding-top: 5px"><h2>Khwaja Yunus Ali University</h2></div>
        <div style="width:10%;float: left;margin-bottom: 0px;padding-top: 10px ;"></div>
    </div>
    <h4 style="width:100%;text-align:center; margin:10px 0 0 0; line-height:18px;">Course Curriculum</h4>
    <div style="margin:0 auto; width:675px;">

        <div>
            <div class="table-responsive">
                <div class="row">
                    <h5 style="text-align: center"><b><span style="color: green;"><?php echo $session_name->SESSION_NAME; ?>  Course Curriculum</span></b>
                    </h5>

                </div>
                <div class="row">
                    <?php foreach ($semester as $row): ?>

                        <?php $total_credit_per_semester = 0; ?>
                        <div class="col-lg-12">
                            <div class="ibox">

                                <div class="ibox-content courseView" id="course_<?php echo  $row->SL_NO; ?>">

                                        <?php
                                        $courseOffer = $this->db->query("SELECT a.SEM_COURSE_ID,
                                                                           a.FACULTY_ID,
                                                                           a.DEPT_ID,
                                                                           a.PROGRAM_ID,
                                                                           a.COURSE_ID,
                                                                           a.OFFERED_COURSE_ID,
                                                                           c.COURSE_CODE,
                                                                           c.CREDIT,
                                                                           c.COURSE_TITLE
                                                                           FROM aca_semester_course a
                                                                           LEFT JOIN aca_course_offer b
                                                                           ON a.OFFERED_COURSE_ID = b.OFFERED_COURSE_ID
                                                                           LEFT JOIN aca_course c ON b.COURSE_ID = c.COURSE_ID
                                                                           WHERE     a.PROGRAM_ID =$program
                                                                           AND b.OFFER_TYPE = '$offerType'
                                                                           AND a.SESSION_ID = '$session'
                                                                           AND a.SEMESTER_ID = $row->SL_NO")->result();


                                        if(!empty($courseOffer)): ?>
                                            <p><b><?php echo $row->SEMESTER_NAME; ?></b></p>
                                            <?php

                                            echo "<table>
                                                      <tr>
                                                        <th style='width: 20%'>Course Code</th>
                                                        <th style='width: 80%'>Course Name</th>
                                                        <th style='width: 20%'>Credit</th>
                                                      </tr>";

                                            foreach ($courseOffer as $rows) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $rows->COURSE_CODE ?> </td>
                                                    <td><?php echo $rows->COURSE_TITLE ?></td>
                                                    <td style='text-align: center'><?php echo $rows->CREDIT; $total_credit_per_semester += $rows->CREDIT; ?></td>
                                                </tr>
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
                                </div>
                            </div>
                        </div>
                       
                    <?php endforeach; ?><br>

                    <table style="width: 100%">
                        <tr>
                            <td style="text-align: center"><b>Total Credit : <?php echo $total_credit; ?></b></td>
                        </tr>
                    </table>


                </div>
            </div>

        </div>

        <br><br><br>
        <div style="width: 100%;border-bottom: 1px dotted black;"></div>

        <div class="clearfix"></div>
    </div>
</div>
<div id="footer">
    <?php echo $html_footer; ?>
</div>
</body>
</html>
