<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @category   Applicalnt
 * @package    Applicalnt Activity
 * @author     Emdadul Huq <emdadul@atilimited.net>
 * @copyright  2015 ATI Limited Development Group
 */
class Applicant extends CI_Controller
{
    protected $APPLICANT_ID;

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('applicant_logged_in') == FALSE) {
            redirect('portal/online_apply', 'refresh');
        }

        $user_data = $this->session->userdata('applicant_logged_in');
        $this->APPLICANT_USER_ID = $user_data['APPLICANT_USER_ID'];

        header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->load->model('utilities');
    }

    /**
     * @access none
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed View
     */
    function index()
    {
        $data['content_view_page'] = 'applicant/welcome.php';
        $this->applicant_portal->display($data);
    }

    /**
     * @access none
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return View
     */
    function registrationSuccess($applicant)
    {
        $data['content_view_page'] = 'admin/applicant/success_msg.php';
        $this->applicant_portal->display($data);
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return
     */
    public function admission()
    {
        $data['contentTitle'] = 'Admission';
        $data["breadcrumbs"] = array(
            "Applicant" => "#",
            "Admission" => '#'
        );
        $data['pageTitle'] = 'Online University Management System';
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('FULL_NAME_BN', 'full name', 'required'); 
        $applicant_ses = $this->session->userdata('applicant_logged_in'); 
        if ($this->form_validation->run() == FALSE) { 
            // print_r($this->session->userdata('applicant_logged_in'));  echo
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
            // $data['session'] = $this->utilities->getAll('session_view');
            $data['faculty'] = $this->utilities->findAllByAttribute('ins_faculty', array('ACTIVE_STATUS' => 1));
            $data['department'] = $this->utilities->findAllByAttribute('ins_dept', array('ACTIVE_STATUS' => 1));
            $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
            $data['applicant_user'] = $this->utilities->findAllByAttribute('applicant_user', array('APPLICANT_USER_ID' => $applicant_ses['APPLICANT_USER_ID']));
            $data['selected_program'] = $this->utilities->findByAttribute('ins_program',array('PROGRAM_ID' => $applicant_ses['PROGRAM_ID']));
            //print_r($data['applicant_user'] );exit;
            // echo $data['applicant_user'][0]->APPLICANT_USER_ID;exit;
            if ($data['applicant_user'][0]->FF_COM_STATUS == 0) {
                $data['content_view_page'] = 'applicant/admission';
            } else {
                redirect('applicant/applicantDetails');
            }

        } else {

            $current_adm_info = $this->utilities->findByAttribute('adm_ysession', array('IS_CURRENT' => 1));
            $current_session_id = $current_adm_info->YSESSION_ID;
            $current_session_year = $current_adm_info->DINYEAR;
            $ADM_ROLL_NO = $this->utilities->get_addmission_roll_number($current_session_year, $current_session_id, $applicant_ses['FACULTY_ID'], $applicant_ses['DEPT_ID'], $applicant_ses['PROGRAM_ID']);

            require(APPPATH . 'views/common/image_upload/class.upload.php');
            $applicant_photo_name = '';
            $signature_photo_name = '';
            $foo = new Upload($_FILES['photo']);
            if ($foo->uploaded) {
                // large size image
                //$foo->file_new_name_body = 'foo';
                $foo->image_border = 1;
                $foo->file_new_name_body = 'photo_'.$ADM_ROLL_NO;
                //$foo->image_border_color    = '#231F20';
                $foo->allowed = array('image/*');
                $foo->Process('upload/applicant/photo/');
                if ($foo->processed) {
                    $applicant_photo_name=  'photo_'.$ADM_ROLL_NO.'.'.$foo->file_src_name_ext;

                } else {
                    echo 'error : ' . $foo->error;
                }
            }

            $sig_photo = new Upload($_FILES['signature']);
            if ($sig_photo->uploaded) {
                // large size image
                $sig_photo->file_new_name_body = 'signature_'.$ADM_ROLL_NO;
                $sig_photo->image_border = 1;
                //$foo->image_border_color    = '#231F20';
                $sig_photo->allowed = array('image/*');
                $sig_photo->Process('upload/applicant/signature/');
                if ($sig_photo->processed) {
                    $signature_photo_name = 'signature_'.$ADM_ROLL_NO.'.'.$sig_photo->file_src_name_ext;
                } else {
                    echo 'error : ' . $sig_photo->error;
                }
            }
            // ### applicant personal information ###


            $applicnt_personal_info = array(
                'FULL_NAME_EN' => $applicant_ses['FULL_NAME'],
                'MOBILE_NO' => $applicant_ses['MOBILE'],
                'GENDER' => $applicant_ses['GENDER'],
                'DATH_OF_BIRTH' => $applicant_ses['BIRTH_DT'],
                'EMAIL_ADRESS' => $applicant_ses['EMAIL'],
                'APPLICANT_USER_ID' => $applicant_ses['APPLICANT_USER_ID'],
                'ADM_PRG_ID' => $applicant_ses['ADM_PRG_ID'],
                'ADM_SESSION_ID' => $current_session_id,
                'ADM_ROLL_NO' => $ADM_ROLL_NO,

                'DEGREE_ID' => $applicant_ses['DEGREE_ID'],
                'FACULTY_ID' => $applicant_ses['FACULTY_ID'],
                'DEPT_ID' => $applicant_ses['DEPT_ID'],
                'PROGRAM_ID' => $applicant_ses['PROGRAM_ID'],

                'MOTHER_NAME' => $this->input->post('MOTHER_NAME'),
                'FATHER_NAME' => $this->input->post('FATHER_NAME'),
                'PLACE_OF_BIRTH' => $this->input->post('PLACE_OF_BIRTH'),
                'FULL_NAME_BN' => $this->input->post('FULL_NAME_BN'),
                'BLOOD_GROUP' => $this->input->post('BLOOD_GRP'),
                'MARITAL_STATUS' => $this->input->post('MARITAL_STATUS'),
                'NATIONALITY' => $this->input->post('NATIONALITY'),
                'RELIGION_ID' => $this->input->post('RELIGION_ID'),
                'BIRTH_CERTIFICATE' => $this->input->post('BIRTH_CERTIFICATE'),
                'NATIONAL_ID' => $this->input->post('NATIONAL_ID'),
                'HEIGHT_FEET' => $this->input->post('HEIGHT_FEET'),
                'HEIGHT_CM' => $this->input->post('HEIGHT_CM'),
                'WEIGHT_KG' => $this->input->post('WEIGHT_KG'),
                'WEIGHT_LBS' => $this->input->post('WEIGHT_LBS'),
                'PHOTO' => $applicant_photo_name,
                'SIGNATURE_PHOTO' => $signature_photo_name,
                'ANNUAL_INCOME' => $this->input->post('ANNUAL_INCOME'),
                'SCHOLARSHIP' => $this->input->post('SCHOLARSHIP'),
                'SCHOLARSHIP_DESC' => $this->input->post('SCHOLARSHIP_DESC'),
                'EXPELLED' => $this->input->post('EXPELLED'),
                'EXPELLED_DESC' => $this->input->post('EXPELLED_DESC'),
                'ARRESTED' => $this->input->post('ARRESTED'),
                'ARRESTED_DESC' => $this->input->post('ARRESTED_DESC'),
                'CONVICTED' => $this->input->post('CONVICTED'),
                'CONVICTED_DESC' => $this->input->post('CONVICTED_DESC'),
                'APPLY_BEFORE' => $this->input->post('APPLY_BEFORE'),
                'APPLY_SEMESTER' => $this->input->post('APPLY_SEMESTER'),
                'APPLY_YEAR' => $this->input->post('APPLY_YEAR'),
                'SIBLING_EXIST' => $this->input->post('SIBLING_EXIST'),
                'SBLN_ROLL_NO' => $this->input->post('SBLN_ROLL_NO'),
            );
            // print_r($applicnt_personal_info);exit;
            $this->utilities->insert('applicant_personal_info', $applicnt_personal_info);
            $applicant_id = $this->db->insert_id();

            // ### applicant father information ###
            $applicant_father_info = array(
                'APPLICANT_ID' => $applicant_id,
                'GURDIAN_NAME' => $this->input->post('FATHER_NAME'),
                'OCCUPATION' => $this->input->post('FATHER_OCU'),
                'MOBILE_NO' => $this->input->post('FATHER_PHN'),
                'EMAIL_ADRESS' => $this->input->post('FATHER_EMAIL'),
                'WORKING_ORG' => $this->input->post('FATHER_WORK_ADRESS'),
                'GUARDIAN_TYPE' => 'F',
            );
            $this->utilities->insert('applicant_gurdianinfo', $applicant_father_info);
            // ### applicant mother information ###
            $applicant_mother_info = array(
                'APPLICANT_ID' => $applicant_id,
                'GURDIAN_NAME' => $this->input->post('MOTHER_NAME'),
                'OCCUPATION' => $this->input->post('MOTHER_OCU'),
                'MOBILE_NO' => $this->input->post('MOTHER_PHN'),
                'EMAIL_ADRESS' => $this->input->post('MOTHER_EMAIL'),
                'WORKING_ORG' => $this->input->post('MOTHER_WORK_ADDRESS'),
                'GUARDIAN_TYPE' => 'M',
            );
            $this->utilities->insert('applicant_gurdianinfo', $applicant_mother_info);
            // ### applicant mother information ###
            if ($this->input->post('local_emergency_guardian') == 'F') {
                $local_guandian_flag = array(
                    'LOCAL_GUARDIAN_FG' => 1,
                );
                $this->utilities->updateData('applicant_gurdianinfo', $local_guandian_flag, array("APPLICANT_ID" => $applicant_id, "GUARDIAN_TYPE" => 'F',));
            } else if ($this->input->post('local_emergency_guardian') == 'M') {
                $local_guandian_flag = array(
                    'LOCAL_GUARDIAN_FG' => 1,
                );
                $this->utilities->updateData('applicant_gurdianinfo', $local_guandian_flag, array("APPLICANT_ID" => $applicant_id, "GUARDIAN_TYPE" => 'M',));

            } else {
                $applicant_local_guardian_info = array(
                    'APPLICANT_ID' => $applicant_id,
                    'GURDIAN_NAME' => $this->input->post('LOCAL_GAR_NAME'),
                    'GUARDIAN_RELATION' => $this->input->post('LOCAL_GAR_RELATION'),
                    'ADDRESS' => $this->input->post('LOCAL_GAR_ADDRESS'),
                    'MOBILE_NO' => $this->input->post('LOCAL_GAR_PHN'),
                    'GUARDIAN_TYPE' => 'O',
                    'LOCAL_GUARDIAN_FG' => 1,
                );
                $this->utilities->insert('applicant_gurdianinfo', $applicant_local_guardian_info);
            }

            // present and permanet address insertion
            if ($this->input->post('same_as_present') == 'YES') {
                $present_address = array(
                    'APPLICANT_ID' => $applicant_id,
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
                $this->utilities->insertData($present_address, 'applicant_adressinfo');
            } else {
                $present_address = array(
                    'APPLICANT_ID' => $applicant_id,
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
                $this->utilities->insertData($present_address, 'applicant_adressinfo');

                $permanent_address = array(
                    'APPLICANT_ID' => $applicant_id,
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
                $this->utilities->insertData($permanent_address, 'applicant_adressinfo');
            }
            //end address insertion

//academic information insertion
            $EXAM_NAME = $this->input->post("EXAM_NAME");
            $PASSING_YEAR = $this->input->post("PASSING_YEAR");
            $BOARD = $this->input->post("BOARD");
            $GROUP = $this->input->post("GROUP");
            $GPA = $this->input->post("GPA");
            $INSTITUTE = $this->input->post("INSTITUTE");
            $GPAWA = $this->input->post("GPAWA");

            foreach ($EXAM_NAME as $key => $value) {
                $applicant_academic_info = array(
                    'APPLICANT_ID' => $applicant_id,
                    'EXAM_DEGREE_ID' => $EXAM_NAME[$key],
                    'PASSING_YEAR' => $PASSING_YEAR[$key],
                    'BOARD' => $BOARD[$key],
                    'MAJOR_GROUP_ID' => $GROUP[$key],
                    'RESULT_GRADE' => $GPA[$key],
                    'RESULT_GRADE_WA' => $GPAWA[$key],
                    'INSTITUTION' => $INSTITUTE[$key]
                );
                $this->utilities->insert('applicant_acadimicinfo', $applicant_academic_info);
            }

            $form_complete_status = array(
                'FF_COM_STATUS' => '1'
            );
            $this->utilities->updateData('applicant_user', $form_complete_status, array('APPLICANT_USER_ID' => $applicant_ses['APPLICANT_USER_ID']));

            redirect('applicant/admissionNotification');
        }


        $this->applicant_portal->display($data);

    }


    /**
     * @access
     * @param  applicant_id
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return
     */
    function admissionNotification()
    {
        $data['content_view_page'] = 'applicant/applicant_admission_notification';
        $this->applicant_portal->display($data);
    }


    /**
     * @access
     * @param
     * @author Abhijit Mondal Abhi <abhijit@atilimited.net>
     * @return
     */

    function applicantDetails()
    {
        $applicant = $this->utilities->findByAttribute('applicant_personal_info', array('APPLICANT_USER_ID' => $this->APPLICANT_USER_ID));
        $APPLICANT_ID = $applicant->APPLICANT_ID;

        $data['applicant_id'] = $APPLICANT_ID;
        $data["applicant_info"] = $this->applicant_model->getAppicantInfoAll($APPLICANT_ID);

        //echo "<pre>"; print_r($data["applicant_info"]); exit; echo "</pre>";

        $data['content_view_page'] = 'applicant/details_modal_view';
        $this->applicant_portal->display($data);
    }

    function applicantPersonalDetails($applicant_id = '')
    {
        $applicant = $this->utilities->findByAttribute('applicant_personal_info', array('APPLICANT_USER_ID' => $this->APPLICANT_USER_ID));
        $APPLICANT_ID = $applicant->APPLICANT_ID;

        $data['applicant_id'] = $APPLICANT_ID;
        $data["applicant_info"] = $this->applicant_model->getAppicantInfoAll($APPLICANT_ID);

        $this->load->view('applicant/applicant_personal_information', $data);
    }

    function updateApplicantPersonalDetails()
    {
        $applicant = $this->utilities->findByAttribute('applicant_personal_info', array('APPLICANT_USER_ID' => $this->APPLICANT_USER_ID));
        $APPLICANT_ID = $applicant->APPLICANT_ID;

        if ($applicant->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS != 1) {
            $this->form_validation->set_rules('FULL_NAME_BN', 'Full name BN', 'required');
            $this->form_validation->set_rules('PLACE_OF_BIRTH', 'place', 'required');

            $data["applicant_info"] = $this->applicant_model->getAppicantInfoAll($APPLICANT_ID);

            if ($this->form_validation->run() == FALSE) {

                $data['nationality'] = $this->utilities->getAll('country');
                $data['religion'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 3));
                $data['merital_status'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 8));
                $data['blood_group'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 4));

                $this->load->view('applicant/update_applicant_personal_information', $data);

            } else {

                require(APPPATH . 'views/common/image_upload/class.upload.php');
                $applicant_photo_name = '';
                $signature_photo_name = '';



                $foo = new Upload($_FILES['photo']);
                if ($foo->uploaded) {
                    // large size image

                    unlink('upload/applicant/photo/'.$applicant->PHOTO);

                    $foo->file_new_name_body = 'photo_'.$applicant->ADM_ROLL_NO;
                    $foo->image_border = 1;
                    //$foo->file_overwrite = true;
                    //$foo->image_border_color    = '#231F20';
                    $foo->allowed = array('image/*');
                    $foo->Process('upload/applicant/photo/');

                    if ($foo->processed) {

                        $applicant_photo_name = 'photo_'.$applicant->ADM_ROLL_NO.'.'.$foo->file_src_name_ext;
                    } else {
                        echo 'error : ' . $foo->error;
                    }
                }


                $sig_photo = new Upload($_FILES['signature']);
                if ($sig_photo->uploaded) {

                    unlink('upload/applicant/signature/'.$applicant->SIGNATURE_PHOTO);

                    // large size image
                    $sig_photo->file_new_name_body = 'signature_'.$applicant->ADM_ROLL_NO;
                    $sig_photo->image_border = 1;
                    //$sig_photo->file_overwrite = true;
                    //$foo->image_border_color    = '#231F20';
                    $sig_photo->allowed = array('image/*');
                    $sig_photo->Process('upload/applicant/signature/');
                    if ($sig_photo->processed) {
                        $signature_photo_name = 'signature_'.$applicant->ADM_ROLL_NO.'.'.$sig_photo->file_src_name_ext;
                    } else {
                        echo 'error : ' . $sig_photo->error;
                    }
                }
                // ### applicant personal information ###
                $applicant_info = array(
                    'FULL_NAME_BN' => $this->input->post('FULL_NAME_BN'),
                    'PLACE_OF_BIRTH' => $this->input->post('PLACE_OF_BIRTH'),
                    'BLOOD_GROUP' => $this->input->post('BLOOD_GRP'),
                    'MARITAL_STATUS' => $this->input->post('MARITAL_STATUS'),
                    'NATIONALITY' => $this->input->post('NATIONALITY'),
                    'NATIONAL_ID' => $this->input->post('NATIONAL_ID'),
                    'BIRTH_CERTIFICATE' => $this->input->post('BIRTH_CERTIFICATE'),
                    'RELIGION_ID' => $this->input->post('RELIGION_ID'),

                    'HEIGHT_FEET' => $this->input->post('HEIGHT_FEET'),
                    'HEIGHT_CM' => $this->input->post('HEIGHT_CM'),
                    'WEIGHT_KG' => $this->input->post('WEIGHT_KG'),
                    'WEIGHT_LBS' => $this->input->post('WEIGHT_LBS'),
                );

                if ($applicant_photo_name != '') {
                    $applicant_info['PHOTO'] = $applicant_photo_name;

                }
                if ($signature_photo_name != '') {
                    $applicant_info['SIGNATURE_PHOTO'] = $signature_photo_name;

                }
                // print_r($emp_info);exit;
                $this->utilities->updateData('applicant_personal_info', $applicant_info, array('APPLICANT_ID' => $APPLICANT_ID));

                echo $applicant_photo_name;
            }

        } else {

            redirect('applicant/applicantDetails');
        }

    }

    function applicantFamillyDetails()
    {
        $applicant = $this->utilities->findByAttribute('applicant_personal_info', array('APPLICANT_USER_ID' => $this->APPLICANT_USER_ID));
        $APPLICANT_ID = $applicant->APPLICANT_ID;
        $data['applicant_info'] = $applicant;


        $data['applicant_id'] = $APPLICANT_ID;
        $data["fathersInfo"] = $this->applicant_model->getApplicantFatherInfo($APPLICANT_ID);
        $data["motherInfo"] = $this->applicant_model->getApplicantMotherInfo($APPLICANT_ID);
        $data["local_guardian"] = $this->applicant_model->getApplicantLocalGuardianInfo($APPLICANT_ID);

        $this->load->view('applicant/applicant_family_details', $data);
    }

    function updateApplicantFamilyDetails()
    {
        $applicant = $this->utilities->findByAttribute('applicant_personal_info', array('APPLICANT_USER_ID' => $this->APPLICANT_USER_ID));
        $APPLICANT_ID = $applicant->APPLICANT_ID;
        $data['applicant_info'] = $APPLICANT_ID;

        if ($applicant->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS != 1) {
            $this->form_validation->set_rules('FATHER_NAME', 'Father name', 'required');

            if ($this->form_validation->run() == FALSE) {

                $data['occupation'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 21));
                $data['relation'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 40));

                $data["fathersInfo"] = $this->applicant_model->getApplicantFatherInfo($APPLICANT_ID);
                $data["motherInfo"] = $this->applicant_model->getApplicantMotherInfo($APPLICANT_ID);
                $data["local_guardian"] = $this->applicant_model->getApplicantLocalGuardianInfo($APPLICANT_ID);

                //echo "<pre>"; echo print_r($data["local_guardian"]); exit; echo "</pre>";

                $this->load->view('applicant/update_applicant_family_details', $data);
            } else {

                // ### applicant father information ###

                $applicant_father_info = array(
                    'APPLICANT_ID' => $APPLICANT_ID,
                    'GURDIAN_NAME' => $this->input->post('FATHER_NAME'),
                    'OCCUPATION' => $this->input->post('FATHER_OCU'),
                    'MOBILE_NO' => $this->input->post('FATHER_PHN'),
                    'EMAIL_ADRESS' => $this->input->post('FATHER_EMAIL'),
                    'WORKING_ORG' => $this->input->post('FATHER_WORK_ADRESS'),
                    'GUARDIAN_TYPE' => 'F',
                );

                $father_id = $this->input->post('APP_FATHER_ID');

                $this->utilities->updateData('applicant_gurdianinfo', $applicant_father_info, array('APP_PARENT_ID' => $father_id));
                //$this->utilities->insert('applicant_gurdianinfo', $applicant_father_info);
                // ### applicant mother information ###
                $applicant_mother_info = array(
                    'APPLICANT_ID' => $APPLICANT_ID,
                    'GURDIAN_NAME' => $this->input->post('MOTHER_NAME'),
                    'OCCUPATION' => $this->input->post('MOTHER_OCU'),
                    'MOBILE_NO' => $this->input->post('MOTHER_PHN'),
                    'EMAIL_ADRESS' => $this->input->post('MOTHER_EMAIL'),
                    'WORKING_ORG' => $this->input->post('MOTHER_WORK_ADDRESS'),
                    'GUARDIAN_TYPE' => 'M',
                );

                $mother_id = $this->input->post('APP_MOTHER_ID');

                $this->utilities->updateData('applicant_gurdianinfo', $applicant_mother_info, array('APP_PARENT_ID' => $mother_id));
                //$this->utilities->insert('applicant_gurdianinfo', $applicant_mother_info);
                // ### applicant mother information ###
                if ($this->input->post('local_emergency_guardian') == 'F') {
                    $local_guandian_flag = array(
                        'LOCAL_GUARDIAN_FG' => 1,
                    );
                    $local_guandian_remove_flag = array(
                        'LOCAL_GUARDIAN_FG' => 0,
                    );

                    $this->utilities->updateData('applicant_gurdianinfo', $local_guandian_flag, array("APPLICANT_ID" => $APPLICANT_ID, "GUARDIAN_TYPE" => 'F',));
                    $this->utilities->updateData('applicant_gurdianinfo', $local_guandian_remove_flag, array("APPLICANT_ID" => $APPLICANT_ID, "GUARDIAN_TYPE" => 'M',));
                } else if ($this->input->post('local_emergency_guardian') == 'M') {
                    $local_guandian_flag = array(
                        'LOCAL_GUARDIAN_FG' => 1,
                    );
                    $local_guandian_remove_flag = array(
                        'LOCAL_GUARDIAN_FG' => 0,
                    );
                    $this->utilities->updateData('applicant_gurdianinfo', $local_guandian_flag, array("APPLICANT_ID" => $APPLICANT_ID, "GUARDIAN_TYPE" => 'M',));
                    $this->utilities->updateData('applicant_gurdianinfo', $local_guandian_remove_flag, array("APPLICANT_ID" => $APPLICANT_ID, "GUARDIAN_TYPE" => 'F',));

                } else {
                    $applicant_local_guardian_info = array(
                        'APPLICANT_ID' => $APPLICANT_ID,
                        'GURDIAN_NAME' => $this->input->post('LOCAL_GAR_NAME'),
                        'GUARDIAN_RELATION' => $this->input->post('LOCAL_GAR_RELATION'),
                        'ADDRESS' => $this->input->post('LOCAL_GAR_ADDRESS'),
                        'MOBILE_NO' => $this->input->post('LOCAL_GAR_PHN'),
                        'GUARDIAN_TYPE' => 'O',
                        'LOCAL_GUARDIAN_FG' => 1,
                    );
                    $this->utilities->insert('applicant_gurdianinfo', $applicant_local_guardian_info);
                }

                $this->session->set_flashdata('Success', 'Successfully Updated');
                redirect('applicant/applicantDetails');

            }
        } else {

            redirect('applicant/applicantDetails');
        }


    }

    public function applicantAddressInfo()
    {
        $applicant = $this->utilities->findByAttribute('applicant_personal_info', array('APPLICANT_USER_ID' => $this->APPLICANT_USER_ID));
        $APPLICANT_ID = $applicant->APPLICANT_ID;
        $data['applicant_info'] = $applicant;

        $data['applicant_id'] = $APPLICANT_ID;
        $data['local_present_adddress'] = $this->applicant_model->getLocalPresentAddress($APPLICANT_ID);
        $data['local_permanent_adddress'] = $this->applicant_model->getLocalPermanentAddress($APPLICANT_ID);

        $this->load->view('applicant/applicant_address', $data);
    }

    function updateApplicantAddressInfo()
    {
        $applicant = $this->utilities->findByAttribute('applicant_personal_info', array('APPLICANT_USER_ID' => $this->APPLICANT_USER_ID));
        $APPLICANT_ID = $applicant->APPLICANT_ID;

        if ($applicant->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS != 1) {
            $data['local_present_adddress'] = $this->applicant_model->getLocalPresentAddress($APPLICANT_ID);
            $data['local_permanent_adddress'] = $this->applicant_model->getLocalPermanentAddress($APPLICANT_ID);

            //echo "<pre>"; echo print_r($data['local_present_adddress']); exit; echo "</pre>";

            $this->form_validation->set_rules('DIVISION_ID', 'Division name', 'required');

            if ($this->form_validation->run() == FALSE) {

                $data['division'] = $this->utilities->getAll('sa_divisions');
                $data['district'] = $this->utilities->getAll('sa_districts');
                $data['thana'] = $this->utilities->getAll('sa_thanas');
                $data['police_station'] = $this->utilities->getAll('sa_police_station');
                $data['ward_no'] = $this->utilities->getAll('sa_unions');
                $data['post_office'] = $this->utilities->getAll('sa_post_offices');

                $this->load->view('applicant/update_applicant_address', $data);
            } else {

                // present and permanet address insertion
                if ($this->input->post('same_as_present') == 'YES') {
                    $present_address = array(
                        'APPLICANT_ID' => $APPLICANT_ID,
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

                    $this->utilities->updateData('applicant_adressinfo', $present_address, array('APPLICANT_ID' => $APPLICANT_ID, 'ADRESS_TYPE' => 'PS'));

                    $this->session->set_flashdata('Success', 'Successfully Updated');
                    redirect('applicant/applicantDetails');
                } else {
                    $present_address = array(
                        'APPLICANT_ID' => $APPLICANT_ID,
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

                    $this->utilities->updateData('applicant_adressinfo', $present_address, array('APPLICANT_ID' => $APPLICANT_ID, 'ADRESS_TYPE' => 'PS'));

                    $permanent_address = array(
                        'APPLICANT_ID' => $APPLICANT_ID,
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

                    $this->utilities->updateData('applicant_adressinfo', $permanent_address, array('APPLICANT_ID' => $APPLICANT_ID, 'ADRESS_TYPE' => 'PR'));

                    $this->session->set_flashdata('Success', 'Successfully Updated');
                    redirect('applicant/applicantDetails');
                }
            }
        } else {

            redirect('applicant/applicantDetails');
        }

    }

    function applicantAcademicInfo()
    {
        $applicant = $this->utilities->findByAttribute('applicant_personal_info', array('APPLICANT_USER_ID' => $this->APPLICANT_USER_ID));
        $APPLICANT_ID = $applicant->APPLICANT_ID;
        $data['applicant_info'] = $applicant;

        $data['applicant_id'] = $APPLICANT_ID;
        $data['academic'] = $this->applicant_model->getApplicantAcademicInfo($APPLICANT_ID);

        $this->load->view('applicant/applicant_academic_info', $data);
    }

    function updateApplicantAcademicInfo()
    {
        $applicant = $this->utilities->findByAttribute('applicant_personal_info', array('APPLICANT_USER_ID' => $this->APPLICANT_USER_ID));
        $APPLICANT_ID = $applicant->APPLICANT_ID;
        $data['APPLICANT_ID'] = $APPLICANT_ID;

        if ($applicant->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS != 1) {
            $data['academic'] = $this->applicant_model->getApplicantAcademicInfo($APPLICANT_ID);

            $this->form_validation->set_rules('EXAM_NAME[]', 'Exam name', 'required');

            if ($this->form_validation->run() == FALSE) {

                $data['exam_name'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 13));
                $data['board_name'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 24));
                $data['group_name'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 25));

                $this->load->view('applicant/update_applicant_academic_info', $data);
            } else {

                //academic information insertion
                $APP_AI_ID = $this->input->post("APP_AI_ID");
                $EXAM_NAME = $this->input->post("EXAM_NAME");
                $PASSING_YEAR = $this->input->post("PASSING_YEAR");
                $BOARD = $this->input->post("BOARD");
                $GROUP = $this->input->post("GROUP");
                $GPA = $this->input->post("GPA");
                $INSTITUTE = $this->input->post("INSTITUTE");
                $GPAWA = $this->input->post("GPAWA");

                foreach ($EXAM_NAME as $key => $value) {
                    $applicant_academic_info = array(
                        'APPLICANT_ID' => $APPLICANT_ID,
                        'EXAM_DEGREE_ID' => $EXAM_NAME[$key],
                        'PASSING_YEAR' => $PASSING_YEAR[$key],
                        'BOARD' => $BOARD[$key],
                        'MAJOR_GROUP_ID' => $GROUP[$key],
                        'RESULT_GRADE' => $GPA[$key],
                        'RESULT_GRADE_WA' => $GPAWA[$key],
                        'INSTITUTION' => $INSTITUTE[$key]
                    );
                    $APP_ID = $APP_AI_ID[$key];
                    $this->utilities->updateData('applicant_acadimicinfo', $applicant_academic_info, array('APP_AI_ID' => $APP_ID));
                }

                $this->session->set_flashdata('Success', 'Successfully Updated');
            }
        } else {

            redirect('applicant/applicantDetails');
        }

    }

    function applicantOtherDetailsInfo()
    {
        $applicant = $this->utilities->findByAttribute('applicant_personal_info', array('APPLICANT_USER_ID' => $this->APPLICANT_USER_ID));
        $APPLICANT_ID = $applicant->APPLICANT_ID;
        $data['applicant_info'] = $applicant;

        $data['applicant_id'] = $APPLICANT_ID;
        $data["applicant_info"] = $this->applicant_model->getAppicantInfoAll($APPLICANT_ID);

        $this->load->view('applicant/applicant_others_info', $data);
    }

    function updateApplicantOtherDetailsInfo()
    {
        $applicant = $this->utilities->findByAttribute('applicant_personal_info', array('APPLICANT_USER_ID' => $this->APPLICANT_USER_ID));
        $APPLICANT_ID = $applicant->APPLICANT_ID;

        if ($applicant->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS != 1) {
            $data['applicant_id'] = $APPLICANT_ID;
            $data["applicant_info"] = $this->applicant_model->getAppicantInfoAll($APPLICANT_ID);

            $this->form_validation->set_rules('ANNUAL_INCOME', 'Annual Income', 'required');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view('applicant/update_applicant_others_info', $data);
            } else {
                $applicant_other_info = array(

                    'ANNUAL_INCOME' => $this->input->post('ANNUAL_INCOME'),
                    'SCHOLARSHIP' => $this->input->post('SCHOLARSHIP'),
                    'SCHOLARSHIP_DESC' => $this->input->post('SCHOLARSHIP_DESC'),
                    'EXPELLED' => $this->input->post('EXPELLED'),
                    'EXPELLED_DESC' => $this->input->post('EXPELLED_DESC'),
                    'ARRESTED' => $this->input->post('ARRESTED'),
                    'ARRESTED_DESC' => $this->input->post('ARRESTED_DESC'),
                    'CONVICTED' => $this->input->post('CONVICTED'),
                    'CONVICTED_DESC' => $this->input->post('CONVICTED_DESC'),
                    'APPLY_BEFORE' => $this->input->post('APPLY_BEFORE'),
                    'APPLY_SEMESTER' => $this->input->post('APPLY_SEMESTER'),
                    'APPLY_YEAR' => $this->input->post('APPLY_YEAR'),
                    'SIBLING_EXIST' => $this->input->post('SIBLING_EXIST'),
                    'SBLN_ROLL_NO' => $this->input->post('SBLN_ROLL_NO'),
                );

                $this->utilities->updateData('applicant_personal_info', $applicant_other_info, array('APPLICANT_ID' => $APPLICANT_ID));
                $this->session->set_flashdata('Success', 'Successfully Updated');
                redirect('applicant/applicantDetails');
            }

        } else {

            redirect('applicant/applicantDetails');
        }

    }


    function admitCardNotification($status)
    {
        // $data['applicant'] = $this->db->query("")->row();

        $data['status'] = $status;

        $data['content_view_page'] = 'applicant/applicant_admitCard_notification';
        $this->applicant_portal->display($data);
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return
     */
    public function online_registration_preview()
    {
        $data['contentTitle'] = 'Dashboard';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Dashboard" => '#'
        );
        $data['pageTitle'] = 'Online University Management System';

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
        $data['session'] = $this->utilities->getAll('session_view');
        $data['faculty'] = $this->utilities->findAllByAttribute('faculty', array('ACTIVE_STATUS' => 1));
        $data['department'] = $this->utilities->findAllByAttribute('department', array('ACTIVE_STATUS' => 1));
        $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
        $data['content_view_page'] = 'applicant/registration';
        $this->applicant_portal->display($data);

    }



    function admitCardStatus()
    {
        //print_r($this->session->userdata('applicant_logged_in'));
        $user_data = $this->session->userdata('applicant_logged_in');
        $applicant = $user_data['APPLICANT_USER_ID'];
        $ADM_PRG_ID = $user_data['ADM_PRG_ID'];

        //echo "<pre>"; print_r($data['applicant']); exit; echo "</pre>";

        $data['contentTitle'] = 'Admission';
        $data["breadcrumbs"] = array(
            "Applicant" => "#",
            "Applicant Status" => '#'
        );

        $data['pageTitle'] = 'Online University Management System';
        //$data["previlages"] = $this->checkPrevilege();
        $data["ac_type"] = '';
        $data['dimention'] = "horizental";
        $data['applicant'] = $this->applicant_model->getApplicantInfo();
        $data['applicantAdmit'] = $this->applicant_model->getApplicantData($applicant);
        $data['exam_details'] = $this->utilities->findByAttribute('adm_program', array('ADM_PRG_ID' => $ADM_PRG_ID ));

        //echo $data['applicantAdmit']->ELIGIBLE_BY_DEPT_HEAD_STATUS; exit;

        $data['content_view_page'] = 'applicant/applicant_admitCard_notification';
        $this->applicant_portal->display($data);

    }


    /**
     * @access
     * @param  none
     * @author Abhijit M. Abhi <abhijit@atilimited.net>
     * @return
     */

    function admitCard()
    {
        //print_r($this->session->userdata('applicant_logged_in'));
        $user_data = $this->session->userdata('applicant_logged_in');
        $applicant = $user_data['APPLICANT_USER_ID'];
        $ADM_PRG_ID = $user_data['ADM_PRG_ID'];

        //echo "<pre>"; print_r($data['applicant']); exit; echo "</pre>";

        $data['contentTitle'] = 'Admission';
        $data["breadcrumbs"] = array(
            "Applicant" => "#",
            "Admit Card" => '#'
        );

        $data['pageTitle'] = 'Online University Management System';
        //$data["previlages"] = $this->checkPrevilege();
        $data["ac_type"] = '';
        $data['dimention'] = "horizental";
        $data['applicant'] = $this->applicant_model->getApplicantInfo();
        $data['applicantAdmit'] = $this->applicant_model->getApplicantData($applicant);
        $data['exam_details'] = $this->utilities->findByAttribute('adm_program', array('ADM_PRG_ID' => $ADM_PRG_ID ));

        //echo "<pre>"; print_r($data['exam_details']); exit;

        if($data['applicantAdmit']->APPROVE_FOR_ADMIT == 1) {

            //echo "<pre>"; print_r($data['applicantAdmit']->APPROVE_FOR_ADMIT); exit; echo "</pre>";

            $data['content_view_page'] = 'applicant/admit_card';
            $this->applicant_portal->display($data);
        }

    }


    /**
     * @access
     * @param  applicant_id
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return
     */
    function applicant_admid_card($applicant)
    {
        $data['applicant'] = $this->db->query("SELECT aai.*, d.DEPT_NAME, f.FACULTY_NAME, p.PROGRAM_NAME, sv.SESSION_NAME
        FROM adm_applicant_info aai
        INNER JOIN session_view sv on sv.SESSION_ID = aai.SESSION_ID
        INNER JOIN faculty f on f.FACULTY_ID = aai.FACULTY_ID
        INNER JOIN department d on d.DEPT_ID = aai.DEPT_ID
        INNER JOIN program p on p.PROGRAM_ID = aai.PROGRAM_ID
        WHERE aai.APPLICANT_ID = $applicant")->row();
        $data['content_view_page'] = 'admin/applicant/applicant_admid_card';
        $this->applicant_portal->display($data);
    }

    /**
     * @access
     * @param  applicant_id
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return
     */
    function applicant_admit_card_print()
    {
        $user_data = $this->session->userdata('applicant_logged_in');
        $applicant = $user_data['APPLICANT_USER_ID'];
        $ADM_PRG_ID = $user_data['ADM_PRG_ID'];

        $data['exam_details'] = $this->utilities->findByAttribute('adm_program', array('ADM_PRG_ID' => $ADM_PRG_ID ));

        $data['applicant'] = $this->applicant_model->getApplicantInfo();       


        require_once('mpdf/mpdf.php');

        $mpdf = new mPDF();
        $mpdf->SetTitle('Admid Card');
        $mpdf->mirrorMargins = 1;
        $mpdf->useOnlyCoreFonts = true;
        $report = $this->load->view('admin/applicant/applicant_admid_card_pdf', $data, TRUE);
        //$footer = $this->load->view('admin/course/semester_course_info_footer', $data, TRUE);
        $mpdf->WriteHTML("$report");
        $mpdf->SetHTMLFooter("$footer");
        $mpdf->Output();
        exit;
    }


    /**
     * @methodName stuLogout()
     * @access
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      this function use for student log out
     */
    function logout()
    {
        $this->session->unset_userdata('applicant_logged_in');
        $this->session->unset_userdata('applicant_summary');
        $this->session->unset_userdata('app_academic_sess_array');
        redirect('Portal/login', 'refresh');
    }

}

/* End of file Applicant.php */
/* Location: ./application/controllers/Applicant.php */