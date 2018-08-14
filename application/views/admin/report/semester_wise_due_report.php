<!doctype html>
<html>
<head>
    <link type="text/css" rel="stylesheet"
          href="<?php echo base_url(); ?>resources/assets/css/modules/materialadmin/css/theme-default/bootstrap.css"/>
    <style type="text/css">
        body {
            font-family: Verdana;
        }

        #personal_info {
            border: 0px solid black;
            border-radius: 2px
        }

        #aca_tbl th, #aca_tbl td {
            border: 1px solid black;
            padding: 5px;
        }

        #aca_tbl {
            border-collapse: collapse;
        }

        #footer {
            text-align: center;
        }

        .footer-text {
            text-align: center;
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
    <div id="personal_info">
        <div style="float: left;width:100%" class="text-center">
            <table width="100%">
                <tr>
                    <td style="text-align: center;"><h3>Faculty of <?php echo $faculty->FACULTY_NAME; ?></h3></td>
                </tr>
                <tr>
                    <td style="text-align: center;"><p style=" font-size:14px;">Department
                            of <?php echo $dept->DEPT_NAME; ?><p style=" size:14px;"></td>
                </tr>
                <tr>
                    <td style="text-align: center;"><p style=" font-size:14px;"><?php echo $program->PROGRAM_NAME; ?><p>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;"><p style=" font-size: 13px;"><?php echo $degree->DEGREE_NAME; ?></p>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;"><p style=" font-size: 13px;"><?php echo $semester->SEMESTER_NAME; ?>
                            || <?php echo $session->SESSION_NAME . " (" . $session->YEAR_SETUP_TITLE . ")"; ?></p></td>
                </tr>

            </table>
        </div>
    </div>
    <p>Semester Due Report </p>
    <?php if ($semester_due): ?>
        <table id="aca_tbl" width="100%">
            <thead>
            <tr>
                <td width='5%'>SN</td>
                <td width='10%'>STUDENT ID</td>
                <td width='15%'>NAME</td>
                <td width='30%'>PARTICULARS</td>
                <td width='10%'>DEBIT</td>
                <td width='10%'>CREDIT</td>
                <td width='10%'>DUE</td>
            </tr>
            </thead>
            <tbody>
            <?php
            $sn = 1;
            $due = 0;
            ?>
            <?php foreach ($semester_due as $row): ?>
                <?php
                $due = $row->CR - $row->DR;
                ?>
                <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $row->STUDENT_ID; ?></td>
                    <td><?php echo $row->FULL_NAME_EN; ?></td>
                    <td>
                        <?php
                        $particulr = $this->db->query("SELECT  DISTINCT ac.CHARGE_NAME, pp.PARTICULAR_AMOUNT
                                                            FROM bm_vouchermst bv
                                                            INNER JOIN ac_program_particulars pp on (pp.FACULTY_ID = bv.FACULTY_ID AND pp.DEPT_ID = bv.DEPT_ID AND pp.PROGRAM_ID = bv.PROGRAM_ID AND pp.SESSION_ID = bv.SESSION_ID AND pp.SEMESTER_ID = bv.SEMESTER_ID)
                                                            INNER JOIN ac_academic_charge ac on ac.CHARGE_ID = pp.PARTICULAR_ID
                                                            WHERE  bv.STUDENT_ID = $row->STUDENT_ID")->result();
                        $max = 1;
                        foreach ($particulr as $pr) {
                            echo $pr->CHARGE_NAME . ": " . $pr->PARTICULAR_AMOUNT;
                            if ($max == sizeof($particulr)) {

                            } else {
                                echo "<hr style='margin-top: 5px; margin-bottom: 5px;'>";
                            }
                            $max++;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($row->CR == '') {
                            echo '0';
                        } else {
                            echo $row->CR;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($row->DR == '') {
                            echo '0';
                        } else {
                            echo $row->DR;
                        }
                        ?>
                    </td>
                    <td><?php echo $due; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center text-danger"> Data not found !!</p>
    <?php endif; ?>
</div>
<div id="footer">
    <?php echo $html_footer; ?>
</div>
</body>
</html>