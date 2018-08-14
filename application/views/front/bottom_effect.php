<section class="ct-u-paddingBoth100 ct-u-backgroundLightGreen">
    <div class="container">
        <div class="ct-slick ct-js-slick" data-adaptiveHeight="true" data-animations="true" data-autoplay="true"
             data-infinite="true" data-autoplaySpeed="6000" data-draggable="false" data-touchMove="false"
             data-arrows="true" data-items="1">
            <div class="item">
                <h2 class="ct-fw-700">Undergraduate Programs</h2>

                <div class="ct-divider ct-u-marginBoth30"></div>
                <p class="ct-u-marginBottom90">
                    consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque
                    penatibus etma
                    enim. Donec pede justo .

                </p>

                <div class="row">
                    <?php
                    for ($i = 0; $i <= 4; $i++) {
                        ?>
                        <div class="col-sm-6 col-md-3 bottom_gap">
                            <div class="ct-productBox">
                                <a href="<?php echo base_url(); ?>index.php/info/student_registration">
                                    <div class="ct-productImage">
                                        <img src="<?= base_url(); ?>front/assets/images/demo-content/productBox-1.jpg"
                                             alt="Product">
                                    </div>
                                    <div class="ct-productDescription">
                                        <h5 class="ct-fw-600 ct-u-marginBottom10">Developing Mobile Apps</h5>
                                        <span>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean .</span>
                                    </div>
                                </a>

                            </div>
                        </div>
                    <?php
                    }
                    ?>


                </div>
            </div>


            <div class="item">
                <h2 class="ct-fw-700">Graduate Programs</h2>

                <div class="ct-divider ct-u-marginBoth30"></div>
                <p class="ct-u-marginBottom90">
                    consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque
                    penatibus etma
                    enim. Donec pede justo .

                </p>

                <div class="row">
                    <?php
                    for ($i = 0; $i <= 4; $i++) {
                        ?>
                        <div class="col-sm-6 col-md-3 bottom_gap">
                            <div class="ct-productBox">
                                <a href="<?php echo base_url(); ?>index.php/info/student_registration">
                                    <div class="ct-productImage">
                                        <img src="<?= base_url(); ?>front/assets/images/demo-content/productBox-1.jpg"
                                             alt="Product">
                                    </div>
                                    <div class="ct-productDescription">
                                        <h5 class="ct-fw-600 ct-u-marginBottom10">Developing Mobile Apps</h5>
                                        <span>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean .</span>
                                    </div>
                                </a>

                            </div>
                        </div>
                    <?php
                    }
                    ?>


                </div>
            </div>

        </div>
</section>