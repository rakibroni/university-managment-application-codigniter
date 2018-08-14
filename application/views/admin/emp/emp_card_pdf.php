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
    <h4 style="width:100%;text-align:center; margin:10px 0 0 0; line-height:18px;">Employee Card</h4><br>
    <div style="margin:0 auto; width:675px;text-align:center;">
 <table     style=" margin-left:180px;" width="50%" border="1"    >
            <tr >
                <td style="text-align: center;" rowspan="3"><img alt="image" style="width: 60px" src="<?php echo base_url() ?>/upload/employee/photo/<?php echo $emp_info->EMP_IMG ?>"></td>
                <td><?php echo $emp_info->FULL_ENAME;?></td>
            </tr>
            <tr >
                 
                <td><?php echo $emp_info->DESIGNATION;?></td>
            </tr>
            <tr>
                
                <td><?php echo $emp_info->MOBILE;?></td>
            </tr>
            <tr>
                <td style="text-align: center;"><?php echo $emp_info->DEPT_ABBR;?></td>
                <td><?php echo $emp_info->EMAIL;?></td>
            </tr>
        </table> 
        
        <div class="clearfix"></div>
    </div>
</div>
<!--<div id="footer">-->
<!--    --><?php //echo $html_footer; ?>
<!--</div>-->
</body>
</html>