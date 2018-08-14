<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* @category   FrontPortal
* @package    Portal
* @author     Emdadul Huq <Emdadul@atilimited.net>
* @copyright  2015 ATI Limited Development Group
*/
class Report extends CI_Controller {

    private $user_session;
    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('auth/login', 'refresh');
        }
        $this->user_session = $this->session->userdata('logged_in');
        header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->load->model('utilities');
    }
    /**
     * @methodName checkPrevilege()
     * @access
     * @param  none
     * @return Mixed View
     */

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
    /**
    * @methodName semesterWiseReport()
    * @access
    * @param  none
    * @author Emdadul Huq <Emdadul@atilimited.net>
    * @return Mixed Template
    */
    public function semesterWiseReport()
    {
        $data["breadcrumbs"] = array(
            "Admin" => '#',
            "Semester Wise Due" => "admin/Semester Wise Due"

        );
        $data['contentTitle'] = 'Semester Wise Due';
        $data["ac_type"] = '';
        $data['faculty'] = $this->utilities->findAllByAttribute('faculty', array("ACTIVE_STATUS" => 1, "ADMINISTRATION" => 0));
        $data['dimention'] = "horizental";
        $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
        $data["session"] = $this->utilities->getAll("session_view");
        $data['content_view_page'] = 'admin/report/semester_wise_due_index';
        $this->admin_template->display($data);
    }
    /**
    * @methodName semesterDue()
    * @access
    * @param  none
    * @author Emdadul Huq <Emdadul@atilimited.net>
    * @return Mixed Template
    */
    function semesterDue($FACULTY_ID, $DEPT_ID, $PROGRAM_ID, $SESSION_ID, $SEMESTER_ID){
        $data['pageTitle'] = 'Print PDF';
        $data['faculty'] = $this->utilities->findByAttribute('faculty', array("FACULTY_ID" => $FACULTY_ID));
        $data['dept'] = $this->utilities->findByAttribute('department', array("DEPT_ID" => $DEPT_ID));
        $program = $this->utilities->findByAttribute('program', array("PROGRAM_ID" => $PROGRAM_ID));
        $data['program'] = $program;
        $data['degree'] = $this->utilities->findByAttribute('degree', array("DEGREE_ID" => $program->DEGREE_ID));
        $data['semester'] = $this->utilities->findByAttribute('sav_semester', array("SEMESTER_ID" => $SEMESTER_ID));
        $data["session"] = $this->db->query("SELECT sy.SES_YEAR_ID, s.SESSION_NAME, ys.YEAR_SETUP_TITLE
                                            FROM session_year sy
                                            LEFT JOIN session s on s.SESSION_ID = sy.SESSION
                                            LEFT JOIN year_setup ys on ys.YEAR_SETUP_ID = sy.YEAR_SETUP_ID
                                            WHERE sy.SES_YEAR_ID = $SESSION_ID")->row();
        $data['semester_due'] = $this->db->query("SELECT SUM(R.CR) CR, SUM(R.DR)DR, R.FULL_NAME_EN, R.STUDENT_ID
                                                    FROM (
                                                    SELECT NULL CR,SUM(VL.DR_AMT)DR , (SELECT SI.FULL_NAME_EN FROM STUDENTS_INFO SI WHERE SI.STUDENT_ID = BV.STUDENT_ID)FULL_NAME_EN, BV.STUDENT_ID
                                                    FROM BM_VOUCHERMST BV
                                                    INNER JOIN BM_VN_LEDGERS VL ON (VL.VOUCHER_NO = BV.VOUCHER_NO AND VL.TRX_CODE_NO ='PM' )
                                                    WHERE  BV.FACULTY_ID = $FACULTY_ID AND BV.DEPT_ID = $DEPT_ID AND BV.PROGRAM_ID = $PROGRAM_ID AND BV.SESSION_ID = $SESSION_ID AND BV.SEMESTER_ID = $SEMESTER_ID
                                                    GROUP BY BV.VOUCHER_NO
                                                    UNION ALL
                                                    SELECT SUM(VL.CR_AMT)CR , NULL DR, (SELECT SI.FULL_NAME_EN FROM STUDENTS_INFO SI WHERE SI.STUDENT_ID = BV.STUDENT_ID)FULL_NAME_EN, BV.STUDENT_ID
                                                    FROM BM_VOUCHERMST BV
                                                    INNER JOIN BM_VN_LEDGERS VL ON (VL.VOUCHER_NO = BV.VOUCHER_NO AND VL.TRX_CODE_NO ='GR' )
                                                    WHERE  BV.FACULTY_ID = $FACULTY_ID AND BV.DEPT_ID = $DEPT_ID AND BV.PROGRAM_ID = $PROGRAM_ID AND BV.SESSION_ID = $SESSION_ID AND BV.SEMESTER_ID = $SEMESTER_ID
                                                    GROUP BY BV.VOUCHER_NO) R
                                                    GROUP BY  R.FULL_NAME_EN, R.STUDENT_ID
                                                    ")->result();

        include('mpdf/mpdf.php');
        $mpdf = new mPDF();
        $mpdf->SetTitle('Semester Due');
        $mpdf->mirrorMargins = 1;
        $mpdf->useOnlyCoreFonts = true;
        $report = $this->load->view('admin/report/semester_wise_due_report', $data, TRUE);
        $mpdf->WriteHTML("body { font-family: arial; }$report");
        $mpdf->Output();
        exit;

    }
    /**
    * @methodName searchSemesterDue()
    * @access
    * @param  none
    * @author Emdadul Huq <Emdadul@atilimited.net>
    * @return Mixed Template
    */
    function searchSemesterDue(){
        $FACULTY_ID = $this->input->post('FACULTY_ID');
        $DEPT_ID = $this->input->post('DEPT_ID');
        $PROGRAM_ID = $this->input->post('PROGRAM_ID');
        $SEMESTER_ID = $this->input->post('SEMESTER_ID');
        $SESSION_ID = $this->input->post('SESSION_ID');
        $data['faculty'] = $this->utilities->findByAttribute('faculty', array("FACULTY_ID" => $FACULTY_ID));
        $data['dept'] = $this->utilities->findByAttribute('department', array("DEPT_ID" => $DEPT_ID));
        $program = $this->utilities->findByAttribute('program', array("PROGRAM_ID" => $PROGRAM_ID));
        $data['program'] = $program;
        $data['degree'] = $this->utilities->findByAttribute('degree', array("DEGREE_ID" => $program->DEGREE_ID));
        $data['semester'] = $this->utilities->findByAttribute('sav_semester', array("SEMESTER_ID" => $SEMESTER_ID));
        $data["session"] = $this->db->query("SELECT sy.SES_YEAR_ID, s.SESSION_NAME, ys.YEAR_SETUP_TITLE
                                            FROM session_year sy
                                            LEFT JOIN session s on s.SESSION_ID = sy.SESSION
                                            LEFT JOIN year_setup ys on ys.YEAR_SETUP_ID = sy.YEAR_SETUP_ID
                                            WHERE sy.SES_YEAR_ID = $SESSION_ID")->row();
        $data['semester_due'] = $this->db->query("SELECT SUM(R.CR) CR, SUM(R.DR)DR, R.FULL_NAME_EN, R.STUDENT_ID
                                                    FROM (
                                                    SELECT NULL CR,SUM(VL.DR_AMT)DR , (SELECT SI.FULL_NAME_EN FROM STUDENTS_INFO SI WHERE SI.STUDENT_ID = BV.STUDENT_ID)FULL_NAME_EN, BV.STUDENT_ID
                                                    FROM BM_VOUCHERMST BV
                                                    INNER JOIN BM_VN_LEDGERS VL ON (VL.VOUCHER_NO = BV.VOUCHER_NO AND VL.TRX_CODE_NO ='PM' )
                                                    WHERE  BV.FACULTY_ID = $FACULTY_ID AND BV.DEPT_ID = $DEPT_ID AND BV.PROGRAM_ID = $PROGRAM_ID AND BV.SESSION_ID = $SESSION_ID AND BV.SEMESTER_ID = $SEMESTER_ID
                                                    GROUP BY BV.VOUCHER_NO
                                                    UNION ALL
                                                    SELECT SUM(VL.CR_AMT)CR , NULL DR, (SELECT SI.FULL_NAME_EN FROM STUDENTS_INFO SI WHERE SI.STUDENT_ID = BV.STUDENT_ID)FULL_NAME_EN, BV.STUDENT_ID
                                                    FROM BM_VOUCHERMST BV
                                                    INNER JOIN BM_VN_LEDGERS VL ON (VL.VOUCHER_NO = BV.VOUCHER_NO AND VL.TRX_CODE_NO ='GR' )
                                                    WHERE  BV.FACULTY_ID = $FACULTY_ID AND BV.DEPT_ID = $DEPT_ID AND BV.PROGRAM_ID = $PROGRAM_ID AND BV.SESSION_ID = $SESSION_ID AND BV.SEMESTER_ID = $SEMESTER_ID
                                                    GROUP BY BV.VOUCHER_NO) R
                                                    GROUP BY  R.FULL_NAME_EN, R.STUDENT_ID
                                                    ")->result();
         $this->load->view('admin/report/semester_wise_due', $data);
    }

}

/* End of file Report.php */
/* Location: ./application/controllers/Report.php */