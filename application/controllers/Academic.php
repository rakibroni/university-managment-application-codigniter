<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @category   Academic
 * @package    Academic Activity
 * @author     Jahid Hasan <jahid@atilimited.net>
 * @copyright  2015 ATI Limited Development Group
 */

class Academic extends CI_Controller {

    private $user;

    public function __construct() {
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

    function index() {
        $data['contentTitle'] = 'New Semester Registration Request';
        $data['breadcrumbs'] = array(
            'Academic' => 'academic/index',
            'Academic List' => '#'
        );
        $data["reg_periods"] = $this->utilities->getAll("reg_crs_reg_period");

        $data["ac_type"] = '';
        $data['faculty'] = $this->utilities->findAllByAttribute('faculty', array("ACTIVE_STATUS" => 1, "ADMINISTRATION" => 0));
        $data['dimention'] = "horizental";
        $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
        $data["session"] = $this->db->query("SELECT sy.SES_YEAR_ID, s.SESSION_NAME, ys.YEAR_SETUP_TITLE
                                            FROM session_year sy
                                            LEFT JOIN session s on s.SESSION_ID = sy.SESSION
                                            LEFT JOIN year_setup ys on ys.YEAR_SETUP_ID = sy.YEAR_SETUP_ID")->result();
        $data['academic'] = $this->db->query("SELECT b.*,
										a.FULL_NAME_EN,
										a.ROLL_NO,
										d.FACULTY_NAME,
										e.DEPT_NAME,
										f.PROGRAM_NAME,
								                m.LKP_NAME LKP_NAME, m.LKP_ID,
								                t.COURSE_TITLE COURSE_TITLE
										FROM stu_courseinfo b
										INNER JOIN students_info a ON b.STUDENT_ID = a.STUDENT_ID
										INNER JOIN aca_course_offer c ON b.OFFERED_COURSE_ID = c.OFFERED_COURSE_ID
										INNER JOIN faculty d ON c.FACULTY_ID = d.FACULTY_ID
										INNER JOIN department e ON c.DEPT_ID = e.DEPT_ID
										INNER JOIN program f ON c.PROGRAM_ID = f.PROGRAM_ID
								        INNER JOIN m00_lkpdata m ON m.LKP_ID = b.SEMISTER_ID
								        INNER JOIN aca_course t ON t.COURSE_ID = b.COURSE_ID
                                                                        where b.IS_CURRENT=1
                                                                        GROUP BY b.STUDENT_ID")->result();
        $data['content_view_page'] = 'academic/index';
        $this->admin_template->display($data);
    }

    /*
     * @methodName ajax_get_department()
     * @access none
     * @param  none
     * @return Mixed Template
     */

    function ajax_get_department() {
        $faculty = $_POST['selectedValue'];
        $query = $this->utilities->findAllByAttribute('department', array("FACULTY_ID" => $faculty, "ACTIVE_STATUS" => 1));
        $returnVal = '<option value="" id="cmbFaculty" >Select One</option>';
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value="' . $row->DEPT_ID . '">' . $row->DEPT_NAME . '</option>';
            }
        }
        echo $returnVal;
    }

    /*
     * @methodName ajax_get_program()
     * @access none
     * @param  none
     * @return Mixed Template
     */

    public function ajax_get_program() {
        $department = $_POST['selectedValue'];
        $query = $this->utilities->findAllByAttribute('program', array("DEPT_ID" => $department, "ACTIVE_STATUS" => 1));
        $returnVal = '<option value="">Select one</option>';
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value="' . $row->PROGRAM_ID . '">' . $row->PROGRAM_NAME . '</option>';
            }
        }
        echo $returnVal;
    }

    public function ajax_get_course() {
        $program = $_POST['selectedValue'];
        // $query = $this->utilities->findAllByAttribute('aca_course_offer', array("PROGRAM_ID" => $program, "ACTIVE_STATUS" => 1));
        $query = $this->db->query("select c.COURSE_ID,c.COURSE_TITLE
									from program p, aca_course_offer o,aca_course c
									where p.PROGRAM_ID=o.PROGRAM_ID
									and o.COURSE_ID=c.COURSE_ID
									and o.PROGRAM_ID= $program")->result();
        $returnVal = '<option value="">Select one</option>';
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value="' . $row->COURSE_ID . '">' . $row->COURSE_TITLE . '</option>';
            }
        }
        echo $returnVal;
    }

    /**
     * @methodName  newRegistration()
     * @access
     * @param
     * @author      Jahid Hasan <jahid@atilimited.net>
     * @return      Student List accourding to search result
     */
    function newRegistration() {
        $faculty = $this->input->post('FACULTY_ID');
        $department = $this->input->post('DEPT_ID');
        $program = $this->input->post('PROGRAM_ID');
        $period = $this->input->post('REG_PERIOD_ID');
        $faculty_id = '';
        $department_id = '';
        $program_id = '';
        $period_id = '';

        if ($faculty != '') {
            $faculty_id = "AND s.FACULTY_ID = $faculty";
        }
        if ($department != '') {
            $department_id = "AND d.DEPT_ID =$department";
        }
        if ($program != '') {
            $program_id = "AND p.PROGRAM_ID =$program";
        }
        if ($period != '') {
            $regPeriod = $this->utilities->findByAttribute("reg_crs_reg_period",array("REG_PERIOD_ID" => $period));
            $period_id = "s.REG_PERIOD_ID =$period";
        }        
        $semester_id = "AND s.SEMESTER_ID =$regPeriod->SEMESTER_ID";    
        $session_id = "AND s.SESSION_ID =$regPeriod->SESSION_ID";

        $data['students'] = $this->db->query("SELECT s.*, sv.SESSION_NAME,
                                               i.ROLL_NO,
                                               i.FULL_NAME_EN,
                                               f.FACULTY_NAME,
                                               d.DEPT_NAME,
                                               p.PROGRAM_NAME,
                                               m.LKP_NAME LKP_NAME, m.LKP_ID,
                                               t.COURSE_TITLE COURSE_TITLE
                                          FROM reg_stu_crs_request s
                                               INNER JOIN students_info i ON s.STUDENT_ID = i.STUDENT_ID
                                               INNER JOIN faculty f ON f.FACULTY_ID = s.FACULTY_ID
                                               INNER JOIN department d ON d.DEPT_ID = s.DEPT_ID
                                               INNER JOIN program p ON p.PROGRAM_ID = s.PROGRAM_ID
                                               INNER JOIN m00_lkpdata m ON m.LKP_ID = s.SEMESTER_ID
                                               INNER JOIN aca_course t ON t.COURSE_ID = s.COURSE_ID
                                               INNER JOIN session_view sv on sv.SESSION_ID = s.SESSION_ID
                                               WHERE $period_id $faculty_id $department_id $semester_id $session_id  GROUP BY s.STUDENT_ID")->result();
        $data["reg_periods"] = $this->utilities->dropdownFromTableWithCondition("reg_crs_reg_period", "Select Period", "REG_PERIOD_ID", "RP_TITLE");
        $this->load->view('academic/registration_list', $data);
    }

    /**
     * @param       REG_PERIOD_ID defining Registration period id
     * @author      Jahid Hasan <jahid@atilimited.net>
     * @return      Process registration data
     */
    function approveRegistration() {
        $regId = $this->input->post('REG_PERIOD_ID');
        $regPeriod = $this->utilities->findByAttribute("reg_crs_reg_period",array("REG_PERIOD_ID" => $regId));
        // recieve form data
        $cmbFaculty = $regPeriod->FACULTY_ID;
        $department = $regPeriod->DEPT_ID;
        $program = $regPeriod->PROGRAM_ID;
        $semester = $regPeriod->SEMESTER_ID;
        $session = $regPeriod->SESSION_ID;
        $stdReqId = $this->input->post('studentReqId');
        $remarks = "Semester Registration";
        $get_semester_particulars_array = array(
            'SESSION_ID' => $session,
            'SEMESTER_ID' => $semester,
            'FACULTY_ID' => $cmbFaculty,
            'DEPT_ID' => $department,
            'PROGRAM_ID' => $program
        );
        $get_semester_particulars = $this->utilities->findAllByAttribute("ac_program_particulars", $get_semester_particulars_array);
        if(!empty($get_semester_particulars)){            
            /*reg_stu_crs_request update ACTIVE_STATUS 1 */
            for ($i = 0; $i< sizeof($stdReqId); $i++) {
                $course = $this->input->post('courseId'.$stdReqId[$i]);
                for ($j=0; $j< sizeof($course); $j++) {
                    $this->utilities->updateData('reg_stu_crs_request', array("ACTIVE_STATUS" => 1), array("FACULTY_ID" => $cmbFaculty, "DEPT_ID" => $department, "PROGRAM_ID" => $program, "SEMESTER_ID" => $semester,"SESSION_ID" => $session, "STUDENT_ID" => $stdReqId[$i], "COURSE_ID" => $course[$j]));
                }
            }
            /* end update part*/
            // get semester particulars
            $success = 0;
            // looping all student requested course for registration
            for ($i = 0; $i < sizeof($stdReqId); $i++) {
                // get student informations
                $student_info = $this->utilities->findByAttribute("students_info", array("STUDENT_ID" => $stdReqId[$i]));
                $voucher_no = $this->utilities->pk_f('bm_vouchermst'); // get Primary Key
                $this->db->trans_start();
                // insert data into Voucher Master Table
                $v_master_data_array = array(
                    "VOUCHER_NO" => $voucher_no,
                    "VOUCHER_DT" => date("Y/m/d"),
                    "STUDENT_ID" => $stdReqId[$i],
                    "ROLL_NO" => $student_info->ROLL_NO,
                    "FACULTY_ID" => $cmbFaculty,
                    "DEPT_ID" => $department,
                    "PROGRAM_ID" => $program,
                    "SESSION_ID" => $session,
                    "SEMESTER_ID" => $semester,
                    "ORG_ID" => 1,
                    "REMARKS" => $remarks,
                    "CREATED_BY" => $this->user["USER_ID"]
                );
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
                        "REMARKS" => $remarks,
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
                $add_session = $this->utilities->findByAttribute("students_info", array("STUDENT_ID" => $stdReqId[$i])); /*Student admission session*/
                $semester_info_pk = $this->utilities->pk_f('stu_semesterinfo');
                $semester_data_array = array(
                    "S_SEMESTER_ID" => $semester_info_pk,
                    "STUDENT_ID" => $stdReqId[$i],
                    "FACULTY_ID" => $cmbFaculty,
                    "DEPT_ID" => $department,
                    "PROGRAM_ID" => $program,
                    "SESSION_ID" => $add_session->ADM_SESSION_ID,
                    "SEM_SESSION" => $session,
                    "SEMESTER_ID" => $semester,
                    "IS_CURRENT" => 1,
                    "CREATED_BY" => $this->user["USER_ID"]
                );
                $this->db->insert("stu_semesterinfo", $semester_data_array);
                $update_semester_info = array(
                    'IS_CURRENT' => 0
                );
                $this->utilities->updateData('stu_semesterinfo', $update_semester_info, array('STUDENT_ID' => $stdReqId[$i], 'S_SEMESTER_ID !=' => $semester_info_pk));
                /*start course upgrade*/
                $courseInfo = $this->db->query("SELECT acs.COURSE_ID, aco.OFFERED_COURSE_ID
                                                FROM aca_semester_course acs
                                                INNER JOIN aca_course_offer aco on (aco.COURSE_ID = acs.COURSE_ID) AND (aco.FACULTY_ID = acs.FACULTY_ID) AND (aco.DEPT_ID = acs.DEPT_ID) AND (aco.PROGRAM_ID = acs.PROGRAM_ID)
                                                WHERE aco.PROGRAM_ID = $program AND acs.SEMESTER_ID = $semester AND aco.FACULTY_ID = $cmbFaculty AND aco.DEPT_ID = $department
                                                ")->result();
                $check = 0;
                foreach ($courseInfo as $course) {
                    $course_info_pk = $this->utilities->pk_f('stu_courseinfo');
                    $courseInfo = array(
                        'STU_CRS_ID' => $course_info_pk,
                        'STUDENT_ID' => $stdReqId[$i],
                        'OFFERED_COURSE_ID' => $course->OFFERED_COURSE_ID,
                        'SESSION_ID' => $add_session->ADM_SESSION_ID,
                        "SEM_SESSION" => $session,
                        'SEMISTER_ID' => $semester,
                        'FACULTY_ID' => $cmbFaculty,
                        'DEPT_ID' => $department,
                        'PROGRAM_ID' => $program,
                        'COURSE_ID' => $course->COURSE_ID,
                        'IS_CURRENT' => 1,
                        'IS_DROPPED' => 0,
                        'ACTIVE_STATUS' => 1,
                        'CREATED_BY' => $this->user["USER_ID"]
                    );
                    $check = $this->utilities->hasInformationByThisId("stu_courseinfo",
                        array('STUDENT_ID' => $stdReqId[$i],
                            'OFFERED_COURSE_ID' => $course->OFFERED_COURSE_ID,
                            "SEM_SESSION" => $session,
                            'SEMISTER_ID' => $semester,
                            'FACULTY_ID' => $cmbFaculty,
                            'DEPT_ID' => $department,
                            'PROGRAM_ID' => $program,
                            'COURSE_ID' => $course->COURSE_ID,
                            'IS_CURRENT' => 1));
                    if (empty($check)) {// if Program name available
                        if ($this->utilities->insertData($courseInfo, 'stu_courseinfo')) { // if data inserted successfully
                            $preCourse = $this->db->query("SELECT acs.COURSE_ID
                                            FROM stu_courseinfo acs
                                            WHERE acs.STUDENT_ID = $stdReqId[$i] AND acs.SEMISTER_ID < $semester ")->result();
                            $courseUp = array(
                                'IS_CURRENT' => 0,
                                'UPDATED_BY' => $this->user["USER_ID"]
                            );
                            foreach ($preCourse as $preC) {
                                $this->utilities->updateData('stu_courseinfo', $courseUp, array('STUDENT_ID' => $stdReqId[$i], 'COURSE_ID' => $preC->COURSE_ID));
                            }
                        }
                    }
                }
                /*end course upgrade*/

                $this->db->trans_complete();
                if ($this->db->trans_status() == TRUE) {
                    echo "";
                } else {
                    echo "Failed";
                }
                $success = 1;
            }
            if($success == 1){
                echo "&nbsp;&nbsp;<span class='btn btn-outline btn-success btn-sm'>Approved successfully &nbsp;<span class='text-primary'> <i class='fa fa-check'></i></span></span>";
            }
        }else {
            echo "app";
        }
    }

}

/* End of file Academic.php */
/* Location: ./application/controllers/Academic.php */