<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eregistration extends CI_Controller
{

    private $user;
    public $user_id = null;

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('auth/login', 'refresh');
        }
        $user_session = $this->user = $this->session->userdata("logged_in");
        $this->user_id = $user_session['USER_TYPE'];
        $this->load->model('utilities');
    }

    /**
     * @methodName checkPrevilege()
     * @access
     * @param  none
     * @return Mixed View
     */

    public function checkPrevilege($param = "")
    {
        if ($param == "") {
            $controller = $this->uri->segment(1, 'dashboard');
            $action = $this->uri->segment(2, 'index');
            $link = "$controller/$action";
        } else {
            $link = "$param";
        }
        return $this->security_model->get_all_checked_module_links_by_user($link, $this->user['USERGRP_ID'], $this->user['USERLVL_ID'], $this->user['USER_ID']);
    }

    /**
     * @access none
     * @param  none
     * @author Abhijit Mondal Abhi <abhijit@atilimited.net>
     * @return View
     */

    function index()
    {
        $data['content_view_page'] = 'eregistration/welcome.php';
        $this->applicant_portal->display($data);
    }


    function registrationDetails()
    {
        $user_data = $this->session->userdata('applicant_logged_in');
        $applicant = $this->utilities->findByAttribute('applicant_personal_info', array('APPLICANT_USER_ID' => $user_data['APPLICANT_USER_ID']));
        $APPLICANT_ID = $applicant->APPLICANT_ID;

        $data['applicant_id'] = $APPLICANT_ID;
        $data["applicant_info"] = $this->eregistration_model->getAppicantInfoAll($APPLICANT_ID);
        //echo "<pre>"; print_r($data); exit; echo "</pre>";

        $data['content_view_page'] = 'eregistration/details_modal_view';
        $this->applicant_portal->display($data);
    }

    function registrationPersonalDetails()
    {
        $user_data = $this->session->userdata('applicant_logged_in');
        $applicant = $this->utilities->findByAttribute('applicant_personal_info', array('APPLICANT_USER_ID' => $user_data['APPLICANT_USER_ID']));
        $APPLICANT_ID = $applicant->APPLICANT_ID;

        $data['applicant_id'] = $APPLICANT_ID;
        $data["applicant_info"] = $this->eregistration_model->getAppicantInfoAll($APPLICANT_ID);

        $this->load->view('eregistration/registration_personal_details', $data);
    }

    function registrationFamilyDetails()
    {
        $user_data = $this->session->userdata('applicant_logged_in');
        $applicant = $this->utilities->findByAttribute('applicant_personal_info', array('APPLICANT_USER_ID' => $user_data['APPLICANT_USER_ID']));
        $APPLICANT_ID = $applicant->APPLICANT_ID;
        $data['applicant_info'] = $applicant;


        $data['applicant_id'] = $APPLICANT_ID;
        $data["fathersInfo"] = $this->eregistration_model->getApplicantFatherInfo($APPLICANT_ID);
        $data["motherInfo"] = $this->eregistration_model->getApplicantMotherInfo($APPLICANT_ID);
        $data["local_guardian"] = $this->eregistration_model->getApplicantLocalGuardianInfo($APPLICANT_ID);

        $this->load->view('eregistration/registration_family_details', $data);
    }

    public function registrationAddressInfo()
    {
        $user_data = $this->session->userdata('applicant_logged_in');
        $applicant = $this->utilities->findByAttribute('applicant_personal_info', array('APPLICANT_USER_ID' => $user_data['APPLICANT_USER_ID']));
        $APPLICANT_ID = $applicant->APPLICANT_ID;
        $data['applicant_info'] = $applicant;

        $data['applicant_id'] = $APPLICANT_ID;
        $data['local_present_adddress'] = $this->eregistration_model->getLocalPresentAddress($APPLICANT_ID);
        $data['local_permanent_adddress'] = $this->eregistration_model->getLocalPermanentAddress($APPLICANT_ID);

        $this->load->view('eregistration/registration_address_details', $data);
    }

    function registrationAcademicInfo()
    {
        $user_data = $this->session->userdata('applicant_logged_in');
        $applicant = $this->utilities->findByAttribute('applicant_personal_info', array('APPLICANT_USER_ID' => $user_data['APPLICANT_USER_ID']));
        $APPLICANT_ID = $applicant->APPLICANT_ID;
        $data['applicant_info'] = $applicant;

        $data['applicant_id'] = $APPLICANT_ID;
        $data['academic'] = $this->eregistration_model->getApplicantAcademicInfo($APPLICANT_ID);

        $this->load->view('eregistration/registration_academic_details', $data);
    }

    function registrationOtherDetailsInfo()
    {
        $user_data = $this->session->userdata('applicant_logged_in');
        $applicant = $this->utilities->findByAttribute('applicant_personal_info', array('APPLICANT_USER_ID' => $user_data['APPLICANT_USER_ID']));
        $APPLICANT_ID = $applicant->APPLICANT_ID;
        $data['applicant_info'] = $applicant;

        $data['applicant_id'] = $APPLICANT_ID;
        $data["applicant_info"] = $this->eregistration_model->getAppicantInfoAll($APPLICANT_ID);

        $this->load->view('eregistration/registration_others_details', $data);
    }

    function importStudent()
    {
        $data['contentTitle'] = 'Create Student';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Create Student" => '#'
        );
        $data['pageTitle'] = 'Studnet Login info ';
        $data['content_view_page'] = 'admin/setup/create_student/import_student';
        $this->admin_template->display($data);
    }

    function saveCsv()
    {

        $this->load->library('csvimport');
        $data['error'] = '';    //initialize image upload error array to empty
        $config['upload_path'] = 'upload/eregistration/existing_student';
        $config['allowed_types'] = 'csv|xls|xlsx';
        $config['max_size'] = '1000';

        $this->load->library('upload', $config);


        // If upload failed, display error
        if (!$this->upload->do_upload()) {

            $data['error'] = $this->upload->display_errors();

        } else {

            $file_data = $this->upload->data();


            $file_path = 'upload/eregistration/existing_student/' . $file_data['file_name'];

            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);

                foreach ($csv_array as $row) {
                    //$pk = $this->utilities->pk_f('students_info');
                    $student_info = array(
                        //'STUDENT_ID' => $pk,
                        'REGISTRATION_NO' => $row['ID'],
                        'FULL_NAME_EN' => $row['STUDENT'],
                        'MOBILE_NO' => $row['MOBILE'],
                        'PREVIOUS_STU_FG' => 1,
                        //'EMAIL_ADRESS' => $row['EMAIL'],
                        'LOGIN_PASSWORD' => $this->generatePassword(),
                    );

                    $this->utilities->insertData($student_info, 'student_personal_info');
//                    $stu_contact = array(

//                        'STU_CI_ID' => $this->utilities->pk_f('stu_contractinfo'),
//                        'STUDENT_ID' => $pk,
//                        'CONTACTS' => $row['MOBILE'],
//                        'CONTACT_TYPE' => 'M',
//                    );
//                    $this->utilities->insertData($stu_contact, 'stu_contractinfo');
                }
                $this->session->set_flashdata('Success', 'Student Information Inserted Successfully.');
                redirect("eregistration/importStudent");
            } else
                $data['error'] = "Error occured";
        }
    }


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


    function existingStudentList()
    {
        $data['contentTitle'] = 'Upload Student List';
        $data["breadcrumbs"] = array(
            "Student" => "#",
            "Upload Student List" => '#'
        );
        $data["previlages"] = $this->checkPrevilege('eregistration/existingStudentList');
        $data["session"] = $this->utilities->admissionSessionList();
        $data["ins_session"] = $this->utilities->academicSessionList();
        $data['program'] = $this->utilities->getAll('ins_program');
        //echo "<pre>"; print_r($data['ins_session']); exit;
        $data['section'] = $this->db->query("SELECT a.SECTION_ID,a.NAME FROM aca_section a;")->result();
        $data["ac_type"] = '';
        $data['dimention'] = "horizental";
        $data['existing_student'] = $this->db->query("SELECT a.*
                                                          FROM student_personal_info a
                                                         WHERE a.PREVIOUS_STU_FG = 1 AND SESSION_ID IS NULL
                                                        ORDER BY a.STUDENT_ID ASC")->result(); 
        $data['content_view_page'] = 'eregistration/existing_student_list';
        $this->admin_template->display($data);
    }


    /**
     * @access none
     * @param  none
     * @author Abhijit Mondal Abhi <abhijit@atilimited.net>
     * @return View
     */

    function loadExistingStudentList()
    {
        $data['existing_student'] = $this->db->query("SELECT a.*
                                                          FROM student_personal_info a
                                                         WHERE a.PREVIOUS_STU_FG = 1 AND SESSION_ID IS NULL
                                                        ORDER BY a.STUDENT_ID ASC")->result();

        $this->load->view('eregistration/search_student_list',$data);

    }

}