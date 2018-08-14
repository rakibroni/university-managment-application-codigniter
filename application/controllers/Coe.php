<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @category   FrontPortal
 * @package    Portal
 * @author     Emdadul Huq <Emdadul@atilimited.net>
 * @copyright  2015 ATI Limited Development Group
 */
class Coe extends CI_Controller
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
     * @access none
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
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
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return kk
     */
    function exam()
    {
        $data['contentTitle'] = 'Exam';
        $data['breadcrumbs'] = array(
            'Exam' => '#',
            'Exam List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['exam'] = $this->db->query("SELECT x.*, ses.SESSION_NAME
                                                  FROM exam x
                                                  LEFT JOIN session_view ses ON ses.SESSION_ID = x.SESSION_ID  ")->result();
        $data['content_view_page'] = 'admin/coe/exam/index';
        $this->admin_template->display($data);
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return vv
     */
    function examForm()
    {
        $data["ac_type"] = 1; /* Insertion form */

        $data["session"] = $this->utilities->getAll("session_view"); // select all Semester name from  m00_lkpdata
        $data["program"] = $this->utilities->getAll("program"); // select all Semester name from  m00_lkpdata
        $data["exam_type"] = $this->utilities->getAll("exam_type");

        //print_r( $data['exam_policy']);exit;
        $this->load->view('admin/coe/exam/add_exam', $data);
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return vv
     */
    function createExam()
    {
        $PROGRAM_ID = $this->input->post("allValues");

        $EX_TYPE_ID = $this->input->post("EX_TYPE_ID");
        $SESSION_ID = $this->input->post("SESSION_ID");
        $EX_TITLE = $this->input->post("EX_TITLE");
        $EX_DESC = $this->input->post("EX_DESC");
        $startDate = $this->input->post("EX_DT_FROM");
        $endDate = $this->input->post("EX_DT_TO");
        $status = ((isset($_POST['status'])) ? 1 : 0);

        $date1 = explode("/", $startDate);
        $EX_DT_FROM = $date1[2] . '-' . $date1[1] . '-' . $date1[0];
        $date2 = explode("/", $endDate);
        $EX_DT_TO = $date2[2] . '-' . $date2[1] . '-' . $date2[0];


        $check = $this->utilities->hasInformationByThisId("exam", array("EX_TITLE" => $EX_TITLE));
        if(empty($check)){
        $exam = array(
            'SESSION_ID' => $SESSION_ID,
            'EX_TYPE_ID' => $EX_TYPE_ID,
            'EX_TITLE' => $EX_TITLE,
            'EX_DESC' => $EX_DESC,
            'EX_DT_FROM' => $EX_DT_FROM,
            'EX_DT_TO' => $EX_DT_TO,
            'ACTIVE_STATUS' => $status,
            'CREATED_BY' => $this->user["USER_ID"]
        );
        $EXAM_ID = $this->utilities->insert('exam', $exam);
        if (!empty($PROGRAM_ID)) {
            foreach ($PROGRAM_ID as $key => $value) {

                $exam_program_data = array(
                    'EXAM_ID' => $EXAM_ID,
                    'PROGRAM_ID' => $value
                );


                $this->utilities->insert('exam_programs', $exam_program_data);
            }
        }
        echo "<div class='alert alert-success'>Exam Create successfully</div>";
        }else{
            echo "<div class='alert alert-error'>Exam name already exits please change the name and submit</div>";
        }
    }

    /**
     * @access
     * @param  EXAM ID
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return cc
     */
    function examInfo()
    {
        $EXAM_ID = $this->input->post('param'); /* EXAM ID*/
        $data['exam'] = $this->db->query("SELECT x.*,

                                                   ses.SESSION_NAME

                                              FROM exam x
                                              LEFT JOIN session_view ses ON ses.SESSION_ID = x.SESSION_ID
                                                                                    WHERE x.EXAM_ID = $EXAM_ID
                                        ")->row();
        $this->load->view('admin/coe/exam/exam_info', $data);
    }

    /**
     * @access
     * @param  EXAM ID
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return h
     */
    function examById()
    {
        $EXAM_ID = $this->input->post('param'); /* EXAM ID*/
        $data["previlages"] = $this->checkPrevilege("Coe/exam");
        $data['exam'] = $this->db->query("SELECT x.*,

                                                   ses.SESSION_NAME

                                              FROM exam x
                                              LEFT JOIN session_view ses ON ses.SESSION_ID = x.SESSION_ID
                                        WHERE x.EXAM_ID = $EXAM_ID
                                        ")->result();

        $this->load->view('admin/coe/exam/single_row_exam', $data);
    }

    /**
     * @access
     * @param  Exam ID
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return   dfg
     */
    function examFormUpdate()
    {
        $data["ac_type"] = "edit"; // Update Form
        $EXAM_ID = $this->input->post('param'); // Exam ID
        $data["program"] = $this->utilities->getAll("program"); // select all program name from  program
        $data["session"] = $this->utilities->getAll("session_view");
        $data["exam_type"] = $this->utilities->getAll("exam_type"); // select all Semester name from  m00_lkpdata
        $data['previous_info'] = $this->utilities->findByAttribute("exam", array("EXAM_ID" => $EXAM_ID));

        $this->load->view('admin/coe/exam/add_exam', $data);
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function updateExam()
    {
        $PROGRAM_ID = $this->input->post("PROGRAM_ID");

        $examId = $this->input->post("examId");
        $EX_TYPE_ID = $this->input->post("EX_TYPE_ID");
        $SESSION_ID = $this->input->post("SESSION_ID");
        $EX_TITLE = $this->input->post("EX_TITLE");
        $EX_DESC = $this->input->post("EX_DESC");
        $startDate = $this->input->post("EX_DT_FROM");
        $endDate = $this->input->post("EX_DT_TO");
        $status = ((isset($_POST['status'])) ? 1 : 0);

        $date1 = explode("/", $startDate);
        $EX_DT_FROM = $date1[2] . '-' . $date1[1] . '-' . $date1[0];
        $date2 = explode("/", $endDate);
        $EX_DT_TO = $date2[2] . '-' . $date2[1] . '-' . $date2[0];
        //$check = $this->utilities->hasInformationByThisId("exam", array("EX_TITLE" => $EX_TITLE, "EX_DESC" => $EX_DESC, "EX_DT_FROM" => $EX_DT_FROM, "EX_DT_TO" => $EX_DT_TO));
        $exam = array(
            'SESSION_ID' => $SESSION_ID,
            'EX_TYPE_ID' => $EX_TYPE_ID,
            'EX_TITLE' => $EX_TITLE,
            'EX_DESC' => $EX_DESC,
            'EX_DT_FROM' => $EX_DT_FROM,
            'EX_DT_TO' => $EX_DT_TO,
            'ACTIVE_STATUS' => $status,
            'CREATED_BY' => $this->user["USER_ID"]
        );
        $this->utilities->updateData('exam', $exam, array('EXAM_ID' => $examId));
        $this->utilities->deleteRowByAttribute('exam_programs', array('EXAM_ID' => $examId));
        if (!empty($PROGRAM_ID)) {
            foreach ($PROGRAM_ID as $key => $value) {
                $exam_program_data = array(
                    'EXAM_ID' => $examId,
                    'PROGRAM_ID' => $value
                );

                $this->utilities->insert('exam_programs', $exam_program_data);
            }
        }
        echo "<div class='alert alert-success'>Exam Update successfully</div>";
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return return
     */
    function getBatchByProgram()
    {
        $PROGRAM_ID = $_POST['PROGRAM_ID'];
        $query = $this->utilities->findAllByAttribute('aca_batch', array("PROGRAM_ID" => $PROGRAM_ID, "ACTIVE_STATUS" => 1));
        $returnVal = '<option value = "">Select one</option>';
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value = "' . $row->BATCH_ID . '">' . $row->BATCH_TITLE . '</option>';
            }
        }
        echo $returnVal;
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return   return
     */
    function examList()
    {
        $data["previlages"] = $this->checkPrevilege("Coe/exam");
        $data['exam'] = $this->db->query("SELECT x.* , (SELECT f.FACULTY_NAME FROM faculty f WHERE f.FACULTY_ID = x.FACULTY_ID)FACULTY_NAME,
                                        (SELECT d.DEPT_NAME FROM department d WHERE d.DEPT_ID = x.DEPT_ID)DEPT_NAME,
                                        (SELECT p.PROGRAM_NAME FROM program p WHERE p.PROGRAM_ID = x.PROGRAM_ID)PROGRAM_NAME,
                                        (SELECT sm.SEMESTER_NAME FROM sav_semester sm WHERE sm.SEMESTER_ID = x.SEMESTER_ID)SEMESTER_NAME,
                                        ses.SESSION_NAME, ys.YEAR_SETUP_TITLE,(SELECT ab.BATCH_TITLE FROM aca_batch ab WHERE ab.PROGRAM_ID = x.PROGRAM_ID)BATCH_TITLE
                                        FROM exam x
                                        INNER JOIN session_year sy on sy.SES_YEAR_ID = x.SESSION_ID
                                        INNER JOIN session ses on ses.SESSION_ID = sy.SESSION
                                        INNER JOIN year_setup ys on ys.YEAR_SETUP_ID = sy.YEAR_SETUP_ID
                                        ")->result();
        $this->load->view("admin/coe/exam/exam_list", $data);
    }
    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function gradePolicy()
    {
        $data['contentTitle'] = 'Grade Policy';
        $data['breadcrumbs'] = array(
            'Exam' => '#',
            'Grade Policy List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['grade_policy'] = $this->utilities->getAll('exam_grade_policy');
        $data['content_view_page'] = 'admin/coe/grade_policy/index';
        $this->admin_template->display($data);
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function gradePolicyForm()
    {
        $data["ac_type"] = 1; // Insert Form
        $this->load->view('admin/coe/grade_policy/add_grade_policy', $data);
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return
     */
    function createGradePolicy()
    {
        $GR_POLICY_NAME = $this->input->post("policyName");
        $GR_POLICY_DESC = $this->input->post("description");
        $startDate = $this->input->post("START_DATE");
        $endDate = $this->input->post("END_DATE");
        $status = ((isset($_POST['status'])) ? 1 : 0);

        $date1 = explode("/", $startDate);
        $START_DATE = $date1[2] . '-' . $date1[1] . '-' . $date1[0];
        $date2 = explode("/", $endDate);
        $END_DATE = $date2[2] . '-' . $date2[1] . '-' . $date2[0];

        $check = $this->utilities->hasInformationByThisId("exam_grade_policy", array("GR_POLICY_NAME" => $GR_POLICY_NAME, "START_DATE" => $START_DATE, "END_DATE" => $END_DATE));
        if (empty($check)) {// if Grade Policy available
            $gradePolicy = array(
                'GR_POLICY_NAME' => $GR_POLICY_NAME,
                'GR_POLICY_DESC' => $GR_POLICY_DESC,
                'START_DATE' => $START_DATE,
                'END_DATE' => $END_DATE,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->insert('exam_grade_policy', $gradePolicy)) { // if data inserted successfully
                echo "<div class='alert alert-success'>Grade Policy Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Grade Policy insert failed</div>";
            }
        } else {// if session name not available
            echo "<div class='alert alert-danger'>Grade Policy Already Exist</div>";
        }

    }

    /**
     * @access
     * @param  GR POLICY ID
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return
     */
    function gradePolicyById()
    {
        $GR_POLICY_ID = $this->input->post('param'); // GR POLICY ID
        $data["previlages"] = $this->checkPrevilege("Coe/gradePolicy");
        $data['grade_policy'] = $this->utilities->findAllByAttribute("exam_grade_policy", array("GR_POLICY_ID" => $GR_POLICY_ID));
        $this->load->view('admin/coe/grade_policy/single_row_grade_policy', $data);
    }

    /**
     * @access
     * @param   Grade Policy ID
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function gradePolicyFormUpdate()
    {
        $data["ac_type"] = 2; // Update Form
        $GR_POLICY_ID = $this->input->post('param'); // Grade Policy ID
        $data['gradePolicy'] = $this->utilities->findByAttribute("exam_grade_policy", array("GR_POLICY_ID" => $GR_POLICY_ID));
        $this->load->view('admin/coe/grade_policy/add_grade_policy', $data);
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function updateGradePolicy()
    {
        $GR_POLICY_ID = $this->input->post('gradePolicyId'); // GR Policy id
        $GR_POLICY_NAME = $this->input->post("policyName");
        $GR_POLICY_DESC = $this->input->post("description");
        $startDate = $this->input->post("START_DATE");
        $endDate = $this->input->post("END_DATE");
        $status = ((isset($_POST['status'])) ? 1 : 0);

        $date1 = explode("/", $startDate);
        $START_DATE = $date1[2] . '-' . $date1[1] . '-' . $date1[0];
        $date2 = explode("/", $endDate);
        $END_DATE = $date2[2] . '-' . $date2[1] . '-' . $date2[0];
        $check = $this->utilities->hasInformationByThisId("exam_grade_policy", array("GR_POLICY_NAME" => $GR_POLICY_NAME, "START_DATE" => $START_DATE, "END_DATE" => $END_DATE, "GR_POLICY_ID" != $GR_POLICY_ID));
        if (empty($check)) {// if Grade Policy available
            $gradePolicy = array(
                'GR_POLICY_NAME' => $GR_POLICY_NAME,
                'GR_POLICY_DESC' => $GR_POLICY_DESC,
                'START_DATE' => $START_DATE,
                'END_DATE' => $END_DATE,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->updateData('exam_grade_policy', $gradePolicy, array('GR_POLICY_ID' => $GR_POLICY_ID))) { // if data update successfully
                echo "<div class='alert alert-success'>Grade Policy Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Grade Policy Update failed</div>";
            }
        } else {// if session name not available
            echo "<div class='alert alert-danger'>Grade Policy Already Exist</div>";
        }
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function gradePolicyList()
    {
        $data["previlages"] = $this->checkPrevilege("Coe/gradePolicy");
        $data['grade_policy'] = $this->utilities->getAll('exam_grade_policy');
        $this->load->view("admin/coe/grade_policy/grade_policy_list", $data);
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function grade()
    {
        $data['contentTitle'] = 'Grade';
        $data['breadcrumbs'] = array(
            'Exam' => '#',
            'Grade List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['grade'] = $this->db->query("SELECT eg.*, d.DEGREE_NAME, gp.GR_POLICY_NAME
                                            FROM exam_grade eg
                                            INNER JOIN degree d on d.DEGREE_ID = eg.DEGREE_ID
                                            INNER JOIN exam_grade_policy gp on  gp.GR_POLICY_ID = eg.GR_POLICY_ID")->result(); // select all data from  exam_grade
        $data['content_view_page'] = 'admin/coe/grade/index';
        $this->admin_template->display($data);
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return return
     */
    function gradeForm()
    {
        $data["ac_type"] = 1; /*Insert Form*/
        $data['degree'] = $this->utilities->findAllByAttribute('degree', array("ACTIVE_STATUS" => 1));
        $data['grade_policy'] = $this->utilities->findAllByAttribute('exam_grade_policy', array("ACTIVE_STATUS" => 1));
        $this->load->view('admin/coe/grade/add_grade', $data);
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function createGrade()
    {
        $DEGREE_ID = $this->input->post('DEGREE_ID'); // Degree id
        $GR_POLICY_ID = $this->input->post('GR_POLICY_ID'); // GR Policy id
        $GR_LETTER = $this->input->post("GR_LETTER");
        $GR_MARKS_FROM = $this->input->post("GR_MARKS_FROM");
        $GR_MARKS_TO = $this->input->post("GR_MARKS_TO");
        $GRADE_POINT = $this->input->post("GRADE_POINT");
        $status = ((isset($_POST['status'])) ? 1 : 0);
        // checking if exam_grade is already exist
        $check = $this->utilities->hasInformationByThisId("exam_grade", array('DEGREE_ID' => $DEGREE_ID, 'GR_POLICY_ID' => $GR_POLICY_ID, 'GR_LETTER' => $GR_LETTER, 'GR_MARKS_FROM' => $GR_MARKS_FROM, 'GR_MARKS_TO' => $GR_MARKS_TO, 'GRADE_POINT' => $GRADE_POINT));
        if (empty($check)) {// if Program name available
            // preparing data to insert
            $examGrade = array(
                'DEGREE_ID' => $DEGREE_ID,
                'GR_POLICY_ID' => $GR_POLICY_ID,
                'GR_LETTER' => $GR_LETTER,
                'GR_MARKS_FROM' => $GR_MARKS_FROM,
                'GR_MARKS_TO' => $GR_MARKS_TO,
                'GRADE_POINT' => $GRADE_POINT,
                'ACTIVE_STATUS' => $status
            );
            if ($this->utilities->insertData($examGrade, 'exam_grade')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Exam Grade Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Exam Grade insert failed</div>";
            }
        } else {// if batch name not available
            echo "<div class='alert alert-danger'>Exam Grade Already Exist</div>";
        }
    }

    /**
     * @access
     * @param  GR Id
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function gradeById()
    {
        $GR_ID = $this->input->post('param'); // GR Id
        $data["previlages"] = $this->checkPrevilege("Coe/grade");
        $data['grade'] = $this->db->query("SELECT eg.*, d.DEGREE_NAME, gp.GR_POLICY_NAME
                                            FROM exam_grade eg
                                            INNER JOIN degree d on d.DEGREE_ID = eg.DEGREE_ID
                                            INNER JOIN exam_grade_policy gp on  gp.GR_POLICY_ID = eg.GR_POLICY_ID
                                            WHERE eg.GR_ID = $GR_ID")->result(); // select all data from  exam_grade
        $this->load->view('admin/coe/grade/single_row_grade', $data);
    }

    /**
     * @access
     * @param  GRADE ID
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return
     */
    function gradeFormUpdate()
    {
        $data["ac_type"] = 2; // Update Form
        $GR_ID = $this->input->post('param'); // GRADE ID
        $data['degree'] = $this->utilities->findAllByAttribute('degree', array("ACTIVE_STATUS" => 1));
        $data['grade_policy'] = $this->utilities->findAllByAttribute('exam_grade_policy', array("ACTIVE_STATUS" => 1));
        $data['grade'] = $this->utilities->findByAttributeWithJoin("exam_grade", "exam_grade_policy", "GR_POLICY_ID", "GR_POLICY_ID", "GR_POLICY_NAME", array("GR_ID" => $GR_ID));
        $this->load->view('admin/coe/grade/add_grade', $data);
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function updateGrade()
    {
        $GR_ID = $this->input->post('gradeId'); // GR Policy id
        $DEGREE_ID = $this->input->post('DEGREE_ID'); // GR Policy id
        $GR_POLICY_ID = $this->input->post('GR_POLICY_ID'); // GR Policy id
        $GR_LETTER = $this->input->post("GR_LETTER");
        $GR_MARKS_FROM = $this->input->post("GR_MARKS_FROM");
        $GR_MARKS_TO = $this->input->post("GR_MARKS_TO");
        $GRADE_POINT = $this->input->post("GRADE_POINT");
        $status = ((isset($_POST['status'])) ? 1 : 0);

        $check = $this->utilities->hasInformationByThisId("exam_grade", array('DEGREE_ID' => $DEGREE_ID, 'GR_POLICY_ID' => $GR_POLICY_ID, "GR_LETTER" => $GR_LETTER, 'GR_MARKS_FROM' => $GR_MARKS_FROM, 'GR_MARKS_TO' => $GR_MARKS_TO, 'GRADE_POINT' => $GRADE_POINT, "GR_ID" != $GR_ID));
        if (empty($check)) {// if Program name available
            // preparing data to insert
            $examGrade = array(
                'DEGREE_ID' => $DEGREE_ID,
                'GR_POLICY_ID' => $GR_POLICY_ID,
                'GR_LETTER' => $GR_LETTER,
                'GR_MARKS_FROM' => $GR_MARKS_FROM,
                'GR_MARKS_TO' => $GR_MARKS_TO,
                'GRADE_POINT' => $GRADE_POINT,
                'ACTIVE_STATUS' => $status
            );
            if ($this->utilities->updateData('exam_grade', $examGrade, array('GR_ID' => $GR_ID))) { // if data update successfully
                echo "<div class='alert alert-success'>Grade Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Grade Update failed</div>";
            }
        } else {// if session name not available
            echo "<div class='alert alert-danger'>Grade Already Exist</div>";
        }
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function gradeList()
    {
        $data["previlages"] = $this->checkPrevilege("Coe/grade");
        $data['grade'] = $this->db->query("SELECT eg.*, d.DEGREE_NAME, gp.GR_POLICY_NAME
                                            FROM exam_grade eg
                                            INNER JOIN degree d on d.DEGREE_ID = eg.DEGREE_ID
                                            INNER JOIN exam_grade_policy gp on  gp.GR_POLICY_ID = eg.GR_POLICY_ID")->result(); // select all data from  exam_grade

        $this->load->view("admin/coe/grade/grade_list", $data);
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function applicantList()
    {
        $date = date("Y-m-d");
        $data["ac_type"] = '';
        $data['faculty'] = $this->utilities->findAllByAttribute('faculty', array("ACTIVE_STATUS" => 1, "ADMINISTRATION" => 0));
        $data['dimention'] = "horizental";
        $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
        $data["session"] = $this->db->query("SELECT sy.SES_YEAR_ID, s.SESSION_NAME, ys.YEAR_SETUP_TITLE
                                            FROM session_year sy
                                            LEFT JOIN session s on s.SESSION_ID = sy.SESSION
                                            LEFT JOIN year_setup ys on ys.YEAR_SETUP_ID = sy.YEAR_SETUP_ID")->result();

        $data["appList"] = $this->db->query("SELECT e.EXAM_ID, ss.* ,(SELECT f.FACULTY_NAME FROM faculty f WHERE f.FACULTY_ID = ss.FACULTY_ID)FACULTY_NAME,
                                            (SELECT d.DEPT_NAME FROM department d WHERE d.DEPT_ID = ss.DEPT_ID)DEPT_NAME,
                                            (SELECT p.PROGRAM_NAME FROM program p WHERE p.PROGRAM_ID = ss.PROGRAM_ID)PROGRAM_NAME,
                                            (SELECT sm.SEMESTER_NAME FROM sav_semester sm WHERE sm.SEMESTER_ID = ss.SEMESTER_ID)SEMESTER_NAME,
                                            ses.SESSION_NAME, ys.YEAR_SETUP_TITLE
                                            FROM stu_semesterinfo ss
                                            INNER JOIN session_year sy on sy.SES_YEAR_ID = ss.SESSION_ID
                                            INNER JOIN session ses on ses.SESSION_ID = sy.SESSION
                                            INNER JOIN year_setup ys on ys.YEAR_SETUP_ID = sy.YEAR_SETUP_ID
                                            INNER JOIN exam e on (ss.FACULTY_ID = e.FACULTY_ID AND ss.DEPT_ID = e.DEPT_ID AND ss.PROGRAM_ID = e.PROGRAM_ID AND ss.SEMESTER_ID = e.SEMESTER_ID AND ss.SESSION_ID = e.SESSION_ID)
                                            WHERE e.EX_DT_FROM <= '$date' AND e.EX_DT_TO >= '$date' AND (ss.STUDENT_ID) NOT IN(SELECT ex.STUDENT_ID FROM exam_application ex WHERE ex.STUDENT_ID = ss.STUDENT_ID)")->result();
        $data['content_view_page'] = 'admin/coe/applicant_list';
        $this->admin_template->display($data);
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function approveApplication()
    {
        $studentId = $this->input->post('studentId');
        $insert = 0;
        for ($i = 0; $i < sizeof($studentId); $i++) {
            $examId = $this->input->post("examId_$studentId[$i]");
            $faculty = $this->input->post("facultyId_$studentId[$i]");
            $department = $this->input->post("deptId_$studentId[$i]");
            $program = $this->input->post("programId_$studentId[$i]");
            $session = $this->input->post("sessionId_$studentId[$i]");
            $semester = $this->input->post("semesterId_$studentId[$i]");
            $batchId = $this->input->post("batchId_$studentId[$i]");
            $check = $this->utilities->hasInformationByThisId("exam_application", array(
                'EXAM_ID' => $examId,
                'STUDENT_ID' => $studentId[$i],
                'SESSION_ID' => $session,
                'SEMESTER_ID' => $semester,
                'BATCH_ID' => $batchId,
                'FACULTY_ID' => $faculty,
                'DEPT_ID' => $department,
                'PROGRAM_ID' => $program
            ));
            if ($check == FALSE) {// if approve application available

                $courseF = $this->db->query("SELECT sc.COURSE_ID
                                            FROM aca_semester_course sc
                                            WHERE sc.FACULTY_ID = $faculty AND sc.DEPT_ID = $department
                                            AND sc.PROGRAM_ID = $program AND sc.SEMESTER_ID = $semester")->result();
                foreach ($courseF as $key => $row):
                    $examApp = array(
                        'EXAM_ID' => $examId,
                        'STUDENT_ID' => $studentId[$i],
                        'SESSION_ID' => $session,
                        'SEMESTER_ID' => $semester,
                        'BATCH_ID' => $batchId,
                        'FACULTY_ID' => $faculty,
                        'DEPT_ID' => $department,
                        'PROGRAM_ID' => $program,
                        'COURSE_ID' => $row->COURSE_ID,
                        'ACTIVE_STATUS' => 1
                    );
                    $insert = $this->utilities->insertData($examApp, 'exam_application');
                endforeach;
            }
        }
        if ($insert) { // if data insert successfully
            echo "&nbsp;&nbsp;<span class='btn btn-outline btn-success btn-sm'>Approved successfully &nbsp;<span class='text-primary'> <i class='fa fa-check'></i></span></span>";
        } else { // if data insert failed
            echo "&nbsp;&nbsp;<span class='btn btn-outline btn-danger btn-sm'>Aready Existed !!&nbsp;<span class='text-primary'> <i class='fa fa-check'></i></span></span>";
        }
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function searchApplicant()
    {
        $date = date("Y-m-d");
        $FACULTY_ID = $this->input->post("FACULTY_ID");
        $DEPT_ID = $this->input->post("DEPT_ID");
        $PROGRAM_ID = $this->input->post("PROGRAM_ID");
        $SEMESTER_ID = $this->input->post("SEMESTER_ID");
        $SESSION_ID = $this->input->post("SESSION_ID");
        $data["appList"] = $this->db->query("SELECT e.EXAM_ID, ss.* ,(SELECT f.FACULTY_NAME FROM faculty f WHERE f.FACULTY_ID = ss.FACULTY_ID)FACULTY_NAME,
                                            (SELECT d.DEPT_NAME FROM department d WHERE d.DEPT_ID = ss.DEPT_ID)DEPT_NAME,
                                            (SELECT p.PROGRAM_NAME FROM program p WHERE p.PROGRAM_ID = ss.PROGRAM_ID)PROGRAM_NAME,
                                            (SELECT sm.SEMESTER_NAME FROM sav_semester sm WHERE sm.SEMESTER_ID = ss.SEMESTER_ID)SEMESTER_NAME,
                                            ses.SESSION_NAME, ys.YEAR_SETUP_TITLE
                                            FROM stu_semesterinfo ss
                                            INNER JOIN session_year sy on sy.SES_YEAR_ID = ss.SESSION_ID
                                            INNER JOIN session ses on ses.SESSION_ID = sy.SESSION
                                            INNER JOIN year_setup ys on ys.YEAR_SETUP_ID = sy.YEAR_SETUP_ID
                                            INNER JOIN exam e on (ss.FACULTY_ID = e.FACULTY_ID AND ss.DEPT_ID = e.DEPT_ID AND ss.PROGRAM_ID = e.PROGRAM_ID AND ss.SEMESTER_ID = e.SEMESTER_ID AND ss.SESSION_ID = e.SESSION_ID)
                                            WHERE e.EX_DT_FROM <= '$date' AND e.EX_DT_TO >= '$date' AND ss.FACULTY_ID = $FACULTY_ID AND ss.DEPT_ID = $DEPT_ID AND ss.PROGRAM_ID = $PROGRAM_ID AND ss.SESSION_ID = $SESSION_ID AND ss.SEMESTER_ID = $SEMESTER_ID")->result();
        $this->load->view("admin/coe/applicant_list_view", $data);
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function studentMarks()
    {
        $data['contentTitle'] = 'Students Marks';
        $data['breadcrumbs'] = array(
            'Exam' => '#',
            'Students Marks List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['marks'] = $this->db->query("SELECT sm.* , ac.COURSE_CODE, ac.COURSE_TITLE,(SELECT smm.SEMESTER_NAME FROM sav_semester smm WHERE smm.SEMESTER_ID = sm.SEMESTER_ID)SEMESTER_NAME, ses.SESSION_NAME, ys.YEAR_SETUP_TITLE
                                            FROM exam_student_marks sm
                                            INNER JOIN aca_course ac on ac.COURSE_ID = sm.COURSE_ID
                                            INNER JOIN session_year sy on sy.SES_YEAR_ID = sm.SESSION_ID
                                            INNER JOIN session ses on ses.SESSION_ID = sy.SESSION
                                            INNER JOIN year_setup ys on ys.YEAR_SETUP_ID = sy.YEAR_SETUP_ID")->result();
        $data['content_view_page'] = 'admin/coe/student_marks/index';
        $this->admin_template->display($data);
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function marksForm()
    {
        $data["ac_type"] = 1; /* Insertion form */
        $data["dimention"] = "vertical"; /*for common faculty_dept_program*/
        $data["faculty"] = $this->utilities->getAll("faculty"); // select all faculty name from  faculty
        $data["semester"] = $this->utilities->getAll("sav_semester"); // select all Semester name from  m00_lkpdata
        $data["session"] = $this->db->query("SELECT sy.SES_YEAR_ID, s.SESSION_NAME, ys.YEAR_SETUP_TITLE
                                            FROM session_year sy
                                            LEFT JOIN session s on s.SESSION_ID = sy.SESSION
                                            LEFT JOIN year_setup ys on ys.YEAR_SETUP_ID = sy.YEAR_SETUP_ID
                                            ")->result();
        $this->load->view('admin/coe/student_marks/add_marks', $data);

    }

    /**
     * @access
     * @param  faculty , department, program,session, semester, semester id
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function showCourseList()
    {
        $faculty = $this->input->post("FACULTY_ID");
        $department = $this->input->post("DEPT_ID");
        $program = $this->input->post("PROGRAM_ID");
        $session = $this->input->post("SESSION_ID");
        $semester = $this->input->post("SEMESTER_ID");
        $student = $this->input->post("STUDENT_ID");
        $data["courseList"] = $this->db->query("SELECT DISTINCT sc.COURSE_ID, ac.COURSE_CODE, ac.COURSE_TITLE
                                    FROM stu_courseinfo sc
                                    INNER JOIN aca_course ac on ac.COURSE_ID = sc.COURSE_ID
                                    WHERE sc.FACULTY_ID = $faculty AND sc.DEPT_ID = $department AND sc.PROGRAM_ID = $program AND sc.SESSION_ID = $session AND sc.SEMISTER_ID = $semester AND sc.IS_CURRENT =1 AND sc.STUDENT_ID = $student")->result();
        $this->load->view("admin/coe/student_marks/course_list", $data);
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function searchSemesterStudent()
    {
        $faculty = $this->input->post("FACULTY_ID");
        $department = $this->input->post("DEPT_ID");
        $program = $this->input->post("PROGRAM_ID");
        $session = $this->input->post("SESSION_ID");
        $semester = $this->input->post("SEMESTER_ID");
        $query = $this->db->query("SELECT DISTINCT sc.STUDENT_ID
                            FROM stu_courseinfo sc
                            WHERE sc.FACULTY_ID = $faculty AND sc.DEPT_ID = $department AND sc.PROGRAM_ID = $program AND sc.SESSION_ID = $session AND sc.SEMISTER_ID = $semester AND sc.IS_CURRENT =1")->result();
        $returnVal = '<option value = "">Select one</option>';
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value = "' . $row->STUDENT_ID . '">' . $row->STUDENT_ID . '</option>';
            }
        }
        echo $returnVal;
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function marksList()
    {
        $data["previlages"] = $this->checkPrevilege("Coe/studentMarks");
        $data['marks'] = $this->db->query("SELECT sm.* , ac.COURSE_CODE, ac.COURSE_TITLE,(SELECT smm.SEMESTER_NAME FROM sav_semester smm WHERE smm.SEMESTER_ID = sm.SEMESTER_ID)SEMESTER_NAME, ses.SESSION_NAME, ys.YEAR_SETUP_TITLE
                                            FROM exam_student_marks sm
                                            INNER JOIN aca_course ac on ac.COURSE_ID = sm.COURSE_ID
                                            INNER JOIN session_year sy on sy.SES_YEAR_ID = sm.SESSION_ID
                                            INNER JOIN session ses on ses.SESSION_ID = sy.SESSION
                                            INNER JOIN year_setup ys on ys.YEAR_SETUP_ID = sy.YEAR_SETUP_ID")->result();
        $this->load->view("admin/coe/student_marks/marks_list", $data);
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function studentMarksFormUpdate()
    {
        $data["ac_type"] = "edit"; // Update Form
        $EX_MARKS_ID = $this->input->post('param'); // Exam ID
        $data["dimention"] = "vertical"; /*for common faculty_dept_program*/
        $data["faculty"] = $this->utilities->getAll("faculty"); // select all faculty name from  faculty
        $data["department"] = $this->utilities->getAll("department"); // select all department name from  department
        $data["program"] = $this->utilities->getAll("program"); // select all program name from  program
        $data["semester"] = $this->utilities->getAll("sav_semester"); // select all Semester name from  m00_lkpdata
        $data["session"] = $this->db->query("SELECT sy.SES_YEAR_ID, s.SESSION_NAME, ys.YEAR_SETUP_TITLE
                                            FROM session_year sy
                                            INNER JOIN session s on s.SESSION_ID = sy.SESSION
                                            INNER JOIN year_setup ys on ys.YEAR_SETUP_ID = sy.YEAR_SETUP_ID
                                            ")->result();
        $data['previous_info'] = $this->utilities->findByAttribute("exam_student_marks", array("EX_MARKS_ID" => $EX_MARKS_ID));
        $data['student'] = $this->db->query("SELECT sm.*, ac.COURSE_CODE, ac.COURSE_TITLE
                                            FROM exam_student_marks sm
                                            INNER JOIN aca_course ac on ac.COURSE_ID = sm.COURSE_ID
                                            WHERE sm.EX_MARKS_ID = $EX_MARKS_ID")->row();
        $this->load->view('admin/coe/student_marks/add_marks', $data);
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function createMarks()
    {
        $FACULTY_ID = $this->input->post("FACULTY_ID");
        $DEPT_ID = $this->input->post("DEPT_ID");
        $PROGRAM_ID = $this->input->post("PROGRAM_ID");
        $SESSION_ID = $this->input->post("SESSION_ID");
        $SEMESTER_ID = $this->input->post("SEMESTER_ID");
        $studentId = $this->input->post("STUDENT_ID");
        $courseId = $this->input->post("courseId");
        $status = $this->input->post("status");
        for ($i = 0; $i < sizeof($courseId); $i++) {
            $marks[] = $this->input->post("marks$courseId[$i]");
            $studentMarks = array(
                'FACULTY_ID' => $FACULTY_ID,
                'DEPT_ID' => $DEPT_ID,
                'PROGRAM_ID' => $PROGRAM_ID,
                'SESSION_ID' => $SESSION_ID,
                'SEMESTER_ID' => $SEMESTER_ID,
                'COURSE_ID' => $courseId[$i],
                'STUDENT_ID' => $studentId,
                'MARKS' => $this->input->post("marks$courseId[$i]"),
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            $insert = $this->utilities->insert('exam_student_marks', $studentMarks);
        }
        if ($insert) { // if data inserted successfully
            echo "<div class='alert alert-success'>Marks Create successfully</div>";
        } else { // if data inserted failed
            echo "<div class='alert alert-danger'>Marks insert failed</div>";
        }
    }

    /**
     * @access
     * @param  EX_MARKS_ID
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function studentMarksById()
    {
        $EX_MARKS_ID = $this->input->post('param'); // Exam marks Id
        $data["previlages"] = $this->checkPrevilege("Coe/studentMarks");
        $data['marks'] = $this->db->query("SELECT sm.* , ac.COURSE_CODE, ac.COURSE_TITLE,(SELECT smm.SEMESTER_NAME FROM sav_semester smm WHERE smm.SEMESTER_ID = sm.SEMESTER_ID)SEMESTER_NAME, ses.SESSION_NAME, ys.YEAR_SETUP_TITLE
                                            FROM exam_student_marks sm
                                            INNER JOIN aca_course ac on ac.COURSE_ID = sm.COURSE_ID
                                            INNER JOIN session_year sy on sy.SES_YEAR_ID = sm.SESSION_ID
                                            INNER JOIN session ses on ses.SESSION_ID = sy.SESSION
                                            INNER JOIN year_setup ys on ys.YEAR_SETUP_ID = sy.YEAR_SETUP_ID
                                            WHERE sm.EX_MARKS_ID = $EX_MARKS_ID")->result();
        $this->load->view('admin/coe/student_marks/single_row_marks', $data);
    }

    function updateMarks()
    {
        $EX_MARKS_ID = $this->input->post('EX_MARKS_ID'); // EX_MARKS_ID
        $EX_MARKS = $this->input->post('marks');
        $status = ((isset($_POST['status'])) ? 1 : 0);
        $exam = array(
            'MARKS' => $EX_MARKS,
            'ACTIVE_STATUS' => $status,
            'CREATED_BY' => $this->user["USER_ID"]
        );
        if ($this->utilities->updateData('exam_student_marks', $exam, array('EX_MARKS_ID' => $EX_MARKS_ID))) { // if data update successfully
            echo "<div class='alert alert-success'>Marks Update successfully</div>";
        } else { // if data update failed
            echo "<div class='alert alert-danger'>Marks Update failed</div>";
        }
    }

    function testCache()
    {
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        if (!$cache_data = $this->cache->get('cache_key')) {
            //here goes your codes...
            $some_object = (object)NULL;
            $some_object->test_property = "test date";

            // Save into the cache for 2 minutes
            $this->cache->save('cache_key', $some_object, 120);
            $cache_data = $some_object;
        }
        $this->cache->get('cache_key');
    }

    function importBankDepNo()
    {
        $data['contentTitle'] = 'Bank Deposit No';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Bank Deposit no " => '#'
        );
        $data['pageTitle'] = 'Bank Deposit No';
        $data["exam"] = $this->utilities->findAllFromView('exam');
        $data["branch"] = $this->utilities->findAllFromView('bank_branch');
        $data["session"] = $this->utilities->findAllFromView('session_view');
        $data['content_view_page'] = 'admin/coe/bank_deposit_no';
        $this->admin_template->display($data);
    }

    function saveDep()
    {
        $this->load->library('csvimport');
        $data['error'] = '';    //initialize image upload error array to empty
        $config['upload_path'] = 'upload/bank_deposit_no/';
        $config['allowed_types'] = 'csv|xls|xlsx';
        $config['max_size'] = '1000';
        $this->load->library('upload', $config);
        // If upload failed, display error
        if (!$this->upload->do_upload()) {
            $data['error'] = $this->upload->display_errors();
        } else {
            $file_data = $this->upload->data();
            $file_path = 'upload/bank_deposit_no/' . $file_data['file_name'];
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                    if (!empty($row['DEPOSITE_NO'])) {
                        $bank_deposit_no = array(
                            'DEPOSITE_NO' => $row['DEPOSITE_NO'],
                            'EXAM_ID' => $this->input->post('EXAM_ID'),
                            'BANK_BRANCH_ID' => $this->input->post('BANK_BRANCH_ID'),
                            'SESSION_ID' => $this->input->post('SESSION_ID'),
                            'DEPOSITE_DATE' => date('Y-m-d',strtotime($this->input->post('DEPOSITE_DATE'))),

                        );
                        // print_r($bank_deposit_no);
                        $this->utilities->insertData($bank_deposit_no, 'exam_bank_deposit');
                    }


                }

                $this->session->set_flashdata('Success', 'Student Information Inserted Successfully.');
                redirect("coe/importBankDepNo");
            } else {
                $data['error'] = "Error occured";
            }
        }
    }

    function deposit_list_by_exam_id()
    {
        $EXAM_ID = $this->input->post('EXAM_ID');
        $deposit_no = $this->db->query("select * from exam_bank_deposit where EXAM_ID=$EXAM_ID")->result();
        $dp_n = '';
        foreach ($deposit_no as $row) {
            $dp_n .= '<tr><td>' . $row->DEPOSITE_NO . '</td></tr>';
        }
        echo $dp_n;
    }

    function examSchedule()
    {
        $data["ac_type"] = 1;
        $data['contentTitle'] = 'Exam Schedule';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Exam Schedule" => '#'
        );
        $data['pageTitle'] = 'Exam Schedule';
        $data["exam"] = $this->db->query("SELECT x.*, ses.SESSION_NAME FROM exam x LEFT JOIN session_view ses ON ses.SESSION_ID = x.SESSION_ID")->result();
        $data['room'] = $this->db->query("select * from sc_building_room")->result();
        $data["dimention"] = "vertical";
        $data["faculty"] = $this->utilities->getAll("faculty");
        $data["session"] = $this->utilities->getAll("session_view");
        $data['content_view_page'] = 'admin/coe/add_exam_schedule';
        $this->admin_template->display($data);
    }

    function save_exam_schedule()
    {
        $EXAM_ID = $this->input->post("EXAM_ID");
        $BR_ID = $this->input->post("BR_ID");
        $ROLL_NO_FROM = $this->input->post("ROLL_NO_FROM");
        $ROLL_NO_TO = $this->input->post("ROLL_NO_TO");
        $START_TIME = $this->input->post("START_TIME");
        $END_TIME = $this->input->post("END_TIME");
        $START_DATE = date('Y-m-d', strtotime($this->input->post("START_DATE")));
        $FACULTY_ID = $this->input->post("FACULTY_ID");
        $DEPT_ID = $this->input->post("DEPT_ID");
        $PROGRAM_ID = $this->input->post("PROGRAM_ID");
        //$SESSION_ID = $this->input->post("SESSION_ID");
        $COURSE_ID = $this->input->post("COURSE_ID");
        // $check = $this->utilities->hasInformationByThisId("exam_schedule", array("EXAM_ID" => $EXAM_ID));
        $exam_schedule_data = array(
            'EXAM_ID' => $EXAM_ID,
            'BR_ID' => $BR_ID,
            'ROLL_NO_FROM' => $ROLL_NO_FROM,
            'ROLL_NO_TO' => $ROLL_NO_TO,
            'START_TIME' => $START_TIME,
            'END_TIME' => $END_TIME,
            'START_DT' => $START_DATE,
            'FACULTY_ID' => $FACULTY_ID,
            'DEPT_ID' => $DEPT_ID,
            'PROGRAM_ID' => $PROGRAM_ID,
            'COURSE_ID' => $COURSE_ID

        );

        if ($this->utilities->insertData($exam_schedule_data, 'exam_schedule')) {
            echo "Y";
        } else {
            echo "N";
        }

    }

    function course_by_program()
    {
        $program_id = $this->input->post("PROGRAM_ID");
        $course = $this->db->query("SELECT b.*
                                      FROM aca_course_offer a LEFT JOIN aca_course b ON a.COURSE_ID = b.COURSE_ID
                                     WHERE a.PROGRAM_ID =$program_id")->result();
        $dropdown = '<option></option>';
        foreach ($course as $row) {
            $dropdown .= '<option value="' . $row->COURSE_ID . '">' . $row->COURSE_TITLE . '</option>';
        }
        echo $dropdown;

    }

    function exam_schedule_by_room_id()
    {
        $BR_ID = $this->input->post("BR_ID");
        $START_DATE = date('Y-m-d', strtotime($this->input->post("START_DATE")));
        $data['schedule'] = $this->db->query("SELECT a.*, b.COURSE_TITLE
                                                   FROM exam_schedule a LEFT JOIN aca_course b ON a.COURSE_ID = b.COURSE_ID WHERE  a.BR_ID=$BR_ID and a.START_DT='$START_DATE'")->result();

        $this->load->view('admin/coe/exam_schedule_by_room', $data);
    }

    function examScheduleList()
    {

        $data['contentTitle'] = 'Exam Schedule List';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Exam Schedule list" => '#'
        );
        $data['pageTitle'] = 'Exam Schedule List';
        $data['exam_schedule_list'] = $this->db->query("select a.*,b.EX_TITLE,c.PROGRAM_NAME,d.COURSE_CODE,d.COURSE_TITLE,e.SESSION_NAME,f.BR_CODE,f.BR_NAME from exam_schedule a
                                                                left join exam b on a.EXAM_ID = b.EXAM_ID
                                                                left join program c on a.PROGRAM_ID = c.PROGRAM_ID
                                                                left join aca_course d on a.COURSE_ID = d.COURSE_ID
                                                                left join session_view e on a.SESSION_ID=e.SESSION_ID
                                                                left join sc_building_room f on a.BR_ID = f.BR_ID")->result();
        $data['content_view_page'] = 'admin/coe/exam_schedule_list';
        $this->admin_template->display($data);
    }

    function examScheduleEdit($id)
    {
        $data['contentTitle'] = 'Exam Schedule';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Exam Schedule" => '#'
        );
        $data["ac_type"] = "edit";
        $data['pageTitle'] = 'Exam Schedule';
        $data["dimention"] = "vertical";
        $data['previous_info'] = $this->db->query("select * from exam_schedule WHERE EX_SC_ID=$id")->row();

        $program_id = $data['previous_info']->PROGRAM_ID;
        $BR_ID = $data['previous_info']->BR_ID;
        $START_DT = date('Y-m-d', strtotime($data['previous_info']->START_DT));
        $data["exam"] = $this->db->query("SELECT x.*, ses.SESSION_NAME FROM exam x LEFT JOIN session_view ses ON ses.SESSION_ID = x.SESSION_ID")->result();
        $data['room'] = $this->db->query("select * from sc_building_room")->result();

        $data["faculty"] = $this->utilities->getAll("faculty");
        $data["department"] = $this->utilities->getAll("department");
        $data["program"] = $this->utilities->getAll("program");
        $data["session"] = $this->utilities->getAll("session_view");
        $data['course'] = $this->db->query("SELECT b.*
                                      FROM aca_course_offer a LEFT JOIN aca_course b ON a.COURSE_ID = b.COURSE_ID
                                     WHERE a.PROGRAM_ID = $program_id")->result();
        $data['schedule'] = $this->db->query("SELECT a.*, b.COURSE_TITLE
                                                   FROM exam_schedule a LEFT JOIN aca_course b ON a.COURSE_ID = b.COURSE_ID WHERE  a.BR_ID=$BR_ID and a.START_DT='$START_DT'")->result();


        $data['content_view_page'] = 'admin/coe/edit_exam_schedule';
        $this->admin_template->display($data);
    }

    function updateExamSchedule()
    {
        $EX_SC_ID = $this->input->post("EX_SC_ID");
        $EXAM_ID = $this->input->post("EXAM_ID");
        $BR_ID = $this->input->post("BR_ID");
        $ROLL_NO_FROM = $this->input->post("ROLL_NO_FROM");
        $ROLL_NO_TO = $this->input->post("ROLL_NO_TO");
        $START_TIME = $this->input->post("START_TIME");
        $END_TIME = $this->input->post("END_TIME");
        $START_DATE = date('Y-m-d', strtotime($this->input->post("START_DATE")));
        $FACULTY_ID = $this->input->post("FACULTY_ID");
        $DEPT_ID = $this->input->post("DEPT_ID");
        $PROGRAM_ID = $this->input->post("PROGRAM_ID");
        $SESSION_ID = $this->input->post("SESSION_ID");
        $COURSE_ID = $this->input->post("COURSE_ID");
        // $check = $this->utilities->hasInformationByThisId("exam_schedule", array("EXAM_ID" => $EXAM_ID));
        $exam_schedule_data = array(
            'EXAM_ID' => $EXAM_ID,
            'BR_ID' => $BR_ID,
            'ROLL_NO_FROM' => $ROLL_NO_FROM,
            'ROLL_NO_TO' => $ROLL_NO_TO,
            'START_TIME' => $START_TIME,
            'END_TIME' => $END_TIME,
            'START_DT' => $START_DATE,
            'FACULTY_ID' => $FACULTY_ID,
            'DEPT_ID' => $DEPT_ID,
            'PROGRAM_ID' => $PROGRAM_ID,
            'SESSION_ID' => $SESSION_ID,
            'COURSE_ID' => $COURSE_ID

        );

        if ($this->utilities->updateData('exam_schedule', $exam_schedule_data, array('EX_SC_ID' => $EX_SC_ID))) {
            echo "Y";
        } else {
            echo "N";
        }
    }

    function examMarkingPolicy()
    {
        $data['contentTitle'] = 'Exam Mark Policy';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Exam Mark Policy" => '#'
        );
        $data['exam_marks_policy'] = $this->db->query("SELECT a.*, b.PROGRAM_NAME, c.LKP_NAME
                                                          FROM exam_marking_policy a
                                                               LEFT JOIN program b ON a.PROGRAM_ID = b.PROGRAM_ID
                                                               LEFT JOIN m00_lkpdata c ON a.MARKING_TYPE = c.LKP_ID")->result();
        $data['content_view_page'] = 'admin/coe/exam_mark_policy';
        $this->admin_template->display($data);
    }

    function addMarkingPolicy()
    {
        $data['contentTitle'] = 'Exam Mark Policy';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Exam Mark Policy" => '#'
        );
        $data["ac_type"] = 1;
        $data["dimention"] = "vertical";
        $data['exam_marks_policy'] = $this->db->query("SELECT a.*, b.PROGRAM_NAME, c.LKP_NAME
                                                          FROM exam_marking_policy a
                                                               LEFT JOIN program b ON a.PROGRAM_ID = b.PROGRAM_ID
                                                               LEFT JOIN m00_lkpdata c ON a.MARKING_TYPE = c.LKP_ID")->result();
        $data["faculty"] = $this->utilities->getAll("faculty");
        $data['content_view_page'] = 'admin/coe/add_exam_mark_policy';
        $this->admin_template->display($data);
    }

    function  distributeMarksPolicy()
    {
        $id = $_POST['PROGRAM_ID'];
        //$data=$this->db->query("select * from exam_marking_policy where PROGRAM_ID=$id ")->result();
        $data["marks_type"] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 69));
        $data['previous_marks_by_program'] = $this->db->query("SELECT a.*
                                                      FROM exam_marking_policy a
                                                     WHERE a.PROGRAM_ID =$id ")->result();
        $this->load->view('admin/coe/dis_mark_by_program_id', $data);
    }

    function saveDistributeMarks()
    {
        $MARKS_TYPE_ID = $_POST['MARKS_TYPE_ID'];
        $M_POLICY_ID = $_POST['M_POLICY_ID'];
        $MARK_PERCENT = $this->input->post('marks_percentage');
        if (!empty($MARKS_TYPE_ID)) {
            foreach ($MARKS_TYPE_ID as $key => $value) {

                $data_marks_percentage = array(
                    'MARKING_TYPE' => $MARKS_TYPE_ID[$key],
                    'MARK_PERCENT' => $MARK_PERCENT[$key],
                    'FACULTY_ID' => $this->input->post('FACULTY_ID'),
                    'DEPT_ID' => $this->input->post('DEPT_ID'),
                    'FACULTY_ID' => $this->input->post('FACULTY_ID'),
                    'PROGRAM_ID' => $this->input->post('PROGRAM_ID')
                );
                if ($M_POLICY_ID[$key] == "") {
                    $this->utilities->insertData($data_marks_percentage, 'exam_marking_policy');
                } else {
                    $this->utilities->updateData('exam_marking_policy', $data_marks_percentage, array('M_POLICY_ID' => $M_POLICY_ID[$key]));
                }
            }
            echo "Y";
        }


    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function exRgPeriod()
    {
        $data['contentTitle'] = 'Grade';
        $data['breadcrumbs'] = array(
            'Exam' => '#',
            'Grade List' => '#',
        );
        $data['ex_reg_period'] = $this->db->query("select a.*,b.EX_TITLE from exam_reg_period a left join exam b on a.EXAM_ID = b.EXAM_ID")->result();
        $data['content_view_page'] = 'admin/coe/registration_period/index';
        $this->admin_template->display($data);
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return return
     */
    function exRgPeriodForm()
    {
        $data["ac_type"] = 1;
        $data['exam'] = $this->utilities->findAllByAttribute('exam', array("ACTIVE_STATUS" => 1));
        $this->load->view('admin/coe/registration_period/add_rg_period', $data);
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function createExRgPeriod()
    {
        $EXAM_ID = $this->input->post('EXAM_ID');
        $startDate= $this->input->post('ERP_DT_FROM');
        $endDate= $this->input->post('ERP_DT_TO');
        $status = ((isset($_POST['status'])) ? 1 : 0);

        $date1 = explode("/", $startDate);
        $ERP_DT_FROM= $date1[2] . '-' . $date1[1] . '-' . $date1[0];
        $date2 = explode("/", $endDate);
        $ERP_DT_TO = $date2[2] . '-' . $date2[1] . '-' . $date2[0];
        // checking if exam_grade is already exist
        $check = $this->utilities->hasInformationByThisId("exam_reg_period", array('EXAM_ID' => $EXAM_ID));
        if (empty($check)) {// if Program name available
            // preparing data to insert
            $examrgPeriod = array(
                'EXAM_ID' => $EXAM_ID,
                'ERP_DT_FROM' => $ERP_DT_FROM,
                'ERP_DT_TO' => $ERP_DT_TO,
                'ACTIVE_STATUS' => $status
            );
          // print_r($examrgPeriod);exit;
            if ($this->utilities->insertData($examrgPeriod, 'exam_reg_period')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Exam Registration Period Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Exam Registration Period insert failed</div>";
            }
        } else {// if batch name not available
            echo "<div class='alert alert-danger'>Exam Registration Period Already Exist</div>";
        }
    }

    /**
     * @access
     * @param  GR Id
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function exRgPeriodById()
    {
        $ERP_ID = $this->input->post('param'); // GR Id
        $data['ex_rg_period'] = $this->db->query("select a.*,b.EX_TITLE from exam_reg_period a left join exam b on a.EXAM_ID = b.EXAM_ID where a.ERP_ID=$ERP_ID")->result(); // select all data from  exam_grade
        $this->load->view('admin/coe/registration_period/single_row_rg_period', $data);
    }

    /**
     * @access
     * @param  GRADE ID
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return return
     */
    function exRgPeriodFormUpdate()
    {
        $data["ac_type"] = 'edit'; // Update Form
        $ERP_ID = $this->input->post('param');
        $data['exam'] = $this->utilities->findAllByAttribute('exam', array("ACTIVE_STATUS" => 1));
        $data['previous_info'] = $this->db->query("select a.*,b.EX_TITLE from exam_reg_period a left join exam b on a.EXAM_ID = b.EXAM_ID where a.ERP_ID=$ERP_ID")->row();

        $this->load->view('admin/coe/registration_period/add_rg_period', $data);
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function updateExRgPeriod()
    {
        $ERP_ID = $this->input->post('ERP_ID'); // GR Policy id
        $EXAM_ID = $this->input->post('EXAM_ID');
        $startDate= $this->input->post("ERP_DT_FROM");
        $endDate= $this->input->post("ERP_DT_TO");
        $status = ((isset($_POST['status'])) ? 1 : 0);

        $date1 = explode("/", $startDate);
        $ERP_DT_FROM= $date1[2] . '-' . $date1[1] . '-' . $date1[0];
        $date2 = explode("/", $endDate);
        $ERP_DT_TO = $date2[2] . '-' . $date2[1] . '-' . $date2[0];

        $check = $this->utilities->hasInformationByThisId("exam_reg_period", array("EXAM_ID"=>$EXAM_ID, "ERP_DT_FROM"=>$ERP_DT_FROM, "ERP_DT_TO"=>$ERP_DT_TO,"ERP_ID" != $ERP_ID));
        if (empty($check)) {// if Program name available
            $examrgPeriod = array(
                'EXAM_ID' => $EXAM_ID,
                'ERP_DT_FROM' => $ERP_DT_FROM,
                'ERP_DT_TO' => $ERP_DT_TO,
                'ACTIVE_STATUS' => $status
            );
            if ($this->utilities->updateData('exam_reg_period', $examrgPeriod, array('ERP_ID' => $ERP_ID))) { // if data update successfully
                echo "<div class='alert alert-success'>Exam Registration Period Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Exam Registration Period Update failed</div>";
            }
        } else {// if session name not available
            echo "<div class='alert alert-danger'>Exam Registration Period Already Exist</div>";
        }
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */

    function exRgPeriodList()
    {

        $data['ex_reg_period'] = $this->db->query("select a.*,b.EX_TITLE from exam_reg_period a left join exam b on a.EXAM_ID = b.EXAM_ID")->result(); // select all data from  exam_grade

        $this->load->view("admin/coe/registration_period/rg_period_list", $data);
    }
    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function  exAdmitCardWorkList(){
        $data['pageTitle'] = 'View All Grade';
        $data['breadcrumbs'] = array(
            'All Grade List' => '#',
        );
        $data['ex_reg_period'] = $this->utilities->findAllFormView('exam_application');

        $data['content_view_page'] = 'admin/coe/registration_period/index';
    }
    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */



}

/* End of file Coe.php */
/* Location: ./application/controllers/Coe.php */