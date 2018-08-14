<?php

Class Inventory_model extends CI_Model {
 public function __construct()
 {
  parent::__construct();
  $this->load->database();
}


public function getAllItemSetupInfo()
{
  return $this->db->query("SELECT item.*, cat.CATEGORY_NAME,unit.UNIT_NAME FROM inv_item item
    LEFT JOIN inv_item_category cat ON item.ITEM_CAT_ID = cat.ITEM_CAT_ID
    LEFT JOIN inv_unit unit ON item.UNIT_ID = unit.UNIT_ID ")->result();
}

public function getItemSetupInfoById($id)
{
  return $this->db->query("SELECT item.*, cat.CATEGORY_NAME,unit.UNIT_NAME FROM inv_item item
    LEFT JOIN inv_item_category cat ON item.ITEM_CAT_ID = cat.ITEM_CAT_ID
    LEFT JOIN inv_unit unit ON item.UNIT_ID = unit.UNIT_ID WHERE item.ITEM_ID  = $id")->row();
}

public function getAllRequisitionSetupInfo()
{


    return $this->db->query("SELECT mst.*, lkp.LKP_NAME FROM inv_requisition_mst mst
                              LEFT JOIN m00_lkpdata lkp ON mst.REQ_TYPE = lkp.LKP_ID
                              ORDER BY mst.REQ_MST_ID DESC")->result();

}


public function getAllChildItemlist($mId)
{
  return $this->db->query("SELECT regmst.REQ_DT, regmst.REMARKS, reqchd.*, item.ITEM_ID, item.ITEM_NAME,unit.UNIT_NAME,u.USERNAME FROM inv_requisition_mst regmst
    LEFT JOIN inv_requisition_chd reqchd ON regmst.REQ_MST_ID = reqchd.REQ_MST_ID
    LEFT JOIN inv_item item ON reqchd.ITEM_ID = item.ITEM_ID
    LEFT JOIN inv_unit unit ON item.UNIT_ID = unit.UNIT_ID
    LEFT JOIN sa_users u on reqchd.CREATED_BY = u.USER_ID 
    WHERE regmst.REQ_MST_ID =$mId ORDER BY reqchd.REQ_CHD_ID")->result();
}

    /**
    * @this function use  of purchase order list
    * @author aminul
    */
    public function getPurchaseOrderList(){
      return $this->db->query("SELECT pom.*  FROM inv_po_mst pom where pom.ACTIVE_STATUS='1'")->result();
    }

    /**
    * @this function use  of purchase order list
    * @author aminul
    */
    public function getAllSupplier(){
      return $this->db->query("SELECT pom.*  FROM inv_supplier pom")->result();
    }

    /**
    * @this function use  of purchase order max id
    * @author aminul
    */
    public function getPurchaseOrderMaxId(){
      return $maxid=$this->db->query("SELECT MAX(PO_MST_ID) MAX_PO FROM inv_po_mst")->row();

    }
    /**
    * @this function use  of purchase order list by id
    * @author aminul
    */
    public function getPurchaseOrderListById($id){
      return $this->db->query("SELECT pom.*  FROM inv_po_mst pom where pom.PO_MST_ID='$id' and pom.ACTIVE_STATUS='1'")->row();
    }
    /**
    * @this function use  of purchase order details list by id 
    * @author aminul
    */
    public function getPurchaseOrderDetailsById($id){
      return $this->db->query("SELECT pod.* from inv_po_chd pod where pod.PO_MST_ID=$id")->result();
    }
   /**
    * @this function use  of purchase order details list by id 
    * @author aminul
    */
   public function getPurchaseOrderDetails(){
    return $this->db->query("SELECT pod.* from inv_po_chd pod")->result();
  }

}