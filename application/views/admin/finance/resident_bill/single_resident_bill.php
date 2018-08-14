<?php if ($previlages->READ == 1) { ?>
    <td ><span></span>
    <span class="hidden" id="loader_<?php echo $row->RESIDENT_BILL_ID; ?>"></span>
    </td>
    <td ><?php  echo $row->SESSION_ID; ?></td>
    <td ><?php  echo $row->RESEDENT_ID; ?></td>                   
    <td ><?php  echo $row->BILLING_MONTH; ?></td> 
    <td ><?php  echo $row->ELECTRIC_BILL; ?></td>
    <td ><?php  echo $row->WATER_BILL; ?></td>                   
    <td ><?php  echo $row->HOSTEL_FEE; ?></td> 

    <td >
        <?php if ($previlages->UPDATE == 1) { ?>
            <a class="label label-default openModal" id="<?php echo $row->RESIDENT_BILL_ID; ?>"
               title="Update Resident Bill" data-action="Finance/residentBillUpdate" data-type="edit"><i
                    class="fa fa-pencil"></i></a>
        <?php
        }
        if ($previlages->DELETE == 1) {
            ?>
            <a class="label label-danger deleteItem" id="<?php echo $row->RESIDENT_BILL_ID; ?>" title="Click For Delete"
               data-type="delete" data-field="RESIDENT_BILL_ID" data-tbl="ins_faculty"><i class="fa fa-times"></i></a>
        <?php
        }

        
        ?>
    </td>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>