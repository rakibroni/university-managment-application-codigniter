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

<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Finance List</h5>
    </div>
    <div class="ibox-content">
        <?php
        function display_children($parent_id, $level, $type_id) {
            $sql = "SELECT c.AC_NO,
                       c.AC_NO_UD,
                       c.AC_NAME,
                       c.AC_TYPE_NO,
                       Deriv1.count_row
                FROM fn_achead c
                     LEFT OUTER JOIN (SELECT PARANT_AC_NO, COUNT(*) AS count_row
                                      FROM `fn_achead`
                                      GROUP BY PARANT_AC_NO) Deriv1
                        ON c.AC_NO = Deriv1.PARANT_AC_NO
                WHERE c.PARANT_AC_NO = $parent_id  and c.AC_TYPE_NO=$type_id";
            $CI = get_instance();
            $result = $CI->db->query($sql)->result();
            
            echo "<ul>";
            if (!empty($result)) {
                foreach ($result as $row) {
                    if ($row->count_row > 0) {
                        echo '<li><a id="'. $row->AC_NO .','.$row->AC_TYPE_NO .'" class="btn btn-primary btn-xs openModal" href="#" title="Create Chart of Account" data-action="finance/chartofAccFormInsert" data-type="edit">
                            <i class="glyphicon glyphicon-plus"></i>
                        </a>' . ' <span>' . $row->AC_NAME .'</span> <a id="'. $row->AC_NO .'" class="label label-default openModal" href="#" title="Edit Chart of Account" data-action="finance/chartofAccFormUpdate" data-type="edit">
                            <i class="fa fa-pencil"></i>
                        </a>&nbsp;
                        <a class="label label-danger deleteItem" id="'. $row->AC_NO . '" title="Click For Delete" data-type="delete" data-field="AC_NO" data-tbl="fn_achead"><i class="fa fa-times"></i></a>';
                        display_children($row->AC_NO, $level + 1, $row->AC_TYPE_NO);
                        echo "</li>";
                    } else {
                        echo '<li><a id="'. $row->AC_NO .','.$row->AC_TYPE_NO .'" class="btn btn-primary btn-xs openModal" href="#" title="Create Chart of Account" data-action="finance/chartofAccFormInsert" data-type="edit">
                            <i class="glyphicon glyphicon-plus"></i>
                        </a>' . ' <span>' . $row->AC_NAME .'</span> <a id="'. $row->AC_NO .'" class="label label-default openModal" href="#" title="Edit Chart of Account" data-action="finance/chartofAccFormUpdate" data-type="edit">
                            <i class="fa fa-pencil"></i>
                        </a>&nbsp;
                        <a class="label label-danger deleteItem" id="'. $row->AC_NO . '" title="Click For Delete" data-type="delete" data-field="AC_NO" data-tbl="fn_achead"><i class="fa fa-times"></i></a>';
                    }
                }
            }
            echo "</ul>";
        }
        ?>
        <div class="tree well">
            <ul>
                <li><span>Chart of Account</span></li>
                <?php foreach ($fn_acctype as $row) { ?>
                <li>
                        <a id="0,<?php echo $row->AC_TYPE_NO;?>" class="btn btn-primary btn-xs openModal" href="#" title="Create Chart of Account" data-action="finance/chartofAccFormInsert" data-type="edit">
                            <i class="glyphicon glyphicon-plus"></i>
                        </a>
                        <span><?php echo $row->AC_TYPE; ?></span>
                        <?php echo display_children(0, 0, $row->AC_TYPE_NO); ?>
                    </li>
                <?php }
                ?>
            </ul>
        </div>
    </div>
</div>


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