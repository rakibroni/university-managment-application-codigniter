<style type="text/css">
ul.tsc_pagination {
    padding: 12px 0px 0px 15px;
    height: 100%;
    overflow: hidden;
    font: 12px 'Tahoma';
    list-style-type: none;
}

ul.tsc_pagination li {
    float: left;
    margin: 0px;
    padding: 0px;
    margin-left: 5px;
}

ul.tsc_pagination li a {
    color: black;
    display: block;
    text-decoration: none;
    padding: 7px 10px 7px 10px;
}

ul.tsc_paginationA li a {
    color: #FFFFFF;
    border-radius: 3px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
}

ul.tsc_paginationA01 li a {
    color: #474747;
    border: solid 1px #B6B6B6;
    padding: 6px 9px 6px 9px;
    background: #E6E6E6;
    background: -moz-linear-gradient(top, #FFFFFF 1px, #F3F3F3 1px, #E6E6E6);
    background: -webkit-gradient(linear, 0 0, 0 100%, color-stop(0.02, #FFFFFF), color-stop(0.02, #F3F3F3), color-stop(1, #E6E6E6));
}

ul.tsc_paginationA01 li:hover a,
ul.tsc_paginationA01 li.current a {
    background: #FFFFFF;
}

.text {
    font-size: 12px;
    line-height: 17px;
    font-family: arial;
}

.text.short {
    height: 50px;
    overflow: hidden;
}

.text.full {

}

.read-more {
    cursor: pointer;
    color: lightseagreen;

}

</style>

<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <div class="ibox">
            <div class="ibox-content">
                <div class="pull-right">
                    <button class="btn btn-white btn-xs" type="button">Model</button>
                    <button class="btn btn-white btn-xs" type="button">Publishing</button>
                    <button class="btn btn-white btn-xs" type="button">Modern</button>
                </div>

                <div class="text-center article-title">
                    <span class="text-muted"><i class="fa fa-clock-o"></i> 28th Oct 2015</span>

                    <div class="gallery-thumb ">
                    <?php
                    $b_p = '';
                    if (!empty($blog_details->POST_BANNER)) {
                        $b_p = 'upload/blog_banner/' . $blog_details->POST_BANNER;
                    } else {
                        $b_p = 'assets/portal/images/events/event-list-thumb1.jpg';
                    }
                    ?>
                    <img src="<?php echo base_url($b_p) ?>"  style="height: 250px;width: 800px;margin-top: 15px;margin-left: 150px">

                </div>
                    <h1>
                        <?php echo $blog_details->POST_TITLE ?>
                    </h1>
                </div>
                <div class="">  
                    <?php echo $blog_details->POST_CONTENT ?> 
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <h5>Tags:</h5>
                        <button class="btn btn-primary btn-xs" type="button">Model</button>
                        <button class="btn btn-white btn-xs" type="button">Publishing</button>
                    </div>
                               <!--  <div class="col-md-6">
                                   <div class="small text-right">
                                       <h5>Stats:</h5>
                                       <div> <i class="fa fa-comments-o"> </i> 56 comments </div>
                                       <i class="fa fa-eye"> </i> 144 views
                                   </div>
                               </div> -->
                           </div>



                       </div>
                   </div>
               </div>
           </div>
           <script>
            $(document).on("click", ".read-more", function (e) {

                e.preventDefault();

                var $elem = $(this).parent().find(".text");
                if ($elem.hasClass("short")) {
                    $(this).text("Click to collapse");
                    $elem.removeClass("short").addClass("full");
                }
                else {
                    $(this).text("Read More..");
                    $elem.removeClass("full").addClass("short");
                }
            });
        </script>