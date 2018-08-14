<section id="testimonials" class="navy-section testimonials" style="margin-top:0; padding-top:0px; padding-bottom:0px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center wow zoomIn">
                <i class="fa fa-comment big-icon"></i>

                <h1>
                    What our student's say
                </h1>

                <div class="testimonials-text">
                    <i>"Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model
                        text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various
                        versions have evolved over the years, sometimes by accident, sometimes on purpose (injected
                        humour and the like)."</i>
                </div>
                <small>
                    <strong>12.02.2014 - Andy Smith</strong>
                </small>
            </div>
        </div>
    </div>
</section>


<section class="features" style="background:#f3f3f4;">
    <div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">
            <div class="col-lg-4">
                <div class="ibox">
                    <div class="ibox-content">
                        <h3>Degree List</h3>

                        <div class="input-group">
                            <input type="text" placeholder="Search by degree name"
                                   class="input input-sm form-control deg_value">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-info degree_search"><i
                                        class="fa fa-search"></i> Search
                                </button>
                            </span>
                        </div>

                        <ul class="sortable-list connectList agile-list common_degree">
                            <?php
                            $degreeList = $this->utilities->findAllByAttribute('degree', array('ACTIVE_STATUS' => 1));
                            foreach ($degreeList as $degreeInfo) {
                                ?>
                                <li class="success-element">
                                    <span class="openModal" title="Program list accourding to Degree"
                                          id="<?php echo $degreeInfo->DEGREE_ID; ?>" data-action="portal/applyDeg"
                                          data-type="edit"><?php echo $degreeInfo->DEGREE_NAME; ?></span>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                        <ul class="sortable-list connectList agile-list search_deg">

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ibox">
                    <div class="ibox-content">
                        <h3>Faculty List</h3>

                        <div class="input-group">
                            <input type="text" placeholder="Search by faculty name"
                                   class="input input-sm form-control fac_value">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-info degree_search"><i
                                        class="fa fa-search"></i> Search
                                </button>
                            </span>
                        </div>
                        <ul class="sortable-list connectList agile-list common_faculty">
                            <?php
                            $facultyList = $this->utilities->findAllFromView('faculty');

                            foreach ($facultyList as $facultyInfo) {
                                ?>
                                <li class="success-element">
                                    <span class="openModal" title="Program List Accourding to Faculty"
                                          id="<?php echo $facultyInfo->FACULTY_ID; ?>" data-action="portal/applyFel"
                                          data-type="edit"><?php echo $facultyInfo->FACULTY_NAME; ?></span>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                        <ul class="sortable-list connectList agile-list search_fac">

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ibox">
                    <div class="ibox-content">
                        <h3>Program List</h3>

                        <div class="input-group">
                            <input type="text" placeholder="Search by course name" class="input input-sm form-control">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-info"><i class="fa fa-search"></i> Search
                                </button>
                            </span>
                        </div>
                        <ul class="sortable-list connectList agile-list">
                            <?php
                            $programList = $this->utilities->findAllFromView('program');
                            foreach ($programList as $programInfo) {
                                ?>
                                <li class="success-element">
                                    <span title="Course List Accourding to Faculty"
                                          id="<?php echo $programInfo->PROGRAM_ID; ?>" class="openModal"
                                          data-action="portal/applyProg"
                                          data-type="edit"><?php echo $programInfo->PROGRAM_NAME; ?></span>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="contact" class="gray-section contact">
    <?php $this->load->view("template/footer"); ?>
</section>
<script>
    $(document).on('click', '.degree_search', function () {
        var find_deg = $('.deg_value').val();
        //var find_fac = $('.fac_value').val();
        if (find_deg != '')
            $(".common_degree").hide();
        //if(find_fac != '')
        //$(".common_faculty").hide();


        $.ajax({
            type: "POST",
            url: "degreeList",
            data: 'find_deg=' + find_deg,
            success: function (result) {
                $(".search_deg").html(result);
                //$(".search_fac").html(result);
                //$(".search_cou").html(result);
            }
        });
    });

    $(document).ready(function () {
        $(".fac_value").keyup(function () {

            var find_fac = $('.fac_value').val();
            if (find_fac.length > 2) {
                $('.common_faculty').hide();
                $('.search_fac').show();
                $.ajax({
                    type: "POST",
                    url: "degreeList",
                    data: 'find_fac=' + find_fac,
                    success: function (result) {
                        $(".search_fac").html(result);
                    }
                });
            } else {
                $('.common_faculty').show();
                $('.search_fac').hide();
            }
        });
    });

</script>