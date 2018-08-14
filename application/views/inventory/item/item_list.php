<style type="text/css">
    .tree {
        margin-left: -15px;
        margin-top: 10px;
        width: 100%;
    }
    .tree li {
        list-style-type:none;
        margin:0;
        padding:10px 5px 0 5px;
        position:relative
    }
    .tree li::before, .tree li::after {
        content:'';
        left:-20px;
        position:absolute;
        right:auto
    }
    .tree li::before {
        border-left:1px solid #999;
        bottom:50px;
        height:100%;
        top:0;
        width:1px
    }
    .tree li::after {
        border-top:1px solid #999;
        height:20px;
        top:25px;
        width:25px
    }
    .tree li span {
        -moz-border-radius:5px;
        -webkit-border-radius:5px;
        border:1px solid #999;
        border-radius:5px;
        display:inline-block;
        padding:3px 8px;
        text-decoration:none
    }
    .tree li.parent_li>span {
        cursor:pointer
    }
    .tree>ul>li::before, .tree>ul>li::after {
        border:0
    }
    .tree li:last-child::before {
        height:30px
    }
    .tree li.parent_li>span:hover, .tree li.parent_li>span:hover+ul li span {
        background:#eee;
        border:1px solid #94a0b4;
        color:#000
    }
    .custom_panel{
        padding: 15px;
        overflow: hidden;
        margin-left: 9px;
        width: 101%;
    }
</style>
<?php if ($previlages->READ == 1) { 
    function display_children($parent_id, $level) {
        $sql = "SELECT c.ITEM_ID,
                       c.ITEM_NAME,
                       c.ITEM_CODE,
                       Deriv1.count_row
                FROM inv_item c
                     LEFT OUTER JOIN (SELECT PARENT_ITEM_ID, COUNT(*) AS count_row
                                      FROM `inv_item`
                                      GROUP BY PARENT_ITEM_ID) Deriv1
                        ON c.ITEM_ID = Deriv1.PARENT_ITEM_ID
                WHERE c.PARENT_ITEM_ID = $parent_id";
        $CI = get_instance();
        $result = $CI->db->query($sql)->result();

        echo "<ul>";
        if (!empty($result)) {
            foreach ($result as $row) {
                if ($row->count_row > 0) {
                    echo '<li><a id="' . $row->ITEM_ID . '" class="btn btn-primary btn-xs openModal" href="#" title="Create Item" data-action="inventory/itemFormInsert" data-type="edit">
                            <i class="glyphicon glyphicon-plus"></i>
                        </a>' . ' <span>' . $row->ITEM_NAME . '</span> <a id="' . $row->ITEM_ID . '" class="label label-default openModal" href="#" title="Update Item Information" data-action="inventory/itemFormUpdate" data-type="edit">
                            <i class="fa fa-pencil"></i>
                        </a>&nbsp;
                        <a class="label label-danger deleteItem" id="'. $row->ITEM_ID . '" title="Click For Delete" data-type="delete" data-field="ITEM_ID" data-tbl="inv_item"><i class="fa fa-times"></i></a>';
                    display_children($row->ITEM_ID, $level + 1);
                    echo "</li>";
                } else {
                    echo '<li><a id="' . $row->ITEM_ID . '" class="btn btn-primary btn-xs openModal" href="#" title="Create Item" data-action="inventory/itemFormInsert" data-type="edit">
                            <i class="glyphicon glyphicon-plus"></i>
                        </a>' . ' <span>' . $row->ITEM_NAME . '</span> <a id="' . $row->ITEM_ID . '" class="label label-default openModal" href="#" title="Update Item Information" data-action="inventory/itemFormUpdate" data-type="edit">
                            <i class="fa fa-pencil"></i>
                        </a>&nbsp;
                        <a class="label label-danger deleteItem" id="'. $row->ITEM_ID . '" title="Click For Delete" data-type="delete" data-field="ITEM_ID" data-tbl="inv_item"><i class="fa fa-times"></i></a>';
                }
            }
        }
        echo "</ul>";
    }
    ?>
    <div class="tree well">
        <ul>
            <li>
            <a id="0" class="btn btn-primary btn-xs openModal" href="#" title="Create Item" data-action="inventory/itemFormInsert" data-type="edit">
                            <i class="glyphicon glyphicon-plus"></i>
            </a>
            <span>List of Item</span> 
            
            </li>
            <?php echo display_children(0, 0); ?>
        </ul>
    </div>


    <?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>

<script type="text/javascript">
    $(function() {
        $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
        $('.tree li.parent_li > span').on('click', function(e) {
            var children = $(this).parent('li.parent_li').find(' > ul > li');
            if (children.is(":visible")) {
                children.hide('fast');
                $(this).attr('title', 'Expand this branch').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
            } else {
                children.show('fast');
                $(this).attr('title', 'Collapse this branch').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
            }
            e.stopPropagation();
        });
        //$(this).parent('li.parent_li').find(' > ul').removeClass('hide').addClass('show');
    });
</script>