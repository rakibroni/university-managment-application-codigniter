<!DOCTYPE html>
<html>
<head>
	<title>Email template</title>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <meta http-equiv="Content-Type"  content="text/html,
  image/gif, image/png, image/jpeg, image/bmp, image/webp,multipart/alternative" />
</head>
<body>
  <div style="font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;">
    <table style="width: 100%;">
      <tr>
        <td></td>
        <td bgcolor="#FFFFFF ">
          <div style="padding: 15px; max-width: 800px;margin: 0 auto;display: block; border-radius: 0px;padding: 0px; border: 1px solid lightseagreen;">
            <table style="width: 100%;background: #00b6e2 ;">
              <tr>
                <td></td>
                <td>
                  <div>
                    <table width="100%">
                      <tr>
                        <td rowspan="2" style="text-align:center;padding:10px;">
                          <img style="float:left;width:50px;height:50px;"  src='http://ums.atilimited.net/upload/organization/logo/kyau_web.png' /> 

                         <span style="color:white;float:right;font-size: 13px;font-style: italic;margin-top: 20px; padding:10px; font-size: 14px; font-weight:normal;">
                           "<?php echo $org_info->SLOGAN; ?>."<span></span></span></td>
                         </tr>
                       </table>
                     </div>
                   </td>
                   <td></td>
                 </tr>
               </table>
               <table style="padding: 10px;font-size:14px; width:100%;">
                <tr>
                  <td style="padding:10px;font-size:14px; width:100%;">
                   Dear <?php echo $fullName; ?>,<br><br>Welcome to the University Management community!<br><br> You are one step away to become an user. Please, follow the link below to activate your account. If you cannot click the URL below, please copy and paste it into your web browser.<br><?php echo base_url("") ?> <br>After that, you can immediately start using your new credentials on http://www.kyau.edu.bd<br>Your User Name : <?php echo  $Uemail; ?><br>Password : 123456 <br><br>
                   Thanks and Regards,<br>
                   KYAU<br> 
                   <!-- /Callout Panel -->
                   <!-- FOOTER -->
                 </td>
               </tr>
               <tr>
                 <td>
                   <div align="center" style="font-size:12px; margin-top:20px; padding:5px; width:100%; background:#eee;">
                    © <?php echo date('Y'); ?> <a href="<?php echo $org_info->WEBSITE; ?>" target="_blank" style="color:#333; text-decoration: none;"><?php echo $org_info->ABBR; ?></a>
                  </div>
                </td>
              </tr>
            </table>
          </div>
        </body>
        </html>
