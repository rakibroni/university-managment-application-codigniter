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
    <h4 style="width:100%;text-align:center; margin:10px 0 0 0; line-height:18px;">Result Sheet</h4><br>
    <div style="margin:0 auto; width:675px;">

        <div>
            <div class="table-responsive">
                <div class="row">
<!--                    <h5 style="text-align: center"><b><span style="color: green;">--><?php //echo $session_name->SESSION_NAME; ?><!--  Course Curriculum</span></b>-->
                    </h5>

                </div>
                <div class="row">

                    <table class="table table-responsive" style="border-collapse:collapse;">

                        <tr class="info">
                            <!--            <th><input type="checkbox" id="checkAllBox" > All</th>-->
                            <th>Reg. No.</th>
                            <th>Name</th>

                            <?php foreach($exam_type as $row) : ?>
                                <th class="text-center"><?php echo $row->EX_TITLE; ?></th>
                            <?php endforeach; ?>
                            <th>Final Marks</th>
                            <th class="text-center">Final Grade</th>
                        </tr>

                        <tbody>
                        <?php  foreach($student_list as $stu_list): ?>
                            <tr>
                                <!--                <td><input type="checkbox" class="check" name="STUDENT_ID[]" value="--><?php //echo $stu_list->STUDENT_ID ?><!--"></td>-->
                                <td style="padding: 5px"><?php echo $stu_list->REGISTRATION_NO ?></td>
                                <td><?php echo $stu_list->FULL_NAME_EN ?></td>

                                <?php foreach($exam_type as $row) : ?>
                                    <!--                    <td><div class="has-success"><input name="exam_mark[]" class="form-control text-center"></div></td>-->
                                    <td style="text-align: center">86</td>
                                <?php endforeach; ?>
                                <td style="text-align: center">93</td>
                                <td style="text-align: center">A</td>
                            </tr>
                            <?php

                            ?>

                        <?php endforeach; ?>
                        </tbody>
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
