<?php

Class Employee_model extends CI_Model {

    public function empPersonalInfo($emp_id)
    {
        $row = $this->db->query("select a.*, b.LKP_NAME as LKP_MARITAL_STATUS , c.NATIONALITY as LKP_NATIONALITY,
                        d.LKP_NAME as LKP_RELIGION, e.DEPT_NAME from hr_emp a 
                        left join m00_lkpdata b on a.MARITAL_STATUS=b.LKP_ID 
                        left join country c on a.NATIONALITY=c.id
                        left join m00_lkpdata d on a.RELIGION=d.LKP_ID
                        left join ins_dept e on a.DEPT_ID=e.DEPT_ID
                        WHERE a.EMP_ID = '$emp_id'")->row();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $row;
    }
    public function empInfo()
    {
        $row = $this->db->query("select a.*,c.DEPT_NAME,c.DEPT_ABBR,d.DESIGNATION from hr_emp a 
                                    left join hr_edeptdesi b on a.EMP_ID = b.EMP_ID
                                    left join ins_dept c on b.DEPT_ID=c.DEPT_ID
                                    left join hr_desig d on b.DESIG_ID = d.DESIG_ID group by a.EMP_ID")->result();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $row;
    }


     public function leaveReportInfo()
    {
        $row = $this->db->query("select a.*,sum(chd.NO_OF_DAYS) as NO_OF_DAYS from hr_emp a 
                                 left join hr_leave_approved_chd chd on a.EMP_ID = chd.EMP_ID
                                     group by a.EMP_ID")->result();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $row;
    }

    public function findEmpById($emp_id)
    {
        $row = $this->db->query("select a.*,b.DEPT_ID as department_id,c.DEPT_ABBR, b.DESIG_ID as designation_id, b.DEFAULT_FG, c.DEPT_NAME,d.DESIGNATION from hr_emp a 
                                    left join hr_edeptdesi b on a.EMP_ID = b.EMP_ID
                                    left join ins_dept c on b.DEPT_ID=c.DEPT_ID
                                    left join hr_desig d on b.DESIG_ID = d.DESIG_ID WHERE a.EMP_ID = $emp_id")->row();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
        return $row;
    }

    public function getAllLeaveRequestsFromEmp()
    {
        return $this->db->query("SELECT *, lv.ACTIVE_STATUS as LV_ACTIVE_STATUS FROM hr_leave lv
                                  LEFT JOIN hr_emp emp ON lv.EMP_ID = emp.EMP_ID
                                  ")->result();
    }

    public function getAllLeaveRequestsFromEmpById($leave_id)
    {
        return $this->db->query("SELECT *, lv.ACTIVE_STATUS as LV_ACTIVE_STATUS FROM hr_leave lv
                                  LEFT JOIN hr_emp emp ON lv.EMP_ID = emp.EMP_ID
                                  WHERE lv.LEAVE_ID = $leave_id
                                  ")->row();
    }


    public function getEmployeeDesignation($emp_id){
       
      //return $this->db->query("SELECT  * FROM hr_edeptdesi as edi  left join  hr_desig d on d.DESIG_ID= edi.DESIG_ID WHERE EMP_ID = $emp_id")->result();

        return $this->db->query("SELECT edi.EMP_ID, edi.DEPT_ID, edi.DESIG_ID , edi.DEFAULT_FG , d.DESIG_ID , d.DESIGNATION , ind.DEPT_NAME  FROM hr_edeptdesi as edi  left join  hr_desig d on d.DESIG_ID= edi.DESIG_ID 
        left join  ins_dept as ind on ind.DEPT_ID = edi.DEPT_ID
        WHERE EMP_ID = $emp_id")->result();

      
    }
}