    <?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Teacher extends CI_Controller
    {

        public $user_id = null;
        public $dept_id = null;

        public function __construct()
        {
            parent::__construct();

            if ($this->session->userdata('logged_in') == FALSE) {
                redirect('auth/teacher', 'refresh');
            }
            $user_session = $this->user = $this->session->userdata('logged_in');

            $this->user_id = $user_session['USER_ID'];
            $this->dept_id = $user_session['DEPT_ID'];

            header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            $this->load->model('utilities');
        }

            /**
         * @methodName checkPrevilege()
         * @access none
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
         * @methodName  index()
         * @access
         * @param
         * @author      Rakib Roni
         * <rakib@atilimited.net>
         * @return     faculty ndashboard
         */
        public function index()
        {
            $data['contentTitle'] = 'Dashboard';
            $data["breadcrumbs"] = array("Dashboard" => '#');

            $data['pageTitle'] = 'University student portal';
            $data['content_view_page'] = 'teacher/index';
            $this->teacher_portal->display($data);
        }

        /**
         * @methodName  teacherForm()
         * @access
         * @param
         * @author      Rakib Roni
         * <rakib@atilimited.net>
         * @return      Faculty entry form
         */
        function addTeacher()
        {
            $data['contentTitle'] = 'Teacher Profile';
            $data["breadcrumbs"] = array(
                "Teacher" => "#",
                "Teacher Profile" => '#'
                );
            $data['pageTitle'] = 'Course Mapping';
            $tr_id = $this->user_id;
            $data['pageTitle'] = 'Add Teacher';
            $data['division'] = $this->utilities->getAll('sa_divisions');
            $data['skills'] = $this->utilities->getAll('skills');
            $data['district'] = $this->utilities->getAll('sa_districts');
            $data['thana'] = $this->utilities->getAll('sa_thanas');
            $data['police_station'] = $this->utilities->getAll('sa_police_station');
            $data['union'] = $this->utilities->getAll('sa_unions');
            $data['post_office'] = $this->utilities->getAll('sa_post_offices');
            $data['nationality'] = $this->utilities->getAll('country');
            $data['extra_activity_type'] = $this->utilities->getAll('extra_activity_type');
            $data['religion'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 3));
            $data['merital_status'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 8));
            $data['blood_group'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 4));
            $data['exam_name'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 13));
            $data['board_name'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 24));
            $data['group_name'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 25));
            $data['occupation'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 21));
            $data['relation'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 40));
            $data['teacher_exp'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 66));
            $data['teacher_interest'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 67));
            $data['session'] = $this->utilities->semesterSession();
            $data['faculty'] = $this->utilities->findAllByAttribute('faculty', array('ACTIVE_STATUS' => 1));
            $data['department'] = $this->utilities->findAllByAttribute('department', array('ACTIVE_STATUS' => 1));
            $data['tcr_personal_info'] = $this->db->query("select a.* from sa_users a where a.USER_ID=$tr_id ")->row();
            $data["teacher_email"] = $this->utilities->findAllByAttribute('teacher_staff_contractinfo', array("USER_ID" => $tr_id, "CONTACT_TYPE" => 'E'));
            $data["teacher_contact"] = $this->utilities->findAllByAttribute('teacher_staff_contractinfo', array("USER_ID" => $tr_id, "CONTACT_TYPE" => 'M'));
            $data["fathersInfo"] = $this->db->query("SELECT f.* FROM teacher_staff_parentinfo f WHERE f.USER_ID = '$tr_id' and f.PARENTS_TYPE='F'")->row();
            $data["motherInfo"] = $this->db->query("SELECT f.* FROM teacher_staff_parentinfo f WHERE f.USER_ID = '$tr_id' and f.PARENTS_TYPE='M'")->row();
            $data["teacher_experience"] = $this->db->query("SELECT a.* FROM teacher_staff_experience a WHERE a.USER_ID = $tr_id")->result();
            $data['academic'] = $this->db->query("SELECT a.* FROM teacher_staff_acadimicinfo a WHERE a.USER_ID ='$tr_id' ")->result();
            $data['awards'] = $this->db->query("SELECT a.* FROM teacher_staff_awards a WHERE a.USER_ID ='$tr_id' ")->result();
            $data['affiliations'] = $this->db->query("SELECT a.* FROM teacher_staff_affiliations a WHERE a.USER_ID ='$tr_id' ")->result();
            $data['skill'] = $this->db->query("SELECT a.* FROM teacher_staff_skill a WHERE a.USER_ID ='$tr_id' ")->result();
            $data['interest'] = $this->db->query("SELECT a.* FROM teacher_staff_interests a WHERE a.USER_ID ='$tr_id' ")->result();
            $data['int_travel'] = $this->db->query("SELECT a.* FROM teacher_staff_internationa_travels a WHERE a.USER_ID ='$tr_id' ")->result();
            $data['publication'] = $this->db->query("SELECT a.* FROM teacher_staff_publications a WHERE a.USER_ID ='$tr_id' ")->result();
            $data['disease'] = $this->db->query("SELECT d.TR_DISEASE_ID,d.DISEASE_NAME, d.START_DT, d.END_DT, d.DOCTOR_NAME FROM teacher_staff_diseaseinfo d WHERE d.USER_ID = '$tr_id'")->result();
            $data['local_present_adddress'] = $this->db->query("SELECT a.TR_ADRESS_ID,a.USER_ID, a.ADRESS_TYPE, a.SAS_PSORPR, a.HOUSE_NO_NAME, a.ROAD_AVENO_NAME, a.VILLAGE_WARD, a.DISTRICT_ID, a.DIVISION_ID, a.POLICE_STATION_ID, a.POST_OFFICE_ID, a.THANA_ID, a.UNION_ID,
               (SELECT b.DIVISION_ENAME FROM sa_divisions b WHERE b.DIVISION_ID = a.DIVISION_ID)DIVIS_NAME,
               (SELECT d.DISTRICT_ENAME FROM sa_districts d WHERE d.DISTRICT_ID = a.DISTRICT_ID)DIST_NAME,
               (SELECT p.PS_ENAME FROM sa_police_station p WHERE p.POLICE_STATION_ID = a.POLICE_STATION_ID)PLOSC,
               (SELECT po.POST_OFFICE_ENAME FROM sa_post_offices po WHERE po.POST_OFFICE_ID = a.POST_OFFICE_ID)POSTO,
               (SELECT t.THANA_ENAME FROM sa_thanas t WHERE t.THANA_ID = a.THANA_ID)thn,
               (SELECT u.UNION_NAME FROM sa_unions u WHERE u.UNION_ID = a.UNION_ID)uni FROM teacher_staff_adressinfo a WHERE a.USER_ID = '$tr_id' AND a.ADRESS_TYPE = 'PS'")->row();

            $data["parAddrInfo"] = $this->db->query("SELECT a.TR_ADRESS_ID,a.USER_ID, a.ADRESS_TYPE, a.SAS_PSORPR, a.HOUSE_NO_NAME, a.ROAD_AVENO_NAME, a.VILLAGE_WARD, a.DISTRICT_ID, a.DIVISION_ID, a.POLICE_STATION_ID, a.POST_OFFICE_ID, a.THANA_ID, a.UNION_ID,
               (SELECT b.DIVISION_ENAME FROM sa_divisions b WHERE b.DIVISION_ID = a.DIVISION_ID)DIVIS_NAME,
               (SELECT d.DISTRICT_ENAME FROM sa_districts d WHERE d.DISTRICT_ID = a.DISTRICT_ID)DIST_NAME,
               (SELECT p.PS_ENAME FROM sa_police_station p WHERE p.POLICE_STATION_ID = a.POLICE_STATION_ID)PLOSC,
               (SELECT po.POST_OFFICE_ENAME FROM sa_post_offices po WHERE po.POST_OFFICE_ID = a.POST_OFFICE_ID)POSTO,
               (SELECT t.THANA_ENAME FROM sa_thanas t WHERE t.THANA_ID = a.THANA_ID)thn,
               (SELECT u.UNION_NAME FROM sa_unions u WHERE u.UNION_ID = a.UNION_ID)uni FROM teacher_staff_adressinfo a WHERE a.USER_ID = '$tr_id' AND a.ADRESS_TYPE != 'PS'")->row();

            $data['foreign_ps_address'] = $this->db->query("select a.* FROM teacher_staff_adressinfo_foreign a where a.ADRESS_TYPE='PS' and  a.USER_ID='$tr_id' ")->row();
            $data['foreign_pr_address'] = $this->db->query("select a.* FROM teacher_staff_adressinfo_foreign a where a.ADRESS_TYPE='PR' and  a.USER_ID='$tr_id' ")->row();

            //echo " < pre > ";print_r($data["teacher_experience"]);exit;
            $data['content_view_page'] = 'teacher/teacher_form';
            $this->admin_template->display($data);
        }

        /**
         * @methodName  updateTrPersonalInfo()
         * @access
         * @param
         * @author      Rakib Roni <rakib@atilimited.net>
         * @return      update teacher personal information by teacher
         */
        function updateTrPersonalInfo()
        {
            $tr_session = $this->session->userdata('logged_in');
            $tr_id = $tr_session["USER_ID"];
            $file_name = "";
            if (!empty($_FILES)) {
                $this->load->library('upload');
                $this->load->helper('string');
                $config['upload_path'] = 'upload/faculty_teacher/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['overwrite'] = false;
                $config['remove_spaces'] = true;
                $this->upload->initialize($config);
                if ($this->upload->do_upload('photo')) {
                    $file_data = $this->upload->data();
                    $file_name = $file_data['file_name'];
                }
            }
            $update_teacher_info = array(
                'USER_ID' => $tr_id,
                'FULL_NAME' => $this->input->post('FULL_NAME'),
                'FULL_NAME_BN' => $this->input->post('FULL_NAME_BN'),
                'DOB' => date('Y-m-d', strtotime($this->input->post('DOB'))),
                'GENDER' => $this->input->post('GENDER'),
                'RELIGION' => $this->input->post('RELIGION'),
                'NID' => $this->input->post('NID'),
                'PLACE_OF_BIRTH' => $this->input->post('PLACE_OF_BIRTH'),
                'NATIONALITY' => $this->input->post('NATIONALITY'),
                'MARITAL_STATUS' => $this->input->post('MARITAL_STATUS'),
                'SPOUSE_NAME' => $this->input->post('SPOUSE_NAME'),
                'HEIGHT_FEET' => $this->input->post('HEIGHT_FEET'),
                'HEIGHT_CM' => $this->input->post('HEIGHT_CM'),
                'WEIGHT_KG' => $this->input->post('WEIGHT_KG'),
                'WEIGHT_LBS' => $this->input->post('WEIGHT_LBS'),
                'BLOOD_GROUP' => $this->input->post('BLOOD_GRP'),
                'PASSPORT_NO' => $this->input->post('PASSPORT_NO'), 'HOBBY' => $this->input->post('HOBBY'));
    if ($file_name != "") {
        $update_teacher_info["USER_IMG"] = $file_name;
    }

    if ($this->input->post('USER_ID') != '') {
        $this->utilities->updateData('sa_users', $update_teacher_info, array('USER_ID' => $tr_id));
    } else {
        $this->utilities->insertData($update_teacher_info, 'sa_users');
    }

            //update teacher multiple eamil address
    $EMAIL_ADRESS = $this->input->post('EMAIL_ADRESS');
    $TR_CI_ID = $this->input->post('TR_CI_ID');

            //echo " < pre > ";print_r($EMAIL_ADRESS);exit;
    if (!empty($EMAIL_ADRESS)) {
        for ($i = 0; $i < sizeof($EMAIL_ADRESS); $i++) {

            if ($EMAIL_ADRESS[$i] != "") {
                $email_data = array('CONTACTS' => $EMAIL_ADRESS[$i]);

                if ($TR_CI_ID[$i] == "") {
                    $email_data["USER_ID"] = $tr_id;
                    $email_data["CONTACT_TYPE"] = "E";
                    $email_data["ORG_ID"] = 1;
                    $email_data["DEFAULT_FG"] = 1;
                    $this->utilities->insertData($email_data, 'teacher_staff_contractinfo');
                } else {

                    $this->utilities->updateData('teacher_staff_contractinfo', $email_data, array('TR_CI_ID' => $TR_CI_ID[$i]));
                }
            }
        }
    }

            // update teacher multiple mobile number
    $MOBILE_NO = $this->input->post('MOBILE_NO');
    $TR_CI_ID_M = $this->input->post('TR_CI_ID_M');

    if (!empty($MOBILE_NO)) {
        for ($i = 0; $i < sizeof($MOBILE_NO); $i++) {
            if ($MOBILE_NO[$i] != "") {
                $mobile_data = array('CONTACTS' => $MOBILE_NO[$i]);

                if ($TR_CI_ID_M[$i] == "") {

                    $mobile_data["USER_ID"] = $tr_id;
                    $mobile_data["CONTACT_TYPE"] = "M";
                    $mobile_data["ORG_ID"] = 1;
                    $mobile_data["DEFAULT_FG"] = 1;
                    $this->utilities->insertData($mobile_data, 'teacher_staff_contractinfo');
                } else {

                    $this->utilities->updateData('teacher_staff_contractinfo', $mobile_data, array('TR_CI_ID' => $TR_CI_ID_M[$i]));
                }
            }
        }
    }
    redirect('teacher/addTeacher', 'refresh');
}

        /**
         * @methodName  updateFamillyAndOthers()
         * @access
         * @param
         * @author      Rakib Roni <rakib@atilimited.net>
         * @return      update teacher familly and others information
         */
        function updateFamillyAndOthers()
        {
            $tr_session = $this->session->userdata('logged_in');
            $tr_id = $tr_session["USER_ID"];

            // update father information
            $f_file_name = "";
            if (!empty($_FILES)) {
                $this->load->library('upload');
                $this->load->helper('string');
                $configf['upload_path'] = 'upload/teacher/parents/';
                $configf['allowed_types'] = 'gif|jpg|jpeg|png';
                $configf['overwrite'] = false;
                $configf['remove_spaces'] = true;
                $this->upload->initialize($configf);
                if ($this->upload->do_upload('father_photo')) {
                    $file_data = $this->upload->data();
                    $f_file_name = $file_data['file_name'];
                }
            }
            $TR_PARENT_ID_F = $this->input->post('TR_PARENT_ID_F');
            $fahter_info = array(
                'USER_ID' => $tr_id,
                'PARENTS_TYPE' => 'F',
                'PARENT_NAME' => $this->input->post('FATHER_NAME'),
                'MOBILE_NO' => $this->input->post('FATHER_PHN'),
                'EMAIL_ADRESS' => $this->input->post('FATHER_EMAIL'),
                'OCCUPATION' => $this->input->post('FATHER_OCU'),
                'ECP_FG' => 0, 'ORG_ID' => 1,
                'ACTIVE_FLAG' => 1
                );
            if ($f_file_name != "") {
                $fahter_info["PARENT_PHOTO"] = $f_file_name;
            }
            if ($TR_PARENT_ID_F == "") {
                $mobile_data["USER_ID"] = $tr_id;
                $mobile_data["CONTACT_TYPE"] = "M";
                $mobile_data["ORG_ID"] = 1;
                $mobile_data["DEFAULT_FG"] = 1;
                $this->utilities->insertData($fahter_info, 'teacher_staff_parentinfo');
            } else {

                $this->utilities->updateData('teacher_staff_parentinfo', $fahter_info, array('TR_PARENT_ID' => $TR_PARENT_ID_F));
            }

            // update mother information
            $m_file_name = "";
            if (!empty($_FILES)) {
                $this->load->library('upload');
                $this->load->helper('string');
                $configm['upload_path'] = 'upload/teacher/parents/';
                $configm['allowed_types'] = 'gif|jpg|jpeg|png';
                $configm['overwrite'] = false;
                $configm['remove_spaces'] = true;
                $this->upload->initialize($configm);
                if ($this->upload->do_upload('mother_photo')) {
                    $file_data = $this->upload->data();
                    $m_file_name = $file_data['file_name'];
                }
            }
            $TR_PARENT_ID_M = $this->input->post('TR_PARENT_ID_M');
            $mother_info = array(
                'USER_ID' => $tr_id,
                'PARENTS_TYPE' => 'M',
                'PARENT_NAME' => $this->input->post('MOTHER_NAME'),
                'MOBILE_NO' => $this->input->post('MOTHER_PHN'), 'EMAIL_ADRESS' => $this->input->post('MOTHER_EMAIL'), 'OCCUPATION' => $this->input->post('MOTHER_OCU'), 'ECP_FG' => 0, 'ORG_ID' => 1, 'ACTIVE_FLAG' => 1);
            if ($m_file_name != "") {
                $mother_info["PARENT_PHOTO"] = $m_file_name;
            }

            if ($TR_PARENT_ID_M == "") {
                $mobile_data["USER_ID"] = $tr_id;
                $mobile_data["CONTACT_TYPE"] = "M";
                $mobile_data["ORG_ID"] = 1;
                $mobile_data["DEFAULT_FG"] = 1;
                $this->utilities->insertData($mother_info, 'teacher_staff_parentinfo');
            } else {
                $this->utilities->updateData('teacher_staff_parentinfo', $mother_info, array('TR_PARENT_ID' => $TR_PARENT_ID_M));
            }
            if ($this->input->post('ADDRESS_TYPE') == 'L' && $this->input->post('SAS_PSORPR') == 1) {
                $present_address = array('USER_ID' => $tr_id, 'ADRESS_TYPE' => 'PS', 'SAS_PSORPR' => 'PS', 'VILLAGE_WARD' => $this->input->post('VILLAGE'), 'UNION_ID' => $this->input->post('UNION_ID'), 'THANA_ID' => $this->input->post('THANA_ID'), 'POST_OFFICE_ID' => $this->input->post('POST_OFFICE_ID'), 'POLICE_STATION_ID' => $this->input->post('POLICE_STATION_ID'), 'DISTRICT_ID' => $this->input->post('DISTRICT_ID'), 'DIVISION_ID' => $this->input->post('DIVISION_ID'), 'ACTIVE_FLAG' => 1);
                $teacher_address_type = array('ADDRESS_TYPE' => 'L');
                if ($this->input->post('TR_ADRESS_ID_PS') != '') {
                    $this->utilities->updateData('teacher_staff_adressinfo', $present_address, array('TR_ADRESS_ID' => $this->input->post('TR_ADRESS_ID_PS')));
                    // $this->utilities->updateData('teacher_staff_info', $teacher_address_type, array('USER_ID' => $tr_id));
                    $this->utilities->deleteRowByAttribute('teacher_staff_adressinfo', array('TR_ADRESS_ID' => $this->input->post('TR_ADRESS_ID_PR'), 'ADRESS_TYPE' => 'PR'));
                } else {
                    $this->utilities->insertData($present_address, 'teacher_staff_adressinfo');
                    // $this->utilities->updateData('teacher_staff_info', $teacher_address_type, array('USER_ID' => $tr_id));
                }
            } else if ($this->input->post('ADDRESS_TYPE') == 'L' && $this->input->post('SAS_PSORPR') == 0) {
                $present_address = array('USER_ID' => $tr_id, 'ADRESS_TYPE' => 'PS', 'SAS_PSORPR' => '', 'VILLAGE_WARD' => $this->input->post('VILLAGE'), 'UNION_ID' => $this->input->post('UNION_ID'), 'THANA_ID' => $this->input->post('THANA_ID'), 'POST_OFFICE_ID' => $this->input->post('POST_OFFICE_ID'), 'POLICE_STATION_ID' => $this->input->post('POLICE_STATION_ID'), 'DISTRICT_ID' => $this->input->post('DISTRICT_ID'), 'DIVISION_ID' => $this->input->post('DIVISION_ID'), 'ACTIVE_FLAG' => 1);
                $teacher_address_type = array('ADDRESS_TYPE' => 'L');
                if ($this->input->post('TR_ADRESS_ID_PS') != '') {
                    $this->utilities->updateData('teacher_staff_adressinfo', $present_address, array('TR_ADRESS_ID' => $this->input->post('TR_ADRESS_ID_PS')));
                    // $this->utilities->updateData('teacher_staff_info', $teacher_address_type, array('USER_ID' => $tr_id));
                } else {
                    $this->utilities->insertData($present_address, 'teacher_staff_adressinfo');
                    // $this->utilities->updateData('teacher_staff_info', $teacher_address_type, array('USER_ID' => $tr_id));
                }

                $u_permanent_address = array('USER_ID' => $tr_id, 'ADRESS_TYPE' => 'PR', 'SAS_PSORPR' => '', 'VILLAGE_WARD' => $this->input->post('P_VILLAGE'), 'UNION_ID' => $this->input->post('P_UNION_ID'), 'THANA_ID' => $this->input->post('P_THANA_ID'), 'POST_OFFICE_ID' => $this->input->post('P_POST_OFFICE_ID'), 'POLICE_STATION_ID' => $this->input->post('P_POLICE_STATION_ID'), 'DISTRICT_ID' => $this->input->post('P_DISTRICT_ID'), 'DIVISION_ID' => $this->input->post('P_DIVISION_ID'), 'ACTIVE_FLAG' => 1);

                // $check=$this->utilities->hasInformationByThisId('stu_contractinfo',array('STU_ADRESS_ID'=>$this->input->post('STU_ADRESS_ID_PR'),'ADRESS_TYPE'=>'PR'));
                if ($this->input->post('TR_ADRESS_ID_PR') != '') {
                    $this->utilities->updateData('teacher_staff_adressinfo', $u_permanent_address, array('TR_ADRESS_ID' => $this->input->post('TR_ADRESS_ID_PR')));
                } else {
                    $permanent_address = array('USER_ID' => $tr_id, 'ADRESS_TYPE' => 'PR', 'SAS_PSORPR' => '', 'VILLAGE_WARD' => $this->input->post('P_VILLAGE'), 'UNION_ID' => $this->input->post('P_UNION_ID'), 'THANA_ID' => $this->input->post('P_THANA_ID'), 'POST_OFFICE_ID' => $this->input->post('P_POST_OFFICE_ID'), 'POLICE_STATION_ID' => $this->input->post('P_POLICE_STATION_ID'), 'DISTRICT_ID' => $this->input->post('P_DISTRICT_ID'), 'DIVISION_ID' => $this->input->post('P_DIVISION_ID'), 'ACTIVE_FLAG' => 1);
                    $this->utilities->insertData($permanent_address, 'teacher_staff_adressinfo');
                }
            } else if ($this->input->post('ADDRESS_TYPE') == 'F' && $this->input->post('F_SAS_PSORPR') == 1) {
                $present_address = array('USER_ID' => $tr_id, 'ADRESS_TYPE' => 'PS', 'SAS_PSORPR' => 'PS', 'ADDRESS_LINE_ONE' => $this->input->post('ADDRESS_LINE_ONE'), 'ADDRESS_LINE_TWO' => $this->input->post('ADDRESS_LINE_TWO'), 'CITY' => $this->input->post('CITY'), 'STATE' => $this->input->post('STATE'), 'ZIPCODE' => $this->input->post('ZIPCODE'), 'COUNTRY' => $this->input->post('COUNTRY'), 'ACTIVE_FLAG' => 1);
                $teacher_address_type = array('ADDRESS_TYPE' => 'F');
                if ($this->input->post('TR_FOR_ADRESS_ID_PS') != '') {
                    $this->utilities->updateData('teacher_staff_adressinfo_foreign', $present_address, array('TR_FOR_ADRESS_ID' => $this->input->post('TR_FOR_ADRESS_ID_PS')));
                    // $this->utilities->updateData('teacher_staff_info', $teacher_address_type, array('USER_ID' => $tr_id));
                    $this->utilities->deleteRowByAttribute('teacher_staff_adressinfo_foreign', array('TR_FOR_ADRESS_ID' => $this->input->post('TR_FOR_ADRESS_ID_PR'), 'ADRESS_TYPE' => 'PR'));
                } else {
                    $this->utilities->insertData($present_address, 'teacher_staff_adressinfo_foreign');
                    //  $this->utilities->updateData('teacher_staff_info', $teacher_address_type, array('USER_ID' => $tr_id));
                    $this->utilities->deleteRowByAttribute('teacher_staff_adressinfo', array('USER_ID' => $tr_id));
                }
            } else {
                $present_address = array('USER_ID' => $tr_id, 'ADRESS_TYPE' => 'PS', 'SAS_PSORPR' => '', 'ADDRESS_LINE_ONE' => $this->input->post('ADDRESS_LINE_ONE'), 'ADDRESS_LINE_TWO' => $this->input->post('ADDRESS_LINE_TWO'), 'CITY' => $this->input->post('CITY'), 'STATE' => $this->input->post('STATE'), 'ZIPCODE' => $this->input->post('ZIPCODE'), 'COUNTRY' => $this->input->post('COUNTRY'), 'ACTIVE_FLAG' => 1);
                $teacher_address_type = array('ADDRESS_TYPE' => 'F');
                if ($this->input->post('TR_FOR_ADRESS_ID_PS') != '') {
                    $this->utilities->updateData('teacher_staff_adressinfo_foreign', $present_address, array('TR_FOR_ADRESS_ID' => $this->input->post('TR_FOR_ADRESS_ID_PS')));
                    //  $this->utilities->updateData('teacher_staff_info', $teacher_address_type, array('USER_ID' => $tr_id));
                } else {
                    $this->utilities->insertData($present_address, 'teacher_staff_adressinfo_foreign');
                    // $this->utilities->updateData('teacher_staff_info', $teacher_address_type, array('USER_ID' => $tr_id));
                    $this->utilities->deleteRowByAttribute('teacher_sataff_adressinfo', array('USER_ID' => $tr_id));
                }

                $u_permanent_address = array('USER_ID' => $tr_id, 'ADRESS_TYPE' => 'PR', 'SAS_PSORPR' => '', 'ADDRESS_LINE_ONE' => $this->input->post('F_ADDRESS_LINE_ONE'), 'ADDRESS_LINE_TWO' => $this->input->post('F_ADDRESS_LINE_TWO'), 'CITY' => $this->input->post('F_CITY'), 'STATE' => $this->input->post('F_STATE'), 'ZIPCODE' => $this->input->post('F_ZIPCODE'), 'COUNTRY' => $this->input->post('F_COUNTRY'), 'ACTIVE_FLAG' => 1);

                // $check=$this->utilities->hasInformationByThisId('stu_contractinfo',array('STU_ADRESS_ID'=>$this->input->post('STU_ADRESS_ID_PR'),'ADRESS_TYPE'=>'PR'));
                if ($this->input->post('TR_FOR_ADRESS_ID_PR') != '') {
                    $this->utilities->updateData('teacher_staff_adressinfo_foreign', $u_permanent_address, array('TR_FOR_ADRESS_ID' => $this->input->post('TR_FOR_ADRESS_ID_PR')));
                } else {
                    $permanent_address = array('USER_ID' => $tr_id, 'ADRESS_TYPE' => 'PR', 'SAS_PSORPR' => '', 'ADDRESS_LINE_ONE' => $this->input->post('F_ADDRESS_LINE_ONE'), 'ADDRESS_LINE_TWO' => $this->input->post('F_ADDRESS_LINE_TWO'), 'CITY' => $this->input->post('F_CITY'), 'STATE' => $this->input->post('F_STATE'), 'ZIPCODE' => $this->input->post('F_ZIPCODE'), 'COUNTRY' => $this->input->post('F_COUNTRY'), 'ACTIVE_FLAG' => 1);
                    $this->utilities->insertData($permanent_address, 'teacher_staff_adressinfo_foreign');
                }
            }

            redirect('teacher/addTeacher', 'refresh');
        }

        /**
         * @methodName  updateAcademicInfo()
         * @access
         * @param
         * @author      Rakib Roni <rakib@atilimited.net>
         * @return      teacher acdemic information
         */

        function updateAcademicInfo()
        {
            $EXAM_NAME = $this->input->post('EXAM_NAME');
            $GROUP = $this->input->post('GROUP');
            $INSTITUTE = $this->input->post('INSTITUTE');
            $BOARD = $this->input->post('BOARD');
            $GPA = $this->input->post('GPA');
            $PASSING_YEAR = $this->input->post('PASSING_YEAR');
            $TR_AI_ID = $this->input->post('TR_AI_ID');

            $this->load->library('upload');
            $files = $_FILES;
            $cpt = count($_FILES['CERTIFICATE']['name']);
            for ($i = 0; $i < $cpt; $i++) {
                $_FILES['CERTIFICATE']['name'] = $files['CERTIFICATE']['name'][$i];
                $_FILES['CERTIFICATE']['type'] = $files['CERTIFICATE']['type'][$i];
                $_FILES['CERTIFICATE']['tmp_name'] = $files['CERTIFICATE']['tmp_name'][$i];
                $_FILES['CERTIFICATE']['error'] = $files['CERTIFICATE']['error'][$i];
                $_FILES['CERTIFICATE']['size'] = $files['CERTIFICATE']['size'][$i];
                $this->upload->initialize($this->set_upload_options());
                $this->upload->do_upload('CERTIFICATE');
                $ACHIEVEMENT = $_FILES['CERTIFICATE']['name'];


                $aca_data = array(
                    'EXAM_DEGREE_ID' => $EXAM_NAME[$i],
                    'MAJOR_GROUP_ID' => $GROUP[$i],
                    'INSTITUTION' => $INSTITUTE[$i],
                    'BOARD' => $BOARD[$i],
                    'RESULT_GRADE' => $GPA[$i],
                    'PASSING_YEAR' => $PASSING_YEAR[$i],

                    'USER_ID' => $this->user_id
                    );
                if ($ACHIEVEMENT != "") {
                    $aca_data["ACHIEVEMENT"] = $ACHIEVEMENT;
                }
                if ($TR_AI_ID[$i] == '') {
                    $this->utilities->insertData($aca_data, 'teacher_staff_acadimicinfo');
                } else {

                    $this->utilities->updateData('teacher_staff_acadimicinfo', $aca_data, array('TR_AI_ID' => $TR_AI_ID[$i]));
                }

            }
            redirect('teacher/addTeacher', 'refresh');

        }

        function set_upload_options()
        {
            //upload an image options
            $config = array();
            $config['upload_path'] = 'upload/teacher/academic_certificate/';
            $config['allowed_types'] = '*';
            $config['overwrite'] = FALSE;

            return $config;
        }


        /**
         * @methodName  updateTeacherExp()
         * @access
         * @param
         * @author      Rakib Roni <rakib@atilimited.net>
         * @return      faculty profile
         */
        function updateTeacherExp()
        {

            // update father multiple mobile
            $EXP_TYPE = $this->input->post('EXP_TYPE');
            $DESIGNATION = $this->input->post('DESIGNATION');
            $INSTITUTE = $this->input->post('INSTITUTE');
            $START_DT = $this->input->post('START_DT');
            $END_DT = $this->input->post('END_DT');
            $DESCRIPTION = $this->input->post('DESCRIPTION');


            $TR_RE_ID = $this->input->post('TR_RE_ID');


            if (!empty($EXP_TYPE)) {
                for ($i = 0; $i < sizeof($EXP_TYPE); $i++) {
                    if ($TR_RE_ID[$i] == "") {

                        $exp_data = array(
                            'DESIGNATION' => $DESIGNATION[$i],
                            'INSTITUTE' => $INSTITUTE[$i],
                            'START_DT' => date('Y-m-d', strtotime($START_DT[$i])),
                            'END_DT' => date('Y-m-d', strtotime($END_DT[$i])),
                            'DESCRIPTION' => $DESCRIPTION[$i],
                            'EXP_TYPE' => $EXP_TYPE[$i],
                            'USER_ID' => $this->user_id
                            );

                        $this->utilities->insertData($exp_data, 'teacher_staff_experience');
                    } else {

                        $update_exp_data = array(
                            'DESIGNATION' => $DESIGNATION[$i],
                            'INSTITUTE' => $INSTITUTE[$i],
                            'START_DT' => date('Y-m-d', strtotime($START_DT[$i])),
                            'END_DT' => date('Y-m-d', strtotime($END_DT[$i])),
                            'DESCRIPTION' => $DESCRIPTION[$i],
                            'EXP_TYPE' => $EXP_TYPE[$i],
                            'USER_ID' => $this->user_id
                            );

                        $this->utilities->updateData('teacher_staff_experience', $update_exp_data, array('TR_RE_ID' => $TR_RE_ID[$i]));

                    }
                }
            }
            redirect('teacher/addTeacher', 'refresh');
        }

        /**
         * @methodName  updateAwardsInfo()
         * @access
         * @param
         * @author      Rakib Roni <rakib@atilimited.net>
         * @return      teacher awards information update
         */
        function updateAwardsInfo()
        {
            $AW_REASON = $this->input->post('AW_REASON');
            $AW_FROM = $this->input->post('AW_FROM');
            $AW_DATE = $this->input->post('AW_DATE');
            $DESCRIPTION = $this->input->post('DESCRIPTION');
            $TR_A_ID = $this->input->post('TR_A_ID');
            if (!empty($AW_REASON)) {
                for ($i = 0; $i < sizeof($AW_REASON); $i++) {
                    if ($TR_A_ID[$i] == "") {

                        $aw_data = array(
                            'AW_REASON' => $AW_REASON[$i],
                            'AW_FROM' => $AW_FROM[$i],
                            'AW_DATE' => date('Y-m-d', strtotime($AW_DATE[$i])),
                            'DESCRIPTION' => $DESCRIPTION[$i],
                            'USER_ID' => $this->user_id,
                            );
                        $this->utilities->insertData($aw_data, 'teacher_staff_awards');
                    } else {

                        $Update_aw_data = array(
                            'AW_REASON' => $AW_REASON[$i],
                            'AW_FROM' => $AW_FROM[$i],
                            'AW_DATE' => date('Y-m-d', strtotime($AW_DATE[$i])),
                            'DESCRIPTION' => $DESCRIPTION[$i],
                            'USER_ID' => $this->user_id,
                            );
                        $this->utilities->updateData('teacher_staff_awards', $Update_aw_data, array('TR_A_ID' => $TR_A_ID[$i]));
                    }
                }
            }
            redirect('teacher/addTeacher', 'refresh');
        }

        /**
         * @methodName  updateTeacherAffiliation()
         * @access
         * @param
         * @author      Rakib Roni <rakib@atilimited.net>
         * @return      teacher affiliation information update
         */
        function updateTeacherAffiliation()
        {
            $AF_NAME = $this->input->post('AF_NAME');
            $START_DT = $this->input->post('START_DT');
            $END_DT = $this->input->post('END_DT');

            $TR_AF_ID = $this->input->post('TR_AF_ID');
            if (!empty($AF_NAME)) {
                for ($i = 0; $i < sizeof($AF_NAME); $i++) {
                    if ($TR_AF_ID[$i] == "") {

                        $af_data = array(
                            'AF_NAME' => $AF_NAME[$i],
                            'START_DT' => date('Y-m-d', strtotime($START_DT[$i])),
                            'END_DT' => date('Y-m-d', strtotime($END_DT[$i])),
                            'USER_ID' => $this->user_id
                            );
                        $this->utilities->insertData($af_data, 'teacher_staff_affiliations');
                    } else {

                        $update_af_data = array(
                            'AF_NAME' => $AF_NAME[$i],
                            'START_DT' => date('Y-m-d', strtotime($START_DT[$i])),
                            'END_DT' => date('Y-m-d', strtotime($END_DT[$i])),
                            'USER_ID' => $this->user_id
                            );
                        $this->utilities->updateData('teacher_staff_affiliations', $update_af_data, array('TR_AF_ID' => $TR_AF_ID[$i]));
                    }
                }
            }
            redirect('teacher/addTeacher', 'refresh');
        }

        /**
         * @methodName  updateTeacherSkill()
         * @access
         * @param
         * @author      Rakib Roni <rakib@atilimited.net>
         * @return      faculty profile
         */
        function updateTeacherSkill()
        {
            $SKILL_AREA = $this->input->post('SKILL_AREA');
            $DESCRIPTION = $this->input->post('COM_SKILL_DES');
            $TR_S_ID = $this->input->post('TR_S_ID');

            if (!empty($SKILL_AREA)) {
                for ($i = 0; $i < sizeof($SKILL_AREA); $i++) {

                    if ($TR_S_ID[$i] == "") {

                        $sk_data = array(
                            'SKILL_AREA' => $SKILL_AREA[$i],
                            'DESCRIPTION' => $DESCRIPTION[$i],
                            'USER_ID' => $this->user_id
                            );
                        $this->utilities->insertData($sk_data, 'teacher_staff_skill');
                    } else {

                        $update_sk_data = array(
                            'SKILL_AREA' => $SKILL_AREA[$i],
                            'DESCRIPTION' => $DESCRIPTION[$i],
                            'USER_ID' => $this->user_id
                            );
                        $this->utilities->updateData('teacher_staff_skill', $update_sk_data, array('TR_S_ID' => $TR_S_ID[$i]));
                    }
                }
            }
            redirect('teacher/addTeacher', 'refresh');
        }

        /**
         * @methodName  updateTeacherInterest()
         * @access
         * @param
         * @author      Rakib Roni <rakib@atilimited.net>
         * @return      faculty profile
         */
        function updateTeacherInterest()
        {

            $INTEREST_TYPE = $this->input->post('INTEREST_TYPE');
            $INTERESR_SUBJECT = $this->input->post('INTERESR_SUBJECT');
            $TR_INT_ID = $this->input->post('TR_INT_ID');

            if (!empty($INTEREST_TYPE)) {
                for ($i = 0; $i < sizeof($INTEREST_TYPE); $i++) {

                    if ($TR_INT_ID[$i] == "") {

                        $int_data = array(
                            'INTEREST_TYPE' => $INTEREST_TYPE[$i],
                            'INTERESR_SUBJECT' => $INTERESR_SUBJECT[$i],
                            'USER_ID' => $this->user_id
                            );
                        $this->utilities->insertData($int_data, 'teacher_staff_interests');
                    } else {

                        $update_int_data = array(
                            'INTEREST_TYPE' => $INTEREST_TYPE[$i],
                            'INTERESR_SUBJECT' => $INTERESR_SUBJECT[$i],
                            'USER_ID' => $this->user_id
                            );
                        $this->utilities->updateData('teacher_staff_interests', $update_int_data, array('TR_INT_ID' => $TR_INT_ID[$i]));
                    }
                }
            }
            redirect('teacher/addTeacher', 'refresh');
        }

        /**
         * @methodName  updateTeacherIntTravel()
         * @access
         * @param
         * @author      Rakib Roni <rakib@atilimited.net>
         * @return      faculty profile
         */
        function updateTeacherIntTravel()
        {
            $WHERE = $this->input->post('WHERE');
            $PURPOSE = $this->input->post('PURPOSE');
            $FROM_DT = $this->input->post('FROM_DT');
            $TO_DT = $this->input->post('TO_DT');

            $TR_IR_ID = $this->input->post('TR_IR_ID');

            if (!empty($WHERE)) {
                for ($i = 0; $i < sizeof($WHERE); $i++) {

                    if ($TR_IR_ID[$i] == "") {

                        $inttr_data = array(
                            'WHERE' => $WHERE[$i],
                            'PURPOSE' => $PURPOSE[$i],
                            'FROM_DT' => date('Y-m-d', strtotime($FROM_DT[$i])),
                            'TO_DT' => date('Y-m-d', strtotime($TO_DT[$i])),
                            'USER_ID' => $this->user_id
                            );
                        $this->utilities->insertData($inttr_data, 'teacher_staff_internationa_travels');
                    } else {

                        $update_int_data = array(
                            'WHERE' => $WHERE[$i],
                            'PURPOSE' => $PURPOSE[$i],
                            'FROM_DT' => date('Y-m-d', strtotime($FROM_DT[$i])),
                            'TO_DT' => date('Y-m-d', strtotime($TO_DT[$i])),
                            'USER_ID' => $this->user_id
                            );
                        $this->utilities->updateData('teacher_staff_internationa_travels', $update_int_data, array('TR_IR_ID' => $TR_IR_ID[$i]));
                    }
                }
            }
            redirect('teacher/addTeacher', 'refresh');
        }

        /**
         * @methodName  updateTeacherPublication()
         * @access
         * @param
         * @author      Rakib Roni <rakib@atilimited.net>
         * @return      faculty profile
         */
        function updateTeacherPublication()
        {

            $TITLE = $this->input->post('TITLE');
            $DESCRIPTION = $this->input->post('DESCRIPTION');
            $PUBLISHER = $this->input->post('PUBLISHER');
            $PUBLICATION_URL = $this->input->post('PUBLICATION_URL');
            $AUTHOR = $this->input->post('AUTHOR');
            $PUB_DATE = $this->input->post('PUB_DATE');

            $TR_PUB_ID = $this->input->post('TR_PUB_ID');

            if (!empty($TITLE)) {
                for ($i = 0; $i < sizeof($TITLE); $i++) {

                    if ($TR_PUB_ID[$i] == "") {

                        $pub_data = array(
                            'TITLE' => $TITLE[$i],
                            'DESCRIPTION' => $DESCRIPTION[$i],
                            'PUBLISHER' => $PUBLISHER[$i],
                            'PUBLICATION_URL' => $PUBLICATION_URL[$i],
                            'AUTHOR' => $AUTHOR[$i],
                            'PUB_DATE' => date('Y-m-d', strtotime($PUB_DATE[$i])),
                            'USER_ID' => $this->user_id
                            );
                        $this->utilities->insertData($pub_data, 'teacher_staff_publications');
                    } else {

                        $update_pub_data = array(
                            'TITLE' => $TITLE[$i],
                            'DESCRIPTION' => $DESCRIPTION[$i],
                            'PUBLISHER' => $PUBLISHER[$i],
                            'PUBLICATION_URL' => $PUBLICATION_URL[$i],
                            'AUTHOR' => $AUTHOR[$i],
                            'PUB_DATE' => date('Y-m-d', strtotime($PUB_DATE[$i])),
                            'USER_ID' => $this->user_id
                            );
                        $this->utilities->updateData('teacher_staff_publications', $update_pub_data, array('TR_PUB_ID' => $TR_PUB_ID[$i]));
                    }
                }
            }
            redirect('teacher/addTeacher', 'refresh');
        }

        /**
         * @methodName  updateTeacherDisease()
         * @access
         * @param
         * @author      Rakib Roni <rakib@atilimited.net>
         * @return      faculty profile
         */
        function updateTeacherDisease()
        {

            $DISEASE_NAME = $this->input->post('DISEASE_NAME');
            $START_DT = $this->input->post('START_DT');
            $END_DT = $this->input->post('END_DT');
            $DOCTOR_NAME = $this->input->post('DOCTOR_NAME');
            $TR_DISEASE_ID = $this->input->post('TR_DISEASE_ID');
            if (!empty($DISEASE_NAME)) {
                for ($i = 0; $i < sizeof($DISEASE_NAME); $i++) {
                    if ($TR_DISEASE_ID[$i] == "") {

                        $dis_data = array(
                            'DISEASE_NAME' => $DISEASE_NAME[$i],
                            'START_DT' => date('Y-m-d', strtotime($START_DT[$i])),
                            'END_DT' => date('Y-m-d', strtotime($END_DT[$i])),
                            'DOCTOR_NAME' => $DOCTOR_NAME[$i],
                            'USER_ID' => $this->user_id
                            );
                        $this->utilities->insertData($dis_data, 'teacher_staff_diseaseinfo');
                    } else {
                        $update_dis_data = array(
                            'DISEASE_NAME' => $DISEASE_NAME[$i],
                            'START_DT' => date('Y-m-d', strtotime($START_DT[$i])),
                            'END_DT' => date('Y-m-d', strtotime($END_DT[$i])),
                            'DOCTOR_NAME' => $DOCTOR_NAME[$i],
                            'USER_ID' => $this->user_id
                            );
                        $this->utilities->updateData('teacher_staff_diseaseinfo', $update_dis_data, array('TR_DISEASE_ID' => $TR_DISEASE_ID[$i]));
                    }
                }
            }
            redirect('teacher/addTeacher', 'refresh');
        }

        /**
         * @methodName  profile()
         * @access
         * @param
         * @author      Rakib Roni <rakib@atilimited.net>
         * @return      faculty profile
         */
        function profile()
        {

            $data["breadcrumbs"] = array("Teacher" => "

            //", "Add Teacher" => '#');
                $data['pageTitle'] = 'Add Teacher';
                $data['content_view_page'] = 'admin/faculty/teacher_details';
                $this->admin_template->display($data);
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
            $tr_session = $this->session->userdata('logged_in');
            $tr_id = $tr_session["USER_ID"];
            $data['contentTitle'] = 'Course Content List';
            $data["breadcrumbs"] = array("Teacher" => "#", "Course Content" => '#');
            $data['pageTitle'] = 'Course Content';
            $data['course_content'] = $this->db->query("select a.*, b.CONT_TYPE as CONT_TYPE  FROM aca_crs_content a
               left join aca_crs_content_type b on a.CONT_TYPE_ID = b.CONT_TYPE_ID WHERE a.CREATED_BY=$tr_id")->result();
            $data['faculty'] = $this->utilities->getAll('faculty');
            $data['session'] = $this->utilities->getAll('session');
            $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));

            $data['content_list'] = $this->db->query("select a.*, b.CONT_TYPE as CONT_TYPE  FROM aca_crs_content a
             left join aca_crs_content_type b on a.CONT_TYPE_ID = b.CONT_TYPE_ID")->result();
            $data['content_view_page'] = 'admin/course/course_note';
            $this->admin_template->display($data);
        }

        /**
         * @methodName  contentDisList()
         * @access
         * @param
         * @author      Rakib <rakib@atilimited.net>
         * @return      teacher wise content distribution list
         */
        function contentDisList()
        {
            $tr_session = $this->session->userdata('logged_in');
            $tr_id = $tr_session["USER_ID"];
            $data['contentTitle'] = 'Course Content';
            $data["breadcrumbs"] = array("Teacher" => "#", "Distributed Course Content" => '#');
            $data['pageTitle'] = 'Course Content';
            $data['dis_content'] = $this->db->query("SELECT a.CONTENT_DIST_ID,
               b.CONTENT_URI,
               b.CONTENT_TITLE,
               c.PROGRAM_NAME,
               d.SESSION_NAME,
               e.COURSE_CODE,
               e.COURSE_TITLE,
               f.LKP_NAME,
               g.BATCH_TITLE

               FROM aca_crs_content_distribution a
               LEFT JOIN aca_crs_content b ON a.C_CONTENT_ID = b.C_CONTENT_ID
               LEFT JOIN program c ON a.PROGRAM_ID = c.PROGRAM_ID
               LEFT JOIN session_view d ON a.SEM_SESSION = d.SESSION_ID
               LEFT JOIN aca_course e ON a.COURSE_ID = e.COURSE_ID
               LEFT JOIN m00_lkpdata f ON a.SEMESTER_ID = f.LKP_ID
               LEFT JOIN aca_batch g ON a.BATCH_ID = g.BATCH_ID
               WHERE a.USER_ID = $tr_id ")->result();
            $data['content_view_page'] = 'teacher/dis_content';
            $this->admin_template->display($data);
        }

        function teacherList()
        {
            $data['contentTitle'] = 'Teacher List';
            $data["breadcrumbs"] = array("Teacher" => "#", "Teacher List" => '#');
            $data['pageTitle'] = 'Teacher List';
            $user_session = $this->session->userdata('logged_in');
            $user_type = $user_session["USER_TYPE"];
            $data['faculty'] = $this->db->query("select * from faculty")->result();
            $data['skills'] = $this->db->query("select * from skills")->result();
            $data['extra_activity_type'] = $this->utilities->getAll('extra_activity_type');
            $data['religion'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 3));
            $data['merital_status'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 8));
            $data['blood_group'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 4));
            $data['teachers'] = $this->db->query("SELECT a.*,b.DESIGNATION from sa_users a  left join designations b on a.DESIGNATION_ID =b.DESIGNATION_ID ")->result();
            $data['content_view_page'] = 'teacher/teacher_list';
            $this->admin_template->display($data);
        }

        function teacherDetails()
        {
            $data['contentTitle'] = 'Teacher Details';
            $data["breadcrumbs"] = array("Teacher" => "#", "Add Teacher" => '#');
            $data['pageTitle'] = 'Add Teacher';
            $data['content_view_page'] = 'teacher/teacher_details';
            $this->teacher_portal->display($data);
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

            $data['contentTitle'] = 'Course Content';
            $data["breadcrumbs"] = array("Teacher" => "#", "Course Content" => '#');
            $data['pageTitle'] = 'Course Content';
            $data['content_type'] = $this->db->query("select * from aca_crs_content_type")->result();
            $data['content_view_page'] = 'admin/course/add_course_note';
            $this->admin_template->display($data);
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
            $tr_session = $this->session->userdata('logged_in');
            $tr_id = $tr_session["USER_ID"];
            $file_name = "";
            if (!empty($_FILES)) {
                $this->load->library('upload');
                $this->load->helper('string');
                $config['upload_path'] = 'upload/course_content/';
                $config['allowed_types'] = '*';

                //$config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['overwrite'] = false;
                $config['remove_spaces'] = true;

                //$config['max_size'] = '100';// in KB
                $this->upload->initialize($config);
                if ($this->upload->do_upload('course_content')) {
                    $file_data = $this->upload->data();
                    $file_name = $file_data['file_name'];
                    //$this->utilities->insertData($data, 'profile_picture');
                }
            }
            $CONT_TYPE_ID = $this->input->post('CONT_TYPE_ID');
            $CONTENT_TITLE = $this->input->post('CONTENT_TITLE');
            $status = $this->input->post('status');

            // active status
            $course_content = array(
                'CONT_TYPE_ID' => $CONT_TYPE_ID,
                'CONTENT_TITLE' => $CONTENT_TITLE,
                'CONTENT_URI' => $file_name,
                'CREATED_BY' => $tr_id,
                'ACTIVE_STATUS' => $status
                );

            if ($this->utilities->insertData($course_content, 'aca_crs_content')) {

                // if data inserted successfully
                $this->session->set_flashdata('Success', 'Course Contetn insert suceessfully !');
                redirect('teacher/addCourseContent', 'refresh');
            }
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
            $data['session'] = $this->utilities->getAll('session_view');

            $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
            $this->load->view('admin/course/add_dis_con', $data);
        }

        /**
         * @methodName  saveConDis()
         * @access      public
         * @param
         * @author      Rakib Roni <rakib@atilimited.net>
         * @return      save content distribution
         */


        function saveConDis()
        {
            $tr_session = $this->session->userdata('logged_in');
            $tr_id = $tr_session["USER_ID"];
            $C_CONTENT_ID = $this->input->post('CONTENT_ID');
            if (isset($C_CONTENT_ID)) {
                foreach ($C_CONTENT_ID as $key => $value) {
                    $dis_content = array(
                        'C_CONTENT_ID' => $C_CONTENT_ID[$key],
                        'USER_ID' => $tr_id,
                        'FACULTY_ID' => $this->input->post('FACULTY_ID'),
                        'DEPT_ID' => $this->input->post('DEPARTMENT_ID'),
                        'PROGRAM_ID' => $this->input->post('PROGRAM_ID'),
                        'SEM_SESSION' => $this->input->post('SESSION_ID'),
                        'SEMESTER_ID' => $this->input->post('SEMESTER_ID'),
                        'COURSE_ID' => $this->input->post('COURSE_ID'),
                        'BATCH_ID' => $this->input->post('BATCH_ID'),
                        'START_DATE' => date('Y-m-d', strtotime($this->input->post('START_DATE'))),
                        'END_DATE' => date('Y-m-d', strtotime($this->input->post('END_DATE'))),
                        'ACTIVE_STATUS' => $this->input->post('status'));
                    $this->utilities->insertData($dis_content, 'aca_crs_content_distribution');
                }
                $this->session->set_flashdata('Info', 'Course Contetn distributed suceessfully !');
                redirect('teacher/courseContent/', 'refresh');
            }
        }

        function distributedContentByTeacher()
        {

        }

        /**
         * @methodName  getCourseByProgramFromCourseOffer()
         * @access      public
         * @param
         * @author      Rakib Roni <rakib@atilimited.net>
         * @return get content
         */

        function getCourseByProgramFromCourseOffer()
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

        function trClassSchedule()
        {
            $data['pageTitle'] = 'Class Schedule';
            $data['breadcrumbs'] = array('Class Schedule' => '#',);
            $data['content_view_page'] = 'teacher/tr_class_schedule';
            $this->teacher_portal->display($data);
        }

        public function test()
        {
            $data['pageTitle'] = 'Add Content';
            $data['breadcrumbs'] = array('Create Course Content' => '#',);
            $data['roll'] = $this->db->query("select STUDENT_ID, ROLL_NO  from students_info")->result();

            $data['content_view_page'] = 'teacher/test2';
            $this->teacher_portal->display($data);
        }

        function teacherModal()
        {
            $teacher_id = $_POST['teacher_id'];
            $data['teacher_id'] = $teacher_id;


            $data['tcr_personal_info'] = $this->db->query("SELECT a.*,
               b.LKP_NAME AS bg,
               c.LKP_NAME AS rn,
               d.nationality as nt,
               e.LKP_NAME AS ms
               FROM sa_users a
               LEFT JOIN m00_lkpdata b ON a.BLOOD_GROUP = b.LKP_ID
               LEFT JOIN m00_lkpdata c ON a.RELIGION = c.LKP_ID
               LEFT JOIN country d ON a.NATIONALITY = d.id
               LEFT JOIN m00_lkpdata e ON a.MARITAL_STATUS = e.LKP_ID
               WHERE a.USER_ID =$teacher_id ")->row();
            $data["teacher_email"] = $this->utilities->findAllByAttribute('teacher_staff_contractinfo', array("USER_ID" => $teacher_id, "CONTACT_TYPE" => 'E'));
            $data["teacher_contact"] = $this->utilities->findAllByAttribute('teacher_staff_contractinfo', array("USER_ID" => $teacher_id, "CONTACT_TYPE" => 'M'));

            echo $this->load->view('admin/faculty/teacher_details', $data, true);
        }

        function teacherPersonalDetails()
        {

            $tr_id = $_POST["teacher_id"];
            $data['tcr_personal_info'] = $this->db->query("SELECT a.*,
               b.LKP_NAME AS bg,
               c.LKP_NAME AS rn,
               d.nationality as nt,
               e.LKP_NAME AS ms
               FROM sa_users a
               LEFT JOIN m00_lkpdata b ON a.BLOOD_GROUP = b.LKP_ID
               LEFT JOIN m00_lkpdata c ON a.RELIGION = c.LKP_ID
               LEFT JOIN country d ON a.NATIONALITY = d.id
               LEFT JOIN m00_lkpdata e ON a.MARITAL_STATUS = e.LKP_ID
               WHERE a.USER_ID =$tr_id ")->row();
            $data["teacher_email"] = $this->utilities->findAllByAttribute('teacher_staff_contractinfo', array("USER_ID" => $tr_id, "CONTACT_TYPE" => 'E'));
            $data["teacher_contact"] = $this->utilities->findAllByAttribute('teacher_staff_contractinfo', array("USER_ID" => $tr_id, "CONTACT_TYPE" => 'M'));

            $this->load->view('teacher/teacher_personal_information', $data);
        }

        function teacherFamillyDetails()
        {
            $tr_id = $_POST["teacher_id"];
            $data["fathersInfo"] = $this->db->query("SELECT f.*, g.LKP_NAME AS oc
                FROM teacher_staff_parentinfo f
                LEFT JOIN m00_lkpdata g ON f.OCCUPATION = g.LKP_ID
                WHERE f.USER_ID = '$tr_id' AND f.PARENTS_TYPE = 'F'")->row();
            $data["motherInfo"] = $this->db->query("SELECT f.*, g.LKP_NAME AS oc
                FROM teacher_staff_parentinfo f
                LEFT JOIN m00_lkpdata g ON f.OCCUPATION = g.LKP_ID
                WHERE f.USER_ID =  '$tr_id' AND f.PARENTS_TYPE = 'M'")->row();
            $data['local_present_adddress'] = $this->db->query("SELECT a.TR_ADRESS_ID,a.USER_ID, a.ADRESS_TYPE, a.SAS_PSORPR, a.HOUSE_NO_NAME, a.ROAD_AVENO_NAME, a.VILLAGE_WARD, a.DISTRICT_ID, a.DIVISION_ID, a.POLICE_STATION_ID, a.POST_OFFICE_ID, a.THANA_ID, a.UNION_ID,
               (SELECT b.DIVISION_ENAME FROM sa_divisions b WHERE b.DIVISION_ID = a.DIVISION_ID)DIVIS_NAME,
               (SELECT d.DISTRICT_ENAME FROM sa_districts d WHERE d.DISTRICT_ID = a.DISTRICT_ID)DIST_NAME,
               (SELECT p.PS_ENAME FROM sa_police_station p WHERE p.POLICE_STATION_ID = a.POLICE_STATION_ID)PLOSC,
               (SELECT po.POST_OFFICE_ENAME FROM sa_post_offices po WHERE po.POST_OFFICE_ID = a.POST_OFFICE_ID)POSTO,
               (SELECT t.THANA_ENAME FROM sa_thanas t WHERE t.THANA_ID = a.THANA_ID)thn,
               (SELECT u.UNION_NAME FROM sa_unions u WHERE u.UNION_ID = a.UNION_ID)uni FROM teacher_staff_adressinfo a WHERE a.USER_ID = '$tr_id' AND a.ADRESS_TYPE = 'PS'")->row();
            $this->load->view('teacher/teacher_family_details', $data);
        }

        function teacherAcademicInfo()
        {
            $tr_id = $_POST["teacher_id"];
            $data['academic'] = $this->db->query("SELECT a.*,b.LKP_NAME as ed,c.LKP_NAME as mg,d.LKP_NAME as br FROM teacher_staff_acadimicinfo a
                left join m00_lkpdata b on a.EXAM_DEGREE_ID=b.LKP_ID
                left join m00_lkpdata c on a.MAJOR_GROUP_ID=c.LKP_ID
                left join m00_lkpdata d on a.BOARD = d.LKP_ID
                WHERE a.USER_ID ='$tr_id'")->result();
            $this->load->view('teacher/teacher_academic_info', $data);
        }

        function teacherExp()
        {
            $tr_id = $_POST["teacher_id"];
            $data['teacher_exp'] = $this->db->query("SELECT a.*, b.LKP_NAME AS exp_type_name
                FROM teacher_staff_experience a
                LEFT JOIN m00_lkpdata b ON a.EXP_TYPE = b.LKP_ID
                WHERE a.USER_ID ='$tr_id'")->result();
            $this->load->view('teacher/teacher_exp_info', $data);
        }

        function teacherMedicalInfo()
        {
            $tr_id = $_POST["teacher_id"];
            $data['medical_info'] = $this->db->query("SELECT a.* FROM teacher_staff_diseaseinfo a WHERE a.USER_ID ='$tr_id'")->result();
            $this->load->view('teacher/teacher_medical_info', $data);
        }

        function teacherAwardInfo()
        {
            $tr_id = $_POST["teacher_id"];
            $data['awards'] = $this->db->query("SELECT a.* FROM teacher_staff_awards a WHERE a.USER_ID ='$tr_id'")->result();
            $this->load->view('teacher/teacher_award_info', $data);
        }

        function teacherAffiliation()
        {
            $tr_id = $_POST["teacher_id"];
            $data['affilication'] = $this->db->query("SELECT a.* FROM teacher_staff_affiliations a WHERE a.USER_ID ='$tr_id'")->result();
            $this->load->view('teacher/teacher_affiliation_info', $data);
        }

        function teacherSkill()
        {
            $tr_id = $_POST["teacher_id"];
            $data['skills'] = $this->db->query("SELECT a.*, b.DESC AS san
                FROM teacher_staff_skill a LEFT JOIN skills b ON a.SKILL_AREA = b.SKILL_ID
                WHERE a.USER_ID = '$tr_id'")->result();
            $this->load->view('teacher/teacher_skill_info', $data);
        }

        function teacherInterest()
        {
            $tr_id = $_POST["teacher_id"];
            $data['interest'] = $this->db->query("SELECT a.*,b.LKP_NAME as itn from teacher_staff_interests a
                left join m00_lkpdata b on a.INTEREST_TYPE=b.LKP_ID
                where a.USER_ID='$tr_id'")->result();
            $this->load->view('teacher/teacher_interest_info', $data);
        }

        function teacherTourTravels()
        {
            $tr_id = $_POST["teacher_id"];
            $data['tour'] = $this->db->query("SELECT a.*  from teacher_staff_internationa_travels a where a.USER_ID='$tr_id'")->result();
            $this->load->view('teacher/teacher_tour_info', $data);
        }

        function teacherPublication()
        {
            $tr_id = $_POST["teacher_id"];
            $data['publication'] = $this->db->query("SELECT a.*  from teacher_staff_publications a where a.USER_ID='$tr_id'")->result();
            $this->load->view('teacher/teacher_publication', $data);
        }

        function blogList()
        {
            $data['contentTitle'] = 'Your Blog List';
            $data["breadcrumbs"] = array(
                "Teacher" => "#",
                "Your Blog List" => '#'
                );
            $data['pageTitle'] = 'Your Blog List';

            $data['blog_list'] = $this->db->query("select a.* from blog_post a where a.ENTERED_BY=$this->user_id")->result();

            $data['content_view_page'] = 'teacher/blog/teacher_blog_index';
            $this->admin_template->display($data);
        }

        function addBlog()
        {
            $data["ac_type"] = 1;
            $data['contentTitle'] = 'Create Blog';
            $data["breadcrumbs"] = array(
                "Teacher" => "#",
                "Create Blog" => '#'
                );
            $data['content_view_page'] = 'teacher/blog/add_blog';
            $this->admin_template->display($data);
        }

        function createBlog()
        {
            $file_name = "";
            if (!empty($_FILES)) {
                $this->load->library('upload');
                $this->load->helper('string');
                $config['upload_path'] = 'upload/blog_banner/';

                //$config['allowed_types'] = '*';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['overwrite'] = false;
                $config['remove_spaces'] = true;

                //$config['max_size'] = '100';// in KB
                $this->upload->initialize($config);
                if ($this->upload->do_upload('POST_BANNER')) {
                    $file_data = $this->upload->data();
                    $file_name = $file_data['file_name'];
                }
            }

            $blog_post = array('POST_TITLE' => $this->input->post('POST_TITLE'), 'POST_CONTENT' => $this->input->post('POST_CONTENT'), 'POST_BANNER' => $file_name, 'ACTIVE_STATUS' => $this->input->post('ACTIVE_STATUS'), 'ENTERED_BY' => $this->user_id);

            if ($id = $this->utilities->insert('blog_post', $blog_post)) {
                $post_tag = array('POST_ID' => $id, 'POST_TAGS' => $this->input->post('POST_TAGS'));
                $this->utilities->insertData($post_tag, 'blog_tag');

                // if data inserted successfully
                $this->session->set_flashdata('Success', 'Successfully Blog Posted !');
                redirect('teacher/addBlog', 'refresh');
            }
        }


        function editBlog($id)
        {

            $data['contentTitle'] = 'Edit Your Post';
            $data["breadcrumbs"] = array(
                "Teacher" => "#",
                "Edit Your Post" => '#'
                );

            $data['blog_details'] = $this->db->query("SELECT a.*, b.POST_TAGS
                FROM blog_post a LEFT JOIN blog_tag b ON a.POST_ID = b.POST_ID
                WHERE a.POST_ID = $id")->row();
            $data['content_view_page'] = 'teacher/blog/edit_blog';
            $this->admin_template->display($data);
        }

        function updateBlog()
        {
            $POST_ID = $this->input->post('POST_ID');
            $file_name = "";
            if (!empty($_FILES)) {
                $this->load->library('upload');
                $this->load->helper('string');
                $config['upload_path'] = 'upload/blog_banner/';

                //$config['allowed_types'] = '*';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['overwrite'] = false;
                $config['remove_spaces'] = true;

                //$config['max_size'] = '100';// in KB
                $this->upload->initialize($config);
                if ($this->upload->do_upload('POST_BANNER')) {
                    $file_data = $this->upload->data();
                    $file_name = $file_data['file_name'];
                }
            }

            if ($file_name != "") {
                $update_blog_post["POST_BANNER"] = $file_name;
            }
            $update_blog_post = array('POST_TITLE' => $this->input->post('POST_TITLE'), 'POST_CONTENT' => $this->input->post('POST_CONTENT'), 'ACTIVE_STATUS' => $this->input->post('ACTIVE_STATUS'), 'ENTERED_BY' => $this->user_id);

            if ($this->utilities->updateData('blog_post', $update_blog_post, array('POST_ID' => $POST_ID))) {
                $post_tag = array('POST_TAGS' => $this->input->post('POST_TAGS'));
                $this->utilities->updateData('blog_tag', $post_tag, array('POST_ID' => $POST_ID));

                // if data inserted successfully
                $this->session->set_flashdata('Success', 'Successfully Blog Updated !');
                redirect('teacher/editBlog/' . $POST_ID);
            }
        }

        function blogComment()
        {
            $post_id = $_POST['post_id'];
            $comment = $_POST['comment'];
            $blog_comment = array(
                'POST_ID' => $post_id,
                'CMT_COMMENT' => $comment,
                'COMMENT_BY' => $this->user_id
                );
            $this->utilities->insertData($blog_comment, 'blog_post_comment');
            $data['cmt_by_post_id'] = $this->db->query("SELECT a.*, b.FULL_NAME_EN, b.TEACHER_PHOTO
                FROM blog_post_comment a
                LEFT JOIN sa_users b ON a.COMMENT_BY = b.USER_ID
                WHERE a.POST_ID =$post_id")->result();
            $this->load->view('teacher/blog/comment_by_post_id', $data);
        }

        function bolgWorkList()
        {
            $data['contentTitle'] = 'Blog List';
            $data['breadcrumbs'] = array(
                'Admin' => '#',
                'Blog List' => '#',
                );
            $data['blog_list'] = $this->db->query("SELECT a.*, b.POST_TAGS
                FROM blog_post a LEFT JOIN blog_tag b ON a.POST_ID = b.POST_ID")->result();
            $data['content_view_page'] = 'teacher/blog/blog_work_index_data_table';
            $this->admin_template->display($data);
        }

        function ajaxDatatableBlogList()
        {

            // storing  request (ie, get/post) global array to a variable
            $requestData = $_REQUEST;

            $columns = array(

                // datatable column index  => database column name
                0 => 'POST_TITLE', 2 => 'POST_CONTENT');

            // getting total number records without any search

            $query = $this->db->query("SELECT POST_ID,POST_TITLE, POST_CONTENT,APPROVE_BY_ADMIN,REMARKS,PUBLISH_DT,POST_BANNER FROM blog_post")->num_rows();

            $totalData = $query;

            $totalFiltered = $totalData;
            // when there is no search parameter then total number rows = total number filtered rows.

            if (!empty($requestData['search']['value'])) {

                // if there is a search parameter

                $query = $this->db->query("SELECT POST_ID,POST_TITLE, POST_CONTENT,APPROVE_BY_ADMIN,REMARKS,PUBLISH_DT,POST_BANNER FROM blog_post WHERE POST_TITLE LIKE '" . $requestData['search']['value'] . "%' OR POST_SUB_TITLE LIKE '" . $requestData['search']['value'] . "%' OR POST_CONTENT LIKE '" . $requestData['search']['value'] . "%' ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . " ")->result();

                $totalFiltered = $query;
                // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query


            } else {

                $query = $this->db->query("SELECT POST_ID,POST_TITLE,  POST_CONTENT,APPROVE_BY_ADMIN,REMARKS,PUBLISH_DT,POST_BANNER FROM blog_post  ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . " ")->result();

            }

            $data = array();
            $statusArray = array('new', 'Published', 'Review', 'Reject', 'Pending');
            foreach ($query as $row) {
                // preparing an array
                $nestedData = array();

                $nestedData[] = '<input name="POST_ID[]" value="' . $row->POST_ID . '" class="POST_CHK" type="checkbox">';
                $nestedData[] = '<div class="small">
                <div class="text short">
                    ' . $row->POST_TITLE . '
                </div>
                <a href="#"  class="read-more">Read more..</a>
            </div>';


            $nestedData[] = '<div class="lightBoxGallery">
            <a href="' . base_url() . 'upload/blog_banner/' . $row->POST_BANNER . '"
                title="Banner Photo" data-gallery="">
                <img style="width:20%" src="' . base_url() . '/upload/blog_banner/' . $row->POST_BANNER . '"></a></div>';
                $nestedData[] = '<div class="small">
                <div class="text short">
                    ' . $row->POST_CONTENT . '
                </div>
                <a href="#"  class="read-more">Read more..</a>
            </div>';
            $nestedData[] = '<textarea name="REMARKS_' . $row->POST_ID . '" class="form-control">' . $row->REMARKS . '</textarea>';
            $PUBLISH_DT = ($row->PUBLISH_DT == '') ? '' : date('m/d/Y', strtotime($row->PUBLISH_DT));
            $nestedData[] = '<input type="text" name="PUBLISH_DT_' . $row->POST_ID . '" value="' . $PUBLISH_DT . '" class="form-control datepicker" placeholder="MM/DD/YYYY" data-mask="99/99/9999">';
            $options = '';
            for ($i = 0; $i < 5; $i++) {
                $isSelected = ($row->APPROVE_BY_ADMIN == $i) ? 'selected="selected"' : '';
                $options .= "<option value='$i' " . $isSelected . ">" . $statusArray[$i] . "</option>";
            }
            $nestedData[] = '<select name="STATUS_' . $row->POST_ID . '" class="form-control blog_status" >' . $options . '</select>';
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

    function blogPostApprove()
    {

        $POST_ID = ((isset($_POST['POST_ID'])) ? $_POST['POST_ID'] : '');

        foreach ($POST_ID as $key => $value) {
            $approve_data = array(
                'REMARKS' => $this->input->post('REMARKS_' . $value),
                'APPROVE_BY_ADMIN' => $this->input->post('STATUS_' . $value),
                'PUBLISH_DT' => ($this->input->post('PUBLISH_DT_' . $value) == '') ? null : date('Y-m-d', strtotime($this->input->post('PUBLISH_DT_' . $value)))

                );
                //print_r($approve_data);
            $this->utilities->updateData('blog_post', $approve_data, array("POST_ID" => $value));
        }
            // exit;
        $this->session->set_flashdata('Success', 'Successfully Blog permission Updated !');
        redirect('teacher/bolgWorkList/');


    }


    function apvRejBlogPost()
    {
        $post_id = $this->input->post('post_id');
        $approve_status = $this->input->post('approve_status');
        if ($approve_status == 1) {
            $new_status = 0;
        } else {
            $new_status = 1;
        }
        $update_approve_status = array(
            "APPROVE_BY_ADMIN" => $new_status
            );
        if ($this->utilities->updateData('blog_post', $update_approve_status, array("POST_ID" => $post_id))) {
            echo $new_status;
        }
    }

    function pendingBlogPost()
    {

        $data['pending_post'] = $this->db->query("SELECT a.*, b.POST_TAGS
          FROM blog_post a LEFT JOIN blog_tag b ON a.POST_ID = b.POST_ID
          WHERE a.APPROVE_BY_ADMIN = '0'")->result();

        $this->load->view('teacher/blog/pending_post', $data);
    }

    function approveBlogPost()
    {

        $data['pending_post'] = $this->db->query("SELECT a.*, b.POST_TAGS
          FROM blog_post a LEFT JOIN blog_tag b ON a.POST_ID = b.POST_ID
          WHERE a.APPROVE_BY_ADMIN = '1'")->result();

        $this->load->view('teacher/blog/pending_post', $data);
    }

    function ajaxDatatableIndex()
    {
        $data['pageTitle'] = 'Blog List';
        $data['breadcrumbs'] = array('Blog List' => '#',);
        $data['content_view_page'] = 'teacher/ajax_datatable';
        $this->admin_template->display($data);
    }

    function ajaxDatatable()
    {

            // storing  request (ie, get/post) global array to a variable
        $requestData = $_REQUEST;

        $columns = array(

                // datatable column index  => database column name
            0 => 'ROLL_NO', 1 => 'FULL_NAME_EN', 2 => 'DEPARTMENT');

            // getting total number records without any search

        $query = $this->db->query("SELECT ROLL_NO, FULL_NAME_EN, DEPARTMENT FROM students_info")->num_rows();

        $totalData = $query;

        $totalFiltered = $totalData;
            // when there is no search parameter then total number rows = total number filtered rows.

        if (!empty($requestData['search']['value'])) {

                // if there is a search parameter

            $query = $this->db->query("SELECT ROLL_NO, FULL_NAME_EN, DEPARTMENT FROM students_info WHERE ROLL_NO LIKE '" . $requestData['search']['value'] . "%' OR FULL_NAME_EN LIKE '" . $requestData['search']['value'] . "%' OR DEPARTMENT LIKE '" . $requestData['search']['value'] . "%' ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . " ")->result();

            $totalFiltered = $query;
                // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query

        } else {

            $query = $this->db->query("SELECT ROLL_NO, FULL_NAME_EN, DEPARTMENT FROM students_info  ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . " ")->result();
        }

        $data = array();
        foreach ($query as $row) {
                // preparing an array
            $nestedData = array();

            $nestedData[] = $row->ROLL_NO;
            $nestedData[] = $row->FULL_NAME_EN;
            $nestedData[] = $row->DEPARTMENT;

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

    //***************************

    function courseEnrollment()
    {

        $data['contentTitle'] = 'New Student List';
        $data["breadcrumbs"] = array(
            "Student" => "#",
            "New Student List" => '#'
            );
        $data['program'] = $this->utilities->findAllByAttribute('ins_program', array("DEPT_ID" => $this->dept_id));
        $data['section'] = $this->utilities->findAllByAttribute('aca_section', array("ACTIVE_STATUS" => 1));
        $data['semester'] = $this->utilities->findAllByAttribute('sav_semester', array("ACTIVE_FLAG" => 1));
        $data["session"] = $this->utilities->academicSessionList();
        $data['student_list'] = $this->db->query("select a.* from student_personal_info a WHERE DEPT_ID=$this->dept_id order by a.STUDENT_ID desc")->result();
        $data['content_view_page'] = 'student/student_list';
        $this->admin_template->display($data);

    }

        /**
         * @methodName enrollmentStudentList
         * @access
         * @param  none
         * @author Abhijit M. Abhi <abhijit@atilimited.net>
         * @return
         **/

        function enrollmentStudentList()
        {
            $program_id = $this->input->post("PROGRAM_ID");
            $session_id = $this->input->post("SESSION_ID");
            $batch_id = $this->input->post("BATCH_ID");
            $section_id = $this->input->post("SECTION_ID");
            $semester = $this->input->post("SEMESTER");

            $data['program_id'] = $program_id;
            $data['session_id'] = $session_id;
            $data['batch_id'] = $batch_id;
            $data['section_id'] = $section_id;
            $data['semester'] = $semester;
            $data['offer_type'] = 'F';

            $data['student_list'] = $this->teacher_model->getStudentListByThisAttribute($program_id, $session_id, $batch_id, $section_id);
            $this->load->view('student/search_student_list', $data);
        }

        /**
         * @methodName saveCourseEnrollment
         * @access
         * @param  none
         * @author Abhijit M. Abhi <abhijit@atilimited.net>
         * @return
         **/

        function saveCourseEnrollment()
        {
            $program_id = $this->input->post("PROGRAM_ID");
            $session_id = $this->input->post("SESSION_ID");
            $batch_id = $this->input->post("BATCH_ID");
            $section_id = $this->input->post("SECTION_ID");
            $semester = $this->input->post("SEMESTER");

            $program_info = $this->utilities->findByAttribute('ins_program', array('PROGRAM_ID' => $program_id));
            $data['program_id'] = $program_id;
            $data['session_id'] = $session_id;
            $data['batch_id'] = $batch_id;
            $data['section_id'] = $section_id;
            $data['semester'] = $semester;
            $data['offer_type'] = 'F';

            $student_id = $this->input->post("STUDENT_ID");
            // print_r($student_id);exit;
            for ($i = 0; $i < sizeof($student_id); $i++) {
                $student_course = $this->input->post('ENROLL_COURSE_ID_' . $student_id[$i]);
                $offered_course_id = $this->input->post('OFFERED_COURSE_ID_' . $student_id[$i]);

                for ($j = 0; $j < sizeof($student_course); $j++) {

                    $student_enroll_course = array(
                        "STUDENT_ID" => $student_id[$i],
                        "COURSE_ID" => $student_course[$j],
                        "OFFERED_COURSE_ID" => $offered_course_id[$j],
                        "SESSION_ID" => $session_id,
                        "SEMISTER_SL_NO" => $semester,
                        "PROGRAM_ID" => $program_id,
                        "FACULTY_ID" => $program_info->FACULTY_ID,
                        "DEPT_ID" => $program_info->DEPT_ID,
                        "IS_CURRENT" => 1,
                        "CREATED_BY" => $this->user_id,
                        );
                    $this->utilities->insert('student_courseinfo', $student_enroll_course);
                }
                $student_semester_info = array(
                    "STUDENT_ID" => $student_id[$i],
                    "PROGRAM_ID" => $program_id,
                    "FACULTY_ID" => $program_info->FACULTY_ID,
                    "DEPT_ID" => $program_info->DEPT_ID,
                    "SESSION_ID" => $session_id,
                    "SEMESTER_SL_NO" => $semester,
                    "BATCH_ID" => $batch_id,
                    "SECTION_ID" => $section_id,
                    "IS_CURRENT" => 1,
                    "CREATED_BY" => $this->user_id,
                    );
                $this->utilities->insert('student_semesterinfo', $student_semester_info);
            }

            echo "Y";

        }

        /**
         * @methodName manualCourseEnrollment
         * @access
         * @param  none
         * @author Abhijit M. Abhi <abhijit@atilimited.net>
         * @return
         **/

        function manualCourseEnrollment()
        {
            $data['contentTitle'] = 'New Student List';
            $data["breadcrumbs"] = array(
                "Student" => "#",
                "New Student List" => '#'
                );

            $data['session'] = $this->session->userdata['logged_in']['SESSION_ID'];

            //echo "<pre>"; print_r($data['session']); exit;

            $data['student_list'] = $this->db->query("select a.* from student_personal_info a WHERE DEPT_ID=$this->dept_id order by a.STUDENT_ID desc")->result();
            $data['content_view_page'] = 'student/registration/manual_course_enrollment';
            $this->admin_template->display($data);

        }

        /**
         * @methodName findThisStudentCourses
         * @access
         * @param  none
         * @author Abhijit M. Abhi <abhijit@atilimited.net>
         * @return
         **/

        function findThisStudentCourses()
        {
            $stu_roll_no = $this->input->post('STU_ROLL_NO');
            $session = $this->input->post('SESSION_ID');
            $dept_id = $this->session->userdata['logged_in']['DEPT_ID'];

            $data['student_course_list'] = $this->teacher_model->studentCourseListByThisAttribute($stu_roll_no, $session, $dept_id);

            if (!empty($data['student_course_list'])) {
                $data['ACTIVE_STATUS'] = 1;
                $data['session_id'] = $data['student_course_list'][0]->SESSION_ID;
                $data['program_id'] = $data['student_course_list'][0]->PROGRAM_ID;
                $data['stu_reg_no'] = $stu_roll_no;
            }

            $this->load->view('student/registration/student_course_list', $data);
        }

        /*
        * @methodName deleteItem
        * @access
        * @param  none
        * @author Abhijit M. Abhi <abhijit@atilimited.net>
        * @return
        */

        public function deleteItem()
        {
            $item_id = $this->input->post('item_id');
            $data_tbl = $this->input->post('data_tbl');
            $data_field = $this->input->post('data_field');
            $attribute = array(
                "$data_field" => $item_id
                );

            $result = $this->utilities->deleteRowByAttribute($data_tbl, $attribute);
            if ($result == TRUE) {
                echo "Y";
            } else {
                echo "N";
            }
        }

        /*
       * @methodName newCourseFormInsert
       * @access
       * @param  none
       * @author Abhijit M. Abhi <abhijit@atilimited.net>
       * @return policy add form
       */

        function newCourseFormInsert()
        {
            $session_id = $this->input->post('session_id');
            $program_id = $this->input->post('program_id');
            $stu_reg_id = $this->input->post('stu_reg_id');

            $student_info = $this->utilities->findByAttribute('student_personal_info', array('REGISTRATION_NO' => $stu_reg_id));

            $stu_session_id = $student_info->SESSION_ID;
            $student_id = $student_info->STUDENT_ID;


            $data['student_id'] = $student_id;
            $data['session_id'] = $session_id;
            $data['program_id'] = $program_id;

            $data["ac_type"] = 1;
            $data['course_list'] = $this->db->query("SELECT * FROM aca_semester_course a
              LEFT JOIN aca_course_offer b ON a.OFFERED_COURSE_ID = b.OFFERED_COURSE_ID
              LEFT JOIN aca_course c ON b.COURSE_ID = c.COURSE_ID
              WHERE a.SESSION_ID = '$stu_session_id' 
              AND a.PROGRAM_ID = '$program_id'
              AND a.COURSE_ID NOT IN (SELECT x.COURSE_ID FROM student_courseinfo x WHERE  x.STUDENT_ID = '$student_id')")->result();

            //echo "<pre>"; print_r($data['course_list']); exit;

            $this->load->view('student/registration/add_new_course', $data);
        }

        /*
       * @methodName enrolledNewCourse
       * @accesss
       * @param  none
       * @author Abhijit M. Abhi <abhijit@atilimited.net>
       * @return
       */

        function enrolledNewCourse()
        {
            $new_course_id = $this->input->post('COURSE_ID');
            $student_id = $this->input->post('STUDENT_ID');
            $session_id = $this->input->post('SESSION_ID');
            $program_id = $this->input->post('PROGRAM_ID');
            $course_for = $this->input->post('COURSE_FOR');

            $student_info = $this->teacher_model->studentListByThisAttribute($student_id);

            $course_info = $this->db->get_where('aca_course_offer a', array('a.COURSE_ID' => $new_course_id))->row();
            $offered_course_id = $course_info->OFFERED_COURSE_ID;

            //echo "<pre>"; print_r($data['course_info']); exit;

            $new_enrolled_course = array(
                'STUDENT_ID' => $student_id,
                'SESSION_ID' => $session_id,
                'COURSE_ID' => $new_course_id,
                'PROGRAM_ID' => $program_id,
                'OFFERED_COURSE_ID' => $offered_course_id,
                'FACULTY_ID' => $student_info->FACULTY_ID,
                'DEPT_ID' => $student_info->DEPT_ID,
                'COURSE_FOR' => $course_for,

                );

            if ($this->utilities->insertData($new_enrolled_course, 'student_courseinfo')) {
                echo "<div class='alert alert-success'>Course Enrollment successfull</div>";
            } else {
                echo "<div class='alert alert-danger'>Course Enrollment failed</div>";
            }
        }

        /*
      * @methodName newEnrolledCourseList
      * @access
      * @param  none
      * @author Abhijit M. Abhi <abhijit@atilimited.net>
      * @return list
      */

        function newEnrolledCourseList()
        {
            $stu_id = $this->input->post('STUDENT_ID');
            $session = $this->input->post('SESSION_ID');

            $data['student_course_list'] = $this->teacher_model->getStudentCourseListByThisAttribute($stu_id, $session);
    //            echo "<pre>"; print_r($data['student_course_list']); exit;
            $data['ACTIVE_STATUS'] = 1;
            $data['session_id'] = $data['student_course_list'][0]->SESSION_ID;
            $data['program_id'] = $data['student_course_list'][0]->PROGRAM_ID;
            $data['stu_reg_no'] = $data['student_course_list'][0]->REGISTRATION_NO;

            $this->load->view('student/registration/new_list', $data);

        }

        /*
         * @methodName noticeBoard()
         * @access
         * @author      rakib <rakib@atilimited.net>
         * @param        none
         * @return      existing room list
         */

        function noticeBoard()
        {
            $data['contentTitle'] = 'Notice';
            $data['breadcrumbs'] = array(
                'Notice' => '#',
                'Notice Board' => '#',
                );
            $data["ac_type"] = 1;
            $data['notice'] = $this->utilities->getAll('notice');
            $data['content_view_page'] = 'admin/setup/notice/notice_board';
            $this->admin_template->display($data);
        }

        /*
         * @methodName residentAppAprv()
         * @access
         * @author      rakib <rakib@atilimited.net>
         * @param        none
         * @return      student application approve for resident
         */

        function residentAppAprv()
        {
            $data['contentTitle'] = 'Resident';
            $data['breadcrumbs'] = array(
                'Resident' => '#',
                'Application' => '#',
                );
            $data["ac_type"] = 1;
            $data['resident_application'] = $this->teacher_model->getResidentApplication();
            $data['content_view_page'] = 'student/hostel/approve_application';
            $this->admin_template->display($data);
        }

        function residentAppAprvByDeptHead()
        {

            $data['application_id'] = $this->input->post('param');
            $this->load->view('student/hostel/approve_application_remarks', $data);
        }

        function saveResidentAppAprvByDeptHead()
        {

            $data_param = array(
                'APPROVE_BY_DEPT_HEAD' => $this->user_id,
                'APPROVE_BY_DEPT_HEAD_STATUS' => $this->input->post('APPROVE_BY_DEPT_HEAD_STATUS'),
                'REMARK_DEPT_HEAD' => $this->input->post('REMARK_DEPT_HEAD')
                );
            $this->utilities->updateData('resident_application', $data_param, array('APP_ID' => $this->input->post('APP_ID')));
        }

        function residentAppAprvForProvost()
        {
            $data['contentTitle'] = 'Resident';
            $data['breadcrumbs'] = array(
                'Resident' => '#',
                'Application' => '#',
                );
            $data["ac_type"] = 1;
            $data['resident_application'] = $this->teacher_model->getResidentApplicationListForProvost();
            $data['content_view_page'] = 'student/hostel/approve_application_list_for_provost';
            $this->admin_template->display($data);
        }

        function residentAppAprvByProvost()
        {

            $data['application_id'] = $this->input->post('param');
            $this->load->view('student/hostel/approve_application_remarks_provost', $data);
        }

        function saveResidentAppAprvByProvost()
        {

            $data_param = array(
                'APPROVE_PROVOST' => $this->user_id,
                'APPROVE_PROVOST_STATUS' => $this->input->post('APPROVE_PROVOST_STATUS'),
                'REMARK_PROVOST' => $this->input->post('REMARK_PROVOST')
                );
            $this->utilities->updateData('resident_application', $data_param, array('APP_ID' => $this->input->post('APP_ID')));
        }

        ##################################################################################################
        /*                                       HR leave                                                */
        ##################################################################################################

        /**
         * @methodName leave
         * @access
         * @param  none
         * @author Abhijit M. Abhi <abhijit@atilimited.net>
         * @return
         */

        function leave()
        {
            $data['contentTitle'] = 'Leave';
            $data['breadcrumbs'] = array(
                'Leave' => '#',
                'Leave Records' => '#',
                );

            // $data["previlages"] = $this->checkPrevilege();

            $emp_id = $this->session->userdata['logged_in']['EMP_ID'];
            $data['emp_id']=$emp_id ;
            $data['leaveType'] = $this->utilities->findAllFromView('hr_leave_type'); 
            $data['leaves'] = $this->db->get_where('hr_leave', array('EMP_ID' => $emp_id))->result();

            $data['content_view_page'] = 'teacher/leave/leave_index';
            $this->admin_template->display($data);
        }

        /**
         * @methodName leaveRequest()
         * @access
         * @param  none
         * @author Md. Reazul Islam <reazul@atilimited.net>
         * @return Mixed Template
         */

        function leaveRequest()
        {
            $data["ac_type"] = 1;
            $data['leaveType'] = $this->utilities->findAllFromView('hr_leave_type'); 
            $this->load->view('teacher/leave/leave_request', $data);
        }


       /**
         * @methodName createLeaveRequest()
         * @access
         * @param  none
         * @author Md. Reazul Islam <reazul@atilimited.net>
         * @return Mixed Template
         */

       function createLeaveRequest()
       {
        $start_date_string = $this->input->post('start_date');
        $end_date_string = $this->input->post('end_date');
        $leave_reason = $this->input->post('leave_reason');
        $emr_contact = $this->input->post('emr_contact');
        $leave_address = $this->input->post('leave_address');
        $start_date = date('Y-m-d', strtotime($start_date_string));
        $end_date = date('Y-m-d', strtotime($end_date_string));
        $leave_type_id = $this->input->post('TYPE_NAME');
        $total_days = $this->input->post('TOTAL_DAYS');

            // $status = ((isset($_POST['status'])) ? 1 : 0);

        $leaveRequest = array(
            'LEAVE_FORM' => $start_date,
            'LEAVE_TO' => $end_date,
            'LEAVE_REASON' => $leave_reason,
            'EMR_CONTACT' => $emr_contact,
            'ADDRESS_DURING_LEAVE' => $leave_address,
            'ACTIVE_STATUS' => 0,
            'CREATED_BY' => $this->user["USER_ID"],
            'DEPT_ID' => $this->user["DEPT_ID"],
            'DESIG_ID' => $this->user["DESIG_ID"],
            'EMP_ID' => $this->session->userdata['logged_in']['EMP_ID'],
            );

        if ($LEAVE_MST_ID=$this->utilities->insert('hr_leave',$leaveRequest)) {
           for ($i=0; $i < sizeof($leave_type_id); $i++) { 
            $leave_chd_data= array(
                'LEAVE_ID' => $LEAVE_MST_ID,
                'LEAVE_TYPE_ID' => $leave_type_id[$i],
                'NO_OF_DAYS' => $total_days[$i],
                'CREATED_BY' => $this->user["USER_ID"]
                );
            $this->utilities->insertData($leave_chd_data, 'hr_leave_chd');

        }

                // if data inserted successfully
        echo "<div class='alert alert-success'>Leave request successfully created</div>";
    } else {
                // if data inserted failed
        echo "<div class='alert alert-danger'>Leave request failed</div>";
    }
}





       /**
         * @methodName leaveFormUpdate()
         * @access
         * @param  none
         * @author Md. Reazul Islam <reazul@atilimited.net>
         * @return Mixed Template
         */

       function leaveFormUpdate()
       {
        $data["ac_type"] = 2;
        $id = $this->input->post('param');
        $data['leave_info'] = $this->teacher_model->getAllLeaveTypeInfo($id);
        $data['mst_leave_info'] = $this->teacher_model->getAllLeaveInfoById($id);
        $data['leaveType'] = $this->utilities->findAllFromView('hr_leave_type'); 

        $this->load->view('teacher/leave/edit_leave_request', $data);
    }

        /**
         * @methodName updateLeave()
         * @access
         * @param  none
         * @author Md. Reazul Islam <reazul@atilimited.net>
         * @return Mixed Template
         */

        function updateLeave($id)
        {
            //$grd_id = $this->input->post('txtLeaveId');
            $start_date_string = $this->input->post('start_date');
            $end_date_string = $this->input->post('end_date');
            $leave_reason = $this->input->post('leave_reason');
            $emr_contact = $this->input->post('emr_contact');
            $leave_address = $this->input->post('leave_address');
            $start_date = date('Y-m-d', strtotime($start_date_string));
            $end_date = date('Y-m-d', strtotime($end_date_string));
            $leaveRequest = array(
                'LEAVE_FORM' => $start_date,
                'LEAVE_TO' => $end_date,
                'LEAVE_REASON' => $leave_reason,
                'EMR_CONTACT' => $emr_contact,
                'ADDRESS_DURING_LEAVE' => $leave_address,
                'CREATED_BY' => $this->user["USER_ID"],
                'DEPT_ID' => $this->user["DEPT_ID"],
                'DESIG_ID' => $this->user["DESIG_ID"],
                'EMP_ID' => $this->session->userdata['logged_in']['EMP_ID'],
                );

            $this->db->update('hr_leave',$leaveRequest,array('LEAVE_ID'=>$id));

            //requisition details table update
            $leave_type_idu = $this->input->post('LEAVE_TYPE_ID');
            $countTypeIdu= count($leave_type_idu);
            $LEAVE_CHD_IDu=$this->input->post('LEAVE_CHD_ID');
            $LEAVE_ID=$this->input->post('LEAVE_ID');
            $NO_OF_DAYS = $this->input->post('NO_OF_DAYS');
            for($re=0;$re<$countTypeIdu;$re++){
                if(!isset($LEAVE_CHD_IDu[$re])==''){
                    $upLeaveReq=array(
                        'LEAVE_ID' => $id,
                        'LEAVE_TYPE_ID' => $leave_type_idu[$re],
                        'NO_OF_DAYS' => $NO_OF_DAYS[$re],
                        'UPDATED_BY' => $this->user["USER_ID"],
                        'UPDATE_DATE'=>date('Y-m-d')
                        );
                }
               // echo '<pre>';print_r($REQUIREMENT_QTY);exit;
                $this->db->update('hr_leave_chd',$upLeaveReq,array('LEAVE_CHD_ID'=>$LEAVE_CHD_IDu[$re]));
            }

             //insert requisition details table
            $LEAVE_ID_C=$this->input->post('LEAVE_ID');
            $leave_type_idi=$this->input->post('LEAVE_TYPE_ID_N');
            $countItemIdd=count($leave_type_idi);
            $NO_OF_DAYSi=$this->input->post('NO_OF_DAYS_I');
           // echo '<pre>';print_r($leave_type_idi);
            $LEAVE_CHD_ID=$this->input->post('LEAVE_ID');
            for($red=0;$red<$countItemIdd;$red++){
                if(isset($leave_type_id[$red])==''){
                 $leaveUP=array(
                    'LEAVE_ID'=> $id,
                    'LEAVE_TYPE_ID' => $leave_type_idi[$red],
                    'NO_OF_DAYS' => $NO_OF_DAYSi[$red],
                    'CREATED_BY' => $this->user["USER_ID"],
                    );

                 $this->db->insert('hr_leave_chd',$leaveUP);

             }
         }
         $this->session->set_flashdata('Success', 'Congratulation ! Leave Request Updated Successfully.');
         redirect('teacher/leave');



     }


       /**
         * @methodName deleteLeaveDetials()
         * @access
         * @param  none
         * @author Md. Reazul Islam <reazul@atilimited.net>
         * @return Mixed Template
         */

       public function deleteLeaveDetials11(){
        $chd_id=$_POST['chd_id'];
        $this->db->delete('hr_leave_chd',array('LEAVE_CHD_ID' => $chd_id)); 
    }


    /**
         * @methodName viewLeaveRequestInfo()
         * @access
         * @param  none
         * @author Md. Reazul Islam <reazul@atilimited.net>
         * @return Mixed Template
         */


    function viewLeaveRequestInfo()
    {
        $id = $this->input->post('param'); 
        $data['leaveType'] = $this->utilities->findAllFromView('hr_leave_type'); 
        $data['leave_info'] = $this->teacher_model->getAllLeaveTypeInfo($id);
        $data['mst_leave_info'] = $this->teacher_model->getAllLeaveInfoById($id);
            //echo "<pre>";print_r($data['mst_leave_info']);exit();
        $this->load->view("teacher/leave/view_leave_request", $data);
    }


     function viewLeaveReportInfo()
    {
        $EMP_ID = $_POST['EMP_ID'];
        $data['emp_id'] = $EMP_ID;
        //$data['leaveType'] = $this->utilities->findAllFromView('hr_leave_approved_chd'); 
        //$data['leave_info'] = $this->teacher_model->getAllLeaveTypeInfo($id);
        $data['mst_leave_info'] = $this->teacher_model->getEmpWiseLeaveReport($emp_id);
            //echo "<pre>";print_r($data['mst_leave_info']);exit();
        $this->load->view("admin/leave_report/view_leave_request", $data);
    }


        /**
         * @methodName leaveById
         * @access
         * @param  none
         * @author Abhijit M. Abhi <abhijit@atilimited.net>
         * @return
         */

        function leaveById()
        {
            $ex_leave_id = $this->input->post('param');
            // $data["previlages"] = $this->checkPrevilege("exam/examApplication");
            $data['row'] = $this->utilities->findByAttribute('hr_leave', array('LEAVE_ID' => $ex_leave_id));
            $this->load->view('teacher/leave/single_leave_application_row', $data);
        }

        /**
         * @methodName leaveList
         * @access
         * @param  none
         * @author Abhijit M. Abhi <abhijit@atilimited.net>
         * @return
         */

        function leaveList()
        {
            // $data["previlages"] = $this->checkPrevilege("exam/gradeSheet");
            $emp_id = $this->session->userdata['logged_in']['EMP_ID'];
            $data['emp_id']=$emp_id ;
            $data['leaveType'] = $this->utilities->findAllFromView('hr_leave_type'); 
            $data['leaves'] = $this->db->get_where('hr_leave', array('EMP_ID' => $emp_id))->result();
            $this->load->view("teacher/leave/leave_records", $data);
        }

        ##################################################################################################
        /*                                       Leave Request from Employee                                               */
        ##################################################################################################


        /**
         * @methodName getLeaveRequest
         * @access
         * @param  none
         * @author Abhijit M. Abhi <abhijit@atilimited.net>
         * @return
         */

        function getLeaveRequest()
        {
            $data['contentTitle'] = 'Leave';
            $data['breadcrumbs'] = array(
                'Leave' => '#',
                'Employee Request' => '#',
                );

            // $data["previlages"] = $this->checkPrevilege();

            $data['leaves'] = $this->employee_model->getAllLeaveRequestsFromEmp();
            $data['content_view_page'] = 'admin/leave_request/leave_request_index';
            $this->admin_template->display($data);
        }




         /**
         * @methodName leaveReport
         * @access
         * @param  none
         * @author Md.Rokibuzzaman <rokibuzzaman@atilimited.net>
         * @return
         */

     public function leaveReport(){
      $data['contentTitle'] = 'Leave Report';
      $data['breadcrumbs'] = array(
        'Admin' => '#',
        'Leave Report' => '#',
        );
        //$data["previlages"] = $this->checkPrevilege();
        $data['leave_report_list'] = $this->employee_model->leaveReportInfo(); // select all data from  faculty
        $data['content_view_page'] = 'admin/leave_report/leave_report_index';
        $this->admin_template->display($data);
      }


        /**
         * @methodName approveLeaveRequest
         * @access
         * @param  none
         * @author Abhijit M. Abhi <abhijit@atilimited.net>
         * @return
         */

        function approveLeaveRequest()
        {
            $data["ac_type"] = 2;
            $id=$data['leave_id'] = $this->input->post('param');
            $data['leave_info'] = $this->teacher_model->getAllLeaveTypeInfo($id);
            $data['leaveType'] = $this->utilities->findAllFromView('hr_leave_type'); 
            //$data['LEAVE_ID'] = $leave_id;
            //$data['leaves'] = $this->employee_model->getAllLeaveRequestsFromEmpById($leave_id);
            $data['leaves'] = $this->teacher_model->getAllLeaveInfoById($id);
            $this->load->view('admin/leave_request/leave_request_approve', $data);
        }

        /**
         * @methodName rejectLeaveRequest
         * @access
         * @param  none
         * @author Abhijit M. Abhi <abhijit@atilimited.net>
         * @return
         */

        function rejectLeaveRequest()
        {
            $data["ac_type"] = 2;
            $data['leave_id'] = $this->input->post('param');

            $this->load->view('admin/leave_request/leave_request_reject', $data);
        }


        /**
         * @methodName updateLeaveRequest
         * @access
         * @param  none
         * @author Abhijit M. Abhi <abhijit@atilimited.net>
         * @return
         */

        function updateLeaveRequest()
        {
            $leave_id = $this->input->post('leaveId');
            $requestType = $this->input->post('requestType');
            $leave_id = $this->input->post('leaveId');
            $remarks = $this->input->post('remarks');

            if ($requestType == 'approve') {

             //insert requisition details table
                $leave_id = $this->input->post('leaveId');
                $EMP_ID = $this->input->post('EMP_ID');
                $DEPT_ID = $this->input->post('DEPT_ID');
                $DESIG_ID = $this->input->post('DESIG_ID');
                $start_date = date('Y-m-d',strtotime($this->input->post('start_date'))); 
                $end_date = date('Y-m-d',strtotime($this->input->post('end_date')));
                $EMP_ID = $this->input->post('EMP_ID');
                $DEPT_ID = $this->input->post('DEPT_ID');
                $DESIG_ID = $this->input->post('DESIG_ID');
                $LEAVE_REASON = $this->input->post('LEAVE_REASON'); 
                $EMR_CONTACT = $this->input->post('EMR_CONTACT'); 
                $ADDRESS_DURING_LEAVE = $this->input->post('ADDRESS_DURING_LEAVE');  

                $leaveMaster=array(
                    'LEAVE_ID'=>$leave_id,
                    'EMP_ID'=>$EMP_ID,
                    'DEPT_ID'=>$DEPT_ID,
                    'DESIG_ID'=>$DESIG_ID,
                    'LEAVE_FORM'=>$start_date,
                    'LEAVE_TO'=>$end_date,
                    'LEAVE_REASON'=>$LEAVE_REASON,
                    'EMR_CONTACT'=>$EMR_CONTACT,
                    'ADDRESS_DURING_LEAVE'=>$ADDRESS_DURING_LEAVE,
                    'CREATED_BY' => $this->user["USER_ID"],
                    );
                $LEAVE_MST_ID=$this->utilities->insert('hr_leave_approved_mst',$leaveMaster);

                $LEAVE_TYPE_ID=$this->input->post('LEAVE_TYPE_ID');
                $countLeaveTypeIdd=count($LEAVE_TYPE_ID);
                $NO_OF_DAYS=$this->input->post('NO_OF_DAYS');
                $LEAVE_CHD_ID=$this->input->post('LEAVE_CHD_ID');
                for ($i=0; $i <$countLeaveTypeIdd; $i++) { 
                   $leave_chd_data= array(
                    'LEAVE_APPROVE_MST_ID' => $LEAVE_MST_ID,
                    'EMP_ID' => $EMP_ID,
                    'LEAVE_CHD_ID' => $LEAVE_CHD_ID[$i],
                    'LEAVE_TYPE_ID' => $LEAVE_TYPE_ID[$i],
                    'NO_OF_DAYS' => $NO_OF_DAYS[$i],
                    'CREATED_BY' => $this->user["USER_ID"]
                    );
                   $this->utilities->insertData($leave_chd_data, 'hr_leave_approved_chd');

               }
               $updateLeave = array(
                'APPROVED_REMARKS' => $remarks,
                'APROVED_STATUS' => 1,
                'ACTIVE_STATUS' => 1,
                'APROVED_BY' => $this->session->userdata['logged_in']['EMP_ID'],
                'UPDATED_BY' => $this->session->userdata['logged_in']['EMP_ID'],
                );
           } elseif ($requestType == 'reject') {
            $updateLeave = array(
                'APPROVED_REMARKS' => $remarks,
                'APROVED_STATUS' => 2,
                'ACTIVE_STATUS' => 0,
                'APROVED_BY' => $this->session->userdata['logged_in']['EMP_ID'],
                'UPDATED_BY' => $this->session->userdata['logged_in']['EMP_ID'],
                );

        }
        $this->db->update('hr_leave',$updateLeave,array('LEAVE_ID'=>$leave_id));



        $this->session->set_flashdata('Success', 'Congratulation ! Leave Approve Updated Successfully.');
      //redirect('teacher/leaveRequestById');
    }

        /**
         * @methodName leaveRequestById
         * @access
         * @param  none
         * @author Abhijit M. Abhi <abhijit@atilimited.net>
         * @return
         */

        function leaveRequestById()
        {
            $ex_leave_id = $this->input->post('param');
            $data['row'] = $this->employee_model->getAllLeaveRequestsFromEmpById($ex_leave_id);
            $this->load->view('admin/leave_request/single_leave_request_application_row', $data);
        }


        /**
         * @methodName leaveType()
         * @access
         * @param  none
         * @author Md. Reazul Islam <reazul@atilimited.net>
         * @return Mixed Template
         */
        function leaveType()
        {
            $data['contentTitle'] = 'Leave';
            $data['breadcrumbs'] = array(
                'Leave Type' => '#',
                'Leave Type List' => '#',
                );
            $data["previlages"] = $this->checkPrevilege();
            $data['leaveType'] = $this->utilities->findAllFromView('hr_leave_type'); // select all data from leave type
            $data['content_view_page'] = 'admin/leave_type/leave_type_index';
            $this->admin_template->display($data);
        }

        /**
         * @methodName leaveTypeFormInsert()
         * @access
         * @param  none
         * @author Md. Reazul Islam <reazul@atilimited.net>
         * @return Mixed Template
         */

        function leaveTypeFormInsert()
        {
            $data["ac_type"] = 1;
            $this->load->view('admin/leave_type/add_leave_type', $data);
        }

          /**
         * @methodName leaveTypeList()
         * @access
         * @param  none
         * @author Md. Reazul Islam <reazul@atilimited.net>
         * @return Mixed Template
         */


          function leaveTypeList()
          {
            $data["previlages"] = $this->checkPrevilege("teacher/leaveType");
            $data['leaveType'] = $this->utilities->findAllFromView('hr_leave_type'); // select all data from unit
            $this->load->view("admin/leave_type/leave_type_list", $data);
        }

        /**
         * @methodName createLeaveType()
         * @access
         * @param  none
         * @author Md. Reazul Islam <reazul@atilimited.net>
         * @return Mixed Template
         */


        function createLeaveType()
        {
            $leaveType = $this->input->post('leaveType'); // leave Type name
            $description = $this->input->post('description'); // description
            $totalDays = $this->input->post('totalDays'); // total Days
            $status = ((isset($_POST['status'])) ? 1 : 0); // active status
            // checking if Degree with this name is already exist
            $check = $this->utilities->hasInformationByThisId("hr_leave_type", array("TYPE_NAME" => $leaveType));
            if (empty($check)) {// if unit name available
                // preparing data to insert
                $leaveType = array(
                    'TYPE_NAME' => $leaveType,
                    'LEAVE_DESC' => $description,
                    'TOTAL_DAYS' => $totalDays,
                    'ACTIVE_STATUS' => $status,
                    'CREATED_BY' => $this->user["USER_ID"]
                    );
                if ($this->utilities->insertData($leaveType, 'hr_leave_type')) { // if data inserted successfully
                    echo "<div class='alert alert-success'>Leave Type Create successfully</div>";
                } else { // if data inserted failed
                    echo "<div class='alert alert-danger'>Leave  Type insert failed</div>";
                }
            } else {// if leave Type name not available
                echo "<div class='alert alert-danger'>Leave  Type Already Exist</div>";
            }
        }

          /**
         * @methodName leaveTypeFormUpdate()
         * @access
         * @param  none
         * @author Md. Reazul Islam <reazul@atilimited.net>
         * @return Mixed Template
         */


          function leaveTypeFormUpdate()
          {
            $data["ac_type"] = 2;
            $id = $this->input->post('param'); // unit ID
            $data['leaveType'] = $this->utilities->findByAttribute('hr_leave_type', array('LEAVE_TYPE_ID' => $id)); // select all data from degree where degree id
            $this->load->view('admin/leave_type/add_leave_type', $data);
        }

        /**
         * @methodName updateLeaveType()
         * @access
         * @param  none
         * @author Md. Reazul Islam <reazul@atilimited.net>
         * @return Mixed Template
         */

        function updateLeaveType()
        {
            $leave_type_id = $this->input->post('txtLeaveTypeId'); // leave type id
            $leaveType = $this->input->post('leaveType'); // leave Type name
            $description = $this->input->post('description'); // description
            $totalDays = $this->input->post('totalDays'); // total Days
            $status = ((isset($_POST['status'])) ? 1 : 0); // active status
            // checking if unit with this name is already exist
            $check = $this->utilities->hasInformationByThisId("hr_leave_type", array("TYPE_NAME" => $leaveType, "LEAVE_TYPE_ID !=" => $leave_type_id));

            if (empty($check)) {// if unit name available
                // preparing data to insert
                $leaveType = array(
                    'TYPE_NAME' => $leaveType,
                    'LEAVE_DESC' => $description,
                    'TOTAL_DAYS' => $totalDays,
                    'ACTIVE_STATUS' => $status,
                    'UPDATED_BY' => $this->user["USER_ID"]
                    );
                //var_dump($unit); exit();
                if ($this->utilities->updateData('hr_leave_type', $leaveType, array('LEAVE_TYPE_ID' => $leave_type_id))) { // if data update successfully
                    echo "<div class='alert alert-success'>Leave Type Update successfully</div>";
                } else { // if data update failed
                    echo "<div class='alert alert-danger'>Leave Type Update failed</div>";
                }
            } else {// if unit name not available
                echo "<div class='alert alert-danger'>Leave Type Already Exist</div>";
            }
        }

         /**
         * @methodName leaveTypeById()
         * @access
         * @param  none
         * @author Md. Reazul Islam <reazul@atilimited.net>
         * @return Mixed Template
         */

         function leaveTypeById()
         {
            $data["previlages"] = $this->checkPrevilege("teacher/leaveType");
            $leave_type_id = $this->input->post('param'); // leave Type name
            $data['row'] = $this->utilities->findByAttribute('hr_leave_type', array('LEAVE_TYPE_ID' => $leave_type_id)); // select all data from leave Type where leave type  id
            $this->load->view('admin/leave_type/single_leave_type_row', $data);
        }


    }
