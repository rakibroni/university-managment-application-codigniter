<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @category   FrontPortal
 * @package    Portal
 * @author     Emdadul <Emdadul@atilimited.net>
 * @copyright  2015 ATI Limited Development Group
 */
class Setup extends CI_Controller
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
     * @methodName degree()
     * @access
     * @param  none
     * @return Mixed Template
     */
    function degree()
    {
        $data['contentTitle'] = 'Degree';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Degree List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['degree'] = $this->utilities->findAllFromView('ins_degree'); // select all data from degree
        $data['content_view_page'] = 'admin/setup/degree/degree_index';
        $this->admin_template->display($data);
    }

    /*
     * @methodName addDegree()
     * @access
     * @param  none
     * @return Mixed Template
     */

    function degreeFormInsert()
    {
        $data["ac_type"] = 1;
        $this->load->view('admin/setup/degree/add_degree', $data);
    }

    /*
     * @methodName getDegree()
     * @access
     * @param  none
     * @return Mixed Template
     */

    function degreeList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/degree");
        $data['degree'] = $this->utilities->findAllFromView('ins_degree'); // select all data from degree
        $this->load->view("admin/setup/degree/degree_list", $data);
    }

    /*
     * @methodName createDegree()
     * @access
     * @param  none
     * @return status
     */

    function createDegree()
    {
        $degree = $this->input->post('degreeName'); // degree name
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Degree with this name is already exist
        $check = $this->utilities->hasInformationByThisId("ins_degree", array("DEGREE_NAME" => $degree));
        if (empty($check)) {// if Degree name available
            // preparing data to insert
            $degree = array(
                'DEGREE_NAME' => $degree,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->insertData($degree, 'ins_degree')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Degree Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Degree Name insert failed</div>";
            }
        } else {// if degree name not available
            echo "<div class='alert alert-danger'>Degree Name Already Exist</div>";
        }
    }

    /*
     * @methodName degreeFormUpdate()
     * @access
     * @param  none
     * @return status
     */

    function degreeFormUpdate()
    {
        $data["ac_type"] = 2;
        $id = $this->input->post('param'); // degree ID
        $data['degree'] = $this->utilities->findByAttribute('ins_degree', array('DEGREE_ID' => $id)); // select all data from degree where degree id
        $this->load->view('admin/setup/degree/add_degree', $data);
    }

    /*
     * @methodName updateDegree()
     * @access
     * @param  none
     * @return status
     */

    function updateDegree()
    {
//        echo "<pre>";
//        print_r($_POST);
//        exit;
        $degree_id = $this->input->post('txtDegreeId'); // degree name
        $degreeName = $this->input->post('degreeName'); // degree name
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Degree with this name is already exist
        $check = $this->utilities->hasInformationByThisId("ins_degree", array("DEGREE_NAME" => $degreeName, "DEGREE_ID !=" => $degree_id));

        if (empty($check)) {// if Degree name available
            // preparing data to insert
            $degree = array(
                'DEGREE_NAME' => $degreeName,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            //var_dump($degree); exit();
            if ($this->utilities->updateData('ins_degree', $degree, array('DEGREE_ID' => $degree_id))) { // if data update successfully
                echo "<div class='alert alert-success'>Degree Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Degree Name Update failed</div>";
            }
        } else {// if degree name not available
            echo "<div class='alert alert-danger'>Degree Name Already Exist</div>";
        }
    }

    /*
     * @methodName degreeById()
     * @access
     * @param  none
     * @return Mixed Template
     */

    function degreeById()
    {
        $degree_id = $this->input->post('param'); // degree name
        $data["previlages"] = $this->checkPrevilege("setup/degree");
        $data['row'] = $this->utilities->findByAttribute('ins_degree', array('DEGREE_ID' => $degree_id)); // select all data from degree where degree id
        $this->load->view('admin/setup/degree/single_degree_row', $data);
    }

    /*
     * @methodName faculty()
     * @access
     * @param  none
     * @return Mixed Template
     */

    function faculty()
    {
        $data['contentTitle'] = 'Faculty';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Faculty List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['faculty'] = $this->utilities->findAllFromView('ins_faculty'); // select all data from  faculty
        $data['content_view_page'] = 'admin/setup/faculty/faculty_index';
        $this->admin_template->display($data);
    }

    /*
     * @methodName facultyFormInsert()
     * @access
     * @param  none
     * @return Mixed Template
     */

    function facultyFormInsert()
    {
        $data["ac_type"] = 1;
        $this->load->view('admin/setup/faculty/add_faculty', $data);
    }

    /*
     * @methodName facultyList()
     * @access
     * @param  none
     * @return Mixed Template
     */

    function facultyList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/faculty");
        $data['faculty'] = $this->utilities->findAllFromView('ins_faculty'); // select all data from  faculty
        $this->load->view("admin/setup/faculty/faculty_list", $data);
    }

    /*
     * @methodName createFaculty()
     * @access
     * @param  none
     * @return status
     */

    function createFaculty()
    {
        $faculty = $this->input->post('facultyName'); // faculty name
        $UD_SLNO = $this->input->post('UD_SLNO'); // faculty name

        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Faculty with this name is already exist
        $check = $this->utilities->hasInformationByThisId("ins_faculty", array("FACULTY_NAME" => $faculty));
        if (empty($check)) {// if Faculty name available
            // preparing data to insert
            $faculty = array(
                'FACULTY_NAME' => $faculty,
                'ACTIVE_STATUS' => $status,
                'UD_SLNO' => $UD_SLNO,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->insertData($faculty, 'ins_faculty')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Faculty Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Faculty Name insert failed</div>";
            }
        } else {// if faculty name not available
            echo "<div class='alert alert-danger'>Faculty Name Already Exist</div>";
        }
    }

    /*
     * @methodName facultyFormUpdate()
     * @access
     * @param  none
     * @return status
     */

    function facultyFormUpdate()
    {
        $data["ac_type"] = 2;
        $id = $this->input->post('param'); // faculty ID
        $data['faculty'] = $this->utilities->findByAttribute('ins_faculty', array('FACULTY_ID' => $id)); // select all data from faculty where faculty id
        $this->load->view('admin/setup/faculty/add_faculty', $data);
    }

    /*
     * @methodName updateFaculty()
     * @access
     * @param  none
     * @return status
     */

    function updateFaculty()
    {

        $faculty_id = $this->input->post('txtFacultyId'); // faculty name
        $facultyName = $this->input->post('facultyName'); // faculty name       
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        $UD_SLNO = $this->input->post('UD_SLNO');
        // checking if Faculty with this name is already exist
        $check = $this->utilities->hasInformationByThisId("ins_faculty", array("FACULTY_NAME" => $facultyName, "FACULTY_ID !=" => $faculty_id));

        if (empty($check)) {// if Faculty name available
            // preparing data to insert
            $faculty = array(
                'FACULTY_NAME' => $facultyName,
                'ACTIVE_STATUS' => $status,
                'UD_SLNO' => $UD_SLNO,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            //var_dump($faculty); exit();
            if ($this->utilities->updateData('ins_faculty', $faculty, array('FACULTY_ID' => $faculty_id))) { // if data update successfully
                echo "<div class='alert alert-success'>Faculty Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Faculty Name Update failed</div>";
            }
        } else {// if faculty name not available
            echo "<div class='alert alert-danger'>Faculty Name Already Exist</div>";
        }
    }

    /*
     * @methodName facultyById()
     * @access
     * @param  none
     * @return Mixed Template
     */

    function facultyById()
    {
        $faculty_id = $this->input->post('param'); // faculty id
        $data["previlages"] = $this->checkPrevilege("setup/faculty");
        $data['row'] = $this->utilities->findByAttribute('ins_faculty', array('FACULTY_ID' => $faculty_id)); // select all data from faculty where faculty id
        $this->load->view('admin/setup/faculty/single_faculty_row', $data);
    }

    /*
     * @methodName department()
     * @access
     * @param  none
     * @return Mixed Template
     */

    function department()
    {
        $data['previlages'] = $this->checkPrevilege();
        $data['contentTitle'] = 'Department';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Department List' => '#',
        );
        $data['department'] = $this->utilities->departmentList(); // select all data from  department with fuculty inforamtion

        $data['content_view_page'] = 'admin/setup/department/department_index';
        $this->admin_template->display($data);
    }

    /*
     * @methodName departmentFormInsert()
     * @access
     * @param  none
     * @return status
     */

    function departmentFormInsert()
    {
        $data["ac_type"] = 1;
        $data["faculty"] = $this->utilities->findAllByAttribute("ins_faculty", array("ACTIVE_STATUS" => 1)); // select all faculty name from  faculty
        $this->load->view('admin/setup/department/add_department', $data);
    }

    /*
     * @methodName departmentList()
     * @access
     * @param  none
     * @return status
     */

    function departmentList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/department");
        $data['department'] = $this->utilities->departmentList(); // select all data from  department with fuculty inforamtion
        $this->load->view("admin/setup/department/dept_list", $data);
    }

    /*
     * @methodName createDepartment()
     * @access
     * @param  none
     * @return status
     */

    function createDepartment()
    {

        $Facultys = $this->input->post('FACULTY_ID'); // faculty id
        $DEPT_NAME = $this->input->post('deptFullName'); // department full name
        $DEPT_ABBR = $this->input->post('deptShortName'); // department short name
        $UD_SLNO = $this->input->post('UD_SLNO'); // department short name
        $office = 0; //$this->input->post('office'); // active status
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Department with this name is already exist
        $check = $this->utilities->hasInformationByThisId("ins_dept", array("DEPT_NAME" => $DEPT_NAME));
        if (empty($check)) {// if Department name available
            // preparing data to insert
            $department = array(
                'DEPT_ABBR' => $DEPT_ABBR,
                'DEPT_NAME' => $DEPT_NAME,
                'UFOR_ACM' => 0,
                'ACTIVE_STATUS' => $status,
                'UD_SLNO' => $UD_SLNO,
                'CREATED_BY' => $this->user["USER_ID"]
            );

            if ($DEPT_ID = $this->utilities->insert('ins_dept', $department)) { // if data inserted successfully
                if (!empty($Facultys)) {
                    $ins_fac_dept = array(
                        'FACULTY_ID' => $Facultys,
                        'DEPT_ID' => $DEPT_ID
                    );
                    $update_department = array('UFOR_ACM' => 1);
                    $this->utilities->updateData('ins_dept', $update_department, array("DEPT_ID" => $DEPT_ID));
                    $this->utilities->insertData($ins_fac_dept, 'ins_fac_dept');
                }
                echo "<div class='alert alert-success'>Department Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Department Name insert failed</div>";
            }
        } else {// if faculty name not available
            echo "<div class='alert alert-danger'>Department Name Already Exist</div>";
        }
    }

    /*
     * @methodName departmentFormUpdate()
     * @access
     * @param  none
     * @return status
     */

    function departmentFormUpdate()
    {
        $data["ac_type"] = "edit";
        $id = $this->input->post('param');
        $data['department'] = $this->utilities->departmentByid($id); // select all data from department where id match
        //print_r($data['department'] );exit;
        $data["faculty"] = $this->utilities->findAllByAttribute("ins_faculty", array("ACTIVE_STATUS" => 1)); // select all faculty name from  faculty
        $this->load->view('admin/setup/department/add_department', $data);
    }

    /*
     * @methodName updateDepartment()
     * @access
     * @param  none
     * @return status
     */

    function updateDepartment()
    {
        $dept_id = $this->input->post('txtDepartmentId'); // faculty name
        $FAC_DEPT_ID = $this->input->post('FAC_DEPT_ID'); // faculty id
        $Facultys = $this->input->post('FACULTY_ID'); // faculty id
        $DEPT_NAME = $this->input->post('deptFullName'); // department full name
        $DEPT_ABBR = $this->input->post('deptShortName');
        $UD_SLNO = $this->input->post('UD_SLNO');
        $office = 0; //$this->input->post('office'); // active status
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Department with this name is already exist
        $check = $this->utilities->hasInformationByThisId("ins_dept", array("DEPT_NAME" => $DEPT_NAME, "DEPT_ID" != $dept_id));

        if (empty($check)) {// if Department name available
            // preparing data to insert
            $department = array(
                'DEPT_ABBR' => $DEPT_ABBR,
                'DEPT_NAME' => $DEPT_NAME,
                'ACTIVE_STATUS' => $status,
                'UD_SLNO' => $UD_SLNO,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->updateData('ins_dept', $department, array('DEPT_ID' => $dept_id))) { // if data update successfully
                if (!empty($FAC_DEPT_ID)) {
                    $ins_fac_dept = array(
                        'FACULTY_ID' => $Facultys,
                        'DEPT_ID' => $dept_id
                    );
                    $this->utilities->updateData('ins_fac_dept', $ins_fac_dept, array('FAC_DEPT_ID' => $FAC_DEPT_ID));
                } else {
                    $ins_fac_dept = array(
                        'FACULTY_ID' => $Facultys,
                        'DEPT_ID' => $dept_id
                    );
                    $this->utilities->insertData($ins_fac_dept, 'ins_fac_dept');

                }
                echo "<div class='alert alert-success'>Department Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Department Name Update failed</div>";
            }
        } else {// if faculty name not available
            echo "<div class='alert alert-danger'>Department Name Already Exist</div>";
        }
    }

    /*
     * @methodName departmentById()
     * @access
     * @param  none
     * @return Mixed Template
     */

    function departmentById()
    {
        $dept_id = $this->input->post('param'); // degree name
        $data["previlages"] = $this->checkPrevilege("setup/department");
        $data['dept'] = $this->utilities->findAllByAttributeFromDepartmentWithId($dept_id); // select all data from  department
        $this->load->view('admin/setup/department/single_department_row', $data);
    }

    /*
     * @methodName program()
     * @access
     * @param  none
     * @return Mixed Template
     */

    function program()
    {
        $data['contentTitle'] = 'Program';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Program List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['program'] = $this->utilities->findAllByAttributeFromProgram();
        $data['content_view_page'] = 'admin/setup/program/program_index';
        $this->admin_template->display($data);
    }

    /*
     * @methodName programFormInsert()
     * @access
     * @param  none
     * @return status
     */

    function programFormInsert()
    {
        $data["ac_type"] = 1;
        $data["degree"] = $this->utilities->findAllByAttribute("ins_degree", array("ACTIVE_STATUS" => 1)); // select all degree name from  degree
        $data["faculty"] = $this->utilities->findAllByAttribute("ins_faculty", array("ACTIVE_STATUS" => 1)); // select all faculty name from  faculty
        $this->load->view('admin/setup/program/add_program', $data);
    }

    /*
     * @methodName programList()
     * @access
     * @param  none
     * @return status
     */

    function programList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/program");
        $data['program'] = $this->utilities->findAllByAttributeFromProgram(); // select all data from  program
        $this->load->view("admin/setup/program/program_list", $data);
    }

    /*
     * @methodName createProgram()
     * @access
     * @param  none
     * @return status
     */

    function createProgram()
    {
        $Degrees = $this->input->post('DEGREE_ID'); // degree
        $Departments = $this->input->post('DEPT_ID'); // program
        $Facultys = $this->input->post('FACULTY_ID'); // faculty
        $programName = $this->input->post('PROGRAM_NAME'); // Program name
        $TotalSemester = $this->input->post('TotalSemester'); //  Total Semesters
        $UD_SLNO = $this->input->post('UD_SLNO'); //  Total Semesters
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
                'UD_SLNO' => $UD_SLNO,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->insertData($program, 'ins_program')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Program Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Program Name insert failed</div>";
            }
        } else {// if faculty name not available
            echo "<div class='alert alert-danger'>Program Name Already Exist</div>";
        }
    }

    /*
     * @methodName programFormUpdate()
     * @access
     * @param  none
     * @return status
     */

    function programFormUpdate()
    {
        $data["ac_type"] = "edit";
        $id = $this->input->post('param'); // program ID
        $data['program'] = $this->utilities->findByAttribute('ins_program', array('PROGRAM_ID' => $id)); // select all data from program where program id
        $data["department"] = $this->utilities->findAllByAttribute("ins_dept", array("ACTIVE_STATUS" => 1)); // select all department name from  department
        $data["degree"] = $this->utilities->findAllByAttribute("ins_degree", array("ACTIVE_STATUS" => 1)); // select all degree name from  degree
        $data["faculty"] = $this->utilities->findAllByAttribute("ins_faculty", array("ACTIVE_STATUS" => 1)); // select all faculty name from  faculty
        $this->load->view('admin/setup/program/add_program', $data);
    }

    /*
     * @methodName updateProgram()
     * @access
     * @param  none
     * @return status
     */

    function updateProgram()
    {

        $program_id = $this->input->post('txtProgramId'); // program id
        $Degrees = $this->input->post('DEGREE_ID'); // degree
        $Departments = $this->input->post('DEPT_ID'); // program
        $Facultys = $this->input->post('FACULTY_ID'); // faculty
        $programName = $this->input->post('PROGRAM_NAME'); // Program name
        $semesterParYrs = $this->input->post('semesterParYrs'); // Semester per Years
        $TotalSemester = $this->input->post('TotalSemester'); //  Total Semesters
        $UD_SLNO = $this->input->post('UD_SLNO');
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Program with this name is already exist
        $check = $this->utilities->hasInformationByThisId("ins_program", array("PROGRAM_NAME" => $programName, "PROGRAM_ID" != $program_id));
        if (empty($check)) {// if Program name available
            // preparing data to insert
            $program = array(
                'PROGRAM_NAME' => $programName,
                'TOTAL_SESSION' => $TotalSemester,
                'DEGREE_ID' => $Degrees,
                'DEPT_ID' => $Departments,
                'FACULTY_ID' => $Facultys,
                'ACTIVE_STATUS' => $status,
                'UD_SLNO' => $UD_SLNO,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            /* print_r($program);
            exit; */
            if ($this->utilities->updateData('ins_program', $program, array('PROGRAM_ID' => $program_id))) { // if data update successfully
                echo "<div class='alert alert-success'>Program Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Program Name Update failed</div>";
            }
        } else {// if faculty name not available
            echo "<div class='alert alert-danger'>Program Name Already Exist</div>";
        }
    }

    /*
     * @methodName programById()
     * @access
     * @param  none
     * @return Mixed Template
     */

    function programById()
    {
        $program_id = $this->input->post('param'); // degree name
        $data["previlages"] = $this->checkPrevilege("setup/program");
        $data['program'] = $this->utilities->findAllByAttributeFromProgramWithId($program_id); // select all data from  program

        $this->load->view('admin/setup/program/single_program_row', $data);
    }

    /*
     * @methodName ProgramPart()
     * @access
     * @param  none
     * @return Mixed Template
     */

    function programPart()
    {
        $data['pageTitle'] = 'View All Program Part';
        $data['breadcrumbs'] = array(
            'All Program Part List' => '#',
        );
        $data['program_part'] = $this->utilities->findAllByAttributeWithJoin('program_part', 'program', 'program_id', 'program_id', 'PROGRAM_NAME', '', ''); // select all data from  program_part with program inforamtion
        //var_dump($data['program_part']);
        $data['content_view_page'] = 'admin/setup/program_part/program_part_index';
        $this->admin_template->display($data);
    }

    /*
     * @methodName addProgramPart()
     * @access
     * @param  none
     * @return Mixed Template
     */

    function addProgramPart()
    {
        $data['program'] = $this->utilities->findAllFromView('program');
        $this->load->view('admin/setup/program_part/add_program_part', $data);
    }

    /*
     * @methodName getProgramPart()
     * @access
     * @param  none
     * @return Mixed Template
     */

    function getProgramPart()
    {
        $data['program_part'] = $this->utilities->findAllByAttributeWithJoin('program_part', 'program', 'program_id', 'program_id', 'PROGRAM_NAME', '', ''); // select all data from  program_part with program inforamtion
        $this->load->view("admin/setup/program_part/program_part_list", $data);
    }

    /*
     * @methodName createProgramPart()
     * @access
     * @param  none
     * @return status
     */

    function createProgramPart()
    {
        $program_id = $this->input->post('program_id'); // program name
        $programPartName = $this->input->post('programPartName'); // Program part name
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Session with this name is already exist
        $check = $this->utilities->hasInformationByThisId("program_part", array("PR_PART_NAME" => $programPartName));
        if (empty($check)) {// if Session name available
            // preparing data to insert
            $program_part = array(
                'PROGRAM_ID' => $program_id,
                'PR_PART_NAME' => $programPartName,
                'ACTIVE_STATUS' => ($status == "on") ? 1 : 0,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->insertData($program_part, 'program_part')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Program Part Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'> Program Part Name insert failed</div>";
            }
        } else {// if session name not available
            echo "<div class='alert alert-danger'> Program Part Name Already Exist</div>";
        }
    }

    /*
     * @methodName session()
     * @access
     * @param  none
     * @return Mixed Template
     */

    function session()
    {
        $data['contentTitle'] = 'Session';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Session List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['session'] = $this->utilities->findAllFromView('ins_session'); // select all data from degree
        $data['content_view_page'] = 'admin/setup/session/session_index';
        $this->admin_template->display($data);
    }

    /*
     * @methodName addSession()
     * @access
     * @param  none
     * @return Mixed Template
     */

    function sessionFormInsert()
    {
        $data["ac_type"] = 1;
        $this->load->view('admin/setup/session/add_session', $data);
    }

    /*
     * @methodName getSession()
     * @access
     * @param  none
     * @return Mixed Template
     */

    function sessionList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/session");
        $data['session'] = $this->utilities->findAllFromView('ins_session'); // select all data from degree
        $this->load->view("admin/setup/session/session_list", $data);
    }

    /*
     * @methodName createSession()
     * @access
     * @param  none
     * @return status
     */

    function createSession()
    {
        $sessionName = $this->input->post('sessionName'); // session name
        $UD_SLNO = $this->input->post('UD_SLNO'); // session name
        // checking if Session with this name is already exist
        $check = $this->utilities->hasInformationByThisId("ins_session", array("SESSION_NAME" => $sessionName));
        if (empty($check)) {// if Session name available
            // preparing data to insert
            $session = array(
                'SESSION_NAME' => $sessionName,
                'UD_SLNO' => $UD_SLNO,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->insertData($session, 'ins_session')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Session Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Session Name insert failed</div>";
            }
        } else {// if session name not available
            echo "<div class='alert alert-danger'>Session Name Already Exist</div>";
        }
    }

    /*
     * @methodName sessionFormUpdate()
     * @access
     * @param  none
     * @return status
     */

    function sessionFormUpdate()
    {
        $data["ac_type"] = 2;
        $id = $this->input->post('param'); // session ID
        $data['session'] = $this->utilities->findByAttribute('ins_session', array('SESSION_ID' => $id)); // select all data from session where session id
        $this->load->view('admin/setup/session/add_session', $data);
    }

    /*
     * @methodName updateSession()
     * @access
     * @param  none
     * @return status
     */

    function updateSession()
    {
        $session_id = $this->input->post('txtSessionId'); // session id
        $sessionName = $this->input->post('sessionName'); // session name
        $UD_SLNO = $this->input->post('UD_SLNO'); // user defined SL. No

        // checking if Session with this name is already exist
        $check = $this->utilities->hasInformationByThisId("ins_session", array("SESSION_NAME" => $sessionName, "SESSION_ID !=" => $session_id));
        if (empty($check)) {// if Session name available
            // preparing data to insert
            $session = array(
                'SESSION_NAME' => $sessionName,
                'UD_SLNO' => $UD_SLNO,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->updateData('ins_session', $session, array('SESSION_ID' => $session_id))) { // if data update successfully
                echo "<div class='alert alert-success'>Session Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Session Name Update failed</div>";
            }
        } else {// if session name not available
            echo "<div class='alert alert-danger'>Session Name Already Exist</div>";
        }
    }

    /*
     * @methodName sessionById()
     * @access
     * @param  none
     * @return Mixed Template
     */

    function sessionById()
    {
        $session_id = $this->input->post('param'); // session name
        $data["previlages"] = $this->checkPrevilege("setup/session");
        $data['row'] = $this->utilities->findByAttribute('ins_session', array('SESSION_ID' => $session_id)); // select all data from session where session id
        $this->load->view('admin/setup/session/single_session_row', $data);
    }

    public function deleteItem()
    {
        $item_id = $this->input->post('item_id'); //
        $data_tbl = $this->input->post('data_tbl'); // table name
        $data_field = $this->input->post('data_field'); // column name
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
     * @methodName statusItem()
     * @access
     * @param   none
     * @return  All Item Active inactive status
     */

    function statusItem()
    {
        $item_id = $this->input->post('item_id'); // id
        $status = $this->input->post('status'); // current status
        $data_tbl = $this->input->post('data_tbl'); // table name
        $data_field = $this->input->post('data_field'); // column name
        $data_fieldId = $this->input->post('data_fieldId'); // table column ID


        if ($status == 1) {
            $new_status = 0;
        } else {
            $new_status = 1;
        }

        $update_status = array(
            "$data_field" => $new_status
        );

        if ($this->utilities->updateData($data_tbl, $update_status, array("$data_fieldId" => $item_id))) {
            echo "Y";
        } else {
            echo "N";
        }
    }

    /*
      eventType()
     * @access
     * @param  none
     * @author Sultan Ahmmed <sultan@atilimited.net>
     * @return event type index page
     */

    function eventType()
    {
        $data['contentTitle'] = 'Event Type';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'All Event Type List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['eventType'] = $this->utilities->findAllFromView('event_type'); // select all data from  event type
        $data['content_view_page'] = 'admin/setup/event/eventType_index';
        $this->admin_template->display($data);
    }

    /*
     * @methodName eventTypeList()
     * @access
     * @param  none
     * @author Sultan Ahmmed <sultan@atilimited.net>
     * @return event type list
     */

    function eventTypeList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/eventType");
        $data['eventType'] = $this->utilities->findAllFromView('event_type'); // select all data from  event_type
        $this->load->view("admin/setup/event/event_type_list", $data);
    }

    /**
     * @methodName  eventTypeFormInsert()
     * @access
     * @param  none
     * @author Sultan Ahmmed <sultan@atilimited.net>
     * @return Mixed Template
     */
    public function eventTypeFormInsert()
    {
        $data["ac_type"] = 1;
        $this->load->view('admin/setup/event/add_event_type', $data);
    }

    /**
     * @methodName  createEventType()
     * @access
     * @param  none
     * @author Sultan Ahmmed <sultan@atilimited.net>
     * @insert event type data
     */
    function createEventType()
    {
        $eventType = $this->input->post('eventType');
        $check = $this->utilities->hasInformationByThisId("event_type", array("E_COM_TITLE" => $eventType));
        if (empty($check)) {// if event type available
            // preparing data to insert
            $event = array(
                'E_COM_TITLE' => $this->input->post('eventType'),
                'E_DESC' => $this->input->post('content'),
                'ACTIVE_STATUS' => $this->input->post('status')
            );
            if ($this->utilities->insertData($event, 'event_type')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Event Type Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Event Type insert failed</div>";
            }
        } else {// if event type not available
            echo "<div class='alert alert-danger'>Event Type Already Exist</div>";
        }
    }

    /*
     * @methodName eventTypeFormUpdate()
     * @access
     * @param  none
     * @author Sultan Ahmmed <sultan@atilimited.net>
     * @return Mixed Template
     */

    function eventTypeFormUpdate()
    {
        $data["ac_type"] = 2;
        $id = $this->input->post('param'); // event type ID
        $data['eventType'] = $this->utilities->findByAttribute('event_type', array('E_TYPE_ID' => $id)); // select all data from event type where event id
        $this->load->view('admin/setup/event/add_event_type', $data);
    }

    /*
     * @methodName updateEventType()
     * @access
     * @param  none
     * @author Sultan Ahmmed <sultan@atilimited.net>
     * @return update event type data
     */

    function updateEventType()
    {
        $eventType_id = $this->input->post('eventTypeId'); // event type id
        //if (empty($check)) {// if event type name available
        // preparing data to insert
        $eventType = array(
            'E_COM_TITLE' => $this->input->post('eventType'),
            'E_DESC' => $this->input->post('content'),
            'ACTIVE_STATUS' => $this->input->post('status'),
            'UPDATED_BY' => $this->user["USER_ID"]
        );
        if ($this->utilities->updateData('event_type', $eventType, array('E_TYPE_ID' => $eventType_id))) { // if data update successfully
            echo "<div class='alert alert-success'>Event type Update successfully</div>";
        } else { // if data update failed
            echo "<div class='alert alert-danger'>Event type Update failed</div>";
        }
        //} else {// if event type not available
        //    echo "<div class='alert alert-danger'>Event type Already Exist</div>";
        //}
    }

    /*
     * @methodName eventTypeById()
     * @access
     * @param  none
     * @author Sultan Ahmmed <sultan@atilimited.net>
     * @return single row
     */

    function eventTypeById()
    {
        $event_type_id = $this->input->post('param'); // event type id
        $data["previlages"] = $this->checkPrevilege("setup/eventType");
        $data['row'] = $this->utilities->findByAttribute('event_type', array('E_TYPE_ID' => $event_type_id)); // select all data from event type where event type id
        $this->load->view('admin/setup/event/single_event_type_row', $data);
    }

    /*
     * @methodName event()
     * @access
     * @param  none
     * @author Sultan Ahmmed <sultan@atilimited.net>
     * @return event index page
     */

    function event()
    {
        $data['contentTitle'] = 'Event';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Event List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['event'] = $this->db->query("SELECT e.EVENT_ID, e.E_TITLE, e.START_DT, e.END_DT, e.ACTIVE_STATUS, (SELECT e.E_TITLE FROM event_type t WHERE t.E_TYPE_ID = e.E_TYPE_ID)type FROM event e")->result();
        $data['content_view_page'] = 'admin/setup/event/event_index';
        $this->admin_template->display($data);
    }

    /*
     * @methodName eventList()
     * @access
     * @param  none
     * @author Sultan Ahmmed <sultan@atilimited.net>
     * @return event list
     */

    function eventList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/event");
        $data['event'] = $this->db->query("SELECT e.EVENT_ID, e.E_TITLE, e.START_DT, e.END_DT, e.ACTIVE_STATUS,
            (SELECT t.E_COM_TITLE FROM event_type t WHERE t.E_TYPE_ID = e.E_TYPE_ID)type FROM event e")->result();
        $this->load->view("admin/setup/event/event_list", $data);
    }

    /*
     * @methodName eventListView()
     * @access
     * @param  none
     * @author Sultan Ahmmed <sultan@atilimited.net>
     * @return event list
     */

    function eventListView()
    {
        $data['event'] = $this->db->query("SELECT e.E_TITLE, e.E_TYPE_ID,
            (SELECT t.E_COM_TITLE FROM event_type t WHERE t.E_TYPE_ID = e.E_TYPE_ID)type FROM event e")->result();
        $this->load->view("admin/setup/event/event_list_view", $data);
    }

    /**
     * @methodName  addEventFormInsert()
     * @access
     * @param  none
     * @author Sultan Ahmmed <sultan@atilimited.net>
     * @return Mixed Template
     */
    public function eventFormInsert()
    {
        $data["ac_type"] = 1;
        $data['current_date'] = $this->input->post('date');
        $data["eventType"] = $this->utilities->dropdownFromTableWithCondition("event_type", "Select Event", "E_TYPE_ID", "E_TYPE_NAME", array("ACTIVE_STATUS" => 1)); // select all event types from event type table
        $this->load->view('admin/setup/event/add_event', $data);
    }

    /**
     * @methodName  createEvent()
     * @access
     * @param  none
     * @author Sultan Ahmmed <sultan@atilimited.net>
     * @insert event data
     */
    function createEvent()
    {

        $eventTile = $this->input->post('eventTile');
        $start = $this->input->post('startDate');
        $date1 = explode("/", $start);
        $sd = $date1[2] . '-' . $date1[1] . '-' . $date1[0];

        $end = $this->input->post('endDate');
        $date2 = explode("/", $end);
        $ed = $date2[2] . '-' . $date2[1] . '-' . $date2[0];

        $check = $this->utilities->hasInformationByThisId("event", array("E_TITLE" => $eventTile, "START_DT" => $sd, "END_DT" => $ed));

        if (empty($check)) {// if Event name available
            $event = array(
                'E_TYPE_ID' => $this->input->post('cmbEvents'),
                'E_TITLE' => $this->input->post('eventTile'),
                'E_DESC' => $this->input->post('content'),
                'START_DT' => $sd,
                'END_DT' => $ed,
                'START_TIME' => $this->input->post('startTime'),
                'END_TIME' => $this->input->post('endTime'),
                'ACTIVE_STATUS' => $this->input->post('status')
            );
            if ($this->utilities->insertData($event, 'event')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Event Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Event insert failed</div>";
            }
        } else {// if event name not available
            echo "<div class='alert alert-danger'>Event Title Already Exist</div>";
        }
    }

    /*
     * @methodName eventFormDelete()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */

    function eventFormDelete()
    {
        $data["ac_type"] = 2;
        $event_id = $this->input->post('param'); // event type ID
        echo $event_id;
        /* $data["eventType"] = $this->utilities->dropdownFromTableWithCondition("event_type", "Select Event", "E_TYPE_ID", "E_COM_TITLE", array("ACTIVE_STATUS" => 1)); // select all event types from event type table
          $data['event'] = $this->db->query("SELECT e.EVENT_ID, e.E_TYPE_ID, e.E_TITLE, e.E_DESC, e.START_DT, e.END_DT, e.START_TIME, e.END_TIME, e.ACTIVE_STATUS,
          (SELECT t.E_COM_TITLE FROM event_type t WHERE t.E_TYPE_ID = e.E_TYPE_ID)type FROM event e WHERE e.EVENT_ID = '$event_id'")->row();

          $this->load->view('admin/setup/event/add_event', $data); */
    }

    /*
     * @methodName eventFormUpdate()
     * @access
     * @param  none
     * @author Sultan Ahmmed <sultan@atilimited.net>
     * @return Mixed Template
     */

    function eventFormUpdate()
    {
        $data["ac_type"] = 2;
        $event_id = $this->input->post('param'); // event type ID
        $data["eventType"] = $this->utilities->dropdownFromTableWithCondition("event_type", "Select Event", "E_TYPE_ID", "E_COM_TITLE", array("ACTIVE_STATUS" => 1)); // select all event types from event type table
        $data['event'] = $this->db->query("SELECT e.EVENT_ID,
           e.E_TITLE,
           e.E_DESC,
           e.START_DT,
           e.END_DT,
           e.START_TIME,
           e.END_TIME,
           e.ACTIVE_STATUS,
           f.*
           FROM event e LEFT JOIN event_type f ON e.E_TYPE_ID = f.E_TYPE_ID
           WHERE e.EVENT_ID = '$event_id'")->row();

        $this->load->view('admin/setup/event/add_event', $data);
    }

    /*
     * @methodName updateEvent()
     * @access
     * @param  none
     * @author Sultan Ahmmed <sultan@atilimited.net>
     * @return update data
     */

    function updateEvent()
    {
        $event_id = $this->input->post('eventId'); // degree name

        $start = $this->input->post('startDate');
        $date1 = explode("/", $start);
        $sd = $date1[2] . '-' . $date1[1] . '-' . $date1[0];

        $end = $this->input->post('endDate');
        $date2 = explode("/", $end);
        $ed = $date2[2] . '-' . $date2[1] . '-' . $date2[0];
        //if (empty($check)) {// if Degree name available
        // preparing data to insert
        $event = array(
            'E_TYPE_ID' => $this->input->post('cmbEvents'),
            'E_TITLE' => $this->input->post('eventTile'),
            'E_DESC' => $this->input->post('content'),
            'START_DT' => $sd,
            'END_DT' => $ed,
            'START_TIME' => $this->input->post('startTime'),
            'END_TIME' => $this->input->post('endTime'),
            'ACTIVE_STATUS' => $this->input->post('status')
        );
        if ($this->utilities->updateData('event', $event, array('EVENT_ID' => $event_id))) { // if data update successfully
            echo "<div class='alert alert-success'>Event Update successfully</div>";
        } else { // if data update failed
            echo "<div class='alert alert-danger'>Event Update failed</div>";
        }
        //} else {// if event name not available
        //    echo "<div class='alert alert-danger'>Event Already Exist</div>";
        //}
    }

    /*
     * @methodName eventTypeCalender()
     * @access none
     * @param  $event_id
     * @return Mixed Template
     */

    function eventTypeCalender()
    {
        $event_id = $this->input->post('param');
        $data['event_date'] = $event_id;
        // select all data from event with inforamtion
        $data['event'] = $this->db->query("SELECT e.E_TITLE,
            (SELECT t.E_COM_TITLE FROM event_type t WHERE t.E_TYPE_ID = e.E_TYPE_ID)type FROM event e WHERE '$event_id' between e.START_DT AND e.END_DT ")->result();
        $this->load->view("admin/setup/event/event_type", $data);
    }

    /*
     * @methodName eventInfo()
     * @access none
     * @param  $event_id
     * @return Mixed Template
     */

    function eventInfo()
    {
        $event_id = $this->input->post('param');
        // select all data from event with inforamtion
        $data['event'] = $this->db->query("SELECT e.EVENT_ID,
           e.E_TITLE,
           e.E_DESC,
           e.START_DT,
           e.END_DT,
           e.START_TIME,
           e.END_TIME,
           e.ACTIVE_STATUS,
           f.E_TYPE_NAME
           FROM event e LEFT JOIN event_type f ON e.E_TYPE_ID = f.E_TYPE_ID
           WHERE e.EVENT_ID ='$event_id'")->row();
        /* var_dump($data['event']);
        exit(); */
        $this->load->view("admin/setup/event/event_info", $data);
    }

    /*
     * @methodName eventById()
     * @access
     * @param  none
     * @author Sultan Ahmmed <sultan@atilimited.net>
     * @return Mixed Template
     */

    function eventById()
    {
        $event_id = $this->input->post('param'); // event type id
        $data["previlages"] = $this->checkPrevilege("setup/event");
        $data['row'] = $this->db->query("SELECT e.EVENT_ID, e.E_TITLE, e.START_DT, e.END_DT, e.ACTIVE_STATUS,
            (SELECT t.E_COM_TITLE FROM event_type t WHERE t.E_TYPE_ID = e.E_TYPE_ID)type FROM event e WHERE e.EVENT_ID = '$event_id'")->row();
        $this->load->view('admin/setup/event/single_event_row', $data);
    }

    /*
     * @methodName yearSetup()
     * @access
     * @param  none
     * @author Sultan Ahmmed <sultan@atilimited.net>
     * @return year setup list
     */

    function yearSetup()
    {
        $data['contentTitle'] = 'Session Year';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Year List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['yearSetup'] = $this->utilities->findAllFromView('ins_years'); // select all data from  year_setup
        //var_dump($data['yearSetup']); exit;
        $data['content_view_page'] = 'admin/setup/year_setup/year_setup_index';
        $this->admin_template->display($data);
    }

    /*
     * @methodName yearSetupList()
     * @access
     * @param  none
     * @author Sultan Ahmmed <sultan@atilimited.net>
     * @return year list
     */

    function yearSetupList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/yearSetup");
        $data['yearSetup'] = $this->utilities->findAllFromView('ins_years'); // select all data from year_setup
        $this->load->view("admin/setup/year_setup/year_setup_list", $data);
    }

    /**
     * @methodName  yearSetupFormInsert()
     * @access
     * @param  none
     * @author Sultan Ahmmed <sultan@atilimited.net>
     * @return Mixed Template
     */
    public function yearSetupFormInsert()
    {
        $data["ac_type"] = 1;
        $this->load->view('admin/setup/year_setup/add_year', $data);
    }

    /**
     * @methodName  createYearSetup()
     * @access
     * @param  none
     * @author Sultan Ahmmed <sultan@atilimited.net>
     * @insert year setup data
     */
    function createYearSetup()
    {
        $yearTile = $this->input->post('yearTile');
        $check = $this->utilities->hasInformationByThisId("ins_years", array("YEAR_TITLE" => $yearTile));
        $start = date('Y-m-d', strtotime($this->input->post('startDate')));
        $end = date('Y-m-d', strtotime($this->input->post('endDate')));


        if (empty($check)) {// if year setup title available
            $year = array(
                'YEAR_TITLE' => $yearTile,
                'YEAR_DESC' => $this->input->post('content'),
                'START_DT' => $start,
                'END_DT' => $end

            );
            //  print_r($year);exit;
            if ($this->utilities->insertData($year, 'ins_years')) { // if data inserted successfully
                echo "<div class='alert alert-success'>New Year Setup Inserted successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Year Setup insert failed</div>";
            }
        } else {// if event name not available
            echo "<div class='alert alert-danger'>Year Setup Title Already Exist</div>";
        }
    }

    /*
     * @methodName yearSetupFormUpdate()
     * @access
     * @param  none
     * @author Sultan Ahmmed <sultan@atilimited.net>
     * @return Mixed Template
     */

    function yearSetupFormUpdate()
    {
        $data["ac_type"] = 2;
        $year_id = $this->input->post('param'); // event type ID
        $data['yearSetup'] = $this->utilities->findByAttribute('ins_years', array('YEAR_ID' => $year_id)); // select all data from event type where event id
        $this->load->view('admin/setup/year_setup/add_year', $data);
    }

    /*
     * @methodName updateYearSetup()
     * @access
     * @param  none
     * @author Sultan Ahmmed <sultan@atilimited.net>
     * @return update year data
     */

    function updateYearSetup()
    {
        $yearSetup_id = $this->input->post('yearSetupId'); // year setup id
        $yearTile = $this->input->post('yearTile');
        $start = date('Y-m-d', strtotime($this->input->post('startDate')));
        $end = date('Y-m-d', strtotime($this->input->post('endDate')));
        $year = array(
            'YEAR_TITLE' => $yearTile,
            'YEAR_DESC' => $this->input->post('content'),
            'START_DT' => $start,
            'END_DT' => $end

        );
        if ($this->utilities->updateData('ins_years', $year, array('YEAR_ID' => $yearSetup_id))) { // if data update successfully
            echo "<div class='alert alert-success'>Year Setup Update successfully</div>";
        } else { // if data update failed
            echo "<div class='alert alert-danger'>Year Setup Update failed</div>";
        }
        //} else {// if event type not available
        //    echo "<div class='alert alert-danger'>Event type Already Exist</div>";
        //}
    }

    /*
     * @methodName yearSetupById()
     * @access
     * @param  none
     * @author Sultan Ahmmed <sultan@atilimited.net>
     * @return Mixed Template
     */

    function yearSetupById()
    {
        $yearSetup_id = $this->input->post('param'); // year setup id
        $data["previlages"] = $this->checkPrevilege("setup/yearSetup");
        $data['row'] = $this->utilities->findByAttribute('ins_years', array('YEAR_ID' => $yearSetup_id)); // select all data from year setup where year setup id
        $this->load->view('admin/setup/year_setup/single_yearSetup_row', $data);
    }

    function yearSetupCurrentById()
    {
        $yearSetup_id = $this->input->post('param');
        $inactive = array(
            'IS_CURRENT' => 0
        );
        if ($this->utilities->updateData('year_setup', $year, array('IS_CURRENT' => 1))) { // if data update successfully
            //echo "<div class='alert alert-success'>Past Year</div>";
        }
        $current = array(
            'IS_CURRENT' => 1
        );
        if ($this->utilities->updateData('year_setup', $current, array('YEAR_SETUP_ID' => $yearSetup_id))) { // data update successfully
            //echo "<div class='alert alert-success'>Current Year</div>";
        }
        $yearSetup_id = $this->input->post('param'); // year setup id
        $data["previlages"] = $this->checkPrevilege("setup/yearSetup");
        $data['row'] = $this->utilities->findByAttribute('year_setup', array('YEAR_SETUP_ID' => $yearSetup_id)); // select all data from year setup where year setup id
        $this->load->view('admin/setup/year_setup/yearSetupList', $data);
    }

    /*
     * @param  dimention defining faculty,department and program dropdown form dimension
     * @author Jahid Hasan <jahid@atilimited.net>
     * @return Mixed Template
     */

    function expense()
    {
        $data['contentTitle'] = 'Particular';
        $data['breadcrumbs'] = array(
            'Setup' => 'setup/expense',
            'Particular Charge List' => '#',
        );
        $data["ac_type"] = '';
        $data["previlages"] = $this->checkPrevilege(); // for user previlages
        $data['faculty'] = $this->utilities->findAllByAttribute('faculty', array("ACTIVE_STATUS" => 1, "ADMINISTRATION" => 0));
        $data['dimention'] = "horizental";
        $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
        // get all data from ac_academic_charge_rate
        $data["expenses"] = $this->db->query("SELECT acr.RATE_ID, acr.CHARGE_ID, acr.AMOUNT, acr.START_DATE, acr.END_DATE, acr.ACTIVE_STATUS,
            (SELECT m.LKP_NAME FROM m00_lkpdata m WHERE acr.SEMISTER_ID = m.LKP_ID)SEMESTER,
            (SELECT p.PROGRAM_NAME FROM program p WHERE p.PROGRAM_ID = acr.PROGRAM_ID)PROGRAM,
            (SELECT d.DEPT_NAME FROM department d WHERE d.DEPT_ID = acr.DEPT_ID)DEPARTMENT,
            (SELECT f.FACULTY_NAME FROM faculty f WHERE f.FACULTY_ID = acr.FACULTY_ID)FACULTY,
            (SELECT ac.CHARGE_NAME FROM ac_academic_charge ac WHERE ac.CHARGE_ID = acr.CHARGE_ID)CHARGE_NAME
            FROM ac_academic_charge_rate acr ORDER BY acr.RATE_ID DESC")->result();
        $data['content_view_page'] = 'admin/setup/expense/index';
        $this->admin_template->display($data);
    }

    /**
     * @param  none
     * @author Emdadul <emdadul@atilimited.net>
     * @return Mixed Template
     */
    function ajax_get_particular_charge_rate()
    {
        $faculty = $this->input->post('faculty'); // faculty name
        $dept = $this->input->post('department'); // department name
        $program = $this->input->post('program'); // programe
        $data["expensesList"] = $this->db->query("SELECT accr.*, acc.CHARGE_NAME FROM ac_academic_charge_rate accr
            LEFT JOIN ac_academic_charge acc on acc.CHARGE_ID = accr.CHARGE_ID
            WHERE accr.FACULTY_ID = $faculty AND accr.DEPT_ID = $dept AND accr.PROGRAM_ID = $program
            ORDER BY acc.CHARGE_NAME ASC")->result();

        $this->load->view("admin/setup/expense/ajax_particular_charge_rate", $data);
    }

    /*
     * @methodName expenseFormInsert()
     * @access
     * @param  none
     * @author Nurullah <nurul@atilimited.net>
     * @return Mixed Template
     */

    function expenseFormInsert()
    {
        $data["ac_type"] = 1; // for insert expense info
        $data["charge"] = $this->utilities->dropdownFromTableWithCondition("ac_academic_charge", "Select Charge", "CHARGE_ID", "CHARGE_NAME", array("ACTIVE_STATUS" => 1));
        // select all Charge name from  ac_academic_charge
        $data["faculty"] = $this->utilities->dropdownFromTableWithCondition("faculty", "Select Faculty", "FACULTY_ID", "FACULTY_NAME", array("ACTIVE_STATUS" => 1, "ADMINISTRATION" => 0));
        $data["semester"] = $this->utilities->dropdownFromTableWithCondition("m00_lkpdata", "Select Semester", "LKP_ID", "LKP_NAME", array("GRP_ID" => 16));
        // select all faculty name from  faculty
        //$data['faculty'] = $this->utilities->findAllByAttribute('faculty', array("ACTIVE_STATUS" => 1, "ADMINISTRATION" => 0));
        $data['dimention'] = "vertical";
        // $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
        // select all semester name from  semester
        $this->load->view('admin/setup/expense/add_expense', $data);
    }

    /*
     * @methodName expenseCreate()
     * @access
     * @param  none
     * @author Nurullah <nurul@atilimited.net>
     * @return Mixed Template
     */

    function expenseCreate()
    {
        $CHARGE_NAME = $this->input->post('CHARGE_NAME'); // charge name
        $AMOUNT = $this->input->post('AMOUNT'); // amount
        $START_DATE = $this->input->post('START_DATE'); // start date
        $date1 = explode("/", $START_DATE);
        $sd = $date1[2] . '-' . $date1[1] . '-' . $date1[0]; // date formate

        $END_DATE = $this->input->post('END_DATE'); // end date
        $date2 = explode("/", $END_DATE);
        $ed = $date2[2] . '-' . $date2[1] . '-' . $date2[0]; // date formate

        $FACULTY_ID = $this->input->post('FACULTY_ID'); // faculty
        $DEPT_ID = $this->input->post('DEPT_ID'); // department
        $PROGRAM_ID = $this->input->post('PROGRAM_ID'); // programe
        $SEMISTER_ID = $this->input->post('SEMESTER_ID'); // semester
        $check = $this->utilities->hasInformationByThisId("ac_academic_charge_rate", array("FACULTY_ID" => $FACULTY_ID, "DEPT_ID" => $DEPT_ID, "PROGRAM_ID" => $PROGRAM_ID, "SEMISTER_ID" => $SEMISTER_ID, "CHARGE_ID" => $CHARGE_NAME, "AMOUNT" => $AMOUNT, "START_DATE" => $sd, "END_DATE" => $ed));
        if (empty($check)) { //if START_DATE, END_DATE available
            $expenses = array(
                'CHARGE_ID' => $CHARGE_NAME,
                'AMOUNT' => $AMOUNT,
                'START_DATE' => $sd,
                'END_DATE' => $ed,
                'FACULTY_ID' => $FACULTY_ID,
                'DEPT_ID' => $DEPT_ID,
                'PROGRAM_ID' => $PROGRAM_ID,
                'SEMISTER_ID' => $SEMISTER_ID,
                'ACTIVE_STATUS' => 1,
                'CREATED_BY' => $this->user['USER_ID']
            );
            if ($this->utilities->insertData($expenses, 'ac_academic_charge_rate')) { // insert data in ac_academic_charge_rate
                echo "<div class='alert alert-success'>Expense Create successfully</div>"; // if insert success
            } else { // if data Create failed
                echo "<div class='alert alert-danger'>Expense Create failed</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Start or End date Already Exist</div>";
        }
    }

    /*
     * @methodName getExpense()
     * @access
     * @param  none
     * @author Nurullah <nurul@atilimited.net>
     * @return Mixed Template
     */

    function getExpense()
    {
        $data["previlages"] = $this->checkPrevilege("setup/expense"); // for user previlages
        $data["expenses"] = $this->db->query("SELECT acr.RATE_ID, acr.CHARGE_ID, acr.AMOUNT, acr.START_DATE, acr.END_DATE, acr.ACTIVE_STATUS,
            (SELECT m.LKP_NAME FROM m00_lkpdata m WHERE acr.SEMISTER_ID = m.LKP_ID)SEMESTER,
            (SELECT p.PROGRAM_NAME FROM program p WHERE p.PROGRAM_ID = acr.PROGRAM_ID)PROGRAM,
            (SELECT d.DEPT_NAME FROM department d WHERE d.DEPT_ID = acr.DEPT_ID)DEPARTMENT,
            (SELECT f.FACULTY_NAME FROM faculty f WHERE f.FACULTY_ID = acr.FACULTY_ID)FACULTY,
            (SELECT ac.CHARGE_NAME FROM ac_academic_charge ac WHERE ac.CHARGE_ID = acr.CHARGE_ID)CHARGE_NAME
                                            FROM ac_academic_charge_rate acr ORDER BY acr.RATE_ID DESC")->result(); // get all data from ac_academic_charge_rate
        $this->load->view("admin/setup/expense/expense_list", $data);
    }

    /*
     * @methodName expenseInfo()
     * @access
     * @param  none
     * @author Nurullah <nurul@atilimited.net>
     * @return Mixed Template
     */

    function expenseInfo()
    {
        $rate_id = $this->input->post('param'); // id
        $data["expenses"] = $this->db->query("SELECT acr.RATE_ID, acr.CHARGE_ID, acr.AMOUNT, acr.START_DATE, acr.END_DATE, acr.ACTIVE_STATUS,
            (SELECT m.LKP_NAME FROM m00_lkpdata m WHERE acr.SEMISTER_ID = m.LKP_ID)SEMESTER,
            (SELECT p.PROGRAM_NAME FROM program p WHERE p.PROGRAM_ID = acr.PROGRAM_ID)PROGRAM,
            (SELECT d.DEPT_NAME FROM department d WHERE d.DEPT_ID = acr.DEPT_ID)DEPARTMENT,
            (SELECT f.FACULTY_NAME FROM faculty f WHERE f.FACULTY_ID = acr.FACULTY_ID)FACULTY,
            (SELECT ac.CHARGE_NAME FROM ac_academic_charge ac WHERE ac.CHARGE_ID = acr.CHARGE_ID)CHARGE_NAME
                                            FROM ac_academic_charge_rate acr  WHERE acr.RATE_ID = $rate_id")->row(); // get all data from
        $this->load->view("admin/setup/expense/preview_expense", $data);
    }

    /*
     * @methodName expenseFormUpdate()
     * @access
     * @param  none
     * @author Nurullah <nurul@atilimited.net>
     * @return Mixed Template
     */

    function expenseFormUpdate()
    {
        $rate_id = $this->input->post('param'); // hidden value
        $data["ac_type"] = 2; // for Update expense info
        $data["expenses"] = $this->utilities->findByAttribute('ac_academic_charge_rate', array("RATE_ID" => $rate_id));
        // get all value from ac_academic_charge_rate  where RATE_ID = $rate_id
        $data["charge"] = $this->utilities->dropdownFromTableWithCondition("ac_academic_charge", "Select Charge", "CHARGE_ID", "CHARGE_NAME", array("ACTIVE_STATUS" => 1));
        // select all Charge name from  ac_academic_charge
        $data["faculty"] = $this->utilities->dropdownFromTableWithCondition("faculty", "Select Faculty", "FACULTY_ID", "FACULTY_NAME", array("ACTIVE_STATUS" => 1, "ADMINISTRATION" => 0));
        // select all faculty name from  faculty
        $data["department"] = $this->utilities->dropdownFromTableWithCondition("department", "Select Department", "DEPT_ID", "DEPT_NAME", array("ACTIVE_STATUS" => 1));
        // select all Department name from  faculty
        $data["program"] = $this->utilities->dropdownFromTableWithCondition("program", "Select Program", "PROGRAM_ID", "PROGRAM_NAME", array("ACTIVE_STATUS" => 1));
        // select all Program name from  faculty
        $data["semester"] = $this->utilities->dropdownFromTableWithCondition("m00_lkpdata", "Select Semester", "LKP_ID", "LKP_NAME", array("GRP_ID" => 16));
        // select all semester name from  semester
        $this->load->view("admin/setup/expense/add_expense", $data);
    }

    /*
     * @methodName expenseUpdate()
     * @access
     * @param  none
     * @author Nurullah <nurul@atilimited.net>
     * @return Mixed Template
     */

    function expenseUpdate()
    {

        $rate_id = $this->input->post('RATE_ID'); // hidden value
        $CHARGE_NAME = $this->input->post('CHARGE_NAME'); // charge name
        $AMOUNT = $this->input->post('AMOUNT'); // amount
        $START_DATE = $this->input->post('START_DATE'); // start date
        $date1 = explode("/", $START_DATE);
        $sd = $date1[2] . '-' . $date1[1] . '-' . $date1[0]; // date formate

        $END_DATE = $this->input->post('END_DATE'); // end date
        $date2 = explode("/", $END_DATE);
        $ed = $date2[2] . '-' . $date2[1] . '-' . $date2[0]; // date formate

        $FACULTY_ID = $this->input->post('FACULTY_ID'); // faculty name
        $DEPT_ID = $this->input->post('DEPT_ID'); // department name
        $PROGRAM_ID = $this->input->post('PROGRAM_ID'); // program name
        $SEMISTER_ID = $this->input->post('SEMESTER_ID'); //semester name
        $check = $this->utilities->hasInformationByThisId("ac_academic_charge_rate", array("START_DATE" => $sd, "END_DATE" => $ed, "RATE_ID !=" => $rate_id));
        if (empty($check)) { // if start date and end date available
            $expenses = array(
                'CHARGE_ID' => $CHARGE_NAME,
                'AMOUNT' => $AMOUNT,
                'START_DATE' => $sd,
                'END_DATE' => $ed,
                'FACULTY_ID' => $FACULTY_ID,
                'DEPT_ID' => $DEPT_ID,
                'PROGRAM_ID' => $PROGRAM_ID,
                'SEMISTER_ID' => $SEMISTER_ID,
                'ACTIVE_STATUS' => 1,
                'UPDATED_BY' => $this->user['USER_ID'],
                'UPDATE_DATE' => date("Y-m-d h:i:s a")
            );
            if ($this->utilities->updateData('ac_academic_charge_rate', $expenses, array('RATE_ID' => $rate_id))) { // update data
                echo "<div class='alert alert-success'>Expense Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Expense Update failed</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Start or End date Already Exist</div>";
        }
    }

    /*
     * @methodName expanseById()
     * @access
     * @param  none
     * @author Nurullah <nurul@atilimited.net>
     * @return Mixed Template
     */

    function expanseById()
    {
        $rate_id = $this->input->post('param');
        $data["previlages"] = $this->checkPrevilege("setup/expense");
        $data["row"] = $this->db->query("SELECT acr.RATE_ID, acr.CHARGE_ID, acr.AMOUNT, acr.START_DATE, acr.END_DATE, acr.ACTIVE_STATUS,
            (SELECT m.LKP_NAME FROM m00_lkpdata m WHERE acr.SEMISTER_ID = m.LKP_ID)SEMESTER,
            (SELECT p.PROGRAM_NAME FROM program p WHERE p.PROGRAM_ID = acr.PROGRAM_ID)PROGRAM,
            (SELECT d.DEPT_NAME FROM department d WHERE d.DEPT_ID = acr.DEPT_ID)DEPARTMENT,
            (SELECT f.FACULTY_NAME FROM faculty f WHERE f.FACULTY_ID = acr.FACULTY_ID)FACULTY,
            (SELECT ac.CHARGE_NAME FROM ac_academic_charge ac WHERE ac.CHARGE_ID = acr.CHARGE_ID)CHARGE_NAME
            FROM ac_academic_charge_rate acr  WHERE acr.RATE_ID = $rate_id")->row();
        $this->load->view('admin/setup/expense/single_expense_row', $data);
    }

    /*
     * @methodName building()
     * @access
     * @author     Abhijit M. Abhi <abhijit@atilimited.net>
     * @param      none
     * @return
     */

    function building()
    {
        $data['contentTitle'] = 'Buildings';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Building List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['buildings'] = $this->setup_model->getAllBuildingInfo();

        //echo "<pre>"; print_r($data['buildings']); exit;

        $data['content_view_page'] = 'admin/setup/building/building_index';
        $this->admin_template->display($data);
    }

    /*
     * @methodName addBuilding()
     * @access
     * @author     Abhijit M. Abhi <abhijit@atilimited.net>
     * @param      none
     * @return
     */

    function addBuilding()
    {
        $data["ac_type"] = 1;
        $data['campus_info'] = $this->db->get_where('sa_campus')->result();
        $data['building_type'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 74));

        //echo "<pre>"; print_r($data['building_type']); exit;

        $this->load->view('admin/setup/building/add_building', $data);
    }

    /*
    * @methodName createBuilding()
    * @access
    * @author     Abhijit M. Abhi <abhijit@atilimited.net>
    * @param      none
    * @return
    */

    function createBuilding()
    {
        $campus_id = $this->input->post('CAMPUS_ID');
        $building_name = $this->input->post('BUILDING_NAME');
        $building_type_id = $this->input->post('BUILDING_TYPE_ID');
        $description = $this->input->post('description');

        $status = ((isset($_POST['status'])) ? 1 : 0);

        $check = $this->utilities->hasInformationByThisId("sa_building", array("building_name" => $building_name, 'CAMPUS_ID' => $campus_id));
        if (empty($check)) {

            $building = array(
                'CAMPUS_ID' => $campus_id,
                'BUILDING_NAME' => $building_name,
                'BUILDING_TYPE' => $building_type_id,
                'DESC' => $description,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );

            if ($this->utilities->insertData($building, 'sa_building')) {
                echo "<div class='alert alert-success'> Create successfully</div>";
            } else {
                echo "<div class='alert alert-danger'> Name insert failed</div>";
            }
        } else {
            echo "<div class='alert alert-danger'> Name Already Exist</div>";
        }
    }

    /*
   * @methodName buildingList()
   * @access
   * @author     Abhijit M. Abhi <abhijit@atilimited.net>
   * @param      none
   * @return
   */

    function buildingList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/building");
        $data['buildings'] = $this->setup_model->getAllBuildingInfo();
        $this->load->view("admin/setup/building/building_list", $data);
    }

    /*
  * @methodName editBuilding()
  * @access
  * @author     Abhijit M. Abhi <abhijit@atilimited.net>
  * @param      none
  * @return
  */

    function editBuilding()
    {
        $data["ac_type"] = 2;
        $id = $this->input->post('param');
        $data['building'] = $this->utilities->findByAttribute('sa_building', array('BUILDING_ID' => $id));
        $data['campus_info'] = $this->db->get_where('sa_campus')->result();
        $data['building_type'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 74));
        //$data['campus'] = $this->db->get_where('sa_campus')->result();

        //echo "<pre>"; print_r($data['campus']); exit;

        $this->load->view('admin/setup/building/add_building', $data);
    }

    /*
  * @methodName updateBuilding()
  * @access
  * @author     Abhijit M. Abhi <abhijit@atilimited.net>
  * @param      none
  * @return
  */

    function updateBuilding()
    {

        $building_id = $this->input->post('BUILDING_ID');

        //echo  $building_type_id; exit;

        $campus_id = $this->input->post('CAMPUS_ID');
        $building_name = $this->input->post('BUILDING_NAME');
        $building_type_id = $this->input->post('BUILDING_TYPE_ID');
        $description = $this->input->post('description');
        $status = ((isset($_POST['status'])) ? 1 : 0);


        $update_building = array(
            'BUILDING_NAME' => $building_name,
            'BUILDING_TYPE' => $building_type_id,
            'DESC' => $description,
            'ACTIVE_STATUS' => $status,
            'CREATED_BY' => $this->user["USER_ID"]
        );

        //echo "<pre>"; print_r($update_building); exit;

        if ($this->utilities->updateData('sa_building', $update_building, array('BUILDING_ID' => $building_id))) {
            echo "<div class='alert alert-success'>Building Update successfully</div>";
        } else {
            echo "<div class='alert alert-danger'>Building Name Update failed</div>";
        }

    }

    /*
      * @methodName buildingById()
      * @access
      * @author     Abhijit M. Abhi <abhijit@atilimited.net>
      * @param      none
      * @return
      */

    function buildingById()
    {
        $building_id = $this->input->post('param');
        $data["previlages"] = $this->checkPrevilege("setup/building");
        $data['row'] = $this->setup_model->getBuildingInfoById($building_id);
        //$data['row'] = $this->utilities->findByAttribute('sa_building', array('BUILDING_ID' => $building_id));
        $this->load->view('admin/setup/building/single_building_row', $data);
    }

    /*
      * @methodName room()
      * @access
      * @author     Abhijit M. Abhi <abhijit@atilimited.net>
      * @param      none
      * @return
      */

    function room()
    {
        $data['contentTitle'] = 'Room';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Room List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['room_info'] = $this->setup_model->getAllRoomInfo();
        $data['content_view_page'] = 'admin/setup/room/room_index';
        $this->admin_template->display($data);
    }

    /*
      * @methodName addRoom()
      * @access
      * @author     Abhijit M. Abhi <abhijit@atilimited.net>
      * @param      none
      * @return
      */

    function addRoom()
    {
        $data["ac_type"] = 1;
        $data["campus"] = $this->utilities->findAllByAttribute("sa_campus", array("ACTIVE_STATUS" => 1));
        $data["building"] = $this->utilities->findAllByAttribute("sa_building", array("ACTIVE_STATUS" => 1));
        $data["building_floor"] = $this->utilities->findAllFromView("building_floor");
        $data["room_type"] = $this->utilities->findAllByAttribute("m00_lkpdata a", array("a.GRP_ID" => 76));   
        $this->load->view('admin/setup/room/add_room', $data);
    }

    /*
     * @methodName createRoom()
     * @access
     * @author      rakib
     * @param  none
     * @return
     */

    function createRoom()
    {
        $campus_id = $this->input->post('CAMPUS_ID');
        $building_id = $this->input->post('BUILDING_ID');
        $floor_id = $this->input->post('FLOOR_ID');
        $room_no = $this->input->post('ROOM_NO');
        $room_name = $this->input->post('ROOM_NAME');
        $room_type = $this->input->post('ROOM_TYPE_ID');
        $description= $this->input->post('description');
        $status = ((isset($_POST['status'])) ? 1 : 0);
        // checking if  with this name is already exist
        $check = $this->utilities->hasInformationByThisId("sa_room a", array("a.CAMPUS_ID" => $campus_id, "a.BUILDING_ID" => $building_id, "a.FLOOR_ID" => $floor_id, "a.ROOM_ID" => $room_no ));
        if (empty($check)) {
            // preparing data to insert
            $building_room = array(
                'CAMPUS_ID' => $campus_id,
                'BUILDING_ID' => $building_id,
                'FLOOR_ID' => $floor_id,
                'ROOM_NO' => $room_no,
                'ROOM_NAME' => $room_name,
                'ROOM_TYPE' => $room_type,
                'DESC' => $description,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );

//            echo "<pre>"; print_r($building_room); exit;

            if ($this->utilities->insertData($building_room, 'sa_room')) {
                echo "<div class='alert alert-success'> Create successfully</div>";
            } else {
                echo "<div class='alert alert-danger'> Room insert failed</div>";
            }
        } else {
            echo "<div class='alert alert-danger'> Room Already Exist</div>";
        }
    }


    /*
     * @methodName   roomList()
     * @access
     * @author       rakib
     * @param        none
     * @return
     */

    function roomList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/room");
        $data['room_info'] = $this->setup_model->getAllRoomInfo();
        $this->load->view("admin/setup/room/room_list", $data);
    }

    /*
     * @methodName   editRoom()
     * @access
     * @author       rakib
     * @param        none
     * @return
     */

    function editRoom()
    {
        $data["ac_type"] = "edit";
        $room_id = $this->input->post('param');
        $data["campus"] = $this->utilities->findAllByAttribute("sa_campus", array("ACTIVE_STATUS" => 1));
        $data["building"] = $this->utilities->findAllByAttribute("sa_building", array("ACTIVE_STATUS" => 1));
        $data["floor"] = $this->utilities->findAllFromView("building_floor");
        $data["room_type"] = $this->utilities->findAllByAttribute("m00_lkpdata a", array("a.GRP_ID" => 76)); 
        $data['previous_info'] = $this->setup_model->getAllRoomByIdInfo($room_id);
        //echo "<pre>";print_r($data['previous_info']);exit();
        $this->load->view('admin/setup/room/add_room', $data);
    }

    /*
     * @methodName   updateRoom()
     * @access
     * @author       rakib
     * @param        none
     * @return
     */

    function updateRoom()
    {   
        $ROOM_ID = $this->input->post('ROOM_ID');
        $campus_id = $this->input->post('CAMPUS_ID');
        $building_id = $this->input->post('BUILDING_ID');
        $floor_id = $this->input->post('FLOOR_ID');
        $room_no = $this->input->post('ROOM_NO');
        $room_name = $this->input->post('ROOM_NAME');
        $room_type = $this->input->post('ROOM_TYPE_ID');
        $description= $this->input->post('description');
        $status = ((isset($_POST['status'])) ? 1 : 0);
        $check = $this->utilities->hasInformationByThisId("sa_room a", array("a.CAMPUS_ID" => $campus_id, "a.BUILDING_ID" => $building_id, "a.FLOOR_ID" => $floor_id, "a.ROOM_ID" => $room_no, "a.ROOM_ID !=" =>$ROOM_ID));

        if (empty($check)) {
            $update_room = array(
                'CAMPUS_ID' => $campus_id,
                'BUILDING_ID' => $building_id,
                'FLOOR_ID' => $floor_id,
                'ROOM_NO' => $room_no,
                'ROOM_NAME' => $room_name,
                'ROOM_TYPE' => $room_type,
                'DESC' => $description,
                'ACTIVE_STATUS' => $status,
                'UPDATE_BY' => $this->user['USER_ID'],
                'UPDATED_DT' => date("Y-m-d h:i:s a")
            );

            if ($this->utilities->updateData('sa_room', $update_room, array('ROOM_ID' => $ROOM_ID))) { // if data update successfully
                echo "<div class='alert alert-success'>Room Update successfully</div>";
            } else {
                echo "<div class='alert alert-danger'>Room Name Update failed</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Room Name Already Exist</div>";
        }
    }

    /*
     * @methodName   roomById()
     * @access
     * @author       rakib
     * @param        none
     * @return
     */

    function roomById()
    {
        $room_id = $this->input->post('param');
        $data["previlages"] = $this->checkPrevilege("setup/room");
        $data['row'] = $this->setup_model->getAllRoomByIdInfo($room_id);
        $this->load->view('admin/setup/room/single_room_row', $data);
    }


    /*
     * @methodName schedule()
     * @access
     * @author     rakib
     * @param        none
     * @return      existing room list
     */

    function schedule()
    {
        $data['contentTitle'] = 'Schedule';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Create Schedule' => '#',
        );
        $data["ac_type"] = 1;
        $data["previlages"] = $this->checkPrevilege();
        $data["eventType"] = $data['rooms'] = $this->utilities->findAllFromView('event_type');
        $data['content_view_page'] = 'admin/setup/course_schedule/add_event';
        $this->admin_template->display($data);
    }

    /*
     * @methodName notice()
     * @access
     * @author      rakib <rakib@atilimited.net>
     * @param        none
     * @return      existing room list
     */

    function notice()
    {
        $data['contentTitle'] = 'Notice';
        $data['breadcrumbs'] = array(
            'Notice' => '#',
            'Notice list' => '#',
        );
        $data["ac_type"] = 1;
        $data["previlages"] = $this->checkPrevilege();
        $data['notice'] = $this->utilities->getAll('notice');
        $data['content_view_page'] = 'admin/setup/notice/notice_index';
        $this->admin_template->display($data);
    }

    /*
     * @methodName addNotice()
     * @access
     * @author      rakib <rakib@atilimited.net>
     * @param        none
     * @return      existing room list
     */

    function addNotice()
    {
        $data['pageTitle'] = 'Create Notice';
        $data['breadcrumbs'] = array(
            'Create Notice ' => '#',
        );
        $data['dimention'] = 'horizental';
        $data["ac_type"] = 'view'; //access type two for common edit view        
        $data['content_view_page'] = 'admin/setup/notice/add_notice';
        $this->admin_template->display($data);
    }

    /*
     * @methodName saveNotice()
     * @access
     * @author      rakib <rakib@atilimited.net>
     * @param        none
     * @return      program  list by dep id
     */

    function saveNotice()
    {
        $file_name = "";
        if (!empty($_FILES)) {

            $this->load->library('upload');
            $this->load->helper('string');
            $config['upload_path'] = 'upload/notice/';
            //$config['allowed_types'] = '*';
            $config['allowed_types'] = '*';
            $config['overwrite'] = false;
            $config['remove_spaces'] = true;
            //$config['max_size']   = '100';// in KB
            $this->upload->initialize($config);
            if ($this->upload->do_upload('N_ATTACHMENT')) {
                $file_data = $this->upload->data();
                $file_name = $file_data['file_name'];
            }
        }
        $data_notice = array(
            'N_TITLE' => $this->input->post('NOTICE_TITLE'),
            'N_DESC' => $this->input->post('NOTICE_DESCRIPTION'),
            'N_ATTACHMENT' => $file_name,
            'START_DATE' => date('Y-m-d', strtotime($this->input->post('START_DATE'))),
            'END_DATE' => date('Y-m-d', strtotime($this->input->post('END_DATE'))), 
            'ACTIVE_STATUS' => $this->input->post('ACTIVE_STATUS'),
            'CREATE_DATE' => date('Y-m-d')
        );
        //echo "<pre>"; print_r($data_notice);exit;

        $this->utilities->insertData($data_notice, 'notice');
        $this->session->set_flashdata('Success', 'Congratulation ! Notice saved successfully.');
        redirect('setup/addNotice', 'refresh');
    }

    /*
     * @methodName editNotice()
     * @access
     * @author      rakib <rakib@atilimited.net>
     * @param        none
     * @return      program  list by dep id
     */

    function editNotice($notice_id)
    {
        $data['pageTitle'] = 'Edit Notice';
        $data['breadcrumbs'] = array(
            'Edit Notice' => '#',
        );
        $data['dimention'] = 'horizental';
        $data["ac_type"] = 'edit'; //access type  for common edit view
        $data['previous_info'] = $this->utilities->findByAttribute('notice', array('NOTICE_ID' => $notice_id));
       
        $data['content_view_page'] = 'admin/setup/notice/edit_notice';
        $this->admin_template->display($data);
    }

    /*
     * @methodName updateNotice()
     * @access
     * @author      rakib <rakib@atilimited.net>
     * @param        none
     * @return      program  list by dep id
     */

    function updateNotice()
    {
        $file_name = "";
        if (!empty($_FILES)) {
            $this->load->library('upload');
            $this->load->helper('string');
            $config['upload_path'] = 'upload/notice/';
            //$config['allowed_types'] = '*';
            $config['allowed_types'] = '*';
            $config['overwrite'] = false;
            $config['remove_spaces'] = true;
            //$config['max_size']   = '100';// in KB
            $this->upload->initialize($config);
            if ($this->upload->do_upload('N_ATTACHMENT')) {
                $file_data = $this->upload->data();
                $file_name = $file_data['file_name'];
            }
        }


        $NOTICE_ID = $this->input->post('NOTICE_ID');
        

        $update_data_notice = array(
            'N_TITLE' => $this->input->post('N_TITLE'),
            'N_DESC' => $this->input->post('N_DESC'),
            'START_DATE' => date('Y-m-d', strtotime($this->input->post('START_DATE'))),
            'END_DATE' => date('Y-m-d', strtotime($this->input->post('END_DATE'))),
            
            'ACTIVE_STATUS' => $this->input->post('ACTIVE_STATUS'),
            'CREATE_DATE' => date('Y-m-d')
        );
        if ($file_name != "") {
            $update_data_notice["N_ATTACHMENT"] = $file_name;
        }
        $this->utilities->updateData('notice', $update_data_notice, array('NOTICE_ID' => $NOTICE_ID));
        $this->session->set_flashdata('Success', 'Congratulation ! Notice updated successfully.');
        redirect('setup/editNotice/' . $NOTICE_ID, 'refresh');
    }

    /*
     * @methodName depByFacId()
     * @access
     * @author      rakib <rakib@atilimited.net>
     * @param        none
     * @return      department list by faulty id
     */

    function depByFacId()
    {
        $faculty_id = $this->input->post('faculty_id');
        // $department = $this->utilities->findByAttribute('department', array('FACULTY_ID' => $faculty_id));
        $query = $this->utilities->findAllByAttribute('department', array("FACULTY_ID" => $faculty_id, "ACTIVE_STATUS" => 1));
        $returnVal = '<option value="" >-Select-</option>';
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value="' . $row->DEPT_ID . '">' . $row->DEPT_NAME . '</option>';
            }
        }
        echo $returnVal;
    }

    /*
     * @methodName proByDepId()
     * @access
     * @author      rakib <rakib@atilimited.net>
     * @param        none
     * @return      program  list by dep id
     */

    function proByDepId()
    {
        $dep_id = $this->input->post('dep_id');
        // $department = $this->utilities->findByAttribute('department', array('FACULTY_ID' => $faculty_id));
        $query = $this->utilities->findAllByAttribute('program', array("DEPT_ID" => $dep_id, "ACTIVE_STATUS" => 1));
        $returnVal = '<option value="" >-Select-</option>';
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value="' . $row->PROGRAM_ID . '">' . $row->PROGRAM_NAME . '</option>';
            }
        }
        echo $returnVal;
    }

    /*
     * @methodName charge()
     * @access
     * @param  none
     * @author Nurullah <nurul@atilimited.net>
     * @return Mixed Template
     */

    function charge()
    {
        $data['contentTitle'] = 'Charge';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Charge List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege(); // for user previlages
        $data["charges"] = $this->utilities->findAllByAttribute('ac_academic_charge', array("")); // select all data from  ac_academic_charge
        $data['content_view_page'] = 'admin/setup/expense/charge_index';
        $this->admin_template->display($data);
    }

    /*
     * @methodName chargeFormInsert()
     * @access
     * @param  none
     * @author Nurullah <nurul@atilimited.net>
     * @return Mixed Template
     */

    function chargeFormInsert()
    {
        $data["ac_type"] = 1; // for insert charge info
        $this->load->view('admin/setup/expense/charge_add', $data);
    }

    /*
     * @methodName createCharge()
     * @access
     * @param  none
     * @author Nurullah <nurul@atilimited.net>
     * @return Mixed Template
     */

    function createCharge()
    {
        $charge_name = $this->input->post('CHARGE_NAME'); // charge name
        $application = $this->input->post('IS_APP_FEE'); // is it application
        $tutoin = $this->input->post('IS_TUTOIN_FEE'); // is it tytoin
        $redundent = $this->input->post('REDUNDENT'); // is it redundent
        $check = $this->utilities->hasInformationByThisId("ac_academic_charge", array("CHARGE_NAME" => $charge_name));
        if (empty($check)) { // if charge name available
            $chargee_name = array(
                'CHARGE_NAME' => $charge_name,
                'IS_APP_FEE' => $application,
                'IS_TUTOIN_FEE' => $tutoin,
                'REDUNDENT' => $redundent,
                'CREATED_BY' => $this->user['USER_ID']
            );
            if ($this->utilities->insertData($chargee_name, 'ac_academic_charge')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Charge Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Charge insert failed</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Charge Name Already Exist</div>";
            // if charge name not available
        }
    }

    /*
     * @methodName getCharge()
     * @access
     * @param  none
     * @author Nurullah <nurul@atilimited.net>
     * @return Mixed Template
     */

    function getCharge()
    {
        $data["previlages"] = $this->checkPrevilege("setup/charge"); // for user previlages
        $data["charges"] = $this->utilities->findAllByAttribute('ac_academic_charge', array("")); //get all data from ac_academic_charge
        $this->load->view("admin/setup/expense/charge_list", $data);
    }

    /*
     * @methodName chargeFormUpdate()
     * @access
     * @param  none
     * @author Nurullah <nurul@atilimited.net>
     * @return Mixed Template
     */

    function chargeFormUpdate()
    {
        $charge_id = $this->input->post('param');
        $data["ac_type"] = 2; //for update course info
        $data['charges'] = $this->utilities->findByAttribute('ac_academic_charge', array("CHARGE_ID" => $charge_id)); // select all data from  ac_academic_charge
        $this->load->view('admin/setup/expense/charge_add', $data);
    }

    /*
     * @methodName updateCharge()
     * @access
     * @param  none
     * @author Nurullah <nurul@atilimited.net>
     * @return Mixed Template
     */

    function updateCharge()
    {
        $charge_id = $this->input->post('CHARGE_ID'); // charge  id hidden value
        $charge_name = $this->input->post('CHARGE_NAME'); // charge name
        $application = $this->input->post('IS_APP_FEE'); // is it application
        $tutoin = $this->input->post('IS_TUTOIN_FEE'); // is it tution
        $redundent = $this->input->post('REDUNDENT'); // is it redundent
        $check = $this->utilities->hasInformationByThisId("ac_academic_charge", array("CHARGE_NAME" => $charge_name, "CHARGE_ID !=" => $charge_id));
        if (empty($check)) {// if charge name available
            // preparing data to update
            $update = array(
                'CHARGE_NAME' => $charge_name,
                'IS_APP_FEE' => $application,
                'IS_TUTOIN_FEE' => $tutoin,
                'REDUNDENT' => $redundent,
                'UPDATED_BY' => $this->user["USER_ID"],
                'UPDATE_DATE' => date("Y-m-d h:i:s a")
            );
            if ($this->utilities->updateData('ac_academic_charge', $update, array('CHARGE_ID' => $charge_id))) { // if data update successfully
                echo "<div class='alert alert-success'>Charge Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Charge Update failed</div>";
            }
        } else {// if course name not available
            echo "<div class='alert alert-danger'>Charge Name Already Exist</div>";
        }
    }

    /*
     * @methodName chargeById()
     * @access
     * @param  none
     * @author Nurullah <nurul@atilimited.net>
     * @return Mixed Template
     */

    function chargeById()
    {
        $charge_id = $this->input->post('param'); // charge id
        $data["previlages"] = $this->checkPrevilege("setup/charge"); // user previlages
        $data["row"] = $this->utilities->findByAttribute('ac_academic_charge', array('CHARGE_ID' => $charge_id)); // get all data from ac_academic_charge by charge_id
        $this->load->view('admin/setup/expense/charge_single_row', $data);
    }

    /*
     * @param  none
     * @author Nurullah <nurul@atilimited.net>
     * @return Mixed Template
     */

    function particular()
    {
        $data['contentTitle'] = 'Program Wise Particular';
        $data['breadcrumbs'] = array(
            'Particular' => '#',
            'Program Wise Particular list' => '#',
        );
        $data['ac_type'] = '';
        $data["previlages"] = $this->checkPrevilege(); // for user previlages
        $data['faculty'] = $this->utilities->findAllByAttribute('faculty', array("ACTIVE_STATUS" => 1, "ADMINISTRATION" => 0));
        $data['dimention'] = "horizental";
        $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
        // select all Session name from  Session
        $data["session"] = $this->utilities->getAll("session_view"); // select all SESSION
        // select all data from  ac_program_particulars
        $data["particular"] = $this->db->query("SELECT sv.*, acp.P_PARTICULAR_ID, acp.PARTICULAR_AMOUNT, acp.ACTIVE_STATUS,
            (SELECT f.FACULTY_NAME FROM faculty f WHERE f.FACULTY_ID = acp.FACULTY_ID)FACULTY,
            (SELECT d.DEPT_NAME FROM department d WHERE d.DEPT_ID = acp.DEPT_ID)DEPARTMENT,
            (SELECT p.PROGRAM_NAME FROM program p WHERE p.PROGRAM_ID = acp.PROGRAM_ID )PROGRAM,
            (SELECT s.SESSION_NAME FROM session s WHERE s.SESSION_ID = acp.SESSION_ID )SESSION,
            (SELECT m.LKP_NAME FROM m00_lkpdata m WHERE m.LKP_ID = acp.SEMESTER_ID )SEMESTER,
            (SELECT ac.CHARGE_NAME FROM ac_academic_charge ac WHERE ac.CHARGE_ID = acp.PARTICULAR_ID)PARTICULER
            FROM ac_program_particulars acp
            INNER JOIN session_view sv on sv.SESSION_ID = acp.SESSION_ID
            ORDER BY acp.P_PARTICULAR_ID DESC")->result();
        $data['content_view_page'] = 'admin/setup/expense/particular_index';
        $this->admin_template->display($data);
    }

    /*
     * @param  none
     * @author Nurullah <nurul@atilimited.net>
     * @return Mixed Template
     */

    function particularFormInsert()
    {
        $data["ac_type"] = 1; // for insert charge info
        $data["faculty"] = $this->utilities->dropdownFromTableWithCondition("faculty", "Select Faculty", "FACULTY_ID", "FACULTY_NAME", array("ACTIVE_STATUS" => 1, "ADMINISTRATION" => 0)); // select all faculty name from  faculty
        $data["semester"] = $this->utilities->dropdownFromTableWithCondition("m00_lkpdata", "Select Semester", "LKP_ID", "LKP_NAME", array("GRP_ID" => 16)); // select all category name from  category
        $data["session"] = $this->utilities->getAll("session_view"); // select all SESSION      
        $this->load->view('admin/setup/expense/particular_add', $data);
    }

    /*
     * @methodName particularFormInsert()
     * @access
     * @param  none
     * @author Nurullah <nurul@atilimited.net>
     * @return Mixed Template
     */

    function particularCharge()
    {
        $cmbFaculty = $this->input->post('cmbFaculty'); // faculty name
        $department = $this->input->post('department'); // department name
        $program = $this->input->post('program'); // programe
        $session = $this->input->post('cmbSession'); // session
        $semester = $this->input->post('cmbSemester'); // semester
        $chkCharge = $this->input->post('charge_id'); // particular id multipul hidden value
        $amount = $this->input->post('charge_amount'); // particuler amount multipul hidden value
        $check = $this->utilities->hasInformationByThisId("ac_program_particulars", array('FACULTY_ID' => $cmbFaculty, 'DEPT_ID' => $department, 'PROGRAM_ID' => $program, 'SESSION_ID' => $session, 'SEMESTER_ID' => $semester));
        if (empty($check)) {// if Program name available
            for ($i = 0; $i < sizeof($chkCharge); $i++) { // multipul data --> get single value
                $particular = array(
                    'FACULTY_ID' => $cmbFaculty,
                    'DEPT_ID' => $department,
                    'PROGRAM_ID' => $program,
                    'SESSION_ID' => $session,
                    'SEMESTER_ID' => $semester,
                    'PARTICULAR_ID' => $chkCharge[$i],
                    'PARTICULAR_AMOUNT' => $amount[$i],
                    'ACTIVE_STATUS' => 1,
                    'CREATED_BY' => $this->user["USER_ID"]
                );
                $success = $this->utilities->insertData($particular, 'ac_program_particulars');
            }
            if ($success) { // if data inserted successfully
                echo "<div class='alert alert-success'>Particular Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Particular insert failed</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Particular Charge Already Exist !!</div>";
        }
    }

    /**
     * @methodName ajax_get_particular_charge()
     * @access
     * @param  none
     * @author Emdadul <emdadul@atilimited.net>
     * @return Mixed Template
     */
    function ajax_get_particular_charge()
    {
        $faculty = $this->input->post('faculty'); // faculty name
        $dept = $this->input->post('department'); // department name
        $program = $this->input->post('program'); // programe
        $semester = $this->input->post('semester'); // semester
        $session = $this->input->post('session'); // session
        $data["chargeList"] = $this->db->query("SELECT app.P_PARTICULAR_ID, acc.CHARGE_NAME, app.PARTICULAR_AMOUNT
            FROM ac_program_particulars app
            LEFT JOIN ac_academic_charge acc on acc.CHARGE_ID = app.PARTICULAR_ID
            WHERE app.FACULTY_ID = $faculty AND app.DEPT_ID =$dept AND app.PROGRAM_ID = $program AND app.SEMESTER_ID = $semester AND app.SESSION_ID = $session
            ORDER BY acc.CHARGE_NAME ASC")->result();
        $this->load->view("admin/setup/expense/ajax_particular_charge", $data);
    }

    /**
     * @methodName getParticular()
     * @access
     * @param  none
     * @author Nurullah <nurul@atilimited.net>
     * @return Mixed Template
     */
    function getChargeList()
    {
        $faculty = $this->input->post('faculty'); // faculty name
        $dept = $this->input->post('dept'); // department name
        $program = $this->input->post('program'); // programe
        $semester = $this->input->post('semester'); // programe
        $data["chargeList"] = $this->db->query("SELECT ac.CHARGE_ID, ac.CHARGE_NAME, acr.*
            FROM ac_academic_charge ac
            INNER JOIN ac_academic_charge_rate acr
            WHERE ac.CHARGE_ID = acr.CHARGE_ID
            AND DATE_FORMAT(acr.START_DATE, '%Y-%m-%d') <= DATE_FORMAT(NOW(), '%Y-%m-%d')
            AND DATE_FORMAT(acr.END_DATE, '%Y-%m-%d') >= DATE_FORMAT(NOW(), '%Y-%m-%d')
            AND acr.FACULTY_ID = $faculty AND acr.DEPT_ID = $dept AND acr.PROGRAM_ID = $program AND acr.SEMISTER_ID = $semester")->result();
        $this->load->view("admin/setup/expense/particular_charge_list", $data);
    }

    /*
     * @methodName getParticular()
     * @access
     * @param  none
     * @author Nurullah <nurul@atilimited.net>
     * @return Mixed Template
     */

    function getParticular()
    {
        $data["previlages"] = $this->checkPrevilege("setup/particular"); // for user previlages
        $data["particular"] = $this->db->query("SELECT sv.*, acp.P_PARTICULAR_ID, acp.PARTICULAR_AMOUNT, acp.ACTIVE_STATUS,
            (SELECT f.FACULTY_NAME FROM faculty f WHERE f.FACULTY_ID = acp.FACULTY_ID)FACULTY,
            (SELECT d.DEPT_NAME FROM department d WHERE d.DEPT_ID = acp.DEPT_ID)DEPARTMENT,
            (SELECT p.PROGRAM_NAME FROM program p WHERE p.PROGRAM_ID = acp.PROGRAM_ID )PROGRAM,
            (SELECT s.SESSION_NAME FROM session s WHERE s.SESSION_ID = acp.SESSION_ID )SESSION,
            (SELECT m.LKP_NAME FROM m00_lkpdata m WHERE m.LKP_ID = acp.SEMESTER_ID )SEMESTER,
            (SELECT ac.CHARGE_NAME FROM ac_academic_charge ac WHERE ac.CHARGE_ID = acp.PARTICULAR_ID)PARTICULER
            FROM ac_program_particulars acp
            INNER JOIN session_year sy on sv.SES_YEAR_ID = acp.SESSION_ID
            ORDER BY acp.P_PARTICULAR_ID DESC")->result(); // select all data from  ac_program_particulars
        $this->load->view("admin/setup/expense/particular_list", $data);
    }

    /*
     * @methodName getParticular()
     * @access
     * @param  none
     * @author Nurullah <nurul@atilimited.net>
     * @return Mixed Template
     */

    function particularFormUpdate()
    {
        $particular_id = $this->input->post('param'); // particuler id
        $data["ac_type"] = 2; //for update course info
        $data["faculty"] = $this->utilities->dropdownFromTableWithCondition("faculty", "Select Faculty", "FACULTY_ID", "FACULTY_NAME", array("ACTIVE_STATUS" => 1, "ADMINISTRATION" => 0)); // select all faculty name from  faculty
        $data["semester"] = $this->utilities->dropdownFromTableWithCondition("m00_lkpdata", "Select Category", "LKP_ID", "LKP_NAME", array("GRP_ID" => 16)); // select all semester name from  category
        $data["session"] = $this->db->query("SELECT sy.SES_YEAR_ID, s.SESSION_NAME, ys.YEAR_SETUP_TITLE
            FROM session_year sy
            LEFT JOIN session s on s.SESSION_ID = sy.SESSION
            LEFT JOIN year_setup ys on ys.YEAR_SETUP_ID = sy.YEAR_SETUP_ID
                                            ")->result(); // select all Session name from  Session
        $data["chargeList"] = $this->db->query("SELECT ac.CHARGE_ID, ac.CHARGE_NAME, acr.*
            FROM ac_academic_charge ac
            INNER JOIN ac_academic_charge_rate acr
            WHERE ac.CHARGE_ID = acr.CHARGE_ID
            AND DATE_FORMAT(acr.START_DATE, '%Y-%m-%d') <= DATE_FORMAT(NOW(), '%Y-%m-%d')
            AND DATE_FORMAT(acr.END_DATE, '%Y-%m-%d') >= DATE_FORMAT(NOW(), '%Y-%m-%d')
            AND acr.FACULTY_ID = $faculty AND acr.DEPT_ID = $dept AND acr.PROGRAM_ID = $program")->result();
        // get all data from ac_academic_charge and ac_academic_charge_rate Where current date must be start_sate and end date rang .
        $data['particular'] = $this->db->query("SELECT acp.P_PARTICULAR_ID, acp.SESSION_ID, acp.PARTICULAR_AMOUNT, acp.ACTIVE_STATUS,acp.PARTICULAR_ID,
            acp.FACULTY_ID, acp.DEPT_ID, acp.PROGRAM_ID, acp.SESSION_ID, acp.SEMESTER_ID, sy.SES_YEAR_ID, ys.YEAR_SETUP_ID, d.DEPT_NAME, p.PROGRAM_NAME, s.SESSION_NAME, ys.YEAR_SETUP_TITLE
            FROM ac_program_particulars acp
            LEFT JOIN department d on d.DEPT_ID = acp.DEPT_ID
            LEFT JOIN program p on p.PROGRAM_ID = acp.PROGRAM_ID
            LEFT JOIN session_year sy on sy.SES_YEAR_ID = acp.SESSION_ID
            LEFT JOIN session s on s.SESSION_ID = sy.SESSION
            LEFT JOIN year_setup ys on ys.YEAR_SETUP_ID = sy.SES_YEAR_ID
                                                WHERE acp.P_PARTICULAR_ID =  $particular_id")->row(); // select all data from  ac_academic_charge
        $this->load->view('admin/setup/expense/particular_add', $data);
    }

    function updateParticular()
    {
        $particular_id = $this->input->post('txtParticularID'); // charge  id hidden value
        $cmbFaculty = $this->input->post('cmbFaculty'); // faculty name
        $department = $this->input->post('department'); // department name
        $program = $this->input->post('program'); // programe
        $session = $this->input->post('cmbSession'); // session
        $semester = $this->input->post('cmbSemester'); // semester
        $chkCharge = $this->input->post('charge_id'); // particular id multipul hidden value
        $amount = $this->input->post('charge_amount'); // particuler amount multipul hidden value
        for ($i = 0; $i < sizeof($chkCharge); $i++) { // multipul data --> get single value
            $particular = array(
                'FACULTY_ID' => $cmbFaculty,
                'DEPT_ID' => $department,
                'PROGRAM_ID' => $program,
                'SESSION_ID' => $session,
                'SEMESTER_ID' => $semester,
                'PARTICULAR_ID' => $chkCharge[$i],
                'PARTICULAR_AMOUNT' => $amount[$i],
                'ACTIVE_STATUS' => 1,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            $success = $this->utilities->updateData('ac_program_particulars', $particular, array('P_PARTICULAR_ID' => $particular_id));
        }
        if ($success) { // if data update successfully
            echo "<div class='alert alert-success'>Particular Update successfully</div>";
        } else { // if data update failed
            echo "<div class='alert alert-danger'>Particular Update failed</div>";
        }
    }

    function particulerById()
    {
        $particular_id = $this->input->post('param'); // particular id
        $data["previlages"] = $this->checkPrevilege("setup/particular"); // user previlages
        $data["row"] = $this->db->query("SELECT acp.P_PARTICULAR_ID, acp.PARTICULAR_AMOUNT, acp.ACTIVE_STATUS,
            (SELECT f.FACULTY_NAME FROM faculty f WHERE f.FACULTY_ID = acp.FACULTY_ID)FACULTY,
            (SELECT d.DEPT_NAME FROM department d WHERE d.DEPT_ID = acp.DEPT_ID)DEPARTMENT,
            (SELECT p.PROGRAM_NAME FROM program p WHERE p.PROGRAM_ID = acp.PROGRAM_ID )PROGRAM,
            (SELECT s.SESSION_NAME FROM session s WHERE s.SESSION_ID = acp.SESSION_ID )SESSION,
            (SELECT m.LKP_NAME FROM m00_lkpdata m WHERE m.LKP_ID = acp.SEMESTER_ID )SEMESTER,
            (SELECT ac.CHARGE_NAME FROM ac_academic_charge ac WHERE ac.CHARGE_ID = acp.PARTICULAR_ID)PARTICULER
            FROM ac_program_particulars acp WHERE acp.P_PARTICULAR_ID = $particular_id")->row();
// get single data from ac_program_particulars where P_PARTICULAR_ID = id
        $this->load->view('admin/setup/expense/particular_single_row', $data);
    }

    /*
     * @methodName union()
     * @access
     * @author      jakir <jakir@atilimited.net>
     * @param        none
     * @return      program  list by dep id
     */

    function union()
    {
        $data['contentTitle'] = 'Union';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Union List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['union'] = $this->db->query("select * from sa_unions")->result();
        $data['content_view_page'] = 'admin/setup/union/union_index';
        $this->admin_template->display($data);
    }

    function unionFormInsert()
    {
        $data["ac_type"] = 1;
        $data["thana"] = $this->utilities->dropdownFromTableWithCondition("sa_thanas", "Select Thana", "THANA_ID", "THANA_ENAME", array("ACTIVE_FLAG" => 1));
        $this->load->view('admin/setup/union/add_union', $data);
    }

    function createUnion()
    {
        $union = $this->input->post('unionName'); // union name
        $thana = $this->input->post('thana');
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if union with this name is already exist
        $check = $this->utilities->hasInformationByThisId("sa_unions", array("UNION_NAME" => $union));
        if (empty($check)) {// if union name available
            // preparing data to insert
            $union = array(
                'UNION_NAME' => $union,
                'THANA_ID' => $thana,
                'ACTIVE_FLAG' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->insertData($union, 'sa_unions')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Union Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Union Name insert failed</div>";
            }
        } else {// if Union name not available
            echo "<div class='alert alert-danger'>Union Name Already Exist</div>";
        }
    }

    function unionList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/union");
        $data['union'] = $this->db->query("SELECT U.UNION_ID UNION_ID,U.UNION_NAME UNION_NAME,
         U.ACTIVE_FLAG ACTIVE_FLAG,O.POST_OFFICE_ENAME POST_OFFICE_ENAME,
         O.THANA_ID,S.THANA_ENAME THANA_ENAME,D.DISTRICT_ENAME DISTRICT_ENAME
         FROM sa_unions U,sa_post_offices O,sa_thanas S,sa_districts D
         WHERE U.THANA_ID=O.THANA_ID
         AND O.THANA_ID=S.THANA_ID
         AND S.DISTRICT_ID =D.DISTRICT_ID
         and D.DISTRICT_ID=12")->result();
        $this->load->view("admin/setup/union/union_list", $data);
    }

     public function ajaxUnionList()
    {

        $columns = array( 
            0 =>'THANA_ID', 
            1 =>'UD_UNION_CODE',
            2=> 'UNION_NAME',
            3 =>'ORDER_SL',
            4 =>'ACTIVE_FLAG', 

        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData =  
        $query = $this
                ->db
                ->get('sa_unions');
    
        return $query->num_rows();

        $totalFiltered = $totalData; 

        if(empty($this->input->post('search')['value']))
        {                   
            $posts = $this->course_model->allCourse($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value'];
            $posts =  $this->course_model->posts_search($limit,$start,$search,$order,$dir)[0];
            $totalFiltered = $this->course_model->posts_search($limit,$start,$search,$order,$dir)[1];
        }

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
                $nestedData['COURSE_ID'] = $post->COURSE_ID;
                $nestedData['COURSE_CODE'] = $post->COURSE_CODE;
                $nestedData['COURSE_TITLE'] = $post->COURSE_TITLE;
                $nestedData['DEPT_NAME'] = $post->DEPT_NAME;
                $nestedData['ACTION'] ="

                <a class='label label-info openBigModal' 
                id='$post->COURSE_ID'   data-action='course/courseInfo' 
                data-type='edit' title='Course Information'><i class='fa fa-eye'></i>
                </a>&nbsp;  

                <a class='label label-default openModal' id='$post->COURSE_ID'
                title='Update Course Information' data-action='course/courseFormUpdate' 
                data-type='edit'><i class='fa fa-pencil'></i>
                </a>&nbsp;
                <a class='label label-danger deleteCourse' 
                id='$post->COURSE_ID'  title='Click For 
                Delete' data-action='setup/deleteDegree' 
                data-type='delete' data-field='COURSE_ID' 
                data-tbl='aca_course'><i class='fa fa-times'></i>
                </a>

                ";




                //$nestedData['body'] = substr(strip_tags($post->body),0,50)."...";
               // $nestedData['created_at'] = date('j M Y h:i a',strtotime($post->created_at));
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );        

        echo json_encode($json_data); 
    }

    function unionFormUpdate()
    {
        $data["ac_type"] = 2;
        $id = $this->input->post('param'); // union ID
        $data['union'] = $this->utilities->findByAttribute('sa_unions', array('UNION_ID' => $id)); // select all data from union where union id
        $data["thana"] = $this->utilities->dropdownFromTableWithCondition("sa_thanas", "Select Thana", "THANA_ID", "THANA_ENAME", array("ACTIVE_FLAG" => 1));
        $this->load->view('admin/setup/union/add_union', $data);
    }

    function updateUnion()
    {
        //        echo "<pre>";
        //        print_r($_POST);
        //        exit;
        $union_id = $this->input->post('txtUnionId'); // union name
        $unionName = $this->input->post('unionName'); // union name
        $thana = $this->input->post('thana');
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if union with this name is already exist
        $check = $this->utilities->hasInformationByThisId("sa_unions", array("UNION_NAME" => $unionName, "UNION_ID !=" => $union_id));
        if (empty($check)) {// if union name available
            // preparing data to insert
            $union = array(
                'UNION_NAME' => $unionName,
                'THANA_ID' => $thana,
                'ACTIVE_FLAG' => $status,
                'UPDATED_BY' => $this->user['USER_ID'],
                'UPDATE_DATE' => date("Y-m-d h:i:s a")
            );
            //var_dump($union); exit();
            if ($this->utilities->updateData('sa_unions', $union, array('UNION_ID' => $union_id))) { // if data update successfully
                echo "<div class='alert alert-success'>Union  Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Union  Name Update failed</div>";
            }
        } else {// if Union name not available
            echo "<div class='alert alert-danger'>Union Name Already Exist</div>";
        }
    }

    function unionById()
    {
        $union_id = $this->input->post('param'); // union name
        $data["previlages"] = $this->checkPrevilege("setup/union");
        $data['row'] = $this->db->query("SELECT U.UNION_ID UNION_ID,U.UNION_NAME UNION_NAME,
         U.ACTIVE_FLAG ACTIVE_FLAG,O.POST_OFFICE_ENAME POST_OFFICE_ENAME,
         O.THANA_ID,S.THANA_ENAME THANA_ENAME,D.DISTRICT_ENAME DISTRICT_ENAME
         FROM sa_unions U,sa_post_offices O,sa_thanas S,sa_districts D
         WHERE U.THANA_ID=O.THANA_ID
         AND O.THANA_ID=S.THANA_ID
         AND S.DISTRICT_ID =D.DISTRICT_ID
         and UNION_ID=$union_id")->row();
        $this->load->view('admin/setup/union/single_union_row', $data);
    }

    /*
     * @methodName postoffice()
     * @access
     * @author      jakir <jakir@atilimited.net>
     * @param        none
     * @return      program  list by dep id
     */

    function postoffice()
    {
        $data['contentTitle'] = 'Post Office';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Post Office List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['postoffice'] = $this->db->query("SELECT P.POST_OFFICE_ID POST_OFFICE_ID,
         P.ACTIVE_FLAG ACTIVE_FLAG,P.POST_OFFICE_ENAME POST_OFFICE_ENAME,
         P.POST_CODE POST_CODE,T.THANA_ENAME THANA_ENAME,
         T.THANA_ID ,D.DISTRICT_ENAME DISTRICT_ENAME
         FROM sa_post_offices  P ,sa_thanas T,sa_districts D
         WHERE P.THANA_ID=T.THANA_ID
         AND T.DISTRICT_ID=D.DISTRICT_ID")->result();
        //echo "<pre>"; print_r( $data['postoffice']); exit; echo "</pre>";
        $data['content_view_page'] = 'admin/setup/postoffice/postoffice_index';
        $this->admin_template->display($data);
    }

    function postofficeFormInsert()
    {
        $data["ac_type"] = 1;
        $data["district"] = $this->utilities->dropdownFromTableWithCondition("sa_districts", "Select District", "DISTRICT_ID", "DISTRICT_ENAME", array("ACTIVE_FLAG" => 1));
        $data["thana"] = $this->utilities->dropdownFromTableWithCondition("sa_thanas", "Select Thana", "THANA_ID", "THANA_ENAME", array("ACTIVE_FLAG" => 1));
        $this->load->view('admin/setup/postoffice/add_postoffice', $data);
    }

    function createPostoffice()
    {
        $postoffice = $this->input->post('PostofficeName'); // postoffice name
        $postcode = $this->input->post('PostcodeName'); // Postcode
        $thana = $this->input->post('thana');
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if postoffice with this name is already exist
        $check = $this->utilities->hasInformationByThisId("sa_postoffices", array("POST_OFFICE_ENAME" => $postoffice));
        if (empty($check)) {// if postoffice name available
            // preparing data to insert
            $postoffice = array(
                'POST_OFFICE_ENAME' => $postoffice,
                'POST_CODE' => $postcode,
                'THANA_ID' => $thana,
                'ACTIVE_FLAG' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->insertData($postoffice, 'sa_postoffices')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Postoffice Create successfully <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Postoffice Name insert failed</div>";
            }
        } else {// if Postoffice name not available
            echo "<div class='alert alert-danger'>Postoffice Name Already Exist</div>";
        }
    }

    function postofficeList()
    {
        $data['postoffice'] = $this->db->query("SELECT P.POST_OFFICE_ID POST_OFFICE_ID,
         P.ACTIVE_FLAG ACTIVE_FLAG,P.POST_OFFICE_ENAME POST_OFFICE_ENAME,
         P.POST_CODE POST_CODE,T.THANA_ENAME THANA_ENAME,
         T.THANA_ID ,D.DISTRICT_ENAME DISTRICT_ENAME
         FROM sa_postoffices P ,sa_thanas T,sa_districts D
         WHERE P.THANA_ID=T.THANA_ID
         AND T.DISTRICT_ID=D.DISTRICT_ID")->result();
        $data['content_view_page'] = 'admin/setup/postoffice/postoffice_index';
        $this->load->view("admin/setup/postoffice/postoffice_list", $data);
    }

    function postofficeFormUpdate()
    {
        $data["ac_type"] = 2;
        $id = $this->input->post('param'); // postoffice ID
        $data["district"] = $this->utilities->dropdownFromTableWithCondition("sa_districts", "Select District", "DISTRICT_ID", "DISTRICT_ENAME", array("ACTIVE_FLAG" => 1));
        $data['postoffice'] = $this->db->query("SELECT po.*,  sd.DISTRICT_ID, st.THANA_ENAME FROM sa_post_offices po
            LEFT JOIN sa_thanas st on st.THANA_ID = po.THANA_ID
            LEFT JOIN sa_districts sd on sd.DISTRICT_ID = st.DISTRICT_ID
                                                WHERE po.POST_OFFICE_ID = $id")->row(); // select all data from postoffice where postoffice id
        $data["thana"] = $this->utilities->dropdownFromTableWithCondition("sa_thanas", "Select Thana", "THANA_ID", "THANA_ENAME", array("ACTIVE_FLAG" => 1));
        $this->load->view('admin/setup/postoffice/add_postoffice', $data);
    }

    function updatePostoffice()
    {
        //        echo "<pre>";
        //        print_r($_POST);
        //        exit;
        $post_office_id = $this->input->post('txtPostofficeId'); // postoffice name
        $postofficeName = $this->input->post('PostofficeName'); // postoffice name
        $postcode = $this->input->post('PostcodeName'); // postcode
        $thana = $this->input->post('thana');
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if postoffice with this name is already exist
        $check = $this->utilities->hasInformationByThisId("sa_post_offices", array("POST_OFFICE_ENAME" => $postofficeName, "POST_OFFICE_ID !=" => $post_office_id));
        if (empty($check)) {// if postoffice name available
            // preparing data to insert
            $postoffice = array(
                'POST_OFFICE_ENAME' => $postofficeName,
                'POST_CODE ' => $postcode,
                'THANA_ID' => $thana,
                'ACTIVE_FLAG' => $status,
                'UPDATED_BY' => $this->user['USER_ID'],
                'UPDATE_DATE' => date("Y-m-d h:i:s a")
            );
            //var_dump($postoffice); exit();
            if ($this->utilities->updateData('sa_post_offices', $postoffice, array('POST_OFFICE_ID' => $post_office_id))) { // if data update successfully
                echo "<div class='alert alert-success'>Post Office  Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Post Office  Name Update failed</div>";
            }
        } else {// if Post Office name not available
            echo "<div class='alert alert-danger'>Post Office Name Already Exist</div>";
        }
    }

    function postofficeById()
    {
        $post_office_id = $this->input->post('param'); // union name
        $data["previlages"] = $this->checkPrevilege("setup/union");
        $data['row'] = $this->db->query("SELECT P.POST_OFFICE_ID POST_OFFICE_ID,
         P.ACTIVE_FLAG ACTIVE_FLAG,P.POST_OFFICE_ENAME POST_OFFICE_ENAME,
         P.POST_CODE POST_CODE,T.THANA_ENAME THANA_ENAME,
         T.THANA_ID ,D.DISTRICT_ENAME DISTRICT_ENAME
         FROM sa_post_offices P ,sa_thanas T,sa_districts D
         WHERE P.THANA_ID=T.THANA_ID
         AND T.DISTRICT_ID=D.DISTRICT_ID
         and POST_OFFICE_ID = $post_office_id")->row();
        $this->load->view('admin/setup/postoffice/single_postoffice_row', $data);
    }

    /*
     * @methodName thana()
     * @access
     * @author      jakir <jakir@atilimited.net>
     * @param        none
     * @return      program  list by dep id
     */

    function thana()
    {
        $data['contentTitle'] = 'Thana';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Thana List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['thana'] = $this->utilities->findAllByAttributeWithJoin("sa_thanas", "sa_districts", "DISTRICT_ID", "DISTRICT_ID", "DISTRICT_ENAME", array(""));
        $data['content_view_page'] = 'admin/setup/thana/thana_index';
        $this->admin_template->display($data);
    }

    function thanaFormInsert()
    {
        $data["ac_type"] = 1;
        $data["district"] = $this->utilities->dropdownFromTableWithCondition("sa_districts", "Select District", "DISTRICT_ID", "DISTRICT_ENAME", array("ACTIVE_FLAG" => 1));
        $this->load->view('admin/setup/thana/add_thana', $data);
    }

    function createThana()
    {
        $thana = $this->input->post('thanaName'); // thana name
        $district = $this->input->post('district');
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if thana with this name is already exist
        $check = $this->utilities->hasInformationByThisId("sa_thanas", array("THANA_ENAME" => $thana));
        if (empty($check)) {// if thana name available
            // preparing data to insert
            $thana = array(
                'THANA_ENAME' => $thana,
                'DISTRICT_ID' => $district,
                'ACTIVE_FLAG' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->insertData($thana, 'sa_thanas')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Thana Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Thana Name insert failed</div>";
            }
        } else {// if Thana name not available
            echo "<div class='alert alert-danger'>Thana Name Already Exist</div>";
        }
    }

    function thanaList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/thana");
        $data['thana'] = $this->utilities->findAllByAttributeWithJoin("sa_thanas", "sa_districts", "DISTRICT_ID", "DISTRICT_ID", "DISTRICT_ENAME", array(""));
        $this->load->view("admin/setup/thana/thana_list", $data);
    }

    function thanaFormUpdate()
    {
        $data["ac_type"] = 2;
        $id = $this->input->post('param'); // thana ID
        $data['thana'] = $this->utilities->findByAttribute('sa_thanas', array('THANA_ID' => $id)); // select all data from thana where thana id
        $data["district"] = $this->utilities->dropdownFromTableWithCondition("sa_districts", "Select District", "DISTRICT_ID", "DISTRICT_ENAME", array("ACTIVE_FLAG" => 1));
        $this->load->view('admin/setup/thana/add_thana', $data);
    }

    function updateThana()
    {
//        echo "<pre>";
//        print_r($_POST);
//        exit;
        $thana_id = $this->input->post('txtThanaId'); // thana name
        $thanaName = $this->input->post('thanaName'); // thana name
        $district = $this->input->post('district');
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if thana with this name is already exist
        $check = $this->utilities->hasInformationByThisId("sa_thanas", array("THANA_ENAME" => $thanaName, "THANA_ID !=" => $thana_id));
        if (empty($check)) {// if thana name available
            // preparing data to insert
            $district = array(
                'THANA_ENAME' => $thanaName,
                'DISTRICT_ID' => $district,
                'ACTIVE_FLAG' => $status,
                'UPDATED_BY' => $this->user['USER_ID'],
                'UPDATE_DATE' => date("Y-m-d h:i:s a")
            );
            //var_dump($thana); exit();
            if ($this->utilities->updateData('sa_thanas', $district, array('THANA_ID' => $thana_id))) { // if data update successfully
                echo "<div class='alert alert-success'>Thana  Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Thana  Name Update failed</div>";
            }
        } else {// if Thana name not available
            echo "<div class='alert alert-danger'>Thana Name Already Exist</div>";
        }
    }

    function thanaById()
    {
        $thana_id = $this->input->post('param'); // thana name
        $data["previlages"] = $this->checkPrevilege("setup/thana");
        $data['row'] = $this->utilities->findByAttribute('sa_thanas', array('THANA_ID' => $thana_id)); // select all data from thana where thana id
        $data['row'] = $this->utilities->findByAttributeWithJoin("sa_thanas", "sa_districts", "DISTRICT_ID", "DISTRICT_ID", "DISTRICT_ENAME", array("THANA_ID" => $thana_id));
        $this->load->view('admin/setup/thana/single_thana_row', $data);
    }

    /*
     * @methodName district()
     * @access
     * @author      jakir <jakir@atilimited.net>
     * @param        none
     * @return      program  list by dep id
     */

    function district()
    {
        $data['contentTitle'] = 'District';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'District List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        //print_r($data["previlages"]);
        //$data['district'] = $this->utilities->findAllFromView('sa_districts');
        $data['district'] = $this->utilities->findAllByAttributeWithJoin("sa_districts", "sa_divisions", "DIVISION_ID", "DIVISION_ID", "DIVISION_ENAME", array(""));
        $data['content_view_page'] = 'admin/setup/district/district_index';
        $this->admin_template->display($data);
    }

    function districtFormInsert()
    {
        $data["ac_type"] = 1;
        $data["division"] = $this->utilities->dropdownFromTableWithCondition("sa_divisions", "Select Division", "DIVISION_ID", "DIVISION_ENAME", array("ACTIVE_FLAG" => 1));
        $this->load->view('admin/setup/district/add_district', $data);
    }

    function createDistrict()
    {
        $district = $this->input->post('districtName'); // district name
        $division = $this->input->post('division');
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if district with this name is already exist
        $check = $this->utilities->hasInformationByThisId("sa_districts", array("DISTRICT_ENAME" => $district));
        if (empty($check)) {// if district name available
            // preparing data to insert
            $district = array(
                'DISTRICT_ENAME' => $district,
                'DIVISION_ID' => $division,
                'ACTIVE_FLAG' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->insertData($district, 'sa_districts')) { // if data inserted successfully
                echo "<div class='alert alert-success'>District Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>District Name insert failed</div>";
            }
        } else {// if District name not available
            echo "<div class='alert alert-danger'>District Name Already Exist</div>";
        }
    }

    function districtList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/district");
        $data['district'] = $this->utilities->findAllByAttributeWithJoin("sa_districts", "sa_divisions", "DIVISION_ID", "DIVISION_ID", "DIVISION_ENAME", array(""));
        $this->load->view("admin/setup/district/district_list", $data);
    }

    function districtFormUpdate()
    {
        $data["ac_type"] = 2;
        $id = $this->input->post('param'); // district ID
        $data['district'] = $this->utilities->findByAttribute('sa_districts', array('DISTRICT_ID' => $id)); // select all data from district where district id
        $data["division"] = $this->utilities->dropdownFromTableWithCondition("sa_divisions", "Select Division", "DIVISION_ID", "DIVISION_ENAME", array("ACTIVE_FLAG" => 1));
        $this->load->view('admin/setup/district/add_district', $data);
    }

    function updateDistrict()
    {
//        echo "<pre>";
//        print_r($_POST);
//        exit;
        $district_id = $this->input->post('txtDistrictId'); // division name
        $districtName = $this->input->post('districtName'); // division name
        $division = $this->input->post('division');
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if division with this name is already exist
        $check = $this->utilities->hasInformationByThisId("sa_districts", array("DISTRICT_ENAME" => $districtName, "DISTRICT_ID !=" => $district_id));
        if (empty($check)) {// if division name available
            // preparing data to insert
            $division = array(
                'DISTRICT_ENAME' => $districtName,
                'DIVISION_ID' => $division,
                'ACTIVE_FLAG' => $status,
                'UPDATED_BY' => $this->user['USER_ID'],
                'UPDATE_DATE' => date("Y-m-d h:i:s a")
            );
            //var_dump($division); exit();
            if ($this->utilities->updateData('sa_districts', $division, array('DISTRICT_ID' => $district_id))) { // if data update successfully
                echo "<div class='alert alert-success'>District  Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>District  Name Update failed</div>";
            }
        } else {// if District name not available
            echo "<div class='alert alert-danger'>District Name Already Exist</div>";
        }
    }

    function districtById()
    {
        $district_id = $this->input->post('param'); // district name
        $data["previlages"] = $this->checkPrevilege("setup/district");
        $data['row'] = $this->utilities->findByAttribute('sa_districts', array('DISTRICT_ID' => $district_id)); // select all data from district where district id
        $data['row'] = $this->utilities->findByAttributeWithJoin("sa_districts", "sa_divisions", "DIVISION_ID", "DIVISION_ID", "DIVISION_ENAME", array("DISTRICT_ID" => $district_id));
        $this->load->view('admin/setup/district/single_district_row', $data);
    }

    /*
     * @methodName division()
     * @access
     * @param  none
     * @return Mixed Template
     */

    function division()
    {
        $data['contentTitle'] = 'Division';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Division List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        //print_r($data["previlages"]);
        $data['division'] = $this->utilities->findAllFromView('sa_divisions');
        // select all data from sa_divisions
        $data['content_view_page'] = 'admin/setup/division/division_index';
        $this->admin_template->display($data);
    }

    function divisionFormInsert()
    {
        $data["ac_type"] = 1;
        $this->load->view('admin/setup/division/add_division', $data);
    }

    function createDivision()
    {
        $division = $this->input->post('divisionName'); // division name
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if division with this name is already exist
        $check = $this->utilities->hasInformationByThisId("sa_divisions", array("DIVISION_ENAME" => $division));
        if (empty($check)) {// if division name available
            // preparing data to insert
            $division = array(
                'DIVISION_ENAME' => $division,
                'ACTIVE_FLAG' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->insertData($division, 'sa_divisions')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Division Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Division Name insert failed</div>";
            }
        } else {// if Division name not available
            echo "<div class='alert alert-danger'>Division Name Already Exist</div>";
        }
    }

    function updateDivision()
    {
//        echo "<pre>";
//        print_r($_POST);
//        exit;
        $division_id = $this->input->post('txtDivisionId'); // division name
        $divisionName = $this->input->post('divisionName'); // division name
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if division with this name is already exist
        $check = $this->utilities->hasInformationByThisId("sa_divisions", array("DIVISION_ENAME" => $divisionName, "DIVISION_ID !=" => $division_id));

        if (empty($check)) {// if division name available
            // preparing data to insert
            $division = array(
                'DIVISION_ENAME' => $divisionName,
                'ACTIVE_FLAG' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            //var_dump($division); exit();
            if ($this->utilities->updateData('sa_divisions', $division, array('DIVISION_ID' => $division_id))) { // if data update successfully
                echo "<div class='alert alert-success'>Division  Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Division  Name Update failed</div>";
            }
        } else {// if division name not available
            echo "<div class='alert alert-danger'>Division Name Already Exist</div>";
        }
    }

    function divisionById()
    {
        $division_id = $this->input->post('param'); // district name
        $data["previlages"] = $this->checkPrevilege("setup/division");
        $data['row'] = $this->utilities->findByAttribute('sa_divisions', array('DIVISION_ID' => $division_id)); // select all data from district where district id

        $this->load->view('admin/setup/division/single_division_row', $data);
    }

    function divisionList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/division");
        $data['division'] = $this->utilities->findAllFromView('division'); // select all data from division
        $this->load->view("admin/setup/division/division_list", $data);
    }

    function divisionFormUpdate()
    {
        $data["ac_type"] = 2;
        $id = $this->input->post('param'); // division ID
        $data['division'] = $this->utilities->findByAttribute('sa_divisions', array('DIVISION_ID' => $id)); // select all data from division where division id
        $this->load->view('admin/setup/division/add_division', $data);
    }

    function extraActivityType()
    {
        $data['contentTitle'] = 'Extra Activity';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Extra Activity List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['extraActivityType'] = $this->utilities->findAllFromView('extra_activity_type');
        $data['content_view_page'] = 'admin/setup/extraActivityType/extraActivityType_index';
        $this->admin_template->display($data);
    }

    function extraActivityTypeList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/extraActivityType");
        $data['extraActivityType'] = $this->utilities->findAllFromView('extra_activity_type');
        $this->load->view("admin/setup/extraActivityType/extraActivityType_list", $data);
    }

    function extraActivityTypeFormInsert()
    {
        $data["ac_type"] = 1;
        $this->load->view('admin/setup/extraActivityType/add_extraActivityType', $data);
    }

    function createExtraActivityType()
    {
        $extraActivityType = $this->input->post('extraActivityTypeName');
        $status = ((isset($_POST['status'])) ? 1 : 0);
        $check = $this->utilities->hasInformationByThisId("extra_activity_type", array("ACTIVITY_NAME" => $extraActivityType));
        if (empty($check)) {
            $extraActivityType = array(
                'ACTIVITY_NAME' => $extraActivityType,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->insertData($extraActivityType, 'extra_activity_type')) {
                echo "<div class='alert alert-success'>Extra Activity Create successfully</div>";
            } else {
                echo "<div class='alert alert-danger'>Extra Activity  Name insert failed</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Extra Activity  Name Already Exist</div>";
        }
    }

    function extraActivityTypeFormUpdate()
    {
        $data["ac_type"] = 2;
        $id = $this->input->post('param');
        $data['extraActivityType'] = $this->utilities->findByAttribute('extra_activity_type', array('ACTIVITY_TYPE_ID' => $id));
        $this->load->view('admin/setup/extraActivityType/add_extraActivityType', $data);
    }

    function updateExtraActivityType()
    {
        $extraActivityType_id = $this->input->post('txtExtraActivityType');
        $extraActivityType = $this->input->post('extraActivityTypeName');
        $status = ((isset($_POST['status'])) ? 1 : 0);
        $check = $this->utilities->hasInformationByThisId("extra_activity_type", array("ACTIVITY_NAME" => $extraActivityType, "ACTIVITY_TYPE_ID !=" => $extraActivityType_id));

        if (empty($check)) {
            $extraActivityType = array(
                'ACTIVITY_NAME' => $extraActivityType,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->updateData('extra_activity_type', $extraActivityType, array('ACTIVITY_TYPE_ID' => $extraActivityType_id))) {
                echo "<div class='alert alert-success'>Division  Update successfully</div>";
            } else {
                echo "<div class='alert alert-danger'>Division  Name Update failed</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Division Name Already Exist</div>";
        }
    }

    function extraActivityTypeById()
    {
        $extraActivityType_id = $this->input->post('param'); // district name
        $data["previlages"] = $this->checkPrevilege("setup/extraActivityType");
        $data['row'] = $this->utilities->findByAttribute('extra_activity_type', array('ACTIVITY_TYPE_ID' => $extraActivityType_id));
        $this->load->view('admin/setup/extraActivityType/single_extraActivityType_row', $data);
    }

    /*
     * @methodName weekendHoliDays()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return holiday index page
     */

    function weekendHoliDays()
    {
        $data['pageTitle'] = 'View All Weekend Holiday';
        $data['breadcrumbs'] = array(
            'All Event List' => '#',
        );
        $data['holiday'] = $this->db->query("SELECT e.EVENT_ID, e.E_TITLE, e.START_DT, e.END_DT, e.ACTIVE_STATUS,
            (SELECT t.E_COM_TITLE FROM event_type t WHERE t.E_TYPE_ID = e.E_TYPE_ID)type FROM event e")->result();
        $data['content_view_page'] = 'admin/setup/holiday/holiday_index';
        $this->admin_template->display($data);
    }

    /*
     * @methodName getDateForSpecificDayBetweenDates()
     * @access
     * @param  StartDate, endDate, WeekdayNumber
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Weekend date
     */

    public function getDateForSpecificDayBetweenDates($start, $end, $weekday = 0)
    {
        $weekdays = "Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday";
        $arr_weekdays = explode(",", $weekdays);
        $weekday = $arr_weekdays[$weekday];
        if (!$weekday)
            die("Invalid Weekday!");

        $start = strtotime("+0 day", strtotime($start));
        $end = strtotime($end);
        $dateArr = array();
        $friday = strtotime($weekday, $start);
        while ($friday <= $end) {
            $dateArr[] = date("Y-m-d", $friday);
            $friday = strtotime("+1 weeks", $friday);
        }
        $dateArr[] = date("Y-m-d", $friday);
        return $dateArr;
    }

    /*
     * @methodName getDatesFromRange()
     * @access
     * @param  StartDate, endDate
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Weekend date
     */

    public function getDatesFromRange($start, $end)
    {
        $interval = new DateInterval('P1D');

        $realEnd = new DateTime($end);
        $realEnd->add($interval);

        $period = new DatePeriod(
            new DateTime($start), $interval, $realEnd
        );

        foreach ($period as $date) {
            $array[] = $date->format('Y-m-d');
        }

        return $array;
    }

    /*
     * @methodName holiday()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return holiday index page
     */

    function holiday()
    {
        $data['contentTitle'] = 'Holiday';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Holiday List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['holiday'] = $this->utilities->findAllFromView('holiday_master'); // select all data from holiday_master
        $data['content_view_page'] = 'admin/setup/holiday/holiday_index';
        $this->admin_template->display($data);
    }

    /*
     * @methodName holiday_list()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return holiday index page
     */

    function holidayList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/event");
        $data['holiday'] = $this->utilities->findAllFromView('holiday_master'); // select all data from holiday_master
        $this->load->view("admin/setup/holiday/holiday_list", $data);
    }

    /*
     * @methodName holidayFormInsert()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return holiday index page
     */

    function weekendFormInsert()
    {
        $data["ac_type"] = 1;
        $this->load->view('admin/setup/holiday/add_weekend', $data);
    }

    /*
     * @methodName createWeekend()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return holiday index page
     */

    function createWeekend()
    {
        $formDate = $this->input->post("fromDate");
        $toDate = $this->input->post("toDate");
        $day = $this->input->post("txtHolidayDay");
        $weekendDayName = $this->input->post("weekendTitle");
        $content = $this->input->post("content");  // Descripsion
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status

        $form = date('Y-m-d', strtotime(str_replace('/', '-', $formDate)));
        $to = date('Y-m-d', strtotime(str_replace('/', '-', $toDate)));
        $insert = 0;
        for ($j = 0; $j < sizeof($day); $j++) {
            $dateArr = $this->getDateForSpecificDayBetweenDates($form, $to, $day[$j]); // getDateForSpecificDayBetweenDates function call.
            $i = 1;
            foreach ($dateArr as $weekendDate) {
                if ($i < sizeof($dateArr)) {

                    $weekendHoliday = array(
                        "TYPE" => 'W',
                        "HOLIDAY_NAME" => $weekendDayName,
                        "HOLIDAY_DESC" => $content,
                        "HOLIDAY_DT" => $weekendDate,
                        'ACTIVE_STATUS' => $status,
                        'CREATED_BY' => $this->user["USER_ID"]
                    );
                    $check = $this->utilities->hasInformationByThisId("holiday_master", array("HOLIDAY_DT" => $weekendDate));
                    if (empty($check)) {// if Holiday name available // preparing data to insert
                        $insert = $this->utilities->insertData($weekendHoliday, "holiday_master");
                    }
                    $i++;
                }
            }
        }
        if ($check) {
            echo "<div class='alert alert-danger'>Weekend Date Already Exist</div>";
        }
        if ($insert) { // if data inserted successfully
            echo "<div class='alert alert-success'>Weekend Create successfully</div>";
        }
    }

    /*
     * @methodName holidayFormInsert()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return holiday index page
     */

    function holidayFormInsert()
    {
        $data["ac_type"] = 1;
        $this->load->view('admin/setup/holiday/add_holiday', $data);
    }

    /*
     * @methodName createWeekend()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return holiday index page
     */

    function createHoliday()
    {

        $holiday = $this->input->post("cmbHoliday");
        $formDate = $this->input->post("fromDate");
        $toDate = $this->input->post("toDate");
        $holidayDayName = $this->input->post("holidayTitle");
        $content = $this->input->post("content");  // Descripsion
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status

        $form = date('Y-m-d', strtotime(str_replace('/', '-', $formDate)));
        $to = date('Y-m-d', strtotime(str_replace('/', '-', $toDate)));

        $dateArr = $this->getDatesFromRange($form, $to); // getDatesFromRange function call.
        $insert = 0;
        foreach ($dateArr as $weekendDate) {

            $weekendHoliday = array(
                "TYPE" => $holiday,
                "HOLIDAY_NAME" => $holidayDayName,
                "HOLIDAY_DESC" => $content,
                "HOLIDAY_DT" => $weekendDate,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            $check = $this->utilities->hasInformationByThisId("holiday_master", array("HOLIDAY_DT" => $weekendDate));
            if (empty($check)) {// if Holiday name available // preparing data to insert
                $insert = $this->utilities->insertData($weekendHoliday, "holiday_master");
            }
        }
        if ($check) {
            echo "<div class='alert alert-danger'>Holiday Date Already Exist</div>";
        }
        if ($insert) { // if data inserted successfully
            echo "<div class='alert alert-success'>Holiday Create successfully</div>";
        }
    }

    /*
     * @methodName holidayById()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */

    function holidayById()
    {
        $holiday_id = $this->input->post('param'); // event type id
        $data["previlages"] = $this->checkPrevilege("setup/holiday");
        $data['sn'] = 8;
        $data['row'] = $this->utilities->findByAttribute('holiday_master', array('HOLIDAY_ID' => $holiday_id)); // select all data from degree where degree id
        $this->load->view('admin/setup/holiday/single_holiday_row', $data);
    }


    /*
     * @methodName admSession()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */

    function admSession()
    {
        $data['contentTitle'] = 'Session';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Session List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['sessionYear'] = $this->utilities->admissionSessionList(); // select all data from session_year
        $data['content_view_page'] = 'admin/setup/session_year/session_year_index';
        $this->admin_template->display($data);
    }

    /*
     * @methodName admSession()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */

    function examSession()
    {
        $data['contentTitle'] = 'Exam Session';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Exam Session List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['sessionYear'] = $this->utilities->academicSessionList(); // select all data from session_year
        $data['content_view_page'] = 'admin/setup/session_year/exam_session_year_index';
        $this->admin_template->display($data);
    }

    /*
     * @methodName sessionYearFormInsert()
     * @access
     * @param  none
     * @return Mixed Template
     */

    function sessionYearFormInsert()
    {
        $data["ac_type"] = 1;
        $data["session"] = $this->utilities->getAll("ins_session"); // select all Category name from  aca_course_category
        $data["year"] = $this->utilities->getAll("ins_years"); // select all Category name from  aca_course_category
        $this->load->view('admin/setup/session_year/add_session_year', $data);
    }

    /*
   * @methodName sessionYearFormInsert()
   * @access
   * @param  none
   * @return Mixed Template
   */

    function examSessionYearFormInsert()
    {
        $data["ac_type"] = 1;
        $data["session"] = $this->utilities->getAll("ins_session"); // select all Category name from  aca_course_category
        $data["year"] = $this->utilities->getAll("ins_years"); // select all Category name from  aca_course_category
        $this->load->view('admin/setup/session_year/exam_add_session_year', $data);
    }

    /*
     * @methodName createSessionYear()
     * @access
     * @param  none
     * @return status
     */

    function createSessionYear()
    {
        $session = $this->input->post('SESSION_ID'); // session name
        $year = $this->input->post('YEAR_SETUP_ID'); // year name
        $UD_SLNO = $this->input->post('UD_SLNO'); // year name
        $IS_CURRENT = ((isset($_POST['IS_CURRENT'])) ? 1 : 0);
        $IS_TRIMESTER = ((isset($_POST['IS_TRIMESTER'])) ? 1 : 0);
        $IS_SEMESTER = ((isset($_POST['IS_SEMESTER'])) ? 1 : 0);
        $IS_ADMISSION = ((isset($_POST['IS_ADMISSION'])) ? 1 : 0);
        $ACTIVE_STATUS = ((isset($_POST['ACTIVE_STATUS'])) ? 1 : 0);
        // checking if Session with this name is already exist
        $check = $this->utilities->hasInformationByThisId("adm_ysession", array("SESSION_ID" => $session, "DINYEAR" => $year));
        if (empty($check)) {// if Session name available
            // preparing data to insert
            $session = array(
                'SESSION_ID' => $session,
                'DINYEAR' => $year,
                'IS_CURRENT' => $IS_CURRENT,
                'TRIMESTER' => $IS_TRIMESTER,
                'SEMESTER' => $IS_SEMESTER,
                'UD_SLNO' => $UD_SLNO,
                'ACTIVE_STATUS' => $ACTIVE_STATUS,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            $ses_year_id = $this->utilities->insert('adm_ysession', $session);
            if (!empty($ses_year_id)) {
                if ($IS_CURRENT == 1) {
                    $this->db->query("UPDATE adm_ysession
                    SET IS_CURRENT = 0
                    WHERE YSESSION_ID !=$ses_year_id");
                }

                echo "<div class='alert alert-success'>Session Year Create successfully</div>";
            } else {
                echo "<div class='alert alert-danger'>Session and Year insert failed</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Session and Year Already Exist</div>";
        }
    }

    /*
     * @methodName createSessionYear()
     * @access
     * @param  none
     * @return status
     */

    function createExamSessionYear()
    {
        $session = $this->input->post('SESSION_ID'); // session name
        $year = $this->input->post('YEAR_SETUP_ID'); // year name
        $UD_SLNO = $this->input->post('UD_SLNO'); // year name
        $IS_CURRENT = ((isset($_POST['IS_CURRENT'])) ? 1 : 0);
        $IS_TRIMESTER = ((isset($_POST['IS_TRIMESTER'])) ? 1 : 0);
        $IS_SEMESTER = ((isset($_POST['IS_SEMESTER'])) ? 1 : 0);
        $IS_ADMISSION = ((isset($_POST['IS_ADMISSION'])) ? 1 : 0);
        $ACTIVE_STATUS = ((isset($_POST['ACTIVE_STATUS'])) ? 1 : 0);
        // checking if Session with this name is already exist
        $check = $this->utilities->hasInformationByThisId("ins_ysession", array("SESSION_ID" => $session, "DINYEAR" => $year));
        if (empty($check)) {// if Session name available
            // preparing data to insert
            $session = array(
                'SESSION_ID' => $session,
                'DINYEAR' => $year,
                'IS_CURRENT' => $IS_CURRENT,
                'TRIMESTER' => $IS_TRIMESTER,
                'SEMESTER' => $IS_SEMESTER,
                'UD_SLNO' => $UD_SLNO,
                'ACTIVE_STATUS' => $ACTIVE_STATUS,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            $ses_year_id = $this->utilities->insert('ins_ysession', $session);
            if (!empty($ses_year_id)) {
                if ($IS_CURRENT == 1) {
                    $this->db->query("UPDATE ins_ysession
                    SET IS_CURRENT = 0
                    WHERE YSESSION_ID !=$ses_year_id");
                }

                echo "<div class='alert alert-success'>Session Year Create successfully</div>";
            } else {
                echo "<div class='alert alert-danger'>Session and Year insert failed</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Session and Year Already Exist</div>";
        }
    }

    /*
     * @methodName sessionYearFormUpdate()
     * @access
     * @param  none
     * @return Mixed Template
     */
    function sessionYearFormUpdate()
    {
        $data["ac_type"] = "edit";
        $SES_YEAR_ID = $this->input->post('param'); // SES_YEAR_ID
        $data["session"] = $this->utilities->getAll("ins_session"); // select all Category name from  aca_course_category
        $data["year"] = $this->utilities->getAll("ins_years"); // select all Category name from  aca_course_category
        $data['sessionYear'] = $this->utilities->admissionSessionById($SES_YEAR_ID);
        //echo "<pre>"; print_r( $data['sessionYear'] ); exit; echo "</pre>";
        $this->load->view('admin/setup/session_year/add_session_year', $data);
    }    /*
     * @methodName sessionYearFormUpdate()
     * @access
     * @param  none
     * @return Mixed Template
     */
    function sessionExamYearFormUpdate()
    {
        $data["ac_type"] = "edit";
        $SES_YEAR_ID = $this->input->post('param'); // SES_YEAR_ID
        $data["session"] = $this->utilities->getAll("ins_session"); // select all Category name from  aca_course_category
        $data["year"] = $this->utilities->getAll("ins_years"); // select all Category name from  aca_course_category
        $data['sessionYear'] = $this->utilities->academicSessionById($SES_YEAR_ID);
        //echo "<pre>"; print_r( $data['sessionYear'] ); exit; echo "</pre>";
        $this->load->view('admin/setup/session_year/exam_add_session_year', $data);
    }

    /*
     * @methodName sessionYearList()
     * @access
     * @param  none
     * @return Mixed Template
     */
    function updateExamSessionYear()
    {
        $yearSetupId = $this->input->post('yearSetupId'); // session name
        $session = $this->input->post('SESSION_ID');
        $year = $this->input->post('YEAR_SETUP_ID'); // year name
        $UD_SLNO = $this->input->post('UD_SLNO'); // year name
        $IS_CURRENT = ((isset($_POST['IS_CURRENT'])) ? 1 : 0);
        $IS_TRIMESTER = ((isset($_POST['IS_TRIMESTER'])) ? 1 : 0);
        $IS_SEMESTER = ((isset($_POST['IS_SEMESTER'])) ? 1 : 0);
        $ACTIVE_STATUS = ((isset($_POST['ACTIVE_STATUS'])) ? 1 : 0);
        // checking if Session with this name is already exist
        $check = $this->utilities->hasInformationByThisId("ins_ysession", array("SESSION_ID" => $session, "DINYEAR" => $year, "YSESSION_ID" != $yearSetupId));

        if (empty($check)) {// if Session name available
            // preparing data to insert
            $session = array(
                'SESSION_ID' => $session,
                'DINYEAR' => $year,
                'IS_CURRENT' => $IS_CURRENT,
                'TRIMESTER' => $IS_TRIMESTER,
                'SEMESTER' => $IS_SEMESTER,
                'UD_SLNO' => $UD_SLNO,
                'ACTIVE_STATUS' => $ACTIVE_STATUS,
                'UPDATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->updateData('ins_ysession', $session, array('YSESSION_ID' => $yearSetupId))) { // if data inserted successfully

                if ($IS_CURRENT == 1) {
                    $this->db->query("UPDATE ins_ysession
                    SET IS_CURRENT = 0
                    WHERE YSESSION_ID !=$yearSetupId");
                }
                echo "<div class='alert alert-success'>Session Year Update successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Session and Year Update failed</div>";
            }
        } else {// if session name not available
            echo "<div class='alert alert-danger'>Session and Year Already Exist</div>";
        }

    }    /*
     * @methodName sessionYearList()
     * @access
     * @param  none
     * @return Mixed Template
     */
    function updateSessionYear()
    {
        $yearSetupId = $this->input->post('yearSetupId'); // session name
        $session = $this->input->post('SESSION_ID');
        $UD_SLNO = $this->input->post('UD_SLNO');
        $year = $this->input->post('YEAR_SETUP_ID'); // year name
        $IS_CURRENT = ((isset($_POST['IS_CURRENT'])) ? 1 : 0);
        $IS_TRIMESTER = ((isset($_POST['IS_TRIMESTER'])) ? 1 : 0);
        $IS_SEMESTER = ((isset($_POST['IS_SEMESTER'])) ? 1 : 0);
        $ACTIVE_STATUS = ((isset($_POST['ACTIVE_STATUS'])) ? 1 : 0);
        // checking if Session with this name is already exist
        $check = $this->utilities->hasInformationByThisId("adm_ysession", array("SESSION_ID" => $session, "DINYEAR" => $year, "YSESSION_ID" != $yearSetupId));
        if (empty($check)) {// if Session name available
            // preparing data to insert
            $session = array(
                'SESSION_ID' => $session,
                'UD_SLNO' => $UD_SLNO,
                'DINYEAR' => $year,
                'IS_CURRENT' => $IS_CURRENT,
                'TRIMESTER' => $IS_TRIMESTER,
                'SEMESTER' => $IS_SEMESTER,
                'ACTIVE_STATUS' => $ACTIVE_STATUS,
                'UPDATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->updateData('adm_ysession', $session, array('YSESSION_ID' => $yearSetupId))) { // if data inserted successfully
                if ($IS_CURRENT == 1) {
                    $this->db->query("UPDATE adm_ysession
                    SET IS_CURRENT = 0
                    WHERE YSESSION_ID !=$yearSetupId");
                }
                echo "<div class='alert alert-success'>Session Year Update successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Session and Year Update failed</div>";
            }
        } else {// if session name not available
            echo "<div class='alert alert-danger'>Session and Year Already Exist</div>";
        }

    }

    /*
     * @methodName sessionYearList()
     * @access
     * @param  none
     * @return Mixed Template
     */

    function sessionYearList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/admSession");
        $data['sessionYear'] = $this->utilities->admissionSessionList();// select all data from session_year
        $this->load->view("admin/setup/session_year/session_year_list", $data);
    }

    /*
       * @methodName sessionYearList()
       * @access
       * @param  none
       * @return Mixed Template
       */

    function examSessionYearList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/examSession");
        $data['sessionYear'] = $this->utilities->academicSessionList();// select all data from session_year
        $this->load->view("admin/setup/session_year/exam_session_year_list", $data);
    }

    /*
     * @methodName sessionYearById()
     * @access
     * @param  none
     * @return Mixed Template
     */

    function examSessionYearById()
    {
        $sesYearId = $this->input->post('param'); // session name
        $data["previlages"] = $this->checkPrevilege("setup/examSessionYear");
        $data['row'] = $this->utilities->academicSessionById($sesYearId); // select all data from session where session id
        $this->load->view('admin/setup/session_year/exam_single_sessionYear_row', $data);
    }

    /*
  * @methodName sessionYearById()
  * @access
  * @param  none
  * @return Mixed Template
  */

    function sessionYearById()
    {
        $sesYearId = $this->input->post('param'); // session name
        $data["previlages"] = $this->checkPrevilege("setup/sessionYear");
        $data['row'] = $this->utilities->admissionSessionById($sesYearId); // select all data from session where session id
        $this->load->view('admin/setup/session_year/single_sessionYear_row', $data);
    }

    /**
     * @methodName registrationPeriod()
     * @access none
     * @param  none
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function registrationPeriod()
    {
        $data['contentTitle'] = 'Registration Period';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Registration Period List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['reg_period'] = $this->db->query("SELECT r.*, f.FACULTY_NAME, d.DEPT_NAME, p.PROGRAM_NAME, md.LKP_NAME, sv.*
            FROM reg_crs_reg_period r
            LEFT JOIN faculty f on f.FACULTY_ID = r.FACULTY_ID
            LEFT JOIN department d on d.DEPT_ID = r.DEPT_ID
            LEFT JOIN program p on p.PROGRAM_ID = r.PROGRAM_ID
            LEFT JOIN session_view sv on sv.SESSION_ID = r.SESSION_ID
            LEFT JOIN m00_lkpdata md on md.LKP_ID  = r.SEMESTER_ID ")->result();
        $data['content_view_page'] = 'admin/setup/registration_period/reg_index';
        $this->admin_template->display($data);
    }

    /**
     * @methodName regPeriodForm()
     * @access none
     * @param  none
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function regPeriodForm()
    {
        $data["ac_type"] = 1;
        $data['current_date'] = $this->input->post('date');
        $data["dimention"] = "vertical"; /*for common faculty_dept_program*/
        $data["faculty"] = $this->utilities->getAll("faculty"); // select all faculty name from  faculty
        $data["semester"] = $this->utilities->getAll("sav_semester"); // select all Semester name from  m00_lkpdata
        $data["session"] = $this->utilities->getAll("session_view");
        $this->load->view('admin/setup/registration_period/add_reg_period', $data);
    }

    /**
     * @param
     * @return Mixed Template
     * @author JAHID HASAN <jahid@atilimited.net>
     */
    function createRegPeriod()
    {
        /* echo "<pre>";
         print_r($_POST);
         exit();*/
        $session = $this->input->post('SESSION_ID');
        $semester = $this->input->post('SEMESTER_ID');
        $faculty = $this->input->post('FACULTY_ID');
        $department = $this->input->post('DEPT_ID');
        $program = $this->input->post('PROGRAM_ID');
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $status = ((isset($_POST['status'])) ? 1 : 0);

        $date1 = explode("/", $startDate);
        $fromDate = $date1[2] . '-' . $date1[1] . '-' . $date1[0];
        $date2 = explode("/", $endDate);
        $Date_t = $date2[2] . '-' . $date2[1] . '-' . $date2[0];
        $toDate = $Date_t . " 23:59:59";

        /*previous semester find out*/
        $sav_semester = $this->utilities->getAll("sav_semester");
        $semInfo = array();
        foreach ($sav_semester as $key => $row) {
            array_push($semInfo, $row->SEMESTER_ID);
        }
        for ($i = 0; $i < sizeof($semInfo); $i++) {
            if ($semInfo[$i] == $semester) {
                $pre_semester = $semInfo[$i - 1];
            }
        };
        /*end previous semester find out*/
        if ($program == "all") {
            $program_id = 0;
        } else {
            $program_id = $program;
        }
        $reg_data = array(
            "RP_TITLE" => $title,
            "FACULTY_ID" => $faculty,
            "DEPT_ID" => $department,
            "PROGRAM_ID" => $program,
            "SESSION_ID" => $session,
            "SEMESTER_ID" => $semester,
            "FROM_DT" => $fromDate,
            "TO_DT" => $toDate
        );
        $check = $this->utilities->hasInformationByThisId("reg_crs_reg_period", $reg_data);
        if ($check == FALSE) {// if Registration period available
            $reg_data["RP_DESC"] = $description;
            $reg_data["ACTIVE_STATUS"] = $status;
            $reg_data["CREATED_BY"] = $this->user["USER_ID"];

            /* IMPORTANT:
              If "All" option from Program drop down is selected by user,
              student of those programs are searching here and if the Program Course Credit type is "FIXED Credit"
              then their data will be inserted into "reg_stu_crs_request" for approval from authenticated person.
             */
            /*if ($program == "all") {
                $select_previous_semester_sql = " (SELECT s.SEMESTER_ID FROM sav_semester s WHERE s.SEMESTER_ID < sc.SEMISTER_ID ORDER BY s.SEMESTER_ID LIMIT 1)PREVIOUS_SEMESTER, ";
                $program_sql = "";
                $semester_id = "";
            } else {                    
            }*/

            $program_sql = " AND sc.PROGRAM_ID = $program ";
            $semester_id = " AND sc.SEMISTER_ID = $pre_semester ";
            $get_all_students = $this->db->query("SELECT sc.STUDENT_ID, aco.OFFER_TYPE, sc.SEMISTER_ID, sc.FACULTY_ID, sc.DEPT_ID, sc.PROGRAM_ID                                                        
                FROM stu_courseinfo sc
                INNER JOIN aca_course_offer aco on aco.OFFERED_COURSE_ID = sc.OFFERED_COURSE_ID
                WHERE sc.FACULTY_ID = $faculty AND sc.DEPT_ID = $department $program_sql $semester_id
                AND sc.IS_CURRENT = 1 GROUP BY sc.STUDENT_ID")->result();
            /*echo "<pre>";
            print_r($get_all_students);
            exit;*/
            if (!empty($get_all_students)) {
                for ($i = 0; $i < sizeof($get_all_students); $i++) {
                    $s_faculty = $get_all_students[$i]->FACULTY_ID;
                    $s_dept = $get_all_students[$i]->DEPT_ID;
                    $s_program = $get_all_students[$i]->PROGRAM_ID;
                    //$previous_semester = $get_all_students[$i]->SEMISTER_ID;
                    // getting next semester courses
                    $semester_cources = $this->db->query("SELECT  sca.COURSE_ID,sca.SEMESTER_ID, sca.FACULTY_ID, sca.DEPT_ID, sca.PROGRAM_ID
                        FROM aca_semester_course sca
                        WHERE sca.FACULTY_ID = $s_faculty AND sca.DEPT_ID = $s_dept
                        AND sca.PROGRAM_ID = $s_program AND sca.SEMESTER_ID = $semester")->result();

                    if (!empty($semester_cources)) {
                        foreach ($semester_cources as $cources) {
                            if ($get_all_students[$i]->OFFER_TYPE == "F") {
                                $regCourse = array(
                                    'STUDENT_ID' => $get_all_students[$i]->STUDENT_ID,
                                    'REG_PERIOD_ID' => 0, /* Register crouse register period id */
                                    'FACULTY_ID' => $cources->FACULTY_ID,
                                    'DEPT_ID' => $cources->DEPT_ID,
                                    'PROGRAM_ID' => $cources->PROGRAM_ID,
                                    'SESSION_ID' => $session,
                                    'SEMESTER_ID' => $semester,
                                    'COURSE_ID' => $cources->COURSE_ID,
                                    'IS_CURRENT' => 1,
                                    'ACTIVE_STATUS' => 0,
                                    'CREATED_BY' => $this->user["USER_ID"]
                                );
                                $reqInsert = $this->utilities->insertData($regCourse, 'reg_stu_crs_request');
                            } else if ($get_all_students[$i]->OFFER_TYPE == "O") {
                                $regCourse = array(
                                    'STUDENT_ID' => $get_all_students[$i]->STUDENT_ID,
                                    'REG_PERIOD_ID' => 0, /* Register crouse register period id */
                                    'FACULTY_ID' => $cources->FACULTY_ID,
                                    'DEPT_ID' => $cources->DEPT_ID,
                                    'PROGRAM_ID' => $cources->PROGRAM_ID,
                                    'SESSION_ID' => $session,
                                    'SEMESTER_ID' => $semester,
                                    'COURSE_ID' => $cources->COURSE_ID,
                                    'IS_CURRENT' => 1,
                                    'ACTIVE_STATUS' => 0,
                                    'CREATED_BY' => $this->user["USER_ID"]
                                );
                                $reqInsert = $this->utilities->insertData($regCourse, 'reg_stu_crs_request');
                            }
                        }

                    } else {
                        echo "<div class='alert alert-danger'>Semester Courses not assign. Please, declared semserter course offer.</div>";
                    }
                }
                if (!empty($reqInsert)) {
                    $regId = $this->utilities->insert('reg_crs_reg_period', $reg_data);
                    if (!empty($regId)) {
                        $RegUp = array(
                            "REG_PERIOD_ID" => $regId
                        );
                        $this->utilities->updateData('reg_stu_crs_request', $RegUp, array('PROGRAM_ID' => $program, 'SESSION_ID' => $session, 'SEMESTER_ID' => $semester));
                        echo "<div class='alert alert-success'>Registration Period Created successfully</div>";
                    } else { // if data inserted failed
                        echo "<div class='alert alert-danger'>Registration Period Insert Failed</div>";
                    }
                }
            } else {
                echo "<div class='alert alert-danger'>Previous Semester Student not found. Please enter valid semester</div>";
            }

        } else {// if Registration Period already
            echo "<div class='alert alert-danger'>Registration Period  Already Exist</div>";
        }
    }

    function regPeriodFormUpdate()
    {
        $data["ac_type"] = "edit";
        $regPerId = $this->input->post('param'); // faculty ID
        $data["dimention"] = "vertical"; /*for common faculty_dept_program*/
        $data["faculty"] = $this->utilities->getAll("faculty"); // select all faculty name from  faculty
        $data["department"] = $this->utilities->getAll("department"); // select all department name from  department
        $data["program"] = $this->utilities->getAll("program"); // select all program name from  program
        $data["semester"] = $this->utilities->getAll("sav_semester"); // select all Semester name from  m00_lkpdata
        $data["session"] = $this->utilities->getAll("session_view");
        $data['previous_info'] = $this->db->query("SELECT r.*, f.FACULTY_NAME, d.DEPT_NAME, p.PROGRAM_NAME, md.LKP_NAME, sy.SES_YEAR_ID, s.SESSION_NAME, ys.YEAR_SETUP_TITLE
            FROM reg_crs_reg_period r
            LEFT JOIN faculty f on f.FACULTY_ID = r.FACULTY_ID
            LEFT JOIN department d on d.DEPT_ID = r.DEPT_ID
            LEFT JOIN program p on p.PROGRAM_ID = r.PROGRAM_ID
            LEFT JOIN session_year sy on sy.SES_YEAR_ID = r.SESSION_ID
            LEFT JOIN session s on s.SESSION_ID = sy.SESSION
            LEFT JOIN year_setup ys on ys.YEAR_SETUP_ID = sy.YEAR_SETUP_ID
            LEFT JOIN m00_lkpdata md on md.LKP_ID  = r.SEMESTER_ID
            WHERE r.REG_PERIOD_ID = $regPerId
            ")->row();
        $this->load->view('admin/setup/registration_period/add_reg_period', $data);
    }

    function updateRegPeriod()
    {

        $regPeriodId = $this->input->post('regPeriodId'); // Regitration Period Id
        $session = $this->input->post('SESSION'); // Session Id
        $semester = $this->input->post('SEMESTER_ID'); //
        $faculty = $this->input->post('FACULTY_ID'); //
        $department = $this->input->post('DEPT_ID'); //
        $program = $this->input->post('PROGRAM_ID'); //
        $startDate = $this->input->post('startDate'); //
        $endDate = $this->input->post('endDate'); //
        $title = $this->input->post('title'); //
        $description = $this->input->post('description'); //
        $status = ((isset($_POST['status'])) ? 1 : 0); //

        $date1 = explode("/", $startDate);
        $fromDate = $date1[2] . '-' . $date1[1] . '-' . $date1[0];
        $date2 = explode("/", $endDate);
        $Date_t = $date2[2] . '-' . $date2[1] . '-' . $date2[0];
        $toDate = $Date_t . " 23:59:59";

        $check = $this->utilities->hasInformationByThisId("reg_crs_reg_period", array("REG_PERIOD_ID" != $regPeriodId, "RP_TITLE" => $title, "PROGRAM_ID" => $program, "SESSION_ID" => $session, "SEMESTER_ID" => $semester, "FROM_DT" => $fromDate, "TO_DT" => $toDate));
        if (empty($check)) {// if Registration period available
            $regPeriod = array(
                'REG_PERIOD_ID' => $regPeriodId,
                'RP_TITLE' => $title,
                'RP_DESC' => $description,
                'FROM_DT' => $fromDate,
                'TO_DT' => $toDate,
                'FACULTY_ID' => $faculty,
                'DEPT_ID' => $department,
                'PROGRAM_ID' => $program,
                'SESSION_ID' => $session,
                'SEMESTER_ID' => $semester,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->updateData('reg_crs_reg_period', $regPeriod, array('REG_PERIOD_ID' => $regPeriodId))) { // if data inserted successfully
                echo "<div class='alert alert-success'>Registration Period Update successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Registration Period Update failed</div>";
            }
        } else {// if event name not available
            echo "<div class='alert alert-danger'>Registration Period Already Exist</div>";
        }
    }

    function regPeriodList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/registrationPeriod");
        $data['reg_period'] = $this->db->query("SELECT r.*, f.FACULTY_NAME, d.DEPT_NAME, p.PROGRAM_NAME, md.LKP_NAME, sv.*
            FROM reg_crs_reg_period r
            LEFT JOIN faculty f on f.FACULTY_ID = r.FACULTY_ID
            LEFT JOIN department d on d.DEPT_ID = r.DEPT_ID
            LEFT JOIN program p on p.PROGRAM_ID = r.PROGRAM_ID
            LEFT JOIN session_year sv on sv.SESSION_ID = r.SESSION_ID
            LEFT JOIN m00_lkpdata md on md.LKP_ID  = r.SEMESTER_ID ")->result(); // select all data from  Registration Period
        $this->load->view("admin/setup/registration_period/reg_period_list", $data);
    }

    function regPeriodById()
    {
        $regPerId = $this->input->post('param'); // session name
        $data["previlages"] = $this->checkPrevilege("setup/registrationPeriod");
        $data['row'] = $this->db->query("SELECT r.*, f.FACULTY_NAME, d.DEPT_NAME, p.PROGRAM_NAME, md.LKP_NAME, sv.*
            FROM reg_crs_reg_period r
            LEFT JOIN faculty f on f.FACULTY_ID = r.FACULTY_ID
            LEFT JOIN department d on d.DEPT_ID = r.DEPT_ID
            LEFT JOIN program p on p.PROGRAM_ID = r.PROGRAM_ID
            LEFT JOIN session_view sv on sv.SESSION_ID = r.SESSION_ID
            LEFT JOIN m00_lkpdata md on md.LKP_ID  = r.SEMESTER_ID
            WHERE r.REG_PERIOD_ID = $regPerId
            ")->row();
        $this->load->view('admin/setup/registration_period/single_row_reg_period', $data);
    }

    /*
     * @methodName regPeriodInfo()
     * @access none
     * @param  none
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */

    function regPeriodInfo()
    {
        $id = $this->input->post('param');
        $data['regPer'] = $this->db->query("SELECT rcrp.*, d.DEPT_NAME, p.PROGRAM_NAME, ml.LKP_NAME, s.SESSION_NAME, ys.YEAR_SETUP_TITLE FROM reg_crs_reg_period rcrp
            LEFT JOIN department d on d.DEPT_ID = rcrp.DEPT_ID
            LEFT JOIN program p on p.PROGRAM_ID = rcrp.PROGRAM_ID
            LEFT JOIN m00_lkpdata ml on ml.LKP_ID = rcrp.SEMESTER_ID
            LEFT JOIN session_year sy on sy.SES_YEAR_ID = rcrp.SESSION_ID
            LEFT JOIN session s on s.SESSION_ID = sy.SESSION
            LEFT JOIN year_setup ys on ys.YEAR_SETUP_ID = sy.YEAR_SETUP_ID
            WHERE rcrp.REG_PERIOD_ID = $id ")->row();
        $this->load->view("admin/setup/registration_period/registration_period_info", $data);
    }

    /*
     * @methodName ajax_get_district()
     * @access none
     * @param  none
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */

    function ajax_get_district()
    {
        $district = $_POST['district'];
        $query = $this->utilities->findAllByAttribute('sa_thanas', array("DISTRICT_ID" => $district, "ACTIVE_FLAG" => 1));
        $returnVal = '<option value="">Select one</option>';
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value="' . $row->THANA_ID . '">' . $row->THANA_ENAME . '</option>';
            }
        }
        echo $returnVal;
    }

    /*
     * @methodName designation()
     * @access
     * @param  none
     * @return Mixed Template
     */

    function designation()
    {
        $data['contentTitle'] = 'Designation';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Designation List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['designation'] = $this->utilities->findAllFromView('hr_desig');
        //var_dump($data['designation']); exit();
        $data['content_view_page'] = 'admin/setup/designation/designation_index';
        $this->admin_template->display($data);
    }

    /*
     * @methodName programFormInsert()
     * @access
     * @param  none
     * @return status
     */

    function designationFormInsert()
    {
        $data["ac_type"] = 1;
        $data['dimention'] = "horizental";
        $this->load->view('admin/setup/designation/create_designation', $data);
    }

    /*
     * @methodName designationList()
     * @access
     * @param  none
     * @return status
     */

    function designationList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/designation");
        $data['designation'] = $this->utilities->findAllFromView('hr_desig');
        $this->load->view("admin/setup/designation/designation_list", $data);
    }

    /*
     * @methodName createProgram()
     * @access
     * @param  none
     * @return status
     */

    function createDesignation()
    {
        $designation = $this->input->post('designation'); // designation name        

        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Program with this name is already exist
        $check = $this->utilities->hasInformationByThisId("hr_desig", array("DESIGNATION" => $designation));
        if (empty($check)) {// if Program name available
            // preparing data to insert
            $designation = array(
                'DESIGNATION' => $designation,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->insertData($designation, 'hr_desig')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Designation create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Designationinsert failed</div>";
            }
        } else {// if faculty name not available
            echo "<div class='alert alert-danger'>Designation Already Exist</div>";
        }
    }

    /*
     * @methodName programFormUpdate()
     * @access
     * @param  none
     * @return status
     */

    function designationFormUpdate()
    {
        $data["ac_type"] = "edit";
        $id = $this->input->post('param'); // program ID

        $data['designation'] = $this->db->query("SELECT d.*
            FROM hr_desig d
             WHERE d.DESIG_ID = $id")->row(); // select all data from program where program id
        $this->load->view('admin/setup/designation/create_designation', $data);
    }

    /*
     * @methodName updateProgram()
     * @access
     * @param  none
     * @return status
     */

    function updateDesignation()
    {
        $designation_id = $this->input->post('txtDegnaionId'); // program id
        $designation = $this->input->post('designation'); // designation name
        $Departments = $this->input->post('DEPT_ID'); // program
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Designation with this name is already exist
        $check = $this->utilities->hasInformationByThisId("hr_desig", array("DESIGNATION" => $designation));
        if (empty($check)) {// if Designation name available
            // preparing data to insert
            $designation = array(
                'DESIGNATION' => $designation,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            /* print_r($program);
            exit; */
            if ($this->utilities->updateData('hr_desig', $designation, array('DESIG_ID' => $designation_id))) { // if data update successfully
                echo "<div class='alert alert-success'>Designation Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Designation  Update failed</div>";
            }
        } else {// if faculty name not available
            echo "<div class='alert alert-danger'>Designation Already Exist In this Department</div>";
        }
    }

    /*
     * @methodName programById()
     * @access
     * @param  none
     * @return Mixed Template
     */

    function designationById()
    {
        $id = $this->input->post('param'); // degree name
        $data["previlages"] = $this->checkPrevilege("setup/designation");
        $data['designation'] = $this->utilities->findByAttribute('hr_desig', array('DESIG_ID' => $id)); // select all data from  program
        $this->load->view('admin/setup/designation/single_designation_row', $data);
    }

    /**
     * @methodName batch()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function batch()
    {
        $data['contentTitle'] = 'Batch';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Batch List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['batch'] = $this->utilities->findAllFromView('aca_batch');
        $data['content_view_page'] = 'admin/setup/batch/batch_index';
        $this->admin_template->display($data);
    }

    /**
     * @methodName batchFormInsert()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function batchFormInsert()
    {
        $data["ac_type"] = 1;
        $this->load->view('admin/setup/batch/add_batch', $data);
    }

    /**
     * @methodName batchFormInsert()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function batchById()
    {
        $batch_id = $this->input->post('param'); // degree name
        $data["previlages"] = $this->checkPrevilege("setup/batch");       
        $data['batch'] = $this->utilities->findByAttribute('aca_batch', array('BATCH_ID' => $batch_id)); // select all data from  aca_batch
        $this->load->view('admin/setup/batch/single_batch_row', $data);
    }

    /**
     * @methodName createBatch()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function batchList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/batch");
        $data['batch'] = $this->utilities->findAllFromView('aca_batch'); // select all data from  Batch
        $this->load->view("admin/setup/batch/batch_list", $data);
    }

    /**
     * @methodName createBatch()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function createBatch()
    {
        $batchName = $this->input->post('batchName'); // batch name
        $description = $this->input->post('description'); // description 
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Program with this name is already exist

        $check = $this->utilities->hasInformationByThisId("aca_batch", array("BATCH_TITLE" => $batchName, "BATCH_DESC" => $description));
        if (empty($check)) {// if Program name available
            // preparing data to insert
            $batch = array(
                'BATCH_TITLE' => $batchName,
                'BATCH_DESC' => $description,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->insertData($batch, 'aca_batch')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Batch Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Batch insert failed</div>";
            }
        } else {// if batch name not available
            echo "<div class='alert alert-danger'>Batch Already Exist</div>";
        }


    }

    /**
     * @methodName batchFormUpdate()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function batchFormUpdate()
    {
        $data["ac_type"] = "edit";
        $id = $this->input->post('param'); // Batch ID
        $data['previous_info'] = $this->utilities->findByAttribute('aca_batch', array('BATCH_ID' => $id));
        $this->load->view('admin/setup/batch/add_batch', $data);
    }

    /**
     * @methodName updatebatch()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function updatebatch()
    {
        $batch_id = $this->input->post('txtbatchId');
        $batchName = $this->input->post('batchName');
        $description = $this->input->post('description');
        $status = ((isset($_POST['status'])) ? 1 : 0);
        $check = $this->utilities->hasInformationByThisId("aca_batch", array("BATCH_TITLE" => $batchName, "BATCH_ID" != $batch_id));
        if (empty($check)) {
            $batch = array(
                'BATCH_TITLE' => $batchName,
                'BATCH_DESC' => $description,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->updateData('aca_batch', $batch, array('BATCH_ID' => $batch_id))) { // if data update successfully
                echo "<div class='alert alert-success'>Batch Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Batch Update failed</div>";
            }
        } else {// if faculty name not available
            echo "<div class='alert alert-danger'>Batch Already Exist</div>";
        }
    }

    function batchMap()
    {
        $data['contentTitle'] = 'Batch';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Batch Mapping' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['batch'] = $this->utilities->batchProgList();
        $data['content_view_page'] = 'admin/setup/batch/batch_map_index';
        $this->admin_template->display($data);
    }

    /**
     * @methodName batchFormInsert()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function batchMapFormInsert()
    {
        $data["ac_type"] = 1;
        $data['batch'] = $this->utilities->findAllFromView('aca_batch');
        $data['program'] = $this->utilities->findAllFromView('ins_program');
        $data['session'] = $this->utilities->academicSessionList();
        $this->load->view('admin/setup/batch/add_batch_map', $data);
    }

    /**
     * @methodName batchFormInsert()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function batchMapById()
    {
        $batch_id = $this->input->post('param'); // degree name       
        $data['batch'] = $this->utilities->findByAttribute('aca_batch', array('BATCH_ID' => $batch_id)); // select all data from  aca_batch
        $this->load->view('admin/setup/batch/single_batch_map_row', $data);
    }

    /**
     * @methodName createBatch()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function batchMapList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/batch");
        $data['batch'] = $this->utilities->batchProgList();
        $this->load->view("admin/setup/batch/batch_map_list", $data);
    }

    /**
     * @methodName createBatch()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function createBatchMap()
    {
        $PROGRAM_ID = $this->input->post('PROGRAM_ID');

        for ($i = 0; $i < sizeof($PROGRAM_ID); $i++) {
            $check = $this->utilities->hasInformationByThisId("aca_batch_prog", array("BATCH_ID" => $this->input->post('BATCH_ID'), "PROGRAM_ID" => $PROGRAM_ID[$i], "YSESSION_ID" => $this->input->post('SESSION_ID')));
            if (empty($check)) {
                $batch_prog_map = array(
                    'BATCH_ID' => $this->input->post('BATCH_ID'),
                    'PROGRAM_ID' => $PROGRAM_ID[$i],
                    'YSESSION_ID' => $this->input->post('SESSION_ID'),
                    'ACTIVE_STATUS' => $this->input->post('status'),
                    'CREATED_BY' => $this->user["USER_ID"]
                );
                if ($this->utilities->insertData($batch_prog_map, 'aca_batch_prog')) { // if data inserted successfully
                    echo "<div class='alert alert-success'>Batch Map Create successfully</div>";
                } else { // if data inserted failed
                    echo "<div class='alert alert-danger'>Batch Map insert failed</div>";
                }
            } else {// if batch name not available
                echo "<div class='alert alert-danger'>Batch Map Already Exist</div>";
            }
        }
    }

    /**
     * @methodName batchFormUpdate()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function batchMapFormUpdate()
    {
        $data["ac_type"] = "edit";
        $id = $this->input->post('param'); // Batch ID
        $data['previous_info'] = $this->utilities->findByAttribute('aca_batch', array('BATCH_ID' => $id));
        $this->load->view('admin/setup/batch/add_batch_map', $data);
    }

    /**
     * @methodName updatebatch()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function updatebatchMap()
    {
        $batch_id = $this->input->post('txtbatchId');
        $batchName = $this->input->post('batchName');
        $description = $this->input->post('description');
        $status = ((isset($_POST['status'])) ? 1 : 0);
        $check = $this->utilities->hasInformationByThisId("aca_batch", array("BATCH_TITLE" => $batchName, "BATCH_ID" != $batch_id));
        if (empty($check)) {
            $batch = array(
                'BATCH_TITLE' => $batchName,
                'BATCH_DESC' => $description,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->updateData('aca_batch', $batch, array('BATCH_ID' => $batch_id))) { // if data update successfully
                echo "<div class='alert alert-success'>Batch Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Batch Update failed</div>";
            }
        } else {// if faculty name not available
            echo "<div class='alert alert-danger'>Batch Already Exist</div>";
        }
    }

    /**
     * @methodName accessory()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function accessories()
    {
        $data['contentTitle'] = 'Accessory';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Accessory List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['accessory'] = $this->utilities->getAll('sc_accessories');
        $data['content_view_page'] = 'admin/setup/accessories/accessory_index';
        $this->admin_template->display($data);
    }

    /**
     * @methodName accessoryFormInsert()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function accessoryFormInsert()
    {
        $data["ac_type"] = 1;
        $this->load->view('admin/setup/accessories/add_accessory', $data);
    }

    /**
     * @methodName accessoriesById()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function accessoriesById()
    {
        $id = $this->input->post('param'); // accessory name
        $data["previlages"] = $this->checkPrevilege("setup/accessories");
        $data['accessory'] = $this->db->query("SELECT * FROM sc_accessories WHERE BR_ACCESSORY_ID = $id")->result(); // select all data from  aca_batch
        $this->load->view('admin/setup/accessories/single_accessory_row', $data);
    }

    /**
     * @methodName accessoriesList()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function accessoriesList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/accessories");
        $data['accessory'] = $this->utilities->findAllFromView('sc_accessories'); // select all data from  sc_accessories
        $this->load->view("admin/setup/accessories/accessory_list", $data);
    }

    /**
     * @methodName createAccessories()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function createAccessories()
    {
        $accessoryName = $this->input->post('accessoryName'); // accessory name
        $description = $this->input->post('description'); // description
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Program with this name is already exist
        $check = $this->utilities->hasInformationByThisId("sc_accessories", array("ACCESSORY_NAME" => $accessoryName));
        if (empty($check)) {// if Program name available
            // preparing data to insert
            $accessory = array(
                'ACCESSORY_NAME' => $accessoryName,
                'ACCESSORY_DESC' => $description,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->insertData($accessory, 'sc_accessories')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Accessory Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Accessory insert failed</div>";
            }
        } else {// if batch name not available
            echo "<div class='alert alert-danger'>Accessory Already Exist</div>";
        }
    }

    /**
     * @methodName accessoryFormUpdate()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function accessoryFormUpdate()
    {
        $data["ac_type"] = 2;
        $id = $this->input->post('param'); // Accessory ID
        $data['accessory'] = $this->utilities->findByAttribute('sc_accessories', array('BR_ACCESSORY_ID' => $id)); // select all data from degree where degree id
        $this->load->view('admin/setup/accessories/add_accessory', $data);
    }

    /**
     * @methodName updateAccessories()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function updateAccessories()
    {
        $id = $this->input->post('txtaccessoryId'); // accessory id
        $accessoryName = $this->input->post('accessoryName'); // accessory name
        $description = $this->input->post('description'); // description
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Program with this name is already exist
        $check = $this->utilities->hasInformationByThisId("sc_accessories", array("ACCESSORY_NAME" => $accessoryName, 'BR_ACCESSORY_ID' != $id));
        if (empty($check)) {// if Program name available
            // preparing data to insert
            $accessory = array(
                'ACCESSORY_NAME' => $accessoryName,
                'ACCESSORY_DESC' => $description,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->updateData('sc_accessories', $accessory, array('BR_ACCESSORY_ID' => $id))) { // if data inserted successfully
                echo "<div class='alert alert-success'>Accessory Update successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Accessory Update failed</div>";
            }
        } else {// if batch name not available
            echo "<div class='alert alert-danger'>Accessory Already Exist</div>";
        }
    }

    /**
     * @methodName br_accessory()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function brAccessories()
    {
        $data['contentTitle'] = 'Building Accessory';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Building Accessory List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['br_accessory'] = $this->db->query("SELECT ba.*, sa.ACCESSORY_NAME, br.BR_NAME, sbt.BR_TYPE_NAME, sbt.BR_TYPE_ID
            FROM sc_br_accessories ba
            INNER JOIN sc_accessories sa on sa.BR_ACCESSORY_ID = ba.BR_ACCESSORY_ID
            INNER JOIN sc_building_room br on br.BR_ID = ba.BR_ID
            INNER JOIN sc_br_type sbt on sbt.BR_TYPE_ID = br.BR_TYPE_ID")->result();
        $data['content_view_page'] = 'admin/setup/building_accessory/br_accessory_index';
        $this->admin_template->display($data);
    }

    /**
     * @methodName brAccessoryFormInsert()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function brAccessoryFormInsert()
    {
        $data["ac_type"] = 1;
        $data["building_type"] = $this->utilities->findAllByAttribute("sc_br_type", array("ACTIVE_STATUS" => 1)); // select all Building
        $data["building"] = $this->utilities->findAllByAttribute("sc_building_room", array("ACTIVE_STATUS" => 1)); // select all Building
        $data["accessory"] = $this->utilities->findAllByAttribute("sc_accessories", array("ACTIVE_STATUS" => 1)); // select all sc_accessories name from  sc_accessories
        $this->load->view('admin/setup/building_accessory/add_br_accessory', $data);
    }

    /**
     * @methodName ajax_get_buildingRoom()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function ajax_get_buildingRoom()
    {
        $buildingType = $this->input->post("buildingType");
        $query = $this->utilities->findAllByAttribute('sc_building_room', array("BR_TYPE_ID" => $buildingType, "ACTIVE_STATUS" => 1));
        $returnVal = '<option value="" id="ROOM_ID" >Select ROOM</option>';
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value="' . $row->BR_ID . '">' . $row->BR_NAME . ' (' . $row->BR_CODE . ')' . '</option>';
            }
        }
        echo $returnVal;
    }

    /**
     * @methodName createBrAccessories()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function createBrAccessories()
    {
        $ROOM_ID = $this->input->post('ROOM_ID'); // accessory name
        $accessory = $this->input->post('BR_ACCESSORY_ID'); // accessory name
        $quantity = $this->input->post('quantity'); // quantity
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Program with this name is already exist
        $check = $this->utilities->hasInformationByThisId("sc_br_accessories", array('BR_ID' => $ROOM_ID, "BR_ACCESSORY_ID" => $accessory, 'ACCESSORY_QTY' => $quantity));
        if (empty($check)) {// if Program name available
            // preparing data to insert
            $br_accessory = array(
                'BR_ID' => $ROOM_ID,
                'BR_ACCESSORY_ID' => $accessory,
                'ACCESSORY_QTY' => $quantity,
                'ACTIVE_STATUS' => $status
            );
            if ($this->utilities->insertData($br_accessory, 'sc_br_accessories')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Building Accessory Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Building Accessory insert failed</div>";
            }
        } else {// if batch name not available
            echo "<div class='alert alert-danger'>Building Accessory Already Exist</div>";
        }
    }

    /**
     * @methodName updateBrAccessories()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function brAccessoryFormUpdate()
    {
        $data["ac_type"] = "edit";
        $id = $this->input->post('param'); // brAccessory ID
        $data["building_type"] = $this->utilities->findAllByAttribute("sc_br_type", array("ACTIVE_STATUS" => 1)); // select all Building
        $data["building"] = $this->utilities->findAllByAttribute("sc_building_room", array("ACTIVE_STATUS" => 1)); // select all Building
        $data["accessory"] = $this->utilities->findAllByAttribute("sc_accessories", array("ACTIVE_STATUS" => 1)); // select all sc_accessories name from  sc_accessories
        $data['br_accessory'] = $this->db->query("SELECT ba.*, bt.BR_TYPE_ID, br.BR_ID, br.BR_NAME, br.BR_CODE
            FROM sc_br_accessories ba
            INNER JOIN sc_building_room br on ba.BR_ID = br.BR_ID
            INNER JOIN sc_br_type bt on bt.BR_TYPE_ID = br.BR_TYPE_ID
                                                WHERE ba.SC_BR_ACCESSORY_ID = $id")->row(); // select all data from  sc_br_accessories
        $this->load->view('admin/setup/building_accessory/add_br_accessory', $data);
    }

    /**
     * @methodName updateBrAccessories()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function updateBrAccessories()
    {
        $id = $this->input->post('txtBrAccessoryId'); // txtBrAccessory id
        $ROOM_ID = $this->input->post('ROOM_ID'); // accessory name
        $accessory = $this->input->post('BR_ACCESSORY_ID'); // accessory name
        $quantity = $this->input->post('quantity'); // quantity
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Program with this name is already exist
        $check = $this->utilities->hasInformationByThisId("sc_br_accessories", array('BR_ID' => $ROOM_ID, "BR_ACCESSORY_ID" => $accessory, 'ACCESSORY_QTY' => $quantity, "SC_BR_ACCESSORY_ID" != $id));
        if (empty($check)) {// if Program name available
            // preparing data to insert
            $br_accessory = array(
                'BR_ID' => $ROOM_ID,
                'BR_ACCESSORY_ID' => $accessory,
                'ACCESSORY_QTY' => $quantity,
                'ACTIVE_STATUS' => $status
            );
            if ($this->utilities->updateData('sc_br_accessories', $br_accessory, array('SC_BR_ACCESSORY_ID' => $id))) { // if data inserted successfully
                echo "<div class='alert alert-success'>Building Room Accessory Update successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Building Room Accessory Update failed</div>";
            }
        } else {// if batch name not available
            echo "<div class='alert alert-danger'>Building Room Accessory Already Exist</div>";
        }
    }

    /**
     * @methodName brAccessoriesList()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function brAccessoriesList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/brAccessories");
        $data['br_accessory'] = $this->db->query("SELECT ba.*,sa.ACCESSORY_NAME, br.BR_NAME, bt.BR_COM_TITLE
            FROM sc_br_accessories ba
            INNER JOIN sc_accessories sa on sa.BR_ACCESSORY_ID = ba.BR_ACCESSORY_ID
            INNER JOIN sc_building_room br on br.BR_ID = ba.BR_ID
            INNER JOIN sc_br_type bt on bt.BR_TYPE_ID = br.BR_TYPE_ID")->result();
        $this->load->view("admin/setup/building_accessory/br_accessory_list", $data);
    }

    /**
     * @methodName brAccessoriesById()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function brAccessoriesById()
    {
        $id = $this->input->post('param'); // degree name
        $data["previlages"] = $this->checkPrevilege("setup/brAccessories");
        $data['br_accessory'] = $this->db->query("SELECT ba.*, sa.ACCESSORY_NAME, br.BR_NAME, sbt.BR_COM_TITLE, sbt.BR_TYPE_ID
            FROM sc_br_accessories ba
            INNER JOIN sc_accessories sa on sa.BR_ACCESSORY_ID = ba.BR_ACCESSORY_ID
            INNER JOIN sc_building_room br on br.BR_ID = ba.BR_ID
            INNER JOIN sc_br_type sbt on sbt.BR_TYPE_ID = br.BR_TYPE_ID
                                                WHERE ba.SC_BR_ACCESSORY_ID = $id")->result(); // select all data from  sc_br_accessories
        $this->load->view('admin/setup/building_accessory/single_br_accessory_row', $data);
    }

    /**
     * @methodName assignment()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function assignment()
    {
        $data['contentTitle'] = 'Assignment List';
        $data["breadcrumbs"] = array(
            "Teacher" => "#",
            "Assignment List" => '#'
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['assignment'] = $this->db->query('SELECT aa.*, ac.COURSE_TITLE, ac.COURSE_CODE, act.TOPIC_TITLE FROM aca_assignment aa
            INNER JOIN aca_course  ac on ac.COURSE_ID = aa.COURSE_ID
            LEFT JOIN aca_course_topics act on act.CRS_TOPIC_ID = aa.CRS_TOPIC_ID
            ORDER BY aa.CREATE_DATE DESC')->result();
        $data['content_view_page'] = 'admin/setup/assignment/assignment_index';
        $this->admin_template->display($data);
    }

    /**
     * @methodName assignmentFormInsert()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function assignmentFormInsert()
    {
        $data["ac_type"] = 1;
        $data["flag"] = '';
        $data["dimention"] = "vertical";
        $data['faculty'] = $this->utilities->getAll('faculty');
        $data['session'] = $this->utilities->getAll('session_view');
        $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));

        $this->load->view('admin/setup/assignment/add_assignment', $data);
    }

    /**
     * @methodName ajax_get_topics()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function ajax_get_topics()
    {
        $COURSE_ID = $this->input->post("COURSE_ID");
        $query = $this->utilities->findAllByAttribute('aca_course_topics', array("COURSE_ID" => $COURSE_ID, "ACTIVE_STATUS" => 1));
        $returnVal = '<option value="" id="TOPIC_ID" >Select Topics</option>';
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value="' . $row->CRS_TOPIC_ID . '">' . $row->TOPIC_TITLE . '</option>';
            }
        }
        echo $returnVal;
    }

    /**
     * @methodName assignmentById()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function assignmentById()
    {
        $id = $this->input->post('param'); // accessory name
        $data["previlages"] = $this->checkPrevilege("setup/assignment");
        $data['assignment'] = $this->db->query("SELECT aa.*, ac.COURSE_TITLE, ac.COURSE_CODE, act.TOPIC_TITLE
            FROM aca_assignment aa
            INNER JOIN aca_course  ac on ac.COURSE_ID = aa.COURSE_ID
            LEFT JOIN aca_course_topics act on act.CRS_TOPIC_ID = aa.CRS_TOPIC_ID
                                                WHERE aa.ASSIGN_ID = $id")->result(); // select signle data from  aca_assignment
        $this->load->view('admin/setup/assignment/single_assignment_row', $data);
    }

    /**
     * @methodName assignmentList()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function assignmentList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/assignment");
        $data['assignment'] = $this->db->query('SELECT aa.*, ac.COURSE_TITLE, ac.COURSE_CODE, act.TOPIC_TITLE FROM aca_assignment aa
            INNER JOIN aca_course  ac on ac.COURSE_ID = aa.COURSE_ID
            LEFT JOIN aca_course_topics act on act.CRS_TOPIC_ID = aa.CRS_TOPIC_ID
                                                ORDER BY aa.CREATE_DATE DESC')->result(); // select all data from  aca_assignment
        $this->load->view("admin/setup/assignment/assignment_list", $data);
    }

    /**
     * @methodName createAssignment()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function createAssignment()
    {
        $COURSE_ID = $this->input->post('COURSE_ID'); // Course Id
        $TOPIC_ID = $this->input->post('TOPIC_ID'); // Topics Id
        $ASSIGN_TITLE = $this->input->post('ASSIGN_TITLE'); // Assignment Title
        $ASSIGN_DESC = $this->input->post('ASSIGN_DESC'); // Assignment description
        $DIST_ID = $this->input->post('DIST_ID'); //
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Program with this name is already exist
        $check = $this->utilities->hasInformationByThisId("aca_assignment", array('COURSE_ID' => $COURSE_ID, 'ASSIGN_TITLE' => $ASSIGN_TITLE));
        if (empty($check)) {// if Program name available
            // preparing data to insert
            $assignment = array(
                'COURSE_ID' => $COURSE_ID,
                'CRS_TOPIC_ID' => $TOPIC_ID,
                'ASSIGN_TITLE' => $ASSIGN_TITLE,
                'ASSIGN_DESC' => $ASSIGN_DESC,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            $ASSIGN_ID = $this->utilities->insert('aca_assignment', $assignment);
            if ($ASSIGN_ID) { // if data inserted successfully
                if ($DIST_ID == 1) {
                    $SESSION_ID = $this->input->post('SESSION_ID'); //
                    $FACULTY_ID = $this->input->post('FACULTY_ID'); //
                    $DEPT_ID = $this->input->post('DEPT_ID'); //
                    $PROGRAM_ID = $this->input->post('PROGRAM_ID'); //
                    $SEMESTER_ID = $this->input->post('SEMESTER_ID'); //
                    $BATCH_ID = $this->input->post('BATCH_ID'); //
                    $startDate = $this->input->post('startDate'); //
                    $endDate = $this->input->post('endDate'); //

                    $date1 = explode("/", $startDate);
                    $START_DATE = $date1[2] . '-' . $date1[1] . '-' . $date1[0];
                    $date2 = explode("/", $endDate);
                    $END_DATE = $date2[2] . '-' . $date2[1] . '-' . $date2[0];

                    $assignment_distribution = array(
                        'ASSIGN_ID' => $ASSIGN_ID,
                        'USER_ID' => $this->user["USER_ID"],
                        'FACULTY_ID' => $FACULTY_ID,
                        'DEPT_ID' => $DEPT_ID,
                        'PROGRAM_ID' => $PROGRAM_ID,
                        'SESSION_ID' => $SESSION_ID,
                        'SEMESTER_ID' => $SEMESTER_ID,
                        'BATCH_ID' => $BATCH_ID,
                        'COURSE_ID' => $COURSE_ID,
                        'START_DATE' => $START_DATE,
                        'END_DATE' => $END_DATE,
                        'ACTIVE_STATUS' => $status,
                        'CREATED_BY' => $this->user["USER_ID"]
                    );
                    if ($this->utilities->insertData($assignment_distribution, 'aca_assignment_distribution'))
                        ;
                }
                echo "<div class='alert alert-success'>Assignment Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Assignment insert failed</div>";
            }
        } else {// if batch name not available
            echo "<div class='alert alert-danger'>Assignment Already Exist</div>";
        }
    }

    /**
     * @methodName assignmentFormUpdate()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function assignmentFormUpdate()
    {
        $data["ac_type"] = 2;
        $data["flag"] = '';
        $id = $this->input->post('param'); // Assign ID
        $data['assignment'] = $this->db->query("SELECT aa.*, ac.COURSE_TITLE, ac.COURSE_CODE, act.TOPIC_TITLE
            FROM aca_assignment aa
            INNER JOIN aca_course  ac on ac.COURSE_ID = aa.COURSE_ID
            LEFT JOIN aca_course_topics act on act.CRS_TOPIC_ID = aa.CRS_TOPIC_ID
                                                WHERE aa.ASSIGN_ID = $id")->row(); // select all data from degree where degree id
        $this->load->view('admin/setup/assignment/add_assignment', $data);
    }

    /**
     * @methodName updateAssignment()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function updateAssignment()
    {

        $id = $this->input->post('ASSIGN_ID'); // ASSIGN id
        $COURSE_ID = $this->input->post('COURSE_ID'); // Course Id
        $TOPIC_ID = $this->input->post('TOPIC_ID'); // Topics Id
        $ASSIGN_TITLE = $this->input->post('ASSIGN_TITLE'); // Assignment Title
        $ASSIGN_DESC = $this->input->post('ASSIGN_DESC'); // Assignment description
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Program with this name is already exist
        $check = $this->utilities->hasInformationByThisId("aca_assignment", array('COURSE_ID' => $COURSE_ID, 'CRS_TOPIC_ID' => $TOPIC_ID, 'ASSIGN_TITLE' => $ASSIGN_TITLE, 'ASSIGN_ID' != $id));
        if (empty($check)) {// if Program name available
            // preparing data to insert
            $assignment = array(
                'COURSE_ID' => $COURSE_ID,
                'CRS_TOPIC_ID' => $TOPIC_ID,
                'ASSIGN_TITLE' => $ASSIGN_TITLE,
                'ASSIGN_DESC' => $ASSIGN_DESC,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->updateData('aca_assignment', $assignment, array('ASSIGN_ID' => $id))) { // if data inserted successfully
                echo "<div class='alert alert-success'>Assignment Update successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Assignment Update failed</div>";
            }
        } else {// if batch name not available
            echo "<div class='alert alert-danger'>Assignment Already Exist</div>";
        }
    }

    /**
     * @methodName assignmentDistribute()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function assignmentDistribute()
    {
        $data["ac_type"] = 2;
        $data["flag"] = "distribute";
        $data["dimention"] = "vertical";
        $id = $this->input->post('param'); // Assign ID
        $data['faculty'] = $this->utilities->getAll('faculty');
        $data['session'] = $this->utilities->getAll('session_view');
        $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
        $data['assignment'] = $this->db->query("SELECT aa.*, ac.COURSE_TITLE, ac.COURSE_CODE, act.TOPIC_TITLE
            FROM aca_assignment aa
            INNER JOIN aca_course  ac on ac.COURSE_ID = aa.COURSE_ID
            LEFT JOIN aca_course_topics act on act.CRS_TOPIC_ID = aa.CRS_TOPIC_ID
                                                WHERE aa.ASSIGN_ID = $id")->row(); // select all data from degree where degree id
        $this->load->view('admin/setup/assignment/add_assignment', $data);
    }

    /**
     * @methodName assignmentDistribution()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function assignmentDistribution()
    {
        $data['contentTitle'] = 'Distributed Assignment List';
        $data["breadcrumbs"] = array(
            "Teacher" => "#",
            "Distributed Assignment" => '#'
        );
        $data['dimention'] = "horizental";
        $data["ac_type"] = '';
        $data['faculty'] = $this->utilities->findAllByAttribute('faculty', array("ACTIVE_STATUS" => 1, "ADMINISTRATION" => 0));
        $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
        $data["previlages"] = $this->checkPrevilege();
        $id = $this->user["USER_ID"];
        $data['assign_dist'] = $this->db->query("SELECT ad.*,
           aa.ASSIGN_TITLE,
           f.FACULTY_NAME,
           d.DEPT_NAME,
           p.PROGRAM_NAME,
           s.SEMESTER_NAME,
           ac.COURSE_TITLE,
           ac.COURSE_CODE,
           sv.SESSION_NAME
           FROM aca_assignment_distribution ad
           LEFT JOIN aca_assignment aa ON aa.ASSIGN_ID = ad.ASSIGN_ID
           LEFT JOIN faculty f ON f.FACULTY_ID = ad.FACULTY_ID
           LEFT JOIN department d ON d.DEPT_ID = ad.DEPT_ID
           LEFT JOIN program p ON p.PROGRAM_ID = ad.PROGRAM_ID
           LEFT JOIN sav_semester s ON s.SEMESTER_ID = ad.SEMESTER_ID
           LEFT JOIN session_view sv ON sv.SESSION_ID = ad.SESSION_ID
           LEFT JOIN aca_course ac ON ac.COURSE_ID = ad.COURSE_ID
           WHERE ad.USER_ID = $id")->result();
        $data['content_view_page'] = 'admin/setup/assignment_distribute/assign_dist_index';
        $this->admin_template->display($data);
    }

    /**
     * @methodName assignDistFormInsert()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function assignDistFormInsert()
    {

        $data["ac_type"] = 1;
        $data["flag"] = '';
        $data["dimention"] = "vertical";
        $id = $this->user["USER_ID"];
        $data['course'] = $this->db->query("SELECT DISTINCT  ac.COURSE_TITLE, ac.COURSE_CODE, ad.COURSE_ID
          FROM aca_assignment_distribution ad
          INNER JOIN aca_course ac on ac.COURSE_ID = ad.COURSE_ID
          WHERE ad.USER_ID = $id")->result();
        $data['faculty'] = $this->utilities->getAll('faculty');
        $data['session'] = $this->utilities->getAll("session_view");
        $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
        $this->load->view('admin/setup/assignment_distribute/add_assignment', $data);
    }

    /**
     * @methodName ajax_get_assignment()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function createAssignDist()
    {
        $COURSE_ID = $this->input->post('COURSE_ID'); // Course Id
        $ASSIGN_ID = $this->input->post('ASSIGN_ID'); // Assignment Id
        $SESSION_ID = $this->input->post('SESSION_ID'); //
        $FACULTY_ID = $this->input->post('FACULTY_ID'); //
        $DEPT_ID = $this->input->post('DEPT_ID'); //
        $PROGRAM_ID = $this->input->post('PROGRAM_ID'); //
        $SEMESTER_ID = $this->input->post('SEMESTER_ID'); //
        $BATCH_ID = $this->input->post('BATCH_ID'); //
        $startDate = $this->input->post('startDate'); //
        $endDate = $this->input->post('endDate'); //
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status

        $date1 = explode("/", $startDate);
        $START_DATE = $date1[2] . '-' . $date1[1] . '-' . $date1[0];
        $date2 = explode("/", $endDate);
        $END_DATE = $date2[2] . '-' . $date2[1] . '-' . $date2[0];

        // checking if Program with this name is already exist
        $check = $this->utilities->hasInformationByThisId("aca_assignment_distribution", array('ASSIGN_ID' => $ASSIGN_ID, 'USER_ID' => $this->user["USER_ID"], 'PROGRAM_ID' => $PROGRAM_ID, 'SESSION_ID' => $SESSION_ID, 'SEMESTER_ID' => $SEMESTER_ID, 'BATCH_ID' => $BATCH_ID,));
        // echo "<pre>"; print_r($this->db->last_query()); exit; echo "</pre>";
        if (empty($check)) {// if Program name available
            // preparing data to insert
            $assignment_distribution = array(
                'ASSIGN_ID' => $ASSIGN_ID,
                'USER_ID' => $this->user["USER_ID"],
                'FACULTY_ID' => $FACULTY_ID,
                'DEPT_ID' => $DEPT_ID,
                'PROGRAM_ID' => $PROGRAM_ID,
                'SESSION_ID' => $SESSION_ID,
                'SEMESTER_ID' => $SEMESTER_ID,
                'BATCH_ID' => $BATCH_ID,
                'COURSE_ID' => $COURSE_ID,
                'START_DATE' => $START_DATE,
                'END_DATE' => $END_DATE,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            //  echo "<pre>"; print_r($assignment_distribution); exit; echo "</pre>";
            if ($this->utilities->insertData($assignment_distribution, 'aca_assignment_distribution')) {
                echo "<div class='alert alert-success'>Assignment Distribution Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Assignment Distribution insert failed</div>";
            }
        } else {// if batch name not available
            echo "<div class='alert alert-danger'>Assignment Distribution Already Exist</div>";
        }
    }

    /**
     * @methodName ajax_get_assignment()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function ajax_get_assignment()
    {
        $COURSE_ID = $this->input->post("COURSE_ID");
        $query = $this->utilities->findAllByAttribute('aca_assignment', array("COURSE_ID" => $COURSE_ID, "ACTIVE_STATUS" => 1));
        $returnVal = '<option value="" id="ASSIGN_ID" >Select Assignment</option>';
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value="' . $row->ASSIGN_ID . '">' . $row->ASSIGN_TITLE . '</option>';
            }
        }
        echo $returnVal;
    }

    /**
     * @methodName assignDistList()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function assignDistList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/assignmentDistribution");
        $id = $this->user["USER_ID"];
        $data['assign_dist'] = $this->db->query("SELECT ad.*, aa.ASSIGN_TITLE, f.FACULTY_NAME, d.DEPT_NAME, p.PROGRAM_NAME, s.SEMESTER_NAME, ac.COURSE_TITLE, ac.COURSE_CODE, sv.SESSION_NAME
            FROM aca_assignment_distribution ad
            INNER JOIN aca_assignment aa on aa.ASSIGN_ID = ad.ASSIGN_ID
            INNER JOIN faculty f on f.FACULTY_ID = ad.FACULTY_ID
            INNER JOIN department d on d.DEPT_ID = ad.DEPT_ID
            INNER JOIN program p on p.PROGRAM_ID = ad.PROGRAM_ID
            INNER JOIN sav_semester s on s.SEMESTER_ID = ad.SEMESTER_ID
            INNER JOIN session_view sv on sv.SESSION_ID = ad.SESSION_ID
            INNER JOIN aca_course ac on ac.COURSE_ID = ad.COURSE_ID
                                                WHERE ad.USER_ID = $id")->result(); // select all data from  aca_assignment
        $this->load->view("admin/setup/assignment_distribute/assign_dist_list", $data);
    }

    /**
     * @methodName assignDistById()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function assignDistById()
    {
        $ASSIGN_ID = $this->input->post('param'); // accessory name
        $id = $this->user["USER_ID"];
        $data["previlages"] = $this->checkPrevilege("setup/assignmentDistribution");
        $data['assign_dist'] = $this->db->query("SELECT ad.*, aa.ASSIGN_TITLE, f.FACULTY_NAME, d.DEPT_NAME, p.PROGRAM_NAME, s.SEMESTER_NAME, ac.COURSE_TITLE, ac.COURSE_CODE, sv.SESSION_NAME
            FROM aca_assignment_distribution ad
            INNER JOIN aca_assignment aa on aa.ASSIGN_ID = ad.ASSIGN_ID
            INNER JOIN faculty f on f.FACULTY_ID = ad.FACULTY_ID
            INNER JOIN department d on d.DEPT_ID = ad.DEPT_ID
            INNER JOIN program p on p.PROGRAM_ID = ad.PROGRAM_ID
            INNER JOIN sav_semester s on s.SEMESTER_ID = ad.SEMESTER_ID
            INNER JOIN session_view sv on sv.SESSION_ID = ad.SESSION_ID
            INNER JOIN aca_course ac on ac.COURSE_ID = ad.COURSE_ID
                                                WHERE ad.USER_ID = $id AND ad.AS_DIST_ID = $ASSIGN_ID")->result(); // select signle data from  aca_assignment
        $this->load->view('admin/setup/assignment_distribute/single_assign_dist_row', $data);
    }

    /**
     * @methodName assignDistFormUpdate()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function assignDistFormUpdate()
    {
        $data["ac_type"] = 'edit';
        $id = $this->input->post('param'); // AS_DIST_ID
        $data['dimention'] = "vertical";
        $data['previous_info'] = $this->db->query("SELECT ad.*, aa.ASSIGN_TITLE, f.FACULTY_NAME, d.DEPT_NAME, p.PROGRAM_NAME, s.SEMESTER_NAME, ac.COURSE_TITLE, ac.COURSE_CODE, ses.SESSION_NAME, ys.YEAR_SETUP_TITLE
            FROM aca_assignment_distribution ad
            INNER JOIN aca_assignment aa on aa.ASSIGN_ID = ad.ASSIGN_ID
            INNER JOIN faculty f on f.FACULTY_ID = ad.FACULTY_ID
            INNER JOIN department d on d.DEPT_ID = ad.DEPT_ID
            INNER JOIN program p on p.PROGRAM_ID = ad.PROGRAM_ID
            INNER JOIN sav_semester s on s.SEMESTER_ID = ad.SEMESTER_ID
            INNER JOIN session_year sy on sy.SES_YEAR_ID = ad.SESSION_ID
            INNER JOIN session ses on ses.SESSION_ID = sy.SESSION
            INNER JOIN year_setup ys on ys.YEAR_SETUP_ID = sy.SES_YEAR_ID
            INNER JOIN aca_course ac on ac.COURSE_ID = ad.COURSE_ID
                                                WHERE ad.AS_DIST_ID = $id")->row(); // select all data from degree where degree id
        $data['faculty'] = $this->utilities->getAll('faculty');
        $data['department'] = $this->utilities->getAll('department');
        $data['program'] = $this->utilities->getAll('program');
        $data['session'] = $this->utilities->semesterSession();
        $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
        $this->load->view('admin/setup/assignment_distribute/add_assign_dist', $data);
    }

    /**
     * @methodName updateAssignDist()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function updateAssignDist()
    {
        $AS_DIST_ID = $this->input->post('AS_DIST_ID'); // ASSIGN id
        $COURSE_ID = $this->input->post('COURSE_ID'); // Course Id
        $TOPIC_ID = $this->input->post('TOPIC_ID'); // Topics Id
        $SESSION_ID = $this->input->post('SESSION_ID'); //
        $FACULTY_ID = $this->input->post('FACULTY_ID'); //
        $DEPT_ID = $this->input->post('DEPT_ID'); //
        $PROGRAM_ID = $this->input->post('PROGRAM_ID'); //
        $SEMESTER_ID = $this->input->post('SEMESTER_ID'); //
        $startDate = $this->input->post('startDate'); //
        $endDate = $this->input->post('endDate'); //
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status

        $date1 = explode("/", $startDate);
        $START_DATE = $date1[2] . '-' . $date1[1] . '-' . $date1[0];
        $date2 = explode("/", $endDate);
        $END_DATE = $date2[2] . '-' . $date2[1] . '-' . $date2[0];
        $check = $this->utilities->hasInformationByThisId("aca_assignment_distribution", array('FACULTY_ID' => $FACULTY_ID, 'DEPT_ID' => $DEPT_ID, 'PROGRAM_ID' => $PROGRAM_ID, 'SESSION_ID' => $SESSION_ID, 'SEMESTER_ID' => $SEMESTER_ID, 'COURSE_ID' => $COURSE_ID, 'START_DATE' => $START_DATE, 'END_DATE' => $END_DATE, 'AS_DIST_ID' != $AS_DIST_ID));
        if (empty($check)) {// if Program name available
            // preparing data to insert
            $assignment_distribution = array(
                'USER_ID' => $this->user["USER_ID"],
                'FACULTY_ID' => $FACULTY_ID,
                'DEPT_ID' => $DEPT_ID,
                'PROGRAM_ID' => $PROGRAM_ID,
                'SESSION_ID' => $SESSION_ID,
                'SEMESTER_ID' => $SEMESTER_ID,
                'COURSE_ID' => $COURSE_ID,
                'START_DATE' => $START_DATE,
                'END_DATE' => $END_DATE,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->updateData('aca_assignment_distribution', $assignment_distribution, array('AS_DIST_ID' => $AS_DIST_ID))) {
                echo "<div class='alert alert-success'>Assignment Distribution Update successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Assignment Distribution Update failed</div>";
            }
        } else {// if batch name not available
            echo "<div class='alert alert-danger'>Assignment Distribution Already Exist</div>";
        }
    }

    /**
     * @methodName brAccessoriesById()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function blogCatIndex()
    {
        $data['contentTitle'] = 'Blog Category';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Blog Category List' => '#',
        );

        $data['blog_category'] = $this->utilities->findAllFromView('blog_category');
        $data['content_view_page'] = 'admin/setup/blog_category/blog_cat_index';
        $this->admin_template->display($data);
    }

    /**
     * @methodName brAccessoriesById()
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return Mixed Template
     */
    function addBlogCat()
    {
        $data["ac_type"] = 1;
        $this->load->view('admin/setup/blog_category/add_blog_cat', $data);
    }

    function createBlogCat()
    {
        $BL_CATEGORY = $this->input->post('BL_CATEGORY'); // degree name
        $BL_CATEGORY_DESC = $this->input->post('BL_CATEGORY_DESC'); // degree name
        $status = $this->input->post('ACTIVE_STATUS'); // active status
        // checking if Degree with this name is already exist
        $check = $this->utilities->hasInformationByThisId("blog_category", array("BL_CATEGORY" => $BL_CATEGORY));
        if (empty($check)) {// if Degree name available
            // preparing data to insert
            $blog_cat = array(
                'BL_CATEGORY' => $BL_CATEGORY,
                'BL_CATEGORY_DESC' => $BL_CATEGORY_DESC,
                'ACTIVE_STATUS' => $status,
                'ENTERED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->insertData($blog_cat, 'blog_category')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Blog Category Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Blog Category Name insert failed</div>";
            }
        } else {// if degree name not available
            echo "<div class='alert alert-danger'>Blog Category Name Already Exist</div>";
        }
    }

    function blogCatList()
    {

        $data['blog_category'] = $this->utilities->findAllFromView('blog_category'); // select all data from degree
        $this->load->view("admin/setup/blog_category/blog_cat_list", $data);
    }

    function blogCatUpdate()
    {
        $data["ac_type"] = 2;
        $id = $this->input->post('param'); // degree ID
        $data['blog_category'] = $this->utilities->findByAttribute('blog_category', array('BL_CAT_ID' => $id)); // select all data from degree where degree id
        $this->load->view('admin/setup/blog_category/add_blog_cat', $data);
    }

    function updateBlogCat()
    {
//        echo "<pre>";
//        print_r($_POST);
//        exit;
        $BL_CAT_ID = $this->input->post('BL_CAT_ID'); // degree name
        $BL_CATEGORY = $this->input->post('BL_CATEGORY'); // degree name
        $BL_CATEGORY_DESC = $this->input->post('BL_CATEGORY_DESC'); // degree name

        $status = $this->input->post('ACTIVE_STATUS'); // active status
        // checking if Degree with this name is already exist
        $check = $this->utilities->hasInformationByThisId("blog_category", array("BL_CATEGORY" => $BL_CATEGORY, "BL_CAT_ID !=" => $BL_CAT_ID));

        if (empty($check)) {// if Degree name available
            // preparing data to insert
            $blog_cat = array(
                'BL_CATEGORY' => $BL_CATEGORY,
                'BL_CATEGORY_DESC' => $BL_CATEGORY_DESC,
                'ACTIVE_STATUS' => $status,
                'ENTERED_BY' => $this->user["USER_ID"]
            );
            //var_dump($degree); exit();
            if ($this->utilities->updateData('blog_category', $blog_cat, array('BL_CAT_ID' => $BL_CAT_ID))) { // if data update successfully
                echo "<div class='alert alert-success'>Blog category Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Blog category Name Update failed</div>";
            }
        } else {// if degree name not available
            echo "<div class='alert alert-danger'>Blog category Name Already Exist</div>";
        }
    }

    function blogCatById()
    {
        $BL_CAT_ID = $this->input->post('param'); // degree name

        $data['row'] = $this->utilities->findByAttribute('blog_category', array('BL_CAT_ID' => $BL_CAT_ID)); // select all data from degree where degree id

        $this->load->view('admin/setup/blog_category/single_blog_cat_row', $data);
    }

    function blog()
    {

        $data['content_view_page'] = 'admin/setup/blog_category/blog';

        $this->admin_template->display($data);
    }

    function bank()
    {
        $data['contentTitle'] = 'Bank List';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Bank List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        // print_r($data["previlages"]);exit;
        $data['bank'] = $this->utilities->findAllFromView('bank');
        $data['content_view_page'] = 'admin/setup/bank/bank_index';
        $this->admin_template->display($data);
    }

    function bankFormInsert()
    {
        $data["ac_type"] = 1;
        $this->load->view('admin/setup/bank/add_bank', $data);
    }

    function createBank()
    {
        $BANK_NAME = $this->input->post('BANK_NAME'); // district name
        $ADDRESS = $this->input->post('ADDRESS');
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if district with this name is already exist
        $check = $this->utilities->hasInformationByThisId("bank", array("BANK_NAME" => $BANK_NAME));
        if (empty($check)) {// if district name available
            // preparing data to insert
            $bank = array(
                'BANK_NAME' => $BANK_NAME,
                'ADDRESS' => $ADDRESS,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->insertData($bank, 'bank')) {
                echo "<div class='alert alert-success'>Bank Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Bank Name insert failed</div>";
            }
        } else {// if District name not available
            echo "<div class='alert alert-danger'>Bank Name Already Exist</div>";
        }
    }

    function bankList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/district");
        $data['bank'] = $this->utilities->findAllFromView("bank");
        $this->load->view("admin/setup/bank/bank_list", $data);
    }

    function updateBank()
    {
//        echo "<pre>";
//        print_r($_POST);
//        exit;
        $BANK_ID = $this->input->post('BANK_ID'); // division name
        $BANK_NAME = $this->input->post('BANK_NAME'); // division name
        $ADDRESS = $this->input->post('ADDRESS');
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if division with this name is already exist
        $check = $this->utilities->hasInformationByThisId("bank", array("BANK_NAME" => $BANK_NAME, "BANK_ID !=" => $BANK_ID));
        if (empty($check)) {// if division name available
            // preparing data to insert
            $bank = array(
                'BANK_NAME' => $BANK_NAME,
                'ADDRESS' => $ADDRESS,
                'ACTIVE_STATUS' => $status,
                'UPDATED_BY' => $this->user['USER_ID'],
                'UPDATE_DATE' => date("Y-m-d h:i:s a")
            );
            //var_dump($division); exit();
            if ($this->utilities->updateData('bank', $bank, array('BANK_ID' => $BANK_ID))) { // if data update successfully
                echo "<div class='alert alert-success'>Bank  Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Bank  Name Update failed</div>";
            }
        } else {// if District name not available
            echo "<div class='alert alert-danger'>Bank Name Already Exist</div>";
        }
    }

    function bankById()
    {
        $bank_id = $this->input->post('param'); // district name
        $data["previlages"] = $this->checkPrevilege("setup/district");
        $data['row'] = $this->utilities->findByAttribute('bank', array('BANK_ID' => $bank_id)); // select all data from district where district id
        $this->load->view('admin/setup/bank/single_bank_row', $data);
    }

    function bankFormUpdate()
    {
        $data["ac_type"] = 2;
        $id = $this->input->post('param'); // district ID
        $data['bank'] = $this->utilities->findByAttribute('bank', array('BANK_ID' => $id)); // select all data from district where district id
        $this->load->view('admin/setup/bank/add_bank', $data);
    }

    function bankBranch()
    {
        $data['contentTitle'] = 'Bank Branch';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            ' Bank Branch List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        // print_r($data["previlages"]);exit;
        $data['bank_branch'] = $this->utilities->findAllByAttributeWithJoin('bank', 'bank_branch', 'BANK_ID', 'BANK_ID', '*', '', '');
        $data['content_view_page'] = 'admin/setup/bank_branch/bank_branch_index';
        $this->admin_template->display($data);
    }

    function bankBranchFormInsert()
    {
        $data["ac_type"] = 1;
        $data['bank'] = $this->db->query("select * from bank")->result();
        $this->load->view('admin/setup/bank_branch/add_bank_branch', $data);
    }

    function createBankBranch()
    {
        $BANK_BRANCH_NAME = $this->input->post('BANK_BRANCH_NAME');
        $BANK_ID = $this->input->post('BANK_ID');
        $ADDRESS = $this->input->post('ADDRESS');
        $status = ((isset($_POST['status'])) ? 1 : 0);
        $check = $this->utilities->hasInformationByThisId("bank_branch", array("BANK_BRANCH_NAME" => $BANK_BRANCH_NAME, "BANK_ID" => $BANK_ID));
        if (empty($check)) {// if district name available
            // preparing data to insert
            $bank_branch = array(
                'BANK_BRANCH_NAME' => $BANK_BRANCH_NAME,
                'BANK_ID' => $BANK_ID,
                'ADDRESS' => $ADDRESS,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->insertData($bank_branch, 'bank_branch')) {
                echo "<div class='alert alert-success'>Bank Branch Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Bank Branch Name insert failed</div>";
            }
        } else {// if District name not available
            echo "<div class='alert alert-danger'>Bank Branch Name Already Exist</div>";
        }
    }

    function bankBranchList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/district");
        $data['bank_branch'] = $this->utilities->findAllByAttributeWithJoin('bank', 'bank_branch', 'BANK_ID', 'BANK_ID', '*', '', '');
        // print_r($data['bank_branch']);exit;
        $this->load->view("admin/setup/bank_branch/bank_branch_list", $data);
    }

    function updateBankBranch()
    {

        $BANK_BRANCH_ID = $this->input->post('BANK_BRANCH_ID'); // division name
        $BANK_ID = $this->input->post('BANK_ID'); // division name
        $BANK_BRANCH_NAME = $this->input->post('BANK_BRANCH_NAME'); // division name
        $ADDRESS = $this->input->post('ADDRESS');
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if division with this name is already exist
        $check = $this->utilities->hasInformationByThisId("bank_branch", array("BANK_BRANCH_NAME" => $BANK_BRANCH_NAME, "BANK_BRANCH_ID !=" => $BANK_BRANCH_ID));
        if (empty($check)) {// if division name available
            // preparing data to insert
            $bank = array(
                'BANK_BRANCH_NAME' => $BANK_BRANCH_NAME,
                'ADDRESS' => $ADDRESS,
                'BANK_ID' => $BANK_ID,
                'ACTIVE_STATUS' => $status,
                'UPDATED_BY' => $this->user['USER_ID'],
                'UPDATE_DATE' => date("Y-m-d h:i:s a")
            );
            //var_dump($division); exit();
            if ($this->utilities->updateData('bank_branch', $bank, array('BANK_BRANCH_ID' => $BANK_BRANCH_ID))) { // if data update successfully
                echo "<div class='alert alert-success'>Bank  Branch Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Bank  Branch Name Update failed</div>";
            }
        } else {// if District name not available
            echo "<div class='alert alert-danger'>Bank Branch  Name Already Exist</div>";
        }
    }

    function bankBranchById()
    {
        $bank_id = $this->input->post('param'); // district name
        $data["previlages"] = $this->checkPrevilege("setup/district");

        $data['row'] = $this->utilities->findByAttributeWithJoin('bank', 'bank_branch', 'BANK_ID', 'BANK_ID', '*', array('BANK_BRANCH_ID' => $bank_id), '');

        $this->load->view('admin/setup/bank_branch/single_bank_branch_row', $data);
    }

    function bankBranchFormUpdate()
    {
        $data["ac_type"] = 2;
        $id = $this->input->post('param'); // district ID
        $data['bank'] = $this->db->query("select * from bank")->result();
        $data['bank_branch'] = $this->utilities->findByAttribute('bank_branch', array('BANK_BRANCH_ID' => $id)); // select all data from district where district id
        $this->load->view('admin/setup/bank_branch/add_bank_branch', $data);
    }

    function appPolicy()
    {
        $data['contentTitle'] = 'Application Policy';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Application Policy List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        // print_r($data["previlages"]);exit;
        $data['app_policy'] = $this->utilities->findAllFromView('app_policy');
        $data['content_view_page'] = 'admin/setup/app_policy/app_policy_index';
        $this->admin_template->display($data);
    }

    function appPolicyFormInsert()
    {
        $data["ac_type"] = 1;
        $this->load->view('admin/setup/app_policy/add_app_policy', $data);
    }

    function createAppPolicy()
    {
        $POLICY_NAME = $this->input->post('POLICY_NAME');
        $POLICY_DESC = $this->input->post('POLICY_DESC');
        $status = ((isset($_POST['status'])) ? 1 : 0);
        $POLICY_FLAG = ((isset($_POST['POLICY_FLAG'])) ? 1 : 0);
        // checking if district with this name is already exist
        $check = $this->utilities->hasInformationByThisId("app_policy", array("POLICY_NAME" => $POLICY_NAME));
        if (empty($check)) {// if district name available
            // preparing data to insert
            $app_policy = array(
                'POLICY_NAME' => $POLICY_NAME,
                'POLICY_DESC' => $POLICY_DESC,
                'ACTIVE_FLAG' => $status,
                'POLICY_FLAG' => $POLICY_FLAG

            );
            if ($this->utilities->insertData($app_policy, 'app_policy')) {
                echo "<div class='alert alert-success'>App Policy Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>App Policy Name insert failed</div>";
            }
        } else {// if District name not available
            echo "<div class='alert alert-danger'>App Policy Name Already Exist</div>";
        }
    }

    function appPolicyList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/district");
        $data['app_policy'] = $this->utilities->findAllFromView("app_policy");
        $this->load->view("admin/setup/app_policy/app_policy_list", $data);
    }

    function updateAppPolicy()
    {
        $POLICY_ID = $this->input->post('POLICY_ID');
        $POLICY_NAME = $this->input->post('POLICY_NAME');
        $POLICY_DESC = $this->input->post('POLICY_DESC');
        $status = ((isset($_POST['status'])) ? 1 : 0);
        $POLICY_FLAG = ((isset($_POST['POLICY_FLAG'])) ? 1 : 0);
        // checking if division with this name is already exist
        $check = $this->utilities->hasInformationByThisId("app_policy", array("POLICY_NAME" => $POLICY_NAME, "POLICY_ID !=" => $POLICY_ID));
        if (empty($check)) {// if division name available
            // preparing data to insert
            $app_policy = array(
                'POLICY_NAME' => $POLICY_NAME,
                'POLICY_DESC' => $POLICY_DESC,
                'ACTIVE_FLAG' => $status,
                'POLICY_FLAG' => $POLICY_FLAG
            );
            //var_dump($division); exit();
            if ($this->utilities->updateData('app_policy', $app_policy, array('POLICY_ID' => $POLICY_ID))) { // if data update successfully
                echo "<div class='alert alert-success'>App Policy  Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>App Policy  Name Update failed</div>";
            }
        } else {// if District name not available
            echo "<div class='alert alert-danger'>App Policy Name Already Exist</div>";
        }
    }

    function appPolicyById()
    {
        $app_policy_id = $this->input->post('param'); // district name
        $data["previlages"] = $this->checkPrevilege("setup/district");
        $data['row'] = $this->utilities->findByAttribute('app_policy', array('POLICY_ID' => $app_policy_id)); // select all data from district where district id
        $this->load->view('admin/setup/app_policy/single_app_policy_row', $data);
    }

    function appPolicyFormUpdate()
    {
        $data["ac_type"] = 2;
        $id = $this->input->post('param'); // district ID
        $data['app_policy'] = $this->utilities->findByAttribute('app_policy', array('POLICY_ID' => $id)); // select all data from district where district id
        $this->load->view('admin/setup/app_policy/add_app_policy', $data);
    }

    // committttee setup form
    function committeeType()
    {
        $data['contentTitle'] = 'Committee Type';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Committee Type List' => '#',
        );
        $data['com_type'] = $this->utilities->findAllFromView('committee');
        $data['content_view_page'] = 'admin/setup/committee/com_type/com_type_index';
        $this->admin_template->display($data);
    }

    function committeeTypeFormInsert()
    {
        $data["ac_type"] = 1;
        $this->load->view('admin/setup/committee/com_type/add_com_type', $data);
    }

    function createCommitteeType()
    {
        $COM_TITLE = $this->input->post('COM_TITLE');
        $COM_DESC = $this->input->post('COM_DESC');
        $status = ((isset($_POST['status'])) ? 1 : 0);
        $check = $this->utilities->hasInformationByThisId("committee", array("COM_TITLE" => $COM_TITLE));
        if (empty($check)) {
            $committee = array(
                'COM_TITLE' => $COM_TITLE,
                'COM_DESC' => $COM_DESC,
                'ACTIVE_STATUS' => $status
            );
            if ($this->utilities->insertData($committee, 'committee')) {
                echo "<div class='alert alert-success'>Committee Type Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Committee Type insert failed</div>";
            }
        } else {// if District name not available
            echo "<div class='alert alert-danger'>Committee Type Name Already Exist</div>";
        }
    }

    function committeeTypeList()
    {
        $data['com_type'] = $this->utilities->findAllFromView("committee");
        $this->load->view("admin/setup/committee/com_type/com_type_list", $data);
    }

    function updateCommitteeType()
    {
        $COM_ID = $this->input->post('COM_ID');
        $COM_DESC = $this->input->post('COM_TITLE');
        $COM_TITLE = $this->input->post('COM_DESC');
        $status = ((isset($_POST['status'])) ? 1 : 0);
        $check = $this->utilities->hasInformationByThisId("committee", array("COM_TITLE" => $COM_TITLE, "COM_ID !=" => $COM_ID));
        if (empty($check)) {// if division name available
            // preparing data to insert
            $committee = array(
                'COM_TITLE' => $COM_TITLE,
                'COM_DESC' => $COM_DESC,
                'ACTIVE_STATUS' => $status
            );
            //var_dump($division); exit();
            if ($this->utilities->updateData('committee', $committee, array('COM_ID' => $COM_ID))) {
                echo "<div class='alert alert-success'>Committee Type  Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Committee Type  Name Update failed</div>";
            }
        } else {// if District name not available
            echo "<div class='alert alert-danger'>Committee Type Name Already Exist</div>";
        }
    }

    function committeeTypeById()
    {
        $COM_ID = $this->input->post('param');

        $data['row'] = $this->utilities->findByAttribute('committee', array('COM_ID' => $COM_ID)); // select all data from district where district id
        $this->load->view('admin/setup/committee/com_type/single_com_type_row', $data);
    }

    function committeeTypeFormUpdate()
    {
        $data["ac_type"] = 2;
        $id = $this->input->post('param');
        $data['com_type'] = $this->utilities->findByAttribute('committee', array('COM_ID' => $id)); // select all data from district where district id
        $this->load->view('admin/setup/committee/com_type/add_com_type', $data);
    }

    //committee member setup
    function comMem()
    {
        $data['pageTitle'] = 'View All Committee Member';
        $data['breadcrumbs'] = array(
            'All Committee Member List' => '#',
        );
        $data['com_member'] = $this->db->query("SELECT a.*,
           b.FULL_NAME,
           c.DESIGNATION,
           d.COM_TITLE
           FROM committee_member a
           LEFT JOIN sa_users b ON a.USER_ID = b.USER_ID
           LEFT JOIN designations c ON a.DESIGNATION_ID = c.DESIGNATION_ID
           LEFT JOIN committee d ON a.COM_ID = d.COM_ID")->result();
        $data['content_view_page'] = 'admin/setup/committee/member/com_member_index';
        $this->admin_template->display($data);
    }

    function comMemFormInsert()
    {
        $data["ac_type"] = 1;
        $data['contentTitle'] = 'Committee Member';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Committee Member List' => '#',
        );
        $data['committee'] = $this->db->query("select * from committee")->result();
        $data['user'] = $this->db->query("select * from sa_users")->result();
        $data['designations'] = $this->db->query("select * from designations")->result();
        $data['content_view_page'] = 'admin/setup/committee/member/add_com_member';
        $this->admin_template->display($data);

    }

    function memberListByComId()
    {
        $COM_ID = $this->input->post('COM_ID');
        $data['member_list'] = $this->db->query("select a.*,b.FULL_NAME,c.DESIGNATION from committee_member a
            left join sa_users b on a.USER_ID = b.USER_ID
            left join designations c on a.DESIGNATION_ID = c.DESIGNATION_ID
            WHERE a.COM_ID =$COM_ID")->result();

        $this->load->view('admin/setup/committee/member/member_lsit_com_id', $data);
    }

    function createComMem()
    {
        $USER_ID = $this->input->post('USER_ID');
        $COM_ID = $this->input->post('COM_ID');
        $DESIGNATION_ID = $this->input->post('DESIGNATION_ID');
        $EX_COM_DESC = $this->input->post('EX_COM_DESC');
        $status = ((isset($_POST['status'])) ? 1 : 0);

        $committee_member = array(
            'COM_ID' => $COM_ID,
            'USER_ID' => $USER_ID,
            'DESIGNATION_ID' => $DESIGNATION_ID,
            'EX_COM_DESC' => $EX_COM_DESC,
            'ACTIVE_STATUS' => $status
        );
        $check = $this->utilities->hasInformationByThisId("committee_member", array("USER_ID" => $USER_ID, "COM_ID" => $COM_ID));
        if (!empty($check)) {
            echo "D";
        } else {
            $this->utilities->insertData($committee_member, 'committee_member');

            echo "Y";
        }


    }

    function comMemList()
    {
        $data['com_member'] = $this->db->query("SELECT a.*,
           b.FULL_NAME,
           c.DESIGNATION,
           d.COM_TITLE
           FROM committee_member a
           LEFT JOIN sa_users b ON a.USER_ID = b.USER_ID
           LEFT JOIN designations c ON a.DESIGNATION_ID = c.DESIGNATION_ID
           LEFT JOIN committee d ON a.COM_ID = d.COM_ID")->result();
        $this->load->view("admin/setup/committee/member/com_member_list", $data);
    }

    function updateComMem()
    {
        $COM_MEMBER_ID = $this->input->post('COM_MEMBER_ID');
        $COM_ID = $this->input->post('COM_ID');
        $USER_ID = $this->input->post('USER_ID');
        $DESIGNATION_ID = $this->input->post('DESIGNATION_ID');
        $EX_COM_DESC = $this->input->post('EX_COM_DESC');
        $status = ((isset($_POST['status'])) ? 1 : 0);
        $check = $this->utilities->hasInformationByThisId("committee_member", array("COM_ID" => $COM_ID, "COM_MEMBER_ID !=" => $COM_MEMBER_ID));
        if (empty($check)) {// if division name available
            // preparing data to insert
            $committee_member = array(
                'COM_ID' => $COM_ID,
                'USER_ID' => $USER_ID,
                'DESIGNATION_ID' => $DESIGNATION_ID,
                'EX_COM_DESC' => $EX_COM_DESC,
                'ACTIVE_STATUS' => $status
            );
            //var_dump($division); exit();
            if ($this->utilities->updateData('committee_member', $committee_member, array('COM_MEMBER_ID' => $COM_MEMBER_ID))) {
                echo "<div class='alert alert-success'>Committee Member  Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Committee Member   Update failed</div>";
            }
        } else {// if District name not available
            echo "<div class='alert alert-danger'>Committee Member Already Exist</div>";
        }
    }

    function comMemById()
    {
        $COM_MEMBER_ID = $this->input->post('param');
        $data['row'] = $this->utilities->findByAttribute('committee_member', array('COM_MEMBER_ID' => $COM_MEMBER_ID)); // select all data from district where district id
        $data['row'] = $this->db->query("SELECT a.*,
           b.FULL_NAME,
           c.DESIGNATION,
           d.COM_TITLE
           FROM committee_member a
           LEFT JOIN sa_users b ON a.USER_ID = b.USER_ID
           LEFT JOIN designations c ON a.DESIGNATION_ID = c.DESIGNATION_ID
           LEFT JOIN committee d ON a.COM_ID = d.COM_ID where a.COM_MEMBER_ID=$COM_MEMBER_ID")->row();
        $this->load->view('admin/setup/committee/member/single_com_member_row', $data);
    }

    function comMemFormUpdate()
    {
        $data["ac_type"] = 2;
        $id = $this->input->post('param');
        $data['committee'] = $this->db->query("select * from committee")->result();
        $data['user'] = $this->db->query("select * from sa_users")->result();
        $data['designations'] = $this->db->query("select * from designations")->result();
        $data['com_member'] = $this->utilities->findByAttribute('committee_member', array('COM_MEMBER_ID' => $id)); // select all data from district where district id
        $this->load->view('admin/setup/committee/member/add_com_member', $data);
    }
    /*new add applicantRegPeriod*/
    /**
     * @access none
     * @param  none
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function applicantRegPeriod()
    {
        $data['contentTitle'] = 'Admission Registration Period';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Admission Registration Period List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['admissionPeriod'] = $this->db->query("SELECT adi.*, f.FACULTY_NAME, d.DEPT_NAME, p.PROGRAM_NAME, sv.SESSION_NAME
            FROM adm_passed_app_reg_period adi
            INNER JOIN faculty f on f.FACULTY_ID = adi.FACULTY_ID
            INNER JOIN department d on d.DEPT_ID = adi.DEPT_ID
            INNER JOIN program p on p.PROGRAM_ID = adi.PROGRAM_ID
            INNER JOIN session_view sv on sv.SESSION_ID = adi.SESSION_ID")->result();
        $data['content_view_page'] = 'admin/applicant/registration_period/reg_index';

        $this->admin_template->display($data);
    }

    /**
     * @access none
     * @param  none
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function applicantRegPeriodForm()
    {
        $data['current_date'] = $this->input->post('date');
        $data["ac_type"] = 1; /* Insertion form */
        $data["session"] = $this->utilities->findByAttribute("session_view", array("IS_ADMISSION" => '1')); // select Current session
        $data["faculty"] = $this->utilities->findAllByAttribute("faculty", array("ADMINISTRATION" => 0)); // select all faculty     
        $data["program"] = $this->utilities->getAll("program"); // select all program        
        $this->load->view('admin/applicant/registration_period/add_reg_period', $data);
    }

    /**
     * @access none
     * @param  faculty_id
     * @return view
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    public function programByFaculty()
    {
        $faculty_id = $_POST['faculty'];
        $query = $this->utilities->findAllByAttribute('ins_program', array("FACULTY_ID" => $faculty_id, "ACTIVE_STATUS" => 1));
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value = "' . $row->PROGRAM_ID . '">' . $row->PROGRAM_NAME . '</option>';
            }
        }
        echo $returnVal;
    }

    /**
     * @access none
     * @param  faculty_id
     * @return view
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    public function programByFacultyDegree()
    {
        $faculty_id = $_POST['faculty'];
        $degree_id = $_POST['degree'];
        $returnVal = '';
        $query = $this->utilities->findAllByAttribute('ins_program', array("FACULTY_ID" => $faculty_id, "DEGREE_ID" => $degree_id, "ACTIVE_STATUS" => 1));
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value = "' . $row->PROGRAM_ID . '">' . $row->PROGRAM_NAME . '</option>';
            }
        }
        echo $returnVal;
    }

    /**
     * @param
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function applicantRegPeriodFormUpdate()
    {
        $data["ac_type"] = "edit";
        $regPerId = $this->input->post('param'); // faculty ID
        $data["program"] = $this->utilities->getAll("program"); // select all program name from  program
        $data["session"] = $this->utilities->findByAttribute("session_view", array("IS_ADMISSION" => '1')); // select Current session
        $data["faculty"] = $this->utilities->findAllByAttribute("faculty", array("ADMINISTRATION" => 0)); // select all faculty     
        $data['previous_info'] = $this->db->query("SELECT rp.*, f.FACULTY_NAME, d.DEPT_NAME, p.PROGRAM_NAME, sv.SESSION_NAME
            FROM adm_passed_app_reg_period rp
            INNER JOIN faculty f on f.FACULTY_ID = rp.FACULTY_ID
            INNER JOIN department d on d.DEPT_ID = rp.DEPT_ID
            INNER JOIN program p on p.PROGRAM_ID = rp.PROGRAM_ID
            INNER JOIN session_view sv on sv.SESSION_ID = rp.SESSION_ID            
            WHERE rp.ARP_ID = $regPerId
            ")->row();
        $this->load->view('admin/applicant/registration_period/add_reg_period', $data);
    }

    /**
     * @param
     * @param  session , program, startDate, endDate
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function createApplicantRegPeriod()
    {

        $session = $this->input->post('SESSION_ID');
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $status = ((isset($_POST['status'])) ? 1 : 0);
        $date1 = explode("/", $startDate);
        $fromDate = $date1[2] . '-' . $date1[1] . '-' . $date1[0];
        $date2 = explode("/", $endDate);
        $Date_t = $date2[2] . '-' . $date2[1] . '-' . $date2[0];
        $toDate = $Date_t . " 23:59:59";
        $remarks = "1st Semester Admission";
        $PROGRAM_ID = $this->input->post('PROGRAM_ID');
        $flag = 0;
        for ($i = 0; $i < sizeof($PROGRAM_ID); $i++) {
            $program = $PROGRAM_ID[$i];
            $pInfo = $this->db->query("SELECT FACULTY_ID, DEPT_ID FROM program WHERE PROGRAM_ID  = $program")->row();
            $faculty = $pInfo->FACULTY_ID;
            $department = $pInfo->DEPT_ID;
            $check = $this->utilities->hasInformationByThisId("adm_passed_app_reg_period", array("FACULTY_ID" => $faculty, "DEPT_ID" => $department, "PROGRAM_ID" => $program, "SESSION_ID" => $session));
            if (empty($check)) {// if Registration period available
                $regPeriod = array(
                    "ARP_TITLE" => $title,
                    "ARP_DESC" => $description,
                    "REG_PERIOD_DT_FROM" => $fromDate,
                    "REG_PERIOD_DT_TO" => $toDate,
                    "FACULTY_ID" => $faculty,
                    "DEPT_ID" => $department,
                    "PROGRAM_ID" => $program,
                    "SESSION_ID" => $session,
                    'ACTIVE_STATUS' => $status,
                    'CREATED_BY' => 1
                );
                if ($this->utilities->insertData($regPeriod, 'adm_passed_app_reg_period')) { // if data inserted successfully
                    $flag = 1;
                }
            }
        }
        if ($flag == 1) {
            echo "<div class='alert alert-success'>Admission Registration Period Create successfully</div>";
        } else {
            echo "<div class='alert alert-danger'>Admission Registration Period Already Exist</div>";
        }

    }

    /**
     * @param
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function updateApplicantRegPeriod()
    {

        $regPeriodId = $this->input->post('regPeriodId'); // Regitration Period Id
        $session = $this->input->post('SESSION_ID');
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $status = ((isset($_POST['status'])) ? 1 : 0);
        $date1 = explode("/", $startDate);
        $fromDate = $date1[2] . '-' . $date1[1] . '-' . $date1[0];
        $date2 = explode("/", $endDate);
        $Date_t = $date2[2] . '-' . $date2[1] . '-' . $date2[0];
        $toDate = $Date_t . " 23:59:59";
        $remarks = "1st Semester Admission";
        $PROGRAM_ID = $this->input->post('PROGRAM_ID');
        for ($i = 0; $i < sizeof($PROGRAM_ID); $i++) {
            $program = $PROGRAM_ID[$i];
            $pInfo = $this->db->query("SELECT FACULTY_ID, DEPT_ID FROM program WHERE PROGRAM_ID  = $program")->row();
            $faculty = $pInfo->FACULTY_ID;
            $department = $pInfo->DEPT_ID;

            $check = $this->utilities->hasInformationByThisId("adm_passed_app_reg_period", array("ARP_ID" != $regPeriodId, "FACULTY_ID" => $faculty, "DEPT_ID" => $department, "PROGRAM_ID" => $program, "SESSION_ID" => $session));
            if (empty($check)) {// if Registration period available
                $regPeriod = array(
                    "ARP_TITLE" => $title,
                    "ARP_DESC" => $description,
                    "REG_PERIOD_DT_FROM" => $fromDate,
                    "REG_PERIOD_DT_TO" => $toDate,
                    "FACULTY_ID" => $faculty,
                    "DEPT_ID" => $department,
                    "PROGRAM_ID" => $program,
                    "SESSION_ID" => $session,
                    'ACTIVE_STATUS' => $status,
                    'CREATED_BY' => 1
                );
                if ($this->utilities->updateData('adm_passed_app_reg_period', $regPeriod, array('ARP_ID' => $regPeriodId))) { // if data inserted successfully
                    $success = 1;
                    echo "<div class='alert alert-success'>Admission Registration Period Update successfully</div>";
                } else { // if data inserted failed
                    $success = 0;
                    echo "<div class='alert alert-danger'>Admission Registration Period Update failed</div>";
                }
            } else {// if event name not available

                echo "<div class='alert alert-danger'>Admission Registration Period Already Exist</div>";
            }
        }
    }

    /**
     * @param
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function applicantRegPeriodList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/applicantRegPeriod");
        $data['admissionPeriod'] = $this->db->query("SELECT rp.*, f.FACULTY_NAME, d.DEPT_NAME, p.PROGRAM_NAME, sv.SESSION_NAME
            FROM adm_passed_app_reg_period rp
            INNER JOIN faculty f on f.FACULTY_ID = rp.FACULTY_ID
            INNER JOIN department d on d.DEPT_ID = rp.DEPT_ID
            INNER JOIN program p on p.PROGRAM_ID = rp.PROGRAM_ID
            INNER JOIN session_view sv on sv.SESSION_ID = rp.SESSION_ID ")->result(); // select all data from  Registration Period
        $this->load->view("admin/applicant/registration_period/reg_period_list", $data);
    }

    /**
     * @param
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function applicantRegPeriodById()
    {
        $regPerId = $this->input->post('param'); // registration priod id
        $data["previlages"] = $this->checkPrevilege("setup/applicantRegPeriod");
        $data['row'] = $this->db->query("SELECT rp.*, f.FACULTY_NAME, d.DEPT_NAME, p.PROGRAM_NAME, sv.SESSION_NAME
            FROM adm_passed_app_reg_period rp
            INNER JOIN faculty f on f.FACULTY_ID = rp.FACULTY_ID
            INNER JOIN department d on d.DEPT_ID = rp.DEPT_ID
            INNER JOIN program p on p.PROGRAM_ID = rp.PROGRAM_ID
            INNER JOIN session_view sv on sv.SESSION_ID = rp.SESSION_ID            
            WHERE rp.ARP_ID  = $regPerId
            ")->row();
        $this->load->view('admin/applicant/registration_period/single_row_reg_period', $data);
    }

    /**
     * @access none
     * @param  none
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function admissionInfo()
    {
        $data['contentTitle'] = 'Admission Period';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Admission Period List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['admissionPeriod'] = $this->utilities->admissionProgramList();
        $data['content_view_page'] = 'admin/setup/admission/admission_info_index';
        $this->admin_template->display($data);
    }

    /**
     * @access none
     * @param  none
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function admissionInfoForm()
    {
        $data['current_date'] = $this->input->post('date');
        $data["ac_type"] = 1; /* Insertion form */
        $data["session"] = $this->utilities->findByAttributeWithJoin('adm_ysession', 'ins_session', 'SESSION_ID', 'SESSION_ID', 'SESSION_NAME', array("IS_CURRENT" => 1), ''); // select all
        // $data["degree"] = $this->utilities->getAll("ins_degree"); // select all faculty
        //$data["faculty"] = $this->utilities->getAll("ins_faculty"); // select all faculty  
        $data["program"] = $this->utilities->getAll("ins_program"); // select all faculty  
        $this->load->view('admin/setup/admission/add_admission_info', $data);
    }

    /**
     * @access none
     * @param  none
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function editAdmissionForm($APRGDESC_ID, $ADM_PRG_ID)
    {

        $data["previous_adm_desc"] = $this->utilities->findByAttribute('adm_prgdesc', array('APRGDESC_ID' => $APRGDESC_ID));

        $date_time_status = $data["previous_adm_desc"]->DATE_TIME_STATUS;
        $data['same_data_time'] = '';
        if ($date_time_status == 'SAME') {
            $data['same_data_time'] = $this->db->query("select a.* from adm_program a where a.APRGDESC_ID=$APRGDESC_ID group by a.PRG_EXM_SDT")->row();
        }

        //print_r($data['same_data_time']);exit;

        $data['previous_adm_program_data'] = $this->db->query("select a.*,b.*,c.PROGRAM_NAME,d.DEGREE_NAME from adm_program a 
            left join adm_prgdesc b on b.APRGDESC_ID=a.APRGDESC_ID
            left join ins_program c on a.PROGRAM_ID = c.PROGRAM_ID
            left join ins_degree d on a.DEGREE_ID=d.DEGREE_ID
            where b.APRGDESC_ID=$APRGDESC_ID")->result();
        //print_r($data['previous_adm_program_data']);exit;

        $data["session"] = $this->utilities->findByAttributeWithJoin('adm_ysession', 'ins_session', 'SESSION_ID', 'SESSION_ID', 'SESSION_NAME', array("IS_CURRENT" => 1), '');
        $data["program"] = $this->utilities->getAll("ins_program"); // select all faculty  
        $this->load->view('admin/setup/admission/edit_admission_info', $data);
    }

    /**
     * @param
     * @param  session , program, startDate, endDate
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function createAdmissionInfo()
    {
        $session = $this->input->post('SESSION_ID');
        $title = $this->input->post('title');
        $description = $this->input->post('description');

        $pFromDate = date('Y-m-d', strtotime($this->input->post('pFromDate')));
        $pToDate = date('Y-m-d', strtotime($this->input->post('pToDate')));


        $timeFromC = $this->input->post('timeFromCommon');
        $timeToC = $this->input->post('timeToCommon');
        $timeFrom = $this->input->post('timeFrom');
        $timeTo = $this->input->post('timeTo');

        $DEGREE_ID = $this->input->post('DEGREE_ID');
        $status = ((isset($_POST['status'])) ? 1 : 0);


        $addAdmission = array(
            "ADMPRG_TITLE" => $title,
            "ADMPRG_DESC" => $description,
            "REG_PRG_SDT" => $pFromDate,
            "REG_PRG_EDT" => $pToDate,
            "YSESSION_ID" => $session,
            'CREATED_BY' => $this->user["USER_ID"]
        );
        $APRGDESC_ID = $this->utilities->insert('adm_prgdesc', $addAdmission);

        $date_time_status = $this->input->post('date_time_status');
        if ($date_time_status == 'SAME') {

            $PROGRAM_ID = $this->input->post('PROGRAM_ID');

            // print_r($$tFromDate);exit;
            for ($i = 0; $i < sizeof($PROGRAM_ID); $i++) {
                $degree_id = $this->utilities->findByAttribute('ins_program', array('PROGRAM_ID' => $PROGRAM_ID[$i]));
                $programInfo = array(
                    "APRGDESC_ID" => $APRGDESC_ID,
                    "PROGRAM_ID" => $PROGRAM_ID[$i],
                    "DEGREE_ID" => $degree_id->DEGREE_ID,
                    "PRG_EXM_SDT" => date('Y-m-d', strtotime($this->input->post('tFromDateCommon'))),
                    "PRG_EXM_STM" => $timeFromC,
                    "PRG_EXM_ETM" => $timeToC,
                    "ACTIVE_STATUS" => $status,
                );
                $this->db->insert('adm_program', $programInfo);
            }
        } else {
            $PROGRAM_ID = $this->input->post('PROGRAM_ID');
            $tFromDate = $this->input->post('tFromDate');
            //print_r($PROGRAM_ID);exit;
            for ($i = 0; $i < sizeof($PROGRAM_ID); $i++) {
                $degree_id = $this->utilities->findByAttribute('ins_program', array('PROGRAM_ID' => $PROGRAM_ID[$i]));
                $programInfo = array(
                    "APRGDESC_ID" => $APRGDESC_ID,
                    "PROGRAM_ID" => $PROGRAM_ID[$i],
                    "DEGREE_ID" => $degree_id->DEGREE_ID,
                    "PRG_EXM_SDT" => date('Y-m-d', strtotime($tFromDate[$i])),
                    "PRG_EXM_STM" => $timeFrom[$i],
                    "PRG_EXM_ETM" => $timeTo[$i],
                    "ACTIVE_STATUS" => $status,
                );
                $this->db->insert('adm_program', $programInfo);
            }
        }

    }

    /**
     * @param
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function admissionTestList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/admissionInfo");
        $data['admissionPeriod'] = $this->db->query("SELECT adi.*, f.FACULTY_NAME, d.DEPT_NAME, p.PROGRAM_NAME, sv.SESSION_NAME
          FROM adm_admission_info adi
          INNER JOIN adm_admission_program aap on aap.ADMISSION_ID = adi.ADMISSION_ID
          INNER JOIN faculty f on f.FACULTY_ID = aap.FACULTY_ID
          INNER JOIN department d on d.DEPT_ID = aap.DEPT_ID
          INNER JOIN program p on p.PROGRAM_ID = aap.PROGRAM_ID
                                                      INNER JOIN session_view sv on sv.SESSION_ID = adi.SESSION_ID")->result(); // select all data from  Registration Period
        $this->load->view("admin/setup/admission/admission_info_list", $data);
    }

    /**
     * @param
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function admissionInfoById()
    {
        $regPerId = $this->input->post('param'); // session name
        $data["previlages"] = $this->checkPrevilege("setup/admissionInfo");
        $data['row'] = $this->db->query("SELECT rp.*, f.FACULTY_NAME, d.DEPT_NAME, p.PROGRAM_NAME, sv.SESSION_NAME
            FROM adm_admission_info rp
            INNER JOIN faculty f on f.FACULTY_ID = rp.FACULTY_ID
            INNER JOIN department d on d.DEPT_ID = rp.DEPT_ID
            INNER JOIN program p on p.PROGRAM_ID = rp.PROGRAM_ID
            INNER JOIN session_view sv on sv.SESSION_ID = rp.SESSION_ID 
            WHERE rp.ADMISSION_ID = $regPerId
            ")->row();
        $this->load->view('admin/setup/admission/single_row_admission_info', $data);
    }

    /**
     * @param
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function existing_student_payment()
    {
        $data['contentTitle'] = 'Existing Student Payment';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Existing Student Payment' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['content_view_page'] = 'admin/existing_stu_payment/payment_index';
        $this->admin_template->display($data);
    }

    /**
     * @param faculty_id , dept_id, program_id, session
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function ExistingPaymentList()
    {
        echo "<pre>";
        print_r($_POST);
    }

    /**
     * @param faculty_id , dept_id, program_id, session
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function searchExistingList()
    {
        $faculty = $this->input->post('faculty');
        $department = $this->input->post('department');
        $program = $this->input->post('program');
        $session = $this->input->post('session');
        $semester = $this->input->post('semester');
        $data['stuInfo'] = $this->db->query("
            SELECT si.STUDENT_ID, si.ROLL_NO, ss.SEMESTER_ID
            FROM students_info si
            INNER JOIN stu_semesterinfo ss on (ss.STUDENT_ID = si.STUDENT_ID AND ss.IS_CURRENT = 1)
            WHERE ss.FACULTY_ID = $faculty AND ss.DEPT_ID = $department AND ss.PROGRAM_ID = $program AND ss.SESSION_ID = $session AND ss.SEMESTER_ID = $semester
            ")->result();
        $data['semester'] = $this->utilities->getAll("sav_semester");
        $data['faculty'] = $faculty;
        $data['department'] = $department;
        $data['program'] = $program;
        $data['session'] = $session;
        $this->load->view('admin/existing_stu_payment/search_existing_students_list', $data);
    }

    /**
     * @param
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function existingStudentFormInsert()
    {
        $data["ac_type"] = 1;
        $data['dimention'] = "horizental";
        $data["session"] = $this->utilities->getAll("session_view"); // select all SESSION
        $data["semester"] = $this->utilities->getAll("sav_semester"); // select all SESSION
        $data["faculty"] = $this->utilities->findAllByAttribute("faculty", array("ACTIVE_STATUS" => 1)); // select all faculty from faculty table
        $this->load->view('admin/existing_stu_payment/add_existing_payment', $data);
    }

    /**
     * @param
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function orgIndex()
    {
        $data['contentTitle'] = 'Organization';
        $data['breadcrumbs'] = array(
            'Setup' => '#',
            'Organization' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['organization'] = $this->utilities->findAllByAttribute('sa_organizations', array('STATUS' => 1));

        $data['content_view_page'] = 'admin/setup/organization/org_index';
        $this->admin_template->display($data);
    }

    /**
     * @param
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function editOrg($id)
    {
        $data['contentTitle'] = 'Organization';
        $data['breadcrumbs'] = array(
            'Setup' => '#',
            'Organization' => '#',
        );
        $data['organization_info'] = $this->utilities->findByAttribute('sa_organizations', array('STATUS' => 1,'ORG_ID'=>$id));
        //print_r($data['organization_info']);exit;
        $data['organization'] = $this->utilities->findAllByAttribute('sa_organizations', array('STATUS' => 1));

        $data['content_view_page'] = 'admin/setup/organization/org_index';
        $this->admin_template->display($data);
    }

    function saveOrg()
    {

        require(APPPATH . 'views/common/image_upload/class.upload.php');
        $logo_name = '';

        $ORG_ID=$this->input->post('ORG_ID');
        if(!empty($_FILES['LOGO'])){
            $foo = new Upload($_FILES['LOGO']);

            $foo->file_safe_name=true;
             $foo->file_name_body_pre=rand().'_';
             //echo $foo->file_src_name=rand().$foo->file_src_name_ext;exit;
            if ($foo->uploaded) {
                // large size image
                //$foo->file_new_name_body = 'foo';
                $foo->image_border = 1;

                // $foo->file_new_name_body = 'logo_'.$ADM_ROLL_NO;
                //$foo->image_border_color    = '#231F20';
                $foo->allowed = array('image/*');
                $foo->Process('upload/organization/logo/');
                if ($foo->processed) {

                     $logo_name = $foo->file_dst_name;

                } else {
                    echo 'error : ' . $foo->error;
                }
            }
        }
 
        $orgInfo = array(
            "ORG_NAME" => $this->input->post('ORG_NAME'),
            "ABBR" => $this->input->post('ABBR'),
            "SLOGAN" => $this->input->post('SLOGAN'),
            "REG_NO" => $this->input->post('REG_NO'),
            "PHONE" => $this->input->post('PHONE'),
            "EMAIL" => $this->input->post('EMAIL'),
            "WEBSITE" => $this->input->post('WEBSITE'),
            "DSCP" => $this->input->post('DSCP'),
            

        );
        if($logo_name !=''){
            $orgInfo += array("LOGO" => $logo_name );
        }
        //print_r($orgInfo);exit;
        if($ORG_ID !=''){
            $this->utilities->updateData('sa_organizations', $orgInfo, array('ORG_ID' => $ORG_ID));
        }else{
            $this->db->insert('sa_organizations', $orgInfo);    
        }
        

        redirect('setup/orgIndex');

    }


    /**
     * @methodName campus()
     * @access
     * @param  none
     * @author Abhijit M. Abhi <abhijit@atilimited.net>
     * @return
     */
    function campus()
    {
        $data['contentTitle'] = 'Campus';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Campus List' => '#',
        );

        $data["previlages"] = $this->checkPrevilege();
        $data['campus_info'] = $this->setup_model->getAllCampusSetupInfo();
//        echo "<pre>"; print_r($data['campus_info']); exit;
        $data['content_view_page'] = 'admin/setup/campus/campus_index';
        $this->admin_template->display($data);
    }


    /**
     * @methodName campusFormInsert()
     * @access
     * @param  none
     * @author Abhijit M. Abhi <abhijit@atilimited.net>
     * @return
     */

    function campusFormInsert()
    {
        $data["ac_type"] = 1;

        $data['campus_type'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 72));
        $data['org_type'] = $this->db->get_where('sa_organizations')->result();
        $this->load->view('admin/setup/campus/add_campus', $data);
    }


    /**
     * @methodName createCampus()
     * @access
     * @param  none
     * @author Abhijit M. Abhi <abhijit@atilimited.net>
     * @return
     */

    function createCampus()
    {

//        echo "Hello"; exit;
        $orgID = $this->input->post('ORG_ID');
        $campusType = $this->input->post('CAMPUS_TYPE_ID');
        $campusName = $this->input->post('campusName');
        $description = $this->input->post('description');
        $status = ((isset($_POST['status'])) ? 1 : 0);


        $check = $this->utilities->hasInformationByThisId("sa_campus", array("CAMPUS_NAME" => $campusName, "CAMPUS_DESC" => $description));
        if (empty($check)) {

            $campus = array(
                'ORG_ID' => $orgID,
                'CAMPUS_NAME' => $campusName,
                'CAMPUS_TYPE' => $campusType,
                'CAMPUS_DESC' => $description,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );

//            echo "<pre>"; print_r($campus); exit;

            if ($this->utilities->insertData($campus, 'sa_campus')) {
                echo "<div class='alert alert-success'>Campus Create successfully</div>";
            } else {
                echo "<div class='alert alert-danger'>Campus insert failed</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Campus Already Exist</div>";
        }


    }

    /**
     * @methodName campusList()
     * @access
     * @param  none
     * @author Abhijit M. Abhi <abhijit@atilimited.net>
     * @return
     */

    function campusList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/campus");
        $data['campus_info'] = $this->setup_model->getAllCampusSetupInfo();

//        echo  "<pre>"; print_r($data['campus_info']); exit;

        $this->load->view("admin/setup/campus/campus_list", $data);
    }


    /**
     * @methodName campusFormUpdate()
     * @access
     * @param  none
     * @author Abhijit M. Abhi <abhijit@atilimited.net>
     * @return Mixed Template
     */

    function campusFormUpdate()
    {

        $data["ac_type"] = "edit";
        $id = $this->input->post('param');

        $data['org_type'] = $this->db->get_where('sa_organizations')->result();
        $data['campus_type'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 72));
        $data['campus_info'] = $this->setup_model->getCampusSetupInfoById($id);

//        echo "<pre>"; print_r($data['campus_info']); exit;

        $this->load->view('admin/setup/campus/add_campus', $data);

    }


    /*
    * @methodName updateCampus()
    * @access
    * @param  none
    * @author Abhijit M. Abhi <abhijit@atilimited.net>
    * @return status
    */

    function updateCampus()
    {

        $campus_id = $this->input->post('txtcampusId');
        $org_id = $this->input->post('ORG_ID');
        $campus_name = $this->input->post('campusName');
        $campus_type_id = $this->input->post('CAMPUS_TYPE_ID');
        $description = $this->input->post('description');

        $status = ((isset($_POST['status'])) ? 1 : 0);

        $check = $this->utilities->hasInformationByThisId("sa_campus", array("CAMPUS_NAME" => $campus_name, 'CAMPUS_ID!=' => $campus_id));

        if (empty($check)) {

            $campus = array(
                'ORG_ID' => $org_id,
                'CAMPUS_NAME' => $campus_name,
                'CAMPUS_TYPE' => $campus_type_id,
                'CAMPUS_DESC' => $description,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );

            if ($this->utilities->updateData('sa_campus', $campus, array('CAMPUS_ID' => $campus_id))) {
                echo "<div class='alert alert-success'>Campus Update successfully</div>";
            } else {
                echo "<div class='alert alert-danger'>Campus Name Update failed</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Campus Name Already Exist</div>";
        }
    }

    /*
     * @methodName campusById()
     * @access
     * @param  none
     * @author Abhijit M. Abhi <abhijit@atilimited.net>
     * @return Mixed Template
     */

    function campusById()
    {
        $campus_id = $this->input->post('param');
        $data["previlages"] = $this->checkPrevilege("setup/campus");
        $data['row'] = $this->setup_model->getCampusSetupInfoById($campus_id);
        $this->load->view('admin/setup/campus/single_campus_row', $data);
    }

      /**
     * @methodName store()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */


    function store()
    {
        $data['contentTitle'] = 'Inventory';
        $data['breadcrumbs'] = array(
            'Store' => '#',
            'Store List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['store'] = $this->utilities->findAllFromView('inv_store'); // select all data from unit
        $data['content_view_page'] = 'inventory/store/store_index';
        $this->admin_template->display($data);
    }

    /**
     * @methodName addStore()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function storeFormInsert()
    {
        $data["ac_type"] = 1;
        $this->load->view('inventory/store/add_store', $data);
    }

      /**
     * @methodName getStore()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */


      function storeList()
      {
        $data["previlages"] = $this->checkPrevilege("Inventory/unit");
        $data['store'] = $this->utilities->findAllFromView('inv_store'); // select all data from unit
        $this->load->view("inventory/store/store_list", $data);
    }

    /**
     * @methodName createStore()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */


    function createStore()
    {
        $storeName = $this->input->post('storeName'); // unit name
        $description = $this->input->post('description'); // description
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Degree with this name is already exist
        $check = $this->utilities->hasInformationByThisId("inv_store", array("STORE_NAME" => $storeName));
        if (empty($check)) {// if unit name available
            // preparing data to insert
            $store = array(
                'STORE_NAME' => $storeName,
                'DESC' => $description,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->insertData($store, 'inv_store')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Store Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Store Name insert failed</div>";
            }
        } else {// if degree name not available
            echo "<div class='alert alert-danger'>Store Name Already Exist</div>";
        }
    }

      /**
     * @methodName StoreFormUpdate()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */


      function storeFormUpdate()
      {
        $data["ac_type"] = 2;
        $id = $this->input->post('param'); // unit ID
        $data['store'] = $this->utilities->findByAttribute('inv_store', array('STORE_ID' => $id)); // select all data from degree where degree id
        $this->load->view('inventory/store/add_store', $data);
    }

    /**
     * @methodName updateStore()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function updateStore()
    {
//        echo "<pre>";
//        print_r($_POST);
//        exit;
        $store_id = $this->input->post('txtStoreId'); // store id
        $storeName = $this->input->post('storeName'); // store name
        $description = $this->input->post('description'); // description
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if store with this name is already exist
        $check = $this->utilities->hasInformationByThisId("inv_store", array("STORE_NAME" => $storeName, "STORE_ID !=" => $store_id));

        if (empty($check)) {// if store name available
            // preparing data to insert
            $store = array(
                'STORE_NAME' => $storeName,
                'DESC' => $description,
                'ACTIVE_STATUS' => $status,
                'UPDATED_BY' => $this->user["USER_ID"]
            );
             //echo "<pre>";print_r($store);exit();
            if ($this->utilities->updateData('inv_store', $store, array('STORE_ID' => $store_id))) { // if data update successfully
                echo "<div class='alert alert-success'>Store Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Store Name Update failed</div>";
            }
        } else {// if unit name not available
            echo "<div class='alert alert-danger'>Store Name Already Exist</div>";
        }
    }

     /**
     * @methodName unitById()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

     function storeById()
     {
        $store_id = $this->input->post('param'); // unit name
        $data["previlages"] = $this->checkPrevilege("inventory/unit");
        $data['row'] = $this->utilities->findByAttribute('inv_store', array('STORE_ID' => $store_id)); // select all data from unit where unit id
        $this->load->view('inventory/store/single_store_row', $data);
    }

     /**
     * @methodName libAuthor()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function libAuthor()
    {
        $data['contentTitle'] = 'Library Author';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Library Author List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['lib_author'] = $this->utilities->findAllFromView('lib_author'); // select all data from degree
        $data['content_view_page'] = 'admin/setup/library_author/lib_author_index';
        $this->admin_template->display($data);
    }

    /**
     * @methodName libAuthorFormInsert()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function libAuthorFormInsert()
    {
        $data["ac_type"] = 1;
        $this->load->view('admin/setup/library_author/add_lib_author', $data);
    }

      /**
     * @methodName libAuthorList()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function libAuthorList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/libAuthor");
        $data['lib_author'] = $this->utilities->findAllFromView('lib_author'); // select all data from degree
        $this->load->view("admin/setup/library_author/lib_author_list", $data);
    }

      /**
     * @methodName createlibAuthor()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function createlibAuthor()
    {
        $libAuthName = $this->input->post('libAuthName'); // degree name
        $libAuthCountry = $this->input->post('libAuthCountry'); // degree name
        $remarks = $this->input->post('remarks'); // degree name
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Degree with this name is already exist
        $check = $this->utilities->hasInformationByThisId("lib_author", array("AUTHOR_NAME" => $libAuthName));
        if (empty($check)) {// if Degree name available
            // preparing data to insert
            $libAuth = array(
                'AUTHOR_NAME' => $libAuthName,
                'AUTHOR_COUNTRY' => $libAuthCountry,
                'REMARKS' => $remarks,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->insertData($libAuth, 'lib_author')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Library Author Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Library Author Name insert failed</div>";
            }
        } else {// if degree name not available
            echo "<div class='alert alert-danger'>Library Author Name Already Exist</div>";
        }
    }

    /**
     * @methodName libAuthorFormUpdate()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

     function libAuthorFormUpdate()
    {
        $data["ac_type"] = 2;
        $id = $this->input->post('param'); // degree ID
        $data['lib_author'] = $this->utilities->findByAttribute('lib_author', array('AUTHOR_ID' => $id)); // select all data from degree where degree id
        $this->load->view('admin/setup/library_author/add_lib_author', $data);
    }

    /**
     * @methodName updateLibAuthor()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function updateLibAuthor()
    {
//        echo "<pre>";
//        print_r($_POST);
//        exit;
        $auth_id = $this->input->post('txtLibAuthId'); // degree name
        $libAuthName = $this->input->post('libAuthName'); // degree name
        $libAuthCountry = $this->input->post('libAuthCountry'); // degree name
        $remarks = $this->input->post('remarks'); // degree name
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Degree with this name is already exist
        $check = $this->utilities->hasInformationByThisId("lib_author", array("AUTHOR_NAME" => $libAuthName, "AUTHOR_ID !=" => $auth_id));

        if (empty($check)) {// if Degree name available
            // preparing data to insert
            $authData = array(
                'AUTHOR_NAME' => $libAuthName,
                'AUTHOR_COUNTRY' => $libAuthCountry,
                'REMARKS' => $remarks,
                'ACTIVE_STATUS' => $status,
                'UPDATED_BY' => $this->user["USER_ID"]
            );
            //var_dump($degree); exit();
            if ($this->utilities->updateData('lib_author', $authData, array('AUTHOR_ID' => $auth_id))) { // if data update successfully
                echo "<div class='alert alert-success'>Library Author Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Library Author Name Update failed</div>";
            }
        } else {// if degree name not available
            echo "<div class='alert alert-danger'>Library Author Name Already Exist</div>";
        }
    }

    /**
     * @methodName libAuthorById()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */


    function libAuthorById()
    {
        $auth_id = $this->input->post('param'); // degree name
        $data["previlages"] = $this->checkPrevilege("setup/libAuthor");
        $data['row'] = $this->utilities->findByAttribute('lib_author', array('AUTHOR_ID' => $auth_id)); // select all data from degree where degree id
        $this->load->view('admin/setup/library_author/single_lib_author_row', $data);
    }

    function libPublisher()
    {
        $data['contentTitle'] = 'Library Publisher';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Library Publisher List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['lib_publisher'] = $this->utilities->findAllFromView('lib_publisher'); // select all data from degree
        $data['content_view_page'] = 'admin/setup/library_publisher/lib_publisher_index';
        $this->admin_template->display($data);
    }

     /**
     * @methodName libAuthorFormInsert()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function libPublisherFormInsert()
    {
        $data["ac_type"] = 1;
        $this->load->view('admin/setup/library_publisher/add_lib_publisher', $data);
    }

      /**
     * @methodName libAuthorList()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function libPublisherList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/libPublisher");
        $data['lib_publisher'] = $this->utilities->findAllFromView('lib_publisher'); // select all data from degree
        $this->load->view("admin/setup/library_publisher/lib_publisher_list", $data);
    }

      /**
     * @methodName createlibAuthor()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function createlibPublisher()
    {
        $libPubName = $this->input->post('libPubName'); // degree name
        $libPubCountry = $this->input->post('libPubCountry'); // degree name
        $remarks = $this->input->post('remarks'); // degree name
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Degree with this name is already exist
        $check = $this->utilities->hasInformationByThisId("lib_publisher", array("PUBLISHER_NAME" => $libPubName));
        if (empty($check)) {// if Degree name available
            // preparing data to insert
            $libPub = array(
                'PUBLISHER_NAME' => $libPubName,
                'PUBLISHER_COUNTRY' => $libPubCountry,
                'REMARKS' => $remarks,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->insertData($libPub, 'lib_publisher')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Library Publisher Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Library Publisher Name insert failed</div>";
            }
        } else {// if degree name not available
            echo "<div class='alert alert-danger'>Library Publisher Name Already Exist</div>";
        }
    }

    /**
     * @methodName libAuthorFormUpdate()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

     function libPublisherFormUpdate()
    {
        $data["ac_type"] = 2;
        $id = $this->input->post('param'); // degree ID
        $data['lib_publisher'] = $this->utilities->findByAttribute('lib_publisher', array('PUBLISHER_ID' => $id)); // select all data from degree where degree id
        $this->load->view('admin/setup/library_publisher/add_lib_publisher', $data);
    }

    /**
     * @methodName updateLibAuthor()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function updateLibPublisher()
    {
//        echo "<pre>";
//        print_r($_POST);
//        exit;
        $pub_id = $this->input->post('txtLibPublisherId'); // degree name
        $libPubName = $this->input->post('libPubName'); // degree name
        $libPubCountry = $this->input->post('libPubCountry'); // degree name
        $remarks = $this->input->post('remarks'); // degree name
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Degree with this name is already exist
        $check = $this->utilities->hasInformationByThisId("lib_publisher", array("PUBLISHER_NAME" => $libPubName, "PUBLISHER_ID !=" => $pub_id));

        if (empty($check)) {// if Degree name available
            // preparing data to insert
            $pubData = array(
                'PUBLISHER_NAME' => $libPubName,
                'PUBLISHER_COUNTRY' => $libPubCountry,
                'REMARKS' => $remarks,
                'ACTIVE_STATUS' => $status,
                'UPDATED_BY' => $this->user["USER_ID"]
            );
            //var_dump($degree); exit();
            if ($this->utilities->updateData('lib_publisher', $pubData, array('PUBLISHER_ID' => $pub_id))) { // if data update successfully
                echo "<div class='alert alert-success'>Library Publisher Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Library Publisher Name Update failed</div>";
            }
        } else {// if degree name not available
            echo "<div class='alert alert-danger'>Library Publisher Name Already Exist</div>";
        }
    }

    /**
     * @methodName libPublisherById()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */


    function libPublisherById()
    {
        $publisher_id = $this->input->post('param'); // degree name
        $data["previlages"] = $this->checkPrevilege("setup/libPublisher");
        $data['row'] = $this->utilities->findByAttribute('lib_publisher', array('PUBLISHER_ID' => $publisher_id)); // select all data from degree where degree id
        $this->load->view('admin/setup/library_publisher/single_lib_publisher_row', $data);
    }

    function libraryMemReq()
    {
        $data['pageTitle'] = 'Library Member  Request';
        $data['breadcrumbs'] = array(
            'Library Member  Request ' => '#',
        );
        $data['dimention'] = 'horizental';
        $data["ac_type"] = 'view'; //access type two for common edit view 
        $user_data = $this->session->userdata('logged_in');
        $data['user_id']=$user_data['USER_ID']; 
        $data['user_type']=$user_data['USER_TYPE'];
        //echo "<pre>";print_r($user_data);exit();
        $data["rules"] = $this->utilities->findAllByAttribute("m00_lkpdata a", array("a.GRP_ID" => 83)); 
      //echo "<pre>";  print_r( $data["rules"]);exit();       
        $data['content_view_page'] = 'admin/setup/library_mem_req/lib_mem_req';
        $this->admin_template->display($data);
    }

      /**
     * @methodName emailTemplate()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function emailTemplate()
    {
        $data['contentTitle'] = 'Email Template';
        $data['breadcrumbs'] = array(
            'Setup' => '#',
            'Email Template List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['email_template'] = $this->utilities->findAllFromView('aca_email_template'); // select all data from degree
        $data['content_view_page'] = 'admin/setup/email_template/email_template_index';
        $this->admin_template->display($data);
    }

    /**
     * @methodName emailTemFormInsert()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function emailTemFormInsert()
    {
        $data["ac_type"] = 1;
        $this->load->view('admin/setup/email_template/add_email_template', $data);
    }

    /**
     * @methodName libPublisherList()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function emailTemplateList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/emailTemplate");
        $data['email_template'] = $this->utilities->findAllFromView('aca_email_template'); // select all data from degree
        $this->load->view("admin/setup/email_template/email_template_list", $data);
    }

      /**
     * @methodName createlibPublisher()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function createEmailTemplate()
    {
        $emailSubName = $this->input->post('emailSubName'); // degree name
        $emailBody = $this->input->post('emailBody'); // degree name
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Degree with this name is already exist
        $check = $this->utilities->hasInformationByThisId("aca_email_template", array("EMAIL_SUBJECT" => $emailSubName));
        if (empty($check)) {// if Degree name available
            // preparing data to insert
            $emailTemData = array(
                'EMAIL_SUBJECT' => $emailSubName,
                'EMAIL_BODY' => $emailBody,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->insertData($emailTemData, 'aca_email_template')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Email Template Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Email Template insert failed</div>";
            }
        } else {// if degree name not available
            echo "<div class='alert alert-danger'>Email Template Subject Already Exist</div>";
        }
    }

      /**
     * @methodName emilTemplateFormUpdate()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

     function emilTemplateFormUpdate()
    {
        $data["ac_type"] = 2;
        $id = $this->input->post('param'); // degree ID
        $data['email_template'] = $this->utilities->findByAttribute('aca_email_template', array('EMAIL_TEMPLATE_ID' => $id)); // select all data from degree where degree 
        $this->load->view('admin/setup/email_template/add_email_template', $data);
    }

    /**
     * @methodName updateEmailTemplate()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function updateEmailTemplate()
    {
//        echo "<pre>";
//        print_r($_POST);
//        exit;
        $email_id = $this->input->post('txtemailTemId'); // degree name
        $emailSubName = $this->input->post('emailSubName'); // degree name
        $emailBody = $this->input->post('emailBody'); // degree name
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Degree with this name is already exist
        $check = $this->utilities->hasInformationByThisId("aca_email_template", array("EMAIL_SUBJECT" => $emailSubName, "EMAIL_TEMPLATE_ID !=" => $email_id));

        if (empty($check)) {// if Degree name available
            // preparing data to insert
            $emailTempData = array(
                'EMAIL_SUBJECT' => $emailSubName,
                'EMAIL_BODY' => $emailBody,
                'ACTIVE_STATUS' => $status,
                'UPDATED_BY' => $this->user["USER_ID"]
            );
            //var_dump($degree); exit();
            if ($this->utilities->updateData('aca_email_template', $emailTempData, array('EMAIL_TEMPLATE_ID' => $email_id))) { // if data update successfully
                echo "<div class='alert alert-success'>Email Template Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Email Template Update failed</div>";
            }
        } else {// if degree name not available
            echo "<div class='alert alert-danger'>Email Template Subject Already Exist</div>";
        }
    }

    /**
     * @methodName emailTemplateById()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */


    function emailTemplateById()
    {
        $email_id = $this->input->post('param'); // degree name
        $data["previlages"] = $this->checkPrevilege("setup/emailTemplate");
        $data['row'] = $this->utilities->findByAttribute('aca_email_template', array('EMAIL_TEMPLATE_ID' => $email_id)); // select all data from degree where degree id
        $this->load->view('admin/setup/email_template/single_email_template_row', $data);
    }
    function emailSendTemplate(){
        

        $email='reazulislam0191@gmail.com';
        $data['org_info']=$this->utilities->findByAttribute('sa_organizations', array('STATUS' => 1));
        $message = $this->load->view('admin/setup/email_template/email_send_template',$data);

        //print_r($message);exit;
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
            $mail->From = "support@harnest.com";
            $mail->FromName = "KYAU";
            $mail->AddAddress($email);
            //$mail->AddReplyTo($emp_info->EMPLOYEE);
            $mail->IsHTML(TRUE);
            $mail->Subject = $subject;
            $mail->Body = $message;

            if ($mail->Send()) { 
                echo "Sent successfully";

            }
    }

}

/* End of file setup.php */
/* Location: ./application/controllers/setup.php */
