<?php

Class Applicant_model extends CI_Model {

    public function getApplicantDataById($applicant_id)
    {
        $row = $this->db->query("select a.* from applicant_personal_info a  where a.APPLICANT_ID = '$applicant_id'")->row();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $row;
    }

    public function getApplicantInfo()
    {
        $user_data = $this->session->userdata('applicant_logged_in');
        $applicant = $user_data['APPLICANT_USER_ID'];

        $row = $this->db->query("select a.*, b.FACULTY_NAME, c.DEPT_NAME, d.PROGRAM_NAME from applicant_personal_info a
                                        LEFT JOIN ins_faculty b ON a.FACULTY_ID=b.FACULTY_ID
                                        LEFT JOIN ins_dept c ON a.DEPT_ID=c.DEPT_ID
                                        LEFT JOIN ins_program d ON a.PROGRAM_ID=d.PROGRAM_ID
                                        WHERE APPROVE_FOR_ADMIT=1 AND APPLICANT_USER_ID=$applicant")->row();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $row;
    }

    public  function getApplicantData($applicant_user_id)
    {
        $row = $this->db->query("select a.* from applicant_personal_info a  where a.APPLICANT_USER_ID = '$applicant_user_id'")->row();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $row;
    }

    public  function getAppicantInfoAll($applicant_id)
    {
        $row = $this->db->query("select a.*, b.FACULTY_NAME, c.DEPT_NAME, d.PROGRAM_NAME, e.LKP_NAME as LKP_MARITAL_STATUS,
                                        f.NATIONALITY as LKP_NATIONALITY, g.LKP_NAME as LKP_RELIGION, h.LKP_NAME as LKP_BLOOD_GROUP
                                        from applicant_personal_info a
                                        LEFT JOIN ins_faculty b ON a.FACULTY_ID=b.FACULTY_ID
                                        LEFT JOIN ins_dept c ON a.DEPT_ID=c.DEPT_ID
                                        LEFT JOIN ins_program d ON a.PROGRAM_ID=d.PROGRAM_ID
                                        LEFT JOIN m00_lkpdata e ON a.MARITAL_STATUS=e.LKP_ID
                                        LEFT JOIN country f ON a.NATIONALITY=f.id
                                        LEFT JOIN m00_lkpdata g ON a.RELIGION_ID=g.LKP_ID
                                        LEFT JOIN m00_lkpdata h ON a.BLOOD_GROUP=h.LKP_ID
                                        WHERE APPLICANT_ID=$applicant_id")->row();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $row;
    }

    public  function  getApplicantFatherInfo($applicant_id)
    {
        $row = $this->db->query("select a.*, b.LKP_NAME as FATHER_OCCU from applicant_gurdianinfo a
                                        LEFT  JOIN m00_lkpdata b ON a.OCCUPATION=b.LKP_ID
                                        WHERE a.APPLICANT_ID='$applicant_id' AND a.GUARDIAN_TYPE='F' ")->row();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $row;
    }

    public  function  getApplicantMotherInfo($applicant_id)
    {
        $row = $this->db->query("select a.*, b.LKP_NAME as MOTHER_OCCU from applicant_gurdianinfo a
                                        LEFT  JOIN m00_lkpdata b ON a.OCCUPATION=b.LKP_ID
                                        WHERE a.APPLICANT_ID='$applicant_id' AND a.GUARDIAN_TYPE='M' ")->row();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $row;
    }

    public function getApplicantLocalGuardianInfo($applicant_id)
    {
        $row = $this->db->query("select a.*, b.LKP_NAME as RELATION_WITH_LOCAL_GUARDIAN from applicant_gurdianinfo a
                                LEFT JOIN m00_lkpdata b ON a.GUARDIAN_RELATION=b.LKP_ID
                                WHERE a.APPLICANT_ID='$applicant_id' AND a.LOCAL_GUARDIAN_FG='1' ")->row();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $row;
    }

    public function getApplicantLocalOtherGuardianInfo($applicant_id)
    {
        $row = $this->db->query("select a.*, b.LKP_NAME as RELATION_WITH_LOCAL_GUARDIAN from applicant_gurdianinfo a
                                LEFT JOIN m00_lkpdata b ON a.GUARDIAN_RELATION=b.LKP_ID
                                WHERE a.APPLICANT_ID='$applicant_id'  AND a.LOCAL_GUARDIAN_FG=1
                                AND a.GUARDIAN_TYPE='O' ")->row();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $row;
    }

    public function getApplicantAcademicInfo($applicant_id)
    {
        $row = $this->db->query("SELECT a.*,b.LKP_NAME as ed,c.LKP_NAME as mg,d.LKP_NAME as br FROM applicant_acadimicinfo a
                                                    left join m00_lkpdata b on a.EXAM_DEGREE_ID=b.LKP_ID
                                                    left join m00_lkpdata c on a.MAJOR_GROUP_ID=c.LKP_ID
                                                    left join m00_lkpdata d on a.BOARD = d.LKP_ID
                                                    WHERE a.APPLICANT_ID ='$applicant_id'")->result();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $row;
    }
    public function getApplicantForAdmission($PROGRAM_ID,$ADM_SES)
    {
        $query = $this->db->query("select a.*, b.PROGRAM_NAME, c.DEPT_NAME, d.ADMPRG_TITLE from applicant_personal_info a
                                                    INNER JOIN ins_program b ON a.PROGRAM_ID=b.PROGRAM_ID
                                                    INNER JOIN ins_dept c ON a.DEPT_ID=c.DEPT_ID
                                                    INNER JOIN adm_prgdesc d ON a.ADM_SESSION_ID=d.YSESSION_ID
                                                    WHERE APPROVE_FOR_ADMIT=1 and a.PROGRAM_ID=$PROGRAM_ID and a.ADM_SESSION_ID=$ADM_SES  and a.ELIGIBLE_STU_FG=0 order by a.APPLICANT_ID desc")->result();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $query;
    }

    public  function getLocalPresentAddress($applicant_id)
    {
        $row = $this->db->query("SELECT a.APP_ADRESS_ID,a.APPLICANT_ID, a.ADRESS_TYPE, a.SAS_PSORPR, a.HOUSE_NO_NAME, a.ROAD_AVENO_NAME, a.VILLAGE_WARD, a.DISTRICT_ID, a.DIVISION_ID, a.POLICE_STATION_ID, a.POST_OFFICE_ID, a.THANA_ID, a.UNION_ID,
                                                           (SELECT b.DIVISION_ENAME FROM sa_divisions b WHERE b.DIVISION_ID = a.DIVISION_ID)DIVIS_NAME,
                                                           (SELECT d.DISTRICT_ENAME FROM sa_districts d WHERE d.DISTRICT_ID = a.DISTRICT_ID)DIST_NAME,
                                                           (SELECT p.PS_ENAME FROM sa_police_station p WHERE p.POLICE_STATION_ID = a.POLICE_STATION_ID)PLOSC,
                                                           (SELECT po.POST_OFFICE_ENAME FROM sa_post_offices po WHERE po.POST_OFFICE_ID = a.POST_OFFICE_ID)POSTO,
                                                           (SELECT t.THANA_ENAME FROM sa_thanas t WHERE t.THANA_ID = a.THANA_ID)thn,
                                                           (SELECT u.UNION_NAME FROM sa_unions u WHERE u.UNION_ID = a.UNION_ID)uni FROM applicant_adressinfo a WHERE a.APPLICANT_ID = '$applicant_id' AND a.ADRESS_TYPE = 'PS'")->row();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $row;
    }

    public function getLocalPermanentAddress($applicant_id)
    {
        $row = $this->db->query("SELECT a.APP_ADRESS_ID,a.APPLICANT_ID, a.ADRESS_TYPE, a.SAS_PSORPR, a.HOUSE_NO_NAME, a.ROAD_AVENO_NAME, a.VILLAGE_WARD, a.DISTRICT_ID, a.DIVISION_ID, a.POLICE_STATION_ID, a.POST_OFFICE_ID, a.THANA_ID, a.UNION_ID,
                                                           (SELECT b.DIVISION_ENAME FROM sa_divisions b WHERE b.DIVISION_ID = a.DIVISION_ID)DIVIS_NAME,
                                                           (SELECT d.DISTRICT_ENAME FROM sa_districts d WHERE d.DISTRICT_ID = a.DISTRICT_ID)DIST_NAME,
                                                           (SELECT p.PS_ENAME FROM sa_police_station p WHERE p.POLICE_STATION_ID = a.POLICE_STATION_ID)PLOSC,
                                                           (SELECT po.POST_OFFICE_ENAME FROM sa_post_offices po WHERE po.POST_OFFICE_ID = a.POST_OFFICE_ID)POSTO,
                                                           (SELECT t.THANA_ENAME FROM sa_thanas t WHERE t.THANA_ID = a.THANA_ID)thn,
                                                           (SELECT u.UNION_NAME FROM sa_unions u WHERE u.UNION_ID = a.UNION_ID)uni FROM applicant_adressinfo a WHERE a.APPLICANT_ID = '$applicant_id' AND a.ADRESS_TYPE = 'PR'")->row();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $row;
    }

}