<?php

Class Finance_model extends CI_Model {
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function getRateList(){
    $query=$this->db->query("SELECT accr.*,
      acc.AC_NAME,
      insprogram.PROGRAM_NAME,
      concat(ins_s.SESSION_NAME, ' - ', ins_y.DINYEAR) AS SESSION_NAME
      FROM  fn_academic_charge_rate accr
      LEFT JOIN fn_achead acc ON accr.AC_NO = acc.AC_NO
      LEFT JOIN ins_program insprogram ON accr.PROGRAM_ID = insprogram.PROGRAM_ID
      LEFT JOIN ins_ysession ins_y ON accr.SESSION_ID = ins_y.YSESSION_ID
      LEFT JOIN ins_session ins_s ON ins_s.SESSION_ID = ins_y.SESSION_ID ORDER BY accr.RATE_ID ASC")->result();
                                  //echo "<pre>"; print_r($row); exit; echo "</pre>";
    return $query;
  }
  public function getRateById($id){
    $query=$this->db->query("SELECT accr.*,
      acc.AC_NAME,
      insprogram.PROGRAM_NAME,
      ins_session.SESSION_NAME
      FROM  fn_academic_charge_rate accr
      LEFT JOIN fn_achead acc ON accr.AC_NO = acc.AC_NO
      LEFT JOIN ins_program insprogram ON accr.PROGRAM_ID = insprogram.PROGRAM_ID
      LEFT JOIN ins_ysession ins_ysession ON accr.SESSION_ID = ins_ysession.SESSION_ID
      LEFT JOIN ins_session ins_session ON ins_ysession.SESSION_ID = ins_session.SESSION_ID where accr.RATE_ID=$id")->row();
    return $query;
  }

  public function examSessionRatedList($program_id){
   $query= $this->db->query("SELECT a.*, concat(b.SESSION_NAME, ' - ', a.DINYEAR) AS SESSION_NAME
    FROM ins_ysession a LEFT JOIN ins_session b ON a.SESSION_ID = b.SESSION_ID
    WHERE a.YSESSION_ID IN (SELECT c.SESSION_ID
    FROM fn_academic_charge_rate c
    WHERE c.PROGRAM_ID = $program_id)
    ORDER BY a.UD_SLNO ASC")->result();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
   return $query;
 }

  public function getRegistredStudent(){
   $query= $this->db->query("SELECT b.STUDENT_ID,b.SESSION_ID, b.REGISTRATION_NO, b.FULL_NAME_EN,c.PROGRAM_ID, c.PROGRAM_NAME
                              FROM student_semesterinfo a, student_personal_info b, ins_program c
                              WHERE a.STUDENT_ID = b.STUDENT_ID AND b.PROGRAM_ID = c.PROGRAM_ID
                              GROUP BY b.STUDENT_ID")->result();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
   return $query;
 }

    /**
     * @access none
     * @author Nurullah nurul@atilimited.net
     * @param  none
     * @return 
     */

 public function getAdmittedStudentList($faculty,$department,$program, $semester, $session){
  $condition = '';
  if ($faculty != '') {
    $condition .= ' AND si.FACULTY_ID ='. $faculty;
  }
  if ($department != '') {
    $condition .= ' AND si.DEPT_ID ='. $department;
  }
  if ($program = '') {
    $condition .= ' AND si.PROGRAM_ID ='. $program;
  }
//  if ($semester = '') {
//    $condition .= ' AND si.PROGRAM_ID ='. $semester;
//  }
  if ($session = '') {
    $condition .= ' AND si.SESSION_ID ='. $session;
  }
  $query = $this->db->query("SELECT si.STUDENT_ID, si.REGISTRATION_NO, si.PROGRAM_ID, si.FULL_NAME_EN, si.PHOTO, si.SESSION_ID, 
                                                (SELECT p.PROGRAM_NAME FROM ins_program p WHERE p.PROGRAM_ID = si.PROGRAM_ID)PROGRAM_NAME,
                                                (SELECT d.DEPT_NAME FROM ins_dept d WHERE d.DEPT_ID = si.DEPT_ID)DEPT_NAME,
                                                (SELECT f.FACULTY_NAME FROM ins_faculty f WHERE f.FACULTY_ID = si.FACULTY_ID)FACULTY_NAME
                                                FROM student_personal_info si WHERE ACTIVE_STATUS = 1 $condition ORDER BY si.STUDENT_ID DESC")->result();
//   $query= $this->db->query("SELECT b.STUDENT_ID,
//                                     b.REGISTRATION_NO,
//                                     b.FULL_NAME_EN,
//                                     b.FATHER_NAME,
//                                     a.PROGRAM_ID,
//                                     (SELECT c.PROGRAM_NAME
//                                        FROM ins_program c
//                                       WHERE c.PROGRAM_ID = a.PROGRAM_ID)
//                                        PROGRAM_NAME
//                                FROM student_semesterinfo a
//                                     LEFT JOIN student_personal_info b ON a.STUDENT_ID = b.STUDENT_ID
//                               WHERE  a.SESSION_ID = 6
//                                     AND a.SEMESTER_SL_NO = 1
//                                     AND a.IS_CURRENT = 1 $condition")->result();
   return $query;
 }

    /**
     * @access none
     * @author Nurullah nurul@atilimited.net
     * @param  none
     * @return 
     */

 public function getAdmittedStudentFeeInfo($program_id, $cur_session){

   $query= $this->db->query("SELECT (SELECT b.CHARGE_NAME
                              FROM ac_academic_charge b
                             WHERE a.CHARGE_ID = b.CHARGE_ID)
                              CHARGE_NAME,
                           a.AMOUNT
                      FROM ac_academic_charge_rate a
                     WHERE a.SESSION_ID = $cur_session AND a.PROGRAM_ID = $program_id")->result();
   return $query;
 }

 public function getStudentInfoByStudentID($student_id){
  $query = $this->db->query("SELECT a.FULL_NAME_EN,
       a.REGISTRATION_NO,
       (SELECT b.PROGRAM_NAME
          FROM ins_program b
         WHERE a.PROGRAM_ID = b.PROGRAM_ID)
          PROGRAM_NAME
  FROM student_personal_info a 
  WHERE a.STUDENT_ID = $student_id")->row();
  return $query;
 }

 public function acaBullingListOfStudent ($session_id, $program_id, $billType)
 {
     return $this->db->query("SELECT * FROM student_semesterinfo sem
                              LEFT JOIN student_personal_info stu_info ON stu_info.STUDENT_ID = sem.STUDENT_ID
                              WHERE sem.SESSION_ID = $session_id AND sem.PROGRAM_ID = $program_id
                              AND stu_info.STUDENT_ID NOT IN (SELECT billMst.STUDENT_ID FROM fn_billing_mst billMst WHERE billMst.BILL_TYPE = '$billType')")->result();
 }


 public function fresherBillingListOfStudent ($session_id, $program_id, $billType)

{
    return $this->db->query("SELECT * FROM student_semesterinfo sem
                          LEFT JOIN student_personal_info stu_info ON stu_info.STUDENT_ID = sem.STUDENT_ID
                          WHERE sem.SESSION_ID = $session_id AND sem.PROGRAM_ID = $program_id AND sem.SEMESTER_SL_NO = 1 AND sem.IS_CURRENT = 1
                          AND stu_info.STUDENT_ID NOT IN (SELECT billMst.STUDENT_ID FROM fn_billing_mst billMst WHERE billMst.SESSION_ID = $session_id)
                          ")->result();
}


 public function resiBullingListOfStudent ($session_id, $building_id, $billing_month, $billType)
 {
     $period = explode('-', $billing_month);

     return $this->db->query("SELECT * FROM resident_seat_allocation res_s_allocation
                              LEFT JOIN resident_seat_mapping res_s_mapping ON res_s_allocation.SEAT_MAPPING_ID = res_s_mapping.SEAT_MAPPING_ID
                              LEFT JOIN student_personal_info stu_info ON res_s_allocation.APPLICANT_ID = stu_info.STUDENT_ID
                              WHERE res_s_mapping.BUILDING_ID = $building_id
                              AND stu_info.STUDENT_ID 
                              NOT IN (SELECT billMst.STUDENT_ID FROM fn_billing_mst billMst
                                      LEFT JOIN fn_billing_chd billChild ON billChild.BILLING_MST_ID = billMst.BILLING_MST_ID 
                                      WHERE billMst.BILL_TYPE = '$billType' AND YEAR(billChild.BILLING_MONTH) = $period[1] AND MONTH(billChild.BILLING_MONTH) =  $period[0])")->result();
 }



 public function residentBillInformation(){

  return $this->db->query("select a.*,b.SESSION_ID,b.RESEDENT_ID,b.BILLING_MONTH,c.AC_NAME from fn_resident_bill_chd a 
left join fn_resident_bill_mst  b on a.RESIDENT_BILL_MST_ID = b.RESIDENT_BILL_MST_ID
left join fn_achead c on a.AC_NO = c.AC_NO")->result();

 }




    ################# END DATA TABLE #########################
}