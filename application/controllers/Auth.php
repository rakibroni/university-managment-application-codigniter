    <?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Auth extends CI_Controller
    {
        

        /**
         * @methodName login()
         * @access
         * @param
         * @author      Rakib Roni <rakib@atilimited.net>
         * @return      login template
         */
        function login()
        {  
         

            if ($this->session->userdata('logged_in') == TRUE) {
                redirect('admin/index', 'refresh');
            }

            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            $this->form_validation->set_rules('user_name', 'Username', 'required|callback_username_check');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data['organization_info']=$this->utilities->findByAttribute('sa_organizations', array('STATUS' => 1));
            // print_r($data);exit;
                $this->load->view('login',$data);
            } else {
                $session_info = $this->session->userdata('logged_in');
              
                if ($session_info['ACTIVE_STATUS'] == 1) {
                    $this->session->set_flashdata('Info', "Welcome To Student Management System Application!");
                    redirect('admin/index', 'refresh');
                }
            }
            
        }


        /**
         * @methodName  forgotPasswordStudent()
         * @access
         * @param
         * @author      Abhijit M. Abhi <abhijit@atilimited.net>
         * @return
         */

        function forgotPassword()
        {
            $this->form_validation->set_rules('user_email', 'User Email', 'required|callback_checkUser');
            $data['organization_info']=$this->utilities->findByAttribute('sa_organizations', array('STATUS' => 1));
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('password_retrieve',$data);
            } else {
                $data['user_email'] = $this->input->post('user_email');
                $this->load->view('set_new_password', $data);
            }
        }

        /**
         * @methodName
         * @access
         * @param
         * @author      Abhijit M. Abhi <abhijit@atilimited.net>
         * @return
         */


        function resetAdminPassword()
        {
            $new_password = $this->input->post('new_pass');
            $email = $this->input->post('user_email');

            // add additional parameters
            $options = array(
                'cost' => 11,
                'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
            );
            // creating the salt
            $h_pass = password_hash($new_password, PASSWORD_BCRYPT, $options);

            $user_info = $this->db->join('sa_users b', 'b.EMP_ID=a.EMP_ID')->get_where('hr_emp a', array ('a.EMAIL' => $email) )->row();

            $this->db->query("UPDATE sa_users a JOIN hr_emp b ON a.EMP_ID=b.EMP_ID SET a.USERPW = '$h_pass' WHERE b.EMAIL='$email'");

            $message = "<br>Please visit this link for login<br>" . base_url("auth/login") . " <br>Your login details.<br /> User Name:<b> " . $user_info->USERNAME . '</b><br> Password:<b>' . $new_password . '</b><br>Thanks <br> KYAU';
            $subject = "KYAU Applicant New Login Password";

            require 'gmail_app/class.phpmailer.php';
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = "mail.harnest.com";
            $mail->Port = "465";
            $mail->SMTPAuth = true;
            $mail->Username = "support@harnest.com";
            $mail->Password = "Ati@2017";
            $mail->SMTPSecure = 'ssl';
            $mail->From = "support@harnest.com";
            $mail->FromName = "HEQEP";
            $mail->AddAddress($email);
            //$mail->AddReplyTo($emp_info->EMPLOYEE);
            $mail->IsHTML(TRUE);
            $mail->Subject = $subject;
            $mail->Body = $message;

            if ($mail->Send()) {

                $this->session->set_flashdata('msg', 'Your password has sent to your mail.');
                redirect("auth/login");

            }


        }


        /**
         * @methodName
         * @access
         * @param
         * @author      Abhijit M. Abhi <abhijit@atilimited.net>
         * @return
         */


        function checkUser($user_email)
        {
            $mobile_digit = $this->input->post('mobile_digit');

            $this->load->model('auth_model');

            $result = $this->auth_model->userCredentials($user_email, $mobile_digit);

            if (!empty($result)) {

                if ($result->EMAIL != '') {
                    return TRUE;
                } else {

                    $this->form_validation->set_message('checkUser', 'Something Wrong');
                    return false;
                }
            } else {

                $this->form_validation->set_message('checkUser', 'Sorry, we didn\'t recognise your credentials');
                return false;
            }
        }


        /**
         * @methodName checkDatabase()
         * @access
         * @param
         * @author      Rakib Roni <rakib@atilimited.net>
         * @return      check user
         */


        function username_check($username)
        {
            $password = $this->input->post('password');
           //var_dump($password); die();user_name
            $check_user = $this->auth_model->login($username);
            //var_dump($check_user);
            if (!empty($check_user)) {
                if (password_verify($password, $check_user->USERPW)) {

                    $this->session->unset_userdata('logged_in');
                    $admission_session=$this->utilities->findByAttribute('adm_ysession',array('IS_CURRENT'=>1));
                    $aca_session=$this->utilities->findByAttribute('ins_ysession',array('IS_CURRENT'=>1));
                    $sess_array = array(
                        'USER_ID' => $check_user->USER_ID,
                        'USERNAME' => $check_user->USERNAME, 
                        'ORG_ID' => $check_user->ORG_ID,
                        'EMP_ID' => $check_user->EMP_ID,
                        'USER_IMG' => $check_user->USER_IMG,
                        'USER_TYPE' => $check_user->USER_TYPE,
                        'USERGRP_ID' => $check_user->USERGRP_ID,
                        'USERLVL_ID' => $check_user->USERLVL_ID,
                        'ACTIVE_STATUS' => $check_user->ACTIVE_STATUS,  
                        'DEPT_ID' => $check_user->DEPT_ID,
                        'DESIG_ID' => $check_user->DESIG_ID,
                        'IS_ADMIN' => $check_user->IS_ADMIN, 
                        'PKPLUS' => date('y') . '000000000000',
                        'FULL_NAME' => $check_user->FULL_NAME,
                        'ADMISSION_SESSION_ID' => $admission_session->YSESSION_ID, 
                        'SESSION_ID' => $aca_session->YSESSION_ID
                    );
                    if ($check_user->ACTIVE_STATUS != 0) {
                        $this->session->set_userdata('logged_in', $sess_array);
                        date_default_timezone_set("Asia/Dhaka");
                        
            
                        $user_log_data=array(
                            'USER_ID'=>$check_user->USER_ID,
                            'IP_ADDRESS'=>  $this->input->ip_address(),
                            'LOGIN_DATE'=>date('Y-m-d h:i:sa'),
                            'LOG_TYPE'=>'LOG IN',
                            'USERNAME'=>$check_user->USERNAME
                            );
                        $this->utilities->insertData( $user_log_data, 'user_logs');
                        return TRUE;
                    } else {
                        $this->form_validation->set_message('username_check', 'User Account Still Inactivated By the Admin.');
                        return false;
                    }
                } else {
                    $this->form_validation->set_message('username_check', "The Password you entered don't match");
                    return FALSE;
                }
            } else {
                $this->form_validation->set_message('username_check', "The Username you entered don't match");
                return FALSE;
            }
        }

        /**
         * @methodName logut()
         * @access
         * @param
         * @author     Rakib Roni <rakib@atilimited.net>
         * @return     logut user
         */
        function logout()
        {
            date_default_timezone_set("Asia/Dhaka");
           $ses_data= $this->session->userdata('logged_in');
            $user_log_data=array(
                            'USER_ID'=>$ses_data['USER_ID'],
                            'IP_ADDRESS'=>  $this->input->ip_address(),
                            'LOGIN_DATE'=>date('Y-m-d h:i:sa'),
                            'LOG_TYPE'=>'LOG OUT',
                            'USERNAME'=>$ses_data['USERNAME']
                            );
            $this->utilities->insertData( $user_log_data, 'user_logs');
            $this->session->unset_userdata('logged_in');
            redirect('auth/login', 'refresh');
        }

        /**
         * @methodName  studentLogin()
         * @access
         * @param
         * @author      Rakib Roni <rakib@atilimited.net>
         * @return      Student login template
         */
        function studentLogin()
        {
            if ($this->session->userdata('stu_logged_in') == TRUE) {
                redirect('student/index', 'refresh');
            }
            $this->form_validation->set_rules('stu_user_name', 'Username', 'required|callback_checkStudentLogin');
            $this->form_validation->set_rules('stu_password', 'Password', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('student_login');
            } else {
                $session_info = $this->session->userdata('stu_logged_in');

                if ($session_info['ACTIVE_STATUS'] == 1) {
                    //  $this->session->set_flashdata('Info', "Welcome To KYAU - Student Panel!");
                    redirect('student/index', 'refresh');
                }
            }
        }

        /**
         * @methodName  forgotPasswordStudent()
         * @access
         * @param
         * @author      Abhijit M. Abhi <abhijit@atilimited.net>
         * @return
         */

        function forgotStudentPassword()
        {
            $this->form_validation->set_rules('stu_reg_no', 'Registration No.', 'required|callback_checkStudentReg');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('student_password_retrieve');
            } else {

                $email = $this->input->post('stu_user_email');

                $user_info = $this->utilities->findByAttribute('student_personal_info', array('EMAIL_ADRESS' => $email));


                $message = "<br>Please visit this link for login<br>" . base_url("auth/studentLogin") . " <br>Your login details.<br /> Registration No:<b> " . $user_info->REGISTRATION_NO . '</b><br> Password:<b>' . $user_info->LOGIN_PASSWORD . '</b><br>Thanks <br> KYAU';
                $subject = "KYAU Applicant New Login Password";

                require 'gmail_app/class.phpmailer.php';
                $mail = new PHPMailer;
                $mail->IsSMTP();
                $mail->Host = "mail.harnest.com";
                $mail->Port = "465";
                $mail->SMTPAuth = true;
                $mail->Username = "support@harnest.com";
                $mail->Password = "Ati@2017";
                $mail->SMTPSecure = 'ssl';
                $mail->From = "support@harnest.com";
                $mail->FromName = "HEQEP";
                $mail->AddAddress($email);
                //$mail->AddReplyTo($emp_info->EMPLOYEE);
                $mail->IsHTML(TRUE);
                $mail->Subject = $subject;
                $mail->Body = $message;

                if ($mail->Send()) {

                    $this->session->set_flashdata('msg', 'Your password has sent to your mail.');
                    redirect("auth/studentLogin");
                }
            }
        }



        /**
         * @methodName
         * @access
         * @param
         * @author      Abhijit M. Abhi <abhijit@atilimited.net>
         * @return
         */


        function checkStudentReg($stu_reg_no)
        {
            $stu_user_email = $this->input->post('stu_user_email');
            $stu_mobile = $this->input->post('stu_mobile');

            $this->load->model('auth_model');

            $result = $this->auth_model->studentCredentials($stu_reg_no, $stu_user_email, $stu_mobile);

            if (!empty($result)) {

                if ($result->EMAIL_ADRESS != '') {
                    return TRUE;
                } else {

                    $this->form_validation->set_message('checkStudentReg', 'Something Wrong');
                    return false;
                }
            } else {

                $this->form_validation->set_message('checkStudentReg', 'Sorry, we didn\'t recognise your credentials');
                return false;
            }
        }


        /**
         * @methodName checkStudentLogin()
         * @access
         * @param
         * @author      Rakib Roni <rakib@atilimited.net>
         * @return      check studnet login permission
         */
        function checkStudentLogin($stu_user_name)
        {

            $password = $this->input->post('stu_password');
            //$hashPassword = $this->utilities->get_field_value_by_attribute('sa_users', 'USERPW', array('USERNAME' => $username));
            $result = $this->auth_model->stuLogin($stu_user_name, $password);

            //if (password_verify($password, $hashPassword)) {
            if (!empty($result)) {

                $this->session->unset_userdata('stu_logged_in');

                $sess_array = array(
                    'STUDENT_ID' => $result->STUDENT_ID,
                    'ROLL_NO' => $result->REGISTRATION_NO,
                    'FULL_NAME_EN' => $result->FULL_NAME_EN,
                    'SESSION_ID' => $result->SESSION_ID,                
                    'DEPT_ID' => $result->DEPT_ID,
                    'PROGRAM_ID' => $result->PROGRAM_ID,
                    'BATCH_ID' => $result->BATCH_ID,
                    'SECTION_ID' => $result->SECTION_ID, 
                    'PHOTO' => $result->PHOTO, 
                    'ACTIVE_STATUS' => $result->ACTIVE_STATUS
                );
                if ($result->ACTIVE_STATUS != 0) {
                    $this->session->set_userdata('stu_logged_in', $sess_array);
                    return TRUE;
                } else {
                    $this->form_validation->set_message('checkStudentLogin', 'User Account Still  Inactivated By the Admin.');
                    return false;
                }
            } else {
                $this->form_validation->set_message('checkStudentLogin', 'Whoops! We didn\'t recognise your username or password. Please try again.');
                return false;
            }
        }

        /**
         * @methodName stuLogout()
         * @access
         * @param
         * @author      Rakib Roni <rakib@atilimited.net>
         * @return      this function use for student log out
         */
        function stuLogout()
        {
            $this->session->unset_userdata('stu_logged_in');
            redirect('auth/studentLogin', 'refresh');
        }

        /**
         * @methodName  parentsLogin()
         * @access
         * @param
         * @author      Rakib Roni <rakib@atilimited.net>
         * @return      parents login page
         */
        function parentsLogin()
        {
            if ($this->session->userdata('parents_logged_in') == TRUE) {
                redirect('parents/index', 'refresh');
            }
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            $this->form_validation->set_rules('parents_user_name', 'Username', 'required|callback_checkParentsLogin');
            $this->form_validation->set_rules('parents_password', 'Password', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('parents_login');
            } else {
                $session_info = $this->session->userdata('parents_logged_in');
                if ($session_info['ACTIVE_STATUS'] == 1) {
                    $this->session->set_flashdata('Info', "Welcome To KYAU - Parents Panel!");
                    redirect('parents/index', 'refresh');
                }
            }
        }

        /**
         * @methodName checkParentsLogin()
         * @access
         * @param
         * @author      Rakib Roni <rakib@atilimited.net>
         * @return      check parents credential and create parents session
         */
        function checkParentsLogin($parents_user_name)
        {
            $password = $this->input->post('parents_password');
            $check_user = $this->auth_model->parentsLogin($parents_user_name);
            //echo $check_user;exit;
            if (!empty($check_user)) {
                if ($password === $check_user->PASSWORD) {


                    $sess_array = array(
                        'PARENT_PRO_ID' => $check_user->PARENT_PRO_ID,
                        'MOBILE_NO' => $check_user->MOBILE_NO,
                        'ACTIVE_STATUS' => $check_user->ACTIVE_STATUS,
                        'USER_TYPE' => 'Parents'
                    );
                    if ($check_user->ACTIVE_STATUS != 0) {
                        $this->session->set_userdata('parents_logged_in', $sess_array);
                        return TRUE;
                    } else {
                        $this->form_validation->set_message('checkParentsLogin', 'User Account Still Inactivated By the Admin.');
                        return false;
                    }
                } else {
                    $this->form_validation->set_message('checkParentsLogin', "The Password you entered don't match");
                    return FALSE;
                }
            } else {
                $this->form_validation->set_message('checkParentsLogin', "The Username you entered don't match");
                return FALSE;
            }
        }

        function parentsLogout()
        {
            $this->session->unset_userdata('parents_logged_in');
            redirect('auth/parentsLogin', 'refresh');
        }


        function teacher()
        {
            if ($this->session->userdata('tr_logged_in') == TRUE) {
                redirect('teacher/index', 'refresh');
            }
            $this->form_validation->set_rules('tr_user_name', 'Username', 'required|callback_checkteacherLogin');
            $this->form_validation->set_rules('tr_password', 'Password', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('teacher_login');
            } else {
                $session_info = $this->session->userdata('tr_logged_in');

                if ($session_info['ACTIVE_STATUS'] == 1) {
                    //  $this->session->set_flashdata('Info', "Welcome To KYAU - Student Panel!");
                    redirect('teacher/index', 'refresh');
                }
            }
        }

        function checkteacherLogin($tr_user_name)
        {

            $password = $this->input->post('tr_password');
            //$hashPassword = $this->utilities->get_field_value_by_attribute('sa_users', 'USERPW', array('USERNAME' => $username));
            $result = $this->auth_model->trLogin($tr_user_name, $password);

            //if (password_verify($password, $hashPassword)) {
            if (!empty($result)) {
                $sess_array = array(
                    'TEACHER_ID' => $result->TEACHER_ID,
                    'USER_NAME' => $result->USER_NAME,
                    'FULL_NAME_EN' => $result->FULL_NAME_EN,
                    'PASSWORD' => $result->PASSWORD,
                    'TEACHER_PHOTO' => $result->TEACHER_PHOTO,
                    'USER_TYPE' => 'Teacher',
                    'ACTIVE_STATUS' => $result->ACTIVE_STATUS
                );
                if ($result->ACTIVE_STATUS != 0) {
                    $this->session->set_userdata('tr_logged_in', $sess_array);
                    return TRUE;
                } else {
                    $this->form_validation->set_message('check_database', 'User Account Still  Inactivated By the Admin.');
                    return false;
                }
            } else {
                $this->form_validation->set_message('check_database', 'Whoops! We didn\'t recognise your username or password. Please try again.');
                return false;
            }
        }

        function trLogout()
        {
            $this->session->unset_userdata('tr_logged_in');
            redirect('auth/teacher', 'refresh');
        }

      

    }
