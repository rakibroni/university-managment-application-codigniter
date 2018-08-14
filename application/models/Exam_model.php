<?php

Class Exam_model extends CI_Model {

    public function getAllExamSetup()
    {
        return $this->db->select('a.*')
                        ->select('a.ACTIVE_STATUS as GRADE_ACTIVE_STATUS')
                        ->select('b.*')
                        ->join('exam_grade_policy b', 'a.GR_POLICY_ID = b.GR_POLICY_ID', 'left')
                        ->get_where('exam_grade a')
                        ->result();
    }

    public function getAllExamSetupById($gr_id)
    {
        return $this->db->select('a.*')
                        ->select('a.ACTIVE_STATUS as GRADE_ACTIVE_STATUS')
                        ->select('b.*')
                        ->join('exam_grade_policy b', 'a.GR_POLICY_ID = b.GR_POLICY_ID', 'left')
                        ->get_where('exam_grade a', array('a.GR_ID' => $gr_id))
                        ->row();
    }

    public function getExamPolicies()
    {
        return $this->db->get_where('exam_grade_policy a', array('a.ACTIVE_STATUS' => 1))->result();
    }

    public function getAllExamApplication()
    {
        return $this->db->select('a.*')
                        ->select('a.ACTIVE_STATUS as EX_APP_ACTIVE_STATUS')
                        ->select('b.*')
                        ->select("CONCAT(d.SESSION_NAME, ' - ', c.DINYEAR) AS ins_session")
                        ->join('exam_marks_type b', 'a.EXAM_ID = b.EXAM_MARKS_TYPE_ID', 'left')
                        ->join('ins_ysession c', 'a.SESSION_ID = c.YSESSION_ID', 'left')
                        ->join('ins_session d', 'c.SESSION_ID = d.SESSION_ID', 'left')
                        ->get_where('exam_application a')->result();

    }

    public function getAllExamApplicationById($ex_app_id)
    {
        return $this->db->select('a.*')
                        ->select('a.ACTIVE_STATUS as EX_APP_ACTIVE_STATUS')
                        ->select('b.*')
                        ->select("CONCAT(d.SESSION_NAME, ' - ', c.DINYEAR) AS ins_session")
                        ->join('exam_marks_type b', 'a.EXAM_ID = b.EXAM_MARKS_TYPE_ID', 'left')
                        ->join('ins_ysession c', 'a.SESSION_ID = c.YSESSION_ID', 'left')
                        ->join('ins_session d', 'c.SESSION_ID = d.SESSION_ID', 'left')
                        ->get_where('exam_application a', array('a.EX_APP_ID' => $ex_app_id))->row();
    }

    public function getAllExamGradeSheet()
    {
        return $this->db->select('a.*')
                        ->select('a.ACTIVE_STATUS as GRADE_SHEET_ACTIVE_STATUS')
                        ->select('b.*')
                        ->select('c.*')
                        ->select('d.EXAM_TITLE')
                        ->select('e.DEGREE_NAME')
                        ->join('exam_marks_type c', 'a.EXAM_MARKS_TYPE_ID = c.EXAM_MARKS_TYPE_ID', 'left')
                        ->join('exam_type d', 'a.EXAM_TYPE_ID = d.EXAM_TYPE_ID', 'left')
                        ->join('ins_dept b', 'a.DEPT_ID = b.DEPT_ID', 'left')
                        ->join('ins_degree e', 'a.DEGREE_ID = e.DEGREE_ID', 'left')
                        ->get_where('exam_grade_sheet a')
                        ->result();
    }

    public function getAllExamGradeSheetById($grd_sheet_id)
    {
        return $this->db->select('a.*')
                        ->select('a.ACTIVE_STATUS as GRADE_SHEET_ACTIVE_STATUS')
                        ->select('b.*')
                        ->select('c.*')
                        ->select('d.EXAM_TITLE')
                        ->select('e.DEGREE_NAME')
                        ->join('exam_marks_type c', 'a.EXAM_MARKS_TYPE_ID = c.EXAM_MARKS_TYPE_ID', 'left')
                        ->join('exam_type d', 'a.EXAM_TYPE_ID = d.EXAM_TYPE_ID', 'left')
                        ->join('ins_dept b', 'a.DEPT_ID = b.DEPT_ID', 'left')
                        ->join('ins_degree e', 'a.DEGREE_ID = e.DEGREE_ID', 'left')
                        ->get_where('exam_grade_sheet a', array('a.EXAM_GRADE_SHEET_ID' => $grd_sheet_id))
                        ->row();
    }

    public function getAllCourseEnrolledStudent($program_id, $session_id, $batch_id, $section_id, $course_id)
    {
        return $this->db->query("SELECT a.*, b.*
                                    FROM student_personal_info a
                                    LEFT JOIN student_courseinfo b ON a.STUDENT_ID = b.STUDENT_ID
                                   
                                    WHERE     a.PROGRAM_ID = $program_id
                                    AND a.SESSION_ID = $session_id
                                    AND a.BATCH_ID = $batch_id
                                    AND a.SECTION_ID = $section_id
                                    AND b.COURSE_ID = $course_id
                                    
                                    AND a.STUDENT_ID IN (SELECT b.STUDENT_ID
                                    FROM student_semesterinfo b ) 
                                    
                                    
                                    
                                    ")->result();
    }

    public function getAllMarksTypeByDept($dept_id)
    {
        return $this->db->join('exam_marks_type b', 'a.EXAM_MARKS_TYPE_ID = b.EXAM_MARKS_TYPE_ID', 'left')
                        ->get_where('exam_grade_sheet a', array('DEPT_ID' => $dept_id))->result();
    }

    public function getStudentExamMarks($program_id, $session_id, $batch_id, $section_id, $course_id, $mark_type_id)
    {
        return $this->db->join('aca_course b', 'a.COURSE_ID = b.COURSE_ID', 'left')
                        ->join('student_personal_info c', 'a.STUDENT_ID = c.STUDENT_ID', 'left')
                        ->get_where('exam_student_marks a', array('a.PROGRAM_ID' => $program_id, 'a.SESSION_ID' => $session_id, 'a.BATCH_ID' => $batch_id, 'a.SECTION_ID' => $section_id, 'a.COURSE_ID' => $course_id, 'a.MARKS_TYPE_ID' => $mark_type_id ))->result();
    }

    public function getExamGradeSheet($dept_id)
    {
        return $this->db->query("SELECT b.MARKS_TITLE,a.MARKS_PER,a.EXAM_MARKS_TYPE_ID
                                    FROM exam_grade_sheet a, exam_marks_type b
                                    WHERE a.EXAM_MARKS_TYPE_ID = b.EXAM_MARKS_TYPE_ID AND a.DEPT_ID = $dept_id order by a.SL_NO asc")->result();
    }

    public function getCourseStudent($PROGRAM_ID,$BATCH_ID,$SECTION_ID,$SESSION_ID,$COURSE_ID)
    {
        return $this->db->query("SELECT b.STUDENT_ID,b.REGISTRATION_NO, b.FULL_NAME_EN,a.*
                                    FROM exam_student_marks a, student_personal_info b
                                    WHERE     a.STUDENT_ID = b.STUDENT_ID
                                          AND a.PROGRAM_ID = $PROGRAM_ID
                                          AND a.BATCH_ID = $BATCH_ID
                                          AND a.SECTION_ID = $SECTION_ID
                                          AND a.SESSION_ID = $SESSION_ID
                                          AND a.COURSE_ID = $COURSE_ID group by a.STUDENT_ID")->result();
    }

    public function getCourseMarkByStudent($PROGRAM_ID,$BATCH_ID,$SECTION_ID,$SESSION_ID,$COURSE_ID,$STUDENT_ID,$MARKS_TYPE_ID)
    {
        return $this->db->query("SELECT b.STUDENT_ID,b.REGISTRATION_NO, b.FULL_NAME_EN,a.MARKS_TYPE_ID,a.*
                                    FROM exam_student_marks a, student_personal_info b
                                    WHERE     a.STUDENT_ID = b.STUDENT_ID
                                          AND a.PROGRAM_ID = $PROGRAM_ID
                                          AND a.BATCH_ID = $BATCH_ID
                                          AND a.SECTION_ID = $SECTION_ID
                                          AND a.SESSION_ID = $SESSION_ID
                                          AND a.COURSE_ID = $COURSE_ID
                                          and b.STUDENT_ID=$STUDENT_ID
                                          and  a.MARKS_TYPE_ID=$MARKS_TYPE_ID
                                          ")->row();
    }

    public function gradePointLetter($MARKS)
    {
        return $this->db->query("SELECT a.GRADE_POINT, a.GR_LETTER
                                    FROM exam_grade a
                                    WHERE $MARKS BETWEEN a.GR_MARKS_FROM AND a.GR_MARKS_TO")->row();
    }

    public function getTranscriptInfoByThisStudent($STUDENT_ID)
    {
        return $this->db->query("SELECT * FROM exam_tabulation_sheet a
                                      LEFT JOIN aca_course b ON a.COURSE_ID = b.COURSE_ID
                                      WHERE a.STUDENT_ID = $STUDENT_ID")->result();
    }

    public function countRowWithData($STUDENT_ID)
    {
        return $this->db->query("SELECT a.SESSION_ID, count(*) as NUM, concat(c.SESSION_NAME, ' - ', b.DINYEAR) AS aca_session FROM exam_tabulation_sheet a
                                                LEFT JOIN ins_ysession b ON a.SESSION_ID = b.YSESSION_ID
                                                LEFT JOIN ins_session c ON b.SESSION_ID = c.SESSION_ID
                                                WHERE a.STUDENT_ID = $STUDENT_ID GROUP BY a.SESSION_ID")->result();
    }
    public function getEligibilityStudent($program_id,$exam_app_id)
    {
        return $this->db->query("SELECT a.*
                                FROM student_personal_info a
                                WHERE     a.PROGRAM_ID = $program_id
                                      AND a.STUDENT_ID NOT IN (SELECT b.STUDENT_ID
                                                               FROM exam_eligible b
                                                               WHERE b.EX_APP_ID = $exam_app_id)")->result();
    }

    public function getRetakeImprovementStudentList($session_id)
    {
        return $this->db->select('a.*')
                        ->select('b.*')
                        ->select("CONCAT(f.SESSION_NAME,' ',e.DINYEAR) AS ADM_SESSION_NAME")
                        ->select('c.*')
                        ->select('d.*')
                        ->join('student_personal_info b', 'a.STUDENT_ID = b.STUDENT_ID', 'left')
                        ->join('ins_dept c', 'b.DEPT_ID = c.DEPT_ID', 'left')
                        ->join('aca_batch d', 'b.BATCH_ID = d.BATCH_ID', 'left')
                        ->join('adm_ysession e', 'b.ADM_SESSION_ID = e.YSESSION_ID', 'left')
                        ->join('ins_session f', 'e.SESSION_ID = f.SESSION_ID', 'left')->group_by("a.STUDENT_ID")
                        ->order_by('a.STUDENT_ID', 'ASC')
                        ->or_where_in('a.COURSE_FOR', array('R','I'))
                        ->get_where('exam_tabulation_sheet a', array('a.SESSION_ID' => $session_id, 'b.SESSION_ID' => $session_id))
                        ->result();
    }

}