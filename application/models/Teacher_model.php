<?php

class Teacher_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function getStudentListByThisAttribute($program_id, $session_id, $batch_id, $section_id)
    {
        return $this->db->query("SELECT a.*
                                  FROM student_personal_info a
                                  WHERE     a.PROGRAM_ID = $program_id
                                  AND a.SESSION_ID = $session_id
                                  AND a.BATCH_ID = $batch_id
                                  AND a.SECTION_ID = $section_id
                                  AND a.STUDENT_ID NOT IN (SELECT b.STUDENT_ID
                                  FROM student_semesterinfo b WHERE b.SESSION_ID =$session_id and b.PROGRAM_ID=$program_id)")->result();
    }

    public function studentCourseListByThisAttribute($stu_roll_no, $session, $dept_id)
    {
        return $this->db->join('student_courseinfo b', 'a.STUDENT_ID = b.STUDENT_ID', 'left')
                                ->join('aca_course c', 'b.COURSE_ID = c.COURSE_ID', 'left')
                                ->get_where('student_personal_info a', array('a.REGISTRATION_NO' => $stu_roll_no, 'b.SESSION_ID' => $session, 'a.DEPT_ID' => $dept_id ))->result();
    }

    public function studentListByThisAttribute($student_id)
    {
        return $this->db->query("SELECT * FROM student_personal_info a 
                                          LEFT JOIN ins_faculty b ON a.FACULTY_ID = b.FACULTY_ID
                                          LEFT  JOIN  ins_dept c ON a.DEPT_ID = c.DEPT_ID
                                          WHERE a.STUDENT_ID = '$student_id'")->row();
    }

    public function getStudentCourseListByThisAttribute($stu_id, $session)
    {
        return $this->db->join('student_courseinfo b', 'a.STUDENT_ID = b.STUDENT_ID', 'left')
                        ->join('aca_course c', 'b.COURSE_ID = c.COURSE_ID', 'left')
                        ->get_where('student_personal_info a', array('a.STUDENT_ID' => $stu_id, 'b.SESSION_ID' => $session ))->result();
    }
    function getResidentApplication(){
      return $this->db->query("SELECT a.*, b.*
                                FROM resident_application a, student_personal_info b
                                WHERE     a.APPLICANT_ID = b.STUDENT_ID
                                      AND a.APPLICATION_TYPE = 'A'
                                      AND a.APPLICANT_TYPE = 'S'")->result();
    }
    function getResidentApplicationListForProvost(){
      return $this->db->query("SELECT a.*, b.*
                                FROM resident_application a, student_personal_info b
                                WHERE     a.APPLICANT_ID = b.STUDENT_ID
                                      AND a.APPLICATION_TYPE = 'A'
                                      AND a.APPLICANT_TYPE = 'S' 
                                      AND a.APPROVE_BY_DEPT_HEAD_STATUS =1 ")->result();
    }

    function getAllLeaveTypeInfo($mId){
      return $this->db->query(" SELECT mst.*, chd.LEAVE_CHD_ID,chd.LEAVE_ID,chd.LEAVE_TYPE_ID,chd.NO_OF_DAYS,type.TYPE_NAME
                             FROM hr_leave mst
                            LEFT JOIN hr_leave_chd chd ON mst.LEAVE_ID = chd.LEAVE_ID
                            LEFT JOIN hr_leave_type type ON chd.LEAVE_TYPE_ID = type.LEAVE_TYPE_ID
                            WHERE mst.LEAVE_ID=$mId ORDER BY chd.LEAVE_CHD_ID")->result();
    }

    public function getAllLeaveInfoById($id)

    {
       return $this->db->query("SELECT *  FROM hr_leave 
                        WHERE LEAVE_ID  = $id")->row();
                       
    }
    public function getEmpWiseLeave($emp_id,$leave_type_id)

    {
       $sql="SELECT   sum(b.NO_OF_DAYS) AS total_leave
              FROM hr_leave_approved_mst a LEFT JOIN hr_leave_approved_chd b on a.LEAVE_APPROVE_MST_ID = b.LEAVE_APPROVE_MST_ID where a.EMP_ID=? and b.LEAVE_TYPE_ID=?";
      return $this->db->query($sql, array($emp_id,$leave_type_id))->row();
                       
    }


  


      function getAllLeaveTypeInfoDetails($emp_id){
      return $this->db->query("SELECT b.*,a.*,c.*
              FROM hr_leave_approved_mst a LEFT JOIN hr_leave_approved_chd b on a.LEAVE_APPROVE_MST_ID = b.LEAVE_APPROVE_MST_ID
              LEFT JOIN hr_leave_type c on b. LEAVE_TYPE_ID = c.LEAVE_TYPE_ID where a.EMP_ID=$emp_id group by b.LEAVE_TYPE_ID ")->result();
    }

     public function getEmpWiseLeaveReport($emp_id)

    {
       $sql="SELECT   sum(b.NO_OF_DAYS) AS total_leave
              FROM hr_leave_approved_mst a LEFT JOIN hr_leave_approved_chd b on a.LEAVE_APPROVE_MST_ID = b.LEAVE_APPROVE_MST_ID where a.EMP_ID=? ";
      return $this->db->query($sql, array($emp_id))->row();
                       
    }

    }