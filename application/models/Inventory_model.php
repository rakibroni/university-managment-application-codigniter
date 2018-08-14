<?php

Class Inventory_model extends CI_Model {
 public function __construct()
 {
  parent::__construct();
  $this->load->database();
}


public function getAllItemSetupInfo()
{
  return $this->db->query("SELECT item.*, unit.UNIT_NAME
   FROM inv_item item
   LEFT JOIN inv_unit unit ON item.UNIT_ID = unit.UNIT_ID 
   WHERE item.IS_ITEM=1 AND item.ACTIVE_STATUS=1")->result();
}

public function getItemSetupInfoById($id)
{
  return $this->db->query("SELECT item.*,unit.UNIT_NAME FROM inv_item item

    LEFT JOIN inv_unit unit ON item.UNIT_ID = unit.UNIT_ID WHERE item.ITEM_ID  = $id")->row();
}

public function getAllRequisitionSetupInfo_b()
{


  return $this->db->query("SELECT mst.*, lkp.LKP_NAME FROM inv_requisition_mst mst
    LEFT JOIN m00_lkpdata lkp ON mst.REQ_TYPE = lkp.LKP_ID
    where mst.ACTIVE_STATUS=1
    ORDER BY mst.REQ_MST_ID DESC")->result();

}

public function getAllRequisitionSetupInfo()
{


  return $this->db->query("SELECT mst.*, lkp.LKP_NAME FROM inv_requisition_mst mst
    LEFT JOIN m00_lkpdata lkp ON mst.REQ_TYPE = lkp.LKP_ID
    LEFT JOIN sa_users us ON mst.CREATED_BY=us.USER_ID
    LEFT JOIN hr_emp emp ON us.EMP_ID=emp.EMP_ID
    and mst.ACTIVE_STATUS=1
    ORDER BY mst.REQ_MST_ID DESC")->result();

}

   /**
    * @this function use  get Requisition
    * @author Rokibuzzaman
    */

  public function getAllRequisitionReportInfo($fromDate,$toDate)
  {
  return $this->db->query("SELECT mst.*, lkp.LKP_NAME FROM inv_requisition_mst mst
    LEFT JOIN m00_lkpdata lkp ON mst.REQ_TYPE = lkp.LKP_ID
    where mst.ISSUED_STATUS=1 and (mst.REQ_DT BETWEEN '$fromDate' and '$toDate')
    ")->result();

  }



   /**
    * @this function use  get item by id
    * @author Rokibuzzaman
    */
    public function getAllChildItemlistReport($fromDate,$toDate)
    {
        return $this->db->query("SELECT regmst.REQ_DT, regmst.REMARKS, reqchd.*, item.ITEM_ID, item.ITEM_NAME,unit.UNIT_NAME,u.USERNAME,sum(reqchd.REQUIREMENT_QTY)REQUIREMENT_QTY
        FROM inv_requisition_mst regmst
        LEFT JOIN inv_requisition_chd reqchd ON regmst.REQ_MST_ID = reqchd.REQ_MST_ID
        LEFT JOIN inv_item item ON reqchd.ITEM_ID = item.ITEM_ID
        LEFT JOIN inv_unit unit ON item.UNIT_ID = unit.UNIT_ID
        LEFT JOIN sa_users u on reqchd.CREATED_BY = u.USER_ID 
        where  (regmst.REQ_DT BETWEEN '$fromDate' and '$toDate') group by reqchd.ITEM_ID")->result();
    }



    /**
    * @this function use  get issue item
    * @author Rokibuzzaman
    */

  public function getAllIssueReqReportInfo($fromDate,$toDate)
  {
    return $this->db->query("SELECT mst.*, lkp.LKP_NAME FROM inv_requisition_mst mst
    LEFT JOIN m00_lkpdata lkp ON mst.REQ_TYPE = lkp.LKP_ID
    where mst.ISSUED_STATUS=1 and (mst.REQ_DT BETWEEN '$fromDate' and '$toDate')
    ")->result();
  }


   /**
    * @this function use  for get  issue item Report
    * @author Rokibuzzaman
    */
      public function getAllIssueDetailsItemReport($fromDate,$toDate){
        return $this->db->query("SELECT iss.ISSUE_DT,issc.*,itm.ITEM_NAME,itm.UNIT_ID ,u.UNIT_NAME,sum(issc.ISSUED_QTY)TOTAL_ISSUED_QTY
        FROM inv_issue_mst iss 
        LEFT JOIN inv_issue_chd issc ON iss.ISSUE_MST_ID = issc.ISSUE_MST_ID
        LEFT JOIN inv_item itm ON issc.ITEM_ID=itm.ITEM_ID
        LEFT JOIN inv_unit u ON itm.UNIT_ID=u.UNIT_ID
        LEFT JOIN inv_requisition_chd rch ON issc.REQ_CHD_ID=rch.REQ_CHD_ID
        where issc.ACTIVE_STATUS=1 AND (iss.ISSUE_DT BETWEEN '$fromDate' and '$toDate') group by issc.ITEM_ID")->result();
      }


    /**
    * @this function use  get item by id
    * @author aminul
    */
    public function getAllChildItemlist($id)
    {
      return $this->db->query("SELECT regmst.REQ_DT, regmst.REMARKS, reqchd.*, item.ITEM_ID, item.ITEM_NAME,unit.UNIT_NAME,u.USERNAME,(SELECT SUM(issc.ISSUED_QTY) FROM inv_issue_chd issc WHERE issc.REQ_CHD_ID=reqchd.REQ_CHD_ID) TOTAL_ISSUED_QTY
        FROM inv_requisition_mst regmst
        LEFT JOIN inv_requisition_chd reqchd ON regmst.REQ_MST_ID = reqchd.REQ_MST_ID
        LEFT JOIN inv_item item ON reqchd.ITEM_ID = item.ITEM_ID
        LEFT JOIN inv_unit unit ON item.UNIT_ID = unit.UNIT_ID
        LEFT JOIN sa_users u on reqchd.CREATED_BY = u.USER_ID 
        WHERE regmst.REQ_MST_ID =$id ORDER BY reqchd.REQ_CHD_ID")->result();
    }

    public function getAllRequisitionInfoById($id)
    {
      return $this->db->query("SELECT mst.*, lkp.LKP_NAME FROM inv_requisition_mst mst
        LEFT JOIN m00_lkpdata  lkp ON mst.REQ_TYPE = lkp.LKP_ID
        WHERE mst.REQ_MST_ID  = $id")->row();
    }
    /**
    * @this function use  of purchase order list
    * @author aminul
    */
    public function getPurchaseOrderList(){
      return $this->db->query("SELECT pom.*  FROM inv_po_mst pom where pom.ACTIVE_STATUS='1' order by pom.PO_MST_ID DESC")->result();
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
        return $this->db->query("SELECT DISTINCT(pod.PO_CHD_ID),pod.PO_MST_ID,sup.*,itm.ITEM_NAME,itm.UNIT_ID ,u.UNIT_NAME,pod.ITEM_ID,pod.SUPPLIER_ID,pod.ORDER_QTY,pod.ACTIVE_STATUS,
        (SELECT SUM(por.RECEIVE_QTY) FROM inv_pr_chd por WHERE por.PO_CHD_ID=pod.PO_CHD_ID)RECEIVE_QTY 
        FROM inv_po_chd pod 
        LEFT JOIN inv_pr_chd por ON pod.PO_CHD_ID=por.PO_CHD_ID
        LEFT JOIN inv_item itm ON por.ITEM_ID=itm.ITEM_ID
        LEFT JOIN inv_unit u ON itm.UNIT_ID=u.UNIT_ID
        LEFT JOIN inv_supplier sup ON por.SUPPLIER_ID=sup.SUPPLIER_ID
        WHERE pod.PO_MST_ID=$id ORDER BY pod.PO_CHD_ID")->result();
    }


     /**
    * @this function use  for get  Purchase Order item Report
    * @author Rokibuzzaman
    */
      public function getAllPurchaseOrderItemReport($fromDate,$toDate){
        return $this->db->query("SELECT pos.PO_DATE,poc.*,itm.ITEM_NAME,itm.UNIT_ID ,u.UNIT_NAME,sum(poc.ORDER_QTY)TOTAL_ORDER_QTY
        FROM inv_po_mst pos 
        LEFT JOIN inv_po_chd poc ON pos.PO_MST_ID = poc.PO_MST_ID
        LEFT JOIN inv_item itm ON poc.ITEM_ID=itm.ITEM_ID
        LEFT JOIN inv_unit u ON itm.UNIT_ID=u.UNIT_ID
        where (pos.PO_DATE BETWEEN '$fromDate' and '$toDate') group by poc.ITEM_ID")->result();
      }

    /**
    * @this function use  for get   Purchase Order Receive item Report
    * @author Rokibuzzaman
    */
      public function getAllPurchaseOrderReceiveItemReport($fromDate,$toDate){
        return $this->db->query("SELECT prs.PR_DATE,prc.*,itm.ITEM_NAME,itm.UNIT_ID ,u.UNIT_NAME,sum(prc.RECEIVE_QTY)TOTAL_RECEIVE_QTY
        FROM inv_pr_mst prs 
        LEFT JOIN inv_pr_chd prc ON prs.PR_MST_ID = prc.PR_MST_ID
        LEFT JOIN inv_item itm ON prc.ITEM_ID=itm.ITEM_ID
        LEFT JOIN inv_unit u ON itm.UNIT_ID=u.UNIT_ID
        where (prs.PR_DATE BETWEEN '$fromDate' and '$toDate') group by prc.ITEM_ID")->result();
      }

    /**
    * @this function use  for get   Purchase Order Return item Report
    * @author Rokibuzzaman
    */
      public function getAllPurchaseOrderReturnItemReport($fromDate,$toDate){
        return $this->db->query("SELECT prs.PR_RET_DATE,prc.*,itm.ITEM_NAME,itm.UNIT_ID ,u.UNIT_NAME,sum(prc.RET_RECEIVE_QTY)TOTAL_RET_RECEIVE_QTY
        FROM inv_pr_return_mst prs 
        LEFT JOIN inv_pr_return_chd prc ON prs.PR_RET_MST_ID = prc.PR_RET_MST_ID
        LEFT JOIN inv_item itm ON prc.ITEM_ID=itm.ITEM_ID
        LEFT JOIN inv_unit u ON itm.UNIT_ID=u.UNIT_ID
        where (prs.PR_RET_DATE BETWEEN '$fromDate' and '$toDate') group by prc.ITEM_ID")->result();
      }




    /**
    * @this function use for get Issue Return item Report
    * @author Rokibuzzaman
    */
      public function getAllIssueReturnItemReport($fromDate,$toDate){
        return $this->db->query("SELECT irs.ISSUE_RET_DT,irc.*,itm.ITEM_NAME,itm.UNIT_ID ,u.UNIT_NAME,sum(irc.ISSUED_RET_QTY)TOTAL_ISSUED_RET_QTY
        FROM inv_issue_return_mst irs 
        LEFT JOIN inv_issue_return_chd irc ON irs.ISSUE_RET_MST_ID = irc.ISSUE_RET_MST_ID
        LEFT JOIN inv_item itm ON irc.ITEM_ID=itm.ITEM_ID
        LEFT JOIN inv_unit u ON itm.UNIT_ID=u.UNIT_ID
        where (irs.ISSUE_RET_DT BETWEEN '$fromDate' and '$toDate') group by irc.ITEM_ID")->result();
      }


   /**
    * @this function use  of purchase order details list by id 
    * @author aminul
    */
   public function getPurchaseOrderDetails(){
    return $this->db->query("SELECT pod.* from inv_po_chd pod")->result();
  }
     /**
    * @this function use  of purchase order max id
    * @author aminul
    */
     public function getReceivePurchaseOrderMaxId(){
      return $maxid=$this->db->query("SELECT MAX(poe.PR_MST_ID) AS PR_MST_ID FROM inv_pr_mst poe")->row();

    }
     /**
    * @this function use  for item id when purchase order receive
    * @author aminul
    */
     public function getItemById($id)
     {
      return $this->db->query("SELECT pod.ITEM_ID,itm.ITEM_NAME,uni.UNIT_NAME 
        FROM inv_po_chd pod
        LEFT JOIN inv_item  itm ON pod.ITEM_ID=itm.ITEM_ID
        LEFT JOIN inv_unit uni ON itm.UNIT_ID=uni.UNIT_ID
        WHERE pod.PO_MST_ID='$id'")->result();

     }
         /**
    * @this function use  of purchase order max id
    * @author aminul
    */
         public function getSupplierById($id){
          return $this->db->query("SELECT pod.SUPPLIER_ID,sup.FULL_ENAME
            FROM inv_po_chd pod
            LEFT JOIN inv_supplier sup ON pod.SUPPLIER_ID=sup.SUPPLIER_ID
            WHERE pod.PO_MST_ID='$id'")->result();
        }
     /**
    * @this function use  of purchase reseive max id
    * @author aminul
    */
     public function getPerReMstNO($id){
      return $this->db->query("SELECT po.PR_MST_NO,po.PR_MST_ID FROM inv_pr_mst po WHERE po.PO_MST_ID='$id'")->result();
    }
      /**
    * @this function use  of receive master max id
    * @author aminul
    */
      public function getPerReMstNoDetails($id){
        return $this->db->query("SELECT po.PR_MST_ID,po.ITEM_ID,po.SUPPLIER_ID,po.RECEIVE_QTY FROM inv_pr_chd po WHERE po.PR_MST_ID='$id'")->result();
      }
    /**
    * @this function use  of issue item max id
    * @author aminul
    */
    public function getIssueItemMaxId(){
      return $maxid=$this->db->query("SELECT MAX(iss.ISSUE_MST_ID) AS ISSUE_MST_ID FROM inv_issue_mst iss")->row();

    }
    /**
    * @this function use  for get employee name of session
    * @author aminul
    */
    public function issueEmployee($user_id){
      return $this->db->query("SELECT us.EMP_ID,emp.FULL_ENAME 
        FROM sa_users us
        LEFT JOIN hr_emp emp ON us.EMP_ID=emp.EMP_ID
        WHERE us.USER_ID='$user_id'")->row();
    }
   /**
    * @this function use  for get department name of issue
    * @author aminul
    */
   public function issueDept($user_id){
    return $this->db->query("SELECT us.EMP_ID,emp.FULL_ENAME,us.DEPT_ID,dep.DEPT_NAME 
      FROM sa_users us
      LEFT JOIN hr_emp emp ON us.EMP_ID=emp.EMP_ID
      LEFT JOIN ins_dept dep ON us.DEPT_ID=dep.DEPT_ID
      WHERE us.USER_ID='$user_id'")->row();
  }

   /**
    * @this function use  for get previous issue item
    * @author aminul
    */

   public function previousIssueItem($id){
    return $this->db->query("SELECT isu.ISSUE_NO FROM inv_issue_mst isu WHERE isu.REQ_MST_ID='$id'")->result();
  }
   /**
    * @this function use  for get all issue list
    * @author aminul
    */
   public function getAllIssueItem(){
    $allIssue="SELECT iss.* FROM inv_issue_mst iss WHERE iss.ACTIVE_STATUS=?";
    return $this->db->query($allIssue,array(1))->result();
  }

    /**
    * @this function use  for get  issue item by id
    * @author aminul
    */
    public function getAllIssueItemById($id){
      $issue="SELECT iss.* FROM inv_issue_mst iss WHERE iss.ISSUE_MST_ID=? and iss.ACTIVE_STATUS=?";
      return $this->db->query($issue,array($id,'1'))->row();
    }

      /**
    * @this function use  for get  issue item by id
    * @author aminul
    */
      public function getAllIssueDetailsItemById($id){
        $issueDe="SELECT issc.*,itm.ITEM_NAME,itm.UNIT_ID ,u.UNIT_NAME,rch.REQUIREMENT_QTY
        FROM inv_issue_chd issc 
        LEFT JOIN inv_item itm ON issc.ITEM_ID=itm.ITEM_ID
        LEFT JOIN inv_unit u ON itm.UNIT_ID=u.UNIT_ID
        LEFT JOIN inv_requisition_chd rch ON issc.REQ_CHD_ID=rch.REQ_CHD_ID
        WHERE issc.ISSUE_MST_ID=? AND issc.ACTIVE_STATUS=?";
        return $this->db->query($issueDe,array($id,'1'))->result();
      }
  /**
  * @this function use  of issue return max id
  * @author aminul
 */
  public function getIssueReturnMaxId(){
    return $maxid=$this->db->query("SELECT MAX(iss.ISSUE_RET_MST_ID) AS ISSUE_RET_MST_ID FROM inv_issue_return_mst iss")->row();

  }

   /**
    * @this function use  for get previous issue return no
    * @author aminul
    */
   public function previousIssueReturn($id){
    $pRrQuery="SELECT rm.ISSUE_RET_NO FROM inv_issue_return_mst rm WHERE rm.ISSUE_MST_ID=?";
    return $this->db->query($pRrQuery,array($id))->result();
  }

     /**
    * @this function use  for get all purchase order list
    * @author aminul
    */
     public function getAllPurchaseOrder(){
      $purOrder="SELECT iss.* FROM inv_pr_mst iss WHERE iss.ACTIVE_STATUS=?";
      return $this->db->query($purOrder,array(1))->result();
    }
     /**
    * @this function use  for get all purchase order list
    * @author aminul
    */
     public function getPurchaseOrder($id){
      $po="SELECT pc.*,itm.ITEM_NAME,u.UNIT_NAME,s.FULL_ENAME,ipc.ORDER_QTY
      FROM inv_pr_chd pc
      LEFT JOIN inv_item itm ON pc.ITEM_ID=itm.ITEM_ID
      LEFT JOIN inv_unit u ON itm.UNIT_ID=u.UNIT_ID
      LEFT JOIN inv_supplier s ON pc.SUPPLIER_ID=s.SUPPLIER_ID
      LEFT JOIN inv_po_chd ipc ON pc.PO_CHD_ID=ipc.PO_CHD_ID
      WHERE pc.PR_MST_ID=? AND pc.ACTIVE_STATUS=?";
      return $this->db->query($po,array($id,1))->result();
    }
     /**
    * @this function use  for get all purchase order list
    * @author aminul
    */
     public function getAllPurchaseOrderById($id){
      $purOrderR="SELECT iss.* FROM inv_pr_mst iss WHERE iss.PR_MST_ID=? and iss.ACTIVE_STATUS=?";
      return $this->db->query($purOrderR,array($id,1))->row();
    }

      /**
  * @this function use  of issue return max id
  * @author aminul
 */
  public function getOrderReturnMaxId(){
    return $maxid=$this->db->query("SELECT MAX(iss.PR_RET_MST_ID) AS MAX_PR_RET_MST_ID FROM inv_pr_return_mst iss")->row();

  }

    /**
    * @this function use  for get previous issue return no
    * @author aminul
    */
   public function previousOrderReturnNo($id){
    $pRrQuery="SELECT ore.PR_RET_MST_NO FROM inv_pr_return_mst ore WHERE ore.PR_MST_ID=?";
    return $this->db->query($pRrQuery,array($id))->result();
  }

  public function itemStock($item_id){
    $sql="select * from inv_stock where STOCK_ID= (select MAX(STOCK_ID) max_stock_id FROM inv_stock where ITEM_ID=?)";
    return $this->db->query($sql,array($item_id))->row();
  }



  }