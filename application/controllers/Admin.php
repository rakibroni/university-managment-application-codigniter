<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
    private $user_session;
    
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('auth/login', 'refresh');
        }
        $this->user_session = $this->session->userdata('logged_in');
        // $user_session = $this->user = $this->session->userdata('logged_in');
        // $this->user_id = $user_session['USER_TYPE'];

        header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->load->model('utilities');
    }

    /*
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
        return $this->security_model->get_all_checked_module_links_by_user($link, $this->user_session['USERGRP_ID'], $this->user_session['USERLVL_ID'], $this->user_session['USER_ID']);
    }

    /**
     * @methodName  index()
     * @access
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      dashboard
     */
    public function index()
    {

        $data['contentTitle'] = 'Dashboard';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Dashboard" => '#'
            );
        $data['pageTitle'] = 'Online University Management System';
        $current_session= $this->utilities->findByAttribute("adm_ysession", array("IS_CURRENT" => 1));
        $data['programs']  = $this->utilities->findAllByAttribute("ins_program", array("ACTIVE_STATUS" => 1)); 
        
        //current session total applicant
        $data['tot_applicant'] = $this->utilities->countRowByAttribute("applicant_personal_info", array("ADM_SESSION_ID" => $current_session->YSESSION_ID));
        $data['tot_applicant_male'] = $this->utilities->countRowByAttribute("applicant_personal_info", array("ADM_SESSION_ID" => $current_session->YSESSION_ID, "GENDER" => 'M'));
        $data['tot_applicant_female'] = $this->utilities->countRowByAttribute("applicant_personal_info", array("ADM_SESSION_ID" => $current_session->YSESSION_ID, "GENDER" => 'F'));

        //total student
        $data['tot_stu'] = $this->utilities->countRowByAttribute("student_personal_info", array("ACTIVE_STATUS" => 1));
        $data['tot_stu_male'] = $this->utilities->countRowByAttribute("student_personal_info", array("GENDER" => 'M'));
        $data['tot_stu_female'] = $this->utilities->countRowByAttribute("student_personal_info", array("GENDER" => 'F'));

        //degree wise total applicant
        $data['tot_applicant_bsc'] = $this->utilities->countRowByAttribute("applicant_personal_info", array("ADM_SESSION_ID" => $current_session->YSESSION_ID, "DEGREE_ID" => 3));
        $data['tot_applicant_msc'] = $this->utilities->countRowByAttribute("applicant_personal_info", array("ADM_SESSION_ID" => $current_session->YSESSION_ID, "DEGREE_ID" => 4));
        $data['tot_applicant_diploma'] = $this->utilities->countRowByAttribute("applicant_personal_info", array("ADM_SESSION_ID" => $current_session->YSESSION_ID, "DEGREE_ID" => 5));
        
        //degree wise total student
        $data['tot_stu_bsc'] = $this->utilities->countRowByAttribute("student_personal_info", array( "DEGREE_ID" => 3));
        $data['tot_stu_msc'] = $this->utilities->countRowByAttribute("student_personal_info", array("DEGREE_ID" => 4));
        $data['tot_stu_diploma'] = $this->utilities->countRowByAttribute("student_personal_info", array("DEGREE_ID" => 5));

        $data['content_view_page'] = 'dashboard';
        $this->admin_template->display($data);
    }

    /**
     * @methodName  users()
     * @access
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      all staff list
     */
    function users()
    {

        $data['contentTitle'] = 'User List';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "User List" => '#'
            );
        $data['pageTitle'] = 'User List';
        $data['users'] = $this->utilities->findAllByAttributeWithJoin("sa_users", "designations", "DESIGNATION_ID", "DESIGNATION_ID", "DESIGNATION");
        $data["groups"] = $this->utilities->dropdownFromTableWithCondition("sa_user_group", "Select A Group", "USERGRP_ID", "USERGRP_NAME", array("ORG_ID" => 1, "ACTIVE_STATUS" => 1)); // ORG_ID should be session value
        $data["departments"] = $this->utilities->dropdownFromTableWithCondition("department", "Select Department", "DEPT_ID", "DEPT_NAME", array("ACTIVE_STATUS" => 1)); // All departments value
        $data["fields"] = $this->db->field_data('sa_users');

        $data['content_view_page'] = 'admin/users';
        $this->admin_template->display($data);
    }

    /**
     * @methodName  get_userLevelByGroup()
     * @access
     * @param
     * @author      Nurullah<nurul@atilimited.net>
     * @return      group wise user Level list
     */
    function get_userLevelByGroup()
    {
        $group_id = $_POST['groupId'];
        $query = $this->utilities->findAllByAttribute('sa_ug_level', array("USERGRP_ID" => $group_id, "ACTIVE_STATUS" => 1));
        $returnVal = '<option value="">Select One</option>';
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value="' . $row->UG_LEVEL_ID . '">' . $row->UGLEVE_NAME . '</option>';
            }
        }
        echo $returnVal;
    }

    /**
     * @methodName  get_designationByDept()
     * @access
     * @param
     * @author      Nurullah<nurul@atilimited.net>
     * @return      Department wise Designation list
     */
    function get_designationByDept()
    {
        $dept_id = $_POST['dept_id'];
        $query = $this->utilities->findAllByAttribute('designations', array("DEPT_ID" => $dept_id, "ACTIVE_STATUS" => 1));
        $returnVal = '<option value="">Select One</option>';
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value="' . $row->DESIGNATION_ID . '">' . $row->DESIGNATION . '</option>';
            }
        }
        echo $returnVal;
    }

    /**
     * @methodName  searchUserList()
     * @access
     * @param
     * @author      Nurullah<nurul@atilimited.net>
     * @return      Submit (Group id, user level, department id, gender)---> user list
     */
    function searchUserList()
    {
        $group_id = $_POST['cmbGroup'];
        $userLevel_id = $_POST['userLevel'];
        $department_id = $_POST['cmbDepartment'];
        $designation_id = $_POST['userDesignation'];
        $gender_id = $_POST['userGender'];
        $data["filtered_result"] = $this->utilities->userlist($group_id, $userLevel_id, $department_id, $designation_id, $gender_id);
        echo $this->load->view("admin/user_list", $data, true);
    }

    /**
     * @methodName  advSearchUserList()
     * @access
     * @param
     * @author      Nurullah<nurul@atilimited.net>
     * @return      Submit (fild Name, operator, Keyword)---> user list
     */
    function advSearchUserList()
    {
        $fild_name = $_POST['fildName'];
        $operator = $_POST['operator'];
        $textKeyword = $_POST['textKeyword'];
        $operatorType = $_POST['operatorType'];
        if ($operatorType == 1) {
            $data["filtered_result"] = $this->db->query("SELECT u.USER_ID, u.USER_IMG, u.FULL_NAME, u.MOBILE,u.EMAIL,(SELECT d.DESIGNATION FROM designations d WHERE d.DESIGNATION_ID = u.DESIGNATION_ID)DESIGNATION"
                . " FROM sa_users u WHERE u.$fild_name $operator '$textKeyword%'")->result();
            echo $this->load->view("admin/user_list", $data, true);
        } elseif ($operatorType == 2) {
            $data["filtered_result"] = $this->db->query("SELECT u.USER_ID, u.USER_IMG, u.FULL_NAME, u.MOBILE,u.EMAIL,(SELECT d.DESIGNATION FROM designations d WHERE d.DESIGNATION_ID = u.DESIGNATION_ID)DESIGNATION"
                . " FROM sa_users u WHERE u.$fild_name $operator '%$textKeyword%'")->result();
            echo $this->load->view("admin/user_list", $data, true);
        } else {
            $data["filtered_result"] = $this->db->query("SELECT u.USER_ID, u.USER_IMG, u.FULL_NAME, u.MOBILE,u.EMAIL,(SELECT d.DESIGNATION FROM designations d WHERE d.DESIGNATION_ID = u.DESIGNATION_ID)DESIGNATION"
                . " FROM sa_users u WHERE u.$fild_name $operator '$textKeyword'")->result();
            echo $this->load->view("admin/user_list", $data, true);
        }
    }

    /**
     * @methodName  addUser()
     * @access
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      Insert a new user
     */
    function addUser()
    {
        $data['contentTitle'] = 'Add New User';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Add  User" => '#'
            );

        $data['pageTitle'] = 'Add User';
        $this->form_validation->set_rules('USERNAME', 'user name', 'required');
        $this->form_validation->set_rules('USERPW', 'password', 'required');
        $this->form_validation->set_rules('DEPT_ID', 'department ', 'required');
        $this->form_validation->set_rules('user_group', 'user group ', 'required');
        $this->form_validation->set_rules('FIRST_NAME', 'first name ', 'required');
        $this->form_validation->set_rules('LAST_NAME', 'last name', 'required');
        $this->form_validation->set_rules('EMAIL', 'email', 'trim|required|valid_email');
        $this->form_validation->set_rules('NID', 'national id', 'required');
        $this->form_validation->set_rules('DOB', 'date of birth', 'required');
        $this->form_validation->set_rules('GENDER', 'gender', 'required');
        $this->form_validation->set_rules('HIRE_DATE', 'hire date', 'required');
        $this->form_validation->set_rules('MOBILE', 'mobile', 'required');
        $this->form_validation->set_rules('RELIGION', 'religion', 'required');
        $this->form_validation->set_rules('NATIONALITY', 'nationality', 'required');
        $this->form_validation->set_rules('PRE_ADDRESS', 'present address', 'required');
        $this->form_validation->set_rules('PER_ADDRESS', 'permanent address', 'required');
//$this->form_validation->set_rules('photo', 'photo', 'required');

        if ($this->form_validation->run() == FALSE) {
            $session_info = $this->session->userdata('logged_in');
            $data['nationality'] = $this->utilities->getAll('country');
            $data['religion'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 3));
            $data['blood_group'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 4));
            $data['user_group'] = $this->utilities->findAllByAttribute('sa_user_group', array('ORG_ID' => $session_info['ORG_ID']));
            $data['faculty'] = $this->utilities->findAllByAttribute("faculty", array("ACTIVE_STATUS" => 1));
            $data['designations'] = $this->utilities->findAllByAttribute('designations', array('ORG_ID' => $session_info['ORG_ID']));
            $data['content_view_page'] = 'admin/add_user';
        } else {
            $is_duplicate = $this->utilities->hasInformationByThisId('sa_users', array('USERNAME' => $this->input->post('USERNAME')));
            if ($is_duplicate > 0) {
                $this->session->set_flashdata('Error', 'Sorry this user already exits !');
                redirect('admin/addUser', 'refresh');
            } else {
// $files = $_FILES;
// print_r($files);exit;

                if (!empty($_FILES)) {
                    $this->load->library('upload');
                    $this->load->helper('string');
                    $config['upload_path'] = 'upload/';
//$config['allowed_types'] = '*';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['overwrite'] = false;
                    $config['remove_spaces'] = true;
//$config['max_size']	= '100';// in KB
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('photo')) {
                        $file_data = $this->upload->data();
                        $file_name = $file_data['file_name'];
//$this->utilities->insertData($data, 'profile_picture');
                        $add_file = array(
                            'FIRST_NAME' => $this->input->post('FIRST_NAME'),
                            'MIDDLE_NAME' => $this->input->post('MIDDLE_NAME'),
                            'LAST_NAME' => $this->input->post('LAST_NAME'),
                            'FULL_NAME' => $this->input->post('FIRST_NAME') . ' ' . $this->input->post('MIDDLE_NAME') . ' ' . $this->input->post('LAST_NAME'),
                            'EMAIL' => $this->input->post('EMAIL'),
                            'ALT_EMAIL' => $this->input->post('ALT_EMAIL'),
                            'NID' => $this->input->post('NID'),
                            'DOB' => date('Y-m-d', strtotime($this->input->post('DOB'))),
                            'AGE' => $this->input->post('AGE'),
                            'BLOOD_GROUP' => $this->input->post('BLOOD_GROUP'),
                            'HEIGHT_FEET' => $this->input->post('HEIGHT_FEET'),
                            'HEIGHT_CM' => $this->input->post('HEIGHT_CM'),
                            'WEIGHT_KG' => $this->input->post('WEIGHT_KG'),
                            'WEIGHT_LBS' => $this->input->post('WEIGHT_LBS'),
                            'GENDER' => $this->input->post('GENDER'),
                            'RELIGION' => $this->input->post('RELIGION'),
                            'NATIONALITY' => $this->input->post('NATIONALITY'),
                            'HIRE_DATE' => date('Y-m-d', strtotime($this->input->post('HIRE_DATE'))),
                            'USER_IMG' => $file_name,
                            'FATHERS_NAME' => $this->input->post('FATHERS_NAME'),
                            'MOTHERS_NAME' => $this->input->post('MOTHERS_NAME'),
                            'HOME_PHONE' => $this->input->post('HOME_PHONE'),
                            'MOBILE' => $this->input->post('MOBILE'),
                            'MARITAL_STATUS' => ((isset($_POST['MARITAL_STATUS'])) ? 1 : 0),
                            'SPOUSE_NAME' => $this->input->post('SPOUSE_NAME'),
                            'PLACE_OF_BIRTH' => $this->input->post('PLACE_OF_BIRTH'),
                            'PASSPORT_NO' => $this->input->post('PASSPORT_NO'),
                            'DATE_OF_ISSUE' => date('Y-m-d', strtotime($this->input->post('DATE_OF_ISSUE'))),
                            'EXPIRE_DATE' => date('Y-m-d', strtotime($this->input->post('EXPIRE_DATE'))),
                            'PLACE_OF_ISSUE' => $this->input->post('PLACE_OF_ISSUE'),
                            'PRE_ADDRESS' => $this->input->post('PRE_ADDRESS'),
                            'PER_ADDRESS' => $this->input->post('PER_ADDRESS'),
                            'CONTACT_PERSON' => $this->input->post('CONTACT_PERSON'),
                            'CONTACT_PERSON_ADD' => $this->input->post('CONTACT_PERSON_ADD'),
                            'CONTACT_PERSON_PHN' => $this->input->post('CONTACT_PERSON_PHN'),
                            'RELATION' => $this->input->post('RELATION'),
                            'USERGRP_ID' => $this->input->post('user_group'),
                            'USERLVL_ID' => $this->input->post('user_group_lavel'),
                            'FACULTY_ID' => $this->input->post('FACULTY_ID'),
                            'DEPT_ID' => $this->input->post('DEPT_ID'),
                            'DESIGNATION_ID' => $this->input->post('designation'),
                            'BIOMETRIC_ID' => $this->input->post('BIOMETRIC_ID'),
                            'OFFICIAL_PHONE_NO' => $this->input->post('OFFICIAL_PHONE_NO'),
                            'OFFICIAL_PHONE_EXTENSION' => $this->input->post('OFFICIAL_PHONE_EXTENSION'),
                            'USERNAME' => $this->input->post('USERNAME'),
                            'USERPW' => $this->input->post('USERPW')
                            );

                        $emp_id = $this->utilities->insert('sa_users', $add_file);
                        $session_info = $this->session->userdata('logged_in');
                        $ALT_MOBILE = $this->input->post('ALT_MOBILE');

                        if ($ALT_MOBILE) {
                            foreach ($ALT_MOBILE as $key => $value) {
                                $insert_mobile = array(
                                    'CONTACT_INFO' => $ALT_MOBILE [$key],
                                    'CONTACT_TYPE' => 'M',
                                    'EMP_ID' => $emp_id,
                                    'ORG_ID' => $session_info["ORG_ID"],
                                    'DEFAULT_FG' => 1,
                                    'ACTIVE_STATUS' => 1
                                    );

                                $this->utilities->insertData($insert_mobile, 'hr_emp_cinfo');
                            }
                        }
                        $this->session->set_flashdata('Success', 'Congratulation ! User Information Added Successfully.');
                        redirect('admin/users', 'refresh');
                    }
                }
            }
        }
        $this->admin_template->display($data);
    }

    /**
     * @methodName  userGroupByOrgId()
     * @access
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      organization wise user groups
     */
    function userGroupByOrgId()
    {
        $org_id = $_POST['org_id'];
        $data['user_groups'] = $this->utilities->findAllByAttribute('sa_user_group', array('ORG_ID' => $org_id));
        $this->load->view('admin/ajax_ug_list', $data);
    }

    /**
     * @methodName  viewUser()
     * @access
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      view user details in modal
     */
    function viewUser()
    {
        $user_id = $_POST['param'];
        $data['user_details'] = $this->db->query("SELECT u.*,
            f.FACULTY_NAME AS faculty,
            de.DEPT_NAME as department,
            g.USERGRP_NAME AS USER_GRP_NAME,
            l.UGLEVE_NAME AS USER_GRP_LVL_NAME,
            d.DESIGNATION AS DESIGNATION,
            c.nationality AS NATIONALITES
            FROM sa_users u
            LEFT JOIN faculty f ON u.FACULTY_ID = f.FACULTY_ID
            LEFT JOIN department de ON u.DEPT_ID = de.DEPT_ID
            LEFT JOIN sa_user_group g ON u.USERGRP_ID = g.USERGRP_ID
            LEFT JOIN sa_ug_level l ON u.USERLVL_ID = l.UG_LEVEL_ID
            LEFT JOIN designations d ON u.DESIGNATION_ID = d.DESIGNATION_ID
            LEFT JOIN country c ON u.NATIONALITY = c.id
            WHERE u.USER_ID = $user_id")->row();
        $this->load->view('admin/user_details', $data);
    }

    /**
     * @methodName  editUser()
     * @access
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      edit user's previous data
     */
    function editUser($id)
    {
        $data['contentTitle'] = 'Edit User';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Edit  User" => '#'
            );
        $USER_ID = $id;
        $previous_info = $this->utilities->findByAttribute('sa_users', array('USER_ID' => $USER_ID));
        $data['previous_info'] = $previous_info;
        $session_info = $this->session->userdata('logged_in');
        $data['religion'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 3));
        $data['blood_group'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 4));
        $data['nationality'] = $this->utilities->getAll('country');
        $data['group_lavel'] = $this->utilities->getAll('sa_ug_level');
        $data['faculty'] = $this->utilities->findAllByAttribute("faculty", array("ADMINISTRATION" => 1));
        $data['department'] = $this->utilities->getAll('department');
        $data['mobiles'] = $this->utilities->findAllByAttribute('hr_emp_cinfo', array('EMP_ID' => $USER_ID));
        $data['user_group'] = $this->utilities->findAllByAttribute('sa_user_group', array('ORG_ID' => $session_info['ORG_ID']));
        $data['section'] = $this->utilities->findAllByAttribute('sa_org_sections', array('ORG_ID' => $session_info['ORG_ID']));
        $data['designations'] = $this->utilities->findAllByAttribute('designations', array('ORG_ID' => $session_info['ORG_ID']));
        $data['content_view_page'] = 'admin/edit_user';
        $this->admin_template->display($data);
    }

    /**
     * @methodName  updateUser()
     * @access
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      update user information
     */
    function updateUser()
    {
//        $files = $_FILES;
//         print_r();exit;
        $file_name = "";
        if (!empty($_FILES)) {
            $this->load->library('upload');
            $this->load->helper('string');
            $config['upload_path'] = 'upload/';
//$config['allowed_types'] = '*';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['overwrite'] = false;
            $config['remove_spaces'] = true;
//$config['max_size']	= '100';// in KB
            $this->upload->initialize($config);
            if ($this->upload->do_upload('photo')) {
                $file_data = $this->upload->data();
                $file_name = $file_data['file_name'];
//$this->utilities->insertData($data, 'profile_picture');
            }
        }
        $update_data = array(
            'FIRST_NAME' => $this->input->post('FIRST_NAME'),
            'MIDDLE_NAME' => $this->input->post('MIDDLE_NAME'),
            'LAST_NAME' => $this->input->post('LAST_NAME'),
            'FULL_NAME' => $this->input->post('FIRST_NAME') . ' ' . $this->input->post('MIDDLE_NAME') . ' ' . $this->input->post('LAST_NAME'),
            'EMAIL' => $this->input->post('EMAIL'),
            'ALT_EMAIL' => $this->input->post('ALT_EMAIL'),
            'NID' => $this->input->post('NID'),
            'DOB' => date('Y-m-d', strtotime($this->input->post('DOB'))),
            'AGE' => $this->input->post('AGE'),
            'BLOOD_GROUP' => $this->input->post('BLOOD_GROUP'),
            'HEIGHT_FEET' => $this->input->post('HEIGHT_FEET'),
            'HEIGHT_CM' => $this->input->post('HEIGHT_CM'),
            'WEIGHT_KG' => $this->input->post('WEIGHT_KG'),
            'WEIGHT_LBS' => $this->input->post('WEIGHT_LBS'),
            'GENDER' => $this->input->post('GENDER'),
            'RELIGION' => $this->input->post('RELIGION'),
            'NATIONALITY' => $this->input->post('NATIONALITY'),
            'HIRE_DATE' => date('Y-m-d', strtotime($this->input->post('HIRE_DATE'))),
            'FATHERS_NAME' => $this->input->post('FATHERS_NAME'),
            'MOTHERS_NAME' => $this->input->post('MOTHERS_NAME'),
            'HOME_PHONE' => $this->input->post('HOME_PHONE'),
            'MOBILE' => $this->input->post('MOBILE'),
            'MARITAL_STATUS' => ((isset($_POST['MARITAL_STATUS'])) ? 1 : 0),
            'SPOUSE_NAME' => $this->input->post('SPOUSE_NAME'),
            'PLACE_OF_BIRTH' => $this->input->post('PLACE_OF_BIRTH'),
            'PASSPORT_NO' => $this->input->post('PASSPORT_NO'),
            'DATE_OF_ISSUE' => date('Y-m-d', strtotime($this->input->post('DATE_OF_ISSUE'))),
            'EXPIRE_DATE' => date('Y-m-d', strtotime($this->input->post('EXPIRE_DATE'))),
            'PLACE_OF_ISSUE' => $this->input->post('PLACE_OF_ISSUE'),
            'PRE_ADDRESS' => $this->input->post('PRE_ADDRESS'),
            'PER_ADDRESS' => $this->input->post('PER_ADDRESS'),
            'CONTACT_PERSON' => $this->input->post('CONTACT_PERSON'),
            'CONTACT_PERSON_ADD' => $this->input->post('CONTACT_PERSON_ADD'),
            'CONTACT_PERSON_PHN' => $this->input->post('CONTACT_PERSON_PHN'),
            'RELATION' => $this->input->post('RELATION'),
            'USERGRP_ID' => $this->input->post('user_group'),
            'USERLVL_ID' => $this->input->post('user_group_lavel'),
            'FACULTY_ID' => $this->input->post('FACULTY_ID'),
            'DEPT_ID' => $this->input->post('DEPT_ID'),
            'DESIGNATION_ID' => $this->input->post('designation'),
            'BIOMETRIC_ID' => $this->input->post('BIOMETRIC_ID'),
            'OFFICIAL_PHONE_NO' => $this->input->post('OFFICIAL_PHONE_NO'),
            'OFFICIAL_PHONE_EXTENSION' => $this->input->post('OFFICIAL_PHONE_EXTENSION'),
            'USERNAME' => $this->input->post('USERNAME'),
            'USERPW' => $this->input->post('USERPW')
            );
        if ($file_name != "") {
            $update_data["USER_IMG"] = $file_name;
        }

        $session_info = $this->session->userdata('logged_in');
        $ALT_MOBILE = $this->input->post('ALT_MOBILE');
        $EMP_CI_ID = $this->input->post('EMP_CI_ID');

        if ($ALT_MOBILE) {
            foreach ($ALT_MOBILE as $key => $value) {
                $update_mobile = array(
                    'CONTACT_INFO' => $ALT_MOBILE [$key],
                    'CONTACT_TYPE' => 'M',
                    'EMP_ID' => $this->input->post('USER_ID'),
                    'ORG_ID' => $session_info["ORG_ID"],
                    'DEFAULT_FG' => 1,
                    'ACTIVE_STATUS' => 1
                    );
                $this->utilities->updateData('hr_emp_cinfo', $update_mobile, array('EMP_CI_ID' => $EMP_CI_ID[$key]));
            }
        }

        $this->utilities->updateData('sa_users', $update_data, array('USER_ID' => $this->input->post('USER_ID')));
        $this->session->set_flashdata('Success', 'Congratulation ! User Information Updated Successfully.');
        redirect('admin/users', 'refresh');
    }

    /**
     * @methodName  sectionByGrId()
     * @access
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      user group wise section list
     */
    function sectionByOrgId()
    {
        $org_id = $_POST['org_id'];
        $data['section'] = $this->utilities->findAllByAttribute('sa_org_sections', array('ORG_ID' => $org_id));
        $this->load->view('admin/ajax_section_list', $data);
    }

    /**
     * @methodName  userLavelByGrId()
     * @access
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      user group wise lavel list
     */
    function userLavelByGrId()
    {
        $user_group_id = $_POST['user_group_id'];
        $data['user_group_lavel'] = $this->utilities->findAllByAttribute('sa_ug_level', array('USERGRP_ID' => $user_group_id));
        $this->load->view('admin/ajax_lavel_list', $data);
    }

    function userLavelByEmailId()
    {
        $empId = $_POST['EMP_ID'];
        $user_email_id = $this->db->query("SELECT EMAIL FROM hr_emp WHERE EMP_ID = $empId")->row();
        echo json_encode($user_email_id);
        //$this->pr($data['user_email_id']);
        //$this->load->view('admin/ajax_lavel_list', $data);
    }

    /**
     *
     *
     * /**
     * @methodName  departmentByFaculty()
     * @access
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      ajax department list by faculty ID
     */
    function departmentByFaculty()
    {
        $faculty_id = $_POST['faculty_id'];
        $data['department'] = $this->utilities->findAllByAttribute('department', array('FACULTY_ID' => $faculty_id));
        $this->load->view('admin/ajax_dep_list', $data);
    }

    /*
     * @methodName ajax_get_program()
     * @access none
     * @param  none
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */

    public function ajax_get_designaion()
    {
        $dept_id = $_POST['dept_id'];
        $query = $this->utilities->findAllByAttribute('designations', array("DEPT_NO" => $dept_id, "ACTIVE_STATUS" => 1));
        $returnVal = '<option value="">Select one</option>';
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value="' . $row->DESIGNATION_ID . '">' . $row->DESIGNATION . '</option>';
            }
        }
        echo $returnVal;
    }

    /**
     * @methodName  registration()
     * @access
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      exixting registrated student list
     */
    function registration()
    {
        $data['contentTitle'] = 'Existing Students';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Existing Student" => '#'
            );
        $data['registered_student'] = $this->utilities->getAll('regi_student');
        $data['content_view_page'] = 'admin/registered_student';
        $this->admin_template->display($data);
    }

    /**
     * @methodName  addRegStu()
     * @access
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      add registration student
     */
    function addRegStu()
    {
        $data['contentTitle'] = 'Add Students';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Add Student" => '#'
            );

        $data['content_view_page'] = 'admin/add_reg_stu';
        $this->admin_template->display($data);
    }

    /**
     * @methodName  applicantDetails()
     * @access
     * @param
     * @author      Sultan <sultan@atilimited.net>
     * @return      View the student's details
     */
    function applicantDetails()
    {
        $applicant_id = $this->input->post('param');
        $data['applicant'] = $this->db->query("SELECT a.*,
            (SELECT b.BLOODGROUP_NAME FROM sav_bloodgrp b WHERE b.BLOODGROUP_ID = a.BLOOD_GROUP)blood,
            (SELECT m.LKP_NAME FROM m00_lkpdata m WHERE m.LKP_ID = a.MARITAL_STATUS)marital,
            (SELECT n.nationality FROM country n WHERE n.id = a.NATIONALITY)nationality,
            (SELECT group_concat(c.CONTACTS) FROM stu_contractinfo c WHERE c.STUDENT_ID = a.STUDENT_ID)contact,
            (SELECT r.RELIGION_NAME FROM sav_religion r WHERE r.RELIGION_ID = a.RELIGION_ID)relegion FROM students_info a WHERE a.STUDENT_ID ='$applicant_id'")->result();
//echo "<pre>"; print_r($data['applicant']); exit; echo "</pre>";
        $data['course'] = $this->db->query("SELECT c.OFFERED_COURSE_ID,
            (SELECT s.SESSION_NAME FROM session_view s WHERE s.SESSION_ID = c.SESSION_ID)session,
            (SELECT sem.SEMESTER_NAME FROM sav_semester sem WHERE sem.SEMESTER_ID = c.SEMISTER_ID)semester
            FROM stu_courseinfo c WHERE c.STUDENT_ID = '$applicant_id'")->row();

        $data['courseList'] = $this->db->query("SELECT cl.COURSE_ID,
            (SELECT c.COURSE_TITLE FROM aca_course c WHERE c.COURSE_ID = cl.COURSE_ID)course,
            (SELECT cod.COURSE_CODE FROM aca_course cod WHERE cod.COURSE_ID = cl.COURSE_ID)course_code FROM stu_courseinfo cl WHERE cl.STUDENT_ID = '$applicant_id'")->result();

        $data['admission'] = $this->db->query("SELECT a.CREATE_DATE,
            (SELECT s.SESSION_NAME FROM session_view s WHERE s.SESSION_ID = a.SESSION_ID)session,
            (SELECT sem.SEMESTER_NAME FROM sav_semester sem WHERE sem.SEMESTER_ID = a.SEMISTER_ID)semester,
            (SELECT sem.SEMESTER_NAME FROM sav_semester sem WHERE sem.SEMESTER_ID = a.SEMISTER_ID)semester,
            (SELECT f.FACULTY_NAME FROM faculty f WHERE f.FACULTY_ID = a.FACULTY_ID)faculty,
            (SELECT p.PROGRAM_NAME FROM program p WHERE p.PROGRAM_ID = a.PROGRAM_ID)program,
            (SELECT d.DEPT_NAME FROM department d WHERE d.DEPT_ID = a.DEPT_ID)dept
            FROM stu_admissioninfo a WHERE a.STUDENT_ID = '$applicant_id'")->row();
        $data["contact"] = $this->utilities->findAllByAttribute('stu_contractinfo', array("STUDENT_ID" => $applicant_id, "CONTACT_TYPE" => 'M'));
        $data["email"] = $this->utilities->findAllByAttribute('stu_contractinfo', array("STUDENT_ID" => $applicant_id, "CONTACT_TYPE" => 'E'));
        $data["academic_info"] = $this->db->query("SELECT a.CREATE_DATE,
            (SELECT s.SESSION_NAME FROM session_view s WHERE s.SESSION_ID = a.SESSION_ID)session,
            (SELECT f.FACULTY_NAME FROM faculty f WHERE f.FACULTY_ID = a.FACULTY_ID)faculty,
            (SELECT d.DEPT_NAME FROM department d WHERE d.DEPT_ID = a.DEPT_ID)department,
            (SELECT p.PROGRAM_NAME FROM program p WHERE p.PROGRAM_ID = a.PROGRAM_ID)program,
            (SELECT sem.SEMESTER_NAME FROM sav_semester sem WHERE sem.SEMESTER_ID = a.SEMISTER_ID)semester FROM stu_admissioninfo a WHERE a.STUDENT_ID = '$applicant_id'")->row();

        $data["fathersInfo"] = $this->db->query("SELECT a.*, b.OCCUPATION_NAME
            FROM stu_parentinfo a
            LEFT JOIN sav_occupation b ON a.OCCUPATION = b.OCCUPATION_ID
            WHERE a.STUDENT_ID = $applicant_id AND a.PARENTS_TYPE = 'F'")->row();

        $data["motherInfo"] = $this->db->query("SELECT a.*, b.OCCUPATION_NAME
            FROM stu_parentinfo a
            LEFT JOIN sav_occupation b ON a.OCCUPATION = b.OCCUPATION_ID
            WHERE a.STUDENT_ID = $applicant_id AND a.PARENTS_TYPE = 'M'")->row();

        $data["father_contact"] = $this->utilities->findAllByAttribute('stu_pgscontract', array("STUDENT_ID" => $applicant_id, "PGSC_TYPE" => 'F', "CONTACT_TYPE" => 'M'));
        $data["father_email"] = $this->utilities->findAllByAttribute('stu_pgscontract', array("STUDENT_ID" => $applicant_id, "PGSC_TYPE" => 'F', "CONTACT_TYPE" => 'E'));

        $data["mother_contact"] = $this->utilities->findAllByAttribute('stu_pgscontract', array("STUDENT_ID" => $applicant_id, "PGSC_TYPE" => 'M', "CONTACT_TYPE" => 'M'));
        $data["mother_email"] = $this->utilities->findAllByAttribute('stu_pgscontract', array("STUDENT_ID" => $applicant_id, "PGSC_TYPE" => 'M', "CONTACT_TYPE" => 'E'));

        $data["addrInfo"] = $this->db->query("SELECT a.STUDENT_ID, a.ADRESS_TYPE, a.SAS_PSORPR, a.HOUSE_NO_NAME, a.ROAD_AVENO_NAME, a.VILLAGE_WARD, a.DISTRICT_ID, a.DIVISION_ID, a.POLICE_STATION_ID, a.POST_OFFICE_ID, a.THANA_ID, a.UNION_ID,
            (SELECT b.DIVISION_ENAME FROM sa_divisions b WHERE b.DIVISION_ID = a.DIVISION_ID)DIVIS_NAME,
            (SELECT d.DISTRICT_ENAME FROM sa_districts d WHERE d.DISTRICT_ID = a.DISTRICT_ID)DIST_NAME,
            (SELECT p.PS_ENAME FROM sa_police_station p WHERE p.POLICE_STATION_ID = a.POLICE_STATION_ID)PLOSC,
            (SELECT po.POST_OFFICE_ENAME FROM sa_post_offices po WHERE po.POST_OFFICE_ID = a.POST_OFFICE_ID)POSTO,
            (SELECT t.THANA_ENAME FROM sa_thanas t WHERE t.THANA_ID = a.THANA_ID)thn,
            (SELECT u.UNION_NAME FROM sa_unions u WHERE u.UNION_ID = a.UNION_ID)uni FROM stu_adressinfo a WHERE a.STUDENT_ID = '$applicant_id' AND a.ADRESS_TYPE = 'PS'")->result();

        $data["parAddrInfo"] = $this->db->query("SELECT a.STUDENT_ID, a.ADRESS_TYPE, a.SAS_PSORPR, a.HOUSE_NO_NAME, a.ROAD_AVENO_NAME, a.VILLAGE_WARD, a.DISTRICT_ID, a.DIVISION_ID, a.POLICE_STATION_ID, a.POST_OFFICE_ID, a.THANA_ID, a.UNION_ID,
            (SELECT b.DIVISION_ENAME FROM sa_divisions b WHERE b.DIVISION_ID = a.DIVISION_ID)DIVIS_NAME,
            (SELECT d.DISTRICT_ENAME FROM sa_districts d WHERE d.DISTRICT_ID = a.DISTRICT_ID)DIST_NAME,
            (SELECT p.PS_ENAME FROM sa_police_station p WHERE p.POLICE_STATION_ID = a.POLICE_STATION_ID)PLOSC,
            (SELECT po.POST_OFFICE_ENAME FROM sa_post_offices po WHERE po.POST_OFFICE_ID = a.POST_OFFICE_ID)POSTO,
            (SELECT t.THANA_ENAME FROM sa_thanas t WHERE t.THANA_ID = a.THANA_ID)thn,
            (SELECT u.UNION_NAME FROM sa_unions u WHERE u.UNION_ID = a.UNION_ID)uni FROM stu_adressinfo a WHERE a.STUDENT_ID = '$applicant_id' AND a.ADRESS_TYPE != 'PS'")->row();


        $data['spouse'] = $this->db->query("SELECT s.SFULL_NAME,s.MARRIAGE_DT,s.EMAIL_ADRESS,
            (SELECT r.RELATION_NAME FROM sav_relation r WHERE r.RELATION_ID = s.RELATION_ID)relation FROM stu_spouseinfo s WHERE s.STUDENT_ID = '$applicant_id'")->row();

        $data['academic'] = $this->db->query("SELECT a.INSTITUTION, a.RESULT_GRADE, a.PASSING_YEAR, a.ACHIEVEMENT,
           (SELECT dg.EDUDEGREE_NAME FROM sav_edudegree dg WHERE dg.EDUDEGREE_ID = a.EXAM_DEGREE_ID )deg,
           (SELECT brd.UNIVERSITY_BOARD_NAME FROM sav_university_board brd WHERE brd.UNIVERSITY_BOARD_ID = a.BOARD )board,
           (SELECT mg.EDUCATION_GROUP_NAME FROM sav_education_group mg WHERE mg.EDUCATION_GROUP_ID = a.MAJOR_GROUP_ID )grp FROM stu_acadimicinfo a WHERE a.STUDENT_ID = '$applicant_id' ")->result();

        $data['medical'] = $this->db->query("SELECT m.CURRENTLY_USED, m.PREVIOUSLY_USED, m.TYPE_AMOUNT_FREQUENCY, m.DURATION, m.STOP_DT,
            (SELECT s.SUBSTANCES_NAME FROM sav_substances s WHERE s.SUBSTANCES_ID = m.SUBSTANCE)substances FROM stu_medicalinfo m WHERE m.STUDENT_ID = '$applicant_id'")->result();

        $data['disease'] = $this->db->query("SELECT d.DISEASE_NAME, d.START_DT, d.END_DT, d.DOCTOR_NAME FROM stu_diseaseinfo d WHERE d.STUDENT_ID = '$applicant_id'")->result();


        $data['waiver'] = $this->db->query("SELECT w.* FROM stu_weaverinfo w WHERE w.STUDENT_ID = '$applicant_id'")->row();
        $data['sibling'] = $this->db->query("SELECT s.SBLN_ROLL_NO as rr FROM stu_siblings s WHERE s.STUDENT_ID = '$applicant_id'")->row();
//echo "<pre>";print_r($data);exit;
        $this->load->view('admin/applicant/applicant_info', $data);
    }

    function applicanStuUpdate()
    {
        $applicant_id = $this->input->post('param');
        $data["ac_type"] = 2; //for update info
        $data['applicant'] = $this->utilities->findByAttribute('students_info', array("STUDENT_ID" => $applicant_id)); // select all data from  student inforamtion
        $this->load->view('admin/admission/registration', $data);
    }

    /**
     * @methodName  applicants()
     * @access
     * @param
     * @author      Sultan <sultan@atilimited.net>
     * @author      Emdadul <Emdadul@atilimited.net>
     * @return      Student List accourding to search result
     */
    function applicants()
    {
        $data['contentTitle'] = 'Student List';
        $data['breadcrumbs'] = array(
            'Admin' => 'admin/index',
            'Applicant List' => '#'
            );
        $data["previlages"] = $this->checkPrevilege();
        $data['dimention'] = "horizental";
        $data['ac_type'] = '';
        $data['faculty'] = $this->utilities->findAllByAttribute('faculty', array("ACTIVE_STATUS" => 1, "ADMINISTRATION" => 0));
        $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
        $data["session"] = $this->utilities->getAll("session_view");
        $data['applicant'] = $this->db->query("select a.*,c.FACULTY_NAME,d.DEPT_NAME,e.PROGRAM_NAME,f.SESSION_NAME,g.LKP_NAME from students_info a
            left join stu_semesterinfo b on a.STUDENT_ID = b.STUDENT_ID
            left join faculty c on b.FACULTY_ID = c.FACULTY_ID
            left join department d on b.DEPT_ID=d.DEPT_ID
            left join program e on b.PROGRAM_ID = e.PROGRAM_ID
            left join session_view f on b.SEM_SESSION=f.SESSION_ID
            left join m00_lkpdata g on b.SEMESTER_ID=g.LKP_ID")->result();
        $data['content_view_page'] = 'admin/applicant/index';
        $this->admin_template->display($data);
    }

    /**
     * @methodName  semRegPayment()
     * @access
     * @param
     * @author      Emdadul Huq <emdadul@atilimited.net>
     * @return      Student List accourding to search result
     */
    function semRegPayment()
    {
        $data['contentTitle'] = 'Applicant List';
        $data['breadcrumbs'] = array(
            'Admin' => 'admin/index',
            'Applicant List' => '#'
            );
        $data["previlages"] = $this->checkPrevilege();
        $data['dimention'] = "horizental";
        $data['ac_type'] = '';
        $data['courses_offer_list'] = $this->utilities->findAllByAttributeFromCourseOffer(); // select all data from  course_offer with department and program, course, semester inforamtion
        $data['faculty'] = $this->utilities->findAllByAttribute('faculty', array("ACTIVE_STATUS" => 1, "ADMINISTRATION" => 0));
        $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
        $data['session'] = $this->utilities->getAll('session_view');
        $data['applicant'] = $this->db->query("SELECT si.ROLL_NO,
         si.FULL_NAME_EN,
         s.SESSION_NAME,
         ys.YEAR_SETUP_TITLE,
         cr.CRS_REQ_ID,
         cr.STUDENT_ID,
         cr.FACULTY_ID,
         cr.DEPT_ID,
         cr.PROGRAM_ID,
         cr.SESSION_ID,
         cr.SEMESTER_ID,
         cr.COURSE_ID,
         cr.IS_CURRENT,
         cr.ACTIVE_STATUS,
         (SELECT p.PROGRAM_NAME FROM program p WHERE p.PROGRAM_ID = cr.PROGRAM_ID)PROGRAM_NAME,
         (SELECT ss.LKP_NAME FROM m00_lkpdata ss WHERE ss.LKP_ID = cr.SEMESTER_ID)LKP_NAME,
         (SELECT f.FACULTY_NAME FROM faculty f WHERE f.FACULTY_ID = cr.FACULTY_ID)FACULTY_NAME,
         (SELECT d.DEPT_NAME FROM department d WHERE d.DEPT_ID = cr.DEPT_ID)DEPT_NAME
         FROM reg_stu_crs_request cr
         INNER JOIN session_year sy ON sy.SES_YEAR_ID = cr.SESSION_ID
         INNER JOIN SESSION s ON s.SESSION_ID = sy.SESSION
         INNER JOIN year_setup ys ON ys.YEAR_SETUP_ID = sy.YEAR_SETUP_ID
         INNER JOIN students_info si ON si.STUDENT_ID = cr.STUDENT_ID
         WHERE cr.STUDENT_ID NOT IN
         (SELECT v.STUDENT_ID FROM bm_vouchermst v INNER JOIN bm_vn_ledgers vl ON v.VOUCHER_NO = vl.VOUCHER_NO
         WHERE cr.STUDENT_ID = v.STUDENT_ID
         AND vl.TRX_CODE_NO = 'PM'
         AND v.FACULTY_ID = cr.FACULTY_ID
         AND v.DEPT_ID = cr.DEPT_ID
         AND v.PROGRAM_ID = cr.PROGRAM_ID
         AND v.SESSION_ID = cr.SESSION_ID
         AND v.SEMESTER_ID = cr.SEMESTER_ID)
         AND cr.IS_CURRENT = 1
         AND cr.ACTIVE_STATUS = 1
         GROUP BY cr.STUDENT_ID,cr.SEMESTER_ID")->result();
        $data['content_view_page'] = 'admin/applicant/index';
        $this->admin_template->display($data);
    }

    /**
     * @methodName  searchApplican()
     * @access
     * @param
     * @author      Sultan <sultan@atilimited.net>
     * @return      Student List accourding to search result
     */
    function searchApplicant()
    {
        $faculty = $this->input->post('faculty');
        $department = $this->input->post('department');
        $program = $this->input->post('program');
        $semester = $this->input->post('semester');
        $session = $this->input->post('session');
        $faculty_id = '';
        $department_id = '';
        $program_id = '';
        $semester_id = '';
        $session_id = '';

        if ($faculty != '') {
            $faculty_id = $faculty;
        }
        if ($department != '') {
            $department_id = "AND  b.DEPT_ID =$department";
        }
        if ($program != '') {
            $program_id = "AND  b.PROGRAM_ID =$program";
        }
        if ($semester != '') {
            $semester_id = "AND b.SEMESTER_ID =$semester";
        }
        if ($session != '') {
            $session_id = "AND b.SEM_SESSION =$session";
        }
        $data['applicant'] = $this->db->query("select a.*,c.FACULTY_NAME,d.DEPT_NAME,e.PROGRAM_NAME,f.SESSION_NAME,g.LKP_NAME from students_info a
            left join stu_semesterinfo b on a.STUDENT_ID = b.STUDENT_ID
            left join faculty c on b.FACULTY_ID = c.FACULTY_ID
            left join department d on b.DEPT_ID=d.DEPT_ID
            left join program e on b.PROGRAM_ID = e.PROGRAM_ID
            left join session_view f on b.SEM_SESSION=f.SESSION_ID
            left join m00_lkpdata g on b.SEMESTER_ID=g.LKP_ID
            where
            b.FACULTY_ID=$faculty $department_id $program_id $semester_id $session_id

            ")->result();
        $this->load->view('admin/applicant/applicant_list', $data);
    }

    /**
     * @methodName  semesterUpgrade()
     * @access
     * @param
     * @author      Emdadul <Emdadul@atilimited.net>
     * @return      Student List accourding to search result
     */
    function semesterUpgrade()
    {
        $data['contentTitle'] = 'Student List';
        $data['breadcrumbs'] = array(
            'Admin' => 'admin/semester upgrade',
            'Student List' => '#'
            );
        $data["previlages"] = $this->checkPrevilege();
        $data['dimention'] = "horizental";
        $data['ac_type'] = '';
        $data['courses_offer_list'] = $this->utilities->findAllByAttributeFromCourseOffer(); // select all data from  course_offer with department and program, course, semester inforamtion
        $data['faculty'] = $this->utilities->findAllByAttribute('faculty', array("ACTIVE_STATUS" => 1, "ADMINISTRATION" => 0));
        $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
        $data["session"] = $this->db->query("SELECT sy.SES_YEAR_ID, s.SESSION_NAME, ys.YEAR_SETUP_TITLE
            FROM session_year sy
            LEFT JOIN session s on s.SESSION_ID = sy.SESSION
            LEFT JOIN year_setup ys on ys.YEAR_SETUP_ID = sy.YEAR_SETUP_ID")->result();
        $data['courses_offer_list'] = $this->utilities->findAllByAttributeFromCourseOffer(); // select all data from  course_offer with department and program, course, semester inforamtion
        $data['applicant'] = $this->db->query("SELECT bv.*, bl.*, s.SESSION_NAME, ys.YEAR_SETUP_TITLE, si.FULL_NAME_EN , d.FACULTY_NAME, e.DEPT_NAME, ml.LKP_NAME, f.PROGRAM_NAME
            FROM bm_vouchermst bv
            INNER JOIN students_info si on bv.STUDENT_ID = si.STUDENT_ID
            INNER JOIN stu_semesterinfo ss on (ss.STUDENT_ID = bv.STUDENT_ID AND ss.SEMESTER_ID = bv.SEMESTER_ID)
            INNER JOIN bm_vn_ledgers bl on bl.VOUCHER_NO = bv.VOUCHER_NO
            INNER JOIN faculty d ON bv.FACULTY_ID = d.FACULTY_ID
            INNER JOIN department e ON bv.DEPT_ID = e.DEPT_ID
            INNER JOIN program f ON bv.PROGRAM_ID = f.PROGRAM_ID
            INNER JOIN m00_lkpdata ml ON bv.SEMESTER_ID = ml.LKP_ID
            INNER JOIN session_year sy on sy.SES_YEAR_ID = bv.SESSION_ID
            INNER JOIN session s on s.SESSION_ID = sy.SESSION
            INNER JOIN year_setup ys on ys.YEAR_SETUP_ID = sy.YEAR_SETUP_ID
            WHERE bl.TRX_CODE_NO = 'PM' AND ss.IS_CURRENT = 1
            GROUP BY bv.STUDENT_ID ")->result();

        $data['content_view_page'] = 'admin/semester_upgrade/index';
        $this->admin_template->display($data);
    }

    /**
     * @access
     * @param       studentId
     * @author      Emdadul <emdadul@atilimited.net>
     * @return      FACULTY_ID, DEPT_ID, PROGRAM_ID, SEMESTER_ID, SESSION_ID
     */
    function searchCurrentPaidStudent()
    {
        $FACULTY_ID = $this->input->post("FACULTY_ID");
        $DEPT_ID = $this->input->post("DEPT_ID");
        $PROGRAM_ID = $this->input->post("PROGRAM_ID");
        $SEMESTER_ID = $this->input->post("SEMESTER_ID");
        $SESSION_ID = $this->input->post("SESSION_ID");
        $data['applicant'] = $this->db->query("SELECT bv.*, bl.*, s.SESSION_NAME, ys.YEAR_SETUP_TITLE, si.FULL_NAME_EN , d.FACULTY_NAME, e.DEPT_NAME, ml.LKP_NAME, f.PROGRAM_NAME
            FROM bm_vouchermst bv
            INNER JOIN students_info si on bv.STUDENT_ID = si.STUDENT_ID
            INNER JOIN stu_semesterinfo ss on (ss.STUDENT_ID = bv.STUDENT_ID AND ss.SEMESTER_ID = bv.SEMESTER_ID)
            INNER JOIN bm_vn_ledgers bl on bl.VOUCHER_NO = bv.VOUCHER_NO
            INNER JOIN faculty d ON bv.FACULTY_ID = d.FACULTY_ID
            INNER JOIN department e ON bv.DEPT_ID = e.DEPT_ID
            INNER JOIN program f ON bv.PROGRAM_ID = f.PROGRAM_ID
            INNER JOIN m00_lkpdata ml ON bv.SEMESTER_ID = ml.LKP_ID
            INNER JOIN session_year sy on sy.SES_YEAR_ID = bv.SESSION_ID
            INNER JOIN session s on s.SESSION_ID = sy.SESSION
            INNER JOIN year_setup ys on ys.YEAR_SETUP_ID = sy.YEAR_SETUP_ID
            WHERE bl.TRX_CODE_NO = 'PM' AND ss.IS_CURRENT = 1 AND ss.FACULTY_ID = $FACULTY_ID AND ss.DEPT_ID = $DEPT_ID AND ss.PROGRAM_ID = $PROGRAM_ID AND ss.SESSION_ID = $SESSION_ID AND ss.SEMESTER_ID = $SEMESTER_ID
            GROUP BY bv.STUDENT_ID ")->result();
        $this->load->view("admin/semester_upgrade/student_list", $data);
    }

    /**
     * @methodName  semesterUpgradeConfirm()
     * @access
     * @param       studentId
     * @author      Emdadul <emdadul@atilimited.net>
     * @return      none
     */
    function semesterUpgradeConfirm($studentId, $flag = '')
    {
        $previous_sem = 0;
        $sInfo = $this->db->query("SELECT * FROM stu_semesterinfo
            WHERE STUDENT_ID = $studentId AND IS_CURRENT = 1")->row();
        $semester = $this->db->query("SELECT * FROM m00_lkpdata WHERE GRP_ID =16")->result();
        $semesterId = array();
        foreach ($semester as $key => $sem) {
            array_push($semesterId, $sem->LKP_ID);
        }
        for ($i = 0; $i < count($semesterId); $i++) {
            if ($sInfo->SEMESTER_ID == $semesterId[$i]) {
                $previous_sem = $semesterId[$i - 1];
            }
        }
        $courseInfo = $this->db->query("SELECT acs.COURSE_ID, aco.OFFERED_COURSE_ID
            FROM aca_semester_course acs
            INNER JOIN aca_course_offer aco
            on (aco.COURSE_ID = acs.COURSE_ID)
            AND (aco.FACULTY_ID = acs.FACULTY_ID)
            AND (aco.DEPT_ID = acs.DEPT_ID)
            AND (aco.PROGRAM_ID = acs.PROGRAM_ID)
            WHERE aco.PROGRAM_ID = $sInfo->PROGRAM_ID AND acs.SESSION_ID = $sInfo->SESSION_ID AND acs.SEMESTER_ID = $sInfo->SEMESTER_ID AND aco.FACULTY_ID = $sInfo->FACULTY_ID AND aco.DEPT_ID = $sInfo->DEPT_ID
            ")->result();
        $success = 0;
        $check = 0;
        foreach ($courseInfo as $course) {
            $course_info_pk = $this->utilities->pk_f('stu_courseinfo');
            $courseInfo = array(
                'STU_CRS_ID' => $course_info_pk,
                'STUDENT_ID' => $sInfo->STUDENT_ID,
                'OFFERED_COURSE_ID' => $course->OFFERED_COURSE_ID,
                'SESSION_ID' => $sInfo->SESSION_ID,
                'SEMISTER_ID' => $sInfo->SEMESTER_ID,
                'FACULTY_ID' => $sInfo->FACULTY_ID,
                'DEPT_ID' => $sInfo->DEPT_ID,
                'PROGRAM_ID' => $sInfo->PROGRAM_ID,
                'COURSE_ID' => $course->COURSE_ID,
                'IS_CURRENT' => 1,
                'IS_DROPPED' => 0,
                'ACTIVE_STATUS' => $sInfo->CREATED_BY,
                'CREATED_BY' => $sInfo->CREATED_BY
                );
            $check = $this->utilities->hasInformationByThisId("stu_courseinfo",
                array('STUDENT_ID' => $sInfo->STUDENT_ID,
                    'OFFERED_COURSE_ID' => $course->OFFERED_COURSE_ID,
                    'SESSION_ID' => $sInfo->SESSION_ID,
                    'SEMISTER_ID' => $sInfo->SEMESTER_ID,
                    'FACULTY_ID' => $sInfo->FACULTY_ID,
                    'DEPT_ID' => $sInfo->DEPT_ID,
                    'PROGRAM_ID' => $sInfo->PROGRAM_ID,
                    'COURSE_ID' => $course->COURSE_ID,
                    'IS_CURRENT' => 1));
            if (empty($check)) {// if Program name available
                if ($this->utilities->insertData($courseInfo, 'stu_courseinfo')) { // if data inserted successfully
                    $success = 1;
                }
            }
        }
        if ($success == 1) { /* if stu_courseinfo inserted successfully upgrade privious course is_current = 0 */
            $preCourse = $this->db->query("SELECT acs.COURSE_ID
                FROM stu_courseinfo acs
                WHERE acs.STUDENT_ID = $sInfo->STUDENT_ID AND acs.PROGRAM_ID = $sInfo->PROGRAM_ID AND acs.SESSION_ID = $sInfo->SESSION_ID AND acs.SEMISTER_ID = $previous_sem")->result();
            $courseUp = array(
                'IS_CURRENT' => 0,
                'UPDATED_BY' => $sInfo->CREATED_BY
                );
            $update = 0;
            foreach ($preCourse as $preC) {
                $update = $this->utilities->updateData('stu_courseinfo', $courseUp, array('STUDENT_ID' => $sInfo->STUDENT_ID, 'SESSION_ID' => $sInfo->SESSION_ID, 'SEMISTER_ID' => $previous_sem, 'PROGRAM_ID' => $sInfo->PROGRAM_ID, 'COURSE_ID' => $preC->COURSE_ID));
            }
            if ($update) {
                $this->utilities->updateData('stu_semesterinfo', $courseUp, array('STUDENT_ID' => $sInfo->STUDENT_ID, 'SESSION_ID' => $sInfo->SESSION_ID, 'SEMESTER_ID' => $previous_sem, 'PROGRAM_ID' => $sInfo->PROGRAM_ID));
                if ($flag == '') {
                    echo "<div class='alert alert-success'>Upgrade successfully</div>";
                } else {
                    return 1;
                }
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Upgrade failed</div>";
            }
        } else {
            if ($flag == '') {
                if ($check == 0) {
                    echo "<div class='alert alert-danger'>Already Upgrade !!</div>";
                }
            } else {
                if ($check == 0) {
                    return 2;
                }
            }
        }
        /*$semester_info_pk = $this->utilities->pk_f('stu_semesterinfo');
        $semesterInfo = array(
            'S_SEMESTER_ID' => $semester_info_pk,
            'STUDENT_ID' => $sInfo->STUDENT_ID,
            'FACULTY_ID' => $sInfo->FACULTY_ID,
            'DEPT_ID' => $sInfo->DEPT_ID,
            'PROGRAM_ID' => $sInfo->PROGRAM_ID,
            'SESSION_ID' => $sInfo->SESSION_ID,
            'SEMESTER_ID' => $current_sem,
            'IS_CURRENT' => $sInfo->IS_CURRENT,
            'CREATED_BY' => $sInfo->CREATED_BY
        );
        if ($this->utilities->insertData($semesterInfo, 'stu_semesterinfo')) {
             if stu_semesterinfo inserted successfully then upgrade privious semester id is_current = 0
            $semUp = array(
                'IS_CURRENT' => 0,
                'UPDATED_BY' => $sInfo->CREATED_BY
            );
            $this->utilities->updateData('stu_semesterinfo', $semUp, array('STUDENT_ID' => $sInfo->STUDENT_ID, 'SEMESTER_ID' => $sInfo->SEMESTER_ID, 'PROGRAM_ID' => $sInfo->PROGRAM_ID));
            echo "<div class='alert alert-success'>Data add successfully</div>";
        } else { // if data inserted failed
            echo "<div class='alert alert-danger'>Data insert failed</div>";
        }*/
    }

    /**
     * @methodName  semesterUpgradeConfirm()
     * @access
     * @param       studentId
     * @author      Emdadul <emdadul@atilimited.net>
     * @return      none
     */
    function semesterUpgradeAll()
    {

        $students = $this->input->post('chkStudent');
        $upgrade = 0;
        for ($i = 0; $i < sizeof($students); $i++) {
            $Upgrade = $this->semesterUpgradeConfirm($students[$i], "All"); /* Recursive function From semesterUpgradeConfirm untile last student */
        }
        if ($Upgrade == 1) {
            echo "&nbsp;&nbsp;<span class='btn btn-outline btn-success btn-sm'>Upgrade successfully &nbsp;<span class='text-primary'> <i class='fa fa-check'></i></span></span>";
        } else {
            echo "&nbsp;&nbsp;<span class='btn btn-outline btn-danger btn-sm'>Already Exited&nbsp;<span class='text-primary'> <i class='fa fa-check'></i></span></span>";
        }
    }

    /**
     * @methodName  searchCurrentStudent()
     * @access
     * @param
     * @author      Emdadul <emdadul@atilimited.net>
     * @return      none
     */
    function searchCurrentStudent()
    {
        $faculty = $this->input->post('faculty');
        $department = $this->input->post('department');
        $program = $this->input->post('program');
        $semester = $this->input->post('semester');
        $session = $this->input->post('session');

        $faculty_id = '';
        $department_id = '';
        $program_id = '';
        $semester_id = '';
        $session_id = '';

        if ($faculty != '') {
            $faculty_id = $faculty;
        }
        if ($department != '') {
            $department_id = "AND  bv.DEPT_ID =$department";
        }
        if ($program != '') {
            $program_id = "AND  bv.PROGRAM_ID =$program";
        }
        if ($semester != '') {
            $semester_id = "AND bv.SEMESTER_ID =$semester";
        }
        if ($session != '') {
            $session_id = "AND bv.SESSION_ID =$session";
        }
        $data['applicant'] = $this->db->query("SELECT bv.*, bl.*, si.FULL_NAME_EN , f.FACULTY_NAME, d.DEPT_NAME, ml.LKP_NAME, p.PROGRAM_NAME
            FROM bm_vouchermst bv
            INNER JOIN students_info si on bv.STUDENT_ID = si.STUDENT_ID
            INNER JOIN stu_semesterinfo ss on (ss.STUDENT_ID = bv.STUDENT_ID AND ss.SEMESTER_ID = bv.SEMESTER_ID)
            INNER JOIN bm_vn_ledgers bl on bl.VOUCHER_NO = bv.VOUCHER_NO
            INNER JOIN faculty f ON bv.FACULTY_ID = f.FACULTY_ID
            INNER JOIN department d ON bv.DEPT_ID = d.DEPT_ID
            INNER JOIN program p ON bv.PROGRAM_ID = p.PROGRAM_ID
            INNER JOIN m00_lkpdata ml ON bv.SEMESTER_ID = ml.LKP_ID
            where f.FACULTY_ID = $faculty_id  $department_id $program_id $semester_id $session_id AND bl.TRX_CODE_NO = 'PM' AND ss.IS_CURRENT = 1
            ")->result();
        $this->load->view('admin/semester_upgrade/student_semester_list', $data);
    }

    /**
     * @methodName  calender()
     * @access
     * @param
     * @author      Sultan Ahmmed <sultan@atilimited.net>
     * @return      Calender Task Schedule
     */
    function calendar()
    {
        $data['contentTitle'] = 'Academic Calendar';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Academic Calendar" => '#'
            );
        //$data['month'] = $this->utilities->getAllSpecific('event'); // Get all event Whith specific data
        $data['event'] = $this->utilities->getAll('event'); // Get all event data
        $data['firstDay'] = $this->db->query("select LKP_NAME from m00_lkpdata where GRP_ID=64")->row(); // Get first data from m00_lkdata
        $data['content_view_page'] = 'admin/calendar/index';
        $this->admin_template->display($data);
    }

    /**
     * @methodName  calendarEvents()
     * @access
     * @param
     * @author      Sultan Ahmmed <sultan@atilimited.net>
     * @return      Calender Task Schedule
     */
    function calendarEvents()
    {
        $events = $this->utilities->findAllFromView('event'); // select all data from event where event type id

        $returnArray = array();
        foreach ($events as $event_slot) {

            if ($event_slot->ACTIVE_STATUS == 1) {
                $color = '#1AB394';
            } else {
                $color = '#D9EDF7';
            }
            $returnArray[] = array(
                'id' => $event_slot->EVENT_ID,
                'title' => $event_slot->E_TITLE,
                'start' => date('Y-m-d', strtotime($event_slot->START_DT)) . " " . $event_slot->START_TIME,
                'end' => date('Y-m-d', strtotime($event_slot->END_DT)) . " " . $event_slot->END_TIME,
                //'color' => 'rgba(116,166,117,.7)',
//'patient_id' => $event_slot->HN_NO,
                'color' => $color,
                'allDay' => false
                );
        }

        echo json_encode($returnArray);
    }

    /**
     * @methodName  addEventFormInsert()
     * @access
     * @param
     * @author      Sultan Ahmmed <sultan@atilimited.net>
     * @return      View Event Create Form
     */
    function addEventFormInsert()
    {
        $data["ac_type"] = 1;
        $this->load->view('admin/calendar/add_event', $data);
    }

    /**
     * @methodName  createEvent()
     * @access
     * @param
     * @author      Sultan Ahmmed <sultan@atilimited.net>
     * @return      Insert Event date
     */
    function createEvent()
    {
        $event = $this->input->post('eventName'); //Event Name
        $status = $this->input->post('status'); //Active Status

        $event = array(
            'EVENT_TITLE' => $event,
            'ACTIVE_STATUS' => $status
            );

        if ($this->utilities->insertData($event, 'event')) { // if data inserted successfully
            echo "<div class='alert alert-success'>Event Create successfully</div>";
        } else { // if data inserted failed
            echo "<div class='alert alert-danger'>Event insert failed</div>";
        }
    }

    /**
     * @methodName  courseContent()
     * @access
     * @param
     * @author      Rakib <rakib@atilimited.net>
     * @return      Content list
     */
    function courseContent()
    {
        $data['contentTitle'] = 'Course Content List';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Course Content" => '#'
            );
        $data['pageTitle'] = 'Course Content';
        $data['course_content'] = $this->db->query("select a.*, b.CONT_TYPE as CONT_TYPE  FROM aca_crs_content a
            left join aca_crs_content_type b on a.CONT_TYPE_ID = b.CONT_TYPE_ID")->result();
        $data['faculty'] = $this->utilities->getAll('faculty');
        $data['session'] = $this->utilities->getAll('session');
        $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));

        $data['content_list'] = $this->db->query("select a.*, b.CONT_TYPE as CONT_TYPE  FROM aca_crs_content a
            left join aca_crs_content_type b on a.CONT_TYPE_ID = b.CONT_TYPE_ID")->result();
        $data['content_view_page'] = 'admin/course/course_note';
        $this->admin_template->display($data);
    }

    /**
     * @methodName  addCourseNote()
     * @access
     * @param
     * @author      Rakib <rakib@atilimited.net>
     * @return      Content list
     */
    function addCourseContent()
    {


        $data['pageTitle'] = 'Add Content';
        $data['breadcrumbs'] = array(
            'Create Course Content' => '#',
            );
        $data['content_type'] = $this->db->query("select * from aca_crs_content_type")->result();
        $data['content_view_page'] = 'admin/course/add_course_note';
        $this->admin_template->display($data);
    }

    function courseContentList()
    {
        $data["previlages"] = $this->checkPrevilege("admin/courseContent");
        $data['course_content'] = $this->db->query("select a.*, b.CONT_TYPE as CONT_TYPE  FROM aca_crs_content a
            left join aca_crs_content_type b on a.CONT_TYPE_ID = b.CONT_TYPE_ID")->result();

        $this->load->view("admin/course/course_note_list", $data);
    }

    /**
     * @methodName  createCourseNote()
     * @access
     * @param
     * @author      Rakib <rakib@atilimited.net>
     * @return      Insert course content
     */
    function createCourseContent()
    {
        $file_name = "";

        if (!empty($_FILES)) {
            $this->load->library('upload');
            $this->load->helper('string');
            $config['upload_path'] = 'upload/course_content/';
            $config['allowed_types'] = '*';
            //$config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['overwrite'] = false;
            $config['remove_spaces'] = true;
            //$config['max_size']	= '100';// in KB
            $this->upload->initialize($config);
            if ($this->upload->do_upload('course_content')) {
                $file_data = $this->upload->data();
                $file_name = $file_data['file_name'];
                //$this->utilities->insertData($data, 'profile_picture');
            }
        }
        $CONT_TYPE_ID = $this->input->post('CONT_TYPE_ID');
        $CONTENT_TITLE = $this->input->post('CONTENT_TITLE');
        $status = $this->input->post('status'); // active status
        $course_content = array(
            'CONT_TYPE_ID' => $CONT_TYPE_ID,
            'CONTENT_TITLE' => $CONTENT_TITLE,
            'CONTENT_URI' => $file_name,
            'ACTIVE_STATUS' => $status
            );

        if ($this->utilities->insertData($course_content, 'aca_crs_content')) { // if data inserted successfully
            $this->session->set_flashdata('Success', 'Course Contetn insert suceessfully !');
            redirect('admin/addCourseContent', 'refresh');
        }
    }

    /**
     * @methodName  editCourseContent()
     * @access
     * @param
     * @author      Rakib <rakib@atilimited.net>
     * @return      Edit course content
     */
    function editCourseContent($id)
    {

        $data['pageTitle'] = 'Edit Content';
        $data['breadcrumbs'] = array(
            'Edit Course Content' => '#',
            );
        $data['content_type'] = $this->db->query("select * from aca_crs_content_type")->result();
        $data['previous_info'] = $this->utilities->findByAttribute('aca_crs_content', array('C_CONTENT_ID' => $id));
        $data['content_view_page'] = 'admin/course/edit_course_note';
        $this->admin_template->display($data);
    }

    /**
     * @methodName  updateCourseContent()
     * @access
     * @param
     * @author      Rakib <rakib@atilimited.net>
     * @return      Insert course content
     */
    function updateCourseContent()
    {
        $file_name = "";

        if (!empty($_FILES)) {
            $this->load->library('upload');
            $this->load->helper('string');
            $config['upload_path'] = 'upload/course_content/';
            $config['allowed_types'] = '*';
            //$config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['overwrite'] = false;
            $config['remove_spaces'] = true;
            //$config['max_size']	= '100';// in KB
            $this->upload->initialize($config);
            if ($this->upload->do_upload('course_content')) {
                $file_data = $this->upload->data();
                $file_name = $file_data['file_name'];
                //$this->utilities->insertData($data, 'profile_picture');
            }
        }

        $CONT_TYPE_ID = $this->input->post('CONT_TYPE_ID');
        $CONTENT_TITLE = $this->input->post('CONTENT_TITLE');
        $status = $this->input->post('status'); // active status
        $update_course_content = array(
            'CONT_TYPE_ID' => $CONT_TYPE_ID,
            'CONTENT_TITLE' => $CONTENT_TITLE,
            'ACTIVE_STATUS' => $status
            );
        if ($file_name != "") {
            $update_course_content["CONTENT_URI"] = $file_name;
        }

        if ($this->utilities->updateData('aca_crs_content', $update_course_content, array('C_CONTENT_ID' => $this->input->post('C_CONTENT_ID')))) { // if data inserted successfully
            $this->session->set_flashdata('Info', 'Course Contetn Updated suceessfully !');
            redirect('admin/editCourseContent/' . $this->input->post('C_CONTENT_ID'), 'refresh');
        }
    }

    /**
     * @methodName  contentDistribution()
     * @access
     * @param
     * @author      Rakib <rakib@atilimited.net>
     * @return      Content distribution list
     */
    function contentDistrubution()
    {
        $data['contentTitle'] = 'Content Distribution';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Content List" => '#'
            );
        $data['pageTitle'] = 'Content Distribution List';


        $data['con_dis_list'] = $this->db->query("select a.*,b.CONTENT_TITLE,b.CONTENT_URI,c.PROGRAM_NAME,d.SESSION_NAME,e.LKP_NAME as SEMESTER,f.COURSE_TITLE,f.COURSE_CODE from aca_crs_content_distribution a
            left join aca_crs_content b on a.C_CONTENT_ID=b.C_CONTENT_ID
            left join program c on a.PROGRAM_ID = c.PROGRAM_ID
            left join session d on a.SESSION_ID = d.SESSION_ID
            left join m00_lkpdata e on a.SEMESTER_ID=e.LKP_ID
            left join aca_course f on a.COURSE_ID = f.COURSE_ID")->result();
        $data['content_view_page'] = 'admin/course/content_dis_list';
        $this->admin_template->display($data);
    }

    /**
     * @methodName  addConDis()
     * @access
     * @param
     * @author      Rakib <rakib@atilimited.net>
     * @return      Content distribution list
     */
    function addConDis()
    {

        $data['corConId'] = $this->input->post('corConId');
        $data['faculty'] = $this->utilities->getAll('faculty');
        $data['session'] = $this->utilities->getAll('session');
        $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
        $this->load->view('admin/course/add_dis_con', $data);
    }

    /**
     * @methodName  programByDepartment()
     * @access public
     * @param
     * @author   Rakib Roni <rakib@atilimited.net>
     * @return      ajax program list by department ID
     */
    public function programByDepartment()
    {
        $department_id = $_POST['department_id'];
        $query = $this->utilities->findAllByAttribute('program', array("DEPT_ID" => $department_id, "ACTIVE_STATUS" => 1));
        $returnVal = '<option value = "">Select one</option>';
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value = "' . $row->PROGRAM_ID . '">' . $row->PROGRAM_NAME . '</option>';
            }
        }
        echo $returnVal;
    }

    /**
     * @methodName  saveConDis()
     * @access      public
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return
     */
    public function saveConDis()
    {
        $C_CONTENT_ID = $this->input->post('CONTENT_ID');


        if (isset($C_CONTENT_ID)) {
            foreach ($C_CONTENT_ID as $key => $value) {
                $dis_content = array(
                    'C_CONTENT_ID' => $C_CONTENT_ID[$key],
                    'USER_ID' => 1,
                    'FACULTY_ID' => $this->input->post('FACULTY_ID'),
                    'DEPT_ID' => $this->input->post('DEPARTMENT_ID'),
                    'PROGRAM_ID' => $this->input->post('PROGRAM_ID'),
                    'SESSION_ID' => $this->input->post('SESSION_ID'),
                    'SEMESTER_ID' => $this->input->post('SEMESTER_ID'),
                    'COURSE_ID' => $this->input->post('COURSE_ID'),
                    'START_DATE' => date('Y-m-d', strtotime($this->input->post('START_DATE'))),
                    'END_DATE' => date('Y-m-d', strtotime($this->input->post('END_DATE'))),
                    'ACTIVE_STATUS' => $this->input->post('status')
                    );
                $this->utilities->insertData($dis_content, 'aca_crs_content_distribution');
            }
            $this->session->set_flashdata('Info', 'Course Contetn distributed suceessfully !');
            redirect('admin/courseContent/', 'refresh');
        }
    }

    /**
     * @methodName  getCourseByProgramFromCourseOffer()
     * @access      public
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return
     */
    public function getCourseByProgramFromCourseOffer()
    {
        $program = $_POST['PROGRAM_ID'];
        $courses = $this->db->query("SELECT b.COURSE_ID, b.COURSE_TITLE
            FROM aca_course_offer a LEFT JOIN aca_course b ON a.COURSE_ID = b.COURSE_ID
            WHERE a.PROGRAM_ID =$program ")->result();

        $result = '<option value = "">Select one</option>';
        foreach ($courses as $row) {
            $result .= '<option value="' . $row->COURSE_ID . '">' . $row->COURSE_TITLE . '</option>';
        }

        echo $result;
    }

    function classSchedule()
    {
        $data['contentTitle'] = 'Create Class Schedule';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Class Schedule" => '#'
            );
        $data["checkRoomSchedule"] = array();
        $data["ac_type"] = "view";
        $data["dimention"] = "vertical";
        $data['pageTitle'] = 'Create Class Schedule';
        $data['faculty'] = $this->utilities->getAll('faculty');
        $data['rooms'] = $this->utilities->findAllFromView('v_building_room');

        $data['teachers'] = $this->utilities->getAll('sa_users');
        $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
        $data['session'] = $this->utilities->findByAttribute('session_view', array('IS_CURRENT' => 1));// Institute current semester session
        $data['content_view_page'] = 'admin/setup/class_schedule/class_schedule';
        $this->admin_template->display($data);
    }

    /**
     * @access      public
     * @param
     * @author      Jahid Hasan <jahid@atilimited.net>
     * @return      room schedule duplicate check
     */
    public function checkRoomSchedule()
    {
        $day = "";
        $room_id = $this->input->post('ROOM_ID');
        $date_range = explode(" to ", $this->input->post('daterange'));
        $start_dt = date('Y-m-d', strtotime($date_range[0]));
        $end_dt = date('Y-m-d', strtotime($date_range[1]));

        $start_time = $this->input->post('START_TIME');
        $end_time = $this->input->post('END_TIME');

        $sat = $this->input->post('chkDay1');
        $sun = $this->input->post('chkDay2');
        $mon = $this->input->post('chkDay3');
        $tue = $this->input->post('chkDay4');
        $wed = $this->input->post('chkDay5');
        $thu = $this->input->post('chkDay6');
        $fri = $this->input->post('chkDay7');
        //$operator = ($day != "")?" OR ":" ";
        if (isset($sat)) {
            $day .= (($day != "") ? " OR " : " ") . "SAT = 1";
        }
        if (isset($sun)) {
            $day .= (($day != "") ? " OR " : " ") . "SUN = 1";
        }
        if (isset($mon)) {
            $day .= (($day != "") ? " OR " : " ") . "MON = 1";
        }
        if (isset($tue)) {
            $day .= (($day != "") ? " OR " : " ") . "TUE = 1";
        }
        if (isset($wed)) {
            $day .= (($day != "") ? " OR " : " ") . "WED = 1";
        }
        if (isset($thu)) {
            $day .= (($day != "") ? " OR " : " ") . "THU = 1";
        }
        if (isset($fri)) {
            $day .= (($day != "") ? " OR " : " ") . "FRI = 1";
        }
        $day_sql = ($day != "") ? " AND (" . $day . ")" : "";
        $time_sql = ($start_time != "") ? " AND (START_TIME >= '$start_time' AND END_TIME <= '$end_time') " : "";
        $data["checkRoomSchedule"] = $this->db->query("SELECT * FROM `sc_schedule`
            WHERE `ROOM_ID` = '$room_id' $time_sql
            AND (START_DT >= '$start_dt' AND END_DT <= '$end_dt')
            $day_sql")->row();
        $this->load->view("common/week_days", $data);
    }

    /**
     * @access      public
     * @param
     * @author      Jahid Hasan <jahid@atilimited.net>
     * @return
     */
    public function viewRoomSchedule()
    {
        $day = "";
        $room_id = $this->input->post('ROOM_ID');
        $date_range = explode(" to ", $this->input->post('daterange'));
        $start_dt = date('Y-m-d', strtotime($date_range[0]));
        $end_dt = date('Y-m-d', strtotime($date_range[1]));

        $start_time = $this->input->post('START_TIME');
        $end_time = $this->input->post('END_TIME');

        $sat = $this->input->post('chkDay1');
        $sun = $this->input->post('chkDay2');
        $mon = $this->input->post('chkDay3');
        $tue = $this->input->post('chkDay4');
        $wed = $this->input->post('chkDay5');
        $thu = $this->input->post('chkDay6');
        $fri = $this->input->post('chkDay7');
        if (isset($sat)) {
            $day .= (($day != "") ? " OR " : " ") . "SAT = 1";
        }
        if (isset($sun)) {
            $day .= (($day != "") ? " OR " : " ") . "SUN = 1";
        }
        if (isset($mon)) {
            $day .= (($day != "") ? " OR " : " ") . "MON = 1";
        }
        if (isset($tue)) {
            $day .= (($day != "") ? " OR " : " ") . "TUE = 1";
        }
        if (isset($wed)) {
            $day .= (($day != "") ? " OR " : " ") . "WED = 1";
        }
        if (isset($thu)) {
            $day .= (($day != "") ? " OR " : " ") . "THU = 1";
        }
        if (isset($fri)) {
            $day .= (($day != "") ? " OR " : " ") . "FRI = 1";
        }
        $day_sql = ($day != "") ? " AND (" . $day . ")" : "";
        $time_sql = ($start_time != "") ? " AND (sc.START_TIME >= '$start_time' AND sc.END_TIME <= '$end_time') " : "";
        $data["roomSchedule"] = $this->db->query("SELECT *, (SELECT c.COURSE_TITLE FROM aca_course c WHERE c.COURSE_ID = sc.COURSE_ID)COURSE_TITLE,
            (SELECT br.BR_CODE FROM v_building_room br WHERE br.BR_ID = sc.ROOM_ID)B_ROOM FROM sc_schedule sc
            WHERE sc.ROOM_ID = '$room_id' $time_sql
            AND (START_DT >= '$start_dt' AND END_DT <= '$end_dt')
            $day_sql")->result();
        $this->load->view("common/schedule_view", $data);
    }

    /**
     * @param       form data
     * @author      Jahid Hasan <jahid@atilimited.net>
     * @return
     */
    function saveClassSch()
    {
        // recieving form data
        $sat = $this->input->post('chkDay1');
        $sun = $this->input->post('chkDay2');
        $mon = $this->input->post('chkDay3');
        $tue = $this->input->post('chkDay4');
        $wed = $this->input->post('chkDay5');
        $thu = $this->input->post('chkDay6');
        $fri = $this->input->post('chkDay7');
        $sat_st_time = $this->input->post('CUS_START_TIME1');
        $sat_end_time = $this->input->post('CUS_END_TIME1');
        $sun_st_time = $this->input->post('CUS_START_TIME2');
        $sun_end_time = $this->input->post('CUS_END_TIME2');
        $mon_st_time = $this->input->post('CUS_START_TIME3');
        $mon_end_time = $this->input->post('CUS_END_TIME3');
        $tue_st_time = $this->input->post('CUS_START_TIME4');
        $tue_end_time = $this->input->post('CUS_END_TIME4');
        $wed_st_time = $this->input->post('CUS_START_TIME5');
        $wed_end_time = $this->input->post('CUS_END_TIME5');
        $thu_st_time = $this->input->post('CUS_START_TIME6');
        $thu_end_time = $this->input->post('CUS_END_TIME6');
        $fri_st_time = $this->input->post('CUS_START_TIME7');
        $fri_end_time = $this->input->post('CUS_END_TIME7');
        $date_range = explode(" to ", $this->input->post('daterange'));
        $st_time = $this->input->post('START_TIME');
        $end_time = $this->input->post('END_TIME');

        // Preparing data array for filtering and inserting into DB
        $data_class_scheduel = array(
            'MODERATOR_ID' => $this->input->post('MODERATOR_ID'),
            'FACULTY_ID' => $this->input->post('FACULTY_ID'),
            'DEPT_ID' => $this->input->post('DEPT_ID'),
            'PROGRAM_ID' => $this->input->post('PROGRAM_ID'),
            'SEMESTER_ID' => $this->input->post('SEMESTER_ID'),
            'BATCH_ID' => $this->input->post('BATCH_ID'),
            'SESSION_ID' => $this->input->post('SESSION_ID'),
            'COURSE_ID' => $this->input->post('COURSE_ID'),
            'ROOM_ID' => $this->input->post('ROOM_ID'),
            'START_DT' => date('Y-m-d', strtotime($date_range[0])),
            'END_DT' => date('Y-m-d', strtotime($date_range[1]))
            );
        // checking if there is already a schedule according to input
        $is_duplicate = $this->utilities->findByAttribute('sc_schedule', $data_class_scheduel);

        $data_class_scheduel['START_TIME'] = empty($is_duplicate) ? (isset($st_time) ? $st_time : null) : (isset($st_time) ? $st_time : $is_duplicate->START_TIME);
        $data_class_scheduel['END_TIME'] = empty($is_duplicate) ? (isset($end_time) ? $end_time : null) : (isset($end_time) ? $end_time : $is_duplicate->END_TIME);

        $data_class_scheduel['SAT'] = empty($is_duplicate) ? (isset($sat) ? 1 : 0) : (isset($sat) ? 1 : $is_duplicate->SAT);
        $data_class_scheduel['SAT_ST_TIME'] = empty($is_duplicate) ? (!empty($sat_st_time) ? $sat_st_time : null) : (!empty($sat_st_time) ? $sat_st_time : $is_duplicate->SAT_ST_TIME);
        $data_class_scheduel['SAT_END_TIME'] = empty($is_duplicate) ? (!empty($sat_end_time) ? $sat_end_time : null) : (!empty($sat_end_time) ? $sat_end_time : $is_duplicate->SAT_END_TIME);

        $data_class_scheduel['SUN'] = empty($is_duplicate) ? (isset($sun) ? 1 : 0) : (isset($sun) ? 1 : $is_duplicate->SUN);
        $data_class_scheduel['SUN_ST_TIME'] = empty($is_duplicate) ? (!empty($sun_st_time) ? $sun_st_time : null) : (!empty($sun_st_time) ? $sun_st_time : $is_duplicate->SUN_ST_TIME);
        $data_class_scheduel['SUN_END_TIME'] = empty($is_duplicate) ? (!empty($sun_end_time) ? $sun_end_time : null) : (!empty($sun_end_time) ? $sun_end_time : $is_duplicate->SUN_END_TIME);

        $data_class_scheduel['MON'] = empty($is_duplicate) ? (isset($mon) ? 1 : 0) : (isset($mon) ? 1 : $is_duplicate->MON);
        $data_class_scheduel['MON_ST_TIME'] = empty($is_duplicate) ? (!empty($mon_st_time) ? $mon_st_time : null) : (!empty($mon_st_time) ? $mon_st_time : $is_duplicate->MON_ST_TIME);
        $data_class_scheduel['MON_END_TIME'] = empty($is_duplicate) ? (!empty($mon_end_time) ? $mon_end_time : null) : (!empty($mon_end_time) ? $mon_end_time : $is_duplicate->MON_END_TIME);

        $data_class_scheduel['TUE'] = empty($is_duplicate) ? (isset($tue) ? 1 : 0) : (isset($tue) ? 1 : $is_duplicate->TUE);
        $data_class_scheduel['TUE_ST_TIME'] = empty($is_duplicate) ? (!empty($tue_st_time) ? $tue_st_time : null) : (!empty($tue_st_time) ? $tue_st_time : $is_duplicate->TUE_ST_TIME);
        $data_class_scheduel['TUE_END_TIME'] = empty($is_duplicate) ? (!empty($tue_end_time) ? $tue_end_time : null) : (!empty($tue_end_time) ? $tue_end_time : $is_duplicate->TUE_END_TIME);

        $data_class_scheduel['WED'] = empty($is_duplicate) ? (isset($wed) ? 1 : 0) : (isset($wed) ? 1 : $is_duplicate->WED);
        $data_class_scheduel['WED_ST_TIME'] = empty($is_duplicate) ? (!empty($wed_st_time) ? $wed_st_time : null) : (!empty($wed_st_time) ? $wed_st_time : $is_duplicate->WED_ST_TIME);
        $data_class_scheduel['WED_END_TIME'] = empty($is_duplicate) ? (!empty($wed_end_time) ? $wed_end_time : null) : (!empty($wed_end_time) ? $wed_end_time : $is_duplicate->WED_END_TIME);

        $data_class_scheduel['THU'] = empty($is_duplicate) ? (isset($thu) ? 1 : 0) : (isset($thu) ? 1 : $is_duplicate->THU);
        $data_class_scheduel['THU_ST_TIME'] = empty($is_duplicate) ? (!empty($thu_st_time) ? $thu_st_time : null) : (!empty($thu_st_time) ? $thu_st_time : $is_duplicate->THU_ST_TIME);
        $data_class_scheduel['THU_END_TIME'] = empty($is_duplicate) ? (!empty($thu_end_time) ? $thu_end_time : null) : (!empty($thu_end_time) ? $thu_end_time : $is_duplicate->THU_END_TIME);

        $data_class_scheduel['FRI'] = empty($is_duplicate) ? (isset($fri) ? 1 : 0) : (isset($fri) ? 1 : $is_duplicate->FRI);
        $data_class_scheduel['FRI_ST_TIME'] = empty($is_duplicate) ? (!empty($fri_st_time) ? $fri_st_time : null) : (!empty($fri_st_time) ? $fri_st_time : $is_duplicate->FRI_ST_TIME);
        $data_class_scheduel['FRI_END_TIME'] = empty($is_duplicate) ? (!empty($fri_end_time) ? $fri_end_time : null) : (!empty($fri_end_time) ? $fri_end_time : $is_duplicate->FRI_END_TIME);

        if (empty($is_duplicate)) {
            // insert data
            if ($this->utilities->insertData($data_class_scheduel, 'sc_schedule')) {
                $this->session->set_flashdata('Success', 'Class Schedule Created Successfully');
                redirect('admin/classSchedule');
            } else {
                $this->session->set_flashdata('Error', 'Schedule Create Failed');
                redirect('admin/classSchedule', 'refresh');
            }
        } else {
            $data_class_scheduel['START_TIME'] = $this->input->post('START_TIME');
            $data_class_scheduel['END_TIME'] = $this->input->post('END_TIME');
            if ($this->utilities->updateData('sc_schedule', $data_class_scheduel, array("SCHEDULE_ID" => $is_duplicate->SCHEDULE_ID))) {
                $this->session->set_flashdata('Success', 'Class Schedule Updated Successfully');
                redirect('admin/classSchedule');
            } else {
                $this->session->set_flashdata('Error', 'Schedule Update Failed');
                redirect('admin/classSchedule', 'refresh');
            }
        }
    }

    /**
     * @methodName moderatorSchedule()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return
     */
    function courseSchedule()
    {
        $session = $this->input->post("SESSION_ID");
        $course = $this->input->post("COURSE_ID");
        $data['roomSchedule'] = $this->db->query("  SELECT a.*, b.FULL_NAME, c.BR_NAME, c.BR_CODE, ac.COURSE_TITLE
            FROM   sc_schedule a
            INNER join sa_users b on a.MODERATOR_ID = b.USER_ID
            INNER join sc_building_room c on a.ROOM_ID = c.BR_ID
            INNER JOIN aca_course ac on ac.COURSE_ID = a.COURSE_ID
            WHERE  a.COURSE_ID = $course and a.SESSION_ID = $session")->result();
        $this->load->view("admin/setup/class_schedule/course_class_schedule", $data);
    }

    /**
     * @methodName moderatorSchedule()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return moderator schedule
     */
    function moderatorSchedule()
    {
        $MODERATOR_ID = $this->input->post('MODERATOR_ID');
        $date_range = explode(" to ", $this->input->post('daterange'));
        $st_time = $this->input->post('START_TIME');
        $end_time = $this->input->post('END_TIME');
        $start_dt = date('m/d/Y', strtotime($date_range[0]));
        $end_dt = date('m/d/Y', strtotime($date_range[1]));
        $schedule = $this->db->query("SELECT ss.* FROM sc_schedule ss
            WHERE ss.MODERATOR_ID = '$MODERATOR_ID' AND ss.START_DT >= '$start_dt' AND ss.END_DT >= '$end_dt' AND ss.START_TIME >= '$st_time' AND ss.END_TIME >= '$end_time'")->result();
        if ($schedule) {
            echo "<soan class='label label-danger'>Not Available</span>";
        } else {
            echo "<soan class='label label-primary'>Available</span>";
        }

    }

    /**
     * @methodName moderatorScheduleView()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return
     */
    function moderatorScheduleView()
    {
        $MODERATOR_ID = $this->input->post('MODERATOR_ID');
        echo "<a  title='Schedule details' class='pull-leftt openModal' id = '$MODERATOR_ID' data-action='admin/scheduleDetailsView' data-type = 'edit'> Schedule Details </a>";
    }

    /**
     * @methodName scheduleDetailsView()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return
     */
    function scheduleDetailsView()
    {
        $MODERATOR_ID = $this->input->post('param');
        $data['moderator'] = $this->db->query("SELECT FULL_NAME FROM sa_users
            WHERE USER_ID =  '$MODERATOR_ID'")->row();
        $data['roomSchedule'] = $this->db->query("SELECT *, (SELECT c.COURSE_TITLE FROM aca_course c WHERE c.COURSE_ID = sc.COURSE_ID)COURSE_TITLE, (SELECT br.BR_CODE
            FROM v_building_room br WHERE br.BR_ID = sc.ROOM_ID)B_ROOM
            FROM sc_schedule sc
            WHERE MODERATOR_ID = '$MODERATOR_ID' ")->result();
        $this->load->view("common/schedule_view", $data);
    }

    /**
     * @methodName roomDetails()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return
     */
    function roomDetails()
    {
        $room_id = $this->input->post('ROOM_ID');
        echo "<a  title='Room details' class='pull-leftt openModal' id = '$room_id' data-action='admin/roomDetailsView' data-type = 'edit'> Room Details </a>";
    }

    /**
     * @methodName roomDetails()
     * @access
     * @param       form data
     * @author      Emdadul Huq <Emdadul@atilimited.net>
     * @return
     */
    function roomDetailsView()
    {
        $room_id = $this->input->post('param');
        $data['building'] = $this->db->query("SELECT br.* FROM sc_building_room br WHERE br.BR_ID = $room_id")->row();
        $data['details'] = $this->db->query("SELECT ba.*,sa.ACCESSORY_NAME, br.BR_NAME, bt.BR_TYPE_NAME
            FROM sc_br_accessories ba
            INNER JOIN sc_accessories sa on sa.BR_ACCESSORY_ID = ba.BR_ACCESSORY_ID
            INNER JOIN sc_building_room br on br.BR_ID = ba.BR_ID
            INNER JOIN sc_br_type bt on bt.BR_TYPE_ID = br.BR_TYPE_ID
            WHERE ba.BR_ID = $room_id
            ")->result();
        $this->load->view('admin/setup/building_accessory/room_details', $data);

    }

    function createStudent()
    {
        $data['contentTitle'] = 'Create Student';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Create Student" => '#'
            );
        $data['pageTitle'] = 'Studnet Login info ';
        $data['content_view_page'] = 'admin/setup/create_student/create_student';
        $this->admin_template->display($data);
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

    function saveStudent()
    {

        $ROLL_NO = $this->input->post('ROLL_NO');
        $EMAIL = $this->input->post('EMAIL');
        $password = $this->generatePassword();
        $chk_duplicate = $this->utilities->hasInformationByThisId('students_info', array('ROLL_NO' => $ROLL_NO));
        if ($chk_duplicate == 0) {

            $pk = $this->utilities->pk_f('students_info');
            $data_stu_log_info = array(
                'STUDENT_ID' => $pk,
                'ROLL_NO' => $ROLL_NO,
                'PASSWORD' => $password
                );
            $this->utilities->insertData($data_stu_log_info, 'students_info');

            $data_stu_email = array(
                'STU_CI_ID' => $this->utilities->pk_f('stu_contractinfo'),
                'STUDENT_ID' => $pk,
                'CONTACTS' => $EMAIL,
                'CONTACT_TYPE' => 'E'
                );
            $this->utilities->insertData($data_stu_email, 'stu_contractinfo');

            //email send
            $msgBody = " Dear Student, <br> Please visit this link for login and update your information<br>" . base_url("auth/studentLogin") . " <br>Your login details.<br /> Username:<b> " . $ROLL_NO . '</b><br> Password:<b>' . $password . '</b><br>Thanks <br> KYAU';


            require 'gmail_app/class.phpmailer.php';
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = "cloud2.eicra.com";
            $mail->Port = "465";
            $mail->SMTPAuth = true;
            $mail->Username = "dgdp@atilimited.net";
            $mail->Password = "dgdp@1234";
            $mail->SMTPSecure = 'ssl';
            $mail->From = "dgdp@atilimited.net";
            $mail->FromName = "KYAU";
            $mail->AddAddress($EMAIL);
            $mail->AddReplyTo('dgdp@atilimited.net');
            $mail->WordWrap = 1000;
            $mail->IsHTML(TRUE);
            $mail->Subject = "Student Login Information";
            //$mail->Body = $this->load->view('admin/setup/create_student/email_template',$data,true);
            $mail->Body = $msgBody;
            $send = $mail->Send();
            $this->session->set_flashdata('Success', 'Student Information Inserted Successfully.');

            echo "Y";
        } else {
            echo "D";
        }
    }

    function studentList()
    {
        $data['contentTitle'] = 'Studnet List';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "All Student" => '#'
            );
        $data['pageTitle'] = 'Existing Studnet';
        $data['students'] = $this->db->query("select a.*,b.CONTACTS,b.STU_CI_ID from students_info a
            left join stu_contractinfo b on a.STUDENT_ID = b.STUDENT_ID  WHERE b.CONTACT_TYPE = 'M'")->result();
        $data['content_view_page'] = 'admin/setup/create_student/studnet_list';
        $this->admin_template->display($data);
    }

    function importStudet()
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
        $config['upload_path'] = 'upload/csv/';
        $config['allowed_types'] = 'csv|xls|xlsx';
        $config['max_size'] = '1000';

        $this->load->library('upload', $config);


        // If upload failed, display error
        if (!$this->upload->do_upload()) {

            $data['error'] = $this->upload->display_errors();
        } else {

            $file_data = $this->upload->data();
            $file_path = 'upload/csv/' . $file_data['file_name'];
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                    $pk = $this->utilities->pk_f('students_info');
                    $studnet_info = array(
                        'STUDENT_ID' => $pk,
                        'ROLL_NO' => $row['ID'],
                        'FULL_NAME_EN' => $row['STUDENT'],
                        'FATHER_NAME' => $row['FATHER'],
                        'MOTHER_NAME' => $row['MOTHER'],
                        'DEPARTMENT' => $row['DEPARTMENT'],
                        'SESSION' => $row['SESSION'],
                        'SEMESTER' => $row['SEMESTER'],
                        'PASSWORD' => $this->generatePassword(),
                        );

                    $this->utilities->insertData($studnet_info, 'students_info');
                    $stu_contact = array(
                        'STU_CI_ID' => $this->utilities->pk_f('stu_contractinfo'),
                        'STUDENT_ID' => $pk,
                        'CONTACTS' => $row['MOBILE'],
                        'CONTACT_TYPE' => 'M',
                        );
                    $this->utilities->insertData($stu_contact, 'stu_contractinfo');
                }
                $this->session->set_flashdata('Success', 'Student Information Inserted Successfully.');
                redirect("admin/importStudet");
            } else
            $data['error'] = "Error occured";
        }
    }

    function updateStuPasGvn()
    {
        $studnet_id = $_POST['student_id'];
        $update_data = array('PS_GVN_FG' => 1);
        if ($this->utilities->updateData('students_info', $update_data, array('STUDENT_ID' => $studnet_id))) {
            echo 'Y';
        }
    }

    function delStuContact()
    {
        $attribute_id = $_POST['attribute_id'];

        if ($this->utilities->deleteRowByAttribute('stu_contractinfo', array('STUDENT_ID' => $attribute_id))) {
            echo 'Y';
        } else {
            echo 'N';
        }
    }

    function addTeacher()
    {
        ini_set('max_execution_time', 0);
        ini_set("memory_limit", -1);

        $data['contentTitle'] = 'Add Teacher';
        $data["breadcrumbs"] = array(
            "Teacher" => "#",
            "Add Teacher" => '#'
            );
        $data['pageTitle'] = 'Add Teacher';
        $this->form_validation->set_rules('FULL_NAME_EN', 'Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['faculty'] = $this->utilities->findAllByAttribute('faculty', array('ACTIVE_STATUS' => 1));
            $data['department'] = $this->utilities->findAllByAttribute('department', array('ACTIVE_STATUS' => 1));
            $data['designation'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 65));
            $data['content_view_page'] = 'admin/faculty/teacher_form';
        } else {
            $teacher_info = array(
                'FULL_NAME_EN' => $this->input->post('FULL_NAME_EN'),
                'MOBILE_NO' => $this->input->post('MOBILE_NO'),
                'EMAIL_ADRESS' => $this->input->post('EMAIL_ADRESS'),
                'JOIN_DATE' => date('Y-m-d', strtotime($this->input->post('JOIN_DATE'))),
                'FACULTY' => $this->input->post('FACULTY'),
                'DEPARTMENT' => $this->input->post('DEPARTMENT'),
                'DESIGNATION' => $this->input->post('DESIGNATION'),
                'USER_NAME' => $this->input->post('teacher_user_name'),
                'PASSWORD' => $this->input->post('teacher_password')
                );
            $this->utilities->insertData($teacher_info, 'teacher_info');
            $this->session->set_flashdata('Success', 'Teacher Information Inserted Successfully.');
            redirect('admin/addTeacher', 'refresh');
        }
        $this->admin_template->display($data);
    }

    function teacherList()
    {
        $data['contentTitle'] = 'Add Teacher';
        $data["breadcrumbs"] = array(
            "Teacher" => "#",
            "Add Teacher" => '#'
            );
        $data['pageTitle'] = 'Add Teacher';
        $data['teachers'] = $this->db->query("select a.* from sa_users a where a.USER_TYPE='F'")->result();
        $data['content_view_page'] = 'admin/faculty/teacher_list';
        $this->admin_template->display($data);
    }

    function teacherDetails()
    {
        $data['contentTitle'] = 'Teacher Details';
        $data["breadcrumbs"] = array(
            "Teacher" => "#",
            "Add Teacher" => '#'
            );
        $data['pageTitle'] = 'Add Teacher';
        $data['content_view_page'] = 'admin/faculty/teacher_details';
        $this->admin_template->display($data);
    }

    /**
     * @methodName  teacherAssignedCourse()
     * @access      public
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      assign courses to teacher
     */
    function teacherAssignedCourse()
    {
        $data['contentTitle'] = 'Teacher Course Mapping';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Course Mapping" => '#'
            );
        $data['pageTitle'] = 'Course Mapping';
        $data['dimention'] = 'vertical';
        $data['ac_type'] = 1;
        $data['faculty'] = $this->utilities->getAll('faculty');
        $data['content_view_page'] = 'admin/course/tr_course_mapping';
        $this->admin_template->display($data);
    }

    function trListByCourseId()
    {
        $id = $_POST['course_id'];
        $data['tr_list'] = $this->db->query("SELECT a.*, b.FULL_NAME, b.USER_IMG
            FROM techer_assigned_courses a LEFT JOIN sa_users b ON a.TEACHER_ID = b.USER_ID
            WHERE a.COURSE_ID=$id")->result();
        $this->load->view('admin/course/tr_list_by_course', $data);

    }

    /**
     * @methodName  getCourseByProgramFromCourseOffer()
     * @access      public
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return       save course mapping
     */
    function saveCourseMapping()
    {
        //echo "<pre>"; print_r($_POST); exit; echo "</pre>";
        $MODERATOR_ID = $this->input->post('MODERATOR_ID');
        foreach ($MODERATOR_ID as $key => $value) {
            $insert_course_mapping = array(
                'TEACHER_ID' => $value,
                'COURSE_ID' => $this->input->post('COURSE_ID'),
                'DEPT_ID' => $this->input->post('DEPT_ID'),
                'FACULTY_ID' => $this->input->post('FACULTY_ID'),
                'PROGRAM_ID' => $this->input->post('PROGRAM_ID')
                );
            // $check_duplicate = $this->utilities->hasInformationByThisId('techer_assigned_courses', array('TEACHER_ID' => $this->input->post('MODERATOR_ID'), 'COURSE_ID' => $value));
            $this->utilities->insertData($insert_course_mapping, 'techer_assigned_courses');
        }
        echo "Y";
    }

    /**
     * @methodName  depWiseTrCrList()
     * @access      public
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      department wise teacher and course list
     */
    function depWiseTrCrList()
    {
        $department_id = $this->input->post('department_id');
        $data['teachers'] = $this->utilities->findAllByAttribute('teacher_info', array('DEPARTMENT' => $department_id));
        $this->load->view('admin/course/dep_tr_wise_course_list', $data);
    }

    /**
     * @methodName  courseMappingList()
     * @access      public
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      course mapping list
     */
    function courseMappingList()
    {
        $data['contentTitle'] = 'Course Mapping';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Course Mapping Details" => '#'
            );
        $data['pageTitle'] = 'Course Mapping Details';
        $data['faculty'] = $this->utilities->getAll('faculty');
        $data['teachers'] = $this->utilities->getAll('teacher_info');
        $data['session'] = $this->utilities->getAll('session_view');
        $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
        $data['content_view_page'] = 'admin/course/course_mapping_list';
        $this->admin_template->display($data);
    }

    /**
     * @methodName  createUser()
     * @access      public
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      User create by supur admin
     */
    function createUser()
    {
        $data['contentTitle'] = 'Create User';
        $data["breadcrumbs"] = array(
            "User" => "#",
            "Create User" => '#'
            );

        $data['pageTitle'] = 'Create User';
        $data['user_group'] = $this->utilities->getAll('sa_user_group');
        //$data['user_list'] = $

        //$data['emp_list'] = $this->utilities->getAll('hr_emp');
        
        $data['emp_list'] = $this->db->query("select * from  hr_emp where EMP_ID not in (select EMP_ID from  sa_users) and ACTIVE_STATUS =1")->result();
        //$this->pr($data['emp_list']);exit();
        
        //$data['user_type'] = $this->db->query("select * from hr_emp where CHAR_LKP='c'")->result();
        
        $data['faculty'] = $this->db->query("select * from ins_dept ")->result();
        $data['content_view_page'] = 'admin/faculty/create_user';
        $this->admin_template->display($data);
    }

    /**
     * @methodName  saveUser()
     * @access      public
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      Save user
     */
    function saveUser()
    {
        $pass = $this->input->post('USERPW');
        $userEmail = $this->input->post('USERNAME');
        $data['Uemail'] = $this->input->post('USERNAME');
        $empId = $this->input->post('EMP_ID');
        $data['fullName']=$this->db->query("SELECT FULL_ENAME FROM hr_emp WHERE EMP_ID = $empId")->row();
        $subject = "KYAU Account verification";
            if (!empty($userEmail))  {
                $data['org_info']=$this->utilities->findByAttribute('sa_organizations', array('STATUS' => 1));

                require 'gmail_app/class.phpmailer.php';
                $mail = new PHPMailer;
                $mail->IsSMTP();
                $mail->Host = "mail.harnest.com";
                $mail->Port = "465";
                $mail->SMTPAuth = true;
                $mail->Username = "dev@atilimited.net";
                $mail->Password = "@ti321$#";
                $mail->SMTPSecure = 'ssl';
                //$mail->From = "pmis@atilimited.net";
                $mail->From = "kyau@atilimited.net";
                $mail->FromName = "KYAU";
                $mail->AddAddress($userEmail);
                $mail->IsHTML(TRUE);
                $mail->Subject = $subject;
                $mail->Body = $this->load->view('admin/setup/email_template/email_send_template', $data , TRUE);
                 if ($mail->Send()) {
                     $this->session->set_flashdata('Success','Mail sent Successfully.');
                }
    
                }
           else{
        $this->session->set_flashdata('Error','You are not successfully message send!.');
        }
        // add additional parameters
        $options = array(
            'cost' => 11,
            //'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
            );
        // creating the salt
        $h_pass = password_hash($pass, PASSWORD_BCRYPT, $options);
       // var_dump($h_pass); die();
        $user_dept_info = $this->utilities->findByAttribute('hr_edeptdesi', array('EMP_ID' => $this->input->post('EMP_ID'), 'DEFAULT_FG' => 1));
        $emp_image_name = $this->utilities->findByAttribute('hr_emp', array('EMP_ID' => $this->input->post('EMP_ID')));

        //print_r($emp_image_name);exit;
        $user_data = array(
            'EMP_ID' => $this->input->post('EMP_ID'),
            'USERGRP_ID' => $this->input->post('USERGRP_ID'),
            'USERLVL_ID' => $this->input->post('USER_GRP_LVL_ID'),
            'USERNAME' => $this->input->post('USERNAME'),
            'USER_IMG' => $emp_image_name->EMP_IMG,
            'DEPT_ID' => $user_dept_info->DEPT_ID,
            'DESIG_ID' => $user_dept_info->DESIG_ID,
            'USERPW' => $h_pass,
            );


        if ($this->utilities->hasInformationByThisId('sa_users', array('USERNAME' => $this->input->post('USERNAME'))) == TRUE) {
            echo "DU";
        } else if ($this->utilities->hasInformationByThisId('sa_users', array('EMP_ID' => $this->input->post('EMP_ID'))) == TRUE) {
            echo "DB";
        } else {
            $this->utilities->insertData($user_data, 'sa_users');
            echo "Y";
        }
    }

    /**
     * @param       USER ID
     * @author      Emdadul Huq<Emdadul@atilimited.net>
     * @return      none
     */
    function updateUserLevel()
    {
        $userId = $this->input->post("param");
        $data['emp_list'] = $this->utilities->getAll('hr_emp');


        $data['user_group'] = $this->utilities->getAll('sa_user_group');
        $data['user_lv'] = $this->utilities->getAll('sa_ug_level');
        $data["user"] = $this->utilities->findByAttribute("sa_users", array("USER_ID" => $userId));

        //echo "<pre>"; print_r($data["user"]);  echo "</pre>";

        $this->load->view('admin/faculty/user_update_form', $data);
    }

    function editUserLevel()
    {
        $user_id = $this->input->post('user_id');
        $emp_id = $this->input->post('EMP_ID');
        $USER_GRP_ID = $this->input->post('USERGRP_ID');
        $USER_GRP_LVL_ID = $this->input->post('USER_GRP_LVL_ID');
        $USERNAME = $this->input->post('USERNAME');
        $ACTIVE_STATUS = $this->input->post('ACTIVE_STATUS');
        $password = $this->input->post('USERPW');
        if ( !empty($password)) {
        // add additional parameters
        $options = array(
            'cost' => 11,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
            );
        // creating the salt
        $h_pass = password_hash($password, PASSWORD_BCRYPT, $options);

        // checking if Program with this name is already exist
        //  $check = $this->utilities->hasInformationByThisId("sa-user", array("USER_ID" => $user_id));
        //  if (empty($check)) {// if Program name available
        // preparing data to insert
        $user = array(
            'USERGRP_ID' => $USER_GRP_ID,
            'USERLVL_ID' => $USER_GRP_LVL_ID,
            'USERNAME' => $USERNAME,
            'ACTIVE_STATUS' => $ACTIVE_STATUS,
            'USERPW' => $h_pass,
            'EMP_ID' => $emp_id,
            );

        //echo "<pre>"; print_r($user); exit; echo "</pre>";
    }

    else{
        $user = array(
            'USERGRP_ID' => $USER_GRP_ID,
            'USERLVL_ID' => $USER_GRP_LVL_ID,
            'USERNAME' => $USERNAME,
            'ACTIVE_STATUS' => $ACTIVE_STATUS,
            'EMP_ID' => $emp_id,
            );


    }
        if ($this->utilities->updateData('sa_users', $user, array('USER_ID' => $user_id))) { // if data update successfully
            echo "<div class='alert alert-success'>User Update successfully</div>";
        } else { // if data update failed
            echo "<div class='alert alert-danger'>User Update failed</div>";
        }
//        } else {// if faculty name not available
//            echo "<div class='alert alert-danger'>User Name Already Exist</div>";
//        }
    }

    function userById()
    {
        $user_id = $this->input->post('param'); // degree name
        // $data["previlages"] = $this->checkPrevilege("setup/program");

        $data["previlages"] = $this->checkPrevilege();
        $data['user_group'] = $this->utilities->getAll('sa_user_group');

        $data['user'] = $this->utilities->findAllByAttributeFromUserWithId($user_id);

        $this->load->view('admin/single_user_row', $data);
    }

    /**
     * @param       none
     * @author      Emdadul Huq<Emdadul@atilimited.net>
     * @return      none
     */
    function updateUserInformation()
    {
        $USER_ID = $this->input->post('userId');
        $pass = $this->input->post('USERPW');
        // add additional parameters
        $options = array(
            'cost' => 11,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
            );
        // creating the salt
        $h_pass = password_hash($pass, PASSWORD_BCRYPT, $options);
        $user_data = array(
            'FULL_NAME' => $this->input->post('USERNAME'),
            'USERGRP_ID' => $this->input->post('USERGRP_ID'),
            'USERLVL_ID' => $this->input->post('USER_GRP_LVL_ID'),
            'USERNAME' => $this->input->post('USERNAME'),
            'USERPW' => $h_pass,
            'EMAIL' => $this->input->post('EMAIL'),
            'BIOMETRIC_ID' => $this->input->post('BIOMETRIC_ID'),
            'HIRE_DATE' => date('Y-m-d', strtotime($this->input->post('HIRE_DATE'))),
            'MOBILE' => $this->input->post('MOBILE'),
            'USER_TYPE' => $this->input->post('USER_TYPE'),
            'DEPT_ID' => $this->input->post('DEPARTMENT_ID'),
            'DESIGNATION_ID' => $this->input->post('DESIGNATION_ID')
            );
        if ($this->utilities->updateData('sa_users', $user_data, array('USER_ID' => $USER_ID))) { // if data update successfully
            echo "<div class='alert alert-success'>User Update successfully</div>";
        } else { // if data update failed
            echo "<div class='alert alert-danger'>User Update failed</div>";
        }
    }

    /**
     * @param       user id, email
     * @author      Emdadul Huq<Emdadul@atilimited.net>
     * @return      none
     */
    function checkEmailAddress()
    {
        $user_id = $this->input->post("user_id");
        $Email = $this->input->post("Email");
        $check = $this->utilities->hasInformationByThisId("sa_users", array("EMAIL" => $Email, "USER_ID !=" => $user_id));
        if (!empty($check)) {
            echo "used";
        } else {
            echo "";
        }
    }

    /**
     * @param       user id, BIOMETRIC_ID.
     * @author      Emdadul Huq<Emdadul@atilimited.net>
     * @return      none
     */
    function checkBiometricId()
    {
        $user_id = $this->input->post("user_id");
        $BIOMETRIC_ID = $this->input->post("BIOMETRIC_ID");
        $check = $this->utilities->hasInformationByThisId("sa_users", array("BIOMETRIC_ID" => $BIOMETRIC_ID, "USER_ID !=" => $user_id));
        if (!empty($check)) {
            echo "used";
        } else {
            echo "";
        }
    }

    /**
     * @param       User Id
     * @author      Emdadul Huq<Emdadul@atilimited.net>
     * @return      none
     */
    function UserInformationById()
    {
        $userId = $this->input->post("param");
        $data["previlages"] = $this->checkPrevilege("admin/userList");
        // print_r( $data["previlages"] );exit;
        $data['user'] = $this->db->query("SELECT su.*, d.DEPT_NAME, des.DESIGNATION, sug.USERGRP_NAME, sul.UGLEVE_NAME
            FROM sa_users su 
            INNER JOIN department d on d.DEPT_ID = su.DEPT_ID
            INNER JOIN designations des on des.DESIGNATION_ID = su.DESIGNATION_ID
            INNER JOIN sa_user_group sug on sug.USERGRP_ID = su.USERGRP_ID
            INNER JOIN sa_ug_level sul on sul.UG_LEVEL_ID = su.USERLVL_ID
                                            WHERE  su.USER_ID = $userId ")->row(); // select single element
        $this->load->view('admin/faculty/single_user_row', $data);
    }

    /**
     * @param       user id, user level
     * @author      Emdadul Huq<Emdadul@atilimited.net>
     * @return      none
     */
    function searchUser()
    {
        $USERGRP_IDS = $this->input->post("USERGRP_IDS");
        $USER_LVL = $this->input->post("USER_LVL");
        $data['user'] = $this->db->query("SELECT su.*, d.DEPT_NAME, des.DESIGNATION, sug.USERGRP_NAME, sul.UGLEVE_NAME
            FROM sa_users su 
            INNER JOIN department d on d.DEPT_ID = su.DEPT_ID
            LEFT JOIN designations des on des.DESIGNATION_ID = su.DESIGNATION_ID
            INNER JOIN sa_user_group sug on sug.USERGRP_ID = su.USERGRP_ID
            INNER JOIN sa_ug_level sul on sul.UG_LEVEL_ID = su.USERLVL_ID
                                            WHERE su.USERGRP_ID = $USERGRP_IDS AND su.USERLVL_ID = $USER_LVL")->result(); // select single element
        $this->load->view('admin/faculty/search_user_list', $data);
    }

    /**
     * @param       userID
     * @author      Emdadul Huq<Emdadul@atilimited.net>
     * @return      none
     */
    function viewUserLevel()
    {
        $userId = $this->input->post("param");
        $data['user'] = $this->db->query("SELECT su.*, d.DEPT_NAME, des.DESIGNATION, sug.USERGRP_NAME, sul.UGLEVE_NAME
            FROM sa_users su 
            INNER JOIN department d on d.DEPT_ID = su.DEPT_ID
            LEFT JOIN designations des on des.DESIGNATION_ID = su.DESIGNATION_ID
            INNER JOIN sa_user_group sug on sug.USERGRP_ID = su.USERGRP_ID
            INNER JOIN sa_ug_level sul on sul.UG_LEVEL_ID = su.USERLVL_ID
                                            WHERE su.USER_ID = $userId")->row(); // select single element
        $this->load->view('admin/faculty/user_view', $data);
    }

    /**
     * @param       none
     * @author      Emdadul Huq<Emdadul@atilimited.net>
     * @return      none
     */
    function userList()
    {
        $data['contentTitle'] = 'User';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'User List' => '#',
            );
        $data["previlages"] = $this->checkPrevilege();

        $data['user_group'] = $this->utilities->getAll('sa_user_group');

        $data['user'] = $this->utilities->getAllUserInfo();
        $data['content_view_page'] = 'admin/faculty/user_list';
        $this->admin_template->display($data);
    }


     /**
     * @methodName  parentsWorkList()
     * @access      public
     * @param
     * @author      Md.Reazul Islam <reazul@atilimited.net>
     * @return      parents list whose are requested to get user name and password
     */

      function getUserLevel($groupId)
      {
        if($groupId!='')
        {
            $userLevel = $this->db->query("SELECT l.UG_LEVEL_ID,l.UGLEVE_NAME
                                        FROM sa_ug_level l WHERE USERGRP_ID= $groupId")->result();

        echo "<option value=''>Select Level</option>";
        foreach ($userLevel as $row) {

            echo "<option value='$row->UG_LEVEL_ID'>$row->UGLEVE_NAME</option>";
        }

        }
        else 
        {
             echo "<option value=''>Select Level</option>";
        }
        
      }

    /**
     * @methodName  pr()
     * @access      public
     * @param
     * @author      Md.Reazul Islam <reazul@atilimited.net>
     * @return      parents list whose are requested to get user name and password
     */

      private function pr($data)
      {
        echo "<pre>";
        print_r($data);
        exit;
      }

    /**
     * @methodName  usersGrpLevWiseSearch()
     * @access      public
     * @param
     * @author      Md.Reazul Islam <reazul@atilimited.net>
     * @return      parents list whose are requested to get user name and password
     */

      function usersGrpLevWiseSearch()
        {
        $data["previlages"] = $this->checkPrevilege('admin/userList');
        //$this->pr($m);
        $groupId = $this->input->post('GROUP_ID');
        $levelId = $this->input->post('LEVEL_ID');
        if($levelId!='' AND $groupId!='')
        {
            $whereString="WHERE  u.USERGRP_ID = $groupId AND u.USERLVL_ID = $levelId";
        }
        else if($levelId=='' AND $groupId!='')
        {
            $whereString="WHERE  u.USERGRP_ID = $groupId";
        }
        else if($levelId!='' AND $groupId=='')
        {
            $whereString="WHERE  u.USERLVL_ID = $levelId";
        }
        else
        {
            $whereString="";
        }
        $data['user']= $this->db->query("SELECT 
                                            u.USERGRP_ID,
                                            u.USERLVL_ID,
                                            u.EMP_ID,
                                            u.DEPT_ID,
                                            u.DESIG_ID,
                                            e.FULL_ENAME,
                                            e.EMP_IMG,
                                            d.DEPT_NAME,
                                            h.DESIGNATION,
                                            l.UGLEVE_NAME,
                                            g.USERGRP_NAME,
                                            u.USERNAME,
                                            u.USER_ID
                                        FROM
                                            sa_users u
                                                LEFT JOIN
                                            sa_user_group g ON u.USERGRP_ID = g.USERGRP_ID
                                                LEFT JOIN
                                            sa_ug_level l ON u.USERLVL_ID = l.UG_LEVEL_ID
                                                LEFT JOIN
                                            hr_emp e ON u.EMP_ID = e.EMP_ID
                                                LEFT JOIN
                                            ins_dept d ON u.DEPT_ID = d.DEPT_ID
                                                LEFT JOIN
                                            hr_desig h ON u.DESIG_ID = h.DESIG_ID
                                    $whereString
                                    ")->result();
         $this->load->view("admin/faculty/usersGrpLevWiseSearch",$data);
       }


    /**
     * @methodName  parentsWorkList()
     * @access      public
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      parents list whose are requested to get user name and password
     */
    function parentList()
    {
        $data['contentTitle'] = 'Parent';
        $data["breadcrumbs"] = array(
            "Parents" => "parents/index",
            "Parent List" => '#'
            );
        $data['parent_list'] = $this->db->query("select a.*,c.ROLL_NO from parent_profile a
            left join parent_childs b on a.PARENT_PRO_ID = b.PARENT_PRO_ID
            left join students_info c on b.STUDENT_ID = c.STUDENT_ID")->result();
        $data['content_view_page'] = "admin/parents/parent_list";
        $this->admin_template->display($data);
    }

    /**
     * @methodName  parentsWorkList()
     * @access      public
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      parents list whose are requested to get user name and password
     */
    function parentsWorkList()
    {
        $data['contentTitle'] = 'Parent List';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Parent List' => '#',
            );
        $data['content_view_page'] = 'admin/parents/parent_work_list';
        $this->admin_template->display($data);
    }

    /**
     * @methodName  ajaxDatatableParentList()
     * @access      public
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      parent datatable  list via ajax call
     */
    function ajaxDatatableParentList()
    {
        // storing  request (ie, get/post) global array to a variable
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'STUDENT_ID', 1 => 'PARENTS_NAME', 2 => 'MOBILE_NO');
        // getting total number records without any search
        $query = $this->db->query("SELECT * FROM parent_profile")->num_rows();
        $totalData = $query;
        $totalFiltered = $totalData;
        // when there is no search parameter then total number rows = total number filtered rows.
        if (!empty($requestData['search']['value'])) {
            $query = $this->db->query("SELECT p.PARENT_PRO_ID,
             p.PARENTS_NAME,
             p.MOBILE_NO,
             p.EMAIL,
             p.USERNAME,
             p.PASSWORD,
             p.REMARKS,
             p.ACTIVE_STATUS P_ACTIVE_STATUS,
             pc.STUDENT_ID,
             pc.ACTIVE_STATUS STU_ACTIVE_STATUS,
             (SELECT sp.GURDIAN_NAME
             FROM stu_parentinfo sp
             WHERE     sp.STUDENT_ID = pc.STUDENT_ID
             AND sp.ECP_FG = 1
             AND sp.PARENTS_TYPE = 'O')
             GURDIAN,
             (SELECT GROUP_CONCAT(s.FATHER_NAME, ', ', s.MOTHER_NAME)
             FROM students_info s
             WHERE s.STUDENT_ID = pc.STUDENT_ID)
             FATHER
             FROM parent_profile p
             INNER JOIN parent_childs pc ON p.PARENT_PRO_ID = pc.PARENT_PRO_ID
             WHERE pc.ACTIVE_STATUS = 0 AND STUDENT_ID LIKE '" . $requestData['search']['value'] . "%'ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . " ")->result();
            $totalFiltered = $query;
            // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query
        } else {
            $query = $this->db->query("SELECT p.PARENT_PRO_ID,
             p.PARENTS_NAME,
             p.MOBILE_NO,
             p.EMAIL,
             p.USERNAME,
             p.PASSWORD,
             p.USERNAME,
             p.REMARKS,
             p.ACTIVE_STATUS P_ACTIVE_STATUS,
             pc.STUDENT_ID,
             pc.ACTIVE_STATUS STU_ACTIVE_STATUS,
             (SELECT sp.GURDIAN_NAME
             FROM stu_parentinfo sp
             WHERE     sp.STUDENT_ID = pc.STUDENT_ID
             AND sp.ECP_FG = 1
             AND sp.PARENTS_TYPE = 'O')
             GURDIAN,
             (SELECT GROUP_CONCAT(s.FATHER_NAME, ', ', s.MOTHER_NAME)
             FROM students_info s
             WHERE s.STUDENT_ID = pc.STUDENT_ID)
             FATHER
             FROM parent_profile p
             INNER JOIN parent_childs pc ON p.PARENT_PRO_ID = pc.PARENT_PRO_ID
             WHERE pc.ACTIVE_STATUS = 0  ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "")->result();
        }
        $data = array();

        foreach ($query as $row) {
            // preparing an array
            $nestedData = array();
            $nestedData[] = $row->STUDENT_ID;
            $nestedData[] = $row->FATHER;
            //$previousdata=$this->db->query("select EMAIL_ADDRESS from stu_parentinfo where STUDENT_ID=$row->STUDENT_ID")->row();
            $nestedData[] = ($row->GURDIAN != '') ? $row->GURDIAN : $row->FATHER;
            $nestedData[] = '<textarea name="REMARKS_' . $row->PARENT_PRO_ID . '" class="form-control">' . $row->REMARKS . '</textarea>';
            $checked = ($row->STU_ACTIVE_STATUS == '1') ? 'checked="checked"' : '';
            $nestedData[] = '<input type="hidden" name="STUDENT_ID_' . $row->PARENT_PRO_ID . '" value="' . $row->STUDENT_ID . '">
            <input type="hidden" name="EMAIL_' . $row->PARENT_PRO_ID . '" value="' . $row->EMAIL . '">
            <input type="hidden" name="USERNAME_' . $row->PARENT_PRO_ID . '" value="' . $row->USERNAME . '">
            <input type="hidden" name="PASSWORD_' . $row->PARENT_PRO_ID . '" value="' . $row->PASSWORD . '">
            <input name="PARENT_PRO_ID[]" value="' . $row->PARENT_PRO_ID . '" class="PARENT_PRO_ID_CHK" type="checkbox" ' . $checked . '">';
            $data[] = $nestedData;
        }
        $json_data = array("draw" => intval($requestData['draw']),
            // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData),
            // total number of records
            "recordsFiltered" => intval($totalFiltered),
            // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data
            // total data array
            );
        echo json_encode($json_data);
    }

    /**
     * @methodName  approveParent()
     * @access      public
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      approve  parent from parents list and send success mail.
     */
    function approveParent()
    {
        $PARENT_PRO_ID = ((isset($_POST['PARENT_PRO_ID'])) ? $_POST['PARENT_PRO_ID'] : '');

        foreach ($PARENT_PRO_ID as $key => $value) {
            $approve_data = array(
                'REMARKS' => $this->input->post('REMARKS_' . $value),
                'ACTIVE_STATUS' => 1
                );
            // print_r($approve_data);
            $this->utilities->updateData('parent_profile', $approve_data, array("PARENT_PRO_ID" => $value));
            //approve data for parent child relationship table
            $approve_data_for_p_c = array('ACTIVE_STATUS' => 1);
            $this->utilities->updateData('parent_childs', $approve_data_for_p_c, array('PARENT_PRO_ID' => $value, 'STUDENT_ID' => $this->input->post('STUDENT_ID_' . $value)));
            //for email function
            $user_name = $this->input->post('USERNAME_' . $value);
            $password = $this->input->post('PASSWORD_' . $value);
            $email = $this->input->post('EMAIL_' . $value);
            $msgBody = " Dear Gurdian, <br> Please visit this link for login and update your information<br>" . base_url("auth/parentsLogin") . " <br>Your login details.<br /> Username:<b> " . $user_name . '</b><br> Password:<b>' . $password . '</b><br>Thanks <br> KYAU';
            $CC = null;
            $BCC = null;
            $toMail = $email;
            //$CC = $_POST['cc'];
            //$BCC = $_POST['bcc'];
            $subject = "Parent Login";
            $msgBody = $msgBody;
            $success = 0;
            $this->load->library('email_lib');
            $success = $this->email_lib->sendEmail($toMail, $CC, $BCC, $subject, $msgBody);
        }
        // exit;
        $this->session->set_flashdata('Success', 'Successfully updated and mail to parents !');
        redirect('admin/parentsWorkList/');
    }

    function userWiseDepartment()
    {
        $user_type = $_POST['user_type'];
        if ($user_type != '291') {
            $query = $this->db->query("select * from department where FACULTY_ID !=10")->result();
        } else {
            $query = $this->db->query("select * from department where FACULTY_ID =10")->result();
        }
        $result = '<option value = "">Select one</option>';
        foreach ($query as $row) {
            $result .= '<option value="' . $row->DEPT_ID . '">' . $row->DEPT_NAME . '</option>';
        }
        echo $result;
    }

    function organogram()
    {
        $data['contentTitle'] = 'Organogram';
        $data["breadcrumbs"] = array(
            "User" => "#",
            "Create User" => '#'
            );
        $data['pageTitle'] = 'Organogram';
        $data['organogam'] = $this->db->query("select * from organogam")->result();
        $data['content_view_page'] = 'teacher/organogram';
        $this->admin_template->display($data);
    }

    function addOrganogam()
    {
        $data['contentTitle'] = 'Add Organogram';
        $data["breadcrumbs"] = array(
            "User" => "#",
            "Create User" => '#'
            );
        $data['pageTitle'] = 'Add Organogram';
        $data['parent'] = $this->db->query("select * from organogam")->result();
        $data['content_view_page'] = 'teacher/add_organogram';
        $this->admin_template->display($data);
    }

    function saveOrganogum()
    {
        $organogam_data = array(
            'NAME' => $this->input->post('NAME'),
            'TITLE' => $this->input->post('TITLE'),
            'PARENT_ID' => ($this->input->post('PARENT_ID') != '') ? $this->input->post('PARENT_ID') : null,
            );
        $this->utilities->insertData($organogam_data, 'organogam');
        redirect('admin/addOrganogam', 'refresh');
    }

    /**
     * @access none
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function singleApplicantPassed($applicantId, $flag = '')
    {

        /*appliant personal information add adm_appliantion_info to students_info and stu_admissioninfo*/
        $appInfo = $this->db->query("SELECT * FROM adm_applicant_info WHERE APPLICANT_ID = $applicantId")->row();
        $pk = $this->utilities->pk_f('students_info');
        $addPk = $this->utilities->pk_f('stu_admissioninfo');
        $SEMESTER_ID = 90;
        $applicantInfo = array(
            'STUDENT_ID' => $pk,
            'ROLL_NO' => $appInfo->ROLL_NO,
            'BIOMETRIC_ID' => '',
            'PASSWORD' => $appInfo->PASSWORD,
            'FIRST_NAME' => $appInfo->FIRST_NAME,
            'MIDDLE_NAME' => $appInfo->MIDDLE_NAME,
            'LAST_NAME' => $appInfo->LAST_NAME,
            'FULL_NAME_EN' => $appInfo->FULL_NAME_EN,
            'FULL_NAME_BN' => $appInfo->FULL_NAME_BN,
            'STUD_PHOTO' => $appInfo->STUD_PHOTO,
            'HOME_PHONE' => $appInfo->HOME_PHONE,
            'NATIONALITY' => $appInfo->NATIONALITY,
            'NATIONAL_ID' => $appInfo->NATIONAL_ID,
            'EMAIL_ADRESS' => $appInfo->EMAIL_ADRESS,
            'COUNTRY_ID' => $appInfo->COUNTRY_ID,
            'FATHER_NAME' => $appInfo->FATHER_NAME,
            'MOTHER_NAME' => $appInfo->MOTHER_NAME,
            'MARITAL_STATUS' => $appInfo->MARITAL_STATUS,
            'SPOUSE_NAME' => $appInfo->SPOUSE_NAME,
            'DATH_OF_BIRTH' => $appInfo->DATH_OF_BIRTH,
            'PLACE_OF_BIRTH' => $appInfo->PLACE_OF_BIRTH,
            'HEIGHT_CM' => $appInfo->HEIGHT_CM,
            'BLOOD_GROUP' => $appInfo->BLOOD_GROUP,
            'HEIGHT_FEET' => $appInfo->HEIGHT_FEET,
            'HEIGHT_INCHES' => $appInfo->HEIGHT_INCHES,
            'WEIGHT_KG' => $appInfo->WEIGHT_KG,
            'WEIGHT_LBS' => $appInfo->WEIGHT_LBS,
            'COLOR_OF_EYES' => $appInfo->COLOR_OF_EYES,
            'IDENTIFY_MARK' => $appInfo->IDENTIFY_MARK,
            'RELIGION_ID' => $appInfo->RELIGION_ID,
            'PASSPORT_NO' => $appInfo->PASSPORT_NO,
            /*'ISSUE_DATE' => $appInfo->ISSUE_DATE,
            'EXPIRE_DATE' => $appInfo->EXPIRE_DATE,*/
            'PS_GVN_FG' => $appInfo->PS_GVN_FG
            );
        if ($this->utilities->insertData($applicantInfo, 'students_info')) {
            $stuId = $this->db->query("SELECT STUDENT_ID FROM students_info WHERE ROLL_NO = $appInfo->ROLL_NO ")->row();
            $addmissionInfo = array(
                'STU_ADMISSION_ID' => $addPk,
                'STUDENT_ID' => $stuId->STUDENT_ID,
                'SESSION_ID' => $appInfo->SESSION_ID,
                'FACULTY_ID' => $appInfo->FACULTY_ID,
                'DEPT_ID' => $appInfo->DEPT_ID,
                'PROGRAM_ID' => $appInfo->PROGRAM_ID,
                'SEMISTER_ID' => '',
                'ACTIVE_STATUS' => 1
                );
            if ($this->utilities->insertData($addmissionInfo, 'stu_admissioninfo')) {
                echo "insert Successfully";
            }
        }
        /*end add applicant personal info*/

        /*Applicant parent info insert into stu_parentinfo from from_parentinfo*/
        $parentInfo = $this->db->query("SELECT * FROM adm_applicant_parentinfo WHERE APPLICANT_ID  = $applicantId")->result();
        foreach ($parentInfo as $row) {
            $parentPk = $this->utilities->pk_f('stu_parentinfo');
            $pInfo = array(
                'STU_PARENT_ID' => $parentPk,
                'STUDENT_ID' => $row->APPLICANT_ID,
                'PARENTS_TYPE' => $row->PARENTS_TYPE,
                'GURDIAN_NAME' => $row->GURDIAN_NAME,
                'OCCUPATION' => $row->OCCUPATION,
                'PARENT_PHOTO' => $row->PARENT_PHOTO,
                'NATIONALITY' => $row->NATIONALITY,
                'WORKING_ORG' => $row->WORKING_ORG,
                'MOBILE_NO' => $row->MOBILE_NO,
                'EMAIL_ADRESS' => $row->EMAIL_ADRESS,
                'PASSWORD' => $row->PASSWORD,
                'ECP_FG' => $row->ECP_FG,
                'ORG_ID' => $row->ORG_ID,
                'ACTIVE_FLAG' => 1,
                );
            $ppInfo = $this->utilities->insertData($pInfo, 'stu_parentinfo');
            if ($ppInfo) {
                echo "inserted successfully";
            }
        }
        /*end parent info*/

        /*Applicant contact info insert into stu_pgscontract from adm_pgscontract*/
        $contactInfo = $this->db->query("SELECT * FROM adm_pgscontract WHERE APPLICANT_ID  = $applicantId")->result();
        foreach ($contactInfo as $row) {
            $pgsPk = $this->utilities->pk_f('stu_pgscontract');
            $cInfo = array(
                'STU_PGS_ID' => $pgsPk,
                'STUDENT_ID' => $applicantId,
                'PGSC_TYPE' => $row->PGSC_TYPE,
                'PGSC_ID' => $row->PGSC_ID,
                'CONTACTS' => $row->CONTACTS,
                'CONTACT_TYPE' => $row->CONTACT_TYPE,
                'ORG_ID' => $row->ORG_ID,
                'DEFAULT_FG' => $row->DEFAULT_FG,
                'ACTIVE_STATUS' => 1,
                );
            $contInfo = $this->utilities->insertData($cInfo, 'stu_pgscontract');
            if ($contInfo) {
                echo "inserted successfully";
            }
        }
        /*end contact info*/

        /*Applicant address info insert into stu_adressinfo from adm_applicant_adressinfo*/
        $addressInfo = $this->db->query("SELECT * FROM adm_applicant_adressinfo WHERE APPLICANT_ID  = $applicantId")->result();
        foreach ($addressInfo as $row) {
            $addressPk = $this->utilities->pk_f('stu_adressinfo');
            $addrInfo = array(
                'STU_ADRESS_ID' => $addressPk,
                'STUDENT_ID' => $applicantId,
                'ADRESS_TYPE' => $row->ADRESS_TYPE,
                'SAS_PSORPR' => $row->SAS_PSORPR,
                'HOUSE_NO_NAME' => $row->HOUSE_NO_NAME,
                'ROAD_AVENO_NAME' => $row->ROAD_AVENO_NAME,
                'VILLAGE_WARD' => $row->VILLAGE_WARD,
                'UNION_ID' => $row->UNION_ID,
                'THANA_ID' => $row->THANA_ID,
                'POST_OFFICE_ID' => $row->POST_OFFICE_ID,
                'POLICE_STATION_ID' => $row->POLICE_STATION_ID,
                'DISTRICT_ID' => $row->DISTRICT_ID,
                'DIVISION_ID' => $row->DIVISION_ID,
                'ACTIVE_FLAG' => 1,
                'CREATED_BY' => $applicantId,
                );
            $addInfo = $this->utilities->insertData($addrInfo, 'stu_adressinfo');
            if ($addInfo) {
                echo "inserted successfully";
            }
        }
        /*end address info*/

        /*Applicant academic info insert into stu_acadimicinfo from adm_applicant_acadimicinfo*/
        $academicInfo = $this->db->query("SELECT * FROM adm_applicant_acadimicinfo WHERE APPLICANT_ID  = $applicantId")->result();
        foreach ($academicInfo as $row) {
            $academicPK = $this->utilities->pk_f('stu_acadimicinfo');
            $acInfo = array(
                'STU_AI_ID' => $academicPK,
                'STUDENT_ID' => $applicantId,
                'EXAM_DEGREE_ID' => $row->EXAM_DEGREE_ID,
                'MAJOR_GROUP_ID' => $row->MAJOR_GROUP_ID,
                'INSTITUTION' => $row->INSTITUTION,
                'BOARD' => $row->BOARD,
                'RESULT_GRADE' => $row->RESULT_GRADE,
                'CGPA_MARKPCT' => $row->CGPA_MARKPCT,
                'SCALE_MARKS' => $row->SCALE_MARKS,
                'PASSING_YEAR' => $row->PASSING_YEAR,
                'DURATION' => $row->DURATION,
                'ACHIEVEMENT' => $row->ACHIEVEMENT,
                'ACTIVE_FLAG' => $row->ACTIVE_FLAG,
                'CREATED_BY' => $applicantId
                );
            $acadeInfo = $this->utilities->insertData($acInfo, 'stu_acadimicinfo');
            if ($acadeInfo) {
                echo "inserted successfully";
            }
        }
        /*end academic info*/
    }

    /**
     * @access none
     * @param  selected_id
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function allApplicantPassed()
    {
        $applicantId = $this->input->post("chkApplicant");
        for ($i = 0; $i < sizeof($applicantId); $i++) {
            $this->singleApplicantPassed($applicantId[$i], 'approved');
        }

    }

    /**
     * @access none
     * @param  applicantId
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function approveRemark()
    {
        $data['applicantId'] = $this->input->post("applicantId");
        $this->load->view("admin/applicant/approve_remarks", $data);
    }

    /**
     * @access none
     * @param  applicantId
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function rejectRemark()
    {
        $data['applicantId'] = $this->input->post("applicantId");
        $this->load->view("admin/applicant/reject_remarks", $data);
    }


    /**
     * @access none
     * @param  applicantId
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function approveApplicantList()
    {
        $program = $this->input->post("program");
        $session = $this->input->post("session");
        $offer = $this->input->post("offer");
        $data['applicant'] = $this->db->query("SELECT asi.*, d.DEPT_NAME, p.PROGRAM_NAME, f.FACULTY_NAME, sv.SESSION_NAME, ml.LKP_NAME
            FROM adm_applicant_info asi
            INNER JOIN program p on p.PROGRAM_ID = asi.PROGRAM_ID
            INNER JOIN department d on d.DEPT_ID = asi.DEPT_ID
            INNER JOIN faculty f on f.FACULTY_ID = asi.FACULTY_ID
            INNER JOIN session_view sv on sv.SESSION_ID = asi.SESSION_ID
            INNER JOIN m00_lkpdata ml on ml.LKP_ID = asi.GENDER
            WHERE asi.ADMIT_CARD_GENERATED = 1 AND asi.REJECT = 0 AND asi.PROGRAM_ID = $program AND asi.SESSION_ID = $session AND asi.OFFER_TYPE = '$offer'
            ")->result();
        $this->load->view("admin/applicant/approve_applicant_list", $data);
    }

    /**
     * @access none
     * @param  applicantId
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function newApplicantReject()
    {

        $applicantId = $_POST['applicantId'];
        $appUpdate = array(
            //'REJECT' => 1
            'ELIGIBLE_BY_ADDMISSION_DEPT' => $this->user_session['USER_ID'],
            'ELIGIBLE_BY_ADDMISSION_DEPT_STATUS' => 2,
            'ELIGIBLE_ADDMISSION_DEPT_DT' => date("Y-m-d"),
            'ELIGIBLE_ADM_REMARKS' => $_POST['remarks'],
            );
        $update = $this->utilities->updateData('applicant_personal_info', $appUpdate, array("APPLICANT_ID" => $applicantId));
        if (!empty($update)) {
            echo "<div class='alert alert-success'>Rejected successfully</div>";
        }
    }


    function newApplicantRejectByHead()
    {

        $applicantId = $_POST['applicantId'];
        $appUpdate = array(
            //'REJECT' => 1
            'ELIGIBLE_BY_DEPT_HEAD' => $this->user_session['USER_ID'],
            'ELIGIBLE_BY_DEPT_HEAD_STATUS' => 2,
            'ELIGIBLE_BY_DEPT_HEAD_DT' => date("Y-m-d"),
            'ELIGIBLE_DEPT_HEAD_REMARKS' => $_POST['remarks'],
            );
        $update = $this->utilities->updateData('applicant_personal_info', $appUpdate, array("APPLICANT_ID" => $applicantId));
        if (!empty($update)) {
            echo "<div class='alert alert-success'>Rejected successfully</div>";
        }
    }

    function newApplicantRejectForAdmit()
    {

        $applicantId = $_POST['applicantId'];
        $appUpdate = array(
            //'REJECT' => 1
            'APPROVE_BY' => $this->user_session['USER_ID'],
            'APPROVE_FOR_ADMIT' => 2,
            'APPROVE_DT' => date("Y-m-d"),
            'APPROVE_REMARKS' => $_POST['remarks'],
            );
        $update = $this->utilities->updateData('applicant_personal_info', $appUpdate, array("APPLICANT_ID" => $applicantId));
        if (!empty($update)) {
            echo "<div class='alert alert-success'>Rejected successfully</div>";
        }
    }

    /**
     * @access none
     * @param  applicantId
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function newApplicantApproved()
    {

        $appUpdate = array(
            'ELIGIBLE_BY_ADDMISSION_DEPT' => $this->user_session['USER_ID'],
            'ELIGIBLE_BY_ADDMISSION_DEPT_STATUS' => 1,
            'ELIGIBLE_ADDMISSION_DEPT_DT' => date("Y-m-d"),
            'ELIGIBLE_ADM_REMARKS' => $_POST['remarks'],
            );
        $update = $this->utilities->updateData('applicant_personal_info', $appUpdate, array("APPLICANT_ID" => $_POST['applicantId']));
        if ($update) {
            echo "<div class='alert alert-success'>Approved successfully</div>";
        }

    }


    function newApplicantApprovedByHead()
    {

        $appUpdate = array(
            'ELIGIBLE_BY_DEPT_HEAD' => $this->user_session['USER_ID'],
            'ELIGIBLE_BY_DEPT_HEAD_STATUS' => 1,
            'ELIGIBLE_BY_DEPT_HEAD_DT' => date("Y-m-d"),
            'ELIGIBLE_DEPT_HEAD_REMARKS' => $_POST['remarks'],
            );
        $update = $this->utilities->updateData('applicant_personal_info', $appUpdate, array("APPLICANT_ID" => $_POST['applicantId']));
        if ($update) {
            echo "<div class='alert alert-success'>Approved successfully</div>";
        }

    }

    function newApplicantApprovedForAdmit()
    {

        $appUpdate = array(
            'APPROVE_BY' => $this->user_session['USER_ID'],
            'APPROVE_FOR_ADMIT' => 1,
            'APPROVE_DT' => date("Y-m-d"),
            'APPROVE_REMARKS' => $_POST['remarks'],
            );
        $update = $this->utilities->updateData('applicant_personal_info', $appUpdate, array("APPLICANT_ID" => $_POST['applicantId']));
        if ($update) {
            echo "<div class='alert alert-success'>Approved successfully</div>";
        }

    }

    /**
     * @access none
     * @param  applicantId
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function applicantById()
    {
        $applicantId = $this->input->post("applicantId");
        $data['applicant'] = $this->applicant_model->getApplicantDataById($applicantId);

        //echo "<pre>"; print_r($data['applicant']); exit; echo "</pre>";

        $this->load->view("admin/applicant/single_new_applicant_row", $data);

    }


    function applicantByIdHead()
    {
        $applicantId = $this->input->post("applicantId");
        $data['applicant'] = $this->applicant_model->getApplicantDataById($applicantId);

        //echo "<pre>"; print_r($data['applicant']); exit; echo "</pre>";

        $this->load->view("admin/applicant/single_new_applicant_row_head", $data);

    }

    function applicantForAdmit()
    {
        $applicantId = $this->input->post("applicantId");
        $data['applicant'] = $this->applicant_model->getApplicantDataById($applicantId);

        //echo "<pre>"; print_r($data['applicant']); exit; echo "</pre>";

        $this->load->view("admin/applicant/single_new_applicant_row_admit", $data);

    }

    /**
     * @access none
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function allApplicantApproved()
    {
        $applicantId = $this->input->post("chkApplicant");
        for ($i = 0; $i < sizeof($applicantId); $i++) {
            $update = $this->newApplicantApproved($applicantId[$i], 'approved');
            if ($update == 1) {
                $applicantInfo = array(
                    "REMARKS" => "Applicant Passed successfully"
                    );
                $this->utilities->updateData('adm_applicant_info', $applicantInfo, array('APPLICANT_ID' => $applicantId[$i]));
            }
        }
        if ($update == 1) {
            echo "<div class='alert alert-success'>Approved successfully &nbsp;<span class='text-primary'> <i class='fa fa-check'></i></div>";
        } else {
            echo "appp";
        }
    }

    /**
     * @access none
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function newApplicantList()
    {
        $data['contentTitle'] = 'Applicant List';
        $data["breadcrumbs"] = array(
            "Applicant" => "#",
            "New Applicant List" => '#'
            );
        $data["previlages"] = $this->checkPrevilege('admin/newApplicantList');

        $data["ac_type"] = '';
        $data['program'] = $this->utilities->findAllByAttribute('ins_program', array("ACTIVE_STATUS" => 1));
        $data["session"] = $this->utilities->admissionSessionList();
        $data['dimention'] = "horizental";
        $data['applicant'] = $this->db->query("select a.* from applicant_personal_info a where a.ELIGIBLE_BY_DEPT_HEAD_STATUS is null order by a.APPLICANT_ID desc")->result();
        $data['content_view_page'] = 'admin/applicant/new_applicant_list';
        $this->admin_template->display($data);
    }

    /**
     * @access none
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function newApplicantProSesWise()
    {
        $PROGRAM_ID = $this->input->post('PROGRAM_ID');
        $ADM_SES = $this->input->post('YSESSION_ID');
        $data['applicant'] = $this->db->query("select a.* from applicant_personal_info a where a.ELIGIBLE_BY_DEPT_HEAD_STATUS is null and a.PROGRAM_ID=$PROGRAM_ID and a.ADM_SESSION_ID=$ADM_SES order by a.APPLICANT_ID desc")->result();
        $this->load->view('admin/applicant/new_applicant_list_program_sess_wise', $data);

    }

    /**
     * @access none
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function newApplicantAdmissonApproveProSesWise()
    {
        $PROGRAM_ID = $this->input->post('PROGRAM_ID');
        $ADM_SES = $this->input->post('YSESSION_ID');
        $data['applicant'] = $this->db->query("select a.* from applicant_personal_info a where a.ELIGIBLE_BY_ADDMISSION_DEPT_STATUS =1 and a.ELIGIBLE_BY_DEPT_HEAD_STATUS is null and a.PROGRAM_ID=$PROGRAM_ID and a.ADM_SESSION_ID=$ADM_SES order by a.APPLICANT_ID desc")->result();
        $this->load->view('admin/applicant/new_applicant_list_adm_approv_program_sess_wise', $data);
    }

    /**
     * @access none
     * @param  none
     * @author Abhijit Mondal Abhi <abhijit@atilimited.net>
     * @return template
     */
    function deptApplicantList()
    {
        $data['contentTitle'] = 'Applicant';
        $data["breadcrumbs"] = array(
            "Applicant" => "#",
            "Passed Applicant List" => '#'
            );
        $data["previlages"] = $this->checkPrevilege();
        $data["ac_type"] = '';
        $data['program'] = $this->utilities->findAllByAttribute('ins_program', array("ACTIVE_STATUS" => 1, 'DEPT_ID' => $this->user_session['DEPT_ID']));
        $data["session"] = $this->utilities->admissionSessionList();
        $dept_id = $this->user_session['DEPT_ID'];
        $data['applicant'] = $this->db->query("select a.* from applicant_personal_info a WHERE a.ELIGIBLE_BY_ADDMISSION_DEPT_STATUS=1  and a.ELIGIBLE_BY_DEPT_HEAD_STATUS is null and a.DEPT_ID=$dept_id order by a.APPLICANT_ID desc")->result();
        $data['content_view_page'] = 'admin/applicant/passed_applicant_list';
        $this->admin_template->display($data);
    }

    function applicantModal()
    {
        $APPLICANT_ID = $_POST['APPLICANT_ID'];
        $data['applicant_id'] = $APPLICANT_ID;
        //$data["applicant_info"] = $this->db->query("select a.* from applicant_personal_info a WHERE a.APPLICANT_ID = '$APPLICANT_ID'")->row();
        $data["applicant_info"] = $this->applicant_model->getAppicantInfoAll($APPLICANT_ID);
        //echo "<pre>"; print_r($data); exit; echo "</pre>";
        echo $this->load->view('admin/applicant/details_modal_view', $data, true);
    }

    function applicantPersonalDetails($param_applicant_id = '')
    {
        if ($param_applicant_id != '') {
            $APPLICANT_ID = $param_applicant_id;
        } else {
            $APPLICANT_ID = $_POST["APPLICANT_ID"];
        }

        $data['applicant_id'] = $APPLICANT_ID;
        $data["applicant_info"] = $this->applicant_model->getAppicantInfoAll($APPLICANT_ID);

        //echo '<pre>'; echo print_r($data["applicant_info"]); exit;

        $this->load->view('admin/applicant/applicant_personal_information', $data);
    }

    function updateApplicantPersonalDetails($param_applicant_id = '')
    {
        $student_id = $param_applicant_id;

        $applicant = $this->utilities->findByAttribute('applicant_personal_info', array('APPLICANT_ID' => $student_id));
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

                $this->load->view('admin/applicant/update_applicant_personal_information', $data);
            } else {

                require(APPPATH . 'views/common/image_upload/class.upload.php');
                $applicant_photo_name = '';
                $signature_photo_name = '';
                $foo = new Upload($_FILES['photo']);


                if ($foo->uploaded) {
                    // large size image

                    unlink('upload/applicant/photo/' . $applicant->PHOTO);

                    $foo->file_new_name_body = 'photo_' . $applicant->ADM_ROLL_NO;
                    $foo->image_border = 1;
                    //$foo->file_overwrite = true;
                    //$foo->image_border_color    = '#231F20';
                    $foo->allowed = array('image/*');
                    $foo->Process('upload/applicant/photo/');

                    if ($foo->processed) {

                        $applicant_photo_name = 'photo_' . $applicant->ADM_ROLL_NO . '.' . $foo->file_src_name_ext;
                    } else {
                        echo 'error : ' . $foo->error;
                    }
                }


                $sig_photo = new Upload($_FILES['signature']);
                if ($sig_photo->uploaded) {
                    // large size image

                    unlink('upload/applicant/signature/' . $applicant->SIGNATURE_PHOTO);

                    $sig_photo->file_new_name_body = 'signature_' . $applicant->ADM_ROLL_NO;
                    $sig_photo->image_border = 1;
                    //$sig_photo->file_overwrite = true;
                    //$foo->image_border_color    = '#231F20';
                    $sig_photo->allowed = array('image/*');
                    $sig_photo->Process('upload/applicant/signature/');
                    if ($sig_photo->processed) {
                        $signature_photo_name = 'signature_' . $applicant->ADM_ROLL_NO . '.' . $sig_photo->file_src_name_ext;
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


    function applicantFamillyDetails($param_applicant_id = '')
    {
        if ($param_applicant_id != '') {
            $APPLICANT_ID = $param_applicant_id;
        } else {
            $APPLICANT_ID = $_POST["APPLICANT_ID"];
        }

        $data['applicant_id'] = $APPLICANT_ID;
        $data["fathersInfo"] = $this->applicant_model->getApplicantFatherInfo($APPLICANT_ID);
        $data["applicant_info"] = $this->applicant_model->getAppicantInfoAll($APPLICANT_ID);
        $data["motherInfo"] = $this->applicant_model->getApplicantMotherInfo($APPLICANT_ID);
        $data["local_guardian"] = $this->applicant_model->getApplicantLocalGuardianInfo($APPLICANT_ID);


        //echo "<pre>"; print_r($data["local_guardian"]); exit; echo "</pre>";
        $this->load->view('admin/applicant/applicant_family_details', $data);
    }

    function updateApplicantFamilyDetails($param_applicant_id)
    {
        $applicant_id = $param_applicant_id;

        $applicant = $this->utilities->findByAttribute('applicant_personal_info', array('APPLICANT_ID' => $applicant_id));
        $APPLICANT_ID = $applicant->APPLICANT_ID;
        $data['applicant_id'] = $APPLICANT_ID;

        $data["applicant_info"] = $this->applicant_model->getAppicantInfoAll($APPLICANT_ID);

        if ($applicant->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS != 1) {
            $this->form_validation->set_rules('FATHER_NAME', 'Father name', 'required');

            if ($this->form_validation->run() == FALSE) {

                $data['occupation'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 21));
                $data['relation'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 40));

                $data["fathersInfo"] = $this->applicant_model->getApplicantFatherInfo($APPLICANT_ID);
                $data["motherInfo"] = $this->applicant_model->getApplicantMotherInfo($APPLICANT_ID);
                $data["local_guardian"] = $this->applicant_model->getApplicantLocalGuardianInfo($APPLICANT_ID);
                $data["local_Other_guardian"] = $this->applicant_model->getApplicantLocalOtherGuardianInfo($APPLICANT_ID);

                //echo "<pre>"; echo print_r($data["local_Other_guardian"]); exit;

                $this->load->view('admin/applicant/update_applicant_family_details', $data);
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

                    $this->utilities->updateData('applicant_gurdianinfo', $local_guandian_remove_flag, array("APPLICANT_ID" => $APPLICANT_ID, "GUARDIAN_TYPE" => 'M',));
                    $this->utilities->updateData('applicant_gurdianinfo', $local_guandian_flag, array("APPLICANT_ID" => $APPLICANT_ID, "GUARDIAN_TYPE" => 'F',));
                    $this->db->delete('applicant_gurdianinfo', array("APPLICANT_ID" => $APPLICANT_ID, 'GUARDIAN_TYPE' => 'O'));

                } else if ($this->input->post('local_emergency_guardian') == 'M') {
                    $local_guandian_flag = array(
                        'LOCAL_GUARDIAN_FG' => 1,
                        );
                    $local_guandian_remove_flag = array(
                        'LOCAL_GUARDIAN_FG' => 0,
                        );

                    $this->utilities->updateData('applicant_gurdianinfo', $local_guandian_remove_flag, array("APPLICANT_ID" => $APPLICANT_ID, "GUARDIAN_TYPE" => 'F',));
                    $this->utilities->updateData('applicant_gurdianinfo', $local_guandian_flag, array("APPLICANT_ID" => $APPLICANT_ID, "GUARDIAN_TYPE" => 'M',));
                    $this->db->delete('applicant_gurdianinfo', array("APPLICANT_ID" => $APPLICANT_ID, 'GUARDIAN_TYPE' => 'O'));


                } else {

                    if (!empty($data["local_Other_guardian"])) {

                        $applicant_local_guardian_info = array(
                            'APPLICANT_ID' => $APPLICANT_ID,
                            'GURDIAN_NAME' => $this->input->post('LOCAL_GAR_NAME'),
                            'GUARDIAN_RELATION' => $this->input->post('LOCAL_GAR_RELATION'),
                            'ADDRESS' => $this->input->post('LOCAL_GAR_ADDRESS'),
                            'MOBILE_NO' => $this->input->post('LOCAL_GAR_PHN'),
                            'GUARDIAN_TYPE' => 'O',
                            'LOCAL_GUARDIAN_FG' => 1,
                            );

                        $local_guandian_remove_flag = array(
                            'LOCAL_GUARDIAN_FG' => 0,
                            );

                        $this->db->delete('applicant_gurdianinfo', array("APPLICANT_ID" => $APPLICANT_ID, 'GUARDIAN_TYPE' => 'O'));
                        $this->utilities->insert('applicant_gurdianinfo', $applicant_local_guardian_info);
                        $this->utilities->updateData('applicant_gurdianinfo', $local_guandian_remove_flag, array("APPLICANT_ID" => $APPLICANT_ID, "GUARDIAN_TYPE" => 'M',));
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

                        $local_guandian_remove_flag = array(
                            'LOCAL_GUARDIAN_FG' => 0,
                            );

                        $this->db->delete('applicant_gurdianinfo', array("APPLICANT_ID" => $APPLICANT_ID, 'GUARDIAN_TYPE' => 'O'));
                        $this->utilities->insert('applicant_gurdianinfo', $applicant_local_guardian_info);
                        $this->utilities->updateData('applicant_gurdianinfo', $local_guandian_remove_flag, array("APPLICANT_ID" => $APPLICANT_ID, "GUARDIAN_TYPE" => 'M',));
                        $this->utilities->updateData('applicant_gurdianinfo', $local_guandian_remove_flag, array("APPLICANT_ID" => $APPLICANT_ID, "GUARDIAN_TYPE" => 'F',));
                    }

                }

                $this->session->set_flashdata('Success', 'Successfully Updated');
                redirect('applicant/applicantDetails');

            }
        } else {

            redirect('applicant/applicantDetails');
        }


    }


    public function applicantAddressInfo($param_applicant_id = '')
    {
        if ($param_applicant_id != '') {
            $APPLICANT_ID = $param_applicant_id;
        } else {
            $APPLICANT_ID = $_POST["APPLICANT_ID"];
        }

        $data['applicant_id'] = $APPLICANT_ID;
        $data["applicant_info"] = $this->applicant_model->getAppicantInfoAll($APPLICANT_ID);
        $data['local_present_adddress'] = $this->applicant_model->getLocalPresentAddress($APPLICANT_ID);
        $data['local_permanent_adddress'] = $this->applicant_model->getLocalPermanentAddress($APPLICANT_ID);

        $this->load->view('admin/applicant/applicant_address', $data);
    }


    function updateApplicantAddressInfo($param_applicant_id)
    {
        $applicant_id = $param_applicant_id;

        $applicant = $this->utilities->findByAttribute('applicant_personal_info', array('APPLICANT_ID' => $applicant_id));
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

                $this->load->view('admin/applicant/update_applicant_address', $data);
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


    function applicantAcademicInfo($param_applicant_id = '')
    {
        if ($param_applicant_id != '') {
            $APPLICANT_ID = $param_applicant_id;
        } else {
            $APPLICANT_ID = $_POST["APPLICANT_ID"];
        }

        $data['applicant_id'] = $APPLICANT_ID;
        $data["applicant_info"] = $this->applicant_model->getAppicantInfoAll($APPLICANT_ID);
        $data['academic'] = $this->applicant_model->getApplicantAcademicInfo($APPLICANT_ID);

        $this->load->view('admin/applicant/applicant_academic_info', $data);
    }


    function updateApplicantAcademicInfo($param_applicant_id)
    {
        $applicant_id = $param_applicant_id;

        $applicant = $this->utilities->findByAttribute('applicant_personal_info', array('APPLICANT_ID' => $applicant_id));
        $APPLICANT_ID = $applicant->APPLICANT_ID;
        $data['APPLICANT_ID'] = $APPLICANT_ID;

        if ($applicant->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS != 1) {
            $data['academic'] = $this->applicant_model->getApplicantAcademicInfo($APPLICANT_ID);


            //echo "<pre>"; print_r($data['academic']); exit;

            $this->form_validation->set_rules('EXAM_NAME[]', 'Exam name', 'required');

            if ($this->form_validation->run() == FALSE) {

                $data['exam_name'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 13));
                $data['board_name'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 24));
                $data['group_name'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 25));

                $this->load->view('admin/applicant/update_applicant_academic_info', $data);
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


    function applicantOtherDetailsInfo($param_applicant_id = '')
    {
        if ($param_applicant_id != '') {
            $APPLICANT_ID = $param_applicant_id;
        } else {
            $APPLICANT_ID = $_POST["APPLICANT_ID"];
        }

        $data['applicant_id'] = $APPLICANT_ID;
        $data["applicant_info"] = $this->applicant_model->getAppicantInfoAll($APPLICANT_ID);
        $this->load->view('admin/applicant/applicant_others_info', $data);
    }

    function updateApplicantOtherDetailsInfo($param_applicant_id)
    {
        $applicant_id = $param_applicant_id;

        $applicant = $this->utilities->findByAttribute('applicant_personal_info', array('APPLICANT_ID' => $applicant_id));
        $APPLICANT_ID = $applicant->APPLICANT_ID;

        if ($applicant->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS != 1) {
            $data['applicant_id'] = $APPLICANT_ID;
            $data["applicant_info"] = $this->applicant_model->getAppicantInfoAll($APPLICANT_ID);

            $this->form_validation->set_rules('ANNUAL_INCOME', 'Annual Income', 'required');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view('admin/applicant/update_applicant_others_info', $data);
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


    /**
     * @access none
     * @param
     * @author Abhijit Mondal Abhi <abhijit@atilimited.net>
     * @return template
     */


    function passedApplicantList()
    {
        $data['contentTitle'] = 'Passed Applicant List';
        $data["breadcrumbs"] = array(
            "Applicant" => "#",
            "Passed Applicant List" => '#'
            );
        $data["previlages"] = $this->checkPrevilege();
        $data["ac_type"] = '';
        $data['program'] = $this->utilities->findAllByAttribute('ins_program', array("ACTIVE_STATUS" => 1));
        $data["session"] = $this->utilities->admissionSessionList();
        $data['dimention'] = "horizental";
        $data['applicant'] = $this->db->query("select a.* from applicant_personal_info a WHERE ELIGIBLE_BY_DEPT_HEAD_STATUS=1 order by a.APPLICANT_ID desc")->result();
        $data['content_view_page'] = 'admin/applicant/passed_applicant/passed_applicant_list';
        $this->admin_template->display($data);

    }


    function applicantPaymentInfo()
    {
        $APPLICANT_ID = $_POST["APPLICANT_ID"];
        $data['payment'] = $this->db->query("select a.* from adm_applicant_deposit a

            where a.APPLICANT_ID ='$APPLICANT_ID'")->row();

        $this->load->view('admin/applicant/applicant_payment_info', $data);
    }

    /**
     * @access none
     * @param  faculty , dept, program, session
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function searchNewPassedApplicant()
    {
        $faculty = $this->input->post('faculty');
        $department = $this->input->post('department');
        $program = $this->input->post('program');
        $session = $this->input->post('session');
        $offer = $this->input->post('offer');
        $data['applicant'] = $this->db->query(" SELECT asi.*, d.DEPT_NAME, p.PROGRAM_NAME, f.FACULTY_NAME, sv.SESSION_NAME, ml.LKP_NAME
            FROM adm_applicant_info asi
            INNER JOIN program p on p.PROGRAM_ID = asi.PROGRAM_ID
            INNER JOIN department d on d.DEPT_ID = asi.DEPT_ID
            INNER JOIN faculty f on f.FACULTY_ID = asi.FACULTY_ID
            INNER JOIN session_view sv on sv.SESSION_ID = asi.SESSION_ID
            INNER JOIN m00_lkpdata ml on ml.LKP_ID = asi.GENDER
            WHERE asi.PASSED = 0 AND asi.ADMIT_CARD_GENERATED = 1 AND asi.PROGRAM_ID = $program AND asi.DEPT_ID = $department AND asi.FACULTY_ID = $faculty AND asi.SESSION_ID = $session AND asi.OFFER_TYPE='$offer'
            ")->result();
        $this->load->view('admin/applicant/search_applicant_list_napp', $data);
    }

    /**
     * @access none
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function applicant_list_admit_card()
    {
        $data['contentTitle'] = 'Applicant List';
        $data["breadcrumbs"] = array(
            "Applicant" => "#",
            "Approved Applicant List" => '#'
            );
        $data["previlages"] = $this->checkPrevilege();
        $data["ac_type"] = '';
        $data['program'] = $this->utilities->findAllByAttribute('ins_program', array("ACTIVE_STATUS" => 1));
        $data["session"] = $this->utilities->admissionSessionList();
        $data['dimention'] = "horizental";
        $data['applicant'] = $this->db->query("select a.* from applicant_personal_info a WHERE ELIGIBLE_BY_DEPT_HEAD != '' AND a.ELIGIBLE_STU_FG != 1 order by a.APPLICANT_ID desc")->result();
        $data['content_view_page'] = 'admin/applicant/admin_card_applicant_list';
        $this->admin_template->display($data);
    }

    function admissionStudent()
    {
        $data['contentTitle'] = 'Applicant List';
        $data["breadcrumbs"] = array(
            "Applicant" => "#",
            "Final Approved List" => '#'
            );
        $data["previlages"] = $this->checkPrevilege();
        $data["ac_type"] = '';
        $data['program'] = $this->utilities->findAllByAttribute('ins_program', array("ACTIVE_STATUS" => 1));
        $data["session"] = $this->utilities->admissionSessionList();
        $data['dimention'] = "horizental";
        $data['applicant'] = $this->db->query("select a.*, b.PROGRAM_NAME, c.DEPT_NAME from applicant_personal_info a
            INNER JOIN ins_program b ON a.PROGRAM_ID=b.PROGRAM_ID
            INNER JOIN ins_dept c ON a.DEPT_ID=c.DEPT_ID
            WHERE a.APPROVE_FOR_ADMIT=1 AND a.ELIGIBLE_STU_FG=0 order by a.APPLICANT_ID desc")->result();

        $data['content_view_page'] = 'admin/applicant/admission_student_list';
        $this->admin_template->display($data);
    }

    /**
     * @access none
     * @param  none
     * @author Abhijit Mondal Abhi <abhijit@atilimited.net>
     * @return View
     */

    function loadAdmissionStudentList()
    {
        $data['applicant'] = $this->db->query("select a.*, b.PROGRAM_NAME, c.DEPT_NAME from applicant_personal_info a
            INNER JOIN ins_program b ON a.PROGRAM_ID=b.PROGRAM_ID
            INNER JOIN ins_dept c ON a.DEPT_ID=c.DEPT_ID
            WHERE a.APPROVE_FOR_ADMIT=1 AND a.ELIGIBLE_STU_FG=0 order by a.APPLICANT_ID desc")->result();

        $this->load->view('admin/applicant/search_admission_student_list',$data);

    }

    /**
     * @access none
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function applicant_list_admit_card_prg_ses_wise()
    {

        $PROGRAM_ID = $this->input->post('PROGRAM_ID');
        $ADM_SES = $this->input->post('YSESSION_ID');
        $data['adm_ses'] = $ADM_SES; 
        $data['applicant'] = $this->db->query("select a.* from applicant_personal_info a WHERE ELIGIBLE_BY_DEPT_HEAD != '' AND a.ELIGIBLE_STU_FG != 1 and a.PROGRAM_ID=$PROGRAM_ID and a.ADM_SESSION_ID=$ADM_SES order by a.APPLICANT_ID desc")->result();
        $this->load->view('admin/applicant/admin_card_applicant_list_prog_ses_wise', $data);

    }




    /**
     * @access none
     * @param  none
     * @author Abhijit Mondal Abhi <abhijit@atilimited.net>
     * @return none
     */


    function admission_student_list()
    {
        $PROGRAM_ID = $this->input->post('PROGRAM_ID');
        $ADM_SES = $this->input->post('YSESSION_ID');

        $data['adm_ses'] = $ADM_SES;
        //$data['batch'] = $this->utilities->findAllByAttributeFromBatch($ADM_SES);        
        $data['batch'] = $this->utilities->programWiseBatchList($PROGRAM_ID);
        $data['section'] = $this->db->query("SELECT a.SECTION_ID,a.NAME FROM aca_section a;")->result();
        $data['applicant'] = $this->applicant_model->getApplicantForAdmission($PROGRAM_ID ,$ADM_SES );
        //echo '<pre>'; print_r($data['applicant']); exit;
        $this->load->view('admin/applicant/admission_student_list_ses_wise', $data);

    }


    /**
     * @access none
     * @param  none
     * @author Abhijit Mondal Abhi <abhijit@atilimited.net>
     * @return none
     */

    function applicant_to_student()
    {
        $section_id = $this->input->post('SECTION_ID');
        $batch_id = $this->input->post('BATCH_ID');
        $all_applicant_id = $this->input->post('APPLICANT_ID');

        foreach ($all_applicant_id as $key => $value) {

            $APPLICANT_ID = $all_applicant_id[$key];
            
            $applicant_personal_info = $this->utilities->findByAttribute("applicant_personal_info", array("APPLICANT_ID" => $APPLICANT_ID));
            $applicant_academic_info = $this->utilities->findAllByAttribute("applicant_acadimicinfo", array("APPLICANT_ID" => $APPLICANT_ID));
            $applicant_address_info = $this->utilities->findAllByAttribute("applicant_adressinfo", array("APPLICANT_ID" => $APPLICANT_ID));
            $applicant_guardian_info = $this->utilities->findAllByAttribute("applicant_gurdianinfo", array("APPLICANT_ID" => $APPLICANT_ID));


            $admission_ses_data = $this->utilities->findByAttribute('adm_ysession', array("YSESSION_ID" => $applicant_personal_info->ADM_SESSION_ID));
            $ins_ses_data = $this->utilities->findByAttribute('ins_ysession', array("IS_CURRENT" => 1));

            $ud_faculty_id = $this->utilities->findByAttribute('ins_faculty', array("FACULTY_ID" => $applicant_personal_info->FACULTY_ID));
            $ud_program_id = $this->utilities->findByAttribute('ins_program', array("PROGRAM_ID" => $applicant_personal_info->PROGRAM_ID));
            $registration_no = $this->utilities->get_registration_no($admission_ses_data->DINYEAR, $admission_ses_data->SESSION_ID, $ud_faculty_id->UD_SLNO, $ud_program_id->UD_SLNO);
            $applicant_personal_data = array(

                'REGISTRATION_NO' => $registration_no,
                'LOGIN_PASSWORD' => '123456',
                'ADM_SESSION_ID' => $applicant_personal_info->ADM_SESSION_ID,
                'SESSION_ID' => $ins_ses_data->YSESSION_ID,
                'DEGREE_ID' => $applicant_personal_info->DEGREE_ID,
                'FACULTY_ID' => $applicant_personal_info->FACULTY_ID,
                'DEPT_ID' => $applicant_personal_info->DEPT_ID,
                'PROGRAM_ID' => $applicant_personal_info->PROGRAM_ID,
                'BATCH_ID' => $batch_id,
                'FULL_NAME_EN' => $applicant_personal_info->FULL_NAME_EN,
                'FULL_NAME_BN' => $applicant_personal_info->FULL_NAME_BN,

                'GENDER' => $applicant_personal_info->GENDER,
                'MOBILE_NO' => $applicant_personal_info->MOBILE_NO,
                'NATIONALITY' => $applicant_personal_info->NATIONALITY,
                'NATIONAL_ID' => $applicant_personal_info->NATIONAL_ID,
                'EMAIL_ADRESS' => $applicant_personal_info->EMAIL_ADRESS,
                'FATHER_NAME' => $applicant_personal_info->FATHER_NAME,
                'MOTHER_NAME' => $applicant_personal_info->MOTHER_NAME,
                'MARITAL_STATUS' => $applicant_personal_info->MARITAL_STATUS,
                'DATH_OF_BIRTH' => $applicant_personal_info->DATH_OF_BIRTH,
                'PLACE_OF_BIRTH' => $applicant_personal_info->PLACE_OF_BIRTH,
                'BIRTH_CERTIFICATE' => $applicant_personal_info->BIRTH_CERTIFICATE,
                'HEIGHT_CM' => $applicant_personal_info->HEIGHT_CM,
                'BLOOD_GROUP' => $applicant_personal_info->BLOOD_GROUP,
                'HEIGHT_FEET' => $applicant_personal_info->HEIGHT_FEET,
                'HEIGHT_INCHES' => $applicant_personal_info->HEIGHT_INCHES,
                'WEIGHT_KG' => $applicant_personal_info->WEIGHT_KG,
                'WEIGHT_LBS' => $applicant_personal_info->WEIGHT_LBS,
                'RELIGION_ID' => $applicant_personal_info->RELIGION_ID,
                'PASSPORT_NO' => $applicant_personal_info->PASSPORT_NO,
                'ANNUAL_INCOME' => $applicant_personal_info->ANNUAL_INCOME,
                'SCHOLARSHIP' => $applicant_personal_info->SCHOLARSHIP,
                'SCHOLARSHIP_DESC' => $applicant_personal_info->SCHOLARSHIP_DESC,
                'EXPELLED' => $applicant_personal_info->EXPELLED,
                'EXPELLED_DESC' => $applicant_personal_info->EXPELLED_DESC,
                'ARRESTED' => $applicant_personal_info->ARRESTED,
                'ARRESTED_DESC' => $applicant_personal_info->ARRESTED_DESC,
                'CONVICTED' => $applicant_personal_info->CONVICTED,
                'CONVICTED_DESC' => $applicant_personal_info->CONVICTED_DESC,
                'SIBLING_EXIST' => $applicant_personal_info->SIBLING_EXIST,
                'SBLN_ROLL_NO' => $applicant_personal_info->SBLN_ROLL_NO,
                'TERMS_AND_CONDITION' => $applicant_personal_info->TERMS_AND_CONDITION,
                'ACTIVE_STATUS' => $applicant_personal_info->ACTIVE_STATUS,
                'APPLY_BEFORE' => $applicant_personal_info->APPLY_BEFORE,
                'APPLY_SEMESTER' => $applicant_personal_info->APPLY_SEMESTER,
                'APPLY_YEAR' => $applicant_personal_info->APPLY_YEAR,
                'SECTION_ID' => $section_id,
                );
            // print_r( $applicant_personal_data);exit;
            // User Image moved from Applicant folder to Student folder
            //  copy('upload/applicant/photo/'.$applicant_personal_info->PHOTO, 'upload/student/photo/'.$applicant_personal_data['REGISTRATION_NO'].'.png');
            $photo_ext = pathinfo('upload/applicant/photo/' . $applicant_personal_info->PHOTO);
            $sig_ext = pathinfo('upload/applicant/signature/' . $applicant_personal_info->SIGNATURE_PHOTO);
            copy('upload/applicant/photo/' . $applicant_personal_info->PHOTO, 'upload/student/photo/' .'photo_'. $applicant_personal_data['REGISTRATION_NO'] . '.' . $photo_ext['extension']);
            copy('upload/applicant/signature/' . $applicant_personal_info->SIGNATURE_PHOTO, 'upload/student/signature/' .'signature_'. $applicant_personal_data['REGISTRATION_NO'] . '.' . $sig_ext['extension']);

            $applicant_personal_data['PHOTO'] = 'photo_' . $registration_no . '.' . $photo_ext['extension'];
            $applicant_personal_data['SIGNATURE_PHOTO'] = 'signature_' . $registration_no . '.' . $sig_ext['extension'];

            //print_r( $applicant_personal_data);exit;

            // Get Last Insert ID
            $last_insert_id = $this->utilities->insert('student_personal_info', $applicant_personal_data);

            foreach ($applicant_academic_info as $row_academic_info) {
                $academic_info = array(

                    'STUDENT_ID' => $last_insert_id,
                    'EXAM_DEGREE_ID' => $row_academic_info->EXAM_DEGREE_ID,
                    'PASSING_YEAR' => $row_academic_info->PASSING_YEAR,
                    'BOARD' => $row_academic_info->BOARD,
                    'MAJOR_GROUP_ID' => $row_academic_info->MAJOR_GROUP_ID,
                    'RESULT_GRADE' => $row_academic_info->RESULT_GRADE,
                    'RESULT_GRADE_WA' => $row_academic_info->RESULT_GRADE_WA,
                    'INSTITUTION' => $row_academic_info->INSTITUTION
                    );

                $this->utilities->insert('student_acadimicinfo', $academic_info);
            }

            foreach ($applicant_address_info as $row_address_info) {
                $address_info = array(

                    'STUDENT_ID' => $last_insert_id,
                    'ADRESS_TYPE' => $row_address_info->ADRESS_TYPE,
                    'SAS_PSORPR' => $row_address_info->SAS_PSORPR,
                    'VILLAGE_WARD' => $row_address_info->VILLAGE_WARD,
                    'UNION_ID' => $row_address_info->UNION_ID,
                    'THANA_ID' => $row_address_info->THANA_ID,
                    'POST_OFFICE_ID' => $row_address_info->POST_OFFICE_ID,
                    'POLICE_STATION_ID' => $row_address_info->POLICE_STATION_ID,
                    'DISTRICT_ID' => $row_address_info->DISTRICT_ID,
                    'DIVISION_ID' => $row_address_info->DIVISION_ID,
                    'ACTIVE_FLAG' => 1
                    );

                $this->utilities->insert('student_adressinfo', $address_info);
            }

            foreach ($applicant_guardian_info as $row_guardian_info) {
                $guardian_info = array(

                    'STUDENT_ID' => $last_insert_id,
                    'GURDIAN_NAME' => $row_guardian_info->GURDIAN_NAME,
                    'OCCUPATION' => $row_guardian_info->OCCUPATION,
                    'MOBILE_NO' => $row_guardian_info->MOBILE_NO,
                    'EMAIL_ADRESS' => $row_guardian_info->EMAIL_ADRESS,
                    'WORKING_ORG' => $row_guardian_info->WORKING_ORG,
                    'GUARDIAN_TYPE' => $row_guardian_info->GUARDIAN_TYPE,
                    );

                $this->utilities->insert('student_gurdianinfo', $guardian_info);
            }

            $this->utilities->updateData('applicant_personal_info', array('ELIGIBLE_STU_FG' => 1), array('APPLICANT_ID' => $APPLICANT_ID));

        }

    }


    /**
     * @access none
     * @param
     * @author Abhijit Mondal Abhi <abhijit@atilimited.net>
     * @return
     */
    function existing_to_student()
    {
        $adm_session_id = $this->input->post('ADA_SESSION_ID');
        $ins_session_id = $this->input->post('INS_SESSION_ID');
        $program_id = $this->input->post('PROGRAM_ID');
        $batch_id = $this->input->post('BATCH_ID');
        $section_id = $this->input->post('SECTION_ID');
        $all_student_id = $this->input->post('STUDENT_ID');

        $program_info = $this->utilities->findByAttribute('ins_program', array("PROGRAM_ID" => $program_id));

        for ($i = 0; $i < sizeof($all_student_id); $i++) {

            $STUDENT_ID = $all_student_id[$i];

            $student_personal_info = array(

                'ADM_SESSION_ID' => $adm_session_id,
                'SESSION_ID' => $ins_session_id,
                'DEGREE_ID' => $program_info->DEGREE_ID,
                'FACULTY_ID' => $program_info->FACULTY_ID,
                'DEPT_ID' => $program_info->DEPT_ID,
                'PROGRAM_ID' => $program_id,
                'BATCH_ID' => $batch_id,
                'SECTION_ID' => $section_id,
                );

            $this->utilities->updateData('student_personal_info', $student_personal_info, array('STUDENT_ID' => $STUDENT_ID));
        }

    }

    /**
     * @access none
     * @param  Selected_applicant
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function allApplicantCardGenerateApproved()
    {
        $applicantId = $this->input->post("chkApplicant");
        for ($i = 0; $i < sizeof($applicantId); $i++) {
            $update = $this->applicantCardGenerateApproved($applicantId[$i], 'approved');
        }
        if ($update == 1) {
            echo "<div class='alert alert-success'>Approved successfully &nbsp;<span class='text-primary'> <i class='fa fa-check'></i></div>";
        } else {
            echo "&nbsp;&nbsp;<span class='btn btn-danger btn-sm'>Already Exited&nbsp;<span class='text-primary'> <i class='fa fa-check'></i></span></span>";
        }
    }

    /**
     * @access none
     * @param  applicant_id
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function applicantCardGenerateApproved($applicantId, $flag = '')
    {
        $app = $this->utilities->findByAttribute('adm_applicant_info', array("APPLICANT_ID" => $applicantId));

        $year = date('Y');
        $session = $app->SESSION_ID;
        $program = $app->PROGRAM_ID;
        $ROLL_NO = $this->utilities->get_addmission_roll_number($year, $session, $program);
        $appUpdate = array(
            'ADMIT_CARD_GENERATED' => 1,
            'ROLL_NO' => $ROLL_NO
            );
        $update = $this->utilities->updateData('adm_applicant_info', $appUpdate, array("APPLICANT_ID" => $applicantId));
        if ($update) {
            if ($flag == '') {
                echo "<span class='text-danger'> <i class='fa fa-check'></i></span>";
            } else {
                return 1;
            }
        }
    }

    /**
     * @access none
     * @param  faculty , dept, program, session
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function searchApplicantAddGen()
    {
        $faculty = $this->input->post('faculty');
        $department = $this->input->post('department');
        $program = $this->input->post('program');
        $session = $this->input->post('session');
        $data['applicant'] = $this->db->query(" SELECT asi.*, d.DEPT_NAME, p.PROGRAM_NAME, f.FACULTY_NAME, sv.SESSION_NAME, ml.LKP_NAME
            FROM adm_applicant_info asi
            INNER JOIN program p on p.PROGRAM_ID = asi.PROGRAM_ID
            INNER JOIN department d on d.DEPT_ID = asi.DEPT_ID
            INNER JOIN faculty f on f.FACULTY_ID = asi.FACULTY_ID
            INNER JOIN session_view sv on sv.SESSION_ID = asi.SESSION_ID
            INNER JOIN m00_lkpdata ml on ml.LKP_ID = asi.GENDER
            WHERE asi.PROGRAM_ID = $program AND asi.DEPT_ID = $department AND asi.FACULTY_ID = $faculty AND asi.SESSION_ID = $session
            ")->result();
        $this->load->view('admin/applicant/search_applicant_list_acg', $data);
    }

    /**
     * @access none
     * @param  faculty , dept, program, session
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return template
     */
    function searchPassedApplicantList()
    {
        $faculty = $this->input->post('faculty');
        $department = $this->input->post('department');
        $program = $this->input->post('program');
        $session = $this->input->post('session');
        $data['applicant'] = $this->db->query(" SELECT asi.*, d.DEPT_NAME, p.PROGRAM_NAME, f.FACULTY_NAME, sv.SESSION_NAME, ml.LKP_NAME
            FROM adm_applicant_info asi
            INNER JOIN program p on p.PROGRAM_ID = asi.PROGRAM_ID
            INNER JOIN department d on d.DEPT_ID = asi.DEPT_ID
            INNER JOIN faculty f on f.FACULTY_ID = asi.FACULTY_ID
            INNER JOIN session_view sv on sv.SESSION_ID = asi.SESSION_ID
            INNER JOIN m00_lkpdata ml on ml.LKP_ID = asi.GENDER
            WHERE asi.PASSED = 1 AND asi.ADMIT_CARD_GENERATED = 1 AND asi.PROGRAM_ID = $program AND asi.DEPT_ID = $department AND asi.FACULTY_ID = $faculty AND asi.SESSION_ID = $session
            ")->result();
        $this->load->view('admin/applicant/search_passed_applicant_list', $data);
    }

    /**
     * @methodName  applicants()
     * @access
     * @param
     * @author      Emdadul <Emdadul@atilimited.net>
     * @return      Student List accourding to search result
     */
    function existing_students()
    {
        $data['contentTitle'] = 'Student List';
        $data['breadcrumbs'] = array(
            'Admin' => 'admin/index',
            'Applicant List' => '#'
            );
        $data["previlages"] = $this->checkPrevilege();
        $data['dimention'] = "horizental";
        $data['ac_type'] = '';
        $data['faculty'] = $this->utilities->findAllByAttribute('ins_faculty', array("ACTIVE_STATUS" => 1));
        $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
        //$data["session"] = $this->utilities->getAll("session_view");
        $data["session"] = $this->utilities->admissionSessionList();
        $data["applicant"] = $this->finance_model->getAdmittedStudentList($faculty = '',$department = '',$program = '', $semester = '', $session ='');
        //$data["applicant"] = $this->finance_model->getAdmittedStudentList($FACULTY_ID = '',$DEPT_ID = '',$PROGRAM_ID = '');
//        $data['applicant'] = $this->db->query("SELECT a.*,c.FACULTY_NAME,d.DEPT_NAME,e.PROGRAM_NAME,f.SESSION_NAME,g.LKP_NAME from students_info a
//            JOIN stu_semesterinfo b on (a.STUDENT_ID = b.STUDENT_ID and b.IS_CURRENT = 1)
//            JOIN faculty c on b.FACULTY_ID = c.FACULTY_ID
//            JOIN department d on b.DEPT_ID=d.DEPT_ID
//            JOIN program e on b.PROGRAM_ID = e.PROGRAM_ID
//            JOIN session_view f on b.SESSION_ID=f.SESSION_ID
//            JOIN m00_lkpdata g on b.SEMESTER_ID=g.LKP_ID")->result();
        $data['content_view_page'] = 'admin/applicant/existing_student/index';
        $this->admin_template->display($data);
    }

    /**
     * @methodName  applicants()
     * @access
     * @param       faculty , departmen, program, session, semester.
     * @author      Emdadul <Emdadul@atilimited.net>
     * @return      Student List accourding to search result
     */
    function searchExistingStu()
    {

        $faculty = $this->input->post("faculty");
        $department = $this->input->post("department");
        $program = $this->input->post("program");
        $semester = $this->input->post("semester");
        $session = $this->input->post("session");
        $data["applicant"] = $this->finance_model->getAdmittedStudentList($faculty,$department,$program, $semester, $session);
        /*$data['applicant'] = $this->db->query("SELECT a.*, c.FACULTY_NAME, d.DEPT_NAME, e.PROGRAM_NAME, f.SESSION_NAME, g.LKP_NAME
         FROM   students_info a
         JOIN stu_semesterinfo b ON a.STUDENT_ID = b.STUDENT_ID
         JOIN faculty c ON b.FACULTY_ID = c.FACULTY_ID
         JOIN department d ON b.DEPT_ID = d.DEPT_ID
         JOIN program e on b.PROGRAM_ID = e.PROGRAM_ID
         JOIN session_view f on b.SESSION_ID = f.SESSION_ID
         JOIN m00_lkpdata g on b.SEMESTER_ID = g.LKP_ID
         WHERE b.FACULTY_ID = $faculty AND b.DEPT_ID = $department AND b.PROGRAM_ID = $program AND b.SEM_SESSION = $session AND b.SEMESTER_ID =  $semester ")->result();
          */
         $this->load->view('admin/applicant/existing_student/student_list', $data);
     }

     function test()
     {
        $data['contentTitle'] = 'Student List';
        $data['breadcrumbs'] = array(
            'Admin' => 'admin/index',
            'Applicant List' => '#'
            );

        $data['content_view_page'] = 'test';
        $this->admin_template->display($data);
    }

    function imageResize()
    {
        require(APPPATH . 'views/common/image_upload/class.upload.php');

        $foo = new Upload($_FILES['photo']);
        if ($foo->uploaded) {
            // large size image
            //$foo->file_new_name_body = 'foo';
            $foo->image_resize = true;
            $foo->image_y = 300;
            $foo->image_x = 280;
            $foo->image_border = 1;
            //$foo->image_border_color    = '#231F20';
            $foo->allowed = array('image/*');
            $foo->Process('upload/existing_studnet_photo/large/');
            if ($foo->processed) {
                echo $foo->file_src_name;
            } else {
                echo 'error : ' . $foo->error;

            }

            // medium size image
            //$foo->file_new_name_body = 'foo';
            $foo->image_resize = true;
            $foo->image_y = 135;
            $foo->image_x = 135;
            $foo->image_border = 1;
            $foo->image_border_color = '#231F20';
            $foo->allowed = array('image/*');
            $foo->Process('upload/existing_studnet_photo/');
            $foo->processed;
            // thumbs size image
            // $foo->file_new_name_body = 'image_resized';
            $foo->image_resize = true;
            $foo->image_y = 50;
            $foo->image_x = 50;
            $foo->image_border = 1;
            $foo->image_border_color = '#231F20';
            $foo->allowed = array('image/*');
            $foo->Process('upload/existing_studnet_photo/thumbs/');
            $foo->processed;

        }
    }


    /*
      * @methodName seatMapping()
      * @access
      * @author     Abhijit M. Abhi <abhijit@atilimited.net>
      * @param      none
      * @return
      */

    function seatMapping()
    {
        $data['contentTitle'] = 'Seat';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Seat Mapping' => '#',
            );
        $data["previlages"] = $this->checkPrevilege();
        $data['resident_building']=$this->utilities->findAllByAttribute('sa_building',array('BUILDING_TYPE'=>347));
        $data["building_floor"] = $this->utilities->findAllFromView("building_floor");

        $data['content_view_page'] = 'admin/setup/residence/residence_mapping';
        $this->admin_template->display($data);
    }

    /*
     * @methodName addRoomMapping()
     * @access
     * @author     Abhijit M. Abhi <abhijit@atilimited.net>
     * @param      none
     * @return
     */

    function addRoomMapping()
    {
        $data["ac_type"] = 1;
        $data["campus"] = $this->utilities->findAllByAttribute("sa_campus", array("ACTIVE_STATUS" => 1));
        $data["building_floor"] = $this->utilities->findAllFromView("building_floor");
        $data["resident_seat"]=$this->utilities->findAllFromView("resident_seat");
        $this->load->view('admin/setup/residence/add_mapping', $data);
    }

    /*
     * @methodName createRoomMapping()
     * @access
     * @author     Abhijit M. Abhi <abhijit@atilimited.net>
     * @param      none
     * @return
     */

    function createRoomMapping()
    {

        $building_id = $this->input->post('BUILDING_ID');
        $floor_id = $this->input->post('FLOOR_ID');
        $room_no = $this->input->post('ROOM_NO');
        $seat_no = $this->input->post('SEAT_NO');  
        $status = ((isset($_POST['status'])) ? 1 : 0);

        for ($i = 0; $i < sizeof($seat_no); $i++) {
            $mapping_room = array(

                'BUILDING_ID' => $building_id,
                'FLOOR_ID' => $floor_id,
                'ROOM_ID' => $room_no,
                'SEAT_NO' => $seat_no[$i],                 
                'BOOKED_STATUS' => 0,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user_session["USER_ID"]

                );
            $this->utilities->insertData($mapping_room, 'resident_seat_mapping'); 
        }
        echo "<div class='alert alert-success'> Create successfully</div>"; 
        
    }

    function residentSeatStatus(){

        $building_id = $this->input->post('BUILDING_ID');
        $floor_id = $this->input->post('FLOOR_ID');
        //echo $floor_id ;exit;
        $data['building_id']=$building_id ;
        $data['floor_id']=$floor_id;
        $data['room_status']=$this->resident_model->getRoomStatus($building_id,$floor_id);
        $this->load->view('admin/setup/residence/resident_seat_status',$data);

    }
    function residentSeatBooking(){

        $data['seat_book_id']=$this->input->post("param");
        $data['resident_application']=$this->resident_model->getResidentApplication();
        $this->load->view('admin/setup/residence/resident_seat_booking',$data);

    }
    function viewResidentSeatBooking(){

        $data['seat_book_id']=$this->input->post("param");
        $data['seat_book_details']=$this->resident_model->getResidentStudentInformation($data['seat_book_id']);
        $this->load->view('admin/setup/residence/view_resident_seat_booking',$data);

    }
    function saveResidentSeatBooking(){ 

        $SEAT_BOOK_ID=$this->input->post('SEAT_BOOK_ID');
        $STUDENT_ID= $this->input->post('STUDENT_ID');
        $this->utilities->updateData('resident_seat_mapping',array('BOOKED_STATUS'=>1), array('SEAT_MAPPING_ID' =>$SEAT_BOOK_ID ));
        $resident_applicant_details=$this->utilities->findByAttribute('resident_application',array('APPLICANT_ID'=> $STUDENT_ID,'APPLICATION_TYPE'=>'A'));
        
        $seat_booking_info=array(
            'APPLICANT_ID'=>$STUDENT_ID,            
            'SEAT_MAPPING_ID'=>  $SEAT_BOOK_ID,           
            'ALLOCATION_START_DT'=>date('Y-m-d',strtotime($this->input->post('ALLOCATION_START_DT'))),
            'ALLOCATION_END_DT'=>date('Y-m-d',strtotime($this->input->post('ALLOCATION_END_DT') )),
            'REMARK'=>$this->input->post('REMARK'),
            'ACTIVE_STATUS'=>1,
            'CREATED_BY'=> $this->user_session['USER_ID'],
            );
        $this->utilities->insertData($seat_booking_info,'resident_seat_allocation');

    }

     /**
     * @methodName waiverInfo()
     * @access 
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed View
     */

     function waiverInfo()
     {

        $data['ins_session']=$this->utilities->academicSessionList();
    //echo "<pre>"; print_r($data['ins_session']);exit();
        $data['program'] = $this->utilities->getAll('ins_program');
        $data['content_view_page']='admin/waiver/add_student_waiver';
        $this->admin_template->display($data);
    }

     /**
     * @methodName waiverListOfStudent()
     * @access 
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed View
     */

     function waiverListOfStudent()
     {
        $session_id = $this->input->post('SESSION_ID');
        $program_id = $this->input->post('PROGRAM_ID');
        $data["s_id"] = $session_id;
        $data["p_id"] = $program_id;
    //$data['student_waiver_info'] = $this->utilities->getAll('student_waiver_info');
        $data["waiver_type"] = $this->db->get('waiver_view')->result();
        $data['waiver_student'] = $this->student_model->waiverListOfStudent($program_id, $session_id);

  // echo "<pre>"; print_r($data['student_waiver_info']); exit;

        $this->load->view('admin/waiver/waiver_student_list', $data);
    }

/**
     * @methodName insertWiverListingData()
     * @access 
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed View
     */

function insertWiverListingData()
{

    $STUDENT_ID = $this->input->post('STUDENT_ID');
    $WAIVER_ID = $this->input->post('WAIVER_ID');
    $PERCENTAGE = $this->input->post('PERCENTAGE');
    $s_id = $this->input->post('s_id');
    $p_id = $this->input->post('p_id');
    $countStuID= count($STUDENT_ID);
    $STU_WAIVER_ID = $this->input->post('STU_WAIVER_ID');
         // echo "<pre>";print_r($STUDENT_ID );exit();

    for ($i=0; $i <$countStuID; $i++) {


       $waiver_info= array(
        'STUDENT_ID' => $STUDENT_ID[$i],
        'WAIVER_TYPE' => $this->input->post('WAIVER_ID_'.$STUDENT_ID[$i]),
        'PERCENTAGE' => $this->input->post('PERCENTAGE_'.$STUDENT_ID[$i]),
        'SESSION_ID' => $s_id,
        'ACTIVE_STATUS' => 1,
        'CREATED_BY'=> $this->user_session['USER_ID'],

        ); 

       $check = $this->utilities->hasInformationByThisId("student_waiver_info", array("STUDENT_ID" => $STUDENT_ID[$i], "SESSION_ID" => $s_id[$i]));

       if (!empty($check)) {
           $stuWaiverId= $STU_WAIVER_ID[$i];
           $this->utilities->updateData('student_waiver_info', $waiver_info, array("STUDENT_ID" => $STUDENT_ID[$i], "SESSION_ID" => $s_id[$i]));

       } else {

        $this->utilities->insert('student_waiver_info', $waiver_info); 

    }


}
$this->session->set_flashdata('Success', 'Student Waiver Inserted Successfully.');      
redirect('admin/waiverInfo');
}



function resetPasswordInsert()
{
    $this->load->view('admin/reset_password/add_password');
} 
public function checkUserPassword() {
  $username = $this->user_session['USERNAME'];
  $check_user = $this->auth_model->login($username);
          // echo "<pre>";print_r($userId );exit();
  $pass = $this->input->post('password');
  if(password_verify($pass, $check_user->USERPW)){
    echo "true";
}else{
    echo "false";
}

}
function updateVisitorProfilePassword(){           

 $username = $this->user_session['USERNAME'];
 $check_user = $this->auth_model->login($username);
 $userName = $check_user->USERNAME;
 $new_password = $this->input->post('passwordNew');
 $options = array(
    'cost' => 11,
    //'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
    );
            // creating the salt
 $h_pass = password_hash($new_password, PASSWORD_BCRYPT, $options);


 $query = $this->db->query("UPDATE sa_users  SET USERPW = '$h_pass' WHERE USERNAME='$userName'");

 if ($query == TRUE) {
    echo "<div class='alert alert-success'>Your password has been reset</div>";
}
else{
    echo "<div class='alert alert-danger'>Your password has been reset failed</div>";
}

}
function userLog(){
    $data['contentTitle'] = 'User Log';
    $data['breadcrumbs'] = array(
        'Admin' => '#',
        'User Log' => '#',
    );
    $data["previlages"] = $this->checkPrevilege();
    $data['user_log'] = $this->db->query("SELECT * FROM user_logs order by LOGIN_DATE desc")->result();
    $data['content_view_page'] = 'admin/user_log';
    $this->admin_template->display($data);
}

    /**
     * @methodName applicantInfoPdf()
     * @access 
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed View
     */

    function applicantInfoPdf($param_applicant_id = '')
    {
      $data['pageTitle'] = 'Print PDF';      
    if ($param_applicant_id != '') {
            $APPLICANT_ID = $param_applicant_id;
        } else {
            $APPLICANT_ID = $_POST["APPLICANT_ID"];
        }

        $data['applicant_id'] = $APPLICANT_ID;
        $data["fathersInfo"] = $this->applicant_model->getApplicantFatherInfo($APPLICANT_ID);
        $data["applicant_info"] = $this->applicant_model->getAppicantInfoAll($APPLICANT_ID);
         //echo "<pre>";print_r($data['applicant_info']);exit();
        $data["motherInfo"] = $this->applicant_model->getApplicantMotherInfo($APPLICANT_ID);
        $data["local_guardian"] = $this->applicant_model->getApplicantLocalGuardianInfo($APPLICANT_ID);
        $data['local_present_adddress'] = $this->applicant_model->getLocalPresentAddress($APPLICANT_ID);
        $data['local_permanent_adddress'] = $this->applicant_model->getLocalPermanentAddress($APPLICANT_ID);
        $data['academic'] = $this->applicant_model->getApplicantAcademicInfo($APPLICANT_ID);

      include('mpdf/mpdf.php');

      $mpdf = new mPDF('','A4',10,'');
      $mpdf->autoLangToFont = true;
      $mpdf->SetTitle('Applicant Information');
      $mpdf->mirrorMargins = 1;
      $mpdf->useOnlyCoreFonts = true;
      $report = $this->load->view('admin/applicant_list_info/applicant_info_pdf', $data, TRUE);
            $mpdf->WriteHTML("$report");
      $mpdf->SetHTMLFooter("$footer");
      $mpdf->Output();
      exit;
    }


    /**
     * @methodName  hrDashboard()
     * @access
     * @param
     * @author      Abu Nawim <nawim@atilimited.net>
     * @return      Redirect HR Dashboard from main dashboard
     */

    function hrDashboard(){

        $data['contentTitle'] = 'HR Dashboard ';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Dashboard" => '#'
            );
        $data['pageTitle'] = 'Online University Management System ';
        $current_session= $this->utilities->findByAttribute("adm_ysession", array("IS_CURRENT" => 1));
        $data['programs']  = $this->utilities->findAllByAttribute("ins_program", array("ACTIVE_STATUS" => 1)); 
        $data['content_view_page'] = 'hr_dashboard';
        $this->admin_template->display($data);


    }


    /**
     * @param       userMultipleMailSendList
     * @author      Md.Reazul Islam <reazul@atilimited.net>
     * @return      none
     */
    function userMultipleMailSendList()
    {
        $data['contentTitle'] = 'Users';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'User Mail List' => '#',
            );
        $data["previlages"] = $this->checkPrevilege();

        $data['user_group'] = $this->utilities->getAll('sa_user_group');

        $data['user'] = $this->utilities->getAllUserInfo();
        $data['content_view_page'] = 'admin/faculty/user_mail_list';
        $this->admin_template->display($data);
    }

     /**
     * @param       usersSendMailByGrpLevWise
     * @author      Md.Reazul Islam <reazul@atilimited.net>
     * @return      none
     */

     function usersSendMailByGrpLevWise()
        {
        $data["previlages"] = $this->checkPrevilege('admin/userList');
        //$this->pr($m);
        $groupId = $this->input->post('GROUP_ID');
        $levelId = $this->input->post('LEVEL_ID');
        if($levelId!='' AND $groupId!='')
        {
            $whereString="WHERE  u.USERGRP_ID = $groupId AND u.USERLVL_ID = $levelId";
        }
        else if($levelId=='' AND $groupId!='')
        {
            $whereString="WHERE  u.USERGRP_ID = $groupId";
        }
        else if($levelId!='' AND $groupId=='')
        {
            $whereString="WHERE  u.USERLVL_ID = $levelId";
        }
        else
        {
            $whereString="";
        }
        $data['user']= $this->db->query("SELECT 
                                            u.USERGRP_ID,
                                            u.USERLVL_ID,
                                            u.EMP_ID,
                                            u.DEPT_ID,
                                            u.DESIG_ID,
                                            e.FULL_ENAME,
                                            e.EMP_IMG,
                                            d.DEPT_NAME,
                                            h.DESIGNATION,
                                            l.UGLEVE_NAME,
                                            g.USERGRP_NAME,
                                            u.USERNAME,
                                            u.USER_ID
                                        FROM
                                            sa_users u
                                                LEFT JOIN
                                            sa_user_group g ON u.USERGRP_ID = g.USERGRP_ID
                                                LEFT JOIN
                                            sa_ug_level l ON u.USERLVL_ID = l.UG_LEVEL_ID
                                                LEFT JOIN
                                            hr_emp e ON u.EMP_ID = e.EMP_ID
                                                LEFT JOIN
                                            ins_dept d ON u.DEPT_ID = d.DEPT_ID
                                                LEFT JOIN
                                            hr_desig h ON u.DESIG_ID = h.DESIG_ID
                                    $whereString
                                    ")->result();
         $this->load->view("admin/faculty/usersSendMailByGrpLevWise",$data);
       }

    /**
     * @param       multipleMailSend
     * @author      Md.Reazul Islam <reazul@atilimited.net>
     * @return      none
     */

    public function multipleMailSend()
    {
        if(isset($_POST)){
            $userId= $this->input->post('USER_ID');
            $whereString='';
            foreach ($userId as $key => $value) {
                if ($key == 0) {
                    $whereString.= " WHERE USER_ID = $value";
                  }else{
                    $whereString.= " OR USER_ID = $value";
                  }  
            }
            //echo $whereString;exit();
            $uData=$this->db->query("SELECT u.USER_ID,u.USERNAME,u.USERPW,h.EMAIL,h.FULL_ENAME FROM sa_users u
            LEFT JOIN hr_emp h ON u.EMP_ID = h.EMP_ID  $whereString")->result();
            //echo "<pre>";print_r($uData);exit();
            $subject = "KYAU Account verification";
            if (!empty($userId))  {
                $data['org_info']=$this->utilities->findByAttribute('sa_organizations', array('STATUS' => 1));

                require 'gmail_app/class.phpmailer.php';
                foreach ($uData as $key => $value) {
                $data['Uemail']=$value->EMAIL;
                $data['fullName']=$value->FULL_ENAME;
                $body = $this->load->view('admin/setup/email_template/email_send_multiple', $data , TRUE);
                $mail = new PHPMailer;
                $mail->IsSMTP();
                $mail->Host = "mail.harnest.com";
                $mail->Port = "465";
                $mail->SMTPAuth = true;
                $mail->Username = "dev@atilimited.net";
                $mail->Password = "@ti321$#";
                $mail->SMTPSecure = 'ssl';
                $mail->From = "kyau@atilimited.net";
                //$mail->From = "kyau@gmail.com";
                $mail->FromName = "KYAU";
                $mail->AddAddress($value->EMAIL);
                $mail->IsHTML(TRUE);
                $mail->Subject = $subject;
                $mail->Body =$body;
                 if ($mail->Send()) {
                     $this->session->set_flashdata('Success','Mail sent Successfully.');
                }
    
                }
            }
           else{
        $this->session->set_flashdata('Error','You are not successfully message send!.');
        }
       redirect('admin/userMultipleMailSendList');

        }
        }

        }
