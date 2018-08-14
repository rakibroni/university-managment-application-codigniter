<div class="col-md-8">
    <div class="row">
        <div class="col-md-12">
            <div class="event-container clearfix">
                <div class="left-event-content">
                    <?php if (!empty($event_details)): ?>
                        <h2 class="event-title"><?php echo $event_details->E_TITLE ?></h2>
                        <span class="event-time"><?php echo date('d-M-Y', strtotime($event_details->START_DT)) ?>
                            - <?php echo date('d-M-Y', strtotime($event_details->END_DT)) ?></span>
                        <p> <?php echo $event_details->E_DESC; ?> </p>
                        <p><strong class="dark-text">Speaker:</strong> Professor Amanda Burls - Professor of
                            Public Health, City University London</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="widget-main">
        <div class="widget-main-title">
            <h4 class="widget-title">Upcoming Events</h4>
        </div>
        <div class="widget-inner">
            <?php foreach ($upcoming_events as $row): ?>
                <div class="event-small-list clearfix">
                    <div class="calendar-small">
                        <?php
                        $time = strtotime($row->CREATE_DATE);
                        $month = date("M", $time);
                        $year = date("Y", $time);
                        $day = date("d", $time);
                        ?>
                        <span class="s-month"><?php echo $month ?></span>
                        <span class="s-date"><?php echo $day ?></span>
                    </div>
                    <div class="event-small-details">
                        <h5 class="event-small-title"><a
                                href="<?php echo site_url('portal/event_details/' . $row->EVENT_ID); ?>"><?php echo $row->E_TITLE ?></a>
                        </h5>

                        <p class="event-small-meta small-text"> <?php echo date('h:i', strtotime($row->START_TIME)) ?>
                            to <?php echo date('h:i', strtotime($row->END_TIME)) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="widget-main">
        <div class="widget-main-title">
            <h4 class="widget-title">Our Gallery</h4>
        </div>
        <div class="widget-inner">
            <div class="gallery-small-thumbs clearfix">
                <div class="thumb-small-gallery closed" style="opacity: 1;">
                    <a title="Gallery Tittle One" href="images/gallery/gallery1.jpg" rel="gallery1"
                       class="fancybox">
                        <img alt=""
                             src="<?php echo base_url() ?>/assets/portal/images/gallery/gallery-small-thumb1.jpg">
                    </a>
                </div>
                <div class="thumb-small-gallery closed" style="opacity: 1;">
                    <a title="Gallery Tittle One" href="images/gallery/gallery2.jpg" rel="gallery1"
                       class="fancybox">
                        <img alt=""
                             src="<?php echo base_url() ?>/assets/portal/images/gallery/gallery-small-thumb2.jpg">
                    </a>
                </div>
                <div class="thumb-small-gallery closed" style="opacity: 1;">
                    <a title="Gallery Tittle One" href="images/gallery/gallery3.jpg" rel="gallery1"
                       class="fancybox">
                        <img alt=""
                             src="<?php echo base_url() ?>/assets/portal/images/gallery/gallery-small-thumb3.jpg">
                    </a>
                </div>
                <div class="thumb-small-gallery closed" style="opacity: 1;">
                    <a title="Gallery Tittle One" href="images/gallery/gallery4.jpg" rel="gallery1"
                       class="fancybox">
                        <img alt=""
                             src="<?php echo base_url() ?>/assets/portal/images/gallery/gallery-small-thumb4.jpg">
                    </a>
                </div>
                <div class="thumb-small-gallery closed" style="opacity: 1;">
                    <a title="Gallery Tittle One" href="images/gallery/gallery5.jpg" rel="gallery1"
                       class="fancybox">
                        <img alt=""
                             src="<?php echo base_url() ?>/assets/portal/images/gallery/gallery-small-thumb5.jpg">
                    </a>
                </div>
                <div class="thumb-small-gallery closed" style="opacity: 1;">
                    <a title="Gallery Tittle One" href="images/gallery/gallery6.jpg" rel="gallery1"
                       class="fancybox">
                        <img alt=""
                             src="<?php echo base_url() ?>/assets/portal/images/gallery/gallery-small-thumb6.jpg">
                    </a>
                </div>
                <div class="thumb-small-gallery closed" style="opacity: 1;">
                    <a title="Gallery Tittle One" href="images/gallery/gallery7.jpg" rel="gallery1"
                       class="fancybox">
                        <img alt=""
                             src="<?php echo base_url() ?>/assets/portal/images/gallery/gallery-small-thumb7.jpg">
                    </a>
                </div>
                <div class="thumb-small-gallery closed" style="opacity: 1;">
                    <a title="Gallery Tittle One" href="images/gallery/gallery8.jpg" rel="gallery1"
                       class="fancybox">
                        <img alt=""
                             src="<?php echo base_url() ?>/assets/portal/images/gallery/gallery-small-thumb8.jpg">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
