<?php
$controller = $this->uri->segment(1);
$action = $this->uri->segment(2);
$applicant_ses=$this->session->userdata('applicant_logged_in');

?>
<nav class="navbar-default navbar-static-side" role="navigation">

    <div class="sidebar-collapse">

        <ul class="nav sidebar-menu" id="side-menu">
            <li class="nav-header">

                <div class="logo-element">
                    KYAU
                </div>
            </li>
           
                <li>
                    <a href="<?php echo site_url()?>/applicant/admission"><i class="fa fa-pie-chart"></i> <span class="nav-label">Admission</span>  </a>
                </li>

            <li>
                <a href="<?php echo site_url()?>/applicant/admitCardStatus"><i class="fa fa-diamond"></i> <span class="nav-label">Admission Status</span></a>
            </li>

        </ul>


    </div>
</nav>
