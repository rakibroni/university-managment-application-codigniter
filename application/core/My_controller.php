<?php

class My_controller extends CI_Controller {
  public function __construct()
  {
    parent::__construct(); //need this!!

    //other construct code below here
  }

  public function another()
  {
    //some other function you want available to all other controllers that extend MY_Controller
  }
} 
