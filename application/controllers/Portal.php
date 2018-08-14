<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @category   FrontPortal
 * @package    Portal
 * @author     Jahid Hasan <jahid@atilimited.net>
 * @copyright  2015 ATI Limited Development Group
 */

class Portal extends CI_Controller
{
    /*
     * @methodName index()
     * @access public
     * @param  none
     * @return University portal home page
     */

    public function index()
    {
        
        $data['upcoming_events'] = $this->db->query("SELECT a.*
                                                      FROM event a
                                                      ORDER BY a.CREATE_DATE DESC
                                                      LIMIT 3")->result();
        $this->template->display($data);
    }

    /*
     * @methodName contact()
     * @access public
     * @param  none
     * @author rakib@atilimited.net
     * @return portal contact us page
     */
    function contact()
    {
        $data["breadcrumbs"] = array(
            "Home" => "portal/index",
            "Contact" => '#'
        );
        $data['content_view_page'] = 'portal/contact_us';
        $this->template->display($data);
    }

    /*
     * @methodName blog()
     * @access public
     * @param  none
     * @author rakib@atilimited.net
     * @return portal blog list
     */

    function blog()
    {
        $data["breadcrumbs"] = array(
            "Home" => "portal/index",
            "Blog" => '#'
        );

        $this->load->library('pagination');
        $config = array();
        $config["base_url"] = base_url() . "portal/blog";
        $total_post = $this->db->count_all("blog_post");

        $config["total_rows"] = $total_post;

        $config["per_page"] = 6;
        $config["uri_segment"] = 3;
        $limit = $config["per_page"] = 6;
        //pagination style start
        $config['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';
        $config['full_tag_close'] = '</ul>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="current"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['first_link'] = '&lt;&lt;';
        $config['last_link'] = '&gt;&gt;';
        //pagination style end
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['blog_list'] = $this->db->query("SELECT a.*, b.POST_TAGS,c.FULL_NAME
            FROM blog_post a LEFT JOIN blog_tag b ON a.POST_ID = b.POST_ID
            left join sa_users c on a.ENTERED_BY=c.USER_ID  where a.APPROVE_BY_ADMIN=1 LIMIT $limit OFFSET $page ")->result();
        $data["links"] = $this->pagination->create_links();

        $data['content_view_page'] = 'portal/blog';
        $this->template->display($data);
    }

    function blogDetails($id)
    {
        $data["breadcrumbs"] = array(
            "Home" => "portal/index",
            "Blog" => "#",
            "Details" => '#'
        );

        $data['blog_details']=$this->db->query("select * from blog_post where POST_ID=$id")->row();
        $data['content_view_page'] = 'portal/blog_details';
        $this->template->display($data);
    }

    function management()
    {
        $data["breadcrumbs"] = array(
            "Home" => "portal/index",
            "About Us" => "#",
            "Management" => '#'
        );

        $data['content_view_page'] = 'portal/management';
        $this->template->display($data);
    }

    /*
     * @methodName mission_vision()
     * @access public
     * @param  none
     * @author rakib@atilimited.net
     * @return portal mission and vision
     */
    function mission_vision()
    {
        $data["breadcrumbs"] = array(
            "Home" => "portal/index",
            "About Us" => "#",
            "Mission & Vision" => '#'
        );

        $data['content_view_page'] = 'portal/mission_vision';
        $this->template->display($data);
    }

    function login()
    {
        $data["breadcrumbs"] = array(
            "Home" => "portal/index",
            "Login" => "#",
        );

        $data['content_view_page'] = 'portal/applicant_login';
        $this->template->display($data);
    }

    /*
     * @methodName background_history()
     * @access public
     * @param  none
     * @author rakib@atilimited.net
     * @return portal background history
     */

    function background_history()
    {
        $data["breadcrumbs"] = array(
            "Home" => "portal/index",
            "About Us" => "#",
            "Background History" => '#'
        );

        $data['content_view_page'] = 'portal/background_history';
        $this->template->display($data);
    }

    /*
     * @methodName gallery()
     * @access public
     * @param  none
     * @author rakib@atilimited.net
     * @return portal gallery
     */
    function gallery()
    {
        $data["breadcrumbs"] = array(
            "Home" => "portal/index",
            "About Us" => "#",
            "Gallery" => '#'
        );

        $data['content_view_page'] = 'portal/gallary';
        $this->template->display($data);
    }

    /*
     * @methodName feature()
     * @access public
     * @param  none
     * @author rakib@atilimited.net
     * @return department wise staff list
     */
    function dept_wise_staff($id)
    {
        $data["breadcrumbs"] = array(
            "Home" => "portal/index",
            "Institute" => "#",
            "Staff" => '#'
        );

        $data['dept_wise_staff'] = $this->db->query("SELECT a.*, b.DATH_OF_BIRTH, b.TEACHER_PHOTO
          FROM sa_users a LEFT JOIN teacher_staff_info b ON a.USER_ID = b.USER_ID
          WHERE a.DEPT_ID =$id")->result();
        $data['content_view_page'] = 'portal/dept_wise_staff';
        $this->template->display($data);
    }

    /*
     * @methodName feature()
     * @access public
     * @param  none
     * @author rakib@atilimited.net
     * @return department wise faculty teacher list
     */
    function dept_wise_faculty($id)
    {
        $data["breadcrumbs"] = array(
            "Home" => "portal/index",
            "Institute" => "#",
            "Faculty" => '#'
        );
        $data['dept_wise_faculty'] = $this->db->query("SELECT a.*  FROM sa_users a WHERE a.DEPT_ID =$id")->result();
        $data['content_view_page'] = 'portal/dept_wise_faculty';
        $this->template->display($data);
    }

    function feature()
    {
        $data['pageTitle'] = 'Online University Management System';
        $data['degree'] = $this->db->query("select * from degree")->result();
        $data['content_view_page'] = 'portal/feature';
        $this->template->display($data);
    }


    function facultyDetails()
    {
        $data['pageTitle'] = 'Online University Management System';
        $data['degree'] = $this->db->query("select * from degree")->result();
        $data['content_view_page'] = 'portal/faculty_index';
        $this->template->display($data);
    }

    function facultyTeacher()
    {
        $data['pageTitle'] = 'Online University Management System';
        $data['degree'] = $this->db->query("select * from degree")->result();
        $data['faculty_teacher'] = $this->db->query("select * from department where FACULTY_ID !=13")->result();
        $data['content_view_page'] = 'portal/faculty_index';
        $this->template->display($data);
    }

    function facultyStaff()
    {
        $data['pageTitle'] = 'Online University Management System';
        $data['degree'] = $this->db->query("select * from degree")->result();
        $data['department'] = $this->db->query("select * from department where FACULTY_ID =13")->result();
        $data['content_view_page'] = 'portal/staff_index';
        $this->template->display($data);
    }

    /*
     * @methodName semesterCourseList()
     * @access public
     * @param  none
     * @author rakib@atilimited.net
     * @return program wise all courses show in semester wise
     */
    function semesterCourseList($id)
    {
        $data["breadcrumbs"] = array(
            "Home" => "portal/index",
            "Academic" => "#",
            "Course List" => '#'
        );

        $program = $id;
        $data['degree'] = $this->db->query("select * from degree")->result();
        $data["info"] = $this->db->query("SELECT DISTINCT(f.FACULTY_NAME), f.FACULTY_ID, dg.DEGREE_NAME, d.DEPT_ID, d.DEPT_NAME, p.PROGRAM_ID, p.PROGRAM_NAME FROM aca_semester_course asca
            LEFT JOIN faculty f on f.FACULTY_ID = asca.FACULTY_ID
            LEFT JOIN department d on d.DEPT_ID = asca.DEPT_ID
            LEFT JOIN program p on p.PROGRAM_ID = asca.PROGRAM_ID
            LEFT JOIN degree dg on dg.DEGREE_ID = p.DEGREE_ID
            WHERE asca.PROGRAM_ID = $program")->result();

        $data["courses"] = $this->db->query("SELECT a.PROGRAM_ID, a.SEMESTER_ID, ac.COURSE_ID, ac.COURSE_TITLE,  ac.COURSE_CODE, ac.CREDIT, lkp.LKP_NAME FROM aca_semester_course a
            LEFT JOIN aca_course ac on a.COURSE_ID = ac.COURSE_ID
            LEFT JOIN m00_lkpdata lkp on lkp.LKP_ID = a.SEMESTER_ID
            WHERE a.PROGRAM_ID = $program
            ORDER BY a.SEMESTER_ID")->result();
        $data['content_view_page'] = 'portal/semester_course_list';
        $this->template->display($data);
    }

    function event_details($id)
    {
        $data["breadcrumbs"] = array(
            "Home" => "portal/index",
            "Event Details" => '#'
        );
        $data['upcoming_events'] = $this->db->query("SELECT a.*
          FROM event a
          ORDER BY a.CREATE_DATE DESC
          LIMIT 3")->result();
        $data['event_details'] = $this->utilities->findByAttribute('event', array('EVENT_ID' => $id));

        $data['under_graduate'] = $this->db->query("select * from program WHERE DEGREE_ID=4")->result();
        $data['post_graduate'] = $this->db->query("select * from program WHERE DEGREE_ID=61")->result();
        $data['phd'] = $this->db->query("select * from program WHERE DEGREE_ID=63")->result();
        $data['department'] = $this->db->query("select * from department where FACULTY_ID !=13")->result();
        $data['staff_dept'] = $this->db->query("select * from department where FACULTY_ID =13")->result();

        $data['content_view_page'] = 'portal/event_details';
        $this->template->display($data);
    }

    function courseDetails()
    {
        $course = $_POST['course_id'];
        $data['course'] = $this->db->query("SELECT ac.*
            FROM aca_course ac
            WHERE ac.COURSE_ID = $course")->result();
        /**$data['course'] = $this->db->query("SELECT ac.*, act.CRS_TOPIC_ID, act.COURSE_ID, act.TOPIC_TITLE, act.TOPIC_DESC, act.TOPIC_DURATION, act.SUGGESTED_ACTIVITIES
         * FROM aca_course ac
         * LEFT JOIN aca_course_topics act on act.COURSE_ID = ac.COURSE_ID
         * WHERE ac.COURSE_ID = $course")->result();*/
        $this->load->view('portal/course_details', $data);
    }

    function applicantLogin()
    {

        if ($this->session->userdata('applicant_logged_in') == TRUE) {
            redirect('applicant/index', 'refresh');
        }
        $this->form_validation->set_rules('EMAIL', 'email', 'required|callback_checkApplicantLogin');
        $this->form_validation->set_rules('PASSWORD', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {

            echo "ds";exit;

            redirect('portal/login', 'refresh');
        } else {
            $session_info = $this->session->userdata('applicant_logged_in');

            if ($session_info['ACTIVE_STATUS'] == 1) {
                //  $this->session->set_flashdata('Info', "Welcome To KYAU - Student Panel!");
                redirect('Applicant/index', 'refresh');
            }
        }
    }


    function forgotPassword()
    {
        $data["breadcrumbs"] = array(
            "Home" => "portal/index",
            "Forgot Password" => "#",
        );

        $data['content_view_page'] = 'portal/retrieve_password';
        $this->template->display($data);
    }


    function applicantForgotPassword()
    {
        $this->form_validation->set_rules('EMAIL', 'EMAIL', 'required|callback_checkEmail');

        if ($this->form_validation->run() == FALSE) {

            $data["breadcrumbs"] = array(
                "Home" => "portal/index",
                "Forgot Password" => "#",
            );

            $data['content_view_page'] = 'portal/retrieve_password';
            $this->template->display($data);
        } else {


            $email = $this->input->post('EMAIL');

            $user_info = $this->utilities->findByAttribute('applicant_user', array('EMAIL' => $email));


            $message = "<br>Please visit this link for login<br>" . base_url("Portal/login") . " <br>Your login details.<br /> Email:<b> " . $user_info->EMAIL . '</b><br> Password:<b>' . $user_info->PASSWORD . '</b><br>Thanks <br> KYAU';
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


                //redirect('portal/login');

//                $data["breadcrumbs"] = array(
//                    "Home" => "portal/index",
//                    "Forgot Password" => "#",
//                );
//
                $data['msg'] = "Your password has sent to your mail.";
//
//                $data['content_view_page'] = 'portal/reset_password';
//                $this->template->display($data);

                $data["breadcrumbs"] = array(
                    "Home" => "portal/index",
                    "Login" => "#",
                );

                $data['content_view_page'] = 'portal/applicant_login';
                $this->template->display($data);

            }
        }

    }

    function test(){
         $email = 'rakibronicse@gmail.com';



            $message = '<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Password reset</title>
    </head>
    <body style="margin:0px; padding:0px; border: 0 none; font-size: 9px; font-family: verdana, sans-serif; background-color: #efefef;">
     
    <table style="width: 700px; margin: 50px auto 50px auto; border: 1px #ccc solid; background: #fff; font-size: 11px; font-family: verdana, sans-serif;" align="center">
        <!-- This is the very top blue part of the template. Replace colors and image/logo in the lines below. Best image size would be 308x55 or similar. -->
        <tbody>
        <tr>
            <td colspan="2" style="padding: 9px; color: #fff; background: #1B3073;">
                <!-- This is the sentence right under the image/logo. -->
                <p style="color: #ccc;margin-top:0px;margin-bottom:0px; font-size: 16px;">Support :: ATI Limited</p>
            </td>
        </tr>

        <tr style="padding: 10px;">


            <td style="width: 240px; vertical-align: top;">
                <div style="margin:15px 8px 15px;padding: 9px; border: 1px #ccc solid; font-size: 10px;">
                    <strong>Ticket No.</strong>{{ $ticket_no }}
                    <hr style="height: 1px; color: #ccc;" />
                    <strong>Date:</strong> {{ $req_date }}<br />
                    <br />
                    <strong>Issue By:</strong> {{ $issued_by }}
                    <!-- ********If you have custom attributes in your Spiceworks installation, and want them to show in your emails, this is where you add them. -->
                    <br />
                    <strong>Ticket Type:</strong> {{ $request_type  }}<br />
                    <strong>Status:</strong> {{ $status }}<br />
                    <strong>Level:</strong> {{ $level }}<br  />
                    <strong>Priority:</strong> {{ $priority }}<br />
                    <strong>Urgency:</strong> {{ $urgency  }}<br />
                    <strong>Mode Of Request:</strong> {{ $req_mode }}<br />
                    <br /><br />
                    <!-- Begin Requester Information -->
                    <strong>Requester Information:</strong><hr />
                    <strong>Name:</strong> {{ $txtRequesterName }}<br />
                    <strong>Contact No:</strong> {{ $txtContactNo }}<br />
                    <strong>Email:</strong> {{ $txtEmail }}<br />
                    <strong>Office:</strong> {{ $txtOffice }}<br />
                    <strong>Designation:</strong> {{ $txtDesignation }}<br />


                    <br />
                    <br/>
                </div>
            </td>
            <td style="width: 400px; padding: 15px 0px 0px 18px; vertical-align: top;">
                <strong>Subject:</strong> {{ $subject }}<br />
                <hr />
                <strong>Description:</strong>
                <p>{!! $body !!}</p>
            </td>
        </tr>
        <tr>
            <td><hr />Copyright &copy; {{ date() }}. ATI Limited. All rights reserved. .<br /><small>Please do not reply this email.</small></td>
        </tr>
        </tbody>
    </table>
    </body>
</html>';
            $subject = "KYAU Applicant New Login Password";


            require 'gmail_app/class.phpmailer.php';
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = "mail.harnest.com";
            $mail->Port = "465";
            $mail->SMTPAuth = true;
            $mail->Username = "dev@atilimited.net";
            $mail->Password = "@ti321$#";
            $mail->SMTPSecure = 'ssl';
            $mail->From = "noreply@youthopiabangla.org";
            $mail->FromName = "Youthopia.bangla";
            $mail->AddAddress($email);
              //$mail->AddReplyTo($emp_info->EMPLOYEE);
            $mail->IsHTML(TRUE);
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->Send();
    }

    function checkEmail()
    {
        $email = $this->input->post('EMAIL');
        $phone_digit = $this->input->post('PHONE');

        $this->load->model('auth_model');
        $result = $this->auth_model->applicantCredentials($email, $phone_digit);

        if (!empty($result)) {

            if ($result->EMAIL != '') {
                return TRUE;
            } else {

                $this->form_validation->set_message('EMAIL', 'Something Wrong');
                return false;
            }
        } else {

            $this->form_validation->set_message('checkEmail', 'We didn\'t recognise your Email or Mobile No.');
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
    function checkApplicantLogin($EMAIL)
    {

         $password = $this->input->post('PASSWORD');
      

        //$hashPassword = $this->utilities->get_field_value_by_attribute('sa_users', 'USERPW', array('USERNAME' => $username));
        $this->load->model('auth_model');
        $result = $this->auth_model->applicantLogin($EMAIL, $password);

 
        //if (password_verify($password, $hashPassword)) {
        if (!empty($result)) {
            $sess_array = array(
                'APPLICANT_USER_ID' => $result->APPLICANT_USER_ID,
                'ADM_PRG_ID' => $result->ADM_PRG_ID,
                'DEGREE_ID' => $result->DEGREE_ID,
                'FACULTY_ID' => $result->FACULTY_ID,
                'DEPT_ID' => $result->DEPT_ID,
                'PROGRAM_ID' => $result->PROGRAM_ID,
                'FF_COM_STATUS' => $result->FF_COM_STATUS,
                'FULL_NAME' => $result->FULL_NAME,
                'GENDER' => $result->GENDER,
                'EMAIL' => $result->EMAIL,
                'MOBILE' => $result->MOBILE,
                'BIRTH_DT' => $result->BIRTH_DT,
                'ACTIVE_STATUS' => $result->ACT_FG
            );
            if ($result->ACT_FG != 0) {
                $this->session->set_userdata('applicant_logged_in', $sess_array);
                return TRUE;
            } else {
                $this->form_validation->set_message('check_database', 'Something Wrong');
                return false;
            }
        } else {
            $this->form_validation->set_message('check_database', 'Whoops! We didn\'t recognise your username or password. Please try again.');
            return false;
        }
    }

    /**
     * @access
     * @param  program , name, gendar, moblie, dob, email
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return portal template
     */
    function loginCheck()
    {
        $Email = $this->input->post("Email");
        $password = $this->input->post("password");
        $check = $this->db->query("SELECT * FROM adm_applicant_info WHERE EMAIL_ADRESS = '$Email' AND BINARY PASSWORD = '$password'")->row();
        if ($check == TRUE) {
            $sess_array = array(
                'APPLICANT_ID' => $check->APPLICANT_ID,
                'PROGRAM_ID' => $check->PROGRAM_ID,
                'APPLICANT_NAME' => $check->FULL_NAME_EN,
                'EMAIL_ADRESS' => $check->EMAIL_ADRESS,
                'SESSION_ID' => $check->SESSION_ID,
            );
            $this->session->set_userdata('applicant_logged_in', $sess_array);
        } else {
            echo "Email and password don't match.";
        }
    }

    /**
     * @access
     * @param  program , name, gendar, moblie, dob, email
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return portal template
     */
    function onlineApplicantReg()
    {
        $sess_array = array(
            'PKPLUS_APPLICANT' => date('y') . '000000000000',
        );
        $this->session->set_userdata('applicant_logged_in', $sess_array);
        $session = $this->input->post("session");
        $offerType = $this->input->post("offerType");
        $program = $this->input->post("PROGRAM_ID");
        $fName = $this->input->post("FIRST_NAME");
        $mName = $this->input->post("MIDDLE_NAME");
        $lName = $this->input->post("LAST_NAME");
        $gender = $this->input->post("GENDER");
        $mobile = $this->input->post("MOBILE_NO");
        $email = $this->input->post("EMAIL");
        $date = explode("/", $this->input->post("DATE_OF_BIRTH"));
        $dob = $date[2] . '-' . $date[1] . '-' . $date[0];
        $password = $this->generatePassword();
        $nn = $this->db->query("SELECT FACULTY_ID, DEPT_ID FROM program  WHERE PROGRAM_ID = $program")->row();
        $applicant_pk = $this->utilities->pk_f_applicant('adm_applicant_info');
        $applicantInfo = array(
            'APPLICANT_ID' => $applicant_pk,
            'SESSION_ID' => $session,
            'OFFER_TYPE' => $offerType,
            'FIRST_NAME' => $fName,
            'MIDDLE_NAME' => $mName,
            'LAST_NAME' => $lName,
            'FULL_NAME_EN' => $fName . ' ' . $mName . ' ' . $lName,
            'GENDER' => $gender,
            'DATH_OF_BIRTH' => $dob,
            'EMAIL_ADRESS' => $email,
            'MOBILE_NO' => $mobile,
            'FACULTY_ID' => $nn->FACULTY_ID,
            'DEPT_ID' => $nn->DEPT_ID,
            'PROGRAM_ID' => $program,
            'PASSWORD' => $password
        );
        if ($this->utilities->insertData($applicantInfo, 'adm_applicant_info')) {
            $toMail = $email;
            $CC = null;
            $BCC = null;
            $subject = "Applicant Login info";
            $msgBody = "Dear Applicant,
            Please visit this link for login and update your information" .
                base_url() . "portal/online_apply \n
            Your login details.\n
            Username: " . $email . "\n
            Password:" . $password . " \n
            Thanks\n
            KYAU ";

            $success = 0;
            $this->load->library('email_lib');
            $success = $this->email_lib->sendEmail($toMail, $CC, $BCC, $subject, $msgBody);
            if ($success) {
                echo "Email sent successfully!!";
            } else {
                echo "Email Not Sent !!";
            }
            $sess_array = array(
                'APPLICANT_ID' => $applicant_pk,
                'PROGRAM_ID' => $program,
                'APPLICANT_NAME' => $fName . ' ' . $mName . ' ' . $lName,
                'EMAIL' => $email,
                'SESSION_ID' => $session
            );
            $this->session->set_userdata('applicant_logged_in', $sess_array);
        }
    }

    /**
     * @methodName stuLogout()
     * @access
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      this function use for student log out
     */
    function appLogout()
    {
        $this->session->unset_userdata('applicant_logged_in');
        redirect('Portal/online_apply', 'refresh');
    }

    /**
     * @access
     * @param  Email_id
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return password
     */
    function generatePassword($length = 8)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);

        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }

        return $result;
    }

    /**
     * @access
     * @param  Email_id
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return msg
     */
    function applicantEmailCheck()
    {
        $email = $this->input->post("email");
        $check = $this->db->query("SELECT EMAIL_ADRESS FROM adm_applicant_info WHERE EMAIL_ADRESS = '$email' ")->row();
        if ($check == TRUE) {
            echo "Email Already Existed";
        } else {
            echo "<i class='fa fa-check'></i>";
        }
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return portal template
     */
    function AdmissionInstruction()
    {
        echo "instruction";
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return portal template
     */
    function signUp()
    {
        $data['degree'] = $this->db->query("select * from ins_degree")->result();
        $data['content_view_page'] = 'portal/online_apply';
        $this->template->display($data);
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return portal template
     */
    function signUpForm($program_id, $ADM_PRG_ID)
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('PROGRAM_ID', 'program required', 'required');
        $this->form_validation->set_rules('FULL_NAME', 'full name', 'required');
        $this->form_validation->set_rules('EMAIL', 'email', 'required|valid_email|is_unique[applicant_user.EMAIL]');
        $this->form_validation->set_rules('MOBILE_NO', 'mobile no', 'required|min_length[11]|max_length[11]');
        $this->form_validation->set_rules('DATE_OF_BIRTH', 'date of birth ', 'required');

        if ($this->form_validation->run() == FALSE) {

            $data['programs'] = $this->utilities->findByAttribute('ins_program', array('PROGRAM_ID' => $program_id));
            $data['ADM_PRG_ID'] = $ADM_PRG_ID;
            $data['content_view_page'] = 'portal/sign_up_form';
        } else {


           unset($_SESSION["applicant_logged_in"]);
            $email = $this->input->post('EMAIL');
            $password = mt_rand(100000, 999999);
            $name = $this->input->post('FULL_NAME');
            $PROGRAM_ID = $this->input->post('PROGRAM_ID');
            $program_details = $this->utilities->findByAttribute('ins_program', array('PROGRAM_ID' => $PROGRAM_ID));
            $applicant_user_data = array(
                'FULL_NAME' => $name,
                'EMAIL' => $email,
                'DEGREE_ID' => $program_details->DEGREE_ID,
                'FACULTY_ID' => $program_details->FACULTY_ID,
                'DEPT_ID' => $program_details->DEPT_ID,
                'PROGRAM_ID' => $PROGRAM_ID,
                'GENDER' => $this->input->post('GENDER'),
                'MOBILE' => $this->input->post('MOBILE_NO'),
                'ADM_PRG_ID' => $this->input->post('ADM_PRG_ID'),
                'BIRTH_DT' => date('Y-m-d', strtotime($this->input->post('DATE_OF_BIRTH'))),
                'PASSWORD' => $password,
            );

            $message = " Dear " . $name . ", <br> KYAU applicant login credential <br>" . base_url("Portal/signUp") . " <br>Your login details.<br /> Email:<b> " . $email . '</b><br> Password:<b>' . $password . '</b><br>Thanks <br> KYAU';

            $subject = "KYAU Applicant Login Info";

            //echo $message;exit;
            require 'gmail_app/class.phpmailer.php';
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = "mail.harnest.com";
            $mail->Port = "465";
            $mail->SMTPAuth = true;
            $mail->Username = "dev@atilimited.net";
            $mail->Password = "@ti321$#";
            $mail->SMTPSecure = 'ssl';
            $mail->From = "support@harnest.com";
            $mail->FromName = "KYAU";
            $mail->AddAddress($email);
            //$mail->AddReplyTo($emp_info->EMPLOYEE);
            $mail->IsHTML(TRUE);
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->send();
//            if ($mail->Send()) {
                $this->db->insert("applicant_user", $applicant_user_data);
                $applicant_id = $this->db->insert_id();
                $sess_array = array(
                    'APPLICANT_USER_ID' => $applicant_id,
                    'FULL_NAME' => $name,
                    'EMAIL' => $email,
                    'DEGREE_ID' => $program_details->DEGREE_ID,
                    'FACULTY_ID' => $program_details->FACULTY_ID,
                    'DEPT_ID' => $program_details->DEPT_ID,
                    'PROGRAM_ID' => $PROGRAM_ID,
                    'GENDER' => $this->input->post('GENDER'),
                    'MOBILE' => $this->input->post('MOBILE_NO'),
                    'ADM_PRG_ID' => $this->input->post('ADM_PRG_ID'),
                    'BIRTH_DT' => date('Y-m-d', strtotime($this->input->post('DATE_OF_BIRTH'))),

                );
                $this->session->set_userdata('applicant_logged_in', $sess_array);
                redirect('applicant/admission');
//            }

        }
        $this->template->display($data);
    }


    /**
     * @param $degree_name
     */

    function offeredProgramList($degree_id)
    {
        $data['degrees'] = $this->utilities->findByAttribute('ins_degree', array('DEGREE_ID' => $degree_id));
        $data['programs'] = $this->utilities->currentOfferdProgramList($degree_id);

        // echo "<pre>"; print_r($data['programs']); exit; "</pre>";

        $data['content_view_page'] = 'portal/offered_program_list';
        $this->template->display($data);
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return portal template
     */
    function admission_form()
    {
        $data["breadcrumbs"] = array(
            "Home" => "portal/index",
            "Admission Form" => "#"

        );
        $data['under_graduate'] = $this->db->query("select * from program WHERE DEGREE_ID=4")->result();
        $data['post_graduate'] = $this->db->query("select * from program WHERE DEGREE_ID=61")->result();
        $data['phd'] = $this->db->query("select * from program WHERE DEGREE_ID=63")->result();
        $data['degree'] = $this->utilities->findAllByAttribute('degree', array('ACTIVE_STATUS' => 1));
        $data['division'] = $this->utilities->getAll('sa_divisions');
        $data['nationality'] = $this->utilities->getAll('country');
        $data['extra_activity_type'] = $this->utilities->getAll('extra_activity_type');
        $data['religion'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 3));
        $data['merital_status'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 8));
        $data['blood_group'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 4));
        $data['substance'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 56));
        $data['exam_name'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 13));
        $data['board_name'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 24));
        $data['group_name'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 25));
        $data['occupation'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 21));
        $data['relation'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 40));
        $data['content_view_page'] = 'portal/admission_form';
        $this->template->display($data);

    }

    /*
     * @methodName degreeList()
     * @access
     * @param  $a is string defining degree name
     * @return status
     */

    public function degreeList()
    {
        $this->load->view('portal/ajax');
    }

    public function searchProg()
    {
        $this->load->view('portal/ajax');
    }

    /*
     * @methodName admissionForm()
     * @access
     * @param  $id is string defining degree name
     * @return status
     */

    public function admissionForm($id)
    {
        $data['pageTitle'] = 'Pree-admission Process';
        $data['degree_id'] = $id;
        $data['degree'] = $this->utilities->findAllFromView('degree');
        $data['faculty'] = $this->utilities->findAllFromView('faculty');
        $data['course'] = $this->utilities->findAllFromView('course');

        $data['religion'] = $this->utilities->findAllFromView('sav_religion', array('ACTIVE_FLAG' => 1));
        $data['maritals'] = $this->utilities->findAllFromView('sav_maritals', array('ACTIVE_FLAG' => 1));
        $data['country'] = $this->utilities->findAllFromView('sa_country');
        $data['division'] = $this->utilities->getAll('sa_divisions');
        $data['content_view_page'] = 'portal/admissionForm';
        $this->template->display($data);
    }

    public function addAdmission()
    {

        $add_field = array(
            'FIRST_NAME' => $this->input->post('firstName'),
            'MIDDLE_NAME' => $this->input->post('middleName'),
            'LAST_NAME' => $this->input->post('lastName'),
            'FULL_NAME_EN' => $this->input->post('firstName') . ' ' . $this->input->post('middleName') . ' ' . $this->input->post('lastName'),
            'FULL_NAME_BN' => $this->input->post('namebn'),
            //'STUD_PHOTO' => $file_name,
            'GENDER' => $this->input->post('gender'),
            'MOBILE_NO' => $this->input->post('contactNo1'),
            'HOME_PHONE' => $this->input->post('contactNo2'),
            'NATIONALITY' => $this->input->post('nationality'),
            'NATIONAL_ID' => $this->input->post('nationalID'),
            'COUNTRY_ID' => '',
            'EMAIL_ADRESS' => $this->input->post('email'),
            'FATHER_NAME' => $this->input->post('fatherName'),
            'MOTHER_NAME' => $this->input->post('motherName'),
            'MARITAL_STATUS' => '',
            'SPOUSE_NAME' => $this->input->post('firstName'),
            'DATH_OF_BIRTH' => date('Y-m-d', strtotime($this->input->post('DOB'))),
            'PLACE_OF_BIRTH' => $this->input->post('birthCity') . ', ' . $this->input->post('birthCountry'),
            'HEIGHT_CM' => '',
            'HEIGHT_FEET' => '',
            'HEIGHT_INCHES' => '',
            'WEIGHT_KG' => '',
            'WEIGHT_LBS' => '',
            'COLOR_OF_EYES' => $this->input->post('firstName'),
            'IDENTIFY_MARK' => $this->input->post('firstName'),
            'RELIGION_ID' => $this->input->post('religion')
        );
        //$applican_data =
        $applican_data = $this->utilities->insert('tempstud_info', $add_field);
        var_dump($add_field);
        var_dump($applican_data);
        exit;
        //  }
        // }
    }


    /*
    * @methodName portalDegree()
    * @access
    * @param  degree id
    * @return Mixed View
    */

    public function preAdmission()
    {
        $data['pageTitle'] = 'Pree-admission Process';
        $data['degree'] = $this->utilities->findAllFromView('degree');
        $data['faculty'] = $this->utilities->findAllFromView('faculty');
        $data['course'] = $this->utilities->findAllFromView('aca_course');
        $data['content_view_page'] = 'portal/preAdmission';
        $this->template->display($data);
    }

    function applyDeg()
    {
        $this->load->view('portal/apply_degree');
    }

    function applyFel()
    {
        $this->load->view('portal/apply_feculty');
    }

    function applyProg()
    {
        $this->load->view('portal/apply_program');
    }

    /*
    * @methodName programCources()
    * @access
    * @param  id
    * @return Mixed View
    */

    public function programCources($id)
    {
        $data['pageTitle'] = 'List of Programs';
        $data['degree'] = $this->db->query("select degree_name from degree_type where degree_type_id = $id")->result();
        //$data['degree'] = $this->utilities->findAllByAttribute("degree_type",array("degree_type_id" => $id,""=>""));
        $data['programe'] = $this->db->query("select * from program where degree_type_id = $id")->result();
        $data['content_view_page'] = 'portal/programe_list';
        $this->template->display($data);
    }

    /*
    * @methodName programDetails()
    * @access
    * @param  id
    * @return Mixed View
    */

    public function programDetails($id)
    {
        $data['pageTitle'] = 'List of Programs';
        $data['degree'] = $this->db->query("select * from program where program_id = $id")->result();
        $data['programe'] = $this->db->query("select * from program where degree_type_id = $id")->result();
        $data['content_view_page'] = 'portal/programe_details';
        $this->template->display($data);
    }

    /*Edit by Emdadul Huq <emdadul@atilimited.net> */

    /*
    * @methodName portalInstruction()
    * @access
    * @param  none
    * @return Mixed View
    */

    function portalInstruction()
    {
        echo "Not Assing of Admission Instruction !!!";
    }

    /*
    * @methodName portalDepartment()
    * @access
    * @param  degree id, program id and department id
    * @return Mixed View
    */

    function portalDepartment($degree, $program_id, $dept_id)
    {

        $data['pageTitle'] = 'Apply for online Admission';
        $data['degree'] = $degree;
        $data['program'] = $program_id;
        $data['department'] = $this->utilities->findByAttribute('department', array("DEPT_ID" => $dept_id)); //Find all data form department

        /*echo "<pre>";
        print_r($data['department']);
        exit();*/
        $this->load->view("portal/department_info", $data);
    }

    function portalDegree($id)
    {

        $data['pageTitle'] = 'Apply for online Admission';
        $data['degree'] = $id;
        $data['degree_name'] = $this->utilities->findByAttribute('degree', array("DEGREE_ID" => $id)); //Find all data form degree
        $data['dept'] = $this->utilities->findAllDistinectAtt($id); //Find distinct Department name data form program
        $data['content_view_page'] = 'portal/program_list';
        $this->template->display($data);
    }

    /*
     * @methodName portalProg()
     * @access
     * @param  none
     * @return Mixed View
     */

    function portalProg()
    {
        $this->load->view('portal/portal_program');
    }

    /*
     * @methodName portalCourseOffer()
     * @access
     * @param  none
     * @return Mixed View
     */
    function portalCourseOffer()
    {
        $this->load->view('portal/portal_courseOffer');
    }

    /*
     * @methodName applicant()
     * @access
     * @param  none
     * @return Mixed View
     */
    public function applicant()
    {
        $data['pageTitle'] = 'Apply for online Admission';
        $data['breadcrumbs'] = $data['pageTitle'];
        $data['degree'] = $this->utilities->findAllFromView('degree', array("ACTIVE_STATUS" => 1)); //Find all data form degree
        $this->template->display($data);
    }

    /*
     * @methodName  admission
     * @access
     * @param
     * @author  Emdadul Huq <Emdadul@atilimited.net>
     * @return mixed Vied
     */

    function admission()
    {

        $data['pageTitle'] = 'Apply for online Admission';
        $this->form_validation->set_rules('ROLL_NO', 'roll no', 'required');
        //$data['degree_id'] = $id;

        if ($this->form_validation->run() == FALSE) {
            $data['division'] = $this->utilities->getAll('sa_divisions');
            $data['nationality'] = $this->utilities->getAll('country');
            $data['religion'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 3));
            $data['merital_status'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 8));
            $data['blood_group'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 4));
            $data['substance'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 56));
            $data['exam_name'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 13));
            $data['board_name'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 24));
            $data['group_name'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 25));
            $data['occupation'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 21));
            $data['relation'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 40));
            $data['session'] = $this->utilities->findAllByAttribute('session', array('ACTIVE_STATUS' => 1));
            $data['faculty'] = $this->utilities->findAllByAttribute('faculty', array('ACTIVE_STATUS' => 1));
            $data['department'] = $this->utilities->findAllByAttribute('department', array('ACTIVE_STATUS' => 1));
            $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
            $data['content_view_page'] = 'portal/admission';

        } else {
            $pk = $this->utilities->pk_f('students_info');

            if (!empty($_FILES)) {
                $this->load->library('upload');
                $this->load->helper('string');
                $config['upload_path'] = 'upload/existing_studnet_photo/';
                //$config['allowed_types'] = '*';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['overwrite'] = false;
                $config['remove_spaces'] = true;
                //$config['max_size']   = '100';// in KB
                $this->upload->initialize($config);
                if ($this->upload->do_upload('photo')) {
                    $file_data = $this->upload->data();
                    $file_name = $file_data['file_name'];
                }
                $student_info = array(
                    'STUD_PHOTO' => $file_name,
                    'STUDENT_ID' => $pk,
                    'FIRST_NAME' => $this->input->post('FIRST_NAME'),
                    'MIDDLE_NAME' => $this->input->post('MIDDLE_NAME'),
                    'LAST_NAME' => $this->input->post('LAST_NAME'),
                    'FULL_NAME_EN' => $this->input->post('FIRST_NAME') . ' ' . $this->input->post('MIDDLE_NAME') . ' ' . $this->input->post('LAST_NAME'),
                    'FULL_NAME_BN' => $this->input->post('FULL_NAME_BN'),
                    'DATH_OF_BIRTH' => date('Y-m-d', strtotime($this->input->post('DATH_OF_BIRTH'))),
                    'GENDER' => $this->input->post('GENDER'),
                    'RELIGION_ID' => $this->input->post('RELIGION_ID'),
                    'NATIONAL_ID' => $this->input->post('NATIONAL_ID'),
                    'PLACE_OF_BIRTH' => $this->input->post('PLACE_OF_BIRTH'),
                    'NATIONALITY' => $this->input->post('NATIONALITY'),
                    'FATHER_NAME' => $this->input->post('FATHER_NAME'),
                    'MOTHER_NAME' => $this->input->post('MOTHER_NAME'),
                    'MARITAL_STATUS' => $this->input->post('MARITAL_STATUS'),
                    'SPOUSE_NAME' => $this->input->post('SPOUSE_NAME'),
                    'HEIGHT_FEET' => $this->input->post('HEIGHT_FEET'),
                    'HEIGHT_CM' => $this->input->post('HEIGHT_CM'),
                    'WEIGHT_KG' => $this->input->post('WEIGHT_KG'),
                    'WEIGHT_LBS' => $this->input->post('WEIGHT_LBS'),
                    'BLOOD_GROUP' => $this->input->post('BLOOD_GRP'),
                    'PASSWORD' => $this->input->post('PASSWORD'),
                    'SSOF_FINANC' => $this->input->post('SSOF_FINANC'),
                    'FMLY_INCOME' => $this->input->post('FMLY_INCOME'),
                    'PASSPORT_NO' => $this->input->post('PASSPORT'),
                    'ROLL_NO' => $this->input->post('ROLL_NO'),
                    'SIBLING_EXIST' => $this->input->post('SIBLING_EXIST')
                );

                $this->utilities->insertData($student_info, 'students_info');

                // insert stundent multiple mobile no
                $MOBILE_NO = $this->input->post('MOBILE_NO');
                if (!empty($MOBILE_NO)) {
                    for ($i = 0; $i < sizeof($MOBILE_NO); $i++) {
                        $insert_mobile = array(
                            'STU_CI_ID' => $this->utilities->pk_f('stu_contractinfo'),
                            'STUDENT_ID' => $pk,
                            'CONTACTS' => $MOBILE_NO [$i],
                            'CONTACT_TYPE' => 'M',
                            'ORG_ID' => 1,
                            'DEFAULT_FG' => 1,
                            'ACTIVE_STATUS' => 1
                        );
                        $this->utilities->insertData($insert_mobile, 'stu_contractinfo');
                    }
                }
                // insert studnet multiple eamil
                $EMAIL_ADRESS = $this->input->post('EMAIL_ADRESS');
                if (!empty($MOBILE_NO)) {
                    for ($i = 0; $i < sizeof($MOBILE_NO); $i++) {
                        $insert_mobile = array(
                            'STU_CI_ID' => $this->utilities->pk_f('stu_contractinfo'),
                            'STUDENT_ID' => $pk,
                            'CONTACTS' => $EMAIL_ADRESS [$i],
                            'CONTACT_TYPE' => 'E',
                            'ORG_ID' => 1,
                            'DEFAULT_FG' => 1,
                            'ACTIVE_STATUS' => 1
                        );
                        $this->utilities->insertData($insert_mobile, 'stu_contractinfo');
                    }
                }
                //father information insertionn
                $father_pk = $this->utilities->pk_f('stu_parentinfo');
                $fahter_info = array(
                    'STU_PARENT_ID' => $father_pk,
                    'STUDENT_ID' => $pk,
                    'PARENTS_TYPE' => 'F',
                    'OCCUPATION' => $this->input->post('FATHER_OCU'),
                    'ECP_FG' => 0,
                    'ORG_ID' => 1,
                    'ACTIVE_FLAG' => 1
                );
                $this->utilities->insertData($fahter_info, 'stu_parentinfo');

                $FATHER_PHN = $this->input->post('FATHER_PHN');
                if (!empty($FATHER_PHN)) {
                    for ($i = 0; $i < sizeof($FATHER_PHN); $i++) {
                        $insert_mobile_f = array(
                            'STU_PGS_ID' => $this->utilities->pk_f('stu_pgscontract'),
                            'STUDENT_ID' => $pk,
                            'PGSC_TYPE' => 'F',
                            'PGSC_ID' => $father_pk,
                            'CONTACTS' => $FATHER_PHN [$i],
                            'CONTACT_TYPE' => 'M',
                            'ORG_ID' => 1,
                            'DEFAULT_FG' => 1,
                            'ACTIVE_STATUS' => 1
                        );
                        $this->utilities->insertData($insert_mobile_f, 'stu_pgscontract');
                    }
                }
                $FATHER_EMAIL = $this->input->post('FATHER_EMAIL');
                if (!empty($FATHER_EMAIL)) {
                    for ($i = 0; $i < sizeof($FATHER_EMAIL); $i++) {
                        $insert_mobile_f = array(
                            'STU_PGS_ID' => $this->utilities->pk_f('stu_pgscontract'),
                            'STUDENT_ID' => $pk,
                            'PGSC_TYPE' => 'F',
                            'PGSC_ID' => $father_pk,
                            'CONTACTS' => $FATHER_EMAIL [$i],
                            'CONTACT_TYPE' => 'E',
                            'ORG_ID' => 1,
                            'DEFAULT_FG' => 1,
                            'ACTIVE_STATUS' => 1
                        );
                        $this->utilities->insertData($insert_mobile_f, 'stu_pgscontract');
                    }
                }

                //end father information insertion
                // ***** start mother information insertion *****
                $mother_pk = $this->utilities->pk_f('stu_parentinfo');
                $mother_info = array(
                    'STU_PARENT_ID' => $mother_pk,
                    'STUDENT_ID' => $pk,
                    'PARENTS_TYPE' => 'M',
                    'OCCUPATION' => $this->input->post('MOTHER_OCU'),
                    'ECP_FG' => 0,
                    'ORG_ID' => 1,
                    'ACTIVE_FLAG' => 1
                );
                $this->utilities->insertData($mother_info, 'stu_parentinfo');

                $MOTHER_PHN = $this->input->post('MOTHER_PHN');
                if (!empty($MOTHER_PHN)) {
                    for ($i = 0; $i < sizeof($MOTHER_PHN); $i++) {
                        $insert_mobile_m = array(
                            'STU_PGS_ID' => $this->utilities->pk_f('stu_pgscontract'),
                            'STUDENT_ID' => $pk,
                            'PGSC_TYPE' => 'M',
                            'PGSC_ID' => $mother_pk,
                            'CONTACTS' => $MOTHER_PHN [$i],
                            'CONTACT_TYPE' => 'M',
                            'ORG_ID' => 1,
                            'DEFAULT_FG' => 1,
                            'ACTIVE_STATUS' => 1
                        );
                        $this->utilities->insertData($insert_mobile_m, 'stu_pgscontract');
                    }
                }

                $MOTHER_EMAIL = $this->input->post('MOTHER_EMAIL');
                if (!empty($MOTHER_EMAIL)) {
                    for ($i = 0; $i < sizeof($MOTHER_EMAIL); $i++) {
                        $insert_mobile_m = array(
                            'STU_PGS_ID' => $this->utilities->pk_f('stu_pgscontract'),
                            'STUDENT_ID' => $pk,
                            'PGSC_TYPE' => 'M',
                            'PGSC_ID' => $mother_pk,
                            'CONTACTS' => $MOTHER_EMAIL [$i],
                            'CONTACT_TYPE' => 'E',
                            'ORG_ID' => 1,
                            'DEFAULT_FG' => 1,
                            'ACTIVE_STATUS' => 1
                        );
                        $this->utilities->insertData($insert_mobile_m, 'stu_pgscontract');
                    }
                }
                //end mother information insertion
                // present and permanet address insertion
                if ($this->input->post('SAS_PSORPR') == 1) {
                    $present_address = array(
                        'STU_ADRESS_ID' => $this->utilities->pk_f('stu_adressinfo'),
                        'STUDENT_ID' => $pk,
                        'ADRESS_TYPE' => 'PS',
                        'SAS_PSORPR' => 'PS',
                        'VILLAGE_WARD' => $this->input->post('VILLAGE'),
                        'UNION_ID' => $this->input->post('UNION_ID'),
                        'THANA_ID' => $this->input->post('THANA_ID'),
                        'POST_OFFICE_ID' => $this->input->post('POST_OFFICE_ID'),
                        'POLICE_STATION_ID' => $this->input->post('POLICE_STATION_ID'),
                        'DISTRICT_ID' => $this->input->post('DISTRICT_ID'),
                        'DIVISION_ID' => $this->input->post('DIVISION_ID'),
                        'ACTIVE_FLAG' => 1
                    );
                    $this->utilities->insertData($present_address, 'stu_adressinfo');
                } else {
                    $present_address = array(
                        'STU_ADRESS_ID' => $this->utilities->pk_f('stu_adressinfo'),
                        'STUDENT_ID' => $pk,
                        'ADRESS_TYPE' => 'PS',
                        'SAS_PSORPR' => '',
                        'VILLAGE_WARD' => $this->input->post('VILLAGE'),
                        'UNION_ID' => $this->input->post('UNION_ID'),
                        'THANA_ID' => $this->input->post('THANA_ID'),
                        'POST_OFFICE_ID' => $this->input->post('POST_OFFICE_ID'),
                        'POLICE_STATION_ID' => $this->input->post('POLICE_STATION_ID'),
                        'DISTRICT_ID' => $this->input->post('DISTRICT_ID'),
                        'DIVISION_ID' => $this->input->post('DIVISION_ID'),
                        'ACTIVE_FLAG' => 1
                    );
                    $this->utilities->insertData($present_address, 'stu_adressinfo');

                    $permanent_address = array(
                        'STU_ADRESS_ID' => $this->utilities->pk_f('stu_adressinfo'),
                        'STUDENT_ID' => $pk,
                        'ADRESS_TYPE' => 'PR',
                        'SAS_PSORPR' => '',
                        'VILLAGE_WARD' => $this->input->post('P_VILLAGE'),
                        'UNION_ID' => $this->input->post('P_UNION_ID'),
                        'THANA_ID' => $this->input->post('P_THANA_ID'),
                        'POST_OFFICE_ID' => $this->input->post('P_POST_OFFICE_ID'),
                        'POLICE_STATION_ID' => $this->input->post('P_POLICE_STATION_ID'),
                        'DISTRICT_ID' => $this->input->post('P_DISTRICT_ID'),
                        'DIVISION_ID' => $this->input->post('P_DIVISION_ID'),
                        'ACTIVE_FLAG' => 1
                    );
                    $this->utilities->insertData($permanent_address, 'stu_adressinfo');
                }
                //end address insertion
                //start local guardian and emegensy contact person

                $leg = $this->input->post('local_emergency_guardian');
                if ($leg == 'F') {
                    $update_f_info = array(
                        'ECP_FG' => 1,
                    );
                    $this->utilities->updateData('stu_parentinfo', $update_f_info, array('STU_PARENT_ID' => $father_pk));
                } else if ($leg == 'M') {
                    $update_m_info = array(
                        'ECP_FG' => 1,
                    );
                    $this->utilities->updateData('stu_parentinfo', $update_m_info, array('STU_PARENT_ID' => $mother_pk));
                } else {
                    echo "asdf";
                    $lg_pk = $this->utilities->pk_f('stu_parentinfo');
                    $local_emergency_guardian = array(
                        'STU_GI_ID' => $lg_pk,
                        'STUDENT_ID' => $pk,
                        'GFULL_NAME' => $this->input->post('LOCAL_GAR_NAME'),
                        'RELATION_ID' => $this->input->post('LOCAL_GAR_RELATION'),
                        'ADDRESS' => $this->input->post('LOCAL_GAR_ADDRESS'),
                        'ECP_FG' => 1,
                        'ORG_ID' => 1,
                        'ACTIVE_FLAG' => 1
                    );

                    $this->utilities->insertData($local_emergency_guardian, 'stu_guardians');
                    $LOCAL_GAR_PHN = $this->input->post('LOCAL_GAR_PHN');
                    if (!empty($LOCAL_GAR_PHN)) {
                        for ($i = 0; $i < sizeof($LOCAL_GAR_PHN); $i++) {
                            $insert_mobile_lg = array(
                                'STU_PGS_ID' => $this->utilities->pk_f('stu_pgscontract'),
                                'STUDENT_ID' => $pk,
                                'PGSC_TYPE' => 'EG',
                                'PGSC_ID' => $lg_pk,
                                'CONTACTS' => $LOCAL_GAR_PHN [$i],
                                'CONTACT_TYPE' => 'M',
                                'ORG_ID' => 1,
                                'DEFAULT_FG' => 1,
                                'ACTIVE_STATUS' => 1
                            );
                            $this->utilities->insertData($insert_mobile_lg, 'stu_pgscontract');
                        }
                    }
                }
                //echo "<pre>";
                //print_r($_POST);
                //exit;
                //end local guardian and emegensy contact person
                // academic information insertion
                $COUNTER = $this->input->post('COUNTER');
                $this->load->library('upload');
                $this->load->helper('string');
                $configc['upload_path'] = 'upload/academin_certificate/';
                //$config['allowed_types'] = '*';
                $configc['allowed_types'] = 'gif|jpg|jpeg|png';
                $configc['overwrite'] = false;
                $configc['remove_spaces'] = true;
                //$config['max_size']   = '100';// in KB
                $this->upload->initialize($configc);

                for ($i = 1; $i <= $COUNTER; $i++) {
                    if ($this->upload->do_upload('CERTIFICATE_' . $i)) {
                        $file_data = $this->upload->data();
                        $file_name = $file_data['file_name'];
                        $ac_pk = $this->utilities->pk_f('stu_acadimicinfo');
                        $academic_info = array(
                            'STU_AI_ID' => $ac_pk,
                            'STUDENT_ID' => $pk,
                            'EXAM_DEGREE_ID' => $this->input->post('EXAM_NAME_' . $i),
                            'MAJOR_GROUP_ID' => $this->input->post('GROUP_' . $i),
                            'INSTITUTION' => $this->input->post('INSTITUTE_' . $i),
                            'BOARD' => $this->input->post('BOARD_' . $i),
                            'RESULT_GRADE' => $this->input->post('GPA_' . $i),
                            'PASSING_YEAR' => $this->input->post('PASSING_YEAR_' . $i),
                            'ACHIEVEMENT' => $file_name,
                            'ACTIVE_FLAG' => 1
                        );
                        $this->utilities->insertData($academic_info, 'stu_acadimicinfo');
                    }
                }
                //end academic information insertion
                //start medicle  insertion

                $SUBSTANCE = $this->input->post('SUBSTANCE');
                $CURRENTLY_USED = $this->input->post('CURRENTLY_USED');
                $PREVIOUSLY_USED = $this->input->post('PREVIOUSLY_USED');
                $TYPE_AMOUNT_FREQUENCY = $this->input->post('TYPE_AMOUNT_FREQUENCY');
                $DURATION = $this->input->post('DURATION');
                $STOP_DT = $this->input->post('STOP_DT');
                if (!empty($SUBSTANCE)) {
                    for ($i = 0; $i < sizeof($SUBSTANCE); $i++) {
                        $medical_pk = $this->utilities->pk_f('stu_medicalinfo');
                        $insert_medical_info = array(
                            'STU_MEDI_ID' => $medical_pk,
                            'STUDENT_ID' => $pk,
                            'SUBSTANCE' => $SUBSTANCE[$i],
                            'CURRENTLY_USED' => $CURRENTLY_USED[$i],
                            'PREVIOUSLY_USED' => $PREVIOUSLY_USED[$i],
                            'TYPE_AMOUNT_FREQUENCY' => $TYPE_AMOUNT_FREQUENCY[$i],
                            'DURATION' => $DURATION[$i],
                            'STOP_DT' => date('Y-m-d', strtotime($STOP_DT[$i])),
                            'ACTIVE_STATUS' => 1
                        );
                        $this->utilities->insertData($insert_medical_info, 'stu_medicalinfo');
                    }
                }
                //end medicle insertion
                //start diseases  insertion

                $DISEASE_NAME = $this->input->post('DISEASE_NAME');
                $START_DT = $this->input->post('START_DT');
                $END_DT = $this->input->post('END_DT');
                $DOCTOR_NAME = $this->input->post('DOCTOR_NAME');

                if (!empty($DISEASE_NAME)) {
                    for ($i = 0; $i < sizeof($DISEASE_NAME); $i++) {
                        $diseases_pk = $this->utilities->pk_f('stu_diseaseinfo');
                        $insert_dises_info = array(
                            'STU_DISEASE_ID' => $diseases_pk,
                            'STUDENT_ID' => $pk,
                            'DISEASE_NAME' => $DISEASE_NAME[$i],
                            'START_DT' => date('Y-m-d', strtotime($START_DT[$i])),
                            'END_DT' => date('Y-m-d', strtotime($END_DT[$i])),
                            'DOCTOR_NAME' => $DOCTOR_NAME[$i],
                            'ACTIVE_STATUS' => 1
                        );
                        $this->utilities->insertData($insert_dises_info, 'stu_diseaseinfo');
                    }
                }
                //end diseases insertion
                //start waiver information insertion
                $waiver_pk = $this->utilities->pk_f('stu_weaverinfo');
                $waiver_info = array(
                    'STU_WEAVER_ID' => $waiver_pk,
                    'STUDENT_ID' => $pk,
                    'PERCENTAGE' => $this->input->post('WEAVER_PERCENTAGE'),
                    'REASON' => $this->input->post('WEAVER_REASON'),
                    'ACTIVE_STATUS' => 1
                );
                $this->utilities->insertData($waiver_info, 'stu_weaverinfo');
                //end waiver information insertion
                //start admission information insertion
                $stu_admission_pk = $this->utilities->pk_f('stu_admissioninfo');
                $admission_info = array(
                    'STU_ADMISSION_ID' => $stu_admission_pk,
                    'STUDENT_ID' => $pk,
                    'SESSION_ID' => $this->input->post('SESSION'),
                    'FACULTY_ID' => $this->input->post('FACULTY'),
                    'DEPT_ID' => $this->input->post('DEPT_ID'),
                    'PROGRAM_ID' => $this->input->post('PROGRAM_ID'),
                    'SEMISTER_ID' => $this->input->post('SEMESTER'),
                    'ACTIVE_STATUS' => 1
                );
                $this->utilities->insertData($admission_info, 'stu_admissioninfo');
                //end admission information insertion
                //start existing student course information isertion
                $COURSE_ID = $this->input->post('COURSE_ID');
                if (isset($COURSE_ID)) {
                    $OFFER_COURSE_ID = $this->input->post('OFFERED_COURSE_ID');
                    for ($i = 0; $i < sizeof($COURSE_ID); $i++) {
                        $course_info_pk = $this->utilities->pk_f('stu_courseinfo');
                        $student_current_courses = array(
                            'STU_CRS_ID' => $course_info_pk,
                            'STUDENT_ID' => $pk,
                            'OFFERED_COURSE_ID' => $OFFER_COURSE_ID[$i],
                            'SESSION_ID' => $this->input->post('SESSION_ID_C'),
                            'SEMISTER_ID' => $this->input->post('SEMISTER_ID_C'),
                            'COURSE_ID' => $COURSE_ID[$i],
                            'IS_CURRENT' => 1,
                            'ACTIVE_STATUS' => 1
                        );
                        $this->utilities->insertData($student_current_courses, 'stu_courseinfo');
                    }
                }
                //end existing student course information isertion
                //start sibling insertion
                $stu_sibling_pk = $this->utilities->pk_f('stu_siblings');
                $sibling_info = array(
                    'STU_SBLN_ID' => $stu_sibling_pk,
                    'SBLN_ROLL_NO' => $this->input->post('SBLN_ROLL_NO'),
                    'STUDENT_ID' => $pk,
                    'ACTIVE_STATUS' => 1
                );
                $this->utilities->insertData($sibling_info, 'stu_siblings');
                //end sibling insertion
            }
            $this->session->set_flashdata('Success', 'Congratulation ! Existing Student Information Added Successfully.');
            redirect('admission/registration', 'refresh');
        }
        $this->template->display($data);
    }

    function contactUs()
    {
        $data['content_view_page'] = 'portal/contact_us';
        $this->template->display($data);
    }

    /**
     * @access none
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function our_programs()
    {
        $data['department'] = $this->db->query("SELECT DISTINCT p.DEPT_ID
            FROM program p
            WHERE p.ACTIVE_STATUS = 1")->result();
        $data['faculty'] = $this->db->query("SELECT DISTINCT p.FACULTY_ID
            FROM program p
            WHERE p.ACTIVE_STATUS = 1")->result();
        $data['content_view_page'] = 'portal/programs/our_programs';
        $this->template->display($data);
    }

    /**
     * @access none
     * @param  file
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function studentImagUpload()
    {

        if (!empty($_FILES)) {
            $file_name = "";
            $this->load->library('upload');
            $this->load->helper('string');
            $config['upload_path'] = 'upload/applicant_photo/';
            //$config['allowed_types'] = '*';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['overwrite'] = false;
            $config['remove_spaces'] = true;
            //$config['max_size']   = '100';// in KB
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $file_data = $this->upload->data();
                $file_name = $file_data['file_name'];
            }
        }
        echo $file_name;

    }

    /**
     * @access none
     * @param  file
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function parentImagUpload()
    {
        if (!empty($_FILES)) {
            $file_name = "";
            $this->load->library('upload');
            $this->load->helper('string');
            $config['upload_path'] = 'upload/applicant_photo/parents_photo/';
            //$config['allowed_types'] = '*';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['overwrite'] = false;
            $config['remove_spaces'] = true;
            //$config['max_size']   = '100';// in KB
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $file_data = $this->upload->data();
                $file_name = $file_data['file_name'];
            }
        }
        echo $file_name;
    }

    /**
     * @access none
     * @param  file
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function RecieptImagUpload()
    {
        if (!empty($_FILES)) {
            $file_name = "";
            $this->load->library('upload');
            $this->load->helper('string');
            $config['upload_path'] = 'upload/bank_deposit_no/';
            //$config['allowed_types'] = '*';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['overwrite'] = false;
            $config['remove_spaces'] = true;
            //$config['max_size']   = '100';// in KB
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $file_data = $this->upload->data();
                $file_name = $file_data['file_name'];
            }
        }
        echo $file_name;
    }

    /**
     * @access none
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function applicantPersonalInfo()
    {

        $APPLICANT_ID = $this->input->post("APPLICANT_ID");
        $FULL_NAME_BN = $this->input->post("BanglaName");
        $blood_group = $this->input->post("blood_group");
        $RELIGION = $this->input->post("RELIGION");
        $MARITAL_STATUS = $this->input->post("MARITAL_STATUS");
        $SPOUSE_NAME = '';
        if ($MARITAL_STATUS == 12) {
            $SPOUSE_NAME = $this->input->post("SPOUSE_NAME");
        }
        $NATIONALITY = $this->input->post("NATIONALITY");
        $NATIONAL_ID = $this->input->post("NationalId");
        $PlaceOfBirth = $this->input->post("PlaceOfBirth");
        $PassportNo = $this->input->post("PassportNo");
        $issueDate = 0;
        $expireDate = 0;
        if ($PassportNo = '') {
            $iDate = explode("/", $this->input->post("issueDate"));
            $issueDate = $iDate[2] . '-' . $iDate[1] . '-' . $iDate[0];
            $eDate = explode("/", $this->input->post("expireDate"));
            $expireDate = $eDate[2] . '-' . $eDate[1] . '-' . $eDate[0];
        }
        $WEIGHT_KG = $this->input->post("WEIGHT_KG");
        $WEIGHT_LBS = $this->input->post("WEIGHT_LBS");
        $HEIGHT_FEET = $this->input->post("HEIGHT_FEET");
        $HEIGHT_CM = $this->input->post("HEIGHT_CM");
        $STD_PHOTO = $this->input->post("STD_PHOTO");
        $APP_SIG = $this->input->post("APP_SIG");
        $priorIndex = $this->input->post("priorIndex");


        $check = $this->utilities->hasInformationByThisId("adm_applicant_info", array("APPLICANT_ID" => $APPLICANT_ID, "FULL_NAME_BN" => $FULL_NAME_BN, "BLOOD_GROUP" => $blood_group));
        if (empty($check)) {
            $applicantInfo = array(
                'ROLL_NO' => '',
                'FULL_NAME_BN' => $FULL_NAME_BN,
                'STUD_PHOTO' => $STD_PHOTO,
                'SIGNATURE_PHOTO' => $APP_SIG,
                'HOME_PHONE' => '',
                'NATIONALITY' => $NATIONALITY,
                'NATIONAL_ID' => $NATIONAL_ID,
                'COUNTRY_ID' => '',
                'FATHER_NAME' => '',
                'MOTHER_NAME' => '',
                'MARITAL_STATUS' => $MARITAL_STATUS,
                'SPOUSE_NAME' => $SPOUSE_NAME,
                'PLACE_OF_BIRTH' => $PlaceOfBirth,
                'HEIGHT_CM' => $HEIGHT_CM,
                'BLOOD_GROUP' => $blood_group,
                'HEIGHT_FEET' => $HEIGHT_FEET,
                'HEIGHT_INCHES' => $HEIGHT_FEET * 12,
                'WEIGHT_KG' => $WEIGHT_KG,
                'WEIGHT_LBS' => $WEIGHT_LBS,
                'RELIGION_ID' => $RELIGION,
                'PASSPORT_NO' => $PassportNo,
                'ISSUE_DATE' => $issueDate,
                'EXPIRE_DATE' => $expireDate,
                'SSOF_FINANC' => '',
                'FMLY_INCOME' => '',
                'SIBLING_EXIST' => 0,

            );
            $update = $this->utilities->updateData('adm_applicant_info', $applicantInfo, array('APPLICANT_ID' => $APPLICANT_ID));
            if ($update) {
                echo "update successfully";
            }
        }
        if ($priorIndex == 0) {
            $check = $this->utilities->hasInformationByThisId("adm_applicant_form_step", array("APPLICANT_ID" => $APPLICANT_ID));
            if (empty($check)) {
                $formSteps = array(
                    'APPLICANT_ID' => $APPLICANT_ID,
                    'STEP' => $priorIndex
                );
                $step = $this->utilities->insertData($formSteps, 'adm_applicant_form_step');
                if ($step) {
                    echo "successfully";
                }
            }
        }
    }

    /**
     * @access none
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function applicantFamilyInfo()
    {

        $APPLICANT_ID = $this->input->post("APPLICANT_ID");
        $FATHER_NAME = $this->input->post("FATHER_NAME");
        $F_Occupation = $this->input->post("F_Occupation");
        $FATHER_PHN = $this->input->post("F_Mobile");
        $FATHER_EMAIL = $this->input->post("F_Email");
        $father_PHOTO = $this->input->post("father_PHOTO");
        $MOTHER_NAME = $this->input->post("MOTHER_NAME");
        $M_Occupation = $this->input->post("M_Occupation");
        $MOTHER_PHN = $this->input->post("M_Mobile");
        $MOTHER_EMAIL = $this->input->post("M_Email");
        $mother_PHOTO = $this->input->post("mother_PHOTO");
        $priorIndex = $this->input->post("priorIndex");

        $FMLY_INCOME = $this->input->post("FMLY_INCOME");
        $SSOF_FINANC = $this->input->post("SSOF_FINANC");
        $SIBLING_EXIST = $this->input->post("SIBLING_EXIST");
        $SIBLING_ID = $this->input->post("SIBLING_ID");

        $check = $this->utilities->hasInformationByThisId("adm_applicant_parentinfo", array("APPLICANT_ID" => $APPLICANT_ID, "PARENTS_TYPE" => 'F'));
        if (empty($check)) {// if father adm_applicant_parentinfo available
            $applicantInfo = array(
                'SSOF_FINANC' => $SSOF_FINANC,
                'FMLY_INCOME' => $FMLY_INCOME,
                'SIBLING_EXIST' => $SIBLING_EXIST
            );

            $update = $this->utilities->updateData('adm_applicant_info', $applicantInfo, array('APPLICANT_ID' => $APPLICANT_ID));
            /*if SIBLING_EXIST is equal to 1 then sibling informarion data insert*/
            if ($SIBLING_EXIST == 1) {
                $session_data = $this->session->userdata('applicant_logged_in');
                $session_data['PKPLUS_SIBLING'] = date('y') . '0000000';
                $this->session->set_userdata('applicant_logged_in', $session_data);
                $sbln_pk = $this->utilities->pk_f_sibling('adm_applicant_siblings');
                $sblnInfo = array(
                    'APP_SBLN_ID' => $sbln_pk,
                    'SBLN_ROLL_NO' => $SIBLING_ID,
                    'APPLICANT_ID' => $APPLICANT_ID,
                    'ACTIVE_STATUS' => 1
                );
                $this->utilities->insertData($sblnInfo, 'adm_applicant_siblings');
            }
            $fatherInfo = array(
                /*'APP_PARENT_ID' => $this->utilities->pk_f('adm_applicant_parentinfo'),*/
                'APPLICANT_ID' => $APPLICANT_ID,
                'PARENTS_TYPE' => 'F',
                'GURDIAN_NAME' => $FATHER_NAME,
                'OCCUPATION' => $F_Occupation,
                'PARENT_PHOTO' => $father_PHOTO,
                'NATIONALITY' => 0,
                'MOBILE_NO' => '',
                'EMAIL_ADRESS' => '',
                'ECP_FG' => 0,
                'ORG_ID' => 1,
                'ACTIVE_FLAG' => 1
            );
            if ($this->utilities->insertData($fatherInfo, 'adm_applicant_parentinfo')) {
                echo "successfully";
            }
            /*Start father's multiple mobile no and email address*/

            $father_id = $this->db->query("SELECT APP_PARENT_ID FROM adm_applicant_parentinfo WHERE APPLICANT_ID = $APPLICANT_ID AND PARENTS_TYPE = 'F'")->row();
            for ($i = 0; $i < sizeof($FATHER_PHN); $i++) {
                $father_phn = array(
                    /*'APP_PGS_ID' => $this->utilities->pk_f('adm_pgscontract'),*/
                    'APPLICANT_ID' => $APPLICANT_ID,
                    'PGSC_TYPE' => 'F',
                    'PGSC_ID' => $father_id->APP_PARENT_ID,
                    'CONTACTS' => $FATHER_PHN[$i],
                    'CONTACT_TYPE' => 'M',
                    'ORG_ID' => 1,
                    'DEFAULT_FG' => 1,
                    'ACTIVE_STATUS' => 1,
                );
                $this->utilities->insertData($father_phn, 'adm_pgscontract');
            }
            for ($i = 0; $i < sizeof($FATHER_EMAIL); $i++) {
                $father_email = array(
                    /*'APP_PGS_ID' => $this->utilities->pk_f('adm_pgscontract'),*/
                    'APPLICANT_ID' => $APPLICANT_ID,
                    'PGSC_TYPE' => 'F',
                    'PGSC_ID' => $father_id->APP_PARENT_ID,
                    'CONTACTS' => $FATHER_EMAIL[$i],
                    'CONTACT_TYPE' => 'E',
                    'ORG_ID' => 1,
                    'DEFAULT_FG' => 1,
                    'ACTIVE_STATUS' => 1,
                );
                $this->utilities->insertData($father_email, 'adm_pgscontract');
            }
        }
        /*End father's multiple mobile no and email address*/
        $check = $this->utilities->hasInformationByThisId("adm_applicant_parentinfo", array("APPLICANT_ID" => $APPLICANT_ID, 'PARENTS_TYPE' => 'M'));
        if (empty($check)) {// if mother adm_applicant_parentinfo available

            $motherInfo = array(
                /*'APP_PARENT_ID' => $this->utilities->pk_f('adm_applicant_parentinfo'),*/
                'APPLICANT_ID' => $APPLICANT_ID,
                'PARENTS_TYPE' => 'M',
                'GURDIAN_NAME' => $MOTHER_NAME,
                'OCCUPATION' => $M_Occupation,
                'PARENT_PHOTO' => $mother_PHOTO,
                'NATIONALITY' => 0,
                'MOBILE_NO' => '',
                'EMAIL_ADRESS' => '',
                'ECP_FG' => 0,
                'ORG_ID' => 1,
                'ACTIVE_FLAG' => 1
            );
            if ($this->utilities->insertData($motherInfo, 'adm_applicant_parentinfo')) {
                echo "successfully";
            }
            /*Start mother's multiple mobile no and email address*/

            $mother_id = $this->db->query("SELECT APP_PARENT_ID FROM adm_applicant_parentinfo WHERE APPLICANT_ID = $APPLICANT_ID AND PARENTS_TYPE = 'M'")->row();
            for ($i = 0; $i < sizeof($MOTHER_PHN); $i++) {
                $mother_phn = array(
                    /*'APP_PGS_ID' => $this->utilities->pk_f('adm_pgscontract'),*/
                    'APPLICANT_ID' => $APPLICANT_ID,
                    'PGSC_TYPE' => 'M',
                    'PGSC_ID' => $mother_id->APP_PARENT_ID,
                    'CONTACTS' => $MOTHER_PHN[$i],
                    'CONTACT_TYPE' => 'M',
                    'ORG_ID' => 1,
                    'DEFAULT_FG' => 1,
                    'ACTIVE_STATUS' => 1,
                );
                $this->utilities->insertData($mother_phn, 'adm_pgscontract');
            }
            for ($i = 0; $i < sizeof($MOTHER_EMAIL); $i++) {
                $mother_email = array(
                    /*'APP_PGS_ID' => $this->utilities->pk_f('adm_pgscontract'),*/
                    'APPLICANT_ID' => $APPLICANT_ID,
                    'PGSC_TYPE' => 'M',
                    'PGSC_ID' => $mother_id->APP_PARENT_ID,
                    'CONTACTS' => $MOTHER_EMAIL[$i],
                    'CONTACT_TYPE' => 'E',
                    'ORG_ID' => 1,
                    'DEFAULT_FG' => 1,
                    'ACTIVE_STATUS' => 1,
                );
                $this->utilities->insertData($mother_email, 'adm_pgscontract');
            }
        }
        $step = $this->db->query("SELECT MAX(STEP)step FROM adm_applicant_form_step WHERE  APPLICANT_ID = $APPLICANT_ID")->row();
        if ($step->step < $priorIndex) {
            if ($priorIndex == 1) {
                $formSteps = array(
                    'STEP' => $priorIndex
                );
                $step = $this->utilities->updateData('adm_applicant_form_step', $formSteps, array("APPLICANT_ID" => $APPLICANT_ID));
                if ($step) {
                    echo "Update successfully";
                }
            }
        }
        /*End mother's multiple mobile no and email address*/
    }

    /**
     * @access none
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function applicantMailingInfo()
    {

        /*print_r($_POST);
        exit();*/
        $APPLICANT_ID = $this->input->post("APPLICANT_ID");
        $priorIndex = $this->input->post("priorIndex");
        $DIVISION = $this->input->post("DIVISION");
        $DISTRICT = $this->input->post("DISTRICT");
        $UPZILLA = $this->input->post("UPZILLA");
        $POLISH_STATION = $this->input->post("POLISH_STATION");
        $POST_OFFICE = $this->input->post("POST_OFFICE");
        $UNION = $this->input->post("UNION");
        $VILLAGE = $this->input->post("VILLAGE");
        $local_emergency_guardian = $this->input->post("local_emergency_guardian");

        /*present and permanet address insertion*/
        if ($this->input->post('SAS_PSORPR') == 1) {
            $check = $this->utilities->hasInformationByThisId("adm_applicant_adressinfo", array("APPLICANT_ID" => $APPLICANT_ID, "ADRESS_TYPE" => 'PS', "SAS_PSORPR" => 'PS',));
            if (empty($check)) {
                $present_address = array(
                    'APPLICANT_ID' => $APPLICANT_ID,
                    'ADRESS_TYPE' => 'PS',
                    'SAS_PSORPR' => 'PS',
                    'VILLAGE_WARD' => $VILLAGE,
                    'UNION_ID' => $UNION,
                    'THANA_ID' => $UPZILLA,
                    'POST_OFFICE_ID' => $POST_OFFICE,
                    'POLICE_STATION_ID' => $POLISH_STATION,
                    'DISTRICT_ID' => $DISTRICT,
                    'DIVISION_ID' => $DIVISION,
                    'ACTIVE_FLAG' => 1
                );
                $pa = $this->utilities->insertData($present_address, 'adm_applicant_adressinfo');
                if ($pa) {
                    echo "successfully";
                }
            }
        } else {
            $check = $this->utilities->hasInformationByThisId("adm_applicant_adressinfo", array("APPLICANT_ID" => $APPLICANT_ID, "ADRESS_TYPE" => 'PS', "SAS_PSORPR" => ''));
            if (empty($check)) {
                $present_address = array(
                    'APPLICANT_ID' => $APPLICANT_ID,
                    'ADRESS_TYPE' => 'PS',
                    'SAS_PSORPR' => '',
                    'VILLAGE_WARD' => $VILLAGE,
                    'UNION_ID' => $UNION,
                    'THANA_ID' => $UPZILLA,
                    'POST_OFFICE_ID' => $POST_OFFICE,
                    'POLICE_STATION_ID' => $POLISH_STATION,
                    'DISTRICT_ID' => $DISTRICT,
                    'DIVISION_ID' => $DIVISION,
                    'ACTIVE_FLAG' => 1
                );
                $pa = $this->utilities->insertData($present_address, 'adm_applicant_adressinfo');
                if ($pa) {
                    echo "successfully";
                }
            }
            $check = $this->utilities->hasInformationByThisId("adm_applicant_adressinfo", array("APPLICANT_ID" => $APPLICANT_ID, "ADRESS_TYPE" => 'PR', "SAS_PSORPR" => ''));
            if (empty($check)) {
                $u_permanent_address = array(
                    'APPLICANT_ID' => $APPLICANT_ID,
                    'ADRESS_TYPE' => 'PR',
                    'SAS_PSORPR' => '',
                    'VILLAGE_WARD' => $this->input->post('P_VILLAGE'),
                    'UNION_ID' => $this->input->post('P_UNION'),
                    'THANA_ID' => $this->input->post('P_UPZILLA'),
                    'POST_OFFICE_ID' => $this->input->post('P_POST_OFFICE'),
                    'POLICE_STATION_ID' => $this->input->post('P_POLISH_STATION'),
                    'DISTRICT_ID' => $this->input->post('P_DISTRICT'),
                    'DIVISION_ID' => $this->input->post('P_DIVISION'),
                    'ACTIVE_FLAG' => 1
                );
                $pr = $this->utilities->insertData($u_permanent_address, 'adm_applicant_adressinfo');
                if ($pr) {
                    echo "successfully";
                }
            }
        }
        if ($local_emergency_guardian == 'O') { /*'O' means Emergency contact others*/

            $LOCAL_GAR_NAME = $this->input->post("LOCAL_GAR_NAME");
            $LOCAL_GAR_RELATION = $this->input->post("LOCAL_GAR_RELATION");
            $LOCAL_GAR_ADDRESS = $this->input->post("LOCAL_GAR_ADDRESS");
            $LOCAL_GAR_PHN = $this->input->post("LOCAL_GAR_PHN");
            $LOCAL_GAR_EMAIL = $this->input->post("LOCAL_GAR_EMAIL");
            $check = $this->utilities->hasInformationByThisId("adm_applicant_parentinfo", array("APPLICANT_ID" => $APPLICANT_ID, "PARENTS_TYPE" => 'O'));
            if (empty($check)) {
                $gardianInfo = array(
                    /*'APP_PARENT_ID' => $this->utilities->pk_f('adm_applicant_parentinfo'),*/
                    'APPLICANT_ID' => $APPLICANT_ID,
                    'PARENTS_TYPE' => 'O',
                    'GURDIAN_NAME' => $LOCAL_GAR_NAME,
                    'NATIONALITY' => 0,
                    'MOBILE_NO' => '',
                    'EMAIL_ADRESS' => '',
                    'GARDIAN_TYPE' => 'O',
                    'GARDIAN_RELATION' => $LOCAL_GAR_RELATION,
                    'GARDIAN_ADDRESS' => $LOCAL_GAR_ADDRESS,
                    'ECP_FG' => 0,
                    'ORG_ID' => 1,
                    'ACTIVE_FLAG' => 1,
                    'CREATED_BY' => $APPLICANT_ID
                );
                if ($this->utilities->insertData($gardianInfo, 'adm_applicant_parentinfo')) {
                    echo "successfully";
                }
                $gardian_address = array(
                    'APPLICANT_ID' => $APPLICANT_ID,
                    'ADRESS_TYPE' => 'LG',
                    'SAS_PSORPR' => '',
                    'VILLAGE_WARD' => $this->input->post('LG_VILLAGE'),
                    'UNION_ID' => $this->input->post('LG_UNION'),
                    'THANA_ID' => $this->input->post('LG_UPZILLA'),
                    'POST_OFFICE_ID' => $this->input->post('LG_POST_OFFICE'),
                    'POLICE_STATION_ID' => $this->input->post('LG_POLISH_STATION'),
                    'DISTRICT_ID' => $this->input->post('LG_DISTRICT'),
                    'DIVISION_ID' => $this->input->post('LG_DIVISION'),
                    'ACTIVE_FLAG' => 1
                );
                $this->utilities->insertData($gardian_address, 'adm_applicant_adressinfo');

            }
            $check = $this->utilities->hasInformationByThisId("adm_pgscontract", array("APPLICANT_ID" => $APPLICANT_ID, 'PGSC_TYPE' => 'EG'));
            if (empty($check)) {
                $mother_id = $this->db->query("SELECT APP_PARENT_ID FROM adm_applicant_parentinfo WHERE APPLICANT_ID = $APPLICANT_ID AND PARENTS_TYPE = 'O'")->row();
                for ($i = 0; $i < sizeof($LOCAL_GAR_PHN); $i++) {
                    $other_phn = array(
                        /*'APP_PGS_ID' => $this->utilities->pk_f('adm_pgscontract'),*/
                        'APPLICANT_ID' => $APPLICANT_ID,
                        'PGSC_TYPE' => 'EG',
                        'PGSC_ID' => $mother_id->APP_PARENT_ID,
                        'CONTACTS' => $LOCAL_GAR_PHN[$i],
                        'CONTACT_TYPE' => 'M',
                        'ORG_ID' => 1,
                        'DEFAULT_FG' => 1,
                        'ACTIVE_STATUS' => 1,
                    );
                    $this->utilities->insertData($other_phn, 'adm_pgscontract');
                }
                for ($i = 0; $i < sizeof($LOCAL_GAR_EMAIL); $i++) {
                    $other_email = array(
                        /*'APP_PGS_ID' => $this->utilities->pk_f('adm_pgscontract'),*/
                        'APPLICANT_ID' => $APPLICANT_ID,
                        'PGSC_TYPE' => 'EG',
                        'PGSC_ID' => $mother_id->APP_PARENT_ID,
                        'CONTACTS' => $LOCAL_GAR_EMAIL[$i],
                        'CONTACT_TYPE' => 'E',
                        'ORG_ID' => 1,
                        'DEFAULT_FG' => 1,
                        'ACTIVE_STATUS' => 1,
                    );
                    $this->utilities->insertData($other_email, 'adm_pgscontract');
                }
            }

        } else {
            /*gardian father and mother section*/
            if ($local_emergency_guardian == 'F') {
                /*$check = $this->utilities->hasInformationByThisId("adm_pgscontract", array("APPLICANT_ID" => $APPLICANT_ID, 'GARDIAN_TYPE' => 'F'));
                if(empty($check)){*/
                $parentInfo = array(
                    'GARDIAN_TYPE' => 'F',
                    'UPDATED_BY' => $APPLICANT_ID
                );
                $this->utilities->updateData('adm_applicant_parentinfo', $parentInfo, array('APPLICANT_ID' => $APPLICANT_ID, 'PARENTS_TYPE' => 'F'));
                //}
            } else {
                /*$check = $this->utilities->hasInformationByThisId("adm_pgscontract", array("APPLICANT_ID" => $APPLICANT_ID, 'GARDIAN_TYPE' => 'M'));
                if(empty($check)){*/
                $parentInfo = array(
                    'GARDIAN_TYPE' => 'M',
                    'UPDATED_BY' => $APPLICANT_ID
                );
                $this->utilities->updateData('adm_applicant_parentinfo', $parentInfo, array('APPLICANT_ID' => $APPLICANT_ID, 'PARENTS_TYPE' => 'M'));
                //}
            }
        }
        $step = $this->db->query("SELECT MAX(STEP)step FROM adm_applicant_form_step WHERE  APPLICANT_ID = $APPLICANT_ID")->row();
        if ($step->step < $priorIndex) {
            if ($priorIndex == 2) {
                $formSteps = array(
                    'STEP' => $priorIndex
                );
                $step = $this->utilities->updateData('adm_applicant_form_step', $formSteps, array("APPLICANT_ID" => $APPLICANT_ID));
                if ($step) {
                    echo "Update successfully";
                }
            }
        }
        //End address insertion
    }

    /**
     * @access none
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */

    function applicantAcademicInfo()
    {
        $APPLICANT_ID = $this->input->post("APPLICANT_ID");
        $priorIndex = $this->input->post("priorIndex");
        $EXAM_TYPE_SSC = $this->input->post("EXAM_TYPE_SSC");
        $INSTITUTE_SSC = $this->input->post("INSTITUTE_SSC");
        $PASSING_YEAR_SSC = $this->input->post("PASSING_YEAR_SSC");
        $BOARD_SSC = $this->input->post("BOARD_SSC");
        $GROUP_SSC = $this->input->post("GROUP_SSC");
        $GPA_SSC = $this->input->post("GPA_SSC");
        $ssc_certificate = $this->input->post("ssc_certificate");
        $EXAM_TYPE_HSC = $this->input->post("EXAM_TYPE_HSC");
        $INSTITUTE_HSC = $this->input->post("INSTITUTE_HSC");
        $PASSING_YEAR_HSC = $this->input->post("PASSING_YEAR_HSC");
        $BOARD_HSC = $this->input->post("BOARD_HSC");
        $GROUP_HSC = $this->input->post("GROUP_HSC");
        $GPA_HSC = $this->input->post("GPA_HSC");
        $hsc_certificate = $this->input->post("hsc_certificate");
        $degreeId = $this->input->post("degreeId");
        $check = $this->utilities->hasInformationByThisId("adm_applicant_acadimicinfo", array("APPLICANT_ID" => $APPLICANT_ID, "ACTIVE_FLAG" => 1));
        if (empty($check)) {
            $academic_info_ssc = array(
                'APPLICANT_ID' => $APPLICANT_ID,
                'EXAM_DEGREE_ID' => $EXAM_TYPE_SSC,
                'MAJOR_GROUP_ID' => $GROUP_SSC,
                'INSTITUTION' => $INSTITUTE_SSC,
                'BOARD' => $BOARD_SSC,
                'RESULT_GRADE' => $GPA_SSC,
                'ACHIEVEMENT' => $ssc_certificate,
                'PASSING_YEAR' => $PASSING_YEAR_SSC,
                'ACTIVE_FLAG' => 1, /*1 for H.S.C*/
                'CREATED_BY' => $APPLICANT_ID
            );
            $this->utilities->insertData($academic_info_ssc, 'adm_applicant_acadimicinfo');
        }
        $check = $this->utilities->hasInformationByThisId("adm_applicant_parentinfo", array("APPLICANT_ID" => $APPLICANT_ID, "ACTIVE_FLAG" => 2));
        if (empty($check)) {
            $academic_info_ssc = array(
                'APPLICANT_ID' => $APPLICANT_ID,
                'EXAM_DEGREE_ID' => $EXAM_TYPE_HSC,
                'MAJOR_GROUP_ID' => $GROUP_HSC,
                'INSTITUTION' => $INSTITUTE_HSC,
                'BOARD' => $BOARD_HSC,
                'RESULT_GRADE' => $GPA_HSC,
                'ACHIEVEMENT' => $hsc_certificate,
                'PASSING_YEAR' => $PASSING_YEAR_HSC,
                'ACTIVE_FLAG' => 2, /*2 for H.S.C*/
                'CREATED_BY' => $APPLICANT_ID
            );
            $this->utilities->insertData($academic_info_ssc, 'adm_applicant_acadimicinfo');
        }
        if ($degreeId == 61) {
            $EXAM_NAME_HONS = $this->input->post("EXAM_NAME_HONS");
            $PASSING_YEAR_HONS = $this->input->post("PASSING_YEAR_HON");
            $UniversityName = $this->input->post("UniversityName");
            $DeptName = $this->input->post("DeptName");
            $CGPA_HONS = $this->input->post("GPA_HONS");

            /*$academic_info_ssc = array(
                'APPLICANT_ID' => $APPLICANT_ID,
                'EXAM_DEGREE_ID' => $EXAM_NAME_HONS,
                'MAJOR_GROUP_ID' => $GROUP_HSC,
                'INSTITUTION' => $UniversityName,
                'BOARD' => $BOARD_HSC,
                'RESULT_GRADE' => $CGPA_HONS,
                'PASSING_YEAR' => $PASSING_YEAR_HONS,
                'ACTIVE_FLAG' => 1
                );*/
        }
        //print_r($_POST);
        $step = $this->db->query("SELECT MAX(STEP)step FROM adm_applicant_form_step WHERE  APPLICANT_ID = $APPLICANT_ID")->row();
        if ($step->step < $priorIndex) {
            if ($priorIndex == 3) {
                $formSteps = array(
                    'STEP' => $priorIndex
                );
                $step = $this->utilities->updateData('adm_applicant_form_step', $formSteps, array("APPLICANT_ID" => $APPLICANT_ID));
                if ($step) {
                    echo "Update successfully";
                }
            }
        }
    }

    /**
     * @access none
     * @param  recieptNo
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function checkReceipt()
    {
        $receiptNo = $this->input->post("receiptNo");
        $check = $this->db->query("SELECT bd.* FROM adm_bank_deposit bd WHERE DEPOSITE_NO = $receiptNo")->row();

        if (!empty($check)) {
            $deposit_check = $this->db->query("SELECT ad.* FROM adm_applicant_deposit ad WHERE DEPOSITE_ID = $check->DEPOSITE_ID")->row();
            if (!empty($deposit_check)) {
                echo "<span class='text-danger'>Bank Receipt Already Used <i class='fa fa-times text-danger'></span></i>";
            }
        } else {
            echo "<span class='text-danger'>No Bank Receipt Found<i class='fa fa-times text-danger'></span></i>";
        }
    }

    /**
     * @access none
     * @param  recieptNo
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function checkGPASSC()
    {
        $APPLICANT_ID = $this->input->post("APPLICANT_ID");
        $SSCGPA = $this->input->post("SSCGPA");
        $app = $this->db->query("SELECT aai.* FROM adm_applicant_info aai WHERE APPLICANT_ID = $APPLICANT_ID")->row();

        $check = $this->db->query("SELECT aai.* FROM adm_admission_instruction aai WHERE PROGRAM_ID = $app->PROGRAM_ID")->row();
        if (!empty($check)) {
            echo $check->RULES;
        }
    }

    /**
     * @access none
     * @param  recieptNo
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function checkGPAHSC()
    {
        $APPLICANT_ID = $this->input->post("APPLICANT_ID");
        $SSCGPA = $this->input->post("SSCGPA");
        $app = $this->db->query("SELECT aai.* FROM adm_applicant_info aai WHERE APPLICANT_ID = $APPLICANT_ID")->row();

        $check = $this->db->query("SELECT aai.* FROM adm_admission_instruction aai WHERE PROGRAM_ID = $app->PROGRAM_ID")->row();
        if (!empty($check)) {
            echo $check->RULES;
        }
    }

    /**
     * @access none
     * @param  applicant_id , bankName, ReceiptNo, RecieptCopy
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function applicantPayment()
    {

        $APPLICANT_ID = $this->input->post("APPLICANT_ID");
        $se = $this->db->query("SELECT SESSION_ID FROM adm_applicant_info WHERE APPLICANT_ID = $APPLICANT_ID")->row();
        $branchName = $this->input->post("branchName");
        $paymentMode = $this->input->post("paymentMode");
        $receiptNo = $this->input->post("receiptNo");
        $recieptImage = $this->input->post("recieptImage");
        $priorIndex = $this->input->post("priorIndex");
        $currentDate = date("Y/m/d h:i:sa");
        $Dep = $this->utilities->findByAttribute("adm_bank_deposit", array("DEPOSITE_NO" => $receiptNo));
        $payment = array(
            'APPLICANT_ID' => $APPLICANT_ID,
            'DEPOSITE_ID' => $Dep->DEPOSITE_ID,
            'DEPOSITE_RECIEPT' => $recieptImage,
            'PAYMENT_MODE' => $paymentMode,
        );
        /*add insert into adm_applicant_deposit*/
        $paymentInsert = $this->utilities->insertData($payment, 'adm_applicant_deposit');
        if (!empty($paymentInsert)) {

            $step = $this->db->query("SELECT MAX(STEP)step FROM adm_applicant_form_step WHERE  APPLICANT_ID = $APPLICANT_ID")->row();
            if ($step->step < $priorIndex) {
                if ($priorIndex == 4) {
                    $formSteps = array(
                        'STEP' => $priorIndex,
                        'FINISHED' => 1,
                    );
                    /*update applicant form setps*/
                    $step = $this->utilities->updateData('adm_applicant_form_step', $formSteps, array("APPLICANT_ID" => $APPLICANT_ID));
                    if (!empty($step)) {
                        /*applicant admid card generate or not procedure*/
                        $admidStatus = $this->utilities->findByAttribute("app_policy", array("POLICY_ID" => 9));
                        if ($admidStatus->POLICY_FLAG == 0) { /*if POLICY_FLAG of app_policy is equal to 0 then ADMIT_CARD_GENERATED of adm_applicant_info update 1*/
                            $app_session = $this->session->userdata('applicant_logged_in');
                            $year = date('Y');
                            $session = $app_session['SESSION_ID'];
                            $program = $app_session['PROGRAM_ID'];
                            $ROLL_NO = $this->utilities->get_addmission_roll_number($year, $session, $program);

                            $applicantUp = array(
                                'ADMIT_CARD_GENERATED' => 1,
                                'ROLL_NO' => $ROLL_NO,
                            );
                            $this->utilities->updateData('adm_applicant_info', $applicantUp, array("APPLICANT_ID" => $APPLICANT_ID));
                        }
                        echo $admidStatus->POLICY_FLAG;
                        /*End applicant admid card generate procedure*/
                    }
                }
            }
        }
    }
}
