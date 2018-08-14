<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @category   FrontPortal
 * @package    Portal
 * @author     Jahid Hasan <jahid@atilimited.net>
 * @copyright  2015 ATI Limited Development Group
 */

class Admission extends CI_Controller
{

    private $user;

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('auth/login', 'refresh');
        }
        $this->user = $this->session->userdata("logged_in");
        $this->load->model('utilities');
    }

    /*
     * @methodName index()
     * @access none
     * @param  none
     * @return Mixed Template
     */

    function index()
    {
        $data['pageTitle'] = 'View All Applicant';
        $data['breadcrumbs'] = array(
            'All Applicant list' => '#'
        );
        $data['applicants'] = $this->utilities->findAllByAttributeWithJoin('admission', 'admission_academic_info', 'ADMISSION_ID', 'ADMISSION_ID', '*', '', '');
        $data['content_view_page'] = 'admin/admission/index';
        $this->admin_template->display($data);
    }

    function emp()
    {
        $data['pageTitle'] = 'View All Applicant';
        $data['breadcrumbs'] = array(
            'All Applicant list' => '#'
        );
        $data['applicants'] = $this->utilities->findAllByAttributeWithJoin('admission', 'admission_academic_info', 'ADMISSION_ID', 'ADMISSION_ID', '*', '', '');
        $data['content_view_page'] = 'admin/emp/add_emp';
        $this->admin_template->display($data);
    }

    /*
     * @methodName applicantReg()
     * @access none
     * @param  none
     * @return Mixed Template
     */

    function applicantReg()
    {
        $check = $this->input->post('chkCourses');
        for ($i = 0; $i < sizeof($check); $i++) {
            $data["admission"] = $this->utilities->findAllByAttribute("admission", array("ADMISSION_ID" => "$check[$i]"));
            var_dump($data["admission"]);
        }
    }

    /**
     * @methodName  regApplicant()
     * @access
     * @param
     * @author      Nurulla <rakib@atilimited.net>
     * @return      All existing student list
     */
    function regApplicant()
    {
        $data['pageTitle'] = 'View All Applicant';
        $data['breadcrumbs'] = array(
            'All Applicant list' => '#'
        );
        $data['applicants'] = $this->utilities->findAllByAttributeWithJoin('regi_student', 'regi_std_academic_info', 'REGI_NO', 'REGI_NO', '*', '', '');
        $data['content_view_page'] = 'admin/admission/applicant_list';
        $this->admin_template->display($data);
    }

    /**
     * @methodName  applicant_details()
     * @access
     * @param
     * @author      Nurulla <rakib@atilimited.net>
     * @return      Existing student details
     */
    function applicant_details()
    {
        $applecent_id = $_POST['param'];
        $data['applecent_details'] = $this->db->query("SELECT s.*, sa.* FROM regi_student s INNER JOIN regi_std_academic_info sa ON s.REGI_NO = sa.REGI_NO WHERE s.REGI_ID = $applecent_id")->row();
        $data['academic_details'] = $this->db->query("SELECT sa.ACADEMIC_INFO_ID, sa.REGI_NO,
            (SELECT l.LKP_NAME FROM m00_lkpdata l WHERE sa.EXAM_NAME = l.LKP_ID ) EXAM_NAME,
            (SELECT l.LKP_NAME FROM m00_lkpdata l WHERE sa.BOARD = l.LKP_ID ) BOARD,
            (SELECT l.LKP_NAME FROM m00_lkpdata l WHERE sa.'GROUP' = l.LKP_ID )GROUP_NAME,
            sa.PASSING_YEAR, sa.GPA, sa.INSTITUTE FROM regi_std_academic_info sa WHERE sa.ACADEMIC_INFO_ID = $applecent_id")->result();
        $this->load->view('admin/admission/applicant_details', $data);
    }

    /*
     * @methodName  registration
     * @access
     * @param
     * @author  Rakib Roni <rakib@atilimited.net>
     * @return Insert existing student
     */

    function registration()
    {
        ini_set('max_execution_time', 0);
        ini_set("memory_limit", -1);
//        $COUNTER = $this->input->post('COUNTER');
//        echo "<pre>";
//        print_r($COUNTER);
//        echo "</pre>"; exit;
        $data['contentTitle'] = 'Add Existing Student';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Add  Existing Student" => '#'
        );
        $data['pageTitle'] = 'Add Existing Student';
        $this->form_validation->set_rules('ROLL_NO', 'roll no', 'required');


        if ($this->form_validation->run() == FALSE) {
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
            $data['content_view_page'] = 'admin/admission/registration';
        } else {

            $pk = $this->utilities->pk_f('students_info');
            if (!empty($_FILES)) {
                $file_name = "";
                $this->load->library('upload');
                $this->load->helper('string');
                $config['upload_path'] = 'upload/existing_studnet_photo/';
                //$config['allowed_types'] = '*';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['overwrite'] = false;
                $config['remove_spaces'] = true;
                //$config['max_size']	= '100';// in KB
                $this->upload->initialize($config);
                if ($this->upload->do_upload('photo')) {
                    $file_data = $this->upload->data();
                    $file_name = $file_data['file_name'];

                }
                $student_info = array(
                    'STUD_PHOTO' => $file_name,
                    'STUDENT_ID' => $pk,
                    'FULL_NAME_EN' => $this->input->post('FULL_NAME_EN'),
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
                    'PASSPORT_NO' => $this->input->post('PASSPORT_NO'),
                    'ROLL_NO' => $this->input->post('ROLL_NO'),
                    'SIBLING_EXIST' => $this->input->post('SIBLING_EXIST'),
                    'BATCH_ID' => $this->input->post('BATCH_ID'),
                    'HOBBY' => $this->input->post('HOBBY')
                );

                $this->utilities->insertData($student_info, 'students_info');

                // insert stundent extra curriculm activity
                $ACTIVITY_TYPE_ID = $this->input->post('ACTIVITY_TYPE_ID');
                $DESCRIPTION = $this->input->post('DESCRIPTION');
                if (!empty($ACTIVITY_TYPE_ID)) {
                    for ($i = 0; $i < sizeof($ACTIVITY_TYPE_ID); $i++) {
                        $insert_extra_activity = array(
                            'STU_EXTRA_ACTIVITIES_ID' => $this->utilities->pk_f('stu_extra_activities'),
                            'STUDENT_ID' => $pk,
                            'ACTIVITY_TYPE_ID' => $ACTIVITY_TYPE_ID[$i],
                            'DESCRIPTION' => $DESCRIPTION [$i],
                            'ACTIVE_STATUS' => 1
                        );
                        $this->utilities->insertData($insert_extra_activity, 'stu_extra_activities');
                    }
                }
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
                if (!empty($EMAIL_ADRESS)) {
                    for ($i = 0; $i < sizeof($EMAIL_ADRESS); $i++) {
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
                $father_file_name = "";
                $configf['upload_path'] = 'upload/existing_studnet_photo/parent/';
                $configf['allowed_types'] = 'gif|jpg|jpeg|png';
                $configf['overwrite'] = false;
                $configf['remove_spaces'] = true;
                $this->upload->initialize($configf);
                if ($this->upload->do_upload('father_photo')) {
                    $file_data = $this->upload->data();
                    $father_file_name = $file_data['file_name'];
                }
                $father_pk = $this->utilities->pk_f('stu_parentinfo');
                $fahter_info = array(
                    'STU_PARENT_ID' => $father_pk,
                    'STUDENT_ID' => $pk,
                    'PARENTS_TYPE' => 'F',
                    'OCCUPATION' => $this->input->post('FATHER_OCU'),
                    'PARENT_PHOTO' => $father_file_name,
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
                $mother_file_name = "";
                $configm['upload_path'] = 'upload/existing_studnet_photo/parent/';
                $configm['allowed_types'] = 'gif|jpg|jpeg|png';
                $configm['overwrite'] = false;
                $configm['remove_spaces'] = true;
                $this->upload->initialize($configf);
                if ($this->upload->do_upload('mother_photo')) {
                    $file_data = $this->upload->data();
                    $mother_file_name = $file_data['file_name'];
                }
                $mother_pk = $this->utilities->pk_f('stu_parentinfo');
                $mother_info = array(
                    'STU_PARENT_ID' => $mother_pk,
                    'STUDENT_ID' => $pk,
                    'PARENTS_TYPE' => 'M',
                    'OCCUPATION' => $this->input->post('MOTHER_OCU'),
                    'PARENT_PHOTO' => $mother_file_name,
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
                // present and permanent address insertion
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

                    $lg_pk = $this->utilities->pk_f('stu_parentinfo');
                    $local_emergency_guardian = array(

                        'STU_PARENT_ID' => $lg_pk,
                        'STUDENT_ID' => $pk,
                        'PARENTS_TYPE' => 'L',
                        'GURDIAN_NAME' => $this->input->post('LOCAL_GAR_NAME'),
                        'RELATION_ID' => $this->input->post('LOCAL_GAR_RELATION'),
                        'GURDIAN_ADDRESS' => $this->input->post('LOCAL_GAR_ADDRESS'),
                        'ECP_FG' => 0,
                        'ORG_ID' => 1,
                        'ACTIVE_FLAG' => 1
                    );

                    $this->utilities->insertData($local_emergency_guardian, 'stu_parentinfo');
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
                    $update_f_info = array(
                        'ECP_FG' => 0,
                    );
                    $this->utilities->updateData('stu_parentinfo', $update_f_info, array('STU_PARENT_ID' => $father_pk));

                    $update_m_info = array(
                        'ECP_FG' => 0,
                    );
                    $this->utilities->updateData('stu_parentinfo', $update_m_info, array('STU_PARENT_ID' => $mother_pk));
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
                //$config['max_size']	= '100';// in KB
                $this->upload->initialize($configc);

                for ($i = 0; $i < sizeof($COUNTER); $i++) {
                    if ($this->upload->do_upload('CERTIFICATE_' . $COUNTER[$i])) {
                        $file_data = $this->upload->data();
                        $file_name = $file_data['file_name'];
                        $ac_pk = $this->utilities->pk_f('stu_acadimicinfo');
                        $academic_info = array(
                            'STU_AI_ID' => $ac_pk,
                            'STUDENT_ID' => $pk,
                            'EXAM_DEGREE_ID' => $this->input->post('EXAM_NAME_' . $COUNTER[$i]),
                            'MAJOR_GROUP_ID' => $this->input->post('GROUP_' . $COUNTER[$i]),
                            'INSTITUTION' => $this->input->post('INSTITUTE_' . $COUNTER[$i]),
                            'BOARD' => $this->input->post('BOARD_' . $COUNTER[$i]),
                            'RESULT_GRADE' => $this->input->post('GPA_' . $COUNTER[$i]),
                            'PASSING_YEAR' => $this->input->post('PASSING_YEAR_' . $COUNTER[$i]),
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
                            'STOP_DT' => ($STOP_DT[$i] != '') ? date('Y-m-d', strtotime($STOP_DT[$i])) : '',
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
                    'ADMISSION_DATE' => date('Y-m-d', strtotime($this->input->post('ADMISSION_DATE'))),
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
                            'FACULTY_ID' => $this->input->post('FACULTY_C'),
                            'DEPT_ID' => $this->input->post('DEPT_ID_C'),
                            'PROGRAM_ID' => $this->input->post('PROGRAM_ID_C'),
                            'SESSION_ID' => $this->input->post('SESSION'),
                            'SEM_SESSION' => $this->input->post('SESSION_ID_C'),
                            'SEMISTER_ID' => $this->input->post('SEMISTER_ID_C'),
                            'COURSE_ID' => $COURSE_ID[$i],
                            'IS_CURRENT' => 1,
                            'ACTIVE_STATUS' => 1
                        );
                        $this->utilities->insertData($student_current_courses, 'stu_courseinfo');
                    }
                }
                //end existing student course information isertion
                //for payment and semester update made by jahid sr. programmer
                // get semester particulars
                $session = $this->input->post('SESSION_ID_C');
                $semester = $this->input->post('SEMISTER_ID_C');
                $cmbFaculty = $this->input->post('FACULTY_C');
                $department = $this->input->post('DEPT_ID_C');
                $program = $this->input->post('PROGRAM_ID_C');
                $batch =   $this->input->post('BATCH_ID');

                $get_semester_particulars_array = array(
                    'SESSION_ID' => $session,
                    'SEMESTER_ID' => $semester,
                    'FACULTY_ID' => $cmbFaculty,
                    'DEPT_ID' => $department,
                    'PROGRAM_ID' => $program,

                );
               // print_r($get_semester_particulars_array);exit;
                $get_semester_particulars = $this->utilities->findAllByAttribute("ac_program_particulars", $get_semester_particulars_array);
               // print_r($get_semester_particulars);exit;
                $success = 0;
                // looping all student requested course for registration
                // get student informations
                $student_info = $this->utilities->findByAttribute("students_info", array("STUDENT_ID" => $pk));

                $voucher_no = $this->utilities->pk_f('bm_vouchermst'); // get Primary Key
                $this->db->trans_start();
                // insert data into Voucher Master Table
                $v_master_data_array = array(
                    "VOUCHER_NO" => $voucher_no,
                    "VOUCHER_DT" => date("Y/m/d"),
                    "STUDENT_ID" => $pk,
                    "ROLL_NO" => $student_info->ROLL_NO,
                    "FACULTY_ID" => $cmbFaculty,
                    "DEPT_ID" => $department,
                    "PROGRAM_ID" => $program,
                    "SESSION_ID" => $session,
                    "SEMESTER_ID" => $semester,
                    "ORG_ID" => 1,
                    "REMARKS" => '',
                    "CREATED_BY" => $this->user["USER_ID"]
                );
              //  print_r($v_master_data_array);exit;
                $this->db->insert("bm_vouchermst", $v_master_data_array);
                // insert program particular information for each student
                foreach ($get_semester_particulars as $particular) {
                    // insert data into Voucher Child Table
                    $trans_no = $this->utilities->pk_f('bm_voucherchd'); // get Primary Key
                    $v_chd_data_array = array(
                        "TRX_TRAN_NO" => $trans_no,
                        "TRX_TRAN_DT" => date("Y/m/d"),
                        "VOUCHER_NO" => $voucher_no,
                        "SESSION_ID" => $session,
                        "SEMISTER_ID" => $semester,
                        "PRTCULR_NO" => $particular->PARTICULAR_ID,
                        "BILL_AMT" => $particular->PARTICULAR_AMOUNT,
                        "PUNIT_PRICE" => $particular->PARTICULAR_AMOUNT,
                        "ORG_ID" => 1,
                        "REMARKS" => '',
                        "CREATED_BY" => $this->user["USER_ID"]
                    );

                    $this->db->insert("bm_voucherchd", $v_chd_data_array);
                    // insert data into LEDGER Table
                    $ledger_pk = $this->utilities->pk_f('bm_vn_ledgers'); // get Primary Key
                    $ledger_data_array = array(
                        "VLEDGER_NO" => $ledger_pk,
                        "VLEDGER_DT" => date("Y/m/d"),
                        "TRX_CODE_NO" => "GR",
                        "TRX_TRAN_NO" => $trans_no,
                        "VOUCHER_NO" => $voucher_no,
                        "CR_AMT" => $particular->PARTICULAR_AMOUNT,
                        "PITEM_TQTY" => 1
                    );
                    $this->db->insert("bm_vn_ledgers", $ledger_data_array);
                }
                // inserting into student semester details table
                $semester_info_pk = $this->utilities->pk_f('stu_semesterinfo');
                $semester_data_array = array(
                    "S_SEMESTER_ID" => $semester_info_pk,
                    "STUDENT_ID" => $pk,
                    "FACULTY_ID" => $cmbFaculty,
                    "DEPT_ID" => $department,
                    "PROGRAM_ID" => $program,
                    "SESSION_ID" =>  $this->input->post('SESSION'),
                    "SEM_SESSION" => $session,
                    "SEMESTER_ID" => $semester,
                    "IS_CURRENT" => 1,
                    "CREATED_BY" => $this->user["USER_ID"]
                );
                $this->db->insert("stu_semesterinfo", $semester_data_array);
                $update_semester_info = array(
                    'IS_CURRENT' => 0
                );
                $this->utilities->updateData('stu_semesterinfo', $update_semester_info, array('STUDENT_ID' => $pk, 'S_SEMESTER_ID !=' => $semester_info_pk));
                $this->db->trans_complete();
                //

                //start sibling insertion
                if ($this->input->post('SIBLING_EXIST') == 1) {
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
            }
            $this->session->set_flashdata('Success', 'Student Information Uploaded Successfully.');
            redirect('admission/registration', 'refresh');
        }
        $this->admin_template->display($data);
    }

    /**
     * @methodName  editExistingStu()
     * @access      public
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      edit existing registration student
     */
    function editExistingStu($studnet_id)
    {

        $data['contentTitle'] = 'Update Existing Student';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Update Existing Studnet" => '#'
        );
        $data['pageTitle'] = 'Update Existing Student';
        //start dropdown value
        $data['extra_activity_type'] = $this->utilities->getAll('extra_activity_type');
        $data['division'] = $this->utilities->getAll('sa_divisions');
        $data['district'] = $this->utilities->getAll('sa_districts');
        $data['thana'] = $this->utilities->getAll('sa_thanas');
        $data['police_station'] = $this->utilities->getAll('sa_police_station');
        $data['union'] = $this->utilities->getAll('sa_unions');
        $data['post_office'] = $this->utilities->getAll('sa_post_offices');
        $data['nationality'] = $this->utilities->getAll('country');
        $data['program'] = $this->utilities->getAll('program');
        $data['religion'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 3));
        $data['merital_status'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 8));
        $data['blood_group'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 4));
        $data['substance'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 56));
        $data['exam_name'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 13));
        $data['board_name'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 24));
        $data['group_name'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 25));
        $data['occupation'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 21));
        $data['relation'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 40));
        $data['session'] = $this->utilities->semesterSession();
        $data['faculty'] = $this->utilities->findAllByAttribute('faculty', array('ACTIVE_STATUS' => 1));
        $data['department'] = $this->utilities->findAllByAttribute('department', array('ACTIVE_STATUS' => 1));
        $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
        //end drop down value
        // start student existing data

        $data['applicant'] = $this->db->query("SELECT a.*,
            (SELECT b.BLOODGROUP_NAME FROM sav_bloodgrp b WHERE b.BLOODGROUP_ID = a.BLOOD_GROUP)blood,
            (SELECT m.MARITAL_NAME FROM sav_maritals m WHERE m.MARITAL_ID = a.MARITAL_STATUS)marital,
            (SELECT n.NICENAME FROM sa_country n WHERE n.ID = a.MARITAL_STATUS)nationality,
            (SELECT group_concat(c.CONTACTS) FROM stu_contractinfo c WHERE c.STUDENT_ID = a.STUDENT_ID)contact,
            (SELECT r.RELIGION_NAME FROM sav_religion r WHERE r.RELIGION_ID = a.RELIGION_ID)relegion FROM students_info a WHERE a.STUDENT_ID = '$studnet_id'")->row();

        $data['admission'] = $this->db->query("SELECT a.* FROM stu_admissioninfo a WHERE a.STUDENT_ID ='$studnet_id'")->row();
        $data["contact"] = $this->utilities->findAllByAttribute('stu_contractinfo', array("STUDENT_ID" => $studnet_id, "CONTACT_TYPE" => 'M'));
        $data["email"] = $this->utilities->findAllByAttribute('stu_contractinfo', array("STUDENT_ID" => $studnet_id, "CONTACT_TYPE" => 'E'));
        $data["academic_info"] = $this->db->query("SELECT a.CREATE_DATE,
            (SELECT s.SESSION_NAME FROM session s WHERE s.SESSION_ID = a.SESSION_ID)session,
            (SELECT f.FACULTY_NAME FROM faculty f WHERE f.FACULTY_ID = a.FACULTY_ID)faculty,
            (SELECT d.DEPT_NAME FROM department d WHERE d.DEPT_ID = a.DEPT_ID)department,
            (SELECT p.PROGRAM_NAME FROM program p WHERE p.PROGRAM_ID = a.PROGRAM_ID)program,
            (SELECT sem.SEMESTER_NAME FROM sav_semester sem WHERE sem.SEMESTER_ID = a.SEMISTER_ID)semester FROM stu_admissioninfo a WHERE a.STUDENT_ID = '$studnet_id'")->row();

        $data["fathersInfo"] = $this->db->query("SELECT f.* FROM stu_parentinfo f WHERE f.STUDENT_ID = '$studnet_id' and f.PARENTS_TYPE='F'")->row();
        $data["motherInfo"] = $this->db->query("SELECT f.* FROM stu_parentinfo f WHERE f.STUDENT_ID = '$studnet_id' and f.PARENTS_TYPE='M'")->row();
        $data["father_contact"] = $this->utilities->findAllByAttribute('stu_pgscontract', array("STUDENT_ID" => $studnet_id, "PGSC_TYPE" => 'F', "CONTACT_TYPE" => 'M'));
        $data["father_email"] = $this->utilities->findAllByAttribute('stu_pgscontract', array("STUDENT_ID" => $studnet_id, "PGSC_TYPE" => 'F', "CONTACT_TYPE" => 'E'));

        $data["mother_contact"] = $this->utilities->findAllByAttribute('stu_pgscontract', array("STUDENT_ID" => $studnet_id, "PGSC_TYPE" => 'M', "CONTACT_TYPE" => 'M'));
        $data["mother_email"] = $this->utilities->findAllByAttribute('stu_pgscontract', array("STUDENT_ID" => $studnet_id, "PGSC_TYPE" => 'M', "CONTACT_TYPE" => 'E'));

        $data["addrInfo"] = $this->db->query("SELECT a.STU_ADRESS_ID,a.STUDENT_ID, a.ADRESS_TYPE, a.SAS_PSORPR, a.HOUSE_NO_NAME, a.ROAD_AVENO_NAME, a.VILLAGE_WARD, a.DISTRICT_ID, a.DIVISION_ID, a.POLICE_STATION_ID, a.POST_OFFICE_ID, a.THANA_ID, a.UNION_ID,
            (SELECT b.DIVISION_ENAME FROM sa_divisions b WHERE b.DIVISION_ID = a.DIVISION_ID)DIVIS_NAME,
            (SELECT d.DISTRICT_ENAME FROM sa_districts d WHERE d.DISTRICT_ID = a.DISTRICT_ID)DIST_NAME,
            (SELECT p.PS_ENAME FROM sa_police_station p WHERE p.POLICE_STATION_ID = a.POLICE_STATION_ID)PLOSC,
            (SELECT po.POST_OFFICE_ENAME FROM sa_post_offices po WHERE po.POST_OFFICE_ID = a.POST_OFFICE_ID)POSTO,
            (SELECT t.THANA_ENAME FROM sa_thanas t WHERE t.THANA_ID = a.THANA_ID)thn,
            (SELECT u.UNION_NAME FROM sa_unions u WHERE u.UNION_ID = a.UNION_ID)uni FROM stu_adressinfo a WHERE a.STUDENT_ID = '$studnet_id' AND a.ADRESS_TYPE = 'PS'")->row();

        $data["parAddrInfo"] = $this->db->query("SELECT a.STU_ADRESS_ID,a.STUDENT_ID, a.ADRESS_TYPE, a.SAS_PSORPR, a.HOUSE_NO_NAME, a.ROAD_AVENO_NAME, a.VILLAGE_WARD, a.DISTRICT_ID, a.DIVISION_ID, a.POLICE_STATION_ID, a.POST_OFFICE_ID, a.THANA_ID, a.UNION_ID,
            (SELECT b.DIVISION_ENAME FROM sa_divisions b WHERE b.DIVISION_ID = a.DIVISION_ID)DIVIS_NAME,
            (SELECT d.DISTRICT_ENAME FROM sa_districts d WHERE d.DISTRICT_ID = a.DISTRICT_ID)DIST_NAME,
            (SELECT p.PS_ENAME FROM sa_police_station p WHERE p.POLICE_STATION_ID = a.POLICE_STATION_ID)PLOSC,
            (SELECT po.POST_OFFICE_ENAME FROM sa_post_offices po WHERE po.POST_OFFICE_ID = a.POST_OFFICE_ID)POSTO,
            (SELECT t.THANA_ENAME FROM sa_thanas t WHERE t.THANA_ID = a.THANA_ID)thn,
            (SELECT u.UNION_NAME FROM sa_unions u WHERE u.UNION_ID = a.UNION_ID)uni FROM stu_adressinfo a WHERE a.STUDENT_ID = '$studnet_id' AND a.ADRESS_TYPE != 'PS'")->row();

        $data['guardianInfo'] = $this->db->query("SELECT g.* FROM stu_guardians g WHERE g.STUDENT_ID = '$studnet_id' ")->row();

        $data['guardian_contact'] = $this->utilities->findAllByAttribute('stu_pgscontract', array("STUDENT_ID" => $studnet_id, "PGSC_TYPE" => 'E'));

        $data['spouse'] = $this->db->query("SELECT s.SFULL_NAME,s.MARRIAGE_DT,s.EMAIL_ADRESS,
            (SELECT r.RELATION_NAME FROM sav_relation r WHERE r.RELATION_ID = s.RELATION_ID)relation FROM stu_spouseinfo s WHERE s.STUDENT_ID = '$studnet_id'")->row();

        $data['academic'] = $this->db->query("SELECT a.* FROM stu_acadimicinfo a WHERE a.STUDENT_ID ='$studnet_id' ")->result();

        $data['medical'] = $this->db->query("SELECT m.STU_MEDI_ID, m.SUBSTANCE,m.CURRENTLY_USED, m.PREVIOUSLY_USED, m.TYPE_AMOUNT_FREQUENCY, m.DURATION, m.STOP_DT,
            (SELECT s.SUBSTANCES_NAME FROM sav_substances s WHERE s.SUBSTANCES_ID = m.SUBSTANCE)substances FROM stu_medicalinfo m WHERE m.STUDENT_ID = '$studnet_id'")->result();

        $data['disease'] = $this->db->query("SELECT d.STU_DISEASE_ID,d.DISEASE_NAME, d.START_DT, d.END_DT, d.DOCTOR_NAME FROM stu_diseaseinfo d WHERE d.STUDENT_ID = '$studnet_id'")->result();

        $data['waiver'] = $this->db->query("SELECT w.* FROM stu_weaverinfo w WHERE w.STUDENT_ID = '$studnet_id'")->row();
        $data['sibling'] = $this->db->query("SELECT s.* FROM stu_siblings s WHERE s.STUDENT_ID = '$studnet_id'")->row();
        $data['extra_activity'] = $this->db->query("select a.*,b.ACTIVITY_NAME from stu_extra_activities a
                                                    left join extra_activity_type b  on a.ACTIVITY_TYPE_ID = b.ACTIVITY_TYPE_ID
                                                    where a.STUDENT_ID='$studnet_id'")->result();
        // end student existing data
        $data['content_view_page'] = 'admin/admission/edit_existing_stu';
        $this->admin_template->display($data);
    }

    /**
     * @methodName  updateExistingStu()
     * @access      public
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      udpate existing student information.
     */
    function updateExistingStu($stu_id)
    {
        $file_name = "";
        if (!empty($_FILES)) {
            $this->load->library('upload');
            $this->load->helper('string');
            $config['upload_path'] = 'upload/existing_studnet_photo/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['overwrite'] = false;
            $config['remove_spaces'] = true;
            $this->upload->initialize($config);
            if ($this->upload->do_upload('photo')) {
                $file_data = $this->upload->data();
                $file_name = $file_data['file_name'];
            }
        }
        $update_student_info = array(
            'FULL_NAME_EN' => $this->input->post('FULL_NAME_EN'),
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
            'PASSPORT_NO' => $this->input->post('PASSPORT_NO'),
            'ROLL_NO' => $this->input->post('ROLL_NO'),
            'SIBLING_EXIST' => $this->input->post('SIBLING_EXIST'),
            'HOBBY' => $this->input->post('HOBBY')
        );

        if ($file_name != "") {
            $update_student_info["STUD_PHOTO"] = $file_name;
        }
        $this->utilities->updateData('students_info', $update_student_info, array('STUDENT_ID' => $stu_id));

        // insert stundent extra curriculm activity
        $ACTIVITY_TYPE_ID = $this->input->post('ACTIVITY_TYPE_ID');
        $DESCRIPTION = $this->input->post('DESCRIPTION');
        if (!empty($ACTIVITY_TYPE_ID)) {
            for ($i = 0; $i < sizeof($ACTIVITY_TYPE_ID); $i++) {
                if ($ACTIVITY_TYPE_ID [$i] != '') {
                    $insert_extra_activity = array(
                        'STU_EXTRA_ACTIVITIES_ID' => $this->utilities->pk_f('stu_extra_activities'),
                        'STUDENT_ID' => $stu_id,
                        'ACTIVITY_TYPE_ID' => $ACTIVITY_TYPE_ID[$i],
                        'DESCRIPTION' => $DESCRIPTION [$i],
                        'ACTIVE_STATUS' => 1
                    );
                    //print_r($insert_extra_activity);exit;
                    $this->utilities->insertData($insert_extra_activity, 'stu_extra_activities');
                }
            }
        }
        // update studnet multiple eamil address
        $EMAIL_ADRESS = $this->input->post('EMAIL_ADRESS');
        $STU_CI_ID = $this->input->post('STU_CI_ID');

        if (!empty($EMAIL_ADRESS)) {
            for ($i = 0; $i < sizeof($EMAIL_ADRESS); $i++) {

                if ($EMAIL_ADRESS[$i] != "") {
                    $email_data = array(
                        'CONTACTS' => $EMAIL_ADRESS [$i]
                    );

                    if ($STU_CI_ID[$i] == "") {
                        $email_data["STU_CI_ID"] = $this->utilities->pk_f('stu_contractinfo');
                        $email_data["STUDENT_ID"] = $stu_id;
                        $email_data["CONTACT_TYPE"] = "E";
                        $email_data["ORG_ID"] = 1;
                        $email_data["DEFAULT_FG"] = 1;
                        $this->utilities->insertData($email_data, 'stu_contractinfo');
                    } else {
                        $this->utilities->updateData('stu_contractinfo', $email_data, array('STU_CI_ID' => $STU_CI_ID[$i]));
                    }
                }
            }
        }
        // update studnet multiple mobile number
        $MOBILE_NO = $this->input->post('MOBILE_NO');
        $STU_CI_ID_M = $this->input->post('STU_CI_ID_M');
        if (!empty($MOBILE_NO)) {
            for ($i = 0; $i < sizeof($MOBILE_NO); $i++) {
                if ($MOBILE_NO[$i] != "") {
                    $mobile_data = array(
                        'CONTACTS' => $MOBILE_NO [$i]
                    );

                    if ($STU_CI_ID_M[$i] == "") {
                        $mobile_data["STU_CI_ID"] = $this->utilities->pk_f('stu_contractinfo');
                        $mobile_data["STUDENT_ID"] = $stu_id;
                        $mobile_data["CONTACT_TYPE"] = "M";
                        $mobile_data["ORG_ID"] = 1;
                        $mobile_data["DEFAULT_FG"] = 1;
                        $this->utilities->insertData($mobile_data, 'stu_contractinfo');
                    } else {

                        $this->utilities->updateData('stu_contractinfo', $mobile_data, array('STU_CI_ID' => $STU_CI_ID_M[$i]));
                    }
                }
            }
        }
        // update father information
        $f_file_name = "";
        if (!empty($_FILES)) {
            $this->load->library('upload');
            $this->load->helper('string');
            $configf['upload_path'] = 'upload/existing_studnet_photo/parent/';
            $configf['allowed_types'] = 'gif|jpg|jpeg|png';
            $configf['overwrite'] = false;
            $configf['remove_spaces'] = true;
            $this->upload->initialize($configf);
            if ($this->upload->do_upload('father_photo')) {
                $file_data = $this->upload->data();
                $f_file_name = $file_data['file_name'];
            }
        }
        $STU_PARENT_ID_F = $this->input->post('STU_PARENT_ID_F');
        $fahter_info = array(
            'STUDENT_ID' => $stu_id,
            'PARENTS_TYPE' => 'F',
            'OCCUPATION' => $this->input->post('FATHER_OCU'),
            'ECP_FG' => 0,
            'ORG_ID' => 1,
            'ACTIVE_FLAG' => 1
        );
        if ($f_file_name != "") {
            $fahter_info["PARENT_PHOTO"] = $f_file_name;
        }
        $this->utilities->updateData('stu_parentinfo', $fahter_info, array('STU_PARENT_ID' => $STU_PARENT_ID_F));

        // update father multiple mobile
        $FATHER_PHN = $this->input->post('FATHER_PHN');
        $STU_PGS_ID_F = $this->input->post('STU_PGS_ID_F');


        if (!empty($FATHER_PHN)) {
            for ($i = 0; $i < sizeof($FATHER_PHN); $i++) {

                if ($FATHER_PHN[$i] != "") {
                    $mobile_data_f = array(
                        'CONTACTS' => $FATHER_PHN [$i]
                    );

                    if ($STU_PGS_ID_F[$i] == "") {
                        $mobile_data_f["STU_PGS_ID"] = $this->utilities->pk_f('stu_pgscontract');
                        $mobile_data_f["STUDENT_ID"] = $stu_id;
                        $mobile_data_f["PGSC_TYPE"] = 'F';
                        $mobile_data_f["PGSC_ID"] = $STU_PARENT_ID_F;
                        $mobile_data_f["CONTACT_TYPE"] = 'M';
                        $mobile_data_f["ORG_ID"] = 1;
                        $mobile_data_f["DEFAULT_FG"] = 1;
                        $mobile_data_f["ACTIVE_STATUS"] = 1;
                        $this->utilities->insertData($mobile_data_f, 'stu_pgscontract');
                    } else {

                        $this->utilities->updateData('stu_pgscontract', $mobile_data_f, array('STU_PGS_ID' => $STU_PGS_ID_F[$i]));
                    }
                }
            }
        }

        // update father multiple email
        $FATHER_EMAIL = $this->input->post('FATHER_EMAIL');
        $STU_PGS_ID_FE = $this->input->post('STU_PGS_ID_FE');


        if (!empty($FATHER_EMAIL)) {
            for ($i = 0; $i < sizeof($FATHER_EMAIL); $i++) {
                if ($FATHER_EMAIL[$i] != "") {
                    $eamil_data_f = array(
                        'CONTACTS' => $FATHER_EMAIL [$i]
                    );
                    if ($STU_PGS_ID_FE[$i] == "") {
                        $eamil_data_f["STU_PGS_ID"] = $this->utilities->pk_f('stu_pgscontract');
                        $eamil_data_f["STUDENT_ID"] = $stu_id;
                        $eamil_data_f["PGSC_TYPE"] = 'F';
                        $eamil_data_f["PGSC_ID"] = $STU_PARENT_ID_F;
                        $eamil_data_f["CONTACT_TYPE"] = 'E';
                        $eamil_data_f["ORG_ID"] = 1;
                        $eamil_data_f["DEFAULT_FG"] = 1;
                        $eamil_data_f["ACTIVE_STATUS"] = 1;
                        $this->utilities->insertData($eamil_data_f, 'stu_pgscontract');
                    } else {

                        $this->utilities->updateData('stu_pgscontract', $eamil_data_f, array('STU_PGS_ID' => $STU_PGS_ID_FE[$i]));
                    }
                }
            }
        }
        // update mother information
        $m_file_name = "";
        if (!empty($_FILES)) {
            $this->load->library('upload');
            $this->load->helper('string');
            $configm['upload_path'] = 'upload/existing_studnet_photo/parent/';
            $configm['allowed_types'] = 'gif|jpg|jpeg|png';
            $configm['overwrite'] = false;
            $configm['remove_spaces'] = true;
            $this->upload->initialize($configm);
            if ($this->upload->do_upload('mother_photo')) {
                $file_data = $this->upload->data();
                $m_file_name = $file_data['file_name'];
            }
        }
        $STU_PARENT_ID_M = $this->input->post('STU_PARENT_ID_M');
        $mother_info = array(
            'STUDENT_ID' => $stu_id,
            'PARENTS_TYPE' => 'M',
            'OCCUPATION' => $this->input->post('MOTHER_OCU'),
            'ECP_FG' => 0,
            'ORG_ID' => 1,
            'ACTIVE_FLAG' => 1
        );
        if ($m_file_name != "") {
            $mother_info["PARENT_PHOTO"] = $m_file_name;
        }

        $this->utilities->updateData('stu_parentinfo', $mother_info, array('STU_PARENT_ID' => $STU_PARENT_ID_M));

        // update mother multiple mobile
        $MOTHER_PHN = $this->input->post('MOTHER_PHN');
        $STU_PGS_ID_M = $this->input->post('STU_PGS_ID_M');
        if (!empty($MOTHER_PHN)) {
            for ($i = 0; $i < sizeof($MOTHER_PHN); $i++) {

                if ($MOTHER_PHN[$i] != "") {
                    $mobile_data_m = array(
                        'CONTACTS' => $MOTHER_PHN [$i]
                    );

                    if ($STU_PGS_ID_M[$i] == "") {
                        $mobile_data_m["STU_PGS_ID"] = $this->utilities->pk_f('stu_pgscontract');
                        $mobile_data_m["STUDENT_ID"] = $stu_id;
                        $mobile_data_m["PGSC_TYPE"] = 'M';
                        $mobile_data_m["PGSC_ID"] = $STU_PARENT_ID_M;
                        $mobile_data_m["CONTACT_TYPE"] = 'M';
                        $mobile_data_m["ORG_ID"] = 1;
                        $mobile_data_m["DEFAULT_FG"] = 1;
                        $mobile_data_m["ACTIVE_STATUS"] = 1;
                        $this->utilities->insertData($mobile_data_m, 'stu_pgscontract');
                    } else {

                        $this->utilities->updateData('stu_pgscontract', $mobile_data_m, array('STU_PGS_ID' => $STU_PGS_ID_M[$i]));
                    }
                }
            }
        }
        // update mother multiple email
        $MOTHER_EMAIL = $this->input->post('MOTHER_EMAIL');
        $STU_PGS_ID_ME = $this->input->post('STU_PGS_ID_ME');
        if (!empty($MOTHER_EMAIL)) {
            for ($i = 0; $i < sizeof($MOTHER_EMAIL); $i++) {
                if ($MOTHER_EMAIL[$i] != "") {
                    $eamil_data_m = array(
                        'CONTACTS' => $MOTHER_EMAIL [$i]
                    );
                    if ($STU_PGS_ID_ME[$i] == "") {
                        $eamil_data_m["STU_PGS_ID"] = $this->utilities->pk_f('stu_pgscontract');
                        $eamil_data_m["STUDENT_ID"] = $stu_id;
                        $eamil_data_m["PGSC_TYPE"] = 'M';
                        $eamil_data_m["PGSC_ID"] = $STU_PARENT_ID_M;
                        $eamil_data_m["CONTACT_TYPE"] = 'E';
                        $eamil_data_m["ORG_ID"] = 1;
                        $eamil_data_m["DEFAULT_FG"] = 1;
                        $eamil_data_m["ACTIVE_STATUS"] = 1;
                        $this->utilities->insertData($eamil_data_m, 'stu_pgscontract');
                    } else {

                        $this->utilities->updateData('stu_pgscontract', $eamil_data_m, array('STU_PGS_ID' => $STU_PGS_ID_ME[$i]));
                    }
                }
            }
        }


        // present and permanet address insertion

        if ($this->input->post('SAS_PSORPR') == 1) {
            $present_address = array(
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
            $this->utilities->updateData('stu_adressinfo', $present_address, array('STU_ADRESS_ID' => $this->input->post('STU_ADRESS_ID_PS')));
            $this->utilities->deleteRowByAttribute('stu_adressinfo', array('STU_ADRESS_ID' => $this->input->post('STU_ADRESS_ID_PR'), 'ADRESS_TYPE' => 'PR'));
        } else {

            $present_address = array(
                'STUDENT_ID' => $stu_id,
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

            $this->utilities->updateData('stu_adressinfo', $present_address, array('STU_ADRESS_ID' => $this->input->post('STU_ADRESS_ID_PS')));

            $u_permanent_address = array(
                'STUDENT_ID' => $stu_id,
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
            // $check=$this->utilities->hasInformationByThisId('stu_contractinfo',array('STU_ADRESS_ID'=>$this->input->post('STU_ADRESS_ID_PR'),'ADRESS_TYPE'=>'PR'));
            if ($this->input->post('STU_ADRESS_ID_PR') != '') {
                $this->utilities->updateData('stu_adressinfo', $u_permanent_address, array('STU_ADRESS_ID' => $this->input->post('STU_ADRESS_ID_PR')));
            } else {
                $permanent_address = array(
                    'STU_ADRESS_ID' => $this->utilities->pk_f('stu_adressinfo'),
                    'STUDENT_ID' => $stu_id,
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
        }
        //end address insertion
        //start local guardian and emegensy contact person

        $leg = $this->input->post('local_emergency_guardian');

        if ($leg == 'F') {
            $update_f_info = array(
                'ECP_FG' => 1,
            );
            $this->utilities->updateData('stu_parentinfo', $update_f_info, array('STU_PARENT_ID' => $STU_PARENT_ID_F));
            if ($this->input->post('STU_GI_ID_LG') != '') {
                $this->utilities->deleteRowByAttribute('stu_guardians', array('STU_GI_ID' => $this->input->post('STU_GI_ID_LG')));
                $STU_PGS_ID_EP = $this->input->post('STU_PGS_ID_EP');
                for ($i = 0; $i < sizeof($STU_PGS_ID_EP); $i++) {
                    $this->utilities->deleteRowByAttribute('stu_pgscontract', array('STU_PGS_ID' => $STU_PGS_ID_EP[$i]));
                }
            }
        } else if ($leg == 'M') {
            $update_m_info = array(
                'ECP_FG' => 1,
            );
            $this->utilities->updateData('stu_parentinfo', $update_m_info, array('STU_PARENT_ID' => $STU_PARENT_ID_M));
            if ($this->input->post('STU_GI_ID_LG') != '') {
                $this->utilities->deleteRowByAttribute('stu_guardians', array('STU_GI_ID' => $this->input->post('STU_GI_ID_LG')));
                $STU_PGS_ID_EP = $this->input->post('STU_PGS_ID_EP');
                for ($i = 0; $i < sizeof($STU_PGS_ID_EP); $i++) {
                    $this->utilities->deleteRowByAttribute('stu_pgscontract', array('STU_PGS_ID' => $STU_PGS_ID_EP[$i]));
                }
            }
        } else {

            $STU_GI_ID_LG = $this->input->post('STU_GI_ID_LG');
            $local_emergency_guardian = array(
                'GFULL_NAME' => $this->input->post('LOCAL_GAR_NAME'),
                'RELATION_ID' => $this->input->post('LOCAL_GAR_RELATION'),
                'ADDRESS' => $this->input->post('LOCAL_GAR_ADDRESS'),
                'ECP_FG' => 1,
                'ORG_ID' => 1,
                'ACTIVE_FLAG' => 1
            );
            if ($STU_GI_ID_LG) {
                $this->utilities->updateData('stu_guardians', $local_emergency_guardian, array('STU_GI_ID' => $STU_GI_ID_LG));
            } else {
                $new_guardian_id = $this->utilities->pk_f('stu_guardians');
                $insert_local_emergency_guardian = array(
                    'STU_GI_ID' => $new_guardian_id,
                    'STUDENT_ID' => $stu_id,
                    'GFULL_NAME' => $this->input->post('LOCAL_GAR_NAME'),
                    'RELATION_ID' => $this->input->post('LOCAL_GAR_RELATION'),
                    'ADDRESS' => $this->input->post('LOCAL_GAR_ADDRESS'),
                    'ECP_FG' => 1,
                    'ORG_ID' => 1,
                    'ACTIVE_FLAG' => 1
                );
                $this->utilities->insertData($insert_local_emergency_guardian, 'stu_guardians');

                $LOCAL_GAR_PHN = $this->input->post('LOCAL_GAR_PHN');
                $STU_PGS_ID_EP = $this->input->post('STU_PGS_ID_EP');
                if (!empty($LOCAL_GAR_PHN)) {
                    for ($i = 0; $i < sizeof($LOCAL_GAR_PHN); $i++) {
                        if ($LOCAL_GAR_PHN[$i] != "") {
                            $mobile_data_lg = array(
                                'CONTACTS' => $LOCAL_GAR_PHN [$i]
                            );
                            if ($STU_PGS_ID_EP[$i] == "") {
                                $mobile_data_lg["STU_PGS_ID"] = $this->utilities->pk_f('stu_pgscontract');
                                $mobile_data_lg["STUDENT_ID"] = $stu_id;
                                $mobile_data_lg["PGSC_TYPE"] = 'EG';
                                $mobile_data_lg["PGSC_ID"] = $new_guardian_id;
                                $mobile_data_lg["CONTACT_TYPE"] = 'E';
                                $mobile_data_lg["ORG_ID"] = 1;
                                $mobile_data_lg["DEFAULT_FG"] = 1;
                                $mobile_data_lg["ACTIVE_STATUS"] = 1;
                                $this->utilities->insertData($mobile_data_lg, 'stu_pgscontract');
                            } else {

                                $this->utilities->updateData('stu_pgscontract', $mobile_data_lg, array('STU_PGS_ID' => $STU_PGS_ID_EP[$i]));
                            }
                        }
                    }
                }
            }
        }
        //start admission information insertion

        $admission_info = array(
            'STUDENT_ID' => $stu_id,
            'ADMISSION_DATE' => date('Y-m-d', strtotime($this->input->post('ADMISSION_DATE'))),
            'SESSION_ID' => $this->input->post('SESSION'),
            'FACULTY_ID' => $this->input->post('FACULTY'),
            'DEPT_ID' => $this->input->post('DEPT_ID'),
            'PROGRAM_ID' => $this->input->post('PROGRAM_ID'),
            'SEMISTER_ID' => $this->input->post('SEMESTER'),
            'ACTIVE_STATUS' => 1
        );

        $this->utilities->updateData('stu_admissioninfo', $admission_info, array('STU_ADMISSION_ID' => $this->input->post('STU_ADMISSION_ID')));
        //end admission information insertion

        $SUBSTANCE = $this->input->post('SUBSTANCE');
        $CURRENTLY_USED = $this->input->post('CURRENTLY_USED');
        $PREVIOUSLY_USED = $this->input->post('PREVIOUSLY_USED');
        $TYPE_AMOUNT_FREQUENCY = $this->input->post('TYPE_AMOUNT_FREQUENCY');
        $DURATION = $this->input->post('DURATION');
        $STOP_DT = $this->input->post('STOP_DT');
        $STU_MEDI_ID = $this->input->post('STU_MEDI_ID');
        if (!empty($SUBSTANCE)) {
            for ($i = 0; $i < sizeof($SUBSTANCE); $i++) {

                $update_medical_info = array(
                    'STUDENT_ID' => $stu_id,
                    'SUBSTANCE' => $SUBSTANCE[$i],
                    'CURRENTLY_USED' => $CURRENTLY_USED[$i],
                    'PREVIOUSLY_USED' => $PREVIOUSLY_USED[$i],
                    'TYPE_AMOUNT_FREQUENCY' => $TYPE_AMOUNT_FREQUENCY[$i],
                    'DURATION' => $DURATION[$i],
                    'STOP_DT' => ($STOP_DT[$i] != '') ? date('Y-m-d', strtotime($STOP_DT[$i])) : '',
                    'ACTIVE_STATUS' => 1
                );
                //echo "<pre>";print_r($update_medical_info);
                $this->utilities->updateData('stu_medicalinfo', $update_medical_info, array('STU_MEDI_ID' => $STU_MEDI_ID[$i]));
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
                    'STUDENT_ID' => $stu_id,
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
        // academic information insertion
        $COUNTER = $this->input->post('COUNTER');
        $file_name = "";
        $this->load->library('upload');
        $this->load->helper('string');
        $configc['upload_path'] = 'upload/academin_certificate/';
        //$config['allowed_types'] = '*';
        $configc['allowed_types'] = 'gif|jpg|jpeg|png';
        $configc['overwrite'] = false;
        $configc['remove_spaces'] = true;
        //$config['max_size']	= '100';// in KB
        $this->upload->initialize($configc);

        for ($i = 1; $i <= ($COUNTER); $i++) {
            $ac_info_pk = $this->input->post("AC_PK_$i");
            if ($ac_info_pk != "") {
                $ac_pk = $this->utilities->pk_f('stu_acadimicinfo');
                $academic_info_update = array(
                    'EXAM_DEGREE_ID' => $this->input->post('EXAM_NAME_' . $i),
                    'MAJOR_GROUP_ID' => $this->input->post('GROUP_' . $i),
                    'INSTITUTION' => $this->input->post('INSTITUTE_' . $i),
                    'BOARD' => $this->input->post('BOARD_' . $i),
                    'RESULT_GRADE' => $this->input->post('GPA_' . $i),
                    'PASSING_YEAR' => $this->input->post('PASSING_YEAR_' . $i)
                );
                if ($this->upload->do_upload('CERTIFICATE_' . $i)) {
                    $file_data = $this->upload->data();
                    $file_name = $file_data['file_name'];
                    $academic_info_update["ACHIEVEMENT"] = $file_name;
                }
                $this->utilities->updateData('stu_acadimicinfo', $academic_info_update, array('STU_AI_ID' => $ac_info_pk));
            } else {
                if ($this->upload->do_upload('CERTIFICATE_' . $i)) {
                    $file_data = $this->upload->data();
                    $file_name = $file_data['file_name'];
                    $ac_pk = $this->utilities->pk_f('stu_acadimicinfo');
                    $academic_info = array(
                        'STU_AI_ID' => $ac_pk,
                        'STUDENT_ID' => $stu_id,
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
        }

        //end academic information insertion

        $previous_course_result = array();
        $faculty = $this->input->post('FACULTY_C');
        $dept = $this->input->post('DEPT_ID_C');
        $program = $this->input->post('PROGRAM_ID_C');
        $semister = $this->input->post('SEMISTER_ID_C');
        $session = $this->input->post('SESSION_ID_C');
        $selected_courses = $this->input->post('COURSE_ID');
        $offered_course_id = $this->input->post('OFFERED_COURSE_ID');


        // preparing ids to be used in "IN()" operator
        $course_ids = implode(",", $selected_courses);
        // delete the other course ids found in the database
        $this->db->query("DELETE FROM stu_courseinfo WHERE STUDENT_ID = '$stu_id' AND FACULTY_ID = $faculty AND DEPT_ID = $dept
                          AND PROGRAM_ID = $program AND SEMISTER_ID = $semister AND SESSION_ID = $session
                          AND COURSE_ID NOT IN ($course_ids)");

        // looping the new courses to insert
        for ($i = 0; $i < sizeof($selected_courses); $i++) {
            $check_current_courses = array(
                'STUDENT_ID' => $stu_id,
                'SESSION_ID' => $session,
                'SEMISTER_ID' => $semister,
                'FACULTY_ID' => $faculty,
                'DEPT_ID' => $dept,
                'PROGRAM_ID' => $program,
                'COURSE_ID' => $selected_courses[$i],
                'IS_CURRENT' => 1
            );
            // check if course info already exist
            if ($this->utilities->hasInformationByThisId('stu_courseinfo', $check_current_courses) == FALSE) {
                // get the offer course ids from "course_offer" table
                $offered_course = $this->db->query("SELECT c.OFFERED_COURSE_ID FROM aca_course_offer c
                                                    WHERE c.FACULTY_ID = $faculty AND c.DEPT_ID = $dept AND c.PROGRAM_ID = $program
                                                    AND c.COURSE_ID = $selected_courses[$i]")->row();
                // Prepare the primary key of the table
                $course_info_pk = $this->utilities->pk_f('stu_courseinfo');
                // preparing student course information data to insert
                $student_current_courses = array(
                    'STU_CRS_ID' => $course_info_pk,
                    'STUDENT_ID' => $stu_id,
                    'OFFERED_COURSE_ID' => $offered_course->OFFERED_COURSE_ID,
                    'SESSION_ID' => $session,
                    'SEMISTER_ID' => $semister,
                    'FACULTY_ID' => $faculty,
                    'DEPT_ID' => $dept,
                    'PROGRAM_ID' => $program,
                    'COURSE_ID' => $selected_courses[$i],
                    'IS_CURRENT' => 1,
                    'ACTIVE_STATUS' => 1
                );
                // insert student course informations
                $this->utilities->insertData($student_current_courses, 'stu_courseinfo');
            }
        }


        //start waiver information insertion

        $update_waiver_info = array(
            'PERCENTAGE' => $this->input->post('WEAVER_PERCENTAGE'),
            'REASON' => $this->input->post('WEAVER_REASON'),
            'ACTIVE_STATUS' => 1
        );
        if ($this->input->post('STU_WEAVER_ID') != '') {
            $this->utilities->updateData('stu_weaverinfo', $update_waiver_info, array('STU_WEAVER_ID' => $this->input->post('STU_WEAVER_ID')));
        } else {
            $waiver_pk = $this->utilities->pk_f('stu_weaverinfo');
            $waiver_info = array(
                'STU_WEAVER_ID' => $waiver_pk,
                'STUDENT_ID' => $stu_id,
                'PERCENTAGE' => $this->input->post('WEAVER_PERCENTAGE'),
                'REASON' => $this->input->post('WEAVER_REASON'),
                'ACTIVE_STATUS' => 1
            );
            $this->utilities->insertData($waiver_info, 'stu_weaverinfo');
        }
        //end waiver information insertion
        //start sibling insertion
        if ($this->input->post('SIBLING_EXIST') == 1) {
            $sibling_info = array(
                'SBLN_ROLL_NO' => $this->input->post('SBLN_ROLL_NO'),
                'STUDENT_ID' => $stu_id,
                'ACTIVE_STATUS' => 1
            );
            if ($this->input->post('STU_SBLN_ID') != '') {
                $this->utilities->updateData('stu_siblings', $sibling_info, array('STU_SBLN_ID' => $this->input->post('STU_SBLN_ID')));
            } else {
                $data_sibling_info = array(
                    'STU_SBLN_ID' => $this->utilities->pk_f('stu_siblings'),
                    'STUDENT_ID' => $stu_id,
                    'SBLN_ROLL_NO' => $this->input->post('SBLN_ROLL_NO'),
                    'STUDENT_ID' => $stu_id,
                    'ACTIVE_STATUS' => 1
                );
                $this->utilities->insertData($data_sibling_info, 'stu_siblings');
            }
        } else {
            $this->utilities->deleteRowByAttribute('stu_siblings', array('STU_SBLN_ID' => $this->input->post('STU_SBLN_ID')));
        }
        //end sibling insertion
        //redirect to update student form
        redirect('admission/editExistingStu/' . $stu_id);
    }

    /**
     * @methodName  delImage()
     * @access public
     * @param
     * @author   Rakib Roni <rakib@atilimited.net>
     * @return    delete file,image from folder
     */
    function delImage()
    {
        $image_name = $_POST['image_name'];
        if (unlink('upload/academin_certificate/' . $image_name)) {
            echo 'Y';
        } else {
            echo 'N';
        }
    }

    public function applecentEdit()
    {
        $data['contentTitle'] = 'Edit User';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Edit  User" => '#'
        );
        $previous_info = $this->utilities->findByAttribute('regi_student', array('REGI_ID' => 1));
        $data['previous_info'] = $previous_info;
        $data['nationality'] = $this->utilities->getAll('country');
        $data['exam_name'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 13));
        $data['board_name'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 24));
        $data['group_name'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 25));
        $data['occupation'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 21));
        $data['relation'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 40));
        $data['session'] = $this->utilities->findAllByAttribute('session', array('ACTIVE_STATUS' => 1));
        $data['faculty'] = $this->utilities->findAllByAttribute('faculty', array('ACTIVE_STATUS' => 1));
        $data['department'] = $this->utilities->findAllByAttribute('department', array('ACTIVE_STATUS' => 1));
        $data['program'] = $this->utilities->findAllByAttribute('program', array('ACTIVE_STATUS' => 1));
        $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
        // print_r($data);exit;
        //var_dump($data['previous_info']);exit;
        $data['content_view_page'] = 'admin/admission/edit_registration';
        $this->admin_template->display($data);
    }

    public function payment()
    {
        $data['contentTitle'] = 'Payment';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Calendar" => '#'
        );
        $data['content_view_page'] = 'payment/invoice';
        $this->admin_template->display($data);
    }





    ////////////////////////////////////////////////////////////////////////
    function rollPolicy() {
        $data['contentTitle'] = 'Admission';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Roll Policy List' => '#',
            );
        //$data["previlages"] = $this->checkPrevilege();
        $data['program'] = $this->utilities->findAllByAttributeFromProgram();
        $data['content_view_page'] = 'admin/setup/roll_policy/roll_policy_index';
        $this->admin_template->display($data);
    }

    public function checkPrevilege($param = "") {
        if ($param == "") {
            $controller = $this->uri->segment(1, 'dashboard');
            $action = $this->uri->segment(2, 'index');
            $link = "$controller/$action";
        } else {
            $link = "$param";
        }
        return $this->security_model->get_all_checked_module_links_by_user($link, $this->user['USERGRP_ID'], $this->user['USERLVL_ID'], $this->user['USER_ID']);
    }

    function rollPolicyFormInsert() {
        $data["ac_type"] = 1;
        $data["session"] = $this->utilities->admissionSessionList();
        $data["degree"] = $this->utilities->findAllByAttribute("ins_degree", array("ACTIVE_STATUS" => 1)); // select all degree name from  degree
        $data["faculty"] = $this->utilities->findAllByAttribute("ins_faculty", array("ACTIVE_STATUS" => 1)); // select all faculty name from  faculty
        $data["program"] = $this->utilities->findAllByAttribute("ins_program", array("ACTIVE_STATUS" => 1)); //select all program name from  program
        $this->load->view('admin/setup/roll_policy/add_roll_policy', $data);
    }

    function createRollPolicy() {
        $Degrees = $this->input->post('DEGREE_ID'); // degree
        $Departments = $this->input->post('DEPT_ID'); // program
        $Facultys = $this->input->post('FACULTY_ID'); // faculty
        $programName = $this->input->post('PROGRAM_ID'); // Program name
        
        $TotalSemester = $this->input->post('TotalSemester'); //  Total Semesters
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Program with this name is already exist
        $check = $this->utilities->hasInformationByThisId("ins_program", array("PROGRAM_NAME" => $programName));
        if (empty($check)) {// if Program name available
            // preparing data to insert
            $program = array(
                'PROGRAM_NAME' => $programName,                
                'TOTAL_SESSION' => $TotalSemester,
                'DEGREE_ID' => $Degrees,
                'DEPT_ID' => $Departments,
                'FACULTY_ID' => $Facultys,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
                );

            echo json_encode($program);
            exit;

            // if ($this->utilities->insertData($program, 'ins_program')) { // if data inserted successfully
            //     echo "<div class='alert alert-success'>Program Create successfully</div>";
            // } else { // if data inserted failed
            //     echo "<div class='alert alert-danger'>Program Name insert failed</div>";
            // }
        } else {// if faculty name not available
            echo "<div class='alert alert-danger'>Program Name Already Exist</div>";
        }
    }
    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return
     */
    public function directAdmission()
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
            $data['degree'] = $this->utilities->findAllByAttribute('ins_degree', array('ACTIVE_STATUS' => 1));
            //$data['faculty'] = $this->utilities->findAllByAttribute('ins_faculty', array('ACTIVE_STATUS' => 1));
            //$data['department'] = $this->utilities->findAllByAttribute('ins_dept', array('ACTIVE_STATUS' => 1));
            //$data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
            //$data['applicant_user'] = $this->utilities->findAllByAttribute('applicant_user', array('APPLICANT_USER_ID' => $applicant_ses['APPLICANT_USER_ID']));
            //$data['program'] = $this->utilities->findAllByAttribute('ins_program',array('ACTIVE_STATUS' =>1));
             
            $data['content_view_page'] = 'admin/admission/admission_form';
            

        } else {
            $program_id=$this->input->post('PROGRAM_ID');

            $current_adm_info = $this->utilities->findByAttribute('adm_ysession', array('IS_CURRENT' => 1));
            $program_details = $this->utilities->findByAttribute('ins_program', array('PROGRAM_ID' =>$program_id ));
            $current_session_id = $current_adm_info->YSESSION_ID;
            $current_session_year = $current_adm_info->DINYEAR;
            $ADM_ROLL_NO = $this->utilities->get_addmission_roll_number($current_session_year, $current_session_id, $program_details->FACULTY_ID, $program_details->DEPT_ID, $program_id);

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
                'FULL_NAME_EN' => $this->input->post('FULL_NAME'),
                'MOBILE_NO' => $this->input->post('MOBILE_NO'),
                'GENDER' => $this->input->post('GENDER'),
                'DATH_OF_BIRTH' => date('Y-m-d',strtotime($this->input->post('DATE_OF_BIRTH'))),
                'EMAIL_ADRESS' => $this->input->post('EMAIL'),                
                 
                'APPROVE_FOR_ADMIT' =>1,//cause its direct admission
                'ADM_SESSION_ID' => $current_session_id,
                'ADM_ROLL_NO' => $ADM_ROLL_NO,

                'DEGREE_ID' => $this->input->post('DEGREE_ID'),
                'FACULTY_ID' => $program_details->FACULTY_ID,
                'DEPT_ID' => $program_details->DEPT_ID,
                'PROGRAM_ID' => $program_id,

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
            //echo "<pre>"; print_r($applicnt_personal_info);echo "</pre>";exit;
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

            redirect('admission/directAdmission');
        }


        $this->admin_template->display($data);

    }

}

?>
