<?php

Class Course_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getCourseList()
    {
        $result = $this->db->query("SELECT c.COURSE_ID,c.COURSE_CODE, c.COURSE_TITLE, c.CREDIT, c.COURSE_DESC,c.ACTIVE_STATUS,c.GLOBAL_FOR_INSTITUTE, c.GLOBAL_FOR_FACULTY,
            (SELECT d.DEPT_NAME FROM ins_dept d WHERE d.DEPT_ID = c.DEPT_ID )DEPT_NAME,
            (SELECT cc.CAT_NAME FROM aca_course_category cc WHERE cc.C_CAT_ID = c.C_CAT_ID )COURSE_CATEGORY
            FROM aca_course c ORDER BY c.COURSE_ID DESC ")->result();
        //echo "<pre>"; print_r($result); exit; echo "</pre>";
        return $result;
    }
    public function getCourseById($course_id)
    {
     $query= $this->db->query("SELECT c.COURSE_ID,c.COURSE_CODE, c.COURSE_TITLE, c.CREDIT, c.COURSE_DESC, c.BOOKS, c.TEACHING_METHOD, c.MISSION, c.VISION, c.OBJECTIVE, c.ACTIVE_STATUS,c.GLOBAL_FOR_INSTITUTE, c.GLOBAL_FOR_FACULTY,
                                    (SELECT d.DEPT_NAME FROM ins_dept d WHERE d.DEPT_ID = c.DEPT_ID )DEPT_NAME,
                                    (SELECT cc.CAT_NAME FROM aca_course_category cc WHERE cc.C_CAT_ID = c.C_CAT_ID )COURSE_CATEGORY
                                    FROM aca_course c WHERE c.COURSE_ID = $course_id")->row();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
     return $query;
    }
// get department name by reazul
     public function getDepById($dep_id)
    {
     $query= $this->db->query("SELECT  d.DEPT_NAME
                                    FROM ins_dept d 
                                    LEFT JOIN aca_course c ON d.DEPT_ID = c.DEPT_ID
                                    WHERE d.DEPT_ID  = $dep_id")->row();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
     return $query;
    }
    public function getOfferedCourseList($program_id,$offer_type){
     $query= $this->db->query("SELECT a.*,
                                   b.COURSE_CODE,
                                   b.COURSE_TITLE,
                                    b.CREDIT,
                                   c.CAT_NAME
                              FROM aca_course_offer a
                                   LEFT JOIN aca_course b ON a.COURSE_ID = b.COURSE_ID
                                   LEFT JOIN aca_course_category c ON b.C_CAT_ID = c.C_CAT_ID
                             WHERE a.PROGRAM_ID = $program_id AND a.OFFER_TYPE = '$offer_type'")->result();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
     return $query;
    }
    public function getCourseWisePrerequisitionCourse($program,$course_id,$offer_type){
     $query= $this->db->query("SELECT a.PRE_COURSE_ID,b.COURSE_CODE
                                                      FROM aca_crs_prerequisite a
                                                           LEFT JOIN aca_course b ON a.PRE_COURSE_ID = b.COURSE_ID
                                                     WHERE a.PROGRAM_ID=$program and  a.COURSE_ID = $course_id  and a.OFFER_TYPE='$offer_type'")->result();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
     return $query;
    }
    public function programSessionWiseOfferedCourse($program_id,$session){
     $query= $this->db->query("SELECT a.FACULTY_ID,
                                       a.DEPT_ID,
                                       a.PROGRAM_ID,
                                       a.SEMESTER_ID,
                                       a.COURSE_ID,
                                       a.OFFERED_COURSE_ID,
                                       a.SEQUENCE,
                                       a.ACTIVE_STATUS
                                  FROM aca_semester_course a
                                 WHERE a.PROGRAM_ID = $program_id AND a.SESSION_ID = $session")->result();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
     return $query;
    }

    public function enrollmentCourse($program_id,$session_id,$semester,$offer_type){
     $query= $this->db->query("SELECT b.COURSE_ID,
                                       b.COURSE_CODE,
                                       b.COURSE_TITLE,
                                       b.CREDIT,
                                       a.OFFERED_COURSE_ID
                                  FROM aca_semester_course a, aca_course b, aca_course_offer c
                                 WHERE     a.COURSE_ID = b.COURSE_ID
                                       AND a.OFFERED_COURSE_ID = c.OFFERED_COURSE_ID
                                       AND a.PROGRAM_ID = $program_id
                                       AND a.SESSION_ID = $session_id
                                       AND a.SEMESTER_ID = $semester
                                       AND c.OFFER_TYPE = '$offer_type'")->result();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
     return $query;
    }
    public function examSessionOfferList($program_id){
     $query= $this->db->query("SELECT a.*, concat(b.SESSION_NAME, ' - ', a.DINYEAR) AS SESSION_NAME
                                    FROM ins_ysession a LEFT JOIN ins_session b ON a.SESSION_ID = b.SESSION_ID
                                   WHERE a.YSESSION_ID NOT IN (SELECT c.SESSION_ID
                                                                 FROM aca_semester_course c
                                                                WHERE c.PROGRAM_ID = $program_id)
                                  ORDER BY a.UD_SLNO ASC")->result();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
     return $query;
    }
    public function examSessionOfferedList($program_id){
     $query= $this->db->query("SELECT a.*, concat(b.SESSION_NAME, ' - ', a.DINYEAR) AS SESSION_NAME
                                  FROM ins_ysession a LEFT JOIN ins_session b ON a.SESSION_ID = b.SESSION_ID
                                 WHERE a.YSESSION_ID  IN (SELECT c.SESSION_ID
                                                               FROM aca_semester_course c WHERE c.PROGRAM_ID = $program_id) ORDER BY a.UD_SLNO ASC")->result();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
     return $query;
    }
    public function getStudentSessionWiseCourseList($student_id,$session_id){
     $query= $this->db->query("SELECT b.COURSE_ID,
                                       b.COURSE_CODE,
                                       b.COURSE_TITLE,
                                       b.CREDIT
                                FROM student_courseinfo a, aca_course b
                                WHERE     a.COURSE_ID = b.COURSE_ID
                                      AND a.STUDENT_ID = $student_id
                                      AND a.SESSION_ID = $session_id
                                      AND a.IS_DROPPED = 0")->result();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
     return $query;
    }
    public function getStudentClassSchedule($program_id,$batch_id,$section_id,$session_id,$course_id,$day){
     $query= $this->db->query("SELECT a.START_TIME,
                                     a.END_TIME,
                                     c.ROOM_NO,
                                     b.SHORT_NAME
                              FROM class_schedule a, hr_emp b, sa_room c
                              WHERE     a.TEACHER_ID = b.EMP_ID
                                    AND a.ROOM_ID = c.ROOM_ID
                                    AND a.PROGRAM_ID =$program_id
                                    AND a.BATCH_ID = $batch_id
                                    AND a.SECTION_ID = $section_id
                                    AND a.SESSION_ID = $session_id
                                    AND a.COURSE_ID = $course_id
                                    AND a.DAY='$day'            
                                    ")->row();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
     return $query;
    }
    public function getAllClassSchedule(){
     $query= $this->db->query("SELECT a.*,
                                     b.COURSE_TITLE,
                                     c.FULL_ENAME,
                                     d.BATCH_TITLE,
                                     e.NAME AS SECTION_NAME,
                                     f.PROGRAM_SHORT_NAME
                              FROM class_schedule a,
                                   aca_course b,
                                   hr_emp c,
                                   aca_batch d,
                                   aca_section e,
                                   ins_program f
                              WHERE     a.COURSE_ID = b.COURSE_ID
                                    AND a.TEACHER_ID = c.EMP_ID
                                    AND a.BATCH_ID = d.BATCH_ID
                                    AND a.SECTION_ID = e.SECTION_ID
                                    AND a.PROGRAM_ID = f.PROGRAM_ID")->result();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
     return $query;
    }

     ############## DATA TABLR ################
      function allposts_count()
    {   
        $query = $this
                ->db
                ->get('aca_course');
    
        return $query->num_rows();  

    }
    
    function allCourse($limit,$start,$col,$dir)
    {   
       /*$query = $this
                ->db
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('aca_course');*/
        $query=$this->db->query("SELECT a.*,b.DEPT_NAME FROM aca_course a
                                    left join ins_dept b on a.DEPT_ID=b.DEPT_ID ORDER BY a.$col $dir LIMIT $start,$limit")->result();

        
        if(!empty($query))
        {
            return $query; 
        }
        else
        {
            return null;
        }
        
    }
   
    function posts_search($limit,$start,$search,$col,$dir)
    {
        $query=$this->db->query("SELECT a.*,b.DEPT_NAME FROM aca_course a
                                    left join ins_dept b on a.DEPT_ID=b.DEPT_ID 
                                    where 
                                        a.COURSE_TITLE like '%$search%' or 
                                         b.DEPT_NAME like '%$search%'
                                    ORDER BY a.$col $dir LIMIT $start,$limit");
        
       
        if(!empty($query))
        {
            return [$query->result(),$query->num_rows()];  
        }
        else
        {
            return null;
        }
    }
    ################# END DATA TABLE #########################
}