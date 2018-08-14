<?php

class Student_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    public  function getStudentInfoAll($student_id)
    {
        $row = $this->db->query("SELECT a.*,
                                       b.FACULTY_NAME,
                                       c.DEPT_NAME,
                                       d.PROGRAM_NAME,
                                       d.PROGRAM_SHORT_NAME,
                                       e.LKP_NAME AS LKP_MARITAL_STATUS,
                                       f.NATIONALITY AS LKP_NATIONALITY,
                                       g.LKP_NAME AS LKP_RELIGION,
                                       h.LKP_NAME AS LKP_BLOOD_GROUP,
                                       i.BATCH_TITLE,
                                       concat(k.SESSION_NAME, ' - ', j.DINYEAR) AS adm_session_name,
                                       concat(m.SESSION_NAME, ' - ', l.DINYEAR) AS current_session_name,
                                       n.NAME as section_name
                                  FROM student_personal_info a
                                       LEFT JOIN ins_faculty b ON a.FACULTY_ID = b.FACULTY_ID
                                       LEFT JOIN ins_dept c ON a.DEPT_ID = c.DEPT_ID
                                       LEFT JOIN ins_program d ON a.PROGRAM_ID = d.PROGRAM_ID
                                       LEFT JOIN m00_lkpdata e ON a.MARITAL_STATUS = e.LKP_ID
                                       LEFT JOIN country f ON a.NATIONALITY = f.id
                                       LEFT JOIN m00_lkpdata g ON a.RELIGION_ID = g.LKP_ID
                                       LEFT JOIN m00_lkpdata h ON a.BLOOD_GROUP = h.LKP_ID
                                       LEFT JOIN aca_batch i ON a.BATCH_ID = i.BATCH_ID
                                       LEFT JOIN adm_ysession j ON a.ADM_SESSION_ID = j.YSESSION_ID
                                       LEFT JOIN ins_session k ON j.SESSION_ID = k.SESSION_ID
                                       LEFT JOIN ins_ysession l ON a.SESSION_ID = l.YSESSION_ID
                                       LEFT JOIN ins_session m ON m.SESSION_ID = l.SESSION_ID
                                       LEFT JOIN aca_section n ON a.SECTION_ID = n.SECTION_ID
                                      WHERE STUDENT_ID = $student_id")->row();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $row;
    }

    public function getStudentWaiverInfo($student_id, $stu_waiver_id='')
    {
        $row = $this->db->query("select a.*, b.WAIVER_NAME, concat(d.SESSION_NAME,' - ', c.DINYEAR) as SESSION_NAME from student_waiver_info a
                                        INNER JOIN waiver_view b ON a.WAIVER_TYPE = b.WAIVER_ID
                                        INNER JOIN ins_ysession c ON a.SESSION_ID = c.YSESSION_ID
                                        INNER JOIN ins_session d ON c.SESSION_ID=d.SESSION_ID
                                        WHERE a.STUDENT_ID='$student_id' AND a.STU_WAIVER_ID='$stu_waiver_id'")->row();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $row;
    }

    public function getStudentAllWaiverInfo($student_id)
    {
        $row = $this->db->query("select a.*, b.WAIVER_NAME, concat(d.SESSION_NAME,' - ', c.DINYEAR) as SESSION_NAME from student_waiver_info a
                                        INNER JOIN waiver_view b ON a.WAIVER_TYPE = b.WAIVER_ID
                                        INNER JOIN ins_ysession c ON a.SESSION_ID = c.YSESSION_ID
                                        INNER JOIN ins_session d ON c.SESSION_ID=d.SESSION_ID
                                        WHERE a.STUDENT_ID='$student_id'")->result();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $row;
    }

    public  function  getStudentFatherInfo($student_id)
    {
        $row = $this->db->query("select a.*, b.LKP_NAME as FATHER_OCCU from student_gurdianinfo a
                                        LEFT  JOIN m00_lkpdata b ON a.OCCUPATION=b.LKP_ID
                                        WHERE a.STUDENT_ID='$student_id' AND a.GUARDIAN_TYPE='F' ")->row();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $row;
    }

    public  function  getStudentMotherInfo($student_id)
    {
        $row = $this->db->query("select a.*, b.LKP_NAME as MOTHER_OCCU from student_gurdianinfo a
                                        LEFT  JOIN m00_lkpdata b ON a.OCCUPATION=b.LKP_ID
                                        WHERE a.STUDENT_ID='$student_id' AND a.GUARDIAN_TYPE='M' ")->row();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $row;
    }

    public function getStudentLocalGuardianInfo($student_id)
    {
        $row = $this->db->query("select a.*, b.LKP_NAME as RELATION_WITH_LOCAL_GUARDIAN from student_gurdianinfo a
                                LEFT JOIN m00_lkpdata b ON a.GUARDIAN_RELATION=b.LKP_ID
                                WHERE a.STUDENT_ID='$student_id' AND a.LOCAL_GUARDIAN_FG='1' ")->row();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $row;
    }

    public function getStudentLocalOtherGuardianInfo($student_id)
    {
        $row = $this->db->query("select a.*, b.LKP_NAME as RELATION_WITH_LOCAL_GUARDIAN from student_gurdianinfo a
                                LEFT JOIN m00_lkpdata b ON a.GUARDIAN_RELATION=b.LKP_ID
                                WHERE a.STUDENT_ID='$student_id'  AND a.LOCAL_GUARDIAN_FG=1
                                AND a.GUARDIAN_TYPE='O' ")->row();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $row;
    }

    public function getStudentAcademicInfo($student_id)
    {
        $row = $this->db->query("SELECT a.*,b.LKP_NAME as ed,c.LKP_NAME as mg,d.LKP_NAME as br FROM student_acadimicinfo a
                                                    left join m00_lkpdata b on a.EXAM_DEGREE_ID=b.LKP_ID
                                                    left join m00_lkpdata c on a.MAJOR_GROUP_ID=c.LKP_ID
                                                    left join m00_lkpdata d on a.BOARD = d.LKP_ID
                                                    WHERE a.STUDENT_ID ='$student_id'")->result();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $row;
    }

    public  function getLocalPresentAddress($student_id)
    {
        $row = $this->db->query("SELECT a.*,
                                                           (SELECT b.DIVISION_ENAME FROM sa_divisions b WHERE b.DIVISION_ID = a.DIVISION_ID)DIVIS_NAME,
                                                           (SELECT d.DISTRICT_ENAME FROM sa_districts d WHERE d.DISTRICT_ID = a.DISTRICT_ID)DIST_NAME,
                                                           (SELECT p.PS_ENAME FROM sa_police_station p WHERE p.POLICE_STATION_ID = a.POLICE_STATION_ID)PLOSC,
                                                           (SELECT po.POST_OFFICE_ENAME FROM sa_post_offices po WHERE po.POST_OFFICE_ID = a.POST_OFFICE_ID)POSTO,
                                                           (SELECT t.THANA_ENAME FROM sa_thanas t WHERE t.THANA_ID = a.THANA_ID)thn,
                                                           (SELECT u.UNION_NAME FROM sa_unions u WHERE u.UNION_ID = a.UNION_ID)uni FROM student_adressinfo a WHERE a.STUDENT_ID = '$student_id' AND a.ADRESS_TYPE = 'PS'")->row();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $row;
    }

    public function getLocalPermanentAddress($student_id)
    {
        $row = $this->db->query("SELECT a.*,
                                                           (SELECT b.DIVISION_ENAME FROM sa_divisions b WHERE b.DIVISION_ID = a.DIVISION_ID)DIVIS_NAME,
                                                           (SELECT d.DISTRICT_ENAME FROM sa_districts d WHERE d.DISTRICT_ID = a.DISTRICT_ID)DIST_NAME,
                                                           (SELECT p.PS_ENAME FROM sa_police_station p WHERE p.POLICE_STATION_ID = a.POLICE_STATION_ID)PLOSC,
                                                           (SELECT po.POST_OFFICE_ENAME FROM sa_post_offices po WHERE po.POST_OFFICE_ID = a.POST_OFFICE_ID)POSTO,
                                                           (SELECT t.THANA_ENAME FROM sa_thanas t WHERE t.THANA_ID = a.THANA_ID)thn,
                                                           (SELECT u.UNION_NAME FROM sa_unions u WHERE u.UNION_ID = a.UNION_ID)uni FROM student_adressinfo a WHERE a.STUDENT_ID = '$student_id' AND a.ADRESS_TYPE = 'PR'")->row();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $row;
    }

    public function getStudentWiseEnrolledCourse($student_id, $session_id)
    {
        $row = $this->db->query("SELECT b.COURSE_ID,
                                   b.COURSE_CODE,
                                   b.COURSE_TITLE,
                                   b.CREDIT
                                  FROM student_courseinfo a, aca_course b
                                  WHERE a.COURSE_ID = b.COURSE_ID AND a.STUDENT_ID = $student_id AND a.SESSION_ID = $session_id")->result();
                                    //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $row;
    }

    public function getAllSessionByStudentId($student_id)
    {
        $row = $this->db->query("SELECT b.YSESSION_ID, concat(c.SESSION_NAME, ' - ', b.DINYEAR) AS SESSION_NAME FROM student_semesterinfo a 
                                              LEFT JOIN ins_ysession b ON a.SESSION_ID=b.YSESSION_ID
                                              LEFT JOIN ins_session c ON b.SESSION_ID = c.SESSION_ID
                                               WHERE a.STUDENT_ID = $student_id")->result();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $row;
    }
    public function getStudentWiseSemesterPayment($student_id,$session_id)
    {
        $query = $this->db->query("SELECT b.BILLING_CHD_ID,
                                       b.BILLING_MST_ID,
                                       b.AC_NO,
                                       b.RATE_ID,
                                       b.RATE_AMT,
                                       b.TOTAL_BILL,
                                       b.DISC_AMT,
                                       b.VAT_AMT,
                                       b.BILL_AMT,
                                       b.BILLING_MONTH,
                                       b.REMARKS,
                                       c.AC_NAME,
                                       SUM(d.PAID_AMT) AS PAID_AMT,
                                       (b.BILL_AMT - ABS(SUM(d.PAID_AMT))) AS DUE_AMT     
                                 FROM fn_billing_mst a
                                 LEFT JOIN fn_billing_chd b ON a.BILLING_MST_ID = b.BILLING_MST_ID
                                 LEFT JOIN fn_achead c on b.AC_NO = c.AC_NO
                                 LEFT JOIN fn_voucherchd d ON d.BILLING_CHD_ID = b.BILLING_CHD_ID
                                 WHERE a.STUDENT_ID = $student_id AND a.SESSION_ID = $session_id GROUP BY b.BILLING_CHD_ID")->result();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $query;
    }
    public function getFresherStudentWiseTempBill($student_id,$session_id)
    {
        $query = $this->db->query("SELECT b.BILLING_CHD_TEMP_ID, b.BILLING_MST_TEMP_ID, b.AC_NO, b.RATE_ID, b.RATE_AMT, b.TOTAL_BILL, b.DISC_AMT, b.VAT_AMT, b.BILL_AMT, b.BILLING_MONTH, b.REMARKS, c.AC_NAME FROM fn_billing_mst_temp a LEFT JOIN fn_billing_chd_temp b ON a.BILLING_MST_TEMP_ID = b.BILLING_MST_TEMP_ID LEFT JOIN fn_achead c on b.AC_NO = c.AC_NO 
                                 WHERE a.STUDENT_ID = $student_id AND a.SESSION_ID = $session_id")->result();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $query;
    }

    public function getAllCourseByStudentIdAndSessionWise($student_id, $session_id)
    {
       return $query = $this->db->query("SELECT b.COURSE_TITLE,
                                                 b.COURSE_CODE,
                                                 b.CREDIT,
                                                 a.MARKS,
                                                 a.GRADE_LETTER,
                                                 a.GRADE_POINT
                                          FROM exam_tabulation_sheet a, aca_course b
                                          WHERE a.STUDENT_ID = $student_id AND a.SESSION_ID = $session_id AND a.COURSE_ID = b.COURSE_ID")->result();
         
    }
    public function getChargeRate($program_id, $session_id)
    {
       return $query = $this->db->query("SELECT a.*,
                                             IFNULL(
                                                (SELECT b.AMOUNT
                                                 FROM ac_academic_charge_rate b
                                                 WHERE     b.CHARGE_ID = a.CHARGE_ID
                                                       AND b.PROGRAM_ID = $program_id
                                                       AND b.SESSION_ID = $session_id),
                                                0)  AS AMOUNT
                                      FROM ac_academic_charge a")->result();
         
    }

    function academicSessionListForWithoutWaiver(){

        return  $this->db->query("select w.* FROM student_waiver_info w 
                                  RIGHT JOIN ins_ysession y ON w.SESSION_ID=y.SESSION_ID WHERE w.STUDENT_ID=1 AND
                                  a.*,concat(b.SESSION_NAME,' - ', a.DINYEAR) as SESSION_NAME from ins_ysession a 
                                  left join ins_session b on a.SESSION_ID = b.SESSION_ID ORDER BY a.UD_SLNO ASC")->result();
    }
    function getStudentTotalCredit($session_id,$program_id,$student_id){
              return  $this->db->query("SELECT sum(b.CREDIT) AS total_credit
                                        FROM student_courseinfo a, aca_course b
                                        WHERE a.COURSE_ID = b.COURSE_ID
                                         AND a.SESSION_ID = $session_id
                                         AND a.PROGRAM_ID = $program_id
                                         AND a.STUDENT_ID = $student_id")->row();
    }
    function getRegCorseListBySession($student_id,$session_id){
              return  $this->db->query("SELECT b.COURSE_CODE, b.COURSE_TITLE, b.CREDIT
                                          FROM student_courseinfo a, aca_course b
                                         WHERE     a.COURSE_ID = b.COURSE_ID
                                               AND a.SESSION_ID = $session_id
                                                
                                               AND a.STUDENT_ID = $student_id")->result();
    }

  public function waiverListOfStudent ($program_id, $session_id)
 {
     return $this->db->query("SELECT stu.*, sem.PROGRAM_ID,sem.SESSION_ID  FROM student_personal_info stu
                              LEFT JOIN student_semesterinfo sem ON sem.STUDENT_ID = stu.STUDENT_ID
                              WHERE stu.PROGRAM_ID =$program_id AND sem.SESSION_ID = $session_id AND sem.IS_CURRENT =1")->result();
 }

 public function getStudentWise1stSemesterPayment($session_id, $program_id)
 {
    return $this->db->query("SELECT * FROM aca_semester_course sem_course 
                              LEFT JOIN aca_course aca_crs ON sem_course.COURSE_ID = aca_crs.COURSE_ID
                              WHERE sem_course.SESSION_ID = $session_id AND sem_course.PROGRAM_ID = $program_id AND sem_course.SEMESTER_ID = 1 AND sem_course.ACTIVE_STATUS = 1")->result();
 }

 public function getFreshStudentWiseSemesterPayment($session_id, $program_id)
 {
     return $this->db->join('fn_achead ac_head', 'ac_head.AC_NO = ch_rate.AC_No', 'left')
                        ->get_where('fn_academic_charge_rate ch_rate', array('SESSION_ID' => $session_id, 'PROGRAM_ID' => $program_id, 'ch_rate.ACTIVE_STATUS' => 1))->result();
 }


 public function checkLibraryMember ($student_id){

     return  $this->db->query("select ACTIVE_STATUS from lib_members where MEBBER_ID=".$student_id)->result();
 }


 public function studentItemBorrowHistory($student_id){
  //var_dump($student_id); die();

  return $this->db->query("select * from lib_members libm  left join lib_borrowers libb on libb.MEMBER_ID =libm.MEMBER_NO left join lib_item libi on libi.ITEM_ID = libb.ITEM_ID where libm.MEBBER_ID = $student_id ")->result();
 }


}