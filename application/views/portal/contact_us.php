<div class="col-md-5">
    <div class="contact-map">
        <div class="google-map-canvas" id="map-canvas" style="height: 542px;">
            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
            <div style="overflow:hidden;height:540px;width:442px;">
                <div id="gmap_canvas" style="height:500px;width:600px;"></div>
                <style>
                    #gmap_canvas img {
                        max-width: none !important;
                        background: none !important
                    }
                </style>
                <a class="google-map-code" href="http://wordpress-themes.org" id="get-map-data">KYAU</a>
            </div>
            <script type="text/javascript">
                function init_map() {
                    var myOptions = {
                        zoom: 15,
                        center: new google.maps.LatLng(24.3889913, 89.71335279999994),
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                    map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
                    marker = new google.maps.Marker({
                        map: map,
                        position: new google.maps.LatLng(24.3889913, 89.71335279999994)
                    });
                    infowindow = new google.maps.InfoWindow({content: "<b>KYAU</b><br/>Enayetpur,Chowhali<br/>6751 Sirajgonj"});
                    google.maps.event.addListener(marker, "click", function () {
                        infowindow.open(map, marker);
                    });
                    infowindow.open(map, marker);
                }
                google.maps.event.addDomListener(window, 'load', init_map);
            </script>
        </div>
    </div>
</div> <!-- /.col-md-5 -->

<div class="col-md-7">
    <div class="contact-page-content">
        <div class="contact-heading">
            <h3>Our Contact Details</h3>

            <p>Please don't hesitate contact us any further information </p>
        </div>
        <div class="contact-form clearfix">
            <p class="full-row">
                            <span class="contact-label">
                                <label for="name-id">First Name:</label>
                                <span class="small-text">Put your name here</span>
                            </span>
                <input type="text" id="name-id" name="name-id"/>
            </p>

            <p class="full-row">
                            <span class="contact-label">
                                <label for="surname-id">Last Name:</label>
                                <span class="small-text">Put your surname here</span>
                            </span>
                <input type="text" id="surname-id" name="surname-id"/>
            </p>

            <p class="full-row">
                            <span class="contact-label">
                                <label for="email-id">E-mail:</label>
                                <span class="small-text">Type email address</span>
                            </span>
                <input type="text" id="email-id" name="email-id"/>
            </p>

            <p class="full-row">
                            <span class="contact-label">
                                <label for="message">Message:</label>
                                <span class="small-text">Type email address</span>
                            </span>
                <textarea name="message" id="message" rows="6"></textarea>
            </p>

            <p class="full-row">
                <input class="mainBtn" type="submit" name="" value="Send Message"/>
            </p>
        </div>
    </div>
</div> <!-- /.col-md-7 -->
