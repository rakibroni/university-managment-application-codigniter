<?php

Class Library_model extends CI_Model {

	function insert($tableName, $post)
    {

        $this->db->insert($tableName, $post);
        return $this->db->insert_id();
    }


  public function allRowInTable($tableName){

    return $this->db->count_all($tableName);

  }


    public function itemInfo()
    {
        //$row = $this->db->query("select * from lib_item")->result();
        $row = $this->db->query("select libi.ITEM_ID ,libi.ISBN_NO ,libi.BOOK_CELL_NO , libi.ITEM_NAME  ,libi.ACTIVE_STATUS , b.LKP_NAME as DEPARTMENT ,c.LKP_NAME as BOOK_TYPE_ID from lib_item  libi  left join m00_lkpdata b on b.LKP_ID=libi.DEPARTMENT left join m00_lkpdata c on c.LKP_ID=libi.BOOK_TYPE_ID")->result();

        return $row;
    }


    public function singleItemLiberayInfo($ITEM_ID)
    {

        $row = $this->db->query("select libi.* , b.LKP_NAME as DEPARTMENT ,c.LKP_NAME as BOOK_TYPE_ID ,liba.AUTHOR_NAME , libp.PUBLISHER_NAME ,invs.FULL_ENAME from lib_item  libi  left join m00_lkpdata b on b.LKP_ID=libi.DEPARTMENT left join m00_lkpdata c on c.LKP_ID=libi.BOOK_TYPE_ID left join lib_author liba on liba.AUTHOR_ID=libi.AUTHOR_ID left join lib_publisher libp  on libp.PUBLISHER_ID=libi.PUBLISHER_ID left join inv_supplier invs  on invs.SUPPLIER_ID=libi.SUPPILER_ID ")->row();

        return $row;
    }

    public function stockItemInfo()
    {
       
        $row = $this->db->query("select libir.* , libi.ITEM_NAME ,invs.FULL_ENAME  from lib_item_receive  libir  left join lib_item libi on libi.ITEM_ID=libir.ITEM_NAME_ID left join inv_supplier invs on invs.SUPPLIER_ID=libir.SUPPLIER_ID")->result();
        return $row;
    }


    public function stockItemList(){
                $row = $this->db->query("SELECT  libs.ITEM_ID , libi.ITEM_NAME, COUNT(libs.ITEM_ID) as number_item FROM lib_stock libs left join lib_item libi on libi.ITEM_ID=libs.ITEM_ID GROUP BY ITEM_ID")->result();
                 return $row;
            }


    public function currentStockItemStatus(){
         
            $row = $this->db->query("SELECT * FROM ( SELECT  libs.ITEM_ID , libi.ITEM_NAME, COUNT(libs.ITEM_ID) as number_item FROM lib_stock libs left join lib_item libi on libi.ITEM_ID=libs.ITEM_ID GROUP BY ITEM_ID) AS A left JOIN ( select *, count(libb.ITEM_ID) as test from lib_borrowers libb WHERE ACTIVE_STATUS = 1 group by ITEM_ID ) AS B ON A.ITEM_ID=B.ITEM_ID")->result();

                 return $row;
            }



    public function libraryMember()
    {
      
        $row = $this->db->query("select libm.* , spi.FULL_NAME_EN from lib_members libm left join student_personal_info spi on spi.STUDENT_ID=libm.MEBBER_ID")->result();
        return $row;
    }

    function findAllByAttributeLibrary($tableName, $attribute)
    {
        return $this->db->get_where($tableName, $attribute)->row();
    }


    function get_field_value_by_attribute_library($tableName, $fieldName, $attribute)
    {
        return $this->db->get_where($tableName, $attribute)->row()->{$fieldName};
    }

    public function libraryAllStock()
    {
      
        $row = $this->db->query("select libs.* , libi.* , lkp.LKP_NAME from lib_stock libs left join lib_item libi  on libi.ITEM_ID=libs.ITEM_ID left join m00_lkpdata lkp on lkp.LKP_ID = libi.DEPARTMENT  order by libs.LIB_STOCK_ID ")->result();
        return $row;
    }

    public function singleLibraryMemberDetails($memberId){

     $libraryMemberInfo=$this->db->query("select libm.* , spi.FULL_NAME_EN  ,insd.DEPT_NAME from lib_members libm left join student_personal_info spi on spi.STUDENT_ID=libm.MEBBER_ID  left join ins_dept insd on insd.DEPT_ID=spi.DEPT_ID where libm.MEMBER_NO=".$memberId)->row();
     return $libraryMemberInfo;
    }

    public function singleLibraryItemDetails($itemId){

     $libraryItemInfo=$this->db->query("select *, libi.ITEM_NAME , libi.DEPARTMENT , mlk.LKP_NAME from lib_stock libs left join lib_item libi on libi.ITEM_ID =libs.ITEM_ID left join m00_lkpdata  mlk on mlk.LKP_ID = libi.DEPARTMENT where libs.SKU =".$itemId)->row();
     return $libraryItemInfo;

    }

    public function libraryBorrowList()
    {
        $libraryBorrowItemList=$this->db->query("select * ,libme.MEBBER_ID ,spi.FULL_NAME_EN ,spi.MOBILE_NO , insde.DEPT_NAME ,libi.ITEM_NAME from lib_borrowers  libbo left join lib_members libme on libme.MEMBER_NO = libbo.MEMBER_ID left join student_personal_info spi on spi.STUDENT_ID = libme.MEBBER_ID left join ins_dept insde on insde.DEPT_ID = spi.DEPT_ID left join lib_item libi on libi.ITEM_ID =libbo.ITEM_ID  where libbo.ACTIVE_STATUS = 1")->result();
             return $libraryBorrowItemList;
       
    }

    public function libraryBorrowSingleList($itemUniqueId)
    {
        $libraryBorrowItemList=$this->db->query("select * ,libme.MEBBER_ID ,spi.FULL_NAME_EN ,spi.MOBILE_NO , insde.DEPT_NAME ,libi.ITEM_NAME from lib_borrowers  libbo left join lib_members libme on libme.MEMBER_NO = libbo.MEMBER_ID left join student_personal_info spi on spi.STUDENT_ID = libme.MEBBER_ID left join ins_dept insde on insde.DEPT_ID = spi.DEPT_ID left join lib_item libi on libi.ITEM_ID =libbo.ITEM_ID where libbo.BORROWER_ID = ".$itemUniqueId)->row();
             return $libraryBorrowItemList;     
    }


    public function libraryItemBorrwDetails($itemId)
    {
       
      $libraryItemBorrowInfo=$this->db->query("select *, libi.ITEM_NAME , libi.DEPARTMENT , mlk.LKP_NAME , libb.MEMBER_ID , libm.MEBBER_ID as STUDENT_ID , spi.FULL_NAME_EN  ,insd.DEPT_NAME from lib_stock libs left join lib_item libi on libi.ITEM_ID =libs.ITEM_ID left join lib_borrowers libb on libb.STOCK_ID = libs.SKU  left join lib_members libm on libm.MEMBER_NO = libb.MEMBER_ID left join student_personal_info spi on spi.STUDENT_ID=libm.MEBBER_ID  left join ins_dept insd on insd.DEPT_ID=spi.DEPT_ID left join m00_lkpdata  mlk on mlk.LKP_ID = libi.DEPARTMENT where libs.SKU =".$itemId)->row();
     return $libraryItemBorrowInfo;

    }

    public function libraryItemHistory($skuCode){

        
       $dataItemHistory= $this->db->query("select * , m00l.LKP_NAME from lib_stock libs left join lib_item libi on libi.ITEM_ID = libs.ITEM_ID left join m00_lkpdata m00l on libi.DEPARTMENT = m00l.LKP_ID where libs.SKU=".$skuCode)->row();
        return $dataItemHistory;
    }


    public function libraryItemHistoryStudent($skuCode){    
       $dataItemHistoryStudent= $this->db->query("select * , libm.MEBBER_ID from lib_borrowers libb left join lib_members libm on libm.MEMBER_NO = libb.MEMBER_ID left join student_personal_info spi on libm.MEBBER_ID=spi.STUDENT_ID where libb.STOCK_ID =".$skuCode)->result();
        return $dataItemHistoryStudent;
    }

    public function libraryBorrowItemWise(){
        $datalibraryBorrowItemWise=$this->db->query("select * , count(lib_borrowers.ITEM_ID) as test from lib_borrowers WHERE ACTIVE_STATUS = 1 group by ITEM_ID")->result();
        return $datalibraryBorrowItemWise;
    }

    public function dateWiseItem($date){
       // var_dump($date); DATE(Date)
        //STR_TO_DATE(STR_TO_DATE(
        //$test2=STR_TO_DATE($date, '%d/%m/%Y');

        //$numberAffictedRow=$this->db->query("select *  from lib_stock where CREATE_DATE LIKE ".$test2."%")->row();
        //var_dump($numberAffictedRow); die();
       // return $datalibraryBorrowItemWise;

        }



    public function todayItem(){

        $dateTime=date('d-m-y');    
        $numberAffictedRowToday=$this->db->query("select * from lib_stock where DATE_FORMAT(CREATE_DATE,'%d-%m-%y') = '$dateTime'")->result();
       $finalAffectedDataForTodayItem=$this->db->affected_rows();
       return $finalAffectedDataForTodayItem;
     
    }


    public function todayBorrow(){

        $dateTime=date('d-m-y');    
        $numberAffictedRowToday=$this->db->query("select * from lib_borrowers where DATE_FORMAT(CREATE_DATE,'%d-%m-%y') = '$dateTime'")->result();
        $finalAffectedDataForTodayBorrow=$this->db->affected_rows();

        return $finalAffectedDataForTodayBorrow;
 
    }

    public function todayMember(){

    $dateTime=date('d-m-y');    
    $finalAffectedDataFor=$this->db->query("select * from lib_members where DATE_FORMAT(CREATE_DATE,'%d-%m-%y') = '$dateTime'")->result();
    $finalAffectedDataForTodayMember=$this->db->affected_rows();

    return $finalAffectedDataForTodayMember;

    }

    public function thisMonth($date,$tableName){

    $dateTime=$date;
    $tableName=$tableName;
 
    $finalAffectedDataFor=$this->db->query("select * from $tableName where DATE_FORMAT(CREATE_DATE,'%m-%y') = '$dateTime'")->result();
    $finalAffectedDataForMonthItem=$this->db->affected_rows();

    return $finalAffectedDataForMonthItem;

    }


    public function thisYear($date,$tableName){

    $dateTime=$date;
    $tableName=$tableName;
 
    $finalAffectedDataFor=$this->db->query("select * from $tableName where DATE_FORMAT(CREATE_DATE,'-%y') = '$dateTime'")->result();
    $finalAffectedDataForMonthItem=$this->db->affected_rows();
    return $finalAffectedDataForMonthItem;

    }




}
