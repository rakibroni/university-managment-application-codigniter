<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @category   FrontPortal
 * @package    Portal
 * @author     Jahid Hasan <jahid@atilimited.net>
 * @copyright  2015 ATI Limited Development Group
 */
class Course extends CI_Controller
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

    /**
     * @methodName  checkPrevilege()
     * @access
     * @param  none
     * @return  Mixed View
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
     * @methodName index()
     * @access public
     * @param  none
     * @return Mixed Template
     */

    public function index()
    {
        $data['contentTitle'] = 'Course';
        $data['breadcrumbs'] = array(
            'Course' => '#',
            'Course List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        //$data['courses'] = $this->course_model->getCourseList(); 
        $data['content_view_page'] = 'admin/course/index';
        $this->admin_template->display($data);
    }   
    public function ajaxCourseList()
    {

        $columns = array( 
            0 =>'COURSE_ID', 
            1 =>'COURSE_CODE',
            2=> 'COURSE_TITLE',
            3 =>'DEPT_NAME', 

        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->course_model->allposts_count();

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

    /**
     * @methodName courseFormInsert()
     * @access none
     * @param  none
     * @return Mixed Template
     */

    function courseFormInsert()
    {
        $data["ac_type"] = 1; // for insert course info
        $data["departments"] = $this->utilities->dropdownFromTableWithCondition("ins_dept", "Select Department", "DEPT_ID", "DEPT_NAME", array("ACTIVE_STATUS" => 1,'UFOR_ACM'=>1)); // select all departments name from  department
        $data["category"] = $this->utilities->dropdownFromTableWithCondition("aca_course_category", "Select Category", "C_CAT_ID", "CAT_NAME", array("ACTIVE_STATUS" => 1)); // select all category name from  category
        $this->load->view('admin/course/create_course', $data);
    }

    /**
     * @methodName createCourse()
     * @access none
     * @param  none
     * @return Mixed Template
     */

    function createCourse()
    {
        $department = $this->input->post('cmbDepartments'); // department name
        $code = $this->input->post('courseCode'); // course code name
        $title = $this->input->post('courseTitle'); // course title name
        $credit = $this->input->post('courseCredit'); // course credit name
        $category = $this->input->post('cmbCategory'); // course category name
        $content = $this->input->post('content'); // course category name
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        $Institute = ((isset($_POST['Institute'])) ? 1 : 0);  // active Institute
        $Faculty = ((isset($_POST['Faculty'])) ? 1 : 0); // active Faculty
        $BOOKS = $this->input->post('BOOKS');
        $TEACHING_METHOD = $this->input->post('TEACHING_METHOD');
        $MISSION = $this->input->post('MISSION');
        $VISION = $this->input->post('VISION');
        $OBJECTIVE = $this->input->post('OBJECTIVE');
        // checking if Course with this name is already exist
        $check = $this->utilities->hasInformationByThisId("aca_course", array("DEPT_ID" => $department, "COURSE_CODE" => $code));
        if (empty($check)) {// if Department name, course code, course catagory available
            // preparing data to insert
            $course = array(
                'DEPT_ID' => $department,
                'COURSE_CODE' => $code,
                'COURSE_TITLE' => $title,
                'CREDIT' => $credit,
                'C_CAT_ID' => $category,
                'COURSE_DESC' => $content,
                'BOOKS' => $BOOKS,
                'TEACHING_METHOD' => $TEACHING_METHOD,
                'MISSION' => $MISSION,
                'VISION' => $VISION,
                'OBJECTIVE' => $OBJECTIVE,
                'ACTIVE_STATUS' => $status,
                'GLOBAL_FOR_FACULTY' => $Faculty,
                'GLOBAL_FOR_INSTITUTE' => $Institute,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->insertData($course, 'aca_course')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Course Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Course insert failed</div>";
            }
        } else {// if course name not available
            echo "<div class='alert alert-danger'>Course Name Already Exist</div>";
        }
    }

    /**
     * @methodName getCourses()
     * @access none
     * @param  none
     * @return Mixed Template
     */

    function getCourses()
    {
        $data["previlages"] = $this->checkPrevilege("Course/index");
        $data['courses'] = $this->db->query("select a.*,b.DEPT_NAME,c.CAT_NAME from aca_course a 
            left join ins_dept b on a.DEPT_ID=b.DEPT_ID
                                                left join aca_course_category c on a.C_CAT_ID=c.C_CAT_ID ")->result(); // select all data from  course with department and catagory inforamtion
        $this->load->view("admin/course/course_list", $data);
    }

    /**
     * @methodName courseInfo()
     * @access none
     * @param  $course_id
     * @return Mixed Template
     */

    function courseInfo()
    {
        $course_id = $this->input->post('param');
        // select all data from  course with department and catagory inforamtion
        $data['courses'] = $this->course_model->getCourseById($course_id);
        $this->load->view("admin/course/course_info", $data);
    }

    /**
     * @methodName courseFormUpdate()
     * @access none
     * @param  $course_id
     * @return Mixed Template
     */

    function courseFormUpdate()
    {
        $course_id = $this->input->post('param');
        $data["ac_type"] = 2; //for update course info
        $data['course'] = $this->utilities->findByAttribute('aca_course', array("COURSE_ID" => $course_id)); 
        $data["departments"] = $this->utilities->dropdownFromTableWithCondition("ins_dept", "Select Department", "DEPT_ID", "DEPT_NAME", array("ACTIVE_STATUS" => 1,'UFOR_ACM'=>1)); 
        $data["category"] = $this->utilities->dropdownFromTableWithCondition("aca_course_category", "Select Category", "C_CAT_ID", "CAT_NAME", array("ACTIVE_STATUS" => 1)); 
        $this->load->view('admin/course/create_course', $data);
    }

    /**
     * @methodName updateCourse()
     * @access none
     * @param  $course_id
     * @return Mixed Template
     */

    function updateCourse()
    {
        $course_id = $this->input->post('txtCourseID'); // course id hidden value
        $department = $this->input->post('cmbDepartments'); // department name
        $code = $this->input->post('courseCode'); // course code name
        $title = $this->input->post('courseTitle'); // course title name
        $credit = $this->input->post('courseCredit'); // course credit name
        $category = $this->input->post('cmbCategory'); // course category name
        $content = $this->input->post('content'); // course category name
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        $Institute = $this->input->post('Institute'); // active Institute
        $Faculty = $this->input->post('Faculty'); // active Faculty
        $BOOKS = $this->input->post('BOOKS');
        $TEACHING_METHOD = $this->input->post('TEACHING_METHOD');
        $MISSION = $this->input->post('MISSION');
        $VISION = $this->input->post('VISION');
        $OBJECTIVE = $this->input->post('OBJECTIVE');
        // checking if Course with this name is already exist
        $check = $this->utilities->findByAttribute("aca_course", array("COURSE_ID !=" => $course_id, "DEPT_ID" => $department, "COURSE_CODE" => $code));
        if (empty($check)) {// if Department name, course code available
            // preparing data to update
            $update = array(
                'DEPT_ID' => $department,
                'COURSE_CODE' => $code,
                'COURSE_TITLE' => $title,
                'CREDIT' => $credit,
                'C_CAT_ID' => $category,
                'COURSE_DESC' => $content,
                'BOOKS' => $BOOKS,
                'TEACHING_METHOD' => $TEACHING_METHOD,
                'MISSION' => $MISSION,
                'VISION' => $VISION,
                'OBJECTIVE' => $OBJECTIVE,
                'ACTIVE_STATUS' => $status,
                'GLOBAL_FOR_FACULTY' => $Faculty,
                'GLOBAL_FOR_INSTITUTE' => $Institute,
                'UPDATED_BY' => $this->user["USER_ID"],
                'UPDATE_DATE' => date("Y-m-d h:i:s a")
            );
            if ($this->utilities->updateData('aca_course', $update, array('COURSE_ID' => $course_id))) { // if data update successfully
                echo "<div class='alert alert-success'>Course Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Course insert failed</div>";
            }
        } else {// if course name not available
            echo "<div class='alert alert-danger'>Course Name Already Exist</div>";
        }
    }

    /**
     * @methodName courseById()
     * @access none
     * @param  $course_id
     * @return Mixed Template
     */

    function courseById()
    {
        $course_id = $this->input->post('param'); // course id / hidden value
        $data['row'] = $this->course_model->getCourseById($course_id);
        $this->load->view('admin/course/single_course_row', $data);
    }

    /**
     * @methodName courseOffer()
     * @access none
     * @param  none
     * @return Mixed Template
     */

    function courseOffer()
    {
        $data["ac_type"] = 1;
        $data['contentTitle'] = 'Course Assign';
        $data['breadcrumbs'] = array(
            'Course' => '#',
            'Course Assign ' => '#',
        );

        $data["faculty"] = $this->utilities->findAllByAttribute("ins_faculty",array('ACTIVE_STATUS' => 1));
        $data['content_view_page'] = 'admin/course/course_offer';
        $this->admin_template->display($data);
    }

    function deptWiseCourseOffer()
    {
        $data["ac_type"] = 1;
        $data['contentTitle'] = 'Department Wise Course Assign';
        $data['breadcrumbs'] = array(
            'Course' => '#',
            'Department Wise Course Assign ' => '#',
        );

        //
        $data["previlages"] = $this->checkPrevilege();
        $user_data = $this->session->userdata('logged_in');
        $dep_id = $user_data['DEPT_ID'];
        //$data['dep_wise_course'] = $this->utilities->findAllByAttribute('aca_course', array("DEPT_ID" => $dep_id));\

        $data['programs'] = $this->utilities->findAllByAttribute('ins_program', array("DEPT_ID" => $dep_id, "ACTIVE_STATUS" => 1));
        $data['dep_name'] = $this->course_model->getDepById($dep_id);
        $data['content_view_page'] = 'admin/course/dept_wise_course_offer';
        $this->admin_template->display($data);
        //

        /*$data["faculty"] = $this->utilities->findAllByAttribute("ins_faculty",array('ACTIVE_STATUS' => 1));
        $data['content_view_page'] = 'admin/course/course_offer';
        $this->admin_template->display($data);*/
    }


    function prerequisiteList()
    {
        //print_r($_POST);
        $faculty = $_POST['faculty'];
        $dept = $_POST['dept'];
        $program = $_POST['program'];
        $courseId = $_POST['course'];
        $data["course"] = $this->db->query("SELECT acp.*, ac.COURSE_CODE, ac.COURSE_TITLE, ac.CREDIT, acc.CAT_NAME, acc.CAT_COLOR
            FROM aca_crs_prerequisite acp
            LEFT JOIN aca_course ac on ac.COURSE_ID = acp.PRE_COURSE_ID
            LEFT JOIN aca_course_category acc on acc.C_CAT_ID = ac.C_CAT_ID
            WHERE acp.COURSE_ID = $courseId AND acp.FACULTY_ID = $faculty AND acp.DEPT_ID = $dept AND acp.PROGRAM_ID = $program")->result();
        $this->load->view('admin/course/prerequisite_view', $data);
    }

    function courseDetails()
    {
        $course = $_POST['course'];
        $data['course'] = $this->db->query("SELECT ac.*
            FROM aca_course ac
            WHERE ac.COURSE_ID = $course")->result();
        /**$data['course'] = $this->db->query("SELECT ac.*, act.CRS_TOPIC_ID, act.COURSE_ID, act.TOPIC_TITLE, act.TOPIC_DESC, act.TOPIC_DURATION, act.SUGGESTED_ACTIVITIES
         * FROM aca_course ac
         * LEFT JOIN aca_course_topics act on act.COURSE_ID = ac.COURSE_ID
         * WHERE ac.COURSE_ID = $course")->result();*/
        $this->load->view('admin/course/course_details', $data);
    }

    /**
     * @methodName ajax_get_department()
     * @access none
     * @param  none
     * @return Mixed Template
     */

    public function ajax_get_department()
    {
        $faculty = $this->input->post("selectedValue");      
        $query = $this->utilities->deptByFacId($faculty);
        $returnVal = '<option value="" id="cmbFaculty" >--Select--</option>';
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value="' . $row->DEPT_ID . '">' . $row->DEPT_NAME . '</option>';
            }
        }
        echo $returnVal;
    }

    /**
     * @methodName ajax_get_program_with_all()
     * @access none
     * @param  none
     * @return Mixed Template
     */

    public function ajax_get_program_with_all()
    {
        $department = $this->input->post("selectedValue");
        $query = $this->utilities->findAllByAttribute('program', array("DEPT_ID" => $department, "ACTIVE_STATUS" => 1));
        $returnVal = '<option value="">--Select--</option>';
        $returnVal .= '<option value="all">All</option>';
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value="' . $row->PROGRAM_ID . '">' . $row->PROGRAM_NAME . '</option>';
            }
        }
        echo $returnVal;
    }

    /**
     * @methodName ajax_get_program()
     * @access none
     * @param  none
     * @return Mixed Template
     */

    public function ajax_get_program()
    {
        $department = $this->input->post("selectedValue");
        $query = $this->utilities->findAllByAttribute('program', array("DEPT_ID" => $department, "ACTIVE_STATUS" => 1));
        $returnVal = '<option value="">--Select--</option>';
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value="' . $row->PROGRAM_ID . '">' . $row->PROGRAM_NAME . '</option>';
            }
        }
        echo $returnVal;
    }

    /**
     * @methodName ajax_get_program()
     * @access none
     * @param  none
     * @return Mixed Template
     */

    public function ajax_get_offer_type()
    {
        $returnVal = '<option value="">--Select--</option>';
      //  $returnVal .= '<option value="O">Open Credit</option>';
        $returnVal .= '<option value="F">Fixed Credit</option>';
        echo $returnVal;
    }

    /** Edit by jahid */
    /**
     * @methodName getCourseByDept()
     * @access none
     * @param  none
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */

    public function getCourseByDept()
    {
        $department = $this->input->post("selectedValue");
        $faculty = $_POST['faculty'];
        $data['flag'] = $_POST['flag'];
        $data["category"] = $this->utilities->dropdownFromTableWithCondition("aca_course_category", "Select Category", "C_CAT_ID", "CAT_NAME", array("ACTIVE_STATUS" => 1)); // select all Category name from  aca_course_category
        $data["courses"] = $this->db->query("SELECT c.COURSE_ID, c.DEPT_ID, c.COURSE_CODE, c.COURSE_TITLE, c.CREDIT, c.GLOBAL_FOR_INSTITUTE,c.GLOBAL_FOR_FACULTY ,acc.C_CAT_ID, acc.CAT_NAME, acc.CAT_COLOR,f.FACULTY_ID
            FROM aca_course c
            LEFT JOIN aca_course_category acc on acc.C_CAT_ID = c.C_CAT_ID
            LEFT JOIN department d on d.DEPT_ID = c.DEPT_ID
            LEFT JOIN faculty f on f.FACULTY_ID = d.FACULTY_ID
            WHERE c.ACTIVE_STATUS = 1 and (c.DEPT_ID =$department or c.GLOBAL_FOR_INSTITUTE =1)
            UNION
            SELECT c.COURSE_ID, c.DEPT_ID, c.COURSE_CODE, c.COURSE_TITLE, c.CREDIT, c.GLOBAL_FOR_INSTITUTE,c.GLOBAL_FOR_FACULTY ,acc.C_CAT_ID, acc.CAT_NAME, acc.CAT_COLOR,f.FACULTY_ID
            FROM aca_course c
            LEFT JOIN aca_course_category acc on acc.C_CAT_ID = c.C_CAT_ID
            LEFT JOIN department d on d.DEPT_ID = c.DEPT_ID
            LEFT JOIN faculty f on f.FACULTY_ID = d.FACULTY_ID
            WHERE c.ACTIVE_STATUS = 1 AND c.GLOBAL_FOR_FACULTY =1 AND f.FACULTY_ID = $faculty")->result();
        $data['courseCat'] = $this->utilities->getAll("aca_course_category");
        $this->load->view('admin/course/course_offer_list', $data);
    }

    public function getCourseOffered()
    {
        $faculty = $_POST['faculty'];
        $department = $_POST['dept'];
        $program = $_POST['program'];
        $offer_type = $_POST['offer_type'];
        $data['faculty'] = $faculty;
        $data['department'] = $department;
        $data['program'] = $program;
        $data['offer_type'] = $offer_type;     
        $data["offered_courses"] = $this->course_model->getOfferedCourseList($program,$offer_type); 
        $this->load->view('admin/course/course_offered_display', $data);
    }

    public function getDeptWiseCourseOffered()
    {

        $userdata = $this->session->userdata('logged_in');

        //$data['dep_wise_course'] = $this->utilities->findAllByAttribute('aca_course', array("DEPT_ID" => $dep_id));

        $department = $userdata['DEPT_ID'];
        $program = $_POST['program'];
        $offer_type = $_POST['offer_type'];
        $data['department'] = $department;
        $data['program'] = $program;
        $data['offer_type'] = $offer_type;
        $data["offered_courses"] = $this->course_model->getOfferedCourseList($program,$offer_type);

        $this->load->view('admin/course/dept_wise_course_offered_display', $data);
    }

    /**
     * @methodName getCourseByProgram()
     * @access none
     * @param  none
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */

    public function getCourseByProgram()
    {


        $faculty = $_POST['faculty'];
        $dept = $_POST['dept'];
        $program = $_POST['program'];
        $data['courseCat'] = $this->utilities->getAll("aca_course_category");
        $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
        $data["courses"] = $this->db->query("SELECT ac.COURSE_ID, ac.COURSE_CODE, ac.COURSE_TITLE
            FROM aca_course_offer aco
            LEFT JOIN aca_course ac on ac.COURSE_ID = aco.COURSE_ID
            WHERE aco.FACULTY_ID = $faculty AND aco.DEPT_ID = $dept AND aco.PROGRAM_ID = $program
            ORDER BY ac.COURSE_TITLE")->result();

        $this->load->view('admin/course/course_offer_list_by_semester', $data);


    }

    /*
     * @methodName getCourseByProgramFromCourseOffer()
     * @access none
     * @param  none
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    public function getCourseByProgramFromCourseOffered()
    {
        $session=$_POST['session'];
        $data['session_name']=$this->utilities->academicSessionById($session);
        $data["session"] =$session ;
        $program = $_POST['program_id'];
        $OfferType = $_POST['OfferType'];
        //$data['flag'] = $_POST['flag'];
        $data['courseCat'] = $this->utilities->getAll("aca_course_category");
        $data["program"] = $program;
        $data["offerType"] = $OfferType;
        $data["semester"] = $this->utilities->getAll("sav_semester"); // select all Semester name from  m00_lkpdata
        $this->load->view('admin/course/course_offer_list_by_semester', $data);
    }

    /**
     * @methodName getCourseByProSemeFromSemeOffer()
     * @access none
     * @param  none
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    public function getCourseByProSemeFromSemeOffer()
    {
        $program = $_POST['program'];
        $semester = $_POST['semester'];
        $data['flag'] = $_POST['flag'];
        $data['semester_offer'] = $this->db->query("SELECT a.* FROM aca_semester_course a WHERE a.SEMESTER_ID = $semester AND a.PROGRAM_ID = $program")->result();
        $data['courseCat'] = $this->utilities->getAll("aca_course_category");
        $data["courses"] = $this->db->query("SELECT c.OFFERED_COURSE_ID,
            c.FACULTY_ID,
            c.DEPT_ID,
            c.PROGRAM_ID,
            c.COURSE_ID,
            c.COURSE_CODE,
            c.COURSE_TITLE,
            c.CREDIT,
            c.CAT_NAME,
            c.CAT_COLOR,
            (SELECT sc.SEQUENCE
            FROM aca_semester_course sc
            WHERE     sc.FACULTY_ID = c.FACULTY_ID
            AND sc.DEPT_ID = c.DEPT_ID
            AND sc.PROGRAM_ID = c.PROGRAM_ID
            AND sc.COURSE_ID = c.COURSE_ID
            AND sc.SEMESTER_ID = $semester)SEQUENCE,
            IFNULL(
            (SELECT COUNT(sc.COURSE_ID)
            FROM aca_semester_course sc
            WHERE     sc.FACULTY_ID = c.FACULTY_ID
            AND sc.DEPT_ID = c.DEPT_ID
            AND sc.PROGRAM_ID = c.PROGRAM_ID
            AND sc.COURSE_ID = c.COURSE_ID
            AND sc.SEMESTER_ID = $semester ), 0)
            IN_SEMESTER
            FROM (SELECT co.OFFERED_COURSE_ID,
            co.FACULTY_ID,
            co.DEPT_ID,
            co.PROGRAM_ID,
            co.COURSE_ID,
            ac.COURSE_CODE,
            ac.COURSE_TITLE,
            ac.CREDIT,
            cc.CAT_NAME,
            cc.CAT_COLOR
            FROM aca_course_offer co
            LEFT JOIN aca_course ac ON ac.COURSE_ID = co.COURSE_ID
            LEFT JOIN aca_course_category cc ON cc.C_CAT_ID = ac.C_CAT_ID
            WHERE  co.PROGRAM_ID = $program ) c ORDER BY SEQUENCE DESC")->result();

        $this->load->view('admin/course/course_offer_list_by_semester', $data);
    }

    /**
     * @methodName getCourseByDeptNotInCourseOffer()
     * @access none
     * @param  none
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */

    public function getCourseByDeptNotInCourseOffer()
    {
        $dept = $this->input->post("selectedValue");
        $data["courses"] = $this->utilities->getCourseNotInCOurseOffer($dept);
        $this->load->view('admin/course/course_offer_list', $data);
    }
        /**
     * @methodName coursePrerequisite()
     * @access none
     * @param  none
     * @return Mixed Template
     */
        function coursePrerequisite()
        {
            $program=$this->input->post("program");
            $offer_type=$this->input->post("offer_type"); 
            $course_id=$this->input->post("course_id");
            $data["program"]= $program;
            $data["offer_type"]=  $offer_type;
            $data["course_id"]=$course_id;
            $data["courses"] = $this->course_model->getOfferedCourseList($program,$offer_type); 
            $data["pre_courses"] = $this->course_model->getCourseWisePrerequisitionCourse($program,$course_id,$offer_type); 
           // print_r($data["pre_courses"]);exit;
            $this->load->view('admin/course/course_prerequisit_list', $data);
        }

    /**
     * @methodName coursePrequisite()
     * @access none
     * @param  none
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function createPrerequisite()
    {

        $program = $this->input->post('program');
        $course_id = $this->input->post('course_id');
        $offer_type = $this->input->post('offer_type');
        $PRE_COURSE_ID = $this->input->post('PRE_COURSE_ID');
        
        $success = 0;
        $this->db->query("DELETE FROM aca_crs_prerequisite WHERE COURSE_ID = $course_id");
        for ($i = 0; $i < sizeof($PRE_COURSE_ID); $i++) {
            $prequisit_course = array(
                "COURSE_ID" => $course_id,                
                "PROGRAM_ID" => $program,
                "OFFER_TYPE" => $offer_type,
                "PRE_COURSE_ID" => $PRE_COURSE_ID[$i],
                'CREATED_BY' => $this->user["USER_ID"]
            );
            $check = $this->utilities->hasInformationByThisId("aca_crs_prerequisite", array("COURSE_ID" => $course_id, "PRE_COURSE_ID" => $PRE_COURSE_ID[$i],"OFFER_TYPE" => $offer_type));
            if (empty($check)) {
                $success = $this->utilities->insertData($prequisit_course, 'aca_crs_prerequisite');
            }
        }
        if ($success) { // if data inserted successfully
            echo "&nbsp;&nbsp;<span class='btn btn-outline btn-primary btn-xs'>Add successfully &nbsp;<span class='text-primary'> <i class='fa fa-check'></i></span></span>";
        } else { // if data inserted failed
            echo "<div class='alert alert-warning'>Prerequisite Course Already exit</div>";
        }
    }

    function coursePrequisiteCounter()
    {
        $courseId = $this->input->post('courseId');
        $counter = $this->db->query("SELECT count(actp.COURSE_ID) as counter FROM aca_crs_temp_prerequisite actp
            WHERE actp.COURSE_ID = $courseId")->result();
        foreach ($counter as $key => $value) {
            echo $value->counter;
        }
    }

    /**
     * @methodName courseOfferPreview()
     * @access none
     * @param  none
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */

    function courseOfferPreview()
    {

        $cmbFaculty = $this->input->post('cmbFaculty');
        $department = $this->input->post('department');
        $program = $this->input->post('program');
        $OfferType = $this->input->post('OfferType');
        $chkCourses = $this->input->post('course_id');
        $update = $this->input->post('update');
        $data["totalSemester"] = $this->input->post('totalSemester');
        $data["totalDuration"] = $this->input->post('totalDuration');
        $data["chkCourses"] = $chkCourses;
        for ($i = 0; $i < sizeof($chkCourses); $i++) {
            $courseId[] = $chkCourses[$i];
            $cmbCategory = $this->input->post("cmbCategory$chkCourses[$i]");
            $duration[] = $this->input->post("duration$chkCourses[$i]");
            $minCredit[] = $this->input->post("minCredit$chkCourses[$i]");
            $Category[$i] = $cmbCategory;
            /**Course category no.*/
            //$data["courses"] = $this->utilities->findAllByAttribute("aca_course", array("COURSE_ID" => $chkCourses[$i]));
        }
        //exit();
        if ($update == 0) {
            $data["CheckCourseOffered"] = $this->utilities->getDeptNotInCourseOffer($program); // select true or false from Course offered with dept. ID
        }
        $data['category'] = $Category;
        /**category declared from array*/
        $data["update"] = $update;
        $data["courseId"] = $courseId;
        $data["prerequisite"] = $this->db->query("SELECT  DISTINCT COURSE_ID FROM aca_crs_temp_prerequisite;")->result();
        $data["OfferType"] = $OfferType;
        $data["duration"] = $duration;          //Time duration each course
        $data["minCredit"] = $minCredit;        // Minimum credit
        $data["degree"] = $this->db->query("SELECT  DISTINCT  d.DEGREE_NAME FROM program p
            LEFT JOIN degree d on d.DEGREE_ID = p.DEGREE_ID
            WHERE p.PROGRAM_ID = $program")->result();
        $data["faculty"] = $this->utilities->findByAttribute("faculty", array("FACULTY_ID" => $cmbFaculty));
        $data["department"] = $this->utilities->findByAttribute("department", array("DEPT_ID" => $department));
        $data["program"] = $this->utilities->findByAttribute("program", array("PROGRAM_ID" => $program));
        $this->load->view('admin/course/course_offer_preview', $data);
    }

    /**
     * @methodName semesterCoursePreview()
     * @access none
     * @param  none
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */

    function semesterCoursePreview()
    {
        $cmbFaculty = $this->input->post('cmbFaculty');
        $department = $this->input->post('department');
        $program = $this->input->post('program');
        $semester = $this->input->post('semester');
        $session = $this->input->post('session');
        $chkCourses = $this->input->post('course_id');
        $update = $this->input->post('update');
        $data["chkCourses"] = $chkCourses;
        for ($i = 0; $i < sizeof($chkCourses); $i++) {

            $sequence = $this->input->post("sequence$chkCourses[$i]");       // Sequence values fixed with checkbox selected
            $sequence_no[$i] = $sequence;
            $data["courses"] = $this->utilities->findAllByAttribute("aca_course", array("COURSE_ID" => $chkCourses[$i]));
        }
        $data['sequenceNo'] = $sequence_no;
        if ($update == 0) {
            $data["CheckCourseOffered"] = $this->utilities->getDeptNotInCourseOffer($program); // select true or false from Course offered with dept. ID
        }
        $data["update"] = $update;
        $data['degree'] = $this->db->query("SELECT d.DEGREE_NAME FROM program p
            LEFT JOIN degree d on d.DEGREE_ID = p.DEGREE_ID
            WHERE p.PROGRAM_ID = $program")->result();
        $data["faculty"] = $this->utilities->findByAttribute("faculty", array("FACULTY_ID" => $cmbFaculty));
        $data["department"] = $this->utilities->findByAttribute("department", array("DEPT_ID" => $department));
        $data["program"] = $this->utilities->findByAttribute("program", array("PROGRAM_ID" => $program));
        $data["semester"] = $this->utilities->findByAttribute("m00_lkpdata", array("LKP_ID" => $semester));
        $data["session"] = $this->utilities->sessionViewWithCondition($session); // session data from condition
        $this->load->view('admin/course/course_offer_By_semester_preview', $data);
    }

    /**
     * @methodName courseOfferList()
     * @access none
     * @param  none
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */

    function courseOfferList()
    {
        $data['contentTitle'] = 'Offered Course';
        $data['breadcrumbs'] = array(
            'Course' => '#',
            'Offered Course  List' => '#',
        );
        $data['courses_offer_list'] = $this->utilities->findAllByAttributeFromCourseOffer(); // select all data from  course_offer with department and program, course, semester inforamtion
        $data["faculty"] = $this->utilities->dropdownFromTableWithCondition("faculty", "Select Faculty", "FACULTY_ID", "FACULTY_NAME", array("ACTIVE_STATUS" => 1)); // select all faculty name from  faculty
        $data['content_view_page'] = 'admin/course/courses_offer_list_view';
        $this->admin_template->display($data);
    }

    /**
     * @methodName getCourseOfferByDeptProSemester()
     * @access none
     * @param  none
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */

    public function getCourseOfferByDeptProSemester()
    {

        $faculty = $_POST['faculty'];
        $department = $_POST['department'];
        $program = $_POST['program'];
        $semester = $_POST['semester'];
        $data['course_offer'] = $this->utilities->findAllByAttributeFromCourseOfferWithDeptProSem($department, $program, $semester); // select all
        $this->load->view('admin/course/course_offer_view', $data);
    }

    /**
     * @methodName courseOfferCreate()
     * @access none
     * @param  none
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */

    function courseOfferCreate()
    {

        $faculty = $this->input->post('faculty');
        $department = $this->input->post('department');
        $program = $this->input->post('program');
        $offerType = $this->input->post('offerType');
        $duration = $this->input->post('CrsDuration');
        $minCredit = $this->input->post('CrsMinCredit');
        $course = $this->input->post('courseId');
        $courseCategory = $this->input->post('category');
        /** $totalSemester = $this->input->post('totalSemester');
         * $totalDuration = $this->input->post('totalDuration');*/
        $status = 1;
        $COURSE_TYPE_ID = 1;

        // checking if Course with this name is already exist
        $check = $this->utilities->hasInformationByThisId("aca_course_offer", array("PROGRAM_ID" => $program, "OFFER_TYPE" => $offerType));
        if (empty($check)) {// if Department name, course code, course catagory available
            // preparing data to insert
            /** Not define */
            for ($i = 0; $i < sizeof($course); $i++) {

                $category = $this->utilities->findByAttribute("aca_course", array("COURSE_ID" => $course[$i]));
                $update = array(
                    'C_CAT_ID' => $courseCategory[$i],
                    'UPDATED_BY' => $this->user["USER_ID"],
                    'UPDATE_DATE' => date("Y-m-d h:i:s a")
                );
                $up = $this->utilities->updateData('aca_course', $update, array('COURSE_ID' => $course[$i]));
                $course_offer = array(
                    'OFFER_TYPE' => $offerType,
                    'FACULTY_ID' => $faculty,
                    'DEPT_ID' => $department,
                    'PROGRAM_ID' => $program,
                    //'SESSION_ID' => $session,
                    //'SEMESTER_ID' => $semester,
                    'COURSE_ID' => $course[$i],
                    'DURATION' => $duration[$i],
                    'MIN_CR_LIMIT' => $minCredit[$i],
                    'COURSE_CATEGORY_ID' => $category->C_CAT_ID,
                    'COURSE_TYPE_ID' => $COURSE_TYPE_ID,
                    'ACTIVE_STATUS' => $status,
                    'CREATED_BY' => $this->user["USER_ID"]
                );
                $success = $this->utilities->insertData($course_offer, 'aca_course_offer');
                /** Add prerequisite into aca_crs_prerequisite */
                $this->db->where('COURSE_ID', $course[$i]);
                $query = $this->db->get('aca_crs_temp_prerequisite');
                foreach ($query->result() as $row) {
                    $course_prerequisit = array(
                        'COURSE_ID' => $row->COURSE_ID,
                        'PRE_COURSE_ID' => $row->PRE_COURSE_ID,
                        'FACULTY_ID' => $faculty,
                        'DEPT_ID' => $department,
                        'PROGRAM_ID' => $program,
                        'ACTIVE_STATUS' => $status,
                        'CREATED_BY' => $this->user["USER_ID"]
                    );
                    $this->db->insert('aca_crs_prerequisite', $course_prerequisit);
                }
            }
            /** truncate aca_crs_temp_prerequisite*/
            $this->db->truncate('aca_crs_temp_prerequisite');

            if ($success) { // if data inserted successfully
                $oType = '';
                if ($offerType == "F") {
                    $oType = "FIXED CREDIT";
                } else {
                    $oType = "OPEN CREDIT";
                }
                $suc_re = $this->db->query("SELECT p.PROGRAM_NAME, d.DEPT_NAME, f.FACULTY_NAME, dg.DEGREE_NAME
                    FROM program p
                    LEFT JOIN department d on d.DEPT_ID = p.DEPT_ID
                    LEFT JOIN faculty f on f.FACULTY_ID = p.FACULTY_ID
                    LEFT JOIN degree dg on dg.DEGREE_ID = p.DEGREE_ID
                    WHERE p.PROGRAM_ID = $program")->row();
                echo "<div class='alert alert-primary text-center' style='background-color: #fff;'>
                <h1 class='text-info'><span class='text-primary'> <i class='fa fa-check-circle'></i></span> Course Offer successfully !!</h1>
                <hr>
                <h2>Faculty of $suc_re->FACULTY_NAME</h2>
                <h3>Department of $suc_re->DEPT_NAME </h3>
                <h4>Program of $suc_re->PROGRAM_NAME </h4>
                <h4>$suc_re->DEGREE_NAME </h4>
                <p>$oType</p>
                <hr>";
                echo "<table class='table'>
                <thead>
                <tr>
                <th>SN</th>
                <th>Title</th>
                <th>Credit</th>
                </tr>
                </thead>
                ";
                $sn = 1;
                for ($k = 0; $k < count($course); $k++) {
                    $qu = $this->db->query("SELECT c.COURSE_CODE, c.COURSE_TITLE, c.CREDIT, aca.CAT_NAME, aca.CAT_COLOR
                        FROM aca_course c
                        LEFT JOIN aca_course_category aca on aca.C_CAT_ID = c.C_CAT_ID
                        WHERE c.COURSE_ID = $course[$k] AND  c.ACTIVE_STATUS = 1")->result();
                    foreach ($qu as $row) {
                        echo "<tr class='text-left'>";
                        echo "<td>" . $sn++ . "</td>";
                        echo "<td>" . $row->COURSE_CODE . " " . $row->COURSE_TITLE . "</td>";
                        echo "<td>" . $row->CREDIT . "</td>";
                        echo "</tr>";
                    }
                }
                echo "</table>";
                echo "<a href ='" . base_url() . "Course/courseOffer'><button class='btn btn-block btn-outline btn-danger' type='button'>Again Course Offer ?</button></a>
                </div>";


            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Course Offered failed</div>";
            }
        } else {// if course name not available
            echo "<div class='alert alert-danger'>Course Offer Already Exist</div>";
        }
    }

    /**
     * @access none
     * @param  none
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */

    function createSemesterCourse()
    {
        $faculty = $this->input->post('faculty');
        $department = $this->input->post('department');
        $program = $this->input->post('program');
        $semester = $this->input->post('semester');
        $session = $this->input->post('session');
        $course = $this->input->post('course_id');
        $sequence = $this->input->post('sequence');
        $status = 1;
        $COURSE_TYPE_ID = 1;
        $success = 0;
        for ($i = 0; $i < sizeof($course); $i++) {
            $category = $this->utilities->hasInformationByThisId("aca_semester_course", array("PROGRAM_ID" => $program, "SEMESTER_ID" => $semester, "COURSE_ID" => $course[$i]));
            if (!$category) {
                $aca_semester_course = array(
                    'FACULTY_ID' => $faculty,
                    'DEPT_ID' => $department,
                    'PROGRAM_ID' => $program,
                    'SEMESTER_ID' => $semester,
                    'COURSE_ID' => $course[$i],
                    'SEQUENCE' => $sequence[$i],
                    'SESSION_ID' => $session,
                    'ACTIVE_STATUS' => $status,
                    'CREATED_BY' => $this->user["USER_ID"]
                );
                $success = $this->utilities->insertData($aca_semester_course, 'aca_semester_course');
            }

        }
        $suc_re = $this->db->query("SELECT p.PROGRAM_NAME, d.DEPT_NAME, f.FACULTY_NAME, dg.DEGREE_NAME FROM program p
            LEFT JOIN department d on d.DEPT_ID = p.DEPT_ID
            LEFT JOIN faculty f on f.FACULTY_ID = p.FACULTY_ID
            LEFT JOIN degree dg on dg.DEGREE_ID = p.DEGREE_ID
            WHERE p.PROGRAM_ID = $program")->result();
        $sem = $this->db->query("SELECT LKP_NAME FROM m00_lkpdata WHERE LKP_ID =$semester")->row();
        $ses = $this->utilities->sessionViewWithCondition($session); // session data with specific condition
        if ($success) { // if data inserted successfully
            foreach ($suc_re as $row) {
                echo "<div class='alert alert-primary text-center' style='background-color: #fff;'>
                <h2>Faculty of $row->FACULTY_NAME</h2>
                <h3>Department of $row->DEPT_NAME </h3>
                <h4>Program of $row->PROGRAM_NAME </h4>
                <h4>$row->DEGREE_NAME </h4>
                <h5>Session: $ses->SESSION_NAME ($ses->YEAR_SETUP_TITLE)</h5>
                <p>$sem->LKP_NAME</p>
                <div class='text-info'>Course Offer successfully !!</div>
                </div>";
            }
            echo "<a href ='" . base_url() . "course/semesterCourse'><button class='btn btn-block btn-outline btn-primary' type='button'>Again Course Offer ?</button></a>";
            echo "<a href ='" . base_url() . "course/semesterCourseView'><button class='btn btn-block btn-outline btn-primary' type='button' >Semester Course Offer List ? </button></a>";

        } else { // if data inserted failed
            foreach ($suc_re as $row) {
                echo "<div class='alert alert-primary text-center' style='background-color: #fff;'>
                <h2>Faculty of $row->FACULTY_NAME</h2>
                <h3>Department of $row->DEPT_NAME </h3>
                <h4>Program of $row->PROGRAM_NAME </h4>
                <h4>$row->DEGREE_NAME </h4>
                <h5>Session: $ses->SESSION_NAME ($ses->YEAR_SETUP_TITLE)</h5>
                <div class='text-danger'> <b>$sem->LKP_NAME </b>Course Offer Already Exist !!</div>
                </div>";
            }
            echo "<a href ='" . base_url() . "course/semesterCourse'><button class='btn btn-block btn-outline btn-primary' type='button'>Again Course Offer ?</button></a>";
            echo "<a href ='" . base_url() . "course/semesterCourseView'><button class='btn btn-block btn-outline btn-primary' type='button' >Semester Course Offer List ? </button></a>";
        }
    }

    /**
     * @methodName searchCourseOffer()
     * @access none
     * @param  none
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */

    function searchCourseOffer()
    {
        $faculty_id = $this->input->post('faculty');
        $department_id = $this->input->post('department');
        $program_id = $this->input->post('program');
        $offer_type = $this->input->post('offer_type');

        $data['result'] = $this->utilities->getOfferedCourses($faculty_id, $department_id, $program_id, $offer_type); // select all course for specific condition
        $this->load->view('admin/course/get_course_offer', $data);
    }

    /**
     * @methodName courseOfferAdd()
     * @access none
     * @param  none
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */

    function courseOfferAdd()
    {
        $program=$this->input->post('program');
        $offerType=$this->input->post('offerType');
        $department=$this->input->post('dept');

        $data["offered_courses"] = $this->course_model->getOfferedCourseList($program,$offerType);
        $data["courses"] = $this->utilities->findAllByAttribute('aca_course',array('DEPT_ID'=>$department));
        $data["faculty"] = $this->input->post('faculty');
        $data["department"] =$department;
        $data["program"] =  $program;
        $data["offerType"] = $offerType;
        $this->load->view('admin/course/course_offer_add_form', $data);
    }

    /***
     * @methodName courseOfferDelete()
     * @access none
     * @param  faculty defining Faculty ID
     * @param  dept defining Department ID
     * @param  program defining Program ID
     * @param  offerType defining whether the course offer type is Fixed or Open
     * @return Mixed Template
     * @author Jahid Hasan <jahid@atilimited.net>
     */

    function courseOfferDetails()
    {
        $faculty = $this->input->post('faculty');
        $department = $this->input->post('dept');
        $program = $this->input->post('program');
        $offerType = $this->input->post('offerType');
        $data['faculty_id'] = $faculty;
        $data['dept_id'] = $department;
        $data['program_id'] = $program;
        $data['offerType'] = $offerType;
        $data['course_offer'] = $this->utilities->getOfferedCoursesWithCondition($faculty, $department, $program, $offerType); // select all data from  course_offer with department and program, course, semester inforamtion condition with id
        $data['courseCat'] = $this->utilities->getAll("aca_course_category");
        $this->load->view('admin/course/course_offer_update', $data);
    }

    /**
     * @methodName courseOfferUpdate()
     * @access none
     * @param  none
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */

    function courseOfferUpdate()
    {
        $faculty = $this->input->post('faculty');
        $department = $this->input->post('department');
        $program = $this->input->post('program');
        $offerType = $this->input->post('courseType');
        $course = $this->input->post('course');
        for ($i = 0; $i < sizeof($course); $i++) {
            $courseId[] = $course[$i];          
            $duration[] = $this->input->post("duration$course[$i]");
            $minCredit[] = $this->input->post("minCredit$course[$i]");

        }
        for ($i = 0; $i < sizeof($course); $i++) {
            $course_offer = array(
                'OFFER_TYPE' => $offerType,
                'FACULTY_ID' => $faculty,
                'DEPT_ID' => $department,
                'PROGRAM_ID' => $program,
                'COURSE_ID' => $course[$i],
                'DURATION' => $duration[$i],
                'MIN_CR_LIMIT' => $minCredit[$i],                              
                'ACTIVE_STATUS' => 1,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            $success = $this->utilities->insertData($course_offer, 'aca_course_offer');
        }

        if ($success) { // if data inserted successfully
            echo "<div class='alert alert-success'>Course Offered  Create successfully</div>";
        } else { // if data inserted failed
            echo "<div class='alert alert-danger'>Course Offered insert failed</div>";
        }
    }

    /**
     * @methodName deleteCourseOffered()
     * @access none
     * @param  none
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    public function deleteCourseOffered()
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

    /**
     * @access none
     * @param  none
     * @return Mixed Template
     */

    function semesterCourse()
    {
        $data["ac_type"] = 1;
        $data['contentTitle'] = 'Semester Course';
        $data['breadcrumbs'] = array(
            'Course' => '#',
            'Semester Course' => '#',
        );
        $data["dimention"] = "vertical";
        $data["faculty"] = $this->utilities->getAll("ins_faculty"); // select all faculty name from  faculty
        $data["semester"] = $this->utilities->getAll("sav_semester"); // select all Semester name from  m00_lkpdata

        $data["offer_session"] = 
        $data["offered_session"] =

        $data['content_view_page'] = 'admin/course/course_offer_by_semester';
        $this->admin_template->display($data);
    }

    function sessionListForCourseOffer(){
        $program_id=$this->input->post('program_id');
        $query =$this->course_model->examSessionOfferList($program_id);
        $returnVal = '<option value="">Select One</option>';
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value="' . $row->YSESSION_ID . '">' . $row->SESSION_NAME . '</option>';
            }
        }
        echo $returnVal;

    }
    function sessionListAlreadyOffer(){
        $program_id=$this->input->post('program_id');
        $query = $this->course_model->examSessionOfferedList( $program_id);
        $returnVal = '<option value="">Select One</option>';
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value="' . $row->YSESSION_ID . '">' . $row->SESSION_NAME . '</option>';
            }
        }
        echo $returnVal;

    }




    /**
     * @param  program Id, OfferedType
     * @return Mixed Template
     */
    function offeredCourse()
    {
        $program = $this->input->post('program');
        $semester = $this->input->post('semester');
        $offerType = $this->input->post('offerType');
        $session = $this->input->post('session');
        $data["courses"] = $this->db->query("SELECT co.OFFERED_COURSE_ID, co.OFFER_TYPE, co.COURSE_ID,ac.COURSE_CODE, ac.COURSE_TITLE, ac.CREDIT
            FROM aca_course_offer co
            INNER JOIN aca_course ac on ac.COURSE_ID = co.COURSE_ID
            WHERE co.PROGRAM_ID = $program AND co.OFFER_TYPE = '$offerType' AND co.COURSE_ID NOT IN( 
            SELECT sc.COURSE_ID FROM aca_semester_course sc WHERE sc.COURSE_ID = co.COURSE_ID AND sc.PROGRAM_ID = co.PROGRAM_ID AND sc.SESSION_ID=$session)")->result();
        $data["program"] = $program;
        $data["semester"] = $semester;
        $data["offerType"] = $offerType;
        $data["session"] = $session;
        $this->load->view('admin/course/course_list_without_semeter_offer', $data);
    }

    /**
     * @methodName semesterCourseDelete()
     * @access none
     * @param  none
     * @return Mixed Template
     */
    function semesterCourseDelete() {
        $offerType = $this->input->post("offerType");
        $program = $this->input->post('program');
        $semester = $this->input->post('semester');
        $session = $this->input->post('session');
        $course = $this->input->post('course_id');
        //$course_offer_id = $this->input->post("course_offer_id_$course");
        // query for checking if course is already assign in this semester        
        $aca_semester_course = array(
            'SESSION_ID' => $session,
            'PROGRAM_ID' => $program,
            'SEMESTER_ID' => $semester,
            'COURSE_ID' => $course,
        );

        if ($this->utilities->deleteRowByAttribute( 'aca_semester_course', $aca_semester_course)) {
            echo "<span class='text-danger'><i class='fa fa-remove'></i></span>";
        }

    }
/**
     * @methodName semesterCourseAdd()
     * @access none
     * @param  none
     * @return Mixed Template
     */
function semesterCourseAdd()
{
    $offerType = $this->input->post("offerType");
    $program = $this->input->post('program');
    $semester = $this->input->post('semester');
    $session = $this->input->post('session');
    $course = $this->input->post('course_id');
    $course_offer_id = $this->input->post("course_offer_id_$course");
        // query for checking if course is already assign in this semester
    $sem_course_info = $this->utilities->hasInformationByThisId("aca_semester_course", array("PROGRAM_ID" => $program, "SEMESTER_ID" => $semester, "COURSE_ID" => $course, 'OFFERED_COURSE_ID' => $course_offer_id));
    if (empty($sem_course_info)) {
        $program_details = $this->utilities->findByAttribute("ins_program", array('PROGRAM_ID' => $program));
        $sequence = $this->utilities->get_max_value_by_attribute("aca_semester_course", "SEQUENCE", array('SEMESTER_ID' => $semester, 'PROGRAM_ID' => $program));
        if ($sequence) {
            $sequence = $sequence + 1;
        } else {
            $sequence = 1;
        }
            //for ($i=0; $i < sizeof($course); $i++) {
        $aca_semester_course = array(
            'FACULTY_ID' => $program_details->FACULTY_ID,
            'DEPT_ID' => $program_details->DEPT_ID,
            'PROGRAM_ID' => $program,
            'SEMESTER_ID' => $semester,
            'COURSE_ID' => $course,
            'OFFERED_COURSE_ID' => $course_offer_id,
            'SEQUENCE' => $sequence,
            'SESSION_ID' => $session,
            'ACTIVE_STATUS' => 1,
            'CREATED_BY' => $this->user["USER_ID"]
        );
        if ($this->utilities->insertData($aca_semester_course, 'aca_semester_course')) {
            echo "<i class='fa fa-check'></i>";
        } else {
            echo "<i class='fa fa-remove'></i>";
        }
            //}
    }
}

    /**
     * @methodName semesterCourseView()
     * @access none
     * @param  none
     * @return Mixed Template
     */
    function semesterCourseView()
    {
        $data["ac_type"] = 1;
        $data['contentTitle'] = 'Semester Course View';
        $data['breadcrumbs'] = array(
            'Course ' => '#',
            'Semester course view ' => '#',
        );
        $data["semesterCourse"] = $this->db->query("SELECT DISTINCT csa.FACULTY_ID, (SELECT f.FACULTY_NAME FROM faculty f WHERE f.FACULTY_ID = csa.FACULTY_ID)FACULTY_NAME,
            csa.DEPT_ID,(SELECT d.DEPT_NAME FROM department d WHERE d.DEPT_ID = csa.DEPT_ID)DEPT_NAME, csa.PROGRAM_ID,
            (SELECT p.PROGRAM_NAME FROM program p WHERE p.PROGRAM_ID = csa.PROGRAM_ID)PROGRAM_NAME, csa.SESSION_ID, s.SESSION_NAME
            FROM aca_semester_course csa
            LEFT JOIN session_view s on s.SESSION_ID = csa.SESSION_ID
            Order by csa.PROGRAM_ID")->result();
        $data['content_view_page'] = 'admin/course/semester_course_view';
        $this->admin_template->display($data);
    }

    /**
     * @methodName semesterCourseList()
     * @access none
     * @param  none
     * @return Mixed Template
     */
    function semesterCourseList()
    {
        $program = $this->input->post('program');
        $dept = $this->input->post('dept');
        $faculty = $this->input->post('faculty');
        $session = $this->input->post('session');

        $data["info"] = $this->db->query("SELECT DISTINCT(f.FACULTY_NAME), f.FACULTY_ID, dg.DEGREE_NAME, d.DEPT_ID, d.DEPT_NAME, p.PROGRAM_ID, p.PROGRAM_NAME,asca.SESSION_ID, s.SESSION_NAME, ys.YEAR_SETUP_TITLE
            FROM aca_semester_course asca
            LEFT JOIN faculty f on f.FACULTY_ID = asca.FACULTY_ID
            LEFT JOIN department d on d.DEPT_ID = asca.DEPT_ID
            LEFT JOIN program p on p.PROGRAM_ID = asca.PROGRAM_ID
            LEFT JOIN degree dg on dg.DEGREE_ID = p.DEGREE_ID
            LEFT JOIN session_year sy on sy.SES_YEAR_ID = asca.SESSION_ID
            LEFT JOIN session s on s.SESSION_ID = sy.SESSION
            LEFT JOIN year_setup ys on ys.YEAR_SETUP_ID = sy.YEAR_SETUP_ID
            WHERE asca.PROGRAM_ID = $program AND asca.DEPT_ID = $dept AND asca.FACULTY_ID = $faculty AND asca.SESSION_ID = $session")->result();

        $data["courses"] = $this->db->query("SELECT a.PROGRAM_ID, a.SEMESTER_ID, a.SESSION_ID, ac.COURSE_ID, ac.COURSE_TITLE,  ac.COURSE_CODE, ac.CREDIT, lkp.LKP_NAME
            FROM aca_semester_course a
            LEFT JOIN aca_course ac on a.COURSE_ID = ac.COURSE_ID
            LEFT JOIN m00_lkpdata lkp on lkp.LKP_ID = a.SEMESTER_ID
            WHERE a.PROGRAM_ID = $program AND a.DEPT_ID = $dept AND a.FACULTY_ID = $faculty AND a.SESSION_ID = $session
            ORDER BY a.SEMESTER_ID")->result();

        $this->load->view('admin/course/semester_course_list', $data);
    }
    /**
     * @methodName previousSessionWiseCourseOffer()
     * @access none
     * @param  none
     * @return Mixed Template
     */
    function previousSessionWiseCourseOffer()
    {
        $YSESSION_ID = $this->input->post('YSESSION_ID');
        $PREVIOUS_YSESSION = $this->input->post('PREVIOUS_YSESSION');
        $PROGRAM_ID = $this->input->post('PROGRAM_ID');        
        $previous_session_course= $this->course_model->programSessionWiseOfferedCourse($PROGRAM_ID,$PREVIOUS_YSESSION);
        foreach ($previous_session_course as $row) {
            $offer_coure=array(
                'FACULTY_ID'=>$row->FACULTY_ID,
                'DEPT_ID'=>$row->DEPT_ID,
                'PROGRAM_ID'=>$row->PROGRAM_ID,
                'SEMESTER_ID'=>$row->SEMESTER_ID,
                'COURSE_ID'=>$row->COURSE_ID,
                'OFFERED_COURSE_ID'=>$row->OFFERED_COURSE_ID,
                'ACTIVE_STATUS'=>$row->ACTIVE_STATUS,
                'SESSION_ID'=>$YSESSION_ID,
                'SEQUENCE'=>$row->SEQUENCE,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            $this->utilities->insertData($offer_coure, 'aca_semester_course');
        } 
        echo "Y";

    }

    /**
     * @methodName courseInformation()
     * @access none
     * @param  none
     * @return Mixed Template
     */
    function CourseViewPerSemester()
    {
        $program = $this->input->post('program');
        $semester = $this->input->post('semester');
        $offerType = $this->input->post('offerType');
        $session = $this->input->post('session');
        $courses = $this->db->query("SELECT ac.COURSE_ID, ac.COURSE_CODE, ac.COURSE_TITLE, acs.SEM_COURSE_ID
            FROM aca_semester_course  acs
            INNER JOIN aca_course ac on ac.COURSE_ID = acs.COURSE_ID
            WHERE PROGRAM_ID = $program AND SEMESTER_ID = $semester")->result();
        echo '<ol class="sortable">';
        foreach ($courses as $row) {
            echo "<li><a id='courseItem_" . $row->SEM_COURSE_ID . "' data-action='course/courseDetails' course='" . $row->COURSE_ID . "' class='openCourseDetailsModal' title='Course Details'>" . $row->COURSE_CODE . "&nbsp;: " . $row->COURSE_TITLE . "</a><span>&nbsp;&nbsp;&nbsp;&nbsp;<a class='semOfferedDeleteItem text-danger' id='" . $row->SEM_COURSE_ID . "' title='Click For Delete'  data-type='delete' data-field='SEM_COURSE_ID' data-tbl='aca_semester_course'><i class='fa fa-times'></i></a></span></li>";
        }
        echo "</ol>";
        echo "<a title='Semester Course Offered' class='label label-primary label-sm pull-left openOfferCourseModal' data-action='course/offeredCourse' session='" . $session . "'data-semester='" . $semester . "' data-program='" . $program . "'offerType='" . $offerType . "'> Add Course </a>";
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

    /**
     * @methodName courseInformation()
     * @access none
     * @param  none
     * @return Mixed Template
     */
    function courseInformation($program, $dept, $faculty, $session)
    {
        $data['pageTitle'] = 'Print PDF';
        $data['degree'] = $this->db->query("SELECT d.DEGREE_NAME
            FROM program p
            LEFT JOIN degree d on d.DEGREE_ID = p.DEGREE_ID
            WHERE p.PROGRAM_ID = $program")->result();
        $data["semesterCourse"] = $this->utilities->dropdownFromTableWithCondition("program", "Select Program", "PROGRAM_ID", "PROGRAM_NAME", array("ACTIVE_STATUS" => 1)); // select all program name from  program
        $data["info"] = $this->db->query("SELECT DISTINCT(f.FACULTY_NAME), f.FACULTY_ID, dg.DEGREE_NAME, d.DEPT_ID, d.DEPT_NAME, p.PROGRAM_ID, p.PROGRAM_NAME,asca.SESSION_ID, s.SESSION_NAME, ys.YEAR_SETUP_TITLE
            FROM aca_semester_course asca
            LEFT JOIN faculty f on f.FACULTY_ID = asca.FACULTY_ID
            LEFT JOIN department d on d.DEPT_ID = asca.DEPT_ID
            LEFT JOIN program p on p.PROGRAM_ID = asca.PROGRAM_ID
            LEFT JOIN degree dg on dg.DEGREE_ID = p.DEGREE_ID
            LEFT JOIN session_year sy on sy.SES_YEAR_ID = asca.SESSION_ID
            LEFT JOIN session s on s.SESSION_ID = sy.SESSION
            LEFT JOIN year_setup ys on ys.YEAR_SETUP_ID = sy.YEAR_SETUP_ID
            WHERE asca.PROGRAM_ID = $program AND asca.DEPT_ID = $dept AND asca.FACULTY_ID = $faculty AND asca.SESSION_ID = $session")->result();

        $data["courses"] = $this->db->query("SELECT a.PROGRAM_ID, a.SEMESTER_ID, a.SESSION_ID, ac.COURSE_ID, ac.COURSE_TITLE,  ac.COURSE_CODE, ac.CREDIT, lkp.LKP_NAME
            FROM aca_semester_course a
            LEFT JOIN aca_course ac on a.COURSE_ID = ac.COURSE_ID
            LEFT JOIN m00_lkpdata lkp on lkp.LKP_ID = a.SEMESTER_ID
            WHERE a.PROGRAM_ID = $program AND a.DEPT_ID = $dept AND a.FACULTY_ID = $faculty AND a.SESSION_ID = $session
            ORDER BY a.SEMESTER_ID")->result();

        include('mpdf/mpdf.php');
        $mpdf = new mPDF();
        $mpdf->SetTitle('Semester Course');
        $mpdf->mirrorMargins = 1;
        $mpdf->useOnlyCoreFonts = true;
        $report = $this->load->view('admin/course/semester_course_info', $data, TRUE);
        $footer = $this->load->view('admin/course/semester_course_info_footer', $data, TRUE);
        $mpdf->WriteHTML("$report");
        $mpdf->SetHTMLFooter("$footer");
        $mpdf->Output();
        exit;
    }

    /**
     * @methodName courseCategory()
     * @access none
     * @param  none
     * @return Mixed Template
     */
    function courseCategory()
    {
        $data["ac_type"] = 1;
        $data['contentTitle'] = 'Course Category';
        $data['breadcrumbs'] = array(
            'Course' => '#',
            'Course Category List ' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['courseCategory'] = $this->utilities->getAll('aca_course_category');
        $data['content_view_page'] = 'admin/setup/course_category/course_category_index';
        $this->admin_template->display($data);
    }

    /**
     * @methodName courseCatFormInsert()
     * @access
     * @param  none
     * @return Mixed Template
     */

    function courseCatFormInsert()
    {
        $data["ac_type"] = 1;
        $this->load->view('admin/setup/course_category/add_course_cat', $data);
    }

    /**
     * @methodName createCourseCategory()
     * @access
     * @param  none
     * @return Mixed Template
     */
    function createCourseCategory()
    {
        $catName = $this->input->post('catName'); // category name
        $description = $this->input->post('description'); // description name
        $color = $this->input->post('color'); // color name
        $sequence = $this->input->post('sequence'); // sequence name
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Course Category with this name is already exist
        $check = $this->utilities->hasInformationByThisId("aca_course_category", array("CAT_NAME" => $catName));
        if (empty($check)) {// if Course Category name available
            // preparing data to insert
            $course_cat = array(
                'CAT_NAME' => $catName,
                'CAT_DESC' => $description,
                'CAT_COLOR' => $color,
                'SEQUENCE' => $sequence,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->insertData($course_cat, 'aca_course_category')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Course Category Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Course Category Name insert failed</div>";
            }
        } else {// if faculty name not available
            echo "<div class='alert alert-danger'>Course Category Name Already Exist</div>";
        }
    }

    /**
     * @methodName courseCategoryList()
     * @access
     * @param  none
     * @return Mixed Template
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */

    function courseCategoryList()
    {
        $data["previlages"] = $this->checkPrevilege("course/courseCategory");
        $data['courseCategory'] = $this->utilities->findAllFromView('aca_course_category'); // select all data from courseCategory
        $this->load->view('admin/setup/course_category/course_category_list', $data);
    }

    /**
     * @methodName courseCategoryById()
     * @access
     * @param  none
     * @return Mixed Template
     */
    function courseCategoryById()
    {
        $courseCat_id = $this->input->post('param'); // degree name
        $data["previlages"] = $this->checkPrevilege("Course/courseCategory");
        $data['row'] = $this->utilities->findByAttribute('aca_course_category', array('C_CAT_ID' => $courseCat_id)); // select all data from degree where degree id

        $this->load->view('admin/setup/course_category/single_courseCategory_row', $data);
    }

    function courseCatFormUpdate()
    {
        $data["ac_type"] = 2;
        $id = $this->input->post('param'); // degree ID
        $data['courseCategory'] = $this->utilities->findByAttribute('aca_course_category', array('C_CAT_ID' => $id)); // select all data from degree where degree id
        $this->load->view('admin/setup/course_category/add_course_cat', $data);
    }

    /**
     * @methodName updateCourseCategory()
     * @access
     * @param  none
     * @return status
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */

    function updateCourseCategory()
    {
        $courseCat_id = $this->input->post('txtcourseCategoryId'); // degree name
        $catName = $this->input->post('catName'); // category name
        $description = $this->input->post('description'); // description name
        $color = $this->input->post('color'); // color name
        $sequence = $this->input->post('sequence'); // sequence name
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Course Category with this name is already exist
        $check = $this->utilities->hasInformationByThisId("aca_course_category", array("CAT_NAME" => $catName, "C_CAT_ID !=" => $courseCat_id));

        if (empty($check)) {// if Degree name available
            // preparing data to insert
            $course_cat = array(
                'CAT_NAME' => $catName,
                'CAT_DESC' => $description,
                'CAT_COLOR' => $color,
                'SEQUENCE' => $sequence,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->updateData('aca_course_category', $course_cat, array('C_CAT_ID' => $courseCat_id))) { // if data update successfully
                echo "<div class='alert alert-success'>Course Category Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Course Category Name Update failed</div>";
            }
        } else {// if degree name not available
            echo "<div class='alert alert-danger'>Course Category Name Already Exist</div>";
        }
    }

    /**
     * @methodName courseTopics()
     * @access
     * @param  none
     * @return status
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function courseTopics()
    {
        $data['contentTitle'] = 'Course Topics';
        $data['breadcrumbs'] = array(
            'Course' => '#',
            'Course Topics List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        //print_r($data["previlages"]);
        $data['courseTopics'] = $this->db->query("SELECT ac.COURSE_TITLE, act.*
            FROM aca_course_topics act
            Left JOIN aca_course ac on ac.COURSE_ID = act.COURSE_ID")->result();
        $data['content_view_page'] = 'admin/course/course_topics_index';
        $this->admin_template->display($data);
    }

    /**
     * @methodName courseTopicFormInsert()
     * @access
     * @param  none
     * @return status
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function courseTopicFormInsert()
    {
        $data["ac_type"] = 1; // for insert course info
        $data["department"] = $this->utilities->findAllByAttribute("department", array("ACTIVE_STATUS" => 1)); // select all department name from  department
        $this->load->view('admin/course/course_topics_create', $data);
    }
    /**
     * @methodName createCourseTopics()
     * @access
     * @param  none
     * @return status
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function createCourseTopics(){

        $courseId = $this->input->post('cmbCourses');
        $topicTitle = $this->input->post('topicTitle');
        $duration = $this->input->post('duration');
        $sugggestedAct = $this->input->post('sugggestedAct');
        $description = $this->input->post('description');
        $status = ((isset($_POST['status'])) ? 1 : 0);
        $course_topics = array(
            'COURSE_ID' => $courseId,
            'TOPIC_TITLE' => $topicTitle,
            'TOPIC_DESC' => $description,
            'TOPIC_DURATION' => $duration,
            'SUGGESTED_ACTIVITIES' => $sugggestedAct,
            'ACTIVE_STATUS' => $status,
            'CREATED_BY' => $this->user["USER_ID"]
        );
        $success = $this->utilities->insertData($course_topics, 'aca_course_topics');
        if ($success) { // if data inserted successfully
            echo "<div class='alert alert-success'>Course Topics  Create successfully</div>";
        } else { // if data inserted failed
            echo "<div class='alert alert-danger'>Course Topics insert failed</div>";
        }
    }

    /**
     * @methodName deleteCourseTopics()
     * @access
     * @param  none
     * @return status
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function deleteCourseTopics()
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

    /**
     * @methodName courseTopicFormUpdate()
     * @access
     * @param  none
     * @return status
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function courseTopicFormUpdate()
    {
        $courseTopicsId = $this->input->post('param');
        $data["ac_type"] = 2; //for update course info
        $data['courseTopic'] = $this->db->query("SELECT act.*, ac.COURSE_CODE, ac.COURSE_TITLE, d.DEPT_NAME, d.DEPT_ID
            FROM aca_course_topics act
            LEFT JOIN aca_course ac on ac.COURSE_ID = act.COURSE_ID
            LEFT JOIN department d on d.DEPT_ID = ac.DEPT_ID
                                                WHERE act.CRS_TOPIC_ID = $courseTopicsId")->row(); // select all data from  course inforamtion
        $data["department"] = $this->utilities->findAllByAttribute("department", array("ACTIVE_STATUS" => 1)); // select all department name from  department
        $this->load->view('admin/course/course_topics_create', $data);
    }

    /**
     * @methodName updateCourseTopics()
     * @access
     * @param  none
     * @return status
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function updateCourseTopics()
    {
        $txtCourseTopicID = $this->input->post('txtCourseTopicID'); // course id hidden value
        $cmbCourses = $this->input->post('cmbCourses');
        $topicTitle = $this->input->post('topicTitle');
        $duration = $this->input->post('duration');
        $sugggestedAct = $this->input->post('sugggestedAct');
        $description = $this->input->post('description');
        $status = ((isset($_POST['status'])) ? 1 : 0);
        $course_topics = array(
            'COURSE_ID' => $cmbCourses,
            'TOPIC_TITLE' => $topicTitle,
            'TOPIC_DESC' => $description,
            'TOPIC_DURATION' => $duration,
            'SUGGESTED_ACTIVITIES' => $sugggestedAct,
            'ACTIVE_STATUS' => $status,
            'CREATED_BY' => $this->user["USER_ID"]
        );
        if ($this->utilities->updateData('aca_course_topics', $course_topics, array('CRS_TOPIC_ID' => $txtCourseTopicID))) { // if data update successfully
            echo "<div class='alert alert-success'>Course Update successfully</div>";
        } else { // if data update failed
            echo "<div class='alert alert-danger'>Course Update failed</div>";
        }
    }

    /**
     * @methodName courseTopicsById()
     * @access
     * @param  none
     * @return status
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function courseTopicsById()
    {
        $course_topics_id = $this->input->post('param'); // course id / hidden value
        $data['row'] = $this->db->query("SELECT ac.COURSE_TITLE, act.*
            FROM aca_course_topics act
            Left JOIN aca_course ac on ac.COURSE_ID = act.COURSE_ID
            WHERE act.CRS_TOPIC_ID = $course_topics_id")->row();
        $this->load->view('admin/course/single_course_topics_row', $data);
    }

    /**
     * @methodName courseTopicInfo()
     * @access
     * @param  none
     * @return status
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function courseTopicInfo()
    {
        $courseTopicsId = $_POST['param']; // course id / hidden value
        $data['courseTopic'] = $this->db->query("SELECT act.*, ac.COURSE_CODE, ac.COURSE_TITLE, d.DEPT_NAME, d.DEPT_ID
            FROM aca_course_topics act
            LEFT JOIN aca_course ac on ac.COURSE_ID = act.COURSE_ID
            LEFT JOIN department d on d.DEPT_ID = ac.DEPT_ID
                                                WHERE act.CRS_TOPIC_ID = $courseTopicsId")->row(); // select all data from  course inforamtion
        $this->load->view("admin/course/course_topics_info", $data);

    }

    /**
     * @methodName getCoursesTopics()
     * @access
     * @param  none
     * @return status
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function getCoursesTopics()
    {
        $data["previlages"] = $this->checkPrevilege("Course/courseTopics");

        $data['courseTopics'] = $this->db->query("SELECT ac.COURSE_TITLE, act.*
            FROM aca_course_topics act
            Left JOIN aca_course ac on ac.COURSE_ID = act.COURSE_ID")->result();
        $this->load->view("admin/course/course_topics_list", $data);
    }

    /**
     * @methodName ajax_get_course()
     * @access
     * @param  none
     * @return status
     * @author Emdadul Huq <Emdadul@atilimited.net>
     */
    function ajax_get_course()
    {
        $dept = $_POST['dept']; // course id / hidden value
        $query = $this->utilities->findAllByAttribute('aca_course', array("DEPT_ID" => $dept, "ACTIVE_STATUS" => 1));
        $returnVal = '<option value="" id="cmbCourses" >Select Course Title</option>';
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value="' . $row->COURSE_ID . '">' . $row->COURSE_CODE . ":" . $row->COURSE_TITLE . '</option>';
            }
        }
        echo $returnVal;
    }
    function courseMap(){

        $data['contentTitle'] = 'Course Mapping';
        $data['breadcrumbs'] = array(
            'Course' => '#',
            'Course Mapping' => '#',
        );       
        $data['teacher_list'] =$this->utilities->findAllByAttribute('hr_emp',array('EMP_TYPE'=>'T')); 
        $data['dept_list'] =$this->utilities->findAllByAttribute('ins_dept',array('UFOR_ACM'=>1)); 
        $data['aca_ses_list'] =$this->utilities->academicSessionList(); 
        $data['content_view_page'] = 'admin/course/course_map_index';
        $this->admin_template->display($data);
    }
    function createCourseMap(){

        $course_id=$this->input->post('COURSE_ID');       
        $EMP_ID=$this->input->post('TEACHER_ID');       
        $SESSION_ID=$this->input->post('SESSION_ID');       

        if(!empty($course_id)){
            for($i=0; $i<sizeof($course_id); $i++ ){
                $course_map=array(
                    'EMP_ID'=>$EMP_ID,
                    'COURSE_ID'=>$course_id[$i],                    
                    'SESSION_ID'=>$SESSION_ID,
                    'ACTIVE_STATUS'=>1
                );
                $check = $this->utilities->hasInformationByThisId("teacher_course_map", array("EMP_ID" => $EMP_ID, "COURSE_ID" => $course_id[$i],'SESSION_ID'=>$SESSION_ID));
                if (empty($check)) { 
                    $this->utilities->insertData($course_map, 'teacher_course_map');
                }
            }
        }
    }
    function teacheSessionWiseCourseMap(){

        $teacher_id=$this->input->post('TEACHER_ID');
        $session_id=$this->input->post('SESSION_ID');
        $data['teacher_course_map'] = $this->db->query("SELECT a.*,
         b.COURSE_CODE,
         b.COURSE_TITLE,
         b.CREDIT
         FROM teacher_course_map a, aca_course b
         WHERE a.COURSE_ID = b.COURSE_ID AND a.SESSION_ID =$session_id AND a.EMP_ID =$teacher_id")->result();

        $this->load->view('admin/course/teacher_wise_course_map_list',$data);
    }
    function teacheSessionWiseCourseMapDropdown(){

        $teacher_id=$this->input->post('TEACHER_ID');
        $session_id=$this->input->post('SESSION_ID');
        $query = $this->db->query("SELECT a.*,
         b.COURSE_CODE,
         b.COURSE_TITLE,
         b.CREDIT
         FROM teacher_course_map a, aca_course b
         WHERE a.COURSE_ID = b.COURSE_ID AND a.SESSION_ID =$session_id AND a.EMP_ID =$teacher_id")->result();

        $returnVal = '<option value = "">--Select--</option>';
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value = "' . $row->COURSE_ID . '">' . $row->COURSE_TITLE . '</option>';
            }
        }
        echo $returnVal;
    }
    function teacherSessWiseCourseMapList(){

        $dept_id = $_POST['dept_id'];
        $session_id = $_POST['SESSION_ID']; 
        $teacher_id = $_POST['TEACHER_ID']; 
        $query = $this->db->query("SELECT a.*
            FROM aca_course a
            WHERE    a.COURSE_ID NOT IN (SELECT b.COURSE_ID
            FROM teacher_course_map b
            WHERE b.SESSION_ID = $session_id AND b.EMP_ID = $teacher_id)")->result();
        $returnVal = '<option value = "">--Select--</option>';
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value = "' . $row->COURSE_ID . '">' . $row->COURSE_TITLE . '</option>';
            }
        }
        echo $returnVal;
    }

    function classSchedule(){

        $data['contentTitle'] = 'Course Mapping';
        $data['breadcrumbs'] = array(
            'Course' => '#',
            'Course Mapping' => '#',
        );       
        $data['teacher_list'] =$this->utilities->findAllByAttribute('hr_emp',array('EMP_TYPE'=>'T')); 
        $data["prog_list"] = $this->utilities->findAllByAttribute("ins_program",array('ACTIVE_STATUS' => 1)); 
        $data["section"] = $this->utilities->findAllByAttribute("aca_section", array('ACTIVE_STATUS' => 1));
        $data["rooms"] = $this->utilities->findAllByAttribute("sa_room",array('ACTIVE_STATUS' => 1)); 
        $data["weeks"] = $this->utilities->getAll("weeks"); 
        $data['aca_ses_list'] =$this->utilities->academicSessionList(); 
        $data['class_schedule'] =$this->course_model->getAllClassSchedule(); 
        $data['content_view_page'] = 'admin/course/class_schedule_index';
        $this->admin_template->display($data);
    }
    function createClassSchedule(){ 

        $SESSION_ID=$this->input->post('SESSION_ID');       
        $PROGRAM_ID=$this->input->post('PROGRAM_ID');       
        $BATCH_ID=$this->input->post('BATCH_ID');       
        $SECTION_ID=$this->input->post('SECTION_ID'); 
        $TEACHER_ID=$this->input->post('TEACHER_ID');   
        $COURSE_ID=$this->input->post('COURSE_ID');    
        $ROOM_ID=$this->input->post('ROOM_ID');    
        $DAY=$this->input->post('DAY');    
        $START_TIME=$this->input->post('START_TIME');    
        $END_TIME=$this->input->post('END_TIME'); 

        $class_schedule=array(
            'SESSION_ID'=>$SESSION_ID,
            'PROGRAM_ID'=>$PROGRAM_ID,
            'BATCH_ID'=>$BATCH_ID,
            'SECTION_ID'=>$SECTION_ID,
            'TEACHER_ID'=>$TEACHER_ID,
            'COURSE_ID'=>$COURSE_ID,                    
            'ROOM_ID'=>$ROOM_ID,                    
            'DAY'=>$DAY,                    
            'START_TIME'=>$START_TIME,                    
            'END_TIME'=>$END_TIME, 
            'ACTIVE_STATUS'=>1
        );
        
        $check = $this->utilities->hasInformationByThisId("class_schedule", array("TEACHER_ID" => $TEACHER_ID, "COURSE_ID" => $COURSE_ID,'SESSION_ID'=>$SESSION_ID));
        if (empty($check)) { 
            $this->utilities->insertData($class_schedule, 'class_schedule');
        }


    }

    /**
     * @methodName departmentWiseCourseMapList()
     * @access
     * @param  none
     * @return status
     * @author Md.Reazul Islam<reazul@atilimited.net>
     */
    
    function departmentWiseCourseMapList(){
        $data['contentTitle'] = 'Department Wise Course List';
        $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Course List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
       //print_r($data["previlages"] );exit();
        $user_data = $this->session->userdata('logged_in');
        $dep_id=($user_data['DEPT_ID']);
        $data['dep_wise_course'] = $this->utilities->findAllByAttribute('aca_course', array("DEPT_ID" => $dep_id));
        $data['dep_name'] = $this->course_model->getDepById($dep_id);
        $data['content_view_page'] = 'admin/course/dep_wise_course_index';
        $this->admin_template->display($data);
    }

    /**
     * @methodName departmentWiseCourseInsert()
     * @access
     * @param  none
     * @return status
     * @author Md.Reazul Islam<reazul@atilimited.net>
     */
    function departmentWiseCourseInsert()
    {
        $data["ac_type"] = 1; // for insert course info
        $data["category"] = $this->utilities->dropdownFromTableWithCondition("aca_course_category", "Select Category", "C_CAT_ID", "CAT_NAME", array("ACTIVE_STATUS" => 1)); // select all category name from  category
        $this->load->view('admin/course/create_dep_wise_course', $data);
    }

     /**
     * @methodName createDepWiseCourse()
     * @access
     * @param  none
     * @return status
     * @author Md.Reazul Islam<reazul@atilimited.net>
     */

     function createDepWiseCourse()
    {
        $user_data = $this->session->userdata('logged_in');
        $dep_id=($user_data['DEPT_ID']);
        $code = $this->input->post('courseCode'); // course code name
        $title = $this->input->post('courseTitle'); // course title name
        $credit = $this->input->post('courseCredit'); // course credit name
        $category = $this->input->post('cmbCategory'); // course category name
        $content = $this->input->post('content'); // course category name
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        $Institute = ((isset($_POST['Institute'])) ? 1 : 0);  // active Institute
        $Faculty = ((isset($_POST['Faculty'])) ? 1 : 0); // active Faculty
        $BOOKS = $this->input->post('BOOKS');
        $TEACHING_METHOD = $this->input->post('TEACHING_METHOD');
        $MISSION = $this->input->post('MISSION');
        $VISION = $this->input->post('VISION');
        $OBJECTIVE = $this->input->post('OBJECTIVE');
        // checking if Course with this name is already exist
        $check = $this->utilities->hasInformationByThisId("aca_course", array("COURSE_CODE" => $code));
        if (empty($check)) {// if Department name, course code, course catagory available
            // preparing data to insert
            $course = array(
                'DEPT_ID' => $dep_id,
                'COURSE_CODE' => $code,
                'COURSE_TITLE' => $title,
                'CREDIT' => $credit,
                'C_CAT_ID' => $category,
                'COURSE_DESC' => $content,
                'BOOKS' => $BOOKS,
                'TEACHING_METHOD' => $TEACHING_METHOD,
                'MISSION' => $MISSION,
                'VISION' => $VISION,
                'OBJECTIVE' => $OBJECTIVE,
                'ACTIVE_STATUS' => $status,
                'GLOBAL_FOR_FACULTY' => $Faculty,
                'GLOBAL_FOR_INSTITUTE' => $Institute,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->insertData($course, 'aca_course')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Course Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Course insert failed</div>";
            }
        } else {// if course name not available
            echo "<div class='alert alert-danger'>Course Name Already Exist</div>";
        }
    }

     /**
     * @methodName getDepWiseCourses()
     * @access
     * @param  none
     * @return status
     * @author Md.Reazul Islam<reazul@atilimited.net>
     */

     function getDepWiseCourses()
    {   
        $user_data = $this->session->userdata('logged_in');
        $dep_id=($user_data['DEPT_ID']);
        $data["previlages"] = $this->checkPrevilege("Course/departmentWiseCourseMapList");
        $data['dep_wise_course'] = $this->utilities->findAllByAttribute('aca_course', array("DEPT_ID" => $dep_id)); // select all data from  course with department and catagory inforamtion
        $this->load->view("admin/course/dep_wise_course_list", $data);
    }

    /**
     * @methodName depWiseCourseFormUpdate()
     * @access
     * @param  none
     * @return status
     * @author Md.Reazul Islam<reazul@atilimited.net>
     */

     function depWiseCourseFormUpdate()
    {
        $course_id = $this->input->post('param');
        $data["ac_type"] = 2; //for update course info
        $data['course'] = $this->utilities->findByAttribute('aca_course', array("COURSE_ID" => $course_id)); 
        $data["category"] = $this->utilities->dropdownFromTableWithCondition("aca_course_category", "Select Category", "C_CAT_ID", "CAT_NAME", array("ACTIVE_STATUS" => 1)); 
        $this->load->view('admin/course/create_dep_wise_course', $data);
    }

   /**
     * @methodName updateDepWiseCourse()
     * @access
     * @param  none
     * @return status
     * @author Md.Reazul Islam<reazul@atilimited.net>
     */

    function updateDepWiseCourse()
    {
        $user_data = $this->session->userdata('logged_in');
        $dep_id=($user_data['DEPT_ID']);
        $course_id = $this->input->post('txtCourseID'); // course id hidden value
        $code = $this->input->post('courseCode'); // course code name
        $title = $this->input->post('courseTitle'); // course title name
        $credit = $this->input->post('courseCredit'); // course credit name
        $category = $this->input->post('cmbCategory'); // course category name
        $content = $this->input->post('content'); // course category name
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        $Institute = $this->input->post('Institute'); // active Institute
        $Faculty = $this->input->post('Faculty'); // active Faculty
        $BOOKS = $this->input->post('BOOKS');
        $TEACHING_METHOD = $this->input->post('TEACHING_METHOD');
        $MISSION = $this->input->post('MISSION');
        $VISION = $this->input->post('VISION');
        $OBJECTIVE = $this->input->post('OBJECTIVE');
        // checking if Course with this name is already exist
        $check = $this->utilities->findByAttribute("aca_course", array("COURSE_ID !=" => $course_id, "COURSE_CODE" => $code));
        if (empty($check)) {// if Department name, course code available
            // preparing data to update
            $update = array(
                'DEPT_ID' => $dep_id,
                'COURSE_CODE' => $code,
                'COURSE_TITLE' => $title,
                'CREDIT' => $credit,
                'C_CAT_ID' => $category,
                'COURSE_DESC' => $content,
                'BOOKS' => $BOOKS,
                'TEACHING_METHOD' => $TEACHING_METHOD,
                'MISSION' => $MISSION,
                'VISION' => $VISION,
                'OBJECTIVE' => $OBJECTIVE,
                'ACTIVE_STATUS' => $status,
                'GLOBAL_FOR_FACULTY' => $Faculty,
                'GLOBAL_FOR_INSTITUTE' => $Institute,
                'UPDATED_BY' => $this->user["USER_ID"],
                'UPDATE_DATE' => date("Y-m-d h:i:s a")
            );
            if ($this->utilities->updateData('aca_course', $update, array('COURSE_ID' => $course_id))) { // if data update successfully
                echo "<div class='alert alert-success'>Course Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Course insert failed</div>";
            }
        } else {// if course name not available
            echo "<div class='alert alert-danger'>Course Name Already Exist</div>";
        }
    }
    /**
     * @methodName courseDepWiseById()
     * @access
     * @param  none
     * @return status
     * @author Md.Reazul Islam<reazul@atilimited.net>
     */

    function courseDepWiseById()
    { 
        $data["previlages"] = $this->checkPrevilege("Course/departmentWiseCourseMapList");
        $course_id = $this->input->post('param'); // course id / hidden value
        $data['row'] = $this->course_model->getCourseById($course_id);
        $this->load->view('admin/course/single_course_dep_wise_row', $data);
    }

    /**
     * @methodName courseDepWiseById()
     * @access
     * @param  none
     * @return status
     * @author Md.Reazul Islam<reazul@atilimited.net>
     */
    function depWiseCourseInfo()
    {
        $course_id = $this->input->post('param');
        // select all data from  course with department and catagory inforamtion
        $data['courses'] = $this->course_model->getCourseById($course_id);
        $this->load->view("admin/course/dep_wise_course_info", $data);
    }



}

/** End of file Course.php */
/** Location: ./application/controllers/Course.php */