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
    <?php
    foreach ($degree as $d) {
        $d_name = $d->DEGREE_NAME;
    }
    ?>

    <div id="personal_info">
        <div style="float: left;width:100%" class="text-center">
            <?php foreach ($info as $value) { ?>
                <table width="100%">
                    <tr>
                        <td style="text-align: center;"><h3>Faculty of <?php echo $value->FACULTY_NAME; ?></h3></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;"><p style=" font-size:14px;">Department
                                of <?php echo $value->DEPT_NAME; ?><p style=" size:14px;"></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;"><p style=" font-size:14px;"><?php echo $value->PROGRAM_NAME; ?>
                            <p></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;"><p style=" font-size: 13px;"><?php echo $d_name; ?>
                                || <?php echo $value->SESSION_NAME . " (" . $value->YEAR_SETUP_TITLE . ")"; ?></p></td>
                    </tr>

                </table>
            <?php } ?>
        </div>
    </div>
    <h4>Semester Courses </h4>
    <table id="aca_tbl" width="100%">
        <thead>
        <tr>
            <th width='16%'>Semester</th>
            <th width='12%'>Code</th>
            <th width='42%'>Course Title</th>
            <th width='10%'>Credits</th>
            <th width='19%'>Semester Credits</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $current_semester = '';
        $i = 1;
        $Credit = 0;
        $row_span = count($courses);
        ?>

        <?php foreach ($courses as $row) { ?>
            <?php
            $c = 0;
            echo "<tr>";
            if ($current_semester != $row->LKP_NAME) {
                $cc = $this->db->query("SELECT COUNT(a.SEM_COURSE_ID) count_c FROM aca_semester_course a
                                                    LEFT JOIN aca_course ac on a.COURSE_ID = ac.COURSE_ID
                                                    WHERE a.SEMESTER_ID = $row->SEMESTER_ID AND a.PROGRAM_ID = $row->PROGRAM_ID AND a.SESSION_ID = $row->SESSION_ID
                                                    ORDER BY a.SEMESTER_ID")->result();
                foreach ($cc as $count) {
                    $c = $count->count_c;
                }
                echo "<td rowspan=" . $c . "><span class='text-info'>" . $row->LKP_NAME . "</span></td>";

            } else {
                //echo "<td>&nbsp;</td>"; # insert empty cell
            }
            $Credit += $row->CREDIT;
            echo "<td>$row->COURSE_CODE</td>";
            echo "<td>$row->COURSE_TITLE</td>";
            echo "<td>$row->CREDIT</td>";

            if ($current_semester != $row->LKP_NAME) {
                $cre = $this->db->query("SELECT SUM(ac.CREDIT) Total_Credit FROM aca_semester_course a
                                            LEFT JOIN aca_course ac on a.COURSE_ID = ac.COURSE_ID
                                            WHERE a.SEMESTER_ID = $row->SEMESTER_ID AND a.PROGRAM_ID = $row->PROGRAM_ID AND a.SESSION_ID = $row->SESSION_ID
                                            ORDER BY a.SEMESTER_ID")->result();
                foreach ($cre as $semester_credit) {
                    $total_cr = $semester_credit->Total_Credit;
                }

                echo "<td rowspan=" . $c . "><span class='badge badge-primary'>" . $total_cr . "</span></td>";
                $current_semester = $row->LKP_NAME;
                $i++;
            } else {
                //echo "<td>&nbsp;</td>"; # insert empty cell
            }

            ?>
                        </tr>
                        <?php } ?>
        <tr class="alert alert-info">

            <td colspan="3">
                <center>Total Credits</center>
            </td>
            <td><span class="badge badge-primary"><?php echo $Credit; ?></span></td>
            <td></td>
        </tr>
        </tbody>
    </table>
</div>
<div id="footer">
    <?php echo $html_footer; ?>
</div>
</body>
</html>