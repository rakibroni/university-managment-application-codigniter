<style type="text/css">
    /***
User Profile Sidebar by @keenthemes
A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
Licensed under MIT
***/

    /* Profile container */
    .profile {
        margin: 20px 0;
    }

    /* Profile sidebar */
    .profile-sidebar {
        padding: 20px 0 10px 0;
        background: #fff;
    }

    .profile-userpic img {
        float: none;
        margin: 0 auto;
        width: 50%;
        height: 50%;
        -webkit-border-radius: 50% !important;
        -moz-border-radius: 50% !important;
        border-radius: 50% !important;
    }

    .profile-usertitle {
        text-align: center;
        margin-top: 20px;
    }

    .profile-usertitle-name {
        color: #5a7391;
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 7px;
    }

    .profile-usertitle-job {
        text-transform: uppercase;
        color: #5b9bd1;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .profile-userbuttons {
        text-align: center;
        margin-top: 10px;
    }

    .profile-userbuttons .btn {
        text-transform: uppercase;
        font-size: 11px;
        font-weight: 600;
        padding: 6px 15px;
        margin-right: 5px;
    }

    .profile-userbuttons .btn:last-child {
        margin-right: 0px;
    }

    .profile-usermenu {
        margin-top: 30px;
    }

    .profile-usermenu ul li {
        border-bottom: 1px solid #f0f4f7;
    }

    .profile-usermenu ul li:last-child {
        border-bottom: none;
    }

    .profile-usermenu ul li a {
        color: #93a3b5;
        font-size: 14px;
        font-weight: 400;
    }

    .profile-usermenu ul li a i {
        margin-right: 8px;
        font-size: 14px;
    }

    .profile-usermenu ul li a:hover {
        background-color: #fafcfd;
        color: #5b9bd1;
    }

    .profile-usermenu ul li.active {
        border-bottom: none;
    }

    .profile-usermenu ul li.active a {
        color: #5b9bd1;
        background-color: #f6f9fb;
        border-left: 2px solid #5b9bd1;
        margin-left: -2px;
    }

    /* Profile Content */
    .profile-content {
        padding: 20px;
        background: #fff;
        min-height: 460px;
    }

</style>
<div class="row profile">
    <span type="hidden" id="ITEM_ID" emp-data-id="<?php echo $librarySingleBorrowInfo->MEMBER_ID ?>"></span>

    <div class="col-md-12">
        <div class="profile-content">
            <h4 class="green"> Library Item Borrow Info</h4>
            <div class="ibox-content">
                <div class="table-responsive contentArea">
                    <table class="table table-striped table-bordered table-hover gridTable">
                        <tbody>
                        <tr>
                            <th>MEMBER ID</th>
                            <td>:</td>
                            <td><?php echo ($librarySingleBorrowInfo->MEMBER_ID !='')? " $librarySingleBorrowInfo->MEMBER_ID " :"" ?></td>
                        </tr>
                        <tr>
                            <th>MEMBER NAME</th>
                            <td>:</td>
                            <td><?php echo ($librarySingleBorrowInfo->FULL_NAME_EN !='')? " $librarySingleBorrowInfo->FULL_NAME_EN " :"" ?></td>
                        </tr>
                         <tr>
                            <th>MEMBER DEPERTMENT</th>
                            <td>:</td>
                            <td><?php echo ($librarySingleBorrowInfo->DEPT_NAME !='')? " $librarySingleBorrowInfo->DEPT_NAME " :"" ?></td>
                        </tr>
                         <tr>
                            <th>MEMBER MOBILE </th>
                            <td>:</td>
                            <td><?php echo ($librarySingleBorrowInfo->MOBILE_NO !='')? " $librarySingleBorrowInfo->MOBILE_NO " :"" ?></td>
                        </tr>
                        <tr>
                            <th>ITEM NAME</th>
                            <td>:</td>
                            <td><?php echo ($librarySingleBorrowInfo->ITEM_NAME !='')? " $librarySingleBorrowInfo->ITEM_NAME " :"" ?></td>
                        </tr>
                        <tr>
                            <th>ITEM NO</th>
                            <td>:</td>
                            <td><?php echo ($librarySingleBorrowInfo->STOCK_ID !='')? " $librarySingleBorrowInfo->STOCK_ID " :"" ?></td>
                        </tr>                   
                        <tr>
                            <th>BORRROW DATE </th>
                            <td>:</td>
                            <td><?php  $t = strtotime($librarySingleBorrowInfo->BORROW_DT); 
                                $START_DT = date('d/m/y',$t);  echo $START_DT;
                            ?></td>
                        </tr>
                        <tr>
                            <th>RETURN DATE </th>
                            <td>:</td>
                            <td>
                            <?php $t = strtotime($librarySingleBorrowInfo->RETURN_DT); 
                                $endDt = date('d/m/y',$t);  echo $endDt;
                            ?></td>
                        </tr>         

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        //to show the active menu function
        $('#navlist li').click(function (e) {
            e.preventDefault(); //prevent the link from being followed               
            $('#navlist li').removeClass('active');
            $(this).addClass('active');
        });

        $('#navlist li a').click(function () {
            var EMP_ID = $("#EMP_ID").attr('emp-data-id');
            var action_uri = $(this).attr('data-action');
            $.ajax({
                type: 'post',
                url: "<?php echo base_url(); ?>/" + action_uri,
                data: {EMP_ID: EMP_ID},
                beforeSend: function () {
                    $(".profile-content").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $('.profile-content').html(data);
                }
            });
        });
    });
</script>