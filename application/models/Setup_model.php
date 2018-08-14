<?php

Class Setup_model extends CI_Model {

    public function getAllCampusSetupInfo()
    {
        return $this->db->query("SELECT * FROM sa_campus a 
                                  LEFT JOIN sa_organizations b ON a.ORG_ID = b.ORG_ID
                                  LEFT JOIN m00_lkpdata c ON a.CAMPUS_TYPE = c.LKP_ID")->result();
    }

    public function getCampusSetupInfoById($id)
    {
        return $this->db->query("SELECT * FROM sa_campus a 
                                  LEFT JOIN sa_organizations b ON a.ORG_ID = b.ORG_ID
                                  LEFT JOIN m00_lkpdata c ON a.CAMPUS_TYPE = c.LKP_ID
                                  WHERE a.CAMPUS_ID = $id")->row();
    }

    public function getAllBuildingInfo()
    {
        return $this->db->query("SELECT *, a.ACTIVE_STATUS as BUILDING_ACTIVE_STATUS FROM sa_building a 
                                  LEFT JOIN sa_campus b ON a.CAMPUS_ID = b.CAMPUS_ID
                                  LEFT JOIN m00_lkpdata c ON a.BUILDING_TYPE = c.LKP_ID")->result();
    }

    public function getBuildingInfoById($building_id)
    {
        return $this->db->query("SELECT *, a.ACTIVE_STATUS as BUILDING_ACTIVE_STATUS FROM sa_building a 
                                  LEFT JOIN sa_campus b ON a.CAMPUS_ID = b.CAMPUS_ID
                                  LEFT JOIN m00_lkpdata c ON a.BUILDING_TYPE = c.LKP_ID WHERE a.BUILDING_ID = $building_id")->row();
    }

    public function getAllRoomInfo()
    {
        return $this->db->query("SELECT r.ROOM_ID,r.ROOM_NO,r.ROOM_NAME,r.DESC,r.ACTIVE_STATUS,
                                  c.CAMPUS_NAME,b.BUILDING_NAME,f.FLOOR_NAME,m.LKP_NAME 
                                  FROM sa_room r
                                  LEFT JOIN sa_campus c ON r.CAMPUS_ID = c.CAMPUS_ID
                                  LEFT JOIN sa_building b ON r.BUILDING_ID = b.BUILDING_ID
                                  LEFT JOIN building_floor f ON r.FLOOR_ID = f.FLOOR_SL_NO
                                  LEFT JOIN m00_lkpdata m ON r.ROOM_TYPE = m.LKP_ID ORDER BY r.ROOM_ID DESC ")->result();
    }

    public function getAllRoomByIdInfo($room_id)
    {
        return $this->db->query("SELECT r.ROOM_ID,r.ROOM_NO,r.ROOM_NAME,r.DESC,r.ACTIVE_STATUS,
                                  c.CAMPUS_NAME,b.BUILDING_NAME,f.FLOOR_NAME,m.LKP_NAME,c.CAMPUS_ID,b.BUILDING_ID,r.FLOOR_ID,f.FLOOR_SL_NO,m.LKP_ID,r.ROOM_TYPE 
                                  FROM sa_room r
                                  LEFT JOIN sa_campus c ON r.CAMPUS_ID = c.CAMPUS_ID
                                  LEFT JOIN sa_building b ON r.BUILDING_ID = b.BUILDING_ID
                                  LEFT JOIN building_floor f ON r.FLOOR_ID = f.FLOOR_SL_NO
                                  LEFT JOIN m00_lkpdata m ON r.ROOM_TYPE = m.LKP_ID WHERE r.ROOM_ID = $room_id")->row();
    }
}