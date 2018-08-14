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
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
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
    <h4 style="width:100%;text-align:center; margin:10px 0 0 0; line-height:18px;">Employee List</h4><br>
    <div style="margin:0 auto; width:675px;">

        <table  width="100%; ">
            <thead>
            <tr>
                <th width="10%">SN</th>
                <th width="25%">Name</th>
                <th width="25%">Mobile</th>
                <th width="40%">Email</th>
            </tr>
            </thead>
            <tbody>


            <?php if (!empty($emp_list)): ?>
                <?php $sn = 1; ?>
                <?php foreach ($emp_list as $row) { ?>
                    <tr  class="gradeX" id="row_<?php echo $row->EMP_ID; ?>">
                        <td width="10%" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                            <span><?php echo $sn++; ?></span><span class="hidden"
                                                                   id="courseLoad_<?php echo $row->EMP_ID; ?>"></span>
                        </td>
                        <td width="25%" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>

                            <a class="pull-left applicant_details"    type="button"
                               data-user-id="<?php echo $row->EMP_ID ?>" data-toggle="modal"
                               data-target="#applicant_modal">
                                <?php echo $row->FULL_NAME; ?>
                            </a>

                        </td>
                        <td width="25%" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>

                            <a class="pull-left applicant_details"    type="button"
                               data-user-id="<?php echo $row->EMP_ID ?>" data-toggle="modal"
                               data-target="#applicant_modal">
                                <?php echo $row->MOBILE; ?>
                            </a>

                        </td>
                        <td width="40%" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>

                            <a class="pull-left applicant_details"    type="button"
                               data-user-id="<?php echo $row->EMP_ID ?>" data-toggle="modal"
                               data-target="#applicant_modal">
                                <?php echo $row->EMAIL; ?>
                            </a>

                        </td>
                    </tr>
                <?php } ?>
            <?php endif; ?>
            </tbody>
        </table>
        <div class="clearfix"></div>
    </div>
</div>
<!--<div id="footer">-->
<!--    --><?php //echo $html_footer; ?>
<!--</div>-->
</body>
</html>