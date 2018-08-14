<style type="text/css">
    /* Admission banner */
    .admisstion_banner {
        padding-top: 80px;
        background-image: url("<?php echo base_url(); ?>assets/img/admission-banner.jpg");
        background-size: 100%;
        padding-bottom: 100px;
    }

    .applican {
        background-color: #F4F4F4 !important;
    }

</style>
<section class="admisstion_banner"></section>
<section id="features" class="container services">
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-4">
                <div class="tabs-container">
                    <div class="panel-body applican">
                        <div class="pull-right"><a href="<?php echo base_url(); ?>portal/applicant"
                                                   class="badge badge-danger"><i class="fa fa-arrow-circle-left"></i>
                                Previous </a></div>
                        <h3><a><?php echo $degree_name->DEGREE_NAME; ?></a></h3>

                        <div class="hr-line-dashed"></div>
                        <?php foreach ($dept as $row): ?>
                            <h4>
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                   href="#<?php echo $row->DEPT_ID ?>" aria-expanded="false"
                                   aria-controls="collapseOne">
                                    <i class="fa fa-angle-right"></i> <?php echo $row->DEPT_NAME; ?>
                                </a>
                            </h4>
                            <div id="<?php echo $row->DEPT_ID ?>" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingOne">
                                <ul class="unstyled">
                                    <?php $PROGRAM_Name = $this->utilities->findAllByAttribute('program', array("DEGREE_ID" => $degree, "DEPT_ID" => $row->DEPT_ID));
                                    foreach ($PROGRAM_Name as $pro) : ?>
                                        <li><p style="color: inherit;"><a id="programList"
                                                                          href="<?php echo base_url() ?>Portal/portalDepartment/<?php echo $degree; ?>/<?php echo $pro->PROGRAM_ID; ?>/<?php echo $row->DEPT_ID; ?>"><i
                                                        class="fa fa-caret-right"></i>
                                                    &nbsp;<?php echo $pro->PROGRAM_NAME; ?></a></p></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="tabs-container">
                    <div class="panel-body applican">
                        <div class="pull-right"><span class="loader"></span></div>
                        <div id="deptInfo">
                            <h3><a>Admission to <?php echo $degree_name->DEGREE_NAME; ?></a></h3>

                            <div class="hr-line-dashed"></div>

                            <p>Admission to <?php echo $degree_name->DEGREE_NAME; ?> in Bangladesh is coordinated
                                through The Bangladeshi Universities. Section for Academic Administration is responsible
                                for admission to regular <?php echo $degree_name->DEGREE_NAME; ?> study programmes at
                                the University of KYAU.</p>

                            <h3>Undergraduate Admission Requirements</h3>

                            The minimum qualifications for admission into these programs are:
                            <p>
                            <ul>
                                <li>Academic Qualifications:</li>
                                <ol>
                                    <li>Combined GPA of 7.0 in both SSC and HSC with minimum GPA 3.0 in each.</li>
                                    <li>O-level in five subjects with Average Grade Point of 2.5 or above and A-level in
                                        two subjects with Average Grade Point of 2.0 and above; in the scale of A=5,
                                        B=4, C=3, D=2 & E=1. (One E is acceptable, either in O-levels or in A-levels)
                                    </li>
                                    <li>US High School Diploma or equivalent.</li>
                                </ol>
                                <li>Acceptable scores in KYAU's admission test.</li>
                                <li> Admission test will be waived for those who have got a minimum score of 1000 in SAT
                                    (Math+ Critical Reading) and 500 (CBT 213/IBT 79) in TOEFL or equivalent
                                </li>
                                <li>HSC/A-level (appeared) candidates may sit for the admission test on the basis of an
                                    undertaking that they will not be admitted to KYAU unless they pass the HSC/A level
                                    exams with minimum GPA requirement
                                </li>
                                <li>Application forms are available for Tk. 1000 from Southeast Bank, UCBL, DBBL, Bank
                                    Asia, One Bank, NCC Bank,IFIC Bank, Basundhara Branch, Dhaka.
                                </li>
                            </ul>
                            </p>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="contact" class="gray-section contact">
    <div class="container">
        <?php $this->load->view("template/footer"); ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        $("li p a").click(function (event) {
            var href = $(this).attr('href');
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: href,
                beforeSend: function () {
                    $(".loader").html("<img src='<?php echo base_url(); ?>assets/img/loader-small.gif' />");
                },
                success: function (data) {
                    $(".loader").html("");
                    $('#deptInfo').html(data);
                }
            });
        });
    });

</script>