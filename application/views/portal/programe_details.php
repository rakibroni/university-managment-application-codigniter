<div id="inSlider" class="carousel carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#inSlider" data-slide-to="0" class="active"></li>
        <li data-target="#inSlider" data-slide-to="1"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <div class="container">
                <div class="carousel-caption">
                    <h1>We craft<br/>
                        brands, web apps,<br/>
                        and user interfaces<br/>
                        we are IN+ studio</h1>

                    <p>Lorem Ipsum is simply dummy text of the printing.</p>

                    <p>
                        <a class="btn btn-lg btn-primary" href="landing.html#" role="button">READ MORE</a>
                        <a class="caption-link" href="landing.html#" role="button">Inspinia Theme</a>
                    </p>
                </div>
                <div class="carousel-image wow zoomIn">
                    <img src="<?php echo base_url(); ?>assets/img/landing/laptop.png" alt="laptop"/>
                </div>
            </div>
            <!-- Set background for slide in css -->
            <div class="header-back one"></div>

        </div>
        <div class="item">
            <div class="container">
                <div class="carousel-caption blank">
                    <h1>We create meaningful <br/> interfaces that inspire.</h1>

                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>

                    <p><a class="btn btn-lg btn-primary" href="landing.html#" role="button">Learn more</a></p>
                </div>
            </div>
            <!-- Set background for slide in css -->
            <div class="header-back two"></div>
        </div>
    </div>
    <a class="left carousel-control" href="landing.html#inSlider" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="landing.html#inSlider" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


<section class="features">
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <?php foreach ($degree as $row) { ?>

                    <h1><?php echo $row->programe_name; ?> Department</h1>
                <?php } ?>

            </div>
        </div>
        <?php $i = 1; ?>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1 features-text">
                <div class="ibox float-e-margins">

                    <div class="ibox-content">

                        <table class="table table-striped">
                            <th></th>
                            <th>Title</th>
                            <th>Info</th>
                            <tr>
                                <td></td>
                                <td>Total Credit</td>
                                <td>161</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Duration</td>
                                <td>4 years</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Course Fee</td>
                                <td>BDT 3,000 000</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Program Type</td>
                                <td>Undergraduate</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Department</td>
                                <td>Textile Engineering</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-primary">APPLY</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-5 col-lg-offset-1 features-text">
                <?php foreach ($programe as $row) { ?>
                    <h2><i class="fa fa-angle-right"></i> <?php echo " &nbsp;&nbsp;"; ?>  <a
                            href="<?php echo base_url() . 'portal/programDetails/' . $row->program_id; ?>"><?php echo $row->programe_name; ?></a>
                    </h2>
                    <?php $i++;
                } ?>
            </div>

        </div>

    </div>


</section>

<section id="contact" class="gray-section contact">
    <?php $this->load->view("template/footer"); ?>
</section>