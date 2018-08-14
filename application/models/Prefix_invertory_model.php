<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


Class Prefix_invertory_model extends CI_Model {
 public function __construct()
 {
  parent::__construct();
  $this->load->database();
}

/**
* @create purchase order no concate R,year,month and 4 digit 
* @author aminul<aminul@atilimited.net>
*/
public function createRequisitionNo()
{
  $date=date('Ym');
  $startNum='0';
  $fourDisit='4';
  $formatpoNo=$date.str_pad($startNum, $fourDisit, '0', STR_PAD_LEFT);
  $maxREQ_NO=$this->db->query("SELECT MAX(SUBSTRING(re.REQ_NO,9)) AS REQ_NO FROM inv_requisition_mst re")->row();
  $maxRequiNo=$maxREQ_NO->REQ_NO + 1;
  $RE_NO_C=$maxRequiNo+$formatpoNo;
  return  $RE_NO_F='R'.$RE_NO_C;
}
/**
* @create purchase order no concate P,year,month and 4 digit 
* @author aminul<aminul@atilimited.net> 
*/
public function createPurchaseOrderNo(){
  $date=date('Ym');
  $startNum='0';
  $fourDisit='4';
  $formatpoNo=$date.str_pad($startNum, $fourDisit, '0', STR_PAD_LEFT);
  $maxPoNo=$this->db->query("SELECT MAX(SUBSTRING(pom.PO_NO,9)) AS PO_NO FROM inv_po_mst pom")->row();
  $maxPoNoIncre=$maxPoNo->PO_NO + 1;
  $PO_NO_C=$maxPoNoIncre+$formatpoNo;
  return $PO_NO_F='P'.$PO_NO_C;
}

/**
* @create purchase order no concate OR,year,month and 4 digit 
* @author aminul<aminul@atilimited.net> 
*/
public function createReceivePurchaseOrderNo(){
  $date=date('Ym');
  $startNum='0';
  $fourDisit='4';
  $formatpoNo=$date.str_pad($startNum, $fourDisit, '0', STR_PAD_LEFT);
  $maxORE=$this->db->query("SELECT MAX(SUBSTRING(ore.PR_MST_NO,9)) AS MAX_PR_MST_NO   FROM inv_pr_mst ore ")->row();
  $maxOReNoIncre=$maxORE->MAX_PR_MST_NO + 1;
  $O_R_NO_C=$maxOReNoIncre+$formatpoNo;
  return $OR_RE_NO='OR'.$O_R_NO_C;
}
/**
* @create issue item no concate OR,year,month and 4 digit 
* @author aminul<aminul@atilimited.net> 
*/
public function createIssueItemNo(){
  $date=date('Ym');
  $startNum='0';
  $fourDisit='4';
  $formatpoNo=$date.str_pad($startNum, $fourDisit, '0', STR_PAD_LEFT);
  $maxIssue=$this->db->query("SELECT MAX(SUBSTRING(issue.ISSUE_NO,9)) AS MAX_ISSUE_NO FROM inv_issue_mst issue")->row();
  $maxIssueNo=$maxIssue->MAX_ISSUE_NO + 1;
  $I_N_NO_C=$maxIssueNo+$formatpoNo;
  return $IS_RE_NO='IS'.$I_N_NO_C;
}
/**
* @create issue return no concate IR,year,month and 4 digit 
* @author aminul<aminul@atilimited.net> 
*/
public function createIssueReturnNo(){
  $date=date('Ym');
  $startNum='0';
  $fourDisit='4';
  $formatIssReNo=$date.str_pad($startNum, $fourDisit, '0', STR_PAD_LEFT);
  $maxIssueRe=$this->db->query("SELECT MAX(SUBSTRING(issr.ISSUE_RET_NO,9)) AS MAX_ISSUE_RET_NO FROM inv_issue_return_mst issr")->row();
  $maxIssueReNo=$maxIssueRe->MAX_ISSUE_RET_NO + 1;
  $ISS_R_NO=$maxIssueReNo+$formatIssReNo;
  return $ISS_RE_NO='IR'.$ISS_R_NO;
}

/**
* @create issue return no concate ORE,year,month and 4 digit 
* @author aminul<aminul@atilimited.net> 
*/
public function createOrderReturnNo(){
  $date=date('Ym');
  $startNum='0';
  $fourDisit='4';
  $formatIssReNo=$date.str_pad($startNum, $fourDisit, '0', STR_PAD_LEFT);
  $maxPurOr=$this->db->query("SELECT MAX(SUBSTRING(issr.PR_RET_MST_NO,10)) AS MAX_PR_RET_MST_NO FROM inv_pr_return_mst issr")->row();
  $maxIssueReNo=$maxPurOr->MAX_PR_RET_MST_NO + 1;
  $PUR_OR_NO=$maxIssueReNo+$formatIssReNo;
  return $PUR_RE_NO='ORE'.$PUR_OR_NO;
}


}